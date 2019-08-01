<?php
/**
  * Template Name: Ways to Give Template
 */
get_header();
?>
<style>


    .wayGive .imageCaption h5 {
        color: #000;
    }

    .link {
        color: #e17000;
    }
    .section-textImg.sec .colmn-text{
        overflow:hidden;
    }
</style>


<?php

$id=get_the_id();
$large_image = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full');
$image_gallery_html = get_image_gallery_html("wildaid_page_image_gallery","image-gallery", "large");
displayBanner();
?>

<main class="ourTeam">
    <div class="sectionTop section-textImg">
        <div class="container">
            <div class="colmn-img bg-control" style="background-image:url(<?php echo get_field('image1',$id);?>);">

			        <?php echo $image_gallery_html; ?>

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
    <div class="section wayGive">
            <div class="container">
                <div class="row">
				<?php if(have_rows('team',$id)):
				while(have_rows('team',$id)): the_row();
					$team_title     = get_sub_field('team_title');
					$team_image_id     = get_sub_field('team_image');
					$team_excerpt = get_sub_field('team_excerpt');
					$image= wp_get_attachment_image_src( $team_image_id, "news-block" )[0];
					$button_url     = get_sub_field('button_url');
                    $new_window     = get_sub_field('new_window');
                    $is_download    = get_sub_field('is_download');

                    $target = ((isset($new_window[0]) && $new_window[0]) ? "_blank" : "");

				?>	
                <div class="colmn  eq-height">
	                <?php if($button_url) {   ?>
                        <a href="<?php echo $button_url;?>" class="next" target="<?php echo $target ?>">
                    <?php } ?>
                        <div class="imageCaption">

                            <div class="image">

                                <?php if($team_excerpt){?>
                                    <div class="box-overlay">
                                        <p><?php echo $team_excerpt;?></p>
                                    </div>
                                <?php } ?>

                                <img src="<?php echo $image;?>"  alt="">

                                <?php if($is_download) { ?>
                                    <span class="downButton"><i aria-hidden="true"></i></span>
                                <?php } ?>

                            </div>

                            <figcaption>
                                <h5><?php echo $team_title;?></h5>
		                        <?php if($button_url) {   ?>
			                        <?php echo file_get_contents(get_template_directory()."/svgs/arrow-3.svg") ?>
		                        <?php } ?>
                            </figcaption>

                        </div>

                     <?php if($button_url) {   ?>
                        </a>
                    <?php } ?>

                </div>
				<?php endwhile;endif;?>

                </div>
            </div>
            </div>
        </div>
		<?php wp_reset_query();?>
		<?php if(get_field('title2',$id)!=''):?>
		<div class="section section-textImg sec paddTop0 bottom-gallery">
                <div class="container">
                    <div class="colmn-text">
                        <h2><?php the_field('title2',$id);?></h2>
                        <?php the_field('excerpt2',$id);?>
                    </div>
                    <div class="colmn-img bg-control" style="background-image:url(<?php echo get_field('image2',$id);?>);"></div>
                </div>
            </div>
		<?php endif;?>	
</main>

<?php get_footer(); ?>
