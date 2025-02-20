<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Post;

use App\Models\Post;
use App\Models\Category;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleXMLElement;
use Illuminate\Support\Str;

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
                Upload::make('xml_file')
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
        if (!$request->hasFile('xml_file')) {
            Toast::error('Файл не загружен или превышает лимит.');
            return;
        }
        $file = $request->file('xml_file');
        if (!$file->isValid() || $file->getClientOriginalExtension() !== 'xml') {
            Toast::error('Ошибка загрузки: неверный формат или поврежденный файл.');
            return;
        }
        dd($request);
        $file = $request->file('xml_file');

        if (!$file) {
            Toast::error('Файл не загружен.');
            return;
        }

        $path = $file->store('uploads'); // Временное сохранение
        $xmlContent = Storage::get($path);
        $xml = new SimpleXMLElement($xmlContent);

        foreach ($xml->item0 as $categoryItem) {
            $categoryName = (string) $categoryItem->Name; // Имя категории

            // Найти или создать категорию
            $category = Category::firstOrCreate(['name' => $categoryName]);

            foreach ($categoryItem->Elements->children() as $postItem) {
                Post::create([
                    'title'       => (string) $postItem->Name,
                    'slug'        => Str::slug((string) $postItem->Name),
                    'description' => (string) $postItem->Description,
                    'category_id' => $category->id,
                    'image'       => json_encode([
                        (string) $postItem->Pict1,
                        (string) $postItem->Pict2
                    ]), // Сохраняем как JSON
                ]);
            }
        }

        Storage::delete($path); // Удаляем файл после обработки

        Toast::success('Посты успешно импортированы.');
    }
}
