<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;


class Image extends Model
{
    public $timestamps = false;

    protected $table = 'images';

    public static function addImage($id, $path)
    {
        $firm = [
            'firm_id' => $id,
            'path' => $path,

        ];
        return Image::insertGetId($firm);
    }

    public static function editImage($firmId, $path)
    {
        if (Image::where('firm_id', '=', $firmId)->exists()) {
            Image::where('firm_id', $firmId)->update(['path' => $path]);
        } else {
            $firm = [
                'firm_id' => $firmId,
                'path' => $path,
            ];
            Image::insert($firm);
        }

    }
}

