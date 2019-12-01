<?php

use Illuminate\Database\Seeder;

class NabidkaPolozkaTableSeeder extends Seeder
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

        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 1,
                'nabidka_id' => 1,
                'polozka_id' => 5,
                'typ' => 'Trvalý',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 2,
                'nabidka_id' => 1,
                'polozka_id' => 1,
                'typ' => 'Denni',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 3,
                'nabidka_id' => 1,
                'polozka_id' => 4,
                'typ' => 'Trvalý',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 4,
                'nabidka_id' => 1,
                'polozka_id' => 7,
                'typ' => 'Trvalý',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 5,
                'nabidka_id' => 1,
                'polozka_id' => 9,
                'typ' => 'Trvalý',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 6,
                'nabidka_id' => 1,
                'polozka_id' => 12,
                'typ' => 'Trvalý',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 7,
                'nabidka_id' => 1,
                'polozka_id' => 15,
                'typ' => 'Trvalý',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 8,
                'nabidka_id' => 1,
                'polozka_id' => 11,
                'typ' => 'Denni',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 9,
                'nabidka_id' => 2,
                'polozka_id' => 8,
                'typ' => 'Denni',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 10,
                'nabidka_id' => 2,
                'polozka_id' => 18,
                'typ' => 'Trvalý',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 11,
                'nabidka_id' => 2,
                'polozka_id' => 21,
                'typ' => 'Trvalý',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 12,
                'nabidka_id' => 2,
                'polozka_id' => 12,
                'typ' => 'Trvalý',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 13,
                'nabidka_id' => 2,
                'polozka_id' => 16,
                'typ' => 'Denni',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 14,
                'nabidka_id' => 2,
                'polozka_id' => 17,
                'typ' => 'Trvalý',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 15,
                'nabidka_id' => 3,
                'polozka_id' => 20,
                'typ' => 'Trvalý',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 16,
                'nabidka_id' => 3,
                'polozka_id' => 22,
                'typ' => 'Trvalý',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 17,
                'nabidka_id' => 3,
                'polozka_id' => 3,
                'typ' => 'Denni',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 18,
                'nabidka_id' => 3,
                'polozka_id' => 6,
                'typ' => 'Denni',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 19,
                'nabidka_id' => 3,
                'polozka_id' => 10,
                'typ' => 'Denni',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 20,
                'nabidka_id' => 3,
                'polozka_id' => 12,
                'typ' => 'Trvalý',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 21,
                'nabidka_id' => 3,
                'polozka_id' => 14,
                'typ' => 'Trvalý',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 22,
                'nabidka_id' => 3,
                'polozka_id' => 15,
                'typ' => 'Trvalý',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka_polozka')->insert([
                'alternative_id' => 23,
                'nabidka_id' => 3,
                'polozka_id' => 17,
                'typ' => 'Denni',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
    }
}
