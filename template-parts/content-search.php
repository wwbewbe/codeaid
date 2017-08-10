<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package CodeAid
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="row">
    <div class="col-md-3 col-sm-3 thumbnail">
      <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to %s', 'codeaid' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
          <img src="<?php echo get_thumbnail_url( 'mideum' ); ?>" alt="" title="" />
      </a>
    </div> <!-- 3 thumbnail -->
    <div class="col-md-9 col-sm-9">
      <header class="entry-header">
        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        <?php if ( 'ca_blog' === get_post_type() ) : ?>
          <div class="entry-meta">
            <?php codeaid_posted_on(); ?>
          </div><!-- .entry-meta -->
        <?php endif; ?>
      </header><!-- .entry-header -->

      <?php codeaid_excerpt(); ?>

      <footer class="entry-footer">
        <?php codeaid_entry_footer(); ?>
      </footer><!-- .entry-footer -->
    </div><!-- 9 title excerpt -->
  </div><!-- .row -->
</article><!-- #post-## -->
