@section('title' ,'لیست  نظرات')
@component('admin.layouts.content' , ['title' => 'مدیریت نظرات کاربر'])
    @slot('breadcrumbs')
        <ol class="breadcrumb float-sm-left">
            {{ Breadcrumbs::render('admin.comments.user' , $user) }}
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
                            <th>شماره نظر</th>
                            <th>نظر</th>
                            <th>نظر مربوطه</th>
                            <th>وضعیت</th>
                            <th>اقدامات</th>

                        </tr>
                        @foreach($comments as $comment)
                            <tr>
                                <td>{{ $comment->id }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($comment->comment) }}</td>
                                <td>{{ $comment->commentable->title }} - {{ $comment->commentable->id }}</td>
                                <td>
                                @if($comment->approved == 1)
                                        <div class="btn-group-sm d-flex">

                                            <button class="btn btn-sm btn-success">تایید شده</button>

                                        </div>
                                    @else
                                        <div class="btn-group-sm d-flex">

                                            <button class="btn btn-sm btn-danger">تایید نشده</button>

                                        </div>
                                    @endif
                                </td>
                                <td class="btn-sm">
                                    <div class="btn-group-sm d-flex">
                                        <form method="post"
                                              action="{{ route('admin.comments.destroy' , ['comment' => $comment->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" href="#" class="btn btn-sm btn-danger">حذف</button>

                                        </form>
                                        <form action="{{ route('admin.comments.edit' , ['comment' => $comment->id]) }}">
                                            <button type="submit" href="#" class="btn btn-sm btn-primary">ویرایش
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.comments.show' , ['comment' => $comment->id]) }}">
                                            <button type="submit" href="#" class="btn btn-sm btn-warning">پاسخ دادن
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.comments.approved' , ['comment' => $comment->id]) }}">
                                            <button type="submit" href="#" class="btn btn-sm btn-secondary">تایید نظر
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
{{--                    {{ $comments->appends(['search' => request('search')])->render() }}--}}

                </div>
            </div>
            <!-- /.card -->
        </div>


    </div>

@endcomponent
