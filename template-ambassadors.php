<?php
/**
 Template Name: Ambassadors Template
 */

get_header(); 
$id=get_the_id();
    displayBanner();
?>

<main>
<div class="sectionTop section-textImg">
        <div class="container">
            <div class="colmn-img bg-control" style="background-image:url(<?php echo get_field('image1',$id);?>);"></div>
            <div class="colmn-text">
                <h2><?php the_field('title',$id);?></h2>
                <?php the_field('excerpt1',$id);?>
				<?php if(get_field('button_title1',$id)!=''):?>
					<a href="<?php the_field('button_link1',$id);?>" class="btn btn-link"><?php the_field('button_title1',$id);?></a>
				<?php endif;?>
            </div>
        </div>
    </div>
    <div class="section about-feature ">
        <div class="container">
            <div class="row loaddiv">
				<?php
				$post_query= getFeaturedAmbassadors();

				if ( $post_query->have_posts() ) {
                    while ( $post_query->have_posts() ) {
		    	        $post_query->the_post();
                        echo displayAmbassador();
                    }
				}
				?>
        </div>
    </div>
<div class="section-02">
    <div class="container text-center ambassadors" >
        <a href="#" data-id="ambassadors" data-page="1" data-total-pages="-1" class="btn btn-link loadAmbassadors"><?php _e("View More Ambassadors") ?></a>
    </div>
</div>

</main>

<?php get_footer(); ?>
<!--<script src="https://code.jquery.com/jquery-1.10.2.js"></script>-->

<style>

    .about-feature .colmn .layer {
        /* transform: translateY(0%); */
        XXtransform: none;
        padding: 0 50px 0 35px;
    }

    .about-feature .colmn .layer-fixed h3 {
        text-transform: uppercase;
        font-family: 'Knockout48';
        padding-right:35px;
    }
    .about-feature .colmn .layer-fixed {

        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        z-index: 10;
        padding: 25px 50px 45px 35px;
        color: #fff;
    }

    .about-feature .colmn:hover .layer-fixed h3 {
        display:none
    }

    .about-feature .colmn.ambassador img {
        height: auto;
    }
</style>