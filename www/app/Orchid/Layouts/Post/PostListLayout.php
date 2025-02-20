<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Post;

use App\Models\Post;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PostListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'posts';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('title', 'Заголовок'),

            TD::make('slug', 'slug'),

            TD::make('description', 'Описание')
                ->render(fn(Post $post) => Str::limit($post->description, 50)),

            TD::make('category_id', 'Категория')
                ->render(fn(Post $post) => $post->category->name),

            TD::make('Действия')
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn(Post $post) => DropDown::make()
                    ->icon('bs.three-dots')
                    ->list([
                        Link::make('Редактировать')
                            ->route('platform.posts.edit', $post->id)
                            ->icon('bs.pencil'),

                        Button::make('Удалить')
                            ->icon('bs.trash3')
                            ->confirm('Вы уверены?')
                            ->method('remove', [
                                'id' => $post->id,
                            ]),
                    ])),
        ];
    }
}
