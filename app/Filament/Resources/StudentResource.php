<?php

namespace App\Filament\Resources;

use App\Events\PromoteStudent;
use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\GlobalSearch\Actions\Action;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->minLength('3')
                    ->maxLength('255'),
                Forms\Components\TextInput::make('student_id')
                    ->required()
                    ->minLength('10'),
                Forms\Components\TextInput::make('address_1'),
                Forms\Components\TextInput::make('address_2'),
                Forms\Components\Select::make('standard_id')
                    ->required()
                    ->relationship('standard', 'name')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('standard.name')->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('All standard')
                    ->relationship('standard', 'name')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('Promote')
                        ->action(function (Student $record) {
                            $record->standard_id = $record->standard_id + 1;
                            $record->save();
                        })
                        ->color('success')
                        ->requiresConfirmation(),
                    Tables\Actions\Action::make('Demote')
                        ->action(function (Student $record) {
                            if ($record->standard_id > 1) {
                                $record->standard_id = $record->standard_id - 1;
                                $record->save();
                            }
                        })
                        ->color('danger')
                        ->requiresConfirmation(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make('Promote all')
                    ->action(function (Collection $records) {
                        $records->each(function ($record) {
                            event(new PromoteStudent($record));
                        });
                    })
                    ->requiresConfirmation()
                    ->deselectRecordsAfterCompletion()
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\GuardiansRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Name' => $record->name,
            'Standard' => $record->standard->name,
        ];
    }

    public static function getGlobalSearchResultActions(Model $record): array
    {
        return [
            Action::make('Edit')
                ->iconButton()
                ->icon('heroicon-s-pencil')
                ->url(static::getUrl('edit', ['record' => $record]))
        ];
    }
}
