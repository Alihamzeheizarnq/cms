
@section('title' ,'ثبت مقام')
@component('admin.layouts.content' , ['title' => 'ثبت مقام'])
    @slot('breadcrumbs')
        <ol class="breadcrumb float-sm-left">
            {{ Breadcrumbs::render('admin.users.permission' , $user) }}
        </ol>
    @endslot
    <div class="card">

        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="{{ route('admin.user.permissions.store' ,['user'=>$user->id]) }}">
            @csrf

                <div class="form-group">
                    <label>دسترسی ها</label>
                    <select name="permissions[]" multiple class="form-control">
                        @foreach(\App\Models\Permission::all() as $permission)

                            <option value="{{$permission->id}}" {{ in_array($permission->id,$user->permissions()->pluck('id')->toArray() ) ? 'selected' : ''}}>{{ $permission->name  }} - {{ $permission->label }}</option>

                        @endforeach
                    </select>
                    <div class="mt-2">
                        @error('permissions')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>مقام ها</label>
                    <select name="roles[]" multiple class="form-control">
                        @foreach(\App\Models\Role::all() as $role)

                            <option value="{{$role->id}}" {{ in_array($role->id, $user->roles()->pluck('id')->toArray() ) ? 'selected' : ''}}>{{ $role->name  }} - {{ $role->label }}</option>

                        @endforeach
                    </select>
                    <div class="mt-2">
                        @error('permissions')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>




            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info">اعمال</button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-default float-left">لغو</a>
            </div>

            <!-- /.card-footer -->
        </form>
    </div>

@endcomponent
