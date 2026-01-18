<?php

namespace App\Enums\Sample;

use App\Enums\EnumTrait;

enum SampleItemEnumerate: string
{
    use EnumTrait;

    case Enabled = 'enabled';
    case Disabled = 'disabled';
}
