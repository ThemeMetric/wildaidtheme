<?php
/**
  * Template Name: Contact Template
 */
get_header(); 
$id=get_the_id();
$large_image = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full');
    displayBanner();
?>
<style>
    form{
        margin-bottom:30px;
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
             ?>
            </div>
            <div class="left-cont" style="float: left;">
                <?
			    the_content();
                ?>
            </div>
			<?php if(get_field('content_right',$id)!=''):?>
            <div class="colmn-right narrow">
                <?php the_field('content_right',$id);?>
            </div>
			<?php endif;?>
	        <?php if(get_field('title',$id)!=''):?>
            <div class="row-section">
                <h3><?php the_field('title',$id);?></h3>
            </div>
	        <?php endif;?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
