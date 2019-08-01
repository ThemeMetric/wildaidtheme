<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header();

$id				=	get_the_id();
$programId      = get_the_id();
$post_meta 		= get_post_meta($id);
$image_gallery_html = get_image_gallery_html("wildaid_program_image_gallery","image-gallery", "large");
//print_r($post_meta);
$publicationLimit = 2;
$newsLimit = 2;
$ambassadorLimit = 2;

$content =wpautop( get_the_content());
displayVideoBanner();
?>
<style>
    .related-news {
        margin-top: 20px;
    }

    .realted-news-header {
        margin-bottom: 4px;
    }
    .aHeading h3, .h-p-ul h3, .colmn-left h4{
        margin-bottom:.5em;
    }
    .single-programs .related-programs .aHeading h3{
        margin-bottom:0em;
    }
    .meet-the-ambassadors{
        margin-top:20px;
    }
    .copy-list{
        margin-top:20px;
    }
    .single-programs .related-programs{
        margin-top:40px;
    }
    .single-programs .video-gallery-container{

    }
    .related-news{
        margin-top:10px;
    }
   .single-programs .related-programs.publications{
        margin-top:0px;
    }
    .single-programs .related-programs.recent-news{
        margin-top:50px;
        margin-bottom:50px;
    }
    @media (max-width: 1400px){

        .related-programs .col-md-6 {
            padding: 0px;
            padding-bottom: 1em;
            width: 100%;
        }
        .related-programs .col-md-6:last-child{
            padding-bottom:0;
        }
    }
