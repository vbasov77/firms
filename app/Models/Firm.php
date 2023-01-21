<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Firm extends Model
{
    public $timestamps = false;

    protected $table = 'firms';

    function comments()
    {
        return $this->hasMany('App\Models\Comment')->orderBy('id', 'desc');
    }

    public static function addFirm(Request $request)
    {
        $firm = [
            'name' => $request->name,
            'user_id' => Auth::user()->id,
            'inn' => preg_replace("/\s+/", "", $request->inn),//Удалили пробелы
            'about' => $request->about,
            'general_director' => $request->general_director,
            'address' => $request->address,
            'phone' => $request->phone
        ];

        return Firm::insertGetId($firm);
    }

    public static function editFirm(Request $request){
        $firm = [
            'name' => $request->name,
            'user_id' => Auth::user()->id,
            'inn' => preg_replace("/\s+/", "", $request->inn),//Удалили пробелы
            'about' => $request->about,
            'general_director' => $request->general_director,
            'address' => $request->address,
            'phone' => $request->phone
        ];
        Firm::where('id', $request->id)->update($firm);
    }
}

