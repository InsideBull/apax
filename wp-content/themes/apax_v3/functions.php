<?php

ini_set("display_errors",0);

$IS_EXPORT = 0;

add_filter('jpeg_quality', function($arg){return 100;});
add_theme_support('post-thumbnails');

function my_loginlogo(){echo '<style type="text/css">@import url(https://fonts.googleapis.com/css?family=Oswald:300);body{background:#f8fafa;font-family:Oswald,sans-serif}.login h1 a{background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALcAAAA2CAYAAACFggjiAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIFdpbmRvd3MiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RkYzMzdBNzk3QTI2MTFFNUIxRjZGQ0E3OEFBN0E2Q0UiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RkYzMzdBN0E3QTI2MTFFNUIxRjZGQ0E3OEFBN0E2Q0UiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpGRjMzN0E3NzdBMjYxMUU1QjFGNkZDQTc4QUE3QTZDRSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpGRjMzN0E3ODdBMjYxMUU1QjFGNkZDQTc4QUE3QTZDRSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PhyXdawAAAqkSURBVHja7FwLcFTV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);width:183px;height:54px;background-size:183px 54px}.login label{color:#454545;display:block;margin-bottom:1em}.login form .input,.login input[type=text]{font-weight:400;font-size:20px;padding:2px 8px 3px}.login #login_error,.login .message{border-color:#e42313}input[type=checkbox]:focus,input[type=color]:focus,input[type=date]:focus,input[type=datetime-local]:focus,input[type=datetime]:focus,input[type=email]:focus,input[type=month]:focus,input[type=number]:focus,input[type=password]:focus,input[type=radio]:focus,input[type=search]:focus,input[type=tel]:focus,input[type=text]:focus,input[type=time]:focus,input[type=url]:focus,input[type=week]:focus,select:focus,textarea:focus{border-color:#e42313;-webkit-box-shadow:0 0 2px rgba(228,35,19,.8);box-shadow:0 0 2px rgba(228,35,19,.8)}.login #backtoblog a:hover,.login #nav a:hover,.login h1 a:hover,input[type=checkbox]:checked:before{color:#e42313}.login label{text-shadow:0 0 0;font-weight:300}.wp-core-ui .button-primary{background:#e42313;-webkit-box-shadow:none;box-shadow:none;border:1px solid #e42313;text-shadow:0 0 0;line-height:27px!important}.wp-core-ui .button-primary:hover{border:1px solid #e42313;background:#fff;color:#e42313}::selection{background:#e42313;color:#fff;}::-moz-selection{background:#e42313;color:#fff;}.wp-core-ui .button-primary.active, .wp-core-ui .button-primary.active:focus, .wp-core-ui .button-primary.active:hover, .wp-core-ui .button-primary:active{background:#e42313;border-color:#e42313;-webkit-box-shadow:0 0 0;box-shadow:0 0 0;color:#fff;}.wp-core-ui .button-primary.focus, .wp-core-ui .button-primary.hover, .wp-core-ui .button-primary:focus, .wp-core-ui .button-primary:hover {border-color:#e42313;-webkit-box-shadow:0 0 0;background:#e42313;color:#fff;box-shadow:0 0 0;}</style>';}add_action('login_head', 'my_loginlogo');function my_loginURL() {return 'http://www.adaka.fr';}add_filter('login_headerurl', 'my_loginURL');function my_loginURLtext(){return 'ADaKa - Agence de design interactif';}add_filter('login_headertitle', 'my_loginURLtext');function my_logincustomCSSfile(){wp_enqueue_style('login-styles', get_template_directory_uri() . '/login/login_styles.css');}add_action('login_enqueue_scripts', 'my_logincustomCSSfile');

define('URL_BLOG', 'http://apax-talks.fr/');
define('WP_API_BLOG_ARTICLE', 'wp-json/wp/v2/articles-api/');
define('URL_WP_API_BLOG_ARTICLE', URL_BLOG.WP_API_BLOG_ARTICLE);
define('BITLY_LOGIN', 'adaka01');
define('BITLY_APIKEY', 'R_d629315cd32e429d9e54c4162ffc7abf');

include "custom_search_acf.php";
include "cpt.php";
// include "custom-search-acf-wordpress.php";

function var_dump_pre($txt){
	echo "<pre>";
	var_dump($txt);
	echo "</pre>";
}

