<!DOCTYPE html>
<html>
<head>
    <title>Scan Page</title>
    <script src="https://cdn.jsdelivr.net/npm/dwt/dist/dynamsoft.webtwain.min.js"></script>
</head>
<body>
    <h1>Scan Document</h1>

    <!-- Container untuk WebTWAIN -->
    <div id="dwtcontrolContainer" style="width:600px;height:400px;"></div>

    <button onclick="acquireImage()">Scan</button>
    <button onclick="uploadImage()">Upload</button>


    <script>
        let DWObject = null;

        // Masukkan ProductKey kamu di sini
        Dynamsoft.DWT.ProductKey = "t01948AUAALwlHm/qc8mA4t3oftSBSLCX/NHmLcXAlfg6qkWDRBww2VU2d6T0TBdacZZMNUuCBybsglmueeFDMM3/AwTIhI2PKycrOFXeKZR3WgUnbzmBfpl2W7abZd+8gRPwWgDtz2EHLAa2syTA262rV4YAYA5QBlDuDJYDTm/hg+/i4M3JOMb0v4SeOVnBqfLOuEDKOK2Ck7ecvkDaDs3obztuBWLxywkA5gCdAvb7yA4FghRgDtABkFr6r959AT67MX8=;t01898AUAALPhhfYLzj6kyFEPPzuAgVzqtnyWmROrgkEDxUqKt6BHnJRDTiGM17ZMSrGq/Bwqxj6MHHbmC9FQwrOSCgeQzmTlVAWnlXcayjtZwalbTqCfm9162s08LgyQB14zYNt12ADGwDqXBHi7pffKsAOUAywDWG4OzAGnqzhuvpAGJP77z4EGpyo4rbwzDkgZJys4dcs5BaTt0IzTasc1IIxvzg5QDrBTgL+H7BAQpIBygB0As1aCc1/V4zFe"; // Ganti dengan lisensi kamu

        Dynamsoft.DWT.ResourcesPath = "https://cdn.jsdelivr.net/npm/dwt/dist";
        Dynamsoft.DWT.Containers = [{ ContainerId: 'dwtcontrolContainer', Width: 600, Height: 400 }];
        Dynamsoft.DWT.Load();
        Dynamsoft.DWT.RegisterEvent('OnWebTwainReady', function () {
            DWObject = Dynamsoft.DWT.GetWebTwain('dwtcontrolContainer');
            if (DWObject) {
                console.log("Dynamsoft Web TWAIN Ready!");
            } else {
                alert("Failed to initialize Dynamsoft Web TWAIN.");
            }
        });

        function acquireImage() {
            if (!DWObject) {
                alert("Scanner belum siap. Mohon tunggu sampai scanner siap.");
                return;
            }

            if (DWObject.SourceCount === 0) {
                alert("Tidak ada sumber scanner yang terdeteksi.");
                return;
            }

            DWObject.SelectSourceAsync().then(() => {
                console.log("Sumber scanner dipilih.");
                return DWObject.AcquireImageAsync({});
            }).then(() => {
                console.log("Gambar berhasil discan.");
            }).catch(err => {
                console.error("Gagal scan:", err.message || err);
                alert("Terjadi kesalahan saat scan: " + (err.message || err));
            });
        }


        // function uploadImage() {
        //     if (!DWObject) {
        //         alert("DWObject belum siap.");
        //         return;
        //     }
            
        //     const imageIndex = 0; // semua image
        //     const filename = "scan_" + Date.now() + ".pdf"; // ✅ sudah string & .pdf
        //     const uploadFieldName = "RemoteFile";
        //     const uploadURL = "http://localhost/limsonewater/index.php/Scan_page/upload";

        //     // Simpan ke lokal untuk debug
        //     const testSaveResult = DWObject.SaveAsPDF("S:\\OneWater\\Data\\Scan\\" + filename, imageIndex);
        //     if (!testSaveResult) {
        //         console.error("Gagal simpan lokal:", DWObject.ErrorString);
        //         alert("Gagal simpan lokal.");
        //         return;
        //     } else {
        //         alert("Upload sukses: " + filename);
        //         // kirim ke parent
        //         window.opener.postMessage({
        //             type: 'scan-upload-complete',
        //             filename: filename
        //         }, "*");

        //         setTimeout(() => window.close(), 1000);
        //     }
        // }

        function uploadImage() {
            if (!DWObject) {
                alert("DWObject belum siap.");
                return;
            }

            const filename = "scan_" + Date.now() + ".pdf";
            const localPath = "S:\\OneWater\\Data\\Scan\\" + filename;

            console.log("Jumlah halaman di buffer:", DWObject.HowManyImagesInBuffer);

            // ✅ Simpan semua image di buffer ke dalam 1 PDF
            const result = DWObject.SaveAllAsPDF(localPath);

            if (!result) {
                console.error("Gagal simpan lokal:", DWObject.ErrorString);
                alert("Gagal simpan lokal.");
                return;
            } else {
                alert("Upload sukses: " + filename);

                // Kirim ke parent modal
                window.opener.postMessage({
                    type: 'scan-upload-complete',
                    filename: filename
                }, "*");

                setTimeout(() => window.close(), 1000);
            }
        }



    </script>
</body>
</html>
