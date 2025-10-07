<style>
::-webkit-scrollbar {
  width: 10px;
  height: 10px;
}

::-webkit-scrollbar-thumb {
  background: rgba(0, 0, 0, 0.1);
}

::-webkit-scrollbar-track {
  background: rgba(0, 0, 0, 0);
}
</style>

<div class="content-wrapper">
    <section class="content">
                <!-- Welcome Header -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-dashboard"></i> One Water LIMS Dashboard
                        </h3>
                        <div class="box-tools pull-right">
                            <span class="label label-primary">Welcome, <?php echo $this->session->userdata('full_name'); ?>!</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo number_format($summary['total_projects'] ?? 0); ?></h3>
                        <p>Total Projects</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-folder-open"></i>
                    </div>
                    <a href="<?php echo site_url('sample_reception'); ?>" class="small-box-footer">
                        <!-- More info <i class="fa fa-arrow-circle-right"></i> -->
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo number_format($summary['total_samples'] ?? 0); ?></h3>
                        <p>Total Samples</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-flask"></i>
                    </div>
                    <a href="<?php echo site_url('sample_reception'); ?>" class="small-box-footer">
                        <!-- More info <i class="fa fa-arrow-circle-right"></i> -->
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo number_format($summary['total_tests'] ?? 0); ?></h3>
                        <p>Total Tests</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bar-chart"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        <!-- More info <i class="fa fa-arrow-circle-right"></i> -->
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo number_format($summary['projects_today'] ?? 0); ?></h3>
                        <p>New Projects Today</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-plus-circle"></i>
                    </div>
                    <a href="<?php echo site_url('sample_reception'); ?>" class="small-box-footer">
                        <!-- More info <i class="fa fa-arrow-circle-right"></i> -->
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content Row -->
        <div class="row">
            <div class="col-md-8">
                <!-- Monthly Trends Chart -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-line-chart"></i> Monthly Trends
                        </h3>
                    </div>
                    <div class="box-body">
                        <div id="monthly_chart" style="height: 300px;"></div>
                    </div>
                </div>

                <!-- Module Performance Overview -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-cogs"></i> Module Performance Overview
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Module</th>
                                        <th class="text-center">Total</th>
                                        <!-- <th class="text-center">Today</th> -->
                                        <th class="text-center">Completed</th>
                                        <th class="text-center">Pending</th>
                                        <th class="text-center">Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($module_statistics)): ?>
                                        <?php foreach ($module_statistics as $module): ?>
                                            <tr>
                                                <td><strong><?php echo htmlspecialchars($module['module']); ?></strong></td>
                                                <td class="text-center">
                                                    <span class="badge bg-blue"><?php echo number_format($module['total']); ?></span>
                                                </td>
                                                <!-- <td class="text-center">
                                                    <span class="badge bg-green"><?php echo number_format($module['today']); ?></span>
                                                </td> -->
                                                <td class="text-center">
                                                    <span class="badge bg-green"><?php echo number_format($module['completed']); ?></span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-yellow"><?php echo number_format($module['pending']); ?></span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar progress-bar-<?php echo $module['completion_rate'] >= 80 ? 'success' : ($module['completion_rate'] >= 50 ? 'warning' : 'danger'); ?>" 
                                                             style="width: <?php echo $module['completion_rate']; ?>%"></div>
                                                    </div>
                                                    <span class="badge bg-gray"><?php echo $module['completion_rate']; ?>%</span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No module data available</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Quick Actions -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-tasks"></i> Quick Actions
                        </h3>
                    </div>
                    <div class="box-body">
                        <div>
                            <div class="col-xs-12">
                                <a href="<?php echo site_url('sample_reception?new_modal=1'); ?>" class="btn btn-app btn-block">
                                    <i class="fa fa-plus"></i> New Project
                                </a>
                            </div>
                            <!-- <div class="col-xs-12">
                                <a href="<?php echo site_url('sample_reception'); ?>" class="btn btn-app btn-block">
                                    <i class="fa fa-search"></i> View Samples
                                </a>
                            </div>
                            <div class="col-xs-12">
                                <a href="#" class="btn btn-app btn-block">
                                    <i class="fa fa-download"></i> Export Reports
                                </a>
                            </div> -->
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-clock-o"></i> Recent Activities
                        </h3>
                    </div>
                    <div class="box-body">
                        <ul class="timeline timeline-inverse">
                            <?php if (!empty($recent_activities)): ?>
                                <?php foreach ($recent_activities as $activity): ?>
                                    <li>
                                        <i class="fa <?php echo $activity['icon']; ?> <?php echo $activity['color']; ?>"></i>
                                        <div class="timeline-item">
                                            <span class="time">
                                                <i class="fa fa-clock-o"></i> 
                                                <?php echo date('H:i', strtotime($activity['date'])); ?>
                                            </span>
                                            <h3 class="timeline-header"><?php echo htmlspecialchars($activity['module']); ?></h3>
                                            <div class="timeline-body">
                                                <strong><?php echo htmlspecialchars($activity['action']); ?></strong><br>
                                                <?php echo htmlspecialchars($activity['description']); ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li>
                                    <i class="fa fa-info bg-blue"></i>
                                    <div class="timeline-item">
                                        <div class="timeline-body">No recent activities</div>
                                    </div>
                                </li>
                            <?php endif; ?>
                            <li>
                                <i class="fa fa-clock-o bg-gray"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

 

        <!-- Workflow Status -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-sitemap"></i> Project Workflow Status
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="workflow-table" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Project ID</th>
                                        <th>Description</th>
                                        <th class="text-center">Samples</th>
                                        <th class="text-center">Tests</th>
                                        <th class="text-center">Completed</th>
                                        <th class="text-center">Progress</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Date Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($workflow_status)): ?>
                                        <?php foreach ($workflow_status as $workflow): ?>
                                            <tr>
                                                <td>
                                                    <!-- <a href="<?php echo site_url('sample_reception'); ?>">
                                                        <strong><?php echo htmlspecialchars($workflow['project_id']); ?></strong>
                                                    </a> -->
                                                     <?php echo htmlspecialchars($workflow['project_id']); ?>
                                                </td>
                                                <td><?php echo htmlspecialchars($workflow['description'] ?? 'No description'); ?></td>
                                                <td class="text-center">
                                                    <span class="badge bg-blue"><?php echo $workflow['total_samples']; ?></span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-aqua"><?php echo $workflow['total_tests']; ?></span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-green"><?php echo $workflow['completed_tests']; ?></span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar progress-bar-<?php echo $workflow['completion_rate'] >= 80 ? 'success' : ($workflow['completion_rate'] >= 50 ? 'warning' : 'danger'); ?>" 
                                                             style="width: <?php echo $workflow['completion_rate']; ?>%"></div>
                                                    </div>
                                                    <span class="badge bg-gray"><?php echo $workflow['completion_rate']; ?>%</span>
                                                </td>
                                                <td class="text-center">
                                                    <?php 
                                                    $status_class = $workflow['status'] == 'completed' ? 'success' : ($workflow['status'] == 'in-progress' ? 'warning' : 'danger');
                                                    $status_text = ucfirst(str_replace('-', ' ', $workflow['status']));
                                                    ?>
                                                    <span class="label label-<?php echo $status_class; ?>">
                                                        <?php echo $status_text; ?>
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <small><?php echo date('M j, Y', strtotime($workflow['date_created'])); ?></small>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No workflow data available</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<script src="<?php echo base_url('assets/js/highcharts.js') ?>"></script>
<script src="<?php echo base_url('assets/js/exporting.js') ?>"></script>

