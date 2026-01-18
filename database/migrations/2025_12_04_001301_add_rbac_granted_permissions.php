<?php

use App\Enums\UserRole;

return new class extends \App\DB\BasePermissionMigration {
    protected array $guards = ['sanctum'];

    public function permissions(): array
    {
        return [
            // auto apply to all guards
            //  'permission_name',                  // only assigned to SUPER-ADMIN
            //  'permission_name' => ['user_role'], // assigned to SUPER-ADMIN and user_role
            'rbac.granted' => [UserRole::USER],
        ];
    }
};
