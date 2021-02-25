@section('title' ,'ویرایش دسته بندی')
@component('admin.layouts.content' , ['title' => 'ویرایش دسته بندی'])
    @slot('breadcrumbs')
        <ol class="breadcrumb float-sm-left">
            {{ Breadcrumbs::render('admin.categories.edit' , $category) }}
        </ol>
    @endslot
    <div class="card">

        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="{{ route('admin.categories.update' , $category->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">نام دسته بندی</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           id="inputEmail3" placeholder="نام دسته بندی را وارد کنید" value="{{ old('name' , $category->name) }}">
                    <div class="mt-2">
                        @error('name')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                    <div class="form-group">
                        <label>دسته بندی مرتبط</label>
                        <select name="parent"  class="form-control">
                            <option value="0" {{  $category->parent == 0  ? 'selected' : ''}}>سردسته</option>

                        @foreach(\App\Models\Category::all() as $cate)
                                @php
                                    if ($cate->id == $category->id){
                                        continue;
                                    }
                                @endphp
                                <option value="{{$cate->id}}" {{ $cate->id == $category->parent  ? 'selected' : ''}}>{{ $cate->name  }}</option>

                            @endforeach
                        </select>
                        <div class="mt-2">
                            @error('category')
                            <span class="alert text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>



            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info">ویرایش</button>
            </div>

            <!-- /.card-footer -->
        </form>
    </div>

@endcomponent
