<?php

/**
 * Neuron Functions
 * 
 * Bunch of functions which improve & help the theme
 * to work better and keep the code more organised.
 */

/**
 * Open and close container tags
 * 
 * Simply opens and closes the container tags,
 * theme uses it and finds helpful on files
 * that does not contain html tags.
 */
add_action('bifrost_open_container', 'bifrost_open_container');
add_action('bifrost_close_container', 'bifrost_close_container');
function bifrost_open_container() {
?>
    <div class="container">
<?php
}

function bifrost_close_container() {
?>
    </div>
<?php
}

/**
 * Default Pagination
 * 
 * Well organised pagination with numbers and arrows,
 * theme uses it on blogs and portfolios.
 */
function neuron_pagination($query = '') {
	global $paged;

	$bifrost_range = 4;
	$bifrost_pages = '';
	$bifrost_showitems = ($bifrost_range * 2) + 1;

	if (empty($paged)) {
		if (get_query_var('paged')) {
			$paged = get_query_var('paged');
		} elseif (get_query_var('page')) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}
	}

	if ($bifrost_pages == '') {
		global $wp_query;
		if ($query) {
			$bifrost_pages = $query->max_num_pages;
		} else {
			$bifrost_pages = $wp_query->max_num_pages;
		}

		if (!$bifrost_pages) {
			$bifrost_pages = 1;
		}
	}

	if (1 != $bifrost_pages) {
		echo "<div class='o-pagination'><div class='container'><div class='row align-items-center h-medium-top-padding h-medium-bottom-padding'>";

        $bifrost_prev_class = 'o-pagination__arrow d-inline-flex col-2';
        $bifrost_next_class = 'o-pagination__arrow d-inline-flex col-2';
		if ($paged <= 1) {
            $bifrost_prev_class = 'o-pagination__arrow d-inline-flex col-2 o-pagination__arrow--disabled';
        } 
        echo "<div class='". $bifrost_prev_class ."'><a class=\"bifrost-link d-inline-flex\" href='". get_pagenum_link($paged - 1) ."'><svg xmlns='http://www.w3.org/2000/svg' width='22' height='22' viewBox='0 0 24 24' fill='none' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevron-left'><polyline points='15 18 9 12 15 6'></polyline></svg></a></div>";

        echo "<ul class='col-8 h-align-center o-pagination__numbers'>";
		for ($i = 1; $i <= $bifrost_pages; $i++) {
			if (1 != $bifrost_pages && (!($i >= $paged + $bifrost_range + 1 || $i <= $paged - $bifrost_range - 1) || $bifrost_pages <= $bifrost_showitems)) {
				if ($paged == $i) {
					echo "<li class=\"active\"><a>". $i ."</a></li>";
				} else {
					echo "<li><a href='". get_pagenum_link($i) ."' class=\"inactive bifrost-link\">". $i ."</a></li>";
				}
			}
		}

        $bifrost_pages_float = intval($bifrost_pages);
        echo "</ul>";


        if ($paged == $bifrost_pages_float) {
            $bifrost_next_class = 'o-pagination__arrow d-inline-flex col-2 o-pagination__arrow--disabled';
        }

        echo "<div class='". $bifrost_next_class ."'><a class=\"bifrost-link d-inline-flex ml-auto\" href='". get_pagenum_link($paged + 1) ."'><svg xmlns='http://www.w3.org/2000/svg' width='22' height='22' viewBox='0 0 24 24' fill='none' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevron-right'><polyline points='9 18 15 12 9 6'></polyline></svg></a></div>";

		echo "</div></div></div>\n";
	}
}
/**
 * Comments
 * 
 * Rewrites the comments for easier use.
 */
