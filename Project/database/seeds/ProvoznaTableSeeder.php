<?php

use Illuminate\Database\Seeder;

class ProvoznaTableSeeder extends Seeder
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

        DB::table('provozna')->insert([

            'id' => 1,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'nabidka_id' => 1,
            'oznaceni' => 'Starý Pivovar',
            'obrazok' => 'menza-stary-pivovar.jpg',
            'adresa' => 'Božetechová 2, Brno',
            'od' => 11,
            'do' => 00,
            'uzaverka' => 23,
            'max_den_poloz' => 6
        ]);
        DB::table('provozna')->insert([

            'id' => 2,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'nabidka_id' => 2,
            'oznaceni' => 'New Vietnam',
            'obrazok' => 'vietnam.jpg',
            'adresa' => 'Reissigova 24, Brno',
            'od' => 8,
            'do' => 18,
            'uzaverka' => 16,
            'max_den_poloz' => 4
        ]);
        DB::table('provozna')->insert([

            'id' => 3,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'nabidka_id' => 3,
            'oznaceni' => 'U třech opic',
            'obrazok' => 'tri_opice.jpg',
            'adresa' => 'Semilasso 17, Brno',
            'od' => 10,
            'do' => 17,
            'uzaverka' => 16,
            'max_den_poloz' => 5
        ]);



    }
}
