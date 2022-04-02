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
<div class="col-md-6">
    <div class="form-group">
        <label for="restaurant_menu_id">Select Menu With This Dish:</label>
        <div class="styled-select">
            <select id="restaurant_menu_id" name="restaurant_menu_id">
                <option value=''>Select Menu</option>
                <?php foreach($dataFromViewRestaurantMenus as $res) { ?>
                    <option <?php if($restaurant_menu_id == $res['restaurant_menu_id']) { ?> selected = 'selected' <?php } ?> value='<?php echo $res['restaurant_menu_id']; ?>'><?php echo $res['menu_name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="invalid-feedback" id="dish_number_in_menu_validation">
            Please select Dish Number In Menu
        </div>
    </div>
</div>