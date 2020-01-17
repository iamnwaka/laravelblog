<form method="post" action="{{url('/deletePost', array($post)) }}" enctype="multipart/form-data" class="float-left">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div>
        <button type="submit" class="btn btn-warning">Delete</button>
    </div>
</form>
<div class="clearfix"></div>