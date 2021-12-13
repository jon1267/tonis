<?php

namespace App\Modules\Promocodes\Core\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Promocode;
use Illuminate\Support\Str;
use App\Modules\Promocodes\Core\Http\Requests\ApiPromocodeCreateRequest;

class PromocodeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param ApiPromocodeCreateRequest $request
     * @return mixed
     */
    public function store(ApiPromocodeCreateRequest  $request)
    {
        $promocode['phone'] = phone_format($request->phone);
        $promocode['point_id'] = $request->point_id;
        $promocode['answers'] = json_encode($request->answers);
        $promocode['percent'] = mt_rand(5,10);
        $promocode['hash'] = Str::random(10);
        $promocode['test_id'] = 0;
        $promocode['code'] = $this->randString() . mt_rand(1111,9999). $request->point_id;
        //dd($promocode);

        Promocode::create($promocode);

        return response()->json($promocode); // return Promocode::create($promocode);
    }

    private function randString()
    {
        return substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4);
    }

}
