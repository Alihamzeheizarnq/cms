@section('title' ,'ویرایش کاربر')
@component('admin.layouts.content' , ['title' => 'ویرایش کاربر'])
    @slot('breadcrumbs')
        <ol class="breadcrumb float-sm-left">
            {{ Breadcrumbs::render('admin.users.edit',$user) }}
        </ol>
    @endslot
    <div class="card">

        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="{{ route('admin.users.update' , ['user' => $user->id]) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">نام کاربر</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           id="inputEmail3" placeholder="نام کاربر را وارد کنید" value="{{ $user->name }}">
                    <div class="mt-2">
                        @error('name')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">ایمیل</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           id="inputEmail3" placeholder="ایمیل را وارد کنید" value="{{ $user->email }}">
                    <div class="mt-2">
                        @error('email')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">پسورد</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                           id="inputPassword3" placeholder="پسورد را وارد کنید" value="{{ old('password') }}">
                    <div class="mt-2">
                        @error('password')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">تکرار پسورد</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                           name="password_confirmation" id="inputPassword3" placeholder="تکرار پسوورد را وارد کنید"
                           value="{{ old('password') }}">
                    <div class="mt-2">
                        @error('password_confirmation')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                @if(! $user->markEmailAsVerified())
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck2" name="verify">
                        <label class="form-check-label" for="exampleCheck2">اکانت فعال باشد</label>
                    </div>
                @endif
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info">ورود</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-default float-left">لغو</a>
            </div>

            <!-- /.card-footer -->
        </form>
    </div>

@endcomponent
