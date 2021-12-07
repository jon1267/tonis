@extends('adminlte.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-md-8 col-sm-12 mx-auto">
                    <div class="card ">
                        <div class="card-header ">
                            <h5 class="m-0">{{ (isset($seller)) ? 'Обновление данных' : 'Введите данные' }}</h5>
                        </div>
                        <div class="card-body">

                            <!-- -->
                            <form  action="{{ (isset($seller)) ? route('admin.seller.update', $seller) : route('admin.seller.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if(isset($seller))
                                    @method('PUT')
                                @endif

                                <div class="form-group">
                                    <label for="name">Имя продавца</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                           id="name" name="name" placeholder="Имя продавца"
                                           value="{{(isset($seller->name)) ? $seller->name : old('name')}}">
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
                                           value="{{(isset($seller->email)) ? $seller->email : old('email')}}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone">Телефон</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="text"
                                           id="phone" name="phone" placeholder="Телефон"
                                           value="{{(isset($seller->phone)) ? $seller->phone : old('phone')}}">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-6 pl-0">
                                    <label for="exampleInputFile">Фото продавца</label>
                                    <div class="input-group ">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('photo') is-invalid @enderror" id="photo" name="photo" aria-describedby="customFileInput">
                                            <label class="custom-file-label" for="customFileInput">Выберите фото продавца</label>
                                        </div>
                                    </div>
                                    @error('photo')
                                    <!-- нада style="display: inline-block", т.к. custom-file-input где-то ставит d-none -->
                                    <span class="invalid-feedback" style="display: inline-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <div>
                                        @if(isset($seller) && (!empty($seller->photo)))
                                            <div class="form-group mt-2" id="old_div_deleted_image">
                                                <label for="old_img" >Старое фото продавца</label>
                                                <a href="#" onclick="event.preventDefault(); imageDelete('User', 'photo' ,'{{ $seller->id }}', 'deleted_image')" id="delete-image-button" class="badge badge-danger ml-2" title="удалить старое изображение" >&nbsp;x&nbsp;</a>
                                                <div>
                                                    <img src="{{asset($seller->photo) }}" width="60" alt="Image">
                                                </div>
                                            </div>
                                            <input type="hidden" id="deleted_image_model" name="deleted_image[model]" value="">
                                            <input type="hidden" id="deleted_image_field" name="deleted_image[field]" value="">
                                            <input type="hidden" id="deleted_image_id" name="deleted_image[id]" value="">
                                        @endif
                                    </div>

                                </div>

                                <div class="form-group col-6 pl-0">
                                    <label for="point_id"> Торговая точка </label>
                                    <select class="form-control @error('point_id') is-invalid @enderror" name="point_id" id="point_id">
                                        <option disabled selected value="" >Выберите торговую точку</option>
                                        @foreach($points as $point)
                                            @if(old('point_id') == $point->id)
                                                <option value="{{ old('point_id') }}" selected >{{ $point->name }}</option>
                                            @else
                                                <option value="{{ $point->id }}" {{ (isset($seller->point_id) && $seller->point_id == $point->id ) ? 'selected' : '' }}> {{ $point->name }} </option>
                                            @endif

                                        @endforeach
                                    </select>
                                    @error('point_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>



                                <div class="form-group">
                                    <label for="password">Пароль {{ isset($seller) ? '(не вводите пароль, чтобы он не менялся )' : '' }}</label>
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


                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"> <i class="far fa-save mr-2"></i>Сохранить пользователя </button>
                                    <a href="{{ route('admin.seller.index') }}" class="btn btn-info ml-2"> <i class="fas fa-sign-out-alt mr-2"></i>Отмена</a>
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
