<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PaymentHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tequilaUserPermissions = Permission::insert([
            [
                'name' => 'restaurant.payments',
                'display_name' => 'Reservations',
                'group_name' => 'Manage Reservations',
                'guard_name' => 'web',
                'permission_type' => 2
            ]
        ]);
    }
}
