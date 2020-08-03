<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplyFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // bảng lưu trữ các file được đính kèm khi reply một báo cáo
        Schema::create('reply_files', function (Blueprint $table) {
            $table->id();
            $table->string('replier_id'); // người reply là ai?
            $table->string('report_id'); // reply cho báo cáo nào?
            $table->string('path'); // đường dẫn đính kèm file reply
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
        Schema::dropIfExists('reply_files');
    }
}
