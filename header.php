<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">


	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-KZW6SPR');</script>
	<!-- End Google Tag Manager -->

	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
	<link href="<?php bloginfo('template_url') ?>/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php bloginfo('template_url') ?>/css/reset.css" rel="stylesheet" type="text/css">
    <link href="<?php bloginfo('template_url') ?>/css/slick.css" rel="stylesheet" type="text/css">
    <link href="<?php bloginfo('template_url') ?>/css/slick-theme.css" rel="stylesheet" type="text/css">
    <link href="<?php bloginfo('template_url') ?>/css/style.css?v=5" rel="stylesheet" type="text/css">

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">


	<!-- Start of wildaid Zendesk Widget script -->
	<script>/*<![CDATA[*/window.zEmbed||function(e,t){var n,o,d,i,s,a=[],r=document.createElement("iframe");window.zEmbed=function(){a.push(arguments)},window.zE=window.zE||window.zEmbed,r.src="javascript:false",r.title="",r.role="presentation",(r.frameElement||r).style.cssText="display: none",d=document.getElementsByTagName("script"),d=d[d.length-1],d.parentNode.insertBefore(r,d),i=r.contentWindow,s=i.document;try{o=s}catch(e){n=document.domain,r.src='javascript:var d=document.open();d.domain="'+n+'";void(0);',o=s}o.open()._l=function(){var e=this.createElement("script");n&&(this.domain=n),e.id="js-iframe-async",e.src="https://assets.zendesk.com/embeddable_framework/main.js",this.t=+new Date,this.zendeskHost="wildaid.zendesk.com",this.zEQueue=a,this.body.appendChild(e)},o.write('<body onload="document._l();">'),o.close()}();
		/*]]>*/</script>
	<!-- End of wildaid Zendesk Widget script -->

	<link rel="stylesheet" type="text/css" href="https://cloud.typography.com/6446196/6404992/css/fonts.css" />

</head>
<style>
    .sticky-header .tagline{

        width: 227px;
        position: absolute;
        top: 20px;
        left: 200px;
    }

    @media (max-width: 991px) {
        .tagline{
            display:none;
        }
    }
</style>

<script type="javascript">


</script>
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KZW6SPR"
				  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


<header class="sticky-header">
    <div class="container">
        <div class="logo">
           <a href="<?php bloginfo('url')?>"><img src="<?php echo ot_get_option('logo');?>" title="" alt=""></a>
        </div>
        <div class="tagline">
            <?php echo file_get_contents( get_template_directory()."/svgs/wildaid_corporate-site_nav-tagline.svg"); ?>
        </div>
        <div class="nav">
			<a href="#menu" id="toggle"><span></span></a>
            <!--<ul>
                <li><a href="#">About</a></li>
                <li><a href="#">Programs</a></li>
                <li><a href="#">Videos</a></li>
                <li><a href="#">News</a></li>
                <li><a href="#">Gala</a></li>
                <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                <li><a href="#">Donate</a></li>
            </ul>-->
            <?php //wp_nav_menu(array('menu'=>'Header menu'));
			
			$defaults = array(
			 'theme_location'  => '',
			 'menu'            => 'Header',
			 'container'       => '',
			 'container_class' => '',
			 'container_id'    => '',
			 'menu_class'      => '',
			 'menu_id'         => '',
			 'echo'            => true,
			 'fallback_cb'     => 'wp_page_menu',
			 'before'          => '',
			 'after'           => '',
			 'link_before'     => '',
			 'link_after'      => '',
			 'items_wrap'      => '<ul class="" id="menu">%3$s</ul>',
			 'depth'           => 0,
			 'walker'          => new wildaid_Walker
			);

			wp_nav_menu( $defaults );
			
			?>
			<form action="<?php echo site_url();?>/resource" id="headsearch" method="POST" style="display:none;">
					<input type="search" name="searchField" id="search-text" placeholder="Explore Programs, Ambassadors, Videos and more ...">
				<div class="custom-sel">
					<select id="searchbar" name="searchtype" >
						<option value="">All</option>
						<option value="programs">Programs</option>
						<option value="videos">Videos</option>
						<option value="campaigns">Campaigns</option>
						<option value="news">News</option>
						<option value="publications">Publications</option>
					</select>
				</div>

			</form>		

            	<a href="https://donate.wildaid.org/checkout/donation?eid=126299" target="_blank" class="btn-don">Donate</a>

		</div>
    </div>
</header>