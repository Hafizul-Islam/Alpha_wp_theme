<?php
/*
	Template Name: About page template 
*/
 get_header(); ?>
<body  <?php body_class(); ?> >

<?php get_template_part( "/template-parts/about-page/hero-page" ); ?>


				
			<div class="posts">
				<?php 
				while(have_posts()){
					the_post();
				?>

				<div class="post"  <?php post_class(); ?> >
					<div class="container">
						<div class="row">
							<div class="row"> 
								<div class="col-md-8 offset-md-2">
									<?php
										$attachments = new Attachments('testimonials');
										if(class_exists("attachments" && $attachments->exist()  )){
									?>
											<h2 class="text-center">
												<?php _e('Testimonials','alpha'); ?>
											</h2>
										
									<?php } ?>
									<div class="testimonials slider_class text-center">
										<?php
										if(class_exists("attachments")){
											$attachments = new Attachments('testimonials');
											if( $attachments->exist()){
												while( $attachment = $attachments->get()){ ?>
												<div>
													<?php echo $attachments->image('thumbnail') ?>
												 	<h4> <?php echo esc_html($attachments->Field('title') )?> </h4>
													<p><?php echo esc_html($attachments->Field('testimonials')) ?></p>
													<p>
														<?php echo esc_html($attachments->Field('position')) ?>
														<strong><?php echo esc_html($attachments->Field('company')) ?></strong>
													</p>
												</div>
											<?php
											}
										}
									}
									?>
									</div>
								</div>
							</div>



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
						


						<?php if(class_exists("attachments")){
								
							?>
							<div class="row">
								<?php
									$attachments = new Attachments('team');
										if( $attachments->exist()){
											while( $attachment = $attachments->get()){ ?>

												<div class="col-md-4">
													<?php echo $attachments->image('medium') ?>
												 	<h4> <?php echo esc_html($attachments->Field('name') )?> </h4>
												 	<p>
														<?php echo esc_html($attachments->Field('position')) ?>
														<strong><?php echo esc_html($attachments->Field('company')) ?></strong>
													</p>
													<p><?php echo esc_html($attachments->Field('gmail')) ?></p>
													<p><?php echo esc_html($attachments->Field('bio')) ?></p>
													
												</div>
											<?php
											}
										}
									
									?>
							</div>


							<?php 
							}
							?>

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