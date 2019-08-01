<?php
/**
  * Template Name: News Updates (Landing Page) Template
 */
get_header(); 
$id=get_the_id();

$news_image = wp_get_attachment_image_src( get_post_thumbnail_id(69), 'full');
$placeHolder= __("Search WildAid News");
?>

<style>
    .view-more-news {margin-top: 20px;}
	.page-template-template-news-updates .section-02.box-4 .row.grid-view { padding-top: 8rem; padding-left: 5rem; }
</style>

<div class="banner-container">
<!--    -->
<?php
$tag = get_queried_object();
$tag = $tag->slug;

$post_arr = array(
	'post_type'			=> 'post',
	'posts_per_page' 	=> 6,
	'orderby' 			=> 'post_date',
	'order' 			=> 'DESC',
    'tag'               => $tag
);

$post_query=new WP_Query($post_arr);

newsSlider($id,$post_query);

$post_query->rewind_posts();

wp_reset_query();
	
$cat = 'in-the-news';
	
$inthenews_arr = array(
	'post_type'			=> 'post',
	'posts_per_page' 	=> 6,
	'orderby' 			=> 'post_date',
	'order' 			=> 'DESC',
    'tag'               => $tag,
	'category_name'     => $cat
);
	
$inthenews_query=new WP_Query($inthenews_arr);


?>

    <div class="flex search-container" >

        <form action="<?php echo site_url();?>/resource" id="newssearch"  method="POST">
            <input type="hidden" name="searchtype" id="hiddenSearchType" value="news" />
            <input type="text" placeholder="<?php echo $placeHolder ?>"  name="searchField" id="searchField" class="form-control">
            <button type="submit" form="newssearch"  value="Submit" class="btn btn-site search">
	            <?php echo file_get_contents( get_template_directory()."/svgs/search.svg"); ?>
            </button>
        </form>
    </div>
    <h1 class="page-title"><?php the_title();?></h1>
</div> <!-- END banner-container -->
<main>
    
    <div class="section section-02 paddTop0 box-4 mt60">
        <div class="container">
            <div class="view-toggle">
                <ul>
                    <li>
                        <a class="list-view selected" data-view="list-view" href="#">
                            <svg  version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 72 72" xml:space="preserve">
                                <g id="list" transform="translate(0,-952.36218)"> <path d="M18.6,971.4v4.5h34.7v-4.5H18.6z M18.6,986.1v4.5h34.7v-4.5H18.6z M18.6,1000.8v4.5h34.7v-4.5H18.6z"/> </g>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a class="grid-view" data-view="grid-view" href="#">

                            <svg  version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  x="0px" y="0px" viewBox="0 0 72 72" xml:space="preserve">
                                <path id="grid" d="M18.6,53h13.9V39.4H18.6V53z M18.6,32.6h13.9V19H18.6V32.6z M39.5,53h13.9V39.4H39.5V53z M39.5,19v13.6h13.9V19
	H39.5z"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="row loaddiv list-view">
              <h2>News</h2>
             <?php
				if($post_query->have_posts()):		
					while($post_query->have_posts()): $post_query->the_post();
					$post_id=get_the_id();
					$large_image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'news-block-small');
					$date= get_the_date();
			?>
                <div class="colmn">

                    <figure>
                        <a href="<?php echo get_permalink(); ?>">
                        <div class="box-overlay">

                                <button type="button" class="btn btn-site">View Article</button>
                        </div>

						<?php if (has_post_thumbnail($post_id))
						    {?>
                            <img src="<?php echo $large_image[0];?>" alt="" /><?php }
						?>
                    </a>
                    </figure>


                    <figcaption>
                        <a href="<?php echo get_permalink(); ?>">
                        <h5 class="ellipsis-multiline"><?php echo  get_the_title();?></h5>
                        <div class="abstract"><?php echo get_excerpt(90) ?> </div>
                        <span class="date"><?php echo get_the_date('F j, Y'); ?></span>
                        </a>
                    </figcaption>
                    <a href="<?php echo get_permalink(); ?>"><?php echo file_get_contents( get_template_directory()."/svgs/arrow-2.svg"); ?>   </a>

                </div>
				<?php endwhile;endif;?>
              <div class="text-center view-more-news">
                <a href="/news/wildaid-updates/" class="btn btn-link">VIEW MORE NEWS UPDATES</a>
              </div>
            </div>

            <div class="row loaddiv list-view">
              <h2>WildAid in the News</h2>
             <?php
				if($inthenews_query->have_posts()):		
					while($inthenews_query->have_posts()): $inthenews_query->the_post();
					$post_id=get_the_id();
					$large_image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'news-block-small');
					$date= get_the_date();
			?>
                <div class="colmn">

                    <figure>
                        <a href="<?php echo get_permalink(); ?>">
                        <div class="box-overlay">

                                <button type="button" class="btn btn-site">View Article</button>
                        </div>

						<?php if (has_post_thumbnail($post_id))
						    {?>
                            <img src="<?php echo $large_image[0];?>" alt="" /><?php }
						?>
                    </a>
                    </figure>


                    <figcaption>
                        <a href="<?php echo get_permalink(); ?>">
                        <h5 class="ellipsis-multiline"><?php echo  get_the_title();?></h5>
                        <div class="abstract"><?php echo get_excerpt(90) ?> </div>
                        <span class="date"><?php echo get_the_date('F j, Y'); ?></span>
                        </a>
                    </figcaption>
                    <a href="<?php echo get_permalink(); ?>"><?php echo file_get_contents( get_template_directory()."/svgs/arrow-2.svg"); ?>   </a>

                </div>
				<?php endwhile;endif;?>
              <div class="text-center view-more-news">
                <a href="/news/wildaid-in-the-news/" class="btn btn-link">VIEW MORE WILDAID IN THE NEWS</a>
              </div>
            </div>

        </div>
    </div>
 
   
</main>
<?php get_footer(); ?>
