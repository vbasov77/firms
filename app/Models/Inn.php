<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class Inn extends Model
{
    public static function addInn(Request $request)
    {
        $firm = [
            'user_id' => (int)$request->user_id,
            'firm_id' => (int)$request->firm_id,
            'comment_text' => $request->comment_text,
        ];
        return Inn::insertGetId($firm);
    }

}
