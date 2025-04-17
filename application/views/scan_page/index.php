<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scan Document</title>
    <script src="https://cdn.jsdelivr.net/npm/dwt/dist/dynamsoft.webtwain.min.js"></script>
    </head>
<body>
    <h2>Scan Document</h2>

    <div id="dwtcontrolContainer" style="width:600px; height:400px; border:1px solid #ccc;"></div>

    <button id="scanButton">Start Scanning</button>
    <button id="saveButton">Save to Server</button>
    <form method="post" enctype="multipart/form-data" action="http://127.0.0.1/limsonewater/index.php/scan_page/upload">
    <input type="file" name="RemoteFile">
    <input type="submit" value="Upload">
</form>
    <script>
        // Konfigurasi Kunci Lisensi Dynamsoft Anda
        Dynamsoft.DWT.ProductKey = "t01948AUAALwlHm/qc8mA4t3oftSBSLCX/NHmLcXAlfg6qkWDRBww2VU2d6T0TBdacZZMNUuCBybsglmueeFDMM3/AwTIhI2PKycrOFXeKZR3WgUnbzmBfpl2W7abZd+8gRPwWgDtz2EHLAa2syTA262rV4YAYA5QBlDuDJYDTm/hg+/i4M3JOMb0v4SeOVnBqfLOuEDKOK2Ck7ecvkDaDs3obztuBWLxywkA5gCdAvb7yA4FghRgDtABkFr6r959AT67MX8=;t01898AUAALPhhfYLzj6kyFEPPzuAgVzqtnyWmROrgkEDxUqKt6BHnJRDTiGM17ZMSrGq/Bwqxj6MHHbmC9FQwrOSCgeQzmTlVAWnlXcayjtZwalbTqCfm9162s08LgyQB14zYNt12ADGwDqXBHi7pffKsAOUAywDWG4OzAGnqzhuvpAGJP77z4EGpyo4rbwzDkgZJys4dcs5BaTt0IzTasc1IIxvzg5QDrBTgL+H7BAQpIBygB0As1aCc1/V4zFe"; // Pastikan kunci ini valid

        // Path ke sumber daya DWT (biasanya diperlukan jika tidak menggunakan CDN atau untuk file lokal)
        Dynamsoft.DWT.ResourcesPath = "https://cdn.jsdelivr.net/npm/dwt/dist";

        // Konfigurasi wadah tempat kontrol DWT akan ditampilkan
        Dynamsoft.DWT.Containers = [{ ContainerId: 'dwtcontrolContainer', Width: 600, Height: 400 }];

        // Memuat Dynamsoft Web TWAIN
        Dynamsoft.DWT.Load();

        // Fungsi yang dijalankan setelah DWT siap digunakan
        Dynamsoft.DWT.OnWebTwainReady = function () {
            console.log("Dynamsoft Web TWAIN Ready!"); // Pesan konfirmasi di console
            let viewer = Dynamsoft.DWT.GetWebTwain('dwtcontrolContainer');

            if (!viewer) {
                alert("Gagal menginisialisasi Dynamsoft Web TWAIN viewer.");
                return;
            }

            // Event handler untuk tombol Scan
            document.getElementById("scanButton").onclick = function () {
                if (viewer.SourceCount > 0) {
                    // Pilih sumber (scanner)
                    viewer.SelectSource(function() { // Menggunakan callback untuk memastikan sumber dipilih sebelum dibuka
                        viewer.OpenSource();
                        viewer.AcquireImage({}, // Opsi akuisisi (bisa kosong)
                            function() { console.log("Image acquired successfully."); viewer.CloseSource(); }, // Sukses akuisisi
                            function(errorCode, errorString) { console.error("Acquire Error: " + errorString + " (Code: " + errorCode + ")"); viewer.CloseSource(); } // Error akuisisi
                        );
                    }, function(errorCode, errorString) {
                        console.error("Select Source Error: " + errorString + " (Code: " + errorCode + ")");
                        alert("Gagal memilih sumber scanner: " + errorString);
                    });
                } else {
                    alert("Tidak ada perangkat scanner yang ditemukan. Pastikan driver scanner terinstal dan Dynamsoft Service berjalan.");
                }
            };

            // Event handler untuk tombol Save to Server
            document.getElementById("saveButton").onclick = function () {
                if (viewer.HowManyImagesInBuffer > 0) {
                    // Nama file unik berdasarkan timestamp
                    let filename = 'scan_' + Date.now() + '.jpg';
                    let uploadURL = "http://127.0.0.1/limsonewater/index.php/scan_page/upload"; // Pastikan URL ini benar

                    // --- PERUBAHAN UTAMA: Baris ini dihapus/dikomentari ---
                    // viewer.HTTPPort = 80;
                    // ----------------------------------------------------

                    viewer.IfSSL = false; // Gunakan false jika URL adalah http://
                    viewer.IfShowFileDialog = false; // Jangan tampilkan dialog simpan file lokal
                    viewer.HTTPUploadDataFieldName = "RemoteFile"; // Nama field file di $_FILES PHP
                    viewer.HTTPHeaders = []; // Header tambahan jika diperlukan (biasanya tidak untuk upload standar)

                    console.log("Attempting to upload to:", uploadURL);
                    console.log("Filename:", filename);
                    console.log("Images in buffer:", viewer.HowManyImagesInBuffer);
                    console.log("Upload field name:", viewer.HTTPUploadDataFieldName);
                    console.log("Calling HTTPUploadThroughPost with:", {
                      uploadURL,
                      filename,
                      index: viewer.CurrentImageIndexInBuffer
                    });
                    let viewer1 = Dynamsoft.DWT.GetWebTwain('dwtcontrolContainer');
                      if (viewer1) {
                          console.log("DWT Version:", viewer1.VersionInfo || viewer1.Version || "Tidak diketahui");
                      }

                      let currentIndex = viewer.CurrentImageIndexInBuffer;
                      console.log("Current Image Index:", currentIndex);

                      viewer.HTTPUploadThroughPostEx(
                            uploadURL,
                            filename,
                            currentIndex,
                            "image/jpeg",
                            Dynamsoft.DWT.EnumDWT_UploadDataFormat.UDF_JPG,
                            function (responseText) {
                                console.log("Server response:", responseText);
                                try {
                                    const res = JSON.parse(responseText);
                                    if (res.success && window.opener) {
                                        window.opener.document.getElementById("files").value = res.filename;
                                        window.close();
                                    } else {
                                        alert("Upload failed: " + (res.error || "Unknown error"));
                                    }
                                } catch (e) {
                                    alert("Invalid JSON response: " + responseText);
                                }
                            },
                            function (errCode, errString) {
                                alert("Upload Error: " + errString + " (code " + errCode + ")");
                            },
                            {
                                bUseForm: true, // << INI HARUS ADA
                                // HTTPHeader: [
                                //     "Cache-Control: no-cache",
                                //     "Content-Type: multipart/form-data"
                                // ],
                                // additionalFields: [{ name: "RemoteFile", value: filename }] // 🔥 Tambahkan ini
                            }
                      );

                } else {
                    alert("Silakan pindai dokumen terlebih dahulu sebelum menyimpan.");
                }
            }; // Akhir dari saveButton onclick

        }; // Akhir dari OnWebTwainReady

        // Menangani error jika DWT gagal dimuat
        Dynamsoft.DWT.OnWebTwainLoadFailed = function(errorCode, errorString) {
            console.error('Gagal memuat Dynamsoft Web TWAIN:', errorString + " (Code: " + errorCode + ")");
            alert('Gagal memuat komponen scanner: ' + errorString);
        };

    </script>

</body>
</html>