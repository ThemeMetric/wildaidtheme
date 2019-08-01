<?php
/**
  * Template Name: Our Team Template
 */
get_header(); 
?>
<style>
    .page-template-template-our-team .sectionTop, .page-template-template-our-team .wayGive {
        float: none;
    }

    .page-template-template-our-team .wayGive {
        padding-bottom: 30px;
        margin-bottom: 0px;
    }

    .ourTeam .imageCaption h5 {
        color: #000;
    }

    .link {
        color: #e17000;
    }

    .wayGive .colmn .box-overlay a.overlay{
        color: #fff;
        display: block;
        height: 1px;
        width: 1px;
        overflow: hidden;
        transition: all .1s ease 0s;
        transition-delay: .1s;
        -webkit-transition: all .1s ease 0s;
        transition-delay: .1s;
    }

    .wayGive .colmn:hover .box-overlay a.overlay {
        width: 100%;
        height: 100%;
        overflow: visible;
    }


    .wayGive figcaption a {
        display: block;
        width: 100%;
        height: 100%;
    }
</style>


<?php
$id=get_the_id();
$large_image = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full');
$image_gallery_html = get_image_gallery_html("wildaid_page_image_gallery","image-gallery", "large");
if(empty($image_gallery_html)){
$featured_image_url= get_field('image1',$id);
}

displayBanner();
?>

<main class="ourTeam">
    <div class="sectionTop section-textImg">
        <div class="container">
            <div class="colmn-img bg-control" style="background-image:url(<?php echo $featured_image_url;?>);">

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

                    $target = "";
                    if (is_array($new_window)) {
                        if ($new_window[0]) {
                            $target = "_blank";
                        }
                    }

				?>	
                <div class="colmn eq-height">

                    <?php if(!$team_excerpt){?><a href="<?php echo $button_url;?>" class="next" target="<?php echo $target ?>"><?php } ?>
                        <div class="imageCaption">
                            <div class="image">
                                <?php if($team_excerpt){?>
                                    <div class="box-overlay">
                                        <a href="<?php echo $button_url;?>" class="next overlay" target="<?php echo $target ?>"><p><?php echo $team_excerpt;?></p></a>
                                    </div>
                                <?php } ?>
                                <img src="<?php echo $image;?>"  alt="">
                                <?php if($is_download) { ?>
                                <span class="downButton"><i aria-hidden="true"></i></span>
                                <?php } ?>
                            </div>
                            <figcaption>
                                <?php if($team_excerpt){?><a href="<?php echo $button_url;?>" class="next" target="<?php echo $target ?>"><?php } ?>
                                <h5><?php echo $team_title;?></h5>
                                <?php if($button_url) {   ?>
                                    <?php echo file_get_contents(get_template_directory()."/svgs/arrow-3.svg") ?>
                                <?php } ?>
                                <?php if($team_excerpt){?></a><?php } ?>
                            </figcaption>

                        </div>
                    <?php if(!$team_excerpt){?></a><?php } ?>
                </div>
				<?php endwhile;endif;?>

		   </div>  
            </div>
            </div>
        </div>
		<?php wp_reset_query();?>
		<?php if(get_field('title2',$id)!=''):?>
		<div class="section section-textImg sec paddTop0">
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