function bifrost_comments_open($bifrost_comment, $bifrost_comments_args, $bifrost_comment_depth) {
	switch ($bifrost_comment_depth) {
		case 1:
			$bifrost_comment_class = "col-md-12";
			break;
		case 2:
			$bifrost_comment_class = "col-md-11 offset-md-1";
			break;
		case 3:
			$bifrost_comment_class = "col-md-10 offset-md-2";
			break;
		case 4:
		default:
			$bifrost_comment_class = "col-md-9 offset-md-3";
			break;
	}

	if ($bifrost_comment->comment_type == 'pingback') {
		$bifrost_comment_class .= " o-comment--no-avatar";
	}
?>
<div class="o-comment <?php echo esc_attr($bifrost_comment_class) ?>" id="comment-<?php echo esc_attr($bifrost_comment->comment_ID); ?>">
	<?php if($bifrost_comment->comment_type != 'pingback') : ?>
		<div class="o-comment__avatar">
			<?php echo get_avatar($bifrost_comment, 70) ?>
		</div>
	<?php endif; ?>
	<div class="o-comment__details">
		<div class="o-comment__author-meta d-flex align-items-center">
			<h5 class="o-comment__author-meta-title">
                <?php echo esc_attr($bifrost_comment->comment_author) ?>
            </h5>

            <div class="ml-auto">
                <?php
                    /**
					 * Reply Link
					 */
                    comment_reply_link(
                        array_merge(
                            $bifrost_comments_args,
                            array(
                                'reply_text' => esc_attr__('reply', 'bifrost'),
                                'depth' => $bifrost_comment_depth,
                                'max_depth' => $bifrost_comments_args['max_depth'],
                            )
                        ),
                        $bifrost_comment
                    );
                ?>
            </div>
		</div>
		<div class="o-comment__date">
			<?php comment_date('F j, Y ') . comment_date('g:i a') ?>
		</div>
		<div class="o-comment__content">
			<?php comment_text(); ?>
		</div>
	</div>
</div>
<?php
}

function bifrost_comments_close() {}

function bifrost_comment_form_before() {
	?>
		<div class="row">
            <div class="col-12">
	<?php
}
add_action('comment_form_before', 'bifrost_comment_form_before');

function bifrost_comment_form_after() {
    ?>
            </div>
		</div>
	<?php
}
add_action('comment_form_after', 'bifrost_comment_form_after');

/**
 * Inherit Option ACF to Customizer
 * 
 * It accepts two different options, the field
 * from acf and the option from customizer, it
 * makes them ready to be used if the value
 * will be inherited or not.
 */
function bifrost_inherit_option($inherit, $customizer, $default_customizer, $archive = true) {
		/**
	 * Get Queried Object
	 * 
	 * If the field is being called in taxonomy
	 * the term will be associated to the queried
	 * object as prefix.
	 * 
	 * https://www.advancedcustomfields.com/resources/adding-fields-taxonomy-term/
	 */
	if (class_exists('WooCommerce') && is_shop()) {
		$term = wc_get_page_id('shop');
	} else if (is_tax() && isset(get_queried_object()->term_id)) {
		$term = 'term_' . get_queried_object()->term_id;
	} else {
		$term = get_queried_object();
	}

	/**
	 * Archive
	 * 
	 * All archive pages and taxonomies should
	 * have get_queried_object as second parameter
	 * on the get_field otherwise the right value
	 * would not be returned.
	 */
    if ($archive == true) {
        $inherit = get_field($inherit, $term);
    } else {
        $inherit = get_field($inherit);
    }

    $customizer = get_theme_mod($customizer, $default_customizer);

    if (!$inherit) {
        $inherit = '1';
	}
	
	if (is_array($inherit)) {
		$inherit = $inherit[0];
	}

    if ($inherit == '1') {
        $inherit = $customizer;
    } else {
        $inherit = $inherit - 1;
    }
    
    return $inherit;
}

/**
 * Thumbnail Calculation
 * 
 * A simple calculation which returns as padding
 * bottom the height of image, we use it to eleminate
 * the glitches of masonry when loading.
 */
function bifrost_thumbnail_calculation($thumbnail = 'full') {
	global $post;

	$image_data = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $thumbnail);

	return 'padding-bottom: '. number_format($image_data[2] / $image_data[1] * 100, 6) .'% !important;';
}

