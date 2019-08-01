<?php

/**
 * Twenty Sixteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 *
 * instead attached to a filter or action hook.
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */

/*
add_action('after_setup_theme', function() {
	$file = get_stylesheet_directory() . '/template-inthenews.php';
	touch($file);
});
*/

show_admin_bar( false );


add_filter("template_include", function($template){
    if (is_tag()) {
        $new_template = locate_template( array("template-news.php"));

        if ('' != $new_template) {
            return $new_template;
        }
    }

    return $template;

}, 99);


// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');

if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
    require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentysixteen_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * Create your own twentysixteen_setup() function to override in a child theme.
     *
     * @since Twenty Sixteen 1.0
     */


    function twentysixteen_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
         * If you're building a theme based on Twenty Sixteen, use a find and replace
         * to change 'twentysixteen' to the name of your theme in all the template files
         */
        load_theme_textdomain( 'twentysixteen' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for custom logo.
         *
         *  @since Twenty Sixteen 1.2
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 240,
            'width'       => 240,
            'flex-height' => true,
        ) );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 1200, 9999 );


        /************* THUMBNAIL SIZE OPTIONS *************/


        if ( function_exists( 'add_image_size' ) ) {

            add_image_size('header', 1600, 637, true); // cropped
            add_image_size('footer', 1200, 413, true); // cropped
            add_image_size('square', 520, 520, true); // cropped
            add_image_size('news-block', 509, 382, true); //cropped
            add_image_size('news-thumb', 400, 1200, false); //cropped
            add_image_size('ambassador-program', 290, 164, true); //cropped
            add_image_size('related-type', 384, 164, true); //cropped
            //add_image_size('listing-square', 384, 384, true); //(cropped)
            add_image_size('listing-square', 410, 410, array('center', 'top')); //(cropped)
            add_image_size('news-block-small', 384, 310, true); //cropped
            add_image_size('news-block-small-top', 385, 311, array('center', 'top')); //cropped
            add_image_size('image-gallery',620,380, true);
			add_image_size('image-gallery-top',621,381, array('center', 'top'));
            add_image_size('body-image', 672, 422, true);
            add_image_size('front-slider', 1600, 981, true);
            

        }
        add_filter( 'image_size_names_choose', 'custom_image_sizes_choose' );
        function custom_image_sizes_choose( $sizes ) {
            $custom_sizes = array(
                "header" =>"Header",
                'footer'=>"Footer",
                'square'=>"Large 2 col Square",
                'news-block'=>"News Block",
                'ambassador-program'=> "Ambassador Program",
                'related-type'=>"Related Type",
                'listing-square'=>"Listing Square",
                'news-block-small'=>"News Block Small",
                'image-gallery'=> "Image Gallery"
            );


            return array_merge( $sizes, $custom_sizes );
        }

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'twentysixteen' ),
            'social'  => __( 'Social Links Menu', 'twentysixteen' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'status',
            'audio',
            'chat',
        ) );

        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );

        // Indicate widget sidebars can use selective refresh in the Customizer.
        add_theme_support( 'customize-selective-refresh-widgets' );
    }
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'twentysixteen_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'twentysixteen_content_width', 840 );
}
add_action( 'after_setup_theme', 'twentysixteen_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'twentysixteen' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),
        'before_widget' => '<div class="right-col">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="aHeading"><h3>',
        'after_title'   => '</h3></div>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Content Bottom 1', 'twentysixteen' ),
        'id'            => 'sidebar-2',
        'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Content Bottom 2', 'twentysixteen' ),
        'id'            => 'sidebar-3',
        'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Newsletter', 'twentysixteen' ),
        'id'            => 'newsletter',
        'description'   => __( 'It display newletter form.', 'twentysixteen' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );

