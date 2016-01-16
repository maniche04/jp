@extends('layouts.app')

@section('content')
<div id = 'content'>
<div class="ui teal progress" data-percent="{{$proglevel}}" id="example1">
  <div class="bar"></div>
  <div class="label">Updating Items</div>
</div>

</div>
@endsection
