<?php
/**
 Template Name: Home Template
 */

get_header(); 
$id=get_the_id();
$large_image = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full');


?>

<style>
    main{
    	position:relative;
	}
    .section-textImg.top-feature{
        padding-top:60px;
    }
    .home .custom-video-slider .slider-inner  h4{
        font-size: 48px;
        font-family: 'Knockout48';
        font-weight: 400;
        line-height: 1.2;
        text-transform:initial;
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

    .headerVideoPlaylist li:before {
        content: '';
        position: absolute;
        width: 101%;
        height: 101%;
        opacity: .5;
        z-index: 0;
        background: black ;
    }
    .video.banner-container .headerVideoPlaylist li:hover:before,
    .video.banner-container .headerVideoPlaylist li.selected:before{
        opacity:0;
    }

    .video.banner-container .headerVideoPlaylist li:hover h5, .video.banner-container .headerVideoPlaylist li.selected h5{
        color: #e17000;
    }

    .headerVideoPlaylist li.selected:before {

    }

    .headerVideoPlaylist li:hover:before {

    }
    .video.banner-container .headerVideoPlaylist{
        width:25%;
    }
    .video.banner-container .headerVideoPlaylist li a {
        color: #fff;
    }

    .video.banner-container .headerVideoPlaylist li h5 {
        position: absolute;
        bottom: 15px;
        margin: 0 20px;
        color: #fff;
        display:none;
    }
    .headerVideoCarousel button.slick-next,
    .headerVideoCarousel button.slick-prev{
        display:none!important;
    }
    .play-button{
        top:44%;
    }
    @media (max-width: 1024px){
        .headerVideoPlaylist {
            display:none;
        }

        .video.banner-container .headerVideoCarousel {
            width: 100%;
        }
        .headerVideoCarousel button.slick-next,
        .headerVideoCarousel button.slick-prev{
            display:inline-block!important;
        }
    }

   
    .headerVideoCarousel button.next {
        top: 50%;
        right:15px;
        transform: translateY(-50%);
        background: url(/wp-content/themes/wildaidtheme/svgs/arrow-image-gallery.svg);
        background-size: 100px 70px;
        background-position: center;
	z-index:10;
    }

    .headerVideoCarousel button.prev {
        top: 50%;
        left: 15px;
        transform: rotate(180deg) translateY(50%);
        background: url(/wp-content/themes/wildaidtheme/svgs/arrow-image-gallery.svg);
        background-size: 100px 70px;
        background-position: center;
    }

    @media (max-width:779px) {
        .home .custom-video-slider .slider-inner h4 {
            font-size:30px;
        }
    }
    @media (max-width:500px) {
       .home .custom-video-slider .slider-inner h4 {
            font-size:25px;
        }
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
            bottom: -50px;
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
    @media (max-width: 600px){
        .home .custom-video-slider .slider-inner h4{

        }


    }

    @media (max-width: 775px){
        .play-button{
            top: 10%;
            left: auto;
            right: 45%;
            width: 60px;
            height: 60px;
            bottom: 20%;
            display:none;
        }
        .custom-video-slider .cover-text .colmn{

        }
        .headerVideoCarousel button.slick-next{
            top:60%;
        }
        .headerVideoCarousel button.slick-prev{
            top:60%;
        }
        .custom-video-slider .header-background,.header-background {
            margin-top:0px;
            height: calc(100vw / 2);
        }

    }
    @media (max-width: 415px){

        .home .custom-video-slider .slider-inner h4{
            font-size:18px;
        }
        .home .custom-video-slider .cover-text .colmn{
            bottom: -30px;
            left:20%;
            width:70%;
        }
        .play-button{

            right:30px;
            width: 30px;
            height: 30px;
            bottom: 80%;

	    }
    }
    
</style>

<div class="banner-container video">

    <div class="row-section slider-inner header-background" style="background-color: #000">
      <?php  //$id=get_the_id();

        $slides= getCarouselSlides("wildaid_hero_carousel");


	    if(!empty($slides)){

		    ?>
            <div class="headerVideoCarousel">

			    <?php
			    wildaidSlider($id, '', 'video-header-carousel');
			    ?>
            </div> <!--END headerVideoCarousel -->


            <div class="headerVideoPlaylist">
                <ul>
				    <?php
				    $cntVideo=0;
				    foreach($slides as $slide){
					    $selected="";
					    if($cntVideo == 0){
						    $selected="selected";
					    }

					    //print_r($slide);
					    ?><a href="#" >
                        <li class="<?php echo $selected; ?> video-popup-selector" data-slide="<?php echo $cntVideo; ?>" style="background-image: url('<?php echo $slide["background_image"][0] ?>')">

                        </li></a>

					    <?php
					    $cntVideo++;
				    }
				    ?>
                </ul>
            </div>
		    <?php
	    } //END add_slides   ?>


    </div> <!-- END header-background -->

</div> <!-- END banner-container -->




<main>

    <div class="section section-textImg top-feature ">
<!--        <div class="side-panel"><span>Featured</span></div>-->
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
            <!--  -->
            <div class="colmn-text headtopzero">
                <h2><?php the_field('title',$id);?></h2>
                <?php the_field('excerpt1',$id);?>
				<?php if(get_field('button_title1',$id)!=''):?>
				<a href="<?php the_field('button_link1',$id);?>" class="btn btn-link"><?php the_field('button_title1',$id);?></a>
            <?php endif;?>
			</div>
        </div>
    </div>


    <div class="section section-02 paddTop0 featured-news">
<!--        <div class="side-panel"><span>News</span></div>-->
        <div class="container">
            <div class="row">
			<?php wp_reset_query();
			$post_arr=array(
								'post_type'			=> 'post',
								'posts_per_page' 	=> 3,
								'orderby' 			=> 'post_date',
								'order' 			=> 'DESC'
							);
            $post_query=new WP_Query($post_arr);

            if($post_query->have_posts()):
				while($post_query->have_posts()) : $post_query->the_post();
			    	$post_id=get_the_id();
					if (has_post_thumbnail($post_id)) {
						$large_image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'news-block');
					}
			        ?>

                    <div class="colmn grid-item">

                        <figure>
                            <div class="box-overlay">
                                <a href="<?php echo get_permalink(); ?>"><button type="button" class="btn btn-site">View Article</button></a>
                            </div>
                            <span class="label">Recent News</span>
                            <img src="<?php echo $large_image[0];?>" alt="<?php echo get_the_title();?>">

                        </figure>
                        <figcaption>
                            <h5><a class="page-link" href="<?php echo get_permalink(); ?>"><span class="ellipsis-multiline"><?php echo get_the_title();?></span></a></h5>
                            <span class="date"><?php echo get_the_date('F j, Y'); ?></span>
                        </figcaption>
                    </div>
			        <?php
                endwhile;
                ?>
                
                <div class="row-section text-center view-more-news">
                    <a href="<?php echo get_the_permalink(69);?>" class="btn btn-link">View More News</a>
                </div>
			<?php endif;?>	
            </div>
        </div>
    </div>


	<?php wp_reset_query();?>
    <div class="section section-textImg sec section-programs" >

<!--        <div class="side-panel"><span>Programs</span></div>-->
        <div class="container">
            <div class="colmn-text">
                <h2><?php the_field('title2',$id);?></h2>
                <?php the_field('excerpt2',$id);?>
				<?php if(get_field('button_title2',$id)!=''):?>
				<a href="<?php the_field('button_link2',$id);?>" class="btn btn-link"><?php the_field('button_title2',$id);?></a>
            <?php endif;?>				
            </div>
			<?php $image2=get_field('image2',$id);?>
            <div class="colmn-img bg-control" style="background-image:url(<?php echo $image2;?>);"></div>

        </div>
    </div>
    <div class="section02 home-programs-feature ">
        <div class="container">
            <div class="row loaddiv">
				<?php $post_arr=array(
					'post_type'			=> 'programs',
					'posts_per_page' 	=> -12,
					'orderby' 			=> 'post_date',
					'order' 			=> 'DESC'
				);
				$post_query=new WP_Query($post_arr);
				if($post_query->have_posts()):
					while($post_query->have_posts()): $post_query->the_post();
						$post_id=get_the_id();
						$image_id = get_post_meta( get_the_ID(), 'wildaid_program_thumbnail_id', 1 );
						if($image_id){
							$large_image =  wp_get_attachment_image_src( $image_id, 'listing-square' );
						}
						else if (has_post_thumbnail($post_id))
						{
							$large_image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'listing-square');
						}

						?>
                        <div class="colmn">
                            <a href="<?php echo get_the_permalink($post_id);?>">
                            <img src="<?php echo $large_image[0];?>" class="block" title="" alt="">


                                <h3><?php the_title();?></h3>


                            </a>
                        </div>
					<?php endwhile;endif;?>
            </div>
        </div>
    </div>