if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :
    /**
     * Register Google fonts for Twenty Sixteen.
     *
     * Create your own twentysixteen_fonts_url() function to override in a child theme.
     *
     * @since Twenty Sixteen 1.0
     *
     * @return string Google fonts URL for the theme.
     */
    function twentysixteen_fonts_url() {
        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'twentysixteen' ) ) {
            $fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
        }

        /* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'twentysixteen' ) ) {
            $fonts[] = 'Montserrat:400,700';
        }

        /* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentysixteen' ) ) {
            $fonts[] = 'Inconsolata:400';
        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
                'subset' => urlencode( $subsets ),
            ), 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection() {
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts() {
    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );

    // Add Genericons, used in the main stylesheet.
    wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

    // Theme stylesheet.
    wp_enqueue_style( 'twentysixteen-style', get_stylesheet_uri() );

    // Load the Internet Explorer specific stylesheet.
    wp_enqueue_style( 'twentysixteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentysixteen-style' ), '20160816' );
    wp_style_add_data( 'twentysixteen-ie', 'conditional', 'lt IE 10' );

    // Load the Internet Explorer 8 specific stylesheet.
    wp_enqueue_style( 'twentysixteen-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'twentysixteen-style' ), '20160816' );
    wp_style_add_data( 'twentysixteen-ie8', 'conditional', 'lt IE 9' );

    // Load the Internet Explorer 7 specific stylesheet.
    wp_enqueue_style( 'twentysixteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentysixteen-style' ), '20160816' );
    wp_style_add_data( 'twentysixteen-ie7', 'conditional', 'lt IE 8' );

    // Load the html5 shiv.
    wp_enqueue_script( 'twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
    wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    if ( is_singular() && wp_attachment_is_image() ) {
        wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
    }

    wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );

    wp_enqueue_style( 'wildaid-magnific-style', get_template_directory_uri() . '/css/magnific-popup.css', array( 'twentysixteen-style' ), '20160816' );
    wp_enqueue_script( 'wildaid-magnific', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array(), '20160816', true);

    wp_localize_script( 'twentysixteen-script', 'screenReaderText', array(
        'expand'   => __( 'expand child menu', 'twentysixteen' ),
        'collapse' => __( 'collapse child menu', 'twentysixteen' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes( $classes ) {
    // Adds a class of custom-background-image to sites with a custom background image.
    if ( get_background_image() ) {
        $classes[] = 'custom-background-image';
    }

    // Adds a class of group-blog to sites with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Adds a class of no-sidebar to sites without active sidebar.
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }
    if(!is_front_page()){
        $classes[]="subpage";
    }

    return $classes;
}
add_filter( 'body_class', 'twentysixteen_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb( $color ) {
    $color = trim( $color, '#' );

    if ( strlen( $color ) === 3 ) {
        $r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
        $g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
        $b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
    } else if ( strlen( $color ) === 6 ) {
        $r = hexdec( substr( $color, 0, 2 ) );
        $g = hexdec( substr( $color, 2, 2 ) );
        $b = hexdec( substr( $color, 4, 2 ) );
    } else {
        return array();
    }

    return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentysixteen_content_image_sizes_attr( $sizes, $size ) {
    $width = $size[0];

    840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

    if ( 'page' === get_post_type() ) {
        840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
    } else {
        840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
        600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
    }

    return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
    if ( 'post-thumbnail' === $size ) {
        is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
        ! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
    }
    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function twentysixteen_widget_tag_cloud_args( $args ) {
    $args['largest'] = 1;
    $args['smallest'] = 1;
    $args['unit'] = 'em';
    return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );

class wildaid_Walker extends Walker_Nav_Menu
{
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<span class='d-du'><ul class=''>\n";
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></span>\n";
    }
}
function newsSlider($get_id, $post_query, $slider_class = 'newsSlider') {



    echo '<div class="custom-video-slider"><section class="' . $slider_class . '">';

    if($post_query->have_posts()){
        $i=0;
        while($post_query->have_posts()){
            $post_query->the_post();

            if($i == 3){

                break;
            }
            echo '<div class="row-section videoCol slider slider-inner">';

            $slid_image =wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'header');



            // TODO: Style for title on video slider with no text needs work


            echo '<div class="header-background" style="background-image: url(' . $slid_image[0] . ');">
                            <div class="cover-text text-white">
                                <div class="container">
                                    <div class="banner-caption"><h2 class="ellipsis-multiline">'. get_the_title().'</h2></div>' ;

            echo ' <a class="btn btn-link" href="'.get_permalink().'">'.__("Read More").'</a>';

            echo '	       	
                                </div> <!-- END Container -->
                            </div>
                        </div>';
            // end is video


            echo '</div>';

            $i++;
        } //END WHILE
    } //END HAS POSTS
    echo '</section></div>';


}

function wildaidSlider($get_id, $p_title = '', $slider_class = 'vertical-center-4') {


    wp_reset_query();
    ?>

    <div class="custom-video-slider">
        <section class="<?php echo $slider_class ?>">
        <ul class="slickDots"></ul>

    <?php
    if(have_rows('add_slides',$get_id)!=''):
        $i=0;
    while(have_rows('add_slides',$get_id)) {
	    the_row();
	    ?>
        <div class="row-section videoCol slider slider-inner">

		    <?php
		    $slid_ttle   = get_sub_field( 'title', $get_id );
		    $slider_type = "video-slider-with-text";

		    if ( $slid_ttle == '' ) {
			    $slid_ttle   = get_the_title( $get_id );
			    $slider_type = 'video-slider-without-text';
		    }

		    $slid_cont     = get_sub_field( 'banner_caption', $get_id );
		    $attachment_id = get_sub_field( 'image', $get_id );

		    $slid_image = wp_get_attachment_image_src( $attachment_id, $size = 'header' );

		    $slid_is_video = get_sub_field( 'is_video', $get_id );

		    $slid_video_url   = get_sub_field( 'video_url', $get_id );
		    $slid_button_text = get_sub_field( 'button_text', $get_id );
		    $slid_button_link = get_sub_field( 'button_link', $get_id );

		    // TODO: Style for title on video slider with no text needs work

		    if ( $slid_is_video == "Yes" ) {
			    ?>
                <div class="header-background  <?php echo $slider_type ?>"
                     style="background-image: url(' <?php echo $slid_image[0] ?> ');">

                    <a href=" <?php echo $slid_video_url ?>" class="video-popup">
                        <div class="container cover-text text-white">
                            <div class="banner-caption">
                                <h2> <?php echo $slid_cont ?></h2>
                                <span class="play-button">
                                    <img src="/wp-content/themes/wildaidtheme/svgs/play-icon.svg" width="60px"
                                         height="60px">
                                 </span>
                            </div>
                            <div class="colmn">
                                <h4> <?php echo $slid_ttle ?></h4>
                            </div>
                        </div>

                    </a>
                </div>
			    <?php
		    }
		    else {
			    ?>
                <div class="header-background" style="background-image: url('<?php echo $slid_image[0] ?>');">
                    <div class="cover-text text-white">
                        <?php if(!empty($slid_button_link)){ ?>
                            <a  href="<?php echo $slid_button_link ?>">
                        <?php } ?>
                        <div class="container">
                            <div class="banner-caption"><h2> <?php echo $slid_cont ?></h2></div>
                            <div class="colmn">
                                <h4><?php echo $slid_ttle ?></h4>
							    <?php if ( $slid_button_text != '' ) { ?>
                                    <span class="btn"> <?php echo $slid_button_text ?></span>
							    <?php } ?>
                            </div>
                        </div>
                        <?php  if(!empty($slid_button_link)){ ?>
	                        </a>
                        <?php } ?>
                    </div>
                </div>
			    <?php
		    }
		    ?>
        </div> <!-- Row-section Column -->
	    <?php

	    $i ++;
    } //endWhile
?>
        </section>
        </div>
<?php
    endif;  //add_slides


    wp_reset_query();

}

function footerSlider($get_id)
{
    wp_reset_query();

    echo '<section class="footerslider section-video">';

    if(have_rows('add_slides_footer',$get_id)!=''):
        $k=0;
        while(have_rows('add_slides_footer',$get_id)): the_row();
            echo '<div class="section-video slider slider-inner">';
            $slid_ttle=get_sub_field('title',$get_id);
            $slid_cont=get_sub_field('footer_banner_caption',$get_id);
            $attachment_id=get_sub_field('image',$get_id);

            $slid_image = wp_get_attachment_image_src( $attachment_id, $size='footer' );

            $is_videofoot=get_sub_field('is_videofoot',$get_id);

            $slid_video_url=get_sub_field('video_urlfoot',$get_id);
            $slid_button_text=get_sub_field('button_text',$get_id);
            $slid_button_link=get_sub_field('button_link',$get_id);

            if ($slid_button_text == '') {
                $slid_button_text   = __("View More Videos", "wildaid_domain");
                $slid_button_link   = "/videos";
            }

            $slid_video_type = videoType($slid_video_url);

            if($slid_video_type == 'vimeo'){
                $slid_video_id = (int) substr(parse_url($slid_video_url, PHP_URL_PATH), 1);
            }
            else{
                $slid_video_id = explode("?v=", $slid_video_url); // For videos like http://www.youtube.com/watch?v=...
                if (empty($slid_video_id[1]))
                    $slid_video_id = explode("/v/", $slid_video_url); // For videos like http://www.youtube.com/watch/v/..

                $slid_video_id = explode("&", $slid_video_id[1]); // Deleting any other params
                $slid_video_id = $slid_video_id[0];
            }

            

            
            if($is_videofoot == "Yes")
            {
                echo '<div class="footer-background" style="background-image: url(' . $slid_image[0] . ')">

                <div class="magic_embed"></div>

                            <a href="' . $slid_video_url . '" class="inside_video" data-videotype="' . $slid_video_type . '" data-videoid="' . $slid_video_id . '">
                            <span class="play-button"><img src="/wp-content/themes/wildaidtheme/svgs/play-icon.svg" width="60px" height="60px"></span>
                            <div class="colmn-text">
                                <h3>'.$slid_ttle.'</h3>	
                                    '.$slid_cont.'	
    
                                <a href="'.$slid_button_link.'" class="btn btn-link">'.$slid_button_text.'</a>					
                            </div>
                            </a>
                        </div>';
            }
            else{
                echo '<div>
                        <img src="'.$slid_image.'" class="img-responsive block" title="" alt="">
                        <span class="play-button"><img src="/wp-content/themes/wildaidtheme/svgs/play-icon.svg" width="60px" height="60px"></span>
                        <div class="colmn-text">
                            <h3>'.$slid_ttle.'</h3>
                            '.$slid_cont.'
                            <a href="'.$slid_button_link.'" class="btn btn-link">'.$slid_button_text.'</a>
                        </div>
                    </div>';
            }
            echo '</div>';
        endwhile;

        echo '</section>';

    endif;
}
function video_ajax_function()
{
    $searchval=$_REQUEST['searchval'];
    $q1 = get_posts(array(
        'fields' => 'name',
        'post_type' => 'resources',
        's' => $searchval
    ));

    $q2 = get_posts(array( 'post_type'=>'resources',
        'orderby' 			=> 'post_date',
        'order' 			=> 'DESC',

        'tax_query' => array(
            'relation' => 'AND',
            array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'post_tag',
                    'field'    => 'slug',
                    'terms'    => $searchval
                ),
                array(
                    'taxonomy' => 'location',
                    'field'    => 'slug',
                    'terms'    => $searchval
                ),
            ),
            array(
                'taxonomy' => 'resource-type',
                'field'    => 'slug',
                'terms'    => 'video'
            ),
        )
    ));
    $q1_arr=array();
    $q2_arr=array();
    $arrmerg=array();
    foreach($q1 as $q1s)
    {
        array_push($q1_arr,$q1s->ID);
    }
    $q2_arr=array();
    foreach($q2 as $q2s)
    {
        array_push($q2_arr,$q2s->ID);
    }
    $arrmerg=array_unique(array_merge( $q1_arr, $q2_arr ));
    $gettax_args = array(
        'post_type' => 'resources',
        'post__in' => $arrmerg,
        'post_status' => 'publish',
        'orderby' 	=> 'post_date',
        'order' 	=> 'DESC',
        'posts_per_page' => -1
    );
    $video_loop = new WP_Query( $gettax_args );
    $output1='';
    /*echo "<pre>";
    print_r($video_loop);
      die;*/
    if($video_loop->have_posts()){
        while($video_loop->have_posts()): $video_loop->the_post();
            $post_id=get_the_id();
            $large_image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full');
            $wildaid_resourcesfile= get_post_meta($post_id,'wildaid_resource_file',true);
            $wildaid_resource_is_featured= get_post_meta($post_id,'wildaid_resource_is_featured',true);
            $wildaid_resource_file_duration= get_post_meta($post_id,'wildaid_resource_file_duration',true);

            if($wildaid_resource_is_featured==''):

                $abs_url=get_template_directory_uri();
                $dat=get_the_date( 'H:i' );



                $output1 .= '	
                <div class="colmn">
					<a href="javascript:video(0)" rel="'.$wildaid_resourcesfile.'">
                    <figure>';
                if (has_post_thumbnail($post_id))
                {
                    $output1 .= '   <img src="'.$large_image[0].'" alt="">';
                } else{
                    $output1 .= '<img src="'.$abs_url.'/images/video-img-1.jpg" title="" alt="">';
                }
                $output1 .= '  <div class="time">'.$dat.'</div>
                    </figure>
                    <figcaption>
                        <h5>'. get_the_title().'</h5>
						<p>'.get_the_excerpt().'</p>
                    </figcaption>
					</a>
                </div>';
            endif; endwhile;


        $output1 .= '<div class="text-center ">
                    <a href="javascript:void(0)" class="btn btn-link" id="loadMore">VIEW MORE VIDEO</a>
                    
                </div>';
        $output1 .= ' <script>
		jQuery(document).ready(function () {	
		    size_li = jQuery(".loaddiv .colmn").size();
			//alert(size_li);
		    x=15;
		    jQuery(".loaddiv .colmn:lt("+x+")").show();
		    jQuery("#loadMore").click(function () {
		        x= (x+15 <= size_li) ? x+15 : size_li;
		        jQuery(".loaddiv .colmn:lt("+x+")").show();
				if(x >= size_li)
				{
					jQuery("#loadMore").hide();
				}
		    });
			if(x >= size_li)
			{
				jQuery("#loadMore").hide();
			}
		   
		});	
		</script> ';
        echo $output1;
    }
    else{
        echo "No record found";}

    die();
}
add_action( 'wp_ajax_nopriv_video_ajax_function', 'video_ajax_function' );
add_action( 'wp_ajax_video_ajax_function', 'video_ajax_function' );
//-------  for ambeser gal ----------
function ambsgal_ajax_function()
{

    $id=$_REQUEST['id'];
    $voutput .='';
    $voutput .='<div class="videoCol slider slider-for2">';
    $video_galls= get_post_meta($id,'wildaid_ambassador_related_resources',true);
    foreach ($video_galls as $video_gall) {
        $video_url= get_post_meta($video_gall,'wildaid_resource_file',true);

        $voutput .= '<div class="item">
                    <video controls>
                        <source src="'.$video_url.'">
                    </video>
                </div>	';
    }

    $voutput .='</div>';
    $voutput .='<div class="videoNav slider-nav1">';
    foreach ($video_galls as $video_gall) {
        $video_url= get_post_meta($video_gall,'wildaid_resource_file',true);

        $voutput .= '<div class="item">
	                    <video>
	                        <source src="'.$video_url.'">
	                    </video>
                	</div>	';
    }
    $voutput .='</div>';

    //$thurl=get_template_directory_uri()."/js/slick.js";
    $voutput .= ' 
       <script>
		    jQuery(".slider-for2").slick({
			  slidesToShow: 1,
			  slidesToScroll: 1,
			  arrows: false,
			  fade: true,
			  asNavFor: ".slider-nav1",
				 autoplay: true
			});
			jQuery(".slider-nav1").slick({
			 // slidesToShow: 2,
			  slidesToScroll: 1,
			  asNavFor: ".slider-for2",
			  dots: false,
			  centerMode: true,
			  focusOnSelect: true

			});
		</script> ';
    echo $voutput;
    /*}
    else{
    echo "No record found";}*/

    die();
}
add_action( 'wp_ajax_nopriv_ambsgal_ajax_function', 'ambsgal_ajax_function' );
add_action( 'wp_ajax_ambsgal_ajax_function', 'ambsgal_ajax_function' );



