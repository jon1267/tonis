<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromocodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocodes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100);
            $table->integer('percent');
            $table->string('phone', 100);
            $table->string('hash', 10);
            $table->text('answers');
            $table->integer('test_id');

            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('point_id')->nullable()->constrained('points')->onDelete('set null');

            $table->dateTime('activated_at')->nullable();
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
        Schema::dropIfExists('promocodes');
    }
}
