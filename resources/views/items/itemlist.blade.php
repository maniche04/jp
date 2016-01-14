<?php if(isset($itemlist[0])) { ?>
	<?php if (strlen($result)>0) {?>
	<h3 class = 'ui small center aligned header brown'>{{$result}}</h3><br>
	<?php } ?>





<table class="ui fluid stacked table">
  <thead class = 'ui brown'>
    <tr>
    <th>Item Name</th>
    <th class = 'center aligned'><i class="info icon"></i></th>
    <th class = 'center aligned'><i class="cubes icon"></i>Stock</th>
    <th class = 'center aligned'><i class="money icon"></i>Price</th>
        <th class = 'center aligned'><i class="cart icon"></i>Cart</th>
                <th class = 'center aligned'>

  </tr></thead>
  <tbody>
  <?php foreach ($itemlist as $item) { ?>
    <tr>
      <td>
        <h4 class="ui image header">
          <img src="{{asset($item->imgurl)}}" class="ui mini rounded image">
          <div class="content">
            {{$item->itemname}}
            <div class="sub header">{{$item->itemcode}}
          </div>
        </div>
      </h4>
      </td>
      <td class = 'center aligned'>
      	<div class="ui mini green label"><i class="star icon"></i>Just Arrived</div>
      </td>
      <td class = 'center aligned'>
 		{{number_format($item->currstock,0)}}
      </td>
      <td class = 'center aligned'>
      	{{$item->aedprice}}
      </td>
      <td id = "test" class = 'center aligned'>
  		<?php if($item->currstock == 0) { ?>

              <div class="hidden content">
              <div calss = 'ui large header'>
                            <i class="large circular ban icon"></i><br><br>
</div>
                            </div>
              <div class="visible content">
  
              </div>

          <?php } elseif($item->selqty > 0) { ?>

            {{$item->selqty}} PCS      

            <div  itemid = '{{$item->id}}' class="ui tiny circular vertical animated inverted red rembtn button" tabindex="0">
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
      </td>
      <td>
      	           <i class="large green checkmark icon"></i>
      </td>

    </tr>


	<?php } ?>	
  </tbody>
</table>












<?php } else { ?>
<div class = 'ui fluid basic segment'>
    <h2 class="ui center aligned icon brown header">
  <i class="circular warning icon"></i>
  Not Found
  <h3 class = 'ui small center aligned header brown'>The search keywords did not return any results.<br> Please try again.</h3><br>
</h2>


</div>
<?php } ?>
