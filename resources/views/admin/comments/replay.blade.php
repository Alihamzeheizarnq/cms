@section('title' ,'پاسخ به نظر')
@component('admin.layouts.content' , ['title' => 'پاسخ به نظر'])
    @slot('breadcrumbs')
        <ol class="breadcrumb float-sm-left">
            {{ Breadcrumbs::render('admin.comments.replay' , $comment) }}
        </ol>
    @endslot
    <div class="card">

        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="{{ route('admin.comments.replay', ['comment'=>$comment]) }}">
            @csrf
            <div class="card-body">
                <div class="row">
                    {{ $comment->comment }}
                </div>
                <hr>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">پاسخ</label>
                    <textarea type="text" name="comment" class="form-control @error('comment') is-invalid @enderror"
                              id="inputEmail3"></textarea>
                    <div class="mt-2">
                        @error('comment')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info">ثبت </button>
            </div>

            <!-- /.card-footer -->
        </form>
    </div>

@endcomponent
