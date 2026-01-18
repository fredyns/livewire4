<?php

namespace App\Enums;

/**
 * Enum for User roles.
 */
enum UserRole: string
{
    use EnumTrait;

    case SUPER_ADMIN = 'superadmin';
    case USER = 'user';
}
