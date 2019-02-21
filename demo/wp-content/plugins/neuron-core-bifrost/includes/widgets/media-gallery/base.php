<?php
namespace NeuronElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.0.0
 */
class NeuronMediaGallery extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'neuron-media-gallery';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __('Media Gallery', 'neuron-core');
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-image neuron-badge';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return ['neuron-category'];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {

        $this->start_controls_section(
			'media_gallery_functionality',
			[
				'label' => __('Functionality', 'neuron-core')
			]
        );

        $this->add_control(
			'media_gallery_layout',
			[
                'label' => __('Layout', 'neuron-core'),
                'description' => __('Select the layout of posts.', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'isotope' => __('Isotope', 'neuron-core'),
					'carousel' => __('Carousel', 'neuron-core')
				],
				'default' => 'isotope'
			]
        );
        
        $this->add_control(
			'media_gallery_layout_type',
			[
                'label' => __('Layout Type', 'neuron-core'),
                'description' => __('Select the layout type of isotope.', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'masonry' => __('Masonry', 'neuron-core'),
					'metro' => __('Metro', 'neuron-core'),
					'fitrows' => __('FitRows', 'neuron-core')
				],
				'default' => 'masonry',
				'conditions' => [
					'terms' => [
						[
							'name' => 'media_gallery_layout',
							'operator' => '==',
							'value' => 'isotope'
						], 
					]
				]
			]
		);

        $this->add_control(
			'media_gallery_layout_model',
			[
                'label' => __('Layout Model', 'neuron-core'),
                'description' => __('Select the layout model.', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'meta-inside' => __('Meta Inside', 'neuron-core'),
					'meta-outside' => __('Meta Outside', 'neuron-core')
				],
				'default' => 'meta-inside'
			]
		);

		$this->add_control(
			'media_gallery_lightbox',
			[
				'label' => __('Lightbox', 'neuron-core'),
				'description' => __('Enable the lightbox for the images, the images will open in a large slideshow when clicked.'), 
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'neuron-core'),
				'label_off' => __('No', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'no'
			]
		);

		/**
		 * Categories
		 * 
		 * Get all categories and 
		 * display them in a select, it's up 
		 * to the post type to change this category
         */
		$media_categories = [];
		$media_terms = get_terms('media_category', array('hide_empty' => false));
		if ($media_terms && !is_wp_error($media_terms)) {
			foreach ($media_terms as $term) {
				$media_categories[$term->slug] = $term->name;    
			}
		}

		$this->add_control(
			'media_gallery_filters_visibility',
			[
				'label' => __('Filters', 'neuron-core'),
				'description' => __('Make the media gallery sortable, do not forget to add filters in the repeater.'), 
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'media_gallery_layout' => 'isotope'
				],
			]
		);

		$this->add_control(
			'media_gallery_filters',
			[
				'label'   => __('Filters Query', 'neuron-core'),
				'description' => __('Add the filters.', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => $media_categories,
				'multiple' => true,
				'conditions' => [
					'terms' => [
						[
							'name' => 'media_gallery_layout',
							'operator' => '==',
							'value' => 'isotope'
						], 
						[
							'name' => 'media_gallery_filters_visibility',
							'operator' => '==',
							'value' => 'yes'
						], 
					]
				]
			]
		);

		/**
		 * Query
		 */
		$this->add_control(
            'media_gallery_query_normal',
            [
                'label' => __('Query', 'neuron-core'),
                'description' => __('Add images to the gallery.', 'neuron-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
					[
                        'name' => 'query_image',
                        'label' => __('Image', 'neuron-core'),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => get_template_directory_uri() . '/assets/images/placeholder.png'
						]
                    ],
                    [
                        'name' => 'query_title',
                        'label' => __('Title', 'neuron-core'),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => __('Title', 'neuron-core')
                    ],
                    [
                        'name' => 'query_subtitle',
                        'label' => __('Subtitle', 'neuron-core'),
						'type' => \Elementor\Controls_Manager::TEXT
                    ],
                    [
                        'name' => 'query_category',
						'label' => __('Category', 'neuron-core'),
						'type' => \Elementor\Controls_Manager::SELECT2,
						'options' => $media_categories,
						'multiple' => true
                    ],
                    [
                        'name' => 'query_badge',
						'label' => __('Badge', 'neuron-core'),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => [
							'none' => __('None', 'neuron-core'),
							'new' => __('New', 'neuron-core'),
							'hot' => __('Hot', 'neuron-core')
						],
						'default' => 'none'
                    ],
                    [
                        'name' => 'query_url',
						'label' => __('URL', 'neuron-core'),
						'type' => \Elementor\Controls_Manager::URL
                    ],
                    [
                        'name' => 'query_description',
                        'label' => __('Description', 'neuron-core'),
                        'description' => __('Enter the description. <br /><small>Note: Description is not visible on meta inside.</small>', 'neuron-core'),
						'type' => \Elementor\Controls_Manager::TEXTAREA
					],
					[
                        'name' => 'query_social_media',
                        'label' => __('Social Media', 'neuron-core'),
                        'description' => __('Separate the icon from the URL with two equals ==, also enter a new line for new social media. <br/> <small><a target="_BLANK" href="https://fontawesome.com/cheatsheet#brands">Click here to view cheatsheet of icons.</a></small>', 'neuron-core'),
                        'type' => Controls_Manager::TEXTAREA
                    ],
				],
				'title_field' => '{{{ query_title }}}',
				'conditions' => [
					'terms' => [
						[
							'name' => 'media_gallery_layout_type',
							'operator' => '!=',
							'value' => 'metro'
						], 
					]
				]
            ]
		);

		$this->add_control(
            'media_gallery_query_metro',
            [
                'label' => __('Query', 'neuron-core'),
                'description' => __('Add images to the gallery.', 'neuron-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
					[
                        'name' => 'query_image',
                        'label' => __('Image', 'neuron-core'),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => get_template_directory_uri() . '/assets/images/placeholder.png'
						]
                    ],
                    [
                        'name' => 'query_title',
                        'label' => __('Title', 'neuron-core'),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => __('Title', 'neuron-core'),
                    ],
                    [
                        'name' => 'query_subtitle',
                        'label' => __('Subtitle', 'neuron-core'),
						'type' => \Elementor\Controls_Manager::TEXT
					],
					[
                        'name' => 'query_category',
						'label' => __('Category', 'neuron-core'),
						'type' => \Elementor\Controls_Manager::SELECT2,
						'options' => $media_categories,
						'multiple' => true
					],
					[
                        'name' => 'query_badge',
						'label' => __('Badge', 'neuron-core'),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => [
							'none' => __('None', 'neuron-core'),
							'new' => __('New', 'neuron-core'),
							'hot' => __('Hot', 'neuron-core')
						],
						'default' => 'none'
                    ],
					[
                        'name' => 'query_url',
						'label' => __('URL', 'neuron-core'),
						'type' => \Elementor\Controls_Manager::URL
                    ],
                    [
                        'name' => 'query_description',
                        'label' => __('Description', 'neuron-core'),
						'type' => \Elementor\Controls_Manager::TEXTAREA
                    ],
                    [
                        'name' => 'query_column',
                        'label' => __('Column', 'neuron-core'),
                        'description' => __('Select the column of metro.', 'neuron-core'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                            '1-column' => esc_attr__('1 Column', 'neuron-core'),
                            '2-column' => esc_attr__('2 Column', 'neuron-core'),
                            '3-column' => esc_attr__('3 Column', 'neuron-core'),
                            '4-column' => esc_attr__('4 Column', 'neuron-core'),
                            '5-column' => esc_attr__('5 Column', 'neuron-core'),
                            '6-column' => esc_attr__('6 Column', 'neuron-core'),
                            '7-column' => esc_attr__('7 Column', 'neuron-core'),
                            '8-column' => esc_attr__('8 Column', 'neuron-core'),
                            '9-column' => esc_attr__('9 Column', 'neuron-core'),
                            '10-column' => esc_attr__('10 Column', 'neuron-core'),
                            '11-column' => esc_attr__('11 Column', 'neuron-core'),
                            '12-column' => esc_attr__('12 Column', 'neuron-core')
                        ],
						'default' => '3-column'
					],
					[
                        'name' => 'query_social_media',
                        'label' => __('Social Media', 'neuron-core'),
                        'description' => __('Separate the URL from the icon with two equals ==, also enter a new line for new social media. <br/> <small><a target="_BLANK" href="https://fontawesome.com/cheatsheet#brands">Click here to view cheatsheet of icons.</a></small>', 'neuron-core'),
                        'type' => Controls_Manager::TEXTAREA
                    ],
				],
				'title_field' => '{{{ query_title }}}',
				'condition' => [
					'media_gallery_layout_type' => 'metro'
				]
            ]
		);

        $this->end_controls_section();
        
        $this->start_controls_section(
			'media_gallery_style_layout',
			[
				'label' => __('Layout', 'neuron-core')
			]
		);
		
		$this->add_control(
			'media_gallery_columns',
			[
                'label' => __('Columns', 'neuron-core'),
                'description' => __('Select the columns of the isotope grid.', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1-column' => __('1 Column', 'neuron-core'),
					'2-columns' => __('2 Columns', 'neuron-core'),
					'3-columns' => __('3 Columns', 'neuron-core'),
					'4-columns' => __('4 Columns', 'neuron-core'),
					'5-columns' => __('5 Columns', 'neuron-core'),
					'6-columns' => __('6 Columns', 'neuron-core')
				],
				'default' => '3-columns',
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'media_gallery_layout',
							'operator' => '!=',
							'value' => 'carousel'
						], 
						[
							'name' => 'media_gallery_layout_type',
							'operator' => '!==',
							'value' => 'metro',
						],
					]
				]
			]
		);

		$this->add_control(
			'media_gallery_animation',
			[
                'label' => __('Animation', 'neuron-core'),
                'description' => __('Select initial loading animation for posts.', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'none' 				=> __('None', 'neuron-core'),
					'fade-in' 			=> __('Fade In', 'neuron-core'),
					'fade-in-up' 		=> __('Fade In Up', 'neuron-core'),
					'fade-in-delay' 	=> __('Fade In (with delay)', 'neuron-core'),
					'fade-in-up-delay' 	=> __('Fade In Up (with delay)', 'neuron-core')
				],
				'default' => 'fade-in',
			]
		);

		$this->add_responsive_control(
			'media_gallery_spacing',
			[
                'label' => __('Spacing', 'neuron-core'),
                'description' => __('Move the slider to set the value of spacing. <br /><small>Note: The value is represented in pixels.</small>', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'condition' => [
					'media_gallery_layout' => 'isotope'
				],
				'size_units' => ['px', 'rem'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'condition' => [
					'media_gallery_layout' => 'isotope'
				],
				'selectors' => [
					'{{WRAPPER}} .masonry' => 'margin-left: calc(-{{SIZE}}{{UNIT}} / 2); margin-right: calc(-{{SIZE}}{{UNIT}} / 2)',
					'{{WRAPPER}} .masonry .selector' => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2)',
					'{{WRAPPER}} .masonry .selector .m-media-gallery__item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'render_type' => 'template'
			]
		);

        $this->end_controls_section();
        
        $this->start_controls_section(
			'media_gallery_carousel',
			[
				'label' => __('Carousel', 'neuron-core'),
				'condition' => [
					'media_gallery_layout' => 'carousel'
				]
			]
		);
		
		$this->add_responsive_control(
			'media_gallery_carousel_items',
			[
				'label' => __('Items', 'neuron-core'),
				'description' => __('The number of items you want to see on the screen.', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 1,
				'max'     => 20,
				'step'    => 1
			]
		);

		$this->add_responsive_control(
			'media_gallery_carousel_margin',
			[
				'label' => __('Margin', 'neuron-core'),
				'description' => __('Enter the margin space, number will be represented in pixels.', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 0,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1
			]
		);

		$this->add_control(
			'media_gallery_carousel_height',
			[
				'label' => __('Height', 'neuron-core'),
				'description' => __('Set the height of images to auto or full.', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'auto' => esc_attr__('Auto', 'neuron-core'),
					'full' => esc_attr__('Full', 'neuron-core')
				],
				'default' => 'auto'
			]
		);

		$this->add_responsive_control(
			'media_gallery_carousel_custom_height',
			[
				'label' => __('Custom Height', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['vh', 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .owl-stage .owl-item .h-full-height-image' => 'height: {{SIZE}}{{UNIT}};',
				],
				'default' => [
					'unit' => 'vh',
					'size' => '80'
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					]
				],
				'condition' => [
					'media_gallery_carousel_height' => 'full'
				]
			]
		);

		$this->add_control(
			'media_gallery_carousel_loop',
			[
				'label' => __('Loop', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('On', 'neuron-core'),
				'label_off' => __('Off', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'media_gallery_carousel_mouse_drag',
			[
				'label' => __('Mouse Drag', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('On', 'neuron-core'),
				'label_off' => __('Off', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'media_gallery_carousel_touch_drag',
			[
				'label' => __('Touch Drag', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('On', 'neuron-core'),
				'label_off' => __('Off', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'media_gallery_carousel_navigation',
			[
				'label' => __('Navigation', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('On', 'neuron-core'),
				'label_off' => __('Off', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'media_gallery_carousel_dots',
			[
				'label' => __('Dots', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('On', 'neuron-core'),
				'label_off' => __('Off', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'media_gallery_carousel_autoplay',
			[
				'label' => __('Autoplay', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('On', 'neuron-core'),
				'label_off' => __('Off', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'media_gallery_carousel_pause',
			[
				'label' => __('Pause on mouse house', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('On', 'neuron-core'),
				'label_off' => __('Off', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_responsive_control(
			'media_gallery_carousel_stage_padding',
			[
				'label' => __('Stage Padding', 'neuron-core'),
				'description' => __('Padding left and right on stage (can see neighbours).', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 0,
				'min'     => 0,
				'max'     => 500,
				'step'    => 1
			]
		);

		$this->add_control(
			'media_gallery_carousel_start_position',
			[
				'label' => __('Start Position', 'neuron-core'),
				'description' => __('Enter from which element you want to start the position of carousel.', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 0,
				'min'     => 0,
				'max'     => 500,
				'step'    => 1
			]
		);

		$this->add_control(
			'media_gallery_carousel_autoplay_timeout',
			[
				'label' => __('Auto Play Timeout', 'neuron-core'),
				'description' => __('Autoplay interval timeout, number is represented in seconds.', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 2,
				'min'     => 0,
				'max'     => 500,
				'step'    => 0.1
			]
		);
		
		$this->add_control(
			'media_gallery_carousel_smart_speed',
			[
				'label' => __('Smart Speed', 'neuron-core'),
				'description' => __('Speed Calculate, number is represented in seconds.', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 4.5,
				'min'     => 0,
				'max'     => 500,
				'step'    => 0.1
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'media_gallery_filters_section',
			[
				'label' => __('Filters', 'neuron-core'),
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'media_gallery_layout',
							'operator' => '==',
							'value' => 'isotope',
						],
						[
							'name' => 'media_gallery_filters_visibility',
							'operator' => '==',
							'value' => 'yes',
						]
					]
				]
			]
		);

		$this->add_control(
			'media_gallery_filters_filter_all',
			[
				'label' => __('Show All Filter', 'neuron-core'),
				'description' => __('Show a filter which is able to filter all posts.'), 
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes'
			]
		);

		 $this->add_control(
			'media_gallery_filters_filter_all_string',
			[
				'label'   => __('String', 'neuron-core'),
				'description' => __('Override the filter \'Show All\'.', 'neuron-core'),
                'type'    => Controls_Manager::TEXT,
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'media_gallery_filters_filter_all',
							'operator' => '==',
							'value' => 'yes'
						], 
					],
				]
			]
		);

		$this->end_controls_section();
        
        $this->start_controls_section(
			'media_gallery_thumbnail',
			[
				'label' => __('Thumbnail', 'neuron-core')
			]
		);
		
		$this->add_control(
			'media_gallery_thumbnail_resizer',
			[
				'label' => __('Thumbnail Resizer', 'neuron-core'),
				'description' => __('Activate a thumbnail resizer, it will crop all the images to a given width & height.', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('On', 'neuron-core'),
				'label_off' => __('Off', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'media_gallery_thumbnail_sizes', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'label' => __('Thumbnail Sizes', 'neuron-core'),
				'description' => __('Select the thumbnail size.', 'neuron-core'),
				'default' => 'large',
				'condition' => [
					'media_gallery_thumbnail_resizer' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Style Options
		 */

		/**
		 * Hover
		 */
		$this->start_controls_section(
			'media_gallery_style_hover',
			[
				'label' => __('Hover', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'media_gallery_hover_visibility',
			[
                'label' => __('Visibility', 'neuron-core'),
                'description' => __('Select the visibility of the hover.', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'show'	=> __('Show', 'neuron-core'),
					'hide'	=> __('Hide', 'neuron-core')
				],
				'default' => 'show',
			]
		);

		$this->add_control(
			'media_gallery_hover_animation',
			[
                'label' => __('Animation', 'neuron-core'),
                'description' => __('Select the animation of the hover.', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'translate'	=> __('Translate', 'neuron-core'),
					'scale'	=> __('Scale', 'neuron-core')
				],
				'default' => 'translate',
				'condition' => [
					'media_gallery_hover_visibility' => 'show'
				]
			]
		);

		$this->add_control(
			'media_gallery_style_hover_active',
			[
				'label' => __('Active Hover', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('On', 'neuron-core'),
				'label_off' => __('Off', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'no',
				'separator' => 'after'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'media_gallery_style_hover_background_type',
				'label' => __('Background', 'neuron-core'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .l-media-gallery-wrapper .o-neuron-hover .o-neuron-hover-holder .o-neuron-hover-holder__header__overlay'
			]
		);

		$this->add_control(
			'media_gallery_style_hover_content_vertical_alignment',
			[
				'label' => __('Content Vertical Alignment', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => __('Top', 'neuron-core'),
						'icon' => 'eicon-v-align-top'
					],
					'center' => [
						'title' => __('Middle', 'neuron-core'),
						'icon' => 'eicon-v-align-middle'
					],
					'end' => [
						'title' => __('Bottom', 'neuron-core'),
						'icon' => 'eicon-v-align-bottom'
					]
				],
				'separator' => 'before'
			]
		);

		$this->end_controls_section();

		/**
		 * Image
		 */
		$this->start_controls_section(
			'media_gallery_style_image',
			[
				'label' => __('Image', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'media_gallery_style_image_margin',
			[
				'label' => __('Margin', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery .m-media-gallery__item .o-neuron-hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'media_gallery_style_image_padding',
			[
				'label' => __('Padding', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery .m-media-gallery__item .o-neuron-hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after'
			]
		);

		$this->start_controls_tabs(
			'media_gallery_style_image_tabs'
		);

		$this->start_controls_tab(
			'media_gallery_style_image_normal_tab',
			[
				'label' => __('Normal', 'neuron-core')
			]
		);

		$this->add_control(
			'media_gallery_style_image_border_type',
			[
                'label' => __('Border Type', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'none' => __('None', 'neuron-core'),
                    'solid' => __('Solid', 'neuron-core'),
                    'double' => __('Double', 'neuron-core'),
                    'dotted' => __('Dotted', 'neuron-core'),
                    'dashed' => __('Dashed', 'neuron-core'),
                    'groove' => __('Groove', 'neuron-core')
				],
				'default' => 'none',
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery .m-media-gallery__item .o-neuron-hover .o-neuron-hover-holder' => 'border-style: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			'media_gallery_style_image_border_width',
			[
				'label' => __('Border Width', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'conditions' => [
					'terms' => [
						[
							'name' => 'media_gallery_style_image_border_type',
							'operator' => '!=',
							'value' => 'none',
						]
					]
				],
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery .m-media-gallery__item .o-neuron-hover .o-neuron-hover-holder' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
				],
			]
		);
		
		$this->add_control(
			'media_gallery_style_image_border_color',
			[
				'label' => __('Border Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'conditions' => [
					'terms' => [
						[
							'name' => 'media_gallery_style_image_border_type',
							'operator' => '!=',
							'value' => 'none',
						]
					]
				],
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery .m-media-gallery__item .o-neuron-hover .o-neuron-hover-holder' => 'border-color: {{VALUE}}'
				],
			]
		);

		$this->add_responsive_control(
			'media_gallery_style_image_border_radius',
			[
				'label' => __('Border Radius', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery .m-media-gallery__item .o-neuron-hover .o-neuron-hover-holder' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'media_gallery_style_image_box_shadow',
				'label' => __('Box Shadow', 'neuron-core'),
				'selector' => '{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery .m-media-gallery__item .o-neuron-hover .o-neuron-hover-holder',
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'media_gallery_style_image_hover_tab',
			[
				'label' => __('Hover', 'neuron-core')
			]
		);

		$this->add_control(
			'media_gallery_style_image_hover_border_type',
			[
                'label' => __('Border Type', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'none' => __('None', 'neuron-core'),
                    'solid' => __('Solid', 'neuron-core'),
                    'double' => __('Double', 'neuron-core'),
                    'dotted' => __('Dotted', 'neuron-core'),
                    'dashed' => __('Dashed', 'neuron-core'),
                    'groove' => __('Groove', 'neuron-core')
				],
				'default' => 'none',
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery .m-media-gallery__item .o-neuron-hover .o-neuron-hover-holder:hover' => 'border-style: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			'media_gallery_style_image_hover_border_width',
			[
				'label' => __('Border Width', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'conditions' => [
					'terms' => [
						[
							'name' => 'media_gallery_style_image_hover_border_type',
							'operator' => '!=',
							'value' => 'none',
						]
					]
				],
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery .m-media-gallery__item .o-neuron-hover .o-neuron-hover-holder:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
				],
			]
		);
		
		$this->add_control(
			'media_gallery_style_image_hover_border_color',
			[
				'label' => __('Border Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'conditions' => [
					'terms' => [
						[
							'name' => 'media_gallery_style_image_hover_border_type',
							'operator' => '!=',
							'value' => 'none',
						]
					]
				],
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery .m-media-gallery__item .o-neuron-hover .o-neuron-hover-holder:hover' => 'border-color: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			'media_gallery_style_image_hover_border_radius',
			[
				'label' => __('Border Radius', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery .m-media-gallery__item .o-neuron-hover .o-neuron-hover-holder:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'media_gallery_style_image_hover_box_shadow',
				'label' => __('Box Shadow', 'neuron-core'),
				'selector' => '{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery .m-media-gallery__item .o-neuron-hover .o-neuron-hover-holder:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Post Box
		 */
		$this->start_controls_section(
			'media_gallery_style_post_box',
			[
				'label' => __('Post Box', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'media_gallery_layout_model' => 'meta-outside'
				]
			]
		);

		$this->add_control(
			'media_gallery_style_post_box_border_type',
			[
                'label' => __('Border Type', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'none' => __('None', 'neuron-core'),
                    'solid' => __('Solid', 'neuron-core'),
                    'double' => __('Double', 'neuron-core'),
                    'dotted' => __('Dotted', 'neuron-core'),
                    'dashed' => __('Dashed', 'neuron-core'),
                    'groove' => __('Groove', 'neuron-core')
				],
				'default' => 'none',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item' => 'border-style: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			'media_gallery_style_post_box_border_width',
			[
				'label' => __('Border Width', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'conditions' => [
					'terms' => [
						[
							'name' => 'media_gallery_style_post_box_border_type',
							'operator' => '!=',
							'value' => 'none',
						]
					]
				],
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
				],
			]
		);
		
		$this->add_control(
			'media_gallery_style_post_box_border_color',
			[
				'label' => __('Border Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'conditions' => [
					'terms' => [
						[
							'name' => 'media_gallery_style_post_box_border_type',
							'operator' => '!=',
							'value' => 'none',
						]
					]
				],
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item' => 'border-color: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			'media_gallery_style_post_box_border_radius',
			[
				'label' => __('Border Radius', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'media_gallery_style_post_box_box_shadow',
				'label' => __('Box Shadow', 'neuron-core'),
				'selector' => '{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item',
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'media_gallery_style_meta_box',
			[
				'label' => __('Meta Box', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'media_gallery_layout_model' => 'meta-outside'
				]
			]
		);

		$this->add_responsive_control(
			'media_gallery_style_meta_box_margin',
			[
				'label' => __('Margin', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .m-media-gallery__item__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'media_gallery_style_meta_box_padding',
			[
				'label' => __('Padding', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .m-media-gallery__item__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'media_gallery_style_meta_box_background',
				'label' => __('Background', 'neuron-core'),
				'types' => ['classic', 'gradient'],
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .m-media-gallery__item__content'
			]
		);

		$this->add_control(
			'media_gallery_style_meta_box_border_type',
			[
                'label' => __('Border Type', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'none' => __('None', 'neuron-core'),
                    'solid' => __('Solid', 'neuron-core'),
                    'double' => __('Double', 'neuron-core'),
                    'dotted' => __('Dotted', 'neuron-core'),
                    'dashed' => __('Dashed', 'neuron-core'),
                    'groove' => __('Groove', 'neuron-core')
				],
				'default' => 'none',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .m-media-gallery__item__content' => 'border-style: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'media_gallery_style_meta_box_border_width',
			[
				'label' => __('Border Width', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'conditions' => [
					'terms' => [
						[
							'name' => 'media_gallery_style_meta_box_border_type',
							'operator' => '!=',
							'value' => 'none',
						]
					]
				],
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .m-media-gallery__item__content' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		
		$this->add_control(
			'media_gallery_style_meta_box_border_color',
			[
				'label' => __('Border Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'conditions' => [
					'terms' => [
						[
							'name' => 'media_gallery_style_meta_box_border_type',
							'operator' => '!=',
							'value' => 'none',
						]
					]
				],
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .m-media-gallery__item__content' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'media_gallery_style_meta_box_border_radius',
			[
				'label' => __('Border Radius', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .m-media-gallery__item__content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Icons
		 */
		$this->start_controls_section(
			'media_gallery_style_icons',
			[
				'label' => __('Icons', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE
			]
		);

		$this->start_controls_tabs(
			'media_gallery_style_pagination_button'
		);

		$this->start_controls_tab(
			'media_gallery_style_icons_normal_tab',
			[
				'label' => __('Normal', 'neuron-core')
			]
		);

		$this->add_control(
			'media_gallery_style_icons_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery .o-neuron-hover-holder__body-meta__social-media ul li a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery .o-neuron-hover-holder__body-meta__social-media ul li a:hover' => 'box-shadow: inset 0 0 0 rgba('. neuron_hexToRgb('{{VALUE}}') .', 0), 0 1px 0 {{VALUE}} !important'
				]
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'media_gallery_style_icons_hover_tab',
			[
				'label' => __('Hover', 'neuron-core')
			]
		);

		$this->add_control(
			'media_gallery_style_icons_hover_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery .o-neuron-hover-holder__body-meta__social-media ul li a:hover' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'media_gallery_style_icons_hover_underline',
			[
				'label' => __('Underline', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery .o-neuron-hover-holder__body-meta__social-media ul li a:hover' => '-webkit-box-shadow: inset 0 0 0 rgba(0, 166, 231, 0), 0 2px 0 {{VALUE}}; box-shadow: inset 0 0 0 rgba(0, 166, 231, 0), 0 2px 0 {{VALUE}}',
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'media_gallery_style_icons_size',
			[
                'label' => __('Size', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'rem', 'em'],
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery .o-neuron-hover-holder__body-meta__social-media ul li a' => 'font-size: {{SIZE}}{{UNIT}} !important'
				],
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'media_gallery_style_icons_spacing',
			[
				'label' => __('Spacing', 'neuron-core'),
				'size_units' => ['px', 'rem', 'em'],
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery .o-neuron-hover-holder__body-meta__social-media ul li' => 'margin-left: {{SIZE}}{{UNIT}}'
				]
			]
		);

		$this->add_control(
			'media_gallery_style_icons_alignment',
			[
				'label' => __('Alignment', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'neuron-core'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'neuron-core'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'neuron-core'),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery .o-neuron-hover-holder__body-meta__social-media ul' => 'text-align: {{VALUE}}'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Title
		 */
		$this->start_controls_section(
			'media_gallery_style_title',
			[
				'label' => __('Title', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'media_gallery_style_title_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .m-media-gallery__item__content__title' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .o-neuron-hover__body-meta__title' => 'color: {{VALUE}} !important'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'media_gallery_style_title_typography',
				'label' => __('Typography', 'neuron-core'),
				'selector' =>'
				{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .m-media-gallery__item__content__title, {{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .o-neuron-hover__body-meta__title'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'media_gallery_style_title_shadow',
				'label' => __('Text Shadow', 'neuron-core'),
				'selector' =>'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .m-media-gallery__item__content__title, {{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .o-neuron-hover__body-meta__title'
			]
		);

		$this->add_control(
			'media_gallery_style_title_alignment',
			[
				'label' => __('Alignment', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'neuron-core'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'neuron-core'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'neuron-core'),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .m-media-gallery__item__content__title' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .o-neuron-hover__body-meta__title' => 'text-align: {{VALUE}}'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Subitle
		 */
		$this->start_controls_section(
			'media_gallery_style_subtitle',
			[
				'label' => __('Subtitle', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'media_gallery_style_subtitle_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .m-media-gallery__item__content__subtitle' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .o-neuron-hover__body-meta__subtitle' => 'color: {{VALUE}} !important'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'media_gallery_style_subtitle_typography',
				'label' => __('Typography', 'neuron-core'),
				'selector' =>'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .m-media-gallery__item__content__subtitle, {{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .o-neuron-hover__body-meta__subtitle'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'media_gallery_style_subtitle_shadow',
				'label' => __('Text Shadow', 'neuron-core'),
				'selector' => '{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .m-media-gallery__item__content__subtitle, {{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .o-neuron-hover__body-meta__subtitle'
			]
		);

		$this->add_control(
			'media_gallery_style_subtitle_alignment',
			[
				'label' => __('Alignment', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'neuron-core'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'neuron-core'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'neuron-core'),
						'icon' => 'fa fa-align-right',
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .m-media-gallery__item__content__subtitle' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .o-neuron-hover__body-meta__subtitle' => 'text-align: {{VALUE}}'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Description
		 */
		$this->start_controls_section(
			'media_gallery_style_description',
			[
				'label' => __('Description', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'media_gallery_layout_model' => 'meta-outside'
				]
			]
		);

		$this->add_control(
			'media_gallery_style_description_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .m-media-gallery__item__content__description' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'media_gallery_style_description_typography',
				'label' => __('Typography', 'neuron-core'),
				'selector' =>'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .m-media-gallery__item__content__description'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'media_gallery_style_description_shadow',
				'label' => __('Text Shadow', 'neuron-core'),
				'selector' =>'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .m-media-gallery__item__content__description'
			]
		);

		$this->add_control(
			'media_gallery_style_description_alignment',
			[
				'label' => __('Alignment', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'neuron-core'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'neuron-core'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'neuron-core'),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .l-media-gallery-wrapper .m-media-gallery__item .m-media-gallery__item__content__description' => 'text-align: {{VALUE}}',
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Filters
		 */
		$this->start_controls_section(
			'media_gallery_style_filters',
			[
				'label' => __('Filters', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'media_gallery_layout',
							'operator' => '==',
							'value' => 'isotope'
						],
						[
							'name' => 'media_gallery_filters_visibility',
							'operator' => '==',
							'value' => 'yes'
						]
					]
				]
			]
		);

		$this->add_control(
			'media_gallery_style_filters_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .m-filters ul li a' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'media_gallery_style_filters_hover_color',
			[
				'label' => __('Hover & Active', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .m-filters ul li.active a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .m-filters ul li:hover a' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'media_gallery_style_filters_typography',
				'label' => __('Typography', 'neuron-core'),
				'selector' => '{{WRAPPER}} .m-filters ul li a'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'media_gallery_style_filters_shadow',
				'label' => __('Text Shadow', 'neuron-core'),
				'selector' => '{{WRAPPER}} .m-filters ul li a'
			]
		);

		$this->add_responsive_control(
			'media_gallery_style_filters_spacing',
			[
				'label' => __('Spacing', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['vw', 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .m-filters ul li' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'media_gallery_style_filters_alignment',
			[
				'label' => __('Alignment', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'neuron-core'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'neuron-core'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'neuron-core'),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'left'
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		/**
		 * Query
		 */
		$neuron_gallery_media_query = $settings['media_gallery_layout_type'] == 'metro' ? $settings['media_gallery_query_metro'] : $settings['media_gallery_query_normal'];

		/**
		 * Layout Model
		 */
		$neuron_media_gallery_class = ['m-media-gallery'];
		if ($settings['media_gallery_layout_model']) {
			$neuron_media_gallery_class[] = 'm-media-gallery--' . $settings['media_gallery_layout_model'];
		}

		if ($neuron_gallery_media_query) :
	?>
		<div class="l-media-gallery-wrapper">
			<?php $settings['media_gallery_layout'] != 'carousel' ? include(__DIR__ . '/templates/filters.php')  : '' ?>
			<div class="<?php echo esc_attr(implode(' ', $neuron_media_gallery_class)) ?>">
				<?php 
				/**
				 * Layout Type
				 */
				if ($settings['media_gallery_layout'] == 'isotope') {
					include(__DIR__ . '/layout/layout-isotope.php');
				} else {
					include(__DIR__ . '/layout/layout-carousel.php');
				}
				?>
			</div>
        </div>
        <?php
		endif; wp_reset_postdata();
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _content_template() {}
}
