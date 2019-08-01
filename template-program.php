<?php
/**
 Template Name: Program Template
 */

get_header(); 
$id=get_the_id();
$large_image = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full');
displayBanner();


$bodyImage = wp_get_attachment_image_src(get_post_meta($id, 'image1', 1), 'body-image');
$bodyImage= $bodyImage[0];
//$bodyImage = get_field('image1',$id, 1);
?>
<style>

    .section02.about-feature{
        padding-bottom:30px;
    }
</style>
<main>


<div class="sectionTop section-textImg">
        <div class="container">
            <div class="colmn-img bg-control" style="background-image:url(<?php echo $bodyImage ;?>);"></div>
            <div class="colmn-text">
                <h2><?php the_field('title',$id);?></h2>
                <?php the_field('excerpt1',$id);?>
				<?php if(get_field('button_title1',$id)!=''):?>
                    <a href="<?php the_field('button_link1',$id);?>" class="btn btn-link"><?php the_field('button_title1',$id);?></a>   <a href="<?php the_field('button_link1',$id);?>"><span class="caption">Browse thousands of articles on all our programs.</span></a>
				<?php endif;?>
            </div>
        </div>
    </div>
    <div class="section02 about-feature ">
        <div class="container">
            <div class="row loaddiv">
				<?php $post_arr=array(
								'post_type'			=> 'programs',
								'posts_per_page' 	=> -1,
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
                <div class="colmn m-40">
                    <img src="<?php echo $large_image[0];?>" class="block" title="" alt="">

                        <div class="layer-fixed">
                            <h3><?php the_title();?></h3>
                        </div>
                        <div class="layer">
                            <a href="<?php echo get_the_permalink($post_id);?>">
                            <h3><?php the_title();?></h3>
                            <p><?php echo get_post_meta($post_id,'wildaid_program_subtitle',true);?></p>
                            <span class="btn btn-arrow"></span>
                            </a>
                        </div>

                </div>
				<?php endwhile;endif;?>
            </div>
        </div>
    </div>

</main>

<style>
    .colmn{ display:none;}

</style>

<?php get_footer(); ?>

<!--<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<script>
jQuery.fn.size = function() {
	return this.length;
};
jQuery(document).ready(function () {	
    size_li = jQuery(".loaddiv .colmn").size();
	//alert(size_li); 
    x=14;
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
</script>
