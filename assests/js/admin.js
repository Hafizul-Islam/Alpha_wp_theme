(function($){
	$(document).ready(function(){
		$('button#author_info_image').on('click',function(e){
			e.preventDefault();

			var ImageUploder = wp.media({
				'title' : 'Author Upload Image',
				'button':{
					'text' : 'Set Image'
				},
				'multiple': true
			});
			ImageUploder.open();

			ImageUploder.on("select",function(){
				var image = ImageUploder.state().get("selection").first().toJSON();
				var link = image.url;
				$('input.image_er_link').val(link);
				$('.image_show img').attr('src',link);
			})

		})
	})
}(jQuery));