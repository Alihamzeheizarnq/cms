@section('title' ,'ایجاد دسته بندی')
@component('admin.layouts.content' , ['title' => 'ایجاد دسته بندی'])
    @slot('breadcrumbs')
        <ol class="breadcrumb float-sm-left">
            {{ Breadcrumbs::render('admin.categories.create') }}
        </ol>
    @endslot
    <div class="card">

        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="{{ route('admin.categories.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">نام دسته بندی</label>
                    <input type="text" name="category" class="form-control @error('category') is-invalid @enderror"
                           id="inputEmail3" placeholder="نام دسته بندی را وارد کنید" value="{{ old('category') }}">
                    <div class="mt-2">
                        @error('category')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @if(request('parent') and $parent = \App\Models\Category::find(request('parent')))
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">دسته مرتبط</label>
                    <input type="text" class="form-control" id="inputEmail3" value="{{ $parent->name }}" disabled>
                    <input type="hidden" name="parent" class="form-control" id="inputEmail3" value="{{ $parent->id }}">
                </div>
                @endif

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info">ایجاد</button>
            </div>

            <!-- /.card-footer -->
        </form>
    </div>

@endcomponent
