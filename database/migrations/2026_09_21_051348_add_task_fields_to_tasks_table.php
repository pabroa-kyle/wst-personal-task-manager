<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            if (! Schema::hasColumn('tasks', 'task_name')) {
                $table->string('task_name')->default('')->after('id');
            }

            if (! Schema::hasColumn('tasks', 'description')) {
                $table->text('description')->nullable()->after('task_name');
            }

            if (! Schema::hasColumn('tasks', 'status')) {
                $table->enum('status', ['Pending', 'Completed'])->default('Pending')->after('description');
            }

            if (! Schema::hasColumn('tasks', 'due_date')) {
                $table->date('due_date')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn(['task_name', 'description', 'status', 'due_date']);
        });
    }
};