// For simple images not thumbnails
function bifrost_image_calculation($image_id, $image_size = 'full') {
	$image_data = wp_get_attachment_image_src($image_id, $image_size);

	return 'padding-bottom: '. number_format($image_data[2] / $image_data[1] * 100, 6) .'% !important;';
}

/**
 * Social Media
 * 
 * Incase visibility is false the function will return
 * also the type will be between icon and text, sorter
 * helps to add the social media you want.
 */
function bifrost_social_media($visibility, $sorter) {

	if ($visibility == '2') {
		return;
	}

	$bifrost_social_media_output = [];

	$bifrost_social_media = [
		'facebook' => [
			'url' => get_theme_mod('social_media_facebook'),
			'icon' => 'fab fa-facebook-f'
		],
		'500px' => [
			'url' => get_theme_mod('social_media_500px'),
			'icon' => 'fab fa-500px'
		],
		'twitter' => [
			'url' => get_theme_mod('social_media_twitter'),
			'icon' => 'fab fa-twitter'
		],
		'google_plus' => [
			'url' => get_theme_mod('social_media_google_plus'),
			'icon' => 'fab fa-google-plus'
		],
		'vimeo' => [
			'url' => get_theme_mod('social_media_vimeo'),
			'icon' => 'fab fa-vimeo'
		],
		'dribbble' => [
			'url' => get_theme_mod('social_media_dribbble'),
			'icon' => 'fab fa-dribbble'
		],
		'pinterest' => [
			'url' => get_theme_mod('social_media_pinterest'),
			'icon' => 'fab fa-pinterest'
		],
		'youtube' => [
			'url' => get_theme_mod('social_media_youtube'),
			'icon' => 'fab fa-youtube'
		],
		'behance' => [
			'url' => get_theme_mod('social_media_behance'),
			'icon' => 'fab fa-behance'
		],
		'tumblr' => [
			'url' => get_theme_mod('social_media_tumblr'),
			'icon' => 'fab fa-tumblr'
		],
		'linkedin' => [
			'url' => get_theme_mod('social_media_linkedin'),
			'icon' => 'fab fa-linkedin-in'
		],
		'flickr' => [
			'url' => get_theme_mod('social_media_flickr'),
			'icon' => 'fab fa-flickr'
		],
		'houzz' => [
			'url' => get_theme_mod('social_media_houzz'),
			'icon' => 'fab fa-houzz'
		],
		'spotify' => [
			'url' => get_theme_mod('social_media_spotify'),
			'icon' => 'fab fa-spotify'
		],
		'instagram' => [
			'url' => get_theme_mod('social_media_instagram'),
			'icon' => 'fab fa-instagram'
		],
		'github' => [
			'url' => get_theme_mod('social_media_github'),
			'icon' => 'fab fa-github'
		],
		'stackexchange' => [
			'url' => get_theme_mod('social_media_stackexchange'),
			'icon' => 'fab fa-stack-exchange'
		],
		'soundcloud' => [
			'url' => get_theme_mod('social_media_soundcloud'),
			'icon' => 'fab fa-soundcloud'
		],
		'vk' => [
			'url' => get_theme_mod('social_media_vk'),
			'icon' => 'fab fa-vk'
		]
	];

	if ($sorter) {
		echo '<ul>';
		foreach ($sorter as $social_media) {
			if ($bifrost_social_media[$social_media]['url']) {
				echo sprintf(
					'<li><a target="%s" href="%s"><i class="%s"></i></a></li>',
					get_theme_mod('social_media_new_window') == '1' ? '_BLANK' : '_SELF',
					esc_url($bifrost_social_media[$social_media]['url']),
					esc_attr($bifrost_social_media[$social_media]['icon'])
				);
			}
		}
		echo '</ul>';
	}
}

/**
 * Breadcrumbs
 * 
 * Add support for parent and child pages, archives
 * custom post types and custom taxonomies
 */
