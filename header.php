<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CodeAid
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<meta charset="<?php bloginfo( 'charset' ); ?>">

<title>
<?php wp_title( '-', true, 'right'); ?>
<?php bloginfo( 'name' ); ?>
</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<?php if( is_home() || is_front_page() ): // トップページ用のメタデータ ?>
  <meta name="description" content="<?php bloginfo( 'description' ); ?>">

  <?php $allcats = get_categories();
  $kwds = array();
  foreach ( $allcats as $allcat ) {
    $kwds[] = $allcat->name;
  } ?>
  <meta name="keywords" content="<?php echo implode( ',', $kwds ); ?>">

  <meta property="og:type" content="website">
  <meta property="og:title" content="<?php bloginfo( 'name' ); ?>">
  <meta property="og:url" content="<?php echo esc_url(home_url( '/' )); ?>">
  <meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
  <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/img/site-top.jpg">
<?php endif; // トップページ用のメタデータ【ここまで】 ?>

<?php if( ( is_single() || is_page() ) && ( !is_front_page() ) ): //記事の個別ページ用のメタデータ ?>
  <meta name="description" content="<?php echo wp_trim_words( $post->post_excerpt, 200, '…' ); ?>">

  <?php if ( has_tag() ): ?>
    <?php $tags = get_the_tags();
    $kwds = array();
    foreach ( $tags as $tag ) {
      $kwds[] = $tag->name;
    } ?>
    <?php $allcats = get_the_category();
    foreach ( $allcats as $allcat ) {
      $kwds[] = $allcat->name;
    } ?>
    <meta name="keywords" content="<?php echo implode( ',', $kwds ); ?>">
  <?php endif; ?>

  <meta property="og:type" content="article">
  <meta property="og:title" content="<?php the_title(); ?>">
  <meta property="og:url" content="<?php the_permalink(); ?>">
  <meta property="og:description" content="<?php echo esc_attr( wp_trim_words( $post->post_excerpt, 200, '…' ) ); ?>">
  <meta property="og:image" content="<?php echo get_thumbnail_url( 'large' ); ?>">
<?php endif; //記事の個別ページ用のメタデータ【ここまで】?>

<?php if( is_category() || is_tag() ): // カテゴリー・タグページ用のメタデータ ?>
  <?php if( is_category() ) {
      $termid = $cat;
      $taxname = 'category';
  } elseif( is_tag() ) {
      $termid = $tag_id;
      $taxname = 'post_tag';
  } ?>

  <?php $childcats = get_categories( array( 'child_of'=>$termid ) );
  $kwds = array();
  $kwds[] = single_term_title( '', false );
  foreach ( $childcats as $childcat ) {
    $kwds[] = $childcat->name;
  } ?>
  <meta name="keywords" content="<?php echo implode( ',', $kwds ); ?>">

  <meta name="description" content="<?php echo esc_html__( 'This list is about posts on ', 'codeaid' ); ?><?php single_term_title(); ?>">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?php echo esc_html__( 'Posts related to ', 'codeaid' ); ?><?php single_term_title(); ?> | <?php bloginfo( 'name' ); ?>">
  <meta property="og:url" content="<?php echo get_term_link( $termid, $taxname ); ?>">
  <meta property="og:description" content="<?php echo esc_html__( 'This list is about posts on ', 'codeaid' ); ?><?php single_term_title(); ?>">
  <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/img/site-top.jpg">
<?php endif; // カテゴリ・タグページ用のメタデータ【ここまで】 ?>

<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
<meta property="og:locale" content="ja_JP">
<meta property="og:locale:alternate" content="en_US">
<meta property="og:locale:alternate" content="en_GB">
<meta property="og:locale:alternate" content="zh_TW">
<meta property="fb:app_id" content="2002804263297057">
<meta name="twitter:site" content="@CodeAidxx">
<meta name="twitter:creator" content="@CodeAidxx">
<meta name="twitter:card" content="summary_large_image">

<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" />

<?php wp_head(); ?>

<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-75719561-7"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', 'UA-75719561-7');
</script>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-6212569927869845",
          enable_page_level_ads: true
     });
</script>

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
  <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'codeaid' ); ?></a>

  <header id="masthead" class="site-header" role="banner">
    <div class="row">
      <div class="site-branding col-sm-6">
        <h1 class="site-logo">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="codeaid" />
          </a>
        </h1>
      </div>
      <div class="site-subtitle col-sm-6">
        プログラミング学習応援サイト
      </div>
    </div>
    <div id="site-navi" class="main-navi">
      <div id="small-navi">
        <button type="button" id="navbtn">
        <i class="fa fa-bars"></i><span>MENU</span>
        </button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <?php wp_nav_menu( array(
                  'theme_location' => 'primary',
                  'container' => 'nav',
                  'container_class' => 'header-nav',
          ) ); ?>
        </div>
      </div>
    </div>
    <!-- #site-navigation -->
    <?php if ( ! is_home() && ! is_front_page()  ) : ?>
      <div class="row">
        <div class="school-banner col-md-12 col-sm-12 col-xs-12">
            <a href="https://codeaid.jp/school">
              <div class="school-banner">
                <img src="<?php echo get_template_directory_uri(); ?>/img/school-banner.jpg" alt="">
              </div>
            </a>
        </div>
      </div>
    <?php endif; ?>
    <!-- #school-banner -->
  </header>
  <!-- #masthead -->
<?php if ( is_home() || is_front_page() && get_header_image() ) : ?>
  <div id="main-img">
    <img src="<?php header_image(); ?>" alt="" />
    <h1 class="site-description">
      <?php bloginfo( 'description' ); ?>
    </h1>
  </div>
<?php endif; ?>

<?php if ( ! is_home() && ! is_front_page() && is_my_plugin_active( 'show-adsense/show-adsense.php' ) ) : ?>
  <div class="row">
    <div class="col-md-12">
      <?php echo do_shortcode( '[showad id="header"]' ); ?>
    </div>
  </div>
<?php endif; ?>

<?php if ( ! is_front_page() ) : ?>
  <div id="content" class="site-content row">
<?php endif; ?>
