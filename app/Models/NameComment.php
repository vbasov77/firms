<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class NameComment extends Model
{
    public $timestamps = false;

    protected $table = 'name_comments';

    public static function addName(Request $request)
    {
        $firm = [
            'user_id' => (int)$request->user_id,
            'firm_id' => (int)$request->firm_id,
            'comment_text' => $request->comment_text,
        ];
        return NameComment::insertGetId($firm);
    }

}
