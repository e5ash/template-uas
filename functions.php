<?php
/**
 * name functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package name
 */

if ( ! function_exists( 'name_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function name_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on name, use a find and replace
		 * to change 'name' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'name', get_template_directory() . '/languages' );

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
			'menu-main' => esc_html__( 'Главное меню', 'name' ),
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
		add_theme_support( 'custom-background', apply_filters( 'name_custom_background_args', array(
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
add_action( 'after_setup_theme', 'name_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function name_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'name_content_width', 640 );
}
add_action( 'after_setup_theme', 'name_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function name_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'name' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'name' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'name_widgets_init' );

// Поддержка Open Graph в WordPress
 
function add_opengraph_doctype( $output ) {
  return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');
 

add_action( 'wp_head', 'insert_fb_in_head', 5 );





/**
 * Enqueue scripts and styles.
 */
function name_scripts() {
	wp_enqueue_style( 'name-style', get_stylesheet_uri() );

	wp_enqueue_script( 'name-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'name-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'jquery-cookie', get_template_directory_uri() . '/js/jquery.cookie.js', array('jquery'), '', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'name_scripts' );

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


if( function_exists('acf_add_options_page') ) {
 
	$option_page = acf_add_options_page(array(
		'page_title' 	=> 'Настройки сайта',
		'menu_title' 	=> 'Настройки сайта',
		'menu_slug' 	=> 'theme-general-settings',
		'capability' 	=> 'edit_posts',
		'redirect' 	=> false
	));
 
}


function cptui_register_my_cpts() {

	/**
	 * Post Type: Слайдер.
	 */

	$labels = array(
		"name" => __( "Слайдер", "" ),
		"singular_name" => __( "Слайдер", "" ),
	);

	$args = array(
		"label" => __( "Слайдер", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "slaider", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "slaider", $args );

	/**
	 * Post Type: Программа.
	 */

	$labels = array(
		"name" => __( "Программа", "" ),
		"singular_name" => __( "Программа", "" ),
	);

	$args = array(
		"label" => __( "Программа", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "programma", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "programma", $args );

	/**
	 * Post Type: Отзывы.
	 */

	$labels = array(
		"name" => __( "Отзывы", "" ),
		"singular_name" => __( "Отзывы", "" ),
	);

	$args = array(
		"label" => __( "Отзывы", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "otzivi", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "otzivi", $args );

	/**
	 * Post Type: Команда.
	 */

	$labels = array(
		"name" => __( "Команда", "" ),
		"singular_name" => __( "Команда", "" ),
	);

	$args = array(
		"label" => __( "Команда", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "komanda", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "komanda", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );


add_action( 'wp_footer', 'mycustom_wp_footer' );


function send_amo( $form ) {
	global $subdomain;
	$subdomain='itinero';
  #Массив с параметрами, которые нужно передать методом POST к API системы
	$user_info=array(
    'USER_LOGIN'=>'info@itinero.travel', #Ваш логин (электронная почта)
    'USER_HASH'=>'bdfe66f18d7a154068e0079e731d9dd8' #Хэш для доступа к API (смотрите в профиле пользователя)
    );	
	require_once('amo_class.php');
	$amo=new AMO('info@itinero.travel','ec167c3e4c907f8642bb1718d838f6ae','itinero');
	

	
	$form = WPCF7_Submission::get_instance();
	if ( $form ) {
		$formData = $form->get_posted_data();
	}



	$SUBJECT="Сделка с сайта usa.itinero.travel"; // Название сделки в АМО

	//file_put_contents('test', print_r($formData,true));
	$LEAD_STATUS='16703638'; // Id Статуса "Заявка"
	$LEAD_PIPELINE='808903';
	$CONTACT_PHONE_ID=$acc['custom_fields']['contacts'][1]['id'];
	$CONTACT_EMAIL_ID=$acc['custom_fields']['contacts'][2]['id'];
	$utm_source=isset( $_COOKIE['utm_source'] ) ? $_COOKIE['utm_source'] : 'не определен';
	$utm_medium=isset( $_COOKIE['utm_medium'] ) ? $_COOKIE['utm_medium'] : 'не определен';
	$utm_campaign=isset( $_COOKIE['utm_campaign'] ) ? $_COOKIE['utm_campaign'] : 'не определен';
	$utm_term=isset( $_COOKIE['utm_term'] ) ? $_COOKIE['utm_term'] : 'не определен';
	$CONTACT_NAME="Не указано";
	$mail='';
	if(isset($formData['text-name'])){$CONTACT_NAME=$formData['text-name'];}
	if(isset($formData['name667'])){$CONTACT_NAME=$formData['name667'];} 
	if(isset($formData['text-email'])){$mail=$formData['text-email'];}
	if(isset($formData['email667'])){$mail=$formData['email667'];} 
	$phone='';
	if(isset($formData['text-phone'])){$phone=$formData['text-phone'];} 
	if(isset($formData['tel'])){$phone=$formData['tel'];} 
	if(isset($formData['phone667'])){$phone=$formData['phone667'];}
		$custom=array();
	if(isset($formData['textarea'])){$custom=array('id'=>467305,'values'=>array(array('value'=>$formData['textarea'])));}
	$lead=array('name'=>$SUBJECT,
		'status_id'=>$LEAD_STATUS,
		'pipeline_id'=>$LEAD_PIPELINE,
		'price'=>0,
		//'responsible_user_id'=>$LEAD_ACCOUNT,
		'custom_fields'=> array($custom),

		);

	$AMOAnswerLead = $amo->add_lead($lead);
	$c=$amo->add_contact_info($CONTACT_NAME,$phone,$mail, $AMOAnswerLead, $utm_source);
	//file_put_contents('test', print_r($c,true));



	return 1;
	

}
function filter_wpcf7_mail_components( $components, $wpcf7_get_current_contact_form, $instance ) {
//    // make filter magic happen here...
//   // file_put_contents("test", $components['body']);
	$utm_source=isset($_COOKIE['utm_source'])?$_COOKIE['utm_source']:'';
	$utm_medium=isset($_COOKIE['utm_medium'])?$_COOKIE['utm_medium']:'';
	$utm_campaign=isset($_COOKIE['utm_campaign'])?$_COOKIE['utm_campaign']:'';
	$utm_content=isset($_COOKIE['utm_content'])?$_COOKIE['utm_content']:'';
	$utm_term=isset($_COOKIE['utm_term'])?$_COOKIE['utm_term']:'';
	$text="Откуда: $utm_source (utm_source)\n
//	Тип площадки: $utm_source (utm_source)\n
//	Площадка: $utm_medium (utm_medium)\n
//	Компания:$utm_campaign (utm_campaign)\n
//	Ключевое слово:  $utm_term (utm_term)\n
//	Доп информация:	$utm_content (utm_content)--\n\n";
	$components['body']="Заявка с лендинга canada.ITINERO.TRAVEL\n".$components['body'];
	$components['body']=str_replace("--", $text, $components['body']);
	//file_put_contents("test", $components['body']);

	return $components;
}
//
//// add the filter
add_filter( 'wpcf7_mail_components', 'filter_wpcf7_mail_components', 10, 3 );

add_action( 'wpcf7_before_send_mail', 'send_amo' );

function mycustom_wp_footer() {
?>
<script type="text/javascript">
document.addEventListener( 'wpcf7mailsent', function( event ) {
		if ( '157' == event.detail.contactFormId ) {
			$.fancybox.close();
    	$.fancybox.open({src  : '#popup-thanks-2',type : 'inline'});
    	setTimeout(function() {
				$.fancybox.close();
			}, 1500);
  	} else if ( '342' == event.detail.contactFormId ){
  		window.location.href = "http://itinero.travel/wp-content/uploads/2017/04/%D0%9F%D0%B5%D1%80%D1%83_%D0%98%D1%82%D0%B8%D0%A0%D0%B0%D0%B9%D0%BC%D0%B82018_%D0%98%D1%82%D0%B8%D0%BD%D0%B5%D1%80%D0%BE.pdf";
  		// window.open("http://freelance.e5ash.com/wp-content/uploads/2018/03/Mayskie-Gavayskie-2018_Itinero.pdf").focus();
  		$.fancybox.close();
  		setTimeout(function() {
				$.fancybox.close();
			}, 1500);
  	}
  	else{
  		$.fancybox.close();
  		$.fancybox.open({src  : '#popup-thanks',type : 'inline'});
  		setTimeout(function() {
				$.fancybox.close();
			}, 1500);
  	}
}, false );
</script>
<?php
}