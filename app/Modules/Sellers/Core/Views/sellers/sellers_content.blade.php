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
                        <div class="card-header ">
                            <div class="d-flex align-items-baseline justify-content-between">
                                <div>
                                    <span class="h5 m-0">Продавцы</span>
                                    <a href="{{ route('admin.seller.create') }}" class="btn btn-primary ml-4">
                                        Добавить продавца
                                    </a>
                                </div>

                                <div>
                                    <form  action="{{ route('admin.seller.filter') }}" method="post">
                                    <div class="input-group input-group-sm " style="width: 210px; ">

                                        @csrf
                                        <!--<input type="text" name="table_search" class="form-control float-right" placeholder="Search">-->
                                        <select name="point_id" id="point_id" class="form-control float-right">
                                            <option disabled selected value="" >Фильтр по точкам</option>
                                            @foreach($points as $point)
                                                <option value="{{ $point->id }}">{{ $point->name }}</option>
                                            @endforeach
                                        </select>

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default" title="Фильтровать">
                                                <i class="fas fa-search"></i>
                                            </button>
                                            {{--<a href="{{ route('admin.seller.index') }}" class="badge badge-danger p-2" title="сбросить фильтр">&nbsp;x&nbsp;</a>--}}
                                            <a href="{{ route('admin.seller.index') }}" class="btn btn-default" title="сбросить фильтр"><i class="fas fa-times" style="color: red;"></i></a>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                        <div class="card-body table-responsive p-0 ">

                            <table class="table table-hover " id="table">
                                <tr>
                                    <th>ID</th>
                                    <th>Имя</th>
                                    <th>Email</th>
                                    <th>Телефон</th>
                                    <th>Фото</th>
                                    <th>Действия</th>
                                </tr>

                                @foreach($sellers as $seller)
                                    <tr>
                                        <td>{{$seller->id}}</td>
                                        <td>{{$seller->name}}</td>
                                        <td>{{$seller->email}}</td>
                                        <td>{{$seller->phone}}</td>
                                        <td>
                                            @if(!empty($seller->photo))
                                                <img src="{{asset($seller->photo) }}" height="50"  alt="image">
                                            @endif
                                        </td>
                                        <td>

                                            <form action="{{ route('admin.seller.destroy', $seller) }}" class="form-inline " method="POST" id="seller-delete-{{$seller->id}}">
                                                <div class="form-group">
                                                    {{-- ссылка независима, к форме не привязана, просто чтоб кнопы были в строку --}}
                                                    <a href="{{ route('admin.seller.edit', $seller) }}" class="btn btn-primary btn-sm mr-1" title="Редактировать продавца"> <i class="fas fa-pen"></i> </a>

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm" href="#" role="button" title="Удалить продавца"
                                                            onclick="confirmDelete('{{$seller->id}}', 'seller-delete-')" >
                                                        <i class="fas fa-trash" ></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            <div class="mt-3">
                                @if($sellers->hasPages())
                                    {{ $sellers->links() }}
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
