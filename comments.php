
<div class="comments">
	<h3 class="comment-title">
		<?php
			$alpha_cnt = get_comments_number();
			if($alpha_cnt==1){
				_e('1 comment','alpha');
			}else{
				 echo $alpha_cnt." ".__('comments','alpha');
			}
		?>
	</h3>
	<div class="comments-list">
		<?php
			wp_list_comments();
			?>
			<div class="comments-pagination">
				<?php
					the_comments_pagination( array(
						'screen_reader_text' => __('Pagination','alpha'),
						'prev_text' =>'<'.__( 'previous comments', 'alpha'),
						'next_text' =>'>'.__( 'Next comments', 'alpha'),  
					));
				?>
			</div>

			<?php
			if( !comments_open()){
				_e('comments are closed','alpha');
			}
		?>
	</div>
	

	<div class="comment-form">
		<?php comment_form(  );  ?>
	</div>
</div>

