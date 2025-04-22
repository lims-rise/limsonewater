<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scan_page extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        is_login();
    }
    // Tambahkan method lain jika ada (misalnya index untuk menampilkan view)
    public function index() {
        $this->load->view('scan_page/index'); // Ganti 'scan_page' dengan nama file view Anda jika berbeda
    }

    // public function upload()
    // {
    //     // ---------------------------------------------------------------------
    //     // ** BAGIAN 1: Penanganan CORS Preflight (OPTIONS Request) **
    //     // ---------------------------------------------------------------------
    //     if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    //         header("Access-Control-Allow-Origin: *"); // Atau ganti * dengan domain spesifik Anda jika perlu
    //         header("Access-Control-Allow-Methods: POST, OPTIONS"); // Harus menyertakan OPTIONS
    //         header("Access-Control-Allow-Headers: Content-Type, X-Requested-With, Cache-Control, Pragma, Origin, Authorization");
    //         header("HTTP/1.1 200 OK");
    //         exit();
    //     }
    //     // ---------------------------------------------------------------------
    
    //     // ---------------------------------------------------------------------
    //     // ** BAGIAN 2: Set Header untuk POST Request (dan fallback jika tidak ada OPTIONS) **
    //     // ---------------------------------------------------------------------
    //     header("Access-Control-Allow-Origin: *");
    //     header('Content-Type: application/json');
    //     header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    //     header("Cache-Control: post-check=0, pre-check=0", false);
    //     header("Pragma: no-cache");
    //     // ---------------------------------------------------------------------
    
    //     // ---------------------------------------------------------------------
    //     // ** BAGIAN 3: Logging Awal **
    //     // ---------------------------------------------------------------------
    //     $logFile = FCPATH . 'uploads/log_upload.txt';
    //     $debugFile = FCPATH . 'uploads/debug.txt';
    //     $headersFile = FCPATH . 'uploads/debug_headers.txt';
    
    //     $timestamp = date('Y-m-d H:i:s');
    //     file_put_contents($logFile, "\n--- UPLOAD ATTEMPT [$timestamp] ---\n", FILE_APPEND);
    //     file_put_contents($logFile, "Request Method: " . (isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'N/A') . "\n", FILE_APPEND);
    
    //     // Log headers
    //     $allHeaders = function_exists('getallheaders') ? getallheaders() : 'getallheaders() not available';
    //     file_put_contents($headersFile, "[$timestamp]\n" . print_r($allHeaders, true) . "\n", FILE_APPEND);
    //     file_put_contents($logFile, "Headers Logged to debug_headers.txt\n", FILE_APPEND);
    
    //     // Log raw input
    //     $rawInput = file_get_contents('php://input');
    //     file_put_contents($logFile, "Raw Input Size: " . strlen($rawInput) . " bytes\n", FILE_APPEND);
    
    //     // Log $_FILES and $_POST
    //     file_put_contents($logFile, "FILES:\n" . print_r($_FILES, true) . "\n", FILE_APPEND);
    //     file_put_contents($debugFile, "[$timestamp]\nFILES:\n" . print_r($_FILES, true) . "\n", FILE_APPEND);
    //     file_put_contents($logFile, "POST:\n" . print_r($_POST, true) . "\n", FILE_APPEND);
    //     // ---------------------------------------------------------------------
    
    //     // ---------------------------------------------------------------------
    //     // ** BAGIAN 4: Pemrosesan Upload **
    //     // ---------------------------------------------------------------------
    //     $uploadDir = FCPATH . 'uploads/' . date('Y-m-d') . '/';
    
    //     if (!is_dir($uploadDir)) {
    //         if (!@mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
    //             $errorMsg = "Server error: Gagal membuat direktori upload: $uploadDir. Periksa izin.";
    //             file_put_contents($logFile, "ERROR: $errorMsg\n", FILE_APPEND);
    //             http_response_code(500);
    //             echo json_encode(['success' => false, 'error' => $errorMsg]);
    //             exit;
    //         }
    //         file_put_contents($logFile, "Directory created or already exists: $uploadDir\n", FILE_APPEND);
    //     }
    
    //     // Periksa apakah file 'RemoteFile' ada dan diupload dengan benar
    //     if (!isset($_FILES['RemoteFile'])) {
    //         $errorMsg = 'Tidak ada file yang diterima dengan nama "RemoteFile".';
    //         file_put_contents($logFile, "ERROR: $errorMsg\n", FILE_APPEND);
    //         http_response_code(200); // Kirim response OK untuk menangani error DWT -2359
    //         echo json_encode(['success' => false, 'error' => $errorMsg]);
    //         exit;
    //     }
    
    //     // Periksa error upload PHP
    //     if ($_FILES['RemoteFile']['error'] !== UPLOAD_ERR_OK) {
    //         $uploadErrors = [
    //             UPLOAD_ERR_INI_SIZE   => "File melebihi batas upload_max_filesize di php.ini.",
    //             UPLOAD_ERR_FORM_SIZE  => "File melebihi batas MAX_FILE_SIZE di form HTML.",
    //             UPLOAD_ERR_PARTIAL    => "File hanya terupload sebagian.",
    //             UPLOAD_ERR_NO_FILE    => "Tidak ada file yang diupload.",
    //             UPLOAD_ERR_NO_TMP_DIR => "Missing temporary folder di server.",
    //             UPLOAD_ERR_CANT_WRITE => "Gagal menulis file ke disk (izin?).",
    //             UPLOAD_ERR_EXTENSION  => "Ekstensi PHP menghentikan upload file.",
    //         ];
    //         $errorCode = $_FILES['RemoteFile']['error'];
    //         $errorMsg = isset($uploadErrors[$errorCode]) ? $uploadErrors[$errorCode] : "Unknown upload error code: $errorCode";
    //         file_put_contents($logFile, "ERROR: PHP Upload Error: $errorMsg (Code: $errorCode)\n", FILE_APPEND);
    //         http_response_code(200);
    //         echo json_encode(['success' => false, 'error' => "PHP Upload Error: $errorMsg"]);
    //         exit;
    //     }




    
    //     // Proses file yang diupload

    //     if (isset($_FILES['RemoteFile'])) {
    //         // proses upload
    //         $file = $_FILES['RemoteFile'];
    //         // var_dump($file);
    //         // die();
    //         $originalFilename = basename($file['name']);
    //         $safeFilename = preg_replace("/[^a-zA-Z0-9\._-]/", "_", $originalFilename);
    //         $targetPath = $uploadDir . $safeFilename;
    //         $rawInput = file_get_contents("php://input");
    //         file_put_contents($logFile, "Attempting to move '{$file['tmp_name']}' to '$targetPath'\n", FILE_APPEND);
    
    
    //         file_put_contents('php://temp', $rawInput); // atau log ke file
    //         log_message('debug', "Raw input size: " . strlen($rawInput) . " bytes");
    
        
    //         // Pindahkan file yang diupload
    //         if (move_uploaded_file($file['tmp_name'], $targetPath)) {
    //             $successMsg = "File berhasil diupload dan disimpan sebagai: " . date('Y-m-d') . '/' . $safeFilename;
    //             file_put_contents($logFile, "SUCCESS: $successMsg\n", FILE_APPEND);
    //             http_response_code(200);
    //             echo json_encode(['success' => true, 'filename' => date('Y-m-d') . '/' . $safeFilename, 'message' => $successMsg]);
    //             exit;
    //         } else {
    //             $moveError = error_get_last();
    //             $errorMsg = "Gagal memindahkan file yang diupload ke '$targetPath'. Kemungkinan masalah izin atau path tidak valid.";
    //             file_put_contents($logFile, "ERROR: $errorMsg\n", FILE_APPEND);
    //             if ($moveError) {
    //                 file_put_contents($logFile, "Move Error Details: " . print_r($moveError, true) . "\n", FILE_APPEND);
    //             }
    //             http_response_code(200); // Atau 500
    //             echo json_encode(['success' => false, 'error' => $errorMsg]);
    //             exit;
    //         }
    //     } else {
    //         log_message('error', 'RemoteFile tidak ditemukan di $_FILES.');
    //     }
    //     // ---------------------------------------------------------------------
    // }

    public function upload()
    {
        // Header CORS
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Methods: POST, OPTIONS");
            header("Access-Control-Allow-Headers: Content-Type, X-Requested-With");
            exit();
        }

        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');

        $logFile = FCPATH . 'uploads/log_upload.txt';
        $timestamp = date('Y-m-d H:i:s');
        file_put_contents($logFile, "\n[$timestamp] MULAI UPLOAD\n", FILE_APPEND);
        file_put_contents($logFile, "FILES:\n" . print_r($_FILES, true), FILE_APPEND);

        // Folder tujuan
        $uploadDir = FCPATH . 'uploads/' . date('Y-m-d') . '/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Validasi ada file
        if (!isset($_FILES['RemoteFile'])) {
            file_put_contents($logFile, "ERROR: Field RemoteFile tidak ditemukan.\n", FILE_APPEND);
            echo json_encode(['success' => false, 'error' => 'Tidak ada file diterima.']);
            return;
        }

        $file = $_FILES['RemoteFile'];
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errorMsg = 'Upload error code: ' . $file['error'];
            file_put_contents($logFile, "ERROR: $errorMsg\n", FILE_APPEND);
            echo json_encode(['success' => false, 'error' => $errorMsg]);
            return;
        }

        $safeName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', basename($file['name']));
        $savePath = $uploadDir . $safeName;

        if (move_uploaded_file($file['tmp_name'], $savePath)) {
            file_put_contents($logFile, "SUKSES: File disimpan di $savePath\n", FILE_APPEND);
            echo json_encode([
                'success' => true,
                'filename' => date('Y-m-d') . '/' . $safeName,
                'message' => 'Upload sukses!'
            ]);
        } else {
            file_put_contents($logFile, "ERROR: Gagal simpan file ke $savePath\n", FILE_APPEND);
            echo json_encode(['success' => false, 'error' => 'Gagal menyimpan file.']);
        }
    }

    public function view_file($filename)
    {
        $filename = basename($filename);
        $basePath = '\\\\ad.monash.edu\\shared\\OneWater\\Data\\Scan\\';
        $filePath = $basePath . $filename;
    
        if (!file_exists($filePath)) {
            log_message('error', 'File tidak ditemukan: ' . $filePath);
            show_404();
            return;
        }
    
        // Set header supaya file bisa dibuka di browser
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $filename . '"');
        header('Content-Length: ' . filesize($filePath));
    
        readfile($filePath);
        exit;
    }
    


    // public function view_file($filename) {
    //     $filepath = '\\\\ad.monash.edu\\shared\\OneWater\\Data\\Scan\\' . $filename;
    
    //     // Debug log & output
    //     log_message('debug', 'Coba akses file: ' . $filepath);
    //     echo "Cek path: $filepath<br>";
    
    //     if (file_exists($filepath)) {
    //         echo "File ditemukan, coba buka...<br>";
    //         header('Content-Type: application/pdf');
    //         header('Content-Disposition: inline; filename="' . $filename . '"');
    //         header('Content-Length: ' . filesize($filepath));
    //         readfile($filepath);
    //         exit;
    //     } else {
    //         echo "File tidak ditemukan.";
    //         log_message('error', 'File tidak ditemukan: ' . $filepath);
    //         show_404();
    //     }
    // }

    // public function view_file($filename)
    // {
    //     $networkPath = '\\\\ad.monash.edu\\shared\\OneWater\\Data\\Scan\\' . $filename;
    //     $localPath = FCPATH . 'uploads/scan/' . $filename;

    //     // Jika file belum ada di lokal, copy dulu
    //     if (!file_exists($localPath)) {
    //         if (file_exists($networkPath)) {
    //             if (!copy($networkPath, $localPath)) {
    //                 log_message('error', 'Gagal menyalin file ke lokal: ' . $filename);
    //                 show_error('Gagal menyalin file.', 500);
    //                 return;
    //             }
    //         } else {
    //             log_message('error', 'File tidak ditemukan di network path: ' . $networkPath);
    //             show_404();
    //             return;
    //         }
    //     }

    //     // Redirect ke lokasi file lokal
    //     redirect(base_url('uploads/scan/' . $filename));
    // }



    // Controller Scan_page.php
// public function copy_to_local()
// {
//     $filename = $this->input->post('filename');

//     if (!$filename) {
//         log_message('error', 'Filename tidak diberikan.');
//         show_error('Filename tidak diberikan.', 400);
//         return;
//     }

//     $networkPath = '\\\\130.194.19.71\\OneWater\\Data\\Scan\\' . $filename;
//     $localPath = FCPATH . 'uploads/scan/' . $filename;

//     if (!file_exists($networkPath)) {
//         log_message('error', 'File tidak ditemukan di network drive: ' . $networkPath);
//         show_error('File tidak ditemukan di network drive.', 404);
//         return;
//     }

//     if (!copy($networkPath, $localPath)) {
//         log_message('error', 'Gagal menyalin file ke lokal: ' . $localPath);
//         show_error('Gagal menyalin file ke lokal.', 500);
//         return;
//     }

//     log_message('debug', 'File berhasil disalin ke lokal: ' . $localPath);
//     echo json_encode(['status' => 'success', 'filename' => $filename]);
// }

    
    
    
    


    
}