<?php

namespace App\Modules\Promocodes\Core\Http\Controllers\Api;

//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Promocode;
use App\Models\Setting;
use App\Models\Point;
use App\Models\User;
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
        $promocode['code'] = $this->randString() . mt_rand(1111,9999) . $request->point_id;

        Promocode::create($promocode);

        // в вычачу добавляем адрес точки и массив ее продавцов
        $sellers = User::where('point_id', $request->point_id)->get(['name', 'phone', 'photo'])->toArray();
        $pointAddress = Point::where('id', $request->point_id)->first()->address;

        $promocode['point_address'] = $pointAddress ?? null;
        $promocode['point_sellers'] = count($sellers) ? $sellers : null;
        //dd($promocode);

        return response()->json($promocode);
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
        $pr = Setting::all(['percent1', 'percent2', 'percent3', 'percent4']);
        //dd($pr, $pr[0]['percent1'], $pr[0]['percent2'], $pr[0]['percent3'],);

        $data = [
            ['percent' => $pr[0]['percent1'], 'return' => mt_rand(10,14)],
            ['percent' => $pr[0]['percent2'], 'return' => mt_rand(15,19)],
            ['percent' => $pr[0]['percent3'], 'return' => mt_rand(20,49)],
            ['percent' => $pr[0]['percent4'], 'return' => mt_rand(50,90)],
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
