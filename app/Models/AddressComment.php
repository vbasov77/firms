<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AddressComment extends Model
{
    public $timestamps = false;
    protected $table = 'addr_comments';

    public static function addAddress(Request $request)
    {
        $firm = [
            'user_id' => (int)$request->user_id,
            'firm_id' => (int)$request->firm_id,
            'comment_text' => $request->comment_text,
        ];

        return AddressComment::insertGetId($firm);
    }
}