<script>
$(document).ready(function() {
    // Initialize monthly trends chart
    <?php if (!empty($monthly_statistics)): ?>
    Highcharts.chart('monthly_chart', {
        chart: {
            type: 'line',
            backgroundColor: 'transparent'
        },
        title: {
            text: 'Projects, Samples & Tests Trends (Last 6 Months)',
            style: {
                fontSize: '16px',
                fontWeight: 'bold'
            }
        },
        xAxis: {
            categories: [
                <?php foreach ($monthly_statistics as $month): ?>
                    '<?php echo $month['month']; ?>',
                <?php endforeach; ?>
            ]
        },
        yAxis: {
            title: {
                text: 'Count'
            }
        },
        tooltip: {
            shared: true,
            crosshairs: true
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: true
            }
        },
        series: [{
            name: 'Projects',
            color: '#3c8dbc',
            data: [
                <?php foreach ($monthly_statistics as $month): ?>
                    <?php echo $month['projects']; ?>,
                <?php endforeach; ?>
            ]
        }, {
            name: 'Samples',
            color: '#00a65a',
            data: [
                <?php foreach ($monthly_statistics as $month): ?>
                    <?php echo $month['samples']; ?>,
                <?php endforeach; ?>
            ]
        }, {
            name: 'Tests',
            color: '#f39c12',
            data: [
                <?php foreach ($monthly_statistics as $month): ?>
                    <?php echo isset($month['tests']) ? $month['tests'] : 0; ?>,
                <?php endforeach; ?>
            ]
        }],
        credits: {
            enabled: false
        }
    });
    <?php endif; ?>

    // Initialize DataTables for workflow status table
    $('#workflow-table').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "paging": true,
        "pageLength": 5,
        "lengthMenu": [5, 10, 25, 50, 100],
        "language": {
            "search": "Search Project:",
            "lengthMenu": "Show _MENU_ projects per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ projects",
            "infoEmpty": "No projects available",
            "infoFiltered": "(filtered from _MAX_ total projects)",
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "Next",
                "previous": "Previous"
            }
        },
        "columnDefs": [
            { "orderable": false, "targets": [5] }, // Disable ordering for Progress column (contains HTML)
            { "className": "text-center", "targets": [2, 3, 4, 5, 6, 7] } // Center align specified columns
        ],
        "order": [[7, 'desc']], // Default sort by Date Created (newest first)
        "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "drawCallback": function() {
            // Re-initialize tooltips after table redraw
            $('.progress').tooltip({
                title: 'Click to view details',
                placement: 'top'
            });
        }
    });

    // Auto-refresh dashboard data every 5 minutes
    setInterval(function() {
        location.reload();
    }, 300000);

    // Add tooltips to progress bars
    $('.progress').each(function() {
        $(this).tooltip({
            title: 'Click to view details',
            placement: 'top'
        });
    });

    // Add real-time clock
    function updateClock() {
        var now = new Date();
        var timeString = now.toLocaleTimeString();
        $('#current-time').text(timeString);
    }
    
    // Add clock to header if needed
    if ($('#current-time').length === 0) {
        $('.box-tools').append('<span id="current-time" class="label label-default" style="margin-left: 10px;"></span>');
    }
    
    setInterval(updateClock, 1000);
    updateClock();
});
</script>

