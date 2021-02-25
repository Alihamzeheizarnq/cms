@section('title' ,'لیست کاربران')
@component('admin.layouts.content' , ['title' => 'لیست کاربران'])
    @slot('breadcrumbs')
        <ol class="breadcrumb float-sm-left">
            {{ Breadcrumbs::render('admin.users.index') }}
        </ol>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>کاربران</h4>
                    <div class="card-tools d-flex">
                        @can('create_user')
                            <div class="btn-group-sm ml-2">
                                <a href="{{ route('admin.users.create') }}" class="btn btn-info">ایجاد کاربر</a>
                            </div>
                        @endcan
                        @can('show_management')
                        <div class="btn-group-sm ml-2">
                            <a href="{{ request()->fullUrlWithQuery(['search'=>'website-management-users']) }}"
                               class="btn btn-warning">کاربران مدیریت</a>
                        </div>
                        @endcan
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
                            <th>شماره</th>
                            <th>کاربر</th>
                            <th>ایمیل</th>
                            <th>وضعیت ایمیل</th>
                            <th>اقدامات</th>

                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->email_verified_at)
                                        <span class="badge badge-success">تایید شده</span>
                                    @else
                                        <span class="badge badge-danger">تایید نشده</span>
                                    @endif
                                </td>
                                <td class="btn-sm">
                                    <div class="btn-group-sm d-flex">
                                        @can('delete_user')
                                            <form method="post"
                                                  action="{{ route('admin.users.destroy' , ['user' => $user->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" href="#" class="btn btn-sm btn-danger">حذف
                                                </button>

                                            </form>
                                        @endcan
                                        @can('edit_user')
                                            <form action="{{ route('admin.users.edit' , ['user' => $user->id]) }}">
                                                <button type="submit" href="#" class="btn btn-sm btn-primary">ویرایش
                                                </button>

                                            </form>
                                        @endcan
                                        @if($user->isStaffUser())
                                            <a href="{{ route('admin.user.permissions' ,['user'=>$user->id] ) }}"
                                               class="btn btn-sm btn-warning mr-1">اعمال دسترسی
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $users->render() }}

                </div>
            </div>
            <!-- /.card -->
        </div>


    </div>

@endcomponent