add_filter( 'wp_title', 'filter_wp_title' );
function filter_wp_title( $title ) {
	global $post;

	$seo = get_post_meta($post->ID, '_yoast_wpseo_title', true);
	if ($seo!="")
		echo __($seo);
	else{
		if (is_home())
			$filtered_title = get_bloginfo( 'name' );
		else if (is_page())
			$filtered_title = str_replace("<br/>"," ",$post->post_title);
		else
			$filtered_title = $title;

		echo $filtered_title;
	}
}

add_image_size( 'bloc-3-home', 680, 817, true);
add_image_size( 'bloc-2-image', 680, 0);
add_image_size( 'bloc_mise_avant_image', 191, 191, true);
add_image_size( 'bloc_image_texte', 198, 0);
add_image_size( 'bloc_image_full', 653, 0);
add_image_size( 'home-secteur-spe', 680, 436, true);
add_image_size( 'image-push', 680, 411, true);
add_image_size( 'image-push-full', 680, 897, true);
add_image_size( 'logo-societe', 282, 111);
add_image_size( 'chiffre-cle-societe', 184, 0, true);
add_image_size( 'contact-membre', 315, 191, true);

if (get_current_user_id() != 1) {
	add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );
	remove_action( 'load-update-core.php', 'wp_update_themes' );
	add_filter( 'pre_site_transient_update_themes', create_function( '$a', "return null;" ) );
	remove_action( 'load-update-core.php', 'wp_update_plugins' );
	add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );
	define('DISALLOW_FILE_EDIT', true);
	define( 'DISALLOW_FILE_MODS', true );
}

function get_the_id_wpml($id=false){
	if (!$id) $id = get_the_ID();
	return icl_object_id( $id, get_post_type( $id ), true);
}

function my_mce_external_plugins($plugins) {
    $plugins['anchor'] = get_template_directory_uri() . '/js/tinymce/plugins/anchor/plugin.min.js';
    return $plugins;
}
add_filter('mce_external_plugins', 'my_mce_external_plugins');

if(get_current_user_id() != 1) {
	function tinymce_editor_buttons_second_row($buttons) {
	   //return an empty array to remove this line
		return array();
	}
	add_filter("mce_buttons_2", "tinymce_editor_buttons_second_row", 99);
	function tinymce_editor_buttons($buttons) {
		return array(
				"bold",
				"italic",
				"bullist",
				"numlist",
				"hr",
				"alignleft",
				"alignright",
				"link",
				"unlink",
				"formatselect",
				"styleselect",
				"pastetext",
				"removeformat",
				"charmap",
				"outdent",
				"indent",
				"undo",
				"redo",
				"table",
				"help",
				"dfw",
				"anchor",
				);
		}
	add_filter("mce_buttons", "tinymce_editor_buttons", 99);
} else {
	function tinymce_editor_buttons_admin($buttons) {
		array_push($buttons,"anchor");
		return $buttons;
	}
	add_filter("mce_buttons", "tinymce_editor_buttons_admin", 99);
}

add_theme_support( 'post-thumbnails', array( 'societe', 'team', 'blog' ) );

add_action( 'after_setup_theme', 'juiz_init_editor_styles' );
if ( !function_exists('juiz_init_editor_styles')) {
	function juiz_init_editor_styles() {
		add_editor_style();
	}
}

add_filter( 'mce_buttons_2', 'juiz_mce_buttons_2' );

if ( !function_exists('juiz_mce_buttons_2')) {
    function juiz_mce_buttons_2( $buttons ) {
        array_unshift( $buttons, 'styleselect' );

        return $buttons;
    }
}
add_filter( 'tiny_mce_before_init', 'juiz_mce_before_init' );

if ( !function_exists('juiz_mce_before_init')) {
    function juiz_mce_before_init( $styles ) {
        // on créé un tableau contenant nos styles
        $style_formats = array (
            // Style "Exergue box"
			array(
                'title' => __('Texte bleu Open Sans'),
                'inline' => 'span',
                'classes' => 'blue_text_opensans'
            ),
			array(
                'title' => __('Mini texte bleu Open Sans'),
                'inline' => 'span',
                'classes' => 'mini_blue_text_opensans'
            ),
			array(
                'title' => __('Titre centré souligné'),
                'selector' => 'h2',
                'classes' => 'center_underline'
            )
        );

        // on remplace les styles existants par les nôtres
        $styles['style_formats'] = json_encode( $style_formats );

        return $styles;
    }
}

