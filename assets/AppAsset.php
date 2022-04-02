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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
		'admin_section/vendor/bootstrap/css/bootstrap.min.css',
        'https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css',
		'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css',
		'https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css',
		'css/bootstrap_customized.min.css',
		'css/style.css',
		'css/detail-page-delivery.css',
		'css/home.css',
		'css/custom.css',
		'css/review.css',
		'css/booking-sign_up.css',
		
    ];
    public $js = [
	'js/common_scripts.min.js',
    'js/restaurant_homepage.js',	
    'https://maps.googleapis.com/maps/api/js?key=AIzaSyDbe4e4Y8KGFTym6Ik5wPEWL9poXuYux_U&callback=initAutocomplete&libraries=places&v=weekly&language=de&region=de',
	'js/common_func.js',
	'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js',
	'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js',
	'js/sticky_sidebar.min.js',
	'js/specific_detail.js',
	//'js/bootstrap-input-spinner.js',
	
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
