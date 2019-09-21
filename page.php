<?php get_header(); ?>
<body  <?php body_class(); ?> >

<?php get_template_part( "/template-parts/common/hero" ); ?>


				
			<div class="posts">
				<?php 
				while(have_posts()){
					the_post();
				?>

				<div class="post"  <?php post_class(); ?> >
					<div class="container">
						<div class="row">
							<div class="col-md-10 offset-md-1">
								<h2 class="post-title text-center">
								  <?php the_title(); ?>
								</h2>
								
								<p class="text-center">
									<strong> <?php the_author(); ?> </strong> </br>
									<?php echo  get_the_date(); ?>

									<?php echo get_the_tag_list("<ul class=\"list-unstyled\"> <li> ", "<li></li>" ,",</li></ul>");
									 ?>
								</p>
								

							</div>
						</div>
						<div class="row">
							<div class= "col-md-10 offset-md-1">
								<p class="text-center">
									<?php 
									if( has_post_thumbnail()){
										$thumbnail_url = get_the_post_thumbnail_url( null, "post-thumbnail" );
										//echo '<a href=" '.$thumbnail_url.' " data-featherlight="image">';
										//printf( '<a href=" %s "  data-featherlight="image">',$thumbnail_url);
										echo '<a class="popup" href="#" data-featherlight="image">';
										the_post_thumbnail( "large", "class = 'img-fluid' " );
										echo '</a>';
									}
									?>
								
									<?php  the_content();  ?>
								</p>
								
							</div>
							<?php if(comments_open()): ?>
								<div class="col-md-10 offset-md-1">
									<?php
										comments_template(); 
									?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php 
				}
				?>
			</div>


<?php get_footer(); ?>