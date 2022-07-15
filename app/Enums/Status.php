<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Status extends Enum
{
    const OPEN = 1;
    const SPRINT_BACKLOG = 2;
    const IN_PROGRESS = 3;
    const REVIEW = 4;
    const TEST = 5;
    const CODING_DONE = 6;
    const CLOSED = 7;
}
