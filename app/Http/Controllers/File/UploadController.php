<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Model\File;

class UploadController extends Controller
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
            echo "NO FILE";
        }
        // $this->uploadedFile = $request->file;
        // dd($this->uploadedFile);
    }

    /**
     * Get upload file and save.
     *
     * @param
     * @return
     */
    public function getFile() {
        // lấy đuôi file để xác định kiểu file
        $this->checkExtension();
        // lưu file đã upload vào storage
        $this->store();
        // $this->create();
        // return redirect()->back();
    }

    /**
     * Check file extension to classify and store.
     *
     * @param
     * @return
     */
    private function checkExtension() {
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
        // tải file lên
        // lấy về
        // đưa vào thư mục tương ứng
        // lưu file tải lên vào Storage
        // trả về 1 đường dẫn (path) dẫn đến file vừa được tải lên
        // khi tải xuống, chỉ lấy đường dẫn (path) ra rồi tải về
        //store to storage/app and get path
        // $this->filePath = Storage::putFile($this->folderName, $this->uploadedFile);

        //store to Google Drive
        $this->uploadedFile->storeAs('/', $this->uploadedFile->getClientOriginalName());
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
