@section('title' ,'لیست مقام ها')
@component('admin.layouts.content' , ['title' => 'لیست مقام ها'])
    @slot('breadcrumbs')
        <ol class="breadcrumb float-sm-left">
            {{ Breadcrumbs::render('admin.roles.index') }}
        </ol>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>مقام ها</h4>
                    <div class="card-tools d-flex">
                        <div class="btn-group-sm ml-2">
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-info">ایجاد مقام</a>
                        </div>
                        {{--<div class="btn-group-sm ml-2">--}}
                            {{--<a href="{{ request()->fullUrlWithQuery(['search'=>'website-management-userss']) }}" class="btn btn-warning">کاربران مدیریت</a>--}}
                        {{--</div>--}}
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
                            <th>نام مقام</th>
                            <th>توضیحات</th>
                            <th>اقدامات</th>

                        </tr>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->label }}</td>

                                <td class="btn-sm">
                                    <div class="btn-group-sm d-flex">
                                        <form method="post"
                                              action="{{ route('admin.roles.destroy' , ['role' => $role->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" href="#" class="btn btn-sm btn-danger">حذف</button>

                                        </form>
                                        <form action="{{ route('admin.roles.edit' , ['role' => $role->id]) }}">
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
                    {{--{{ $roles->render() }}--}}

                </div>
            </div>
            <!-- /.card -->
        </div>


    </div>

@endcomponent
