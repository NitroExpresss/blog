<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Post;

use App\Models\Category;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class PostEditLayout extends Rows
{
    /**
     * Элементы разметки экрана.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('post.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Заголовок'))
                ->placeholder(__('Введите заголовок поста')),

            Input::make('post.description')
                ->type('textarea')
                ->required()
                ->title(__('Описание'))
                ->placeholder(__('Введите описание поста')),

            Select::make('post.category_id')
                ->title(__('Категория'))
                ->options(Category::all()->pluck('name', 'id')->toArray())
                ->required()
                ->placeholder(__('Выберите категорию')),

            Input::make('post.image')
                ->type('text') // TODO: добавить загрузку изображения
                ->title(__('Изображение'))
                ->placeholder(__('Введите URL изображения')),
        ];
    }
}
