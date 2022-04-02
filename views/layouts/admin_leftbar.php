<?php
use yii\web\Session;
$controllerName = Yii::$app->controller->id;

$session = Yii::$app->session;

$super_admin = "Y";
if ($session->has('login_type')) {
	$login_type = $session->has('login_type');
	if($login_type == 'restaurant-owner') {
		$super_admin = "N";
	}
}
?>
<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="4">
          <a class="nav-link" href="<?=$relativeUrl;?>reports/dashboard">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>

		<?php if($super_admin == 'Y') { ?>
			<!--<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Restaurant Owner">
			  <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseRestaurantOwner" data-parent="#RestaurantOwner">
				<i class="fa fa-fw fa-list"></i>
				<span class="nav-link-text">Restaurant Owner</span>
			  </a>
			  <ul class="sidenav-second-level collapse" id="collapseRestaurantOwner">
				<li>
				  <a href="<?= Yii::$app->homeUrl.'ab/add-restaurant-owner'; ?>">Add Restaurant Owner </a>
				</li>
			  <li>
				  <a href="<?= Yii::$app->homeUrl.'ab/view-restaurant-owner'; ?>">View Restaurant Owner </a>
				</li>
			  </ul>
			</li> -->
		
			
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseGreyButton" data-parent="#GreyButton">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Grey Button</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseGreyButton">
            <li>
              <a href="<?= Yii::$app->homeUrl.'as/add-grey-button-section'; ?>">Add Grey Button Section</a>
            </li>
          <li>
              <a href="<?= Yii::$app->homeUrl.'as/view-grey-button-section'; ?>">View Grey Button Section</a>
            </li>
          </ul>
        </li>


		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapserestaurantWetrust" data-parent="#restaurantWetrust">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Restaurant We trust</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapserestaurantWetrust">
            <li>
              <a href="<?= Yii::$app->homeUrl.'as/add-restaurant-we-trust-section'; ?>">Add Restaurant We trust</a>
            </li>
          <li>
              <a href="<?= Yii::$app->homeUrl.'as/view-restaurant-we-trust-section'; ?>">View Restaurant We trust</a>
            </li>
          </ul>
        </li>


		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapsePageSectionImage" data-parent="#PageSectionImage">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Home Page Section Image</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapsePageSectionImage">
            <li>
              <a href="<?= Yii::$app->homeUrl.'as/add-home-page-section-image'; ?>">Add Home Page Section Image</a>
            </li>
          <li>
              <a href="<?= Yii::$app->homeUrl.'as/view-home-page-image'; ?>">View Home Page Section Image</a>	
            </li>
          </ul>
        </li>


		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseAreYouOwneSection" data-parent="#AreYouOwnerSection">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Are You Owner Section</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseAreYouOwneSection">
            <li>
              <a href="<?= Yii::$app->homeUrl.'am/add-are-you-owner-section'; ?>">Add Are You Owner Section</a>
            </li>
          <li>
              <a href="<?= Yii::$app->homeUrl.'am/view-are-you-owner-section'; ?>">View Are You Owner Section</a>
            </li>
          </ul>
        </li>


		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseHomePagesSections" data-parent="#HomePagesSections">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Home Pages Sections</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseHomePagesSections">
            <li>
              <a href="<?= Yii::$app->homeUrl.'am/add-home-pages-sections'; ?>">Add Home Pages Sections</a>
            </li>
          <li>
              <a href="<?= Yii::$app->homeUrl.'am/view-home-pages-sections'; ?>">View Home Pages Sections</a>
            </li>
          </ul>
        </li>


		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseHomePageBannerImage" data-parent="#HomePageBannerImage">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Home Page Banner Image</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseHomePageBannerImage">
            <li>
              <a href="<?= Yii::$app->homeUrl.'am/add-home-page-banner-image'; ?>">Add Home Page Banner Image</a>
            </li>
          <li>
              <a href="<?= Yii::$app->homeUrl.'am/view-home-page-banner-image'; ?>">View Home Page Banner Image</a>
            </li>
          </ul>
        </li>


		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseCmsPage" data-parent="#CmsPage">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">CMS Page</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseCmsPage">
            <li>
              <a href="<?= Yii::$app->homeUrl.'am/add-cms-page'; ?>">Add CMS Page</a>
            </li>
          <li>
             <a href="<?= Yii::$app->homeUrl.'am/view-cms-page'; ?>">View CMS Page</a>
            </li>
          </ul>
        </li>
		
		
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseDistrictsAttached" data-parent="#AddDistrictsAttached">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Districts Attached</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseDistrictsAttached">
            <li>
              <a href="<?= Yii::$app->homeUrl.'as/add-districts-attached'; ?>">Add Districts Attached</a>
            </li>
          <li>
             <a href="<?= Yii::$app->homeUrl.'as/view-districts-attached'; ?>">View Districts Attached</a>
            </li>
          </ul>
        </li>
	<?php } ?>

		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseAllrestaurants" data-parent="#Allrestaurants">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Restaurants</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseAllrestaurants">
		   <li>
             <a href="<?= Yii::$app->homeUrl.'as/add-restaurant'; ?>">Add Restaurant </a>
            </li>
            <li>
              <a href="<?= Yii::$app->homeUrl.'as/view-restaurants'; ?>">View Restaurants</a>
            </li>
          </ul>
        </li>
		
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseAddRestaurantAddress" data-parent="#AddRestaurantAddress">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Restaurant Address</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseAddRestaurantAddress">
            <li>
              <a href="<?= Yii::$app->homeUrl.'am/add-restaurant-address'; ?>">Add Restaurant Address</a>
            </li>
          <li>
             <a href="<?= Yii::$app->homeUrl.'am/view-restaurant-address'; ?>">View Restaurant Address</a>
            </li>
          </ul>
        </li>


		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseAddRestaurantDishes" data-parent="#AddRestaurantDishes">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Restaurant Dishes</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseAddRestaurantDishes">
            <li>
              <a href="<?= Yii::$app->homeUrl.'am/add-restaurant-dishes'; ?>">Add Restaurant Dishes</a>
            </li>
          <li>
             <a href="<?= Yii::$app->homeUrl.'am/view-restaurant-dishes'; ?>">View Restaurant Dishes</a>
            </li>
          </ul>
        </li>

		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseAddDishSuppliments" data-parent="#AddDishSuppliments">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Dish Suppliments</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseAddDishSuppliments">
            <li>
              <a href="<?= Yii::$app->homeUrl.'am/add-dish-suppliments'; ?>">Add Dish Suppliments</a>
            </li>
          <li>
             <a href="<?= Yii::$app->homeUrl.'am/view-dish-suppliments'; ?>">View Dish Suppliments</a>
            </li>
          </ul>
        </li>
		
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseAddRestaurantGallery" data-parent="#AddRestaurantGallery">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Restaurants Gallery</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseAddRestaurantGallery">
            <li>
              <a href="<?= Yii::$app->homeUrl.'as/add-restaurants-gallery'; ?>">Add Restaurants Gallery</a>
            </li>
          <li>
             <a href="<?= Yii::$app->homeUrl.'as/view-restaurants-gallery'; ?>">View Restaurants Gallery</a>
            </li>
          </ul>
        </li>
		
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseRestaurantDeliveryPostalCodes" data-parent="#AddRestaurantDeliveryPostalCode">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Restaurant Delivery Postal Codes</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseRestaurantDeliveryPostalCodes">
            <li>
              <a href="<?= Yii::$app->homeUrl.'am/add-restaurant-delivery-postal-codes'; ?>">Add Restaurant Delivery Postal Code</a>
            </li>
          <li>
             <a href="<?= Yii::$app->homeUrl.'am/view-restaurant-delivery-postal-codes'; ?>">View Restaurant Delivery Postal Code</a>
            </li>
          </ul>
        </li>
		
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseAddrestaurantSpecialities" data-parent="#AddrestaurantSpecialities">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Restaurant Specialities</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseAddrestaurantSpecialities">
            <li>
              <a href="<?= Yii::$app->homeUrl.'am/add-restaurant-specialities'; ?>">Add Restaurant Specialities</a>
            </li>
          <li>
             <a href="<?= Yii::$app->homeUrl.'am/view-restaurant-specialities'; ?>">View Restaurant Specialities</a>
            </li>
          </ul>
        </li>
		
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseAddRestaurantMenus" data-parent="#AddRestaurantMenus">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Restaurant Menus</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseAddRestaurantMenus">
            <li>
              <a href="<?= Yii::$app->homeUrl.'am/add-restaurant-menus'; ?>">Add Restaurant Menus</a>
            </li>
          <li>
             <a href="<?= Yii::$app->homeUrl.'am/view-restaurant-menus'; ?>">View Restaurant Menus</a>
            </li>
          </ul>
        </li>


		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseAddrestaurantTimings" data-parent="#AddrestaurantTimings">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Restaurant Timings</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseAddrestaurantTimings">
            <li>
              <a href="<?= Yii::$app->homeUrl.'am/add-restaurant-timings'; ?>">Add/View/Edit Restaurant Timings</a>
            </li>
          <!--<li>
             <a href="<?= Yii::$app->homeUrl.'am/view-restaurant-timings'; ?>">View Restaurant Timings</a>
            </li> -->
          </ul>
        </li>
		
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseAddpopularRestaurants" data-parent="#AddpopularRestaurants">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Popular Restaurants</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseAddpopularRestaurants">
            <li>
              <a href="<?= Yii::$app->homeUrl.'as/add-popular-restaurants'; ?>">Add Popular Restaurants</a>
            </li>
          </ul>
        </li>
		
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>