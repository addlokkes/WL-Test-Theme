<?php
/**
 * WL Test Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WL_Test_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wl_test_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on WL Test Theme, use a find and replace
		* to change 'wl-test-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'wl-test-theme', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'wl-test-theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'wl_test_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'wl_test_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wl_test_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wl_test_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'wl_test_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wl_test_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wl-test-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wl-test-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wl_test_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wl_test_theme_scripts() {
	wp_enqueue_style( 'wl-test-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'wl-test-theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'wl-test-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wl_test_theme_scripts' );

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




/***************WL Test Theme*****************/

function create_posttype_cars() {
    register_post_type( 'cars',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Cars' ),
                'singular_name' => __( 'Car' ),
				'add_new' => 'Add new car'
            ),
            'public' => true,
            'has_archive' => true,
            'menu_position' => 5,
            'supports' => array('title', 'editor', 'thumbnail', 'color', 'comments'),
        )
    );

		register_taxonomy( 
			'model',
			'cars',
			array(
				'label' => __('Model'),
				'rewrite' => array( 'slug' => 'model'),
				'hierarchical' => true
			)
		);

		register_taxonomy( 
			'color',
			'cars',
			array(
				'label' => __('Color'),
				'hierarchical' => true,
				'show_ui' => true
			)
		);

			register_taxonomy( 
			'fuel',
			'cars',
			array(
				'label' => __('Fuel'),
				'rewrite' => array( 'slug' => 'fuel'),
				'hierarchical' => true
			) 
		);

			register_taxonomy( 
			'power',
			'cars',
			array(
				'label' => __('Power'),
				'rewrite' => array( 'slug' => 'power'),
				'hierarchical' => true
			)
		);

			register_taxonomy( 
			'price',
			'cars',
			array(
				'label' => __('Price'),
				'rewrite' => array( 'slug' => 'price'),
				'hierarchical' => true
			)
		);
}

function colorpicker_field_add_new_category($taxonomy) {
	?><div class="form-field term-colorpicker-wrap">
		<label for="term-colorpicker">Color swatch</label>
		<input name="_category_color" value="#ffffff" class="colorpicker" id="term-colorpicker" />
	</div><?php
	}
	
	add_action('category_add_form_fields', 'colorpicker_field_add_new_category',10,2);
	
	function colorpicker_field_edit_category($term) {
		$color= get_option('taxonomy_category_color_'.$term->term_id, true);
		if(empty($color)){ $color='#ffffff'; }
	
	?>
	<tr class="form-field term-colorpicker-wrap">
		<th scope="row">
			<label for="term-colorpicker">Color swatch</label>
		</th>
		<td>
			<input name="_category_color" value="<?php echo $color; ?>" class="colorpicker" id="term-colorpicker" />
		</td>
	</tr> <?php
	}
	
	add_action('category_edit_form_fields', 'colorpicker_field_edit_category',10,2);
	
	function save_termmeta($term_id) {
		if (isset($_POST['_category_color'])) {
			update_option("taxonomy_category_color_".$term_id, $_POST['_category_color'] );
		}
	}
	add_action( 'edited_category', 'save_termmeta', 10, 2 );
	
	add_action('created_category', 'save_termmeta', 10, 2);
	
	function category_colorpicker_enqueue($taxonomy) {
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_style('wp-color-picker');
	}
	
	add_action('admin_enqueue_scripts', 'category_colorpicker_enqueue',10,2);
	
	function colorpicker_init_inline() {
		if (null !== ( $screen = get_current_screen() ) && 'edit-category' !== $screen->id) {
			return;
		}
		?><script>jQuery(document).ready(function ($) {
		$('.colorpicker').wpColorPicker();
		});</script><?php
	}

add_shortcode('phone', 'show_phone' );
function show_phone() {
	return '+38 099 123 45 67';
}

add_action('admin_print_scripts', 'colorpicker_init_inline', 999);
add_action( 'init', 'create_posttype_cars' );