<style>
.timeline > li > .timeline-item {
    background: #fff;
    border-radius: 3px;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    margin-right: 15px;
    margin-left: 15px;
    margin-top: 0;
    padding: 0;
}

.timeline > li > .timeline-item > .timeline-header {
    border-bottom: 1px solid #f4f4f4;
    color: #999;
    font-size: 16px;
    font-weight: 600;
    line-height: 1.1;
    margin: 0;
    padding: 10px 15px;
}

.timeline > li > .timeline-item > .timeline-body,
.timeline > li > .timeline-item > .timeline-footer {
    padding: 10px 15px;
}

.small-box .icon {
    color: rgba(0,0,0,0.15);
    z-index: 0;
}

.small-box .icon > i {
    font-size: 90px;
    position: absolute;
    right: 15px;
    top: 15px;
    transition: all 0.3s linear;
}

.small-box:hover {
    text-decoration: none;
}

.small-box:hover .icon > i {
    font-size: 95px;
}

.progress-xs {
    height: 7px;
}

.badge {
    font-size: 11px;
    font-weight: 600;
}

.box-title {
    font-size: 18px;
    font-weight: 600;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .small-box .icon > i {
        font-size: 60px;
    }
    
    .small-box:hover .icon > i {
        font-size: 65px;
    }
    
    .timeline {
        margin-left: 0;
    }
    
    .timeline > li > .timeline-item {
        margin-left: 0;
        margin-right: 0;
    }
    
    /* DataTables responsive adjustments */
    .dataTables_length,
    .dataTables_filter {
        margin-top: 0;
        margin-bottom: 0;
    }
}

