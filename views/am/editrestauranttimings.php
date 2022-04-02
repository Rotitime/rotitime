<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Edit Restaurnat Timings';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;

?>

<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="http://zefasa.com/rotitime/web/reports/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Restaurnat Timings</li>
      </ol>

      <div class="box_general padding_bottom">
        <d	iv class="header_box version_2">
            <h2><i class="fa fa-file"></i>Edit Restaurnat Timings</h2>
        </div>
		
		
 <form method="POST" method="post" enctype="multipart/form-data">
 
    <div class="col-md-6">
		<div class="form-group">
		<?php
		if(!empty($error)) { ?>
		<div class="alert alert-danger" role="alert">

		<?=$error;?>
		</div>
		<?php
		}
		?>
		</div>
		</div>
 

 <?= $this->render('logged_in_user_restaurants', [
                               "restaurant_id" => $restaurant_id,
                            ]
                        ); ?>
						
						
    	<div class="box_general padding_bottom">
        <div class="row">
       
            <div class="col-lg-12">
                <div class="form-group">
				<?php
                /*echo ($timingMonday['timing_day']);
	 ?>
				 echo "<pre>";
	print_r ($timingMonday); 		
				echo "</pre>";
               					exit;*/

				?>
                    <input type="hidden" id="timing_day" name="timing_day" value="<?php echo ($timingMonday['timing_day']); ?>">
				    <label for="timing_day">Monday</label><br>
                    <div class="item_opt_wrapper">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
								<div class="styled-select">
                                    <select id="monday_start_time" name="monday_start_time">
											 <option  value=''>Restaurant Start Time</option>
											 
											 <?php
											$i=1;
											while($i<=24){ ?>
												
												
													<option <?php  if($i == ($timingMonday['restaurant_start_time'])) { ?> selected='selected' <?php } ?> value=<?=$i?>><?=$i?></option>;
												
												<?php 
												$i++;
												
												
											}
											?>						
									</select>
								</div>
                                    <div class="invalid-feedback" id="restaurant_start_validation">
					                     Please select Restaurant Start Time
				                    </div>										
                                </div>
                            </div>                            
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="styled-select">
									    <select id="monday_end_time" name="monday_end_time">
											 <option  value=''>Restaurant End Time</option>
											  <?php
											$i=1;
											while($i<=24){ ?>
												
												
													<option <?php  if($i == ($timingMonday['restaurant_end_time'])) { ?> selected='selected' <?php } ?> value=<?=$i?>><?=$i?></option>;
												
												<?php 
												$i++;
												
												
											}
											?>					
									    </select>
				                    </div>
				                    <div class="invalid-feedback" id="restaurant_end_validation">
					                     Please select Restaurant End Time
				                    </div>						
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group radio_c_group">
						<input type="hidden" id="monday_is_restaurant_close" name="monday_is_restaurant_close"  value="N" <?php if(($timingMonday['is_restaurant_close']) == 'N') { ?> checked = "checked" <?php } ?>>
							 <input type="checkbox" id="monday_is_restaurant_close" name="monday_is_restaurant_close"  value="Y" <?php if(($timingMonday['is_restaurant_close']) == 'Y') { ?> checked = "checked" <?php } ?>>
									<label for="monday_is_restaurant_close">Is Restaurant close</label><br>
                                </div>
                            </div>
							
							<div class="col-lg-3">
                                <div class="form-group">
								<input type="text" class="form-control" id="monday_speciality" name="monday_speciality" placeholder="Day Speciality"  value="<?php echo ($timingMonday['day_speciality']); ?>">
								<div class="invalid-feedback" id="day_speciality_validation">
				                     Please enter Day Speciality
			                    </div>
                                </div>
                            </div>
							
                        </div>
                        <!-- /row-->
                    </div>
          <?php  ?>
                </div><!-- End form-group -->
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <input type="hidden" id="timing_day" name="timing_day" value="<?php echo ($timingTuesday['timing_day']); ?>">
				    <label for="timing_day">Tuesday</label><br>
                    <div class="item_opt_wrapper">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
								<div class="styled-select">
                                    <select id="tuesday_start_time" name="tuesday_start_time">
											 <option  value=''>Restaurant Start Time</option>
											 
											 <?php
											$i=1;
											while($i<=24){ ?>
												
												
													<option <?php  if($i == ($timingTuesday['restaurant_start_time'])) { ?> selected='selected' <?php } ?> value=<?=$i?>><?=$i?></option>;
												
												<?php 
												$i++;
												
												
											}
											?>						
									</select>
								</div>
                                    <div class="invalid-feedback" id="restaurant_end_validation">
					                     Please select Restaurant Start Time
				                    </div>										
                                </div>
                            </div>                            
                            <div class="col-lg-3">
                                <div class="form-group">
                                <div class="styled-select">
									 <select id="tuesday_end_time" name="tuesday_end_time">
											 <option  value=''>Restaurant End Time</option>
											  <?php
											$i=1;
											while($i<=24){ ?>
												
												
													<option <?php  if($i == ($timingTuesday['restaurant_end_time'])) { ?> selected='selected' <?php } ?> value=<?=$i?>><?=$i?></option>;
												
												<?php 
												$i++;
												
												
											}
											?>					
									</select>
				                </div>
				                    <div class="invalid-feedback" id="restaurant_end_validation">
					                     Please select Restaurant End Time
				                    </div>					
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group radio_c_group">
									<input type="hidden" id="tuesday_is_restaurant_close" name="tuesday_is_restaurant_close"  value="N" <?php if(($timingTuesday['is_restaurant_close']) == 'N') { ?> checked = "checked" <?php } ?>>
		                            <input type="checkbox" id="tuesday_is_restaurant_close" name="tuesday_is_restaurant_close"  value="Y" <?php if(($timingTuesday['is_restaurant_close']) == 'Y') { ?> checked = "checked" <?php } ?>>
									<label for="tuesday_is_restaurant_close">Is Restaurant close</label><br>
                                </div>
                            </div>
							
							 <div class="col-lg-3">
                                <div class="form-group">
								<input type="text" class="form-control" id="tuesday_speciality" name="tuesday_speciality" placeholder="Day Speciality" value="<?php echo ($timingTuesday['day_speciality']); ?>">
								<div class="invalid-feedback" id="day_speciality_validation">
				                     Please enter Day Speciality
			                    </div>
                                </div>
                            </div>
							
                        </div>
                        <!-- /row-->
                    </div>

                </div><!-- End form-group -->
            </div>
			
            <div class="col-lg-12">
                <div class="form-group">
                    <input type="hidden" id="timing_day" name="timing_day" value="<?php echo ($timingWednesday['timing_day']); ?>">
				    <label for="timing_day">Wednesday</label><br>
                    <div class="item_opt_wrapper">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
								<div class="styled-select">
                                    <select id="wednesday_start_time" name="wednesday_start_time">
											 <option  value=''>Restaurant Start Time</option>
											 
											 <?php
											$i=1;
											while($i<=24){ ?>
												
												
													<option <?php  if($i == ($timingWednesday['restaurant_start_time'])) { ?> selected='selected' <?php } ?> value=<?=$i?>><?=$i?></option>;
												
												<?php 
												$i++;
												
												
											}
											?>						
									</select>
								</div>
                                    <div class="invalid-feedback" id="restaurant_end_validation">
					                     Please select Restaurant Start Time
				                    </div>										
                                </div>
                            </div>                            
                            <div class="col-lg-3">
                                <div class="form-group">
                                <div class="styled-select">
									 <select id="wednesday_end_time" name="wednesday_end_time">
											 <option  value=''>Restaurant End Time</option>
											  <?php
											$i=1;
											while($i<=24){ ?>
												
												
													<option <?php  if($i == ($timingWednesday['restaurant_end_time'])) { ?> selected='selected' <?php } ?> value=<?=$i?>><?=$i?></option>;
												
												<?php 
												$i++;
												
												
											}
											?>					
									</select>
				                </div>
				                    <div class="invalid-feedback" id="restaurant_end_validation">
					                     Please select Restaurant End Time
				                    </div>					
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group radio_c_group">
									<input type="hidden" id="wednesday_is_restaurant_close" name="wednesday_is_restaurant_close"  value="N" <?php if(($timingWednesday['is_restaurant_close']) == 'N') { ?> checked = "checked" <?php } ?>>
		                            <input type="checkbox" id="wednesday_is_restaurant_close" name="wednesday_is_restaurant_close"  value="Y" <?php if(($timingWednesday['is_restaurant_close']) == 'Y') { ?> checked = "checked" <?php } ?>>
									<label for="wednesday_is_restaurant_close">Is Restaurant close</label><br>
                                </div>
                            </div>
							
							 <div class="col-lg-3">
                                <div class="form-group">
								<input type="text" class="form-control" id="wednesday_speciality" name="wednesday_speciality" placeholder="Day Speciality"  value="<?php echo ($timingWednesday['day_speciality']); ?>">
								<div class="invalid-feedback" id="day_speciality_validation">
				                     Please enter Day Speciality
			                    </div>
                                </div>
                            </div>
							
                        </div>
                        <!-- /row-->
                    </div>

                </div><!-- End form-group -->
            </div>
            
            <div class="col-lg-12">
                <div class="form-group">
                    <input type="hidden" id="timing_day" name="timing_day" value="<?php echo ($timingThursday['timing_day']); ?>">
				    <label for="timing_day">Thursday</label><br>
                    <div class="item_opt_wrapper">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
								<div class="styled-select">
                                    <select id="thursday_start_time" name="thursday_start_time">
											 <option  value=''>Restaurant Start Time</option>
											 
											 <?php
											$i=1;
											while($i<=24){ ?>
												
												
													<option <?php  if($i == ($timingThursday['restaurant_start_time'])) { ?> selected='selected' <?php } ?> value=<?=$i?>><?=$i?></option>;
												
												<?php 
												$i++;
												
												
											}
											?>						
									</select>
								</div>
                                    <div class="invalid-feedback" id="restaurant_end_validation">
					                     Please select Restaurant Start Time
				                    </div>										
                                </div>
                            </div>                            
                            <div class="col-lg-3">
                                <div class="form-group">
                                <div class="styled-select">
									 <select id="thursday_end_time" name="thursday_end_time">
											 <option  value=''>Restaurant End Time</option>
											  <?php
											$i=1;
											while($i<=24){ ?>
												
												
													<option <?php  if($i == ($timingThursday['restaurant_end_time'])) { ?> selected='selected' <?php } ?> value=<?=$i?>><?=$i?></option>;
												
												<?php 
												$i++;
												
												
											}
											?>					
									</select>
				                </div>
				                    <div class="invalid-feedback" id="restaurant_end_validation">
					                     Please select Restaurant End Time
				                    </div>					
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group radio_c_group">
									<input type="hidden" id="thursday_is_restaurant_close" name="thursday_is_restaurant_close"  value="N" <?php if(($timingThursday['is_restaurant_close']) == 'N') { ?> checked = "checked" <?php } ?>>
		                            <input type="checkbox" id="thursday_is_restaurant_close" name="thursday_is_restaurant_close"  value="Y" <?php if(($timingThursday['is_restaurant_close']) == 'Y') { ?> checked = "checked" <?php } ?>>
									<label for="thursday_is_restaurant_close">Is Restaurant close</label><br>
                                </div>
                            </div>
							
							 <div class="col-lg-3">
                                <div class="form-group">
								<input type="text" class="form-control" id="thursday_speciality" name="thursday_speciality" placeholder="Day Speciality"  value="<?php echo ($timingThursday['day_speciality']); ?>">
								<div class="invalid-feedback" id="day_speciality_validation">
				                     Please enter Day Speciality
			                    </div>
                                </div>
                            </div>
							
                        </div>
                        <!-- /row-->
                    </div>

                </div><!-- End form-group -->
            </div>
            
            <div class="col-lg-12">
                <div class="form-group">
                    <input type="hidden" id="timing_day" name="timing_day" value="<?php echo ($timingFriday['timing_day']); ?>">
				    <label for="timing_day">Friday</label><br>
                    <div class="item_opt_wrapper">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
								<div class="styled-select">
                                    <select id="friday_start_time" name="friday_start_time">
											 <option  value=''>Restaurant Start Time</option>
											 
											 <?php
											$i=1;
											while($i<=24){ ?>
												
												
													<option <?php  if($i == ($timingFriday['restaurant_start_time'])) { ?> selected='selected' <?php } ?> value=<?=$i?>><?=$i?></option>;
												
												<?php 
												$i++;
												
												
											}
											?>						
									</select>
								</div>
                                    <div class="invalid-feedback" id="restaurant_end_validation">
					                     Please select Restaurant Start Time
				                    </div>										
                                </div>
                            </div>                            
                            <div class="col-lg-3">
                                <div class="form-group">
                                <div class="styled-select">
									 <select id="friday_end_time" name="friday_end_time" >
											 <option  value=''>Restaurant End Time</option>
											  <?php
											$i=1;
											while($i<=24){ ?>
												
												
													<option <?php  if($i == ($timingFriday['restaurant_end_time'])) { ?> selected='selected' <?php } ?> value=<?=$i?>><?=$i?></option>;
												
												<?php 
												$i++;
												
												
											}
											?>					
									</select>
				                </div>
				                    <div class="invalid-feedback" id="restaurant_end_validation">
					                     Please select Restaurant End Time
				                    </div>					
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group radio_c_group">
									<input type="hidden" id="friday_is_restaurant_close" name="friday_is_restaurant_close"  value="N" <?php if(($timingFriday['is_restaurant_close']) == 'N') { ?> checked = "checked" <?php } ?>>
		                            <input type="checkbox" id="friday_is_restaurant_close" name="friday_is_restaurant_close"  value="Y" <?php if(($timingFriday['is_restaurant_close']) == 'Y') { ?> checked = "checked" <?php } ?>>
									<label for="friday_is_restaurant_close">Is Restaurant close</label><br>
                                </div>
                            </div>
							
							 <div class="col-lg-3">
                                <div class="form-group">
								<input type="text" class="form-control" id="friday_speciality" name="friday_speciality" placeholder="Day Speciality" value="<?php echo ($timingFriday['day_speciality']); ?>">
								<div class="invalid-feedback" id="day_speciality_validation">
				                     Please enter Day Speciality
			                    </div>
                                </div>
                            </div>
							
                        </div>
                        <!-- /row-->
                    </div>

                </div><!-- End form-group -->
            </div>
            
            
            <div class="col-lg-12">
                <div class="form-group">
                    <input type="hidden" id="timing_day" name="timing_day" value="<?php echo ($timingSaturday['timing_day']); ?>">
				    <label for="timing_day">Satuday</label><br>
                    <div class="item_opt_wrapper">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
								<div class="styled-select">
                                    <select id="saturday_start_time" name="saturday_start_time">
											 <option  value=''>Restaurant Start Time</option>
											 
											 <?php
											$i=1;
											while($i<=24){ ?>
												
												
													<option <?php  if($i == ($timingSaturday['restaurant_start_time'])) { ?> selected='selected' <?php } ?> value=<?=$i?>><?=$i?></option>;
												
												<?php 
												$i++;
												
												
											}
											?>						
									</select>
								</div>
                                    <div class="invalid-feedback" id="restaurant_end_validation">
					                     Please select Restaurant Start Time
				                    </div>										
                                </div>
                            </div>                            
                            <div class="col-lg-3">
                                <div class="form-group">
                                <div class="styled-select">
									 <select id="saturday_end_time" name="saturday_end_time">
											 <option  value=''>Restaurant End Time</option>
											  <?php
											$i=1;
											while($i<=24){ ?>
												
												
													<option <?php  if($i == ($timingSaturday['restaurant_end_time'])) { ?> selected='selected' <?php } ?> value=<?=$i?>><?=$i?></option>;
												
												<?php 
												$i++;
												
												
											}
											?>					
									</select>
				                </div>
				                    <div class="invalid-feedback" id="restaurant_end_validation">
					                     Please select Restaurant End Time
				                    </div>					
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group radio_c_group">
									<input type="hidden" id="saturday_is_restaurant_close" name="saturday_is_restaurant_close"  value="N" <?php if(($timingSaturday['is_restaurant_close']) == 'N') { ?> checked = "checked" <?php } ?>>
		                            <input type="checkbox" id="saturday_is_restaurant_close" name="saturday_is_restaurant_close"  value="Y" <?php if(($timingSaturday['is_restaurant_close']) == 'Y') { ?> checked = "checked" <?php } ?>>
									<label for="saturday_is_restaurant_close">Is Restaurant close</label><br>
                                </div>
                            </div>
							
							 <div class="col-lg-3">
                                <div class="form-group">
								<input type="text" class="form-control" id="saturday_speciality" name="saturday_speciality" placeholder="Day Speciality" value="<?php echo ($timingSaturday['day_speciality']); ?>">
								<div class="invalid-feedback" id="day_speciality_validation">
				                     Please enter Day Speciality
			                    </div>
                                </div>
                            </div>
							
                        </div>
                        <!-- /row-->
                    </div>

                </div><!-- End form-group -->
            </div>
            

            <div class="col-lg-12">
                <div class="form-group">
                    <input type="hidden" id="timing_day" name="timing_day" value="<?php echo ($timingSunday['timing_day']); ?>">
				    <label for="timing_day">Sunday</label><br>
                    <div class="item_opt_wrapper">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
								    <div class="styled-select">
                                    <select id="sunday_start_time" name="sunday_start_time">
											 <option  value=''>Restaurant Start Time</option>
											 
											 <?php
											$i=1;
											while($i<=24){ ?>
												
												
													<option <?php  if($i == ($timingSunday['restaurant_start_time'])) { ?> selected='selected' <?php } ?> value=<?=$i?>><?=$i?></option>;
												
												<?php 
												$i++;
												
												
											}
											?>						
									</select>
								    </div>
                                    <div class="invalid-feedback" id="restaurant_start_validation">
					                     Please select Restaurant Start Time
				                    </div>								
                                </div>
                            </div>                            
                            <div class="col-lg-3">
                                <div class="form-group">
                                <div class="styled-select">
									 <select id="sunday_end_time" name="sunday_end_time">
											 <option  value=''>Restaurant End Time</option>
											  <?php
											$i=1;
											while($i<=24){ ?>
												
												
													<option <?php  if($i == ($timingSunday['restaurant_end_time'])) { ?> selected='selected' <?php } ?> value=<?=$i?>><?=$i?></option>;
												
												<?php 
												$i++;
												
												
											}
											?>					
									</select>
				                </div>
				                    <div class="invalid-feedback" id="restaurant_end_validation">
					                     Please select Restaurant End Time
				                    </div>					
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group radio_c_group">
									<input type="hidden" id="sunday_is_restaurant_close" name="sunday_is_restaurant_close"  value="N" <?php if(($timingSunday['is_restaurant_close']) == 'N') { ?> checked = "checked" <?php } ?>>
		                            <input type="checkbox" id="sunday_is_restaurant_close" name="sunday_is_restaurant_close"  value="Y" <?php if(($timingSunday['is_restaurant_close']) == 'Y') { ?> checked = "checked" <?php } ?>>
									<label for="sunday_is_restaurant_close">Is Restaurant close</label><br>
                                </div>
                            </div>
							
							 <div class="col-lg-3">
                                <div class="form-group">
								<input type="text" class="form-control" id="sunday_speciality" name="sunday_speciality" placeholder="Day Speciality" value="<?php echo ($timingSunday['day_speciality']); ?>">
								<div class="invalid-feedback" id="day_speciality_validation">
				                     Please enter Day Speciality
			                    </div>
                                </div>
                            </div>
							
                        </div>
                        <!-- /row-->
                    </div>

                </div><!-- End form-group -->
            </div>
            
        </div>

    </div>

  
  <button type="submit" class="btn btn-default btn_1 medium" id = "submitbuttontimings">submit</button>
  <a href="<?php echo Yii::$app->homeUrl.'/'.$controllerName.'/view-restaurant-timings'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>
</form>
</div>
</div>
</div>

	<?php
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>