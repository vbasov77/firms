<?php

namespace App\Http\Controllers;

use App\Models\AboutComment;
use App\Models\AddressComment;
use App\Models\Comment;
use App\Models\DirComment;
use App\Models\Inn;
use App\Models\NameComment;
use App\Models\PhoneComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    function saveComment(Request $request)
    {
        // Добавление коммента
        $id = Comment::saveComment($request);
        $date = Comment::where('id', $id)->value('created_at');
        return response()->json([
            'bool' => true,
            'date' => $date,
            'id' => $id
        ]);
    }

    function getInnComment(Request $request)
    {
        // Получение заметок ИНН
        $inn = Inn::where('user_id', $request->user_id)->
        where('firm_id', $request->firm_id)->latest()->get();
        return response()->json([
            'boolInn' => true,
            'arrayInn' => $inn
        ]);
    }

    public function addInnComment(Request $request)
    {
        // Запись заметки в базу данных поля "ИНН"
        $id = Inn::addInn($request);
        $date = Inn::where('id', $id)->value('created_at');
        return response()->json([
            'boolInn' => true,
            'comment_text' => $request->comment_text,
            'date' => $date
        ]);
    }

    function addAboutComment(Request $request)
    {
        // Запись заметки в базу данных поля "Подробнее"
        $id = AboutComment::addAbout($request);
        $date = AboutComment::where('id', $id)->value('created_at');
        return response()->json([
            'boolAbout' => true,
            'comment_text' => $request->comment_text,
            'date' => $date
        ]);
    }

    function getAboutComment(Request $request)
    {
        // Получение из базы данных заметок поля "Подробнее"
        $about = AboutComment::where('user_id', $request->user_id)->
        where('firm_id', $request->firm_id)->latest()->get();
        return response()->json([
            'boolAbout' => true,
            'arrayAbout' => $about
        ]);
    }

    function addNameComment(Request $request)
    {
        // Запись заметки в базу данных поля "Название"
        $id = NameComment::addName($request);
        $date = NameComment::where('id', $id)->value('created_at');
        return response()->json([
            'boolName' => true,
            'comment_text' => $request->comment_text,
            'date' => $date
        ]);
    }

    function getNameComment(Request $request)
    {
        // Получение из базы данных заметок поля "Название"
        $about = NameComment::where('user_id', $request->user_id)->
        where('firm_id', $request->firm_id)->latest()->get();
        return response()->json([
            'boolName' => true,
            'arrayName' => $about
        ]);
    }

    function addDirComment(Request $request)
    {
        // Запись заметки в базу данных поля "Генеральный директор"
        $id = DirComment::addDir($request);
        $date = DirComment::where('id', $id)->value('created_at');
        return response()->json([
            'boolDir' => true,
            'comment_text' => $request->comment_text,
            'date' => $date
        ]);
    }

    function getDirComment(Request $request)
    {
        // Получение из базы данных заметок поля "Генеральный директор"
        $dir = DirComment::where('user_id', $request->user_id)->
        where('firm_id', $request->firm_id)->latest()->get();
        return response()->json([
            'boolDir' => true,
            'arrayDir' => $dir
        ]);
    }

    function addAddrComment(Request $request)
    {
        // Запись заметки в базу данных поля "Адрес"
        $id = AddressComment::addAddress($request);
        $date = AddressComment::where('id', $id)->value('created_at');
        return response()->json([
            'boolAddr' => true,
            'comment_text' => $request->comment_text,
            'date' => $date
        ]);
    }

    function getAddrComment(Request $request)
    {
        // Получение из базы данных заметок поля "Адрес"
        $address = AddressComment::where('user_id', $request->user_id)->
        where('firm_id', $request->firm_id)->latest()->get();
        return response()->json([
            'boolAddr' => true,
            'arrayAddr' => $address
        ]);
    }

    function addPhComment(Request $request)
    {
        // Запись заметки в базу данных поля "Телефон"
        $id = PhoneComment::addPhone($request);
        $date = PhoneComment::where('id', $id)->value('created_at');
        return response()->json([
            'boolPh' => true,
            'comment_text' => $request->comment_text,
            'date' => $date
        ]);
    }

    function getPhComment(Request $request)
    {
        // Получение из базы данных заметок поля "Телефон"
        $comments = PhoneComment::where('user_id', $request->user_id)->
        where('firm_id', $request->firm_id)->latest()->get();
        return response()->json([
            'boolPh' => true,
            'arrayPh' => $comments
        ]);
    }
}
