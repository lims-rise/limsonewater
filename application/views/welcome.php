<style>
/* ================================
   🌤️ MODERN UI 2025 — Color System
=================================*/
:root {
  --ui-bg: #F7F8FA;
  --ui-surface: #FFFFFF;
  --ui-surface-alt: #F1F3F5;

  --ui-text: #1A1D21;
  --ui-text-secondary: #6B7178;
  --ui-border: #E2E4E8;

  /* 2025 accent colors */
  --ui-accent: #4D6EF5;              /* Soft Indigo Blue */
  --ui-accent-soft: #E7EBFF;

  /* Feedback colors (muted) */
  --ui-success: #3FB984;
  --ui-warning: #F5C04D;
  --ui-danger: #E05B5B;

  /* Elevation */
  --ui-shadow-sm: 0 2px 6px rgba(0,0,0,0.05);
  --ui-shadow-md: 0 4px 12px rgba(0,0,0,0.07);
  --ui-radius: 12px;
}

/* Modern Scrollbar */
::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}

::-webkit-scrollbar-thumb {
  background: linear-gradient(180deg, var(--ui-accent), #6B7EF7);
  border-radius: 4px;
}

::-webkit-scrollbar-track {
  background: var(--ui-surface-alt);
}

/* Dashboard Specific Styling - Scoped to avoid affecting global elements */
.dashboard-container {
  background: var(--ui-bg) !important;
}

.dashboard-container .content-wrapper {
  background: var(--ui-bg) !important;
}

/* Modern Box Styling - Dashboard Scoped */
.dashboard-container .box {
  background: var(--ui-surface) !important;
  border: 1px solid var(--ui-border) !important;
  border-radius: var(--ui-radius) !important;
  box-shadow: var(--ui-shadow-sm) !important;
  transition: all 0.3s ease !important;
}

.dashboard-container .box:hover {
  box-shadow: var(--ui-shadow-md) !important;
}

.dashboard-container .box-header {
  background: var(--ui-surface) !important;
  border-bottom: 1px solid var(--ui-border) !important;
  border-radius: var(--ui-radius) var(--ui-radius) 0 0 !important;
}

.dashboard-container .box-title {
  color: var(--ui-text) !important;
  font-weight: 600 !important;
  font-size: 18px !important;
}

.dashboard-container .box-body {
  background: var(--ui-surface) !important;
  color: var(--ui-text) !important;
}

/* Modern Summary Cards */
.small-box {
  border-radius: var(--ui-radius) !important;
  box-shadow: var(--ui-shadow-md) !important;
  border: none !important;
  transition: all 0.3s ease !important;
  overflow: hidden !important;
}

.small-box:hover {
  transform: translateY(-2px) !important;
  box-shadow: 0 8px 25px rgba(77, 110, 245, 0.15) !important;
}

/* Modern 4-Level Progress Bar System (Matching Sample Reception) */
.dashboard-container .progress-bar {
    transition: width 0.5s ease-in-out !important;
}

/* Modern 4-Level Progress Bar System with Right-to-Left Darker Gradient */
#workflow-table .progress-bar-danger,
.dashboard-container .progress-bar-danger { 
    background: linear-gradient(90deg, #FFCDD2, #dd4b39) !important; /* Red: 0-49% - Light to dark red gradient */
}
#workflow-table .progress-bar-warning,
.dashboard-container .progress-bar-warning { 
    background: linear-gradient(90deg, #FFF3E0, #f39c12) !important; /* Yellow-Orange: 50-79% - Light to dark orange gradient */
}
#workflow-table .progress-bar-info,
.dashboard-container .progress-bar-info { 
    background: linear-gradient(90deg, #E1F5FE, #00c0ef) !important; /* Light Blue: 80-99% - Light to dark blue gradient */
}
#workflow-table .progress-bar-success,
.dashboard-container .progress-bar-success { 
    background: linear-gradient(90deg, #E8F5E8, #00a65a) !important; /* Green: 100% - Light to dark green gradient */
}

/* Modern Status Labels - Solid Colors for Clean Look */
#workflow-table .label-danger, 
.dashboard-container .label-danger {
    background-color: #dd4b39 !important; /* Red: Incomplete - AdminLTE solid red */
    border: none !important;
    box-shadow: 0 2px 8px rgba(221, 75, 57, 0.25) !important;
    border-radius: 10px !important;
    color: #ffffff !important; /* White text for better contrast */
}
#workflow-table .label-warning, 
.dashboard-container .label-warning {
    background-color: #f39c12 !important; /* Yellow-Orange: In Progress - AdminLTE solid orange */
    border: none !important;
    box-shadow: 0 2px 8px rgba(243, 156, 18, 0.25) !important;
    border-radius: 10px !important;
    color: #ffffff !important; /* White text for better contrast */
}
#workflow-table .label-info, 
.dashboard-container .label-info {
    background-color: #00c0ef !important; /* Light Blue: Almost Done - AdminLTE solid blue */
    border: none !important;
    box-shadow: 0 2px 8px rgba(0, 192, 239, 0.25) !important;
    border-radius: 10px !important;
    color: #ffffff !important; /* White text for better contrast */
}
#workflow-table .label-success, 
.dashboard-container .label-success {
    background-color: #00a65a !important; /* Green: Complete - AdminLTE solid green */
    border: none !important;
    box-shadow: 0 2px 8px rgba(0, 166, 90, 0.25) !important;
    border-radius: 10px !important;
    color: #ffffff !important; /* White text for better contrast */
}
#workflow-table .label-default, 
.dashboard-container .label-default {
    background-color: #95a5a6 !important; /* Grey: No Tests - AdminLTE solid grey */
    border: none !important;
    box-shadow: 0 2px 8px rgba(149, 165, 166, 0.25) !important;
    border-radius: 10px !important;
    color: #ffffff !important; /* White text for better contrast on grey background */
}

/* Updated Small Box Colors with 2025 Palette */
.small-box.bg-aqua {
  background: linear-gradient(135deg, var(--ui-accent) 0%, #6B7EF7 100%) !important;
}

.small-box.bg-green {
  background: linear-gradient(135deg, var(--ui-success) 0%, #52C49A 100%) !important;
}

.small-box.bg-yellow {
  background: linear-gradient(135deg, var(--ui-warning) 0%, #F7D063 100%) !important;
}

.small-box.bg-red {
  background: linear-gradient(135deg, var(--ui-danger) 0%, #E86F6F 100%) !important;
}

.small-box .inner h3 {
  color: white !important;
  font-weight: 700 !important;
  font-size: 28px !important;
}

.small-box .inner p {
  color: rgba(255, 255, 255, 0.9) !important;
  font-weight: 500 !important;
}

.small-box .icon {
  color: rgba(255, 255, 255, 0.15) !important;
}
</style>

<div class="content-wrapper dashboard-container">
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
                                                    <span class="badge bg-yellow pending-badge" 
                                                          data-module="<?php echo htmlspecialchars($module['module']); ?>"
                                                          style="cursor: pointer;"
                                                          title="Click to view pending items">
                                                        <?php echo number_format($module['pending']); ?>
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    // Modern 4-level progress system for Module Performance
                                                    $module_completion = $module['completion_rate'];
                                                    if ($module_completion >= 100) {
                                                        $module_progress_class = 'success'; // Green: 100%
                                                    } elseif ($module_completion >= 80) {
                                                        $module_progress_class = 'info'; // Light Blue: 80-99% (Almost Done)
                                                    } elseif ($module_completion >= 50) {
                                                        $module_progress_class = 'warning'; // Yellow-Orange: 50-79%
                                                    } else {
                                                        $module_progress_class = 'danger'; // Red: 0-49%
                                                    }
                                                    ?>
                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar progress-bar-<?php echo $module_progress_class; ?>" 
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
                                                    <?php
                                                    // Modern 4-level progress system using AdminLTE colors
                                                    $completion_rate = $workflow['completion_rate'];
                                                    $progress_color = '#dd4b39'; // AdminLTE red for 0-49%
                                                    $progress_class = 'danger';
                                                    
                                                    if ($completion_rate >= 100) {
                                                        $progress_color = '#00a65a'; // AdminLTE green for 100%
                                                        $progress_class = 'success';
                                                    } elseif ($completion_rate >= 80) {
                                                        $progress_color = '#00c0ef'; // AdminLTE light blue for 80-99% (Almost Done)
                                                        $progress_class = 'info';
                                                    } elseif ($completion_rate >= 50) {
                                                        $progress_color = '#f39c12'; // AdminLTE yellow-orange for 50-79%
                                                        $progress_class = 'warning';
                                                    }
                                                    ?>
                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar progress-bar-<?php echo $progress_class; ?>" 
                                                             style="width: <?php echo $completion_rate; ?>%; background-color: <?php echo $progress_color; ?> !important;"></div>
                                                    </div>
                                                    <span class="badge bg-gray"><?php echo $completion_rate; ?>%</span>
                                                </td>
                                                <td class="text-center">
                                                    <?php 
                                                    // Modern 5-level status system with proper 0% handling
                                                    if ($completion_rate >= 100) {
                                                        $status_color = '#00a65a'; // AdminLTE green for 100%
                                                        $status_class = 'success';
                                                        $status_text = 'Complete';
                                                        $status_icon = 'fa-check-circle';
                                                    } elseif ($completion_rate >= 80) {
                                                        $status_color = '#00c0ef'; // AdminLTE light blue for 80-99% (Almost Done)
                                                        $status_class = 'info';
                                                        $status_text = 'Almost Done';
                                                        $status_icon = 'fa-clock-o';
                                                    } elseif ($completion_rate >= 50) {
                                                        $status_color = '#f39c12'; // AdminLTE yellow-orange for 50-79%
                                                        $status_class = 'warning';
                                                        $status_text = 'In Progress';
                                                        $status_icon = 'fa-hourglass-half';
                                                    } elseif ($completion_rate > 0) {
                                                        $status_color = '#dd4b39'; // AdminLTE red for 1-49%
                                                        $status_class = 'danger';
                                                        $status_text = 'In Progress';
                                                        $status_icon = 'fa-exclamation-triangle';
                                                    } else {
                                                        $status_color = '#95a5a6'; // AdminLTE grey for 0%
                                                        $status_class = 'default';
                                                        $status_text = 'No Tests';
                                                        $status_icon = 'fa-minus-circle';
                                                    }
                                                    ?>
                                                    <span class="label label-<?php echo $status_class; ?>">
                                                        <i class="fa <?php echo $status_icon; ?>"></i> <?php echo $status_text; ?>
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <small><?php echo !empty($workflow['date_created']) ? date('M j, Y', strtotime($workflow['date_created'])) : '-'; ?></small>
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

<!-- Modal for Pending Items Detail -->
<div class="modal fade" id="pendingModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f39c12; color: white;">
                <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                <h4 class="modal-title">
                    <i class="fa fa-clock-o"></i> Pending Items - <span id="modalModuleName"></span>
                </h4>
            </div>
            <div class="modal-body" style="height: 75vh; padding: 0;">
                <div id="pendingItemsLoader" class="modern-loader">
                    <div class="loader-animation">
                        <div class="pulse-loader"></div>
                        <div class="pulse-loader pulse-delay-1"></div>
                        <div class="pulse-loader pulse-delay-2"></div>
                    </div>
                    <p class="loader-text">Loading pending items...</p>
                </div>
                <div id="pendingItemsContent" style="display: none; height: 100%; display: flex; flex-direction: column;">
                    <!-- Modern Summary Info Bar -->
                    <!-- <div class="modern-info-bar">
                        <div class="info-content">
                            <div class="info-badge">
                                <span id="pendingItemsCount">0</span>
                            </div>
                            <span class="info-text">pending items found</span>
                        </div>
                    </div> -->
                    <!-- Modern Scrollable Table Container -->
                    <div class="modern-table-container" style="height: 100%; overflow-y: auto; overflow-x: auto;">
                        <table class="modern-table" id="pendingItemsTable">
                            <thead class="modern-thead">
                                <tr>
                                    <th class="modern-th">Project ID</th>
                                    <th class="modern-th">Sample ID</th>
                                    <!-- <th class="modern-th">Client</th> -->
                                    <th class="modern-th">Date Created</th>
                                    <!-- <th class="text-center">Action</th> -->
                                </tr>
                            </thead>
                            <tbody id="pendingItemsTableBody" class="modern-tbody">
                                <!-- Data will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="pendingItemsError" style="display: none;" class="alert alert-danger" style="margin: 20px;">
                    <i class="fa fa-exclamation-triangle"></i> 
                    <strong>Error:</strong> Failed to load pending items. Please try again.
                    <button type="button" class="btn btn-sm btn-warning pull-right" onclick="$('.pending-badge').first().click();">
                        <i class="fa fa-refresh"></i> Retry
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-left">
                    <small class="text-muted">
                        <i class="fa fa-info-circle"></i> 
                        Last updated: <span id="lastUpdatedTime"></span>
                    </small>
                </div>
                <div class="pull-right">
                    <!-- <button type="button" class="btn btn-warning btn-sm" onclick="$('.pending-badge[data-module=\"' + $('#modalModuleName').text() + '\"]').click();" title="Refresh data">
                        <i class="fa fa-refresh"></i> Refresh
                    </button> -->
                    <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">
                        <i class="fa fa-times"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
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
        "order": [], // No default sorting - preserve database order
        "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "drawCallback": function() {
            // Re-initialize tooltips after table redraw
            $('.progress').tooltip({
                // title: 'Click to view details',
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
            // title: 'Click to view details',
            placement: 'top'
        });
    });

    // Handle pending badge click
    $('.pending-badge').on('click', function() {
        var module = $(this).data('module');
        if ($(this).text().trim() === '0') {
            return; // Don't show modal if no pending items
        }
        
        $('#modalModuleName').text(module);
        $('#pendingItemsLoader').show();
        $('#pendingItemsContent').hide();
        $('#pendingItemsError').hide();
        $('#pendingModal').modal('show');
        
        // Load pending items via AJAX
        $.ajax({
            url: '<?php echo site_url("welcome/get_pending_items"); ?>',
            type: 'POST',
            data: { module: module },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var tableBody = '';
                    var itemCount = 0;
                    
                    if (response.data && response.data.length > 0) {
                        itemCount = response.data.length;
                        
                        $.each(response.data, function(index, item) {
                            tableBody += '<tr>';
                            tableBody += '<td>' + item.project_id + '</td>';
                            tableBody += '<td>' + (item.sample_id || '-') + '</td>';
                            // tableBody += '<td>' + (item.client || 'Unknown Client') + '</td>';
                            tableBody += '<td>' + item.date_created + '</td>';
                            
                            /* 
                            // ACTION COLUMN - Hidden for now, may be needed in the future
                            tableBody += '<td class="text-center">';
                            // Map module to valid controller URL
                            var moduleUrls = {
                                'Biobank Storage': 'biobankin',
                                'Moisture Content': 'moisture_content', 
                                'Campylobacter (Biosolids)': 'campy_biosolids',
                                'Campylobacter (Liquids)': 'campy_liquids',
                                'Campylobacter P/A': 'campy_pa',
                                'Salmonella (Liquids)': 'salmonella_liquids',
                                'Salmonella (Biosolids)': 'salmonella_biosolids',
                                'Salmonella P/A': 'salmonella_pa',
                                'DNA Extraction (Culture)': 'extraction_culture',
                                'DNA Extraction (Liquid)': 'extraction_liquid',
                                'DNA Extraction (Metagenome)': 'extraction_metagenome',
                                'DNA Extraction (Biosolid)': 'extraction_biosolid',
                                'Enterolert (Water)': 'enterolert_idexx_water',
                                'Enterolert (Biosolids)': 'enterolert_idexx_biosolids',
                                'Colilert (Biosolids)': 'colilert_idexx_biosolids',
                                'Colilert (Water)': 'colilert_idexx_water',
                                'Protozoa Analysis': 'protozoa',
                                'HemoFlow Analysis': 'hemoflow'
                            };
                            
                            var moduleController = moduleUrls[item.module_name] || 'sample_reception';
                            var viewUrl = '<?php echo base_url(); ?>index.php/' + moduleController;
                            
                            if (item.sample_id && item.sample_id !== '-' && item.sample_id !== 'Unknown Project') {
                                // Add sample_id as filter parameter for the specific module
                                viewUrl += '?sample_id=' + encodeURIComponent(item.sample_id);
                            }
                            
                            tableBody += '<a href="' + viewUrl + '" class="btn btn-xs btn-success" target="_blank" title="Go to ' + item.module_name + ' module for this sample">';
                            tableBody += '<i class="fa fa-flask"></i> Open in Module';
                            tableBody += '</a>';
                            tableBody += '</td>';
                            */
                            tableBody += '</tr>';
                        });
                    } else {
                        tableBody = '<tr><td colspan="4" class="text-center">No pending items found</td></tr>';
                    }
                    
                    // Update item count
                    $('#pendingItemsCount').html('<strong>' + itemCount + '</strong>');
                    
                    $('#pendingItemsTableBody').html(tableBody);
                    $('#pendingItemsLoader').hide();
                    $('#pendingItemsContent').show();
                    

                    
                    // Update timestamp
                    var now = new Date();
                    $('#lastUpdatedTime').text(now.toLocaleTimeString());
                } else {
                    $('#pendingItemsLoader').hide();
                    $('#pendingItemsError').show();
                }
            },
            error: function() {
                $('#pendingItemsLoader').hide();
                $('#pendingItemsError').show();
            }
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
/* Modern Tables & Elements - Dashboard Scoped */
.dashboard-container .table {
  background: var(--ui-surface) !important;
  border-radius: var(--ui-radius) !important;
  overflow: hidden !important;
}

.dashboard-container .table > thead > tr > th {
  background: var(--ui-surface-alt) !important;
  color: var(--ui-text) !important;
  border-bottom: 2px solid var(--ui-border) !important;
  font-weight: 600 !important;
  padding: 16px !important;
}

.dashboard-container .table > tbody > tr > td {
  border-top: 1px solid var(--ui-border) !important;
  color: var(--ui-text) !important;
  padding: 14px 16px !important;
}

.dashboard-container .table > tbody > tr:hover {
  background: var(--ui-surface-alt) !important;
}

/* Modern Badges */
.badge {
  border-radius: 8px !important;
  font-weight: 500 !important;
  padding: 6px 12px !important;
  font-size: 12px !important;
}

.badge.bg-blue {
  background: var(--ui-accent) !important;
  color: white !important;
}

.badge.bg-green {
  background: var(--ui-success) !important;
  color: white !important;
}

.badge.bg-yellow {
  background: var(--ui-warning) !important;
  color: white !important;
}

.badge.bg-aqua {
  background: var(--ui-accent) !important;
  color: white !important;
}

.badge.bg-gray {
  background: var(--ui-text-secondary) !important;
  color: white !important;
}

/* Modern Labels */
.label {
  border-radius: 6px !important;
  font-weight: 500 !important;
  padding: 4px 10px !important;
}

.label-success {
  background: var(--ui-success) !important;
}

.label-warning {
  background: var(--ui-warning) !important;
  color: var(--ui-text) !important;
}

.label-danger {
  background: var(--ui-danger) !important;
}

.label-primary {
  background: var(--ui-accent) !important;
}

.label-default {
  background: var(--ui-text-secondary) !important;
}

/* Modern Progress Bars */
.progress {
  background: var(--ui-surface-alt) !important;
  border-radius: 6px !important;
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.05) !important;
}

.progress-bar-success {
  background: linear-gradient(90deg, var(--ui-success), #52C49A) !important;
}

.progress-bar-warning {
  background: linear-gradient(90deg, var(--ui-warning), #F7D063) !important;
}

.progress-bar-danger {
  background: linear-gradient(90deg, var(--ui-danger), #E86F6F) !important;
}

/* Modern Timeline */
.timeline > li > .timeline-item {
    background: var(--ui-surface) !important;
    border: 1px solid var(--ui-border) !important;
    border-radius: var(--ui-radius) !important;
    box-shadow: var(--ui-shadow-sm) !important;
    margin-right: 15px;
    margin-left: 15px;
    margin-top: 0;
    padding: 0;
    transition: all 0.3s ease !important;
}

.timeline > li > .timeline-item:hover {
    box-shadow: var(--ui-shadow-md) !important;
}

.timeline > li > .timeline-item > .timeline-header {
    border-bottom: 1px solid var(--ui-border) !important;
    color: var(--ui-text) !important;
    background: var(--ui-surface-alt) !important;
    font-size: 16px;
    font-weight: 600;
    line-height: 1.1;
    margin: 0;
    padding: 12px 16px;
    border-radius: var(--ui-radius) var(--ui-radius) 0 0 !important;
}

.timeline > li > .timeline-item > .timeline-body,
.timeline > li > .timeline-item > .timeline-footer {
    padding: 12px 16px;
    color: var(--ui-text-secondary) !important;
}

/* Modern Buttons - Dashboard Scoped */
.dashboard-container .btn {
  border-radius: 8px !important;
  font-weight: 500 !important;
  transition: all 0.3s ease !important;
  border: none !important;
  padding: 10px 20px !important;
}

.dashboard-container .btn-primary {
  background: linear-gradient(135deg, var(--ui-accent) 0%, #6B7EF7 100%) !important;
  color: white !important;
}

.dashboard-container .btn-primary:hover {
  background: linear-gradient(135deg, #3D5BF2 0%, var(--ui-accent) 100%) !important;
  transform: translateY(-1px) !important;
  box-shadow: 0 4px 12px rgba(77, 110, 245, 0.3) !important;
}

.dashboard-container .btn-success {
  background: linear-gradient(135deg, var(--ui-success) 0%, #52C49A 100%) !important;
  color: white !important;
}

.dashboard-container .btn-success:hover {
  background: linear-gradient(135deg, #2FA876 0%, var(--ui-success) 100%) !important;
  transform: translateY(-1px) !important;
}

.dashboard-container .btn-warning {
  background: linear-gradient(135deg, var(--ui-warning) 0%, #F7D063 100%) !important;
  color: var(--ui-text) !important;
}

.dashboard-container .btn-warning:hover {
  background: linear-gradient(135deg, #F2B53F 0%, var(--ui-warning) 100%) !important;
  transform: translateY(-1px) !important;
}

.dashboard-container .btn-app {
  background: var(--ui-surface) !important;
  border: 2px solid var(--ui-border) !important;
  color: var(--ui-text) !important;
  border-radius: var(--ui-radius) !important;
  transition: all 0.3s ease !important;
}

.dashboard-container .btn-app:hover {
  background: var(--ui-accent-soft) !important;
  border-color: var(--ui-accent) !important;
  color: var(--ui-accent) !important;
  transform: translateY(-2px) !important;
}

/* DataTables Modern Styling - Dashboard Scoped */
.dashboard-container .dataTables_wrapper {
  background: var(--ui-surface) !important;
  border-radius: var(--ui-radius) !important;
  padding: 20px !important;
  box-shadow: var(--ui-shadow-sm) !important;
}

.dashboard-container .dataTables_filter input {
  background: var(--ui-surface) !important;
  border: 2px solid var(--ui-border) !important;
  border-radius: 8px !important;
  color: var(--ui-text) !important;
  padding: 8px 12px !important;
  transition: all 0.3s ease !important;
}

.dashboard-container .dataTables_filter input:focus {
  border-color: var(--ui-accent) !important;
  box-shadow: 0 0 0 3px var(--ui-accent-soft) !important;
  outline: none !important;
}

.dashboard-container .dataTables_length select {
  background: var(--ui-surface) !important;
  border: 2px solid var(--ui-border) !important;
  border-radius: 6px !important;
  color: var(--ui-text) !important;
  padding: 6px 10px !important;
}

/* Pagination Modern Styling - Dashboard Scoped */
.dashboard-container .dataTables_paginate .paginate_button {
  background: var(--ui-surface) !important;
  border: 1px solid var(--ui-border) !important;
  color: var(--ui-text) !important;
  border-radius: 6px !important;
  margin: 0 2px !important;
  transition: all 0.3s ease !important;
}

.dashboard-container .dataTables_paginate .paginate_button:hover {
  background: var(--ui-accent-soft) !important;
  border-color: var(--ui-accent) !important;
  color: var(--ui-accent) !important;
}

.dashboard-container .dataTables_paginate .paginate_button.current {
  background: var(--ui-accent) !important;
  border-color: var(--ui-accent) !important;
  color: white !important;
}

/* Modern Chart Container */
#monthly_chart {
  background: var(--ui-surface) !important;
  border-radius: var(--ui-radius) !important;
  padding: 10px !important;
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
    
    /* Modern Table Mobile Responsive */
    #pendingModal .modal-dialog {
        margin: 10px;
    }
    
    .modern-table-container {
        max-height: 00px;
    }
    
    #pendingModal .modal-body {
        max-height: 60vh;
    }
    
    .modern-th,
    .modern-tbody td {
        padding: 12px 15px;
        font-size: 12px;
    }
    
    .modern-info-bar {
        padding: 15px 20px;
    }
    
    .info-badge {
        padding: 6px 12px;
        font-size: 13px;
    }
    
    .modern-loader {
        padding: 40px 20px;
    }
}

/* Modern Modal Styling */
.modal-content {
  background: var(--ui-surface) !important;
  border: none !important;
  border-radius: var(--ui-radius) !important;
  box-shadow: 0 20px 60px rgba(0,0,0,0.15) !important;
}

.modal-header {
  background: linear-gradient(135deg, var(--ui-accent) 0%, #6B7EF7 100%) !important;
  border: none !important;
  border-radius: var(--ui-radius) var(--ui-radius) 0 0 !important;
  color: white !important;
}

.modal-title {
  color: white !important;
  font-weight: 600 !important;
}

.modal-body {
  background: var(--ui-surface) !important;
  color: var(--ui-text) !important;
}

.modal-footer {
  background: var(--ui-surface-alt) !important;
  border-top: 1px solid var(--ui-border) !important;
  border-radius: 0 0 var(--ui-radius) var(--ui-radius) !important;
}

/* Alert Styling */
.alert {
  border-radius: var(--ui-radius) !important;
  border: none !important;
}

.alert-danger {
  background: rgba(224, 91, 91, 0.1) !important;
  color: var(--ui-danger) !important;
  border-left: 4px solid var(--ui-danger) !important;
}

/* Modern Pending Badge */
.pending-badge {
    transition: all 0.3s ease;
    position: relative;
    background: var(--ui-warning) !important;
    color: white !important;
    border-radius: 8px !important;
    cursor: pointer;
}

.pending-badge:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 15px rgba(245, 192, 77, 0.4) !important;
    background: #F2B53F !important;
}

.pending-badge:before {
    content: "Click to view details";
    position: absolute;
    bottom: -25px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0,0,0,0.8);
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 10px;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
    z-index: 1000;
}

.pending-badge:hover:before {
    opacity: 1;
}

/* Modern Table Design */
.modern-table-container {
    background: var(--ui-surface) !important;
    border: 1px solid var(--ui-border) !important;
    border-radius: var(--ui-radius) !important;
    box-shadow: var(--ui-shadow-sm) !important;
    overflow: hidden;
}

.modern-table-container::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

.modern-table-container::-webkit-scrollbar-track {
    background: var(--ui-surface-alt) !important;
}

.modern-table-container::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, var(--ui-accent), #6B7EF7) !important;
    border-radius: 6px;
}

.modern-table-container::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, #3D5BF2, var(--ui-accent)) !important;
}

.modern-table {
    width: 100%;
    margin: 0;
    border-collapse: collapse;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.modern-thead {
    background: linear-gradient(135deg, var(--ui-warning) 0%, #F7D063 100%) !important;
    position: sticky;
    top: 0;
    z-index: 10;
    box-shadow: 0 2px 4px rgba(245, 192, 77, 0.1) !important;
}

.modern-th {
    color: #ffffff !important;
    font-weight: 600;
    font-size: 14px;
    text-align: left;
    padding: 16px 20px;
    border: none;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    font-size: 12px;
    position: relative;
}

.modern-th::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: rgba(255, 255, 255, 0.3);
}

.modern-tbody tr {
    border-bottom: 1px solid #e2e8f0;
    transition: all 0.2s ease;
}

.modern-tbody tr:hover {
    background-color: var(--ui-surface-alt) !important;
    transform: translateY(-1px);
    box-shadow: var(--ui-shadow-sm) !important;
}

.modern-tbody tr:last-child {
    border-bottom: none;
}

.modern-tbody td {
    padding: 16px 20px;
    color: var(--ui-text) !important;
    font-size: 14px;
    line-height: 1.5;
    border: none;
    vertical-align: middle;
}

.modern-tbody td:first-child {
    font-weight: 600;
    color: var(--ui-text) !important;
}

.modern-tbody tr:nth-child(even) {
    background-color: var(--ui-surface) !important;
}

.modern-tbody tr:nth-child(odd) {
    background-color: var(--ui-surface-alt) !important;
}

/* Modern Info Bar */
.modern-info-bar {
    padding: 20px 25px;
    background: linear-gradient(90deg, var(--ui-surface-alt) 0%, var(--ui-surface) 100%) !important;
    border-bottom: 1px solid var(--ui-border) !important;
}

.info-content {
    display: flex;
    align-items: center;
    gap: 12px;
}

.info-badge {
    background: linear-gradient(135deg, var(--ui-warning) 0%, #F7D063 100%) !important;
    color: var(--ui-text) !important;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 14px;
    box-shadow: 0 2px 8px rgba(245, 192, 77, 0.3) !important;
}

.info-text {
    color: var(--ui-text-secondary) !important;
    font-size: 14px;
    font-weight: 500;
}

#pendingModal .modal-header {
    background: linear-gradient(135deg, var(--ui-warning) 0%, #F7D063 100%) !important;
    border: none;
    padding: 20px 25px;
    border-radius: var(--ui-radius) var(--ui-radius) 0 0 !important;
    box-shadow: 0 2px 8px rgba(245, 192, 77, 0.2) !important;
}

#pendingModal .modal-header .modal-title {
    color: #ffffff !important;
    font-weight: 600;
    font-size: 18px;
    text-shadow: 0 1px 2px rgba(0,0,0,0.1) !important;
}

#pendingModal .modal-header .close {
    color: #ffffff !important;
    opacity: 0.9;
    text-shadow: none;
    font-size: 24px;
    transition: all 0.3s ease !important;
    border-radius: 50% !important;
    width: 32px !important;
    height: 32px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}

#pendingModal .modal-header .close:hover {
    opacity: 1;
    color: #ffffff !important;
    background: rgba(255,255,255,0.1) !important;
    transform: scale(1.1) !important;
}

#pendingModal .modal-footer {
    background: var(--ui-surface-alt) !important;
    border-top: 1px solid var(--ui-border) !important;
    border-radius: 0 0 var(--ui-radius) var(--ui-radius) !important;
    padding: 15px 25px;
}

/* Modern Pending Modal Buttons */
#pendingModal .btn-warning {
    background: linear-gradient(135deg, var(--ui-warning) 0%, #F7D063 100%) !important;
    color: var(--ui-text) !important;
    border: none !important;
    border-radius: 8px !important;
    font-weight: 500 !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 2px 4px rgba(245, 192, 77, 0.2) !important;
}

#pendingModal .btn-warning:hover {
    background: linear-gradient(135deg, #F2B53F 0%, var(--ui-warning) 100%) !important;
    color: var(--ui-text) !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 12px rgba(245, 192, 77, 0.3) !important;
}

/* Modern Table Row Hover in Modal */
#pendingModal .modern-tbody tr:hover {
    background-color: rgba(245, 192, 77, 0.05) !important;
    border-left: 3px solid var(--ui-warning) !important;
}

/* Modern Scrollbar for Modal Table */
#pendingModal .modern-table-container::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, var(--ui-warning), #F7D063) !important;
}

#pendingModal .modern-table-container::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, #F2B53F, var(--ui-warning)) !important;
}

#pendingModal .modal-content {
    border: none;
    border-radius: var(--ui-radius) !important;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15) !important;
    overflow: hidden !important;
}

#pendingModal .modal-body {
    background: var(--ui-surface) !important;
    padding: 0 !important;
}

/* Modern Modal Enhancements */
#pendingModal .modal-dialog {
    margin: 30px auto !important;
    transition: all 0.3s ease !important;
}

#pendingModal.fade .modal-dialog {
    transform: translate(0, -50px) !important;
}

#pendingModal.in .modal-dialog {
    transform: translate(0, 0) !important;
}

