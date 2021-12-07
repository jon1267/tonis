<?php

namespace App\Modules\Points\Core\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Modules\Points\Core\Http\Requests\AdminPointStoreRequest;
use App\Modules\Points\Core\Http\Requests\AdminPointUpdateRequest;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //dd(config('view.paths'));
        return view('points.points_content')->with([
            'title' => 'Редактирование торговых точек',
            'points' => Point::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('points.points_create')->with([
            'title' => 'Добавить торговую точку',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AdminPointStoreRequest  $request
     */
    public function store(AdminPointStoreRequest $request)
    {
        //dd($request);
        Point::create($request->except('_token'));

        return redirect()->route('admin.point.index')->with(['status' => 'Торговая точка добавлена']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Point $point
     * @return \Illuminate\Http\Response
     */
    public function show(Point $point)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Point $point
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Point $point)
    {
        return view('points.points_create')->with([
            'title'=> 'Редактирование торговой точки',
            'point' => $point,
        ]);
    }

    /**
     * @param AdminPointUpdateRequest $request
     * @param Point $point
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminPointUpdateRequest $request, Point $point)
    {
        $data = $request->except('_token', '_method');

        $point->update($data);

        return redirect()->route('admin.point.index')->with(['status' => 'Данные торговой точки были изменены']);
    }

    /**
     * @param Point $point
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Point $point)
    {
        $point->delete();

        return redirect()->route('admin.point.index')
            ->with(['status' => 'Данные торговой точки были удалены']);
    }
}
