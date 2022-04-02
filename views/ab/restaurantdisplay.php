<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Add Restaurant';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;
$actionName = Yii::$app->controller->action->id;
?>





   <h2 align="center">Auto Load More Data on Page Scroll with Jquery & PHP</a></h2>
   <br />
   <div id="load_data"></div>
   <div id="load_data_message"></div>
   <br />
   <br />
   <br />
   <br />
   <br />
   <br />
		  <h3></h3>
		  <p></p>
		  <p class="text-muted" align="right">City</p>




	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>