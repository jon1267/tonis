<?php

namespace App\Modules\Admins\Core\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
//use Illuminate\Http\Request;
use App\Modules\Admins\Core\Http\Requests\AdminStoreRequest;
use App\Modules\Admins\Core\Http\Requests\AdminUpdateRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.users_content')
            ->with([
                'title'=>'Редактирование администраторов',
                'users' => User::where('role', 'admin')->paginate(10),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.users_create')->with(['title' => 'Добавить администратора']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AdminStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreRequest  $request)
    {
        //dd($request);
        $data = $request->except('_token', 'password_confirmation');
        $data['password'] = bcrypt($data['password']);

        if (User::create($data)) {
            return redirect()->route('admin.user.index')
                ->with(['status' => 'Администратор успешно добавлен']);
        }

        $request->flash();
        return redirect()->route('admin.user.index')
            ->with(['error' => 'Ошибка добавления администратора']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $title = 'Редактирование администратора';

        return view('admins.users_create')
            ->with(['title'=>$title, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdminUpdateRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateRequest  $request, User $user)
    {
        //dd($request);
        $data = $request->except('_token', '_method' ,'password_confirmation');

        // ввели пароль - меняем, не ввели - оставляем старый
        if(isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $user->password;
        }

        if($user->update($data)) {
            return redirect()->route('admin.user.index')
                ->with(['status' => 'Администратор был успешно изменен']);
        }

        return redirect()->route('admin.user.index')
            ->with(['error' => 'Ошибка измения администратора']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if($user->delete()) {
            return redirect()->route('admin.user.index')
                ->with(['status' => 'Администратор успешно удален']);
        }

        return redirect()->route('admin.user.index')
            ->with(['error' => 'Ошибка удаления данных.']);
    }
}
