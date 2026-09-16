<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?php echo $page_title; ?>
            <small><?php echo $page_description; ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('module_announcement'); ?>">Module Announcements</a></li>
            <li class="active"><?php echo $button; ?></li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $button; ?> Announcement</h3>
            </div>
            
            <form action="<?php echo $action; ?>" method="post">
                <div class="box-body">
                    <input type="hidden" name="id_announcement" value="<?php echo $id_announcement; ?>" />
                    
                    <div class="form-group">
                        <label for="module_url">Target Module <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="module_url" id="module_url" required>
                            <option value="">-- Select Module --</option>
                            <?php foreach($modules as $module): ?>
                                <option value="<?php echo $module->url; ?>" <?php echo $module_url == $module->url ? 'selected' : ''; ?>>
                                    <?php echo $module->menu_name; ?> (<?php echo $module->url; ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo form_error('module_url') ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="e.g., Formula Update" value="<?php echo $title; ?>" required />
                        <?php echo form_error('title') ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="message" id="message" rows="5" placeholder="Enter announcement message..." required><?php echo $message; ?></textarea>
                        <small class="text-muted">You can use line breaks for better formatting.</small>
                        <?php echo form_error('message') ?>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="announcement_type">Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="announcement_type" id="announcement_type" required>
                                    <option value="info" <?php echo $announcement_type == 'info' ? 'selected' : ''; ?>>Info</option>
                                    <option value="warning" <?php echo $announcement_type == 'warning' ? 'selected' : ''; ?>>Warning</option>
                                    <option value="important" <?php echo $announcement_type == 'important' ? 'selected' : ''; ?>>Important</option>
                                    <option value="update" <?php echo $announcement_type == 'update' ? 'selected' : ''; ?>>Update</option>
                                </select>
                                <?php echo form_error('announcement_type') ?>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="priority">Priority <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="priority" id="priority" value="<?php echo $priority; ?>" min="0" max="10" required />
                                <small class="text-muted">Higher number = higher priority (0-10)</small>
                                <?php echo form_error('priority') ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="date_expire">Expiry Date (Optional)</label>
                        <input type="datetime-local" class="form-control" name="date_expire" id="date_expire" value="<?php echo $date_expire ? date('Y-m-d\TH:i', strtotime($date_expire)) : ''; ?>" />
                        <small class="text-muted">Leave empty for no expiration</small>
                    </div>
                    
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="is_active" value="1" <?php echo $is_active == 1 ? 'checked' : ''; ?>> 
                                <strong>Active</strong> <small>(Users will see this announcement)</small>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="require_acknowledgment" value="1" <?php echo $require_acknowledgment == 1 ? 'checked' : ''; ?>> 
                                <strong>Require Acknowledgment</strong> <small>(Users must click "I Understand")</small>
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button; ?></button>
                    <a href="<?php echo site_url('module_announcement'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </form>
        </div>
    </section>
</div>

<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>
