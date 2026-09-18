<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Check if columns exist before adding
            if (!Schema::hasColumn('notifications', 'user_id')) {
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('notifications', 'type')) {
                $table->string('type')->default('general');
            }
            if (!Schema::hasColumn('notifications', 'title')) {
                $table->string('title');
            }
            if (!Schema::hasColumn('notifications', 'message')) {
                $table->text('message');
            }
            if (!Schema::hasColumn('notifications', 'icon')) {
                $table->string('icon')->nullable();
            }
            if (!Schema::hasColumn('notifications', 'link')) {
                $table->string('link')->nullable();
            }
            if (!Schema::hasColumn('notifications', 'is_read')) {
                $table->boolean('is_read')->default(false);
            }
            if (!Schema::hasColumn('notifications', 'read_at')) {
                $table->timestamp('read_at')->nullable();
            }
            
            // Add indexes
            $table->index(['user_id', 'is_read', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $columns = ['user_id', 'type', 'title', 'message', 'icon', 'link', 'is_read', 'read_at'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('notifications', $column)) {
                    if ($column === 'user_id') {
                        $table->dropForeign(['user_id']);
                    }
                    $table->dropColumn($column);
                }
            }
        });
    }
};