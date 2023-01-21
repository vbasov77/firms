<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PhoneComment extends Model
{
    public $timestamps = false;
    protected $table = 'phone_comments';

    public static function addPhone(Request $request)
    {
        $firm = [
            'user_id' => (int)$request->user_id,
            'firm_id' => (int)$request->firm_id,
            'comment_text' => $request->comment_text,
        ];
        return PhoneComment::insertGetId($firm);
    }
}