function remove_menus() {
	if(get_current_user_id() != 1) {
		$remove = array(
			25 => "commentaires",
			65 => "Extensions",
			70 => "Utilisateurs",
			75 => "Outils",
			80 => "Règlages",
			100 => "CPT UI",
			101 => "WPML"
		);
		global $menu;
		global $submenu;

		if(isset($submenu["edit.php?post_type=societe"])) {
			if(isset($submenu["edit.php?post_type=societe"][15]))
				unset($submenu["edit.php?post_type=societe"][15]);
		}
		// if(isset($submenu["edit.php?post_type=team"])) {
			// if(isset($submenu["edit.php?post_type=team"][15]))
				// unset($submenu["edit.php?post_type=team"][15]);
		// }
		if(isset($submenu['themes.php'])) {
			if(isset($submenu['themes.php'][5]))
				unset($submenu['themes.php'][5]);
			if(isset($submenu['themes.php'][6]))
				unset($submenu['themes.php'][6]);
		}
		if(isset($submenu['wpseo_dashboard'])) {
			if(isset($submenu['wpseo_dashboard'][0]))
				unset($submenu['wpseo_dashboard'][0]);
			if(isset($submenu['wpseo_dashboard'][1]))
				unset($submenu['wpseo_dashboard'][1]);
			if(isset($submenu['wpseo_dashboard'][3]))
				unset($submenu['wpseo_dashboard'][3]);
			if(isset($submenu['wpseo_dashboard'][4]))
				unset($submenu['wpseo_dashboard'][4]);
			if(isset($submenu['wpseo_dashboard'][5]))
				unset($submenu['wpseo_dashboard'][5]);
			if(isset($submenu['wpseo_dashboard'][6]))
				unset($submenu['wpseo_dashboard'][6]);
			if(isset($submenu['wpseo_dashboard'][7]))
				unset($submenu['wpseo_dashboard'][7]);
		}
		if(isset($submenu['edit.php'])) {
			if(isset($submenu['edit.php'][15]))
				unset($submenu['edit.php'][15]);
			if(isset($submenu['edit.php'][16]))
				unset($submenu['edit.php'][16]);
		}
		if(isset($submenu['index.php'])) {
			if(isset($submenu['index.php'][10]))
				unset($submenu['index.php'][10]);
		}
		foreach($remove as $k => $v) {
			if(isset($menu[$k]))
				unset($menu[$k]);
		}
	}
}
function hide_menu_items() {

	echo '<style>#icl_menu_translation_of { margin-left: 0!important; }</style>';

	if(get_current_user_id() != 1) {
		echo '<style type="text/css">
		#toplevel_page_cpt_main_menu ,
		#toplevel_page_edit-post_type-acf,
		#menu-settings, #aam-acceess-control,
		#menu-plugins,
		#toplevel_page_sitepress-multilingual-cms-menu-languages > ul > li,
		.themes-php .wrap .add-new-h2,
		#wp-filter-search-input,
		.nav-menus-php #nav-menu-meta #side-sortables li#add-post,
		.nav-menus-php #nav-menu-meta #side-sortables li#add-category,
		.mce-container-body.mce-stack-layout > *:nth-child(n+6), #category-adder,
		#categorychecklist #category-1, #nav-menu-header .icl_nav_menu_text > div
		{ display: none!important; }
		#toplevel_page_sitepress-multilingual-cms-menu-languages > ul > li:nth-child(3)
		{ display: block!important;}
  </style>
  <script type="text/javascript">
		jQuery(document).ready(function($){
			$("#menu_order").parent().hide().prev().hide();
		});
	</script>';

		$screen = get_current_screen();
		$screen->remove_help_tabs();

	}
}

function remove_wp_logo( $wp_admin_bar ) {
	if(get_current_user_id() != 1) {
		$wp_admin_bar->remove_node( 'wp-logo' );
		$wp_admin_bar->remove_node( 'comments' );
		$wp_admin_bar->remove_node( 'new-content' );
		$wp_admin_bar->remove_node( 'wpseo-menu' );
		$wp_admin_bar->remove_node( 'customize' );
	}
}
add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );
add_action('admin_head', 'hide_menu_items', 999);
add_action( 'admin_menu', 'remove_menus' );
if(get_current_user_id() != 1) {
	add_filter('screen_options_show_screen', '__return_false');
	add_filter('acf/settings/show_admin', '__return_false');
}

