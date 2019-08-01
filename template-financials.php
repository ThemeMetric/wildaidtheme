<?php
/**
 * The template for displaying pages
 *
 * Template Name: Financials
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); 
wp_reset_query();
$id=get_the_id();
$large_image = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full');

displayBanner();

?>
<style>
    .colmn-right li {
        list-style: disc;
        margin-left: 18px;
    }
</style>


<main>
    <?php wp_reset_query();?>
        <div class="section section-get-a finances <?php if ($large_image == '') { echo "no-banner";} ?>" >
        <div class="container">
            <?php
            if ($large_image == '') {
                the_title( "<h1 class='title-no-banner'>", "</h1>");
            }
            ?>
            <div class="left-cont half">
                <?php
                the_content();
                ?>
            </div>

            <?php if(get_post_meta($id, 'about_content')!=''):?>
                <div class="colmn-right half">
                    <?php echo  apply_filters('the_content', get_post_meta($id, 'about_content')[0]);?>
                </div>
            <?php endif;?>

        </div>
    </div>
</main>



<?php get_footer(); ?>
