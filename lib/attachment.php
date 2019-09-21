<?php
define( 'ATTACHMENTS_SETTINGS_SCREEN', false );
add_filter( 'attachments_default_instance', '__return_false' );

function alpha_attachment($attachments)
{
	$fields = array(
		array(
			'name' => 'title',
			'type' => 'text',
			'label'=> __('Title','alpha'),
		)
	);

	$args = array(
		'label'     => 'Featured Slider',
		'post_type' => array('post'),
		'filetype'  => array("image"),
		'note'      => 'Add Slidere Iamge',
		'button-text'=> __('Attach Files','alpha'),
		'fields'    => $fields,
	);
	$attachments->register( 'slider', $args ); 
}
add_action( 'attachments_register', 'alpha_attachment' );

function alpha_testimonial_attachment($attachments)
{
	$fields = array(
		array(
			'name' => 'title',
			'type' => 'text',
			'label'=> __('Title','alpha'),
		),
		array(
			'name' => 'position',
			'type' => 'text',
			'label'=> __('POsition','alpha'),
		),
		array(
			'name' => 'company',
			'type' => 'text',
			'label'=> __('Company','alpha'),
		),
		array(
			'name' => 'testimonials',
			'type' => 'textarea',
			'label'=> __('Testimonials','alpha'),
		),
	);

	$args = array(
		'label'     => 'Testimonials',
		'post_type' => array('page'),
		'filetype'  => array("image"),
		'note'      => 'Add Testimonials',
		'button-text'=> __('Attach Files','alpha'),
		'fields'    => $fields,
	);
	$attachments->register( 'testimonials', $args ); 
}
add_action( 'attachments_register', 'alpha_testimonial_attachment' );

function alpha_team_attachment($attachments)
{
	$fields = array(
		array(
			'name' => 'name',
			'type' => 'text',
			'label'=> __('Name','alpha'),
		),
		array(
			'name' => 'gmail',
			'type' => 'text',
			'label'=> __('Gmail','alpha'),
		),
		array(
			'name' => 'position',
			'type' => 'text',
			'label'=> __('POsition','alpha'),
		),
		array(
			'name' => 'company',
			'type' => 'text',
			'label'=> __('Company','alpha'),
		),
		array(
			'name' => 'bio',
			'type' => 'textarea',
			'label'=> __('Bio','alpha'),
		),
	);

	$args = array(
		'label'     => 'Team',
		'post_type' => array('page'),
		'filetype'  => array("image"),
		'note'      => 'Add Team',
		'button-text'=> __('Attach Files','alpha'),
		'fields'    => $fields,
	);
	$attachments->register( 'team', $args ); 
}
add_action( 'attachments_register', 'alpha_team_attachment' );