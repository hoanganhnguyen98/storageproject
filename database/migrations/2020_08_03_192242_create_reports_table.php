<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // bảng lưu các thông tin cơ bản khi gửi một báo cáo
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('sender_id'); // người gửi là ai?
            $table->string('report_number'); // số báo cáo
            $table->string('title'); // tiêu đề báo cáo
            $table->timestamp('sign_date'); // ngày ký
            $table->string('type'); // loại báo cáo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
