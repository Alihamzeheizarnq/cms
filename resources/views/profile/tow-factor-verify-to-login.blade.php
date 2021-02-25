<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('verify-tow-refactor') }}">
            @csrf
            <div class="col-auto mt-5">
                <label for="inputPassword2" class="visually-hidden">Code pleas</label>
                <input type="number" class="form-control" id="inputPassword2" name="token" placeholder="code..."
                       value="{{ old('token') }}">
            </div>
            <div class="col-auto m-2">
                <button type="submit" class="btn btn-success mb-3">verify</button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
