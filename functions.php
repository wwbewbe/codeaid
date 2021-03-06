<?php
/**
 * CodeAid functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CodeAid
 */

if ( ! function_exists( 'codeaid_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function codeaid_setup() {
  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on CodeAid, use a find and replace
   * to change 'codeaid' to the name of your theme in all the template files.
   */
  load_theme_textdomain( 'codeaid', get_template_directory() . '/languages' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );

  /*
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
   */
  add_theme_support( 'post-thumbnails' );
  add_image_size( 'latest-top-thumb', 250, 200, true );
  add_image_size( 'pickup-top-thumb', 250, 150, true );
  add_image_size('thumb100', 100, 100, true); // インナーブログカード用

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'primary' => esc_html__( 'Primary', 'codeaid' ),
  ) );

  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ) );

  // Set up the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'codeaid_custom_background_args', array(
    'default-color' => 'ffffff',
    'default-image' => '',
  ) ) );

  // Add theme support for selective refresh for widgets.
  add_theme_support( 'customize-selective-refresh-widgets' );

  // Default block styles Gutenberg
  add_theme_support( 'wp-block-styles' );

  // Wide Alignment Gutenberg
  add_theme_support( 'align-wide' );

  // Gutenberg editor style
  add_theme_support( 'editor-styles' );
}
endif;
add_action( 'after_setup_theme', 'codeaid_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function codeaid_content_width() {
  $GLOBALS['content_width'] = apply_filters( 'codeaid_content_width', 640 );
}
add_action( 'after_setup_theme', 'codeaid_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function codeaid_widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar', 'codeaid' ),
    'id'            => 'sidebar-1',
    'description'   => esc_html__( 'Add widgets here to appear in sidebar.', 'codeaid' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );

  register_sidebar( array(
    'name'          => esc_html__( 'Content Bottom 1', 'codeaid' ),
    'id'            => 'sidebar-2',
    'description'   => esc_html__( 'Appears at the bottom of the content on front page.', 'codeaid' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'codeaid_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function codeaid_scripts() {
  wp_enqueue_style( 'bootstrap-style', "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" );
  wp_enqueue_style( 'codeaid-style', get_stylesheet_uri(), array(), date('U') );
  wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
  wp_enqueue_style( 'google-font', 'https://fonts.googleapis.com/css?family=Ubuntu+Mono:400,700|Roboto+Condensed:300,400,700|Roboto+Slab:300,400,700|Roboto:300,400,700,900' );
  wp_enqueue_style( 'google-mplus1p', 'https://fonts.googleapis.com/earlyaccess/mplus1p.css' );
  wp_enqueue_style( 'google-roundedmplus1c', 'https://fonts.googleapis.com/earlyaccess/roundedmplus1c.css' );

  wp_enqueue_script( 'jquery');
  wp_enqueue_script( 'bootstrap-script', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' );
  wp_enqueue_script( 'navbtn-script', get_template_directory_uri() .'/js/navbtn.js' );
  wp_enqueue_script( 'codeaid-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), date('U'), true );
  wp_enqueue_script( 'header-fix', get_template_directory_uri() .'/js/header-fix.js' );
  wp_enqueue_script( 'gotop-btn', get_template_directory_uri() .'/js/gotop-btn.js' );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'codeaid_scripts' );

// エディタスタイルシート
add_editor_style( get_template_directory_uri() . '/editor-style.css?ver=' . date( 'U' ) );
add_editor_style( '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * 抜粋の制限文字数設定
 */
//概要（抜粋）の文字(単語)数(WP Multibyte Patchを使わない時に有効)※バイト数で数えているっぽい
function my_length($length) {
    return 50;
}
add_filter('excerpt_length', 'my_length');
// 抜粋欄を使用した時の抜粋文の文字制限(WP Multibyte Patchを使えば有効)
function my_the_excerpt($myexcerpt) {
  $myexcerpt = mb_strimwidth($myexcerpt, 0, 160, "…", "UTF-8");
  return $myexcerpt;
}
add_filter('the_excerpt', 'my_the_excerpt');

// 概要（抜粋）の省略記号
function my_more( $more ) {
  return '…';
}
add_filter( 'excerpt_more', 'my_more' );

//固定ページにも抜粋(excerpt)を使えるようにする
add_post_type_support( 'page', 'excerpt' );

/**
 * 管理画面カスタマイズ
 */
// 編集画面の設定
function editor_setting($init) {
  $init[ 'block_formats' ] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Preformatted=pre;Code=code';

  $style_formats = array(
    array( 'title' => 'Tips info',
      'block' => 'div',
      'classes' => 'tips',
      'wrapper' => true ),
    array( 'title' => 'Attention',
      'block' => 'div',
      'classes' => 'attention',
      'wrapper' => true ),
    array( 'title' => 'Highlight',
      'inline' => 'span',
      'classes' => 'highlight'),
    array( 'title' => 'Highlight-gray',
      'inline' => 'span',
      'classes' => 'highlight-gray'),
    array( 'title' => 'Code-Comment',
      'inline' => 'span',
      'classes' => 'code-comment'),
    array( 'title' => '24px',
      'inline' => 'span',
      'classes' => 'font-24px'),
    array( 'title' => '36px',
      'inline' => 'span',
      'classes' => 'font-36px') );
  $init[ 'style_formats' ] = json_encode( $style_formats );

  return $init;
}
add_filter( 'tiny_mce_before_init', 'editor_setting');

// スタイルメニューを有効化
function add_stylemenu( $buttons ) {
      array_splice( $buttons, 1, 0, 'styleselect' );
      return $buttons;
}
add_filter( 'mce_buttons_2', 'add_stylemenu' );

/**
 * 管理画面の投稿一覧カスタマイズ
 */
// 投稿一覧にカラムを追加
function add_manage_column( $columns ) {
  $post_type = isset( $_REQUEST['post_type'] ) ? $_REQUEST['post_type'] : 'post';
  /*if ( post_type_supports( $post_type, 'excerpt' ) ) {
    $columns['excerpt'] = __( 'Excerpt' );
  }*/
  if ( post_type_supports( $post_type, 'thumbnail' ) ) {
    $columns['thumbnail'] = __( 'Featured Images' );
  }
  return $columns;
}
add_filter( 'manage_posts_columns', 'add_manage_column' );

// 投稿一覧に追加したカラム内容を表示
function display_manage_column( $column_name, $post_id ) {
  /*if ( $column_name == 'excerpt' ) {
    if ( has_excerpt( $post_id ) ) {
      echo get_the_excerpt();
    } else {
      _e( 'None' );
    }
  }*/
  if ( $column_name == 'thumbnail' ) {
    if ( has_post_thumbnail( $post_id ) ) {
      echo get_the_post_thumbnail( $post_id, array( 50, 50 ) );
    } else {
      _e( 'None' );
    }
  }
}
add_action( 'manage_posts_custom_column', 'display_manage_column', 10, 2 );

/**
 * コメント欄の停止（非表示）
 */
function add_comment_close( $open, $post_id ) {
 $post = get_post( $post_id );
 if ( $post && in_array( $post->post_type, array( 'page', 'post' ) ) ) {
   $open = false;
 }
 return $open;
}
add_filter( 'comments_open', 'add_comment_close', 10, 2 );

/**
 * サムネイル関連関数
 */
// サムネイル画像取得
function get_thumbnail_url( $size ) {
  global $post;

  if ( has_post_thumbnail() ) {
    $postthumb = wp_get_attachment_image_src( get_post_thumbnail_id(), $size );
    $url = $postthumb[0];
  } elseif( preg_match( '/wp-image-(\d+)/s', $post->post_content, $thumbid ) ) {
    $postthumb = wp_get_attachment_image_src( $thumbid[1], $size );
    $url = $postthumb[0];
  } else {
    $url = get_template_directory_uri() . '/img/no-image.png';
  }
  return $url;
}

// サムネイル付き最近の投稿一覧ウィジェット
get_template_part('inc/class-widget-recent-posts');
function register_recent_posts_widget() {
  register_widget( 'Widget_Recent_Posts' );
}
add_action( 'widgets_init', 'register_recent_posts_widget' );

// サムネイル付きおすすめ（ピックアップ）投稿一覧ウィジェット
register_nav_menu( 'pickupnav', __( 'Pickup Posts', 'codeaid' ) );
get_template_part('inc/class-widget-pickup-posts');
function register_pickup_posts_widget() {
  register_widget( 'Widget_Pickup_Posts' );
}
add_action( 'widgets_init', 'register_pickup_posts_widget' );

// トップ画面サムネイル付きトピック投稿一覧
register_nav_menu( 'topicnav', __( 'Topic Posts', 'codeaid' ) );

/**
 * プラグインの有効・無効確認
 */
function is_my_plugin_active( $plugin ) {
  if ( ! function_exists( 'is_plugin_active' ) ) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  }
  return is_plugin_active( $plugin );
}

/**
 * リストを表示するショートコード
 */
function set_taxlist($params = array()) {
  extract(shortcode_atts(array(
      'file' => 'taxlist', //表示に使用するPHPファイル
      'posttype' => 'post', // 投稿タイプ
      'tagname' => 0, //表示するタグ名
      'catname' => 0, //表示するカテゴリー名
      'list' => 0, //表示するリスト数
      ), $params));
  ob_start();
//  get_template_part(TEMPLATEPATH . "/$file.php");
//  include(TEMPLATEPATH . "/$file.php");
  include(get_theme_root() .'/'. get_template() . "/$file.php");
  return ob_get_clean();
}
add_shortcode('taxlist', 'set_taxlist');

/**
 * タクソノミーを表示するショートコード
 */
function set_showtax($params = array()) {
  extract(shortcode_atts(array(
          'type' => 'post_tag', //表示するタクソノミー(デフォルト分類：'category', 'post_tag')
          ), $params));

  $tax = '<div class="entry-tax"><ul>';
  $args = array( 'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => true,
          );
  $terms = get_terms( $type, $args );
  if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
    foreach ($terms as $term ) {
      $term_list = '<li>';
      $term_list .= '<a href="' . get_term_link( $term ) . '">';
      $term_list .= $term->name . '</a>';
      $term_list .= '</li>';
      $tax .= $term_list;
    }
  }
  $tax .= '</ul></div>';

  return $tax;
}
add_shortcode('showtax', 'set_showtax');

/**
 * カスタム投稿タイプ作成
 */
function create_post_type() {
	// ブログ記事用カスタム投稿タイプ
	$labels = array(
		'name' => _x( 'Blogs', 'post type general name', 'codeaid' ),
		'singular_name' => _x( 'Blog', 'post type singular name', 'codeaid' ),
		'menu_name' => _x( 'Blogs', 'admin menu', 'codeaid' ),
		'name_admin_bar' => _x( 'Blog', 'add new on admin bar', 'codeaid' ),
		'add_new' => _x( 'Add New', 'blog', 'codeaid' ),
		'add_new_item' => __( 'Add New Blog', 'codeaid' ),
		'new_item' => __( 'New Blog', 'codeaid' ),
		'edit_item' => __( 'Edit Blog', 'codeaid' ),
		'view_item' => __( 'View Blog', 'codeaid' ),
		'all_items' => __( 'All Blogs', 'codeaid' ),
		'search_items' => __( 'Search Blogs', 'codeaid' ),
		'parent_item_colon' => __( 'Parent Blogs:', 'codeaid' ),
		'not_found' => __( 'No blogs found.', 'codeaid' ),
		'not_found_in_trash' => __( 'No blogs found in Trash.', 'codeaid' )
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'menu_position' => 5,
		'rewrite' => array('slug' => 'blog'),
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ),
    'show_in_rest' => true,
	);

	register_post_type( 'ca_blog', $args );

	// ブログ記事用カスタム分類(Keyword)
	$labels = array(
		'name' => _x( 'Keywords', 'taxonomy general name', 'codeaid' ),
		'singular_name' => _x( 'Keyword', 'taxonomy singular name', 'codeaid' ),
		'search_items' => __( 'Search Keywords', 'codeaid' ),
		'all_items' => __( 'All Keywords', 'codeaid' ),
//		'parent_item' => __( 'Parent Keyword', 'codeaid' ),
//  	'parent_item_colon' => __( 'Parent Keyword:', 'codeaid' ),
		'edit_item' => __( 'Edit Keyword', 'codeaid' ),
		'update_item' => __( 'Update Keyword', 'codeaid' ),
		'add_new_item' => __( 'Add New Keyword', 'codeaid' ),
		'new_item_name' => __( 'New Keyword Name', 'codeaid' ),
		'menu_name' => __( 'Keyword', 'codeaid' ),
	);

	$args = array(
		'hierarchical' => false,
		'labels' => $labels,
	);

//	register_taxonomy( 'keyword', array( 'ca_blog' ), $args );
//	register_taxonomy_for_object_type( 'keyword', 'ca_blog' );
//	register_taxonomy_for_object_type( 'category', 'ca_blog' );
	register_taxonomy_for_object_type( 'post_tag', 'ca_blog' );

}
add_action( 'init', 'create_post_type' );

/**
 * クエリー設定のカスタマイズ
 */
function query_filter($query) {
  if ( is_admin() || ! $query->is_main_query() )
        return;

  if ( $query->is_search() || $query->is_archive() ) { // 検索結果もしくはアーカイブ表示
    $query->set( 'post_type', array( 'post', 'ca_blog' ) ); // 投稿記事とカスタム投稿を対象
    $query->set( 'category__not_in', array(1) ); // カテゴリが未分類の記事は非表示
    $query->set( 'orderby', 'date' ); // 名前順に表示
    $query->set( 'order', 'DESC' ); // 昇順で表示
    $query->set( 'posts_per_page', -1 ); // １ページに全て表示
  }

  return;
}
add_action('pre_get_posts','query_filter');

/**
 * アーカイブウィジェットのカスタマイズ
 */
function my_widget_archives_args( $args ){
  if ( ! is_admin() ) {
      $args['post_type'] = 'ca_blog'; // アーカイブウィジェットはカスタム投稿タイプのみ対象
  }
  return $args;
}
add_filter( 'widget_archives_dropdown_args', 'my_widget_archives_dropdown_args' );
add_filter( 'widget_archives_args', 'my_widget_archives_args' );

/**
 * セルフピンバックの無効化
 */
function no_self_ping( &$links ) {
  $home = get_option( 'home' );
  foreach ( $links as $l => $link )
    if ( 0 === strpos( $link, $home ) )
      unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_ping' );

/**
 * Link:のヘッダーレスポンスを削除
 */
remove_action('template_redirect','wp_shortlink_header', 11, 0);

/**
 * インナーブログカード作成
 */
//サイトドメインを取得
function get_this_site_domain(){
  //ドメイン情報を$results[1]に取得する
  preg_match( '/https?:\/\/(.+?)\//i', admin_url(), $results );
  return $results[1];
}

//本文抜粋を取得する関数（綺麗な抜粋文を作成するため）
//使用方法：http://nelog.jp/get_the_custom_excerpt
function get_the_custom_excerpt($content, $length) {
  $length = ($length ? $length : 70);//デフォルトの長さを指定する
  $content =  preg_replace('/<!--more-->.+/is',"",$content); //moreタグ以降削除
  $content =  strip_shortcodes($content);//ショートコード削除
  $content =  strip_tags($content);//タグの除去
  $content =  str_replace("&nbsp;","",$content);//特殊文字の削除（今回はスペースのみ）
  $content =  mb_substr($content,0,$length);//文字列を指定した長さで切り取る
  return $content;
}

//本文中のURLをブログカードタグに変更する
function url_to_blog_card($the_content) {
  if ( is_singular() ) {//投稿ページもしくは固定ページのとき
    //1行にURLのみが期待されている行（URL）を全て$mに取得
    $res = preg_match_all('/^(<p>)?(<a.+?>)?https?:\/\/'.preg_quote(get_this_site_domain()).'\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+(<\/a>)?(<\/p>)?(<br ? \/>)?$/im', $the_content,$m);
    //マッチしたURL一つ一つをループしてカードを作成
    foreach ($m[0] as $match) {
      $url = strip_tags($match);//URL
      $id = url_to_postid( $url );//IDを取得（URLから投稿ID変換）
      if ( !$id ) continue;//IDを取得できない場合はループを飛ばす
      $post = get_post($id);//IDから投稿情報の取得
      $title = $post->post_title;//タイトルの取得
      $date = mysql2date('Y-m-d H:i', $post->post_date);//投稿日の取得
      $excerpt = get_the_custom_excerpt($post->post_content, 90);//抜粋の取得
      $thumbnail = get_the_post_thumbnail($id, 'thumb100', array('style' => 'width:100px;height:100px;', 'class' => 'blog-card-thumb-image'));//サムネイルの取得（要100×100のサムネイル設定）
      if ( !$thumbnail ) {//サムネイルが存在しない場合
        $thumbnail = '<img src="'.get_template_directory_uri().'/images/no-image.png" style="width:100px;height:100px;" />';
      }
      //取得した情報からブログカードのHTMLタグを作成
      $tag = '<div class="blog-card"><div class="blog-card-thumbnail"><a href="'.$url.'" class="blog-card-thumbnail-link">'.$thumbnail.'</a></div><div class="blog-card-content"><div class="blog-card-title"><a href="'.$url.'" class="blog-card-title-link">'.$title.'</a></div><div class="blog-card-excerpt">'.$excerpt.'</div></div><div class="blog-card-footer clear"><span class="blog-card-date">'.$date.'</span></div></div>';
      //本文中のURLをブログカードタグで置換
      $the_content = preg_replace('{'.preg_quote($match).'}', $tag , $the_content, 1);
    }
  }
  return $the_content;//置換後のコンテンツを返す
}
add_filter('the_content','url_to_blog_card');//本文表示をフック
/**
 * インナーブログカード作成（ここまで）
 */

/**
 * 更新日時をコントロール
 * 投稿と固定ページの編集画面メインカラムにボックスを追加
 */
function add_update_custom_box() {
  /* 投稿・カスタム投稿編集画面にカスタムメタボックスを追加 */
  $screens = get_post_types();
  foreach( $screens as $screen ) {
    add_meta_box( 'update_mode', __('Update Mode', 'codeaid'), 'update_mode_custom_box', $screen, 'side', 'high' );
  }
}
add_action( 'admin_menu', 'add_update_custom_box' );

/**
 * ボックスのコンテンツをプリント
 *
 * @param WP_Post $post The object for the current post/page.
 */
function update_mode_custom_box( $post ) {
  // nonceフィールドを追加して後でチェックする
  wp_nonce_field( 'save_update_mode_custom_box_data', 'update_mode_custom_box_nonce' );

  /*
   * DBから既存のvalueを検索してフォームのvalueに使うためにget_post_meta()を使用する
   */
  $update_mode = get_post_meta( $post->ID, 'update_mode', true );
  $list = array( 'normal'=>'通常更新', 'postonly'=>'更新のみ', 'delete'=>'更新削除' );

  echo '<div style="padding-top: 3px; overflow: hidden;">';
  foreach( $list as $_id=>$_name ) {
    echo  '<div style="width: 100px; float: left;">';
    echo    '<label>';
    if ( $_id == $update_mode || (empty($update_mode) && ($_id == 'normal')) ) {
      echo  '<input type="radio" name="update_mode" value="'.$_id.'" checked="checked">';
    } else {
      echo  '<input type="radio" name="update_mode" value="'.$_id.'">';
    }
    echo    $_name;
    echo    '</label> ';
    echo  '</div>';
  }
//  echo  '<input type="hidden" id="last_modified" name="last_modified_hidden" value="';
//  echo  get_the_modified_time( 'Y-m-d H:i:s' ); // 最後に更新した日時を設定
//  echo  '">';
  echo '</div>';

  if( empty(get_post_meta( $post->ID, 'last_modified', true )) ) {
    add_post_meta( $post->ID, 'last_modified', get_the_modified_time( 'Y-m-d H:i:s' ), true );
  } else {
    update_post_meta( $post->ID, 'last_modified', get_the_modified_time( 'Y-m-d H:i:s' ) );
  }
}

/**
 * 投稿が保存されたとき、カスタムデータも保存する
 *
 * @param int $post_id The ID of the post being saved.
 */
function save_update_mode_custom_box_data( $post_id ) {
  /*
   * save_postアクションは他の時にも起動する場合があるので、
   * 先ほど作った編集フォームのから適切な認証とともに送られてきたデータかどうかを検証する必要がある。
   */

  // nonceがセットされているかどうか確認
  if ( ! isset( $_POST['update_mode_custom_box_nonce'] ) ) {
  	return;
  }

  // nonceが正しいかどうか検証
  if ( ! wp_verify_nonce( $_POST['update_mode_custom_box_nonce'], 'save_update_mode_custom_box_data' ) ) {
  	return;
  }

  // 自動保存の場合はなにもしない
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
  	return;
  }

  // ユーザー権限の確認
  if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
  	if ( ! current_user_can( 'edit_page', $post_id ) ) {
  		return;
  	}
  } else {
  	if ( ! current_user_can( 'edit_post', $post_id ) ) {
  		return;
  	}
  }

  /* 安全が確認できたのでデータを保存する */

  // データがセットされているか確認する
  if ( ! isset( $_POST['update_mode'] ) ) {
  	return;
  }

  // ユーザーの入力を無害化する
  $mydata = sanitize_text_field( $_POST['update_mode'] );

  if( empty(get_post_meta( $post_id, 'update_mode', true )) ) {
    add_post_meta( $post_id, 'update_mode', $mydata, true ); // update_modeがなければカスタムフィールド作成
  } elseif( $mydata != get_post_meta( $post_id, 'update_mode' )) {
    update_post_meta( $post_id, 'update_mode', $mydata ); // update_modeと入力した値が違う場合はカスタムフィールド更新
  } elseif( "" == $mydata ) {
    delete_post_meta( $post_id, 'update_mode' ); // 入力したデータがなければカスタムフィールド削除
  }
}
add_action( 'save_post', 'save_update_mode_custom_box_data' );

/* 「更新」以外は更新日時を変更しない */
function my_insert_post_data( $data, $postarr ){

  if( isset($_POST['update_mode']) && $_POST['update_mode'] == 'postonly' ) {
    $last_modified = get_post_meta( $postarr['ID'], 'last_modified', true );
    if ( isset($last_modified) ) {
      $data['post_modified'] = $last_modified;
      $data['post_modified_gmt'] = get_gmt_from_date( $last_modified );
    }
  } elseif( isset($_POST['update_mode']) && $_POST['update_mode'] == 'delete' ) {
    $data['post_modified'] = $data['post_date'];
    $data['post_modified_gmt'] = get_gmt_from_date( $data['post_date'] );
  }
  if (isset($_POST['update_mode'])) {
  }
  return $data;
}
add_filter( 'wp_insert_post_data', 'my_insert_post_data', 99, 2 );
