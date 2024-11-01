<!doctype html>
<html amp lang="en">
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="referrer" content="always">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1" />
	<meta name="robots" content="index,follow,all">
   
	 <!-- Head START -->
    <?php  global $post,$wp; ?>
     <title><?php echo (get_option('wpampweb_m_title')) ?  get_post_meta(get_the_ID(),get_option('wpampweb_m_title'),true) : get_the_title();?></title>
     <link rel="icon" href="<?php echo (get_option('wpampweb_m_favicon')) ?  get_option('wpampweb_m_favicon') : '' ; ?>">
     <meta name="keywords" content="<?php echo (get_option('wpampweb_m_description')) ?  get_post_meta(get_the_ID(),get_option('wpampweb_m_keywords'),true) : '' ; ?>">
     <meta name="descriptions" content="<?php echo (get_option('wpampweb_m_description')) ?  get_post_meta(get_the_ID(),get_option('wpampweb_m_description'),true) : '' ; ?>"> 
     
     <link rel="canonical" href="<?php echo (get_option('wpampweb_m_canonical')) ?  ((get_post_meta(get_the_ID(),get_option('wpampweb_m_canonical'),true)!='') ? get_post_meta(get_the_ID(),get_option('wpampweb_m_canonical'),true) : home_url().$_SERVER['REQUEST_URI']) : home_url().$_SERVER['REQUEST_URI'] ; ?>">
     <link rel="alternate" href="<?php echo home_url(); ?>" hreflang="en-us" />
     <meta name="theme-color" content="#000">
     <?php
     //seo meta description and keywords
     $logo = get_option('wpampweb_m_logo') ? '<a href="'.home_url().'" class="amp-header-logo"><amp-img src="'.get_option('wpampweb_m_logo').'" alt="'.get_bloginfo('name').'" height="30" width="150"></amp-img></a>' : get_bloginfo('name');
     echo do_shortcode(get_option('wpampweb_m_head'));
     $plugins_url = plugins_url('wp-amp-website');
    ?>
	<style amp-custom>
	body{font-family: 'Roboto', sans-serif; color:#000;font-weight:300; font-size:16px; line-height:1.6;}
	.bg-yellow { background-color: #eda42d;color: #fff;}
.container{max-width:767px; margin:0 auto;}
	
.btn {
    background-color: #0d8bcd;
    color: #fff;
    font-size: 1.5rem;
    padding: 10px 20px;
}
.text-orange {
    color: #f4861f;
    text-decoration: none;
}
.container-fluid {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;display:block;
}
.bg-light {
    background-color: #f8f9fa;
}
.bg-white {
    background-color: #f8f9fa;
}
.text-blue {
    color: #2493c0;
    text-decoration: none;
}

ul {
  list-style: none;
}
.circle {
    list-style-type: none;
    position: relative;
    text-align: left;
}
.circle:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 400;
}
.circle > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #069bdc;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 400;
}
.circle > li {
    margin: 20px 0;
    padding-left: 20px;
}
ol {
  list-style: none;
  counter-reset: my-awesome-counter;
}
ol li {
  counter-increment: my-awesome-counter;
}
ol li::before {
  content: counter(my-awesome-counter) ". ";
  color: red;
  font-weight: bold;
}


.tick li:before { content:"\2713\0020"; color: #0d8bcd; font-weight: bold; font-size: 18px;}


.p-relative{position:relative;}
.d-inline-block{display:inline-block;}.d-block{display:block;}.two-column li{width:49%;display:inline-block;}.three-column li {width:32%;display:inline-block;}.one-column li{width:100%;}
	h1,h2,h3,h4,h5,h6{font-weight:300;}
	h1, .h1{font-size:24px; margin:5px 0px; line-height:1.4; font-weight:500;}
.shadow {
    transition: all 0.5s ease-in-out;
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15);
}
.no-shadow{box-shadow:none;}