function get_image_gallery_html( $file_list_meta_key="wildaid_page_image_gallery", $thumbnail_size = 'medium', $actual_size='large') {

    // Get the list of files
    $files = get_post_meta( get_the_ID(), $file_list_meta_key, 1 );
    $html='';
    if(!empty($files)){
    $html= '<div class="imageCarousel"><div>';
    // Loop through them and output an image
    foreach ( (array) $files as $attachment_id => $attachment_url ) {
        $imgattr=wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
        $imgactualattr=wp_get_attachment_image_src( $attachment_id, $actual_size );
	    $imgmeta  = get_post($attachment_id);
	    $title="";
	    if($imgmeta){

		   $title= $imgmeta->post_excerpt;
        }
        $html.='<div>';
        $html.= '<a class="gallery-image" style="" href="'.$imgactualattr[0].'" title="'.$title.'"><img src="'.$imgattr[0].'" width="'.$imgattr[1].'" height="'.$imgattr[2].'" alt="" title="'.$title.'" />';
        if($title){
            $html.='<section class="mfp-caption"><span class="mfp-title">'.$title.'</span></section>';
        }
        $html.= '</a></div>';

    }
    $html.= '</div></div>';
    }
    return $html;
}

function get_page_image_gallery_html($atts) {
    $file_list_meta_key="wildaid_page_image_gallery";
    $thumbnail_size='image-gallery';
    $actual_size='large';
    // Get the list of files
    $files = get_post_meta( get_the_ID(), $file_list_meta_key, 1 );

    $html= '<div class="imageCarousel"><div>';
    // Loop through them and output an image
    foreach ( (array) $files as $attachment_id => $attachment_url ) {
        $imgattr=wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
        $imgactualattr=wp_get_attachment_image_src( $attachment_id, $actual_size );
        $imgmeta = get_post($attachment_id);
	    $title="";
	    if($imgmeta){

		    $title= $imgmeta->post_excerpt;
	    }

        $html.='<div>';
        $html.= '<a class="gallery-image" style="" href="'.$imgactualattr[0].'" title="'.$title.'" ><img src="'.$imgattr[0].'" width="'.$imgattr[1].'" height="'.$imgattr[2].'" alt="" title="'.$title.'" />';
	    if($title) {
		    $html .= '<section class="mfp-caption"><span class="mfp-title">' . $title . '</span></section>';
	    }
        $html.= '</a></div>';
    }
    $html.= '</div></div>';
    return $html;
}
add_shortcode( 'pageimagegallery', 'get_page_image_gallery_html' );


