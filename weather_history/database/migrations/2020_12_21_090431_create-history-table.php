<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTable extends Migration
{
    private const TABLE = 'history';
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->id();
            $table->float('temp');
            $table->date('date_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::TABLE);
    }
}