.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    /* min-width: 0; */
    word-wrap: break-word;
    background-clip: border-box;
    border-radius: .25rem;
}
.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1rem;
    border-bottom: 1px solid #ccc;
}
	.post-loop{margin:10px 0px;padding:10px;}
	.post-loop .screen-reader-text{display:none;}
	a.more-link { padding: 10px; background: #00add8; color: #fff; }
	.link-more{margin-top:15px;}
	.nav-links{margin:0.7rem 0px; padding:5px 10px; border:1px solid #ccc; border-radius:10px; display:inline-block;}
	h2, .h2 {
    font-size: 24px;
    line-height: 1.4;
    font-weight: 600;
    color: #0d8bcd;
    display: inline-block;
    box-shadow: 0 25px 0 -23px #0d8bcd;
}
	h3, .h3{font-size:20px; margin:5px 0px; line-height:1.4;font-weight:600;}
	h4, .h4{font-size:18px; margin:5px 0px; line-height:1.4;}
	h5, .h5{font-size:16px; margin:5px 0px; line-height:1.4;}
	h6{font-size:14px; margin:5px 0px; line-height:1.4;}
	.text-center{text-align:center;}
	p{margin:0 0 10px; line-height:1.6;}
	a{text-decoration:none; color: #00add8;}
	img{max-width:100%;}
	.text-uppercase{text-transform:uppercase;}
	.clear{clear:both;}
.hamburger {
    padding-left: 10px;
    font-size: 2rem;
    display: inline-block;outline: none; color: #fff;
}
.site-name {
    display: inline-block;float: left;
    padding: 12px;
}
header.headerbar {
    position: relative;
    text-align: right;
    padding-right: 20px;
    background: #090a0b;
    color: #fff;
}
.title-bar{background:linear-gradient(100deg,rgba(86, 18, 18, 0.84),rgb(12, 33, 88));
    background-size: cover;
    padding: 10px 10px;
    text-align: center;
    color: #fff;}
.content{padding:10px 0px;}    
.sidebar {
  padding: 10px;
  margin: 0;
}
.sidebar > li {
  list-style: none;
  margin-bottom:10px;
}
.sidebar a {
  text-decoration: none;
}
amp-sidebar#sidebar1 {background: rgba(0, 0, 0, 0.8);color: #fff;width:50%;}
amp-sidebar#sidebar1 a{padding: 8px 15px; width: 75%; color: #fff; font-weight: 300; font-size: 1.1rem;}
amp-sidebar#sidebar1 a:hover, amp-sidebar#sidebar1 a:focus {
    cursor: pointer;
}
.close-sidebar {
    font-size: 1.5em;
    padding-right: 10px;
    text-align: right;
    outline: none;
}
.py-1 {
    padding-bottom: .25rem;padding-top: .25rem;
}
.py-2 {
    padding-bottom: .50rem;padding-top: .50rem;
}
.py-3 {
    padding-bottom: 1rem;padding-top: 1rem;
}
.py-4 {
    padding-bottom: 2rem;padding-top: 2rem;
}
.py-5 {
    padding-bottom: 3rem;padding-top: 3rem;
}
.px-1 {
    padding-left: .25rem;padding-right: .25rem;
}
.px-2 {
    padding-left: .50rem;padding-right: .50rem;
}
.px-3 {
    padding-left: 1rem;padding-right: 1rem;
}
.px-4 {
    padding-left: 2rem;padding-right: 2rem;
}
.px-5 {
    padding-left: 3rem;padding-right: 3rem;
}
.mx-1 {
    margin-bottom: .25rem;margin-top: .25rem;
}
.mx-2 {
    margin-bottom: .50rem;margin-top: .50rem;
}
.mx-3 {
    margin-bottom: 1rem;margin-top: 1rem;
}
.mx-4 {
    margin-bottom: 2rem;margin-top: 2rem;
}
.mx-5 {
    margin-bottom: 3rem;margin-top: 3rem;
}
.text-center{text-align:center}
.text-left{text-align:left}
.text-right{text-align:right}
.text-right{text-align:right}
	.form-section input[type="text"], .form-section input[type="email"], .form-section input[type="phone"], .form-section textarea {background: #fff; border: 1px solid #d7d7d7; padding: 12px 10px; margin: 0 0 15px; width: 100%; box-sizing: border-box; font-family: Roboto,sans-serif; font-size: 13px; font-weight: 400;}
	textarea{height:100px; resize:none;}

/***** Start Scroll to top *****/
 :root {
    --color-primary: #0d8bcd;
    --color-secondary: #00DCC0;
    --color-text-light: #fff;

    --space-2: 1rem;   /* 16px */

    --box-shadow-1: 0 1px 1px 0 rgba(0,0,0,.14), 0 1px 1px -1px rgba(0,0,0,.14), 0 1px 5px 0 rgba(0,0,0,.12);
  }
  .scrollToTop {
    color: var(--color-text-light);
    font-size: 1.4em;
    box-shadow: var(--box-shadow-1);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: none;
    outline: none;
    background: var(--color-primary);
    z-index: 9999;
    bottom: var(--space-2);
    right: var(--space-2);
    position: fixed;
    opacity: 0;
    visibility: hidden;
  }
  .spacer {
    width: 100vw;
    max-width: 700px;
    height: 200vh;
    background-color: var(--color-secondary);
  }
  /* we move the anchor down to componsate the fixed header */
  .target {
    position: relative;
  }
  .target-anchor {
    position: absolute;
    top: -72px;
    left: 0;
  }
/***** End Scroll to top *****/
/* Facny line */


footer.footer {
    background:#090a0b;
    color: #fff;text-align:center;
}
footer.footer ul {
    list-style: none;
    position: relative;
    padding: 10px;
}
footer.footer ul li {
    display: inline-block;
    color: #fff;
    padding-right: 5px;
    padding-left: 5px;
    border-right: 1px solid #fff;
}
footer.footer ul li:last-child{border:none;}
footer.footer ul li a {
    color: #fff;
}
.wrap {
    color: #fff;
}
.copyright {
    padding: 10px 0px;
    text-align: center;
    border-top: 1px solid #23292f;font-size: 14px;
}
/* home page slider */
.heading {
    font-size: 32px;
    text-align: center;
    position: relative;
    top: 30%;
    color: #fff;
}
.col-12{width:100%;display:block;}.col-6{width:50%;display:inline-block;}.col-4{width:33%;display:inline-block;}
<?php 
global $post;

echo get_post_meta($post->ID,'_wpampweb_mobile_css',true);

?>
	</style>
	<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
	<meta name="amp-google-client-id-api" content="googleanalytics">
	<script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
	<script async custom-element="amp-position-observer" src="https://cdn.ampproject.org/v0/amp-position-observer-0.1.js"></script>
	<script async custom-element="amp-lightbox" src="https://cdn.ampproject.org/v0/amp-lightbox-0.1.js"></script>
	<script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>
	<script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
	<script async custom-element="amp-bind" src="https://cdn.ampproject.org/v0/amp-bind-0.1.js"></script>
	<script async custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"></script>
	<script async custom-element="amp-animation" src="https://cdn.ampproject.org/v0/amp-animation-0.1.js"></script>
	<!-- AMP Analytics -->
	<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
	<script async src="https://cdn.ampproject.org/v0.js"></script>
  </head>
<body <?php body_class(); ?>>
<?php 
	/* display header hooks */
	echo do_shortcode(get_option('wpampweb_m_header'));
?>
<div class="container">
<header class="headerbar target"><a class="target-anchor" id="top"></a><amp-position-observer on="enter:hideAnim.start; exit:showAnim.start" layout="nodisplay"></amp-position-observer>
  <div class="site-name"><?php echo $logo;?></div>
  <div role="button" on="tap:sidebar1.toggle" tabindex="0" class="hamburger">☰</div>
</header>
<amp-sidebar id="sidebar1" layout="nodisplay" side="right">
  <div role="button" aria-label="close sidebar" on="tap:sidebar1.toggle" tabindex="0" class="close-sidebar">✕</div>
<?php wp_nav_menu( array(
    'theme_location' => 'wpampweb_amp_top_menu',
    'items_wrap'     => '<ul class="sidebar"><li id="item-id"></li>%3$s</ul>'
) );?>
</amp-sidebar>
