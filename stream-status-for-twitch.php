<?php
/*
Plugin Name: Stream Status for Twitch
Plugin URI: http://bonfirethemes.com/
Description: Setup and customize under Appearance → Customize → Stream Status for Twitch Plugin
Version: 1.0
Author: Bonfire Themes
Author URI: http://bonfirethemes.com/
License: GPL2
*/

    //
	// WORDPRESS LIVE CUSTOMIZER
	//
	function bonfire_sst_theme_customizer( $wp_customize ) {
	
        //
        // ADD "Stream Status for Twitch Plugin" PANEL TO LIVE CUSTOMIZER 
        //
        $wp_customize->add_panel('sst_panel', array('title' => __('Stream Status for Twitch Plugin', 'stream-status-for-twitch'),'priority' => 10,));       

        //
        // ADD "Main Settings" SECTION TO "Stream Status for Twitch Plugin" PANEL 
        //
        $wp_customize->add_section('sst_main_section',array('title' => __( 'Main Settings', 'stream-status-for-twitch' ),'panel' => 'sst_panel','priority' => 1));

        /* channel name */
        $wp_customize->add_setting('sst_channel_name',array('default' => '','sanitize_callback' => 'sanitize_sst_channel_name',));
        function sanitize_sst_channel_name($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('sst_channel_name',array('type' => 'text','label' => 'Channel name','description' => 'Enter your Twitch channel name in order to display stream status.','section' => 'sst_main_section',));
        
        /* hide if feed offline */
        $wp_customize->add_setting('sst_offline_hide',array('sanitize_callback' => 'sanitize_sst_offline_hide',));
        function sanitize_sst_offline_hide( $input ) { if ( $input == 1 ) { return 1; } else { return ''; } }
        $wp_customize->add_control('sst_offline_hide',array('type' => 'checkbox','label' => 'Hide when offline', 'description' => 'If checked, the stream status will be shown only when channel is actively streaming.', 'section' => 'sst_main_section',));
        
        /* open in new window */
        $wp_customize->add_setting('sst_new_window',array('sanitize_callback' => 'sanitize_sst_new_window',));
        function sanitize_sst_new_window( $input ) { if ( $input == 1 ) { return 1; } else { return ''; } }
        $wp_customize->add_control('sst_new_window',array('type' => 'checkbox','label' => 'Open in new window','description' => 'If unchecked, Twitch will open in the same window.', 'section' => 'sst_main_section',));
        
        /* live text */
        $wp_customize->add_setting('sst_live_text',array('default' => '','sanitize_callback' => 'sanitize_sst_live_text',));
        function sanitize_sst_live_text($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('sst_live_text',array('type' => 'text','label' => 'Status text if stream is live','description' => 'If empty, defaults to "LIVE NOW! CLICK TO VIEW."','section' => 'sst_main_section',));
        
        /* offline text */
        $wp_customize->add_setting('sst_offline_text',array('default' => '','sanitize_callback' => 'sanitize_sst_offline_text',));
        function sanitize_sst_offline_text($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('sst_offline_text',array('type' => 'text','label' => 'Status text if stream is offline','description' => 'If empty, defaults to "CURRENTLY OFFLINE".','section' => 'sst_main_section',));
        
        //
        // ADD "Positioning" SECTION TO "Stream Status for Twitch" PANEL 
        //
        $wp_customize->add_section('sst_positioning_section',array('title' => __( 'Positioning', 'stream-status-for-twitch' ),'panel' => 'sst_panel','priority' => 2));
        
        /* absolute position */
        $wp_customize->add_setting('sst_absolute_position',array('sanitize_callback' => 'sanitize_sst_absolute_position',));
        function sanitize_sst_absolute_position( $input ) { if ( $input == 1 ) { return 1; } else { return ''; } }
        $wp_customize->add_control('sst_absolute_position',array('type' => 'checkbox','label' => 'Absolute positioning','description' => 'If unchecked, fixed positioning is applied.', 'section' => 'sst_positioning_section',));
        
        /* placemenet */
        $wp_customize->add_setting('sst_placement',array(
            'default' => 'top',
        ));
        $wp_customize->add_control('sst_placement',array(
            'type' => 'select',
            'label' => 'Placement',
            'section' => 'sst_positioning_section',
            'choices' => array(
                'top' => 'Top',
                'bottom' => 'Bottom',
        ),
        ));
        
        /* top/bottom distance */
        $wp_customize->add_setting('sst_vertical_distance',array('default' => '','sanitize_callback' => 'sanitize_sst_vertical_distance',));
        function sanitize_sst_vertical_distance($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('sst_vertical_distance',array('type' => 'text','label' => 'Top/bottom distance (in pixels)','description' => 'Example: 50 (if empty, defaults to 25).','section' => 'sst_positioning_section',));
        
        /* left distance */
        $wp_customize->add_setting('sst_horizontal_distance',array('default' => '','sanitize_callback' => 'sanitize_sst_horizontal_distance',));
        function sanitize_sst_horizontal_distance($input) {return wp_kses_post(force_balance_tags($input));}
        $wp_customize->add_control('sst_horizontal_distance',array('type' => 'text','label' => 'Left distance (in pixels)','description' => 'Example: 50 (if empty, defaults to 25).','section' => 'sst_positioning_section',));
        
        //
        // ADD "Customization" SECTION TO "Stream Status for Twitch" PANEL 
        //
        $wp_customize->add_section('sst_customization_section',array('title' => __( 'Customization', 'stream-status-for-twitch' ),'panel' => 'sst_panel','priority' => 3));
        
        /* background color */
        $wp_customize->add_setting('sst_background_color',array('sanitize_callback'=>'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'sst_background_color',array(
            'label'=>'Background','settings'=>'sst_background_color','section'=>'sst_customization_section')
        ));
        
        /* status text color */
        $wp_customize->add_setting('sst_status_text_color',array('sanitize_callback'=>'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'sst_status_text_color',array(
            'label'=>'Status text','settings'=>'sst_status_text_color','section'=>'sst_customization_section')
        ));
        
        /* status text hover color */
        $wp_customize->add_setting('sst_status_text_hover_color',array('sanitize_callback'=>'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'sst_status_text_hover_color',array(
            'label'=>'Status text (hover)','settings'=>'sst_status_text_hover_color','section'=>'sst_customization_section')
        ));
        
        /* Twitch icon color */
        $wp_customize->add_setting('sst_twitch_icon_color',array('sanitize_callback'=>'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'sst_twitch_icon_color',array(
            'label'=>'Twitch icon','settings'=>'sst_twitch_icon_color','section'=>'sst_customization_section')
        ));
        
        /* Twitch icon background color */
        $wp_customize->add_setting('sst_twitch_icon_background_color',array('sanitize_callback'=>'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'sst_twitch_icon_background_color',array(
            'label'=>'Twitch icon background','settings'=>'sst_twitch_icon_background_color','section'=>'sst_customization_section')
        ));
        
        /* disable status text underline */
        $wp_customize->add_setting('sst_no_underline',array('sanitize_callback' => 'sanitize_sst_no_underline',));
        function sanitize_sst_no_underline( $input ) { if ( $input == 1 ) { return 1; } else { return ''; } }
        $wp_customize->add_control('sst_no_underline',array('type' => 'checkbox','label' => 'Disable status text underline','description' => 'When checked, status text will not be underlined when hovered.', 'section' => 'sst_customization_section',));

	}
	add_action('customize_register', 'bonfire_sst_theme_customizer');

	//
	// Add menu to theme
	//
	
	function bonfire_sst_header() {
	?>

        <!-- BEGIN MAIN WRAPPER (show only if Twitch channel name entered) -->
        <?php if( get_theme_mod('sst_channel_name') != '') { ?>
        <div class="sst-main-wrapper">
        <a class="sst-twitch" <?php if( get_theme_mod('sst_new_window') != '') { ?>target="_blank"<?php } ?> href="https://www.twitch.tv/<?php echo get_theme_mod('sst_channel_name'); ?>" data-nickname="<?php echo get_theme_mod('sst_channel_name'); ?>">
                <!-- BEGIN TWITCH LOGO -->
                <div class="sst-twitch-logo-wrapper">
                    <div class="sst-icon-twitch"></div>
                </div>
                <!-- END TWITCH LOGO -->
                <!-- BEGIN STATUS -->
                <div class="sst-status-wrapper">
                    <div class="sst-status-wrapper-inner">
                        <!-- BEGIN IF ONLINE -->
                        <div class="sst-status-text-live">
                            <div class="sst-live-marker"></div>
                            <span>
                                <?php if( get_theme_mod('sst_live_text') != '') { ?>
                                    <?php echo get_theme_mod('sst_live_text'); ?>
                                <?php } else { ?>
                                    <?php esc_html_e( 'LIVE NOW! CLICK TO VIEW.', 'stream-status-for-twitch' ); ?>
                                <?php } ?>
                            </span>
                        </div>
                        <!-- END IF ONLINE -->
                        <!-- BEGIN IF OFFLINE -->
                        <div class="sst-status-text-offline">
                            <span>
                                <?php if( get_theme_mod('sst_offline_text') != '') { ?>
                                    <?php echo get_theme_mod('sst_offline_text'); ?>
                                <?php } else { ?>
                                    <?php esc_html_e( 'CURRENTLY OFFLINE', 'stream-status-for-twitch' ); ?>
                                <?php } ?>
                            </span>
                        </div>
                        <!-- END IF OFFLINE -->
                    </div>
                </div>
                <!-- END STATUS -->
            </a>
        </div>
        <?php } ?>
        <!-- END MAIN WRAPPER (show only if Twitch channel name entered) -->
        
        <script>
        jQuery('.sst-twitch').each(function () {
            var nickname = jQuery(this).data('nickname');
            jQuery.getJSON("https://api.twitch.tv/kraken/streams/"+nickname+"?client_id=ls2awgx5gfg9m1q6iopdqb1b7d0y6a", function(c) {
                if (c.stream == null) {
                    // show if offline (unless 'Hide when not streaming' option enabled)
                    <?php if( get_theme_mod('sst_offline_hide') != '') { ?><?php } else { ?>jQuery('.sst-main-wrapper').addClass('sst-main-wrapper-active');<?php } ?>
                    // animations
                    jQuery('.sst-status-text-offline').addClass('sst-current-status');
                    setTimeout(function() {
                        jQuery('.sst-status-text-offline').addClass('sst-current-status-active');
                        jQuery('.sst-status-wrapper').addClass('sst-status-wrapper-active');
                    }, 25);
                } else {
                    // show if online
                    jQuery('.sst-main-wrapper').addClass('sst-main-wrapper-active');
                    // animations
                    jQuery('.sst-status-text-live').addClass('sst-current-status');
                    setTimeout(function() {
                        jQuery('.sst-status-text-live').addClass('sst-current-status-active');
                        jQuery('.sst-status-wrapper').addClass('sst-status-wrapper-active');
                    }, 25);
                }
            });
        });
        </script>

	<?php
	}
	add_action('wp_head','bonfire_sst_header');

	//
	// ENQUEUE stream-status-for-twitch.css
	//
	function bonfire_sst_css() {
		wp_register_style( 'bonfire-stream-status-for-twitch-css', plugins_url( '/stream-status-for-twitch.css', __FILE__ ) . '', array(), '1', 'all' );
		wp_enqueue_style( 'bonfire-stream-status-for-twitch-css' );
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_sst_css' );

	//
	// ENQUEUE Google WebFonts
	//
    function bonfire_sst_fonts_url() {
		$font_url = '';

		if ( 'off' !== _x( 'on', 'Google font: on or off', 'stream-status-for-twitch' ) ) {
			$font_url = add_query_arg( 'family', urlencode( 'Roboto:500' ), "//fonts.googleapis.com/css" );
		}
		return $font_url;
	}
	function bonfire_sst_scripts() {
		wp_enqueue_style( 'stream-status-for-twitch-fonts', bonfire_sst_fonts_url(), array(), '1.0.0' );
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_sst_scripts' );

	//
	// Insert customization options into the header
	//
	function bonfire_sst_customize() {
	?>
		<!-- BEGIN CUSTOM COLORS (WP THEME CUSTOMIZER) -->
        <style>
        /* background color */
		.sst-status-wrapper { background-color:<?php echo get_theme_mod('sst_background_color'); ?>; }
        /* status text color */
        .sst-status-text-live,
        .sst-status-text-offline { color:<?php echo get_theme_mod('sst_status_text_color'); ?>; }
        /* status text hover */
        .sst-main-wrapper:hover .sst-status-text-live span,
        .sst-main-wrapper:hover .sst-status-text-offline span { color:<?php echo get_theme_mod('sst_status_text_hover_color'); ?>; }
        /* Twitch icon color */
        .sst-icon-twitch { color:<?php echo get_theme_mod('sst_twitch_icon_color'); ?>; }
        /* Twitch icon background color */
        .sst-twitch-logo-wrapper { background-color:<?php echo get_theme_mod('sst_twitch_icon_background_color'); ?>; }
        .sst-status-wrapper { border-color:<?php echo get_theme_mod('sst_twitch_icon_background_color'); ?>; }
        
        /* absolute positioning */
        <?php if( get_theme_mod('sst_absolute_position') != '') { ?>
        .sst-main-wrapper { position:absolute; }
        <?php } ?>
        
        /* distances (if at top) */
        .sst-main-wrapper {
            top:<?php echo get_theme_mod('sst_vertical_distance'); ?>px;
            left:<?php echo get_theme_mod('sst_horizontal_distance'); ?>px;
        }
        
        /* bottom placement + distances (if at bottom) */
        <?php $bonfire_sst_placement = get_theme_mod('sst_placement'); if($bonfire_sst_placement != '') { switch ($bonfire_sst_placement) { case 'bottom': ?>
        .sst-main-wrapper {
            top:auto;
            bottom:25px;
        }
        .sst-main-wrapper {
            top:auto;
            bottom:<?php echo get_theme_mod('sst_vertical_distance'); ?>px;
        }
        <?php break; } } ?>
        
        /* no status text underline */
        <?php if( get_theme_mod('sst_no_underline') != '') { ?>
        .sst-main-wrapper:hover .sst-status-text-live span,
        .sst-main-wrapper:hover .sst-status-text-offline span { text-decoration:none; }
        <?php } ?>
		</style>
		<!-- END CUSTOM COLORS (WP THEME CUSTOMIZER) -->
	
	<?php
	}
	add_action('wp_head','bonfire_sst_customize');

?>