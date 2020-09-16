<div class="card" style="text-align: center">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <a
                    @if(Route::currentRouteName() === 'admin.home')
                    class="text-danger" style="font-weight: bold"
                    @endif

                    href="{{route('admin.home')}}"> 概况 </a>
        </li>
        <li class="list-group-item">
            <a
                    @if(Route::currentRouteName() === 'admin.list')
                    class="text-danger" style="font-weight: bold"
                    @endif
                    href="{{route('admin.list')}}">用户列表</a>
        </li>
        <li class="list-group-item">
            留言列表
        </li>
    </ul>
</div>