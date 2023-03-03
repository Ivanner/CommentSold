<?php

namespace Database\Seeders;

use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('orders')->truncate();
        $csvFile = fopen(base_path("database/seeders/data/orders.csv"), "r");

        $firstLine = true; // skip first line that contains headers
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstLine) {
                // sanitize "NULL" word
                $data = array_map(function ($v) {
                    return $v == "NULL" ? null : $v;
                }, $data);
                try {
                    DB::table('orders')->insert([
                        "id" => $data[0],
                        "product_id" => $data[1],
                        "inventory_id" => $data[2],
                        "street_address" => $data[3],
                        "apartment" => $data[4],
                        "city" => $data[5],
                        "state" => $data[6],
                        "country_code" => $data[7],
                        "zip" => $data[8],
                        "phone_number" => $data[9],
                        "email" => $data[10],
                        "name" => $data[11],
                        "order_status" => $data[12],
                        "payment_ref" => $data[13],
                        "transaction_id" => $data[14],
                        "payment_amt_cents" => intval($data[15]),
                        "ship_charged_cents" => intval($data[16]),
                        "ship_cost_cents" => intval($data[17]),
                        "subtotal_cents" => intval($data[18]),
                        "total_cents" => intval($data[19]),
                        "shipper_name" => $data[20],
                        "payment_date" => $data[21],
                        "shipped_date" => $data[22],
                        "tracking_number" => $data[23],
                        "tax_total_cents" => intval($data[24]),
                        "created_at" => $data[25],
                        "updated_at" => $data[26],
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