</style>
<main>
	<div class="sectionTop section-textImg">
		<div class="container">




			<!--  -->

            <div class="colmn-img bg-control">

				<?php echo $image_gallery_html; ?>


                <!-- NEWS -->
                <div class="related-programs recent-news">
                    <div class="aHeading">
						<?php
						wp_reset_query();

						$news = get_posts(array(
							'post_type' => 'post',
							'meta_query' => array(
								array(
									'key' => 'wildaid_post_related_programs',
									'value' => '"' . $id . '"',
									'compare' => 'LIKE'
								)
							),
                            'posts_per_page' => $newsLimit,
						));

                        //print_r($news);

						if( $news ) {
                            echo "<h3 class='related-news-header'><a href=\"/resource/?searchtype=news&program-dropdown=".$id."\">RELATED NEWS</a></h3>";
                            foreach( $news as $post ) :
                                $p_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'related-type');
                                ?>
                                <div class="related-news colmn grid-item col-md-6 col-sm-6 col-xs-12"">

                                    <figure>
                                        <div class="box-overlay">
                                            <a href="<?php echo get_the_permalink($post->ID);?>"><button type="button" class="btn btn-site">View Article</button></a>
                                        </div>
                                        <img src="<?php echo $p_image[0];?> ">
                                    </figure>
                                    <figcaption>
                                        <h5 class="">
                                            <a class="page-link ellipsis-multiline" href="<?php echo get_the_permalink($post->ID);?>"><?php echo $post->post_title; ?></a>
                                        </h5>
                                        <span class="date"><?php echo get_the_date('F j, Y'); ?></span>
                                    </figcaption>
                                </div>

                            <?php
                        endforeach ; //endforeach;
                    };
					?>
                </div>
            </div>

            <!-- PUBLICATIONS -->
            <?php

            $wildaid_resources= get_post_meta($id,'wildaid_program_related_resources',true);

            if (!empty($wildaid_resources)) {
                $args = array(
                    'post_type' => 'resources',
                    'post__in' => $wildaid_resources,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'resource-type',
                            'field' => 'slug',
                            'terms' => 'publication',
                            'numberposts' => -1,
                        ),
                    )
                );

                $custom_query = get_posts($args);

                //print_r($custom_query);
                // Need to preserve order so we need to use the original array structure...
                $publications = array();
                foreach ($custom_query as $post) {
                    $publications[$post->ID] = $post;
                }


                if (!empty($custom_query)) {
                    ?>
                    <div class="related-programs publications">
                        <div class="aHeading">
                            <?php wp_reset_query();?>
                            <h3><a href="/resource/?searchtype=publications&program-dropdown=<?php echo $id ?>">PUBLICATIONS</a></h3>
                        </div>
                        <ul class="copy-list">
                            <?php
                                $cntItem = 0;
                                foreach ($wildaid_resources as $postId) {
                                    if (isset($publications[$postId])) {
                                        $cntItem++;

                                        if($cntItem > $publicationLimit){
                                            break;
                                        }

                                        $post = $publications[$postId];

                                        setup_postdata($post);
                                        $file_id = get_the_id();
                                        $wildaid_resourcesfile = get_post_meta($file_id, 'wildaid_resource_file', true);
                                        ?>
                                        <li>
                                            <a href="<?php echo $wildaid_resourcesfile; ?>"><?php the_title(); ?></a>
                                        </li>
                                        <?php

                                    }
                                }

                            ?>

                        </ul>

                    </div>
                    <?php
                }
            }


            // MEET THE AMBASSADORS
            $related_ambassador_ids= get_post_meta($programId,'wildaid_program_related_ambassadors',true);
            wp_reset_query();
            $args = array('post_type'=> 'ambassadors','post__in' =>$related_ambassador_ids);
            $ambassador_query = get_posts($args);

            // Need to preserve order so we need to use the original array structure...
            $ambassadors = array();
            foreach ($ambassador_query as $item) {
                $ambassadors[$item->ID] = $item;
            }


            if(!empty($ambassadors)){
                ?>
                <div class="related-programs">
                    <div class="aHeading">
                        <h3><a href="/about/ambassadors">Meet the Ambassadors</a></h3>
                    </div>
                    <ul class="meet-the-ambassadors">
                        <?php
                        $cntItem = 0;
                        foreach ($related_ambassador_ids as $ambassadorId) {
                            $ambassador = $ambassadors[$ambassadorId];

                            $cntItem++;
                            if($cntItem > $ambassadorLimit){
                                break;
                            }

                            $image = getAmbassadorImageUrl($ambassador->ID, 'news-block-small-top');
                            ?>

                            <li>
                                <figure>
                                    <a href="<?php the_permalink($ambassador->ID);?>" data-id="<?php echo $ambassador->ID; ?>"> <img src="<?php echo $image ?>" alt=""></a>
                                </figure>
                                <figcaption>
                                <a href="<?php  the_permalink($ambassador->ID);?>" data-id="<?php echo $ambassador->ID; ?>">
                                    <span><?php echo $ambassador->post_title;?></span>
                                    <?php echo file_get_contents(get_template_directory()."/svgs/arrow-3.svg") ?></a>
                                </figcaption>
                            </li>
                            <?php
                        } // End FOREACH
                    ?>
                </ul>
                </div> <!-- END Meet the ambassadors -->
            <?php
            } // END If have posts?>
        </div>




        <div class="colmn-text headtopzero">

            <h2><?php
	            wp_reset_query();
                echo $post_meta['wildaid_program_subtitle'][0];?></h2>
			<?php echo $content; ?>

            <!-- STATISTICS -->
            <ul class="col-3ul">
                <li class="statistic left"><span><?php echo $post_meta['wildaid_program_statistic_1'][0]; ?></span><br>
					<?php echo $post_meta['wildaid_program_statistic_description_1'][0]; ?></li>
                <li class="statistic center"><span><?php echo $post_meta['wildaid_program_statistic_2'][0]; ?></span><br>
					<?php echo $post_meta['wildaid_program_statistic_description_2'][0]; ?></li>
                <li class="statistic right"><span><?php echo $post_meta['wildaid_program_statistic_3'][0]; ?></span><br>
					<?php echo $post_meta['wildaid_program_statistic_description_3'][0]; ?></li>
            </ul>

            <!-- MORE CONTENT TITLE -->
			<?php if (isset($post_meta['wildaid_program_more_info_title'])) { ?>
                <h2 class="more-header"><?php echo $post_meta['wildaid_program_more_info_title'][0]; ?></h2>
			<?php } ?>

            <!-- MORE CONTENT -->
			<?php
			if (isset($post_meta['wildaid_program_more_info_description'])) {
				echo apply_filters('the_content', $post_meta['wildaid_program_more_info_description'][0]);
			}
			?>



            <!-- AMBASSADOR VIDEOS -->

            <div class="video-gallery-container">


                <div class="aHeading">
                    <h3><a href="/videos">Ambassador Videos</a></h3>

                </div>
                <div class="inner">
                    <div class="video-gallery">
                        <?php
                        $related_ambassador_video_ids= get_post_meta($id,'wildaid_program_related_ambassador_videos',true);
                        //print_r($related_ambassador_video_ids);

                        wp_reset_query();
                        $args = array('post_type'=> 'resources','post__in' => $related_ambassador_video_ids);
                        $relatedAmbassadorVideos = get_posts($args);

                        $current = true;

                        // Need to preserve order so we need to use the original array structure...
                        $ambassadorVideos = array();
                        foreach ($relatedAmbassadorVideos as $video) {
                            $ambassadorVideos[$video->ID] = $video;
                        }


		                foreach ($related_ambassador_video_ids as $videoId) {

		                    $video = $ambassadorVideos[$videoId];
			                $video_url = get_post_meta( $video->ID, 'wildaid_resource_file', true );

			                if ( videoType( $video_url ) != "unknown" ) {
				                ?>
                                <div class="<?php if ( $current ) {echo 'current'; $current = false;} ?> video" id="content-<?php echo $video->ID; ?>">
					                <?php echo do_shortcode( '[fve]' . $video_url . '[/fve]' ); ?>
                                </div>
				                <?php

			                } //END IF VIDEO UNKNOWN
		                } // END FOREACH

		                ?>
                    </div>
                    <div class="video-gallery-column">

                        <ul class="video-gallery-navigation">

							<?php
							$current = true;

                            // Need to preserver order so we need to use the original array structure...
                            foreach ($related_ambassador_video_ids as $videoId) {
                                $video = $ambassadorVideos[$videoId];
                                if ( videoType( $video_url ) != "unknown" ) {
                                    ?>
                                    <li class="<?php if ( $current ) {
                                        echo 'current';
                                        $current = false;
                                    } ?>">
                                        <i class="fa fa-caret-right" aria-hidden="true"></i><a href="#" data-id="<?php echo $video->ID; ?>"><span><?php echo $video->post_title; ?></span></a>
                                    </li>
                                    <?php

                                }
							} // End FOREACH

							?>
                        </ul>



                    </div>

                </div>
            </div> <!-- END OF VIDEO GALLERY CONTAINER -->


        </div>
        </div>
    </div>

