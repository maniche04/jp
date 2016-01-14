@extends('layouts.app')

@section('content')
<div id = 'content'>

<div class = 'ui brown basic segment'>

<div class="ui fluid icon input">
<div class="ui small basic icon buttons">
  <button class="ui <?php if ($view == 'list') { echo 'active'; } ?> inverted brown button" id = 'gridlayout'><i class="block layout icon"></i></button>
  <button class="ui <?php if ($view == 'grid') { echo 'active'; } ?> brown inverted button" id = 'listlayout'><i class="sidebar icon"></i></button>
  </div>
  <input id = 'inputtext' type="text" placeholder="Search for items here..">
  <i class="search icon"></i>
</div>

        <div id ="pagecontainer" class="ui basic segment" style="min-height:100px">
            
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


      $('#listlayout').click(function(){

        $.get( '<?php echo URL::to('/');?>' + '/settings/setlayout/list').done(function( data ) {
            reload();
            $('#gridlayout').addClass('active');
            $('#listlayout').removeClass('active');
            //alert(data);
            });
      });

     $('#gridlayout').click(function(){
        $.get( '<?php echo URL::to('/');?>' + '/settings/setlayout/grid').done(function( data ) {
            reload();
            $('#gridlayout').removeClass('active');
            $('#listlayout').addClass('active');
            //alert(data);
            });
      });


        </script>


@endsection
