@extends('adminlte.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-md-8 col-sm-12 mx-auto">
                    <div class="card ">
                        <div class="card-header ">
                            <h5 class="m-0">{{ 'Данные промокода' }}</h5>
                        </div>
                        <div class="card-body">

                            <!-- -->
                            <div>
                                <div class="form-group">
                                    <label for="code">Промокод</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                           id="code" name="code" placeholder="Введите промокод"
                                           value="{{(isset($promocode->code)) ? $promocode->code : old('code')}}" disabled>
                                    @error('code')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="percent">Процент скидки</label>
                                    <input class="form-control @error('address') is-invalid @enderror" type="text"
                                           id="percent" name="percent" placeholder="Введите торговой точки"
                                           value="{{(isset($promocode->percent)) ? $promocode->percent : old('percent')}}" disabled>
                                    @error('percent')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone">Телефон</label>
                                    <input class="form-control @error('phone') is-invalid @enderror" type="text"
                                           id="phone" name="phone" placeholder="Телефон"
                                           value="{{(isset($promocode->phone)) ? $promocode->phone : old('phone')}}" disabled>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-4 pl-0">
                                    <label for="phone">Дата создания</label>
                                    <input class="form-control" type="text"
                                           id="created_at" name="created_at" placeholder="Дата создания"
                                           value="{{ $promocode->created_at }}" disabled>
                                </div>

                                @if(isset($promocode->activated_at) && !is_null($promocode->activated_at))
                                    <div class="form-group col-4 pl-0">
                                        <label for="phone">Дата активации</label>
                                        <input class="form-control" type="text"
                                               value="{{ $promocode->activated_at }}" disabled>
                                    </div>
                                @elseif(!is_null($promocode->created_at) && (Carbon\Carbon::now() > Carbon\Carbon::create($promocode->created_at)->addHours(24)))
                                    <!-- прошло более 24 часов с момента создания промокода -->
                                    <div class="form-group col-4 pl-0">
                                        <label for="phone">Дата активации</label>
                                        <input class="form-control" type="text"  value="Время активации звершилось" disabled>
                                    </div>
                                @else
                                    <a href="" class="btn btn-primary"> Активировать </a>
                                @endif

                                <div class="form-group mt-5 ">
                                    <!--<button type="submit" class="btn btn-primary"> <i class="far fa-save mr-2"></i>Сохранить данные </button>-->
                                    <a href="{{ route('admin.promocode.index') }}" class="btn btn-info"> <i class="fas fa-sign-out-alt mr-2"></i> Отмена </a>
                                </div>
                            </div>
                            <!-- -->

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

