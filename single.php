<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header();
$id = get_the_ID();
//$large_image = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full');
$intro = get_post_meta($id, 'wildaid_post_intro');
//print_r($post);

if (isset(get_the_category( $id )[0]->name)) {
	$category =  get_the_category( $id )[0]->name;
}
 
$byline = get_post_meta($id, 'byline', true);
 
if ($byline) { 
	$byline = "<p><em>By: " . $byline . "</em></p>";
} else { 
	$byline = ""; 
}
?>

<style>
    .build-corp .row-section p {
        padding-bottom: 10px;
        padding-top: 0;
    }

    .addthis_inline_share_toolbox .at-share-btn {
        background: none !important;
    }

    .addthis_inline_share_toolbox .at-share-btn::after {
        color: #e17000;
        font-size:16px;
        font-weight: normal;
        display: inline-block;
        padding-top: 11px;
        font-family: 'Knockout32';
    }

    .addthis_inline_share_toolbox .at-svc-facebook::after {
        content: "Share"

    }
    .sidebar .right-col .so-icon.side-so-icon  a{
        position:relative;
        padding-right: 30px;
        padding-left:25px;

    }
    .sidebar .right-col a svg{ display:inline; font-size:12px;
        width: 30px;

        position: absolute;
        top: -7px;
        left: -9px;
        fill: rgb(102, 102, 102);

    }
    .sidebar .right-col .so-icon.side-so-icon  a.at-svc-email{
        position: absolute!important;
        left: -29px!important  ;
        background-color: transparent!important;

    }
    .sidebar .right-col .so-icon.side-so-icon a.at-svc-email .at-icon-wrapper{
        width:27px!important;
        height:27px!important;
    }
    .sidebar .right-col  a.at-svc-email svg{
        left: -1px;
        width:22px!important;

    }
    .addthis_inline_share_toolbox .at-svc-twitter::after {
        content: "Tweet"
    }
    .addthis_inline_share_toolbox .at-svc-twitter svg{
        width: 22px!important;
        height: 22px!important;
    }

    .addthis_inline_share_toolbox .at-svc-google_plusone_share::after {
        content: "Share"
    }
    .addthis_inline_share_toolbox .at-resp-share-element .at-share-btn .at-icon-wrapper{
        float:none!important;
        height: 18px !important;
    }
    .addthis_inline_share_toolbox .at-svc-google_plusone_share svg{
        width: 27px!important;
        height: 25px!important;
    }
    .post-content .post-intro {
        font-size: 18px;
        margin-bottom: 20px;
    }

    .post-content iframe {
        padding: 8px;
        width: 100%;
    }

    .post-content .fluid-width-video-wrapper iframe {
        width: 100%;
        position: absolute;
        height: 100%;
        top: 0;
        left: 0;
        margin: 20px 0;
    }

    .post-content .fluid-width-video-wrapper {
        position: relative;
        padding-top: 56.25%;
        margin-bottom: 46px;
    }

    .post-content {
        position: relative;
    }

    .post-content .post-inline-image {
        margin-bottom: 0;
    }

    /* Add This Email */
    .right-col #atstbx {
        position: absolute;
        left: -7px;
    }

    .right-col #atstbx a {
        width: 250px;
        height: 32px;
        padding: 0;
        margin: 0;
    }

    .right-col #atstbx svg {
        left: 0;
        top: -5px;
        width:22px!important;

    }
    .at-icon-wrapper{
        padding-right: 24px;

    }
    .at-resp-share-element .at-svc-google_plusone_share .at-icon-wrapper {
        height: 20px !important;
        width: 27px !important;
        padding-right: 32px;
    }
    .at-resp-share-element  .at-svc-twitter .at-icon-wrapper{
        padding-right: 28px;
    }
    .at-resp-share-element .at-share-btn:focus, .at-resp-share-element .at-share-btn:hover {
        transform: none;
    }

    .twitter-tweet-rendered {
        width: auto !important;
    }

    .EmbeddedTweet {
        margin: auto;
    }

</style>

