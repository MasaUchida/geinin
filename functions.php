<?php
/**
 * original functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package original
 */

if ( ! function_exists( 'original_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function original_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on original, use a find and replace
		 * to change 'original' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'original', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'original' ),
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
		add_theme_support( 'custom-background', apply_filters( 'original_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'original_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function original_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'original_content_width', 640 );
}
add_action( 'after_setup_theme', 'original_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function original_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'original' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'original' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'original_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function original_scripts() {
	wp_enqueue_style( 'original-style', get_stylesheet_uri() );

	wp_enqueue_script( 'original-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'original-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'original_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/*------------------------------------*\
	カスタム投稿タイプ
\*------------------------------------*/
add_theme_support('post-thumbnails');
function create_post_type() {
  $geinin = [
    'title',
    'editor',
    'thumbnail',
    'excerpt'
  ];
  // add post type
  register_post_type( 'geinin',
    array(
      'labels' => array(
		'menu_name' => '芸人一覧',
		'add_new_item'  => '新規芸人登録', //新規作成ページのヘッダに表示されるテキスト
		'add_new'       => '新規芸人登録', //メニューの新規追加のラベル
		'edit_item'     => '編集', //編集ページのタイトルに表示される名前
        'view_item'     => '編集', //編集ページの「投稿を表示」ボタンのラベル
        'search_items'  => '芸人名の検索', //一覧ページの検索ボタンのラベル
        'not_found'     => '見つかりません。', //一覧ページに投稿が見つからなかったときに表示
        'not_found_in_trash' => 'ゴミ箱にはありません。' //ゴミ箱に何も入っていないときに表示
	  ),
      'description' => '芸人を登録してください',
      'public' => true,
      'has_archive' => true,
      'menu_position' => 5,
      'supports' => $geinin,
      'show_tagcloud' => true,
      'menu_icon' => 'dashicons-admin-users',
    )
  );
  // add taxonomy
  register_taxonomy(
    'geinin_type',
    'geinin',
    array(
      'label' => '芸人のカテゴリー',
      'labels' => array(
        'all_items' => '芸人のカテゴリー一覧',
        'add_new_item' => '新しい芸人のカテゴリー'
      ),
      'hierarchical' => true,
      'supports' => array( 'thumbnail' )
    )
  );
  register_taxonomy(
    'geinin_tag',
    'geinin',
    array(
      'hierarchical' => false,
      'update_count_callback' => '_update_post_term_count',
      'label' => '芸人のタグ', 
      'public' => true,
      'show_ui' => true
    )
  );
}
add_action( 'init', 'create_post_type' );

add_filter( 'nav_menu_css_class', 'my_css_attributes_filter', 100, 1 );
add_filter( 'nav_menu_item_id', 'my_css_attributes_filter', 100, 1 );
add_filter( 'page_css_class', 'my_css_attributes_filter', 100, 1 );
function my_css_attributes_filter( $var ) {
  return is_array($var) ? array_intersect($var, array( 'nav-global' )) : '';
}