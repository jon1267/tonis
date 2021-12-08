<?php

namespace App\Modules\Promocodes\Core\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promocode;
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
