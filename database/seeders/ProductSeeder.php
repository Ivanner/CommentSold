<?php

namespace Database\Seeders;

use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('products')->truncate();
        $csvFile = fopen(base_path("database/seeders/data/products.csv"), "r");

        $firstLine = true; // skip first line that contains headers
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstLine) {
                // sanitize "NULL" word
                $data = array_map(function ($v) {
                    return $v == "NULL" ? null : $v;
                }, $data);
                try {
                    DB::table('products')->insert([
                        "id" => $data[0],
                        "product_name" => $data[1],
                        "description" => $data[2],
                        "style" => $data[3],
                        "brand" => $data[4],
                        "created_at" => $data[5],
                        "updated_at" => $data[6],
                        "url" => $data[7],
                        "product_type" => $data[8],
                        "shipping_price" => $data[9],
                        "note" => $data[10],
                        "admin_id" => $data[11]
                    ]);
                } catch (QueryException $ex) {
                    // ignore failed imports
                    Log::error($ex->getMessage());
                }
            }
            $firstLine = false;
        }

        fclose($csvFile);
        Schema::enableForeignKeyConstraints();
    }
}