/* DataTables Layout Improvements */
.dataTables_wrapper .dataTables_length {
    float: left;
    margin-bottom: 10px;
}

.dataTables_wrapper .dataTables_filter {
    float: right;
    text-align: right;
    margin-bottom: 10px;
}

.dataTables_wrapper .dataTables_length select {
    display: inline-block;
    width: auto;
    margin: 0 5px;
}

.dataTables_wrapper .dataTables_filter input {
    display: inline-block;
    width: auto;
    margin-left: 5px;
    padding: 6px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter {
    margin-top: 0;
    margin-bottom: 15px;
}

.dataTables_wrapper .dataTables_info {
    float: left;
    padding-top: 8px;
}

.dataTables_wrapper .dataTables_paginate {
    float: right;
    text-align: right;
    padding-top: 0;
}

/* Clear float for proper alignment */
.dataTables_wrapper:after {
    content: "";
    display: table;
    clear: both;
}

/* Ensure proper spacing */
#workflow-table_wrapper .row:first-child {
    margin-bottom: 15px;
}

#workflow-table_wrapper .row:last-child {
    margin-top: 15px;
}

/* Responsive DataTables */
@media (max-width: 768px) {
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        float: none;
        text-align: left;
        margin-bottom: 10px;
    }
    
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        float: none;
        text-align: center;
        margin-top: 10px;
    }
}
</style>
<script src="<?php echo base_url('assets/js/export-data.js') ?>"></script>
<script src="<?php echo base_url('assets/js/accessibility.js') ?>"></script>

<!-- <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script> -->
        <script type="text/javascript">
            let t
            $(document).ready(function() {

            Highcharts.chart('chart_container', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie',
                    height: "350px"
                },
                
                title: {
                    text: 'Total samples per-objectives',
                    align: 'left'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                    valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    },
                    showInLegend: true,
                    point: {
                            events: {
                                legendItemClick: function (e) {
                                    console.log(e.target.name)
                                }
                            }
                        }
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    itemMarginTop: 10,
                    itemMarginBottom: 10,
                    itemMarginRight: 100,

                    },
                series: [{
                    name: 'Samples',
                    colorByPoint: true,
                    data: 
                    [<?php foreach ($item as $rows) {
                        echo ' {
                            name: "'.$rows->item.'",
                            y: '.$rows->val.'
                          },';
                    } ?>]
                }]
                });

            Highcharts.chart('sub_container', {
                        chart: {
                            type: 'column',
                            height: '300px'
                        },
                        title: {
                            text: 'Total samples per-type all objectives',
                            align: 'left'

                        },
                        
                        xAxis: {
                            categories: 
                            // ['sub1', 'sub2', 'sub3'],
                            [
                                <?php foreach ($obj as $row) {
                                    echo "'$row->type'" . ',';      
                                } ?>
                            ],
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Sample type from all Objectives'
                            }
                        },
                        legend:{ enabled:false },
                        tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{point.key}: </td>' +
                                '<td style="padding:0"><b>{point.y}</b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0,
                                colorByPoint: true,
                                dataLabels: {
                                    enabled: true,
                                    crop: false,
                                    overflow: 'none'
                                }
                            },
                            colors: [
                                '#ff0000',
                                '#00ff00',
                                '#0000ff'
                            ]
                        },
                        series: [
                            {
                                data : 
                                // [{name: 'sub1', y: 100},{name: 'sub2', y: 70},{name: 'sub3', y: 30},]

                                [
                                    <?php foreach ($obj as $row) {
                                        echo "{name: '$row->type',y: $row->val},";
                                    }?>
                                ]
                            }]
                    });                
            });
</script>