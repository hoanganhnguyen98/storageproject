<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // bảng lưu trữ các file được đính kèm khi gửi một báo cáo đi
        Schema::create('attach_files', function (Blueprint $table) {
            $table->id();
            $table->string('report_id'); // cho biết  file được đính kèm trong báo cáo nào?
            $table->string('path'); // đường dẫn lưu trữ file
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
        Schema::dropIfExists('attach_files');
    }
}
