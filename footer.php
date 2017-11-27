<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CodeAid
 */

?>

  </div><!-- #content -->

  <?php if ( ! is_home() && ! is_front_page() && is_my_plugin_active( 'show-adsense/show-adsense.php' ) ) : ?>
    <div class="row">
      <div class="col-md-12">
        <?php echo do_shortcode( '[showad id="footer"]' ); ?>
      </div>
    </div>
  <?php endif; ?>

  <footer id="colophon" class="site-footer" role="contentinfo">
    <div class="row">
      <div class="col-md-12">
        <?php get_template_part('inc/snsbtn'); // add SNS button ?>
          <div class="site-info text-center">
            <p>Copyright&copy; 2017<?php if ( '2017' != ($date = date_i18n( 'Y' )) ) { echo ' - '.$date;}?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> All Rights Reserved. |
              <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php echo esc_html__( 'Contact', 'codeaid' ); ?></a> |
              <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php echo esc_html__( 'About CodeAid', 'codeaid' ); ?>
            </p>
          </div><!-- .site-info -->
      </div>
    </div>
    <a href="#top" class="gotop-btn"><i class="fa fa-chevron-up"></i></a>
  </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script>
  jQuery(function () {
    var headerHight = 50; //ヘッダの高さ
    jQuery('a[href^=#]').click(function(){
      var href= jQuery(this).attr("href");
      var target = jQuery(href == "#" || href == "" ? 'html' : href);
      var position = target.offset().top - headerHight; //ヘッダの高さ分位置をずらす
      jQuery("html, body").animate({scrollTop:position}, 550, "swing");
      return false;
    });
  });
</script>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

<div id="fb-root"></div>
<?php if ( 'ja' == get_bloginfo('language') ) : ?>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.8";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
<?php else : ?>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
<?php endif; ?>

<script src="https://apis.google.com/js/platform.js" async defer></script>
<script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
<script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>

</body>
</html>
