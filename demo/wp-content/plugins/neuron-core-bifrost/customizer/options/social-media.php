<?php 
/**
 * Social Media
 */

// Create Panel and Sections
Kirki::add_section('social_media', array(
	'title'       => esc_attr__('Social Media', 'neuron-core'),
    'priority'    => 10
));

// Settings
Kirki::add_field('neuron_kirki', array(
	'type'        => 'custom',
	'settings'    => 'social_media_message',
	'section'     => 'social_media',
	'default'     => '<h1>' . esc_html__('General', 'neuron-core') . '</h1><hr>'
));
Kirki::add_field('neuron_kirki', array(
	'type'        => 'select',
	'settings'    => 'social_media_new_window',
    'label'       => esc_html__('New Window', 'neuron-core'),
    'description' => esc_html__('Enable if you want the social media links to open in a new window.', 'neuron-core'),
	'section'     => 'social_media',
	'default'     => '2',
    'choices'     => array(
        '1' => esc_attr__('Enable', 'neuron-core'),
        '2' => esc_attr__('Disable', 'neuron-core')
    ),
));

// Url
Kirki::add_field('neuron_kirki', array(
	'type'        => 'custom',
	'settings'    => 'social_media_url_message',
	'section'     => 'social_media',
	'default'     => '<h1>' . esc_html__('URLs', 'neuron-core') . '</h1><hr>'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => 'social_media_facebook',
	'label'    => __('Facebook URL', 'neuron-core'),
	'section'  => 'social_media'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => 'social_media_twitter',
	'label'    => __('Twitter URL', 'neuron-core'),
	'section'  => 'social_media'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => 'social_media_instagram',
	'label'    => __('Instagram URL', 'neuron-core'),
	'section'  => 'social_media'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => 'social_media_500px',
	'label'    => __('500px URL', 'neuron-core'),
	'section'  => 'social_media'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => 'social_media_google_plus',
	'label'    => __('Google Plus URL', 'neuron-core'),
	'section'  => 'social_media'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => 'social_media_vimeo',
	'label'    => __('Vimeo URL', 'neuron-core'),
	'section'  => 'social_media'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => 'social_media_dribbble',
	'label'    => __('Dribbble URL', 'neuron-core'),
	'section'  => 'social_media'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => 'social_media_pinterest',
	'label'    => __('Pinterest URL', 'neuron-core'),
	'section'  => 'social_media'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => 'social_media_youtube',
	'label'    => __('Youtube URL', 'neuron-core'),
	'section'  => 'social_media'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => 'social_media_tumblr',
	'label'    => __('Tumblr URL', 'neuron-core'),
	'section'  => 'social_media'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => 'social_media_linkedin',
	'label'    => __('Linkedin URL', 'neuron-core'),
	'section'  => 'social_media'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => 'social_media_behance',
	'label'    => __('Behance URL', 'neuron-core'),
	'section'  => 'social_media'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => 'social_media_flickr',
	'label'    => __('Flickr URL', 'neuron-core'),
	'section'  => 'social_media'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => 'social_media_spotify',
	'label'    => __('Spotify URL', 'neuron-core'),
	'section'  => 'social_media'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => 'social_media_github',
	'label'    => __('GitHub URL', 'neuron-core'),
	'section'  => 'social_media'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => 'social_media_houzz',
	'label'    => __('Houzz URL', 'neuron-core'),
	'section'  => 'social_media'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => 'social_media_stackexchange',
	'label'    => __('StackExchange URL', 'neuron-core'),
	'section'  => 'social_media'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => 'social_media_soundcloud',
	'label'    => __('SoundCloud URL', 'neuron-core'),
	'section'  => 'social_media'
));
Kirki::add_field('neuron_kirki', array(
	'type'     => 'text',
	'settings' => 'social_media_vk',
	'label'    => __('VK URL', 'neuron-core'),
	'section'  => 'social_media'
));