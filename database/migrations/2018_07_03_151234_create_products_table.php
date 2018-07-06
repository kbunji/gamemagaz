<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('price');
            $table->string('photo')->default('no-image.png');
            $table->text('description');
            $table->integer('category_id')->unsigned();
            $table->timestamps();
        });

        $faker = Faker\Factory::create();
        DB::table('products')->insert(
            array(
                array(
                    'name' => 'The Witcher 3: Wild Hunt',
                    'price' => $faker->numberBetween(400, 1000),
                    'photo' => 'game-1.jpg',
                    'description' => $faker->text,
                    'category_id' => 2,
                    'created_at' => \Carbon\Carbon::now('Asia/Almaty')->toDateTimeString(),
                ),
                array(
                    'name' => 'Overwatch',
                    'price' => $faker->numberBetween(400, 1000),
                    'photo' => 'game-2.jpg',
                    'description' => $faker->text,
                    'category_id' => 1,
                    'created_at' => \Carbon\Carbon::now('Asia/Almaty')->toDateTimeString(),
                ),
                array(
                    'name' => 'World of WarCraft',
                    'price' => $faker->numberBetween(400, 1000),
                    'photo' => 'game-4.jpg',
                    'description' => $faker->text,
                    'category_id' => 3,
                    'created_at' => \Carbon\Carbon::now('Asia/Almaty')->toDateTimeString(),
                )
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
        Schema::dropIfExists('products');
    }
}