/* Modern Loading Animation */
.modern-loader {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 60px 40px;
    background: linear-gradient(135deg, var(--ui-surface-alt) 0%, var(--ui-surface) 100%) !important;
}

.loader-animation {
    display: flex;
    gap: 8px;
    margin-bottom: 20px;
}

.pulse-loader {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--ui-warning) 0%, #F7D063 100%) !important;
    animation: pulseScale 1.5s ease-in-out infinite;
}

.pulse-delay-1 {
    animation-delay: 0.2s;
}

.pulse-delay-2 {
    animation-delay: 0.4s;
}

@keyframes pulseScale {
    0%, 80%, 100% {
        transform: scale(0.8);
        opacity: 0.5;
    }
    40% {
        transform: scale(1.2);
        opacity: 1;
    }
}

.loader-text {
    color: var(--ui-text-secondary) !important;
    font-size: 16px;
    font-weight: 500;
    margin: 0;
    letter-spacing: 0.5px;
}

/* Modern Typography - Dashboard Scoped */
.dashboard-container h1, 
.dashboard-container h2, 
.dashboard-container h3, 
.dashboard-container h4, 
.dashboard-container h5, 
.dashboard-container h6 {
    color: var(--ui-text) !important;
}

.dashboard-container p {
    color: var(--ui-text-secondary) !important;
}

