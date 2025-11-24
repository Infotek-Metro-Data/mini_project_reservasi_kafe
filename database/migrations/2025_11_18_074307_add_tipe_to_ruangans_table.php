<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ruangans', function (Blueprint $table) {
            $table->enum('tipe', ['interior', 'rooftop', 'meeting_room'])->after('nama');
        });
    }

    public function down()
    {
        Schema::table('ruangans', function (Blueprint $table) {
            $table->dropColumn('tipe');
        });
    }
};