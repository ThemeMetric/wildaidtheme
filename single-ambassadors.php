<?php
/**
 * The template for displaying ambassador details
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header();
$id				=	get_the_id();
$content        = wpautop( $post->post_content); //get_the_content();
$title          = $post->post_title;
$post_meta 		= get_post_meta($id);

// Use the program ID to get the first program image used for the hero image of the ambassador
$programs = (unserialize($post_meta['wildaid_ambassador_related_programs'][0]));
$programId = '';
if ($programs) {
    $programId = $programs[0];
}


$image_gallery_html = get_image_gallery_html("wildaid_ambassador_image_gallery","image-gallery", "large");



displayVideoBanner($programId);
?>
<main>
    <div class="sectionTop section-textImg ">
        <div class="container">
            <div class="colmn-img bg-control" style="background-image:url(<?php echo get_field('image1',$id);?>);">

                <div class="colmn-img bg-control" style="background-image:url(<?php echo get_field('image1',$id);?>);">

				            <?php echo $image_gallery_html; ?>


                </div>
            </div>
            <!--  -->
            <div class="colmn-text headtopzero">
                <h2><?php echo $post_meta['wildaid_ambassador_subtitle'][0];?></h2>
                <?php echo $content; ?>

            </div>
        </div>
    </div>

    <div class="section section-textImg ">

        <div class="container">
            <div class="colmn-img bg-control">

            <!-- PROGRAMS -->
            <div class="related-programs single-ambassadors">
                <div class="aHeading">
                    <h3><a href="/resource/?searchtype=programs&ambassador-dropdown=<?php echo $id; ?>">RELATED PROGRAMS</a></h3>
                    <?php

                    wp_reset_query();

                    $programs = (unserialize($post_meta['wildaid_ambassador_related_programs'][0]));

                    if( $programs ):
                        foreach( $programs as $program ) :
	                        $image_id = get_post_meta( $program, 'wildaid_program_thumbnail_id', 1 );
	                        if($image_id){
		                        $p_image =  wp_get_attachment_image_src( $image_id, 'ambassador-program' );
	                        }
	                        else {
		                        $p_image = wp_get_attachment_image_src( get_post_thumbnail_id( $program ), 'ambassador-program' );
	                        }
                            ?>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="imageCaption mb20 ">
                                    <img src="<?php echo $p_image[0];?> ">
                                    <figcaption>
                                        <h5> <a href="<?php echo get_the_permalink($program);?>"><?php echo get_the_title($program); ?></a></h5>
                                        <a href="<?php echo get_the_permalink($program);?>" class="next"><?php echo file_get_contents(get_template_directory()."/svgs/arrow-3.svg") ?></a>
                                    </figcaption>
                                </div>
                            </div>

                            <?php
                        endforeach ; //endforeach;
                    endif;
                    ?>
                </div>
            </div>

        </div>
        <!--  -->
        <div class="colmn-text headtopzero">


            <!-- AMBASSADORS -->
                <?php
                $videos = get_posts(array(
	                'post_type' => 'resources',
	                'posts_per_page'   => 4,
	                'meta_query' => array(
		                array(
			                'key' => 'wildaid_resource_related_ambassadors',
			                'value' => '"' . $id . '"',
			                'compare' => 'LIKE'
		                )
	                ),
	                'tax_query' => array(
		                array(
			                'taxonomy' => 'resource-type',
			                'field' => 'slug',
			                'terms' => 'video', // Where term_id of Term 1 is "1".
			                'include_children' => false
		                )
	                )
                ));

                $wildaid_resources = get_post_meta($id,'wildaid_ambassador_related_resources',true);


                if (!empty($wildaid_resources)) {
                    $args = array(
                        'post_type' => 'resources',
                        'post__in' => $wildaid_resources,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'resource-type',
                                'field' => 'slug',
                                'terms' => 'video',
                                'numberposts' => -1,
                            ),
                        )
                    );
                    $videos = get_posts($args);

                }


                if (!empty($videos)){
                ?>

                <div class="video-gallery-container">
                    <div class="aHeading">
                        <h3>View <?php echo $title; ?> Videos</h3>
                    </div>
                    <div class="inner">
<!--                        <div class="video-gallery-abstract">-->
<!--                            --><?php //echo get_post_meta($id,"wildaid_ambassador_video_gallery_summary",true); ?>
<!--                        </div>-->

                        <div class="video-gallery ">
                                <?php
                                rewind_posts();
                                $current=true;
                                foreach($videos as $video){
                                    $video_url = get_post_meta($video->ID,'wildaid_resource_file',true);

                                    if(videoType($video_url) !="unknown"){
                                        if($current){
                                            $current=false;
                                            ?>
                                            <div class="current video" id="content-<?php echo $video->ID; ?>">

                                        <?php
                                        }
                                        else {?>
                                            <div class="video"  id="content-<?php echo $video->ID; ?>">
                                        <?php
                                        }
                                        ?>

                                            <?php echo do_shortcode( '[fve]' . $video_url . '[/fve]' );?>
                                        </div>
                                    <?php
                                    }
                                }
                                ?>
                        </div>


                        <div class="video-gallery-column">

		                    <?php
		                    $current=true;
		                    ?>

                            <ul class="video-gallery-navigation">
			                    <?php
			                    foreach($videos as $video){
				                    ?>
                                    <li class="<?php if($current){ echo 'current'; $current=false;}?>">
                                        <i class="fa fa-caret-right" aria-hidden="true"></i><a  data-id="<?php echo $video->ID; ?>" href="#" ><?php echo $video->post_title; ?></a>
                                    </li>
				                    <?php
			                    }
			                    ?>
                            </ul>


                        </div>
                    </div>
                </div> <!-- END OF VIDEO GALLERY CONTAINER -->
            <?php } //END HAVE_POSTS ?>


                <div class="aHeading  notop">
                    <h3><a href="/resource/?searchtype=news&ambassador-dropdown=<?php echo $id ?>">Related News</a></h3>
                </div>
                <div class="aHeading">
                    <h3><a href="/about/get-involved/">Get Involved</a></h3>
                </div>

            </div>


        </div>
    </div>
    </div>
    <?php
    wp_reset_query();
    ?>




    <div class="custom-paginate clearfix">
        <div class="container">

            <div class="center-text">
                <a class="single-view-all" href="/about/ambassadors/"> <?php echo file_get_contents( get_template_directory()."/svgs/menu.svg"); ?> View All Ambassadors</a>
                <?php


                $next_post = get_previous_post();
                $prev_post = get_next_post();

                if(isset($prev_post->ID) && $prev_post->ID!=''):
                    echo '<a class="single-prev"  href="'.get_the_permalink($prev_post->ID).'">'. file_get_contents( get_template_directory()."/svgs/arrow-right.svg").' Previous Ambassador</a>';
                endif;
                echo "&nbsp;&nbsp; ";
                if(isset($next_post->ID) && $next_post->ID!=''):
                    echo '<a class="single-next" href="'.get_the_permalink($next_post->ID).'">Next Ambassador '. file_get_contents(get_template_directory()."/svgs/arrow-right.svg").' </a>';
                endif;
                ?>

            </div>
        </div>
    </div>
</main>
<link href="<?php bloginfo('template_url') ?>/css/fancybox.css" rel="stylesheet" type="text/css">
<style type="text/css">
    #ambs li{cursor: pointer;}
    .current{color:#e17000;}
</style>
<?php get_footer();?>
<script src="<?php bloginfo('template_url') ?>/js/jquery.mousewheel.pack.js"></script>
<script src="<?php bloginfo('template_url') ?>/js/fancybox-pack.js"></script>
<script src="<?php bloginfo('template_url') ?>/js/custom-fancy.js"></script>

<script>

    /*
     jQuery('.vertical-center-4').slick({
     slidesToShow: 1,
     slidesToScroll: 1,
     arrows: true,
     fade: true,
     //asNavFor: '.slider-nav1'
     });
     jQuery('.slider-for1').slick({
     slidesToShow: 1,
     slidesToScroll: 1,
     arrows: false,
     fade: true,
     asNavFor: '.slider-nav',
     autoplay: true
     });
     jQuery('.slider-nav').slick({
     slidesToShow: 2,
     slidesToScroll: 1,
     asNavFor: '.slider-for1',
     dots: false,
     centerMode: true,
     focusOnSelect: true

     });
     */

//    jQuery( document ).on( "click", "#ambs li", function() {
//
//        var id = parseInt(jQuery(this).attr('id'));
//        jQuery(".current").removeClass("current");
//        jQuery("#"+id).addClass("current");
//
//        jQuery.ajax({
//            url : "<?php //echo get_admin_url();?>//admin-ajax.php",
//            type : "post",
//            data : {
//                action : "ambsgal_ajax_function",
//                id : id
//            },
//            success : function( response ) {
//
//                jQuery(".videoSlider").html( response );
//            }
//        });
//    });

</script>
