<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Post;

use App\Models\Post;
use App\Models\Category;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Attach;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleXMLElement;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PostImportScreen extends Screen
{
    public function query(): iterable
    {
        return [];
    }
    /**
     * Название экрана.
     */
    public function name(): string
    {
        return 'Импорт постов из XML';
    }

    /**
     * Разметка экрана.
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Attach::make('xml_file')
                    ->title('Выберите XML файл')
                    ->placeholder('Загрузите XML с постами')
                    ->maxFiles(1)
                    ->acceptedFiles('.xml'),

                Button::make('Импортировать')
                    ->method('importPosts')
                    ->icon('bs.upload'),
            ]),
        ];
    }

    /**
     * Обработка загрузки XML-файла и импорт постов.
     */
    public function importPosts(Request $request)
    {

        $path = Attachment::find($request->input('xml_file'))->firstOrFail()->physicalPath();
        $contents = Storage::disk('public')->get($path);

        $xml = simplexml_load_string($contents);

        $json = json_encode($xml);

        $array = json_decode($json, true);
        foreach ($array as $categoryItem) {
            $categoryName = (string) $categoryItem['Category']['Name'];
            $category = Category::updateOrCreate(
                ['name' => $categoryName],
                ['slug' => Str::slug((string) $categoryItem['Category']['Name'])]);
            foreach ($categoryItem['Category']['Elements'] as $postItem) {
                Post::updateOrCreate(
                    [
                        'slug' => Str::slug((string) $postItem['Name']),
                    ],
                    [
                        'title' => (string) $postItem['Name'],
                        'category_id' => $category->id,
                        'description' => (string) $postItem['Description'],
                    ]
                );
            }
        }

        Storage::delete($path);
        
        Toast::success('Посты успешно импортированы.');
        return redirect()->route('platform.posts');
    }
}
