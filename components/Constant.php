<?php

namespace app\components;

use yii\base\Component;

/**
 * Class Constant
 * @package app\components
 */
class Constant extends Component
{
    public function __construct(array $config = [])
    {

      

        /*DEFINE("RTT", "mirzasaf_rotitime");
		DEFINE("RT_RESTAURANTS_ADDRESS_TBL", "rt_restaurants_address");
		DEFINE("RT_RESTAURANTS_TBL", "rt_restaurants");
		DEFINE("RT_RESTAURANTS_TIMINGS_TBL", "rt_restaurant_timings");
		DEFINE("RT_RESTAURANTS_SPECIALITIES_TBL", "rt_restaurant_specialities");
		DEFINE("RT_RESTAURANTS_MENUS_TBL", "rt_restaurant_menus");
		DEFINE("RT_RESTAURANTS_DISHES_TBL", "rt_restaurant_dishes");
		DEFINE("RT_DISH_SUPPLIMENTS_TBL", "rt_dish_suppliments");
		DEFINE("RT_RESTAURANTS_GALLERY_TBL", "rt_restaurants_gallery");
		DEFINE("RT_RESTAURANTS_DELIVERY_POSTAL_CODES_TBL", "rt_restaurants_delivery_postal_codes");
		DEFINE("RT_RESTAURANTS_OWNER_TBL", "rt_restaurants_owner");
		DEFINE("RT_DISTRICT_ATTACHED_TBL", "rt_district_attached");
		DEFINE("RT_HOMEPAGES_SECTIONS_TBL", "rt_homepages_sections");
		DEFINE("RT_HOMEPAGE_MAIN_IMAGE_TBL", "rt_homepage_main_image");
		DEFINE("RT_HOMEPAGE_SECTION_IMAGES_TBL", "rt_homepage_section_images");
		DEFINE("RT_HOME_PAGE_ARE_U_OWNER_SECTION_TBL", "rt_home_page_are_u_owner_section");
		DEFINE("RT_HOME_PAGE_BANNER_IMAGE_TBL", "rt_home_page_banner_image");
		DEFINE("RT_HOME_PAGE_GREY_BUTTONS_TBL", "rt_home_page_grey_buttons");
		DEFINE("RT_HOME_PAGE_RESTAURANT_WE_TRUST_SECTION_TBL", "rt_home_page_restaurant_we_trust_section");
		DEFINE("RT_ORDERS_CONFIRMATION_TBL", "rt_orders_confirmation");
		DEFINE("RT_ORDER_DETALS_TBL", "rt_order_details");
		DEFINE("RT_POPULAR_RESTAURANTS_TBL", "rt_popular_restaurants");
		DEFINE("RT_RESTAURANT_CITIES_TBL", "rt_restaurant_cities");
		DEFINE("RT_RESTAURANT_ORDER_DETAILS_TBL", "rt_restaurant_order_details");

		DEFINE("ENUM_FROM_RESTAURANT_DETAILS_PAGE", "from-restaurant-details-page");
		DEFINE("ENUM_FROM_ORDER_EMAIL", "from-order-email");

		DEFINE("TBL_RT_SUPER_USERS", "rt_super_users");
		DEFINE("MANAGE_LOGIN_ACCOUNT_DETAILS", "session");
		DEFINE("COOKIE_EXPIRY_TIME", "180");
		DEFINE("SITE_URL", "https://zefasa.com/rotitime/"); */
       

        parent::__construct($config);
    }
}
