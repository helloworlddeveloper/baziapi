<table class="table table-responsive table-hover">
    <thead class="thead-light">
    <tr>
        <th scope="col">id</th>
        <th scope="col">logo</th>
        <th scope="col">username</th>
        <th scope="col">email</th>
        <th scope="col">user_type</th>
        <th scope="col">created_at</th>
        <th scope="col">is_activity</th>
        <th scope="col">ip</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($all as $list)
        <tr>
            <th scope="row">{{$list->id}}</th>
            <td>
                <img class="gravatar" src="
                @if($list->logo)
                {{$list->logo}}
                @else
                {{URL::asset('img/gravatar.png')}}
                @endif
                        " alt="">

            </td>
            <td>{{$list->username}}</td>
            <td>{{$list->email}}</td>
            <td>{{$list->user_type}}</td>
            <td>{{$list->created_at}}</td>
            <td>{{$list->is_activity}}</td>
            <td>{{$list->ip}}</td>
            <td>
                <button type="button" class="btn btn-primary">编辑</button>
                　
                <button type="button" class="btn btn-dark">删除</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div style="margin:30px 0;height:60px;min-width:300px;text-align: center">
    <nav aria-label="...">
        <ul class="pagination">
            {{ $all->links() }}
        </ul>
    </nav>
</div>