/* Modern Form Controls - Dashboard Scoped */
.dashboard-container .form-control {
    background: var(--ui-surface) !important;
    border: 2px solid var(--ui-border) !important;
    border-radius: 8px !important;
    color: var(--ui-text) !important;
    transition: all 0.3s ease !important;
}

.dashboard-container .form-control:focus {
    border-color: var(--ui-accent) !important;
    box-shadow: 0 0 0 3px var(--ui-accent-soft) !important;
    background: var(--ui-surface) !important;
}

/* Modern Navigation */
.nav-tabs > li > a {
    background: var(--ui-surface) !important;
    color: var(--ui-text-secondary) !important;
    border: 2px solid var(--ui-border) !important;
    border-radius: 8px 8px 0 0 !important;
}

.nav-tabs > li.active > a {
    background: var(--ui-accent) !important;
    color: white !important;
    border-color: var(--ui-accent) !important;
}

/* Modern Box Variants */
.box-primary {
    border-top-color: var(--ui-accent) !important;
}

.box-success {
    border-top-color: var(--ui-success) !important;
}

.box-warning {
    border-top-color: var(--ui-warning) !important;
}

.box-danger {
    border-top-color: var(--ui-danger) !important;
}

.box-info {
    border-top-color: var(--ui-accent) !important;
}

/* Responsive Table Adjustments */
@media (max-width: 768px) {
    #pendingModal .modal-dialog {
        margin: 10px;
    }
    
    #pendingModal .table-container {
        max-height: 300px;
    }
    
    #pendingModal .modal-body {
        max-height: 60vh;
    }
    
    #pendingModal #pendingItemsTable th,
    #pendingModal #pendingItemsTable td {
        padding: 6px 8px;
        font-size: 12px;
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