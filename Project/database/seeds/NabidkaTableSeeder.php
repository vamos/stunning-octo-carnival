<?php

use Illuminate\Database\Seeder;

class NabidkaTableSeeder extends Seeder
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

        DB::table('nabidka')->insert([
                'id' => 1,
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka')->insert([
                'id' => 2,
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('nabidka')->insert([
                'id' => 3,
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
    }
}
