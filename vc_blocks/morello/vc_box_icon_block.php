<?php 

/**
 * The Shortcode
 */
function ebor_box_icon_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'duration' => '1',
				'icon' => '',
				'delay' => '0',
				'layout' => 'icon-top'
			), $atts 
		) 
	);
	
	if( 'icon-inside' == $layout ){
	
		$output = '
			<div class="text-center border-box">
				<div class="wow fadeInUp" data-wow-duration="'. esc_attr($duration) .'s" data-wow-delay="'. esc_attr($delay) .'s">
					<div class="box"> 
						<span class="icon">
							<i class="'. esc_attr($icon) .'"></i>
						</span>
						'. do_shortcode(htmlspecialchars_decode($content)) .'
					</div>
				</div>
			</div>
		';
	
	} else {
	
		$output = '
			<div class="text-center numbered border-box icon-top">
				<div class="wow fadeInUp" data-wow-duration="'. esc_attr($duration) .'s" data-wow-delay="'. esc_attr($delay) .'s">
					<div class="box"> 
						<span class="icon icon-bg">
							<i class="'. esc_attr($icon) .'"></i>
						</span>
						'. do_shortcode(htmlspecialchars_decode($content)) .'
					</div>
				</div><!--/column -->
			</div>
		';
	
	}
	
	return $output;
}
add_shortcode( 'morello_box_icon_block', 'ebor_box_icon_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_box_icon_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'morello-vc-block',
			"name" => esc_html__("Box Icon & Text", 'morello'),
			"base" => "morello_box_icon_block",
			"category" => esc_html__('morello WP Theme', 'morello'),
			"params" => array(
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Icon", 'morello'),
					"param_name" => "icon",
					"value" => array_values(ebor_get_icons())
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'morello'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Animation Duration (seconds)(numbers only)", 'morello'),
					"param_name" => "duration",
					'value' => '1'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Animation Delay (seconds)(numbers only)", 'morello'),
					"param_name" => "delay",
					'value' => '0.3'
				),
				array(
					'type' => 'dropdown',
					"heading" => esc_html__("Layout", 'morello'),
					'param_name' => 'layout',
					'value' => array(
						'Icon on top of border' => 'icon-top',
						'Icon inside border' => 'icon-inside'
					)
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_box_icon_block_shortcode_vc' );