<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        \DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            [
                'full_name' => 'Jhonar M. Ignacio',
                'email' => 'jmi050994@gmail.com'
            ],
        ];

        foreach ($data as $value) {
           if(!User::where('email', $value['email'])->first()) {
                $user = User::factory()->create($value);
           }
       }
    }
}
