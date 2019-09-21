
<?php get_header(); ?>

<body  <?php body_class(); ?> >
<?php get_template_part( "/template-parts/common/hero" ); ?>

<div class="container">
	<div class="authorsection authorpage">
		<div class="row">
			<div class="col-md-3 authorimage">
				<?php
					echo get_avatar( get_the_author_meta( "id" ));
			    ?>
			</div>
			<div class="col-md-9">
				<h4><?php echo get_the_author_meta( "display_name" );?> </h4>
		 		<P> 
				<?php 
			 		echo get_the_author_meta( "description");
				?>
				</P>
			</div>
		</div>
	</div>
</div>

<div class="posts text-center">
	<?php 
	while(have_posts()){
		the_post();
		?>
		<h1> <a href="<?php the_permalink() ?>"> <?php the_title(); ?> </a> </h1> 
		 
	<?php 
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
 