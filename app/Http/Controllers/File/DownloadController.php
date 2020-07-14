<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\File;

class DownloadController extends Controller
{
    /**
     * Download file.
     *
     * @param $id id of file in database
     * @return
     */
    public function downloadFile($id) {
        $file = File::where('id', $id)->first();
        $name = $file->name;
        $path = $file->path;

        return Storage::download($path, $name);
    }

    /**
     * Display screen to download file.
     *
     * @param
     * @return
     */
    public function showDownloadFile() {
        $files = File::all();
        return view('download', compact('files'));
    }
}
