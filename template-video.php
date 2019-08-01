<?php
/**
  * Template Name: video Template
 */
get_header();
wp_reset_query();

$id = get_the_id();

$large_image = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full');
$placeHolder= __("Search WildAid Videos");
?>
<style>
    #videocont {
        min-width: 100%;
    }

    .view-more-news {margin-top: 20px;}

    .custom-video-slider .slick-slider{
        z-index: 1;
    }

    .video.banner-container .headerVideoPlaylist   {
        margin: 0;
        height: calc((100vw / 2.48) - 140px);
        top: 60px;
    }

    .video.banner-container .headerVideoPlaylist li {
        height: calc(((100vw / 2.48) - 100px) / 3);
        background-size: cover;
        position: relative;
        padding: 0;
    }

    .headerVideoPlaylist li:before {
        content: '';
        position: absolute;
        width: 101%;
        height: 101%;
        opacity: .3;
        z-index: 0;
        background: grey;
    }
    .video.banner-container .headerVideoPlaylist li:hover:before,
    .video.banner-container .headerVideoPlaylist li.selected:before{
        background: linear-gradient(0deg, black 30%, transparent);
    }
    .video.banner-container .headerVideoPlaylist li:hover h5, .video.banner-container .headerVideoPlaylist li.selected h5{
        color: #e17000;
    }
    /*.headerVideoPlaylist li:hover h5:before, .headerVideoPlaylist li.selected h5:before {*/
        /*content: '';*/
        /*border-top: 14px solid transparent;*/
        /*border-bottom: 14px solid transparent;*/
        /*border-right: 17px solid rgba(0,0,0,.7);*/
        /*position: absolute;*/
        /*left: -37px;*/
        /*top: calc(50% - 14px);*/
    /*}*/

    .headerVideoPlaylist li.selected:before {
        opacity: .7;
    }

    .headerVideoPlaylist li:hover:before {
        opacity: .7;
    }

    .video.banner-container .headerVideoPlaylist li a {
        color: #fff;
    }

    .video.banner-container .headerVideoPlaylist li h5 {
        position: absolute;
        bottom: 15px;
        margin: 0 20px;
        color: #fff;
    }

    .now-playing {
        display: none;
        color: #e17000;
        text-transform: uppercase;
        position: absolute;
        top: 10%;
        margin: 0 20px;
    }

    .selected .now-playing {
        display:block;
    }

    .box-4 figcaption {
        height: 4em;
    }


    .search-container{
    display:block;
        width: 40%;
        position: absolute;
      
        right: 10px;
        z-index: 1;
        max-width: 100%;
        align-items: flex-end;
	margin-top: 10px;
    margin-right: 65px;
    }
    .section.tagline {

        background-color:#000000;
        text-align:center;
        height:60px;
       
    }
    
    @media (max-width: 1200px){
        .headerVideoPlaylist {
            display:none;
        }

        .video.banner-container .headerVideoCarousel {
            width: 100%;
        }
    }
    .video.banner-container .headerVideoPlaylist   {
        margin: 0;
        height: calc((100vw /3) - 140px);
        top: 60px;
    }

    .video.banner-container .headerVideoPlaylist li {
        height: calc(((100vw / 3) - 60px) / 3);
        background-size: cover;
        background-position:center;
        position: relative;
        padding: 0;
    }
    .header-background{
        height: calc(100vw / 3);
    }
    .custom-video-slider .header-background{
        width:calc((100vw / 3.3)*2.5);
        margin-top:60px;
        height: calc(100vw / 3.3);
    }
    .headerVideoCarousel .slick-slider{
        height: calc(100vw / 3);
    }

    @media (min-width: 1200px) and (max-width: 1600px){

        .custom-video-slider .cover-text .colmn{
            bottom: -40px;
        }


    }
    @media (max-width: 1200px){
        .header-background{
            width: 100%;
            height: calc(100vw / 2.48);
        }
        .custom-video-slider .header-background{

            margin-top:60px;
            width: 100%;
            height: calc(100vw / 2.48);
        }
        .headerVideoCarousel .slick-slider{
            height: calc(100vw / 3);
        }

        .custom-video-slider .header-background{
            width: 100%;
            height: calc(100vw / 2.48);
        }
        .custom-video-slider .cover-text .colmn{
            bottom: -40px;
        }
    }
    @media screen and (max-width: 640px) {
        
    .search-container{

        width: 100%!important;
        margin-right: 0px!important;
        padding: 0 10px!important;
        right:0!important

    }   
        .custom-video-slider .header-background{
       
        margin-top:0px!important;
      
    }
    }

