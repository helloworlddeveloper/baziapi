@include('admin.base.baseHead')
@include('admin.layer.adminHead')
<div class="row g-0" style="margin-top: 66px">
    <div class="col-6 col-md-4 col-lg-4 col-xl-2 col-xxl-1">
        @include('admin.layer.adminLeft')
    </div>
    <div style="padding: 0 24px" class="col-sm-6 col-md-8 col-lg-8 col-xl-10 col-xxl-11">
        @yield('content')
    </div>
</div>
@include('admin.base.baseFoot')