function bifrost_breadcrumbs($visibility, $sep, $inSubtitle = false) {
	if ($visibility == '2') {
		return;
	}

	// Output
	$output = [];
	
	// Settings
	if ($sep) {
		$separator = $sep;
	} else {
		$separator = '/';
	}
	
	$home_title = esc_attr__('Home', 'bifrost');

	if (class_exists('WooCommerce') && is_shop()) {
		$current_title = woocommerce_page_title(false);
	} elseif (is_author()) {
		$current_title = get_the_author();
	} elseif (is_archive()) {
		if (is_date()) {
			$current_title = get_the_date();
		} else {
			$current_title = single_term_title('', false);
		}
	} else {
		$current_title = get_the_title();
	}
	
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy = 'portfolio_category';
       
    // Get the query & post information
	global $post, $wp_query;
	
    // Do not display on the homepage
    if (!is_front_page()) {

        if (is_archive() && is_tax() && !is_category() && !is_tag()) {
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if ($post_type != 'post') {
				  
				if (get_post_type_object($post_type)) {
					$post_type_object = get_post_type_object($post_type);
					$output[] = '<li class="m-breadcrumb-nav__item">' . $post_type_object->labels->name . '</li>';
					$output[] = '<li class="m-breadcrumb-nav__item m-breadcrumb-nav__item--separator"> ' . $separator . ' </li>';
				}
            }
			$custom_tax_name = get_queried_object()->name;
			
            $output[] = '<li class="m-breadcrumb-nav__item m-breadcrumb-nav__item--active">' . $custom_tax_name . '</li>';
        } elseif (is_category() || is_tag()) {
			$output[] = '<li class="m-breadcrumb-nav__item m-breadcrumb-nav__item--active">' . single_cat_title('', false) . '</li>';
		} elseif (is_attachment()) {
			$output[] = '<li class="m-breadcrumb-nav__item m-breadcrumb-nav__item--active">' . get_the_title(get_the_ID()) . '</li>';
		} elseif (is_single()) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if ($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
              
                $output[] = '<li class="m-breadcrumb-nav__item">' . $post_type_object->labels->name . '</li>';
                $output[] = '<li class="m-breadcrumb-nav__item m-breadcrumb-nav__item--separator"> ' . $separator . ' </li>';
            }
              
            // Get post category info
            $category = get_the_category();
             
            if (!empty($category)) {
              
				// Get last category post is in
				$array_category = array_values($category);
                $last_category = end($array_category);
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','), ',');
                $cat_parents = explode(',', $get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach ($cat_parents as $parents) {
                    $cat_display .= '<li class="m-breadcrumb-nav__item">'. $parents .'</li>';
                    $cat_display .= '<li class="m-breadcrumb-nav__item m-breadcrumb-nav__item--separator"> ' . $separator . ' </li>';
                }
            }
			// If it's a custom post type within a custom taxonomy
			if (get_post_type() == 'product') {
    			$custom_taxonomy = 'product_cat';
			} elseif (get_post_type() == 'portfolio') {
    			$custom_taxonomy = 'portfolio_category';
			}

			$taxonomy_exists = taxonomy_exists($custom_taxonomy);

			if (empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
				$taxonomy_terms = !empty(get_the_terms($post->ID, $custom_taxonomy)) ? get_the_terms($post->ID, $custom_taxonomy) : '';
				if ($taxonomy_terms) {
					$cat_id         = $taxonomy_terms[0]->term_id;
					$cat_nicename   = $taxonomy_terms[0]->slug;
					$cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
					$cat_name       = $taxonomy_terms[0]->name;
				}
			}	
              
            // Check if the post is in a category
            if (!empty($last_category)) {
                $output[] = wp_kses_post($cat_display);
                $output[] = '<li class="m-breadcrumb-nav__item m-breadcrumb-nav__item--active">'. get_the_title() .'</li>';
            } elseif (!empty($cat_id)) {
                $output[] = '<li class="m-breadcrumb-nav__item"><a href="'. esc_url($cat_link) .'">' . esc_attr($cat_name) . '</a></li>';
                $output[] = '<li class="m-breadcrumb-nav__item m-breadcrumb-nav__item--separator"> ' . $separator . ' </li>';
                $output[] = '<li class="m-breadcrumb-nav__item m-breadcrumb-nav__item--active">' . get_the_title() . '</li>';
            } else {
                $output[] = '<li class="m-breadcrumb-nav__item m-breadcrumb-nav__item--active">' . get_the_title() . '</li>';
            }
        } elseif (is_page()) {
            if ($post->post_parent) {
                   
                // If child page, get parents 
                $anc = get_post_ancestors($post->ID);
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
				// Parent page loop
				if (!isset($parents)) {
					$parents = null;
				}

                foreach ($anc as $ancestor) {
                    $parents .= '<li class="m-breadcrumb-nav__item"><a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="m-breadcrumb-nav__item m-breadcrumb-nav__item--separator"> ' . $separator . ' </li>';
                }
                   
                // Display parent pages
                $output[] = wp_kses_post($parents);
                   
                $output[] = '<li class="m-breadcrumb-nav__item m-breadcrumb-nav__item--active">' . get_the_title() . '</li>';
            } else {
                $output[] = '<li class="m-breadcrumb-nav__item m-breadcrumb-nav__item--active">' . get_the_title() . '</li>';
            }
        } elseif (class_exists('WooCommerce') && is_shop()) {
			$output[] = '<li class="m-breadcrumb-nav__item">' . woocommerce_page_title(false) . '</li>';
		} elseif (is_year()) {
            $output[] = '<li class="m-breadcrumb-nav__item"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
        } elseif (is_month()) {
            // Year link
            $output[] = '<li class="m-breadcrumb-nav__item"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
            $output[] = '<li class="m-breadcrumb-nav__item m-breadcrumb-nav__item--separator"> ' . $separator . ' </li>';
               
            // Month display
            $output[] = '<li class="m-breadcrumb-nav__item">' . get_the_time('M') . '</li>';
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            $output[] = '<li class="m-breadcrumb-nav__item m-breadcrumb-nav__item--active">' . $userdata->display_name . '</li>';
        } elseif (get_query_var('paged')) {
            $output[] = '<li class="m-breadcrumb-nav__item">'. esc_attr__('Page', 'bifrost') . get_query_var('paged') . '</li>';
        } elseif (is_search()) {
            $output[] = '<li class="m-breadcrumb-nav__item">Search results for: ' . get_search_query() . '</li>';
        } 

		if ($inSubtitle) {
			return sprintf(
				'<div class="o-breadcrumb h-fadeInNeuron wow" data-wow-delay="0.10s">
					<ul id="breadcrumbs" class="m-breadcrumb-nav ml-auto">
						<li class="m-breadcrumb-nav__item"><a href="%s">%s</a></li>
						<li class="m-breadcrumb-nav__item m-breadcrumb-nav__item--separator">%s</li>
						%s
					</ul>
				</div>',
				get_home_url(),
				$home_title,
				$separator,
				is_array($output) ? wp_kses_post(implode(' ', $output)) : wp_kses_post($output)
			);
		} else {
			echo sprintf(
				'<div class="o-breadcrumb h-medium-top-padding h-medium-bottom-padding">
					<div class="container">
						<div class="d-flex align-items-center">
							<h5 class="o-breadcrumb__page">%s</h5>
							<ul id="breadcrumbs" class="m-breadcrumb-nav ml-auto">
								<li class="m-breadcrumb-nav__item"><a href="%s">%s</a></li>
								<li class="m-breadcrumb-nav__item m-breadcrumb-nav__item--separator">%s</li>
								%s
							</ul>
						</div>
					</div>
				</div>',
				esc_attr($current_title),
				get_home_url(),
				$home_title,
				$separator,
				is_array($output) ? wp_kses_post(implode(' ', $output)) : wp_kses_post($output)
			);
		}
    }
}

