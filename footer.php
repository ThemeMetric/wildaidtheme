<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<footer>
    <div class="container">
        <div class="colmn-left">
            <?php wp_nav_menu(array('menu'=>'Footer Menu','menu_class'=>'footerNav'));?>
            <div class="social">
                <ul>
                    <?php echo ot_get_option('social_media');?>
                </ul>
            </div>
        </div>
        <div class="charity-logos">
        	<a href="<?php echo ot_get_option('charity_logo_link'); ?>"><img src="<?php echo ot_get_option('charity_logo'); ?>" alt=""></a>
        	<a href="https://www.guidestar.org/profile/20-3644441"><img class="secondlogo" src="https://wildaid.org/wp-content/uploads/2019/06/l2-min.png" alt=""></a>

        </div>
        <div class="colmn-right"  id="footer-newsletter">
            <h6 class="newsletter-header">Subscribe to our mailing list</h6>

                <form action="https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="POST">

                    <input type=hidden name="oid" value="00D46000000ZYo0">
                    <input type="hidden" name="Campaign_ID" value="70146000000LwZC" />
                    <input type=hidden name="retURL" value="https://wildaid.org/about/thanks/">
                    <input type=hidden id="lead_source" name="lead_source" value="Newsletter Signup Form" />
                    <input type=hidden id="company" name="company" value="self" />

                    <div class="newsletter-name-fields hide-element" style="overflow:auto; margin-bottom: 10px;">
                        <input id="first_name" name="first_name"  type="text" class="form-control" placeholder="First Name" required style="float: left;width: 48%;margin-right: 4%;">
                        <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Last Name" required style="float: left;width: 48%;">
                    </div>
                    <div class="flex">
                        <input  id="email" name="email" type="text" class="form-control newsletter-email" required placeholder="Enter Your Email">
                        <input type="submit" class="btn btn-site" value="Sign Up">
                    </div>
                </form>


        </div>
        <div class="row-section text-center copyright">
            <p><?php echo ot_get_option('copyrights');?></p>
        </div>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php bloginfo('template_url') ?>/js/bootstrap.min.js"></script>

<script src="<?php bloginfo('template_url') ?>/js/slick.js?v=1.1"></script>
    <script src="<?php bloginfo('template_url') ?>/js/main.js?v=1.22"></script>

