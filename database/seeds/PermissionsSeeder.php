<?php

use App\User;
use Illuminate\Database\Seeder;
use \Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $create_inspector=Permission::create(['name'=>'create_inspector']);
        $edit_inspector=Permission::create(['name'=>'edit_inspector']);
        $view_all_inspectors=Permission::create(['name'=>'view_all_inspectors']);
        $delete_inspector=Permission::create(['name'=>'delete_inspector']);
        $view_self_inspectors=Permission::create(['name'=>'view_self_inspector']);
        $assign_inspector_to_licensee=Permission::create(['name'=>'assign_inspector_to_licensee']);

        $create_licensee=Permission::create(['name'=>'create_licensee']);
        $edit_licensee=Permission::create(['name'=>'edit_licensee']);
        $view_licensee=Permission::create(['name'=>'view_licensee']);
        $delete_licensee=Permission::create(['name'=>'delete_licensee']);
        $approve_disapprove_licensee=Permission::create(['name'=>'approve_disapprove_licensee']);


        $view_only_inspector_licensee=Permission::create(['name'=>'view_only_inspector_licensee']);


        $receptionist=Role::create(['name'=>'receptionist']);
        $attributer=Role::create(['name'=>'attributer']);
        $inspector=Role::create(['name'=>'inspector']);
        $admin=Role::create(['name'=>'admin']);

        $admin->syncPermissions(Permission::all());
        $admin->revokePermissionTo($view_only_inspector_licensee);
        $admin->revokePermissionTo($view_self_inspectors);


        $inspector->syncPermissions([$view_only_inspector_licensee,$approve_disapprove_licensee,$view_self_inspectors]);

        $receptionist->syncPermissions([$view_licensee,$edit_licensee,$delete_licensee,$create_licensee]);

        $attributer->syncPermissions([$view_licensee,$assign_inspector_to_licensee]);

        $user=User::find(1);
        $user->assignRole($admin);

        $user=User::create(['name'=>'receptionist','email'=>'receptionist@receptionist.com','password'=>bcrypt('123456')]);
        $user->assignRole($receptionist);

        $user=User::create(['name'=>'attributer','email'=>'attributer@attributer.com','password'=>bcrypt('123456')]);
        $user->assignRole($attributer);
    }
}
