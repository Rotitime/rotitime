<?php foreach($restaurantGetReviews as $res) { 
                                    
//echo $res['reviewed_on'];
//$time = strtotime($res['reviewed_on']);
/*$dbDate = new \DateTime($res['reviewed_on']);
$currDate = new \DateTime();
$interval = $currDate->diff($dbDate);*/
//echo $interval->d." days ".$interval->h." hours";
?>
<div class="review_card">
    <div class="row">
        <!--<div class="col-md-2 user_info">
            <figure><img src="<?= $relativeHomeUrl ?>/img/avatar4.jpg" alt=""></figure>
            <h5>Lukas</h5>
        </div>-->
        <div class="col-md-10 review_content">
            <div class="clearfix add_bottom_15">
                <span class="rating"><?=$res['tap_to_rate_your_experience'];?><small>/5</small> <strong>Rating average</strong></span>
                <em>Published <?=$BsCommonMethods ->fn_time_elapsed_string($res['reviewed_on']);?></em>
            </div>
            <h4>"<?=$res['review_title'];?>"</h4>
            <p><?=$res['your_review'];?></p>
        </div>
    </div>
    <!-- /row -->
</div>
<?php } ?>