<?php
/**
  * Template Name: Simple Template
 */
get_header(); 
$id=get_the_id();
$large_image = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'header');

if ($large_image != '') {
?>


<div class="row-section cover-banner bg-control" style="background-image:url(<?php echo $large_image[0];?>);">
    <div class="cover-text text-white">
        <div class="container">
            <div class="colmn">
                <h2><?php the_title();?></h2>
                <span class="play-button"></span>
            </div>
        </div>
    </div>
</div>
<?php } ?>


<style>
    .left-cont ul {
        margin-left: 40px;
    }

    .left-cont ul li {
        list-style-type: disc;
        list-style: inherit;
    }

</style>

<main>
<?php wp_reset_query();?>
    <div class="section section-get-a contact-page <?php if ($large_image == '') { echo "no-banner";} ?>" >
        <div class="container">

            <div class="left-cont" style="float: left;">
                <?php
                if ($large_image == '') {
                    the_title( "<h1 class='title-no-banner'>", "</h1>");
                }
			    the_content();
                ?>
            </div>
			<?php if(get_field('content_right',$id)!=''):?>
            <div class="colmn-right narrow">
                <?php the_field('content_right',$id);?>
            </div>
			<?php endif;?>
            <div class="row-section">
                <h3><?php the_field('title',$id);?></h3>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
