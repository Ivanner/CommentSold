<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        $csvFile = fopen(base_path("database/seeders/data/users.csv"), "r");

        $firstLine = true; // skip first line that contains headers
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstLine) {
                // sanitize "NULL" word
                $data = array_map(function ($v) {
                    return $v == "NULL" ? null : $v;
                }, $data);
                DB::table('users')->insert([
                    "id" => $data[0],
                    "name" => $data[1],
                    "email" => $data[2],
                    "password" => Hash::make($data[4]),
                    "super_admin" => $data[5],
                    "shop_name" => $data[6],
                    "remember_token" => $data[7],
                    "created_at" => $data[8],
                    "updated_at" => $data[9],
                    "card_brand" => $data[10],
                    "card_last_four" => $data[11],
                    "trial_ends_at" => $data[12],
                    "shop_domain" => $data[13],
                    "is_enabled" => $data[14],
                    "billing_plan" => $data[15],
                    "trial_starts_at" => $data[16],
                ]);
            }
            $firstLine = false;
        }

        fclose($csvFile);
        Schema::enableForeignKeyConstraints();
    }
}