if(get_current_user_id() == 3) {
	add_action('admin_head', 'hide_dashboard_glance_items', 999);
	function hide_dashboard_glance_items() {
		echo '<style type="text/css">#dashboard_right_now li.post-count,
		#dashboard_right_now li.page-count, #dashboard_right_now li.comment-count, #dashboard_right_now li.comment-mod-count { display: none!important }
		#glance_blog_num:before {
			content: "\f491"!important;
		}
		</style>';
	}
	add_filter('dashboard_glance_items','add_to_glance');
	function add_to_glance( Array $items )
	{
		$num_posts = wp_count_posts( "blog" );
		$items[] = '<a id="glance_blog_num" href="edit.php?post_type=blog">'.$num_posts->publish.' billets</a>';
		return $items;
	}
}


add_action('admin_menu', 'my_remove_sub_menus');
function my_remove_sub_menus() {
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
	remove_meta_box( 'categorydiv','post','normal' );
	remove_meta_box( 'tagsdiv-post_tag','post','normal' );
}

remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action( 'wp_head', array( $sitepress, 'meta_generator_tag', 20 ) );

function my_scripts_method() {

	$paramScript = array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('ajax-nonce'),
		'isHome' => is_front_page(),
		'id' => get_the_ID()
	);

	wp_deregister_script('jquery');
	wp_deregister_script('wp-embed');
	wp_enqueue_style('open-sans' );
	wp_enqueue_style('sansa', get_template_directory_uri() . '/css/sansa.css' );
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style('bootstrap-theme', get_template_directory_uri() . '/css/bootstrap-theme.min.css' );
	wp_enqueue_style('adakaListMultiple', get_template_directory_uri() . '/css/adakaListMultiple.css' );
	wp_enqueue_style('default', get_stylesheet_uri().'?v=1.2' );
	wp_enqueue_style('print', get_template_directory_uri() . '/css/style_print.css', array(), null, 'print' );
	wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery-1.12.2.min.js');
	wp_enqueue_script('cycle2', get_template_directory_uri() . '/js/jquery.cycle2.min.js');
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js');
	wp_enqueue_script('scrollTo', get_template_directory_uri() . '/js/jquery.scrollTo.min.js');
	wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js');
	wp_enqueue_script('adakaListMultiple', get_template_directory_uri() . '/js/jquery.adakaListMultiple.js');
	wp_enqueue_script('animateNumber', get_template_directory_uri() . '/js/jquery.animateNumber.min.js');
	if (is_home()) {
		wp_enqueue_script( 'home', get_template_directory_uri() . '/js/home.js');
		$paramScript["actuoffset"] = 10;
		$paramScript["actuperpage"] = 10;
		$paramScript["actuyear"] = isset($_GET["year"]) && $_GET["year"] != "" ? $_GET["year"] : false;
	}
	if (get_page_template_slug() == "template-list-societe.php" || get_page_template_slug() == "template-list-equipe.php") wp_enqueue_script( 'template-filter-cat-isotope', get_template_directory_uri() . '/js/template-filter-cat-isotope.js');
	if (get_page_template_slug() == "template-historique.php") wp_enqueue_script( 'template-filter-cat-accordeon', get_template_directory_uri() . '/js/template-filter-cat-accordeon.js');
	if (get_page_template_slug() == "template-contact.php") {
		wp_enqueue_script( 'google-maps', 'http://maps.google.com/maps/api/js?key=AIzaSyDj-7d61BVl3YEwIhaYupYfehNJnlMrFq0');
		wp_enqueue_style( 'gm-place-card', get_template_directory_uri() . '/css/gm-place-card.css' );
		wp_enqueue_script( 'template-contact', get_template_directory_uri() . '/js/template-contact.js');
		$contactScript = array(
			'marker' => get_bloginfo("template_url").'/img/marker-apax-partners.png',
			'title' => __("Apax Partners","apax"),
			'txt_enlarge' => __("View larger map","apax"),
			'txt_direction' => __("Itineraries","apax"),
		);
		wp_localize_script('template-contact', 'oJsonContact', $contactScript);
	}
	wp_enqueue_script('script', get_template_directory_uri().'/js/script.js', array('jquery'), '1.0', 1 );
	wp_localize_script('script', 'oJson', $paramScript);

}
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );


