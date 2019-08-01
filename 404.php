<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
get_header(); ?>

<style type="text/css">
.input404 {
  display: block;
  width: 100%;
  height: 34px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555;
  background-color: #fff;
  background-image: none;
  border-radius: 4px;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  padding: 0px 14px;
  height: 54px;
  outline: none;
  border: none;
  height: 40px;
}

.input404:focus {
  border-color: #66afe9;
  outline: 0;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
}
	
	.search-container {
		max-width: 100%; width: 400px; display: inline-block;
	}
</style>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found pd">
				<div class="container text-center">
				<header class="page-header pt">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'twentysixteen' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentysixteen' ); ?></p>

					<div style="text-align: center;">
  					<div class="search-container">
    					<form method="post" action="/resource" class="flex">
		        		<input type="text" placeholder="Search WildAid" name="searchField" id="searchField" class="input404" value="" />
        				<input type="submit" name="submit" id="searchbtn404" class="btn btn-site" value="Search" />
    					</form>
    				</div>
					</div>




				</div><!-- .page-content -->
				</div>
			</section><!-- .error-404 -->

		</main><!-- .site-main -->

		<!-- <? //php get_sidebar( 'content-bottom' ); ?> -->

	</div><!-- .content-area -->


<?php get_footer(); ?>
