<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package CodeAid
 */

get_header(); ?>

  <div id="primary" class="content-area col-md-12">
    <main id="main" class="site-main" role="main">

      <section class="error-404 not-found">
        <header class="page-header entry-header">
          <h1 class="page-title entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'codeaid' ); ?></h1>
          <img src="<?php echo get_template_directory_uri(); ?>/img/404.jpg" alt="<?php echo esc_html__( 'can&rsquo;t be found...' ); ?>" />
        </header><!-- .page-header -->

        <div class="page-content">
          <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'codeaid' ); ?></p>

          <?php
//            get_search_form();
          ?>

          <?php dynamic_sidebar( 'sidebar-1' ); ?>

          <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
            <?php bloginfo( 'name' ); ?>
            トップページへ戻る</a>
          </p>
        </div><!-- .page-content -->
      </section><!-- .error-404 -->

    </main><!-- #main -->
  </div><!-- #primary -->
<?php// get_sidebar(); ?>
<?php
get_footer();
