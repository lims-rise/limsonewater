<!DOCTYPE html>
<html>
<head>
    <title>Scan Page</title>
    <script src="https://cdn.jsdelivr.net/npm/dwt/dist/dynamsoft.webtwain.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <img src="../img/onewaterlogo.png" height="40px">
        <img src="../img/monash.png" height="40px">
    </div>

    <div id="dwtcontrolContainer" style="width:700px;height:400px;border:1px solid #ccc;"></div>

    <div class="mt-4 text-center">
        <button class="btn btn-primary me-3" onclick="acquireImage()">
            <i class="fa fa-camera"></i> Scan
        </button>
        <button class="btn btn-success" onclick="uploadImage()">
            <i class="fa fa-upload"></i> Upload
        </button>
    </div>
</div>


    <script>
        let DWObject = null;

        // Masukkan ProductKey kamu di sini
        Dynamsoft.DWT.ProductKey = "t01948AUAALwlHm/qc8mA4t3oftSBSLCX/NHmLcXAlfg6qkWDRBww2VU2d6T0TBdacZZMNUuCBybsglmueeFDMM3/AwTIhI2PKycrOFXeKZR3WgUnbzmBfpl2W7abZd+8gRPwWgDtz2EHLAa2syTA262rV4YAYA5QBlDuDJYDTm/hg+/i4M3JOMb0v4SeOVnBqfLOuEDKOK2Ck7ecvkDaDs3obztuBWLxywkA5gCdAvb7yA4FghRgDtABkFr6r959AT67MX8=;t01898AUAALPhhfYLzj6kyFEPPzuAgVzqtnyWmROrgkEDxUqKt6BHnJRDTiGM17ZMSrGq/Bwqxj6MHHbmC9FQwrOSCgeQzmTlVAWnlXcayjtZwalbTqCfm9162s08LgyQB14zYNt12ADGwDqXBHi7pffKsAOUAywDWG4OzAGnqzhuvpAGJP77z4EGpyo4rbwzDkgZJys4dcs5BaTt0IzTasc1IIxvzg5QDrBTgL+H7BAQpIBygB0As1aCc1/V4zFe"; // Ganti dengan lisensi kamu

        Dynamsoft.DWT.ResourcesPath = "https://cdn.jsdelivr.net/npm/dwt/dist";
        Dynamsoft.DWT.Containers = [{ ContainerId: 'dwtcontrolContainer', Width: 700, Height: 400 }];
        Dynamsoft.DWT.Load();
        Dynamsoft.DWT.RegisterEvent('OnWebTwainReady', function () {
            DWObject = Dynamsoft.DWT.GetWebTwain('dwtcontrolContainer');
            if (DWObject) {
                console.log("Dynamsoft Web TWAIN Ready!");
            } else {
                alert("Failed to initialize Dynamsoft Web TWAIN.");
            }
        });

        Dynamsoft.DWT.RegisterEvent('OnWebTwainReady', function () {
            DWObject = Dynamsoft.DWT.GetWebTwain('dwtcontrolContainer');
            if (DWObject) {
                console.log("Dynamsoft Web TWAIN Ready!");
            } else {
                Swal.fire("Gagal", "Failed to initialize Dynamsoft Web TWAIN.", "error");
            }
        });

        function acquireImage() {
            if (!DWObject) {
                Swal.fire("Scanner is not ready", "Waiting till scanner is ready.", "warning");
                return;
            }

            if (DWObject.SourceCount === 0) {
                Swal.fire("There is no scanner", "Scanner is not detect.", "error");
                return;
            }

            DWObject.SelectSourceAsync().then(() => {
                return DWObject.AcquireImageAsync({});
            }).then(() => {
                Swal.fire("Success", "Image scan successfully.", "success");
            }).catch(err => {
                console.error("Scan failed:", err.message || err);
                Swal.fire("Scan failed", err.message || "Unknown error", "error");
            });
        }

        function uploadImage() {
            if (!DWObject) {
                Swal.fire("DWObject is not ready", "", "warning");
                return;
            }

            const filename = "scan_" + Date.now() + ".pdf";
            const localPath = "S:\\OneWater\\Data\\Scan\\" + filename;

            console.log("Jumlah halaman di buffer:", DWObject.HowManyImagesInBuffer);

            const result = DWObject.SaveAllAsPDF(localPath);

            if (!result) {
                console.error("Gagal simpan lokal:", DWObject.ErrorString);
                Swal.fire("Failed to save the image", DWObject.ErrorString || "Gagal menyimpan ke lokal.", "error");
                return;
            } else {
                Swal.fire("Upload success", "File: " + filename, "success");

                window.opener.postMessage({
                    type: 'scan-upload-complete',
                    filename: filename
                }, "*");

                setTimeout(() => window.close(), 1000);
            }
        }



    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</body>
</html>
