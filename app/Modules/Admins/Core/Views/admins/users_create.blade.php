@extends('adminlte.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-md-8 col-sm-12 mx-auto">
                    <div class="card ">
                        <div class="card-header ">
                            <h5 class="m-0">{{ (isset($user)) ? 'Обновление данных' : 'Введите данные' }}</h5>
                        </div>
                        <div class="card-body">

                            <!-- -->
                            <form  action="{{ (isset($user)) ? route('admin.user.update', $user) : route('admin.user.store') }}" method="post">
                                @csrf
                                @if(isset($user))
                                    @method('PUT')
                                @endif

                                <div class="form-group">
                                    <label for="name">Имя администратора</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                           id="name" name="name" placeholder="Имя пользователя"
                                           value="{{(isset($user->name)) ? $user->name : old('name')}}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="text"
                                           id="email" name="email" placeholder="Email"
                                           value="{{(isset($user->email)) ? $user->email : old('email')}}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Пароль {{ isset($user) ? '(не вводите пароль, чтобы он не менялся )' : '' }}</label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                           id="password" name="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Повтор пароля</label>
                                    <input class="form-control" type="password" id="password_confirmation" name="password_confirmation">
                                </div>

                                <input type="hidden" name="role" value="admin">

                                <div class="form-group mt-5">
                                    <button type="submit" class="btn btn-primary"> <i class="far fa-save mr-2"></i>Сохранить пользователя </button>
                                    <a href="{{ route('admin.user.index') }}" class="btn btn-info ml-2"> <i class="fas fa-sign-out-alt mr-2"></i>Отмена</a>
                                </div>
                            </form>
                            <!-- -->

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
