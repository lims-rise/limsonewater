<!DOCTYPE html>
<html>
<head>
    <title>Upload Scan Manual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <img src="../img/onewaterlogo.png" height="40px">
        <img src="../img/monash.png" height="40px">
    </div>

    <div class="text-center mb-4">
        <!-- <input type="file" id="fileInput" class="form-control mb-3" accept="application/pdf,image/*" onchange="previewFile()"> -->
        <div class="text-center mb-4">
            <div id="dropArea" class="border-6 border-dashed rounded p-5 bg-light" 
                ondragover="event.preventDefault()" 
                ondrop="handleDrop(event)" 
                onclick="document.getElementById('fileInput').click()" 
                style="cursor: pointer;">
                <p class="mb-0 text-muted"><i class="fas fa-cloud-upload-alt fa-2x mb-2"></i><br>Drag & Drop file here or click to choose</p>
                <!-- <input type="file" id="fileInput" class="d-none" accept="application/pdf,image/*" onchange="handleFile(this.files)"> -->
                <input type="file" id="fileInput" class="d-none" accept="application/pdf" onchange="handleFile(this.files)">
            </div>

            <div id="previewContainer" class="mt-3" style="display: none;">
                <p class="mb-2">Preview:</p>
                <iframe id="filePreview" width="100%" height="900px" style="border:1px solid #ccc;"></iframe>
            </div>
        </div>

        <div id="previewContainer" style="display: none;">
            <p class="mb-2">Preview:</p>
            <iframe id="filePreview" width="100%" height="400px" style="border:1px solid #ccc;"></iframe>
        </div>
    </div>

    <div class="text-center">
        <button id="uploadBtn" class="btn btn-success" onclick="uploadFile()">
            <span id="uploadIcon"><i class="fa fa-upload"></i> Upload</span>
            <span id="uploadSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
        </button>
    </div>
</div>

<!-- <script>
    let selectedFile = null;

    function previewFile() {
        const input = document.getElementById('fileInput');
        selectedFile = input.files[0];

        if (!selectedFile) return;

        const preview = document.getElementById('filePreview');
        const container = document.getElementById('previewContainer');

        const fileURL = URL.createObjectURL(selectedFile);
        preview.src = fileURL;
        container.style.display = 'block';
    }

    function uploadFile() {
        if (!selectedFile) {
            Swal.fire("No file selected", "Please select a file to upload.", "warning");
            return;
        }

        const formData = new FormData();
        formData.append("file", selectedFile);

        fetch("Scan_page/do_upload", { // <- GANTI sesuai endpoint upload backend kamu
            method: "POST",
            body: formData
        })
        .then(response => {
            if (!response.ok) throw new Error("Upload failed");
            return response.json();
        })
        .then(data => {
            Swal.fire("Upload success", `File uploaded as: ${data.filename}`, "success");

            // Kirim data ke parent window jika dibuka dari modal
            window.opener?.postMessage({
                type: 'scan-upload-complete',
                filename: data.filename
            }, "*");

            setTimeout(() => window.close(), 1000);
        })
        .catch(err => {
            console.error(err);
            Swal.fire("Upload error", err.message || "Failed to upload file.", "error");
        });
    }
</script> -->

<style>
    #dropArea {
        transition: background-color 0.3s ease, border-color 0.3s ease;
        border-style: dashed;
        border-width: 2px;
        border-color: #ccc;
        background-color: #BADFDB;
        cursor: pointer;
        text-align: center;
    }

    #dropArea:hover {
        background-color: #e9f5ff;
        border-color: #BADFDB;
        box-shadow: 0 0 20px rgba(186, 223, 219, 0.3);
    }

    #dropArea.active {
        background-color: #e0f7ff;
        border-color: #BADFDB;
        box-shadow: 0 0 20px rgba(186, 223, 219, 0.3);
        animation: pulseBorder 1.2s infinite;
    }

    @keyframes pulseBorder {
        0% {
            box-shadow: 0 0 20px rgba(186, 223, 219, 0.5);
        }
        70% {
              box-shadow: 0 0 20px rgba(186, 223, 219, 0);
        }
        100% {
            box-shadow: 0 0 20px rgba(186, 223, 219, 0);
        }
    }

    #dropArea p {
        transition: color 0.3s ease;
    }

    #dropArea.active p {
        color: #BADFDB;
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

    const projectId = getQueryParam('project_id'); // ← Ambil dari URL

    function handleFile(files) {
        if (!files || files.length === 0) return;

        const file = files[0];
        if (file.type !== "application/pdf") {
            Swal.fire("Invalid file", "Only PDF files are allowed.", "error");
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

    // function uploadFile() {
    //     if (!selectedFile) {
    //         Swal.fire("No file selected", "Please select a file to upload.", "warning");
    //         return;
    //     }

    //     const formData = new FormData();
    //     formData.append("file", selectedFile);

    //     // Handle UI loading state
    //     const btn = document.getElementById('uploadBtn');
    //     const icon = document.getElementById('uploadIcon');
    //     const spinner = document.getElementById('uploadSpinner');

    //     btn.disabled = true;
    //     icon.innerHTML = "Uploading...";
    //     spinner.classList.remove("d-none");

    //     fetch("Scan_page/do_upload", {
    //         method: "POST",
    //         body: formData
    //     })
    //     .then(response => {
    //         if (!response.ok) throw new Error("Upload failed");
    //         return response.json();
    //     })
    //     .then(data => {
    //         Swal.fire("Upload success", `File uploaded as: ${data.filename}`, "success");

    //         window.opener?.postMessage({
    //             type: 'scan-upload-complete',
    //             filename: data.filename
    //         }, "*");

    //         setTimeout(() => window.close(), 1000);
    //     })
    //     .catch(err => {
    //         console.error(err);
    //         Swal.fire("Upload error", err.message || "Failed to upload file.", "error");
    //     })
    //     .finally(() => {
    //         // Reset button state
    //         btn.disabled = false;
    //         icon.innerHTML = '<i class="fa fa-upload"></i> Upload';
    //         spinner.classList.add("d-none");
    //     });
    // }

    function uploadFile() {
    if (!selectedFile) {
        Swal.fire("No file selected", "Please select a file to upload.", "warning");
        return;
    }

    const formData = new FormData();
    formData.append("file", selectedFile);
    formData.append("project_id", projectId); // ← Kirim project_id

    const btn = document.getElementById('uploadBtn');
    const icon = document.getElementById('uploadIcon');
    const spinner = document.getElementById('uploadSpinner');

    btn.disabled = true;
    icon.innerHTML = "Uploading...";
    spinner.classList.remove("d-none");

    fetch("<?= site_url('Scan_page/do_upload') ?>", {
        method: "POST",
        body: formData
    })
    .then(response => {
        if (!response.ok) throw new Error("Upload failed");
        return response.json();
    })
    .then(data => {
        Swal.fire("Upload success", `File uploaded as: ${data.filename}`, "success");

        window.opener?.postMessage({
            type: 'scan-upload-complete',
            filename: data.filename
        }, "*");

        setTimeout(() => window.close(), 1000);
    })
    .catch(err => {
        console.error(err);
        Swal.fire("Upload error", err.message || "Failed to upload file.", "error");
    })
    .finally(() => {
        btn.disabled = false;
        icon.innerHTML = '<i class="fa fa-upload"></i> Upload';
        spinner.classList.add("d-none");
    });
}
</script>


</script>
</body>
</html>
