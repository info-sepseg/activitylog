<?php

namespace Entigra\\Activitylog\Resources\ActivitylogResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Entigra\\Activitylog\Resources\ActivitylogResource;

class ListActivitylog extends ListRecords
{
    protected static string $resource = ActivitylogResource::class;
}
