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
        //��������� ������ ��� �������� ��������� �����

        //�������� ������ �� ���� ������
        $firm = Firm::leftJoin('images', 'firms.id', '=', 'images.firm_id')
            ->where('firms.id', $request->id)
            ->get(['firms.*', 'images.path']);
        // �������� �����������
        $comments = Comment::where('firm_id', $request->id)->get();
        $userId = null;
        if (Auth::user()) {
            $userId = Auth::user()->id;
        }
        return view('firms.view', ['firm' => $firm [0], 'comments' => $comments, 'userId' => $userId]);
    }

    public function add(Request $request)
    {
        // ���� ��� ����������, ���� ������������ ����� GET
        if ($request->isMethod('get')) {
            return view('firms.add');
        }
        // ���� ��� ����������, ���� ������������ ����� POST
        if ($request->isMethod('post')) {
            $request->validate([                      // �������� �����
                'name' => 'required|string|max:255',
                'address' => 'required|string',
                'inn' => 'required|numeric|min:5',
                'about' => 'required',
                'general_director' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'image' => 'mimes:jpeg,png'
            ]);
            $path_img = '';
            if ($request->file('image')) {  //���� ���������� ����, �� ������� ���
                $path_img = self::addFile($request); //����������� ������� ������ �����
            }
            $id = Firm::addFirm($request); // ��������� ����� � ���� ������
            Image::addImage($id, $path_img); // �������� ���� � ���� ������

            return redirect()->action('FirmController@view', ['id' => $id]);
        }
    }

    public function edit(Request $request)
    {
        // ���� ��� ����������, ���� ������������ ����� GET
        if ($request->isMethod('get')) {
            $logo = Image::where('firm_id', $request->id)->value('path');// �������� ����
            $firm = Firm::where('id', $request->id)->get(); // �������� ������ �� ID

            return view('firms.edit', ['firm' => $firm[0], 'logo' => $logo]);
        }
        // ���� ��� ����������, ���� ������������ ����� POST
        if ($request->isMethod('post')) {
            // �������� �����
            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string',
                'inn' => 'required|numeric|min:5',
                'about' => 'required',
                'general_director' => 'required|string|max:255',
                'phone' => 'required|string|max:20',

            ]);

            // ���� �������� ����� ����, �� �������� ��� � �������
            $path_img = $request->old_image;
            if (!empty($request->file())) {
                $request->validate([
                    'image' => 'mimes:jpeg,png'
                ]);
                Storage::delete('public/images/logo/' . $path_img); //������� ������ ����
                $path_img = self::addFile($request); // �������� ���� � ������
                Image::editImage($request->id, $path_img);
            }
            Firm::editFirm($request);
            return redirect()->action('FirmController@view', ['id' => $request->id]);
        }
    }

    public function delete(Request $request)
    {
        // ������� �����
        Firm::where('id', $request->id)->delete();
        return redirect()->action('FrontController@view');
    }

    public static function addFile(Request $request)
    {
        // ������� ���� � storage public
        $code = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';// ��������� �������
        $code_img = substr(str_shuffle($code), 0, 16);// ������������� ��������� ��� ��� ������
        $guessExtension_image = $request->file('image')->guessExtension();// �������� ���������� ����
        $path_img = $code_img . "." . $guessExtension_image;
        $request->file('image')->storeAs('images/logo', $code_img . '.'
            . $guessExtension_image, 'public');
        return $path_img;
    }


}
