<main>
		<div class="hero_single inner_pages background-image" data-background="url(<?=SITE_URL?>img/home_section_1.jpg)">
			<div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-xl-9 col-lg-10 col-md-8">
							<h1><?= $cmsPageContent['page_name'] ?></h1>
							<p>A successful restaurant experience</p>
						</div>
					</div>
					<!-- /row -->
				</div>
			</div>
		</div>
		<!-- /hero_single -->

        <div class="container margin_30_40">			
			<div class="row">
				<div class="col-lg-12">
					<div class="singlepost">
						
						<!--<h1><?= $cmsPageContent['page_name'] ?></h1>-->
						
						<!-- /post meta -->
						<div class="post-content">
                        <?= $cmsPageContent['page_content']; ?> 
						</div>
						<!-- /post -->
					</div>
					<!-- /single-post -->
				</div>
				<!-- /col -->

				
				<!-- /aside -->
			</div>
			<!-- /row -->	
		</div>

	</main>
	<!-- /main -->