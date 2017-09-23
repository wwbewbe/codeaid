<?php
/**
 * The template for displaying front-page
 */
get_header(); ?>
  <div class="row front-feature">

    <div class="front-sp col-md-12 col-sm-12 col-xs-12">
      <?php if ( get_page_by_path( 'start' ) ) : ?>
          <a href="<?php echo get_permalink( get_page_by_path( 'start' )->ID ); ?>">
            <div class="sp-thumb">
              <img src="<?php echo get_template_directory_uri(); ?>/img/start.jpg" alt="">
            </div>
            <div class="sp-text">
              <h3><?php echo apply_filters( 'the_title', get_page_by_path( 'start' )->post_title ); ?></h3>
              <p><?php echo esc_html__( 'これだけ知っておけばプログラミング学習は怖くない。多くのプログラミングに共通したポイントを知っておくことで、無理なく学習を続けることができます。', 'codeaid' ); ?></p>
            </div>
          </a>
      <?php endif; ?>
    </div>

    <div class="front-cat col-md-12 col-sm-12 col-xs-12">
      <div class="row">
        <?php
    		$location_name = 'topicnav';
    		$locations = get_nav_menu_locations();
    		$myposts = wp_get_nav_menu_items( $locations[ $location_name ] );
    		if( $myposts ): ?>
    			<?php foreach($myposts as $post):
    			if(( $post->object == 'post' ) || ( $post->object == 'page' )):
    			$post = get_post( $post->object_id );
    			setup_postdata($post); ?>

            <div class="col-md-4 col-sm-4">
            	<a href="<?php the_permalink(); ?>">
                <div class="catlist">
                	<img class="topic-thumbnail" src="<?php echo get_thumbnail_url( 'full' ); ?>">
                	<h3><?php the_title() ?></h3>
                  <?php codeaid_excerpt(); ?>
                </div>
            	</a>
            </div>

    			<?php endif;
    			endforeach; ?>
    		<?php wp_reset_postdata();
    		endif; ?>
      </div>
    </div>

  </div>

  <?php
	$location_name = 'pickupnav';
	$locations = get_nav_menu_locations();
	$myposts = wp_get_nav_menu_items( $locations[ $location_name ] );
	if( $myposts ): ?>

    <div class="row front-pickup">
      <div class="col-md-12">
        <h2><?php echo esc_html__( 'Feature Posts', 'codeaid' ); ?></h2>
        <div class="row">
      		<?php foreach($myposts as $post):
      		if(( $post->object == 'post' ) || ( $post->object == 'page' )):
      		$post = get_post( $post->object_id );
      		setup_postdata($post); ?>

            <div class="col-md-3 col-sm-3 col-xs-12">
            	<a href="<?php the_permalink(); ?>">
                <div class="row">
                  <div class="pickup-thumb col-md-12 col-sm-12 col-xs-5">
            	      <img src="<?php echo get_thumbnail_url( 'pickup-top-thumb' ); ?>">
                  </div>
                  <div class="pickup-text col-md-12 col-sm-12 col-xs-7">
                    <h3><?php the_title() ?></h3>
                    <?php if ( is_singular( 'ca_blog' ) ) :?>
                      <div class="date">
                        <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>
                        <?php the_time( 'Y/m/d' ); ?>
                      </div>
                    <?php endif; ?>
                    <?php codeaid_excerpt(); ?>
                  </div>
                </div>
            	</a>
            </div>

      		<?php endif;
      		endforeach; ?>
        	<?php wp_reset_postdata(); ?>
        </div>
      </div>
    </div>

	<?php endif; ?>

  <?php
  $args = array(
    'post_type' => 'ca_blog',
    'posts_per_page' => '6',
  );
  $the_query = new WP_Query($args);
  if ( $the_query->have_posts() ) : ?>
    <div class="front-news">
      <div class="row">
        <div class="col-md-12">
          <h2><?php echo esc_html__( 'Latest Blogs', 'codeaid' ); ?></h2>
          <div class="row">
            <?php while ( $the_query->have_posts() ) :
              $the_query->the_post(); ?>
              <div class="col-md-2 col-sm-2 col-xs-12">
                <a href="<?php the_permalink(); ?>">
                  <div class="newspost">
                    <div class="row">
                      <div class="col-sm-12 col-xs-5">
                        <div class="thumbnail">
                          <img src="<?php echo get_thumbnail_url( 'latest-top-thumb' ); ?>" alt="" title="" />
                        </div>
                      </div>

                      <div class="col-sm-12 col-xs-7">
                        <div class="news-meta">
                          <div class="date">
                            <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>
                            <?php the_time( 'Y/m/d' ); ?>
                          </div>
                          <h3><?php the_title(); ?></h3>
                          <?php codeaid_excerpt(); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            <?php endwhile; ?>
            <?php wp_reset_query(); ?>
          </div>
        </div>
      </div> <!-- /row -->
    </div> <!-- /front-news -->
  <?php endif; ?>

  <div id="main" class="site-main row">
<?php get_footer(); ?>
