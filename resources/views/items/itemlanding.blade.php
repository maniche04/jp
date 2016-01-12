@extends('layouts.app')

@section('content')
<div id = 'content'>

<div class = 'ui segment'>
<div class="ui fluid icon input">
  <input id = 'inputtext' type="text" placeholder="Search for items here..">
  <i class="search icon"></i>
</div>

        <div id ="pagecontainer" class="ui blue segment" style="min-height:100px">
            
            <div class="ui active pagedata inverted dimmer">
                <div class="ui text loader">Loading</div>
            </div>
            <p></p>
            
        </div>

</div>




</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="{{asset('sui/semantic.min.js')}}"></script>
<script>

$('.tobuy.card .image').dimmer({
  on: 'hover'
});
</script>
    <script>
        var contentloader = function (link, target, callback) {
            var dimmer = $(target).html();
            $(target).html(dimmer);            
            $.get('<?php echo URL::to('/');?>' + "/" + link , function(data){      
                $(target).html(data);
                $('.active.dimmer').removeClass('active');
                callback(data);
            });
        }
    </script>

            <script>
        var dimmer = $('#pagecontainer').html();
        </script>
        <script>
        var reload = function(){
            contentloader('items/search?hotkey=' + $('#inputtext').val(),'#pagecontainer',function(data){
                $('.dropdown').dropdown();
              
            });  
        };            
  
        $('#inputtext').keypress(function (e) {
  if (e.which == 13) {
    reload();
  }
});
      reload();
        </script>


@endsection