//function populate_results($model_callback, $display_callback){
//	$queryResults = call_user_func($model_callback);
//	foreach($queryResults as $result){
//		call_user_func( $display_callback);
//	}
//}

function displayNewsResult() {
    global $post;
    $imageattr= wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'news-block-small');
    ?>
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="colmn grid-item" style="display: block;">

                <span class="top-strip">News</span>
                <figure>
                    <div class="box-overlay">
                        <a href="<?php echo get_permalink(); ?>"><button type="button" class="btn btn-site">View Article</button></a>
                    </div>
                    <img src="<?php echo $imageattr[0]?>" alt="" />
                </figure>
                <figcaption>
                    <a class="page-link" href="<?php echo get_permalink(); ?>">
                    <h5 class="ellipsis-multiline"><?php the_title(); ?></h5>
                    <span class="date"><?php echo get_the_date('F j, Y'); ?></span>
                    </a>
                </figcaption>

        </div>
    </div>
    <?php

}


function displayProgramResult() {
    global $post;
    $imageattr= wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'news-block-small');
	$image_id = get_post_meta( get_the_ID(), 'wildaid_program_thumbnail_id', 1 );
	if($image_id){
		$imageattr =  wp_get_attachment_image_src( $image_id, 'news-block-small' );
	}
    ?>
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="colmn eq-heights grid-item">





                <span class="top-strip">Program</span>
                <div class="imageCaption">
                    <figure>
                        <div class="box-overlay">
                            <a href="<?php echo get_permalink(); ?>"><button type="button" class="btn btn-site">View Program</button></a>
                        </div>
                        <img src="<?php echo $imageattr[0]?>">
                    </figure>
                    <figcaption>
                        <a rel="gallery1" href="<?php the_permalink()?>">
                        <h5><?php the_title(); ?></h5>
                        <?php echo file_get_contents(get_template_directory()."/svgs/arrow-3.svg") ?>
                    </figcaption>
                    </a>
                </div>

        </div>
    </div>
    <?php

}
function displayVideoResult() {
    global $post;
    $imageattr= wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'news-block-small');
    $video= get_post_meta(get_the_ID(),'wildaid_resource_file',true);
    if(videoType($video)!= "unknown"){
        ?>
        <div class="col-md-4 col-sm-4 col-xs-12 ">
            <div class="colmn video" style="display: block;">
                <a class="page-link" href="<?php echo $video; ?>">
                    <span class="top-strip">Video</span>
                    <figure>
                        <?php echo do_shortcode( '[fve]' . $video . '[/fve]' ); ?>
                    </figure>
                    <figcaption>
                        <h5><?php the_title(); ?></h5>
                    </figcaption>
                </a>
            </div>
        </div>
        <?php
    }
}