function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}

if (!is_admin()) add_action( 'init', 'disable_wp_emojicons' );

register_nav_menus( array(
	'menu_principal' => 'Menu principal',
	'footer_col1' => 'Footer colonne 1',
	'footer_col2' => 'Footer colonne 2',
	'footer_col3' => 'Footer colonne 3',
	'footer_col4' => 'Footer colonne 4',
) );

// add_action( 'load-post.php', 'wpse8170_media_popup_init' );
// add_action( 'load-post-new.php', 'wpse8170_media_popup_init' );
// function wpse8170_media_popup_init() {
    // wp_enqueue_script( 'wpse8170-media-manager', get_bloginfo("template_url").'/js/media.js', array( 'media-editor' ) );
// }

function get_current_page_depth(){
	global $wp_query;

	$object = $wp_query->get_queried_object();
	$parent_id  = $object->post_parent;
	$depth = 0;
	while($parent_id > 0){
		$page = get_page($parent_id);
		$parent_id = $page->post_parent;
		$depth++;
	}

 	return $depth;
}

add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes=array() ) {
	// add your extension to the array
	$existing_mimes['vcf'] = 'text/x-vcard';
	return $existing_mimes;
}

function get_custom_categories($exclude=false) {
	$categories = get_terms('category','hide_empty=0&exclude=1,3'.($exclude ? ','.$exclude : '') );
	$active = false;
	if (isset($_GET["cat"]) && $_GET["cat"] != "") $active = $_GET["cat"];

	if ($categories && count($categories) > 0) {
		echo '<ul id="list-cat-element">
			<li class="cat-item-all"><a href="'.get_permalink().'?cat=all"'.($active === false ? ' class="active"':'').'>'.__("ALL","apax").'</a></li>';
		foreach ($categories as $categorie){
			echo '<li class="cat-item cat-item-'.$categorie->term_id.'"><a href="'.get_permalink().'?cat='.$categorie->term_id.'"'.($active !== false && $categorie->term_id == $active ? ' class="active"':'').' title="'.$categorie->description.'">'.$categorie->name.'</a></li>';
		}
		echo '</ul>';
	}
}

function change_search_url_rewrite() {
    if ( is_search() && ! empty( $_GET['s'] ) ) {
        // wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
        // exit();
    }
}
add_action( 'template_redirect', 'change_search_url_rewrite' );

function pressPagination($pages = '', $range = 2)
{
    global $paged;
    $showitems= ($range * 2)+1;

    if(empty($paged)) $paged = 1;
    if($pages == '')
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages)
        {
                   $pages = 1;
        }
    }

    if(1 != $pages)
    {
        echo "<div class='pagination'>";
        // if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."' class='navig first_left'>&laquo;</a>";
        if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."' class='navig left'>&lsaquo;</a>";
        else echo "<span class='navig left'></span>";

        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
            }
        }

        if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."' class='navig right'>&rsaquo;</a>";
        else echo "<span class='navig right'></span>";
           // if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."' class='navig first_right'>&raquo;</a>";
           echo "</div>";
       }

}

function main_menu_wrap(){
	$params = '';
	$lang = icl_get_languages('skip_missing=0&order=desc');
	$wrap  = '<ul id="%1$s" class="%2$s">';
	$wrap .= '%3$s';
	foreach ($lang as $code=>$l){
		if(is_home() && !empty($_GET['meta_key']) && $_GET['meta_key'] == 'societe_presse'){
			$params = '?meta_key='.$_GET['meta_key'].'&meta_value='.icl_object_id(intval($_GET['meta_value']),'post', false, $code);
		}
		$wrap .= '<li><a href="'.$l['url'].$params.'" class="lang'.(ICL_LANGUAGE_CODE == $code ? ' active':'').'">'.strtoupper($code).'</a></li>';
	}
	$wrap .= '</ul><div class="clear"></div>';
	return $wrap;
}

