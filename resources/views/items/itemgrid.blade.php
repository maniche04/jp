
<?php if(isset($itemlist[0])) { ?>
<?php if (strlen($result)>0) {?>
<h3 class = 'ui small center aligned header brown'>{{$result}}</h3><br>
<?php } ?>
<div class="ui seven doubling special cards">

<?php foreach ($itemlist as $item) { ?>

<div class="ui brown <?php if(($item->selqty == 0) && ($item->currstock > 0)) { echo 'tobuy';} ?> card">


  <?php if ($item->currstock == 0) { ?>
          <div class="ui small orange top attached ribbon label">
        <i class="ban icon"></i>Out of Stock
      </div>


  <?php } else { ?>
    <?php if ($item->isnew == 1) { ?>
      <div class="ui small green top attached ribbon label">
        <i class="star icon"></i>Just Arrived
      </div>
  <?php } else { ?>
    <?php if ($item->ispromo == 1) { ?>
      <div class="ui small blue top attached ribbon label">
        <i class="down arrow icon"></i>{{$item->promodisc . '%'}} OFF
      </div>

    <?php } ?>

  <?php } ?>


  <?php } ?>
  
  <div class="centered small image blurring dimmable image">
      <div class="ui active dimmer itemcard">
        <div class="content">
          <div class="center">

          <?php if($item->currstock == 0) { ?>

              <div class="hidden content">
              <div calss = 'ui large header'>
                            <i class="large circular ban icon"></i><br><br>
</div>
                            </div>
              <div class="visible content">
  
              </div>

          <?php } elseif($item->selqty > 0) { ?>

            <h2><i class="large circular in cart icon"></i><br>{{$item->selqty}} PCS</h2>

            <div  itemid = '{{$item->id}}' class="ui small circular vertical animated inverted red rembtn button" tabindex="0">
              <div class="hidden content">Remove</div>
              <div class="visible content">
                <i class="ban icon"></i>
              </div>
            </div>





          <?php } else { ?>

            <div class="ui mini right aligned input">
            <input class = 'inputqty center aligned' id = 'item{{$item->id}}' type="number" maxqty = "{{$item->currstock}}" placeholder="Enter Quantity">
          </div>
            <br>
            <br>
            <div  itemid = '{{$item->id}}' class="ui vertical circular animated inverted addbtn green button" tabindex="0">
              <div class="hidden content">Add</div>
              <div class="visible content">
                <i class="add to cart icon"></i>
              </div>
            </div>

          <?php } ?>
          </div>
        </div>
      </div>

      <?php if (strlen($item->imgurl < 1)) { ?>
        <img src="{{asset($item->imgurl)}}">
      <?php } else { ?>
        <img src="{{asset('img/perfumes/noimage.png')}}">      
      <?php } ?>
    </div>
  <div class="content">

    {{$item->itemname}}
    <div class="meta">
      <span class="date">{{$item->brand}}</span>
    </div>
  </div>
  <div class="ui brown content segment">

      <i class="cubes icon"></i>
      <?php if ($item->currstock > 0) { echo $item->currstock; } else { echo '0';}?>

        <span class="right floated star">
      <i class="cash icon"></i>

      <?php if ($currency == 'AED') { ?>
        <?php if ($item->ispromo == 1) { ?>
            <b>AED {{number_format($item->aedprice * (1-($item->promodisc / 100)),2)}}</b>
        <?php } else { ?>
            <b>AED {{$item->aedprice}}</b>
        <?php } ?>     
      <?php } else { ?>
        <?php if ($item->ispromo == 1) { ?>
            <b>USD {{number_format($item->usdprice * (1-($item->promodisc / 100)),2)}}</b>
        <?php } else { ?>
            <b>USD {{$item->usdprice}}</b>
        <?php } ?>
      <?php } ?>
    </span>

  </div>
</div>

<?php } ?>
</div>
<?php } else { ?>
<div class = 'ui fluid basic segment'>
    <h2 class="ui center aligned icon brown header">
  <i class="circular warning icon"></i>
  Not Found
  <h3 class = 'ui small center aligned header brown'>The search keywords did not return any results.<br> Please try again.</h3><br>
</h2>


</div>
<?php } ?>

<script>

$('.tobuy.card .itemcard.dimmer').removeClass('active');

$('.tobuy.card .image').dimmer({
  on: 'hover'
});



</script>

<script>
  $('.addbtn').click(function(){
    var itemid = $(this).attr('itemid');
    var selqty = $('#item' + itemid).val();

    if (parseInt($('#item' + itemid).val()) > parseInt($('#item' + itemid).attr('maxqty'))) {
      $('#item' + itemid).parent().notify("Insufficient Stock",{ position:"top" });
    } else {
          if ($('#item' + itemid).val() < 0){
      $('#item' + itemid).parent().notify("Invalid Entry",{ position:"top" });
    } else {
          $.post( '<?php echo URL::to('/');?>' + '/cart/add', { _token : '{{csrf_token()}}', itemid: itemid, selqty: selqty})
      .done(function( data ) {
        refreshcart();
        reload();
        //alert(data);
    });
    }
    }



  

  }); 

  $('.rembtn').click(function(){
    var itemid = $(this).attr('itemid');

    $.post( '<?php echo URL::to('/');?>' + '/cart/remove', { _token : '{{csrf_token()}}', itemid: itemid})
      .done(function( data ) {
        refreshcart();
        reload();

    });  

  }); 
</script>