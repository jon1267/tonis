@extends('adminlte.start')
<!-- эта форма - запрос ссылки сброса пароля (аналог лариной passwords\email.blade) -->
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <center>
                <img src="{{ asset('/images/euro.png') }}" class="logo" style="max-width: 300px; width: 100%">
            </center>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Забыли пароль? Здесь Вы можете сбросить пароль.</p>

                <form action="{{ route('password.email') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" id="email" name="email" class="form-control  @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Отправить ссылку сброса пароля</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mt-3 mb-1">
                    <a href="/login">Вход</a>
                </p>
                <p class="mb-0">
                    <a href="/register" class="text-center">Регистрация нового партнера</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
@endsection
