@if ($errors->any())
<ul class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
   @foreach($errors->all() as $error)
        <li style="margin-left:15px">{{ $error }}</li>
    @endforeach
</ul>

@endif