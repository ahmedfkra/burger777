<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BalancesResource\Pages;
use App\Filament\Resources\BalancesResource\RelationManagers;
use App\Models\Balances;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TimePicker;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\SelectColumn;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Blade;




class BalancesResource extends Resource
{
    protected static ?string $model = Balances::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make("Info")
                ->schema([
                    // ...
                    Forms\Components\DatePicker::make('work_shift')->placeholder('Enter Work Day')->label('Work Day')->format('d/m/Y'),
                    Forms\Components\Select::make('branch_name')->options([
                        'masief' => 'Al Maseif',
                        'malaqa' => 'Al Maseif',
                        'qurtoba' => 'Qurtoba',
                    ]),
                    Forms\Components\TextInput::make('cashir_name')->label('Cashier Name'),
                    //Forms\Components\TextInput::make(auth()->user()->name)->label('Cashier'),
                    Forms\Components\TimePicker::make('start_date')->placeholder('Enter Start Date')->label('Start Sheft'),
                    Forms\Components\TimePicker::make('end_date')->placeholder('Enter End Date')->label('Close Sheft'),

                ])->columns(2)->collapsed(),

                Section::make("Cash")
                ->schema([
                    // ...
                    Forms\Components\TextInput::make('cash_500')->placeholder('Cash Amount 500'),
                    Forms\Components\TextInput::make('cash_200')->placeholder('Cash Amount 200'),
                    Forms\Components\TextInput::make('cash_100')->placeholder('Cash Amount 100'),
                    Forms\Components\TextInput::make('cash_50')->placeholder('Cash Amount 50'),
                   // Forms\Components\TextInput::make('cash_20')->placeholder('Cash Amount 20'),
                    Forms\Components\TextInput::make('cash_10')->placeholder('Cash Amount 10'),
                    Forms\Components\TextInput::make('cash_1')->placeholder('Cash Amount 1'),

                    ])->columns(2)->collapsed(),

                    Section::make("Netword")
                ->schema([
                    // ...
                    Forms\Components\TextInput::make('net')->placeholder('Enter Amount from Netwrok')->label('Network '),
                    Forms\Components\TextInput::make('other')->placeholder('Other thing')->label('Other Thing'),
                    ])->columns(2)->collapsed(),

                Forms\Components\Textarea::make('notes')->columnSpanFull()->placeholder('Add any note you want'),

            ])->columns(2);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('work_shift')->date()->sortable(),
               // Tables\Columns\TextColumn::make('casher'),
                //TextColumn::make('author.name')
                Tables\Columns\TextColumn::make('branch_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('cashir_name')->sortable(),
                //Tables\Columns\TextColumn::make('start_date')->since(),
                //Tables\Columns\TextColumn::make('total_cash'),
                //Tables\Columns\TextColumn::make('total_network'),
                Tables\Columns\TextColumn::make('total_network')
                            ->money('SAR')
                            ->getStateUsing(function(Model $record) {
                                // return whatever you need to show
                                return $record->net + $record->other;
                            }),

                Tables\Columns\TextColumn::make('total_cash')
                            ->getStateUsing(function(Model $record) {
                                // return whatever you need to show
                                return $record->cash_500 + $record->cash_200 + $record->cash_100 + $record->cash_50 + $record->cash_20 + $record->cash_10+ $record->cash_1  ;
                            }),
                // Tables\Columns\TextColumn::make('total_amount')
                   // ->money('SAR')
                    //->getStateUsing(function(Model $record) {
                     // return whatever you need to show
                 //   return $record->total_network + $record->total_cash;
                  //          }),
                //Tables\Columns\TextColumn::make('notes'),
            ])
            ->filters([
                //
                Filter::make('name')->query(fn (Builder $query): Builder => $query->where('name', true)),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label(''),
                Tables\Actions\EditAction::make()->label(''),
                Tables\Actions\DeleteAction::make()->label(''),

                /*Tables\Actions\Action::make('pdf')
                    ->label('PDF')
                    ->color('success')
                    ->icon('heroicon-o-document-download')
                    ->url(fn (Balances $record) => route('pdf', $record))
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('Download File')
                    //->icon('heroicon-o-document-download')
                    ->url(fn(Balances $record)=>route('balance.pdf.download',$record))
                    ->openUrlInNewTab(),*/
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
            'index' => Pages\ListBalances::route('/'),
            'create' => Pages\CreateBalances::route('/create'),
            'edit' => Pages\EditBalances::route('/{record}/edit'),
        ];
    }
}
