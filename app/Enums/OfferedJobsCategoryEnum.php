<?php

namespace App\Enums;

use App\Traits\EnumFeatures;

enum OfferedJobsCategoryEnum: string
{
    use EnumFeatures;

    case IT = 'it';
    case FINANCE = 'Finance';
    case SALES = 'sales';
    case MARKETING = 'marketing';
    case MEDIA = 'madia';
}
