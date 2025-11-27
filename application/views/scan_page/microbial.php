<!DOCTYPE html>
<html>
<head>
    <title>Upload Microbial Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <img src="../../img/onewaterlogo.png" height="40px">
        <img src="../../img/monash.png" height="40px">
    </div>

    <div class="text-center mb-4">
        <h4 class="text-success mb-3">Upload Microbial Document</h4>
        <div class="text-center mb-4">
            <div id="dropArea" class="border-6 border-dashed rounded p-5 bg-light" 
                ondragover="event.preventDefault()" 
                ondrop="handleDrop(event)" 
                onclick="document.getElementById('fileInput').click()" 
                style="cursor: pointer;">
                <p class="mb-0 text-muted">
                    <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i><br>
                    Drag & Drop PDF document here or click to choose<br>
                    <small class="text-success"><strong>PDF files only</strong></small>
                </p>
                <input type="file" id="fileInput" class="d-none" accept="application/pdf" onchange="handleFile(this.files)">
            </div>

            <div id="previewContainer" class="mt-3" style="display: none;">
                <p class="mb-2">Preview:</p>
                <iframe id="filePreview" width="100%" height="900px" style="border:1px solid #ccc;"></iframe>
            </div>
        </div>
    </div>

    <div class="text-center">
        <button id="uploadBtn" class="btn btn-success" onclick="uploadFile()">
            <span id="uploadIcon">Upload</span>
            <span id="uploadSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
        </button>
    </div>
</div>

<style>
    #dropArea {
        transition: background-color 0.3s ease, border-color 0.3s ease;
        border-style: dashed;
        border-width: 2px;
        border-color: #28a745;
        background-color: #f8f9fa;
        cursor: pointer;
        text-align: center;
    }

    #dropArea:hover {
        background-color: #e8f5e8;
        border-color: #28a745;
        box-shadow: 0 0 20px rgba(40, 167, 69, 0.3);
    }

    #dropArea.active {
        background-color: #d4edda;
        border-color: #28a745;
        box-shadow: 0 0 20px rgba(40, 167, 69, 0.5);
        animation: pulseBorder 1.2s infinite;
    }

    @keyframes pulseBorder {
        0% {
            box-shadow: 0 0 20px rgba(40, 167, 69, 0.5);
        }
        70% {
              box-shadow: 0 0 20px rgba(40, 167, 69, 0);
        }
        100% {
            box-shadow: 0 0 20px rgba(40, 167, 69, 0);
        }
    }

    #dropArea p {
        transition: color 0.3s ease;
    }

    #dropArea.active p {
        color: #28a745;
    }
</style>

<script>
    let selectedFile = null;
    const dropArea = document.getElementById('dropArea');

    // Helper untuk ambil query parameter
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    const projectId = getQueryParam('project_id'); // Ambil dari URL

    function handleFile(files) {
        if (!files || files.length === 0) return;

        const file = files[0];
        if (file.type !== "application/pdf") {
            Swal.fire({
                icon: "error",
                title: "Invalid File Type", 
                text: "Only PDF files are allowed for Microbial documents.",
                confirmButtonText: "OK"
            });
            return;
        }

        // Validate file size (max 10MB)
        if (file.size > 10 * 1024 * 1024) {
            Swal.fire({
                icon: "error",
                title: "File Too Large",
                text: "PDF file size must be less than 10MB.",
                confirmButtonText: "OK"
            });
            return;
        }

        selectedFile = file;

        const preview = document.getElementById('filePreview');
        const container = document.getElementById('previewContainer');

        const fileURL = URL.createObjectURL(selectedFile);
        preview.src = fileURL;
        container.style.display = 'block';
    }

    function handleDrop(event) {
        event.preventDefault();
        dropArea.classList.remove('active');
        handleFile(event.dataTransfer.files);
    }

    dropArea.addEventListener("dragover", function (e) {
        e.preventDefault();
        dropArea.classList.add('active');
    });

    dropArea.addEventListener("dragleave", function (e) {
        e.preventDefault();
        dropArea.classList.remove('active');
    });

    dropArea.addEventListener("drop", function (e) {
        e.preventDefault();
        dropArea.classList.remove('active');
        handleFile(e.dataTransfer.files);
    });

    function uploadFile() {
        if (!selectedFile) {
            Swal.fire({
                icon: "warning",
                title: "No File Selected", 
                text: "Please select a PDF file to upload.",
                confirmButtonText: "OK"
            });
            return;
        }

        const formData = new FormData();
        formData.append("file", selectedFile);
        formData.append("project_id", projectId); // Kirim project_id

        const btn = document.getElementById('uploadBtn');
        const icon = document.getElementById('uploadIcon');
        const spinner = document.getElementById('uploadSpinner');

        btn.disabled = true;
        icon.innerHTML = "Uploading...";
        spinner.classList.remove("d-none");

        fetch("<?= site_url('Scan_page/do_upload_microbial') ?>", {
            method: "POST",
            body: formData
        })
        .then(response => {
            if (!response.ok) throw new Error("Upload failed");
            return response.json();
        })
        .then(data => {
            Swal.fire({
                icon: "success",
                title: "Upload Success", 
                text: `PDF document uploaded successfully as: ${data.filename}`,
                timer: 2000,
                showConfirmButton: false
            });

            // Send filename back to parent window (Microbial module)
            window.opener?.postMessage({
                type: 'scan-upload-complete',
                filename: data.filename
            }, "*");

            setTimeout(() => window.close(), 1500);
        })
        .catch(err => {
            console.error(err);
            Swal.fire({
                icon: "error",
                title: "Upload Failed", 
                text: err.message || "Failed to upload PDF document.",
                confirmButtonText: "Try Again"
            });
        })
        .finally(() => {
            btn.disabled = false;
            icon.innerHTML = '<i class="fas fa-file-pdf"></i> Upload PDF';
            spinner.classList.add("d-none");
        });
    }
</script>

</body>
</html>