<?php
	$alpha_layout_class = "col-md-8";
	$alpha_text_class = "";
	if( !is_active_sidebar( "sidebar-1" )){
		$alpha_layout_class = "col-md-10 offset-md-1";
		$alpha_text_class = "text-center";
	}
 ?>

<?php get_header(); ?>
<body  <?php body_class(); ?> >

<?php get_template_part( "/template-parts/common/hero" ); ?>

<div class="container">
	<div class="row">
		<div class="<?php echo $alpha_layout_class; ?>">
			<div class="posts">
				<?php 
				while(have_posts()){
					the_post();
				?>

				<div class="post"  <?php post_class(); ?> >
					<div class="container">
						<div class="row">
							<div class="col-md-12 <?php echo $alpha_text_class; ?>">
								<h2 class="post-title ">
								  <?php the_title(); ?>
								</h2>
								
								<p class="">
									<strong> <?php the_author(); ?> </strong> </br>
									<?php echo  get_the_date(); ?>

									<?php echo get_the_tag_list("<ul class=\"list-unstyled\"> <li> ", "<li></li>" ,",</li></ul>");
									 ?>
								</p>
								

							</div>
						</div>
						<div class="row">
							<div class= "col-md-12">
								<div class="slider_class">
									<?php
									if(class_exists("attachments")){
										$attachments = new Attachments('slider');
										if( $attachments->exist()){
											while( $attachment = $attachments->get()){ ?>
												<div>
													<?php echo $attachments->image('large') ?>
												</div>
											<?php
											}
										}
									}
									?>
								</div>
								<div>
										<?php 
										if( class_exists("attachments")){
											if( has_post_thumbnail()  ){
												$thumbnail_url = get_the_post_thumbnail_url( null, "post-thumbnail" );
											//	echo '<a href=" '.$thumbnail_url.' " data-featherlight="image">';
												printf( '<a href=" %s "  data-featherlight="image">',$thumbnail_url);
												//echo '<a class="popup" href="#" data-featherlight="image">';
												the_post_thumbnail( "large", array("class" => "img-fluid" ) );
												echo '</a>';
											}
										}
										?>		
									<p>	<?php  the_content();  ?>  </p> 

									<?php 
										if(get_post_format()=='image' && function_exists("the_field")):
									?>
									<div class="camera">
										<strong>Camera Model: </strong> <?php  the_field('camera_model')?></br>
										<strong>LOcation: </strong>
										<?php
											$alpha_location = get_field('location');
											echo esc_html( $alpha_location );
										?></br>
										<strong>Date: </strong> <?php  the_field('date')?></br>
										<?php
											if(get_field("licensed")){
												echo the_field('license_information')."</br>";
											}
											$alpha_image = get_field('image');
											$alpha_image_details=wp_get_attachment_image_src( $alpha_image,"alpha-square" );
											echo "<img src='".esc_url($alpha_image_details[0])."'/>"."</br>";

											$file = get_field('attachment');
											if($file){
												$file_thumb = get_field("thumbnail",$file);
												$file_url = wp_get_attachment_url( $file );
												if($file_thumb){
													$file_thumb_details = wp_get_attachment_image_src( $file_thumb );
													
													echo "<a target='_blank' href='{$file_url}' ><img src='".esc_url($file_thumb_details[0])."'/></a> ";
												}else{
													echo "<a target='_blank' href='{$file_url}' >Expected Value Book</a>";
												}
											}
										?>

									</div>
									</div>
									<?php endif;?>
									
								</div>
							</div>

							<?php if(function_exists('the_field')):?>
							<div>
								<h1> <?php _e('Related post','alpha'); ?></h1>
								<?php
									$related_post = get_field('related_post');
									$alpha_quary = new WP_Query(array(
										'post__in' => $related_post,
										'orderby'  => 'post__in'
									));
									while($alpha_quary->have_posts() ){
										$alpha_quary->the_post();
										?>
										<h4> <?php the_title(); ?> </h4>
										<?php
									}
									wp_reset_query();
								?>
							</div>

							<?php endif; ?>


							<div class="authorsection">
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
                             
                             <?php 
                                 echo do_shortcode("[rating]");
                              ?>

							<?php if( !post_password_required()): ?>
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
		</div>
		<?php if(is_active_sidebar( "sidebar-1" )): ?>
			<div class="col-md-4">
				<?php
					if( is_active_sidebar( "sidebar-1" )){
						dynamic_sidebar( "sidebar-1" );
					}
				 ?>
			</div>
		<?php endif; ?>
	</div>
</div>


<?php get_footer(); ?>