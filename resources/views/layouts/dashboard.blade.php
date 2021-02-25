<x-app-layout>
    <x-slot name="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ url('dashboard') }}">dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('tow-factor-setting') ? 'active' : '' }}" aria-current="page" href="{{ url('tow-factor-setting') }}">tow factor</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
