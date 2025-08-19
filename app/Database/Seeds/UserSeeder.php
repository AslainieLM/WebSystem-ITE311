<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Users data
        $users = [
            [
                'username'    => 'aslainie_lm',
                'email'       => 'aslainie@gmail.com',
                'password'    => password_hash('aslainie', PASSWORD_DEFAULT),
                'first_name'  => 'Aslainie',
                'last_name'   => 'Maruhom',
                'role'        => 'admin',
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'username'    => 'amarah_tador',
                'email'       => 'amarah@gmail.com',
                'password'    => password_hash('amarah', PASSWORD_DEFAULT),
                'first_name'  => 'Amarah',
                'last_name'   => 'Tador',
                'role'        => 'instructor',
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'username'    => 'anisah_lampac',
                'email'       => 'anisah@gmail.com',
                'password'    => password_hash('anisah', PASSWORD_DEFAULT),
                'first_name'  => 'Anisah',
                'last_name'   => 'Lampac',
                'role'        => 'student',
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($users);
    }
}