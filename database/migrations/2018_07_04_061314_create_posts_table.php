<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string('photo');
            $table->timestamps();
        });

        DB::table('posts')->insert(
            array(
                'title' => 'Режим VR',
                'description' => 'Игры в виртуальной реальности пока что особой популярностью не пользуются. 
                Дороговизна VR-оборудования и малое количество достойных ААА-проектов – главные тому причины. 
                Однако разработчики не сдаются и продолжают (хоть и редко) баловать нас качественными VR-играми.
                 Хочется верить в то, что ситуация скоро изменится, автономные VR-гарнитуры станут полноценной заменой
                  игровому ПК, и VR-игры «выстрелят» по полной.',
                'photo' => 'ps_vr.jpg',
                'created_at' => \Carbon\Carbon::now('Asia/Almaty')->toDateTimeString()
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
