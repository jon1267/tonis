@extends('adminlte.admin')

@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <!-- /.col-md-6 -->
                <!-- class="col-10 mx-auto"  -->
                <div class="col-md-8 col-sm-12 mx-auto">
                    <div class="card ">
                        <div class="card-header d-flex align-items-baseline ">
                            <!--<h5 class="m-0"> Промокоды </h5>-->

                            <!--<div>-->
                                <form  action="{{ route('admin.promocode.filter') }}" method="post">
                                    <div class="input-group input-group-sm">

                                        @csrf

                                        <input type="text" name="code" class="form-control float-right mr-2" placeholder="Промокод">
                                        <input type="text" name="phone" class="form-control float-right mr-2" placeholder="Телефон">

                                        <!-- Date -->
                                        <div class="form-group input-group-sm mr-2">
                                            <!--<label>Date:</label>-->
                                            <div class="input-group input-group-sm date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" name="date_from" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="Дата от"/>
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group input-group-sm mr-2">
                                            <!--<label>Date:</label>-->
                                            <div class="input-group input-group-sm date" id="reservationdate1" data-target-input="nearest">
                                                <input type="text" name="date_to" class="form-control datetimepicker-input" data-target="#reservationdate1" placeholder="Дата до"/>
                                                <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group input-group-sm">
                                            <div class="input-group input-group-sm " >
                                                <select name="point_id" id="point_id" class="form-control">
                                                    <option disabled selected value="" >Фильтр по точкам</option>
                                                    @foreach($points as $point)
                                                        <option value="{{ $point->id }}">{{ $point->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append" >
                                                    <button type="submit" class="btn btn-default " title="Фильтровать">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                    <a href="{{ route('admin.promocode.index') }}" class="btn btn-default " title="сбросить фильтр"><i class="fas fa-times" style="color: red;"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            <!--</div>-->

                        </div>
                        <div class="card-body table-responsive p-0">

                            <!--<table class="table table-bordered table-striped table-sm " id="table">-->
                            <table class="table table-hover " id="table">
                                <tr>
                                    <th>ID</th>
                                    <th>Код</th>
                                    <th>Процент</th>
                                    <th>Телефон</th>
                                    <th>Дата создания</th>
                                    <th>Активация</th>
                                    <th>Действия</th>
                                </tr>

                                @foreach($promocodes as $promocode)
                                    <tr>
                                        <td>{{$promocode->id}}</td>
                                        <td>{{$promocode->code}}</td>
                                        <td>{{$promocode->percent}}</td>
                                        <td>{{$promocode->phone}}</td>
                                        <td>{{$promocode->created_at}}</td>
                                        <td>
                                            @if(isset($promocode->activated_at) && !is_null($promocode->activated_at))
                                                <span class="badge badge-pill text-white" style="background: #008000" >Активирован</span>
                                            @elseif(!is_null($promocode->created_at) && (Carbon\Carbon::now() > Carbon\Carbon::create($promocode->created_at)->addHours(24)))
                                                <span class="badge badge-pill text-white" style="background: #808080" >Время вышло</span>
                                            @else
                                                <span class="badge badge-pill text-white" style="background: #808080" >Не активирован</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.promocode.show', $promocode) }}" class="btn btn-primary btn-sm ml-3" title="Просмотр промокода"> <i class="fas fa-eye"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            <div class="mt-3">
                                @if($promocodes->hasPages())
                                    {{ $promocodes->links() }}
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

