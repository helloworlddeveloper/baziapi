@include('admin.base.baseHead')
<style>
    .login-row {
        min-height: 39rem;
    }
</style>
<div class="container">
    <div class="row align-items-center login-row">
        <div class="col">
        </div>
        <div class="col">
            <form method="post" action="{{route('admin.home')}}">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" name="username">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col">
        </div>
    </div>
</div>
@include('admin.base.baseFoot')
