<?php

$controllerName = Yii::$app->controller->id;
$actionName = Yii::$app->controller->action->id; 

if($controllerName == 'as' || $controllerName == 'am' || $controllerName == 'reports' || $controllerName == 'admin' || $controllerName == 'ro' || ($controllerName == 'site' && $actionName == 'login')) {

	include_once("admin_header.php"); 

} else if($controllerName == 'ra' ) {

	include_once("ro_header.php"); 

} else {
	include_once("header_front_end.php"); 
}
?>
        <?= $content ?>

<?php
if($controllerName == 'as' || $controllerName == 'am' || $controllerName == 'reports' || $controllerName == 'admin' || $controllerName == 'ro'  || ($controllerName == 'site' && $actionName == 'login')) {

	include_once("admin_footer.php"); 

} else if($controllerName == 'ra' ) {

	include_once("ro_footer.php"); 

} else {

	include_once("footer_front_end.php"); 

}
?>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
