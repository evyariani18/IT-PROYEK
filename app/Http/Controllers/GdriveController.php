<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class GdriveController extends Controller
{
    public function upload(Request $request)
    {
        // Validasi file yang diunggah
        $request->validate([
            'file' => 'required|file',
        ]);

        // Ambil file yang diunggah
        $file = $request->file('file');

        // Tentukan path file di Google Drive
        $path = 'path/to/file/' . $file->getClientOriginalName();

        // Unggah file ke Google Drive
        $content = file_get_contents($file->getRealPath());
        Storage::disk('google')->put($path, $content);

        return response()->json(['message' => 'File uploaded successfully!']);
    }
}