/**
 * Modify wp_link_pages to show 
 */
add_filter('wp_link_pages_args', 'bifrost_wp_link_pages_args_prevnext_add');
function bifrost_wp_link_pages_args_prevnext_add($args) {
	global $page, $numpages, $more, $pagenow;
	
    if (!$args['next_or_number'] == 'next_and_number') {
        return $args; 
	} 

	$args['next_or_number'] = 'number'; 

	if (!$more) {
        return $args; 
	}
    return $args;
}

/**
 * Ajax Mini Cart
 * 
 * Mini cart will update in 
 * the same page, without 
 * reloading the current state.
 */
function bifrost_woocommerce_header_add_to_cart_fragment($fragments) {
    ob_start();
    ?>
		<span class="number">
			<?php echo sprintf('%d', WC()->cart->cart_contents_count); ?>
		</span>
    <?php
    $fragments['.l-primary-header__bag .number'] = ob_get_clean();
    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'bifrost_woocommerce_header_add_to_cart_fragment');


/**
 * Shop Posts Per Page
 * 
 * The number comes from customizer
 * and via woocommerce filter it changes
 * the posts per page of shop page.
 */
if (get_theme_mod('shop_ppp') && class_exists('WooCommerce')) {
    add_filter('loop_shop_per_page', 'bifrost_loop_shop_per_page', 20);
    function bifrost_loop_shop_per_page($cols) {
        $cols = get_theme_mod('shop_ppp');
        return $cols;
    }
}

