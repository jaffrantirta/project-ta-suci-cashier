<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Create item_units table
        if (!Schema::hasTable('item_units')) {
            Schema::create('item_units', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->timestamps();
            });
        }

        // Step 2: Migrate data to item_units and update items table
        if (!Schema::hasColumn('items', 'item_unit_id')) {
            Schema::table('items', function (Blueprint $table) {
                // Add the new column to store the foreign key reference
                $table->unsignedBigInteger('item_unit_id')->nullable();

                // Temporary: keep the existing unit_of_stock column until data migration is complete
            });
        }

        // Migrate data from unit_of_stock to item_units and update the items table
        DB::table('items')->orderBy('unit_of_stock')->chunk(100, function ($items) {
            foreach ($items as $item) {
                // Check if the unit already exists in item_units
                $unit = DB::table('item_units')->where('name', $item->unit_of_stock)->first();

                // If not, insert the new unit
                if (!$unit) {
                    $unitId = DB::table('item_units')->insertGetId([
                        'name' => $item->unit_of_stock,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    $unitId = $unit->id;
                }

                // Update the item with the new item_unit_id
                DB::table('items')
                    ->where('id', $item->id)
                    ->update(['item_unit_id' => $unitId]);
            }
        });

        // Step 3: Drop the old unit_of_stock column and make item_unit_id non-nullable
        Schema::table('items', function (Blueprint $table) {
            // Remove the old column
            $table->dropColumn('unit_of_stock');

            // Ensure item_unit_id is not nullable
            $table->unsignedBigInteger('item_unit_id')->nullable(false)->change();

            // Add foreign key constraint
            $table->foreign('item_unit_id')->references('id')->on('item_units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Re-add the old unit_of_stock column
        Schema::table('items', function (Blueprint $table) {
            $table->string('unit_of_stock')->nullable();

            // Drop the new item_unit_id column and its foreign key constraint
            $table->dropForeign(['item_unit_id']);
            $table->dropColumn('item_unit_id');
        });

        // Drop the item_units table
        Schema::dropIfExists('item_units');
    }
};
