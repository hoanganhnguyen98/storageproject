<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AttachFile;
use App\Model\ReplyFile;
use App\Model\Receiver;

class HomeController extends Controller
{
    // hiển thị màn hình trang chủ
    public function displayHomeScreen() {
        // tìm kiếm các báo cáo mới được gửi tới
        // ---------------------------
        // khi người dùng đăng nhập, câu lệnh tìm kiếm các báo cáo mới viết như dưới đây
        // // tìm id của người đang đăng nhập
        // $receiver_id = Auth::user()->id;
        // // tìm các báo cáo mới được gửi cho người này, với id và trạng thái
        // $new_reports = Receiver::where([['receiver_id', $receiver_id], ['status', 'new']])->get();
        // ---------------------------


        // demo ----------------------
        $new_reports = Receiver::where('status', 'new')->get();
        // ----------------------------

        // đếm số lượng báo cáo mới
        $total_new_reports = count($new_reports);

        // hiển thị màn hình
        return view('home', compact('total_new_reports'));
    }
}