<?php
wp_reset_query();
?>




 <div class="custom-paginate clearfix">
    <div class="container">

    	<div class="    center-text">
            <a class="single-view-all" href="/program/"><?php echo file_get_contents( get_template_directory()."/svgs/menu.svg"); ?> View All Programs</a>

            <?php

				$next_post = get_previous_post();
				$prev_post = get_next_post();	
				
				if(isset($prev_post->ID) && $prev_post->ID!=''):
					echo '<a  class="single-prev" href="'.get_the_permalink($prev_post->ID).'">'. file_get_contents( get_template_directory()."/svgs/arrow-right.svg").' Previous Program</a>';
				endif;

				if(isset($next_post->ID) && $next_post->ID!=''):
					echo '<a  class="single-next" href="'.get_the_permalink($next_post->ID).'">Next Program '. file_get_contents(get_template_directory()."/svgs/arrow-right.svg").'</a>';
				endif;
				?>

			</div>
	</div>
		</div>
</main>
<link href="<?php bloginfo('template_url') ?>/css/fancybox.css" rel="stylesheet" type="text/css">
<style type="text/css">

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
jQuery( document ).on( "click", "#ambs li", function() {

	var id = parseInt(jQuery(this).attr('id'));
	jQuery(".current").removeClass("current");
	jQuery("#"+id).addClass("current");
	
	jQuery.ajax({
		url : "<?php echo get_admin_url();?>admin-ajax.php",
		type : "post",
		data : {
			action : "ambsgal_ajax_function",
			id : id
		},
		success : function( response ) {
			
			jQuery(".videoSlider").html( response );
		}
	});
});
 
  </script>
