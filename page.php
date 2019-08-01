<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); 
wp_reset_query();
displayBanner();?>
<style>
.sectionTop.section-textImg{
    padding-top:60px;
    padding-bottom:0px;

}
 .sectionTop.about-feature{
     padding-top:60px;
     padding-bottom:0px;

 }
.section.about-wel{
    padding-top:60px;
    padding-bottom:60px;
}
.aHeading h3, .h-p-ul h3, .colmn-left h4{
    margin-top:.5em;
    margin-bottom:.5em;
}
.h-p-ul li{
    padding-bottom:1px;
}
</style>
<main>
<?php wp_reset_query();

if(get_field('image1',$id)):?>
    <div class="sectionTop section-textImg">
        <div class="container">
            <div class="colmn-img bg-control" style="background-image:url(<?php echo get_field('image1',$id);?>);">
            <?php if(!empty(get_field("featured_video_link",$id )) ){ ?>
                <a class="video-popup" href="<?php the_field('featured_video_link',$id);?>">
                    <span class="play-button">
                        <img src="/wp-content/themes/wildaidtheme/svgs/play-icon.svg" width="60px" height="60px">
                     </span>
                    <?php if(!empty(get_field("featured_video_link_subtitle",$id ))){
                      ?>
                        <span class="featured-video-subtitle">
                            <h4><?php the_field('featured_video_link_subtitle',$id) ?> </h4>
                        </span>
                    <?php } //END Featured Link Subtitle ?>
                </a>
            <?php } //END Featured Link ?>
            </div>
            <div class="colmn-text">
                <h2><?php the_field('title',$id);?></h2>
                <?php the_field('excerpt1',$id);?>
				<?php if(get_field('button_title1',$id)!=''):?>
				<a href="<?php the_field('button_link1',$id);?>" class="btn btn-link"><?php the_field('button_title1',$id);?></a>
            <?php endif;?>
            </div>
        </div>
    </div>
<?php endif; wp_reset_query();?>	

      <div class="sectionTop about-feature">
        <div class="container">
            <div class="row">
            <?php the_content();?>
			</div>
		</div>
	</div>

    <?php wp_reset_query();?>
    <?php if(get_field('title2',$id)!=''):?>
        <div class="section section-textImg sec">
            <div class="container">
                <div class="colmn-text">
                    <h2><?php the_field('title2',$id);?></h2>
                    <?php the_field('excerpt2',$id);?>
                </div>
                <div class="colmn-img bg-control" style="background-image:url(<?php echo get_field('image2',$id);?>);"></div>
            </div>
        </div>
    <?php endif;?>

    <?php wp_reset_query();
   if(get_field('about_content',$id)!=''):
   the_field('about_content',$id);
   endif;



	?>
</main>
<?php

wp_reset_query();
if(have_rows('add_slides_footer',$id)!=''){
	footerSlider($id);
}
wp_reset_query();

?>

<?php get_footer(); ?>
