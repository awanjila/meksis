<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('categories', function (Blueprint $table) {
        // Check if column exists before adding
        if (!Schema::hasColumn('categories', 'parent_id')) {
            $table->bigInteger('parent_id')->unsigned()->nullable();
        }
        if (!Schema::hasColumn('categories', 'lft')) {
            $table->integer('lft');
        }
        if (!Schema::hasColumn('categories', 'rgt')) {
            $table->integer('rgt');
        }
        if (!Schema::hasColumn('categories', 'depth')) {
            $table->integer('depth')->nullable();
        }
    });
}

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['parent_id', 'lft', 'rgt', 'depth']);
        });
    }
};
