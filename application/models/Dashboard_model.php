<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    // Get summary statistics for dashboard
    public function get_dashboard_summary() {
        $summary = array();
        
        // Total active projects
        $this->db->select('COUNT(*) as total');
        $this->db->where('flag', '0');
        $query = $this->db->get('sample_reception');
        $summary['total_projects'] = $query->row()->total;

        // Total samples
        $this->db->select('COUNT(*) as total');
        $this->db->where('flag', '0');
        $query = $this->db->get('sample_reception_sample');
        $summary['total_samples'] = $query->row()->total;

        // Total tests (from all testing modules)
        $this->db->select('COUNT(*) as total');
        $this->db->where('flag', '0');
        $query = $this->db->get('sample_reception_testing');
        $summary['total_tests'] = $query->row()->total;

        // Projects today
        $this->db->select('COUNT(*) as total');
        $this->db->where('flag', '0');
        $this->db->where('DATE(date_created)', date('Y-m-d'));
        $query = $this->db->get('sample_reception');
        $summary['projects_today'] = $query->row()->total;

        return $summary;
    }

    // Get module statistics
    public function get_module_statistics() {
        $modules = array(
            'biobank_in' => 'Biobank Storage',
            'moisture_content' => 'Moisture Content',
            'campy_biosolids' => 'Campylobacter (Biosolids)',
            'campy_liquids' => 'Campylobacter (Liquids)',
            'campy_pa' => 'Campylobacter P/A',
            'salmonella_liquids' => 'Salmonella (Liquids)',
            'salmonella_biosolids' => 'Salmonella (Biosolids)',
            'salmonella_pa' => 'Salmonella P/A',
            'extraction_culture' => 'DNA Extraction (Culture)',
            'extraction_liquid' => 'DNA Extraction (Liquid)',
            'extraction_metagenome' => 'DNA Extraction (Metagenome)',
            'enterolert_water_in' => 'Enterolert (Water)',
            'enterolert_biosolids_in' => 'Enterolert (Biosolids)',
            'colilert_biosolids_in' => 'Colilert (Biosolids)',
            'colilert_water_in' => 'Colilert (Water)',
            'protozoa' => 'Protozoa Analysis',
            'hemoflow' => 'HemoFlow Analysis'
        );

        $statistics = array();
        
        foreach ($modules as $table => $name) {
            if ($this->db->table_exists($table)) {
                // Total records
                $this->db->select('COUNT(*) as total');
                $this->db->where('flag', '0');
                $query = $this->db->get($table);
                $total = $query->row()->total;

                // Records today
                $this->db->select('COUNT(*) as today');
                $this->db->where('flag', '0');
                $this->db->where('DATE(date_created)', date('Y-m-d'));
                $query = $this->db->get($table);
                $today = $query->row()->today;

                // Completed tests (where review = 1)
                $this->db->select('COUNT(*) as completed');
                $this->db->where('flag', '0');
                $this->db->where('review', '1');
                $query = $this->db->get($table);
                $completed = $query->row()->completed;

                $statistics[] = array(
                    'module' => $name,
                    'table' => $table,
                    'total' => $total,
                    'today' => $today,
                    'completed' => $completed,
                    'pending' => $total - $completed,
                    'completion_rate' => $total > 0 ? round(($completed / $total) * 100, 1) : 0
                );
            }
        }

        return $statistics;
    }

    // Get recent activities
    public function get_recent_activities($limit = 10) {
        $activities = array();

        // Recent sample receptions
        $this->db->select('id_project, client, id_client_sample, date_created, "sample_reception" as module_type');
        $this->db->where('flag', '0');
        $this->db->order_by('date_created', 'DESC');
        $this->db->limit($limit/2);
        $query = $this->db->get('sample_reception');
        
        foreach ($query->result() as $row) {
            $activities[] = array(
                'module' => 'Sample Reception',
                'action' => 'New Project Created',
                'description' => "Project {$row->id_project} - {$row->id_client_sample}",
                'date' => $row->date_created,
                'icon' => 'fa-plus',
                'color' => 'bg-blue'
            );
        }

        // Recent test completions (from review status)
        $modules_with_review = array('campy_biosolids', 'campy_liquids', 'salmonella_liquids', 'salmonella_biosolids');
        
        foreach ($modules_with_review as $table) {
            if ($this->db->table_exists($table)) {
                $this->db->select("id_one_water_sample, date_updated, '{$table}' as module_type");
                $this->db->where('flag', '0');
                $this->db->where('review', '1');
                $this->db->order_by('date_updated', 'DESC');
                $this->db->limit(2);
                $query = $this->db->get($table);
                
                foreach ($query->result() as $row) {
                    $module_name = ucwords(str_replace('_', ' ', $table));
                    $activities[] = array(
                        'module' => $module_name,
                        'action' => 'Test Completed',
                        'description' => "Sample {$row->id_one_water_sample}",
                        'date' => $row->date_updated,
                        'icon' => 'fa-check',
                        'color' => 'bg-green'
                    );
                }
            }
        }

        // Sort by date
        usort($activities, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        return array_slice($activities, 0, $limit);
    }

    // Get workflow status
    public function get_workflow_status() {
        $workflow = array();

        // Sample reception to testing workflow
        $sql = "SELECT 
                    sr.id_project,
                    sr.id_client_sample,
                    COUNT(srs.id_sample) as total_samples,
                    COUNT(srt.id_testing) as total_tests,
                    COUNT(CASE WHEN COALESCE(
                        bank.review, campy.review, salmonellaL.review, salmonellaB.review, 
                        ec.review, el.review, em.review, cb.review, mc.review, 
                        ewi.review, ebi.review, cbi.review, cwi.review, 
                        pr.review, cp.review, sp.review, hem.review
                    ) = 1 THEN 1 END) as completed_tests,
                    sr.date_created
                FROM sample_reception sr
                LEFT JOIN sample_reception_sample srs ON sr.id_project = srs.id_project AND srs.flag = 0
                LEFT JOIN sample_reception_testing srt ON srs.id_sample = srt.id_sample AND srt.flag = 0
                LEFT JOIN biobank_in bank ON bank.biobankin_barcode = srt.barcode AND bank.flag = 0
                LEFT JOIN campy_liquids campy ON campy.campy_assay_barcode = srt.barcode AND campy.flag = 0
                LEFT JOIN salmonella_liquids salmonellaL ON salmonellaL.salmonella_assay_barcode = srt.barcode AND salmonellaL.flag = 0
                LEFT JOIN salmonella_biosolids salmonellaB ON salmonellaB.salmonella_assay_barcode = srt.barcode AND salmonellaB.flag = 0
                LEFT JOIN extraction_culture ec ON ec.extraction_barcode = srt.barcode AND ec.flag = 0
                LEFT JOIN extraction_liquid el ON el.extraction_barcode = srt.barcode AND el.flag = 0
                LEFT JOIN extraction_metagenome em ON em.extraction_barcode = srt.barcode AND em.flag = 0
                LEFT JOIN campy_biosolids cb ON cb.campy_assay_barcode = srt.barcode AND cb.flag = 0
                LEFT JOIN moisture_content mc ON mc.barcode_moisture_content = srt.barcode AND mc.flag = 0
                LEFT JOIN enterolert_water_in ewi ON ewi.enterolert_barcode = srt.barcode AND ewi.flag = 0
                LEFT JOIN enterolert_biosolids_in ebi ON ebi.enterolert_barcode = srt.barcode AND ebi.flag = 0
                LEFT JOIN colilert_biosolids_in cbi ON cbi.colilert_barcode = srt.barcode AND cbi.flag = 0
                LEFT JOIN colilert_water_in cwi ON cwi.colilert_barcode = srt.barcode AND cwi.flag = 0
                LEFT JOIN protozoa pr ON pr.protozoa_barcode = srt.barcode AND pr.flag = 0
                LEFT JOIN campy_pa cp ON cp.campy_assay_barcode = srt.barcode AND cp.flag = 0
                LEFT JOIN salmonella_pa sp ON sp.salmonella_assay_barcode = srt.barcode AND sp.flag = 0
                LEFT JOIN hemoflow hem ON hem.hemoflow_barcode = srt.barcode AND hem.flag = 0
                WHERE sr.flag = 0
                GROUP BY sr.id_project
                ORDER BY sr.date_created DESC";

        $query = $this->db->query($sql);
        
        foreach ($query->result() as $row) {
            $completion_rate = $row->total_tests > 0 ? round(($row->completed_tests / $row->total_tests) * 100, 1) : 0;
            
            $status = 'pending';
            if ($completion_rate == 100) $status = 'completed';
            elseif ($completion_rate > 0) $status = 'in-progress';

            $workflow[] = array(
                'project_id' => $row->id_project,
                'description' => $row->id_client_sample,
                'total_samples' => $row->total_samples,
                'total_tests' => $row->total_tests,
                'completed_tests' => $row->completed_tests,
                'completion_rate' => $completion_rate,
                'status' => $status,
                'date_created' => $row->date_created
            );
        }

        return $workflow;
    }

    // Get monthly statistics for charts
    public function get_monthly_statistics() {
        $months = array();
        
        // Get last 6 months data
        for ($i = 5; $i >= 0; $i--) {
            $date = date('Y-m', strtotime("-{$i} months"));
            $month_name = date('M Y', strtotime("-{$i} months"));
            
            // Projects count
            $this->db->select('COUNT(*) as count');
            $this->db->where('flag', '0');
            $this->db->where("DATE_FORMAT(date_created, '%Y-%m') =", $date);
            $query = $this->db->get('sample_reception');
            $projects = $query->row()->count;

            // Samples count
            $this->db->select('COUNT(*) as count');
            $this->db->where('flag', '0');
            $this->db->where("DATE_FORMAT(date_created, '%Y-%m') =", $date);
            $query = $this->db->get('sample_reception_sample');
            $samples = $query->row()->count;

            // Tests count (approximate based on all testing modules)
            $tests = 0;
            $testing_tables = array(
                'campy_biosolids_qpcr', 'campy_biosolids', 'campy_liquids', 'campy_pa',
                'colilert_biosolids_in', 'colilert_water_in', 'enterolert_biosolids_in', 
                'enterolert_water_in', 'salmonella_biosolids', 'salmonella_liquids', 
                'salmonella_pa', 'moisture_content', 'hemoflow', 'protozoa'
            );
            
            foreach ($testing_tables as $table) {
                $this->db->select('COUNT(*) as count');
                $this->db->where('flag', '0');
                $this->db->where("DATE_FORMAT(date_created, '%Y-%m') =", $date);
                $result = $this->db->get($table);
                if ($result && $result->num_rows() > 0) {
                    $tests += $result->row()->count;
                }
            }

            $months[] = array(
                'month' => $month_name,
                'projects' => $projects,
                'samples' => $samples,
                'tests' => $tests
            );
        }

        return $months;
    }
}