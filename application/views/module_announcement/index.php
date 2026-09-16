<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?php echo $page_title; ?>
            <small><?php echo $page_description; ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Module Announcements</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Manage Announcements</h3>
                <div class="box-tools pull-right">
                    <?php echo anchor(site_url('module_announcement/create'), '<i class="fa fa-plus"></i> Create New', 'class="btn btn-primary btn-sm"'); ?>
                </div>
            </div>
            
            <div class="box-body">
                <?php if ($this->session->flashdata('message')): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('message'); ?>
                    </div>
                <?php endif; ?>
                
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Module</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th width="8%">Priority</th>
                            <th width="10%">Status</th>
                            <th width="12%">Created</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    var table = $('#example1').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [[6, "desc"]],
        "ajax": {
            "url": "<?php echo site_url('module_announcement/json'); ?>",
            "type": "POST"
        },
        "columnDefs": [
            {
                "targets": [0],
                "orderable": false,
            },
        ],
        "columns": [
            {
                "data": null,
                "render": function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {"data": "module_name"},
            {"data": "announcement_title"},
            {
                "data": "announcement_type",
                "render": function(data) {
                    var colors = {
                        'info': 'info',
                        'warning': 'warning',
                        'important': 'danger',
                        'update': 'success'
                    };
                    return '<span class="label label-' + colors[data] + '">' + data.toUpperCase() + '</span>';
                }
            },
            {"data": "priority"},
            {
                "data": "is_active",
                "render": function(data) {
                    return data == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-default">Inactive</span>';
                }
            },
            {
                "data": "date_created",
                "render": function(data) {
                    if (!data) return '-';
                    
                    // Parse date and format manually
                    var date = new Date(data);
                    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    var day = ('0' + date.getDate()).slice(-2);
                    var month = months[date.getMonth()];
                    var year = date.getFullYear();
                    var hours = ('0' + date.getHours()).slice(-2);
                    var minutes = ('0' + date.getMinutes()).slice(-2);
                    
                    return day + ' ' + month + ' ' + year + ' ' + hours + ':' + minutes;
                }
            },
            {"data": "action", "orderable": false}
        ]
    });

    // Delete handler
    $('#example1').on('click', '.btn_delete', function() {
        var id = $(this).data('id');
        
        Swal.fire({
            title: 'Are you sure?',
            text: "This announcement will be deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo site_url('module_announcement/delete'); ?>',
                    type: 'POST',
                    data: {id: id},
                    success: function(response) {
                        Swal.fire('Deleted!', 'Announcement has been deleted.', 'success');
                        table.ajax.reload();
                    },
                    error: function() {
                        Swal.fire('Error!', 'Failed to delete announcement.', 'error');
                    }
                });
            }
        });
    });
});
</script>
