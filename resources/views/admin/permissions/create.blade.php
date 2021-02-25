@section('title' ,'ایجاد دسترسی')
@component('admin.layouts.content' , ['title' => 'ایجاد دسترسی'])
    @slot('breadcrumbs')
        <ol class="breadcrumb float-sm-left">
            {{ Breadcrumbs::render('admin.permissions.create') }}
        </ol>
    @endslot
    <div class="card">

        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="{{ route('admin.permissions.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">نام دسترسی</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           id="inputEmail3" placeholder="نام دسترسی را وارد کنید" value="{{ old('name') }}">
                    <div class="mt-2">
                        @error('name')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">توضیحات</label>
                    <input type="text" name="label" class="form-control @error('label') is-invalid @enderror"
                           id="inputEmail3" placeholder="توضیحات دسترسی را وارد کنید" value="{{ old('label') }}">
                    <div class="mt-2">
                        @error('label')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info">ایجاد</button>
                <a href="{{ route('admin.permissions.index') }}" class="btn btn-default float-left">لغو</a>
            </div>

            <!-- /.card-footer -->
        </form>
    </div>

@endcomponent
