<?php

use Illuminate\Database\Seeder;

class ObjednavkaTableSeeder extends Seeder
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

        DB::table('objednavka')->insert([
                'id' => 1,
                'provozna_id' => 1,
                'uzivatel_id' => 8,
                'operator_id' => 3,
                'meno' => 'Nataša Olivová',
                'vodic_id' => 2,
                'ulica' => "Prostornaya street 222",
                'mesto' => "Moscow",
                'tel' => "777424248",
                'email' => "natasa@example.com",
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
        DB::table('objednavka')->insert([
                'id' => 2,
                'provozna_id' => 1,
                'uzivatel_id' => 12,
                'operator_id' => 3,
                'meno' => 'Marek Svačina',
                'vodic_id' => 2,
                'ulica' => "Na kopci 3301",
                'mesto' => "Olomouc",
                'tel' => "420667125",
                'email' => "marek@example.com",
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);
    }

}
