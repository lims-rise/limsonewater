<?php
/**
 * Module Announcement Auto-Display Modal
 * 
 * This component automatically shows announcements for the current module
 * Include this file in your module view or footer template
 * 
 * Requirements:
 * - $module_announcements variable must be set (array of announcement objects)
 * - jQuery, Bootstrap Modal, SweetAlert2 (for modern UI - optional)
 */

if (isset($module_announcements) && !empty($module_announcements)):
    foreach ($module_announcements as $index => $announcement):
        // Determine colors based on type
        $type_colors = array(
            'info' => 'info',
            'warning' => 'warning', 
            'important' => 'danger',
            'update' => 'success'
        );
        $type_icons = array(
            'info' => 'info-circle',
            'warning' => 'exclamation-triangle',
            'important' => 'exclamation-circle',
            'update' => 'bullhorn'
        );
        
        $color = isset($type_colors[$announcement->announcement_type]) ? $type_colors[$announcement->announcement_type] : 'info';
        $icon = isset($type_icons[$announcement->announcement_type]) ? $type_icons[$announcement->announcement_type] : 'info-circle';
?>

<!-- Announcement Modal #<?php echo $announcement->id_announcement; ?> -->
<div class="modal fade" id="announcementModal_<?php echo $announcement->id_announcement; ?>" 
     tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-<?php echo $color; ?>" style="color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 0.8;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fa fa-<?php echo $icon; ?>"></i>
                    <?php echo htmlspecialchars($announcement->title); ?>
                </h4>
            </div>
            <div class="modal-body">
                <div class="announcement-message" style="font-size: 14px; line-height: 1.8; margin-bottom: 20px;">
                    <?php echo nl2br(htmlspecialchars($announcement->message)); ?>
                </div>
                <div class="announcement-meta text-muted" style="border-top: 1px solid #f4f4f4; padding-top: 15px;">
                    <small>
                        <i class="fa fa-user"></i> Posted by: <strong><?php echo $announcement->created_by_name; ?></strong><br>
                        <i class="fa fa-clock-o"></i> Date: <strong><?php echo date('d M Y H:i', strtotime($announcement->date_created)); ?></strong>
                    </small>
                </div>
            </div>
            <div class="modal-footer">
                <?php if ($announcement->require_acknowledgment == 1): ?>
                <button type="button" class="btn btn-<?php echo $color; ?> btn-mark-read" 
                        data-announcement-id="<?php echo $announcement->id_announcement; ?>">
                    <i class="fa fa-check"></i> I Understand
                </button>
                <?php else: ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-times"></i> Close
                </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
    endforeach;
endif;
?>

<!-- Announcement Modal Script -->
<?php if (isset($module_announcements) && !empty($module_announcements)): ?>
<script>
$(document).ready(function() {
    var announcements = <?php echo json_encode(array_values(array_map(function($a) { return $a->id_announcement; }, $module_announcements))); ?>;
    var currentIndex = 0;
    
    // Show first announcement automatically
    if (announcements.length > 0) {
        $('#announcementModal_' + announcements[currentIndex]).modal('show');
    }
    
    // Handle mark as read
    $('.btn-mark-read').click(function() {
        var announcementId = $(this).data('announcement-id');
        var $button = $(this);
        
        // Disable button to prevent double-click
        $button.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        
        $.ajax({
            url: '<?php echo site_url("module_announcement/mark_as_read"); ?>',
            type: 'POST',
            data: { id_announcement: announcementId },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Hide current modal
                    $('#announcementModal_' + announcementId).modal('hide');
                    
                    // Show next announcement if exists
                    currentIndex++;
                    if (currentIndex < announcements.length) {
                        setTimeout(function() {
                            $('#announcementModal_' + announcements[currentIndex]).modal('show');
                        }, 500);
                    }
                } else {
                    alert('Error: ' + (response.message || 'Failed to mark as read'));
                    $button.prop('disabled', false).html('<i class="fa fa-check"></i> I Understand');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('Failed to mark as read. Please try again.');
                $button.prop('disabled', false).html('<i class="fa fa-check"></i> I Understand');
            }
        });
    });
    
    // Clean up on modal hidden (when user clicks X)
    $('.modal').on('hidden.bs.modal', function () {
        var announcementId = $(this).attr('id').replace('announcementModal_', '');
        
        // If modal was closed without marking as read, still mark it
        $.ajax({
            url: '<?php echo site_url("module_announcement/mark_as_read"); ?>',
            type: 'POST',
            data: { id_announcement: announcementId },
            dataType: 'json'
        });
        
        // Show next announcement if exists
        currentIndex++;
        if (currentIndex < announcements.length) {
            setTimeout(function() {
                $('#announcementModal_' + announcements[currentIndex]).modal('show');
            }, 500);
        }
    });
});
</script>

<style>
/* Custom styling for announcement modals */
.modal-header.bg-info,
.modal-header.bg-warning,
.modal-header.bg-danger,
.modal-header.bg-success {
    color: white;
}

.modal-header.bg-info {
    background-color: #5bc0de;
}

.modal-header.bg-warning {
    background-color: #f0ad4e;
}

.modal-header.bg-danger {
    background-color: #d9534f;
}

.modal-header.bg-success {
    background-color: #5cb85c;
}

.announcement-message {
    white-space: pre-wrap;
    word-wrap: break-word;
}
</style>
<?php endif; ?>
