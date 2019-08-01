<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

 <div class="colmn">
    <figure>
	
	
	<a href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail() ) {
       the_post_thumbnail( 'square', array( 'class'  => 'img-responsive' ) );
      } ?></a>
      
	</figure>
    <figcaption>
	<h5><?php the_title( sprintf( '<h5><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' ); ?>
	</h5>
	<p><?php twentysixteen_excerpt(); ?></p>

	</figcaption>

	</div>
