
@extends('layouts.app')
@section('content')
<div id = 'content'>
<br>
<br>

<div class="ui indicating big progress" id="itemprogress">
  <div class="bar"></div>
  <div id = "thelabel" class="label">Uploading Data...</div>
</div>

</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
  var startreading = function(){
    $.ajax({
      url: "{{url('/admin/items/read') . "/" .$filename}}",
      success: function(data) {
        console.log(data);
      }
    });
  };

  var getprogress = function(){
    $.ajax({
      url: "{{url('/admin/getprogress/items')}}",
      success: function(data) {
        console.log(data);
        $('#itemprogress').progress({percent: data});
        $('#thelabel').html(data + '% Uploaded');
        return data;
      }
    });
  };

  var checkprogress = function(){
    if(getprogress() < 100){
        checkprogress();
    } else {
        $('#thelabel').html('Upload Complete!');
    }
  };

  startreading();
  setTimeout(function(){
    checkprogress();
  }, 500);


</script>

@endsection




