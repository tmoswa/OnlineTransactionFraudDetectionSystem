<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
Use App\AccountType;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $acc_typ=[
            'Silver',
            'Gold',
            'Platinum',
        ];
        foreach ($acc_typ as $acc) {

            AccountType::create(['name' => $acc]);

       }

          $users=User::create([
               'name'=>'Diversion Machingura',
               'email'=>'myproject22tim@gmail.com',
               'email_verified_at'=>'2022-06-20 00:00:00',
               'password'=> bcrypt('#pass123'),
               'remember_token'=>'jVhuxKnPjp7v6mCefkjas9SVgtyiuqGSGg0tAN1oPyFRoOOAuOtaNW5QPaBC'
           ]);



        $role = Role::create(['name' => 'Admin']);
        $roleb = Role::create(['name' => 'Client']);

        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $users->assignRole([$role->id]);
    }
}
















