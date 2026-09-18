<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rewards', function (Blueprint $table) {
            // Check if columns exist before adding
            if (!Schema::hasColumn('rewards', 'user_id')) {
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('rewards', 'points')) {
                $table->integer('points')->default(0);
            }
            if (!Schema::hasColumn('rewards', 'membership_level')) {
                $table->enum('membership_level', ['bronze', 'silver', 'gold', 'platinum'])->default('bronze');
            }
            if (!Schema::hasColumn('rewards', 'lifetime_spent')) {
                $table->decimal('lifetime_spent', 12, 2)->default(0);
            }
            if (!Schema::hasColumn('rewards', 'reviews_count')) {
                $table->integer('reviews_count')->default(0);
            }
            if (!Schema::hasColumn('rewards', 'orders_count')) {
                $table->integer('orders_count')->default(0);
            }
            
            // Add unique constraint for user_id
            $table->unique('user_id');
            
            // Add indexes
            $table->index(['membership_level', 'points']);
        });
    }

    public function down(): void
    {
        Schema::table('rewards', function (Blueprint $table) {
            $columns = ['user_id', 'points', 'membership_level', 'lifetime_spent', 'reviews_count', 'orders_count'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('rewards', $column)) {
                    if ($column === 'user_id') {
                        $table->dropForeign(['user_id']);
                    }
                    $table->dropColumn($column);
                }
            }
        });
    }
};