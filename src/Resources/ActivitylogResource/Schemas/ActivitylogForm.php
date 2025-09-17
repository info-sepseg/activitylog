<?php

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Entigra\Activitylog\ActivitylogPlugin;
use Spatie\Activitylog\Models\Activity;

class ActivitylogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('causer')
                            ->state(function (?Model $record): string {
                                /** @var Activity $record */
                                return $record?->causer?->name ?? '-';
                            })
                            ->label(__('activitylog::forms.fields.causer.label')),

                        TextEntry::make('subject_type')
                            ->state(function (?Model $record): string {
                                /** @var Activity $record */
                                $state = $record?->subject_type;
                                return $state ? Str::of($state)->afterLast('\\')->headline() . ' # ' . $record->subject_id : '-';
                            })
                            ->label(__('activitylog::forms.fields.subject_type.label')),

                        TextEntry::make('description')
                            ->state(function (?Model $record): string {
                                /** @var Activity $record */
                                return $record?->description ?? '-';
                            })
                            ->label(__('activitylog::forms.fields.description.label'))
                            ->columnSpan('full'),
                    ]),

                Section::make()
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('log_name')
                            ->state(function (?Model $record): string {
                                /** @var Activity $record */
                                return $record?->log_name ? ucwords($record->log_name) : '-';
                            })
                            ->label(__('activitylog::forms.fields.log_name.label')),

                        TextEntry::make('event')
                            ->state(function (?Model $record): string {
                                /** @var Activity $record */
                                return $record?->event ? ucwords(__('activitylog::action.event.' . $record->event)) : '-';
                            })
                            ->label(__('activitylog::forms.fields.event.label')),

                        TextEntry::make('created_at')
                            ->state(function (?Model $record): string {
                                /** @var Activity $record */
                                if (! $record?->created_at) {
                                    return '-';
                                }

                                $parser = ActivitylogPlugin::get()->getDateParser();

                                return $parser($record->created_at)
                                    ->format(ActivitylogPlugin::get()->getDatetimeFormat());
                            })
                            ->label(__('activitylog::forms.fields.created_at.label')),
                    ]),
            ]);
    }
}
