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
    <form action="http://127.0.0.1/limsonewater/index.php/Scan_page/upload" method="post" enctype="multipart/form-data">
  <input type="file" name="RemoteFile">
  <input type="submit" value="Upload">
</form>


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
  //         alert("DWObject not ready.");
  //         return;
  //     }

  //     const imageIndex = 0;
  //     const uploadFieldName = "RemoteFile";
  //     const filename = "scan_" + Date.now() + ".jpg";
  //     const uploadURL = "http://127.0.0.1/limsonewater/index.php/Scan_page/upload";

  //     console.log("Attempting to upload to:", uploadURL);
  //     console.log("Filename:", filename);
  //     console.log("Images in buffer:", DWObject.HowManyImagesInBuffer);
  //     console.log("Upload field name:", uploadFieldName);

  //     const result = DWObject.HTTPUploadThroughPostEx(
  //         uploadURL,
  //         imageIndex,
  //         filename,
  //         Dynamsoft.DWT.EnumDWT_ImageType.IT_JPG,
  //         Dynamsoft.DWT.EnumDWT_UploadDataFormat.Binary,
  //         uploadFieldName
  //     );

  //     if (result === 0) {
  //         const errorString = DWObject.ErrorString;
  //         console.error("Upload failed. Error:", errorString);
  //         alert("Upload gagal: " + errorString);
  //     } else {
  //         console.log("Upload berhasil.");
  //         alert("Upload sukses!");
  //     }
  // }

  function uploadImage() {
    if (!DWObject) {
        alert("DWObject not ready.");
        return;
    }

    const imageIndex = 0; // penting!
    const uploadFieldName = "RemoteFile";
    const filename = "scan_" + Date.now() + ".jpg";
    const uploadURL = "http://localhost/limsonewater/index.php/Scan_page/upload"; // ganti 127.0.0.1 jadi localhost

    console.log("Attempting to upload to:", uploadURL);
    console.log("Filename:", filename);
    console.log("Images in buffer:", DWObject.HowManyImagesInBuffer);
    console.log("Upload field name:", uploadFieldName);

    // 👇 Coba simpan gambar secara lokal dulu untuk debug
    // const testSaveResult = DWObject.SaveAsJPEG("C:\\temp\\test.jpg", imageIndex);
    // if (!testSaveResult) {
    //     console.error("Gagal menyimpan gambar lokal. Error:", DWObject.ErrorString);
    //     alert("Gagal menyimpan gambar ke lokal. Periksa apakah gambarnya valid.");
    //     return;
    // } else {
    //     console.log("Berhasil menyimpan gambar ke C:\\temp\\test.jpg");
    // }

    // 👇 Upload gambar ke server
            DWObject.HTTPUploadThroughPost(
            uploadURL,
            imageIndex,
            filename,
            Dynamsoft.DWT.EnumDWT_ImageType.IT_JPG,
            uploadFieldName,
            function(result, serverResponse) {
                if (result) {
                    console.log("Upload berhasil. Server response:", serverResponse);
                    alert("Upload sukses!");
                } else {
                    console.error("Upload gagal. Error:", DWObject.ErrorString);
                    alert("Upload gagal: " + DWObject.ErrorString);
                }
            }
        );

}



    </script>
</body>
</html>
