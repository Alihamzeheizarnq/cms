@extends('layouts.dashboard')


@section('content')
    @if($errors->any())
        <div class="mb-2">
            @foreach($errors->all() as $error)
                <span class="text-danger">{{ $error }}</span>
            @endforeach
        </div>

    @endif
    <form class="row g-3" method="post" action="{{ route('tow-factor') }}">

        @csrf
        <div class="form-check">
            <input class="form-check-input" name="type" type="radio" value="off" id="flexCheckDefault"
                {{ auth()->user()->type_factor == 'off' || old('type') == 'off' ? 'checked' : '' }}
            >
            <label class="form-check-label" for="flexCheckDefault">
                off
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" name="type" type="radio" value="sms" id="flexCheckChecked"
                {{ auth()->user()->type_factor == 'sms' || old('type') == 'sms' ? 'checked' : '' }}
            >
            <label class="form-check-label" for="flexCheckChecked">
                sms
            </label>
        </div>
        <hr>
        <div class="col-auto">
            <label for="inputPassword2" class="visually-hidden">phone</label>
            <input type="number" class="form-control" id="inputPassword2" name="phone" placeholder="phone 0912..."
                   value="{{ auth()->user()->phone_number ?? old('phone') }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">update</button>
        </div>
    </form>

@endsection
