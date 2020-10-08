<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Articles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id'); // Foreignkey olarak kullanacağımız için unsigned - olmasın diye
            $table->string('title');
            $table->string('image');
            $table->longText('content');
            $table->integer('hit')->default(0);
            $table->integer('status')->default(0)->comment('0:pasif 1:aktif');
            $table->string('slug');
            $table->timestamps();
            // REFERANS KURMA İŞLEMİ
            $table->foreign('category_id')
            ->references('id')
            ->on('categories'); 
            //->onDelete('') Buraya yazılan değerle bağlı değişken silindiğinde ne olacağını ayarlayabiliyoruz..
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
