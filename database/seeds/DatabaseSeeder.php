<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ask for confirmation to refresh migration
        if ($this->command->confirm('Do you wish to refresh migration before seeding, Make sure it will clear all old data ?')) {
            $this->command->call('migrate:refresh');
            $this->command->warn("Data deleted, starting from fresh database.");
        }
        // Seed the default permissions
        $permissions = Permission::defaultPermissions();
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        $this->command->info('Default Permissions added.');
        // Ask to confirm to assign admin or users roles
        if ($this->command->confirm('Create Roles for users, default is admin and users?', true)) {
            // Ask for roles from input
            $roles = $this->command->ask('Enter roles in comma separate format.', 'Admin,User');
            // Explode roles
            $rolesArray = explode(',', $roles);
            // add roles
            foreach($rolesArray as $role) {
                $role = Role::firstOrCreate(['name' => trim($role)]);
                if( $role->name == 'Admin' ) {
                    // assign all permissions to admin roles
                    $role->permissions()->sync(Permission::all());
                    $this->command->info('Admin will have full rights');
                } else {
                    // for others, give access to view only
                    $role->permissions()->sync(Permission::where('name', 'LIKE', 'view_%')->get());
                }
                // create one users for each roles
                $this->createUser($role);
            }
            $this->command->info('Roles ' . $roles . ' added successfully');
        } else {
            Role::firstOrCreate(['name' => 'User']);
            $this->command->info('By default, User roles added.');
        }
    }

    /**
     * Create a users with given roles
     *
     * @param $role
     */
    private function createUser($role)
    {
        $user = factory(User::class)->create();
        $user->assignRole($role->name);
        if( $role->name == 'Admin' ) {
            $this->command->info('Admin login details:');
            $this->command->warn('Username : '.$user->email);
            $this->command->warn('Password : "secret"');
        }
    }
}
