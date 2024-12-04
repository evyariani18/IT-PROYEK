<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client as Google_Client;
use Google\Service\Drive as Google_Service_Drive;
use InvalidArgumentException;
use App\Models\GoogleDriveToken; // Pastikan sudah menambahkan model ini

class GoogleDriveController extends Controller
{
    // Menampilkan form untuk mengunggah file ke Google Drive
    public function showUploadForm()
    {
        return view('tambah_barang');
    }

    // Memulai autentikasi Google
    public function authenticate(Request $request)
    {
        $client = $this->getClient();

        // Jika token autentikasi belum ada, arahkan ke halaman login Google
        if (!session('upload_token')) {
            $authUrl = $client->createAuthUrl();
            return redirect($authUrl);
        }

        // Proses autentikasi dengan 'code' dari Google
        if ($request->has('code')) {
            try {
                // Mendapatkan token dari Google
                $token = $client->fetchAccessTokenWithAuthCode($request->input('code'));

                // Debugging: Cek token yang diterima
                dd($token); // Ini menampilkan token yang diterima

                // Validasi token format
                if (!isset($token['access_token'])) {
                    throw new InvalidArgumentException("Invalid token format");
                }

                // Menyimpan token ke dalam database
                GoogleDriveToken::create([
                    'access_token' => $token['ya29.a0AeDClZC7dd_5e2qGjWa_Cr-7k3Cg0lMVxpe6W7Eqsc-i-5fe-ic3b4m5P4KZMxoPiADBbJtOO932oCEnguW5Cr4yZ3lkna3Il6sOoZQnWzoc0rc0NirUL0YsCYojM9WScMbZslNM3-3J-4Uo3_u_6RPrAngUuhwEr0hvRvMeaCgYKAZ0SARMSFQHGX2MiRoXO-1quVyMDWsJDS4KS-w0175'],  // Simpan token akses
                    'refresh_token' => $token['1//0gJFsQfHCuzOlCgYIARAAGBASNwF-L9Ir--H7QJTTsnnSNLld6YLuqCF_sApRTLiqKwHFdAFIRtzuTE74X2q4ieKcctG1T8ZHPm4'], // Simpan refresh token
                    'expires_in' => $token['3599'],       // Simpan waktu kedaluwarsa token
                    'token_type' => $token['Bearer'],       // Simpan jenis token
                ]);
                
                // Coba query manual untuk memastikan koneksi database berfungsi
            $tokens = DB::table('google_drive_tokens')->get();
            dd($tokens); // Ini akan menampilkan semua data di tabel google_drive_tokens

            // Simpan token ke session untuk penggunaan lebih lanjut
            session(['upload_token' => $token]);

                return redirect()->route('google-drive.upload'); // Redirect ke halaman upload
            } catch (\Exception $e) {
                return redirect()->route('google-drive.authenticate')->withErrors('Gagal mendapatkan token: ' . $e->getMessage());
            }
        }

        return view('tambah_barang');
    }

    // Callback dari Google OAuth
    public function handleCallback(Request $request)
    {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('app/credentials/oauth-credentials.json')); // Pastikan path sesuai
        $client->setRedirectUri(route('google-drive.callback'));
        $client->addScope(Google_Service_Drive::DRIVE_FILE);

        // Jika kode otentikasi ada, ambil token dan simpan ke session
        if ($request->has('code')) {
            try {
                $token = $client->fetchAccessTokenWithAuthCode($request->input('code'));

                // Debugging: Cek isi token
                dd($token); // Ini akan menampilkan token yang diterima

                // Validasi token format
                if (!isset($token['access_token'])) {
                    throw new InvalidArgumentException("Invalid token format");
                }

                // Simpan token ke session jika valid
                session(['upload_token' => $token]);

                return redirect()->route('google-drive.upload'); // Redirect ke halaman upload
            } catch (\Exception $e) {
                return redirect()->route('google-drive.authenticate')->withErrors('Gagal mendapatkan token: ' . $e->getMessage());
            }
        }

        return redirect()->route('google-drive.authenticate')->withErrors('Gagal mendapatkan kode autentikasi.');
    }

    // Menampilkan daftar file di Google Drive
    public function listFiles()
    {
        $client = $this->getClient();
        $drive = new Google_Service_Drive($client);

        try {
            $files = $drive->files->listFiles([
                'fields' => 'files(id, name)',
            ]);
            return view('google-drive.files', ['files' => $files->getFiles()]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Gagal mengambil daftar file: ' . $e->getMessage());
        }
    }

    // Mengupload file ke Google Drive
    public function upload(Request $request)
    {
        // Validasi file yang diupload
        $request->validate([
            'fileToUpload' => 'required|file|max:10240', // Maksimal 10MB
        ]);

        $client = $this->getClient();
        $service = new Google_Service_Drive($client);

        try {
            // Metadata file
            $fileMetadata = new \Google_Service_Drive_DriveFile([
                'name' => $request->file('fileToUpload')->getClientOriginalName(),
                'parents' => [config('services.google.drive_folder')], // Menggunakan ID folder dari .env
            ]);

            // Upload file ke Google Drive
            $file = $service->files->create($fileMetadata, [
                'data' => file_get_contents($request->file('fileToUpload')->path()),
                'mimeType' => $request->file('fileToUpload')->getMimeType(),
                'uploadType' => 'multipart',
            ]);

            // Redirect ke halaman lain setelah berhasil upload
            return redirect()->route('barang_masuk.create')->with('success', "File '{$file->getName()}' berhasil diupload ke Google Drive.");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Gagal upload file: ' . $e->getMessage());
        }
    }

    // Menambahkan fungsi untuk redirect ke Google login
    public function redirectToGoogle()
    {
        $client = $this->getGoogleClient();
        $authUrl = $client->createAuthUrl();
        return redirect()->away($authUrl); // Arahkan pengguna ke halaman login Google
    }

    // Konfigurasi Google Client
    private function getClient()
    {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('app/credentials/oauth-credentials.json')); // Pastikan path sesuai
        $client->addScope(Google_Service_Drive::DRIVE_FILE);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        // Ambil token terbaru dari database
        $token = GoogleDriveToken::latest()->first(); 

        if ($token) {
            // Jika ada token yang ditemukan, gunakan token tersebut
            $client->setAccessToken($token->access_token);

            // Refresh token jika token sudah kedaluwarsa
            if ($client->isAccessTokenExpired() && $token->refresh_token) {
                $newToken = $client->fetchAccessTokenWithRefreshToken($token->refresh_token);
                session(['upload_token' => $newToken]);
            }
        }

        return $client;
    }

    // Menambahkan fungsi Google Client jika diperlukan
    private function getGoogleClient()
    {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('app/credentials/oauth-credentials.json')); // Pastikan path sesuai
        $client->setRedirectUri(route('google-drive.callback'));
        $client->addScope(Google_Service_Drive::DRIVE_FILE);
        $client->setAccessType('offline');
        return $client;
    }
}
