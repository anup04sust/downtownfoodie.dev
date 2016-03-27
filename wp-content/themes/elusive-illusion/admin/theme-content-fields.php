<?php
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_page-banner-attributes',
		'title' => 'Page Attributes  ',
		'fields' => array (
			array (
				'key' => 'field_bg_image',
				'label' => 'Background Image',
				'name' => 'page_bg_image',
				'type' => 'image',
				'instructions' => 'Upload this page Background Image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_page_sub_title',
				'label' => 'Page Group Title/Base Title',
				'name' => 'page_sub_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_page_submenu_title',
				'label' => 'Page Sub  Menu Title',
				'name' => 'page_submenu_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_page_external_url',
				'label' => 'Page External Link',
				'name' => 'page_external_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_title_icon',
				'label' => 'Title Icon',
				'name' => 'page_title_icon',
				'type' => 'image',
				'instructions' => 'Upload icon Image for beside title',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_content_bottom',
				'label' => 'Bottom Content',
				'name' => 'page_bottom_content',
				'type' => 'wysiwyg',
				'instructions' => 'Upload icon Image for beside title',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
