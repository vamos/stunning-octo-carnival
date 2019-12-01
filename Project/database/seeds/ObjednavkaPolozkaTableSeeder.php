<?php

use Illuminate\Database\Seeder;

class ObjednavkaPolozkaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $time = new DateTime('now');

        DB::table('objednavka_polozka')->insert([
                'id' => 12,
                'objednavka_id' => 1,
                'polozka_id' => 1,
                'pocet' => 3,
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('objednavka_polozka')->insert([
                'id' => 11,
                'objednavka_id' => 2,
                'polozka_id' => 1,
                'pocet' => 3,
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
       // DB::table('objednavka_polozka')->insert([
       //         'id' => 13,
       //         'objednavka_id' => 3,
       //         'polozka_id' => 1,
       //         'pocet' => 3,
       //         'created_at' => $time->format('Y-m-d H:i:s'),
       //         'updated_at' => $time->format('Y-m-d H:i:s'),
       // ]);
       // DB::table('objednavka_polozka')->insert([
       //         'id' => 9,
       //         'objednavka_id' => 4,
       //         'polozka_id' => 1,
       //         'pocet' => 3,
       //         'created_at' => $time->format('Y-m-d H:i:s'),
       //         'updated_at' => $time->format('Y-m-d H:i:s'),
       // ]);
       // DB::table('objednavka_polozka')->insert([
       //         'id' => 12,
       //         'objednavka_id' => 5,
       //         'polozka_id' => 1,
       //         'pocet' => 3,
       //         'created_at' => $time->format('Y-m-d H:i:s'),
       //         'updated_at' => $time->format('Y-m-d H:i:s'),
       // ]);
       // DB::table('objednavka_polozka')->insert([
       //         'id' => 8,
       //         'objednavka_id' => 6,
       //         'polozka_id' => 1,
       //         'pocet' => 3,
       //         'created_at' => $time->format('Y-m-d H:i:s'),
       //         'updated_at' => $time->format('Y-m-d H:i:s'),
       // ]);
       // DB::table('objednavka_polozka')->insert([
       //         'id' => 12,
       //         'objednavka_id' => 7,
       //         'polozka_id' => 1,
       //         'pocet' => 3,
       //         'created_at' => $time->format('Y-m-d H:i:s'),
       //         'updated_at' => $time->format('Y-m-d H:i:s'),
       // ]);
       // DB::table('objednavka_polozka')->insert([
       //         'id' => 12,
       //         'objednavka_id' => 8,
       //         'polozka_id' => 1,
       //         'pocet' => 3,
       //         'created_at' => $time->format('Y-m-d H:i:s'),
       //         'updated_at' => $time->format('Y-m-d H:i:s'),
       // ]);
       // DB::table('objednavka_polozka')->insert([
       //         'id' => 9,
       //         'objednavka_id' => 9,
       //         'polozka_id' => 1,
       //         'pocet' => 3,
       //         'created_at' => $time->format('Y-m-d H:i:s'),
       //         'updated_at' => $time->format('Y-m-d H:i:s'),
       // ]);
       // DB::table('objednavka_polozka')->insert([
       //         'id' => 9,
       //         'objednavka_id' => 10,
       //         'polozka_id' => 1,
       //         'pocet' => 3,
       //         'created_at' => $time->format('Y-m-d H:i:s'),
       //         'updated_at' => $time->format('Y-m-d H:i:s'),
       // ]);
       // DB::table('objednavka_polozka')->insert([
       //         'id' => 6,
       //         'objednavka_id' => 11,
       //         'polozka_id' => 1,
       //         'pocet' => 3,
       //         'created_at' => $time->format('Y-m-d H:i:s'),
       //         'updated_at' => $time->format('Y-m-d H:i:s'),
       // ]);
    }
}
