<option value="">Select Restaurant</option>
<?php foreach($cityRestaurantsArr as $res) { ?>
<option value='<?= $res['restaurant_id']; ?>'><?= $res['restaurant_name']; ?></option>
<?php } ?>