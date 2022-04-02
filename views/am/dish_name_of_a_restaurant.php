<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Add Restaurants Dishes';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;
$restaurant_name = '';
?>

      <!-- Breadcrumbs-->

<select id="dish_id" name="dish_id">
	<option value=''>Select Dish</option>
	<?php foreach($dataFromViewRestaurantDishes as $res) { ?>
	<option <?php if($dish_id == $res['dish_id']) { ?> selected = 'selected' <?php } ?> value='<?php echo $res['dish_id']; ?>'><?php echo $res['dish_name']; ?></option>
	<?php } ?>
</select>	
  <input type="hidden" name="homeUrl" id="homeUrl" value=<?= $relativeHomeUrl; ?> />
