<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?php echo $page_title; ?>
            <small><?php echo $page_description; ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('module_announcement'); ?>">Module Announcements</a></li>
            <li class="active">View</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <!-- Announcement Details -->
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $row->title; ?></h3>
                        <div class="box-tools pull-right">
                            <?php
                            $type_colors = array('info' => 'info', 'warning' => 'warning', 'important' => 'danger', 'update' => 'success');
                            ?>
                            <span class="label label-<?php echo $type_colors[$row->announcement_type]; ?>">
                                <?php echo strtoupper($row->announcement_type); ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="box-body">
                        <div class="announcement-message" style="font-size: 14px; line-height: 1.8;">
                            <?php echo nl2br(htmlspecialchars($row->message)); ?>
                        </div>
                    </div>
                    
                    <div class="box-footer">
                        <dl class="dl-horizontal">
                            <dt>Module:</dt>
                            <dd><code><?php echo $row->module_url; ?></code></dd>
                            
                            <dt>Priority:</dt>
                            <dd><?php echo $row->priority; ?></dd>
                            
                            <dt>Created By:</dt>
                            <dd><?php echo $row->created_by; ?> at <?php echo date('d M Y H:i', strtotime($row->date_created)); ?></dd>
                            
                            <?php if ($row->date_expire): ?>
                            <dt>Expires:</dt>
                            <dd><?php echo date('d M Y H:i', strtotime($row->date_expire)); ?></dd>
                            <?php endif; ?>
                            
                            <dt>Status:</dt>
                            <dd>
                                <?php echo $row->is_active == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-default">Inactive</span>'; ?>
                            </dd>
                        </dl>
                        
                        <div class="mt-3">
                            <a href="<?php echo site_url('module_announcement/update/'.$row->id_announcement); ?>" class="btn btn-warning">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                            <a href="<?php echo site_url('module_announcement'); ?>" class="btn btn-default">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Statistics -->
            <div class="col-md-4">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Read Statistics</h3>
                    </div>
                    <div class="box-body">
                        <div class="text-center">
                            <h1 style="font-size: 48px; font-weight: bold; color: #3c8dbc;">
                                <?php echo $stats['read_percentage']; ?>%
                            </h1>
                            <p class="text-muted">
                                <?php echo $stats['read_users']; ?> out of <?php echo $stats['total_users']; ?> users have read this
                            </p>
                        </div>
                        
                        <div class="progress">
                            <div class="progress-bar progress-bar-info" role="progressbar" 
                                 style="width: <?php echo $stats['read_percentage']; ?>%">
                                <span class="sr-only"><?php echo $stats['read_percentage']; ?>% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php if (!empty($users_read)): ?>
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Users Who Read</h3>
                    </div>
                    <div class="box-body" style="max-height: 400px; overflow-y: auto;">
                        <ul class="list-unstyled">
                            <?php foreach ($users_read as $user): ?>
                            <li style="padding: 5px 0; border-bottom: 1px solid #f4f4f4;">
                                <i class="fa fa-check-circle text-success"></i>
                                <strong><?php echo $user->full_name; ?></strong>
                                <br>
                                <small class="text-muted">
                                    <i class="fa fa-clock-o"></i> <?php echo date('d M Y H:i', strtotime($user->date_read)); ?>
                                </small>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>
