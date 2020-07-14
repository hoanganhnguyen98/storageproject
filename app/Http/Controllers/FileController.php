<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Model\File;

class FileController extends Controller
{
    /**
     * File is uploaded from browser.
     *
     * @var string
     */
    private $uploadedFile;

    /**
     * Folder name which stores uploaded files.
     *
     * @var string
     */
    private $folderName;

    /**
     * Path of file after file is stored.
     *
     * @var string
     */
    private $filePath;

    /**
     * Create a new controller instance.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function __construct(Request $request) {
        if ($request->hasFile('file')) {
            $this->uploadedFile = $request->file;
        } else {
            echo 1;
        }
    }

    /**
     * Get upload file and save.
     *
     * @param
     * @return
     */
    public function getFile() {
        $this->checkExtension();
        $this->store();
        $this->create();

        return redirect()->back();
    }

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


    /**
     * Check file extension to classify and store.
     *
     * @param
     * @return
     */
    private function checkExtension() {
        dd($this->uploadedFile);
        $extensionFile = $this->uploadedFile->getClientOriginalExtension();
        if ($extensionFile == 'docx') {
            $this->folderName = 'words';
        } elseif ($extensionFile == 'xlsx') {
            $this->folderName = 'excels';
        } else {
            $this->folderName = 'others';
        }
    }

    /**
     * Store file to storage/app.
     *
     * @param
     * @return
     */
    private function store() {
        $this->filePath = Storage::putFile($this->folderName, $this->uploadedFile);
    }

    /**
     * Save file information to database.
     *
     * @param
     * @return
     */
    private function create() {
        $file = File::create([
            'name' => $this->uploadedFile->getClientOriginalName(),
            'path' => $this->filePath,
            'sender_id' => 1,
            'getter_id' => 2,
        ]);
    }
}
