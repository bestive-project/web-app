<?php

namespace Database\Seeders;

use Database\Seeders\Traits\DisableForeignKey;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    use DisableForeignKey, TruncateTable;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ["Admin", "Konselor", "Guru", "Siswa"];

        $this->disableForeignKeys();
        $this->truncate('roles');
        $this->truncate('permissions');

        foreach ($roles as $role) {
            $role = Role::create([
                'name' => $role,
            ]);
        }
    }
}
