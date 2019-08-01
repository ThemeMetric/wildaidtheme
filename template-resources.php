<?php
/**
 * User: Antonio
 * Template Name: New Resources Template
 * Date: 10/10/2017
 * Time: 3:24 PM
 */

get_header();
$id=get_the_id();




$filters = array();
$searchString = "";
$placeHolder = __("Search WildAid Resources");
$searchType = "";
$searchCat = "";
$sectionFilters=array();


if(isset($_REQUEST['program-dropdown']) && !empty($_REQUEST['program-dropdown'])) {
	$filters["program"]=$_REQUEST['program-dropdown'];
}

if(isset($_REQUEST['ambassador-dropdown']) &&  !empty($_REQUEST['ambassador-dropdown'])) {
	$filters["ambassador"]=$_REQUEST['ambassador-dropdown'];
}

if(isset($_REQUEST['location-dropdown'])&&  !empty($_REQUEST['location-dropdown'])) {
	$filters["location"]=$_REQUEST['location-dropdown'];
}

if(isset($_REQUEST['language-dropdown']) && !empty($_REQUEST['language-dropdown'])) {
	$filters["language"]=$_REQUEST['language-dropdown'];
}

if(isset($_REQUEST['searchField']) && !empty($_REQUEST['searchField'])){
    $searchString= $_REQUEST['searchField'];
}

if(isset($_REQUEST['searchcat']) && !empty($_REQUEST['searchcat'])){
    $searchCat = sanitize_text_field($_REQUEST['searchCat']);
	$filters["cat"] = $searchCat;
}

if(isset($_REQUEST['searchtype']) && !empty($_REQUEST['searchtype'])){
	  $searchType=      $_REQUEST['searchtype'];

	$arySearchType = explode(",", $searchType);

}

if(isset($_REQUEST['section-filters']) && !empty($_REQUEST['section-filters'])) {

    if(is_array($_REQUEST['section-filters'])){

    $sectionFilters= array_values($_REQUEST['section-filters']);


	$searchType= implode(",", $sectionFilters);
    }
    else{
	    $searchType =$_REQUEST['section-filters'];
    }


}
$large_image = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full');
$programs= getPrograms(1, $filters,$searchString );
$programFilters= getPrograms(1, array(),'', -1);
$videos = getResources('video', 1, $filters, $searchString,6,"post_title","rand");
$campaigns = getResources('campaign', 1, $filters, $searchString);
$publications = getResources('publication', 1, $filters, $searchString);
$news = getNews(1, $filters, $searchString);
$ambassadors= getAmbassadors();
$locations = getLocations();
$languages= getLanguages();

?>
<style>
    .box-4 figcaption {
        height: 4em;
    }
    .resources.section-02 figcaption{
        height:4em;
    }

    @media (max-width: 1200px){
        .resources .filter-panel.fixed {
          position: static;
        }
    }
    @media (max-width: 767px){
        .resources .filter-panel.fixed {
            position: fixed;
        }
    }

    @media (max-height: 815px) and (min-width:768px){
        .resources .filter-panel.fixed {
            position: static;
        }
    }

</style>
<div class="banner-container">
<?php
if(have_rows('add_slides',$id)!=''){
	wildaidSlider($id);
} else {
    ?>
	<div class="row-section slider-inner header-background" style="background-image: url('<?php echo $large_image[0]; ?>')">
		<div class="container">
			<div class="cover-text"></div>
			<h4><?php the_title();?></h4>
		</div>
		<ul></ul>


	</div>
	<?php
}
?>
    <div class="flex search-container" >
		<?php
		?>
        <input type="text" placeholder="<?php echo $placeHolder ?>" name="searchbarField" id="searchField" class="form-control" value="<?php echo $searchString ?>"/>
        <button type="button" id="searchbtn" class="btn btn-site search">
	        <?php echo file_get_contents( get_template_directory()."/svgs/search.svg"); ?>
        </button>
    </div>
    <h1 class="page-title"><?php the_title();?></h1>
