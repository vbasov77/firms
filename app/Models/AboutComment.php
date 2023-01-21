<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AboutComment extends Model
{
    public $timestamps = false;

    protected $table = 'about_comments';

    public static function addAbout(Request $request)
    {
        $firm = [
            'user_id' => (int)$request->user_id,
            'firm_id' => (int)$request->firm_id,
            'comment_text' => $request->comment_text,
        ];
        $id = AboutComment::insertGetId($firm);
        return $id;
    }


}