add_action( 'wp_ajax_load-last-actu', 'load_last_actu' );
add_action( 'wp_ajax_nopriv_load-last-actu', 'load_last_actu' );
function load_last_actu() {
	if (isset( $_REQUEST['nonce'] ) && wp_verify_nonce( $_REQUEST['nonce'], 'ajax-nonce' )) {
		global $post;

		$args = array(
			"posts_per_page" => $_POST["perpage"],
			"offset" => $_POST["offset"],
		);
		if (isset($_POST['meta_value']) && !empty($_POST['meta_value']) && isset($_POST['meta_key']) && !empty($_POST['meta_key'])){
			$args['meta_query'] = array(
				array(
					  'key' => $_GET['meta_key'],
					  'value' => intval($_GET['meta_value']),
					  'compare' => '>=',
					  'type' => 'numeric'
				)
			);
		}
		if ($_POST["year"]) $args["year"] = $_POST["year"];
		$new_query = new WP_Query($args);
		$actus = $new_query->get_posts();
		echo '<div><div id="tmpActu">';
		foreach ($actus as $k=>$actu) {
			echo '<div class="grid-item col-md-4 col-lg-3 col-sm-6 cat-item-'.get_the_date("Y",$actu->ID).'">
				<article>
					<div class="block-article">
						<a href="'.get_permalink($actu->ID).'"><span class="date">'.str_replace(" ","<br/>",get_the_date(get_option("date_format"),$actu->ID)).'</span></a>';
						$origine = get_the_title($actu->ID);
						$cut = substr($origine,0,120);
						if ($cut < $origine) $cut .= "...";
						echo '<h2><a href="'.get_permalink($actu->ID).'">'.$cut.'</a></h2>
						<a class="plus" href="'.get_permalink($actu->ID).'">'.__("Read more","apax").'</a>
					</div>
				</article>
			</div>';
		}
		echo '</div></div>';
	}
	die();
}

add_action( 'wp', 'wpse_55202_do_terms_exclusion' );

function wpse_55202_do_terms_exclusion() {
	if ((is_admin() && isset($_GET["post_type"]) && $_GET["post_type"] != "team")
		|| (!is_admin() && get_page_template_slug() != "template-list-equipe.php"))
		add_filter( 'list_terms_exclusions', 'wpse_55202_list_terms_exclusions', 10, 2 );
}

function wpse_55202_list_terms_exclusions($exclusions,$args) {
    return $exclusions . " AND ( t.term_id <> 28 ) AND ( t.term_id <> 27 ) ";
}

add_filter('nav_menu_css_class', 'current_type_nav_class', 10, 2 );
function current_type_nav_class($classes, $item) {
    $post_type = get_post_type();
    if ($post_type == "team") {
		if (get_page_template_slug($item->object_id) == "template-list-equipe.php") {
			array_push($classes, 'current-menu-item');
		} elseif(($key = array_search("current_page_parent", $classes)) !== false) {
			unset($classes[$key]);
		}
    } else if ($post_type == "societe") {
		if (get_page_template_slug($item->object_id) == "template-list-societe.php") {
			array_push($classes, 'current-menu-item');
		} elseif(($key = array_search("current_page_parent", $classes)) !== false) {
			unset($classes[$key]);
		}
	}
    return $classes;
}

function make_bitly_url($url,$format = 'xml',$version = '2.0.1')
{
	$bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url).'&login='.BITLY_LOGIN.'&apiKey='.BITLY_APIKEY.'&format='.$format;
	$response = file_get_contents($bitly);
	if(strtolower($format) == 'json')
	{
		$json = @json_decode($response,true);
		return $json['results'][$url]['shortUrl'];
	}
	else
	{
		$xml = simplexml_load_string($response);
		return 'http://bit.ly/'.$xml->results->nodeKeyVal->hash;
	}
}

add_action( 'pre_get_posts', 'custom_search_filter_blog' );
function custom_search_filter_blog($query){
	if ($query->is_main_query() && is_post_type_archive('blog') && !is_admin() && isset($_GET['meta_value']) && !empty($_GET['meta_value']) && isset($_GET['meta_key']) && !empty($_GET['meta_key'])){
		$other_lang = ICL_LANGUAGE_CODE == 'fr'?'en':'fr';
		$query->set( 'meta_query', array(
			'relation' => 'OR',
			array(
				'key' => $_GET['meta_key'],
				'value' => intval($_GET['meta_value']),
				'compare' => '=='
			),
			array(
				'key' => $_GET['meta_key'],
				'value' => intval(icl_object_id($_GET['meta_value'],'post',true,$other_lang)),
				'compare' => '=='
			),
		));
	}
}

