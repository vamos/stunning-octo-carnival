<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(NabidkaTableSeeder::class);
        $this->call(ProvoznaTableSeeder::class);
        $this->call(PolozkaTableSeeder::class);
        $this->call(NabidkaPolozkaTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ObjednavkaTableSeeder::class);
        $this->call(ObjednavkaPolozkaTableSeeder::class);

    }
}
