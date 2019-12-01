<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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


        DB::table('users')->insert([
            'id' => 1,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'name' => "Bolek Polívka",
            'email' => 'iis@example.com',
            'password' => bcrypt('iisadmin'),
            'city' => "Brno",
            'street' => "Božetechová 2",
            'phone' => "080808080",
            'role' => "admin",
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'pracoviste_id' => '1',
            'name' => "Jan Burák",
            'email' => 'jan@example.com',
            'password' => bcrypt('iisvodic'),
            'city' => "Brno",
            'street' => "Lesná 602",
            'phone' => "420159357",
            'role' => "vodič",
        ]);


        DB::table('users')->insert([
            'id' => 3,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'pracoviste_id' => '1',
            'name' => "Jana Operátorka",
            'email' => 'jana@example.com',
            'password' => bcrypt('iisoperator'),
            'city' => "Brno",
            'street' => "Božetechová 2",
            'phone' => "080808080",
            'role' => "operátor",
        ]);


        DB::table('users')->insert([
            'id' => 4,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'name' => "Anna Pažravá",
            'email' => 'anna@example.com',
            'password' => bcrypt('iisuzivatel'),
            'city' => "Brno",
            'street' => "Božetechová 2",
            'phone' => "080808080",
            'role' => "užívatel",
        ]);

        DB::table('users')->insert([
            'id' => 5,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'name' => "Václav Dort",
            'email' => 'vaclav@example.com',
            'password' => bcrypt('iisuzivatel'),
            'city' => "Kuřim",
            'street' => "Tlustá2",
            'phone' => "456785439",
            'role' => "užívatel",
        ]);
        DB::table('users')->insert([
            'id' => 6,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'name' => "Kevin Bacon",
            'email' => 'kevin@example.com',
            'password' => bcrypt('iisuzivatel'),
            'city' => "LA",
            'street' => "Holywood bl. 42",
            'phone' => "777424242",
            'role' => "užívatel",
        ]);
        DB::table('users')->insert([
            'id' => 7,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'name' => "Lukas Rosol",
            'email' => 'lukas@example.com',
            'password' => bcrypt('iisuzivatel'),
            'city' => "Kuřim",
            'street' => "Tlustá 2",
            'phone' => "456785439",
            'role' => "užívatel",
        ]);
        DB::table('users')->insert([
            'id' => 8,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'name' => "Nataša Olivová",
            'email' => 'natasa@example.com',
            'password' => bcrypt('iisuzivatel'),
            'city' => "Moscow",
            'street' => "Prostornaya Street 222",
            'phone' => "777424248",
            'role' => "užívatel",
        ]);
        DB::table('users')->insert([
            'id' => 9,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'name' => "Čestmír Vomastek",
            'email' => 'cestmir@example.com',
            'password' => bcrypt('iisuzivatel'),
            'city' => "Brno",
            'street' => "Koláčkova 78",
            'phone' => "420554789",
            'role' => "užívatel",
        ]);
        DB::table('users')->insert([
            'id' => 10,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'name' => "Petr Buřt",
            'email' => 'petr@example.com',
            'password' => bcrypt('iisuzivatel'),
            'city' => "Brno",
            'street' => "Polívkova 78",
            'phone' => "420578946",
            'role' => "užívatel",
        ]);
        DB::table('users')->insert([
            'id' => 11,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'name' => "Ema Smetana",
            'email' => 'ema@example.com',
            'password' => bcrypt('iisuzivatel'),
            'city' => "Praha",
            'street' => "K Hradu 1337",
            'phone' => "420579875",
            'role' => "užívatel",
        ]);
        DB::table('users')->insert([
            'id' => 12,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'name' => "Marek Svačina",
            'email' => 'marek@example.com',
            'password' => bcrypt('iisuzivatel'),
            'city' => "Olomouc",
            'street' => "Na kopci 3301",
            'phone' => "420667125",
            'role' => "užívatel",
        ]);
        DB::table('users')->insert([
            'id' => 13,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'pracoviste_id' => '2',
            'name' => "Zuzana Tvarůžková",
            'email' => 'zuzana@example.com',
            'password' => bcrypt('iisoperator'),
            'city' => "Praha 2",
            'street' => "Televizní 1",
            'phone' => "420789456",
            'role' => "operátor",
        ]);
        DB::table('users')->insert([
            'id' => 14,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'pracoviste_id' => '2',
            'name' => "Dana Sojová",
            'email' => 'dana@example.com',
            'password' => bcrypt('iisvodic'),
            'city' => "Brno",
            'street' => "Mendlovo nám. 88",
            'phone' => "420325428",
            'role' => "vodič",
        ]);
        DB::table('users')->insert([
            'id' => 15,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'pracoviste_id' => '3',
            'name' => "Aleš Kaše",
            'email' => 'Aleš@example.com',
            'password' => bcrypt('iisoperator'),
            'city' => "Brno",
            'street' => "Úzká 44",
            'phone' => "420789321",
            'role' => "operátor",
        ]);
        DB::table('users')->insert([
            'id' => 16,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'pracoviste_id' => '3',
            'name' => "Pavel Máslo",
            'email' => 'pavel@example.com',
            'password' => bcrypt('iisvodic'),
            'city' => "Brno",
            'street' => "Pelicova 42",
            'phone' => "420325425",
            'role' => "vodič",
        ]);
        DB::table('users')->insert([
            'id' => 17,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s'),
            'pracoviste_id' => '1',
            'name' => "Marek Párek",
            'email' => 'marek2@example.com',
            'password' => bcrypt('iisvodic'),
            'city' => "Brno",
            'street' => "Žďárská 21",
            'phone' => "420654425",
            'role' => "vodič",
        ]);
    }
}
