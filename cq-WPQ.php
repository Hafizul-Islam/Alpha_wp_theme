
<?php
/**
*	Template name:Custom Query wp query
*/
?>

<?php get_header(); ?>

<body  <?php body_class(); ?> >
<?php get_template_part( "/template-parts/common/hero" ); ?>

<div class="posts text-center">
	
	<?php 
		$paged = get_query_var( "paged" )?get_query_var( "paged"):1;
		$posts_per_page = 4;
		//$total = 9;
		$post_ids = array(75,71,65,33,180,1,23);
		$args = array(
			'posts_per_page'	=>	$posts_per_page,
			//'post__in' 			=>	$post_ids,
			//'numberposts'		=>  $total, 
			//'author__in'        =>  array(1),
			'paged'				=>  $paged,
			//'post_tag'     => 'graph'
			'tax_query' => array(
		        'relation' => 'OR',
		        array(
		            'taxonomy' => 'category',
		            'field'    => 'slug',
		            'terms'    => array( 'new' ),
		        ),
		        array(
		            'taxonomy' => 'post_tag',
		            'field'    => 'slug',
		            'terms'    => array( 'graph' ),
		        ),
		    ),
		);
		$_p = new WP_Query($args); 
		while ($_p->have_posts()) {
			$_p->the_post()
	?>
		<h1> <a href="<?php the_permalink() ?>"> <?php the_title(); ?> </a> </h1> 
		 
	<?php 
	}
	wp_reset_query();

	?>
</div>



 <div class="container post-pagination" >
 	<div class="row">
 		<div class="col-md-4"></div>
 		<div class="col-md-8">
 			<?php 
 				echo paginate_links( array(
 					'total'   => $_p->max_num_pages,
 					'current' => $paged
 				) );
 			?>
 		</div>
 	</div>
 </div>

<?php get_footer(); ?>
 