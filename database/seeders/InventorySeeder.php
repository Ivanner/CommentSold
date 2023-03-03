<?php

namespace Database\Seeders;

use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('inventories')->truncate();
        $csvFile = fopen(base_path("database/seeders/data/inventory.csv"), "r");

        $firstLine = true; // skip first line that contains headers
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstLine) {
                // sanitize "NULL" word
                $data = array_map(function ($v) {
                    return $v == "NULL" ? null : $v;
                }, $data);
                try {
                    DB::table('inventories')->insert([
                        "id" => $data[0],
                        "product_id" => $data[1],
                        "quantity" => $data[2],
                        "color" => $data[3],
                        "size" => $data[4],
                        "weight" => $data[5],
                        "price_cents" => $data[6],
                        "sale_price_cents" => $data[7],
                        "cost_cents" => $data[8],
                        "sku" => $data[9],
                        "length" => $data[10],
                        "width" => $data[11],
                        "height" => $data[12],
                        "note" => $data[13]
                    ]);
                } catch (QueryException $ex) {
                    // ignore insert fails due to failed constraint
                    Log::error($ex->getMessage());
                }
            }
            $firstLine = false;
        }

        fclose($csvFile);
        Schema::enableForeignKeyConstraints();
    }
}
