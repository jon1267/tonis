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
                            <h5 class="m-0"> Троговые точки </h5>
                            <a href="{{ route('admin.point.create') }}" class="btn btn-primary ml-4">
                                Добавить точку
                            </a>
                        </div>
                        <div class="card-body table-responsive p-0">

                            <!--<table class="table table-bordered table-striped table-sm " id="table">-->
                            <table class="table table-hover " id="table">
                                <tr>
                                    <th>ID</th>
                                    <th>Наименование</th>
                                    <th>Адрес</th>
                                    <th>Телефон</th>
                                    <th>Ссылка</th>
                                    <th>QR код</th>
                                    <th>Действия</th>
                                </tr>

                                @foreach($points as $point)
                                    <tr>
                                        <td>{{$point->id}}</td>
                                        <td>{{$point->name}}</td>
                                        <td>{{$point->address}}</td>
                                        <td>{{$point->phone}}</td>
                                        <td><a class="btn btn-primary btn-sm" target="_blank" href="{{ route('point.front', [$point->hash]) }}">Ссылка</a></td>
                                        <td><a class="btn btn-primary btn-sm" target="_blank" href="https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl={{ route('point.front', [$point->hash]) }}">QR код</a></td>
                                        <td>
                                            <form action="{{ route('admin.point.destroy', $point) }}" class="form-inline " method="POST" id="point-delete-{{$point->id}}">
                                                <div class="form-group">
                                                    {{-- ссылка независима, к форме не привязана, просто чтоб кнопы были в строку --}}
                                                    <a href="{{ route('admin.point.edit', $point) }}" class="btn btn-primary btn-sm mr-1" title="Редактировать торговую точку"> <i class="fas fa-pen"></i> </a>

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm" href="#" role="button" title="Удалить фоп"
                                                            onclick="confirmDelete('{{$point->id}}', 'point-delete-')" >
                                                        <i class="fas fa-trash" ></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            <div class="mt-3">
                                @if($points->hasPages())
                                    {{ $points->links() }}
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

