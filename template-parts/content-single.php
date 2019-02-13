<?php
/**
 * Template part for displaying post contents
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package CodeAid
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <h1 class="entry-title"><?php the_title(); ?></h1>

    <ul class="sns-wrap">
    <li>
      <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
    </li>
    <li>
      <div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
    </li>
    <li>
      <a href="http://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="basic-counter" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a>
      </li>
    <li>
      <div class="line-it-button" data-type="share-a" data-url="https://media.line.me/en/how_to_install" style="display: none;"></div>
    </li>
    </ul>

    <div class="entry-meta">
      <?php if ( 'ca_blog' === get_post_type() ) : ?>
        <?php codeaid_posted_on(); ?>
      <?php endif; ?>

      <?php
        /* translators: used between list items, there is a space after the comma */
        $tag_list = get_the_tag_list( '', esc_html__( ' ', 'codeaid' ) );
        if ( '' != $tag_list ) {
          $meta_text = '<i class="fa fa-tags fa-fw" aria-hidden="true"></i>'.esc_html__( '%1$s ', 'codeaid' );
        } else {
          $meta_text = '<i class="fa fa-tags fa-fw" aria-hidden="true"></i>';
        }
      ?>

    <span class="tags-links">
      <?php
        printf(
          $meta_text,
          $tag_list,
          get_permalink(),
          the_title_attribute( 'echo=0' )
        );
      ?>
    </span>
    </div><!-- .entry-meta -->
  </header><!-- .entry-header -->

  <div class="entry-content">
    <?php codeaid_excerpt(); ?>
    <?php codeaid_post_thumbnail(); ?>
    <?php the_content(); ?>
    <div class="pagination-centered">
      <?php
      wp_link_pages( array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'codeaid' ),
        'after'  => '</div>',
      ) );
      ?>
    </div>
  </div><!-- .entry-content -->

  <footer class="entry-meta">
    <?php
    edit_post_link(
      sprintf(
        /* translators: %s: Name of current post */
        esc_html__( 'Edit %s', 'codeaid' ),
        the_title( '<span class="screen-reader-text">"', '"</span>', false )
      ),
      '<span class="edit-link">',
      '</span>'
    );
    ?>
  </footer><!-- .entry-meta -->
</article><!-- #post-## -->
