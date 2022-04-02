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
class AppAssetAdmin extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
		'admin_section/vendor/bootstrap/css/bootstrap.min.css',
		'admin_section/css/admin.css',
		'admin_section/vendor/font-awesome/css/font-awesome.min.css',
		'admin_section/vendor/datatables/dataTables.bootstrap4.css',
		'admin_section/css/custom.css',
		'plugins/bootstrap-select/bootstrap-select.min.css',
        'plugins/select2/dist/css/select2.min.css',
        'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css',
		
    ];
    public $js = [
	'js/common_scripts.min.js',
    'admin_section/vendor/jquery/jquery.min.js',
	'admin_section/vendor/bootstrap/js/bootstrap.bundle.min.js',
	'admin_section/vendor/jquery-easing/jquery.easing.min.js',
	'admin_section/vendor/datatables/jquery.dataTables.js',
	'admin_section/vendor/datatables/jquery.dataTables.js',
	'admin_section/vendor/datatables/dataTables.bootstrap4.js',
	'admin_section/vendor/jquery.selectbox-0.2.js',
	'admin_section/vendor/jquery.magnific-popup.min.js',
	'admin_section/js/admin.js',
	'admin_section/js/editor/summernote-bs4.min.js',
    'plugins/select2/dist/js/select2.min.js',
    'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js',
    'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js',
    'js/plugins_call.js',
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
