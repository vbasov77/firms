<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Comment extends Model
{



    public $timestamps = false;
    protected $table = 'comments';

    /**
     * @return mixed
     */



    public static function saveComment(Request $request)
    {
        $id = Comment::insertGetId([
            'firm_id' => $request->firm,
            'comment_text' => $request->comment,
        ]);
        return $id;
    }
}
