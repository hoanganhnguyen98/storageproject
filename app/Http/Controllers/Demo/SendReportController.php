<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Model\User;
use App\Model\AttachFile;
use App\Model\Receiver;
use App\Model\ReplyFile;
use App\Model\Report;
use App\Notifications\SendMailAfterSendReport;

class SendReportController extends Controller
{
    // kiểm tra trạng thái đã đăng nhập hay chưa?
    // nếu người dùng đã đăng nhập thì mới hiển thị chức năng gửi báo cáo
    // nếu người dùng chưa đăng nhập, điều hướng tới trang đăng nhập
    public function __construct() {
        // $this->middleware('auth');
    }

    // hiển thị màn hình của chức năng gửi báo cáo
    public function displaySendReportScreen() {
        // lấy danh sách người dùng để hiển thị và chọn khi gửi báo cáo
        $users = User::all();

        // hiển thị màn hình
        // compact: đưa biến $users ra ngoài view
        // -> đưa danh sách người dùng ra để chọn khi gửi báo cáo
        return view('admin.send_report', compact('users'));
    }

    // lấy các thông tin của báo cáo được gửi
    public function sendReport(Request $request) {
        // dd($request->all());

        // kiểm tra nếu có các file đính kèm
        if ($request->hasFile('sign_file') && $request->hasFile('attach_file')) {
            // lưu thông tin báo cáo
            $new_report = Report::create([
                // 'sender_id' => Auth::user()->id, // lấy id của người đăng nhập
                // giả sử id là 1
                'sender_id' => 1,
                'report_number' => $request->report_number,
                'title' => $request->title,
                'sign_date' => $request->sign_date,
                'type' => $request->type,
            ]);

            // lưu từng người được gửi báo cáo
            for ($i=0; $i < count($request->receiver_id); $i++) {
                $new_receiver = Receiver::create([
                    'receiver_id' => $request->receiver_id[$i],
                    'report_id' => $new_report->id,
                ]);
            }

            // lưu file có chữ ký
            $sign_file = AttachFile::create([
                'report_id' => $new_report->id,
                'path' => $this->storeReport('attach', $request->sign_file)
            ]);

            // lưu từng file đính kèm
            for ($i=0; $i < count($request->attach_file); $i++) { 
                $new_attach_file = AttachFile::create([
                    'report_id' => $new_report->id,
                    'path' => $this->storeReport('attach', $request->attach_file[$i])
                ]);
            }

            // gửi mail cho người nhận
            for ($i=0; $i < count($request->receiver_id); $i++) {
                // tìm người nhận theo id
                $user = User::where('id', $request->receiver_id[$i])->first();
                // gửi mail kèm thông tin về báo cáo
                $user->notify(new SendMailAfterSendReport($new_report));
            }

            // quay lại và thông báo thành công
            return redirect()->back()->with('success', 'Send report successfully!');
        } else {
            // nếu không có file nào, báo lỗi
            return redirect()->back()->with('error', 'No file in report!');
        }
    }

    // lưu báo cáo
    public function storeReport($folderName, $uploadedFile) {
        // $folderName: tên thư mục muốn lưu file vào
        // $uploadedFile: file vừa upload lên, cần lưu lại
        // --------------------------------------------------
        // lưu file vào thư mục tương ứng ở storage/app
        // trả lại đường dẫn file để lưu vào cơ sở dữ liệu
        return Storage::putFile($folderName, $uploadedFile);
    }
}
