<div class="post"  <?php post_class(); ?> >
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="post-title">
					<a href=" <?php the_permalink(); ?> " > <?php the_title(); ?> </a>	
					</h2>
				</div> 
			</div>
			<div class="row">
				<div class="col-md-4">
					<p>
						<strong> <?php the_author(); ?> </strong> </br>
						<?php echo  get_the_date(); ?>
					</p>
					<?php echo get_the_tag_list("<ul class=\"list-unstyled\"> <li> ", "<li></li>" ,",</li></ul>");
					 ?>

					 '<span class="dashicons dashicons-format-video"></span>';
					 	
				</div>
				<div class= "col-md-8">
					<p>
							<?php 
									if( has_post_thumbnail()){
										$thumbnail_url = get_the_post_thumbnail_url( null, "post-thumbnail" );
										//echo '<a href=" '.$thumbnail_url.' " data-featherlight="image">';
										//printf( '<a href=" %s " data-featherlight="image">',$thumbnail_url);
										echo '<a class="popup" href="#" data-featherlight="image">';
										the_post_thumbnail( "large", "class = 'img-fluid' " );
										echo '</a>';
									}
									?>
					
						<?php   the_excerpt();  ?>
					</p>
					
				</div>
			</div>
		</div>
	</div>