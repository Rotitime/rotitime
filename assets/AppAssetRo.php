<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAssetRo extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
		'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback',
        //'ro/css/plugins/fontawesome-free/css/all.min.css',
		'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
		//'ro/css/plugins/icheck-bootstrap.min.css',
		'ro/dist/css/adminstyle.min.css',
		
    ];
    public $js = [
	'ro/plugins/jquery/jquery.min.js',
	'ro/plugins/jquery-ui/jquery-ui.min.js',
    //'ro/css/plugins/bootstrap.bundle.min.js',	
    'ro/dist/js/adminstyle.js',
	//'js/bootstrap-input-spinner.js',
	
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
