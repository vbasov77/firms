<?php

namespace App\Http\Controllers;


use App\Models\Comment;
use App\Models\Firm;
use App\Models\Image;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class FirmController extends Controller
{
    public function view(Request $request)
    {
        //Формируем данные для страницы отдельной фирмы

        //Получаем данные из двух таблиц
        $firm = Firm::leftJoin('images', 'firms.id', '=', 'images.firm_id')
            ->where('firms.id', $request->id)
            ->get(['firms.*', 'images.path']);
        // Получили комментарии
        $comments = Comment::where('firm_id', $request->id)->get();
        $userId = null;
        if (Auth::user()) {
            $userId = Auth::user()->id;
        }
        return view('firms.view', ['firm' => $firm [0], 'comments' => $comments, 'userId' => $userId]);
    }

    public function add(Request $request)
    {
        // этот код выполнится, если используется метод GET
        if ($request->isMethod('get')) {
            return view('firms.add');
        }
        // этот код выполнится, если используется метод POST
        if ($request->isMethod('post')) {
            $request->validate([                      // Проверка полей
                'name' => 'required|string|max:255',
                'address' => 'required|string',
                'inn' => 'required|numeric|min:5',
                'about' => 'required',
                'general_director' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'image' => 'mimes:jpeg,png'
            ]);
            $path_img = '';
            if ($request->file('image')) {  //Если существует файл, то запишем его
                $path_img = self::addFile($request); //Статическая функция записи файла
            }
            $id = Firm::addFirm($request); // Добавляем фирму в базу данных
            Image::addImage($id, $path_img); // Добавили файл в базу данных

            return redirect()->action('FirmController@view', ['id' => $id]);
        }
    }

    public function edit(Request $request)
    {
        // этот код выполнится, если используется метод GET
        if ($request->isMethod('get')) {
            $logo = Image::where('firm_id', $request->id)->value('path');// Получили лого
            $firm = Firm::where('id', $request->id)->get(); // Получили данные по ID

            return view('firms.edit', ['firm' => $firm[0], 'logo' => $logo]);
        }
        // этот код выполнится, если используется метод POST
        if ($request->isMethod('post')) {
            // Проверка полей
            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string',
                'inn' => 'required|numeric|min:5',
                'about' => 'required',
                'general_director' => 'required|string|max:255',
                'phone' => 'required|string|max:20',

            ]);

            // Если передали новый файл, то проверим его и запишем
            $path_img = $request->old_image;
            if (!empty($request->file())) {
                $request->validate([
                    'image' => 'mimes:jpeg,png'
                ]);
                Storage::delete('public/images/logo/' . $path_img); //Удалили старое лого
                $path_img = self::addFile($request); // Записали файл в стораж
                Image::editImage($request->id, $path_img);
            }
            Firm::editFirm($request);
            return redirect()->action('FirmController@view', ['id' => $request->id]);
        }
    }

    public function delete(Request $request)
    {
        // Удаляем фирму
        Firm::where('id', $request->id)->delete();
        return redirect()->action('FrontController@view');
    }

    public static function addFile(Request $request)
    {
        // Добавим фото в storage public
        $code = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';// Случайные символы
        $code_img = substr(str_shuffle($code), 0, 16);// Сгенерировали случайное имя для файлов
        $guessExtension_image = $request->file('image')->guessExtension();// получили расширение фото
        $path_img = $code_img . "." . $guessExtension_image;
        $request->file('image')->storeAs('images/logo', $code_img . '.'
            . $guessExtension_image, 'public');
        return $path_img;
    }


}
