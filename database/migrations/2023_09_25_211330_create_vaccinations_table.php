<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccinations', function (Blueprint $table) {
            $table->id();
            $table->string('vaccine'); // ワクチン名　カラム
            $table->string('date');  // 接種日　カラム
            $table->string('product');  // 製品名　カラム
            $table->string('lot');  // ロット番号　カラム
            $table->string('clinic');  // クリニック　カラム
            $table->string('doctor');  // 医師　カラム
            $table->string('image_path')->nullable();  // 画像のパスを保存するカラム
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
        Schema::dropIfExists('vaccinations');
    }
};
