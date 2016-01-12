@extends('layouts.app')

@section('content')
<div id = 'content'>
<div class = 'ui segment'>
    <div class="ui top small green ribbon label">
        <i class="star icon"></i> Just Arrived
      </div>
      <br>
      <br>
<div class="ui eight doubling cards">
<div class="ui brown card">

  <div class="ui centered small image">
    <img src="{{asset('img/perfumes/coolwater.jpg')}}">
  </div>
  <div class="content">
    D.DOFF COOL WATER (M) EDT 100ml
    <div class="meta">
      <span class="date">DAVIDOFF</span>
    </div>
  </div>
  <div class="extra content">
    <a>
      <i class="cubes icon"></i>
      1,200
    </a>
        <span class="right floated star">
      <i class="cart icon"></i>
      Add
    </span>
  </div>
</div>

</div>
</div>
<div class = 'ui segment'>
    <div class="ui top small teal ribbon label">
        <i class="down arrow icon"></i> Special Price
      </div>
      <br>
      <br>
<div class="ui eight doubling cards">
<div class="ui brown card">

  <div class="ui centered small image">
    <img src="{{asset('img/perfumes/coolwater.jpg')}}">
  </div>
  <div class="content">
    D.DOFF COOL WATER (M) EDT 100ml
    <div class="meta">
      <span class="date">DAVIDOFF</span>
    </div>
  </div>
  <div class="extra content">
    <a>
      <i class="cubes icon"></i>
      1,200
    </a>
        <span class="right floated star">
      <i class="cart icon"></i>
      Add
    </span>
  </div>
</div>

</div>
</div>
</div>
@endsection
