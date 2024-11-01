<?php
global $post;
$wpampweb_m_desktop_hf = get_option('wpampweb_m_desktop_hf');
$scripts = '';
//load page specific scripts
$scripts .= do_shortcode(get_post_meta($post->ID,'_wpampweb_mobile_css',true));
$getCopyright = (get_option('wpampweb_m_copyright')!='') ? get_option('wpampweb_m_copyright') : '';
?>

<footer class="footer">
	<div class="wrap">
		<?php wp_nav_menu( array(
    'theme_location' => 'wpampweb_amp_footer_menu',
    'items_wrap'     => '<ul class="footer">%3$s</ul>'
) );?>
	</div>
	<div class="copyright">
			<?php echo sprintf($getCopyright,date('Y'));?>
	</div>
</footer>
</div>
<!--
    We use 2 `amp-animation` elements to trigger the visibility of the button. The first one is for making the button visible...
  -->
<amp-animation id="showAnim"
  layout="nodisplay">
  <script type="application/json">
    {
      "duration": "200ms",
      "fill": "both",
      "iterations": "1",
      "direction": "alternate",
      "animations": [{
        "selector": "#scrollToTopButton",
        "keyframes": [{
          "opacity": "1",
          "visibility": "visible"
        }]
      }]
    }
  </script>
</amp-animation>
  <!-- ... and the second one is for adding the button.-->
<amp-animation id="hideAnim"
  layout="nodisplay">
  <script type="application/json">
    {
      "duration": "200ms",
      "fill": "both",
      "iterations": "1",
      "direction": "alternate",
      "animations": [{
        "selector": "#scrollToTopButton",
        "keyframes": [{
          "opacity": "0",
          "visibility": "hidden"
        }]
      }]
    }
  </script>
</amp-animation>
<button id="scrollToTopButton"
  on="tap:top.scrollTo(duration=200)"
  class="scrollToTop">⌃</button>
<?php echo get_option('wpampweb_m_footer') ? do_shortcode(get_option('wpampweb_m_footer')) : '';?>
</body>
</html>
