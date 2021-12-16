@extends('adminlte.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-md-8 col-sm-12 mx-auto">
                    <div class="card ">
                        <div class="card-header ">
                            <h5 class="m-0">Редактирование настроек</h5>
                        </div>
                        <div class="card-body">

                            <!-- -->
                            <form  action="{{ route('admin.setting.update', $setting) }}" method="post">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="name">Скидка 10-14% (по умолчанию 80%) </label>
                                    <input class="form-control @error('percent1') is-invalid @enderror" type="text"
                                           id="percent1" name="percent1" placeholder="Введите % скидки"
                                           value="{{(isset($setting->percent1)) ? $setting->percent1 : old('percent1')}}">
                                    @error('percent1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Скидка 15-19% (по умолчанию 14%)</label>
                                    <input class="form-control @error('percent2') is-invalid @enderror" type="text"
                                           id="percent2" name="percent2" placeholder="Введите % скидки"
                                           value="{{(isset($setting->percent2)) ? $setting->percent2 : old('percent2')}}">
                                    @error('percent2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Скидка 20-49% (по умолчанию 5%)</label>
                                    <input class="form-control @error('percent3') is-invalid @enderror" type="text"
                                           id="percent3" name="percent3" placeholder="Введите % скидки"
                                           value="{{(isset($setting->percent3)) ? $setting->percent3 : old('percent3')}}">
                                    @error('percent3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Скидка 50-90% (по умолчанию 1%)</label>
                                    <input class="form-control @error('percent4') is-invalid @enderror" type="text"
                                           id="percent4" name="percent4" placeholder="Введите % скидки"
                                           value="{{(isset($setting->percent4)) ? $setting->percent4 : old('percent4')}}">
                                    @error('percent4')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="form-group mt-5">
                                    <button type="submit" class="btn btn-primary"> <i class="far fa-save mr-2"></i>Сохранить данные </button>
                                    <a href="{{ route('cabinet') }}" class="btn btn-info ml-2"> <i class="fas fa-sign-out-alt mr-2"></i>Отмена</a>
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

