<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Priority extends Enum
{
    const LOW = 1;
    const NORMAL = 2;
    const HIGH = 3;
    const URGENT = 4;
}
