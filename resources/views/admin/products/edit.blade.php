@section('title' ,'ویرایش محصول')
@component('admin.layouts.content' , ['title' => 'ویرایش محصول'])
    @slot('breadcrumbs')
        <ol class="breadcrumb float-sm-left">
            {{ Breadcrumbs::render('admin.products.edit', $product) }}
        </ol>
    @endslot
    <div class="card">

        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="{{ route('admin.products.update' , $product->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">نام محصول</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           id="inputEmail3" placeholder="نام محصول را وارد کنید" value="{{ $product->title }}">
                    <div class="mt-2">
                        @error('title')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">توضیحات</label>
                    <textarea type="text" rows="5" name="description" class="form-control @error('description') is-invalid @enderror"
                              id="inputEmail3">{{ $product->description }}</textarea>
                    <div class="mt-2">
                        @error('name')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">تعداد موجودی</label>
                    <input type="number" name="inventory" class="form-control @error('inventory') is-invalid @enderror"
                           id="inputEmail3" placeholder="تعداد موجودی محصول را وارد کنید" value="{{ $product->inventory }}">
                    <div class="mt-2">
                        @error('inventory')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">قیمت</label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                           id="inputEmail3" placeholder="تعداد موجودی محصول را وارد کنید" value="{{ $product->price }}">
                    <div class="mt-2">
                        @error('price')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info">ویرایش محصول</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-default float-left">لغو</a>
            </div>

            <!-- /.card-footer -->
        </form>
    </div>

@endcomponent
