@section('title' ,'لیست دسته بندی ها')
@section('style')
    <style>
        .list-group-item li {
            color: red;
            margin-right: 20px;
        }
        .list-group-item li li{
            color: black;
        }
    </style>
@endsection
@component('admin.layouts.content' , ['title' => 'لیست دسته بندی ها'])
    @slot('breadcrumbs')
        <ol class="breadcrumb float-sm-left">
            {{ Breadcrumbs::render('admin.categories.index') }}
        </ol>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>دسته بندی ها</h4>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm ml-2">
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-info">ایجاد دسته بندی</a>
                        </div>
                        <form action="" class="form-group">
                            <div class="input-group input-group-sm" style="width: 150px;">

                                <input type="text" name="search" class="form-control float-right"
                                       value="{{ request('search') }}" placeholder="جستجو">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
            @include('admin.layouts.categories' , ['categories' => $category])
            <!-- /.card-body -->
                <div class="card-footer">
                    {{--{{ $permissions->render() }}--}}

                </div>
            </div>
            <!-- /.card -->
        </div>


    </div>

@endcomponent