</main>
	<?php 	wp_reset_query();
	if(have_rows('add_slides_footer',$id)!=''){
		footerSlider($id);
	}
	wp_reset_query();
	?>



<?php get_footer(); ?>
<style type="text/css">
    .magic_embed {
        overflow:hidden;
        position:relative;
        z-index: 1;
    }
    .magic_embed iframe{
        width:100%;
        height: calc(100vw/2.86);
    }
    @media(min-width: 1000px){
        .magic_embed{
            max-width: calc(100% - 640px);
        }
    }
    @media(max-width: 480px){
        .magic_embed iframe{
            max-height: 320px;
            height: 100%;
        }
    }
</style>
<script type='text/javascript'>
    $('.inside_video').click(function(e){
        e.preventDefault();
        $(this).find('img').hide();

        var videotype = $(this).data('videotype');

        if(videotype == 'vimeo'){
            var video_id = $(this).data('videoid');
            var video_embed = '<iframe src="http://player.vimeo.com/video/'+video_id+ '?title=1&amp;byline=1&amp;portrait=1&amp;autoplay=true" frameborder="0"></iframe>';
            $(this).parent().find('.magic_embed').html(video_embed);
        }
        else{
            var video_id = $(this).data('videoid');
            var video_embed = '<iframe src="http://www.youtube.com/embed/'+video_id+ '?autoplay=true" frameborder="0"></iframe>';
            $(this).parent().find('.magic_embed').html(video_embed);
        }

        
    });
</script>