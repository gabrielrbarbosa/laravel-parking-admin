<?php

namespace App\Filament\Resources;

use App\Enums\EnumUtility;
use App\Enums\VehicleType;
use App\Enums\SizeType;
use App\Enums\FuelType;
use App\Enums\TransmissionType;
use App\Filament\Resources\VehicleResource\Pages;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('license_plate')
                    ->required()
                    ->maxLength(10),
                'vehicle_type' => Forms\Components\Select::make('vehicle_type')
                    ->options(VehicleType::class)
                    ->required()
                    ->getOptionLabelFromRecordUsing(fn (Vehicle $record) => "{$record->first_name} {$record->last_name}"),
                'size_type' => Forms\Components\Select::make('size_type')
                    ->options(SizeType::class),
                'fuel_type' => Forms\Components\Select::make('fuel_type')
                    ->options(FuelType::class),
                'transmission_type' => Forms\Components\Select::make('transmission_type')
                    ->options(TransmissionType::class),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255),
                Forms\Components\Select::make('brand_id')
                    ->relationship('brand', 'name'),
                Forms\Components\TextInput::make('model')
                    ->maxLength(255),
                Forms\Components\TextInput::make('year')
                    ->maxLength(4),
                Forms\Components\TextInput::make('color')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('license_plate')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('brand.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('model')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
