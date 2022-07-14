<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\ExistingAccount;

class Permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = [

            'user-list',

            'user-create',

            'user-edit',

            'user-delete',

            'role-list',

            'role-create',

            'role-edit',

            'role-delete',

            'client-list',

            'client-create',

            'client-edit',

            'client-delete',

            'audit_trail-list',

         ];


         foreach ($permissions as $permission) {

              Permission::create(['name' => $permission]);

         }
        $exis_create=ExistingAccount::create(['acc_number'=>'5162610431645257','national_id'=>'29277135X07','phone_number'=>'0777791898','email'=>'tevinttogo@gmail.com']);
        $exis_create=ExistingAccount::create(['acc_number'=>'5160610481635357','national_id'=>'29277135X08','phone_number'=>'0714382713','email'=>'tevinttogo@gmail.com']);
        $exis_create=ExistingAccount::create(['acc_number'=>'5163619485634997','national_id'=>'29277135X09','phone_number'=>'0775146476','email'=>'tevinttogo@gmail.com']);
    }
}






