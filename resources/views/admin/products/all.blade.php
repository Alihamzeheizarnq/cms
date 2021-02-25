@section('title' ,'لیست  محصولات')
@component('admin.layouts.content' , ['title' => 'لیست  محصولات'])
    @slot('breadcrumbs')
        <ol class="breadcrumb float-sm-left">
            {{ Breadcrumbs::render('admin.products.index') }}
        </ol>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4> محصولات</h4>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm ml-2">
                            <a href="{{ route('admin.products.create') }}" class="btn btn-info">ایجاد محصول</a>
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
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>آیدی محصول</th>
                            <th>عنوان محصول</th>
                            <th>نام فروشنده</th>
                            <th>تعداد موجودی</th>
                            <th>تعداد بازدیدکننده ها</th>
                            <th>اقدامات</th>

                        </tr>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->user->name }}</td>
                                <td>{{ $product->inventory}}</td>
                                <td>{{ $product->view_count}}</td>

                                <td class="btn-sm">
                                    <div class="btn-group-sm d-flex">
                                        <form method="post"
                                              action="{{ route('admin.products.destroy' , ['product' => $product->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" href="#" class="btn btn-sm btn-danger">حذف</button>

                                        </form>
                                        <form action="{{ route('admin.products.edit' , ['product' => $product->id]) }}">
                                            <button type="submit" href="#" class="btn btn-sm btn-primary">ویرایش
                                            </button>

                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $products->appends(['search' => request('search')])->render() }}

                </div>
            </div>
            <!-- /.card -->
        </div>


    </div>

@endcomponent