function displayCampaignResult() {
    global $post;
    $post_id = get_the_ID();
    $imageattr= wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'news-block-small');
    $link = get_post_meta($post_id, "wildaid_resource_file");
    ?>
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="colmn grid-item" style="display: block;">
            <a class="page-link" href="<?php echo get_permalink(); ?>">
                <span class="top-strip">Campaign</span>
                <figure>
                    <div class="box-overlay">
                        <a href="<?php echo $link[0]; ?>" target="_blank"><button type="button" class="btn btn-site">View Campaign</button></a>
                    </div>
                    <img src="<?php echo $imageattr[0]?>" alt="" />
                </figure>
                <figcaption>
                    <h5><a href="<?php echo $link[0]; ?>" target="_blank"><?php the_title(); ?></a></h5>
                </figcaption>
            </a>
        </div>
    </div>
    <?php


}
function displayPublicationResult() {
    global $post;
    $post_id = get_the_ID();
    $imageattr= wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'news-block-small');

    $link = get_post_meta($post_id, "wildaid_resource_file");
    ?>
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="colmn grid-item" style="display: block;">
            <a class="page-link" href="<?php echo get_permalink(); ?>">
                <span class="top-strip">Publication</span>
                <figure>
                    <div class="box-overlay">
                        <a href="<?php echo $link[0]; ?>" target="_blank"><button type="button" class="btn btn-site">View Publication</button></a>
                    </div>
                    <a href="<?php echo $link[0]; ?>" target="_blank"><img src="<?php echo $imageattr[0]?>" alt="" /></a>
                    <span class="downButton"><i  aria-hidden="true"></i></span>
                </figure>
                <figcaption>
                    <h5><a href="<?php echo $link[0]; ?>" target="_blank"><?php the_title(); ?></a></h5>
                    <span class="date"><?php echo get_the_date('Y'); ?></span>
                </figcaption>
            </a>
        </div>
    </div>
    <?php


}
function getAmbassadorImageUrl($id, $image_size ="listing-square"){
    $image="";
    if ( has_post_thumbnail( $id ) ) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $image_size )[0];
    }
    else{
        $images = get_post_meta( $id, "wildaid_ambassador_image_gallery", true );
        if ( $images ) {
            $image = wp_get_attachment_image_src( current( array_keys( $images ) ), $image_size )[0];
        }
    }
    return $image;
}

