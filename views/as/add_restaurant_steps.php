<?php
$controllerName = Yii::$app->controller->id;
$actionName = Yii::$app->controller->action->id;

$controllerAction = $controllerName."/".$actionName;

$rtAdminStepsArr = array('Restaurant','Address','Timings','Specialities','Menus','Dishes','Supliments','Gallery','Delivery Postal Codes');

$rtAdminStepsUrlArr = array('as/add-restaurant','am/add-restaurant-address','am/add-restaurant-timings','am/add-restaurant-specialities','am/add-restaurant-menus','am/add-restaurant-dishes','am/add-dish-suppliments','as/add-restaurants-gallery','am/add-restaurant-delivery-postal-codes');

$stepIndex = array_search($controllerAction, $rtAdminStepsUrlArr);
$stepsTotal = count($rtAdminStepsArr);

$widthForProgressBar = round(100/($stepsTotal - $stepIndex));
?>
<div class="col-lg-12" id="myWizard">
              <div class="progress">
                  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="<?=$stepsTotal;?>" style="width: <?=$widthForProgressBar;?>%;">
                      <?="Step ".($stepIndex+1)." of ".$stepsTotal;?>
                  </div>
              </div> 
              <div class="navbar">
                  <div class="navbar-inner">
                      <ul class="nav nav-pills nav-wizard">
					  <?php 
					  $i = 0;
					  foreach($rtAdminStepsArr as $res) {  
						  $activeStepClass = "";
						  if($controllerAction == $rtAdminStepsUrlArr[$i]) {
							  $activeStepClass = "active";
						  }
						  ?>
                          <li>
                              <a class="hidden-xs <?=$activeStepClass;?>" href="<?= Yii::$app->homeUrl.$rtAdminStepsUrlArr[$i]; ?>"><?=($i+1).'. '.$res;?></a>
                          </li>
						<?php 
						  $i++;
						  } ?>
                      </ul>
                  </div>
              </div>
