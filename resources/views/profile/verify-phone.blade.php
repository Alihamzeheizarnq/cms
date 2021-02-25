<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                @if($errors->any())
                        <div class="mb-2">
                            @foreach($errors->all() as $error)
                                <span class="text-danger">{{ $error }}</span>
                            @endforeach
                        </div>

                    @endif
                    <form class="row g-3" method="post" action="{{ route('verify-token') }}">

                        @csrf
                        <div class="col-auto">
                            <label for="inputPassword2" class="visually-hidden">phone</label>
                            <input type="number" class="form-control" id="inputPassword2" name="token" placeholder="code..."
                                   value="{{ old('token') }}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success mb-3">verify</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
