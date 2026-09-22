<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('status_new')->default('Pending')->after('status');
        });

        DB::table('tasks')->update(['status_new' => DB::raw('status')]);

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->renameColumn('status_new', 'status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('status_old')->default('Pending')->after('status');
        });

        DB::table('tasks')->where('status', 'In Progress')->update(['status' => 'Pending']);
        DB::table('tasks')->update(['status_old' => DB::raw('status')]);

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->renameColumn('status_old', 'status');
        });
    }
};
