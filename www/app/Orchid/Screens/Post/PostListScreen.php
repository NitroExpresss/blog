<?php

namespace App\Orchid\Screens\Post;
use App\Orchid\Layouts\Post\PostListLayout;
use Illuminate\Http\Request;
use App\Models\Post;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class PostListScreen extends Screen

{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'posts' => Post::paginate(10)
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Посты';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'тут можно отредать посты';
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
public function commandBar(): iterable
{
    return [
        Link::make(__('Add Post'))
            ->icon('bs.plus-circle')
            ->route('platform.post.create'),
    ];
}

    /**
     * The screen's layout elements.
     *
     * @throws \Throwable
     *
     * @return array
     */
    public function layout(): iterable
    {
        
        return [
            PostListLayout::class,
        ];
        
    }

    public function showToast(Request $request): void
    {
        Toast::warning($request->get('toast', 'Hello, world! This is a toast message.'));
    }
}
