@extends('home.master')

@section('content')
    @php($show = 1)
    <section id="form"><!--form-->

        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <input type="email" name="email" placeholder="email ..." />
                            <input type="password" name="password" placeholder="password" />
                            <span>
								<input type="checkbox" class="checkbox" name="remember">
								remember
							</span>
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <input type="text" name="name" placeholder="Name"/>
                            <input type="email" name="email" placeholder="Email Address"/>
                            <input type="password" name="password" placeholder="Password"/>
                            <input type="password" name="password_confirmation" placeholder="Password_confirm"/>
                            <button type="submit" class="btn btn-default">register</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection
