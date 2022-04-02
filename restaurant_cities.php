<?php
use app\models;
use app\models\RtCommonMethod;
$RtCommonMethod = new RtCommonMethod();
$loggedInOwnerRestaurants = $RtCommonMethod->fnGetLoggedInCity();

$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

if(!empty($restaurant_url)) {
	$restaurant_id = $restaurant_url;
}

?>
 <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_name">Restaurant Name:<?=$restaurant_name;?></label>
	<select id="restaurant_id" class="form-control"  name="restaurant_id">
		<option value=''>Select Restaurant</option>
		<?php foreach($loggedInOwnerRestaurants as $res) { ?>
		<option <?php if($restaurant_id == $res['restaurant_id']) { ?> selected = 'selected' <?php } ?> value='<?php echo $res['restaurant_id']; ?>'><?php echo $res['restaurant_name']; ?></option>
		<?php } ?>
	</select>

	<div class="invalid-feedback" id="restaurant_name_valids">
        Please Select Restaurant Name
      </div>
  </div>
  </div>