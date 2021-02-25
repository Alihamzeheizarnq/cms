@section('title' ,'ویرایش نظر')
@component('admin.layouts.content' , ['title' => 'ویرایش نظر'])
    @slot('breadcrumbs')
        <ol class="breadcrumb float-sm-left">
            {{ Breadcrumbs::render('admin.comments.edit', $comment) }}
        </ol>
    @endslot
    <div class="card">

        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="{{ route('admin.comments.update' , $comment->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"> نظر</label>
                    <input type="text" name="comment" class="form-control @error('comment') is-invalid @enderror"
                           id="inputEmail3" value="{{ $comment->comment }}">
                    <div class="mt-2">
                        @error('comment')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info">ویرایش نظر</button>
            </div>

            <!-- /.card-footer -->
        </form>
    </div>

@endcomponent
