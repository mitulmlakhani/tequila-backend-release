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
        Schema::table('users', function (Blueprint $table) {
            // Drop the existing unique constraint
            $table->dropUnique('users_passcode_unique');

            // Create a composite unique index (restaurant_id, passcode), allowing reuse if soft deleted
            $table->unique(['restaurant_id', 'passcode'], 'users_restaurant_passcode_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the new composite unique index
            $table->dropUnique('users_restaurant_passcode_unique');

            // Re-add the old unique constraint on passcode
            $table->unique('passcode', 'users_passcode_unique');
        });
    }
};