<main>
<?php
// Start the loop.

    ?>


    <div class="section build-corp biuld-corp no-banner">
        <div class="container">
			<?php 
				if (post_password_required( )) {
    				echo get_the_password_form();
				} else { 
			?>
            <h1 class="left-col"><?php echo get_the_title();?></h1>
            <div class="left-col blog-details">

                <div class="link-soc">
                    <div class="span-6 date">
                        <p>
                        <?php echo get_the_date();?></p>
						<?php echo $byline; ?>
                    </div>
                    <div class="span-6 text-right">
                        <div class="so-icon">
                            <div class="addthis_inline_share_toolbox"></div>
                        </div>
                    </div>
                </div>
                <div class="row-section post-content">
                    <?php
                        if (isset($intro[0]) != '') {
                            echo apply_filters('the_content', lb_featured_image('news-thumb') . "<div class='post-intro'>" . $intro[0] . "</div>" . $post->post_content);
                        } else {
                            echo apply_filters('the_content', lb_featured_image('news-thumb') . $post->post_content);
                        }
                    ?>
                    <div class="hs-t">
                        <span>###</span>
                    </div>

                    <?php	// End of the loop.
                    wp_reset_query();
                    echo lbGetSnippet('news-footer');
                    //echo get_field('content',$id);
                    ?>

                    <div class="link-soc">

                        <div class="row">
                            <div class=" col-sm-6 col-xs-12">
                                <?php

                                $count_arr = get_the_tags($id);
                                if ($count_arr) $count = count($count_arr);
                                $i=1;
                                if(!empty($count_arr) && isset($count_arr)):
                                ?>
                                <span>Tags:
                                <?php

                                    foreach($count_arr as $tag)
                                    {
                                        echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                                        if($i<$count){
                                            echo ", ";
                                        }
                                        $i++;
                                    }
                                ?>
                                </span>

                                <?php endif;?>
                            </div>


                            <div class="col-sm-5 col-xs-12">
                                <div class="so-icon text-right">
                                    <div class="addthis_inline_share_toolbox"></div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                
                
    <?php $orig_post = $post;
    global $post;
    $categories = wp_get_post_tags($post->ID);
    if ($categories) {
    $category_ids = array();
    foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
    $args=array(
    'tag__in' => $category_ids,
    'post__not_in' => array($post->ID),
    'posts_per_page'=> 3,
    'order'    => 'DSC',
   
    'caller_get_posts'=>1
    );
    

    $my_query = new wp_query( $args );
    if( $my_query->have_posts() ) {
    echo '<div id="related_posts"><h3>Related Posts</h3>';
    while( $my_query->have_posts() ) {
    $my_query->the_post(); ?> 

	<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 relatepost">	     
	   <div class="relatedthumb">
            <a href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail() ) {
       the_post_thumbnail( 'square', array( 'class'  => 'img-responsive' ) );
      } ?></a>
           </div>
	    <div class="relatedcontent text-center">
	    <h5><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h5>  
	    
	   <span class="digdig"><?php the_time('F j, Y'); ?></span>
	    
	    </div>
	</div>	
    <?php
    }
    echo '</div>';
    }
    }
    $post = $orig_post;
    wp_reset_query(); ?> 
                
                
                
            </div>

            <aside id="secondary" class="sidebar widget-area" role="complementary">
                <div class="right-col">
                    <div class="so-icon side-so-icon">
                        <a href="/news/"><?php echo file_get_contents( get_template_directory()."/svgs/news.svg"); ?> Back to News</a>
                        <a><div class="addthis_inline_share_toolbox_rb9e"></div><span class="email-article">Email this article</span></a>
                    </div>
                </div>
                <div class="right-col">
                <div class="aHeading"><h3>Recent News</h3></div>
                <?php echo do_shortcode("[wildaidnews]")?>
                </div>
            </aside><!-- .sidebar .widget-area -->
			<?php
				}
			?>
        </div>
    </div>
</main>

<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59fbc0eaf7e0badf"></script>
<?php get_footer(); ?>


