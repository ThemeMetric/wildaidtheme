<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); 
$posttitle = get_post(69);
$news_image = wp_get_attachment_image_src( get_post_thumbnail_id(69), 'full');
?>
<div class="row-section slider-inner">
<img src="<?php echo $news_image[0];?>">
 <div class="container">
 <div class="cover-text">
    
 </div>
 <h4><?php echo  $title = single_tag_title(); ?></h4>

 </div>
<div class="flex" style="width:700px; position:absolute; bottom:0; right: 0;">
                <input type="text" class="form-control" placeholder="Enter Your Email">
                <button type="button" class="btn btn-site">Sign Up</button>
            </div>

</div>
<main>
    
    <div class="section section-02 paddTop0 box-4 mt60">
        <div class="container">
            <div class="row">
		<?php if ( have_posts() ) : ?>			

			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			// End the loop.
			endwhile;


			
			?>
			
		<div class="post-pagination text-center"> 
		   <?php the_posts_pagination(array(
		     'next_text' => '<span aria-hidden="true"> <i class="fa fa-angle-right" aria-hidden="true"></i></span>',
		     'prev_text' => '<span aria-hidden="true"> <i class="fa fa-angle-left" aria-hidden="true"></i>  </span>',
		     'screen_reader_text' => ' ',
		     'type'                => 'list'
		     )); ?>
		 </div>
		 
		 
			
			<?php

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</div>
        </div>
    </div>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
