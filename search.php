<?php get_header(); ?>

<body  <?php body_class(); ?> >
<?php get_template_part( "/template-parts/common/hero" ); ?>

<div class="posts">
	<?php 
	if(!have_posts()){ 
	?>

	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<h3> <?php _e('No result found','alpha'); ?></h3>
			</div>
		</div>
	</div>
		

	<?php
	}
	while(have_posts()){
		the_post();
		get_template_part( "post-formats/content",get_post_format() );
	}
	?>
</div>



 <div class="container post-pagination" >
 	<div class="row">
 		<div class="col-md-4"></div>
 		<div class="col-md-8">
 			<?php 
 				the_posts_pagination( array(
 					"screen_reader_text"=>' ',
 					"prev_text"=>"New Posts",
 					"next_text"=>"Old posts"
 				));
 			?>
 		</div>
 	</div>
 </div>

 <?php get_footer(); ?>
