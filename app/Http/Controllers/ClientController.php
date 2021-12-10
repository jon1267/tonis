<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Открытый (видимый с улицы, без авторизаций, аутентиф и тдитп) по GET параметру hash,
 * вернет $point->id, если в табл. points есть запись с таким {hash}
 * Class PointHashController
 * @package App\Http\Controllers
 */
class ClientController extends Controller
{
    public function index(Request $request)
    {
        $point_id = $request->get('point_id');

        return view('welcome')->with('point_id', $point_id);
    }
}
