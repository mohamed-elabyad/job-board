<?php

namespace App\Enums;

use App\Traits\EnumFeatures;

enum OfferedJobsExperienceEnum: string
{
    use EnumFeatures;

    case ENTRY = 'entry';
    case INTERMEDIATE = 'intermediate';
    case SENIOR = 'senior';
}
