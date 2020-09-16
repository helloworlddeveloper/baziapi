@extends('admin.base.base')
@section('content')

    @if(Route::currentRouteName() === 'admin.home')
        @include('admin.home.adminInfo')
    @endif

    @if(Route::currentRouteName() === 'admin.list')
        @include('admin.home.adminUserList')
    @endif

@endsection