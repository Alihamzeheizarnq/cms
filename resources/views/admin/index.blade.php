@section('title' ,'داشبورد')
@component('admin.layouts.content' , ['title' => 'داشبورد'])
    @slot('breadcrumbs')
        <ol class="breadcrumb float-sm-left">
            {{ Breadcrumbs::render('dashboard') }}
        </ol>
    @endslot


@endcomponent
