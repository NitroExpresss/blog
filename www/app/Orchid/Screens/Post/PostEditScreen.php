<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Post;

use App\Models\Post;
use App\Orchid\Layouts\Post\PostEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Support\Str;

class PostEditScreen extends Screen
{
    public $post;
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

    public function description(): ?string
    {
        return "Blog posts";
    }

    public function name(): ?string
    {
        return $this->post->exists ? 'Редактирование поста' : 'Создание поста';
    }

    /**
     * Button commands.
     *
     * @return iterable
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Сохранить'))
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
    public function save(Request $request, )
    {
        $postData = request()->validate([
            'post.title' => 'required|string|max:255',
            'post.description' => 'required|string',
            'post.category_id' => 'required|exists:categories,id',
            // 'post.image' => 'nullable|array',
            // 'post.image.*' => 'nullable|string',
        ]);
        $postData['post']['slug'] = Str::slug($postData['post']['title']);
        $this->post->fill($postData['post'])->save();
        Toast::success('Пост успешно сохранен');
        return redirect()->route('platform.posts');
    }
}