add_action('pre_get_posts', 'custom_search_filter_presse');
function custom_search_filter_presse($query){
	if ($query->is_main_query() && is_home() && !is_admin() && isset($_GET['meta_value']) && !empty($_GET['meta_value']) && isset($_GET['meta_key']) && !empty($_GET['meta_key'])){
		$other_lang = ICL_LANGUAGE_CODE == 'fr'?'en':'fr';
		$query->set( 'meta_query', array(
			'relation' => 'OR',
			array(
				'key' => $_GET['meta_key'],
				'value' => $_GET['meta_value'],
				'compare' => 'LIKE'
			),
			array(
				'key' => $_GET['meta_key'],
				'value' => icl_object_id($_GET['meta_value'],'post',true,$other_lang),
				'compare' => 'LIKE'
			),
		));
		$query->set( 'suppress_filters', true);
	}
}

class themeslug_walker_nav_menu extends Walker_Nav_Menu {
	// add classes to ul sub-menus
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'sub-menu',
			( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
			( $display_depth >=2 ? 'sub-sub-menu' : '' ),
			'menu-depth-' . $display_depth
			);
		$class_names = implode( ' ', $classes );
		// build html
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}

	// add main/sub classes to li's and links
	function start_el(  &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
			( $depth >=2 ? 'sub-sub-menu-item' : '' ),
			( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
			'menu-item-depth-' . $depth,
			'menu'.$item->object_id
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		if (($item->object_id==18 || $item->object_id==356) && (is_post_type_archive('blog') || get_post_type() == "blog")){
			unset($classes[4]);
		}
		if ((($item->object_id==16 || $item->object_id==355) && get_post_type() == "blog") ||
			($item->type == "custom" && ($item->url == get_bloginfo("home").'/blog/' || $item->url == get_bloginfo("home").'/en/blog/') && get_post_type() == "blog")){
			$classes[] = "current-menu-item";
		}
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		// build html
		$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

		// link attributes
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

		$sous_menu = get_pages("parent=".$item->object_id."&sort_column=menu_order&hierarchical=0");
		$title = apply_filters( 'the_title', $item->title, $item->ID );
		if ($depth === 1){
			$title .= get_the_post_thumbnail( $item->object_id, 'image_menu', array('alt'=>trim(strip_tags($item->title))));
		}

		$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			$title,
			count($sous_menu)>0 && $depth === 0 ? $args->link_after : "",
			$args->after
		);

		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/*
 * Add columns to exhibition post list
 */
function add_acf_columns ( $columns ) {
$new = array();

$new["cb"] = $columns["cb"];
$new["title"] = $columns["title"];
$new["id"] = "ID";
$new["associes_blog"] = __ ( 'Associé', 'apax' );
$new["date"] = $columns["date"];
return $new;
}
add_filter ( 'manage_blog_posts_columns', 'add_acf_columns' );

/*
 * Add columns to exhibition post list
 */
 function associes_blog_custom_column ( $column, $post_id ) {
   switch ( $column ) {
     case 'id':
		echo $post_id;
       break;
	  case 'associes_blog':
		$associe = get_post(get_post_meta ( $post_id, 'associes_blog', true ));
		echo $associe->post_title;
       break;
   }
 }
 add_action ( 'manage_blog_posts_custom_column', 'associes_blog_custom_column', 10, 2 );

/*
 * Get attached socity object (current lang first, other lang next, $default if doesn't exists)
 */
function get_attached_society($post_id, $default = null) {
	if(get_field('entreprise_blog', $post_id)){
		return get_field('entreprise_blog', $post_id);
	}else{
		$lang = ICL_LANGUAGE_CODE == 'fr'?'en':'fr';
		$translated_id = intval(icl_object_id($post_id, 'post', false, $lang));
		if(get_field('entreprise_blog', $translated_id)){
			return get_post(icl_object_id(get_field('entreprise_blog', $translated_id)->ID, 'post', true), ICL_LANGUAGE_CODE) ;
		}
	}
	return $default;
 }

 function my_password_post_filter( $where = '' ) {
    // Make sure this only applies to loops / feeds on the frontend
    if (!is_single() && !is_admin()) {
        // exclude password protected
        $where .= " AND post_password = ''";
    }
    return $where;
}
add_filter( 'posts_where', 'my_password_post_filter' );