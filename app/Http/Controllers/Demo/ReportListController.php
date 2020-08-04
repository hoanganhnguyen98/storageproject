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

        // dd($reports);

        // hiển thị màn hình
        return view('admin.report_list', compact('reports'));
    }

    public function displayReportDetailScreen($report_id) {

    }
}
