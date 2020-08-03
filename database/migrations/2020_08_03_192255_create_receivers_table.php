<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // bảng lưu thông tin người nhận báo cáo
        Schema::create('receivers', function (Blueprint $table) {
            $table->id();
            $table->string('receiver_id'); // cho biết người nhận là ai?
            $table->string('report_id'); // cho biết báo cáo được gửi cho người này?
            // trạng thái báo cáo:
            // lúc mới gửi, mặc định giá trị là "new",
            // khi người nhận reply lại, trạng thái chuyển sang "replied"
            $table->string('status')->default('new');
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
        Schema::dropIfExists('receivers');
    }
}
