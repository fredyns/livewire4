<?php

use App\Enums\UserRole;

return new class extends \App\DB\BaseAssignUserRoleMigration {
    public function assignments(): array
    {
        return [
            //  'user_email' => ['user_role'],
            'dm@fredyns.id' => [UserRole::USER, UserRole::SUPER_ADMIN],
            'fredy.ns@bki.co.id' => [UserRole::USER, UserRole::SUPER_ADMIN],
            'fredy.ns@gmail.com' => [UserRole::USER],
            'admin@admin.com' => [UserRole::USER, UserRole::SUPER_ADMIN],
            'user@testing.com' => [UserRole::USER],
        ];
    }
};
