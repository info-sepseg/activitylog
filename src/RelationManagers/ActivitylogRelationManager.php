<?php

namespace Entigra\Activitylog\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Entigra\Activitylog\ActivitylogPlugin;
use Entigra\Activitylog\Resources\ActivitylogResource\ActivitylogResource;
use Filament\Actions\ViewAction;
use Filament\Schemas\Schema;

class ActivitylogRelationManager extends RelationManager
{
    protected static string $relationship = 'activities';

    protected static ?string $recordTitleAttribute = 'description';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return static::$title ?? (string) str(ActivitylogPlugin::get()->getPluralLabel())
            ->kebab()
            ->replace('-', ' ')
            ->headline();
    }

    public function schema(Schema $schema): Schema
    {
        return ActivitylogResource::schema($schema);
    }

    public function table(Table $table): Table
    {
        return ActivitylogResource::table(
            $table
                ->heading(ActivitylogPlugin::get()->getPluralLabel())
                ->recordActions([
                    ViewAction::make(),
                ])
        );
    }
}
