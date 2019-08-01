<?php 
/**
  * Template Name: Get Involved Template
 */
get_header();
?>
<style>
   

</style>
<?php
$id=get_the_id();
$large_image = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'header');
displayBanner();

?>
<main class="ourTeam">
   <section class="sectionTop section-get-a">
       <div class="container">
           <div class="row">
                <div class="left-cont">
                    <h2><?php the_field('title',$id);?></h2>
                    <?php the_field('excerpt1',$id);?>
                    <?php if(get_field('button_title1',$id)!=''):?>
                        <a href="<?php the_field('button_link1',$id);?>" class="btn btn-link"><?php the_field('button_title1',$id);?></a>
                        <?php endif;?>

                    <?php wp_reset_query();?>


                    <?php the_content();?>
                </div>
                <?php wp_reset_query();?>
                <?php if(get_field('content_right',$id)!=''):?>
                <div class="right-cont">
                <ul class="h-p-ul">
                    <?php the_field('content_right',$id);?>
                </ul>

                </div>
                <?php endif;?>
            </div>
            
       </div>
   </section>
</main>

<?php get_footer();?>