


<?php if(isset($itemlist[0])) { ?>
<div class="ui seven doubling special cards">

<?php foreach ($itemlist as $item) { ?>

<div class="ui brown <?php if($item->selqty == 0) { echo 'tobuy';} ?> card">
  <?php if ($item->isnew == 1) { ?>
      <div class="ui bottom small green ribbon label">
        <i class="star icon"></i>Newly Arrived
      </div>
  <?php } else { ?>
    <?php if ($item->ispromo == 1) { ?>
      <div class="ui bottom small orange ribbon label">
        <i class="down arrow icon"></i>{{$item->promodisc . '%'}} OFF
      </div>
    <?php } ?>

  <?php } ?>
  <div class="centered small image blurring dimmable image">
      <div class="ui active dimmer">
        <div class="content">
          <div class="center">
          <?php if($item->selqty > 0) { ?>

            <h2>{{$item->selqty}} PCS</h2>
            <br>
            <br>
            <div class="ui inverted red button">Remvove</div>

          <?php } else { ?>

            <div class="ui mini right aligned input">
            <input id = 'item{{$item->id}}' type="number" placeholder="Enter Quantity Here">
          </div>
            <br>
            <br>
            <div itemid = '{{$item->id}}' class="ui inverted green addbtn button">Add</div>
          <?php } ?>
          </div>
        </div>
      </div>
      <img src="{{asset($item->imgurl)}}">
    </div>
  <div class="content">

    {{$item->itemname}}
    <div class="meta">
      <span class="date">{{$item->brand}}</span>
    </div>
  </div>
  <div class="ui extra content segment">

      <i class="cubes icon"></i>
      <?php if ($item->currstock > 0) { echo $item->currstock; } else { echo '0';}?>

        <span class="right floated star">
      <i class="cash icon"></i>
      <b>AED {{$item->aedprice}}</b>
    </span>

  </div>
</div>

<?php } ?>
</div>
<?php } else { ?>
    <h2 class="ui icon header">
  <i class="warning icon"></i>
  <div class="content">
    Oops..
    <div class="sub header">The keyword you typed did not generate any results. Try again!</div>
  </div>
</h2>
<?php } ?>

<script>

$('.tobuy.card .image').dimmer({
  on: 'hover'
});
</script>

<script>
  $('.addbtn').click(function(){
    var itemid = $(this).attr('itemid');
    var selqty = $('#item' + itemid).val();

    $.post( '<?php echo URL::to('/');?>' + '/cart/add', { itemid: itemid, selqty: selqty})
      .done(function( data ) {
        alert(data);
    });  

  }); 
</script>