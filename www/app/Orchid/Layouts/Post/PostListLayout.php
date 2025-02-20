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
            TD::make('title', __('Заголовок'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(fn (Post $post) => Link::make($post->title)
                    ->route('platform.posts.edit', $post->id)),

            TD::make('slug', __('Slug'))
                ->sort()
                ->filter(Input::make()),

            TD::make('description', __('Description'))
                ->sort()
                ->filter(Input::make())
                ->render(fn (Post $post) => Str::limit($post->description, 50)), // Ограничение по символам

            TD::make('category_id', __('Категория'))
                ->sort()
                ->render(fn (Post $post) => $post->category->name ?? 'No category'),

            TD::make('image', __('Картинки'))
                ->render(fn (Post $post) => $post->image ? $post->image : 'No image'),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Post $post) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Link::make(__('Edit'))
                            ->route('platform.posts.edit', $post->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Are you sure you want to delete this post?'))
                            ->method('remove', [
                                'id' => $post->id,
                            ]),
                    ])),
        ];
    }
}
