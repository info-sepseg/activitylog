<?php

namespace Entigra\Activitylog\Resources\ActivitylogResource\Pages;

use Filament\Resources\Pages\ViewRecord;
use Entigra\Activitylog\Resources\ActivitylogResource;

class ViewActivitylog extends ViewRecord
{
    public static function getResource(): string
    {
        return ActivitylogResource::class;
    }
}
