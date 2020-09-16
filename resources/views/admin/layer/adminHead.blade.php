<nav class="navbar navbar-light bg-light fixed-top">
    <div class="container-fluid shadow-sm">
        <a class="navbar-brand" href="#">
            管理后台 {{Auth::guard('admin')->user()->username}}
            <a href="{{route('admin.logout')}}">logout</a>
        </a>
    </div>
</nav>
