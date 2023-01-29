<?php

namespace App\Http\Controllers;

use App\Models\Firm;


class FrontController extends Controller
{
    public function view()
    {
        // Получаем данные из двух таблиц
        $firms = Firm::leftJoin('images', 'firms.id', '=', 'images.firm_id')->get(['firms.*', 'images.path']);

        return view('front', ['firms' => $firms]);
    }


}
