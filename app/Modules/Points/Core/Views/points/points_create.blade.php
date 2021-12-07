@extends('adminlte.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-md-8 col-sm-12 mx-auto">
                    <div class="card ">
                        <div class="card-header ">
                            <h5 class="m-0">{{ (isset($point)) ? 'Обновление данных торговой точки' : 'Введите данные торговой точки' }}</h5>
                        </div>
                        <div class="card-body">

                            <!-- -->
                            <form  action="{{ (isset($point)) ? route('admin.point.update', $point) : route('admin.point.store') }}" method="post">
                                @csrf

                                @php
                                    $newPointHash = mt_rand(111111111,999999999);
                                @endphp

                                @if(isset($point))
                                    @method('PUT')
                                    {{--<input type="hidden" name="updated_by_id" value="{{ $userId }}">--}}
                                    <input type="hidden" name="created_by_id" value="{{ $userId }}">
                                @else
                                    <input type="hidden" name="created_by_id" value="{{ $userId }}">
                                    <input type="hidden" name="hash" value="{{ $newPointHash }}">
                                @endif



                                <div class="form-group">
                                    <label for="name">Наименование</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                           id="name" name="name" placeholder="Введите наименование торговой точки"
                                           value="{{(isset($point->name)) ? $point->name : old('name')}}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="address">Адрес</label>
                                    <input class="form-control @error('address') is-invalid @enderror" type="text"
                                           id="address" name="address" placeholder="Введите торговой точки"
                                           value="{{(isset($point->address)) ? $point->address : old('address')}}">
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone">Телефон</label>
                                    <input class="form-control @error('phone') is-invalid @enderror" type="text"
                                           id="phone" name="phone" placeholder="Телефон"
                                           value="{{(isset($point->phone)) ? $point->phone : old('phone')}}">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="hash">ХЭШ</label>
                                    <input class="form-control @error('hash') is-invalid @enderror" type="text"
                                           id="hash" name="hash"  placeholder="hash"
                                           value="{{(isset($point->hash)) ? $point->hash : $newPointHash }}" disabled>
                                    @error('hash')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{-- <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http://point.kleopatra0707.com/{{(isset($point->hash)) ? $point->hash : $newPointHash }}" alt="qr_code"> --}}
                                </div>
                                <div class="mt-4">
                                    <a class="btn btn-primary"  href="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http://point.kleopatra0707.com/{{(isset($point->hash)) ? $point->hash : $newPointHash }}">QR код</a>
                                </div>


                                <div class="form-group mt-5">
                                    <button type="submit" class="btn btn-primary"> <i class="far fa-save mr-2"></i>Сохранить данные </button>
                                    <a href="{{ route('admin.point.index') }}" class="btn btn-info ml-2"> <i class="fas fa-sign-out-alt mr-2"></i>Отмена</a>
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

