<?php

namespace App\Modules\Sellers\Core\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Point;
use App\Services\Images\Img;
use Illuminate\Http\Request;
use App\Modules\Sellers\Core\Http\Requests\AdminSellerStoreRequest;
use App\Modules\Sellers\Core\Http\Requests\AdminSellerUpdateRequest;

class SellerController extends Controller
{
    /**
     * @var Img
     */
    private $img;

    public function __construct(Img $img)
    {
        $this->img = $img;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Редактирование продавцов';
        $sellers = User::where('role', 'seller')->paginate(10);

        return view('sellers.sellers_content')
            ->with(['title'=>$title, 'sellers' => $sellers]);
    }

    public function filter(Request $request)
    {
        if (request('point_id') === null) {
            return redirect()->route('admin.seller.index');
        }

        $filterPointName = Point::where('id', $request->point_id)->first()->name;
        $title = 'фильтр : ' . $filterPointName;
        $sellers = User::where([['role','seller'],['point_id', $request->point_id] ])->paginate(10);

        return view('sellers.sellers_content')->with(['title'=>$title, 'sellers' => $sellers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Point::count()) {
            return redirect()->route('admin.seller.index')
                ->with(['error' => 'Нельзя добавить продавца, если нет торговых точек.']);
        }

        return view('sellers.sellers_create')->with(['title' => 'Добавить продавца']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AdminSellerStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminSellerStoreRequest  $request)
    {
        //dd($request);
        $data = $request->except('_token', 'password_confirmation');
        $data['password'] = bcrypt($data['password']);
        $data['photo'] = $this->img->save($request, 'photo', '/images/photo');

        if (User::create($data)) {
            return redirect()->route('admin.seller.index')
                ->with(['status' => 'Продавец успешно добавлен']);
        }

        $request->flash();
        return redirect()->route('admin.seller.index')
            ->with(['error' => 'Ошибка добавления продавца']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $seller
     * @return \Illuminate\Http\Response
     */
    public function show(User $seller)
    {
        //
    }

    /**
     * @param User $seller
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $seller)
    {
        $title = 'Редактирование продавца';

        return view('sellers.sellers_create')
            ->with(['title'=>$title, 'seller' => $seller]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdminSellerUpdateRequest  $request
     * @param  \App\Models\User  $seller
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminSellerUpdateRequest  $request, User  $seller)
    {
        //dd($request);
        $data = $request->except('_token', '_method' ,'password_confirmation');
        $data['photo'] = $this->img->save($request, 'photo',   '/images/photo', $seller->photo);
        // удаление, если нажато удалить старое фото для photo
        if (!is_null($request->deleted_image['id'])) {
            $this->img->delete($seller->photo);
            $data['photo'] =  null;
        }

        // ввели пароль - меняем, не ввели - оставляем старый
        if(isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $seller->password;
        }

        if($seller->update($data)) {
            return redirect()->route('admin.seller.index')
                ->with(['status' => 'Продавец был успешно изменен']);
        }

        return redirect()->route('admin.seller.index')
            ->with(['error' => 'Ошибка измения продавца']);

    }

    /**
     * @param User $seller
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User  $seller)
    {
        if($seller->delete()) {
            return redirect()->route('admin.seller.index')
                ->with(['status' => 'Продавец успешно удален']);
        }

        return redirect()->route('admin.seller.index')
            ->with(['error' => 'Ошибка удаления данных.']);
    }
}