function displayAmbassador() {
    global $post;
    $post_id = get_the_ID();
    $html    = "";
    $image   = getAmbassadorImageUrl($post_id,"listing-square");

    //TODO: How to handle ambassadors without images
    if ($image == '') {
        //return;
        $image = '/wp-content/themes/wildaidtheme/images/fpo-black.png';
    }

    $html = "<div class=\"colmn m-40 ambassador\" >
        <img src=\"" . $image . "\" class=\"block\" title=\"\" alt=\"\">
       
            <div class=\"layer-fixed\">
            	<h3>" . get_the_title() . "</h3>
            	 
            </div>
            
            <div class=\"layer\">
             <a href=\"" . get_the_permalink( $post_id ) . "\">
                <h3>" . get_the_title() . "</h3>
    <p>" . get_post_meta( $post_id, 'wildaid_ambassador_subtitle', true ) . "</p><span class=\"btn btn-arrow\"></span>
            </a>
    </div>
   
    </div>\n";


    return $html;

}

add_shortcode( 'lb-featured-image', 'lb_featured_image' );



function lb_featured_image($size = 'news-block') {

    global $post;

    $str = "<figure class='post-inline-image'>" . get_the_post_thumbnail($post->ID, $size) . "<figcaption class='image-caption'>" . get_the_post_thumbnail_caption($post->ID) . "</figcaption></figure>";

    return $str;
}