<script>
    jQuery( document ).on( "click", ".search-icon", function(e) {
        if (jQuery(window).width() > 770 ) {
            if (jQuery(window).width() < 991 ) {
                jQuery('#search-text').attr('placeholder', 'Explore WildAid')
            }
            e.preventDefault();

            jQuery('#headsearch').toggle();
            jQuery('#menu li:not(.search-icon)').toggle();

            //jQuery('#menu').toggle();
        }
    });

    jQuery( document ).on( "change", "#searchbar", function() {
        //alert("hi");
        if (jQuery('#search-text').val() != '') {
            jQuery('#headsearch').submit();
        }
    });

    jQuery(document).ready(function(){

        jQuery('.wysija-input').addClass('form-control');
        jQuery('.wysija-submit').addClass('btn btn-site');

        //HEADER Slider
        jQuery('.vertical-center-4').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            autoplay: true,
            dots:true,

          });
        jQuery('.newsSlider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            autoplay: true,
            dots:true,

        });
        jQuery('.subpage .video-header-carousel').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            autoplay: true,
            //fade: true,
        });
        jQuery('.home .video-header-carousel').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            autoplay: true,
            //fade: true,
        });

        jQuery('.video-header-carousel').on('beforeChange', function(e){
            jQuery('.video-popup-selector').removeClass('selected');

        });


        jQuery('.video-header-carousel').on('afterChange', function(e){
            var currentSlide = jQuery(this).slick('slickCurrentSlide');
            jQuery('.video-popup-selector[data-slide="' + currentSlide + '"]').addClass('selected');
        });

        jQuery('.headerVideoPlaylist .video-popup-selector').on('click', function(e) {
            jQuery('.headerVideoPlaylist li').removeClass('selected');
            console.log(jQuery(this));
            jQuery(this).addClass('selected');
            var slideNum = jQuery(this).data('slide');
           jQuery('.video-header-carousel').slick('slickGoTo', slideNum);
        });

        jQuery('.footerslider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            autoplay: true,
            dots:true
            //fade: true,

        });

        jQuery('.video-popup').magnificPopup({
            type: 'iframe'
            // other options
        });
        jQuery('.gallery-image').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true

            },
            image: {
                // options for image content type
                titleSrc: 'title',
                markup:'<div class="mfp-figure">'+
                '<div class="mfp-close"></div>'+
                '<div class="mfp-img"></div>'+
                '<div class="mfp-bottom-bar">'+
                '<div class="mfp-caption">'+
                '<div class="mfp-title"></div>'+
                '</div>'+
                '<div class="mfp-counter"></div>'+
                '</div>'+
                '</div>',
            }
            // other options
        });

        jQuery('.newsletter-email').on('click', function(){
           showNewsletterForm();
        });

        jQuery('#footer-newsletter').on({
            focusout: function () {
                $(this).data('timer', setTimeout(function () {
                    $(this).removeClass('show-full-form');
                    hideNewsletterForm();
                }.bind(this), 0));
            },
            focusin: function () {
                clearTimeout($(this).data('timer'));
            },
            keydown: function (e) {
                if (e.which === 27) {
                    hideNewsletterForm();
                    e.preventDefault();
                }
            }
        });

        $('.newsletter-email').on({
            focusout: function () {
                $(this.hash).data('timer', setTimeout(function () {
                    $(this.hash).removeClass('show-full-form');
                }.bind(this), 0));
            },
            focusin: function () {
                clearTimeout($(this.hash).data('timer'));
            }
        });

        function showNewsletterForm() {
            jQuery('#footer-newsletter').addClass('show-full-form').focus();
            jQuery('.newsletter-header').css('visibility', 'hidden');


        }

        function hideNewsletterForm() {
            jQuery('#footer-newsletter').removeClass('show-full-form');
            jQuery('.newsletter-header').css('visibility', 'visible');
        }

        jQuery('#share-link').on('click', function() {
            jQuery('#at4-share').show();
            jQuery('.at4-arrow.at-right').click();
        })

    });
 
</script>


<?php wp_footer(); ?>
<style>

  .widget_wysija_cont {
    width: 100%;
	margin-bottom: 2px;
}
#form-wysija-2{width:100% important;}
.wysija-paragraph {
    display: inline-block;
}
#form-wysija-2 {
    float: right;
}
.wysija-submit.wysija-submit-field.btn.btn-site {
    display: inline-block !important;
    margin: 0;
}
#form-wysija-2 .wysija-paragraph:nth-child(1) {
    display: none;
}
#form-wysija-2:hover .wysija-paragraph:nth-child(1){ display: inline-block;}
#form-wysija-2 .wysija-paragraph:nth-child(2) {
    display: none;
}
#form-wysija-2:hover .wysija-paragraph:nth-child(2){ display: inline-block;}

.hide-element {
    display: none;
}

.show-full-form .hide-element {
    display:block
}

.show-full-form {
    margin-top: -50px;
}

/* ADD THIS */
#at4-share {display:none}
#share-link {
    text-transform: uppercase;
    font-size: 10px;
    letter-spacing: 3px;
    font-weight: normal;
    display: inline-block;
    color: #bbb;
    position: fixed;
    top: 300px;
    width: 300px;
    left: -280px;
    text-align: right;
    transform-origin: 100% 0;
    -webkit-transform: rotate(-90deg);
    -moz-transform: rotate(-90deg);
    -ms-transform: rotate(-90deg);
    -o-transform: rotate(-90deg);
    z-index: 1000;
    cursor: pointer;
}
  @media (max-width:767px){
      #share-link{
          left:-295px;
      }
  }

</style>

<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59fbc0eaf7e0badf"></script>
<div id="share-link">Share</div>
<script>
  window.addEventListener('load',function(){
    jQuery('a[href="mailto:corie@wildaid.org"]').click(function(){
      ga('gtm1.send','event','link','click','email')
    })
  })
</script>
</body>
</html>