</style>


<div class="banner-container video">
    <!--<div class="row-section slider-inner header-background" style="background-image: url('<?php echo $large_image[0]; ?>')"> -->
    <?php
    if(have_rows('add_slides',$id)!='') {
        //wildaidSlider($id);
    }
    ?>
    <div class="row-section slider-inner header-background" style="background-color: #000">
    <?php
	displayVideoPlaylistBanner($id);
    //if(have_rows('add_slides',$id)!='') {

    //}
    ?>


        <h1 class="page-title"><?php the_title();?></h1>
    </div> <!-- END header-background -->

</div> <!-- END banner-container -->

<main>
    <div class="section tagline">
        <div class="container">
            <div class="flex search-container videos" >

                <form action="<?php echo site_url();?>/resource" id="videosearch"  method="POST">
                    <input type="hidden" name="searchtype" id="hiddenSearchType" value="videos" />
                    <input type="text" placeholder="<?php echo $placeHolder ?>" name="searchField" id="searchField" class="form-control" >
                    <button type="submit" form="videosearch"  value="Submit" class="btn btn-site search" >
				        <?php echo file_get_contents( get_template_directory()."/svgs/search.svg"); ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="section section-02 paddTop0 box-4 mt60">
        <div class="container">
            <div class="row loaddiv" id="videocont">
	             <?php $video_args=  array( 'post_type'=>'resources',
										'orderby' 			=> 'post_date',
										'order' 			=> 'DESC',
                                         'meta_key' => 'wildaid_resource_is_featured',
                                         'meta_value' => 'on',
										'tax_query' => array(
										   array(
											'taxonomy' => 'resource-type',
											'field'    => 'slug',
											'terms'    => 'video',
											'numberposts' => -1,
										   ),
										),
                                        'posts_per_page' => -1
									);

	          
	        	$video_loop = new WP_Query( $video_args );
        
				if($video_loop->have_posts()):		
					while($video_loop->have_posts()): $video_loop->the_post();
					$post_id=get_the_id();
					$large_image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full');
					$wildaid_resourcesfile= get_post_meta($post_id,'wildaid_resource_file',true);
					$wildaid_resource_is_featured= get_post_meta($post_id,'wildaid_resource_is_featured',true);
					$wildaid_resource_file_duration= get_post_meta($post_id,'wildaid_resource_file_duration',true);
					$post_url = get_post_permalink($post_id);

                    $video_type=videoType($wildaid_resourcesfile);


                     if ($video_type ==="youtube" || $video_type==="vimeo" ) { ?>
                         <div class="colmn video">
                                 <figure>
                                     <?php
                                     echo do_shortcode( '[fve]' . $wildaid_resourcesfile . '[/fve]' );
                                     ?>
<!--                                     <div class="time">--><?php //echo get_the_date( 'H:i' ); ?><!--</div>-->
                                 </figure>
                                 <figcaption>
                                     <h5><a href="<?php echo $post_url; ?>"><?php echo get_the_title();?></a></h5>
                                 </figcaption>

                         </div>
                         <?php
                     }


                 endwhile;endif;?>



            </div>

            <div class="text-center view-more-news">
                <a href="/resource/?searchtype=videos" class="btn btn-link">VIEW MORE VIDEOS</a>
            </div>

        </div>
    </div>
    
   
</main>

<?php get_footer(); ?>
<!--<script src="https://code.jquery.com/jquery-1.10.2.js"></script>-->
<script>
jQuery.fn.size = function() {
	return this.length;
};
jQuery(document).ready(function () {	
    size_li = jQuery(".loaddiv .colmn").size();
	//alert(size_li);
    x=15;
    jQuery('.loaddiv .colmn:lt('+x+')').show();
    jQuery('#loadMore').click(function () {
        x= (x+15 <= size_li) ? x+15 : size_li;
        jQuery('.loaddiv .colmn:lt('+x+')').show();
		if(x >= size_li)
		{
			jQuery('#loadMore').hide();
		}
    });
	if(x >= size_li)
	{
		jQuery('#loadMore').hide();
	}
   /* jQuery('#showLess').click(function () {
        x=(x-5<0) ? 3 : x-5;
        jQuery('#myList li').not(':lt('+x+')').hide();
    });*/
});	


<?php get_footer(); ?>