function getRecentNews($p_category = '') {
    //$taxonomy = array();
    global $id;
    $aryPosts = array($id);

    $args = array(
        'post_type' => 'post',
        'post__not_in' => $aryPosts,
        'post_status' => 'publish',
        'orderby' 	=> 'post_date',
        'order' 	=> 'DESC',
        'posts_per_page' => 4
    );


    $news = new WP_Query( $args );

    return($news);
}


add_shortcode( 'wildaidnews', 'wildaidnews_shortcode_handler' );

function wildaidnews_shortcode_handler() {
    ob_start();
    $news = getRecentNews();
    ?>
    <div class="related-programs">
    <?php
    foreach ($news->posts as $post) {
        ?>
        <div class="related-news colmn">

        <figure>
            <div class="box-overlay">
                <a href="<?php echo get_the_permalink($post->ID);?>"><button type="button" class="btn btn-site">View Article</button></a>
            </div>
            <?php echo get_the_post_thumbnail($post->ID, 'related-type', array( 'class' => 'recent-news-thumb' ) ) ?>
        </figure>
        <figcaption>
            <h5 class="ellipsis-multiline">
                <a class="page-link" href="<?php echo get_the_permalink($post->ID);?>"><?php echo $post->post_title; ?>
                </a>
            </h5>
            <span class="date"><?php echo get_the_date('F j, Y',$post->ID); ?></span>
        </figcaption>
        </div>


        <?php
        }
        ?>
    </div>
        <?php

    return ob_get_clean();
}
/*Eventually moving to the banner that uses cmb2 instead of ACF */

function getCarouselSlides($fieldKey ='wildaid_hero_carousel' ){
    global $post;
    $id=get_the_ID();

    if($post->post_type =="ambassadors" ){
        $entries = get_post_meta( $id, $fieldKey, true );

        $carouselSlides=array();
        if(!empty($entries)){
            foreach ( (array) $entries as $key => $entry ) {
                $slide=array();
                if ( isset( $entry['title'] ) ) {
                    $slide["title"] = esc_html( $entry['title'] );
                }
                if ( isset( $entry['text'] ) ) {
                    $slide["text"] = esc_html( $entry['text'] );
                }
                if ( isset( $entry['button_text'] ) ) {
                    $slide["button_text"] = esc_html( $entry['button_text'] );
                }
                if ( isset( $entry['button_url'] ) ) {
                    $slide["button_url"] = esc_html( $entry['button_url'] );
                }
                if ( isset( $entry['button_blank'] ) ) {
                    $slide["button_blank"] = esc_html( $entry['button_blank'] );
                }
                if ( isset( $entry['background_image'] ) ) {
                    $slide["background_image"] = esc_html( $entry['background_image'] );
                }
                if ( isset( $entry['is_video'] ) ) {
                    $slide["is_video"] = ( $entry['is_video'] == 'on' )? true :false;
                }
                if ( isset( $entry['video_url'] ) ) {
                    $slide["video_url"] = esc_html( $entry['video_url'] );
                }
                $carouselSlides[]=$slide;
            }
        }

    }
    else{

        while(have_rows('add_slides',$id)): the_row();
            $slide=array();
            $slide["title"] = get_sub_field('title',$id);
            $slide["text"] = get_sub_field('banner_caption',$id);
            $attachment_id = get_sub_field('image',$id);
            $slide["background_image"] = wp_get_attachment_image_src( $attachment_id, $size='front-slider' );
            $slide["is_video"]=(get_sub_field('is_video',$id)=="Yes")? true: false;
            $slide["video_url"]=get_sub_field('video_url',$id);
            $slide["button_text"]=get_sub_field('button_text',$id);
            $slide["button_url"] =get_sub_field('button_link',$id);
            $slide["button_blank"]=get_sub_field('button_blank',$id);
            $carouselSlides[]=$slide;
        endwhile;
    }
    return $carouselSlides;
}


