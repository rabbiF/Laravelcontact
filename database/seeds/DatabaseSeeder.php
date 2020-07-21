<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Model\Bien;
use App\Model\Client;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(User::class, 3)->create();
        
        for($i = 0; $i < 20; $i++)
        {            
            $client = factory(Client::class)->create();
            $bien = factory(Bien::class)->create();

            DB::table('bien_client')->insert([
                'bien_id' => $bien->id,
                'client_id' => $client->id,
                'created_at' => Carbon::now()
            ]);
        }
    }
}
