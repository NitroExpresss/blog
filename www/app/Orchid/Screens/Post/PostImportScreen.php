<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Post;

use App\Models\Post;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleXMLElement;
use Illuminate\Support\Str;

class PostImportScreen extends Screen
{
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
                    ->placeholder('Загрузите файл с постами в формате XML'),
                
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
        $file = $request->file('xml_file');

        if (!$file) {
            Toast::error('Файл не был загружен.');
            return;
        }

        $path = $file->store('uploads'); // Сохраняем файл во временное хранилище
        $xmlContent = Storage::get($path); // Читаем содержимое
        $xml = new SimpleXMLElement($xmlContent);

        foreach ($xml->post as $post) {
            Post::create([
                'title'       => (string) $post->title,
                'slug'        => Str::slug((string) $post->title),
                'description' => (string) $post->description,
                'category_id' => (int) $post->category_id,
                'image'       => (string) $post->image,
            ]);
        }

        Storage::delete($path); // Удаляем файл после обработки

        Toast::success('Посты успешно импортированы.');
    }
}
