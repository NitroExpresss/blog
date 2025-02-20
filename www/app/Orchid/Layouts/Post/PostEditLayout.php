<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Post;

use App\Models\Category;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Upload;

class PostEditLayout extends Rows
{
    public function fields(): array
    {
        return [
            Input::make('post.title')
                ->title('Заголовок')
                ->placeholder('Введите заголовок')
                ->required(),

            TextArea::make('post.description')
                ->title('Описание')
                ->placeholder('Введите описание')
                ->required(),

            Select::make('post.category_id')
                ->title('Категория')
                ->options(Category::all()->pluck('name', 'id')->toArray())
                ->required()
                ->empty('Выберите категорию'),

            // Upload::make('post.image')
            //     ->title('Загрузите изображения')
            //     ->placeholder('Перетащите файлы сюда или нажмите для загрузки')
            //     ->acceptedFiles('image/*')
            //     ->maxFiles(3)
            //     ->multiple()
        ];
    }
}
