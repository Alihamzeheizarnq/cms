@section('title' ,'لیست  نظرات')
@component('admin.layouts.content' , ['title' => 'لیست  نظرات'])
    @slot('breadcrumbs')
        <ol class="breadcrumb float-sm-left">
            {{ Breadcrumbs::render('admin.comments.index') }}
        </ol>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4> نظرات</h4>
                    <div class="card-tools d-flex">
                        {{--<div class="btn-group-sm ml-2">--}}
                            {{--<a href="{{ route('admin.users.create') }}" class="btn btn-info">ایجاد محصول</a>--}}
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
                            <th>آیدی کاربر</th>
                            <th>نام کاربر</th>
                            <th>ایمیل</th>
                            <th>تعداد نظرات</th>
                            <th>تعداد نظرات تایید نشده</th>
                            <th>اقدامات</th>

                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->comments->count()}}</td>
                                <td>{{ $user->comments()->where('approved' , 0)->count()}}</td>
                                <td class="btn-sm">
                                    <div class="btn-group-sm d-flex">

                                            <a  href="{{ route('admin.user.comment' , ['user'=>$user->id]) }}" class="btn btn-sm btn-success">مشاهده نظرات</a>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
{{--                    {{ $users->appends(['search' => request('search')])->render() }}--}}

                </div>
            </div>
            <!-- /.card -->
        </div>


    </div>

@endcomponent