function displayVideoPlaylistBanner($id){
    //$id=get_the_id();

    $slides= getCarouselSlides("wildaid_hero_carousel");

    //>> DISPLAY HEADER
    //wildaidSlider($id);
    ?>
    <?php
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
                    ?><a href="<?php echo $slide["video_url"] ?>" >
                    <li class="<?php echo $selected; ?> video-popup-selector" data-slide="<?php echo $cntVideo; ?>" style="background-image: url('<?php echo $slide["background_image"][0] ?>')">
                        <h5><?php echo $slide["title"] ;?></h5>
                    </li></a>

                    <?php
                    $cntVideo++;
                }
                ?>
            </ul>
        </div>
        <?php
    } //END add_slides   ?>

    <?php
}

function displayVideoBanner($postImageId = ''){
    $id = get_the_id();

    if ($postImageId == '') {
        $postImageId = $id;
    }

    $large_image = wp_get_attachment_image_src( get_post_thumbnail_id($postImageId), 'front-slider');
    $slides= getCarouselSlides("wildaid_hero_carousel");
//>> DISPLAY HEADER
    ?>
	<?php wp_reset_query();

	if(!empty($slides)){
		?>
    <div class="banner-container videoCarousel">

        <div class="row-section slider-inner header-background" style="background-image: url('<?php echo $large_image[0]; ?>')">
            <h1 class="page-title "><?php the_title();?></h1>

                <div class="headerVideoCarousel">
                    <div class="inner">
                        <?php
                        if (count($slides) > 1) { ?>
                            <button class="prev"></button>
                            <button class="next"></button>
                        <?php
                        }


                        $t=0;
                        foreach($slides as $slide){

                            // TODO: Style for title on video slider with no text needs work

                            if(isset($slide["video_url"])) {
                                $video_type= videoType($slide["video_url"]);
                                $hide="";
                                if($t > 0){
                                    $hide="hide";
                                }
                                if ( $video_type === "youtube" || $video_type === "vimeo" ) { ?>
                                    <div class="video slide <?php echo $hide; ?>">
                                        <a href="javascript:video(0)" rel="<?php echo $slide["video_url"]; ?>">
                                            <figure>
                                                <?php
                                                echo do_shortcode( '[fve]' .$slide["video_url"]. '[/fve]' );
                                                ?>
                                            </figure>
                                        </a>
                                    </div>

                                    <?php
                                }
                            }

                            $t++;

                        }
                        ?>
                    </div><!-- END inner -->
                </div> <!--END headerVideoCarousel -->



        </div> <!-- END header-background -->
    </div> <!-- END banner-container -->
		<?php
	}
	else{
	    ?>
    <div class="no-banner video-header">
        <div class="container">
                 <h1 class="title-no-banner"><?php echo get_the_title();?></h1>

        </div>
    </div>
        <?php
    }//END add_slides
    ?>

    <?php
}


function displayBanner(){
    $id=get_the_id();
    $large_image = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'front-slider');

//>> DISPLAY HEADER
    ?>
    <div class="banner-container">
        <?php
        if(have_rows('add_slides',$id)!=''){
            wildaidSlider($id);
        }
        else if($large_image != '') {
            ?>
            <div class="row-section slider-inner header-background" style="background-image: url('<?php echo $large_image[0]; ?>')">
            </div>
            <?php
        }

        ?>

        <h1 class="page-title"><?php the_title();?></h1>
    </div> <!-- END banner-container -->
    <?php



}

function get_excerpt( $count ) {
    global $post;
    $permalink = get_permalink($post->ID);
    $excerpt = get_the_content();
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $count);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = '<p>'.$excerpt.'... <a href="'.$permalink.'">Read More</a></p>';
    return $excerpt;
}
