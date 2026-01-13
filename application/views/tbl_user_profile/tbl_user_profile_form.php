<!-- Modern User Profile Form 2026 -->
<div class="content-wrapper">
    <style>
        /* ================================
           🌟 2026 USER PROFILE FORM UI
        =================================*/
        
        :root {
            --profile-primary: #4D6EF5;
            --profile-primary-light: #E7EBFF;
            --profile-surface: #FFFFFF;
            --profile-surface-alt: #F7F8FA;
            --profile-border: #E2E4E8;
            --profile-text: #1A1D21;
            --profile-text-secondary: #6B7178;
            --profile-success: #3FB984;
            --profile-danger: #E05B5B;
            --profile-warning: #F5C04D;
            --profile-radius: 16px;
            --profile-radius-sm: 12px;
            --profile-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --profile-shadow-lg: 0 8px 25px rgba(77, 110, 245, 0.15);
            --profile-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Modern Container */
        .profile-container {
            background: var(--profile-surface);
            border-radius: var(--profile-radius);
            box-shadow: var(--profile-shadow);
            overflow: hidden;
            transition: var(--profile-transition);
            border: 1px solid var(--profile-border);
            max-width: 800px;
            margin: 0 auto;
        }

        .profile-container:hover {
            box-shadow: var(--profile-shadow-lg);
        }

        /* Header */
        .profile-header {
            background: linear-gradient(135deg, var(--profile-primary-light), rgba(255, 255, 255, 0.9));
            padding: 24px 32px;
            border-bottom: 1px solid var(--profile-border);
            position: relative;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at top right, rgba(77, 110, 245, 0.1), transparent 70%);
        }

        .profile-title {
            color: var(--profile-text);
            font-size: 24px;
            font-weight: 700;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .profile-title i {
            color: var(--profile-primary);
            margin-right: 12px;
            background: rgba(77, 110, 245, 0.1);
            padding: 8px;
            border-radius: 8px;
        }

        /* Form Body */
        .profile-body {
            padding: 28px;
            background: var(--profile-surface);
        }

        /* Form Grid */
        .form-grid {
            display: grid;
            gap: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: 16px;
            align-items: start;
            padding: 16px 0;
            border-bottom: 1px solid rgba(226, 228, 232, 0.5);
        }

        .form-row:last-child {
            border-bottom: none;
        }

        /* Labels */
        .form-label {
            color: var(--profile-text);
            font-weight: 600;
            font-size: 15px;
            margin: 0;
            padding-top: 12px;
            position: relative;
        }

        .form-label.required::after {
            content: '*';
            color: var(--profile-danger);
            margin-left: 4px;
        }

        /* Input Controls */
        .form-control-modern {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid var(--profile-border);
            border-radius: var(--profile-radius-sm);
            background: var(--profile-surface);
            color: var(--profile-text);
            font-size: 15px;
            font-weight: 500;
            transition: var(--profile-transition);
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .form-control-modern:focus {
            outline: none;
            border-color: var(--profile-primary);
            box-shadow: 
                inset 0 1px 3px rgba(0, 0, 0, 0.05),
                0 0 0 4px rgba(77, 110, 245, 0.1);
        }

        .form-control-modern::placeholder {
            color: var(--profile-text-secondary);
            opacity: 0.8;
        }

        /* Password Input Group */
        .password-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-toggle-modern {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            color: var(--profile-text-secondary);
            cursor: pointer;
            padding: 8px;
            border-radius: 6px;
            transition: var(--profile-transition);
            z-index: 10;
        }

        .password-toggle-modern:hover {
            background: rgba(77, 110, 245, 0.1);
            color: var(--profile-primary);
        }

        /* File Upload */
        .file-upload-container {
            display: grid;
            gap: 16px;
        }

        .file-upload-area {
            border: 2px dashed var(--profile-border);
            border-radius: var(--profile-radius-sm);
            padding: 24px;
            text-align: center;
            background: var(--profile-surface-alt);
            transition: var(--profile-transition);
            cursor: pointer;
            position: relative;
        }

        .file-upload-area:hover {
            border-color: var(--profile-primary);
            background: rgba(77, 110, 245, 0.02);
        }

        .file-upload-area.dragover {
            border-color: var(--profile-primary);
            background: rgba(77, 110, 245, 0.05);
        }

        .file-input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .upload-icon {
            font-size: 32px;
            color: var(--profile-primary);
            margin-bottom: 12px;
        }

        .upload-text {
            color: var(--profile-text);
            font-weight: 600;
            margin-bottom: 4px;
        }

        .upload-hint {
            color: var(--profile-text-secondary);
            font-size: 13px;
        }

        /* Image Preview */
        .image-preview {
            width: 120px;
            height: 120px;
            border-radius: var(--profile-radius-sm);
            object-fit: cover;
            border: 3px solid var(--profile-border);
            transition: var(--profile-transition);
            box-shadow: var(--profile-shadow);
        }

        .image-preview:hover {
            border-color: var(--profile-primary);
            box-shadow: var(--profile-shadow-lg);
        }

        /* Action Buttons */
        .form-actions {
            display: flex;
            gap: 12px;
            padding-top: 24px;
            border-top: 1px solid var(--profile-border);
            margin-top: 24px;
        }

        .btn-modern {
            padding: 12px 24px;
            border: none;
            border-radius: var(--profile-radius-sm);
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--profile-transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary-modern {
            background: linear-gradient(135deg, var(--profile-primary), #3B5AE0);
            color: white;
            box-shadow: 0 4px 12px rgba(77, 110, 245, 0.3);
        }

        .btn-primary-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(77, 110, 245, 0.4);
        }

        .btn-secondary-modern {
            background: var(--profile-surface-alt);
            color: var(--profile-text);
            border: 2px solid var(--profile-border);
        }

        .btn-secondary-modern:hover {
            background: var(--profile-border);
            transform: translateY(-1px);
        }

        /* Error Messages */
        .form-error {
            color: var(--profile-danger);
            font-size: 13px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-error::before {
            content: '⚠';
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 10px;
            }
            
            .profile-body {
                padding: 20px 16px;
            }
            
            .profile-header {
                padding: 16px 20px;
            }
            
            .form-actions {
                flex-direction: column;
            }

            .profile-container {
                max-width: 100%;
                margin: 0 10px;
            }
        }
    </style>

    <section class="content">
        <div class="profile-container">
            <div class="profile-header">
                <h3 class="profile-title">
                    <i class="fa fa-user-circle"></i>
                    User Profile
                </h3>
            </div>
            
            <div class="profile-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-grid">
                        
                        <!-- Full Name -->
                        <div class="form-row">
                            <label class="form-label required">Full Name</label>
                            <div class="form-field">
                                <input type="text" class="form-control-modern" name="full_name" id="full_name" 
                                       placeholder="Enter your full name" value="<?php echo $full_name; ?>" required />
                                <?php if(form_error('full_name')): ?>
                                    <div class="form-error"><?php echo form_error('full_name'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-row">
                            <label class="form-label required">Email</label>
                            <div class="form-field">
                                <input type="email" class="form-control-modern" name="email" id="email" 
                                       placeholder="Enter your email address" value="<?php echo $email; ?>" required />
                                <?php if(form_error('email')): ?>
                                    <div class="form-error"><?php echo form_error('email'); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-row">
                            <label class="form-label required">Password</label>
                            <div class="form-field">
                                <div class="password-group">
                                    <input type="password" class="form-control-modern" name="password" id="password" 
                                           placeholder="Enter new password" value="" required style="padding-right: 45px;" />
                                    <button type="button" class="password-toggle-modern bt1">
                                        <i class="fa fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-row">
                            <label class="form-label required">Confirm Password</label>
                            <div class="form-field">
                                <div class="password-group">
                                    <input type="password" class="form-control-modern" name="password2" id="password2" 
                                           placeholder="Confirm your password" value="" required style="padding-right: 45px;" />
                                    <button type="button" class="password-toggle-modern bt2">
                                        <i class="fa fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Picture -->
                        <div class="form-row">
                            <label class="form-label">Profile Picture</label>
                            <div class="form-field">
                                <div class="file-upload-container">
                                    <div class="file-upload-area" onclick="document.getElementById('filex').click()">
                                        <input type="file" name="images" class="file-input" id="filex" accept="image/*">
                                        <div class="upload-icon">
                                            <i class="fa fa-cloud-upload"></i>
                                        </div>
                                        <div class="upload-text">Click to upload image</div>
                                        <div class="upload-hint">JPG, PNG, GIF files only</div>
                                    </div>
                                    
                                    <div style="display: flex; justify-content: center; margin-top: 16px;">
                                        <?php
                                            if (empty($images)) {
                                                $photo = base_url("assets/receipt/no_image.jpg");
                                            } else {
                                                $photo = base_url("assets/foto_profil/". $images);
                                            }
                                            echo "<img id='preview' src='$photo' class='image-preview' alt='Profile Image'>";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-row">
                            <div></div>
                            <div class="form-actions">
                                <input type="hidden" name="id_users" value="<?php echo $id_users; ?>" />
                                <button type="submit" class="btn-modern btn-primary-modern">
                                    <i class="fa fa-save"></i>
                                    Update Profile
                                </button>
                                <a href="<?php echo site_url('welcome') ?>" class="btn-modern btn-secondary-modern">
                                    <i class="fa fa-arrow-left"></i>
                                    Back to Dashboard
                                </a>
                            </div>
                        </div>

                    </div>
                </form>        
            </div>
        </div>
    </section>
</div>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>

<!-- ================================
     💫 MODERN JAVASCRIPT INTERACTIONS 
==================================== -->
<script type="text/javascript">
    $(document).ready(function() {
        
        // ================================
        //  🔒 MODERN PASSWORD VISIBILITY  
        // ================================
        $('.bt1').click(function(){
            const input = $('#password');
            const icon = $(this).find('i');
            
            if (input.attr('type') == 'password') {
                input.attr('type', 'text');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            }
        });

        $('.bt2').click(function(){
            const input = $('#password2');
            const icon = $(this).find('i');
            
            if (input.attr('type') == 'password') {
                input.attr('type', 'text');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            }
        });

        // ================================
        //  🖼️  MODERN IMAGE PREVIEW      
        // ================================
        function readURL(input) {
            if (input.files && input.files[0]) {
                // File type validation
                var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
                var fileName = input.files[0].name.split('.').pop().toLowerCase();
                
                if ($.inArray(fileName, fileExtension) == -1) {
                    alert("Only formats are allowed: " + fileExtension.join(', '));
                    $(input).val('');
                    return;
                }

                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result)
                               .hide()
                               .fadeIn(400);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#filex").change(function() {
            readURL(this);
        });

        // ================================
        //  📱 DRAG & DROP FUNCTIONALITY  
        // ================================
        const fileUploadArea = $('.file-upload-area');
        
        fileUploadArea.on('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('dragover');
        });

        fileUploadArea.on('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('dragover');
        });

        fileUploadArea.on('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('dragover');
            
            const files = e.originalEvent.dataTransfer.files;
            if (files.length > 0) {
                $('#filex')[0].files = files;
                readURL($('#filex')[0]);
            }
        });

        // ================================
        //  ✨ SMOOTH FORM INTERACTIONS   
        // ================================
        $('.form-control-modern').on('focus', function() {
            $(this).closest('.form-row').addClass('focused');
        }).on('blur', function() {
            $(this).closest('.form-row').removeClass('focused');
        });

        // Form submission with loading state
        $('form').on('submit', function() {
            const submitBtn = $('.btn-primary-modern');
            submitBtn.html('<i class="fa fa-spinner fa-spin"></i> Updating...')
                     .prop('disabled', true);
        });

        // ================================
        //  🎯 PASSWORD VALIDATION        
        // ================================
        $("#password").keyup(function(){
            var password = $("#password").val();
            $("#password2").val("");
            
            if (password != "") {
                $(".btn-primary-modern").prop("disabled", false);
            } else {
                $(".btn-primary-modern").prop("disabled", true);
                $("#password").val("");
                $("#password2").val("");
            }
        });

        // Password match validation
        $('#password, #password2').on('input', function() {
            const password1 = $('#password').val();
            const password2 = $('#password2').val();
            
            if (password2.length > 0 && password1 !== password2) {
                $('#password2').css('border-color', 'var(--profile-danger)');
            } else {
                $('#password2').css('border-color', 'var(--profile-border)');
            }
        });
    });
</script>

<!-- $(document).ready(function() {

    $(".bt1").bind("click", function() {
        if ($('#password').attr('type') =='password'){
            $('#password').attr('type','text');
            $('.bt1').removeClass('glyphicon-eye-close');
            $('.bt1').addClass('glyphicon-eye-open');
        }else if($('#password').attr('type') =='text'){
            $('#password').attr('type','password');
            $('.bt1').removeClass('glyphicon-eye-open');
            $('.bt1').addClass('glyphicon-eye-close');
        }
        });    

    $(".bt2").bind("click", function() {
        if ($('#password2').attr('type') =='password'){
            $('#password2').attr('type','text');
            $('.bt2').removeClass('glyphicon-eye-close');
            $('.bt2').addClass('glyphicon-eye-open');
        }else if($('#password2').attr('type') =='text'){
            $('#password2').attr('type','password');
            $('.bt2').removeClass('glyphicon-eye-open');
            $('.bt2').addClass('glyphicon-eye-close');
        }
        });    


</script> -->
