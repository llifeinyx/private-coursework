<?php

namespace App\Items\Models\Enums;

use App\Traits\Models\Enums\EBasicsTrait;

enum Status: string
{
    use EBasicsTrait;

    case OUT_OF_STOCK = 'out-of-stock';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';
    case DRAFT = 'draft';
}
