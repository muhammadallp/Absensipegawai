<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\location;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'nik'=>'18101152610510',
            'nama'=>'admin',
            'alamat'=>'padang',
            'jk'=>'laki-laki',
            'nohp'=>'082283327577',
            'jabatan_id'=>'1',
            'password'=>bcrypt('123456'),
            'level' =>'admin',
            'photo' =>'default.jpg'

        ]);

        location::create([
            'latitude'=>'-2.4439017573242605',
            'longitude'=>'101.23278194080547',
        ]);
    }
}
