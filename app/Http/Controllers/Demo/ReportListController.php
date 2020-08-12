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
use App\Model\Bank;
use App\Model\Group;
use Response;

class ReportListController extends Controller
{
    // kiểm tra trạng thái đã đăng nhập hay chưa?
    // nếu người dùng đã đăng nhập thì mới hiển thị chức năng gửi báo cáo
    // nếu người dùng chưa đăng nhập, điều hướng tới trang đăng nhập
    public function __construct() {
        // $this->middleware('auth');
    }

    // hiển thị màn hình danh sách báo cáo
    public function displayReportListScreen() {
        // lấy danh sách báo cáo
        $reports = Report::all();

        // hiển thị màn hình
        return view('admin.report_list', compact('reports'));
    }

    public function displayReportDetailScreen($report_id) {
        // lấy thông tin cơ bản
        $report = Report::where('id', $report_id)->first();

        // lấy file có chữ ký
        $sign_file = AttachFile::where([['report_id', $report_id],['type', 'sign_file']])->first();

        // lấy các file đính kèm
        $attach_files = AttachFile::where([['report_id', $report_id],['type', 'attach_file']])->get();

        // lấy danh sách Ngân hàng nhận
        $bank_lists = [];

        $receivers = Receiver::where('report_id', $report_id)->get();
        foreach ($receivers as $receiver) {
            $bank = Bank::where('id', $receiver->receiver_id)->first();
            $bank_list['bank_name'] = $bank->name;
            $bank_list['group_name'] = Group::where('id', $bank->group_id)->first()->name;
            $bank_list['status'] = $receiver->status;
            $bank_list['send_day'] = $receiver->created_at;

            $bank_lists[] = $bank_list;
        }

        // hiển thị ra màn hình
        return view('admin.report_detail', compact('report', 'sign_file', 'attach_files', 'bank_lists'));
    }

    public function downloadAttachFile($file_id) {
        // Tìm file cần tải
        $file = AttachFile::where('id', $file_id)->first();

        // nếu là file PDF có chữ ký, hiển thị preview
        if ($file->type == 'sign_file') {
            return Storage::download($file->path, $file->name,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline'
            ]);
        } elseif ($file->type == 'attach_file') {
            // nếu là file đính kèm, hiển thị download
            return Storage::download($file->path, $file->name);
        }
    }
}
