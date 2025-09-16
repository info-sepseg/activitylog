<?php

namespace Entigra\Activitylog\RelationManagers;

use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Entigra\Activitylog\ActivitylogPlugin;
use Entigra\Activitylog\Resources\ActivitylogResource;

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

    public function schema(Form $form): Form
    {
        return ActivitylogResource::schema($form);
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
