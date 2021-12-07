<?php

namespace App\Modules\Points\Core\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PointCabinetController extends Controller
{
    public function cabinet()
    {
        return view('adminlte.admin', [
            'user' => auth()->user(),
        ]);
    }
}