/**
 * Shorten the Excerpt
 */
add_filter('excerpt_length', 'bifrost_excerpt_shorten', 999);
function bifrost_excerpt_shorten($length) {
    return 18;
}

/**
 * Excerpt More
 * 
 * Remove brackets from dots
 */
add_filter('excerpt_more', 'bifrost_excerpt_more');
function bifrost_excerpt_more($more) {
    return '...';
}

/**
 * HEX to RGBA
 * 
 * Convert the normal hex to
 * rgba to easier use.
 */
function bifrost_hexToRgb($hex, $alpha = false) {
	$hex = str_replace('#', '', $hex);
	$length = strlen($hex);

	$rgb = [
		'r' => hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0)),
		'g' => hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0)),
		'b' => hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0))
	];

	if ($alpha == 'zero') {
		$rgb['a'] = 0;
	} elseif ($alpha) {
		$rgb['a'] = $alpha;
	} 

	return implode(', ', $rgb);
}

/**
 * Color Lightness
 * 
 * Pass a rgb color and get back
 * a hsl color, you can lighten
 * or darken via the fourth parameter
 * in the function from.
 */
function bifrost_color_lightness($rgb, $percentage = 0) {
	$r = $rgb[0];
	$g = $rgb[1];
	$b = $rgb[2];

	$r /= 255;
	$g /= 255;
	$b /= 255;

    $max = max($r, $g, $b);
	$min = min($r, $g, $b);

	$h; $s;

	$l = ($max + $min) / 2;
	$d = $max - $min;

	if ($d == 0) {
		$h = $s = 0; 
	} else {
		$s = $d / (1 - abs(2 * $l - 1));
		switch ($max){
			case $r:
				$h = 60 * fmod( ( ( $g - $b ) / $d ), 6 ); 
				if ($b > $g) $h += 360;
				break;
			case $g: 
				$h = 60 * ( ( $b - $r ) / $d + 2 ); 
				break;
			case $b: 
				$h = 60 * ( ( $r - $g ) / $d + 4 ); 
				break;
		}			        	        
	}

	$output = [
		0 => round($h, 2),
		1 => round($s, 2) * 100,
		2 => round($l, 2) * 100
	];

	if ($percentage) {
		$output[2] += $percentage;
	}

	$output[1] .= '%';
	$output[2] .= '%';

	return implode(', ', $output);
}
