<?php

use Illuminate\Database\Seeder;

class PolozkaTableSeeder extends Seeder
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

        DB::table('polozka')->insert([

            'id' => 1,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Dezert',
            'typ' => 'Bezlaktózové',
            'popis' => 'Brownie',
            'obrazok' => 'brownie.jpg',
            'cena' => 3,
            'objem' => 0,
            'hmotnost' => 100,
            'alkohol' => 0
        ]);
        DB::table('polozka')->insert([

            'id' => 2,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Předkrm',
            'typ' => 'Vegánske',
            'popis' => 'Chléb s avokadem',
            'cena' => 6.50,
            'obrazok' => 'chleba_avokado.jpg',
            'objem' => 0,
            'hmotnost' => 400,
            'alkohol' => 0
        ]);
        DB::table('polozka')->insert([

            'id' => 3,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Hlavní jídlo',
            'typ' => 'Bezlepkové',
            'popis' => 'Losos s avokadem',
            'obrazok' => 'losos_avokado.jpg',
            'cena' => 20,

            'objem' => 0,
            'hmotnost' => 350,
            'alkohol' => 0
        ]);
        DB::table('polozka')->insert([

            'id' => 4,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Hlavní jídlo',
            'typ' => 'Ostatní',
            'popis' => 'Masové kuličky',
            'obrazok' => 'masove_kulicky.jpg',
            'cena' => 15,

            'objem' => 0,
            'hmotnost' => 400,
            'alkohol' => 0
        ]);
        DB::table('polozka')->insert([

            'id' => 5,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Předkrm',
            'typ' => 'Ostatní',
            'popis' => 'Obložený croissant',
            'obrazok' => 'oblozeny_croissant.jpg',
            'cena' => 7,

            'objem' => 0,
            'hmotnost' => 250,
            'alkohol' => 0
        ]);
        DB::table('polozka')->insert([

            'id' => 6,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Dezert',
            'typ' => 'Vegetariánske',
            'popis' => 'Palačinky',
            'obrazok' => 'palacinky.jpg',
            'cena' => 7,

            'objem' => 0,
            'hmotnost' => 300,
            'alkohol' => 0
        ]);
        DB::table('polozka')->insert([

            'id' => 7,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Hlavní jídlo',
            'typ' => 'Ostatní',
            'popis' => 'Hovězí s rýží',
            'obrazok' => 'hovezi_a_ryze.jpg',
            'cena' => 8,

            'objem' => 0,
            'hmotnost' => 500,
            'alkohol' => 0
        ]);
        DB::table('polozka')->insert([

            'id' => 8,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Dezert',
            'typ' => 'Vegetariánske',
            'popis' => 'Východní strudl',
            'obrazok' => 'strudl.jpg',
            'cena' => 10,

            'objem' => 0,
            'hmotnost' => 200,
            'alkohol' => 0
        ]);
        DB::table('polozka')->insert([

            'id' => 9,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Hlavní jídlo',
            'typ' => 'Vegetariánské',
            'popis' => 'Zeleninový salát',
            'obrazok' => 'zeleninovy_salat.jpg',
            'cena' => 15,

            'objem' => 0,
            'hmotnost' => 350,
            'alkohol' => 0
        ]);
        DB::table('polozka')->insert([

            'id' => 10,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Dezert',
            'typ' => 'Vegetariánske',
            'popis' => 'Jogurt s ovocem',
            'obrazok' => 'jogurt_ovoce.jpg',
            'cena' => 9,

            'objem' => 0,
            'hmotnost' => 200,
            'alkohol' => 0
        ]);
        DB::table('polozka')->insert([

            'id' => 11,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Nealkoholický nápoj',
            'typ' => 'Ostatní',
            'popis' => 'Jahodová šťáva',
            'obrazok' => 'jahodova_stava.jpg',
            'cena' => 10,

            'objem' => 0.5,
            'hmotnost' => 0,
            'alkohol' => 0
        ]);
        DB::table('polozka')->insert([

            'id' => 12,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Nealkoholický nápoj',
            'typ' => 'Ostatní',
            'popis' => 'Voda',
            'obrazok' => 'voda.jpg',
            'cena' => 2,

            'objem' => 0.75,
            'hmotnost' => 0,
            'alkohol' => 0
        ]);
        DB::table('polozka')->insert([

            'id' => 13,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Teplý nápoj',
            'typ' => 'Ostatní',
            'popis' => 'Kakao',
            'obrazok' => 'kakao.jpg',
            'cena' => 4.20,

            'objem' => 0.3,
            'hmotnost' => 0,
            'alkohol' => 0
        ]);
        DB::table('polozka')->insert([

            'id' => 14,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Alkoholický nápoj',
            'typ' => 'Ostatní',
            'popis' => 'Pivo',
            'obrazok' => 'pivo.jpg',
            'cena' => 9,

            'objem' => 0.5,
            'hmotnost' => 0,
            'alkohol' => 12
        ]);
        DB::table('polozka')->insert([

            'id' => 15,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Teplý nápoj',
            'typ' => 'Ostatní',
            'popis' => 'Káva',
            'cena' => 5,

            'obrazok' => 'kava.jpg',
            // 'denny_trvaly' => 'Trvalý',
            'objem' => 0.2,
            'hmotnost' => 0,
            'alkohol' => 0
        ]);
        DB::table('polozka')->insert([

            'id' => 16,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Nealkoholický nápoj',
            'typ' => 'Ostatní',
            'popis' => 'Rajčatová šťáva',
            'obrazok' => 'rajcatova_stava.jpg',
            'cena' => 7,

            'objem' => 0.75,
            'hmotnost' => 0,
            'alkohol' => 0
        ]);
        DB::table('polozka')->insert([

            'id' => 17,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Alkoholický nápoj',
            'typ' => 'Ostatní',
            'popis' => 'Whiskey',
            'obrazok' => 'whisky.jpg',
            'cena' => 24,

            'objem' => 0.05,
            'hmotnost' => 0,
            'alkohol' => 42
        ]);
        DB::table('polozka')->insert([

            'id' => 18,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Hlavní jídlo',
            'typ' => 'Ostatní',
            'popis' => 'Chobotnička',
            'obrazok' => 'chobotnicka.jpg',
            'cena' => 42,

            'objem' => 0,
            'hmotnost' => 92,
            'alkohol' => 0
        ]);
        DB::table('polozka')->insert([

            'id' => 20,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Hlavní jídlo',
            'typ' => 'Ostatní',
            'popis' => 'Smažený řízek',
            'obrazok' => 'smazeny_rizek.jpg',
            'cena' => 20,

            'objem' => 0,
            'hmotnost' => 350,
            'alkohol' => 0
        ]);
        DB::table('polozka')->insert([

            'id' => 21,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Hlavní jídlo',
            'typ' => 'Ostatní',
            'popis' => 'Sushi',
            'obrazok' => 'sushi.jpg',
            'cena' => 30,

            'objem' => 0,
            'hmotnost' => 300,
            'alkohol' => 0
        ]);
        DB::table('polozka')->insert([

            'id' => 22,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Předkrm',
            'typ' => 'Ostatní',
            'popis' => 'Vaječná omeleta',
            'obrazok' => 'vajecna_omeleta.jpg',
            'cena' => 25,

            'objem' => 0,
            'hmotnost' => 350,
            'alkohol' => 0
        ]);
        DB::table('polozka')->insert([

            'id' => 23,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Polévka',
            'typ' => 'Ostatní',
            'popis' => 'Hovězí vývar',
            'obrazok' => 'vyvar.jpg',
            'cena' => 25,

            'objem' => 350,
            'hmotnost' => 0,
            'alkohol' => 0
        ]);
        DB::table('polozka')->insert([

            'id' => 24,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Polévka',
            'typ' => 'Ostatní',
            'popis' => 'Asijská polévka',
            'obrazok' => 'asijska_polevka.jpg',
            'cena' => 25,

            'objem' => 350,
            'hmotnost' => 0,
            'alkohol' => 0
        ]);
        DB::table('polozka')->insert([

            'id' => 25,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'kategoria' => 'Polévka',
            'typ' => 'Ostatní',
            'popis' => 'Rybí polévka',
            'obrazok' => 'rybi_polevka.jpg',
            'cena' => 25,

            'objem' => 350,
            'hmotnost' => 0,
            'alkohol' => 0
        ]);
    }
}
