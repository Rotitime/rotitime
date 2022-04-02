<?php
use app\models;
use app\models\RtCommonMethod;
$RtCommonMethod = new RtCommonMethod();
$loggedInOwnerRestaurants = $RtCommonMethod->fnGetLoggedInOwnerRestaurants();

$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

$actionName = Yii::$app->controller->action->id; 

if(!empty($restaurant_url)) {
	$restaurant_id = $restaurant_url;
}
$daysOfWeekArr = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
//$daysOfWeekArr = array('Monday','Tuesday');
$timeWithMinutes = array('00','30');
?>
 <?php 
        $i = 0;
        foreach($daysOfWeekArr as $dbres) {

            if(isset($selectedRestaurantData[$dbres])) {
                $res =  $dbres;
                $restaurant_start_timeDb = $selectedRestaurantData[$dbres]['restaurant_start_time'];
                $restaurant_end_timeDb = $selectedRestaurantData[$dbres]['restaurant_end_time'];
                $is_restaurant_closeDb = $selectedRestaurantData[$dbres]['is_restaurant_close'];
                $day_specialityDb = $selectedRestaurantData[$dbres]['day_speciality'];
            } else {
                $res =  $dbres;
                $restaurant_start_timeDb = '';;
                $restaurant_end_timeDb = '';
                $is_restaurant_closeDb = '';
                $day_specialityDb = '';
            }
            
            $d++;
            ?>
            <div class="col-lg-12">
                <div class="form-group">
				<input type="hidden" id="<?=strtolower($res)?>_timing_day" name="<?=strtolower($res)?>_timing_day" value="<?=$res;?>">
				<label for="<?=strtolower($res)?>_timing_day"><?=$res?></label><br>
                    <div class="item_opt_wrapper">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
								<select class="form-control js-example-basic-multiple"  id="<?=strtolower($res)?>_start_time" class="form-control" name="<?=strtolower($res)?>_start_time">
											 <option  value=''>Restaurant Start Time</option>
											 <?php
											$i=1;
											while($i<=24){ ?>
												
												<?php foreach($timeWithMinutes as $timeRes) { 
													if($i == 24 && $timeRes == 30)  {
														continue;
													}
													?>
													<option <?php if($restaurant_start_timeDb == $i.":".$timeRes) { ?> selected = 'selected'  <?php } ?> value=<?=$i.":".$timeRes;?>><?=$i.":".$timeRes;?></option>;
												<?php } ?>
												
												<?php 
												$i++;
												
												
											}
											?>
																		
									</select>
                                    <div class="invalid-feedback" id="<?=strtolower($res)?>_restaurant_start_validation">
					                     Please select Restaurant Start Time for <?=$res;?>
					                </div>
                                </div>
                            </div>                            
                            <div class="col-lg-3">
                                <div class="form-group">
                                <select class="form-control js-example-basic-multiple" id="<?=strtolower($res)?>_end_time" name="<?=strtolower($res)?>_end_time">
											 <option  value=''>Restaurant End Time</option>
											 <?php
											$i=1;
											while($i<=24){ ?>
												
												
												<?php foreach($timeWithMinutes as $timeRes) { 
													if($i == 24 && $timeRes == 30)  {
														continue;
													}
													?>
													<option <?php if($restaurant_end_timeDb == $i.":".$timeRes) { ?> selected = 'selected'  <?php } ?> value=<?=$i.":".$timeRes;?>><?=$i.":".$timeRes;?></option>;
												<?php } ?>
												
												<?php 
												$i++;
												
												
											}
											?>		
									</select> 
                                    <div class="invalid-feedback" id="<?=strtolower($res)?>_restaurant_end_validation">
					                     Please select Restaurant End Time for <?=$res;?>
				                    </div>										
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group radio_c_group">
                                    <?php 
                                    $checkedRestaurantClose = '';
                                    if($is_restaurant_closeDb == 'Y') { 
                                        $checkedRestaurantClose = "checked='checked'";    
                                    } ?>
									<input type="checkbox" <?= $checkedRestaurantClose; ?> id="<?=strtolower($res)?>_is_restaurant_close" name="<?=strtolower($res)?>_is_restaurant_close" value="Y">
									<label for="<?=strtolower($res)?>_is_restaurant_close">Is Restaurant close</label><br>
                                </div>
                            </div>
							
					        <div class="col-lg-3">
                                <div class="form-group">
								<input type="text" class="form-control" id="<?=strtolower($res)?>_speciality" name="<?=strtolower($res)?>_speciality" placeholder="<?=$res;?> Day Speciality" value="<?=$day_specialityDb;?>">
								<div class="invalid-feedback" id="<?=strtolower($res)?>_speciality_validation">
				                     Please enter Day Speciality
			                    </div>
                                </div>
                            </div>
							
                        </div>
                        <!-- /row-->
                    </div>

                </div><!-- End form-group -->
            </div>
        <?php } ?>