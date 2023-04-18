<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RoleSeeder::class);

        $userAdmin = User::factory()->create([
            'email' => 'admin@mailinator.com'
        ]);
        $userAdmin->assignRole(Role::where('id', User::ADMIN)->first());

        $userKonselor = User::factory()->create([
            'email' => 'konselor@mailinator.com'
        ]);
        $userKonselor->assignRole(Role::where('id', User::KONSELOR)->first());

        $userGuru = User::factory()->create([
            'email' => 'guru@mailinator.com'
        ]);
        $userGuru->assignRole(Role::where('id', User::GURU)->first());

        $userSiswa = User::factory()->create([
            'email' => 'siswa@mailinator.com'
        ]);
        $userSiswa->student()->create([
            "birth_place" => "Indramayu",
            "date_birth" => Carbon::now(),
            "class" => "IPA 1",
            "school" => "SMA Andalas 1",
            "phone" => "1289182989",
        ]);
        $userSiswa->assignRole(Role::where('id', User::SISWA)->first());
    }
}
