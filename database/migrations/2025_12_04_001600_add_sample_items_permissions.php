<?php

use App\Enums\UserRole;

return new class extends \App\DB\BasePermissionMigration {
    public function permissions(): array
    {
        return [
            // auto apply to all guards
            //  'permission_name',                  // only assigned to SUPER-ADMIN
            //  'permission_name' => ['user_role'], // assigned to SUPER-ADMIN and user_role
            'sample.items.index' => [UserRole::USER],
            'sample.items.show' => [UserRole::USER],
            'sample.items.create' => [UserRole::USER],
            'sample.items.update' => [UserRole::USER],
            'sample.items.delete' => [UserRole::USER],
        ];
    }
};
