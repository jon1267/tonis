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
                            <h5 class="m-0"> Промокоды </h5>
                            {{--<a href="{{ route('admin.promocode.create') }}" class="btn btn-primary ml-4">
                                Добавить точку
                            </a>--}}
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
                                    <th>Дата активации</th>
                                    <th>Действия</th>
                                </tr>

                                @foreach($promocodes as $promocode)
                                    <tr>
                                        <td>{{$promocode->id}}</td>
                                        <td>{{$promocode->code}}</td>
                                        <td>{{$promocode->percent}}</td>
                                        <td>{{$promocode->phone}}</td>
                                        <td>{{$promocode->created_at}}</td>
                                        <td>{{$promocode->activated_at}}</td>
                                        <td>

                                            <form action="{{ route('admin.promocode.destroy', $promocode) }}" class="form-inline " method="POST" id="promocode-delete-{{$promocode->id}}">
                                                <div class="form-group">
                                                    {{-- ссылка независима, к форме не привязана, просто чтоб кнопы были в строку --}}
                                                    <a href="{{ route('admin.promocode.edit', $promocode) }}" class="btn btn-primary btn-sm mr-1" title="Редактировать промокод"> <i class="fas fa-pen"></i> </a>

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm" href="#" role="button" title="Удалить промокод"
                                                            onclick="confirmDelete('{{$promocode->id}}', 'promocode-delete-')" >
                                                        <i class="fas fa-trash" ></i>
                                                    </button>
                                                </div>
                                            </form>
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

