<?php get_header(); ?>

<body  <?php body_class(); ?> >
<?php get_template_part( "/template-parts/common/hero" ); ?>

<div class="posts text-center">
	<h1> 
		Post In 
		<?php
			if(is_month()){
				$month = get_query_var( "monthnum");
				$dateobj = DateTime::createFromFormat ("!m",$month);
				echo $dateobj->format("F");
			}else if(is_year()){
				echo esc_html(get_query_var( "year" ));
			}else if( is_date()){
				$month = get_query_var( "monthnum");
				$dateobj = DateTime::createFromFormat ("!m",$month);
				$day = esc_html( get_query_var( "date" ) );
				$year = esc_html( get_query_var( "year" ) );
				$mont = $dateobj->format("F");

				printf("%s %s %s",$day,$month,$year);
			}
		 ?>
	</h1>

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
 