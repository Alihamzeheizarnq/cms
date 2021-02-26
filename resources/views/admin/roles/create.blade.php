
@section('title' ,'ایجاد مقام')
@component('admin.layouts.content' , ['title' => 'ایجاد مقام'])
    @slot('breadcrumbs')
        <ol class="breadcrumb float-sm-left">
            {{ Breadcrumbs::render('admin.roles.create') }}
        </ol>
    @endslot
    <div class="card">

        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="{{ route('admin.roles.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">نام مقام</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           id="inputEmail3" placeholder="نام مقام را وارد کنید" value="{{ old('name') }}">
                    <div class="mt-2">
                        @error('name')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
  <div class="form-group">
                    <label>دسترسی ها</label>
                    <select name="permissions[]" multiple class="form-control">
                        @foreach($permissions as $permission)

                            <option value="{{$permission->id}}">{{ $permission->name  }} - {{ $permission->label }}</option>

                        @endforeach
                    </select>
                    <div class="mt-2">
                        @error('permissions')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
              

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">توضیحات</label>
                    <input type="text" name="label" class="form-control @error('label') is-invalid @enderror"
                           id="inputEmail3" placeholder="توضیحات مقام را وارد کنید" value="{{ old('label') }}">
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
                <a href="{{ route('admin.roles.index') }}" class="btn btn-default float-left">لغو</a>
            </div>

            <!-- /.card-footer -->
        </form>
    </div>

@endcomponent
