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
        $promocode['percent'] = $this->getPercent(); //mt_rand(5,10);
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

    /**
     * вероятностное распределение процента скидки промокодов:
     */
    private function getPercent()
    {
        $data = [
            ['percent' => 80, 'return' => mt_rand(10,14)],
            ['percent' => 14, 'return' => mt_rand(15,19)],
            ['percent' => 5,  'return' => mt_rand(20,49)],
            ['percent' => 1,  'return' => mt_rand(50,90)],
        ];

        $percent = mt_rand(1, 100);
        $current = 0;
        $result  = 5; //default percent = 5% if nothing else

        foreach($data as $value){
            $current += $value['percent'];

            if($current >= $percent){
                $result = $value['return'];
                break;
            }
        }

        return $result;
    }

}