</div> <!-- END banner-container -->


<main>
	<div class="resources section section-02 paddTop0 box-3 resource-page mt60">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-12 filter-column">
    				<div class="filter-panel">
        				<a href="#" class="filter-panel-button" ></a>
						<form action="" method="POST" name="resform" id="resform">
							<input type="hidden" name="searchField" id="hiddenSearchText" value=""/>
							<input type="hidden" name="searchtype" id="hiddenSearchType" value="<?php echo $searchType; ?>" />
							<ul id="result-section-filters">
								<li>
									<h5>ALL CONTENT</h5>
									<input id="all-chk" class="uncheck-others" checked="checked" value="all" type="checkbox" name="section-filters[]">
									<label  for="all-chk">ALL CONTENT</label>
								</li>
								<li>
									<h5>Programs</h5>
									<input id="programs-chk" value="programs" type="checkbox" id="225" name="section-filters[]">
									<label  for="programs-chk">Programs</label>


								</li>
								<li>
									<h5>Videos</h5>
									<input id="videos-chk" value="videos" type="checkbox"  id="236" name="section-filters[]">
									<label  for="videos-chk">Video</label>
								</li>
								<li>
									<h5>Campaigns</h5>
									<input id="campaigns-chk" value="campaigns" type="checkbox"  id="237" name="section-filters[]">
									<label  for="campaigns-chk">Campaigns</label>
								</li>
								<li>
									<h5>News</h5>
									<input id="news-chk" value="news" type="checkbox"  id="238" name="section-filters[]" >
									<label for="news-chk">News</label>
								</li>
								<li>
									<h5>
										Publications
									</h5>
									<input id="publications-chk" value="publications" type="checkbox"  id="239" name="section-filters[]" >
									<label for="publications-chk">Publications</label>
								</li>
							</ul>

							<div class="custom-select">

								<select id="program-dropdown" name="program-dropdown" >
									<?php $programFilter= (isset($filters["program"]))? $filters["program"] : "" ?>
									<option <?php if(empty($programFilter)){  echo 'selected="selected"'; }?> value="">Program</option>
									<?php

									while ( $programFilters->have_posts() ) : $programFilters->the_post();

										?>

										<option name="program-dropdown" <?php if($programFilter == get_the_ID()){  echo "selected='selected'"; }  ?>" value="<?php the_ID();?>"><?php the_title();?></option>

										<?php

									endwhile;
									?>
								</select>
								<select id="ambassador-dropdown" name="ambassador-dropdown">
									<?php $ambassadorFilter= (isset($filters["ambassador"]))? $filters["ambassador"] : "" ?>
									<option <?php if(empty($ambassadorFilter)){  echo 'selected="selected"'; }?> value="">Ambassador</option>
									<?php
									while ( $ambassadors->have_posts() ) : $ambassadors->the_post();
										?>
										<option value="<?php the_ID();?>" <?php if($ambassadorFilter == get_the_ID()){  echo "selected='selected'"; }  ?>><?php the_title();?></option>
										<?php
									endwhile;
									?>
								</select>
								<select id="location-dropdown" name="location-dropdown">
									<?php $locationFilter= (isset($filters["location"]))? $filters["location"] : "" ?>
									<option <?php if(empty($locationFilter)){  echo 'selected="selected"'; }?> value="">Location</option>

									<?php
										foreach($locations as $key=>$value) {
											?>
											<option value="<?php echo $value->term_id?>" <?php if($locationFilter == $value->term_id){  echo 'selected="selected"'; }  ?>><?php echo $value->name;?></option>
											<?php
										}
									?>
								</select>
								<select id="language-dropdown" name="language-dropdown">
									<?php $languageFilter= (isset($filters["language"]))? $filters["language"] : "" ?>
									<option <?php if(empty($languageFilter)){  echo 'selected="selected"'; }?> value="">Language</option>
									<?php
									foreach($languages as $key=>$value) {
										?>
										<option value="<?php echo $value->term_id?>" <?php if($languageFilter == $value->term_id){  echo 'selected="selected"'; }  ?>><?php echo $value->name;?></option>
										<?php
									}
									?>
								</select>

							</div>
						</form>
    				</div>
				</div> <!-- Column -->

				<div class="col-md-9 col-sm-9 col-xs-12 results">
					<!-- PROGRAMS ------------------------------------------------------------------>
					<div class="loaded-container programs"  data-page="1" data-total-pages="<?php echo $programs->max_num_pages ?>">
					<?php
					$i=1;
					while ( $programs->have_posts() ) : $programs->the_post();
						displayProgramResult();

					endwhile;
					?>
					</div> <!-- LOAD DIV -->
					<?php if($programs->max_num_pages >1){ ?>
						<div class="text-right programs">
							<a href="#" data-id="programs" class="btn btn-link loadMore"><?php _e("View More Programs") ?></a>
						</div>

					<?php
					}
					?>


					<!-- VIDEOS ------------------------------------------------------------------>
					<div class="loaded-container videos" data-page="1" data-total-pages="<?php echo $videos->max_num_pages ?>">

						<?php
						while ( $videos->have_posts() ) : $videos->the_post();
							displayVideoResult();
						endwhile;
						?>

					</div> <!-- LOAD DIV -->
					<?php if($videos->max_num_pages >1){ ?>
						<div class="text-right videos">
							<a href="#" data-id="videos" class="btn btn-link loadMore"> <?php _e("View More Videos") ?></a>
						</div>
					<?php
					}
					?>

					<!-- NEWS ------------------------------------------------------------------>

					<div class="loaded-container news"  data-page="1" data-total-pages="<?php echo $news->max_num_pages ?>" >
						<?php
						while ( $news->have_posts() ) : $news->the_post();
							displayNewsResult();
						endwhile;
						?>


					</div> <!-- LOAD DIV -->
					<?php if($news->max_num_pages >1){ ?>
						<div class="text-right news">
							<a href="#" data-id="news" class="btn btn-link loadMore"> <?php _e("View More News") ?></a>
						</div>
					<?php
					}
					?>



					<!-- CAMPAIGNS ------------------------------------------------------------------>

					<div class="loaded-container campaigns"  data-page="1" data-total-pages="<?php echo $campaigns->max_num_pages ?>">
						<?php
						while ( $campaigns->have_posts() ) : $campaigns->the_post();
							displayCampaignResult();
						endwhile;
						?>


					</div> <!-- LOAD DIV -->
				<?php if($campaigns->max_num_pages >1){ ?>
						<div class="text-right campaigns">
							<a href="#" data-id="campaigns" class="btn btn-link loadMore"> <?php _e("View More Campaigns" ) ?></a>
						</div>
					<?php
				}
				?>


					<!-- PUBLICATIONS ------------------------------------------------------------------>

					<div class="loaded-container publications" data-page="1" data-total-pages="<?php echo $publications->max_num_pages ?>">
						<?php
						while ( $publications->have_posts() ) : $publications->the_post();
							displayPublicationResult();
						endwhile;
						?>


					</div> <!-- LOAD DIV -->
					<?php if($publications->max_num_pages >1){ ?>
						<div class="text-right publications">
							<a href="#"  data-id="publications" class="btn btn-link loadMore"><?php _e("View More Publications") ?></a>
						</div>
					  <?php
					}
					if(!$programs->have_posts() && !$videos->have_posts() && !$news->have_posts() && !$campaigns->have_posts() && !$publications->have_posts()){
						?>
							<div>
								<p><?php _e("Sorry no results were found.") ?></p>
							</div>
						<?php
					}
					?>
					<div class="noResults" style="display:none">
						<p><?php _e("No Results Found.") ?></p>
					</div>
				</div>  <!-- COLUMN -->

			</div> <!-- Row -->
		</div> <!-- Container -->
	</div>
</main>

<?php get_footer(); ?>