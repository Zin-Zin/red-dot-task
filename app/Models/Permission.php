<?php

namespace App\Models;

class Permission extends \Spatie\Permission\Models\Permission
{
    public static function defaultPermissions()
    {
        return [
            'viewUser',
            'addUser',
            'editUser',
            'deleteUser',
            'viewRole',
            'addRole',
            'editRole',
            'deleteRole',
            'viewPermission',
            'addPermission',
            'editPermission',
            'deletePermission',
        ];
    }
}
