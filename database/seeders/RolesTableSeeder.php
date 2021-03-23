<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::create(['name' => 'superadmin']);
        Role::create(['name' => 'moderator']);


        $superAdmin = Role::where('name','superadmin')->first();
        
        $admin = Admin::where('email','3120217020@ued.udn.vn')->first();

        $admin->role()->attach($superAdmin);
    }
}
