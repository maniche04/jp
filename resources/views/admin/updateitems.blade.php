@extends('layouts.app')

@section('content')
<div id = 'content'>
  <div class = 'ui basic container' id = 'uploadform'> 
  <form id="form1" action="<?php echo URL::to('/') . '/admin/items/upload'?>" method="post" enctype="multipart/form-data">
  {!! csrf_field() !!}
    <input id="file" type="file" name="file" />
    <input class = 'ui green button ' id="submit" type="submit" value="Upload"/>
</form> 
</div>
<br>
<br>


@endsection
