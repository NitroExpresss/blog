<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Post;

use App\Models\Post;
use App\Orchid\Layouts\Post\PostEditLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Support\Str;

class PostEditScreen extends Screen
{
    /**
     * Query data.
     *
     * @param Post $post
     * @return array
     */
    public function query(Post $post): array
    {
        return [
            'post' => $post,
        ];
    }

    /**
     * Button commands.
     *
     * @return iterable
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Создать'))
                ->icon('bs.check-circle')
                ->method('save'),
        ];
    }

    /**
     * Layout.
     *
     * @return iterable
     */
    public function layout(): iterable
    {
        return [
            PostEditLayout::class,
        ];
    }

    /**
     * Save data.
     *
     * @param Post $post
     */
    public function save(Post $post)
    {
        $data = request()->get('post');

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $post->fill($data)->save();

        Toast::info(__('Post saved successfully.'));
    }
}
