<?php

if (  class_exists( 'Attachments' ) ) {

	require_once get_theme_file_path( '/lib/attachment.php' );
}

require_once get_theme_file_path ('/inc/tgm.php');
require_once get_theme_file_path ('/inc/acf-mb.php');

if( site_url()=="http://localhost/wordpress"){
	define("VERSION", time());
}else{
	define("VERSION", wp_get_theme()->get("Version"));
}

function alpha_bootstraping()
{
	load_theme_textdomain( "alpha");
	add_theme_support( "post-thumbnails" );
	add_theme_support( "title-tag" );
	add_theme_support( 'html5', array( 'search-form' ) );
	$alpha_custom_header_details = array(
		'header-text'            => true,
		'default_text_color'     => '#222' ,
		'width'                  => 1200,
		'height'                 => 600
	);
	add_theme_support( "custom-header",$alpha_custom_header_details );
	$alpha_customlogo_details = array(
		'width' =>'100' ,
		'height'=>'100',
	 );
	add_theme_support( "custom-background" );
	add_theme_support( "custom-logo",$alpha_customlogo_details );
	add_theme_support( 'post-formats', array( 'aside', 'gallery','image','audio' ,'video','quote') );
	register_nav_menu( "alphatopmenu", __("Alpha Top Manu","alpha") );
	register_nav_menu( "footerpmenu", __("Footer Manu","alpha") );

	add_image_size( "alpha-square", 300,300,true );
	
}
add_action("after_setup_theme","alpha_bootstraping");

function alpha_assets()
{
	wp_enqueue_style("bootstrap","//maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css");
	wp_enqueue_style("featerlight-css","//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.css");
	wp_enqueue_style( 'dashicons');
	wp_enqueue_style( "tns-style", "//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.1/tiny-slider.css" );
	wp_enqueue_style( 'font-awesome','https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

	
	wp_enqueue_style( "alpha", get_stylesheet_uri(),null,VERSION ); 

	wp_enqueue_script('tns-js', "//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.1/min/tiny-slider.js", null, VERSION, true);
	wp_enqueue_script('featerlight-js', '//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js', array('jquery'), VERSION, true);

	wp_enqueue_script('alpha-main', get_template_directory_uri()."/assests/js/main.js", array('jquery',"featerlight-js"), VERSION, true);

}
add_action( "wp_enqueue_scripts","alpha_assets" );  

function alpha_admin_assets(){
	wp_enqueue_media();
	wp_enqueue_script('alpha-admin-js', get_template_directory_uri()."/assests/js/admin.js", array('jquery'), VERSION, true);
}
add_action( 'admin_enqueue_scripts','alpha_admin_assets');

function alpha_sidebar()
{
	
	$single_sidebar = array(
		'name'          => __( 'single post Sidebar name', 'alpha' ),
		'id'            => 'sidebar-1',
		'description'   => 'Right sidebar',
		'class'         => '',
		'before_widget' => '<div class="sidebar-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	);


	$footer_left = array(
		'name'          => __( 'footer left widget', 'alpha' ),
		'id'            => 'footer-left',
		'description'   => 'Right sidebar',
		'class'         => '',
		'before_widget' => '<li id="%1" class="widget %2">',
		'after_widget'  => '</li>',
		'before_title'  => '',
		'after_title'   => '',
	);


	$footer_right = array(
		'name'          => __( 'footer right widget', 'alpha' ),
		'id'            => 'footer-right',
		'description'   => 'Right sidebar',
		'class'         => '',
		'before_widget' => '<div class="sidebar-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	);

	register_widget( 'Author_Info_Widget');
	register_sidebar( $single_sidebar);
	register_sidebar( $footer_left);
	register_sidebar( $footer_right);
	
}
add_action("widgets_init","alpha_sidebar" );

class Author_Info_Widget extends WP_Widget{
	public function __construct(){
		parent:: __construct('author_info','Author_info_Box',array(
			'description' => 'Author Information titel image and details'
		));
	}
	public function widget($register_info,$widgets_value){
		
		echo $register_info['before_widget'] ;
			echo $register_info['before_title'].$widgets_value['title'].$register_info['after_title']; ?>

			<div class="sidebar-widget__about-me-image">
				<div class="sidebar-widget__about-me-image">
				 	<img src="<?php echo $widgets_value['author_image']; ?>" alt="<?php echo $widgets_value['title']; ?>">
				</div>
			</div>	
			<p><?php echo $widgets_value['author_bio'] ?></p>
		<?php echo $register_info['after_widget'] ;
			
	}
	public function form($three){
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title');?>">Title: </label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $three['title']; ?>"
				id="<?php echo $this->get_field_id('title');?>" class="widefat">
		</p>
		<p> 
			<button type="" class="button" id="author_info_image">UpLoad Image</button>
			<input type="hidden" name="<?php echo $this->get_field_name('author_image');?>" value="<?php echo $three['author_image'];?>"
			class="image_er_link">
			<div class="image_show">
				<img src="<?php echo $three['author_image'];?>" width="300px" height="auto" alt="">
			</div>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('author_bio');?>">Author Bio: </label>
			<textarea name="<?php echo $this->get_field_name('author_bio'); ?>" id="<?php echo $this->get_field_id('author_bio');?>"class="widefat" >
				<?php echo $three['author_bio']; ?>
			</textarea>
		</p>
		<?php
	}
}

function alpha_excerpt($excerpt)
{
	if(!post_password_required()){
		return $excerpt;
	}else{
		echo get_the_password_form();
	}
}
add_filter( "the_excerpt","alpha_excerpt" );
function alpha_title_change()
{
	return "%s";
}
add_filter( "protected_title_format","alpha_title_change" ); 

function alpha_add_item_class($classes,$item)
{
	$classes[]="list-inline-item";
	return $classes;
}
add_filter( "nav_menu_css_class","alpha_add_item_class",10,2);

function alpha_about_page_template()
{
	if( is_page()){
		$alpha_featured_image = get_the_post_thumbnail_url( null, "large" );
		?>
		<style type="text/css" media="screen">
			.page-header{
				background-image: url(<?php echo $alpha_featured_image; ?>); 
			}
		</style>

		<?php 
	}

	if( is_front_page()){
		if( current_theme_supports("custom-header")){
			?>
			<style type="text/css" media="screen">
				.header{
					background-image: url(<?php echo header_image(); ?>); 
					margin-bottom: 50px;
				}

				.header h1.heading a,h3.tagline{
					color: #<?php echo get_header_textcolor() ?>;
					<?php
						if( !display_header_text()){
							echo " display:none;";
						}
					 ?>
				}

			</style>
			<?php

		}
	} 
}
add_action("wp_head","alpha_about_page_template",100);


function alpha_highlight_search_result($text){
	if(is_search()){
		$pattern = '/('.join('|',explode(' ', get_search_query())).')/i';        
		$text = preg_replace($pattern,'<span class="search-highlight">\0</span> ', $text);                          

	}
	return $text;
}
add_filter( "the_content","alpha_highlight_search_result" );
add_filter( "the_excerpt","alpha_highlight_search_result" );
add_filter( "the_title","alpha_highlight_search_result" );

function alpha_post_modify($wpq){
	if(is_home() && $wpq->is_main_query()){
		$wpq->set("tag__not_in",array(4));
	}
}

add_action( 'pre_get_posts', 'alpha_post_modify');

add_filter( 'acf/settings/show_admin','__return_false');