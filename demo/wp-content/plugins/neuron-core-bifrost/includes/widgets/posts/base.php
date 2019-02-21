<?php
namespace NeuronElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.0.0
 */
class NeuronPosts extends Widget_Base {

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
		return 'neuron-posts';
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
		return __('Posts', 'neuron-core');
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
		return 'eicon-gallery-grid neuron-badge';
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
			'posts_functionality',
			[
				'label' => __('Functionality', 'neuron-core')
			]
        );

        $this->add_control(
			'posts_type',
			[
                'label' => __('Post Type', 'neuron-core'),
                'description' => __('Select the post type that you want to get on your isotope grid or carousel slider.', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'post' => __('Post', 'neuron-core'),
                    'portfolio' => __('Portfolio', 'neuron-core'),
                    'product' => __('Product', 'neuron-core')
				],
				'default' => 'post'
			]
        );
        
        $this->add_control(
			'posts_layout',
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
			'posts_layout_type',
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
				'condition' => [
					'posts_layout' => 'isotope'
				]
			]
		);

        $this->add_control(
			'posts_layout_model',
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

		
		/**
		 * Categories
		 * 
		 * Get all categories and 
		 * display them in a select, it's up 
		 * to the post type to change this category
         */
		$post_categories = $portfolio_categories = $product_categories = [];
		
		$post_terms = get_terms('category');
		if ($post_terms && !is_wp_error($post_terms)) {
			foreach ($post_terms as $term) {
				$post_categories[$term->slug] = $term->name;    
			}
		}

		$portfolio_terms = get_terms('portfolio_category');
		if ($portfolio_terms && !is_wp_error($portfolio_terms)) {
			foreach ($portfolio_terms as $term) {
				$portfolio_categories[$term->slug] = $term->name;    
			}
		}

		$product_terms = get_terms('product_cat');
		if ($product_terms && !is_wp_error($product_terms)) {
			foreach ($product_terms as $term) {
				$product_categories[$term->slug] = $term->name;    
			}
		}

		/**
		 * Posts
		 */
		$portfolio_posts = get_posts(['post_type' => 'portfolio', 'posts_per_page' => -1]);
        $portfolio_posts_output = [];
        if ($portfolio_posts) {
            foreach ($portfolio_posts as $portfolio) {
                $portfolio_posts_output[$portfolio->ID] = $portfolio->post_title;
            }
		}

        $products = get_posts(['post_type' => 'product', 'posts_per_page' => -1]);
        $shop_products_output = [];
        if ($products) {
            foreach ($products as $shop) {
                $shop_products_output[$shop->ID] = $shop->post_title;
            }
		}

		$blog_posts = get_posts(['post_type' => 'post', 'posts_per_page' => -1]);
        $blog_posts_output = [];
        if ($blog_posts) {
            foreach ($blog_posts as $blog) {
                $blog_posts_output[$blog->ID] = $blog->post_title;
            }
		}

		/**
		 * Normal Query
		 */
		$this->add_control(
			'posts_query_normal_post',
			[
				'label' => __('Query', 'neuron-core'),
				'description' => __('Select the categories you want to get the posts from. <br /> <small> Note: If no category is selected all posts will be displayed.</small>', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => $post_categories,
				'multiple' => true,
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'post',
						],
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'posts_layout',
									'operator' => '==',
									'value' => 'carousel'
								], 
								[
									'name' => 'posts_layout_type',
									'operator' => '!==',
									'value' => 'metro',
								],
							]
						]
					],
				]
			]
		);

		$this->add_control(
			'posts_query_normal_portfolio',
			[
				'label' => __('Query', 'neuron-core'),
				'description' => __('Select the categories you want to get the posts from. <br /> <small> Note: If no category is selected all posts will be displayed.</small>', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => $portfolio_categories,
				'multiple' => true,
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'portfolio',
						],
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'posts_layout',
									'operator' => '==',
									'value' => 'carousel'
								], 
								[
									'name' => 'posts_layout_type',
									'operator' => '!==',
									'value' => 'metro',
								],
							]
						]
					],
				]
			]
		);

		$this->add_control(
			'posts_query_normal_product',
			[
				'label' => __('Query', 'neuron-core'),
				'description' => __('Select the categories you want to get the posts from. <br /> <small> Note: If no category is selected all posts will be displayed.</small>', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => $product_categories,
				'multiple' => true,
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'product',
						],
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'posts_layout',
									'operator' => '==',
									'value' => 'carousel'
								], 
								[
									'name' => 'posts_layout_type',
									'operator' => '!==',
									'value' => 'metro',
								],
							]
						]
					],
				]
			]
		);

		/**
		 * Metro Query
		 */
		$this->add_control(
            'posts_query_metro_post',
            [
                'label' => __('Query', 'neuron-core'),
                'description' => __('Select the posts you want to show in metro. <br /><small>Note: Do not select the same item two times, it may cause issues.</small>', 'neuron-core'),
				'prevent_empty' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'post_id',
                        'label' => __('Post', 'neuron-core'),
                        'description' => __('Select the post.', 'neuron-core'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => $blog_posts_output
                    ],
                    [
                        'name' => 'post_column',
                        'label' => __('Column', 'neuron-core'),
                        'description' => __('Select the post column.', 'neuron-core'),
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
				],
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'post',
						],
						[
							'name' => 'posts_layout',
							'operator' => '==',
							'value' => 'isotope',
						],
						[
							'name' => 'posts_layout_type',
							'operator' => '==',
							'value' => 'metro',
						],
					],
				]
            ]
		);

		$this->add_control(
            'posts_query_metro_portfolio',
            [
                'label' => __('Query', 'neuron-core'),
                'description' => __('Select the posts you want to show in metro. <br /><small>Note: Do not select the same item two times, it may cause issues.</small>', 'neuron-core'),
				'prevent_empty' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'post_id',
                        'label' => __('Post', 'neuron-core'),
                        'description' => __('Select the post.', 'neuron-core'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => $portfolio_posts_output
                    ],
                    [
                        'name' => 'post_column',
                        'label' => __('Column', 'neuron-core'),
                        'description' => __('Select the post column.', 'neuron-core'),
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
				],
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'portfolio',
						],
						[
							'name' => 'posts_layout',
							'operator' => '==',
							'value' => 'isotope',
						],
						[
							'name' => 'posts_layout_type',
							'operator' => '==',
							'value' => 'metro',
						],
					],
				]
            ]
		);

		$this->add_control(
            'posts_query_metro_product',
            [
                'label' => __('Query', 'neuron-core'),
                'description' => __('Select the posts you want to show in metro. <br /><small>Note: Do not select the same item two times, it may cause issues.</small>', 'neuron-core'),
				'prevent_empty' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'post_id',
                        'label' => __('Post', 'neuron-core'),
                        'description' => __('Select the post.', 'neuron-core'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => $shop_products_output
                    ],
                    [
                        'name' => 'post_column',
                        'label' => __('Column', 'neuron-core'),
                        'description' => __('Select the post column.', 'neuron-core'),
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
				],
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'product',
						],
						[
							'name' => 'posts_layout',
							'operator' => '==',
							'value' => 'isotope',
						],
						[
							'name' => 'posts_layout_type',
							'operator' => '==',
							'value' => 'metro',
						],
					],
				]
            ]
		);


		$this->add_control(
			'posts_ppp',
			[
				'label'   => __('Posts Per Page', 'neuron-core'),
				'description' => __('Enter the number of posts you want to display on the first page, a pagination will be created if there are more posts than this number.', 'neuron-core'),
				'type'    => Controls_Manager::NUMBER,
				'default' => 10,
				'min'     => 1,
				'max'     => 10000,
				'step'    => 1
			]
		);

        $this->end_controls_section();
        
        $this->start_controls_section(
			'posts_style_layout',
			[
				'label' => __('Layout', 'neuron-core')
			]
		);
		
		$this->add_control(
			'posts_columns',
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
					'terms' => [
						[
							'name' => 'posts_layout',
							'operator' => '==',
							'value' => 'isotope',
						],
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'posts_layout',
									'operator' => '==',
									'value' => 'carousel'
								], 
								[
									'name' => 'posts_layout_type',
									'operator' => '!==',
									'value' => 'metro',
								],
							]
						]
					],
				]
			]
		);

		$this->add_control(
			'posts_animation',
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
			'posts_spacing',
			[
                'label' => __('Spacing', 'neuron-core'),
                'description' => __('Move the slider to set the value of spacing. <br /><small>Note: The value is represented in pixels.</small>', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'condition' => [
					'posts_layout' => 'isotope'
				],
				'size_units' => ['px', 'rem'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .masonry' => 'margin-left: calc(-{{SIZE}}{{UNIT}} / 2); margin-right: calc(-{{SIZE}}{{UNIT}} / 2)',
					'{{WRAPPER}} .masonry .selector' => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2)',
					'{{WRAPPER}} .masonry .selector .o-post' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'render_type' => 'template'
			]
		);

        $this->end_controls_section();
        
        $this->start_controls_section(
			'posts_meta',
			[
				'label' => __('Meta', 'neuron-core')
			]
		);
		
		$this->add_control(
			'posts_meta_thumbnail',
			[
				'label' => __('Thumbnail', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'posts_layout_model' => 'meta-outside'
				]
			]
		);

		$this->add_control(
			'posts_meta_title',
			[
				'label' => __('Title', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes'
			]
		);

		$this->add_control(
			'posts_meta_date',
			[
				'label' => __('Date', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes',
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'post'
						], 
						[
							'name' => 'posts_layout_model',
							'operator' => '==',
							'value' => 'meta-outside'
						], 
					],
				]
			]
		);

		$this->add_control(
			'posts_meta_categories',
			[
				'label' => __('Categories', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes',
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '!=',
							'value' => 'product'
						], 
					],
				]
			]
		);

		$this->add_control(
			'posts_meta_tags',
			[
				'label' => __('Tags', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes',
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'post'
						], 
						[
							'name' => 'posts_layout_model',
							'operator' => '==',
							'value' => 'meta-outside'
						], 
					],
				]
			]
		);

		$this->add_control(
			'posts_meta_excerpt',
			[
				'label' => __('Excerpt', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes',
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'post'
						], 
						[
							'name' => 'posts_layout_model',
							'operator' => '==',
							'value' => 'meta-outside'
						], 
					],
				]
			]
		);

		$this->add_control(
			'posts_meta_author',
			[
				'label' => __('Author', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes',
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'post'
						], 
						[
							'name' => 'posts_layout_model',
							'operator' => '==',
							'value' => 'meta-outside'
						], 
					],
				]
			]
		);

		$this->add_control(
			'posts_meta_price',
			[
				'label' => __('Price', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'posts_type' => 'product'
				]
			]
		);

		$this->add_control(
			'posts_meta_results_count',
			[
				'label' => __('Results Count', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'posts_type' => 'product'
				]
			]
		);

		$this->add_control(
			'posts_meta_catalog_ordering',
			[
				'label' => __('Catalog Ordering', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'posts_type' => 'product'
				]
			]
		);

		$this->add_control(
			'posts_meta_ordering_default',
			[
				'label' => __('Default Order', 'neuron-core'),
				'description' => __('Select which order you want to set default.', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'menu_order' => esc_attr__('Default sorting', 'neuron-core'),
					'popularity' => esc_attr__('Sort by popularity', 'neuron-core'),
					'rating' => esc_attr__('Sort by average rating', 'neuron-core'),
					'date' => esc_attr__('Sort by newness', 'neuron-core'),
					'price' => esc_attr__('Sort by price: low to high', 'neuron-core'),
					'price-desc' => esc_attr__('Sort by price: high to low', 'neuron-core')
				],
				'default' => 'menu_order',
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'product'
						], 
					],
				]
			]
		);

        $this->end_controls_section();
        
        $this->start_controls_section(
			'posts_carousel',
			[
				'label' => __('Carousel', 'neuron-core'),
				'condition' => [
					'posts_layout' => 'carousel'
				]
			]
		);
		
		$this->add_responsive_control(
			'posts_carousel_items',
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
			'posts_carousel_margin',
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
			'posts_carousel_height',
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
			'posts_carousel_custom_height',
			[
				'label' => __('Custom Height', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['vh', 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .l-posts-wrapper .owl-stage .owl-item .h-full-height-image' => 'height: {{SIZE}}{{UNIT}};',
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
					'posts_carousel_height' => 'full'
				]
			]
		);

		$this->add_control(
			'posts_carousel_loop',
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
			'posts_carousel_mouse_drag',
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
			'posts_carousel_touch_drag',
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
			'posts_carousel_navigation',
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
			'posts_carousel_dots',
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
			'posts_carousel_autoplay',
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
			'posts_carousel_pause',
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
			'posts_carousel_stage_padding',
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
			'posts_carousel_start_position',
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
			'posts_carousel_autoplay_timeout',
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
			'posts_carousel_smart_speed',
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
			'posts_filters',
			[
				'label' => __('Filters', 'neuron-core'),
				'condition' => [
					'posts_layout' => 'isotope',
				]
			]
		);
		
		$this->add_control(
			'posts_filters_visibility',
			[
				'label' => __('Filters', 'neuron-core'),
				'description' => __('Show the categories as filters. Make sure to add the categories in the query field.'), 
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'posts_filters_query_post',
			[
				'label' => __('Filters Query', 'neuron-core'),
				'description' => __('Select the categories you want to display as filters. <br /> <small>Note: This option does not affect the query, is created only to display filters on metro layout type.</small>', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => $post_categories,
				'multiple' => true,
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'post',
						],
						[
							'name' => 'posts_layout_type',
							'operator' => '==',
							'value' => 'metro',
						],
						[
							'name' => 'posts_filters_visibility',
							'operator' => '==',
							'value' => 'yes'
						]
					],
				]
			]
		);

		$this->add_control(
			'posts_filters_query_portfolio',
			[
				'label' => __('Filters Query', 'neuron-core'),
				'description' => __('Select the categories you want to display as filters. <br /> <small>Note: This option does not affect the query, is created only to display filters on metro layout type.</small>', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => $portfolio_categories,
				'multiple' => true,
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'portfolio',
						],
						[
							'name' => 'posts_layout_type',
							'operator' => '==',
							'value' => 'metro',
						],
						[
							'name' => 'posts_filters_visibility',
							'operator' => '==',
							'value' => 'yes'
						]
					],
				]
			]
		);

		$this->add_control(
			'posts_filters_query_product',
			[
				'label' => __('Filters Query', 'neuron-core'),
				'description' => __('Select the categories you want to display as filters. <br /> <small>Note: This option does not affect the query, is created only to display filters on metro layout type.</small>', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => $product_categories,
				'multiple' => true,
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'product',
						],
						[
							'name' => 'posts_layout_type',
							'operator' => '==',
							'value' => 'metro',
						],
						[
							'name' => 'posts_filters_visibility',
							'operator' => '==',
							'value' => 'yes'
						]
					],
				]
			]
		);

		$this->add_control(
			'posts_filters_filter_all',
			[
				'label' => __('Show All Filter', 'neuron-core'),
				'description' => __('Show a filter which is able to filter all posts.'), 
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'posts_filters_visibility' => 'yes'
				]
			]
		);

		 $this->add_control(
			'posts_filters_filter_all_string',
			[
				'label'   => __('String', 'neuron-core'),
				'description' => __('Override the filter \'Show All\'.', 'neuron-core'),
                'type'    => Controls_Manager::TEXT,
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'posts_filters_visibility',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'posts_filters_filter_all',
							'operator' => '==',
							'value' => 'yes'
						], 
					],
				]
			]
		);
		
        $this->end_controls_section();
        
        $this->start_controls_section(
			'posts_pagination',
			[
				'label' => __('Pagination', 'neuron-core'),
				'condition' => [
					'posts_layout' => 'isotope',
				]
			]
		);
		
		$this->add_control(
			'posts_pagination_visibility',
			[
				'label' => __('Pagination Visibility', 'neuron-core'),
				'description' => __('Select the visibility of pagination.', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'posts_pagination_style',
			[
				'label' => __('Pagination Style', 'neuron-core'),
				'description' => __('Select the pagination style, normal is with numbers and arrows and Show More is with button. ', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'normal' => esc_attr__('Normal (Links)', 'neuron-core'),
					'show-more' => esc_attr__('Show More (Ajax)', 'neuron-core'),
				],
				'default' => 'normal',
				'condition' => [
					'posts_pagination_visibility' => 'yes',
				]
			]
		);

        $this->end_controls_section();
        
        $this->start_controls_section(
			'posts_thumbnail',
			[
				'label' => __('Thumbnail', 'neuron-core'),
				'condition' => [
					'posts_meta_thumbnail' => 'yes'
				]
			]
		);
		
		$this->add_control(
			'posts_thumbnail_resizer',
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
				'name' => 'posts_thumbnail_sizes', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'label' => __('Thumbnail Sizes', 'neuron-core'),
				'description' => __('Select the thumbnail size.', 'neuron-core'),
				'default' => 'large',
				'condition' => [
					'posts_thumbnail_resizer' => 'yes'
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
			'posts_style_hover',
			[
				'label' => __('Hover', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_meta_thumbnail',
							'operator' => '==',
							'value' => 'yes'
						],
					]
				]
			]
		);

		$this->add_control(
			'posts_hover_visibility',
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
			'posts_hover_animation',
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
					'posts_hover_visibility' => 'show'
				]
			]
		);

		$this->add_control(
			'posts_style_hover_active',
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
				'name' => 'posts_style_hover_background_type',
				'label' => __('Background', 'neuron-core'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .l-posts-wrapper .o-neuron-hover .o-neuron-hover-holder .o-neuron-hover-holder__header__overlay'
			]
		);

		$this->add_control(
			'posts_style_hover_meta_vertical_alignment',
			[
				'label' => __('Meta Vertical Alignment', 'neuron-core'),
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
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_layout_model',
							'operator' => '==',
							'value' => 'meta-inside'
						]
					]
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'posts_style_hover_icon',
			[
				'label' => __('Icon', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'posts_layout_model',
							'operator' => '==',
							'value' => 'meta-outside'
						],
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'product'
						]
					],
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'posts_style_hover_icon_vertical_alignment',
			[
				'label' => __('Vertical Alignment', 'neuron-core'),
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
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_style_hover_icon',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'posts_layout_model',
									'operator' => '==',
									'value' => 'meta-outside'
								],
								[
									'name' => 'posts_type',
									'operator' => '==',
									'value' => 'product'
								]
							],
						]
					]
				]
			]
		);

		$this->add_control(
			'posts_style_hover_icon_horizontal_alignment',
			[
				'label' => __('Horizontal Alignment', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => __('Left', 'neuron-core'),
						'icon' => 'eicon-h-align-left'
					],
					'center' => [
						'title' => __('Center', 'neuron-core'),
						'icon' => 'eicon-h-align-center'
					],
					'end' => [
						'title' => __('Right', 'neuron-core'),
						'icon' => 'eicon-h-align-right'
					],
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_style_hover_icon',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'posts_layout_model',
									'operator' => '==',
									'value' => 'meta-outside'
								],
								[
									'name' => 'posts_type',
									'operator' => '==',
									'value' => 'product'
								]
							],
						]
					]
				]
			]
		);

		$this->start_controls_tabs(
			'posts_style_hover_icon_tabs'
		);

		$this->start_controls_tab(
			'posts_style_hover_icon_tabs_normal',
			[
				'label' => __('Normal', 'neuron-core'),
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_style_hover_icon',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'product'
						]
					]	
				]
			]
		);

		$this->add_control(
			'posts_style_hover_icon_color',
			[
				'label' => __('Icon Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .l-posts-wrapper .o-neuron-hover.o-neuron-hover--icon .o-neuron-hover-holder .o-neuron-hover-holder__body .o-neuron-hover-holder__body-meta svg' => 'stroke: {{VALUE}}',
					'{{WRAPPER}} .l-woocommerce-wrapper .product-holder .l-woocommerce-wrapper__product .o-neuron-hover-holder .o-neuron-hover-holder__button svg' => 'stroke: {{VALUE}}'
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_style_hover_icon',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'posts_layout_model',
									'operator' => '==',
									'value' => 'meta-outside'
								],
								[
									'name' => 'posts_type',
									'operator' => '==',
									'value' => 'product'
								]
							],
						]
					]
				]
			]
		);

		$this->add_control(
			'posts_style_hover_icon_background_color',
			[
				'label' => __('Icon Background Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .l-woocommerce-wrapper .product-holder .l-woocommerce-wrapper__product .o-neuron-hover-holder .o-neuron-hover-holder__button' => 'background-color: {{VALUE}}'
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_style_hover_icon',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'product'
						]
					]	
				]
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'posts_style_hover_icon_tabs_hover',
			[
				'label' => __('Hover', 'neuron-core'),
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_style_hover_icon',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'product'
						]
					]	
				]
			]
		);

		$this->add_control(
			'posts_style_hover_icon_hover_color',
			[
				'label' => __('Icon Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .l-woocommerce-wrapper .product-holder .l-woocommerce-wrapper__product .o-neuron-hover-holder .o-neuron-hover-holder__button:hover svg' => 'stroke: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_style_hover_icon',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'product'
						]
					]	
				]
			]
		);

		$this->add_control(
			'posts_style_hover_icon_background_hover_color',
			[
				'label' => __('Icon Background Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .l-woocommerce-wrapper .product-holder .l-woocommerce-wrapper__product .o-neuron-hover-holder .o-neuron-hover-holder__button:hover' => 'background-color: {{VALUE}}'
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_style_hover_icon',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'product'
						]
					]	
				]
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'posts_style_post_box',
			[
				'label' => __('Post Box', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'posts_layout_model' => 'meta-outside'
				]
			]
		);

		$this->add_control(
			'posts_style_post_box_border_type',
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
					'{{WRAPPER}} .l-posts-wrapper .o-post' => 'border-style: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			'posts_style_post_box_border_width',
			[
				'label' => __('Border Width', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_style_post_box_border_type',
							'operator' => '!=',
							'value' => 'none',
						]
					]
				],
				'selectors' => [
					'{{WRAPPER}} .l-posts-wrapper .o-post' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
				],
			]
		);
		
		$this->add_control(
			'posts_style_post_box_border_color',
			[
				'label' => __('Border Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_style_post_box_border_type',
							'operator' => '!=',
							'value' => 'none',
						]
					]
				],
				'selectors' => [
					'{{WRAPPER}} .l-posts-wrapper .o-post' => 'border-color: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			'posts_style_post_box_border_radius',
			[
				'label' => __('Border Radius', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .l-posts-wrapper .o-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'posts_style_post_box_box_shadow',
				'label' => __('Box Shadow', 'neuron-core'),
				'selector' => '{{WRAPPER}} .l-posts-wrapper .o-post',
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'posts_style_meta_box',
			[
				'label' => __('Meta Box', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'posts_layout_model' => 'meta-outside'
				]
			]
		);

		$this->add_responsive_control(
			'posts_style_meta_box_margin',
			[
				'label' => __('Margin', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}} .l-posts-wrapper .o-post .o-blog-post__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .l-posts-wrapper .o-post .o-portfolio-item__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .l-posts-wrapper .o-post .o-neuron-hover__body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'posts_style_meta_box_padding',
			[
				'label' => __('Padding', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}} .l-posts-wrapper .o-post .o-blog-post__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .l-posts-wrapper .o-post .o-portfolio-item__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .l-posts-wrapper .o-post .o-neuron-hover__body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'posts_style_meta_box_background',
				'label' => __('Background', 'neuron-core'),
				'types' => ['classic', 'gradient'],
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .l-posts-wrapper .o-post .o-blog-post__content, {{WRAPPER}} .l-posts-wrapper .o-post .o-portfolio-item__content, {{WRAPPER}} .l-posts-wrapper .o-post .o-neuron-hover__body'
			]
		);

		$this->add_control(
			'posts_style_meta_box_border_type',
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
					'{{WRAPPER}} .l-posts-wrapper .o-post .o-blog-post__content' => 'border-style: {{VALUE}}',
					'{{WRAPPER}} .l-posts-wrapper .o-post .o-portfolio-item__content' => 'border-style: {{VALUE}}',
					'{{WRAPPER}} .l-posts-wrapper .o-post .o-neuron-hover__body' => 'border-style: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			'posts_style_meta_box_border_width',
			[
				'label' => __('Border Width', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_style_meta_box_border_type',
							'operator' => '!=',
							'value' => 'none',
						]
					]
				],
				'selectors' => [
					'{{WRAPPER}} .l-posts-wrapper .o-post .o-blog-post__content' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .l-posts-wrapper .o-post .o-portfolio-item__content' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .l-posts-wrapper .o-post .o-neuron-hover__body' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
				],
			]
		);
		
		$this->add_control(
			'posts_style_meta_box_border_color',
			[
				'label' => __('Border Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_style_meta_box_border_type',
							'operator' => '!=',
							'value' => 'none',
						]
					]
				],
				'selectors' => [
					'{{WRAPPER}} .l-posts-wrapper .o-post .o-blog-post__content' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .l-posts-wrapper .o-post .o-portfolio-item__content' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .l-posts-wrapper .o-post .o-neuron-hover__body' => 'border-color: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			'posts_style_meta_box_border_radius',
			[
				'label' => __('Border Radius', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .l-posts-wrapper .o-post .o-blog-post__content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .l-posts-wrapper .o-post .o-portfolio-item__content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .l-posts-wrapper .o-post .o-neuron-hover__body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Title
		 */
		$this->start_controls_section(
			'posts_style_title',
			[
				'label' => __('Title', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'posts_meta_title' => 'yes'
				]
			]
		);

		$this->add_control(
			'posts_style_title_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-neuron-hover-holder__body-meta__title a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-neuron-hover-holder__body-meta__title a:hover' => 'box-shadow: inset 0 0 0 rgba('. neuron_hexToRgb('{{VALUE}}') .', 0), 0 1px 0 {{VALUE}} !important',
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post .o-blog-post__title a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post .o-blog-post__title a:hover' => 'box-shadow: inset 0 0 0 rgba('. neuron_hexToRgb('{{VALUE}}') .', 0), 0 1px 0 {{VALUE}} !important',
					'{{WRAPPER}} .l-portfolio-wrapper .l-portfolio-wrapper__items-holder .o-neuron-hover-holder__body-meta__title a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .l-portfolio-wrapper .l-portfolio-wrapper__items-holder .o-neuron-hover-holder__body-meta__title a:hover' => 'box-shadow: inset 0 0 0 rgba('. neuron_hexToRgb('{{VALUE}}') .', 0), 0 1px 0 {{VALUE}} !important',
					'{{WRAPPER}} .l-portfolio-wrapper .l-portfolio-wrapper__items-holder .o-portfolio-item__title a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .l-portfolio-wrapper .l-portfolio-wrapper__items-holder .o-portfolio-item__title a:hover' => 'box-shadow: inset 0 0 0 rgba('. neuron_hexToRgb('{{VALUE}}') .', 0), 0 1px 0 {{VALUE}} !important',
					'{{WRAPPER}} .l-woocommerce-wrapper .l-woocommerce-wrapper__products-holder .o-neuron-hover-holder__body-meta__title a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .l-woocommerce-wrapper .l-woocommerce-wrapper__products-holder .o-neuron-hover-holder__body-meta__title a:hover' => 'box-shadow: inset 0 0 0 rgba('. neuron_hexToRgb('{{VALUE}}') .', 0), 0 1px 0 {{VALUE}} !important',
					'{{WRAPPER}} .l-woocommerce-wrapper .l-woocommerce-wrapper__products-holder .o-neuron-hover__body-meta__title a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .l-woocommerce-wrapper .l-woocommerce-wrapper__products-holder .o-neuron-hover__body-meta__title a:hover' => 'box-shadow: inset 0 0 0 rgba('. neuron_hexToRgb('{{VALUE}}') .', 0), 0 1px 0 {{VALUE}} !important'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'posts_style_title_typography',
				'label' => __('Typography', 'neuron-core'),
				'selector' =>'
				{{WRAPPER}} .l-woocommerce-wrapper .l-woocommerce-wrapper__products-holder .o-neuron-hover-holder__body-meta__title a, 
				{{WRAPPER}} .l-woocommerce-wrapper .l-woocommerce-wrapper__products-holder .o-neuron-hover__body-meta__title a, 
				{{WRAPPER}} .l-portfolio-wrapper .l-portfolio-wrapper__items-holder .o-neuron-hover-holder__body-meta__title a, 
				{{WRAPPER}} .l-portfolio-wrapper .l-portfolio-wrapper__items-holder .o-portfolio-item__title a, 
				{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-neuron-hover-holder__body-meta__title a, 
				{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post .o-blog-post__title a'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'posts_style_title_shadow',
				'label' => __('Text Shadow', 'neuron-core'),
				'selector' =>'{{WRAPPER}} .l-woocommerce-wrapper .l-woocommerce-wrapper__products-holder .o-neuron-hover-holder__body-meta__title a, {{WRAPPER}} .l-woocommerce-wrapper .l-woocommerce-wrapper__products-holder .o-neuron-hover__body-meta__title a, {{WRAPPER}} .l-portfolio-wrapper .l-portfolio-wrapper__items-holder .o-neuron-hover-holder__body-meta__title a, {{WRAPPER}} .l-portfolio-wrapper .l-portfolio-wrapper__items-holder .o-portfolio-item__title a, {{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-neuron-hover-holder__body-meta__title a, {{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post .o-blog-post__title a'
			]
		);

		$this->add_control(
			'posts_style_title_alignment',
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
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-neuron-hover-holder__body-meta__title' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post .o-blog-post__title' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .l-portfolio-wrapper .l-portfolio-wrapper__items-holder .o-neuron-hover-holder__body-meta__title' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .l-portfolio-wrapper .l-portfolio-wrapper__items-holder .o-portfolio-item__title' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .l-woocommerce-wrapper .l-woocommerce-wrapper__products-holder .o-neuron-hover-holder__body-meta__title' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .l-woocommerce-wrapper .l-woocommerce-wrapper__products-holder .o-neuron-hover__body-meta__title' => 'text-align: {{VALUE}}'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Meta
		 */
		$this->start_controls_section(
			'posts_style_meta',
			[
				'label' => __('Meta', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '!=',
							'value' => 'product'
						],
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'posts_meta_categories',
									'operator' => '==',
									'value' => 'yes'
								], 
								[
									'relation' => 'and',
									'terms' => [
										[
											'name' => 'posts_meta_date',
											'operator' => '==',
											'value' => 'yes'
										],
										[
											'name' => 'posts_type',
											'operator' => '==',
											'value' => 'post'
										]
									]
								],
								[
									'relation' => 'and',
									'terms' => [
										[
											'name' => 'posts_meta_tags',
											'operator' => '==',
											'value' => 'yes'
										],
										[
											'name' => 'posts_type',
											'operator' => '==',
											'value' => 'post'
										]
									]
								]
							]
						]
					],
				]
			]
		);

		$this->add_control(
			'posts_style_meta_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post__meta .o-blog-post__time' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post__meta .o-blog-post__category ul li a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post__meta .o-blog-post__category ul li a:hover' => 'box-shadow: inset 0 0 0 rgba('. neuron_hexToRgb('{{VALUE}}') .', 0), 0 1px 0 {{VALUE}} !important',
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post__meta .o-blog-post__tags ul li a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post__meta .o-blog-post__tags ul li a:hover' => 'box-shadow: inset 0 0 0 rgba('. neuron_hexToRgb('{{VALUE}}') .', 0), 0 1px 0 {{VALUE}} !important',
					'{{WRAPPER}} .l-portfolio-wrapper .l-portfolio-wrapper__items-holder .o-portfolio-item__category ul li a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .l-portfolio-wrapper .l-portfolio-wrapper__items-holder .o-portfolio-item__category ul li a:hover' => 'box-shadow: inset 0 0 0 rgba('. neuron_hexToRgb('{{VALUE}}') .', 0), 0 1px 0 {{VALUE}} !important'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'posts_style_meta_typography',
				'label' => __('Typography', 'neuron-core'),
				'selector' =>'
				{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post__meta .o-blog-post__time,
				{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post__meta .o-blog-post__category ul li a,
				{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post__meta .o-blog-post__tags ul li a,
				{{WRAPPER}} .l-portfolio-wrapper .l-portfolio-wrapper__items-holder .o-portfolio-item__category ul li a
				'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'posts_style_meta_shadow',
				'label' => __('Text Shadow', 'neuron-core'),
				'selector' => '
				{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post__meta .o-blog-post__time,
				{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post__meta .o-blog-post__category ul li a,
				{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post__meta .o-blog-post__tags ul li a,
				{{WRAPPER}} .l-portfolio-wrapper .l-portfolio-wrapper__items-holder .o-portfolio-item__category ul li a
				'
			]
		);

		$this->add_control(
			'posts_style_meta_icon',
			[
				'label' => __('Icon', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'no',
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '!=',
							'value' => 'product'
						]
					],
				]
			]
		);

		$this->add_control(
			'posts_style_meta_icon_color',
			[
				'label' => __('Icon Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post__time svg' => 'stroke: {{VALUE}} !important',
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post__category svg' => 'stroke: {{VALUE}} !important',
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post__tags svg' => 'stroke: {{VALUE}} !important',
					'{{WRAPPER}} .l-portfolio-wrapper .l-portfolio-wrapper__items-holder .o-portfolio-item__category svg' => 'stroke: {{VALUE}} !important'
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '!=',
							'value' => 'product'
						],
						[
							'name' => 'posts_style_meta_icon',
							'operator' => '==',
							'value' => 'yes'
						]
					],
				]
			]
		);

		$this->add_responsive_control(
			'posts_style_meta_icon_size',
			[
				'label' => __('Icon Size', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post__time svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post__category svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post__tags svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .l-portfolio-wrapper .l-portfolio-wrapper__items-holder .o-portfolio-item__category svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '!=',
							'value' => 'product'
						],
						[
							'name' => 'posts_style_meta_icon',
							'operator' => '==',
							'value' => 'yes'
						]
					],
				]
			]
		);

		$this->add_responsive_control(
			'posts_style_meta_icon_spacing',
			[
				'label' => __('Icon Spacing', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post__time svg' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post__category svg' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post__tags svg' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .l-portfolio-wrapper .l-portfolio-wrapper__items-holder .o-portfolio-item__category svg' => 'margin-right: {{SIZE}}{{UNIT}};'
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '!=',
							'value' => 'product'
						],
						[
							'name' => 'posts_style_meta_icon',
							'operator' => '==',
							'value' => 'yes'
						]
					],
				]
			]
		);

		$this->add_control(
			'posts_style_meta_alignment',
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
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post__meta' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .l-portfolio-wrapper .l-portfolio-wrapper__items-holder .o-portfolio-item__category-holder' => 'text-align: {{VALUE}}',
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Excerpt
		 */
		$this->start_controls_section(
			'posts_style_excerpt',
			[
				'label' => __('Excerpt', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'post'
						], 
						[
							'name' => 'posts_meta_excerpt',
							'operator' => '==',
							'value' => 'yes'
						], 
					],
				]
			]
		);

		$this->add_control(
			'posts_style_excerpt_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder.l-blog-wrapper__posts-holder--meta-outside .o-blog-post .o-blog-post__content p' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'posts_style_excerpt_typography',
				'label' => __('Typography', 'neuron-core'),
				'selector' =>'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder.l-blog-wrapper__posts-holder--meta-outside .o-blog-post .o-blog-post__content p'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'posts_style_excerpt_shadow',
				'label' => __('Text Shadow', 'neuron-core'),
				'selector' =>'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder.l-blog-wrapper__posts-holder--meta-outside .o-blog-post .o-blog-post__content p'
			]
		);

		$this->add_control(
			'posts_style_excerpt_alignment',
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
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder.l-blog-wrapper__posts-holder--meta-outside .o-blog-post .o-blog-post__content p' => 'text-align: {{VALUE}}',
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Author
		 */
		$this->start_controls_section(
			'posts_style_author',
			[
				'label' => __('Author', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'post'
						], 
						[
							'name' => 'posts_meta_author',
							'operator' => '==',
							'value' => 'yes'
						], 
					],
				]
			]
		);

		$this->add_control(
			'posts_style_author_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post .o-blog-post__author .author-name a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post .o-blog-post__author .author-name a:hover' => 'box-shadow: inset 0 0 0 rgba('. neuron_hexToRgb('{{VALUE}}') .', 0), 0 1px 0 {{VALUE}} !important'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'posts_style_author_typography',
				'label' => __('Typography', 'neuron-core'),
				'selector' =>'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post .o-blog-post__author .author-name a'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'posts_style_author_shadow',
				'label' => __('Text Shadow', 'neuron-core'),
				'selector' =>'{{WRAPPER}} .l-blog-wrapper .l-blog-wrapper__posts-holder .o-blog-post .o-blog-post__author .author-name a'
			]
		);

		$this->add_control(
			'posts_style_author_avatar',
			[
				'label' => __('Avatar', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'neuron-core'),
				'label_off' => __('Hide', 'neuron-core'),
				'return_value' => 'yes',
				'default' => 'yes'
			]
		);

		$this->add_control(
			'posts_style_author_alignment',
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
					]
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Price
		 */
		$this->start_controls_section(
			'posts_style_price',
			[
				'label' => __('Price', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'product'
						], 
						[
							'name' => 'posts_meta_price',
							'operator' => '==',
							'value' => 'yes'
						], 
					],
				]
			]
		);

		$this->add_control(
			'posts_style_price_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .l-woocommerce-wrapper .l-woocommerce-wrapper__products-holder.l-woocommerce-wrapper__products-holder--meta-outside .o-neuron-hover .o-neuron-hover__body .o-neuron-hover__body-meta .o-neuron-hover__body-meta__price span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .l-woocommerce-wrapper .l-woocommerce-wrapper__products-holder.l-woocommerce-wrapper__products-holder--meta-inside .o-neuron-hover .o-neuron-hover-holder .o-neuron-hover-holder__body .o-neuron-hover-holder__body-meta .o-neuron-hover-holder__body-meta__price span' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'posts_style_price_typography',
				'label' => __('Typography', 'neuron-core'),
				'selector' =>'{{WRAPPER}} .l-woocommerce-wrapper .l-woocommerce-wrapper__products-holder.l-woocommerce-wrapper__products-holder--meta-outside .o-neuron-hover .o-neuron-hover__body .o-neuron-hover__body-meta .o-neuron-hover__body-meta__price span, {{WRAPPER}} .l-woocommerce-wrapper .l-woocommerce-wrapper__products-holder.l-woocommerce-wrapper__products-holder--meta-inside .o-neuron-hover .o-neuron-hover-holder .o-neuron-hover-holder__body .o-neuron-hover-holder__body-meta .o-neuron-hover-holder__body-meta__price span'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'posts_style_price_shadow',
				'label' => __('Text Shadow', 'neuron-core'),
				'selector' =>'{{WRAPPER}} .l-woocommerce-wrapper .l-woocommerce-wrapper__products-holder.l-woocommerce-wrapper__products-holder--meta-outside .o-neuron-hover .o-neuron-hover__body .o-neuron-hover__body-meta .o-neuron-hover__body-meta__price span, {{WRAPPER}} .l-woocommerce-wrapper .l-woocommerce-wrapper__products-holder.l-woocommerce-wrapper__products-holder--meta-inside .o-neuron-hover .o-neuron-hover-holder .o-neuron-hover-holder__body .o-neuron-hover-holder__body-meta .o-neuron-hover-holder__body-meta__price span'
			]
		);

		$this->add_control(
			'posts_style_price_alignment',
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
					'{{WRAPPER}} .l-woocommerce-wrapper .l-woocommerce-wrapper__products-holder.l-woocommerce-wrapper__products-holder--meta-outside .o-neuron-hover .o-neuron-hover__body .o-neuron-hover__body-meta .o-neuron-hover__body-meta__price' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .l-woocommerce-wrapper .l-woocommerce-wrapper__products-holder.l-woocommerce-wrapper__products-holder--meta-inside .o-neuron-hover .o-neuron-hover-holder .o-neuron-hover-holder__body .o-neuron-hover-holder__body-meta .o-neuron-hover-holder__body-meta__price' => 'text-align: {{VALUE}}'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Result Count
		 */
		$this->start_controls_section(
			'posts_style_results_count',
			[
				'label' => __('Results Count', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_type',
							'operator' => '==',
							'value' => 'product'
						], 
						[
							'name' => 'posts_meta_results_count',
							'operator' => '==',
							'value' => 'yes'
						], 
					],
				]
			]
		);

		$this->add_control(
			'posts_style_result_count_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .l-woocommerce-wrapper .l-woocommerce-wrapper__top-bar .woocommerce-result-count' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'posts_style_result_count_typography',
				'label' => __('Typography', 'neuron-core'),
				'selector' =>'{{WRAPPER}} .l-woocommerce-wrapper .l-woocommerce-wrapper__top-bar .woocommerce-result-count'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'posts_style_result_count_shadow',
				'label' => __('Text Shadow', 'neuron-core'),
				'selector' =>'{{WRAPPER}} .l-woocommerce-wrapper .l-woocommerce-wrapper__top-bar .woocommerce-result-count'
			]
		);

		$this->end_controls_section();

		/**
		 * Filters
		 */
		$this->start_controls_section(
			'posts_style_filters',
			[
				'label' => __('Filters', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'posts_layout',
							'operator' => '==',
							'value' => 'isotope'
						],
						[
							'name' => 'posts_filters_visibility',
							'operator' => '==',
							'value' => 'yes'
						]
					]
				]
			]
		);

		$this->add_control(
			'posts_style_filters_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .m-filters ul li a' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'posts_style_filters_hover_color',
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
				'name' => 'posts_style_filters_typography',
				'label' => __('Typography', 'neuron-core'),
				'selector' => '{{WRAPPER}} .m-filters ul li a'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'posts_style_filters_shadow',
				'label' => __('Text Shadow', 'neuron-core'),
				'selector' => '{{WRAPPER}} .m-filters ul li a'
			]
		);

		$this->add_responsive_control(
			'posts_style_filters_spacing',
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
			'posts_style_filters_alignment',
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

		/**
		 * Pagination
		 */
		$this->start_controls_section(
			'posts_style_pagination',
			[
				'label' => __('Pagination', 'neuron-core'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'posts_layout',
							'operator' => '==',
							'value' => 'isotope'
						],
						[
							'name' => 'posts_pagination_visibility',
							'operator' => '==',
							'value' => 'yes'
						]
					]
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'posts_style_pagination_typography',
				'label' => __('Typography', 'neuron-core'),
				'selector' => '{{WRAPPER}} .load-more-posts-holder button, {{WRAPPER}} .o-pagination ul.o-pagination__numbers li a'
			]
		);

		$this->start_controls_tabs(
			'posts_style_pagination_button'
		);

		$this->start_controls_tab(
			'posts_style_pagination_normal_tab',
			[
				'label' => __('Normal', 'neuron-core')
			]
		);

		$this->add_control(
			'posts_style_pagination_color',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .load-more-posts-holder button' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .o-pagination ul.o-pagination__numbers li a' => 'color: {{VALUE}} !important',
				]
			]
		);

		$this->add_control(
			'posts_style_pagination_background_color',
			[
				'label' => __('Background Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .load-more-posts-holder button' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .o-pagination ul.o-pagination__numbers li a' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'posts_style_pagination_hover_tab',
			[
				'label' => __('Hover', 'neuron-core')
			]
		);

		$this->add_control(
			'posts_style_pagination_color_hover',
			[
				'label' => __('Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .load-more-posts-holder button:hover' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .o-pagination ul.o-pagination__numbers li a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .o-pagination ul.o-pagination__numbers li.active a' => 'color: {{VALUE}} !important'
				]
			]
		);

		$this->add_control(
			'posts_style_pagination_background_color_hover',
			[
				'label' => __('Background Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .load-more-posts-holder button:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .o-pagination ul.o-pagination__numbers li a:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .o-pagination ul.o-pagination__numbers li.active a' => 'background-color: {{VALUE}} !important',
				]
			]
		);

		$this->add_control(
			'posts_style_pagination_hover_animation',
			[
				'label' => __('Hover Animation', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
				'condition' => [
					'posts_pagination_style' => 'show-more'
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'posts_style_pagination_border_type',
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
				'condition' => [
					'posts_pagination_style' => 'show-more'
				],
				'selectors' => [
					'{{WRAPPER}} .load-more-posts-holder button' => 'border-style: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'posts_style_pagination_border_width',
			[
				'label' => __('Border Width', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_style_pagination_border_type',
							'operator' => '!=',
							'value' => 'none',
						],
						[
							'name' => 'posts_pagination_style',
							'operator' => '==',
							'value' => 'show-more',
						]
					]
				],
				'selectors' => [
					'{{WRAPPER}} .load-more-posts-holder button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		
		$this->add_control(
			'posts_style_pagination_border_color',
			[
				'label' => __('Border Color', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_style_pagination_border_type',
							'operator' => '!=',
							'value' => 'none',
						],
						[
							'name' => 'posts_pagination_style',
							'operator' => '==',
							'value' => 'show-more',
						],
					]
				],
				'selectors' => [
					'{{WRAPPER}} .load-more-posts-holder button' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'posts_style_pagination_border_radius',
			[
				'label' => __('Border Radius', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'conditions' => [
					'terms' => [
						[
							'name' => 'posts_pagination_style',
							'operator' => '==',
							'value' => 'show-more',
						],
					]
				],
				'selectors' => [
					'{{WRAPPER}} .load-more-posts-holder button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'posts_style_pagination_margin',
			[
				'label' => __('Margin', 'neuron-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .load-more-posts-holder button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .o-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'posts_style_pagination_padding',
			[
				'label' => __('Padding', 'neuron-core'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .load-more-posts-holder button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'posts_pagination_style' => 'show-more'
				]
			]
		);

		$this->add_control(
			'posts_style_pagination_alignment',
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
				'default' => 'center',
				'condition' => [
					'posts_pagination_style' => 'show-more'
				],
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
		 * Posts Type
		 */
		switch ($settings['posts_type']) {
			default:
				$neuron_posts_type = 'post';
				$neuron_posts_name = 'blog';
				$neuron_posts_taxonomy = 'category';
				$neuron_posts_normal_query = $settings['posts_query_normal_post'];
				$neuron_posts_metro_query = $settings['posts_query_metro_post'];
				$neuron_posts_wrapper_class = 'l-blog-wrapper';
				$neuron_posts_holder_class = 'l-blog-wrapper__posts-holder l-blog-wrapper__posts-holder--'. $settings['posts_layout_model'] .'';
				$neuron_posts_item_class = 'o-blog-post';
				break;
			case 'portfolio':
				$neuron_posts_type = 'portfolio';
				$neuron_posts_name = 'portfolio';
				$neuron_posts_taxonomy = 'portfolio_category';
				$neuron_posts_normal_query = $settings['posts_query_normal_portfolio'];
				$neuron_posts_metro_query = $settings['posts_query_metro_portfolio'];
				$neuron_posts_wrapper_class = 'l-portfolio-wrapper';
				$neuron_posts_holder_class = 'l-portfolio-wrapper__items-holder l-portfolio-wrapper__items-holder--'. $settings['posts_layout_model'] . '';
				$neuron_posts_item_class = 'o-portfolio-item';
				break;
			case 'product':
				$neuron_posts_type = 'product';
				$neuron_posts_name = 'shop';
				$neuron_posts_taxonomy = 'product_cat';
				$neuron_posts_normal_query = $settings['posts_query_normal_product'];
				$neuron_posts_metro_query = $settings['posts_query_metro_product'];
				$neuron_posts_wrapper_class = 'l-woocommerce-wrapper';
				$neuron_posts_holder_class = 'l-woocommerce-wrapper__products-holder l-woocommerce-wrapper__products-holder--'. $settings['posts_layout_model'] .'';
				$neuron_posts_item_class = 'product-holder';
				break;
		}

		/**
         * Paged
         * 
         * Tell the WordPress exactly
         * what page is active.
         */
		if (get_query_var('paged')) {
			$paged = get_query_var('paged');
		} elseif (get_query_var('page')) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}
		
		/**
         * Loop Operator
         * 
         * Show all posts incase no
         * category is selected. Works
		 * only when isotope is selected.
         */
		if ($neuron_posts_normal_query) {
			$loop_operator = "IN";
		} else {
			$loop_operator = "NOT IN";
		}

		/**
         * Query IDs
         */
        $neuron_posts_query = [];
        if ($neuron_posts_metro_query) {
            foreach ($neuron_posts_metro_query as $post) {
				$neuron_posts_query[] = $post['post_id'];
            }
		}

		/**
		 * Query
		 */
		if ($settings['posts_layout_type'] == 'metro') {
			$args = [
				'post_type' => $neuron_posts_type,
				'posts_per_page' => $settings['posts_ppp'],
				'paged' => $paged,
				'post__in' => $neuron_posts_query,
				'orderby' => 'post__in'
			];
		} else {
			$args = [
				'post_type' => $neuron_posts_type,
				'posts_per_page' => $settings['posts_ppp'],
				'paged' => $paged,
				'tax_query' => [
					[
						'taxonomy' => $neuron_posts_taxonomy,
						'field' => 'slug',
						'terms' => $neuron_posts_normal_query,
						'operator' => $loop_operator
					]
				],
			];
		}

		include(__DIR__ . '/shop/orderby.php');

		$neuron_filter = isset($_GET['filter']) ? $_GET['filter'] : '';
		$neuron_exclude = isset($_GET['exclude']) ? $_GET['exclude'] : '';

		if ($neuron_filter) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => $neuron_posts_taxonomy,
					'field' => 'slug',
					'terms' => $neuron_filter
				)
			);
		}

		if ($neuron_exclude) {
			$args['post__not_in'] = $neuron_exclude;
		}

		$query = new \WP_Query($args);

		/**
		 * Hover Visibility
		 * 
		 * Pass the variable to global query to
		 * inherit later in meta-inside and outside
		 * of the portfolio types.
		 */
		set_query_var('neuron_posts_hover_visibility', $settings['posts_hover_visibility']);

		/**
		 * Hover Animation
		 * 
		 * Pass the variable to global query to
		 * inherit later in meta-inside and outside
		 * of the portfolio types.
		 */
		set_query_var('neuron_posts_hover_animation', $settings['posts_hover_animation']);

		/**
		 * Meta
		 */
		$settings['posts_layout_model'] == 'meta-inside' ? $settings['posts_meta_thumbnail'] = 'yes' : '';
		set_query_var('neuron_posts_meta_thumbnail', $settings['posts_meta_thumbnail']);
		set_query_var('neuron_posts_meta_title', $settings['posts_meta_title']);
		set_query_var('neuron_posts_meta_categories', $settings['posts_meta_categories']);
		set_query_var('neuron_posts_meta_date', $settings['posts_meta_date']);
		set_query_var('neuron_posts_meta_tags', $settings['posts_meta_tags']);
		set_query_var('neuron_posts_meta_excerpt', $settings['posts_meta_excerpt']);
		set_query_var('neuron_posts_meta_author', $settings['posts_meta_author']);
		set_query_var('neuron_posts_meta_price', $settings['posts_meta_price']);
		set_query_var('neuron_posts_meta_results_count', $settings['posts_meta_results_count']);
		set_query_var('neuron_posts_meta_catalog_ordering', $settings['posts_meta_catalog_ordering']);
		set_query_var('neuron_posts_meta_ordering_default', $settings['posts_meta_ordering_default']);

		/** 
		 * Carousel Height
		 */ 
		set_query_var('neuron_posts_carousel_height', $settings['posts_carousel_height']);

		/**
		 * Thumbnail Sizes
		 */
		$neuron_thumbnail_output = null;

		if ($settings['posts_thumbnail_resizer'] == 'yes') {
			if ($settings['posts_thumbnail_resizer'] == 'yes') {
				if ($settings['posts_thumbnail_sizes_custom_dimension']) {
					$media_custom_dimension = $settings['posts_thumbnail_sizes_custom_dimension'];
					$media_image_size = [isset($media_custom_dimension['width']) ? $media_custom_dimension['width'] : 500, isset($media_custom_dimension['width']) ? $media_custom_dimension['width'] : 9999];
				} else {
					$media_image_size = $settings['posts_thumbnail_sizes_size'];
				}
			} else {
				$media_image_size = 'full';
			}
			$neuron_thumbnail_output = $media_image_size;
		}

		set_query_var('neuron_posts_thumbnail_resizer', $neuron_thumbnail_output);

		/**
		 * Style
		 */
		set_query_var('neuron_posts_style_meta_icon', $settings['posts_style_meta_icon']);
		set_query_var('neuron_posts_style_author_avatar', $settings['posts_style_author_avatar']);
		set_query_var('neuron_posts_style_author_alignment', $settings['posts_style_author_alignment']);

		/**
		 * Hover 
		 */
		set_query_var('neuron_posts_style_hover_active', $settings['posts_style_hover_active']);
		set_query_var('neuron_posts_style_hover_meta_vertical_alignment', $settings['posts_style_hover_meta_vertical_alignment']);
		set_query_var('neuron_posts_style_hover_icon', $settings['posts_style_hover_icon']);
		set_query_var('neuron_posts_style_hover_icon_vertical_alignment', $settings['posts_style_hover_icon_vertical_alignment']);
		set_query_var('neuron_posts_style_hover_icon_horizontal_alignment', $settings['posts_style_hover_icon_horizontal_alignment']);
		
		if ($query->have_posts()) :
	?>
		<div class="l-posts-wrapper h-overflow-hidden <?php echo esc_attr($neuron_posts_wrapper_class) ?>">
			<?php $settings['posts_layout'] != 'carousel' ? include(__DIR__ . '/templates/filters.php')  : '' ?>
			<?php $settings['posts_type'] == 'product' ? include(__DIR__ . '/shop/top-bar.php') : '' ?>
			<div class="<?php echo esc_attr($neuron_posts_holder_class) ?> h-overflow-hidden">
				<?php 
				/**
				 * Layout Type
				 */
				if ($settings['posts_layout'] == 'isotope') {
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
