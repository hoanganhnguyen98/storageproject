<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::post('/get-file', 'File\UploadController@getFile')->name('get-file');
// Route::get('/download', 'File\DownloadController@showDownloadFile');
// Route::get('download/{id}', 'File\DownloadController@downloadFile');

// màn hình trang chủ
Route::get('/', 'Demo\HomeController@displayHomeScreen');

// chức năng gửi báo cáo
Route::get('/send-report', 'Demo\SendReportController@displaySendReportScreen');

// danh sách báo cáo
Route::get('/report-list', 'Demo\ReportListController@displayReportListScreen');

// báo cáo chi tiết
Route::get('/report-detail-{report_id}', 'Demo\ReportListController@displayReportDetailScreen');

Route::post('/send-report', 'Demo\SendReportController@sendReport')->name('send-report');
