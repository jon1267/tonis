<?php

namespace App\Modules\Promocodes\Core\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promocode;
use Illuminate\Http\Request;
use App\Modules\Promocodes\Core\Http\Requests\AdminPromocodeUpdateRequest;

class PromocodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('promocodes.promocodes_content')->with([
            'title' => 'Редактирование промокодов',
            'promocodes' => Promocode::paginate(10),
        ]);
    }

    /* поиск, фильтр  промокодов */
    public function filterPromocodes(Request $request)
    {
        $r = $request->except('_token');
        $query = Promocode::query();
        //dd($r, $query, request('code'));

        //работает как отмена (сброс) фильтра-поиска
        if (is_null($r['code']) &&  is_null($r['phone']) && is_null($r['date_from']) && is_null($r['date_to']) && !isset($r['point_id'])) {
            return redirect()->route('admin.promocode.index')
                ->with(['status' => 'Пустой запрос. Фильтр сброшен. Введите данные для поиска.']);
        }


        if(request('code') !== null) {
            $query->when($r, function($query, $r)   {
                return $query->where('code', 'like', '%'.$r['code'].'%');
            });
        }
        if(request('phone') !== null) {
            $query->when($r, function($query, $r)   {
                //return $query->where('phone', $r['phone']);
                return $query->where('phone', 'like', '%'.$r['phone'].'%');
            });
        }

        if(request('date_from') !== null && request('date_to')!==null){
            $query->when($r, function($query, $r) {
                return $query->whereDate('created_at', '>=' ,$r['date_from'])
                    ->whereDate('created_at', '<=' ,$r['date_to']);
            });
        }
        if(request('date_from') !== null && request('date_to')===null){
            $query->when($r, function($query, $r) {
                return $query->whereDate('created_at', '>=' ,$r['date_from']);
            });
        }
        if(request('date_from') === null && request('date_to')!==null){
            $query->when($r, function($query, $r) {
                return $query->whereDate('created_at', '<=' ,$r['date_to']);
            });
        }
        if (request('point_id') !== null) {
            $query->when($r, function($query, $r)   {
                return $query->where('point_id', $r['point_id']);
            });
        }

        $promocodes = $query->paginate(10); //get(); //dd($promocodes);

        if (!count($promocodes)) {
            return redirect()->route('admin.promocode.index')
                ->with(['status' => 'По данному запросу ничего не найдено']);
        }

        return view('promocodes.promocodes_content')->with([
            'title' => 'Поиск промокодов',
            'promocodes' => $promocodes
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store() {}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode $promocode
     */
    public function show(Promocode $promocode) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Promocode $promocode
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Promocode $promocode)
    {
        return view('promocodes.promocodes_create')->with([
            'title'=> 'Редактирование промокода',
            'promocode' => $promocode,
        ]);
    }

    /**
     * @param AdminPromocodeUpdateRequest $request
     * @param Promocode $promocode
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminPromocodeUpdateRequest $request, Promocode $promocode)
    {
        $data = $request->except('_token', '_method');

        $promocode->update($data);

        return redirect()->route('admin.promocode.index')->with(['status' => 'Данные промокода были изменены']);
    }

    /**
     * @param Promocode $promocode
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Promocode $promocode)
    {
        $promocode->delete();

        return redirect()->route('admin.promocode.index')->with(['status' => 'Промокод успешно удален']);
    }
}
