<?php
$action = isset($_GET['action']) ? sanitize_text_field($_GET['action']) : '';
$id = isset($_GET['popupbox']) ? absint( intval($_GET['popupbox']) ) : null;
$ays_pb_tab = isset($_GET['ays_pb_tab']) ? sanitize_text_field($_GET['ays_pb_tab']) : 'tab1';

if (isset($_POST['ays_submit']) || isset($_POST['ays_submit_top'])) {
    $_POST['id'] = $id;
    $this->popupbox_obj->add_or_edit_popupbox();
}

if (isset($_POST['ays_apply']) || isset($_POST['ays_apply_top'])) {
    $_POST['id'] = $id;
    $_POST['submit_type'] = 'apply';
    $this->popupbox_obj->add_or_edit_popupbox();
}

$show_warning_note = !isset($_COOKIE['ays_pb_show_warning_note']);

$heading = '';
$loader_image  = "<span class='display_none'><img width='20' height='20' src=" . AYS_PB_ADMIN_URL . "/images/loaders/loading.gif></span>";
$ays_pb_page_url = sprintf('?page=%s', 'ays-pb');

$allow_tags_acordion_arrow = array(
    'div' => array(
        'class' => array()
    ),
    'svg' => array(
        'class' => array(),
        'version' => array(),
        'xmlns' => array(),
        'xmlns:xlink' => array(), 
        'overflow' => array(),
        'preserveAspectRatio' => array(),
        'viewBox' => array(),
        'width' => array(),
        'height' => array()
    ),
    'g' => array(),
    'path' => array(
        'xmlns:default' => array(),
        'd' => array(),
        'fill' => array(),
        'vector-effect' => array()
    )
);

$pb_acordion_svg_html = '
<div class="ays-pb-accordion-arrow-box">
    <svg class="ays-pb-accordion-arrow ays-pb-accordion-arrow-active" version="1.2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" overflow="visible" preserveAspectRatio="none" viewBox="0 0 24 24" width="32" height="32">
        <g>
            <path xmlns:default="http://www.w3.org/2000/svg" d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z" fill="#c4c4c4" vector-effect="non-scaling-stroke" />
        </g>
    </svg>
</div>';

// All popups
$get_all_popups = Ays_Pb_Data::get_popups();

$args = array(
    'public' => true
);
$all_post_types = get_post_types($args, 'objects');

// Popup categories
$popup_categories = $this->popupbox_obj->get_popup_categories();

$default_notification_type_components = array(
    'logo' => 'off',
    'main_content' => 'on',
    'button_1' => 'on',
);

$default_notification_type_component_names = array(
    'logo' => esc_html__('Logo', "ays-popup-box"),
    'main_content' => esc_html__('Content', "ays-popup-box"),
    'button_1' => esc_html__('Button', "ays-popup-box"),
);

$user_id = get_current_user_id();
$user = get_userdata($user_id);
$author = array(
    'id' => $user->ID,
    'name' => $user->data->display_name
);

$x = '✕';

$social_links_default = array(
    'linkedin_link'  => '',
    'facebook_link'  => '',
    'twitter_link'   => '',
    'vkontakte_link' => '',
    'youtube_link'   => '',
    'instagram_link' => '',
    'behance_link'   => '',
    'telegram_link'  => '',
    'tiktok_link'    => '',
);

$image_sizing_options = array(
    'cover'   => esc_html__('Cover', "ays-popup-box"),
    'contain' => esc_html__('Contain', "ays-popup-box"),
    'none'    => esc_html__('None', "ays-popup-box"),
    'unset'   => esc_html__('Unset', "ays-popup-box"),
);

$text_transform_options = array(
    'none'       => esc_html__('None', "ays-popup-box"),
    'capitalize' => esc_html__('Capitalize', "ays-popup-box"),
    'uppercase'  => esc_html__('Uppercase', "ays-popup-box"),
    'lowercase'  => esc_html__('Lowercase', "ays-popup-box"),
);

$text_decoration_options = array(
    'none' => esc_html__('None', "ays-popup-box"),
    'overline' => esc_html__('Overline', "ays-popup-box"),
    'line-through' => esc_html__('Line through', "ays-popup-box"),
    'underline' => esc_html__('Underline', "ays-popup-box"),
);

$font_weight_options = array(
    'normal'  => esc_html__('Normal', "ays-popup-box"),
    'lighter' => esc_html__('Lighter', "ays-popup-box"),
    'bold'    => esc_html__('Bold', "ays-popup-box"),
    'bolder'  => esc_html__('Bolder', "ays-popup-box"),
    '100' => '100',
    '200' => '200',
    '300' => '300',
    '400' => '400',
    '500' => '500',
    '600' => '600',
    '700' => '700',
    '800' => '800',
    '900' => '900',
);

$border_styles = array(
    'solid'  => esc_html__('Solid',"ays-popup-box"),
    'dotted' => esc_html__('Dotted',"ays-popup-box"),
    'dashed' => esc_html__('Dashed',"ays-popup-box"),
    'double' => esc_html__('Double',"ays-popup-box"),
    'groove' => esc_html__('Groove',"ays-popup-box"),
    'ridge'  => esc_html__('Ridge',"ays-popup-box"),
    'inset'  => esc_html__('Inset',"ays-popup-box"),
    'outset' => esc_html__('Outset',"ays-popup-box"),
);

$font_families = array(
    'inherit' => esc_html__('Inherit', "ays-popup-box"),
    'arial' => esc_html__('Arial', "ays-popup-box"),
    'arial black' => esc_html__('Arial Black', "ays-popup-box"),
    'book antique' => esc_html__('Book Antique', "ays-popup-box"),
    'courier new' => esc_html__('Courier New', "ays-popup-box"),
    'cursive' => esc_html__('Cursive', "ays-popup-box"),
    'fantasy' => esc_html__('Fantasy', "ays-popup-box"),
    'georgia' => esc_html__('Georgia', "ays-popup-box"),
    'helvetica' => esc_html__('Helvetia', "ays-popup-box"),
    'impact' => esc_html__('Impact', "ays-popup-box"),
    'lusida console' => esc_html__('Lusida Console', "ays-popup-box"),
    'palatino linotype' => esc_html__('Palatino Linotype', "ays-popup-box"),
    'tahoma' => esc_html__('Tahoma', "ays-popup-box"),
    'times new roman' => esc_html__('Times New Roman', "ays-popup-box"),
);

$options = array(
    // General
    'author' => $author,
    'video_theme_url' => '',
    'image_type_img_src' => '',
    'image_type_img_redirect_url' => '',
    'image_type_img_redirect_to_new_tab' => 'off',
    'facebook_page_url' => 'https://www.facebook.com/wordpress',
    'hide_fb_page_cover_photo' => 'off',
    'use_small_fb_header' => 'on',
    'notification_type_components' => array(),
    'notification_type_components_order' => array(),
    'notification_logo_image' => '',
    'notification_logo_redirect_url' => '',
    'notification_logo_redirect_to_new_tab' => 'off',
    'notification_logo_width' => 100,
    'notification_logo_width_measurement_unit' => 'percentage',
    'notification_logo_width_mobile' => 100,
    'notification_logo_width_measurement_unit_mobile' => 'percentage',
    'notification_logo_max_width' => 100,
    'notification_logo_max_width_measurement_unit' => 'pixels',
    'notification_logo_max_width_mobile' => 100,
    'notification_logo_max_width_measurement_unit_mobile' => 'pixels',
    'notification_logo_min_width' => 50,
    'notification_logo_min_width_measurement_unit' => 'pixels',
    'notification_logo_min_width_mobile' => 50,
    'notification_logo_min_width_measurement_unit_mobile' => 'pixels',
    'notification_logo_max_height' => '',
    'notification_logo_min_height' => '',
    'notification_logo_image_sizing' => 'cover',
    'notification_logo_image_sizing' => 'rectangle',
    'notification_main_content' => 'Write the custom notification banner text here.',
    'notification_button_1_text' => 'Click!',
    'notification_button_1_hover_text' => 'Click!',
    'notification_button_1_redirect_url' => '',
    'notification_button_1_redirect_to_new_tab' => 'off',
    'notification_button_1_bg_color' => '#F66123',
    'notification_button_1_bg_hover_color' => '#F66123',
    'notification_button_1_text_color' => '#FFFFFF',
    'notification_button_1_text_hover_color' => '#FFFFFF',
    'notification_button_1_text_transformation' => 'none',
    'notification_button_1_text_decoration' => 'none',
    'notification_button_1_letter_spacing' => 0,
    'notification_button_1_letter_spacing_mobile' => 0,
    'notification_button_1_font_size' => 15,
    'notification_button_1_font_size_mobile' => 15,
    'notification_button_1_font_weight' => 'normal',
    'notification_button_1_font_weight_mobile' => 'normal',
    'notification_button_1_border_radius' => 6,
    'notification_button_1_border_width' => 0,
    'notification_button_1_border_color' => '#FFFFFF',
    'notification_button_1_border_style' => 'solid',
    'notification_button_1_padding_left_right' => 32,
    'notification_button_1_padding_top_bottom' => 12,
    'notification_button_1_transition' => '0.3',
    'notification_button_1_enable_box_shadow' => 'off',
    'notification_button_1_box_shadow_color' => '#FF8319',
    'notification_button_1_box_shadow_x_offset' => 0,
    'notification_button_1_box_shadow_y_offset' => 0,
    'notification_button_1_box_shadow_z_offset' => 10,
    'except_post_types' => array(),
    'except_posts' => array(),
    'show_on_home_page' => 'off',
    'all_posts' => '',
    'enable_pb_position_mobile' => 'off',
    'pb_position_mobile' => 'center-center',
    // Settings
    'enable_open_delay_mobile' => 'off',
    'open_delay_mobile' => 0,
    'enable_scroll_top_mobile' => 'off',
    'scroll_top_mobile' => 0,
    'close_popup_esc' => 'on',
    'close_popup_overlay' => 'off',
    'close_popup_overlay_mobile' => 'off',
    'ays_pb_hover_show_close_btn' => 'off',
    'close_button_position' => 'right-top',
    'enable_close_button_position_mobile' => 'off',
    'close_button_position_mobile' => 'right-top',
    'close_button_text' => $x,
    'enable_close_button_text_mobile' => 'off',
    'close_button_text_mobile' => $x,
    'close_button_hover_text' => '',
    'enable_autoclose_delay_text_mobile' => 'off',
    'pb_autoclose_mobile' => 20,
    'enable_hide_timer' => 'off',
    'enable_hide_timer_mobile' => 'off',
    'enable_autoclose_on_completion' => 'off',
    'close_button_delay' => 0,
    'enable_close_button_delay_for_mobile' => 'off',
    'close_button_delay_for_mobile' => 0,
    'enable_overlay_text_mobile' => 'off',
    'overlay_mobile_opacity' => '0.5',
    'blured_overlay' => 'off',
    'blured_overlay_mobile' => 'off',
    'enable_pb_sound' => 'off',
    'enable_social_links' => 'off',
    'social_buttons_heading' => '',
    'social_links' => $social_links_default,
    'create_date' => current_time( 'mysql' ),
    'create_author' => $user_id,
    'enable_dismiss' => 'off',
    'enable_dismiss_text' => 'Dismiss ad',
    'enable_dismiss_moible' => 'off',
    'enable_dismiss_text_mobile' => 'Dismiss ad',
    'disable_scroll' => 'off',
    'disable_scroll_mobile' => 'off',
    'disable_scroll_on_popup' => 'off',
    'disable_scroll_on_popup_mobile' => 'off',
    'show_scrollbar' => 'off',
    'show_scrollbar_mobile' => 'off',
    // Styles
    'enable_display_content_mobile' => 'off',
    'show_popup_title_mobile' => 'off',
    'show_popup_desc_mobile' => 'off',
    'popup_width_by_percentage_px' => 'pixels',
    'popup_width_by_percentage_px_mobile' => 'percentage',
    'mobile_width' => '',
    'mobile_max_width' => '',
    'mobile_height' => '',
    'pb_max_height' => '',
    'popup_max_height_by_percentage_px' => 'pixels',
    'pb_max_height_mobile' => '',
    'popup_max_height_by_percentage_px_mobile' => 'pixels',
    'pb_min_height' => '',
    'enable_pb_fullscreen' => 'off',
    'popup_content_padding' => 20,
    'popup_content_padding_mobile' => 20,
    'popup_padding_by_percentage_px' => 'pixels',
    'pb_font_family' => 'inherit',
    'pb_font_size' => 13,
    'pb_font_size_for_mobile' => 13,
    'pb_description_alignment_for_pc' => 'left',
    'pb_description_alignment_for_mobile' => 'left',
    'enable_pb_title_text_shadow' => 'off',
    'pb_title_text_shadow' => 'rgba(255,255,255,0)',
    'pb_title_text_shadow_x_offset' => 2,
    'pb_title_text_shadow_y_offset' => 2,
    'pb_title_text_shadow_z_offset' => 0,
    'enable_pb_title_text_shadow_mobile' => 'off',
    'pb_title_text_shadow_mobile' => 'rgba(255,255,255,0)',
    'pb_title_text_shadow_x_offset_mobile' => 2,
    'pb_title_text_shadow_y_offset_mobile' => 2,
    'pb_title_text_shadow_z_offset_mobile' => 0,
    'enable_animate_in_mobile' => 'off',
    'animate_in_mobile' => 'fadeIn',
    'enable_animate_out_mobile' => 'off',
    'animate_out_mobile' => 'fadeOut',
    'animation_speed' => 1,
    'enable_animation_speed_mobile' => 'off',
    'animation_speed_mobile' => 1,
    'close_animation_speed' => 1,
    'enable_close_animation_speed_mobile' => 'off',
    'close_animation_speed_mobile' => 1,
    'enable_bgcolor_mobile' => 'off',
    'enable_header_bgcolor_mobile' => 'off',
    'header_bgcolor_mobile' => '#ffffff',
    'bgcolor_mobile' => '#ffffff',
    'enable_bg_image_mobile' => 'off',
    'bg_image_mobile' => '',
    'pb_bg_image_position' => 'center-center',
    'enable_pb_bg_image_position_mobile' => 'off',
    'pb_bg_image_position_mobile' => 'center-center',
    'pb_bg_image_sizing' => 'cover',
    'enable_pb_bg_image_sizing_mobile' => 'off',
    'pb_bg_image_sizing_mobile' => 'cover',
    'enable_background_gradient' => 'off',
    'background_gradient_color_1' => '#000',
    'background_gradient_color_2' => '#fff',
    'pb_gradient_direction' => 'vertical',
    'enable_background_gradient_mobile' => 'off',
    'background_gradient_color_1_mobile' => '#000',
    'background_gradient_color_2_mobile' => '#fff',
    'pb_gradient_direction_mobile' => 'vertical',
    'overlay_color' => '#000',
    'enable_overlay_color_mobile' => 'off',
    'overlay_color_mobile' => '#000',
    'enable_bordersize_mobile' => 'off',
    'bordersize_mobile' => 1,
    'border_style' => 'solid',
    'enable_border_style_mobile' => 'off',
    'border_style_mobile' => 'solid',
    'enable_bordercolor_mobile' => 'off',
    'bordercolor_mobile' => '#ffffff',
    'enable_border_radius_mobile' => 'off',
    'border_radius_mobile' => 4,
    'close_button_image' => '',
    'close_button_color' => '#000000',
    'close_button_hover_color' => '#000000',
    'close_button_size' => 1,
    'enable_box_shadow' => 'off',
    'box_shadow_color' => '#000',
    'pb_box_shadow_x_offset' => 0,
    'pb_box_shadow_y_offset' => 0,
    'pb_box_shadow_z_offset' => 15,
    'enable_box_shadow_mobile' => 'off',
    'box_shadow_color_mobile' => '#000',
    'pb_box_shadow_x_offset_mobile' => 0,
    'pb_box_shadow_y_offset_mobile' => 0,
    'pb_box_shadow_z_offset_mobile' => 15,
    'pb_bg_image_direction_on_mobile' => 'on',
    // Limitation Users
    'show_only_once' => 'off',
    'pb_mobile' => 'off',
    'hide_on_pc' => 'off',
    'hide_on_tablets' => 'off',
);

$popupbox = array(
    'id' => null,
    'title' => 'Default title',
    'popup_name' => '',
    'description' => 'Demo Description',
    'category_id' => 1,
    'autoclose' => 20,
    'cookie' => 0,
    'width' => 400,
    'height' => 500,
    'bgcolor' => '#ffffff',
    'textcolor' => '#000000',
    'bordersize' => 1,
    'bordercolor' => '#ffffff',
    'border_radius' => 4,
    'shortcode' => '',
    'users_role' => '',
    'custom_class' => '',
    'custom_css' => '',
    'custom_html' => 'Here can be your custom HTML or Shortcode',
    'onoffswitch' => 'On',
    'show_only_for_author' => 'off',
    'show_all' => 'all',
    'delay' => 0,
    'scroll_top' => 0,
    'animate_in' => 'fadeIn',
    'animate_out' => 'fadeOut',
    'action_button' => '',
    'view_place' => '',
    'action_button_type' => 'both',
    'modal_content' => '',
    'view_type' => 'default',
    'onoffoverlay' => 'On',
    'overlay_opacity' => '0.5',
    'show_popup_title' => 'off',
    'show_popup_desc' => 'off',
    'close_button' => 'Off',
    'header_bgcolor' => '#ffffff',
    'bg_image' => '',
    'log_user' => 'On',
    'guest' => 'On',
    'active_date_check' => 'off',
    'activeInterval' => '',
    'deactiveInterval' => '',
    'active_time_check' => 'off',
    'active_time_start' => '',
    'active_time_end' => '',
    'pb_position' => 'center-center',
    'pb_margin' => 0,
    'views' => 0,
    'conversions' => 0,
    'options' => json_encode($options),
);

switch ($action) {
    case 'add':
        $heading = 'Add new PopupBox';
        break;
    case 'edit':
        $heading = 'Edit PopupBox';
        $popupbox = $this->popupbox_obj->get_popupbox_by_id($id);
        break;
    case 'duplicate':
        $heading = 'Duplicate PopupBox';
        $this->popupbox_obj->duplicate_popupbox($id);
        break;
}

// General Settings | options
$gen_options = ($this->settings_obj->ays_get_setting('options') === false) ? array() : json_decode( stripcslashes($this->settings_obj->ays_get_setting('options')), true );

// WP Editor height
$pb_wp_editor_height = (isset($gen_options['pb_wp_editor_height']) && $gen_options['pb_wp_editor_height'] != '') ? absint( sanitize_text_field($gen_options['pb_wp_editor_height']) ) : 150;

// Popup options
$options = (isset($popupbox['options']) && $popupbox['options'] != '') ? json_decode($popupbox['options'], true) : array();

// Change the popup creation date
$pb_create_date = (isset($options['create_date']) && Ays_Pb_Admin::validateDate($options['create_date'])) ? $options['create_date'] : current_time( 'mysql' );

// Popup author
if (isset($options['author']) && $options['author'] != '') {
    if ( !is_array($options['author']) ) {
        $options['author'] = json_decode($options['author'], true);
    }

    $pb_author = array_map( 'stripslashes', $options['author'] );
} else {
    $pb_author = array('name' => 'Unknown');
}

// Popup type
$modal_content = (isset($popupbox['modal_content']) && $popupbox['modal_content'] != '') ? stripslashes( esc_attr($popupbox['modal_content']) ) : '';

$modal_content_name = '';
$video_tutorial = '';
switch ($modal_content) {
    case 'custom_html':
        $modal_content_name = esc_html__("Custom Content", "ays-popup-box");
        break;
    case 'shortcode':
        $modal_content_name = esc_html__("Shortcode", "ays-popup-box");
        $video_tutorial = '<a href="https://www.youtube.com/watch?v=q6ai1WhpLfc">' . esc_html__("Watch how to add a shortcode popup", "ays-popup-box") . '</a>';
        break;
    case 'video_type':
        $modal_content_name = esc_html__("Video", "ays-popup-box");
        $video_tutorial = '<a href="https://www.youtube.com/watch?v=oOvHTcePpys">' . esc_html__("Watch how to add a video popup", "ays-popup-box") . '</a>';
        break;
    case 'image_type':
        $modal_content_name = esc_html__("Image", "ays-popup-box");
        break;
    case 'facebook_type':
        $modal_content_name = esc_html__("Facebook", "ays-popup-box");
        break;
    case 'notification_type':
        $modal_content_name = esc_html__("Notification", "ays-popup-box");
        break;
    default:
        $modal_content_name = esc_html__("Custom Content", "ays-popup-box");
        break;
}

// Template
$view_type = (isset($popupbox['view_type']) && $popupbox['view_type'] != '') ? stripslashes( esc_attr($popupbox['view_type']) ) : '';

// Popup title
$title = (isset($popupbox['title']) && $popupbox['title'] != '') ? stripslashes( esc_attr($popupbox['title']) ) : 'Default title';

// Enable popup
$onoffswitch = (isset($popupbox['onoffswitch']) && $popupbox['onoffswitch'] != '') ? esc_attr($popupbox['onoffswitch']) : 'On';

// Shortcode type | Shortcode
$shortcode = (isset($popupbox['shortcode']) && $popupbox['shortcode'] != '') ? htmlentities($popupbox['shortcode']) : '';

// Custom content type | Custom content
$custom_html = (isset($popupbox['custom_html']) && $popupbox['custom_html'] != '') ? stripslashes($popupbox['custom_html']) : '';

// Video type | Video
$ays_video_theme_bg = (isset($options['video_theme_url']) && !empty($options['video_theme_url'])) ? esc_url($options['video_theme_url']) : '';

// Video type | Live container video src
$live_container_video_src = ($ays_video_theme_bg != '') ? $ays_video_theme_bg : AYS_PB_ADMIN_URL . '/videos/video_theme.mp4';

// Image type | Main image
$image_type_img_src = (isset($options['image_type_img_src']) && $options['image_type_img_src'] != '') ? esc_url($options['image_type_img_src']) : '';

// Image type | Redirect URL
$image_type_img_redirect_url = (isset($options['image_type_img_redirect_url']) && $options['image_type_img_redirect_url'] != '') ? esc_url($options['image_type_img_redirect_url']) : '';

// Image type | Redirect to the new tab
$image_type_img_redirect_to_new_tab = (isset($options['image_type_img_redirect_to_new_tab']) && $options['image_type_img_redirect_to_new_tab'] == 'on') ? true : false;

// Facebook type | Facebook page URL
$facebook_page_url = (isset($options['facebook_page_url']) && $options['facebook_page_url'] != '') ? esc_url($options['facebook_page_url']) : '';

// Facebook type | Hide FB page cover photo
$hide_fb_page_cover_photo = (isset($options['hide_fb_page_cover_photo']) && $options['hide_fb_page_cover_photo'] == 'on') ? true : false;

// Facebook type | Use small FB header
$use_small_fb_header = (isset($options['use_small_fb_header']) && $options['use_small_fb_header'] == 'on') ? true : false;

// Notification type | Components, Components order
$options['notification_type_components'] = (isset($options['notification_type_components']) && !empty($options['notification_type_components']))  ? $options['notification_type_components'] : $default_notification_type_components;
$notification_type_components = (isset($options['notification_type_components']) && !empty($options['notification_type_components'])) ? $options['notification_type_components'] : array();
$notification_type_components_order = (isset($options['notification_type_components_order']) && !empty($options['notification_type_components_order'])) ? $options['notification_type_components_order'] : $default_notification_type_components;
foreach ($default_notification_type_components as $key => $value) {
    if ( !isset($notification_type_components[$key]) ) {
        $notification_type_components[$key] = 'off';
    }

    if ( !isset($notification_type_components_order[$key]) ) {
        $notification_type_components_order[$key] = 'off';
    }
}

foreach ($notification_type_components_order as $key => $value) {
    if ( !isset($notification_type_components[$key]) ) {
        $notification_type_components_order[$key] = 'off';
    }
}

// Notification type | Logo
$notification_logo_image = (isset($options['notification_logo_image']) && $options['notification_logo_image'] != '') ? esc_url($options['notification_logo_image']) : '';

// Notification type | Logo redirect URL
$notification_logo_redirect_url = (isset($options['notification_logo_redirect_url']) && $options['notification_logo_redirect_url'] != '') ? esc_url($options['notification_logo_redirect_url']) : '';

// Notification type | Logo redirect to the new tab
$notification_logo_redirect_to_new_tab = (isset($options['notification_logo_redirect_to_new_tab']) && $options['notification_logo_redirect_to_new_tab'] == 'on') ? true : false;

// Notification type | Logo width | On desktop
$notification_logo_width = (isset($options['notification_logo_width']) && $options['notification_logo_width'] != '') ? absint( esc_attr($options['notification_logo_width']) ) : 100;

// Notification type | Logo width | Measurement unit | On desktop
$notification_logo_width_measurement_unit = (isset($options['notification_logo_width_measurement_unit']) && $options['notification_logo_width_measurement_unit'] != '') ? stripslashes( esc_attr($options['notification_logo_width_measurement_unit']) ) : 'percentage';

// Notification type | Logo width | On mobile
$notification_logo_width_mobile = (isset($options['notification_logo_width_mobile']) && $options['notification_logo_width_mobile'] != '') ? absint( esc_attr($options['notification_logo_width_mobile']) ) : $notification_logo_width;

// Notification type | Logo width | Measurement unit | On mobile
$notification_logo_width_measurement_unit_mobile = (isset($options['notification_logo_width_measurement_unit_mobile']) && $options['notification_logo_width_measurement_unit_mobile'] != '') ? stripslashes( esc_attr($options['notification_logo_width_measurement_unit_mobile']) ) : $notification_logo_width_measurement_unit;

// Notification type | Logo max-width | On desktop
$notification_logo_max_width = (isset($options['notification_logo_max_width']) && $options['notification_logo_max_width'] != '') ? absint( esc_attr($options['notification_logo_max_width']) ) : 100;

// Notification type | Logo max-width | Measurement unit | On desktop
$notification_logo_max_width_measurement_unit = (isset($options['notification_logo_max_width_measurement_unit']) && $options['notification_logo_max_width_measurement_unit'] != '') ? stripslashes( esc_attr($options['notification_logo_max_width_measurement_unit']) ) : 'pixels';

// Notification type | Logo max-width | On mobile
$notification_logo_max_width_mobile = (isset($options['notification_logo_max_width_mobile']) && $options['notification_logo_max_width_mobile'] != '') ? absint( esc_attr($options['notification_logo_max_width_mobile']) ) : $notification_logo_max_width;

// Notification type | Logo max-width | Measurement unit | On mobile
$notification_logo_max_width_measurement_unit_mobile = (isset($options['notification_logo_max_width_measurement_unit_mobile']) && $options['notification_logo_max_width_measurement_unit_mobile'] != '') ? stripslashes( esc_attr($options['notification_logo_max_width_measurement_unit_mobile']) ) : $notification_logo_max_width_measurement_unit;

// Notification type | Logo min-width | On desktop
$notification_logo_min_width = (isset($options['notification_logo_min_width']) && $options['notification_logo_min_width'] != '') ? absint( esc_attr($options['notification_logo_min_width']) ) : 50;

// Notification type | Logo min-width | Measurement unit | On desktop
$notification_logo_min_width_measurement_unit = (isset($options['notification_logo_min_width_measurement_unit']) && $options['notification_logo_min_width_measurement_unit'] != '') ? stripslashes( esc_attr($options['notification_logo_min_width_measurement_unit']) ) : 'pixels';

// Notification type | Logo min-width | On mobile
$notification_logo_min_width_mobile = (isset($options['notification_logo_min_width_mobile']) && $options['notification_logo_min_width_mobile'] != '') ? absint( esc_attr($options['notification_logo_min_width_mobile']) ) : $notification_logo_min_width;

// Notification type | Logo min-width | Measurement unit | On mobile
$notification_logo_min_width_measurement_unit_mobile = (isset($options['notification_logo_min_width_measurement_unit_mobile']) && $options['notification_logo_min_width_measurement_unit_mobile'] != '') ? stripslashes( esc_attr($options['notification_logo_min_width_measurement_unit_mobile']) ) : $notification_logo_min_width_measurement_unit;

// Notification type | Logo max-height
$notification_logo_max_height = (isset($options['notification_logo_max_height']) && $options['notification_logo_max_height'] != '') ? absint( esc_attr($options['notification_logo_max_height']) ) : '';

// Notification type | Logo min-height
$notification_logo_min_height = (isset($options['notification_logo_min_height']) && $options['notification_logo_min_height'] != '') ? absint( esc_attr($options['notification_logo_min_height']) ) : '';

// Notification type | Logo image sizing
$notification_logo_image_sizing = (isset($options['notification_logo_image_sizing']) && $options['notification_logo_image_sizing'] != '') ? stripslashes( esc_attr($options['notification_logo_image_sizing']) ) : 'cover';

// Notification type | Logo image shape
$notification_logo_image_shape = (isset($options['notification_logo_image_shape']) && $options['notification_logo_image_shape'] != '') ? stripslashes( esc_attr($options['notification_logo_image_shape']) ) : 'rectangle';

// Notification type | Main content
$notification_main_content = (isset($options['notification_main_content']) && $options['notification_main_content'] != '') ? stripslashes($options['notification_main_content']) : 'Write the custom notification banner text here.';

// Notification type | Button 1 text
$notification_button_1_text = (isset($options['notification_button_1_text']) && $options['notification_button_1_text'] != '') ? stripslashes( esc_attr($options['notification_button_1_text']) ) : 'Click!';

// Notification type | Button 1 hover text
$notification_button_1_hover_text = (isset($options['notification_button_1_hover_text']) && $options['notification_button_1_hover_text'] != '') ? stripslashes( esc_attr($options['notification_button_1_hover_text']) ) : '';

// Notification type | Button 1 redirect URL
$notification_button_1_redirect_url = (isset($options['notification_button_1_redirect_url']) && $options['notification_button_1_redirect_url'] != '') ? esc_url($options['notification_button_1_redirect_url']) : '';

// Notification type | Button 1 redirect to the new tab
$notification_button_1_redirect_to_new_tab = (isset($options['notification_button_1_redirect_to_new_tab']) && $options['notification_button_1_redirect_to_new_tab'] == 'on') ? true : false;

// Notification type | Button 1 background color
$notification_button_1_bg_color = (isset($options['notification_button_1_bg_color']) && $options['notification_button_1_bg_color'] != '') ? stripslashes( esc_attr($options['notification_button_1_bg_color']) ) : '#F66123';

// Notification type | Button 1 background color
$notification_button_1_bg_hover_color = (isset($options['notification_button_1_bg_hover_color']) && $options['notification_button_1_bg_hover_color'] != '') ? stripslashes( esc_attr($options['notification_button_1_bg_hover_color']) ) : $notification_button_1_bg_color;

// Notification type | Button 1 text color
$notification_button_1_text_color = (isset($options['notification_button_1_text_color']) && $options['notification_button_1_text_color'] != '') ? stripslashes( esc_attr($options['notification_button_1_text_color']) ) : '#FFFFFF';

// Notification type | Button 1 text hover color
$notification_button_1_text_hover_color = (isset($options['notification_button_1_text_hover_color']) && $options['notification_button_1_text_hover_color'] != '') ? stripslashes( esc_attr($options['notification_button_1_text_hover_color']) ) : $notification_button_1_text_color;

// Notification type | Button 1 text transformation
$notification_button_1_text_transformation = (isset($options['notification_button_1_text_transformation']) && $options['notification_button_1_text_transformation'] != '') ? stripslashes( esc_attr($options['notification_button_1_text_transformation']) ) : 'none';

// Notification type | Button 1 text decoration
$notification_button_1_text_decoration = (isset($options['notification_button_1_text_decoration']) && $options['notification_button_1_text_decoration'] != '') ? stripslashes( esc_attr($options['notification_button_1_text_decoration']) ) : 'none';

// Notification type | Button 1 letter spacing | On desktop
$notification_button_1_letter_spacing = (isset($options['notification_button_1_letter_spacing']) && $options['notification_button_1_letter_spacing'] != '') ? absint( esc_attr($options['notification_button_1_letter_spacing']) ) : 0;

// Notification type | Button 1 letter spacing | On mobile
$notification_button_1_letter_spacing_mobile = (isset($options['notification_button_1_letter_spacing_mobile']) && $options['notification_button_1_letter_spacing_mobile'] != '') ? absint( esc_attr($options['notification_button_1_letter_spacing_mobile']) ) : $notification_button_1_letter_spacing;

// Notification type | Button 1 font size | On desktop
$notification_button_1_font_size = (isset($options['notification_button_1_font_size']) && $options['notification_button_1_font_size'] != '') ? absint( esc_attr($options['notification_button_1_font_size']) ) : 15;

// Notification type | Button 1 font size | On mobile
$notification_button_1_font_size_mobile = (isset($options['notification_button_1_font_size_mobile']) && $options['notification_button_1_font_size_mobile'] != '') ? absint( esc_attr($options['notification_button_1_font_size_mobile']) ) : $notification_button_1_font_size;

// Notification type | Button 1 font weight | On desktop
$notification_button_1_font_weight = (isset($options['notification_button_1_font_weight']) && $options['notification_button_1_font_weight'] != '') ? stripslashes( esc_attr($options['notification_button_1_font_weight']) ) : 'normal';

// Notification type | Button 1 font weight | On mobile
$notification_button_1_font_weight_mobile = (isset($options['notification_button_1_font_weight_mobile']) && $options['notification_button_1_font_weight_mobile'] != '') ? stripslashes( esc_attr($options['notification_button_1_font_weight_mobile']) ) : $notification_button_1_font_weight;

// Notification type | Button 1 border radius
$notification_button_1_border_radius = (isset($options['notification_button_1_border_radius']) && $options['notification_button_1_border_radius'] != '') ? absint( esc_attr($options['notification_button_1_border_radius']) ) : 6;

// Notification type | Button 1 border width
$notification_button_1_border_width = (isset($options['notification_button_1_border_width']) && $options['notification_button_1_border_width'] != '') ? absint( esc_attr($options['notification_button_1_border_width']) ) : 0;

// Notification type | Button 1 border color
$notification_button_1_border_color = (isset($options['notification_button_1_border_color']) && $options['notification_button_1_border_color'] != '') ? stripslashes( esc_attr($options['notification_button_1_border_color']) ) : '#FFFFFF';

// Notification type | Button 1 border style
$notification_button_1_border_style = (isset($options['notification_button_1_border_style']) && $options['notification_button_1_border_style'] != '') ? stripslashes( esc_attr($options['notification_button_1_border_style']) ) : 'solid';

// Notification type | Button 1 padding left/right
$notification_button_1_padding_left_right = (isset($options['notification_button_1_padding_left_right']) && $options['notification_button_1_padding_left_right'] !== '') ? absint( esc_attr($options['notification_button_1_padding_left_right']) ) : 32;

// Notification type | Button 1 padding top/bottom
$notification_button_1_padding_top_bottom = (isset($options['notification_button_1_padding_top_bottom']) && $options['notification_button_1_padding_top_bottom'] !== '') ? absint( esc_attr($options['notification_button_1_padding_top_bottom']) ) : 12;

// Notification type | Button 1 padding transition
$notification_button_1_transition = (isset($options['notification_button_1_transition']) && $options['notification_button_1_transition'] !== '') ? stripslashes( esc_attr($options['notification_button_1_transition']) ) : '0.3';

// Notification type | Button 1 box shadow
$notification_button_1_enable_box_shadow = (isset($options['notification_button_1_enable_box_shadow']) && $options['notification_button_1_enable_box_shadow'] == 'on') ? true : false;

// Notification type | Button 1 box shadow color
$notification_button_1_box_shadow_color = (isset($options['notification_button_1_box_shadow_color']) && $options['notification_button_1_box_shadow_color'] != '') ? stripslashes( esc_attr($options['notification_button_1_box_shadow_color']) ) : '#FF8319';

// Notification type | Button 1 box shadow X offset
$notification_button_1_box_shadow_x_offset = (isset($options['notification_button_1_box_shadow_x_offset']) && $options['notification_button_1_box_shadow_x_offset'] != '') ? absint( intval($options['notification_button_1_box_shadow_x_offset']) ) : 0;

// Notification type | Button 1 box shadow Y offset
$notification_button_1_box_shadow_y_offset = (isset($options['notification_button_1_box_shadow_y_offset']) && $options['notification_button_1_box_shadow_y_offset'] != '') ? absint( intval($options['notification_button_1_box_shadow_y_offset']) ) : 0;

// Notification type | Button 1 box shadow Z offset
$notification_button_1_box_shadow_z_offset = (isset($options['notification_button_1_box_shadow_z_offset']) && $options['notification_button_1_box_shadow_z_offset'] != '') ? absint( intval($options['notification_button_1_box_shadow_z_offset']) ) : 10;

// Popup description
$description = (isset($popupbox['description']) && $popupbox['description'] != '') ? stripslashes($popupbox['description']) : '';

// Show popup only for author
$popupbox['show_only_for_author'] = (isset($popupbox['show_only_for_author']) && $popupbox['show_only_for_author'] == 'on') ? esc_attr($popupbox['show_only_for_author']) : 'off';
$show_only_for_author = (isset($popupbox['show_only_for_author']) && $popupbox['show_only_for_author'] == 'on') ? true : false;

// Display
$show_all = (isset($popupbox['show_all']) && $popupbox['show_all'] != '') ? stripslashes( esc_attr($popupbox['show_all']) ) : 'all';

// Post type
$except_post_types = (isset($options['except_post_types']) && $options['except_post_types'] != '') ? $options['except_post_types'] : array();

// Posts
$except_posts = (isset($options['except_posts']) && $options['except_posts'] != '') ? $options['except_posts'] : array();
$posts = array();
if ($except_post_types) {
    $posts = get_posts(array(
        'post_type' => $except_post_types,
        'post_status' => 'publish',
        'numberposts' => -1
    ));
}

// Show on home page
$show_on_home_page = (isset($options['show_on_home_page']) && $options['show_on_home_page'] == 'on') ? 'on' : 'off';

// Popup trigger
$action_button_type = (isset($popupbox['action_button_type']) && $popupbox['action_button_type'] != '') ? stripslashes( esc_attr($popupbox['action_button_type']) ) : '';

// CSS selector(s) for trigger click
$action_button = (isset($popupbox['action_button']) && $popupbox['action_button'] != '') ? stripslashes( esc_attr($popupbox['action_button']) ) : '';

// Popup position
$pb_position = (isset($popupbox['pb_position']) && $popupbox['pb_position'] != 'center-center') ?  stripslashes( esc_attr($popupbox['pb_position']) ) : 'center-center';

// Enable different popup position for mobile
$enable_pb_position_mobile = (isset($options['enable_pb_position_mobile']) && $options['enable_pb_position_mobile'] == 'on') ? true : false;

// Popup position mobile
$pb_position_mobile = (isset($options['pb_position_mobile']) && $options['pb_position_mobile'] != 'center-center') ?  stripslashes( esc_attr($options['pb_position_mobile']) ) : 'center-center';

// Popup margin (px)
$pb_margin = (isset($popupbox['pb_margin']) && $popupbox['pb_margin'] != '') ? absint( intval($popupbox['pb_margin']) ) : 0;

// Open delay
$open_delay = (isset($popupbox['delay']) && $popupbox['delay'] != '') ? abs( intval($popupbox['delay']) ) : 0;

// Enable different open delay for mobile
$enable_open_delay_mobile = (isset($options['enable_open_delay_mobile']) && $options['enable_open_delay_mobile'] == 'on') ? true : false;

// Open delay mobile
$open_delay_mobile = (isset($options['open_delay_mobile']) && $options['open_delay_mobile'] != '') ? abs( intval($options['open_delay_mobile']) ) : 0;

// Open by scrolling down
$scroll_top = (isset($popupbox['scroll_top']) && $popupbox['scroll_top'] != '') ? abs( intval($popupbox['scroll_top']) ) : 0;

// Enable different open by scrolling down for mobile
$enable_scroll_top_mobile = (isset($options['enable_scroll_top_mobile']) && $options['enable_scroll_top_mobile'] == 'on') ? true : false;

// Open by scrolling down mobile
$scroll_top_mobile = (isset($options['scroll_top_mobile']) && $options['scroll_top_mobile'] != '') ? abs( intval($options['scroll_top_mobile']) ) : 0;

// Close by pressing ESC
$close_popup_esc = (isset($options['close_popup_esc']) && $options['close_popup_esc'] == 'on') ? 'on' : 'off';

// Close by clicking outside the box
$close_popup_overlay = (isset($options['close_popup_overlay']) && $options['close_popup_overlay'] == 'on') ? stripslashes( esc_attr($options['close_popup_overlay'])) : 'off';

// Close by clicking outside the box mobile
$close_popup_overlay_mobile = (isset($options['close_popup_overlay_mobile']) && $options['close_popup_overlay_mobile'] == 'on') ? true : false;

// Hide close button
$close_button = (isset($popupbox['close_button']) && $popupbox['close_button'] != '') ? stripslashes( esc_attr($popupbox['close_button']) ) : 'off';

// Activate close button while hovering on popup
$options['ays_pb_hover_show_close_btn'] = (isset($options['ays_pb_hover_show_close_btn']) && $options['ays_pb_hover_show_close_btn'] == "on") ? "on" : "off";
$ays_pb_hover_show_close_btn = (isset($options['ays_pb_hover_show_close_btn']) && $options['ays_pb_hover_show_close_btn'] == "on") ? true : false;

// Close button position
$close_button_position = (isset($options['close_button_position']) && $options['close_button_position'] != '') ? stripslashes( esc_attr($options['close_button_position']) ) : 'right-top';

// Enable different close button position for mobile
$enable_close_button_position_mobile = (isset($options['enable_close_button_position_mobile']) && $options['enable_close_button_position_mobile'] == 'on') ? true : false;

// Close button position mobile
$close_button_position_mobile = (isset($options['close_button_position_mobile']) && $options['close_button_position_mobile'] != '') ? stripslashes( esc_attr($options['close_button_position_mobile']) ) : 'right-top';

// Close button text
$close_button_text = (isset($options['close_button_text']) && $options['close_button_text'] != '') ? stripslashes( esc_attr($options['close_button_text']) ) : '✕';

// Enable different close button text for mobile
$enable_close_button_text_mobile = (isset($options['enable_close_button_text_mobile']) && $options['enable_close_button_text_mobile'] != '') ? true : false;

// Close button text mobile
$close_button_text_mobile = (isset($options['close_button_text_mobile']) && $options['close_button_text_mobile'] != '') ? stripslashes( esc_attr($options['close_button_text_mobile']) ) : '✕';

// Close button hover text
$close_button_hover_text = (isset($options['close_button_hover_text']) && $options['close_button_hover_text'] != '') ? stripslashes( esc_attr($options['close_button_hover_text']) ) : '';

// Autoclose delay (in seconds)
$autoclose_default_value = ($modal_content == 'image_type') ? 0 : 20;
$autoclose = (isset($popupbox['autoclose']) && $popupbox['autoclose'] != "") ? abs( intval($popupbox['autoclose']) ) : $autoclose_default_value;

// Enable different autoclose delay mobile
$enable_autoclose_delay_text_mobile = (isset($options['enable_autoclose_delay_text_mobile']) && $options['enable_autoclose_delay_text_mobile'] == 'on') ? true : false;

// Autoclose delay mobile (in seconds)
$ays_pb_autoclose_mobile = (isset($options['pb_autoclose_mobile']) && $options['pb_autoclose_mobile'] != "") ? abs( intval($options['pb_autoclose_mobile']) ) : $autoclose;

// Hide timer
$ays_pb_hide_timer = (isset($options['enable_hide_timer']) && $options['enable_hide_timer'] == 'on') ? 'on' : 'off';

// Hide timer mobile
if (isset($options['enable_hide_timer_mobile'])) {
    $ays_pb_hide_timer_mobile = $options['enable_hide_timer_mobile'] == 'on' ? 'on' : 'off';
} else {
    $ays_pb_hide_timer_mobile = $ays_pb_hide_timer;
}

// Autoclose on video completion
$ays_pb_autoclose_on_completion = (isset($options['enable_autoclose_on_completion']) && $options['enable_autoclose_on_completion'] == 'on') ? 'on' : 'off';

// Close button delay
$close_button_delay = (isset($options['close_button_delay']) && $options['close_button_delay'] != '') ? abs( intval($options['close_button_delay']) ) : 0;

// Enable different close button delay mobile
$enable_close_button_delay_for_mobile = (isset($options['enable_close_button_delay_for_mobile']) && $options['enable_close_button_delay_for_mobile'] == 'on') ? true : false;

// Close button delay mobile
$close_button_delay_for_mobile = (isset($options['close_button_delay_for_mobile']) && $options['close_button_delay_for_mobile'] != '') ? abs( intval($options['close_button_delay_for_mobile']) ) : $close_button_delay;

// Popup name
$popup_name = (isset($popupbox['popup_name']) && $popupbox['popup_name'] != '') ? stripslashes( esc_attr($popupbox['popup_name']) ) : '';

// Popup category
$category_id = (isset($popupbox['category_id']) && $popupbox['category_id'] != '') ? abs( intval($popupbox['category_id']) ) : 1;

// Enable Overlay
$onoffoverlay = (isset($popupbox['onoffoverlay']) && $popupbox['onoffoverlay'] != '') ? esc_attr( stripslashes($popupbox['onoffoverlay']) ) : 'on';

// Enable Overlay | Opacity
$overlay_opacity = (isset($popupbox['overlay_opacity']) && ($popupbox['overlay_opacity'])!= '') ? esc_attr( stripslashes($popupbox['overlay_opacity']) ) : '0.5';

// Enable Overlay | Enable different opacity mobile
$enable_overlay_text_mobile = (isset($options['enable_overlay_text_mobile']) && $options['enable_overlay_text_mobile'] == 'on') ? true : false;

// Enable Overlay | Opacity mobile
$ays_pb_overlay_mobile_opacity = (isset($options['overlay_mobile_opacity']) && $options['overlay_mobile_opacity'] != '') ? esc_attr( stripslashes($options['overlay_mobile_opacity']) ) : '0.5';

// Enable blured overlay
$options['blured_overlay'] = (isset($options['blured_overlay']) && $options['blured_overlay'] == 'on') ? esc_attr( stripslashes($options['blured_overlay']) ) : 'off';
$blured_overlay = (isset($options['blured_overlay']) && $options['blured_overlay'] == 'on') ? true : false;

// Enable blured overlay mobile
if (isset($options['blured_overlay_mobile'])) {
    $blured_overlay_mobile = $options['blured_overlay_mobile'] == 'on' ? true : false;
} else {
    $blured_overlay_mobile = $blured_overlay;
}

// Enable popup sound
$options['enable_pb_sound'] = (isset($options['enable_pb_sound']) && $options['enable_pb_sound'] != '') ? esc_attr($options['enable_pb_sound']) : 'off';
$enable_pb_sound = (isset($options['enable_pb_sound']) && $options['enable_pb_sound'] == 'on') ? true : false;

// Popup opening sound
$ays_pb_sound = (isset($gen_options['ays_pb_sound']) && $gen_options['ays_pb_sound'] != '') ? true : false;

// Enable social media links
$enable_social_links = (isset($options['enable_social_links']) && $options['enable_social_links'] == 'on') ? true : false;

// Enable social media links | Heading for share buttons
$social_buttons_heading = (isset($options['social_buttons_heading']) && $options['social_buttons_heading'] != '') ? stripslashes( $options['social_buttons_heading'] ) : '';

// Enable social media links | Social media link buttons
$social_links = (isset($options['social_links']) && $options['social_links'] != '') ? $options['social_links'] : $social_links_default;

// Enable social media links | LinkedIn link
$linkedin_link = (isset($social_links['linkedin_link']) && $social_links['linkedin_link'] != '') ? esc_url($social_links['linkedin_link']) : '';

// Enable social media links | Facebook link
$facebook_link = (isset($social_links['facebook_link']) && $social_links['facebook_link'] != '') ? esc_url($social_links['facebook_link']) : '';

// Enable social media links | X link
$twitter_link = (isset($social_links['twitter_link']) && $social_links['twitter_link'] != '') ? esc_url($social_links['twitter_link']) : '';

// Enable social media links | VKontakte link
$vkontakte_link = (isset($social_links['vkontakte_link']) && $social_links['vkontakte_link'] != '') ? esc_url($social_links['vkontakte_link']) : '';

// Enable social media links | Youtube link
$youtube_link = (isset($social_links['youtube_link']) && $social_links['youtube_link'] != '') ? esc_url($social_links['youtube_link']) : '';

// Enable social media links | Instagram link
$instagram_link = (isset($social_links['instagram_link']) && $social_links['instagram_link'] != '') ? esc_url($social_links['instagram_link']) : '';

// Enable social media links | Behance link
$behance_link = (isset($social_links['behance_link']) && $social_links['behance_link'] != '') ? esc_url($social_links['behance_link']) : '';

// Enable social media links | Telegram link
$telegram_link = (isset($social_links['telegram_link']) && $social_links['telegram_link'] != '') ? esc_url($social_links['telegram_link']) : '';

// Enable social media links | TikTok link
$tiktok_link = (isset($social_links['tiktok_link']) && $social_links['tiktok_link'] != '') ? esc_url($social_links['tiktok_link']) : '';

// Schedule the popup
$popupbox['active_date_check'] = (isset($popupbox['active_date_check']) && $popupbox['active_date_check'] != '') ? esc_attr( stripslashes($popupbox['active_date_check']) ) : 'off';
$active_date_check = (isset($popupbox['active_date_check']) && $popupbox['active_date_check'] == 'on') ? true : false;
if ($active_date_check) {
    $activateTime = strtotime($popupbox['activeInterval']);
    $activePopup = gmdate('Y-m-d H:i:s', $activateTime);
    $deactivateTime = strtotime($popupbox['deactiveInterval']);
    $deactivePopup = gmdate('Y-m-d H:i:s', $deactivateTime);
} else {
    $activePopup = current_time('mysql');
    $deactivePopup = current_time('mysql');
}

// Schedule the popup by time
$popupbox['active_time_check'] = (isset($popupbox['active_time_check']) && $popupbox['active_time_check'] != '') ? esc_attr( stripslashes($popupbox['active_time_check']) ) : 'off';
$active_time_check = (isset($popupbox['active_time_check']) && $popupbox['active_time_check'] == 'on') ? true : false;
if ($active_time_check) {
    $activeTime = $popupbox['active_time_start'];
    $deactiveTime = $popupbox['active_time_end'];
}else{
    $activeTime = gmdate('H:i:s', strtotime(current_time('mysql')));
    $deactiveTime = gmdate('H:i:s', strtotime(current_time('mysql')));
}
// Change the popup author
$change_pb_create_author = (isset($options['create_author']) && $options['create_author'] != '') ? absint( sanitize_text_field($options['create_author']) ) : $user_id;
$get_current_popup_author_data = get_userdata($change_pb_create_author);

// Enable dismiss ad
$options['enable_dismiss'] = (isset($options['enable_dismiss']) && $options['enable_dismiss'] == 'on') ? 'on' : 'off';
$enable_dismiss = (isset($options['enable_dismiss']) && $options['enable_dismiss'] == 'on') ? true : false;

// Enable dismiss ad | Dismiss ad text
$enable_dismiss_text = (isset($options['enable_dismiss_text']) && $options['enable_dismiss_text'] != '') ? esc_attr( stripslashes($options['enable_dismiss_text']) ) : esc_html__('Dismiss ad', "ays-popup-box");

// Enable dismiss ad | Enable different dismiss ad text mobile
if (isset($options['enable_dismiss_mobile'])) {
    $options['enable_dismiss_mobile'] = $options['enable_dismiss_mobile'] == 'on' ? 'on' : 'off';
} else {
    $options['enable_dismiss_mobile'] = $options['enable_dismiss'];
}
$enable_dismiss_mobile = (isset($options['enable_dismiss_mobile']) && $options['enable_dismiss_mobile'] == 'on') ? true : false;

// Enable dismiss ad | Dismiss ad text mobile
if (isset($options['enable_dismiss_text_mobile'])) {
    $enable_dismiss_text_mobile = $options['enable_dismiss_text_mobile'] != '' ? esc_attr( stripslashes($options['enable_dismiss_text_mobile']) ) : esc_html__('Dismiss ad', "ays-popup-box");
} else {
    $enable_dismiss_text_mobile = $enable_dismiss_text;
}

// Disable page scrolling
$options['disable_scroll'] = (isset($options['disable_scroll']) && $options['disable_scroll'] != '') ? sanitize_text_field($options['disable_scroll']) : 'off';
$disable_scroll = (isset($options['disable_scroll']) && $options['disable_scroll'] == 'on') ? true : false;

// Disable page scrolling mobile
if (isset($options['disable_scroll_mobile'])) {
    $disable_scroll_mobile = $options['disable_scroll_mobile'] == 'on' ? true : false;
} else {
    $disable_scroll_mobile = $disable_scroll;
}

// Disable popup scrolling
$options['disable_scroll_on_popup'] = (isset($options['disable_scroll_on_popup']) && $options['disable_scroll_on_popup'] != '') ? esc_attr( stripslashes($options['disable_scroll_on_popup']) ) : 'off';
$ays_pb_disable_scroll_on_popup = (isset($options['disable_scroll_on_popup']) && $options['disable_scroll_on_popup'] == 'on') ? true : false;

// Disable popup scrolling mobile
if (isset($options['disable_scroll_on_popup_mobile'])) {
    $ays_pb_disable_scroll_on_popup_mobile = $options['disable_scroll_on_popup_mobile'] == 'on' ? true : false;
} else {
    $ays_pb_disable_scroll_on_popup_mobile = $ays_pb_disable_scroll_on_popup;
}

// Show scrollbar
$options['show_scrollbar'] = (isset($options['show_scrollbar']) && $options['show_scrollbar'] != '') ? esc_attr( stripslashes($options['show_scrollbar']) ) : 'off';
$ays_pb_show_scrollbar = (isset($options['show_scrollbar']) && $options['show_scrollbar'] == 'on') ? true : false;

// Show scrollbar mobile
if (isset($options['show_scrollbar_mobile'])) {
    $ays_pb_show_scrollbar_mobile = $options['show_scrollbar_mobile'] == 'on' ? true : false;
} else {
    $ays_pb_show_scrollbar_mobile = $ays_pb_show_scrollbar;
}

// Display Content | Show title
$show_popup_title = (isset($popupbox['show_popup_title']) && $popupbox['show_popup_title'] != '') ? esc_attr( stripslashes($popupbox['show_popup_title']) ) : 'off';

// Display Content | Show desctiption
$show_popup_desc = (isset($popupbox['show_popup_desc']) && $popupbox['show_popup_desc'] != '') ? esc_attr( stripslashes($popupbox['show_popup_desc']) ) : 'off';

// Enable different display content mobile
$enable_display_content_mobile = (isset($options['enable_display_content_mobile']) && $options['enable_display_content_mobile'] == 'on') ? true : false;

// Display Content | Show title mobile
if (isset($options['show_popup_title_mobile'])) {
    $show_popup_title_mobile = $options['show_popup_title_mobile'] !== '' ? esc_attr( stripslashes($options['show_popup_title_mobile']) ) : 'off';
} else {
    $show_popup_title_mobile = $show_popup_title;
}

// Display Content | Show description mobile
if (isset($options['show_popup_desc_mobile'])) {
    $show_popup_desc_mobile = $options['show_popup_desc_mobile'] !== '' ? esc_attr( stripslashes($options['show_popup_desc_mobile']) ) : 'off';
} else {
    $show_popup_desc_mobile = $show_popup_desc;
}

// Width | On desktop
$width = (isset($popupbox['width']) && $popupbox['width'] != 0) ? abs( intval($popupbox['width']) ) : '';

// Width | On desktop | Measurement unit
$popup_width_by_percentage_px = (isset($options['popup_width_by_percentage_px']) && $options['popup_width_by_percentage_px'] != '') ? esc_attr( stripslashes($options['popup_width_by_percentage_px']) ) : 'pixels';

// Width | On mobile
$mobile_width = (isset($options['mobile_width']) && $options['mobile_width'] != 0) ? abs( intval($options['mobile_width']) ) : '';

// Width | On mobile | Measurement unit
$popup_width_by_percentage_px_mobile = (isset($options['popup_width_by_percentage_px_mobile']) && $options['popup_width_by_percentage_px_mobile'] != '') ? esc_attr( stripslashes($options['popup_width_by_percentage_px_mobile']) ) : 'percentage';

// Max-width for mobile
$mobile_max_width = (isset($options['mobile_max_width']) && $options['mobile_max_width'] != '') ? abs( intval($options['mobile_max_width']) ) : '';

// Height | On desktop
$height = (isset($popupbox['height']) && $popupbox['height'] != '') ? abs( intval($popupbox['height']) ) : '';

// Height | On mobile
$mobile_height = (isset($options['mobile_height']) && $options['mobile_height'] != '') ? abs( intval($options['mobile_height']) ) : '';

// Popup max-height | On desktop
$popup_max_height = (isset($options['pb_max_height']) && $options['pb_max_height'] != '' && $options['pb_max_height'] != 0) ? absint( intval($options['pb_max_height']) ) : '';

// Popup max-height | On desktop | Measurement unit
$popup_max_height_by_percentage_px = ( isset($options['popup_max_height_by_percentage_px']) && $options['popup_max_height_by_percentage_px'] != '' ) ? esc_attr( stripslashes($options['popup_max_height_by_percentage_px']) ) : 'pixels';

// Popup max-height | On mobile
$popup_max_height_mobile = ( isset($options['pb_max_height_mobile']) && $options['pb_max_height_mobile'] != '' && $options['pb_max_height_mobile'] != 0 ) ? absint( intval($options['pb_max_height_mobile']) ) : '';

// Popup max-height | On mobile | Measurement unit
$popup_max_height_by_percentage_px_mobile = ( isset($options['popup_max_height_by_percentage_px_mobile']) && $options['popup_max_height_by_percentage_px_mobile'] != '' ) ? esc_attr( stripslashes($options['popup_max_height_by_percentage_px_mobile']) ) : 'pixels';

if ($popup_max_height_by_percentage_px == 'percentage' && $popup_max_height > 100) {
    $popup_max_height = 100;
}

if ($popup_max_height_by_percentage_px_mobile == 'percentage' && $popup_max_height_mobile > 100) {
    $popup_max_height_mobile = 100;
}

// Popup min-height
$pb_min_height = (isset($options['pb_min_height']) && $options['pb_min_height'] != '') ? absint( intval($options['pb_min_height']) ) : '';

// Full-screen mode
$ays_enable_pb_fullscreen = (isset($options['enable_pb_fullscreen']) && $options['enable_pb_fullscreen'] == 'on') ? 'on' : 'off';

// Content padding
$default_padding_value = ($view_type == 'minimal' || $modal_content == 'image_type') ? 0 : 20;
$padding = isset($options['popup_content_padding']) && ($options['popup_content_padding']) >= 0 ? abs( intval($options['popup_content_padding']) ) : $default_padding_value;
$options['popup_content_padding_mobile'] = isset($options['popup_content_padding_mobile']) ? $options['popup_content_padding_mobile'] : $padding;
$padding_mobile = isset($options['popup_content_padding_mobile']) && ($options['popup_content_padding_mobile']) >= 0 ? abs( intval($options['popup_content_padding_mobile']) ) : $default_padding_value;
$enable_padding_mobile = (isset($options['enable_padding_mobile']) && $options['enable_padding_mobile'] == 'on') ? true : false;

// Content padding | Measurement unit
$popup_padding_by_percentage_px = (isset($options['popup_padding_by_percentage_px']) && $options['popup_padding_by_percentage_px'] != '') ? esc_attr( stripslashes($options['popup_padding_by_percentage_px']) ) : 'pixels';
// Content padding | Measurement unit mobile
$options['popup_padding_by_percentage_px_mobile'] = isset($options['popup_padding_by_percentage_px_mobile']) ? $options['popup_padding_by_percentage_px_mobile'] : $popup_padding_by_percentage_px; 
$popup_padding_by_percentage_px_mobile = (isset($options['popup_padding_by_percentage_px_mobile']) && $options['popup_padding_by_percentage_px_mobile'] != '') ? esc_attr( stripslashes($options['popup_padding_by_percentage_px_mobile']) ) : 'pixels';

// Text color
$textcolor = (isset($popupbox['textcolor']) && $popupbox['textcolor'] != '') ? esc_attr( stripslashes($popupbox['textcolor']) ) : '#000000';

// Font family
$font_family_option = (isset($options['pb_font_family']) && $options['pb_font_family'] != '') ? esc_attr( stripslashes($options['pb_font_family']) ) : 'inherit';

// Description font size | On desktop
$pb_font_size = (isset($options['pb_font_size']) && $options['pb_font_size'] != '') ? absint( intval($options['pb_font_size']) ) : 13;

// Description font size | On mobile
$pb_font_size_for_mobile = (isset($options['pb_font_size_for_mobile']) && $options['pb_font_size_for_mobile'] != '') ? absint( intval($options['pb_font_size_for_mobile']) ) : 13;

// Description text align
$pb_text_align = (isset($options['pb_description_alignment_for_pc']) && $options['pb_description_alignment_for_pc'] != '') ? esc_attr( stripslashes($options['pb_description_alignment_for_pc']) ) : 'left';

// Description text align mobile
$pb_text_align_mobile = (isset($options['pb_description_alignment_for_mobile']) && $options['pb_description_alignment_for_mobile'] != '') ? esc_attr( stripslashes($options['pb_description_alignment_for_mobile']) ) : 'left';

// Title text shadow | On desktop
$options['enable_pb_title_text_shadow'] = (isset($options['enable_pb_title_text_shadow']) && $options['enable_pb_title_text_shadow'] == 'on') ? 'on' : 'off';
$enable_pb_title_text_shadow = (isset($options['enable_pb_title_text_shadow']) && $options['enable_pb_title_text_shadow'] == 'on') ? true : false;

// Title text shadow | On desktop | Color
$pb_title_text_shadow = (isset($options['pb_title_text_shadow']) && $options['pb_title_text_shadow'] != '') ? stripslashes( esc_attr($options['pb_title_text_shadow']) ) : 'rgba(255,255,255,0)';

// Title text shadow | On desktop | X
$pb_title_text_shadow_x_offset = (isset($options['pb_title_text_shadow_x_offset']) && $options['pb_title_text_shadow_x_offset'] != '') ? absint( intval($options['pb_title_text_shadow_x_offset']) ) : 2;

// Title text shadow | On desktop | Y
$pb_title_text_shadow_y_offset = (isset($options['pb_title_text_shadow_y_offset']) && $options['pb_title_text_shadow_y_offset'] != '') ? absint( intval($options['pb_title_text_shadow_y_offset']) ) : 2;

// Title text shadow | On desktop | Z
$pb_title_text_shadow_z_offset = (isset($options['pb_title_text_shadow_z_offset']) && $options['pb_title_text_shadow_z_offset'] != '') ? absint( intval($options['pb_title_text_shadow_z_offset']) ) : 0;

// Title text shadow | On mobile
if (isset($options['enable_pb_title_text_shadow_mobile'])) {
    $options['enable_pb_title_text_shadow_mobile'] = $options['enable_pb_title_text_shadow_mobile'] == 'on' ? 'on' : 'off';
} else {
    $options['enable_pb_title_text_shadow_mobile'] = $options['enable_pb_title_text_shadow'];
}
$enable_pb_title_text_shadow_mobile = (isset($options['enable_pb_title_text_shadow_mobile']) && $options['enable_pb_title_text_shadow_mobile'] == 'on') ? true : false;

// Title text shadow | On mobile | Color
if (isset($options['pb_title_text_shadow_mobile'])) {
    $pb_title_text_shadow_mobile = ($options['pb_title_text_shadow_mobile'] != '') ? stripslashes( esc_attr($options['pb_title_text_shadow_mobile']) ) : 'rgba(255,255,255,0)';
} else {
    $pb_title_text_shadow_mobile = $pb_title_text_shadow;
}

// Title text shadow | On mobile | X
if (isset($options['pb_title_text_shadow_x_offset_mobile'])) {
    $pb_title_text_shadow_x_offset_mobile = ($options['pb_title_text_shadow_x_offset_mobile'] != '') ? absint( intval($options['pb_title_text_shadow_x_offset_mobile']) ) : 2;
} else {
    $pb_title_text_shadow_x_offset_mobile = $pb_title_text_shadow_x_offset;
}

// Title text shadow | On mobile | Y
if (isset($options['pb_title_text_shadow_y_offset_mobile'])) {
    $pb_title_text_shadow_y_offset_mobile = ($options['pb_title_text_shadow_y_offset_mobile'] != '') ? absint( intval($options['pb_title_text_shadow_y_offset_mobile']) ) : 2;
} else {
    $pb_title_text_shadow_y_offset_mobile = $pb_title_text_shadow_y_offset;
}

// Title text shadow | On mobile | Z
if (isset($options['pb_title_text_shadow_z_offset_mobile'])) {
    $pb_title_text_shadow_z_offset_mobile = ($options['pb_title_text_shadow_z_offset_mobile'] != '') ? absint( intval($options['pb_title_text_shadow_z_offset_mobile']) ) : 0;
} else {
    $pb_title_text_shadow_z_offset_mobile = $pb_title_text_shadow_z_offset;
}

// Opening animation
$animate_in = (isset($popupbox['animate_in']) && $popupbox['animate_in'] != '') ? stripslashes( esc_attr($popupbox['animate_in']) ) : '';

// Enable different opening animation Mobile
$enable_animate_in_mobile = (isset($options['enable_animate_in_mobile']) && $options['enable_animate_in_mobile'] == 'on') ? true : false;

// Opening animation mobile
if (isset($options['animate_in_mobile'])) {
    $animate_in_mobile = $options['animate_in_mobile'] !== '' ? stripslashes( esc_attr($options['animate_in_mobile']) ) : '';
} else {
    $animate_in_mobile = $animate_in;
}

// Closing animation
$animate_out = (isset($popupbox['animate_out']) && $popupbox['animate_out'] != '') ? stripslashes( esc_attr($popupbox['animate_out']) ) : '';

// Enable different closing animation mobile
$enable_animate_out_mobile = (isset($options['enable_animate_out_mobile']) && $options['enable_animate_out_mobile'] == 'on') ? true : false;

// Closing animation mobile
if (isset($options['animate_out_mobile'])) {
    $animate_out_mobile = $options['animate_out_mobile'] !== '' ? stripslashes( esc_attr($options['animate_out_mobile']) ) : '';
} else {
    $animate_out_mobile = $animate_out;
}

// Opening animation speed
$animation_speed = (isset($options['animation_speed']) && $options['animation_speed'] !== '') ? abs( intval($options['animation_speed']) ) : 1;

// Enable different opening animation speed mobile
$enable_animation_speed_mobile = (isset($options['enable_animation_speed_mobile']) && $options['enable_animation_speed_mobile'] == 'on') ? true : false;

// Opening animation speed mobile
if (isset($options['animation_speed_mobile'])) {
    $animation_speed_mobile = $options['animation_speed_mobile'] !== '' ? abs( intval($options['animation_speed_mobile']) ) : 1;
} else {
    $animation_speed_mobile = $animation_speed;
}

// Close Animation Speed
if (isset($options['close_animation_speed'])) {
    $close_animation_speed = (isset($options['close_animation_speed']) && $options['close_animation_speed'] !== '') ? abs( intval($options['close_animation_speed']) ) : 1;
} else {
    $close_animation_speed = $animation_speed;
}

// Enable different close animation speed mobile
$enable_close_animation_speed_mobile = (isset($options['enable_close_animation_speed_mobile']) && $options['enable_close_animation_speed_mobile'] == 'on') ? true : false;

// Close animation speed mobile
if (isset($options['close_animation_speed_mobile'])) {
    $close_animation_speed_mobile = $options['close_animation_speed_mobile'] !== '' ? abs( intval($options['close_animation_speed_mobile']) ) : 1;
} else {
    $close_animation_speed_mobile = $close_animation_speed;
}

// Background color
$bgcolor = (isset($popupbox['bgcolor']) && $popupbox['bgcolor'] != '') ? esc_attr( stripslashes($popupbox['bgcolor']) ) : '';

// Enable different background color mobile
$enable_bgcolor_mobile = (isset($options['enable_bgcolor_mobile']) && $options['enable_bgcolor_mobile'] == 'on') ? true : false;

// Enable different header background color mobile
$enable_header_bgcolor_mobile = (isset($options['enable_header_bgcolor_mobile']) && $options['enable_header_bgcolor_mobile'] == 'on') ? true : false;

// Background color mobile
if (isset($options['bgcolor_mobile'])) {
    $bgcolor_mobile = $options['bgcolor_mobile'] !== '' ? esc_attr( stripslashes($options['bgcolor_mobile']) ) : '';
} else {
    $bgcolor_mobile = $bgcolor;
}

// Background image
switch ($view_type) {
    case 'image':
        $ays_pb_themes_bg_images = AYS_PB_ADMIN_URL . '/images/elefante.jpg';
        break;
    case 'template':
        $ays_pb_themes_bg_images = AYS_PB_ADMIN_URL . '/images/girl-scaled.jpg';
        break;
    default:
        $ays_pb_themes_bg_images = '';
        break;
}

$bg_image = (isset($popupbox['bg_image']) && $popupbox['bg_image'] != '') ? esc_url($popupbox['bg_image']) : $ays_pb_themes_bg_images;

// Enable different background image mobile
$enable_bg_image_mobile = (isset($options['enable_bg_image_mobile']) && $options['enable_bg_image_mobile'] == 'on') ? true : false;

// Background image mobile
if (isset($options['bg_image_mobile'])) {
    $bg_image_mobile = $options['bg_image_mobile'] !== '' ? esc_url($options['bg_image_mobile']) : '';
} else {
    $bg_image_mobile = $bg_image;
}

// Background image position
$pb_bg_image_position = (isset($options['pb_bg_image_position']) && $options['pb_bg_image_position'] != '') ? stripslashes( esc_attr($options['pb_bg_image_position']) ) : 'center-center';

// Enable different background image position mobile
$enable_pb_bg_image_position_mobile = isset($options['enable_pb_bg_image_position_mobile']) && $options['enable_pb_bg_image_position_mobile'] == 'on' ? true : false;

// Background image position mobile
if (isset($options['pb_bg_image_position_mobile'])) {
    $pb_bg_image_position_mobile = $options['pb_bg_image_position_mobile'] !== '' ? stripslashes( esc_attr($options['pb_bg_image_position_mobile']) ) : 'center-center';
} else {
    $pb_bg_image_position_mobile = $pb_bg_image_position;
}

// Background image sizing
$pb_bg_image_sizing = (isset($options['pb_bg_image_sizing']) && $options['pb_bg_image_sizing'] != '') ? stripslashes( esc_attr($options['pb_bg_image_sizing']) ) : 'cover';

// Enable different background image sizing mobile
$enable_pb_bg_image_sizing_mobile = (isset($options['enable_pb_bg_image_sizing_mobile']) && $options['enable_pb_bg_image_sizing_mobile'] == 'on') ? true : false;

// Background image sizing mobile
$pb_bg_image_sizing_mobile = (isset($options['pb_bg_image_sizing_mobile']) && $options['pb_bg_image_sizing_mobile'] !== '') ? stripslashes( esc_attr($options['pb_bg_image_sizing_mobile']) ) : 'cover';

// Background gradient | On desktop
$options['enable_background_gradient'] = (isset($options['enable_background_gradient']) && $options['enable_background_gradient'] != '') ? stripslashes( esc_attr($options['enable_background_gradient']) ) : 'off';
$enable_background_gradient = (isset($options['enable_background_gradient']) && $options['enable_background_gradient'] == 'on') ? true : false;

// Background gradient | On desktop | Color 1
$background_gradient_color_1 = (isset($options['background_gradient_color_1']) && $options['background_gradient_color_1'] != '') ? esc_attr( stripslashes($options['background_gradient_color_1']) ) : '#000';

// Background gradient | On desktop | Color 2
$background_gradient_color_2 = (isset($options['background_gradient_color_2']) && $options['background_gradient_color_2'] != '') ? esc_attr( stripslashes($options['background_gradient_color_2']) ) : '#fff';

// Background gradient | On desktop | Gradient direction
$pb_gradient_direction = (isset($options['pb_gradient_direction']) && $options['pb_gradient_direction'] != '') ? esc_attr( stripslashes($options['pb_gradient_direction']) ) : 'vertical';

// Background gradient | On mobile
if (isset($options['enable_background_gradient_mobile'])) {
    $options['enable_background_gradient_mobile'] = $options['enable_background_gradient_mobile'] != '' ? stripslashes( esc_attr($options['enable_background_gradient_mobile']) ) : 'off';
} else {
    $options['enable_background_gradient_mobile'] = $options['enable_background_gradient'];
}
$enable_background_gradient_mobile = (isset($options['enable_background_gradient_mobile']) && $options['enable_background_gradient_mobile'] == 'on') ? true : false;

// Background gradient | On mobile | Color 1
if (isset($options['background_gradient_color_1_mobile'])) {
    $background_gradient_color_1_mobile = $options['background_gradient_color_1_mobile'] != '' ? esc_attr( stripslashes($options['background_gradient_color_1_mobile']) ) : '#000';
} else {
    $background_gradient_color_1_mobile = $background_gradient_color_1;
}

// Background gradient | On mobile | Color 2
if (isset($options['background_gradient_color_2_mobile'])) {
    $background_gradient_color_2_mobile = $options['background_gradient_color_2_mobile'] != '' ? esc_attr( stripslashes($options['background_gradient_color_2_mobile'] )) : '#fff';
} else {
    $background_gradient_color_2_mobile = $background_gradient_color_2;
}

// Background gradient | On mobile | Gradient direction
if (isset($options['pb_gradient_direction_mobile'])) {
    $pb_gradient_direction_mobile = $options['pb_gradient_direction_mobile'] != '' ? esc_attr( stripslashes($options['pb_gradient_direction_mobile']) ) : 'vertical';
} else {
    $pb_gradient_direction_mobile = $pb_gradient_direction;
}

// Header background color
$header_bgcolor = (isset($popupbox['header_bgcolor']) && $popupbox['header_bgcolor'] != '') ? esc_attr( stripslashes($popupbox['header_bgcolor']) ) : '#ffffff';
// Header background color mobile
$options['header_bgcolor_mobile'] = (isset($options['header_bgcolor_mobile'])) ? $options['header_bgcolor_mobile'] : $header_bgcolor;
$header_bgcolor_mobile = (isset($options['header_bgcolor_mobile']) && $options['header_bgcolor_mobile'] != '') ? esc_attr( stripslashes($options['header_bgcolor_mobile']) ) : '#ffffff';

// Overlay color
$overlay_color = (isset($options['overlay_color']) && $options['overlay_color'] != '') ? esc_attr( stripslashes($options['overlay_color']) ) : '#000';

// Enable different overlay color mobile
$enable_overlay_color_mobile = (isset($options['enable_overlay_color_mobile']) && $options['enable_overlay_color_mobile'] == 'on') ? true : false;

// Overlay color mobile
if (isset($options['overlay_color_mobile'])) {
    $overlay_color_mobile = $options['overlay_color_mobile'] !== '' ? esc_attr( stripslashes($options['overlay_color_mobile']) ) : '#000';
} else {
    $overlay_color_mobile = $overlay_color;
}

// Border width
$border_size = (isset($popupbox['bordersize']) && $popupbox['bordersize'] != '') ? abs( intval( round($popupbox['bordersize']) ) ) : 0;

// Enable different border width mobile
$enable_border_size_mobile = (isset($options['enable_bordersize_mobile']) && $options['enable_bordersize_mobile'] == 'on') ? true : false;

// Border width mobile
if (isset($options['bordersize_mobile'])) {
    $border_size_mobile = $options['bordersize_mobile'] != '' ? abs( intval( round($options['bordersize_mobile']) ) ) : 0;
} else {
    $border_size_mobile = $border_size;
}

// Border style
$ays_pb_border_style = (isset($options['border_style']) && $options['border_style'] != '') ? esc_attr( stripslashes($options['border_style']) ) : 'solid';

// Enable different border style mobile
$enable_border_style_mobile = (isset($options['enable_border_style_mobile']) && $options['enable_border_style_mobile'] == 'on') ? true : false;

// Border style mobile
if (isset($options['border_style_mobile'])) {
    $ays_pb_border_style_mobile = $options['border_style_mobile'] !== '' ? esc_attr( stripslashes($options['border_style_mobile']) ) : '';
} else {
    $ays_pb_border_style_mobile = $ays_pb_border_style;
}

// Border color
$bordercolor = (isset($popupbox['bordercolor']) && $popupbox['bordercolor'] != '') ? esc_attr( stripslashes($popupbox['bordercolor']) ) : '';

// Enable different border color mobile
$enable_bordercolor_mobile = (isset($options['enable_bordercolor_mobile']) && $options['enable_bordercolor_mobile'] == 'on') ? true : false;

// Border color mobile
if (isset($options['bordercolor_mobile'])) {
    $bordercolor_mobile = $options['bordercolor_mobile'] !== '' ? esc_attr( stripslashes($options['bordercolor_mobile']) ) : '';
} else {
    $bordercolor_mobile = $bordercolor;
}

// Border radius
$border_radius = (isset($popupbox['border_radius']) && $popupbox['border_radius'] != '') ? abs( intval( round($popupbox['border_radius']) ) ) : 4;

// Enable different border radius mobile
$enable_border_radius_mobile = (isset($options['enable_border_radius_mobile']) && $options['enable_border_radius_mobile'] == 'on') ? true : false;

// Border radius mobile
if (isset($options['border_radius_mobile'])) {
    $border_radius_mobile = $options['border_radius_mobile'] !== '' ? abs( intval( round($options['border_radius_mobile']) ) ) : 4;
} else {
    $border_radius_mobile = $border_radius;
}

// Close button image
$close_btn_background_img = (isset($options['close_button_image']) && $options['close_button_image'] != '') ? esc_url($options['close_button_image']) : '';

// Close button color
$default_close_button_color = $view_type == 'lil' ? '#ffffff' : $textcolor;
$close_button_color = (isset($options['close_button_color']) && $options['close_button_color'] != '') ? esc_attr( stripslashes($options['close_button_color']) ) : $default_close_button_color;

// Close button hover color
$close_button_hover_color = (isset($options['close_button_hover_color']) && $options['close_button_hover_color'] != '') ? esc_attr( stripslashes($options['close_button_hover_color']) ) : $close_button_color;

// Close button size
$ays_close_button_size = (isset($options['close_button_size']) && $options['close_button_size'] != '') ? abs( intval($options['close_button_size']) ) : 1;

// Box shadow | On desktop
$options['enable_box_shadow'] = (isset($options['enable_box_shadow']) && $options['enable_box_shadow'] != '') ? esc_attr( stripslashes($options['enable_box_shadow']) ) : 'off';
$enable_box_shadow = (isset($options['enable_box_shadow']) && $options['enable_box_shadow'] == 'on') ? true : false;

// Box shadow | On desktop | Color
$box_shadow_color = (isset($options['box_shadow_color']) && $options['box_shadow_color'] != '') ? esc_attr( stripslashes($options['box_shadow_color']) ) : '#000';

// Box shadow | On desktop | X
$pb_box_shadow_x_offset = (isset($options['pb_box_shadow_x_offset']) && $options['pb_box_shadow_x_offset'] != '') ? abs( intval($options['pb_box_shadow_x_offset']) ) : 0;

// Box shadow | On desktop | Y
$pb_box_shadow_y_offset = (isset($options['pb_box_shadow_y_offset']) && $options['pb_box_shadow_y_offset'] != '') ? abs( intval($options['pb_box_shadow_y_offset']) ) : 0;

// Box shadow | On desktop | Z
$pb_box_shadow_z_offset = (isset($options['pb_box_shadow_z_offset']) && $options['pb_box_shadow_z_offset'] != '') ? abs( intval($options['pb_box_shadow_z_offset']) ) : 15;

// Box shadow | On mobile
if (isset($options['enable_box_shadow_mobile'])) {
    $options['enable_box_shadow_mobile'] = $options['enable_box_shadow_mobile'] != '' ? esc_attr( stripslashes($options['enable_box_shadow_mobile']) ) : 'off';
} else {
    $options['enable_box_shadow_mobile'] = $options['enable_box_shadow'];
}
$enable_box_shadow_mobile = (isset($options['enable_box_shadow_mobile']) && $options['enable_box_shadow_mobile'] == 'on') ? true : false;

// Box shadow | On mobile | Color
if (isset($options['box_shadow_color_mobile'])) {
    $box_shadow_color_mobile = ($options['box_shadow_color_mobile'] != '') ? esc_attr( stripslashes($options['box_shadow_color_mobile']) ) : '#000';
} else {
    $box_shadow_color_mobile = $box_shadow_color;
}

// Box shadow | On mobile | X
if ( isset($options['pb_box_shadow_x_offset_mobile']) ) {
    $pb_box_shadow_x_offset_mobile = ($options['pb_box_shadow_x_offset_mobile'] != '') ? abs( intval($options['pb_box_shadow_x_offset_mobile']) ) : 0;
} else {
    $pb_box_shadow_x_offset_mobile = $pb_box_shadow_x_offset;
}

// Box shadow | On mobile | Y
if ( isset($options['pb_box_shadow_y_offset_mobile']) ) {
    $pb_box_shadow_y_offset_mobile = ($options['pb_box_shadow_y_offset_mobile'] != '') ? abs( intval($options['pb_box_shadow_y_offset_mobile']) ) : 0;
} else {
    $pb_box_shadow_y_offset_mobile = $pb_box_shadow_y_offset;
}

// Box shadow | On mobile | Z
if ( isset($options['pb_box_shadow_z_offset_mobile']) ) {
    $pb_box_shadow_z_offset_mobile = ($options['pb_box_shadow_z_offset_mobile'] != '') ? abs( intval($options['pb_box_shadow_z_offset_mobile']) ) : 15;
} else {
    $pb_box_shadow_z_offset_mobile = $pb_box_shadow_z_offset;
}

// Background image style on mobile
$options['pb_bg_image_direction_on_mobile'] = (isset($options['pb_bg_image_direction_on_mobile']) && $options['pb_bg_image_direction_on_mobile'] != '') ? esc_attr( stripslashes($options['pb_bg_image_direction_on_mobile']) ) : 'off';
$pb_bg_image_direction_on_mobile = (isset($options['pb_bg_image_direction_on_mobile']) && $options['pb_bg_image_direction_on_mobile'] == 'on') ? true : false;

// Custom class for popup container
$custom_class = (isset($popupbox['custom_class']) && $popupbox['custom_class'] != '') ? esc_attr( stripslashes($popupbox['custom_class']) ) : '';

// Custom CSS
$custom_css = (isset($popupbox['custom_css']) && $popupbox['custom_css'] != '') ? stripslashes( esc_attr($popupbox['custom_css']) ) : '';

// Display popup once per user
$show_only_once = (isset($options['show_only_once']) && $options['show_only_once'] == 'on') ? 'on' : 'off';

// Display once per session
$cookie = (isset($popupbox['cookie']) && $popupbox['cookie'] != '') ? abs( intval($popupbox['cookie']) ) : 0;

// Display for logged-in users
$log_user = (isset($popupbox['log_user']) && $popupbox['log_user'] != '') ? stripslashes( esc_attr($popupbox['log_user']) ) : 'off';

// Display for logged-in users | Display for certain user roles
$users_role = (isset($popupbox['users_role']) && $popupbox['users_role'] != '') ? json_decode($popupbox['users_role'], true) : array();

// Display for guests
$guest = (isset($popupbox['guest']) && $popupbox['guest'] != '') ? stripslashes( esc_attr($popupbox['guest']) ) : 'off';

// Hide popup on mobile
$ays_pb_mobile = (isset($options['pb_mobile']) && $options['pb_mobile'] == 'on') ? stripslashes( esc_attr($options['pb_mobile']) ) : 'off';

// Hide popup on desktop
$options['hide_on_pc'] = (isset($options['hide_on_pc']) && $options['hide_on_pc'] != '') ? stripslashes( esc_attr($options['hide_on_pc']) ) : 'off';
$ays_pb_hide_on_pc = (isset($options['hide_on_pc']) && $options['hide_on_pc'] == 'on') ? true : false;

// Hide popup on tablets
$options['hide_on_tablets'] = (isset($options['hide_on_tablets']) && $options['hide_on_tablets'] != '') ? stripslashes( esc_attr($options['hide_on_tablets']) ) : 'off';
$ays_pb_hide_on_tablets = (isset($options['hide_on_tablets']) && $options['hide_on_tablets'] == 'on') ? true : false;

if( isset( $popupbox['view_place'] ) && $popupbox['view_place'] != null){
    $id != null ? $view_place = explode( "***", $popupbox['view_place']) : $view_place = array();
}

$ays_pb_timer_position = (- absint(intval($border_size)) -40) . 'px';

$ays_pb_show_hide_timer_box = true;
if ($enable_autoclose_delay_text_mobile) {
    if ($autoclose == '0' && $ays_pb_autoclose_mobile == '0') {
        $ays_pb_show_hide_timer_box = false;
    }
} else {
    if ($autoclose == '0') {
        $ays_pb_show_hide_timer_box = false;
    }
}

if($ays_pb_hide_timer == 'on' || $autoclose == 0) {
    $ays_pb_timer_desc = "<p class='ays_pb_timer' style='visibility:hidden'>".esc_html__('This will close in',"ays-popup-box")." <span data-seconds='20'>20</span> ".esc_html__('seconds',"ays-popup-box")."</p>";
}else{
    $ays_pb_timer_desc = "<p class='ays_pb_timer' style='visibility:visible'>".esc_html__('This will close in',"ays-popup-box")." <span data-seconds='20'>20</span> ".esc_html__('seconds',"ays-popup-box")."</p>";
}

//Enable for selected user OS
$ays_users_os_array = array(
    '/windows nt 10/i'      =>  esc_html__('Windows 10', "ays-popup-box"),
    '/windows nt 6.1/i'     =>  esc_html__('Windows 7', "ays-popup-box"),
    '/macintosh|mac os x/i' =>  esc_html__('Mac OS X', "ays-popup-box"),
    '/linux/i'              =>  esc_html__('Linux', "ays-popup-box"),
);

//Enable for selected browser
$ays_users_browser_array = array(
    '/chrome/i'    => esc_html__('Chrome', "ays-popup-box"),
    '/firefox/i'   => esc_html__('Firefox', "ays-popup-box"),
    '/safari/i'    => esc_html__('Safari', "ays-popup-box"),
    '/opera|OPR/i' => esc_html__('Opera', "ays-popup-box"),
);

$disable_height = '';
$disable_width  = '';
if($ays_enable_pb_fullscreen == 'on'){
    $disable_height = 'readonly';
    $disable_width  = 'readonly';
}else{
    $disable_height = '';
    $disable_width  = '';
}

$close_btn_img_display = 'display:none;';
$close_btn_text_display = 'display:flex; align-items:center; justify-content: center;';
if ($close_btn_background_img != '') {
    $close_btn_img_display = 'display:block;';
    $close_btn_text_display = 'display:none';
}

$hide_title = '';
$hide_desc  = '';

$header_height = (($show_popup_title !== "On") ?  "height: 0px !important" :  "");
$calck_template_footer = (($show_popup_title !== "On") ? "height: 100%;" :  "");
$header_padding = '';
if($show_popup_title == 'On'){
    $hide_title     = 'display:block';
    $header_padding = 'display:flex;align-items:center;justify-content:center';
}else{
    $hide_title     = 'display:none';
    $header_padding = 'height:0 !important';
}

if($show_popup_desc == 'On'){
    $hide_desc = 'display:block';
}else{
    $hide_desc = 'display:none';
}

$next_popup_id = "";
$prev_popup_id = "";
if ( isset( $id ) && !is_null( $id ) ) {
    $next_popup = $this->get_next_or_prev_row_by_id( $id, "next", "ays_pb" );
    $next_popup_id = (isset( $next_popup['id'] ) && $next_popup['id'] != "") ? absint( $next_popup['id'] ) : null;
   
    $prev_popup = $this->get_next_or_prev_row_by_id( $id, "prev", "ays_pb" );
    $prev_popup_id = (isset( $prev_popup['id'] ) && $prev_popup['id'] != "") ? absint( $prev_popup['id'] ) : null;
}

$not_default_view_types = array(
    'mac'       => 'mac',
    'ubuntu'    => 'ubuntu',
    'winXP'     => 'winXP',
    'win98'     => 'win98',
    'cmd'       => 'cmd',
);

$show_popup_triggers_tooltip = array(
    'pageLoaded'    => 'On page load - Trigger displays the popup automatically on the page load. Define the time delay of the popup in Open Delay option.',
    'clickSelector' => 'On click - Trigger displays a popup on your site when the user clicks on a targeted CSS element(s). Define the CSS element in the CSS selector(s) option.',
    'both'          => 'Both (On page load & On click) - Popup will be shown both on page load and click.',
);

$if_dismiss_cookie_exists = (isset( $_COOKIE['ays_pb_fox_lms_pages_popup_dismiss_for_three_click'] ) && $_COOKIE['ays_pb_fox_lms_pages_popup_dismiss_for_three_click'] >= 3) ? true : false;
$if_fox_lms_plugin_exists = ( in_array('fox-lms/fox-lms.php', apply_filters('active_plugins', get_option('active_plugins'))) ) ? true : false;


$if_fox_lms_plugin_installed_flag = get_option('ays_pb_and_fox_lms_plugin_flag');


if ( !$if_fox_lms_plugin_installed_flag ) {
    update_option('ays_pb_and_fox_lms_plugin_flag', 0);
}

if ( $if_fox_lms_plugin_exists ) {
    update_option('ays_pb_and_fox_lms_plugin_flag', 1);
}

$if_fox_lms_plugin_installed_flag = get_option('ays_pb_and_fox_lms_plugin_flag');

?>

<style>
    .ays_image_window p.ays_pb_timer{
        bottom: <?php echo esc_attr($ays_pb_timer_position); ?>;
    }

    .ays-pb-live-container .ays-close-button-text, 
    .ays-pb-live-container.ays_image_window header .ays-close-button-text,
    .ays-pb-live-container.ays_template_window header .ays-close-button-text{
        transform:scale(<?php echo esc_attr($ays_close_button_size); ?>);
        color:<?php echo esc_attr($close_button_color); ?>;
    }

    .close-lil-btn:hover{
        transform: rotate(180deg) scale(<?php echo esc_attr($ays_close_button_size); ?>)
    }

</style>
<?php 
// Getting all WP Roles
global $wp_roles;
$ays_users_roles = $wp_roles->roles;

?>
<div class="wrap ays-pb-dashboard-main-wrap">
    <div class="container-fluid">
        <form method="post" name="popup_attributes" id="ays_pb_form" class="ays-pb-main-form">
            <input type="hidden" name="ays_pb_tab" value="<?php echo esc_attr($ays_pb_tab); ?>">
            <input type="hidden" class="pb_wp_editor_height" value="<?php echo esc_attr($pb_wp_editor_height); ?>">
            <input type="hidden" name="ays_pb_create_date" value="<?php echo esc_attr($pb_create_date); ?>">
            <input type="hidden" name="ays_pb_author" value="<?php echo esc_attr(json_encode($pb_author, JSON_UNESCAPED_SLASHES)); ?>">
            <div class="ays-pb-heading-box">
                <div class="ays-pb-wordpress-user-manual-box">
                    <a href="https://ays-pro.com/wordpress-popup-box-plugin-user-manual" target="_blank">
                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . '/images/icons/text-file.svg' ?>">
                        <span><?php echo esc_html__("View Documentation", "ays-popup-box"); ?></span>
                    </a>
                </div>
            </div>
            <h1 class="wp-heading-inline" style="display:flex; flex-wrap: wrap;">
                <?php echo esc_html($heading); ?>
            </h1>
            <div>
                <div class="ays-pb-subtitle-main-box">
                    <p class="ays_pb_subtitle">
                        <?php if(isset($id) && count($get_all_popups) > 1):?>
                            <img class="ays-pb-open-popups-list" src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/angle-down.svg"?>">
                        <?php endif; ?>
                        <strong class="ays_pb_title_in_top"><?php echo esc_html( $title ); ?></strong>
                    </p>
                    <?php if(isset($id) && count($get_all_popups) > 1):?>
                        <div class="ays-pb-popups-data">
                            <?php $var_counter = 0; foreach($get_all_popups as $var => $var_name): if( intval($var_name['id']) == $id ){continue;} $var_counter++; ?>
                                <label class="ays-pb-message-vars-each-data-label">
                                    <input type="radio" class="ays-pb-popups-each-data-checker" hidden id="ays_pb_message_var_count_<?php echo esc_attr($var_counter)?>" name="ays_pb_message_var_count">
                                    <div class="ays-pb-popups-each-data">
                                        <input type="hidden" class="ays-pb-popups-each-var" value="<?php echo esc_attr($var); ?>">
                                        <a href="?page=ays-pb&action=edit&popupbox=<?php echo absint( intval($var_name['id']) ); ?>" target="_blank" class="ays-pb-go-to-popups"><span><?php echo esc_attr(stripslashes($var_name['title'])); ?></span></a>
                                    </div>
                                </label>              
                            <?php endforeach ?>
                        </div>                        
                    <?php endif; ?>
                </div>
                <p>
                    <span class="ays-pb-type-name ays-pb-small-hint-text"><?php echo esc_html( $modal_content_name ); ?></span>
                    <?php if(isset($id)): ?> 
                        <span class="ays-pb-small-hint-text"><?php echo "ID: " . esc_html( $id ); ?></span>
                    <?php endif; ?>
                </p>
                <?php if ($show_warning_note): ?>
                <div class="ays-pb-cache-warning-note-container">
                    <div class="ays-pb-cache-warning-note">
                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL . "/images/icons/warning.svg"); ?>">
                        <p>
                            <span><?php echo esc_html__("Please Note: ", "ays-popup-box"); ?></span>
                            <span><?php echo esc_html__("If you have a cache plugin, clear the caches and exclude the link where the popup is enabled to see immediate front-end changes", "ays-popup-box"); ?></span>
                        </p>
                    </div>
                    <div class="ays-pb-cache-warning-note-close-container">
                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL . "/images/icons/close-warning-note.svg"); ?>" class="ays-pb-cache-warning-note-close">
                    </div>
                </div>
                <?php endif; ?>
                <p class="ays-pb-type-video">
                   <?php echo wp_kses($video_tutorial, array('a' => array('href' => array()))); ?>
                </p>
            </div>
            <hr>
            <div class="ays-top-menu-container-wrapper">
                <div class="ays-pb-top-menu-wrapper">
                    <div class="ays_pb_menu_left" data-scroll="0"><img src="<?php echo esc_url(AYS_PB_ADMIN_URL . "/images/icons/angle-left.svg"); ?>"></div>
                    <div class="ays-pb-top-menu">
                        <div class="nav-tab-wrapper ays-pb-top-tab-wrapper">
                            <a href="#tab1" data-tab="tab1" class="nav-tab <?php echo ($ays_pb_tab == 'tab1') ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__("General", "ays-popup-box"); ?></a>
                            <a href="#tab2" data-tab="tab2" class="nav-tab <?php echo ($ays_pb_tab == 'tab2') ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__("Settings", "ays-popup-box"); ?></a>
                            <a href="#tab3" data-tab="tab3" class="nav-tab <?php echo ($ays_pb_tab == 'tab3') ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__("Styles", "ays-popup-box"); ?></a>
                            <a href="#tab4" data-tab="tab4" class="nav-tab <?php echo ($ays_pb_tab == 'tab4') ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__("Limitation Users", "ays-popup-box"); ?></a>
                            <a href="#tab5" data-tab="tab5" class="nav-tab <?php echo ($ays_pb_tab == 'tab5') ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__("Integrations", "ays-popup-box"); ?></a>
                        </div>
                    </div>
                    <div class="ays_pb_menu_right" data-scroll="-1"><img src="<?php echo esc_url(AYS_PB_ADMIN_URL . "/images/icons/angle-right.svg"); ?>"></div>
                </div>
                <div class="ays-pb-add-new-button-box ays-pb-add-new-button-pb-edit-box top-menu-buttons-container">
                <?php 
                    $save_attributes = array(
                        'id' => 'ays-button-top-apply',
                        'title' => 'Ctrl + s',
                        'data-toggle' => 'tooltip',
                        'data-delay'=> '{"show":"300"}'
                    );
                    $save_close_attributes = array('id' => 'ays-button-top');
                    submit_button(esc_html__('Save', "ays-popup-box"), 'primary ays-pb-loader-banner', 'ays_apply_top', false, $save_attributes);
                    submit_button(esc_html__('Save and close', "ays-popup-box"), 'ays-pb-loader-banner ays-pb-submit-button-margin-unset', 'ays_submit_top', false, $save_close_attributes);
                ?>
                    <a href="<?php echo esc_url($ays_pb_page_url); ?>" class="button ays-pb-loader-banner"><?php echo esc_html__('Cancel',"ays-popup-box");?></a>
                    <?php
                        echo wp_kses_post($loader_image);
                    ?>
                </div>
            </div>
            <div id="tab1" class="ays-pb-tab-content  <?php echo ($ays_pb_tab == 'tab1') ? 'ays-pb-tab-content-active' : ''; ?>">
                <p class="ays-subtitle"><?php echo  esc_html__('General Settings', "ays-popup-box") ?></p>
                <hr class="ays-pb-bolder-hr"/>
                <!-- Popup title start -->
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="<?php echo esc_attr($this->plugin_name); ?>-popup_title">
                            <span><?php echo esc_html__('Popup title', "ays-popup-box"); ?></span>
                            <a class="ays_help" data-toggle="tooltip"
                               title="<?php echo esc_html__('The option is not being displayed on the front-end by default. Please activate it from the Styles tab.', "ays-popup-box") ?>">
                               <img src="<?php echo esc_url(AYS_PB_ADMIN_URL . "/images/icons/info-circle.svg"); ?>">
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="<?php echo esc_attr($this->plugin_name); ?>-popup_title"  class="ays-text-input" name="<?php echo esc_attr($this->plugin_name); ?>[popup_title]" value="<?php echo esc_attr($title) ?>" />
                    </div>
                </div>
                <!-- Popup title end -->
                <hr/>
                <!-- Enable popup start-->
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="<?php echo esc_attr($this->plugin_name); ?>-onoffswitch">
                            <span><?php echo esc_html__('Enable popup', "ays-popup-box"); ?></span>
                            <a class="ays_help" data-toggle="tooltip"
                                title="<?php echo esc_html__('Turn on the popup for the website based on your configured options.', "ays-popup-box") ?>">
                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL . "/images/icons/info-circle.svg"); ?>">
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <label class="ays-pb-enable-switch">
                            <input type="checkbox" name="<?php echo esc_attr($this->plugin_name); ?>[onoffswitch]" class="ays-pb-onoffswitch-checkbox" id="<?php echo esc_attr($this->plugin_name); ?>-onoffswitch" <?php if($onoffswitch == 'On'){ echo 'checked';} else { echo '';} ?>>
                            <div class="ays-pb-enable-switch-slider ays-pb-enable-switch-round">
                                <span class="ays-pb-enable-switch-on"><?php echo esc_html__( 'ON', "ays-popup-box" ); ?></span>
                                <span class="ays-pb-enable-switch-off"><?php echo esc_html__( 'OFF', "ays-popup-box" ); ?></span>
                            </div>
                        </label>
                    </div>
                </div>
                <!-- Enable popup end-->
                <hr class="ays_shortcode_hr <?php echo $modal_content == 'shortcode' ? '' : 'display_none'; ?>">
                <!-- Shortcode start -->
                <div class="form-group row <?php echo $modal_content == 'shortcode' ? '' : 'display_none'; ?>" id="ays_shortcode">
                    <div class="col-sm-3">
                        <label for="<?php echo esc_attr($this->plugin_name); ?>-shortcode">
                            <span><?php echo esc_html__('Shortcode ', "ays-popup-box"); ?></span>
                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('You can pop up any form by inserting its shortcode. Please copy and paste the shortcode from another plugin to display it in a popup. For example, Contact forms, surveys, polls, quizzes, Google map, etc.', "ays-popup-box"); ?>">
                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL . "/images/icons/info-circle.svg"); ?>">
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="<?php echo esc_attr($this->plugin_name); ?>-shortcode" name="<?php echo esc_attr($this->plugin_name); ?>[shortcode]"  class="ays-text-input" value="<?php echo esc_attr($shortcode); ?>" />
                    </div>
                </div>
                <!-- Shortcode end -->
                <hr class="ays_custom_html_hr <?php echo $modal_content == 'custom_html' ? '' : 'display_none'; ?>">
                <!-- Custom content start -->
                <div class="form-group row ays-field <?php echo $modal_content == 'custom_html' ? '' : 'display_none'; ?>" id="ays_custom_html">
                    <div class="col-sm-3">
                        <label>
                            <span>
                                <span><?php echo esc_html__('Custom Content', "ays-popup-box"); ?></span>
                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Create fully customized popup content with the help of HTML.", "ays-popup-box"); ?>">
                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL . "/images/icons/info-circle.svg"); ?>">
                                </a>
                            </span>
                        </label>
                        <div>
                            <a href="https://ays-pro.com/blog/how-to-create-a-custom-content-popup" target="_blank" style="font-size: 14px;">
                                <?php echo esc_html__("What is a Custom Content Popup?", "ays-popup-box"); ?>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php
                            $content = ($custom_html);
                            $editor_id = 'custom-html';
                            $settings = array('editor_height'=> $pb_wp_editor_height,'textarea_name'=> $this->plugin_name.'[custom_html]', 'editor_class'=>'ays-textarea', 'media_buttons' => true);
                            wp_editor($content,$editor_id,$settings);
                        ?>
                        <div class="ays-pb-small-hint-text">
                            <?php
                                echo esc_html__("To track conversions for this popup, add the class 'asypb-cta' to any element you want to count as a conversion. When a visitor clicks on an element with this class, it will be recorded as a conversion.", "ays-popup-box");
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Custom content end -->
                <hr class="ays_video_type_hr <?php echo $modal_content == 'video_type' ? '' : 'display_none'; ?>">
                <!-- Video type | Video option start -->
                <div class="form-group row <?php echo ($modal_content == 'video_type') ? '' : 'display_none'; ?>" id="ays_video_type">
                    <div class="col-sm-3">
                        <label for='ays_pb_video_theme'>
                            <?php echo esc_html__('Video', "ays-popup-box"); ?>
                            <a class="ays_help" data-toggle="tooltip" data-placement="top"
                                title="<?php echo esc_html__("Add video to the popup.", "ays-popup-box"); ?>">
                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <a href="javascript:void(0)" class="button ays-pb-add-bg-video">
                            <?php echo $image_type_img_src != '' ? esc_html__('Edit Image', "ays-popup-box") : esc_html__('Add Image', "ays-popup-box"); ?>
                        </a>
                        <div class="<?php echo $ays_video_theme_bg != '' ? '' : 'display_none'; ?> ays-pb-bg-video-container-main">
                            <div class="ays-pb-bg-video-container">
                                <span class="ays-remove-bg-video"></span>
                                <video src="<?php echo esc_url($ays_video_theme_bg); ?>" id="ays_pb_video_theme_video"></video>
                                <input type="hidden" name="ays_video_theme_url" id="ays_pb_video_theme" value="<?php echo esc_url($ays_video_theme_bg); ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Video type | Video option end -->
                <hr class="ays_image_type_hr <?php echo $modal_content == 'image_type' ? '' : 'display_none'; ?>">
                <!-- Image type | Image option start -->
                <div class="form-group row <?php echo ($modal_content == 'image_type') ? '' : 'display_none'; ?>" id="ays_image_type">
                    <div class="col-sm-3">
                        <label for='ays_pb_image_type_img_src'>
                            <span style="font-weight: 600;">
                                <?php echo esc_html__('Main Image', "ays-popup-box"); ?>
                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Add image to the popup.", "ays-popup-box"); ?>">
                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL . "/images/icons/info-circle.svg"); ?>">
                                </a>
                            </span>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <a href="javascript:void(0)" class="button ays-pb-image-type-add-img">
                            <?php echo $image_type_img_src != '' ? esc_html__('Edit Image', "ays-popup-box") : esc_html__('Add Image', "ays-popup-box"); ?>
                        </a>
                        <div class="<?php echo $image_type_img_src != '' ? '' : 'display_none'; ?> ays-pb-image-type-img-container-main">
                            <div class="ays-pb-image-type-img-container">
                                <span class="ays-remove-image-type-img"></span>
                                <img src="<?php echo esc_url($image_type_img_src); ?>" id="ays_pb_image_type_img">
                                <input type="hidden" name="ays_pb_image_type_img_src" id="ays_pb_image_type_img_src" value="<?php echo esc_url($image_type_img_src); ?>"/>
                            </div>
                        </div>
                        <div class="ays-pb-image-type-img-settings-container <?php echo $image_type_img_src != ''  ? '' : 'display_none'; ?>">
                            <hr>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for='ays_pb_image_type_img_redirect_url'>
                                        <span>
                                            <?php echo esc_html__('Redirect URL', "ays-popup-box"); ?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("The URL for redirecting after the user clicks on the image.", "ays-popup-box"); ?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL . "/images/icons/info-circle.svg"); ?>">
                                            </a>
                                        </span>
                                    </label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="ays_pb_image_type_img_redirect_url" name="ays_pb_image_type_img_redirect_url" class="ays-text-input" value="<?php echo esc_url($image_type_img_redirect_url); ?>" />
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="ays_pb_image_type_img_redirect_to_new_tab">
                                        <?php  echo esc_html__('Redirect to the new tab', "ays-popup-box" ) ?>
                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "Tick this option to redirect to another tab.", "ays-popup-box"); ?>" >
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                        </a>
                                    </label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="checkbox" id="ays_pb_image_type_img_redirect_to_new_tab" name="ays_pb_image_type_img_redirect_to_new_tab" <?php echo $image_type_img_redirect_to_new_tab ? 'checked' : ''; ?>>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Image type | Image option end -->
                <hr class="ays_facebook_hr <?php echo $modal_content == 'facebook_type' ? '' : 'display_none'; ?>">
                <!-- Facebook page URL start -->
                <div class="form-group row ays_facebook_type_option <?php echo $modal_content == 'facebook_type' ? '' : 'display_none'; ?>">
                    <div class="col-sm-3">
                        <label for="ays_pb_facebook_page_url">
                            <?php  echo esc_html__('Facebook page url', "ays-popup-box" ) ?>
                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "With the help of this insert field, it notes Facebook URL address seen in PopupBox", "ays-popup-box"); ?>" >
                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL . "/images/icons/info-circle.svg"); ?>">
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <input id="ays_pb_facebook_page_url" class="ays-text-input" name="ays_pb_facebook_page_url" type="text" value="<?php echo esc_url($facebook_page_url); ?>" />
                    </div>
                </div>
                <!-- Facebook page URL end -->
                <hr class="ays_facebook_hr <?php echo $modal_content == 'facebook_type' ? '' : 'display_none'; ?>">
                <!-- Hide Facebook page cover photo start -->
                <div class="form-group row ays_facebook_type_option <?php echo $modal_content == 'facebook_type' ? '' : 'display_none'; ?>">
                    <div class="col-sm-3">
                        <label for="ays_pb_hide_fb_page_cover_photo">
                            <?php  echo esc_html__('Hide FB page cover photo', "ays-popup-box" ) ?>
                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "Select this option if you want to hide the cover photo of your Facebook page when it is displayed in the popup.", "ays-popup-box"); ?>" >
                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL . "/images/icons/info-circle.svg"); ?>">
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="checkbox" name="ays_pb_hide_fb_page_cover_photo" id="ays_pb_hide_fb_page_cover_photo" <?php echo $hide_fb_page_cover_photo ? 'checked' : ''; ?> />
                    </div>
                </div>
                <!-- Hide Facebook page cover photo end -->
                <hr class="ays_facebook_hr <?php echo $modal_content == 'facebook_type' ? '' : 'display_none'; ?>">
                <!-- Use small FB header start -->
                <div class="form-group row ays_facebook_type_option <?php echo $modal_content == 'facebook_type' ? '' : 'display_none'; ?>">
                    <div class="col-sm-3">
                        <label for="ays_pb_use_small_fb_header">
                            <?php  echo esc_html__('Use small header', "ays-popup-box" ) ?>
                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "Select this option if you want to use a smaller header for your Facebook page when it is displayed in the popup.", "ays-popup-box"); ?>" >
                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL . "/images/icons/info-circle.svg"); ?>">
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="checkbox" name="ays_pb_use_small_fb_header" id="ays_pb_use_small_fb_header" value="on" <?php echo $use_small_fb_header ? 'checked' : ''; ?> />
                    </div>
                </div>
                <!-- Use small FB header end -->
                <hr class="ays_notification_type_hr <?php echo $modal_content == 'notification_type' ? '' : 'display_none'; ?>">
                <div class="form-group ays_notification_type_option <?php echo $modal_content == 'notification_type' ? '' : 'display_none'; ?>">
                    <div class="ays_notification_type_components_sortable_wrap">
                        <ul class="ays_notification_type_components_sortable">
                            <?php
                                foreach ($notification_type_components_order as $key => $val) {
                                    $checked = '';
                                    if (isset($notification_type_components[$key]) && $notification_type_components[$key] == 'on') {
                                        $checked = 'checked';
                                    }

                                    $default_notification_type_component_names_label = '';
                                    if ( isset($default_notification_type_component_names[$key]) && $default_notification_type_component_names[$key] != '' ) {
                                        $default_notification_type_component_names_label = $default_notification_type_component_names[$key];
                                    }

                                    if ($default_notification_type_component_names_label == '') {
                                        continue;
                                    }
                            ?>
                                    <li class="ui-state-default">
                                        <div class="toggle_component_options open_component_options" data-open="<?php echo esc_attr($key); ?>">
                                            <img class="open_component_img" src="<?php echo esc_url(AYS_PB_ADMIN_URL . "/images/icons/edit-component.svg"); ?>">
                                            <img class="close_component_img display_none" src="<?php echo esc_url(AYS_PB_ADMIN_URL . "/images/icons/close-component.svg"); ?>">
                                        </div>
                                        <input type="hidden" value="<?php echo esc_attr($key); ?>" name="ays_notification_type_components_order[<?php echo esc_attr($key); ?>]"/>
                                        <?php
                                            if($key != 'main_content' && $key != 'button_1'):
                                        ?>
                                        <input type="checkbox" id="ays_show_<?php echo esc_attr($key); ?>" name="ays_notification_type_components[<?php echo esc_attr($key); ?>]" <?php echo esc_attr($checked); ?>/>
                                        <?php 
                                            endif;
                                        ?>
                                        <label for="ays_show_<?php echo esc_attr($key); ?>">
                                            <?php echo esc_html($default_notification_type_component_names_label); ?>
                                        </label>
                                    </li>
                            <?php
                                }
                            ?>
                        </ul>
                        <div class="ays_pb_component_option" style="display: none;" data-window="logo">
                            <div class="ays-pb-accordion-options-main-container">
                                <div class="ays-pb-accordion-header">
                                    <?php echo wp_kses($pb_acordion_svg_html, $allow_tags_acordion_arrow); ?>
                                    <p class="ays-subtitle"><?php echo  esc_html__('General', "ays-popup-box") ?></p>
                                </div>
                                <hr class="ays-pb-bolder-hr"/>
                                <div class="ays-pb-accordion-body">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_logo_image">
                                                <?php  echo esc_html__('Banner logo', "ays-popup-box" ) ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "Add a logo for the notification banner.", "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL . "/images/icons/info-circle.svg"); ?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <a href="javascript:void(0)" class="button ays-pb-notification-type-add-logo-img">
                                                <?php echo $notification_logo_image != '' ? esc_html__('Edit Image', "ays-popup-box") : esc_html__('Add Image', "ays-popup-box"); ?>
                                            </a>
                                            <div class="<?php echo $notification_logo_image != '' ? '' : 'display_none'; ?> ays-pb-notification-logo-container-main">
                                                <div class="ays-pb-notification-logo-container">
                                                    <span class="ays-remove-notification-type-logo-img"></span>
                                                    <img src="<?php echo esc_url($notification_logo_image) ?>" id="ays_pb_notification_logo">
                                                    <input type="hidden" name="ays_pb_notification_logo_image" id="ays_pb_notification_logo_image" value="<?php echo esc_url($notification_logo_image); ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ays-pb-notification-logo-settings-container <?php echo $notification_logo_image != '' ? '' : 'display_none' ?>">
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for="ays_pb_notification_logo_redirect_url">
                                                    <?php  echo esc_html__('Redirect URL', "ays-popup-box" ) ?>
                                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "The URL for redirecting after the user clicks on the logo.", "ays-popup-box"); ?>" >
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL . "/images/icons/info-circle.svg"); ?>">
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" id="ays_pb_notification_logo_redirect_url" class="ays-text-input" name="ays_pb_notification_logo_redirect_url" value="<?php echo esc_url($notification_logo_redirect_url) ?>" />
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for="ays_pb_notification_logo_redirect_to_new_tab">
                                                    <?php  echo esc_html__('Redirect to the new tab', "ays-popup-box" ) ?>
                                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "Tick this option to redirect to another tab.", "ays-popup-box"); ?>" >
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL . "/images/icons/info-circle.svg"); ?>">
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="checkbox" id="ays_pb_notification_logo_redirect_to_new_tab" name="ays_pb_notification_logo_redirect_to_new_tab" <?php echo $notification_logo_redirect_to_new_tab ? 'checked' : ''; ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ays-pb-accordion-options-main-container">
                                <div class="ays-pb-accordion-header">
                                    <?php echo wp_kses($pb_acordion_svg_html, $allow_tags_acordion_arrow); ?>
                                    <p class="ays-subtitle"><?php echo  esc_html__('Styles', "ays-popup-box") ?></p>
                                </div>
                                <hr class="ays-pb-bolder-hr"/>
                                <div class="ays-pb-accordion-body">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_logo_width">
                                                <?php  echo esc_html__('Width', "ays-popup-box" ) ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Specify the width of the logo.', "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL . "/images/icons/info-circle.svg"); ?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label for='ays_pb_notification_logo_width'>
                                                        <?php echo esc_html__('On Desktop', "ays-popup-box"); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Specify the width of the logo for desktop devices.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL . "/images/icons/info-circle.svg"); ?>">
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div style="display: flex; gap: 10px; align-items:center">
                                                        <div>
                                                            <input type="number" id="ays_pb_notification_logo_width" class="ays-text-input" name="ays_pb_notification_logo_width" value="<?php echo esc_attr($notification_logo_width); ?>" />
                                                        </div>
                                                        <div class="ays_pb_width_by_percentage_px_box">
                                                            <select name="ays_pb_notification_logo_width_measurement_unit" id="ays_pb_notification_logo_width_measurement_unit" class="ays_pb_aysDropdown ays-pb-percent">
                                                                <option value="pixels" <?php echo $notification_logo_width_measurement_unit == "pixels" ? "selected" : ""; ?>>
                                                                    <?php echo esc_html__( "px", "ays-popup-box" ); ?>
                                                                </option>
                                                                <option value="percentage" <?php echo $notification_logo_width_measurement_unit == "percentage" ? "selected" : ""; ?>>
                                                                    <?php echo esc_html__( "%", "ays-popup-box" ); ?>
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label for='ays_pb_notification_logo_width_mobile'>
                                                        <?php echo esc_html__('On mobile', "ays-popup-box"); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Specify the width of the logo for mobile devices.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL . "/images/icons/info-circle.svg"); ?>">
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div style="display: flex; gap: 10px; align-items:center">
                                                        <div>
                                                            <input type="number" id="ays_pb_notification_logo_width_mobile" class="ays-text-input" name="ays_pb_notification_logo_width_mobile" value="<?php echo esc_attr($notification_logo_width_mobile); ?>" />
                                                        </div>
                                                        <div class="ays_pb_width_by_percentage_px_box">
                                                            <select name="ays_pb_notification_logo_width_measurement_unit_mobile" id="ays_pb_notification_logo_width_measurement_unit_mobile" class="ays_pb_aysDropdown ays-pb-percent">
                                                                <option value="pixels" <?php echo $notification_logo_width_measurement_unit_mobile == "pixels" ? "selected" : ""; ?>>
                                                                    <?php echo esc_html__( "px", "ays-popup-box" ); ?>
                                                                </option>
                                                                <option value="percentage" <?php echo $notification_logo_width_measurement_unit_mobile == "percentage" ? "selected" : ""; ?>>
                                                                    <?php echo esc_html__( "%", "ays-popup-box" ); ?>
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_logo_max_width">
                                                <?php  echo esc_html__('Max-width', "ays-popup-box" ) ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Specify the max-width of the logo.', "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"; ?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label for='ays_pb_notification_logo_max_width'>
                                                        <?php echo esc_html__('On Desktop', "ays-popup-box"); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Specify the max-width of the logo for desktop devices.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div style="display: flex; gap: 10px">
                                                        <div>
                                                            <input type="number" id="ays_pb_notification_logo_max_width" class="ays-text-input" name="ays_pb_notification_logo_max_width" value="<?php echo esc_attr($notification_logo_max_width); ?>" />
                                                        </div>
                                                        <div class="ays_pb_width_by_percentage_px_box">
                                                            <select name="ays_pb_notification_logo_max_width_measurement_unit" id="ays_pb_notification_logo_max_width_measurement_unit" class="ays_pb_aysDropdown ays-pb-percent">
                                                                <option value="pixels" <?php echo $notification_logo_max_width_measurement_unit == "pixels" ? "selected" : ""; ?>>
                                                                    <?php echo esc_html__( "px", "ays-popup-box" ); ?>
                                                                </option>
                                                                <option value="percentage" <?php echo $notification_logo_max_width_measurement_unit == "percentage" ? "selected" : ""; ?>>
                                                                    <?php echo esc_html__( "%", "ays-popup-box" ); ?>
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label for='ays_pb_notification_logo_max_width_mobile'>
                                                        <?php echo esc_html__('On mobile', "ays-popup-box"); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Specify the max-width of the logo for mobile devices.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div style="display: flex; gap: 10px; align-items:center">
                                                        <div>
                                                            <input type="number" id="ays_pb_notification_logo_max_width_mobile" class="ays-text-input" name="ays_pb_notification_logo_max_width_mobile" value="<?php echo esc_attr($notification_logo_max_width_mobile); ?>" />
                                                        </div>
                                                        <div class="ays_pb_width_by_percentage_px_box">
                                                            <select name="ays_pb_notification_logo_max_width_measurement_unit_mobile" id="ays_pb_notification_logo_max_width_measurement_unit_mobile" class="ays_pb_aysDropdown ays-pb-percent">
                                                                <option value="pixels" <?php echo $notification_logo_max_width_measurement_unit_mobile == "pixels" ? "selected" : ""; ?>>
                                                                    <?php echo esc_html__( "px", "ays-popup-box" ); ?>
                                                                </option>
                                                                <option value="percentage" <?php echo $notification_logo_max_width_measurement_unit_mobile == "percentage" ? "selected" : ""; ?>>
                                                                    <?php echo esc_html__( "%", "ays-popup-box" ); ?>
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_logo_min_width">
                                                <?php  echo esc_html__('Min-width', "ays-popup-box" ) ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Specify the min-width of the logo.', "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label for='ays_pb_notification_logo_min_width'>
                                                        <?php echo esc_html__('On Desktop', "ays-popup-box"); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Specify the min-width of the logo for desktop devices.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div style="display: flex; gap: 10px">
                                                        <div>
                                                            <input type="number" id="ays_pb_notification_logo_min_width" class="ays-text-input" name="ays_pb_notification_logo_min_width" value="<?php echo esc_attr($notification_logo_min_width); ?>" />
                                                        </div>
                                                        <div class="ays_pb_width_by_percentage_px_box">
                                                            <select name="ays_pb_notification_logo_min_width_measurement_unit" id="ays_pb_notification_logo_min_width_measurement_unit" class="ays_pb_aysDropdown ays-pb-percent">
                                                                <option value="pixels" <?php echo $notification_logo_min_width_measurement_unit == "pixels" ? "selected" : ""; ?>>
                                                                    <?php echo esc_html__( "px", "ays-popup-box" ); ?>
                                                                </option>
                                                                <option value="percentage" <?php echo $notification_logo_min_width_measurement_unit == "percentage" ? "selected" : ""; ?>>
                                                                    <?php echo esc_html__( "%", "ays-popup-box" ); ?>
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label for='ays_pb_notification_logo_min_width_mobile'>
                                                        <?php echo esc_html__('On mobile', "ays-popup-box"); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Specify the min-width of the logo for mobile devices.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div style="display: flex; gap: 10px; align-items:center">
                                                        <div>
                                                            <input type="number" id="ays_pb_notification_logo_min_width_mobile" class="ays-text-input" name="ays_pb_notification_logo_min_width_mobile" value="<?php echo esc_attr($notification_logo_min_width_mobile); ?>" />
                                                        </div>
                                                        <div class="ays_pb_width_by_percentage_px_box">
                                                            <select name="ays_pb_notification_logo_min_width_measurement_unit_mobile" id="ays_pb_notification_logo_min_width_measurement_unit_mobile" class="ays_pb_aysDropdown ays-pb-percent">
                                                                <option value="pixels" <?php echo $notification_logo_min_width_measurement_unit_mobile == "pixels" ? "selected" : ""; ?>>
                                                                    <?php echo esc_html__( "px", "ays-popup-box" ); ?>
                                                                </option>
                                                                <option value="percentage" <?php echo $notification_logo_min_width_measurement_unit_mobile == "percentage" ? "selected" : ""; ?>>
                                                                    <?php echo esc_html__( "%", "ays-popup-box" ); ?>
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_logo_max_height">
                                                <?php  echo esc_html__('Max-height', "ays-popup-box" ) ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Specify the max-height of the logo in pixels. ', "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div style="display: flex; gap: 10px">
                                                <div>
                                                    <input type="number" id="ays_pb_notification_logo_max_height" class="ays-text-input" name="ays_pb_notification_logo_max_height" value="<?php echo esc_attr($notification_logo_max_height); ?>" />
                                                </div>
                                                <div class="ays_dropdown_max_width">
                                                    <input type="text" value="px" class="ays-form-hint-for-size" disabled>
                                                </div>
                                            </div>
                                            <span style="display:block;" class="ays-pb-small-hint-text"><?php echo esc_html__("For auto leave blank", "ays-popup-box");?></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_logo_min_height">
                                                <?php  echo esc_html__('Min-height', "ays-popup-box" ) ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Specify the min-height of the logo in pixels. ', "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div style="display: flex; gap: 10px">
                                                <div>
                                                    <input type="number" id="ays_pb_notification_logo_min_height" class="ays-text-input" name="ays_pb_notification_logo_min_height" value="<?php echo esc_attr($notification_logo_min_height); ?>" />
                                                </div>
                                                <div class="ays_dropdown_max_width">
                                                    <input type="text" value="px" class="ays-form-hint-for-size" disabled>
                                                </div>
                                            </div>
                                            <span style="display:block;" class="ays-pb-small-hint-text"><?php echo esc_html__("For auto leave blank", "ays-popup-box");?></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_logo_image_sizing">
                                                <?php  echo esc_html__('Logo image sizing', "ays-popup-box" ) ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Define the logo image size if needed.', "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="ays_pb_notification_logo_image_sizing" id="ays_pb_notification_logo_image_sizing" class="ays_pb_aysDropdown">
                                                <?php
                                                    foreach ($image_sizing_options as $key => $image_size) {
                                                        $selected = '';
                                                        if ($key == $notification_logo_image_sizing) {
                                                            $selected = 'selected';
                                                        }
                                                ?>
                                                <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>>
                                                    <?php echo esc_html($image_size); ?>
                                                </option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_logo_image_shape">
                                                <?php  echo esc_html__('Logo Image Shape', "ays-popup-box" ) ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Select the desired shape for the logo image', "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="ays_pb_notification_logo_image_shape" id="ays_pb_notification_logo_image_shape" class="ays_pb_aysDropdown">
                                                <option <?php echo 'rectangle' == $notification_logo_image_shape ? 'selected' : ''; ?> value="rectangle"><?php echo esc_html__('Rectangle', "ays-popup-box"); ?></option>
                                                <option <?php echo 'circle' == $notification_logo_image_shape ? 'selected' : ''; ?> value="circle"><?php echo esc_html__('Circle', "ays-popup-box"); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ays_pb_component_option" style="display: none;" data-window="main_content">
                            <?php
                                $content = $notification_main_content;
                                $editor_id = $this->plugin_name . '-notification-main-content';
                                $settings = array(
                                                'editor_height'=> $pb_wp_editor_height,
                                                'textarea_name'=> 'ays_pb_notification_main_content',
                                                'editor_class'=>'ays-textarea',
                                                'media_buttons' => true
                                            );
                                wp_editor($content,$editor_id,$settings);
                            ?>
                        </div>
                        <div class="ays_pb_component_option" style="display: none;" data-window="button_1">
                            <div class="ays-pb-accordion-options-main-container">
                                <div class="ays-pb-accordion-header">
                                    <?php echo wp_kses($pb_acordion_svg_html, $allow_tags_acordion_arrow); ?>
                                    <p class="ays-subtitle"><?php echo  esc_html__('General', "ays-popup-box") ?></p>
                                </div>
                                <hr class="ays-pb-bolder-hr"/>
                                <div class="ays-pb-accordion-body">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_button_1_text">
                                                <?php  echo esc_html__('Button text', "ays-popup-box" ) ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "Define the notification button text. Default value is 'Click!'", "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ays_pb_notification_button_1_text" class="ays-text-input" name="ays_pb_notification_button_1_text" value="<?php echo esc_attr($notification_button_1_text); ?>" />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_button_1_hover_text">
                                                <?php  echo esc_html__('Button hover text', "ays-popup-box" ) ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "Displays text when cursor is placed over the button.", "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ays_pb_notification_button_1_hover_text" class="ays-text-input" name="ays_pb_notification_button_1_hover_text" value="<?php echo esc_attr($notification_button_1_hover_text); ?>" />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_button_1_redirect_url">
                                                <?php  echo esc_html__('Redirect URL', "ays-popup-box" ) ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "The URL for redirecting after the user clicks on the button.", "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ays_pb_notification_button_1_redirect_url" class="ays-text-input" name="ays_pb_notification_button_1_redirect_url" value="<?php echo esc_attr($notification_button_1_redirect_url); ?>" />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_button_1_redirect_to_new_tab">
                                                <?php  echo esc_html__('Redirect to the new tab', "ays-popup-box" ) ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "Tick this option to redirect to another tab.", "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="checkbox" id="ays_pb_notification_button_1_redirect_to_new_tab" name="ays_pb_notification_button_1_redirect_to_new_tab" <?php echo esc_attr($notification_button_1_redirect_to_new_tab) ? 'checked' : ''; ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ays-pb-accordion-options-main-container">
                                <div class="ays-pb-accordion-header">
                                    <?php echo wp_kses($pb_acordion_svg_html, $allow_tags_acordion_arrow); ?>
                                    <p class="ays-subtitle"><?php echo  esc_html__('Background styles', "ays-popup-box") ?></p>
                                </div>
                                <hr class="ays-pb-bolder-hr"/>
                                <div class="ays-pb-accordion-body">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_button_1_bg_color">
                                                <?php  echo esc_html__('Background color', "ays-popup-box" ) ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Specify the background color of the button.", "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ays_pb_notification_button_1_bg_color" class="ays_pb_color_input" name="ays_pb_notification_button_1_bg_color" value="<?php echo esc_attr($notification_button_1_bg_color); ?>" data-default-color="#F66123" data-alpha="true" />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_button_1_bg_hover_color">
                                                <?php  echo esc_html__('Background hover color', "ays-popup-box" ) ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Specify the background color of the button on hover.", "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ays_pb_notification_button_1_bg_hover_color" class="ays_pb_color_input" name="ays_pb_notification_button_1_bg_hover_color" value="<?php echo esc_attr($notification_button_1_bg_hover_color); ?>" data-default-color="#F66123" data-alpha="true" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ays-pb-accordion-options-main-container">
                                <div class="ays-pb-accordion-header">
                                    <?php echo wp_kses($pb_acordion_svg_html, $allow_tags_acordion_arrow); ?>
                                    <p class="ays-subtitle"><?php echo  esc_html__('Font styles', "ays-popup-box") ?></p>
                                </div>
                                <hr class="ays-pb-bolder-hr"/>
                                <div class="ays-pb-accordion-body">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_button_1_text_color">
                                                <?php  echo esc_html__('Text color', "ays-popup-box" ) ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "Specify the text color of the button.", "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ays_pb_notification_button_1_text_color" class="ays_pb_color_input" name="ays_pb_notification_button_1_text_color" value="<?php echo esc_attr($notification_button_1_text_color); ?>" data-default-color="#FFFFFF" data-alpha="true" />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_button_1_text_hover_color">
                                                <?php  echo esc_html__('Text hover color', "ays-popup-box") ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "Specify the text color of the button on hover.", "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ays_pb_notification_button_1_text_hover_color" class="ays_pb_color_input" name="ays_pb_notification_button_1_text_hover_color" value="<?php echo esc_attr($notification_button_1_text_hover_color); ?>" data-default-color="#FFFFFF" data-alpha="true" />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_button_1_text_transformation">
                                                <?php  echo esc_html__('Text transformation', "ays-popup-box") ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "Specify how the text appears in all-uppercase or all-lowercase, or with each word capitalized.", "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="ays_pb_notification_button_1_text_transformation" id="ays_pb_notification_button_1_text_transformation" class="ays_pb_aysDropdown">
                                                <?php
                                                    foreach ($text_transform_options as $key => $text_transform) {
                                                        $selected = '';
                                                        if ($key == $notification_button_1_text_transformation) {
                                                            $selected = 'selected';
                                                        }
                                                ?>
                                                <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>>
                                                    <?php echo esc_html($text_transform); ?>
                                                </option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_button_1_text_decoration">
                                                <?php  echo esc_html__('Text decoration', "ays-popup-box") ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "Choose the line position for the button on the front end. Note: It is set as None by default.", "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="ays_pb_notification_button_1_text_decoration" id="ays_pb_notification_button_1_text_decoration" class="ays_pb_aysDropdown">
                                                <?php
                                                    foreach ($text_decoration_options as $key => $text_decoration) {
                                                        $selected = '';
                                                        if ($key == $notification_button_1_text_decoration) {
                                                            $selected = 'selected';
                                                        }
                                                ?>
                                                <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>>
                                                    <?php echo esc_html($text_decoration); ?>
                                                </option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_button_1_letter_spacing">
                                                <?php  echo esc_html__('Letter spacing', "ays-popup-box" ) ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "Define the space between the letters of the button in pixels.", "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label for='ays_pb_notification_button_1_letter_spacing'>
                                                        <?php echo esc_html__('On Desktop', "ays-popup-box"); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Define the space between the letters of the button in pixels for desktop devices.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input id="ays_pb_notification_button_1_letter_spacing" class="ays-pb-text-input ays-pb-text-input-short" name="ays_pb_notification_button_1_letter_spacing" type="number" value="<?php echo esc_attr($notification_button_1_letter_spacing); ?>">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label for='ays_pb_notification_button_1_letter_spacing_mobile'>
                                                        <?php echo esc_html__('On mobile', "ays-popup-box"); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Define the space between the letters of the button in pixels for mobile devices.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input id="ays_pb_notification_button_1_letter_spacing_mobile" class="ays-pb-text-input ays-pb-text-input-short" name="ays_pb_notification_button_1_letter_spacing_mobile" type="number" value="<?php echo esc_attr($notification_button_1_letter_spacing_mobile); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_button_1_font_size">
                                                <?php  echo esc_html__('Font size (px)', "ays-popup-box" ) ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "Define the font size of the button text in pixels.", "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label for='ays_pb_notification_button_1_font_size'>
                                                        <?php echo esc_html__('On Desktop', "ays-popup-box"); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Define the font size of the button text in pixels for desktop devices.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input id="ays_pb_notification_button_1_font_size" class="ays-pb-text-input ays-pb-text-input-short" name="ays_pb_notification_button_1_font_size" type="number" value="<?php echo esc_attr($notification_button_1_font_size); ?>">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label for='ays_pb_notification_button_1_font_size_mobile'>
                                                        <?php echo esc_html__('On mobile', "ays-popup-box"); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Define the font size of the button text in pixels for mobile devices.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input id="ays_pb_notification_button_1_font_size_mobile" class="ays-pb-text-input ays-pb-text-input-short" name="ays_pb_notification_button_1_font_size_mobile" type="number" value="<?php echo esc_attr($notification_button_1_font_size_mobile); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_button_1_font_weight">
                                                <?php echo esc_html__('Font weight', "ays-popup-box") ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "Specify the font weight for the button. Note: By default, it is set as Normal.", "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label for='ays_pb_notification_button_1_font_weight'>
                                                        <?php echo esc_html__('On Desktop', "ays-popup-box"); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Specify the font weight for the button for desktop devices.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <select name="ays_pb_notification_button_1_font_weight" id="ays_pb_notification_button_1_font_weight" class="ays_pb_aysDropdown">
                                                        <?php
                                                            foreach ($font_weight_options as $key => $font_weight) {
                                                                $selected = '';
                                                                if ($key == $notification_button_1_font_weight) {
                                                                    $selected = 'selected';
                                                                }
                                                        ?>
                                                        <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>>
                                                            <?php echo esc_html($font_weight); ?>
                                                        </option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label for='ays_pb_notification_button_1_font_weight_mobile'>
                                                        <?php echo esc_html__('On mobile', "ays-popup-box"); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Specify the font weight for the button for mobile devices.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <select name="ays_pb_notification_button_1_font_weight_mobile" id="ays_pb_notification_button_1_font_weight_mobile" class="ays_pb_aysDropdown">
                                                        <?php
                                                            foreach ($font_weight_options as $key => $font_weight) {
                                                                $selected = '';
                                                                if ($key == $notification_button_1_font_weight_mobile) {
                                                                    $selected = 'selected';
                                                                }
                                                        ?>
                                                        <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>>
                                                            <?php echo esc_html($font_weight); ?>
                                                        </option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ays-pb-accordion-options-main-container">
                                <div class="ays-pb-accordion-header">
                                    <?php echo wp_kses($pb_acordion_svg_html, $allow_tags_acordion_arrow); ?>
                                    <p class="ays-subtitle"><?php echo  esc_html__('Border styles', "ays-popup-box") ?></p>
                                </div>
                                <hr class="ays-pb-bolder-hr"/>
                                <div class="ays-pb-accordion-body">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_button_1_border_radius">
                                                <?php  echo esc_html__('Border radius', "ays-popup-box" ) ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "Specify the radius of the border. Allows adding rounded corners to the button.", "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input id="ays_pb_notification_button_1_border_radius" class="ays-pb-text-input ays-pb-text-input-short" name="ays_pb_notification_button_1_border_radius" type="number" value="<?php echo esc_attr($notification_button_1_border_radius); ?>">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_button_1_border_width">
                                                <?php  echo esc_html__('Border width', "ays-popup-box" ) ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "Specify the border size of the button in pixels.", "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input id="ays_pb_notification_button_1_border_width" class="ays-pb-text-input ays-pb-text-input-short" name="ays_pb_notification_button_1_border_width" type="number" value="<?php echo esc_attr($notification_button_1_border_width); ?>">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_button_1_border_color">
                                                <?php  echo esc_html__('Border color', "ays-popup-box" ) ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "Specify the border color of the button.", "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="ays_pb_notification_button_1_border_color" class="ays_pb_color_input" name="ays_pb_notification_button_1_border_color" value="<?php echo esc_attr($notification_button_1_border_color); ?>" data-default-color="#FFFFFF" data-alpha="true" />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_button_1_border_style">
                                                <span>
                                                    <?php echo  esc_html__('Border style',"ays-popup-box") ?>
                                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Choose your preferred style of the border.", "ays-popup-box"); ?>">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                    </a>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="ays_pb_notification_button_1_border_style" id="ays_pb_notification_button_1_border_style" class="ays_pb_aysDropdown">
                                                <?php
                                                    $selected = "";
                                                    foreach ($border_styles as $key => $border_style) {
                                                        $selected = "";
                                                        if ($key == $notification_button_1_border_style) {
                                                            $selected = "selected";
                                                        }
                                                ?>
                                                <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>>
                                                    <?php echo esc_html($border_style); ?>
                                                </option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ays-pb-accordion-options-main-container">
                                <div class="ays-pb-accordion-header">
                                    <?php echo wp_kses($pb_acordion_svg_html, $allow_tags_acordion_arrow); ?>
                                    <p class="ays-subtitle"><?php echo  esc_html__('Container styles', "ays-popup-box") ?></p>
                                </div>
                                <hr class="ays-pb-bolder-hr"/>
                                <div class="ays-pb-accordion-body">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_button_1_padding_left_right">
                                                <span>
                                                    <?php echo  esc_html__('Padding',"ays-popup-box") ?>
                                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Padding of button.", "ays-popup-box"); ?>">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                    </a>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="col-sm-9 ays_pb_notification_button_paddings_container">
                                            <div class="col-sm-4">
                                                <span class="ays-pb-small-hint-text"><?php echo  esc_html__('Left / Right',"ays-popup-box") ?></span>
                                                <input type="number" class="ays-pb-text-input ays-pb-text-input-short" id="ays_pb_notification_button_1_padding_left_right" name="ays_pb_notification_button_1_padding_left_right" style="width: 100px;" value="<?php echo esc_attr($notification_button_1_padding_left_right); ?>">
                                            </div>
                                            <div class="col-sm-4 ays_divider_left">
                                                <span class="ays-pb-small-hint-text"><?php echo  esc_html__('Top / Bottom',"ays-popup-box") ?></span>
                                                <input type="number" class="ays-pb-text-input ays-pb-text-input-short" id="ays_pb_notification_button_1_padding_top_bottom" name="ays_pb_notification_button_1_padding_top_bottom" style="width: 100px;" value="<?php echo esc_attr($notification_button_1_padding_top_bottom); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_button_1_transition">
                                                <?php  echo esc_html__('Transition', "ays-popup-box" ) ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__( "Set the button's transition duration in seconds. This controls the time it takes for the button's style changes, such as hover effects, to animate smoothly.", "ays-popup-box"); ?>" >
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div style="display: flex; gap: 10px">
                                                <div>
                                                    <input id="ays_pb_notification_button_1_transition" class="ays-pb-text-input ays-pb-text-input-short" name="ays_pb_notification_button_1_transition" type="number" step="0.1" value="<?php echo esc_attr($notification_button_1_transition); ?>">
                                                </div>
                                                <div class="ays_dropdown_max_width">
                                                    <input type="text" value="sec" class="ays-form-hint-for-size" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="ays_pb_notification_button_1_enable_box_shadow">
                                                <span>
                                                    <?php echo esc_html__('Box shadow',"ays-popup-box"); ?>
                                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Allow button box shadow.',"ays-popup-box")?>">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                    </a>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="form-group row ays_toggle_parent">
                                                <input type="checkbox" class="ays_toggle ays_toggle_slide" id="ays_pb_notification_button_1_enable_box_shadow" name="ays_pb_notification_button_1_enable_box_shadow" <?php echo $notification_button_1_enable_box_shadow ? 'checked' : ''; ?>>
                                                <label for="ays_pb_notification_button_1_enable_box_shadow" class="ays_switch_toggle">Toggle</label>
                                                <div class="col-sm-12 ays_toggle_target ays_divider_top" style="margin-top: 10px; padding: 10px 0 0 0; <?php echo $notification_button_1_enable_box_shadow ? '' : 'display: none'; ?>">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <label for="ays_pb_notification_button_1_box_shadow_color">
                                                                <?php echo esc_html__('Box shadow color',"ays-popup-box")?>
                                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('The color of the shadow of the button',"ays-popup-box" ); ?>">
                                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                                </a>
                                                            </label>
                                                            <input type="text" class="ays_pb_color_input" id='ays_pb_notification_button_1_box_shadow_color' name='ays_pb_notification_button_1_box_shadow_color' data-alpha="true" data-default-color="#000000" value="<?php echo esc_attr($notification_button_1_box_shadow_color); ?>"/>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group row">
                                                        <div class="col-sm-4 ays_pb_notification_button_offset_container">
                                                            <span class="ays_pb_small_hint_text"><?php echo esc_html__('X', "ays-popup-box"); ?></span>
                                                            <input type="number" class="ays-text-input ays-text-input-90-width" id='ays_pb_notification_button_1_box_shadow_x_offset' name='ays_pb_notification_button_1_box_shadow_x_offset' value="<?php echo esc_attr($notification_button_1_box_shadow_x_offset); ?>" />
                                                        </div>
                                                        <div class="col-sm-4 ays_divider_left ays_pb_notification_button_offset_container">
                                                            <span class="ays_pb_small_hint_text"><?php echo esc_html__('Y', "ays-popup-box"); ?></span>
                                                            <input type="number" class="ays-text-input ays-text-input-90-width" id='ays_pb_notification_button_1_box_shadow_y_offset' name='ays_pb_notification_button_1_box_shadow_y_offset' value="<?php echo esc_attr($notification_button_1_box_shadow_y_offset); ?>" />
                                                        </div>
                                                        <div class="col-sm-4 ays_divider_left ays_pb_notification_button_offset_container">
                                                            <span class="ays_pb_small_hint_text"><?php echo esc_html__('Z', "ays-popup-box"); ?></span>
                                                            <input type="number" class="ays-text-input ays-text-input-90-width" id='ays_pb_notification_button_1_box_shadow_z_offset' name='ays_pb_notification_button_1_box_shadow_z_offset' value="<?php echo esc_attr($notification_button_1_box_shadow_z_offset); ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="ays_pb_hide_for_video_type ays_pb_hide_for_image_type ays_pb_hide_for_notification_type <?php echo ($modal_content == 'video_type' || $modal_content == 'image_type' || $modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                <div class="form-group row ays-field ays_pb_hide_for_video_type ays_pb_hide_for_image_type ays_pb_hide_for_notification_type <?php echo ($modal_content == 'video_type' || $modal_content == 'image_type' || $modal_content == 'notification_type') ? 'display_none' : ''; ?>" id="ays-popup-box-description">
                    <div class="col-sm-3">
                        <label for="<?php echo esc_attr($this->plugin_name); ?>-popup_description">
                            <span><?php echo esc_html__('Popup description', "ays-popup-box"); ?></span>
                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("The option is not being displayed on the front-end by default. Please activate it from the Styles tab.", "ays-popup-box"); ?>">
                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                            </a>
                        </label>
                        <div class="ays-pb-description-small-hint <?php echo $show_popup_desc == 'On' ? 'display_none' : ''; ?>">
                            <p class="ays-pb-small-hint-text">
                                <?php echo esc_html__("This option is currently unavailable as the 'Show Description' option is disabled.", "ays-popup-box"); ?>
                                <br>
                                <?php echo esc_html__("To find the 'Show Description' option, head to the Styles Tab of the given popup.", "ays-popup-box"); ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <?php
                            $content = $description;
                            $editor_id = $this->plugin_name . '-popup_description';
                            $settings = array('editor_height'=> $pb_wp_editor_height,'textarea_name'=> $this->plugin_name . '[popup_description]', 'editor_class'=>'ays-textarea', 'media_buttons' => true);
                            wp_editor($content,$editor_id,$settings);
                        ?>
                    </div>
                </div>
                <hr>
                <!-- Enable popup for author only start-->
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="ays_pb_show_popup_only_for_author">
                            <span><?php echo esc_html__('Show popup only for author', "ays-popup-box"); ?></span>
                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('If this option is enabled only the author of the popup will be able to see it.', "ays-popup-box") ?>"> 
                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                            </a>
                        </label>
                        <span class="ays-pb-small-hint-text ays-pb-show-only-for-author-hint-text"><?php echo esc_html__("For testing", "ays-popup-box");?></span>
                    </div>
                    <div class="col-sm-9">
                        <input type="checkbox" name="ays_pb_show_popup_only_for_author" id="ays_pb_show_popup_only_for_author" <?php echo $show_only_for_author ? 'checked' : ''; ?>>
                    </div>
                </div>
                <!-- Enable popup for author only end-->
                <hr>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="<?php echo esc_attr($this->plugin_name); ?>-show_all_yes">
                            <span><?php echo esc_html__('Display', "ays-popup-box"); ?></span>
                            <a class="ays_help" data-toggle="tooltip" data-html="true"
                                title="<?php
                                    echo esc_html__('Define the pages your popup will be loaded on.',"ays-popup-box");
                                ?>">
                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <label class="ays-pb-label-style" for="<?php echo esc_attr($this->plugin_name); ?>-show_all_yes"><?php echo esc_html__("All pages", "ays-popup-box"); ?>
                            <input type="radio" id="<?php echo esc_attr($this->plugin_name); ?>-show_all_yes" name="<?php echo esc_attr($this->plugin_name); ?>[show_all]" value="all" <?php echo $show_all == 'yes' || $show_all == 'all' ? 'checked' : ''; ?> />
                        </label>
                        <label class="ays-pb-label-style" for="<?php echo esc_attr($this->plugin_name); ?>-show_all_except"><?php echo esc_html__("Except", "ays-popup-box"); ?>
                            <input type="radio" id="<?php echo esc_attr($this->plugin_name); ?>-show_all_except" name="<?php echo esc_attr($this->plugin_name); ?>[show_all]" value="except" <?php echo $show_all == 'except' ? 'checked' : ''; ?>/>
                        </label>
                        <label class="ays-pb-label-style" for="<?php echo esc_attr($this->plugin_name); ?>-show_all_selected"><?php echo esc_html__("Include", "ays-popup-box"); ?>
                            <input type="radio" id="<?php echo esc_attr($this->plugin_name); ?>-show_all_selected" name="<?php echo esc_attr($this->plugin_name); ?>[show_all]" value="selected" <?php echo $show_all == 'selected' || $show_all == 'no' ? 'checked' : ''; ?>/>
                        </label>
                        <a class="ays_help" style="font-size:15px;" data-toggle="tooltip" data-html="true"
                            title="<?php
                                echo esc_html__('Choose the method of calculation.',"ays-popup-box") .
                                "<ul style='list-style-type: circle;padding-left: 20px;'>".
                                    "<li>". esc_html__('All pages - The popup will display on all pages.',"ays-popup-box") ."</li>".
                                    "<li>". esc_html__('Except - Choose the post/page and post/page types excluding the popup.',"ays-popup-box") ."</li>".
                                    "<li>". esc_html__('Include - Choose the post/page and post/page types including the popup.',"ays-popup-box") ."</li>".
                                "</ul>";
                            ?>">
                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                        </a>
                    </div>
                </div>
                <div class="ays_pb_view_place_tr ays-field <?php echo $show_all == 'yes' || $show_all == 'all' ? 'display_none' : ''; ?>">
                    <hr/>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="ays_pb_post_types"><?php echo esc_html__("Post type", "ays-popup-box"); ?></label>
                            <a class="ays_help" data-toggle="tooltip"
                               title="<?php echo esc_html__('Select post types.', "ays-popup-box") ?>">
                               <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                            </a>
                        </div>
                        <div class="col-sm-9">
                            <select name="ays_pb_except_post_types[]" id="ays_pb_post_types" class="form-control"
                                    multiple="multiple">
                                <?php
                                    foreach ($all_post_types as $post_type) {
                                        if($except_post_types) {
                                            $checked = (in_array($post_type->name, $except_post_types)) ? "selected" : "";
                                        }else{
                                            $checked = "";
                                        }
                                        echo wp_kses("<option value='{$post_type->name}' {$checked}>{$post_type->label}</option>", array(
                                            'option' => array(
                                                'value' => array(),
                                                'selected' => array()
                                            )
                                        ));
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="ays_pb_posts"><?php echo esc_html__("Posts", "ays-popup-box"); ?></label>
                            <a class="ays_help" data-toggle="tooltip"
                               title="<?php echo esc_html__('Select posts.', "ays-popup-box") ?>">
                               <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                            </a>
                        </div>
                        <div class="col-sm-9">
                            <select name="ays_pb_except_posts[]" id="ays_pb_posts" class="form-control"
                                    multiple="multiple">
                                <?php
                                    foreach ( $posts as $post ) {
                                       
                                        $checked = (is_array($except_posts) && in_array($post->ID, $except_posts)) ? "selected" : "";
                                        echo wp_kses("<option value='{$post->ID}' {$checked}>{$post->post_title}</option>", array(
                                            'option' => array(
                                                'value' => array(),
                                                'selected' => array()
                                            )
                                        ));
                                    }
                                    if (!empty($view_place)) {
                                        $args = array(
                                            'post_type' => array('post', 'page'),
                                            'nopaging'  => true
                                        );
                                        // Custom query.
                                        $query = new WP_Query( $args );

                                        if($query->have_posts()){
                                            foreach ($query->posts as $key => $post){
                                                if(in_array($post->ID, $view_place)):
                                                    ?>
                                                    <option selected value="<?php echo esc_attr($post->ID); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></option> 
                                                <?php
                                                endif;
                                            }
                                        }
                                    }
                                ?>
                            </select>
                            <input type='hidden' id="ays_pb_except_posts_id">
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="ays_pb_show_on_home_page" style="margin-bottom:0px;">
                                <span><?php echo esc_html__('Show on Home page', "ays-popup-box"); ?></span>
                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('If the checkbox is ticked, then the popup will be loaded on the Home page too, in addition to the values given above.', "ays-popup-box"); ?>">
                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                </a>
                            </label>
                        </div>
                        <div class="col-sm-9">
                            <p class="onoffswitch" style="margin: 0px;">
                                <input type="checkbox" name="ays_pb_show_on_home_page" class="ays-pb-onoffswitch-checkbox" id="ays_pb_show_on_home_page" <?php echo ($show_on_home_page == 'on') ? 'checked' : '' ?> >
                            </p>
                            <div class="ays-pb-youtube-video-link">
                                <div class="ays-pb-small-hint-text">
                                    <a href="https://youtu.be/wMv-H2jGTaI?list=PL4ufu1uAjjWQTYn0O_72TLzmqgmVIYKI2" target="_blank">
                                        <?php echo esc_html__( 'How to Create Homepage Popup', "ays-popup-box"  ); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
                <hr class="ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                <div class="form-group row ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                    <div class="col-sm-3">
                        <label for="<?php echo esc_attr($this->plugin_name); ?>-action_button_type">
                            <span> <?php echo esc_html__('Popup trigger', "ays-popup-box"); ?></span>
                                <a class="ays_help" data-toggle="tooltip" data-html="true"
                                title="<?php
                                    echo htmlspecialchars(esc_html__('Choose the trigger causing the popup to open on certain events.',"ays-popup-box") .
                                    "<ul style='list-style-type: circle;padding-left: 20px;'>".
                                        "<li>". esc_html__('Onload',"ays-popup-box") ."</li>".
                                        "<li>". esc_html__('Onclick',"ays-popup-box") ."</li>".
                                        "<li>". esc_html__('Both(On page load & On click)',"ays-popup-box") ."</li>".
                                    "</ul>"
                                    );
                                ?>">
                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                </a>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <select id="<?php echo esc_attr($this->plugin_name); ?>-action_button_type" class="ays_pb_aysDropdown" name="<?php echo esc_attr($this->plugin_name); ?>[action_button_type]">
                            <option <?php if(!isset($action_button_type)){ echo 'selected'; } echo 'both' == $action_button_type ? 'selected' : ''; ?> value="both"><?php echo esc_html__('Both (On page load & On click)', "ays-popup-box"); ?></option>
                            <option <?php echo 'pageLoaded' == $action_button_type ? 'selected' : ''; ?> value="pageLoaded"><?php echo esc_html__('Onload', "ays-popup-box"); ?></option>
                            <option <?php echo 'clickSelector' == $action_button_type ? 'selected' : ''; ?> value="clickSelector"><?php echo esc_html__('On Click', "ays-popup-box"); ?></option>
                            <option value="exit_intent" disabled><?php echo esc_html__('On hover (Pro)', "ays-popup-box"); ?></option>
                            <option value="exit_intent" disabled><?php echo esc_html__('Exit Intent (Pro)', "ays-popup-box"); ?></option>
                            <option value="exit_intent" disabled><?php echo esc_html__('After visiting x pages (Pro)', "ays-popup-box"); ?></option>
                            <option value="exit_intent" disabled><?php echo esc_html__('Inactivity (Pro)', "ays-popup-box"); ?></option>
                            <option value="exit_intent" disabled><?php echo esc_html__('Scrolling to element (Pro)', "ays-popup-box"); ?></option>
                        </select>
                        <a class="ays_help ays-pb-triggers-tooltip" data-toggle="tooltip" data-html="true" title="<?php
                            foreach ($show_popup_triggers_tooltip as $key => $show_popup_trigger_tooltip) {
                                if($key == $action_button_type){
                                    echo htmlspecialchars($show_popup_trigger_tooltip);
                                }
                            }
                        ?>">
                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                        </a>
                        <div class="ays-pb-youtube-video-link">
                            <div class="ays-pb-small-hint-text">
                            <a href="https://youtu.be/YTB5_J74AIg" target="_blank">
                                <?php echo esc_html__("View how to make popup on button click", "ays-popup-box");?>
                            </a>
                            </div>
                        </div>
                        <div class="ays-pb-youtube-video-link">
                            <div class="ays-pb-small-hint-text">
                            <a href="https://youtu.be/Phsw4q2mDmE" target="_blank">
                                <?php echo esc_html__("How to Set Popup Triggers with WordPress Popup Plugin (PRO)", "ays-popup-box");?>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="ays_pb_hide_for_notification_type <?php echo ($modal_content != 'notification_type' && ('clickSelector' == $action_button_type  || 'both' == $action_button_type))  ? '' : 'display_none'; ?>">
                <div class="form-group row ays-pb-open-click-hover ays_pb_hide_for_notification_type <?php echo ($modal_content != 'notification_type' && ('clickSelector' == $action_button_type  || 'both' == $action_button_type))  ? '' : 'display_none'; ?>">
                    <div class="col-sm-3">
                        <label for="<?php echo esc_attr($this->plugin_name); ?>-action_button">
                    <span>
                        <?php echo esc_html__('CSS selector(s) for trigger click', "ays-popup-box"); ?>
                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Add your preferred CSS selector(s) if you have given “On click” or “Both” value to the “Popup trigger” option. For example #mybutton or .mybutton.", "ays-popup-box"); ?>">
                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                        </a>
                    </span>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="<?php echo esc_attr($this->plugin_name); ?>-action_button" name="<?php echo esc_attr($this->plugin_name); ?>[action_button]"  class="ays-text-input" value="<?php echo $action_button; ?>" placeholder="#myButtonId, .myButtonClass, .myButton" />
                        <span style="display:block;" class="ays-pb-small-hint-text"><?php echo esc_html__( 'Enter the class starting with a “ . ” and id with a “ # ”', "ays-popup-box" ); ?></span>
                    </div>
                </div>
                <hr class="ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>" />
                <div class="pb_position_block ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="<?php echo esc_attr($this->plugin_name); ?>-position">
                                <span><?php echo esc_html__('Popup position', "ays-popup-box"); ?></span>
                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Specify the position of the popup on the screen. ", "ays-popup-box"); ?>">
                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                </a>
                            </label>
                        </div>
                        <div class="col-sm-9 ays_pb_pc_and_mobile_container">
                            <div>
                                <div class="ays_pb_position_table_container">
                                    <span class="ays_pb_current_device_name <?php echo $enable_pb_position_mobile ? 'show' : '' ?>"><?php echo esc_html__('Desktop', "ays-popup-box") ?></span>
                                    <table id="ays-pb-position-table" data-flag="popup_position">
                                        <tr>
                                            <td data-value="left-top" data-id='1'></td>
                                            <td data-value="top-center"data-id='2'></td>
                                            <td data-value="right-top" data-id='3'></td>
                                        </tr>
                                        <tr>
                                            <td data-value="left-center" data-id='4'></td>
                                            <td id="pb_position_center" data-value="center-center" data-id='5'></td>
                                            <td data-value="right-center" data-id='6'></td>
                                        </tr>
                                        <tr>
                                            <td data-value="left-bottom" data-id='7'></td>
                                            <td data-value="center-bottom" data-id='8'></td>
                                            <td data-value="right-bottom" data-id='9'></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="ays_pb_mobile_settings_container">
                                    <input type="checkbox" class="ays_pb_different_settings_for_mobile" id="ays_pb_enable_popup_position_mobile" name="ays_pb_enable_popup_position_mobile" <?php echo $enable_pb_position_mobile ? 'checked' : '' ?>>
                                    <label for="ays_pb_enable_popup_position_mobile" class="<?php echo $enable_pb_position_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                </div>
                            </div>
                            <div class="ays_pb_option_for_mobile_device <?php echo $enable_pb_position_mobile ? 'show' : '' ?> ">
                                <div class="ays_pb_position_table_container">
                                    <span class="ays_pb_current_device_name <?php echo $enable_pb_position_mobile ? 'show' : '' ?>"><?php echo esc_html__('Mobile', "ays-popup-box") ?></span>
                                    <table id="ays-pb-position-table-mobile" data-flag="popup_position_mobile">
                                        <tr>
                                            <td data-value="left-top" data-id='1'></td>
                                            <td data-value="top-center"data-id='2'></td>
                                            <td data-value="right-top" data-id='3'></td>
                                        </tr>
                                        <tr>
                                            <td data-value="left-center" data-id='4'></td>
                                            <td id="pb_position_center" data-value="center-center" data-id='5'></td>
                                            <td data-value="right-center" data-id='6'></td>
                                        </tr>
                                        <tr>
                                            <td data-value="left-bottom" data-id='7'></td>
                                            <td data-value="center-bottom" data-id='8'></td>
                                            <td data-value="right-bottom" data-id='9'></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <input type="hidden" name="<?php echo esc_attr($this->plugin_name); ?>[pb_position]" class="ays-pb-position-val-class" id="ays-pb-position-val" value="<?php echo $pb_position; ?>" >
                            <input type="hidden" name="ays_pb_position_mobile" class="ays-pb-position-val-class-mobile" id="ays-pb-position-val-mobile" value="<?php echo $pb_position_mobile; ?>" >
                        </div>
                    </div>
                    <hr class="ays_pb_hr_hide" />
                    <div id="popupMargin" class="form-group row">
                        <div class="col-sm-3">
                            <label for="<?php echo esc_attr($this->plugin_name); ?>-pb_margin">
                                <span><?php echo esc_html__('Popup margin(px)', "ays-popup-box"); ?></span>
                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Specify the popup margin in pixels. It accepts only numerical values.", "ays-popup-box"); ?>">
                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                </a>
                            </label>
                        </div>
                        <div class="col-sm-9">
                            <input type="number" id="<?php echo esc_attr($this->plugin_name); ?>-pb_margin" name="<?php echo esc_attr($this->plugin_name); ?>[pb_margin]"  class="ays-pb-text-input ays-pb-text-input-short"  value="<?php echo $pb_margin; ?>" />
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab2" class="ays-pb-tab-content  <?php echo ($ays_pb_tab == 'tab2') ? 'ays-pb-tab-content-active' : ''; ?>">
                <div class="ays-pb-accordion-options-main-container">
                    <div class="d-flex justify-content-end align-items-center">
                        <div class="d-flex justify-content-between align-items-center" style="gap: 5px; font-size: 13px">
                            <div>
                                <a href="javascript:void(0);" class="ays-pb-collapse-all-options"><?php echo esc_html__("Collapse All", "ays-popup-box"); ?></a>
                            </div>    
                            |               
                            <div>
                                <a href="javascript:void(0);" class="ays-pb-expand-all-options"><?php echo esc_html__("Expand All", "ays-popup-box"); ?></a>
                            </div>                   
                        </div>
                    </div>
                    <div class="ays-pb-accordion-header ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                        <?php echo wp_kses($pb_acordion_svg_html, $allow_tags_acordion_arrow); ?>
                        <p class="ays-subtitle"><?php echo  esc_html__('Popup opening', "ays-popup-box") ?></p>
                    </div>
                    <hr class="ays-pb-bolder-hr ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                    <div class="ays-pb-accordion-body ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                        <!-- Opening delay starts -->
                        <div class="form-group row ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                            <div class="col-sm-3">
                                <label for="<?php echo esc_attr($this->plugin_name); ?>-delay" style="margin-bottom:0px;">
                                    <span><?php echo esc_html__('Open Delay ', "ays-popup-box"); ?></span>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Open the popup when a visitor has viewed your website content for a specified period of time (in milliseconds). To disable the option leave it blank or set it to 0.", "ays-popup-box"); ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9 ays_divider_left ays_pb_pc_and_mobile_container">
                                <div>
                                    <div class="ays_pb_pc_and_mobile_box">
                                        <!-- opening delay Desktop -->
                                        <div class="ays_popup_display_flex_width">
                                            <div>
                                                <input type="number" id="<?php echo esc_attr($this->plugin_name); ?>-delay" name="<?php echo esc_attr($this->plugin_name); ?>[delay]"  class="ays-pb-text-input ays-pb-text-input-short"  value="<?php echo $open_delay; ?>">
                                                <span style="display:block;" class="ays-pb-small-hint-text"><?php echo esc_html__( '1 sec = 1000 ms', "ays-popup-box" ); ?></span>
                                                <div style="text-align: center;">
                                                    <span class="ays_pb_current_device_name <?php echo $enable_open_delay_mobile ? 'show' : '' ?>"><?php echo esc_html__('Desktop', "ays-popup-box") ?></span>
                                                </div>
                                            </div>
                                            <div class="ays_dropdown_max_width">
                                                <input type="text" value="ms" class="ays-form-hint-for-size" disabled="">
                                            </div>
                                        </div>
                                        <!-- opening delay Mobile -->
                                        <div class="ays_pb_option_for_mobile_device ays_popup_display_flex_width ays_divider_left <?php echo $enable_open_delay_mobile ? 'show' : '' ?>">
                                            <div>
                                                <input type="number" id="<?php echo esc_attr($this->plugin_name); ?>-delay-mobile" name="ays_pb_open_delay_mobile"  class="ays-pb-text-input ays-pb-text-input-short"  value="<?php echo $open_delay_mobile ?>">
                                                <span style="display:block;" class="ays-pb-small-hint-text"><?php echo esc_html__( '1 sec = 1000 ms', "ays-popup-box" ); ?></span>
                                                <div style="text-align: center;">
                                                    <span class="ays_pb_current_device_name <?php echo $enable_open_delay_mobile ? 'show' : '' ?>"><?php echo esc_html__('Mobile', "ays-popup-box") ?></span>
                                                </div>
                                            </div>
                                            <div class="ays_dropdown_max_width">
                                                <input type="text" value="ms" class="ays-form-hint-for-size" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ays-pb-youtube-video-link">
                                        <div class="ays-pb-small-hint-text">
                                            <a href="https://youtu.be/1ryQv9ojgMY?list=PL4ufu1uAjjWQTYn0O_72TLzmqgmVIYKI2" target="_blank">
                                                <?php echo esc_html__('How to Show Popup after a Time Delay', "ays-popup-box")?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ays_pb_mobile_settings_container">
                                        <input type="checkbox" class="ays_pb_different_settings_for_mobile" id="ays_pb_enable_open_delay_mobile" name="ays_pb_enable_open_delay_mobile" <?php echo $enable_open_delay_mobile ? 'checked' : '' ?>>
                                        <label for="ays_pb_enable_open_delay_mobile" class="<?php echo $enable_open_delay_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Opening delay end -->
                        <hr class="ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                        <!-- Scroll from top starts -->
                        <div class="form-group row ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                            <div class="col-sm-3">
                                <label for="<?php echo esc_attr($this->plugin_name); ?>-scroll_top">
                                    <span><?php echo esc_html__('Open by Scrolling Down', "ays-popup-box"); ?></span>
                                     <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Define the scroll length by pixels to open the popup when scrolling. To disable the option leave it blank or set it to 0.", "ays-popup-box"); ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9 ays_divider_left ays_pb_pc_and_mobile_container">
                                <div>
                                    <div class="ays_pb_pc_and_mobile_box">
                                        <!-- Scroll from top desktop -->
                                        <div class="ays_popup_display_flex_width">
                                            <div>
                                                <input type="number" id="<?php echo esc_attr($this->plugin_name); ?>-scroll_top" name="<?php echo esc_attr($this->plugin_name); ?>[scroll_top]"  class="ays-pb-text-input ays-pb-text-input-short"  value="<?php echo $scroll_top; ?>">
                                                <div style="text-align: center;">
                                                    <span class="ays_pb_current_device_name <?php echo $enable_scroll_top_mobile ? 'show' : '' ?>"><?php echo esc_html__('Desktop', "ays-popup-box") ?></span>
                                                </div>
                                            </div>
                                            <div class="ays_dropdown_max_width">
                                                <input type="text" value="px" class="ays-form-hint-for-size" disabled="">
                                            </div>
                                        </div>
                                        <!-- Scroll from top Mobile -->
                                        <div class="ays_pb_option_for_mobile_device ays_popup_display_flex_width ays_divider_left <?php echo $enable_scroll_top_mobile ? 'show' : '' ?>">
                                            <div>
                                                <input type="number" id="<?php echo esc_attr($this->plugin_name); ?>-scroll_top-mobile" name="ays_pb_scroll_top_mobile"  class="ays-pb-text-input ays-pb-text-input-short"  value="<?php echo $scroll_top_mobile ?>">
                                                <div style="text-align: center;">
                                                    <span class="ays_pb_current_device_name <?php echo $enable_scroll_top_mobile ? 'show' : '' ?>"><?php echo esc_html__('Mobile', "ays-popup-box") ?></span>
                                                </div>
                                            </div>
                                            <div class="ays_dropdown_max_width">
                                                <input type="text" value="px" class="ays-form-hint-for-size" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ays-pb-youtube-video-link">
                                        <div class="ays-pb-small-hint-text">
                                            <a href="https://www.youtube.com/watch?v=7Hh3jp0hMgM&list=PL4ufu1uAjjWQTYn0O_72TLzmqgmVIYKI2" target="_blank">
                                                <?php echo esc_html__('How to Create a Login Form Popup', "ays-popup-box")?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ays_pb_mobile_settings_container">
                                        <input type="checkbox" class="ays_pb_different_settings_for_mobile" id="ays_pb_enable_scroll_top_mobile" name="ays_pb_enable_scroll_top_mobile" <?php echo $enable_scroll_top_mobile ? 'checked' : '' ?>>
                                        <label for="ays_pb_enable_scroll_top_mobile" class="<?php echo $enable_scroll_top_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Scroll from top end -->
                        <hr>
                    </div>
                </div>
                <div class="ays-pb-accordion-options-main-container">
                    <div class="ays-pb-accordion-header">
                        <?php echo wp_kses($pb_acordion_svg_html, $allow_tags_acordion_arrow); ?>
                        <p class="ays-subtitle"><?php echo  esc_html__('Popup Closing', "ays-popup-box") ?></p>
                    </div>
                    <hr class="ays-pb-bolder-hr"/>
                    <div class="ays-pb-accordion-body">
                        <!-- close overlay by esc key start -->
                        <div class="form-group row ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                            <div class="col-sm-3">
                                <label for="ays_close_popup_esc">
                                    <span><?php echo esc_html__('Close by pressing ESC', "ays-popup-box"); ?></span>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("If the option is enabled, the user can close the popup by pressing the ESC button from the keyboard.", "ays-popup-box"); ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <p class="onoffswitch">
                                    <input type="checkbox" name="close_popup_esc" class="ays-pb-onoffswitch-checkbox" id="ays_close_popup_esc" <?php echo $close_popup_esc == 'off' ? '' : 'checked'; ?>/>
                                </p>
                            </div>
                        </div>
                        <!-- close overlay by esc key end -->
                        <hr class="ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                        <!-- Close by clicking outside the box starts -->
                        <div class="form-group row ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                            <div class="col-sm-3">
                                <label for="ays_close_popup_overlay" style="margin-bottom:0px;">
                                    <span><?php echo esc_html__('Close by clicking outside the box', "ays-popup-box"); ?></span>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("If the option is enabled, the user can close the popup by clicking outside the box.  Notice: This option works only if the “Enable Overlay”option is ticked.", "ays-popup-box"); ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="ays_pb_pc_and_mobile_container ays_pb_pc_and_mobile_container_cb">
                                    <div class="ays_pb_option_for_desktop">
                                        <span class="ays_pb_current_device_name" style="<?php echo ($close_popup_overlay_mobile || $close_popup_overlay != 'off') ? 'display: block' : '' ?>"><?php echo esc_html__('Desktop', "ays-popup-box") ?></span>
                                        <p class="onoffswitch" style="margin:0;">
                                            <input type="checkbox" name="close_popup_overlay" class="ays-pb-onoffswitch-checkbox" id="ays_close_popup_overlay" <?php echo $close_popup_overlay == 'off' ? '' : 'checked'; ?>/>
                                        </p>
                                    </div>
                                    <div class="ays_pb_option_for_mobile_device ays_pb_option_for_mobile_device_cb ays_divider_left <?php echo ($close_popup_overlay_mobile || $close_popup_overlay != 'off') ? 'show' : '' ?>">
                                        <span class="ays_pb_current_device_name" style="<?php echo ($close_popup_overlay_mobile || $close_popup_overlay != 'off') ? 'display: block' : '' ?>"><?php echo esc_html__('Mobile', "ays-popup-box") ?></span>
                                        <p class="onoffswitch" style="margin:0;">
                                            <input type="checkbox" name="close_popup_overlay_mobile" class="ays-pb-onoffswitch-checkbox" id="ays_close_popup_overlay_mobile" <?php echo $close_popup_overlay_mobile ? 'checked' : ''; ?>/>
                                        </p>
                                    </div>
                                </div>
                                <div class="ays-pb-youtube-video-link">
                                    <div class="ays-pb-small-hint-text">
                                        <a href="https://youtu.be/iOP7rxNoc9E?list=PL4ufu1uAjjWQTYn0O_72TLzmqgmVIYKI2" target="_blank">
                                            <?php echo esc_html__('How to close Popup by clicking outside the box', "ays-popup-box")?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Close by clicking outside the box end -->
                        <hr class="ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">   
                        <!-- close popup by scroll start-->
                        <div class="col-sm-12 ays-pro-features-v2-main-box ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                            <div class="ays-pro-features-v2-small-buttons-box">
                                <div>
                                    <a href="https://youtu.be/6TVU_KYDE8Q" target="_blank" class="ays-pro-features-v2-video-button">
                                        <div>
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/pro-features-icons/Video_24x24.svg" ?>">
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/pro-features-icons/Video_24x24_Hover.svg" ?>" class="ays-pb-new-video-button-hover">
                                        </div>
                                        <div class="ays-pro-features-v2-video-text">
                                            <?php echo esc_html__("Watch video" , "ays-popup-box"); ?>
                                        </div>
                                    </a>
                                </div>
                                <a href="https://popup-plugin.com/" target="_blank" class="ays-pro-features-v2-upgrade-button">
                                    <div class="ays-pro-features-v2-upgrade-icon" style="background-image: url('<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg');" data-img-src="<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg"></div>
                                    <div class="ays-pro-features-v2-upgrade-text">
                                        <?php echo esc_html__("Upgrade" , "ays-popup-box"); ?>
                                    </div>
                                </a>
                            </div>
                            <div class="form-group row ays-pb-pro-feature-row" style="margin-bottom:0;">
                                <div class="col-sm-3">
                                    <label for="ays_close_popup_scroll" style="line-height: 50px;">
                                        <span><?php echo esc_html__('Close the popup on scroll', "ays-popup-box"); ?></span>
                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Define the scroll length by pixels to close the popup when scrolling.", "ays-popup-box"); ?>">
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                        </a>
                                    </label>
                                </div>
                                <div class="col-sm-9" style="padding:10px 0;">
                                        <input type="text" name="close_popup_scroll" class="ays-pb-onoffswitch-checkbox" id="ays_close_popup_scroll" value=""/>
                                </div>
                            </div>
                        </div>
                        <!-- close popup by scroll end-->
                        <hr class="ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                        <!-- close popup by clicking submit btn by classname start -->
                        <div class="col-sm-12 ays-pro-features-v2-main-box ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                            <div class="ays-pro-features-v2-small-buttons-box">
                                <div>
                                    <a href="https://www.youtube.com/watch?v=z6TfjOR2CVM" target="_blank" class="ays-pro-features-v2-video-button">
                                        <div>
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/pro-features-icons/Video_24x24.svg" ?>">
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/pro-features-icons/Video_24x24_Hover.svg" ?>" class="ays-pb-new-video-button-hover">
                                        </div>
                                        <div class="ays-pro-features-v2-video-text">
                                            <?php echo esc_html__("Watch video" , "ays-popup-box"); ?>
                                        </div>
                                    </a>
                                </div>
                                <a href="https://popup-plugin.com/" target="_blank" class="ays-pro-features-v2-upgrade-button">
                                    <div class="ays-pro-features-v2-upgrade-icon" style="background-image: url('<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg');" data-img-src="<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg"></div>
                                    <div class="ays-pro-features-v2-upgrade-text">
                                        <?php echo esc_html__("Upgrade" , "ays-popup-box"); ?>
                                    </div>
                                </a>
                            </div>
                            <div class="form-group row ays_toggle_parent" style="padding: 10px 0; margin:0;">
                                <div class="col-sm-3">
                                    <label for="ays_close_popup_by_classname">
                                        <?php echo esc_html__('Close by classname (onclick)', "ays-popup-box")?>
                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Copy the given classname, assign it to any tag in the content as well as inside the popup. And the popup will close when the user clicks on the classname.Note: Save your popup before copying the given classname.',"ays-popup-box")?>">
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                        </a>
                                    </label>
                                </div>
                                <div class="col-sm-1">
                                    <input type="checkbox" name="ays_enable_close_by_classname" class="ays-pb-onoffswitch-checkbox ays-enable-timer1 ays_toggle_checkbox" id="ays_close_popup_by_classname" checked/>
                                </div>
                                <div class="col-sm-8 ays_toggle_target ays_divider_left">
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <input type="text" name="ays_pb_close_by_classname_".$id id="ays_pb_close_by_classname" class="ays-enable-timerl ays-text-input" value="<?php echo "ays_pb_close_by_classname_".$id ;?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- close popup by clicking submit btn by classname end -->
                        <hr class="ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                        <!-- Hide close button start -->
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="<?php echo esc_attr($this->plugin_name); ?>-close-button">
                                    <span> <?php echo esc_html__('Hide close button', "ays-popup-box"); ?></span>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("If the option is enabled, the close button of the popup will be disappeared. ", "ays-popup-box"); ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <input type="checkbox" id="<?php echo esc_attr($this->plugin_name); ?>-close-button"  name="<?php echo esc_attr($this->plugin_name); ?>[close_button]" class="ays-pb-onoffswitch-checkbox" <?php echo $close_button == 'on' ? 'checked' : ''; ?> />
                            </div>
                        </div>
                        <!-- Hide close button end -->
                        <hr class="ays_pb_close_bttn_option <?php echo $close_button == 'on' ? 'display_none' : ''; ?>">
                        <!-- Show close button by hovering over the popup start -->
                        <div class="form-group row ays_pb_close_bttn_option <?php echo $close_button == 'on' ? 'display_none' : ''; ?>" id="ays_pb_close_hover">
                            <div class="col-sm-3">
                                <label for="ays_pb_show_close_btn_hover_container">
                                    <span> <?php echo esc_html__('Activate Close button while hovering on popup', "ays-popup-box"); ?></span>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Enable this option to close the popup by hovering over the popup container.", "ays-popup-box"); ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <input type="checkbox" id="ays_pb_show_close_btn_hover_container"  name="ays_pb_show_close_btn_hover_container" class="ays-pb-onoffswitch-checkbox" <?php echo $ays_pb_hover_show_close_btn ? "checked" : ''; ?> value='on' />
                            </div>
                        </div>
                        <!-- Show close button by hovering over the popup end -->
                        <hr class="ays_pb_close_bttn_option <?php echo $close_button == 'on' ? 'display_none' : ''; ?>">
                        <!-- Close button position start -->
                        <div class="form-group row ays-pb-close-button-position-z-index ays_pb_close_bttn_option <?php echo $close_button == 'on' ? 'display_none' : ''; ?>">
                            <div class="col-sm-3">
                                <label for="ays-pb-close-button-position">
                                    <span> <?php echo esc_html__('Close button position', "ays-popup-box"); ?></span>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Select the place of the popup close button. ", "ays-popup-box"); ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9 ays_pb_pc_and_mobile_container">
                                <div>
                                    <div class="ays_pb_pc_and_mobile_box ays_pb_pc_and_mobile_box_input">
                                        <!-- Close button position desktop Start -->
                                        <div>
                                            <div style="text-align: center;">
                                                <span class="ays_pb_current_device_name <?php echo $enable_close_button_position_mobile ? 'show' : '' ?>"><?php echo esc_html__('Desktop', "ays-popup-box") ?></span>
                                            </div>
                                            <select id="ays-pb-close-button-position" name="ays_pb_close_button_position" class="ays-pb-text-input ays-pb-text-input-short ays_pb_aysDropdown">
                                                <option <?php echo ($close_button_position == 'right-top') ? 'selected' : ''; ?> value="right-top"><?php echo esc_html__('Right Top', "ays-popup-box"); ?></option>
                                                <option <?php echo ($close_button_position == 'left-top') ? 'selected' : ''; ?> value="left-top"><?php echo esc_html__('Left Top', "ays-popup-box"); ?></option>
                                                <option <?php echo ($close_button_position == 'left-bottom') ? 'selected' : ''; ?> value="left-bottom"><?php echo esc_html__('Left Bottom', "ays-popup-box"); ?></option>
                                                <option <?php echo $close_button_position == 'right-bottom' ? 'selected' : ''; ?> value="right-bottom"><?php echo esc_html__('Right Bottom', "ays-popup-box"); ?></option>
                                            </select>
                                        </div>
                                        <!-- Close button position desktop End -->
                                        <!-- Close button position Mobile Start -->
                                        <div class="ays_pb_option_for_mobile_device ays_divider_left <?php echo $enable_close_button_position_mobile ? 'show' : '' ?>">
                                            <div style="text-align: center;">
                                                <span class="ays_pb_current_device_name <?php echo $enable_close_button_position_mobile ? 'show' : '' ?>"><?php echo esc_html__('Mobile', "ays-popup-box") ?></span>
                                            </div>
                                            <select id="ays-pb-close-button-position-mobile" name="ays_pb_close_button_position_mobile" class="ays-pb-text-input ays-pb-text-input-short ays_pb_aysDropdown">
                                                <option <?php echo ($close_button_position_mobile == 'right-top') ? 'selected' : ''; ?> value="right-top"><?php echo esc_html__('Right Top', "ays-popup-box"); ?></option>
                                                <option <?php echo ($close_button_position_mobile == 'left-top') ? 'selected' : ''; ?> value="left-top"><?php echo esc_html__('Left Top', "ays-popup-box"); ?></option>
                                                <option <?php echo ($close_button_position_mobile == 'left-bottom') ? 'selected' : ''; ?> value="left-bottom"><?php echo esc_html__('Left Bottom', "ays-popup-box"); ?></option>
                                                <option <?php echo ($close_button_position_mobile == 'right-bottom') ? 'selected' : ''; ?> value="right-bottom"><?php echo esc_html__('Right Bottom', "ays-popup-box"); ?></option>
                                            </select>
                                        </div>
                                        <!-- Close button position Mobile Start -->
                                    </div>
                                    <div class="ays_pb_mobile_settings_container">
                                        <input type="checkbox" class="ays_pb_different_settings_for_mobile" id="ays_pb_enable_close_button_position_mobile" name="ays_pb_enable_close_button_position_mobile" <?php echo $enable_close_button_position_mobile ? 'checked' : '' ?>>
                                        <label for="ays_pb_enable_close_button_position_mobile" class="<?php echo $enable_close_button_position_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Close button position end -->
                        <hr class="ays_pb_close_bttn_option <?php echo $close_button == 'on' ? 'display_none' : ''; ?>">
                        <!-- Close button text start -->
                        <div class="form-group row ays_pb_close_bttn_option <?php echo $close_button == 'on' ? 'display_none' : ''; ?>">
                            <div class="col-sm-3">
                                <label for="ays-pb-close-button-text">
                                    <span><?php echo esc_html__('Close button text', "ays-popup-box"); ?></span>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Define the close button text. The default value is “✕”.", "ays-popup-box"); ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9 ays_pb_pc_and_mobile_container">
                                <div>
                                    <div class="ays_pb_pc_and_mobile_box ays_pb_pc_and_mobile_box_input">
                                        <!-- Close button text desktop Start-->
                                        <div>
                                            <div style="text-align: center;">
                                                <span class="ays_pb_current_device_name <?php echo $enable_close_button_text_mobile ? 'show' : '' ?>"><?php echo esc_html__('Desktop', "ays-popup-box") ?></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <input type="text" id="ays-pb-close-button-text" name="ays_pb_close_button_text" class="ays-pb-text-input ays-pb-text-input-short" value="<?php echo $close_button_text; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Close button text desktop End-->
                                        <!-- Close button text Mobile Start-->
                                        <div class="ays_pb_option_for_mobile_device ays_divider_left <?php echo $enable_close_button_text_mobile ? 'show' : '' ?>">
                                            <div style="text-align: center;">
                                                <span class="ays_pb_current_device_name <?php echo $enable_close_button_text_mobile ? 'show' : '' ?>"><?php echo esc_html__('Mobile', "ays-popup-box") ?></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <input type="text" id="ays-pb-close-button-text-mobile" name="ays_pb_close_button_text_mobile" class="ays-pb-text-input ays-pb-text-input-short" value="<?php echo $close_button_text_mobile; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Close button text Mobile End-->
                                    </div>
                                    <div class="ays_pb_mobile_settings_container">
                                        <input type="checkbox" class="ays_pb_different_settings_for_mobile" id="ays_pb_enable_close_button_text_mobile" name="ays_pb_enable_close_button_text_mobile" <?php echo $enable_close_button_text_mobile ? 'checked' : '' ?>>
                                        <label for="ays_pb_enable_close_button_text_mobile" class="<?php echo $enable_close_button_text_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Close button text end -->
                        <hr class="ays_pb_close_bttn_option <?php echo $close_button == 'on' ? 'display_none' : ''; ?>">
                        <!-- Close button hover text start -->
                        <div class="form-group row ays_pb_close_bttn_option <?php echo $close_button == 'on' ? 'display_none' : ''; ?>">
                            <div class="col-sm-3">
                                <label for="ays-pb-close-button-hover-text">
                                    <span><?php echo esc_html__('Close button hover text', "ays-popup-box"); ?></span>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Displays text when cursor is placed over the close button", "ays-popup-box"); ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <input type="text" id="ays-pb-close-button-hover-text" name="ays_pb_close_button_hover_text" class="ays-pb-text-input ays-pb-text-input-short" value="<?php echo $close_button_hover_text; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Close button hover text end -->
                        <hr class="ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                        <!-- Autoclose Delay (in seconds) start -->
                        <div class="form-group row ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>" id="ays_pb_close_autoclose">
                            <div class="col-sm-3">
                                <label for="<?php echo esc_attr($this->plugin_name); ?>-autoclose">
                                    <span><?php echo esc_html__('Autoclose Delay (in seconds)', "ays-popup-box"); ?></span>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Close the popup after a specified time delay (in seconds). To disable the option leave it blank or set it to 0.", "ays-popup-box"); ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9 ays_pb_pc_and_mobile_container">
                                <div>
                                    <div class="ays_pb_pc_and_mobile_box ays_pb_pc_and_mobile_box_input">
                                        <!-- Autoclose Delay desktop Start-->
                                        <div>
                                            <div style="text-align: center;">
                                                <span class="ays_pb_current_device_name <?php echo $enable_autoclose_delay_text_mobile ? 'show' : '' ?>"><?php echo esc_html__('Desktop', "ays-popup-box") ?></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="number" id="<?php echo esc_attr($this->plugin_name); ?>-autoclose" name="<?php echo esc_attr($this->plugin_name); ?>[autoclose]" class="ays-pb-text-input ays-pb-text-input-short" value="<?php echo $autoclose; ?>" />
                                                    <span style="display:block;" class="ays-pb-small-hint-text">Set 0 for disabling</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Autoclose Delay desktop End-->
                                        <!-- Autoclose Delay Start-->
                                        <div class="ays_pb_option_for_mobile_device ays_divider_left <?php echo $enable_autoclose_delay_text_mobile ? 'show' : '' ?>">
                                            <div style="text-align: center;">
                                                <span class="ays_pb_current_device_name <?php echo $enable_autoclose_delay_text_mobile ? 'show' : '' ?>"><?php echo esc_html__('Mobile', "ays-popup-box") ?></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="number" id="<?php echo esc_attr($this->plugin_name); ?>-autoclose-mobile" name="ays_pb_autoclose_mobile" class="ays-pb-text-input ays-pb-text-input-short" value="<?php echo $ays_pb_autoclose_mobile; ?>" />                                            
                                                    <span style="display:block;" class="ays-pb-small-hint-text">Set 0 for disabling</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Autoclose Delay Mobile End-->
                                    </div>
                                    <div class="ays_pb_mobile_settings_container">
                                        <input type="checkbox" class="ays_pb_different_settings_for_mobile <?php echo esc_attr($this->plugin_name); ?>-autoclose-mobile-toggle" id="ays_pb_enable_autoclose_delay_text_mobile" name="ays_pb_enable_autoclose_delay_text_mobile" <?php echo $enable_autoclose_delay_text_mobile ? 'checked' : '' ?>>
                                        <label for="ays_pb_enable_autoclose_delay_text_mobile" class="<?php echo $enable_autoclose_delay_text_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <!-- Autoclose Delay (in seconds) end -->
                        <hr class="ays-pb-hide-timer-hr ays_pb_hide_for_notification_type <?php echo $ays_pb_show_hide_timer_box && $modal_content != 'notification_type' ? '' : 'display_none'; ?>">
                        <!-- hide timer -->
                        <div class="form-group row ays_pb_hide_for_notification_type <?php echo $ays_pb_show_hide_timer_box && $modal_content != 'notification_type' ? '' : 'display_none'; ?>" id="ays_pb_hide_timer_popup">
                            <div class="col-sm-3">
                                <label for="ays_pb_hide_timer">
                                    <?php echo esc_html__('Hide timer', "ays-popup-box"); ?>
                                    <a class="ays_help" data-toggle="tooltip"
                                       title="<?php echo esc_html__('Hide the timer when the Autoclose Delay option is enabled.', "ays-popup-box") ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9 ays_pb_pc_and_mobile_container">
                                <div class="ays_pb_pc_and_mobile_container ays_pb_pc_and_mobile_container_cb">
                                    <div class="ays_pb_option_for_desktop">
                                        <span class="ays_pb_current_device_name" style="<?php echo ($ays_pb_hide_timer == 'on' || $ays_pb_hide_timer_mobile == 'on') ? 'display: block' : '' ?>"><?php echo esc_html__('Desktop', "ays-popup-box") ?></span>
                                        <p class="onoffswitch">
                                            <input id="ays_pb_hide_timer" type="checkbox" class="ays_pb_hide_timer ays-pb-onoffswitch-checkbox" name="ays_pb_hide_timer" <?php echo ($ays_pb_hide_timer == 'on' )? 'checked' : '' ?> value="on"/>
                                        </p>
                                    </div>
                                    <div class="ays_pb_option_for_mobile_device ays_pb_option_for_mobile_device_cb ays_divider_left <?php echo ($ays_pb_hide_timer == 'on' || $ays_pb_hide_timer_mobile == 'on') ? 'show' : '' ?>">
                                        <span class="ays_pb_current_device_name" style="<?php echo ($ays_pb_hide_timer == 'on' || $ays_pb_hide_timer_mobile == 'on') ? 'display: block' : '' ?>"><?php echo esc_html__('Mobile', "ays-popup-box") ?></span>
                                        <p class="onoffswitch" style="margin:0;">
                                            <input type="checkbox" name="ays_pb_hide_timer_mobile" class="ays-pb-onoffswitch-checkbox" id="ays_pb_hide_timer_mobile" <?php if($ays_pb_hide_timer_mobile == 'on'){ echo 'checked';} ?>/>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- hide timer -->
                        <hr class="ays_video_type_hr <?php echo ($view_type == 'video') ? '' : 'display_none'; ?>">
                        <!-- Autoclose on video completion -->
                        <div class="form-group row ays_pb_autoclose_on_completion_container <?php echo ($view_type == 'video') ? '' : 'display_none'; ?>">
                            <div class="col-sm-3">
                                <label for="ays_pb_autoclose_on_completion">
                                    <?php echo esc_html__('Autoclose on video completion', "ays-popup-box"); ?>
                                    <a class="ays_help" data-toggle="tooltip"
                                       title="<?php echo esc_html__('Automatically close the popup after a video completion.', "ays-popup-box") ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <input id="ays_pb_autoclose_on_completion" type="checkbox" name="ays_pb_autoclose_on_completion" <?php echo ($ays_pb_autoclose_on_completion == 'on' )? 'checked' : '' ?> value="on"/>
                            </div>
                        </div>
                        <!-- Autoclose on video completion -->
                        <hr class="ays_pb_close_bttn_option <?php echo $close_button == 'on' ? 'display_none' : ''; ?>">
                        <div class="form-group row ays_pb_close_bttn_option <?php echo $close_button == 'on' ? 'display_none' : ''; ?>">
                            <div class="col-sm-3">
                                <label for="<?php echo esc_attr($this->plugin_name); ?>-close_button_delay">
                                    <span><?php echo esc_html__('Close button delay', "ays-popup-box"); ?></span>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__(" Set delay in milliseconds for displaying the popup close button. To disable the option leave it blank or set it to 0.", "ays-popup-box"); ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9 ays_divider_left ays_pb_pc_and_mobile_container">
                                
                                <div>
                                    <div class="ays_pb_pc_and_mobile_box ays_pb_pc_and_mobile_box_input">
                                        <!-- Close button delay desktop Start-->
                                        <div>
                                            <div style="text-align: center;">
                                                <span class="ays_pb_current_device_name <?php echo $enable_close_button_delay_for_mobile ? 'show' : '' ?>"><?php echo esc_html__('Desktop', "ays-popup-box") ?></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 ays_popup_display_flex_width">
                                                    <div>
                                                        <input type="number" id="<?php echo esc_attr($this->plugin_name); ?>-close_button_delay" name="ays_pb_close_button_delay"  class="ays-pb-text-input ays-pb-text-input-short"  value="<?php echo $close_button_delay; ?>" />
                                                        <span style="display:block;" class="ays-pb-small-hint-text"><?php echo esc_html__( '1 sec = 1000 ms', "ays-popup-box" ); ?></span>
                                                    </div>
                                                    <div class="ays_dropdown_max_width">
                                                        <input type="text" value="ms" class="ays-form-hint-for-size" disabled="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Close button delay desktop End-->
                                        <!-- Close button delay Mobile Start-->
                                        <div class="ays_pb_option_for_mobile_device ays_divider_left <?php echo $enable_close_button_delay_for_mobile ? 'show' : '' ?>">
                                            <div style="text-align: center;">
                                                <span class="ays_pb_current_device_name <?php echo $enable_close_button_delay_for_mobile ? 'show' : '' ?>"><?php echo esc_html__('Mobile', "ays-popup-box") ?></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 ays_popup_display_flex_width">
                                                    <div>
                                                        <input type="number" id="<?php echo esc_attr($this->plugin_name); ?>-close_button_delay_for_mobile" name="ays_pb_close_button_delay_for_mobile"  class="ays-pb-text-input ays-pb-text-input-short"  value="<?php echo $close_button_delay_for_mobile; ?>" />
                                                        <span style="display:block;" class="ays-pb-small-hint-text"><?php echo esc_html__( '1 sec = 1000 ms', "ays-popup-box" ); ?></span>
                                                    </div>
                                                    <div class="ays_dropdown_max_width">
                                                        <input type="text" value="ms" class="ays-form-hint-for-size" disabled="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Close button delay Mobile End-->
                                    </div>
                                    <div class="ays_pb_mobile_settings_container">
                                        <input type="checkbox" class="ays_pb_different_settings_for_mobile" id="ays_pb_enable_close_button_delay_for_mobile" name="ays_pb_enable_close_button_delay_for_mobile" <?php echo $enable_close_button_delay_for_mobile ? 'checked' : '' ?>>
                                        <label for="ays_pb_enable_close_button_delay_for_mobile" class="<?php echo $enable_close_button_delay_for_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="ays-pb-accordion-options-main-container">
                    <div class="ays-pb-accordion-header">
                        <?php echo wp_kses($pb_acordion_svg_html, $allow_tags_acordion_arrow); ?>
                        <p class="ays-subtitle"><?php echo  esc_html__('Advanced Settings', "ays-popup-box") ?></p>
                    </div>
                    <hr class="ays-pb-bolder-hr"/>
                    <div class="ays-pb-accordion-body">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="ays_pb_popup_name">
                                    <?php echo esc_html__('Popup name', "ays-popup-box"); ?>
                                    <a class="ays_help ays-pb-help-pro" data-toggle="tooltip" title="<?php echo esc_html__('Write the name of the particular Popup. The name will be shown in the Popup list table.',"ays-popup-box");?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="ays_pb_popup_name" name="ays_pb_popup_name" class="ays-text-input ays-pb-popup-name" value="<?php echo $popup_name; ?>">
                            </div>
                        </div> <!-- Popup Name -->
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="ays-category">
                                    <?php echo esc_html__('Popup category', "ays-popup-box"); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Categorize your popup selecting from the premade categories.',"ays-popup-box")?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <select id="ays-category" name="ays_popup_category" class="ays_pb_aysDropdown"> 
                                    <?php
                                    $cat = 0;
                                    foreach ($popup_categories as $popup_category) {
    
                                        $checked = (intval($popup_category['id']) == $category_id ) ? "selected" : "";
                                        if ($cat == 0 && $category_id == 0) {
                                            $checked = 'selected';
                                        }
                                        echo "<option value='" . $popup_category['id'] . "' " . $checked . ">" . stripslashes($popup_category['title']) . "</option>";
                                        $cat++;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <hr class="ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                        <div class="form-group row ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                            <div class="col-sm-3">
                                <label for="<?php echo esc_attr($this->plugin_name); ?>-onoffoverlay">
                                    <span><?php echo esc_html__('Enable Overlay', "ays-popup-box"); ?></span>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Enable to show the overlay outside the popup.", "ays-popup-box"); ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9 ays_toggle_parent">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <p class="onoffswitch">
                                            <input type="checkbox" name="<?php echo esc_attr($this->plugin_name); ?>[onoffoverlay]" class="ays-pb-onoffswitch-checkbox ays_toggle_checkbox" id="<?php echo esc_attr($this->plugin_name); ?>-onoffoverlay" <?php if($onoffoverlay == 'On'){ echo 'checked';} else { echo '';} ?> >
                                        </p>
                                    </div>
                                    <div class="col-sm-8 ays_toggle_target ays_divider_left opacity_box ays_pb_pc_and_mobile_container" style=" <?php echo ( $onoffoverlay == 'On' ) ? '' : 'display:none'; ?>">
                                        <div style="width: 100%;">
                                            <div class="ays_pb_pc_and_mobile_box ays_pb_pc_and_mobile_box_input">
                                                <!-- Overlay Mobile desktop Start-->
                                                <div class="col-sm-8 col-md-6 p-0">
                                                    <div style="text-align: center;">
                                                        <span class="ays_pb_current_device_name <?php echo $enable_autoclose_delay_text_mobile ? 'show' : '' ?>"><?php echo esc_html__('Desktop', "ays-popup-box") ?></span>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-5 col-md-4">
                                                            <label for="ays-overlay-opacity" class="form-check-label">
                                                                <?php echo esc_html__('Opacity:',"ays-popup-box")?>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-7 col-md-8">
                                                            <input type="number" name="<?php echo esc_attr($this->plugin_name); ?>[overlay_opacity]" id="ays-overlay-opacity" class="ays-text-input" value=<?php echo round($overlay_opacity, 1) ?> min="0" max="1" step="0.1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Overlay Mobile desktop End-->
                                                <!-- Overlay Mobile Start-->
                                                <div class="col-sm-8 col-md-6 ays_pb_option_for_mobile_device ays_divider_left <?php echo $enable_overlay_text_mobile ? 'show' : '' ?>">
                                                    <div style="text-align: center;">
                                                        <span class="ays_pb_current_device_name <?php echo $enable_overlay_text_mobile ? 'show' : '' ?>"><?php echo esc_html__('Mobile', "ays-popup-box") ?></span>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-5 col-md-4">
                                                            <label for="ays-overlay-opacity" class="form-check-label">
                                                                <?php echo esc_html__('Opacity:',"ays-popup-box")?>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-7 col-md-8">
                                                            <input type="number" name="ays_pb_overlay_mobile_opacity" id="ays-overlay-opacity" class="ays-text-input" value=<?php echo round($ays_pb_overlay_mobile_opacity, 1) ?> min="0" max="1" step="0.1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Overlay Mobile End-->
                                            </div>
                                            <div class="ays_pb_mobile_settings_container">
                                                <input type="checkbox" class="ays_pb_different_settings_for_mobile" id="ays_pb_enable_overlay_text_mobile" name="ays_pb_enable_overlay_text_mobile" <?php echo $enable_overlay_text_mobile ? 'checked' : '' ?>>
                                                <label for="ays_pb_enable_overlay_text_mobile" class="<?php echo $enable_overlay_text_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="ays_pb_hide_for_notification_type <?php echo ($onoffoverlay == 'On' && $modal_content != 'notification_type') ? '' : 'display_none'; ?>">
                        <!-- Enable blured overlay start -->
                        <div class="form-group row ays-pb-blured-overlay ays_pb_hide_for_notification_type <?php echo ($onoffoverlay == 'On' && $modal_content != 'notification_type') ? '' : 'display_none'; ?>">
                            <div class="col-sm-3">
                                <label for="ays_pb_blured_overlay">
                                    <span><?php echo esc_html__('Enable blured overlay', "ays-popup-box"); ?></span>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Enable blurred overlay of the popup.", "ays-popup-box"); ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="ays_pb_pc_and_mobile_container ays_pb_pc_and_mobile_container_cb">
                                    <div class="ays_pb_option_for_desktop">
                                        <span class="ays_pb_current_device_name" style="<?php echo ($blured_overlay_mobile || $blured_overlay) ? 'display: block' : '' ?>"><?php echo esc_html__('Desktop', "ays-popup-box") ?></span>
                                        <p class="onoffswitch">
                                            <input type="checkbox" name="ays_pb_blured_overlay" class="ays-pb-onoffswitch-checkbox" id="ays_pb_blured_overlay" <?php echo $blured_overlay ? 'checked' : '' ?> >
                                        </p>
                                    </div>
                                    <div class="ays_pb_option_for_mobile_device ays_pb_option_for_mobile_device_cb ays_divider_left <?php echo ($blured_overlay_mobile || $blured_overlay) ? 'show' : '' ?>">
                                        <span class="ays_pb_current_device_name" style="<?php echo ($blured_overlay_mobile || $blured_overlay) ? 'display: block' : '' ?>"><?php echo esc_html__('Mobile', "ays-popup-box") ?></span>
                                        <p class="onoffswitch" style="margin:0;">
                                            <input type="checkbox" name="ays_pb_blured_overlay_mobile" class="ays-pb-onoffswitch-checkbox" id="ays_pb_blured_overlay_mobile" <?php if($blured_overlay_mobile){ echo 'checked';} ?>/>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Enable blured overlay end -->
                        <hr class="ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                        <!-- Enable popup sound start -->
                        <div class="form-group row ays_toggle_parent ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                            <div class="col-sm-3" style="padding-right: 0px;">
                                <label for="ays_enable_pb_sound">
                                    <?php echo esc_html__('Enable popup sound',"ays-popup-box")?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('In case of enabling this option, insert and select the sound from the General Settings of Popup Box navigation menu. Note: This function only works with “On Click” or “Both” trigger types.',"ays-popup-box")?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-1">
                                <input type="checkbox" id="ays_enable_pb_sound"
                                        name="ays_pb_enable_sounds" class="ays_toggle_checkbox"
                                        value="on" <?php echo $enable_pb_sound ? 'checked' : ''; ?>/>
                            </div>
                            <div class="col-sm-7 ays_toggle_target ays_divider_left" style="<?php echo $enable_pb_sound ? '' : 'display:none;' ?>">
                                <?php if($ays_pb_sound): ?>
                                <blockquote class=""><?php echo esc_html__('Sounds are selected. For change sounds go to', "ays-popup-box"); ?> <a href="?page=ays-pb-settings" target="_blank"><?php echo esc_html__('General Settings', "ays-popup-box"); ?></a> <?php echo esc_html__('page', "ays-popup-box"); ?></blockquote>
                                <?php else: ?>
                                <blockquote class=""><?php echo esc_html__('Sounds are not selected. For selecting sounds go to', "ays-popup-box"); ?> <a href="?page=ays-pb-settings" target="_blank"><?php echo esc_html__('General Settings', "ays-popup-box"); ?></a> <?php echo esc_html__('page', "ays-popup-box"); ?></blockquote>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- Enable popup sound end -->
                        <hr class="ays_pb_hide_for_image_type ays_pb_hide_for_facebook_type ays_pb_hide_for_notification_type <?php echo ($modal_content == 'image_type' || $modal_content == 'facebook_type' || $modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                        <!-- Enable Social Media links start-->
                        <div class="form-group row ays_toggle_parent ays_pb_hide_for_image_type ays_pb_hide_for_facebook_type ays_pb_hide_for_notification_type <?php echo ($modal_content == 'image_type' || $modal_content == 'facebook_type' || $modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                            <div class="col-sm-3">
                                <label for="ays_pb_enable_social_links">
                                    <?php echo esc_html__('Enable Social Media links',"ays-popup-box")?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Display social media links at the bottom of your popup container.',"ays-popup-box")?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-3">
                                <input type="checkbox" class="ays-enable-timer1 ays_toggle_checkbox" id="ays_pb_enable_social_links"
                                    name="ays_pb_enable_social_links"
                                    value="on" <?php echo $enable_social_links ? 'checked' : '' ?>/>
                            </div>
                            <div class="col-sm-6 ays_toggle_target ays_divider_left <?php echo $enable_social_links ? '' : 'display_none' ?>">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label>
                                            <?php echo esc_html__('Heading for share buttons',"ays-popup-box")?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Text that will be displayed over share buttons.',"ays-popup-box"); ?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <?php
                                            $content = $social_buttons_heading;
                                            $editor_id = 'ays_pb_social_buttons_heading';
                                            $settings = array('editor_height' => $pb_wp_editor_height, 'textarea_name' => 'ays_pb_social_buttons_heading', 'editor_class' => 'ays-textarea', 'media_elements' => false);
                                            wp_editor($content, $editor_id, $settings);
                                        ?>
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_linkedin_link">
                                            <?php echo esc_html__('LinkedIn link',"ays-popup-box")?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('LinkedIn profile or page link for showing at the end of the popup.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="ays-text-input" id="ays_pb_linkedin_link" name="ays_social_links[ays_pb_linkedin_link]"
                                            value="<?php echo $linkedin_link; ?>" />
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_facebook_link">
                                            <?php echo esc_html__('Facebook link',"ays-popup-box")?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Facebook profile or page link for showing at the end of the popup.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="ays-text-input" id="ays_pb_facebook_link" name="ays_social_links[ays_pb_facebook_link]"
                                            value="<?php echo $facebook_link; ?>" />
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_twitter_link">
                                            <?php echo esc_html__('X link',"ays-popup-box")?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('X profile or page link for showing at the end of the popup.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="ays-text-input" id="ays_pb_twitter_link" name="ays_social_links[ays_pb_twitter_link]"
                                            value="<?php echo $twitter_link; ?>" />
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_vkontakte_link">
                                            <?php echo esc_html__('VKontakte link',"ays-popup-box")?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('VKontakte profile or page link for showing at the end of the popup.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="ays-text-input" id="ays_pb_vkontakte_link" name="ays_social_links[ays_pb_vkontakte_link]"
                                            value="<?php echo $vkontakte_link; ?>" />
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_youtube_link">
                                            <?php echo esc_html__('Youtube link',"ays-popup-box")?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('YouTube page link for showing at the end of the popup.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="ays-text-input" id="ays_pb_youtube_link" name="ays_social_links[ays_pb_youtube_link]"
                                            value="<?php echo $youtube_link; ?>" />
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_instagram_link">
                                            <?php echo esc_html__('Instagram link',"ays-popup-box")?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Instagram page link for showing at the end of the popup.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="ays-text-input" id="ays_pb_instagram_link" name="ays_social_links[ays_pb_instagram_link]"
                                            value="<?php echo $instagram_link; ?>" />
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_behance_link">
                                            <?php echo esc_html__('Behance link',"ays-popup-box")?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Behance page link for showing at the end of the popup.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="ays-text-input" id="ays_pb_behance_link" name="ays_social_links[ays_pb_behance_link]"
                                            value="<?php echo $behance_link; ?>" />
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_telegram_link">
                                            <?php echo esc_html__('Telegram link',"ays-popup-box")?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Telegram page link for showing at the end of the popup.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="ays-text-input" id="ays_pb_telegram_link" name="ays_social_links[ays_pb_telegram_link]"
                                            value="<?php echo $telegram_link; ?>" />
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_tiktok_link">
                                            <?php echo esc_html__('TikTok link',"ays-popup-box")?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('TikTok page link for showing at the end of the popup.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="ays-text-input" id="ays_pb_tiktok_link" name="ays_social_links[ays_pb_tiktok_link]"
                                            value="<?php echo $tiktok_link; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <!-- Enable Social Media links end-->
                        <hr>
                        <!-- scedule start -->
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="active_date_check">
                                    <?php echo esc_html__('Schedule the popup', "ays-popup-box"); ?>
                                    <a class="ays_help" data-toggle="tooltip"
                                        title="<?php echo esc_html__('Define the period of time when the popup will be active.', "ays-popup-box") ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9 ays_toggle_parent">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <input id="active_date_check" type="checkbox" class="active_date_check ays_toggle_checkbox"
                                                name="active_date_check" <?php echo $active_date_check ? 'checked' : '' ?>>
                                    </div>
                                    <div class="col-sm-9 ays_toggle_target ays_divider_left active_date" style="<?php echo $active_date_check ? '' : 'display:none' ?>">
                                        <!-- --Aro Start--- -->
                                        <!-- -1- -->
                                        <div class="form-group">
                                                <div class="row"> 
                                                <div class="col-sm-3">
                                                    <label class="form-check-label" for="ays-active"> <?php echo esc_html__('Start date:', "ays-popup-box"); ?> </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="ays-text-input ays-pb-text-input ays-pb-text-input-short ays_actDect ays_pb_act_dect" id="ays-active" name="ays-active"
                                                            value="<?php echo $activePopup; ?>" placeholder="<?php echo current_time( 'mysql' ); ?>">
                                                        <div class="input-group-append">
                                                            <label for="ays-active" class="input-group-text">
                                                                <span><img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/calendar.svg"?>"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- -2- -->
                                        <div class="form-group">
                                                <div class="row"> 
                                                <div class="col-sm-3">
                                                    <label class="form-check-label" for="ays-deactive"> <?php echo esc_html__('End date:', "ays-popup-box"); ?> </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="ays-text-input ays-pb-text-input ays-pb-text-input-short ays_actDect ays_pb_act_dect" id="ays-deactive" name="ays-deactive"
                                                            value="<?php echo $deactivePopup; ?>" placeholder="<?php echo current_time( 'mysql' ); ?>">
                                                        <div class="input-group-append">
                                                            <label for="ays-deactive" class="input-group-text">
                                                                <span><img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/calendar.svg"?>"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                        <!-- --Aro End--- -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- scedule end -->
                        <hr>
                        <!-- schedule by time start -->
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="active_time_check">
                                    <?php echo esc_html__('Popup Display Hours', "ays-popup-box"); ?>
                                    <a class="ays_help" data-toggle="tooltip"
                                        title="<?php echo esc_html__('Specify the hours of the day when the popup should be displayed.', "ays-popup-box") ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9 ays_toggle_parent">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <input id="active_time_check" type="checkbox" class="active_time_check ays_toggle_checkbox"
                                                name="active_time_check" <?php echo $active_time_check ? 'checked' : '' ?>>
                                    </div>
                                    <div class="col-sm-9 ays_toggle_target ays_divider_left active_time" style="<?php echo $active_time_check ? '' : 'display:none' ?>">
                                        <!-- -1- -->
                                        <div class="form-group">
                                                <div class="row"> 
                                                <div class="col-sm-3">
                                                    <label class="form-check-label" for="ays-active-time"> <?php echo esc_html__('Start time:', "ays-popup-box"); ?> </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="input-group mb-3">
                                                        <input type="time" step="any" class="ays-text-input ays-pb-text-input ays-pb-text-input-short" id="ays-active-time" name="ays-active-time"
                                                            value="<?php echo $activeTime; ?>">
                                                        <div class="input-group-append">
                                                            <label id="ays-active-time-label" for="ays-active-time" class="input-group-text">
                                                                <span><img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/clock-circle.svg"?>"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- -2- -->
                                        <div class="form-group">
                                                <div class="row"> 
                                                <div class="col-sm-3">
                                                    <label class="form-check-label" for="ays-deactive-time"> <?php echo esc_html__('End time:', "ays-popup-box"); ?> </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="input-group mb-3">
                                                        <input type="time" step="any" class="ays-text-input ays-pb-text-input ays-pb-text-input-short" id="ays-deactive-time" name="ays-deactive-time"
                                                            value="<?php echo $deactiveTime; ?>">
                                                        <div class="input-group-append">
                                                            <label id="ays-deactive-time-label" for="ays-deactive-time" class="input-group-text">
                                                                <span><img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/clock-circle.svg"?>"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- schedule by time end -->
                        <hr>
                        <div class="col-sm-12 ays-pro-features-v2-main-box">
                            <div class="ays-pro-features-v2-small-buttons-box">
                                <div>
                                    <a href="https://youtu.be/_5GYMSWSBm4" target="_blank" class="ays-pro-features-v2-video-button">
                                        <div>
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/pro-features-icons/Video_24x24.svg" ?>">
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/pro-features-icons/Video_24x24_Hover.svg" ?>" class="ays-pb-new-video-button-hover">
                                        </div>
                                        <div class="ays-pro-features-v2-video-text">
                                            <?php echo esc_html__("Watch Video" , "ays-popup-box"); ?>
                                        </div>
                                    </a>
                                </div>
                                <a href="https://popup-plugin.com/" target="_blank" class="ays-pro-features-v2-upgrade-button">
                                    <div class="ays-pro-features-v2-upgrade-icon" style="background-image: url('<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg');" data-img-src="<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg"></div>
                                    <div class="ays-pro-features-v2-upgrade-text">
                                        <?php echo esc_html__("Upgrade" , "ays-popup-box"); ?>
                                    </div>
                                </a>
                            </div>
                            <div class="form-group row" style="padding: 10px 0; margin: 0px;">
                                <div class="col-sm-3">
                                    <label for="active_date_check">
                                        <?php echo esc_html__('Multiple Scheduling', "ays-popup-box"); ?>
                                        <a class="ays_help ays-pb-help-pro" data-toggle="tooltip"
                                        title="<?php echo esc_html__('The period of time when Popup will be active', "ays-popup-box") ?>">
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                        </a>
                                    </label>
                                </div>
                                <div class="col-sm-9 ays_toggle_parent">
                                    <div class="active_date_check_header">
                                        <input id="" type="checkbox" class="active_date_check ays_toggle_checkbox" checked>
                                        <a href="javascript:void(0)" class="ays_pb_plus_schedule ays_toggle_target ays_divider_left active_date">
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/plus-square.svg"?>">
                                        </a>
                                    </div>
                                    <div class="form-group ays_toggle_target ays_divider_left active_date">
                                        <div class="row">
                                            <div class="col-sm-12 ays_schedule_parent">
                                                <div class="form-group ays_schedule_form">
                                                    <label class="form-check-label active_deactive_date" for="ays_active"> 
                                                        <?php echo esc_html__('Start date:', "ays-popup-box"); ?> 
                                                        <div class="input-group-append">
                                                            <input type="text"class="ays_pb_act_dect">           
                                                            <label style="padding: 0 12px;" class="input-group-text">
                                                                <span><img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/calendar.svg"?>"></span>
                                                            </label>
                                                        </div>
                                                    </label>
                                                    <label class="form-check-label active_deactive_date"> 
                                                        <?php echo esc_html__('End date:', "ays-popup-box"); ?> 
                                                        <div class="input-group-append">
                                                            <input type="text" class="ays_pb_act_dect">
                                                            <label style="padding: 0 12px;" class="input-group-text">
                                                                <span><img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/calendar.svg"?>"></span>
                                                            </label>
                                                        </div>
                                                    </label>
                                                    <a href="javascript:void(0)" class="ays_pb_delete_schedule">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/times.svg"?>">
                                                    </a>                                        
                                                </div>
                                                <div class="form-group ays_schedule_form">
                                                    <label class="form-check-label active_deactive_date" for="ays_active"> 
                                                        <?php echo esc_html__('Start date:', "ays-popup-box"); ?> 
                                                        <div class="input-group-append">
                                                            <input type="text"class="ays_pb_act_dect">           
                                                            <label style="padding: 0 12px;" class="input-group-text">
                                                                <span><img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/calendar.svg"?>"></span>
                                                            </label>
                                                        </div>
                                                    </label>
                                                    <label class="form-check-label active_deactive_date"> 
                                                        <?php echo esc_html__('End date:', "ays-popup-box"); ?> 
                                                        <div class="input-group-append">
                                                            <input type="text" class="ays_pb_act_dect">
                                                            <label style="padding: 0 12px;" class="input-group-text">
                                                                <span><img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/calendar.svg"?>"></span>
                                                            </label>
                                                        </div>
                                                    </label>
                                                    <a href="javascript:void(0)" class="ays_pb_delete_schedule">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/times.svg"?>">
                                                    </a>                                        
                                                </div>
                                            </div>
                                        </div>                            
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- Action on popup content click -->
                        <div class="col-sm-12 ays-pro-features-v2-main-box">
                            <div class="ays-pro-features-v2-small-buttons-box">
                                <div>
                                    <a href="https://youtu.be/El-xx0SgDfw" target="_blank" class="ays-pro-features-v2-video-button">
                                        <div>
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/pro-features-icons/Video_24x24.svg" ?>">
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/pro-features-icons/Video_24x24_Hover.svg" ?>" class="ays-pb-new-video-button-hover">
                                        </div>
                                        <div class="ays-pro-features-v2-video-text">
                                            <?php echo esc_html__("Watch Video" , "ays-popup-box"); ?>
                                        </div>
                                    </a>
                                </div>
                                <a href="https://popup-plugin.com/" target="_blank" class="ays-pro-features-v2-upgrade-button">
                                    <div class="ays-pro-features-v2-upgrade-icon" style="background-image: url('<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg');" data-img-src="<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg"></div>
                                    <div class="ays-pro-features-v2-upgrade-text">
                                        <?php echo esc_html__("Upgrade" , "ays-popup-box"); ?>
                                    </div>
                                </a>
                            </div>
                            <div class="form-group row ays_toggle_parent" style="padding: 10px 0; margin:0px;">
                                <div class="col-sm-3">
                                    <label for="ays_content_click">
                                        <?php echo esc_html__(' Actions while clicking on the popup',"ays-popup-box")?>
                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Enable closing the popup and/or redirecting to the custom URL in case of clicking on any area of the popup container.',"ays-popup-box")?>">
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                        </a>
                                    </label>
                                </div>
                                <div class="col-sm-1">
                                    <input type="checkbox" id="ays_content_click" name="enable_content_click" class="ays_toggle_checkbox"
                                        value="on" checked/>
                                </div>
                                <!-- close and redirect -->
                                <div class="col-sm-8 ays_toggle_target" style="display:block">
                                    <!-- close -->
                                    <div class="col-sm-4">
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <label for="ays_close_pb_content_click">
                                                    <?php echo esc_html__('Enable closing',"ays-popup-box")?>
                                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('If the option is enabled, then the popup will be closed if the user clicks on any area inside it.',"ays-popup-box")?>">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="checkbox" id="ays_close_pb_content_click" name="enable_close_content_click"
                                                    value="on" checked/>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <!-- redirect -->
                                    <div class="col-sm-8 ays_toggle_parent_redirect">
                                        <div class="form-group row">
                                            <div class="col-sm-5">
                                                <label for="ays_redirect_content_click">
                                                    <?php echo esc_html__('Enable redirection',"ays-popup-box")?>
                                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Enable redirection to the custom URL when the user clicks on any area inside the popup.',"ays-popup-box")?>">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="checkbox" id="ays_redirect_content_click" name="enable_redirect_content_click"  class="ays_toggle_checkbox_redirect" value="on" checked/>
                                            </div>
                                            <div class="col-sm-6 ays_toggle_redirect" style="display:block;">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label for="ays_redirect_url_content_click"> <?php echo esc_html__('Redirection URL',"ays-popup-box")?>
                                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Provide the redirection URL.',"ays-popup-box")?>">
                                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                            </a>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" id="ays_redirect_url_content_click" name="redirect_url_content_click" value=""/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label for="ays_new_tab_content_click"> <?php echo esc_html__('Open in new tab',"ays-popup-box")?>
                                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('If the option is enabled, then the system will redirect the URL in a separate new tab.',"ays-popup-box")?>">
                                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                            </a>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="checkbox" id="ays_new_tab_content_click" name="enable_new_tab_content_click" value="on" checked/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- action click end -->
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label>
                                    <?php echo esc_html__('Change the popup creation date',"ays-popup-box"); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Change the popup creation date to the preferred date.',"ays-popup-box"); ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group mb-3 ays_pb_change_creation_date_container">
                                    <input type="text" class="ays-text-input ays-pb-text-input ays-pb-text-input-short ays-pb-date-create" id="ays_pb_change_creation_date" name="ays_pb_change_creation_date" value="<?php echo $pb_create_date; ?>" placeholder="<?php echo current_time( 'mysql' ); ?>">
                                    <div class="input-group-append">
                                        <label for="ays_pb_change_creation_date" class="input-group-text ays_pb_change_creation_date_icon">
                                            <span><img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/calendar.svg"?>"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Change current pb creation date -->
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="ays_pb_create_author">
                                    <?php echo esc_html__('Change the popup author',"ays-popup-box"); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Change the popup author to the preferred one. Write the User ID in the field. To find the ID, go to the WordPress User's section and hover on the user. You can find the user ID in the link below. Please note, that in case you write an ID, by which there are no users found, the changes will not be applied and the previous author will remain the same.","ays-popup-box"); ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                            <select id="ays_pb_create_author" class="" name="ays_pb_create_author">
                                <option value=""><?php echo esc_html__('Select User',"ays-popup-box")?></option>
                                <?php
                                    $pb_user_id = ( isset($get_current_popup_author_data->ID) && $get_current_popup_author_data->ID != '' ) ? absint( sanitize_text_field($get_current_popup_author_data->ID) ) : 0;
                                    $pb_user_display_name = ( isset($get_current_popup_author_data->display_name) && $get_current_popup_author_data->display_name != '' ) ? stripslashes( esc_html($get_current_popup_author_data->display_name) ) : '';
                                    $selected = '';
                                    if ($pb_user_id == $change_pb_create_author) {
                                        $selected = 'selected';
                                    }
                                ?>
                                    <option value="<?php echo $pb_user_id;?>" <?php echo $selected; ?>>
                                        <?php echo $pb_user_display_name; ?>
                                    </option>
                            </select>
                            </div>
                        </div> <!-- Change the author of the current popup box -->
                        <hr class="ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                        <!-- Enable dismiss ad start -->
                        <div class="form-group row ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                            <div class="col-sm-3">
                                    <label for="ays_pb_enable_dismiss">
                                    <span><?php echo esc_html__('Enable dismiss ad', "ays-popup-box"); ?></span>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("After enabling this option the dismiss ad button will be displayed in the popup. After clicking on the button the ads will be dismissed for 1 month.", "ays-popup-box"); ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9 row ays_toggle_parent ays_pb_enable_dismiss_ad_box">
                                <div class="col-sm-3">
                                    <input type="checkbox" name="ays_pb_enable_dismiss" class="ays_toggle_checkbox ays-pb-onoffswitch-checkbox" id="ays_pb_enable_dismiss" <?php echo ($enable_dismiss) ? 'checked' : ''; ?> />
                                </div>
                                <div class="col-sm-9 ays_toggle_target ays_divider_left" style=" <?php echo ( $enable_dismiss ) ? '' : 'display:none'; ?>" >
                                    <div class="ays_toggle_parent_dismiss_option">
                                        <div class="ays_pb_current_device_name show ays_toggle_target_dismiss_option" style="<?php echo ($enable_dismiss_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px"><?php echo esc_html__('Desktop', "ays-popup-box") ?></div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for="ays_pb_enable_dismiss_text">
                                                    <span><?php echo esc_html__('Dismiss ad text', "ays-popup-box"); ?></span>
                                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Write the text that you want to be displayed on the dismiss ad button.", "ays-popup-box"); ?>">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="ays_pb_enable_dismiss_text" class="ays-text-input" id="ays_pb_enable_dismiss_text" value="<?php echo $enable_dismiss_text; ?>" />
                                            </div>
                                        </div>
                                        <div class="ays_toggle_target_dismiss_option"  style=" <?php echo ( $enable_dismiss_mobile ) ? '' : 'display:none'; ?>">
                                            <hr>
                                            <div class="ays_pb_current_device_name show" style="text-align: center; margin-bottom: 10px"><?php echo esc_html__('Mobile', "ays-popup-box") ?></div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label for="ays_pb_enable_dismiss_text_mobile">
                                                        <span><?php echo esc_html__('Dismiss ad text', "ays-popup-box"); ?></span>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Write the text that you want to be displayed on the dismiss ad button.", "ays-popup-box"); ?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" name="ays_pb_enable_dismiss_text_mobile" class="ays-text-input" id="ays_pb_enable_dismiss_text_mobile" value="<?php echo $enable_dismiss_text_mobile; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ays_pb_mobile_settings_container">
                                            <input type="checkbox" class="ays_toggle_checkbox_dismiss_option ays-pb-onoffswitch-checkbox" id="ays_pb_enable_dismiss_mobile" name="ays_pb_enable_dismiss_mobile" <?php echo $enable_dismiss_mobile ? 'checked' : '' ?>>
                                            <label for="ays_pb_enable_dismiss_mobile" class="<?php echo $enable_dismiss_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Enable dismiss ad end -->
                        <hr class="ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                        <div class="form-group row ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                            <div class="col-sm-3">
                                    <label for="ays_pb_disable_scroll">
                                    <span><?php echo esc_html__('Disable page scrolling', "ays-popup-box"); ?></span>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("The page will not be scrolled while the popup is displaying. Note: When the option is enabled, the system hides the scrolling of the HTML tag. As the scrolling is hidden, it is automatically scrolling the popup to the top and the plugin doesn't have a connection to this. ", "ays-popup-box"); ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="ays_pb_pc_and_mobile_container ays_pb_pc_and_mobile_container_cb">
                                    <div class="ays_pb_option_for_desktop">
                                        <span class="ays_pb_current_device_name" style="<?php echo ($disable_scroll_mobile || $disable_scroll) ? 'display: block' : '' ?>"><?php echo esc_html__('Desktop', "ays-popup-box") ?></span>
                                        <p class="onoffswitch">
                                            <input type="checkbox" name="disable_scroll" class="ays-pb-onoffswitch-checkbox" id="ays_pb_disable_scroll" <?php echo ($disable_scroll) ? 'checked' : ''; ?> />
                                        </p>
                                    </div>
                                    <div class="ays_pb_option_for_mobile_device ays_pb_option_for_mobile_device_cb ays_divider_left <?php echo ($disable_scroll_mobile || $disable_scroll) ? 'show' : '' ?>">
                                        <span class="ays_pb_current_device_name" style="<?php echo ($disable_scroll_mobile || $disable_scroll) ? 'display: block' : '' ?>"><?php echo esc_html__('Mobile', "ays-popup-box") ?></span>
                                        <p class="onoffswitch" style="margin:0;">
                                            <input type="checkbox" name="disable_scroll_mobile" class="ays-pb-onoffswitch-checkbox" id="ays_pb_disable_scroll_mobile" <?php if($disable_scroll_mobile){ echo 'checked';} ?>/>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                        <!-- Disable popup scrolling start -->
                        <div class="form-group row ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                            <div class="col-sm-3">
                                    <label for="ays_pb_disable_scroll_on_popup">
                                    <span><?php echo esc_html__('Disable popup scrolling', "ays-popup-box"); ?></span>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("After enabling this option the content in the popup will not be scrolled.", "ays-popup-box"); ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="ays_pb_pc_and_mobile_container ays_pb_pc_and_mobile_container_cb">
                                    <div class="ays_pb_option_for_desktop">
                                        <span class="ays_pb_current_device_name" style="<?php echo ($ays_pb_disable_scroll_on_popup_mobile || $ays_pb_disable_scroll_on_popup) ? 'display: block' : '' ?>"><?php echo esc_html__('Desktop', "ays-popup-box") ?></span>
                                        <p class="onoffswitch">
                                            <input type="checkbox" name="ays_pb_disable_scroll_on_popup" class="ays-pb-onoffswitch-checkbox" id="ays_pb_disable_scroll_on_popup" <?php echo ($ays_pb_disable_scroll_on_popup) ? 'checked' : ''; ?> />
                                        </p>
                                    </div>
                                    <div class="ays_pb_option_for_mobile_device ays_pb_option_for_mobile_device_cb ays_divider_left <?php echo ($ays_pb_disable_scroll_on_popup_mobile || $ays_pb_disable_scroll_on_popup) ? 'show' : '' ?>">
                                        <span class="ays_pb_current_device_name" style="<?php echo ($ays_pb_disable_scroll_on_popup_mobile || $ays_pb_disable_scroll_on_popup) ? 'display: block' : '' ?>"><?php echo esc_html__('Mobile', "ays-popup-box") ?></span>
                                        <p class="onoffswitch" style="margin:0;">
                                            <input type="checkbox" name="ays_pb_disable_scroll_on_popup_mobile" class="ays-pb-onoffswitch-checkbox" id="ays_pb_disable_scroll_on_popup_mobile" <?php if($ays_pb_disable_scroll_on_popup_mobile){ echo 'checked';} ?>/>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Disable popup scrolling end -->
                        <hr class="ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                        <div class="form-group row ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                            <div class="col-sm-3">
                                    <label for="ays_pb_show_scrollbar">
                                    <span><?php echo esc_html__('Show scrollbar', "ays-popup-box"); ?></span>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Enable this option to display the popup scrollbar.", "ays-popup-box"); ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="ays_pb_pc_and_mobile_container ays_pb_pc_and_mobile_container_cb">
                                    <div class="ays_pb_option_for_desktop">
                                        <span class="ays_pb_current_device_name" style="<?php echo ($ays_pb_show_scrollbar_mobile || $ays_pb_show_scrollbar) ? 'display: block' : '' ?>"><?php echo esc_html__('Desktop', "ays-popup-box") ?></span>
                                        <p class="onoffswitch">
                                            <input type="checkbox" name="ays_pb_show_scrollbar" class="ays-pb-onoffswitch-checkbox" id="ays_pb_show_scrollbar" <?php echo ($ays_pb_show_scrollbar) ? 'checked' : ''; ?> />
                                        </p>
                                    </div>
                                    <div class="ays_pb_option_for_mobile_device ays_pb_option_for_mobile_device_cb ays_divider_left <?php echo ($ays_pb_show_scrollbar_mobile || $ays_pb_show_scrollbar) ? 'show' : '' ?>">
                                        <span class="ays_pb_current_device_name" style="<?php echo ($ays_pb_show_scrollbar_mobile || $ays_pb_show_scrollbar) ? 'display: block' : '' ?>"><?php echo esc_html__('Mobile', "ays-popup-box") ?></span>
                                        <p class="onoffswitch" style="margin:0;">
                                            <input type="checkbox" name="ays_pb_show_scrollbar_mobile" class="ays-pb-onoffswitch-checkbox" id="ays_pb_show_scrollbar_mobile" <?php if($ays_pb_show_scrollbar_mobile){ echo 'checked';} ?>/>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab3" class="ays-pb-tab-content  <?php echo ($ays_pb_tab == 'tab3') ? 'ays-pb-tab-content-active' : ''; ?>">
                <div class="d-flex justify-content-end align-items-center">
                    <div class="d-flex justify-content-between align-items-center" style="gap: 5px; font-size: 13px">
                        <div>
                            <a href="javascript:void(0);" class="ays-pb-collapse-all-options"><?php echo esc_html__("Collapse All", "ays-popup-box"); ?></a>
                        </div>    
                        |               
                        <div>
                            <a href="javascript:void(0);" class="ays-pb-expand-all-options"><?php echo esc_html__("Expand All", "ays-popup-box"); ?></a>
                        </div>                   
                    </div>
                </div>
                <div class="ays_pb_themes ays_pb_hide_for_video_type ays_pb_hide_for_image_type ays_pb_hide_for_facebook_type ays_pb_hide_for_notification_type <?php echo ($modal_content == 'video_type' || $modal_content == 'image_type' || $modal_content == 'facebook_type' || $modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                    <div class="ays-pb-accordion-options-main-container">
                        
                        <div class="ays-pb-accordion-header">
                            <?php echo wp_kses($pb_acordion_svg_html, $allow_tags_acordion_arrow); ?>
                            <p class="ays-subtitle"><?php echo  esc_html__('Template', "ays-popup-box") ?></p>
                        </div>
                        <hr class="ays-pb-bolder-hr"/>
                        <div class="ays-pb-accordion-body">
                            <div class="pb_theme_img_box">
                                <div class="ays-pb-template-themes">
                                    <div class="ays-pb-template-content ays-pb-default-theme">
                                        <div class="ays-pb-template-overlay-preview">
                                            <div class="ays-pb-choose-template-div <?php echo ('default' != $view_type) ? 'display_none' : '' ?>">
                                                <div class="ays-pb-template-checkbox">
                                                    <label class="ays-pb-template-checkbox-container">
                                                        <input type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[view_type]"
                                                                value="default" <?php echo ('default' == $view_type) ? 'checked' : '' ?>>
                                                        <span class="ays-pb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="ays-pb-template-choose-template-btn">
                                                    <button type="button">Choose Template</button>
                                                </div>
                                            </div>
                                            <div class="ays-pb-template-label">
                                                    <p <?php echo ('default' == $view_type) ? 'class="apm_active_theme"' : '' ?> ><?php echo esc_html__('Default', "ays-popup-box") ?></p>
                                                    <p class="ays-pb-template-label-preview">
                                                        <a href="https://demo.popup-plugin.com/shortcode-popup/" target="_blank">Preview</a>
                                                    </p>
                                            </div>
                                        </div>
                                        <div class="pb_theme_image_div col">
                                            <div class="ays-pb-template-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . '/images/themes/word-press-popup-maker-template-default-min.png' ?>" alt="<?php echo esc_html__('Default', "ays-popup-box") ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ays-pb-template-content ays-pb-red-theme">
                                        <div class="ays-pb-template-overlay-preview">
                                            <div class="ays-pb-choose-template-div <?php echo ('lil' != $view_type) ? 'display_none' : '' ?>">
                                                <div class="ays-pb-template-checkbox">
                                                    <label class="ays-pb-template-checkbox-container">
                                                        <input type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[view_type]" value="lil" <?php echo ('lil' == $view_type) ? 'checked' : '' ?>>
                                                        <span class="ays-pb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="ays-pb-template-choose-template-btn">
                                                    <button type="button">Choose Template</button>
                                                </div>
                                            </div>
                                            <div class="ays-pb-template-label">
                                                    <p <?php echo ('red' == $view_type) ? 'class="apm_active_theme"' : '' ?>><?php echo esc_html__('Red', "ays-popup-box") ?></p>
                                                    <p class="ays-pb-template-label-preview">
                                                        <a href="https://demo.popup-plugin.com/custom-content-popup/" target="_blank">Preview</a>
                                                    </p>
                                            </div>
                                        </div>
                                        <div class="pb_theme_image_div col">
                                            <div class="ays-pb-template-img">
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . '/images/themes/word-press-popup-maker-template-red-min.png' ?>"
                                                    alt="<?php echo esc_html__('Red', "ays-popup-box") ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ays-pb-template-content ays-pb-modern-theme">
                                        <div class="ays-pb-template-overlay-preview">
                                            <div class="ays-pb-choose-template-div <?php echo ('image' != $view_type) ? 'display_none' : '' ?>">
                                                <div class="ays-pb-template-checkbox">
                                                    <label class="ays-pb-template-checkbox-container">
                                                        <input type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[view_type]" value="image" <?php echo ('image' == $view_type) ? 'checked' : '' ?>>
                                                        <span class="ays-pb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="ays-pb-template-choose-template-btn">
                                                    <button type="button">Choose Template</button>
                                                </div>
                                            </div>
                                            <div class="ays-pb-template-label">
                                                <p <?php echo ( 'image' == $view_type) ? 'class="apm_active_theme"' : '' ?>><?php echo esc_html__('Modern', "ays-popup-box") ?></p>
                                                    <p class="ays-pb-template-label-preview">
                                                        <a href="https://demo.popup-plugin.com/iframe-popup/" target="_blank">Preview</a>
                                                    </p>
                                            </div>
                                        </div>
                                        <div class="pb_theme_image_div col">
                                            <div class="ays-pb-template-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . '/images/themes/word-press-popup-maker-template-modern-min.png' ?>" alt="<?php echo esc_html__('Modern', "ays-popup-box") ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ays-pb-template-content ays-pb-minimal-theme">
                                        <div class="ays-pb-template-overlay-preview">
                                            <div class="ays-pb-choose-template-div <?php echo ('minimal' != $view_type) ? 'display_none' : '' ?>">
                                                <div class="ays-pb-template-checkbox">
                                                    <label class="ays-pb-template-checkbox-container">
                                                        <input type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[view_type]" value="minimal" <?php echo ('minimal' == $view_type) ? 'checked' : '' ?>>
                                                        <span class="ays-pb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="ays-pb-template-choose-template-btn">
                                                    <button type="button">Choose Template</button>
                                                </div>
                                            </div>
                                            <div class="ays-pb-template-label">
                                                    <p <?php echo ( 'minimal' == $view_type) ? 'class="apm_active_theme"' : '' ?> ><?php echo esc_html__('Minimal', "ays-popup-box") ?></p>
                                                    <p class="ays-pb-template-label-preview" style="display:none;">
                                                        <a href="#">Preview</a>
                                                    </p>
                                            </div>
                                        </div>
                                        <div class="pb_theme_image_div col">
                                            <div class="ays-pb-template-img">
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . '/images/themes/word-press-popup-maker-template-minimal.png' ?>" alt="<?php echo esc_html__('Minimal', "ays-popup-box") ?>">
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="ays-pb-template-content ays-pb-sale-theme">
                                        <div class="ays-pb-template-overlay-preview">
                                            <div class="ays-pb-choose-template-div <?php echo ('template' != $view_type) ? 'display_none' : '' ?>">
                                                <div class="ays-pb-template-checkbox">
                                                    <label class="ays-pb-template-checkbox-container">
                                                        <input type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[view_type]" value="template" <?php echo ('template' == $view_type) ? 'checked' : '' ?>>
                                                        <span class="ays-pb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="ays-pb-template-choose-template-btn">
                                                    <button type="button">Choose Template</button>
                                                </div>
                                            </div>
                                            <div class="ays-pb-template-label">
                                                    <p <?php echo ( 'template' == $view_type) ? 'class="apm_active_theme"' : '' ?> ><?php echo esc_html__('Sale', "ays-popup-box") ?></p>
                                                    <p class="ays-pb-template-label-preview" style="display:none;">
                                                        <a href="#">Preview</a>
                                                    </p>
                                            </div>
                                        </div>
                                        <div class="pb_theme_image_div col">
                                            <div class="ays-pb-template-img">
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . '/images/themes/word-press-popup-maker-template-sale-min.png' ?>" alt="<?php echo esc_html__('Sale', "ays-popup-box") ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- video theme -->
                                    <div class="ays-pb-template-content ays-pb-video-theme" style="display: none;">
                                        <div class="ays-pb-template-overlay-preview">
                                            <div class="ays-pb-choose-template-div <?php echo ('video' != $view_type) ? 'display_none' : '' ?>">
                                                <div class="ays-pb-template-checkbox">
                                                    <label class="ays-pb-template-checkbox-container">
                                                        <input type="radio" id="video_theme_view_type" name="<?php echo esc_attr($this->plugin_name); ?>[view_type]" value="video" <?php echo ($view_type == 'video') ? 'checked' : '' ?>>
                                                        <span class="ays-pb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="ays-pb-template-choose-template-btn">
                                                    <button type="button">Choose Template</button>
                                                </div>
                                            </div>
                                            <div class="ays-pb-template-label">
                                                    <p <?php echo ('video' == $view_type ) ? 'class="apm_active_theme"' : '' ?>><?php echo esc_html__('Video', "ays-popup-box") ?></p>
                                                    <p class="ays-pb-template-label-preview">
                                                        <a href="#">Preview</a>
                                                    </p>
                                            </div>
                                        </div>
                                        <div class="pb_theme_image_div col">
                                            <div class="ays-pb-template-img">
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . '/images/themes/video_theme.png' ?>" alt="<?php echo esc_html__('Video', "ays-popup-box") ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Image theme -->
                                    <div class="ays-pb-template-content ays-pb-image-theme" style="display: none;">
                                        <input type="radio" id="image_type_img_theme_view_type" name="<?php echo esc_attr($this->plugin_name); ?>[view_type]" value="image_type_img_theme" <?php echo ($view_type == 'image_type_img_theme') ? 'checked' : '' ?>>
                                    </div>
                                    <!-- Facebook theme -->
                                    <div class="ays-pb-template-content ays-pb-facebook-theme" style="display: none;">
                                        <input type="radio" id="facebook_theme_view_type" name="<?php echo esc_attr($this->plugin_name); ?>[view_type]" value="facebook" <?php echo ($view_type == 'facebook') ? 'checked' : '' ?>>
                                    </div>
                                    <!-- Notification theme -->
                                    <div class="ays-pb-template-content ays-pb-notification-theme" style="display: none;">
                                        <input type="radio" id="notification_theme_view_type" name="<?php echo esc_attr($this->plugin_name); ?>[view_type]" value="notification" <?php echo ($view_type == 'notification') ? 'checked' : '' ?>>
                                    </div>
                                </div>
                                <div class="ays-pb-template-pro-themes">
                                    <div class="ays-pb-template-content ays-pb-peachy-theme">
                                        <div class="ays-pb-template-overlay-preview">
                                            <div class="ays-pb-template-label">
                                                <p><?php echo esc_html__('Peachy', "ays-popup-box") ?></p>
                                                <p>
                                                    <a href="https://demo.popup-plugin.com/countdown-popup/" target="_blank" style="background:#d06b46;border: 1px solid #d06b46;">Demo</a>
                                                    <a href="https://popup-plugin.com/" target="_blank">Pro</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="pb_theme_image_div col">
                                            <div class="ays-pb-template-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . '/images/themes/word-press-popup-maker-template-peachy-min.png' ?>" alt="<?php echo esc_html__('Sale', "ays-popup-box") ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ays-pb-template-content ays-pb-yellowish-theme">
                                        <div class="ays-pb-template-overlay-preview">
                                            <div class="ays-pb-template-label">
                                                    <p><?php echo esc_html__('Yellowish', "ays-popup-box") ?></p>
                                                    <p>
                                                        <a href="https://demo.popup-plugin.com/coupon-popup/" target="_blank" style="background:#d06b46;border: 1px solid #d06b46;">Demo</a>
                                                        <a href="https://popup-plugin.com/" target="_blank">Pro</a>
                                                    </p>
                                            </div>
                                        </div>
                                        <div class="pb_theme_image_div col">
                                            <div class="ays-pb-template-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . '/images/themes/word-press-popup-maker-template-yellowish-min.png' ?>" alt="<?php echo esc_html__('Sale', "ays-popup-box") ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ays-pb-template-content ays-pb-coral-theme">
                                        <div class="ays-pb-template-overlay-preview">
                                            <div class="ays-pb-template-label">
                                                <p><?php echo esc_html__('Coral', "ays-popup-box") ?></p>
                                                <p>
                                                    <a href="https://demo.popup-plugin.com/yes-no-popup" target="_blank" style="background:#d06b46;border: 1px solid #d06b46;">Demo</a>
                                                    <a href="https://popup-plugin.com/" target="_blank">Pro</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="pb_theme_image_div col">
                                            <div class="ays-pb-template-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . '/images/themes/word-press-popup-maker-template-coral-min.png' ?>" alt="<?php echo esc_html__('Coral', "ays-popup-box") ?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="ays-pb-template-content ays-pb-frozen-theme">
                                        <div class="ays-pb-template-overlay-preview">
                                            <div class="ays-pb-template-label">
                                                <p><?php echo esc_html__('Frozen', "ays-popup-box") ?></p>
                                                <p>
                                                    <a href="https://demo.popup-plugin.com/subscription-popup/" target="_blank" style="background:#d06b46;border: 1px solid #d06b46;">Demo</a>
                                                    <a href="https://popup-plugin.com/" target="_blank">Pro</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="pb_theme_image_div col">
                                            <div class="ays-pb-template-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . '/images/themes/word-press-popup-maker-template-frozen-min.png' ?>" alt="<?php echo esc_html__('Frozen', "ays-popup-box") ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ays-pb-template-content ays-pb-food-theme">
                                        <div class="ays-pb-template-overlay-preview">
                                            <div class="ays-pb-template-label">
                                                    <p><?php echo esc_html__('Food', "ays-popup-box") ?></p>
                                                    <p>
                                                        <a href="https://demo.popup-plugin.com/subscribe-and-get-file-popup/" target="_blank" style="background:#d06b46;">Demo</a>
                                                        <a href="https://popup-plugin.com/" target="_blank">Pro</a>
                                                    </p>
                                            </div>
                                        </div>
                                        <div class="pb_theme_image_div col">
                                            <div class="ays-pb-template-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . '/images/themes/word-press-popup-maker-template-food-min.png' ?>" alt="<?php echo esc_html__('Food', "ays-popup-box") ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ays-pb-template-content ays-pb-forest-theme">
                                        <div class="ays-pb-template-overlay-preview">
                                            <div class="ays-pb-template-label">
                                                <p><?php echo esc_html__('Forest', "ays-popup-box") ?></p>
                                                <p>
                                                    <a href="https://demo.popup-plugin.com/contact-form-popup/" target="_blank" style="background:#d06b46; border: 1px solid #d06b46;">Demo</a>
                                                    <a href="https://popup-plugin.com/" target="_blank">Pro</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="pb_theme_image_div col">
                                            <div class="ays-pb-template-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . '/images/themes/word-press-popup-maker-template-forest-min.png' ?>" alt="<?php echo esc_html__('Forest', "ays-popup-box") ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ays-pb-template-themes-view-more-button-content">
                                    <hr class="ays-pb-template-themes-view-more-border">
                                    <div class="ays-pb-template-themes-view-more-button">
                                        <button class="ays-pb-template-themes-view-more-btn <?php echo !in_array( $view_type, $not_default_view_types ) ? '' : 'display_none'; ?>" type="button">View More</button>
                                        <button class="ays-pb-template-themes-hide-btn" style="<?php echo !in_array( $view_type, $not_default_view_types ) ? 'display:none' : 'display:block'; ?>" type="button">Hide</button>
                                    </div>
                                    <hr class="ays-pb-template-themes-view-more-border">
                                </div>
                                <div class="ays-pb-template-themes-view-more" style="<?php echo !in_array( $view_type, $not_default_view_types ) ? 'display:none' : 'display:flex'; ?>">
                                    <div class="ays-pb-template-content ays-pb-macos-theme">
                                        <div class="ays-pb-template-overlay-preview">
                                            <div class="ays-pb-choose-template-div <?php echo ('mac' != $view_type) ? 'display_none' : '' ?>">
                                                <div class="ays-pb-template-checkbox">
                                                    <label class="ays-pb-template-checkbox-container">
                                                        <input type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[view_type]"
                                                        value="mac" <?php echo ('mac' == $view_type) ? 'checked' : '' ?>>
                                                        <span class="ays-pb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="ays-pb-template-choose-template-btn">
                                                    <button type="button">Choose Template</button>
                                                </div>
                                            </div>
                                            <div class="ays-pb-template-label">
                                                <p <?php echo ('mac' == $view_type) ? 'class="apm_active_theme"' : '' ?>><?php echo esc_html__('MacOS window', "ays-popup-box") ?></p>
                                                <p class="ays-pb-template-label-preview">
                                                    <a href="#">Preview</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="pb_theme_image_div col">
                                            <div class="ays-pb-template-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . '/images/themes/word-press-popup-maker-template-default.png' ?>" alt="<?php echo esc_html__('MacOS ', "ays-popup-box") ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ays-pb-template-content ays-pb-ubuntu-theme">
                                        <div class="ays-pb-template-overlay-preview">
                                            <div class="ays-pb-choose-template-div <?php echo ('ubuntu' != $view_type) ? 'display_none' : '' ?>">
                                                <div class="ays-pb-template-checkbox">
                                                    <label class="ays-pb-template-checkbox-container">
                                                    <input type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[view_type]" value="ubuntu" <?php echo ('ubuntu' == $view_type) ? 'checked' : '' ?>>
                                                        <span class="ays-pb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="ays-pb-template-choose-template-btn">
                                                    <button type="button">Choose Template</button>
                                                </div>
                                            </div>
                                            <div class="ays-pb-template-label">
                                                <p <?php echo ('ubuntu' == $view_type) ? 'class="apm_active_theme"' : '' ?>><?php echo esc_html__('Ubuntu', "ays-popup-box") ?></p>
                                                <p class="ays-pb-template-label-preview">
                                                    <a href="#">Preview</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="pb_theme_image_div col">
                                            <div class="ays-pb-template-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . '/images/themes/word-press-popup-maker-template-ubuntu-min.png' ?>" alt="<?php echo esc_html__('Ubuntu', "ays-popup-box") ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ays-pb-template-content ays-pb-winxp-theme">
                                        <div class="ays-pb-template-overlay-preview">
                                            <div class="ays-pb-choose-template-div <?php echo ('winXP' != $view_type) ? 'display_none' : '' ?>">
                                                <div class="ays-pb-template-checkbox">
                                                    <label class="ays-pb-template-checkbox-container">
                                                        <input type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[view_type]"
                                                        value="winXP" <?php echo ('winXP' == $view_type) ? 'checked' : '' ?>>
                                                        <span class="ays-pb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="ays-pb-template-choose-template-btn">
                                                    <button type="button">Choose Template</button>
                                                </div>
                                            </div>
                                            <div class="ays-pb-template-label">
                                                <p <?php echo ('win98' == $view_type) ? 'class="apm_active_theme"' : '' ?>><?php echo esc_html__('Windows XP', "ays-popup-box") ?></p>
                                                <p class="ays-pb-template-label-preview">
                                                    <a href="#">Preview</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="pb_theme_image_div col">
                                            <div class="ays-pb-template-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . '/images/themes/word-press-popup-maker-template-windowsxp.png' ?>" alt="<?php echo esc_html__('Windows XP', "ays-popup-box") ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ays-pb-template-content ays-pb-win98-theme">
                                        <div class="ays-pb-template-overlay-preview">
                                            <div class="ays-pb-choose-template-div <?php echo ('win98' != $view_type) ? 'display_none' : '' ?>">
                                                <div class="ays-pb-template-checkbox">
                                                    <label class="ays-pb-template-checkbox-container">
                                                        <input type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[view_type]"
                                                        value="win98" <?php echo ('win98' == $view_type) ? 'checked' : '' ?>>
                                                        <span class="ays-pb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="ays-pb-template-choose-template-btn">
                                                    <button type="button">Choose Template</button>
                                                </div>
                                            </div>
                                            <div class="ays-pb-template-label">
                                                <p <?php echo ('win98' == $view_type) ? 'class="apm_active_theme"' : '' ?>><?php echo esc_html__('Windows 98', "ays-popup-box") ?></p>
                                                <p class="ays-pb-template-label-preview">
                                                    <a href="#">Preview</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="pb_theme_image_div col">
                                            <div class="ays-pb-template-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . '/images/themes/word-press-popup-maker-template-windows-98.png' ?>" alt="<?php echo esc_html__('Windows 98', "ays-popup-box") ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ays-pb-template-content ays-pb-command-prompt-theme">
                                        <div class="ays-pb-template-overlay-preview">
                                            <div class="ays-pb-choose-template-div <?php echo ('cmd' != $view_type) ? 'display_none' : '' ?>">
                                                <div class="ays-pb-template-checkbox">
                                                    <label class="ays-pb-template-checkbox-container">
                                                        <input type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[view_type]" value="cmd" <?php echo ('cmd' ==$view_type) ? 'checked' : '' ?>>
                                                        <span class="ays-pb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="ays-pb-template-choose-template-btn">
                                                    <button type="button">Choose Template</button>
                                                </div>
                                            </div>
                                            <div class="ays-pb-template-label">
                                                <p <?php echo ('cmd' == $view_type) ? 'class="apm_active_theme"' : '' ?>><?php echo esc_html__('Command prompt', "ays-popup-box") ?></p>
                                                <p class="ays-pb-template-label-preview">
                                                    <a href="#">Preview</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="pb_theme_image_div col">
                                            <div class="ays-pb-template-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . '/images/themes/word-press-popup-maker-template-command-prompt.png' ?>" alt="<?php echo esc_html__('Command prompt', "ays-popup-box") ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 <?php echo $modal_content == 'facebook_type' || $modal_content == 'notification_type' ? 'col-md-12' : 'col-md-6'; ?> ays_pb_styles_tab_options">
                        <div class="ays-pb-accordion-options-main-container">
                            <div class="ays-pb-accordion-header">
                                <?php echo wp_kses($pb_acordion_svg_html, $allow_tags_acordion_arrow); ?>
                                <p class="ays-subtitle"><?php echo  esc_html__('Popup Dimensions', "ays-popup-box") ?></p>
                            </div>
                            <hr class="ays-pb-bolder-hr"/>
                            <div class="ays-pb-accordion-body">
                                <div class="form-group row ays_pb_hide_for_video_type ays_pb_hide_for_image_type ays_pb_hide_for_notification_type <?php echo ($modal_content == 'video_type' || $modal_content == 'image_type' || $modal_content == 'notification_type') ? 'display_none' : ''; ?>" id="ays-pb-show-title-description-box">
                                    <div class="col-sm-4">
                                        <label>
                                            <?php echo esc_html__("Display Content", "ays-popup-box");?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Show Popup head information - Enable to show the title and(or) the description inside the popup.", "ays-popup-box"); ?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 ays_divider_left">
                                        <div class="ays_toggle_parent">
                                            <div>
                                                <div class="ays_pb_current_device_name ays_pb_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_display_content_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 285px;"><?php echo esc_html__('Desktop', "ays-popup-box") ?></div>
                                                <label class="ays-pb-label-style"><?php echo esc_html__("Show title", "ays-popup-box");?>
                                                    <input type="checkbox" class="ays_pb_title" name="show_popup_title" <?php if($show_popup_title == 'On'){ echo 'checked';} else { echo '';} ?>/>
                                                </label>
                                                <label class="ays-pb-label-style"><?php echo esc_html__("Show description", "ays-popup-box");?>
                                                    <input type="checkbox" class="ays_pb_desc" name="show_popup_desc" <?php if($show_popup_desc == 'On'){ echo 'checked';} else { echo '';} ?>/>
                                                </label>
                                            </div>
                                            <div class="ays_toggle_target ays_pb_display_content_mobile_container" style=" <?php echo ( $enable_display_content_mobile ) ? '' : 'display:none'; ?>">
                                                <hr>
                                                <div class="ays_pb_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 285px;"><?php echo esc_html__('Mobile', "ays-popup-box") ?></div>
                                                <label class="ays-pb-label-style"><?php echo esc_html__("Show title", "ays-popup-box");?>
                                                    <input type="checkbox" class="ays_pb_title_mobile" name="show_popup_title_mobile" <?php echo $show_popup_title_mobile == 'On' ? 'checked' : ''; ?>/>
                                                </label>
                                                <label class="ays-pb-label-style"><?php echo esc_html__("Show description", "ays-popup-box");?>
                                                    <input type="checkbox" class="ays_pb_desc_mobile" name="show_popup_desc_mobile" <?php echo $show_popup_desc_mobile == 'On' ? 'checked' : ''; ?>/>
                                                </label>
                                            </div>
                                            <div class="ays_pb_mobile_settings_container">
                                                <input type="checkbox" class="ays_toggle_checkbox ays-pb-onoffswitch-checkbox" id="ays_pb_enable_display_content_mobile" name="ays_pb_enable_display_content_mobile" <?php echo $enable_display_content_mobile ? 'checked' : '' ?>>
                                                <label for="ays_pb_enable_display_content_mobile" class="<?php echo $enable_display_content_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="ays_pb_hide_for_video_type ays_pb_hide_for_image_type ays_pb_hide_for_notification_type <?php echo ($modal_content == 'video_type' || $modal_content == 'image_type' || $modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                                <!-- popup width for desktop and mobile start -->
                                <div class="form-group row ays_pb_hide_for_notification_type <?php echo $modal_content == 'notification_type' ? 'display_none' : ''; ?>">
                                    <div class="col-sm-4">
                                        <label for='<?php echo esc_attr($this->plugin_name); ?>-width'>
                                            <?php echo esc_html__('Width', "ays-popup-box"); ?>
                                            <a class="ays_help" data-toggle="tooltip" title="" data-original-title="<?php echo esc_html__('Specify the width of the popup in pixels.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 ays-pb-width-content ays_divider_left">
                                        <!-- width for desktop start -->
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for="<?php echo esc_attr($this->plugin_name); ?>-width">
                                                    <?php echo  esc_html__('On desktop',"ays-popup-box") ?>
                                                    <a class="ays_help" data-toggle="tooltip" title="" data-original-title="Define the width for desktop devices. If you put 0 or leave it blank, the width will be 100%. It accepts only numerical values and you can choose whether to define the value by percentage or in pixels.">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div>
                                                    <input type="number" id="<?php echo esc_attr($this->plugin_name); ?>-width"  class="ays-pb-text-input ays-pb-text-input-short ays_pb_width"  name="<?php echo esc_attr($this->plugin_name); ?>[width]" value="<?php echo $width; ?>" <?php echo $disable_width; ?>/>
                                                    <span style="display:block;" class="ays-pb-small-hint-text"><?php echo esc_html__("For 100% leave blank", "ays-popup-box");?></span>
                                                </div>
                                                <div class="ays_pb_width_by_percentage_px_box">
                                                    <select name="ays_popup_width_by_percentage_px" id="ays_popup_width_by_percentage_px" class="ays_pb_aysDropdown ays-pb-percent">
                                                        <option value="pixels" <?php echo $popup_width_by_percentage_px == "pixels" ? "selected" : ""; ?>>
                                                            <?php echo esc_html__( "px", "ays-popup-box" ); ?>
                                                        </option>
                                                        <option value="percentage" <?php echo $popup_width_by_percentage_px == "percentage" ? "selected" : ""; ?>>
                                                            <?php echo esc_html__( "%", "ays-popup-box" ); ?>
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- width for desktop end -->
                                        <hr>
                                        <!-- width for mobile start -->
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for="ays-pb-mobile-width">
                                                    <?php echo  esc_html__('On mobile',"ays-popup-box") ?>
                                                    <a class="ays_help" data-toggle="tooltip" title="" data-original-title="Define the width for mobile devices in percentage. Note: This option works for the screens with less than 768 pixels width.">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div>
                                                    <input id="ays-pb-mobile-width" class="ays-pb-text-input ays-pb-text-input-short" name="ays_pb_mobile_width" type="number" style="display:inline-block;" value="<?php echo $mobile_width; ?>" />
                                                    <span style="display:block;" class="ays-pb-small-hint-text"><?php echo esc_html__("For 100% leave blank", "ays-popup-box");?></span>
                                                </div>
                                                <div class="ays_pb_width_by_percentage_px_box">
                                                    <select name="ays_popup_width_by_percentage_px_mobile" id="ays_popup_width_by_percentage_px_mobile" class="ays_pb_aysDropdown ays-pb-percent">
                                                        <option value="pixels" <?php echo $popup_width_by_percentage_px_mobile == "pixels" ? "selected" : ""; ?>>
                                                            <?php echo esc_html__( "px", "ays-popup-box" ); ?>
                                                        </option>
                                                        <option value="percentage" <?php echo $popup_width_by_percentage_px_mobile == "percentage" ? "selected" : ""; ?>>
                                                            <?php echo esc_html__( "%", "ays-popup-box" ); ?>
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- width for mobile start -->
                                    </div>
                                </div>
                                <!-- popup width for desktop and mobile end -->
                                <hr class="ays_pb_hide_for_notification_type <?php echo $modal_content == 'notification_type' ? 'display_none' : ''; ?>">
                                <div class="form-group row ays_pb_hide_for_notification_type <?php echo $modal_content == 'notification_type' ? 'display_none' : ''; ?>">
                                    <div class="col-sm-4">
                                        <label for="ays-pb-mobile-max-width">
                                            <?php echo  esc_html__('Max-width for mobile',"ays-popup-box") ?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Specify the max-width of the popup for mobile in percentage. Note: This option works for screens with less than 768 pixels width.", "ays-popup-box"); ?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 ays_divider_left ays_popup_display_flex_width">
                                        <div>
                                            <input id="ays-pb-mobile-max-width" class="ays-pb-text-input ays-pb-text-input-short" name="ays_pb_mobile_max_width" type="number" style="display:inline-block;" value="<?php echo $mobile_max_width; ?>">
                                            <span style="display:block;" class="ays-pb-small-hint-text"><?php echo esc_html__("For 100% leave blank", "ays-popup-box");?></span>
                                        </div>
                                        <div class="ays_dropdown_max_width">
                                            <input type="text" value="%" class="ays-form-hint-for-size" disabled>
                                        </div>
                                    </div>
                                </div>
                                <hr class="ays_pb_hide_for_notification_type <?php echo $modal_content == 'notification_type' ? 'display_none' : ''; ?>">
                                <!-- popup height for desktop and mobile start -->
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="<?php echo esc_attr($this->plugin_name); ?>-height">
                                            <span><?php echo esc_html__('Height', "ays-popup-box"); ?></span>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Specify the height of the popup in pixels.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 ays_divider_left ays-pb-height-content">
                                        <!-- heigh for desktop start -->
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for="<?php echo esc_attr($this->plugin_name); ?>-height">
                                                    <?php echo  esc_html__('On desktop',"ays-popup-box") ?>
                                                    <a class="ays_help" data-toggle="tooltip" title="" data-original-title="Define the height for desktop devices. Leave it blank or put 0 to select the default theme value.">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div>
                                                    <input type="number" id="<?php echo esc_attr($this->plugin_name); ?>-height"  class="ays-pb-text-input ays-pb-text-input-short ays_pb_height" name="<?php echo esc_attr($this->plugin_name); ?>[height]" value="<?php echo $height; ?>" <?php echo $disable_height ;?>> 
                                                </div>
                                                <div class="ays_dropdown_max_width">
                                                    <input type="text" value="px" class="ays-form-hint-for-size" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- height for desktop end -->
                                        <hr>
                                        <!-- height for mobile start -->
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for="ays_pb_mobile_height">
                                                    <?php echo  esc_html__('On mobile',"ays-popup-box") ?>
                                                    <a class="ays_help" data-toggle="tooltip" title="" data-original-title="Specify popup height for mobile in pixels. Note: This option works for the screens with less than 768 pixels width.">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div>
                                                    <input type="number" id="ays_pb_mobile_height"  class="ays-pb-text-input ays-pb-text-input-short ays-pb-mobile-height" name="ays_pb_mobile_height" value="<?php echo $mobile_height; ?>"/>
                                                </div>
                                                <div class="ays_dropdown_max_width">
                                                    <input type="text" value="px" class="ays-form-hint-for-size" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- height for mobile end -->
                                    </div>
                                </div>
                                <!-- popup height for desktop and mobile end -->
                                <hr>
                                <!-- popup max height for desktop and mobile start -->
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="">
                                            <span><?php echo esc_html__('Popup max-height', "ays-popup-box"); ?></span>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Specify the max height of the popup in pixels and percentages.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 ays_divider_left">
                                        <!-- max-heigh for desktop start -->
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for="ays-pb-max-height">
                                                    <?php echo  esc_html__('On desktop',"ays-popup-box") ?>
                                                    <a class="ays_help" data-toggle="tooltip" data-original-title="Define the max height for desktop devices.">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div style="display: flex; align-items: center; gap: 5px">
                                                    <div>
                                                        <input type="number" id="ays-pb-max-height" class="ays-pb-text-input ays-pb-text-input-short"  name="ays_pb_max_height" value="<?php echo $popup_max_height ?>"/>
                                                    </div>
                                                    <div class="ays_pb_max_height_by_percentage_px_box">
                                                        <select name="ays_popup_max_height_by_percentage_px" id="ays_popup_max_height_by_percentage_px" class="ays_pb_aysDropdown ays-pb-percent ays_pb_max_height_unit_dropdown">
                                                            <option value="pixels" <?php echo $popup_max_height_by_percentage_px == "pixels" ? "selected" : ""; ?>>
                                                                <?php echo esc_html__( "px", "ays-popup-box" ); ?>
                                                            </option>
                                                            <option value="percentage" <?php echo $popup_max_height_by_percentage_px == "percentage" ? "selected" : ""; ?>>
                                                                <?php echo esc_html__( "%", "ays-popup-box" ); ?>
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <span style="display:block;" class="ays-pb-small-hint-text"><?php echo esc_html__("For auto leave blank", "ays-popup-box");?></span>
                                            </div>
                                        </div>
                                        <!-- max-heigh for desktop end -->
                                        <hr>
                                        <!-- max-heigh for mobile start -->
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for="ays-pb-max-height-mobile">
                                                    <?php echo  esc_html__('On Mobile',"ays-popup-box") ?>
                                                    <a class="ays_help" data-toggle="tooltip" data-original-title="Define the max height for Mobile devices.">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div style="display: flex; align-items: center; gap: 5px">
                                                    <div>
                                                        <input type="number" id="ays-pb-max-height-mobile" class="ays-pb-text-input ays-pb-text-input-short"  name="ays_pb_max_height_mobile" value="<?php echo $popup_max_height_mobile ?>"/>
                                                    </div>
                                                    <div class="ays_pb_max_height_by_percentage_px_box">
                                                        <select name="ays_popup_max_height_by_percentage_px_mobile" id="ays_popup_max_height_by_percentage_px_mobile" class="ays_pb_aysDropdown ays-pb-percent ays_pb_max_height_unit_dropdown">
                                                            <option value="pixels" <?php echo $popup_max_height_by_percentage_px_mobile == "pixels" ? "selected" : ""; ?>>
                                                                <?php echo esc_html__( "px", "ays-popup-box" ); ?>
                                                            </option>
                                                            <option value="percentage" <?php echo $popup_max_height_by_percentage_px_mobile == "percentage" ? "selected" : ""; ?>>
                                                                <?php echo esc_html__( "%", "ays-popup-box" ); ?>
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <span style="display:block;" class="ays-pb-small-hint-text"><?php echo esc_html__("For auto leave blank", "ays-popup-box");?></span>
                                            </div>
                                        </div>
                                        <!-- max-heigh for mobile end -->
                                    </div>
                                </div>
                                <!-- popup max height for desktop and mobile end -->
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for='ays_pb_min_height'>
                                            <?php echo esc_html__('Popup min-height', "ays-popup-box"); ?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Define the popup's minimal height in pixels.","ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 ays_divider_left ays_popup_display_flex_width">
                                        <div>
                                            <input type="number" class="ays-pb-text-input ays-pb-text-input-short" id='ays_pb_min_height' name='ays_pb_min_height' value="<?php echo $pb_min_height ?>" <?php echo $disable_height ;?>>
                                        </div>
                                        <div class="ays_dropdown_max_width">
                                            <input type="text" value="px" class="ays-form-hint-for-size" disabled>
                                        </div>
                                    </div>
                                </div>
                                <hr class="ays_pb_hide_for_notification_type <?php echo $modal_content == 'notification_type' ? 'display_none' : ''; ?>">
                                <!-- open popup full screen -->
                                <div class="form-group row ays_pb_hide_for_notification_type <?php echo $modal_content == 'notification_type' ? 'display_none' : ''; ?>">
                                    <div class="col-sm-4">
                                        <label for="open_pb_fullscreen">
                                            <span><?php echo esc_html__('Full-screen mode', "ays-popup-box"); ?></span>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Enable this option to display the popup on a full screen.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 ays_divider_left">
                                        <input type="checkbox" id="open_pb_fullscreen" class="" name="enable_pb_fullscreen"  <?php echo $ays_enable_pb_fullscreen == 'on' ? 'checked' : ''; ?> />
                                    </div>
                                </div>
                                <hr class="ays_pb_hide_for_video_type <?php echo ($modal_content == 'video_type') ? 'display_none' : ''; ?>" >
                                <div class="form-group row ays_pb_content_padding_option ays_pb_hide_for_video_type <?php echo ($modal_content == 'video_type') ? 'display_none' : ''; ?>">
                                    <div class="col-sm-4">
                                        <label for='ays_popup_content_padding'>
                                            <?php echo esc_html__('Content padding', "ays-popup-box"); ?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Specify the padding of the popup in pixels. It accepts only numerical values and you can choose whether to define the value by percentage or in pixels.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 ays-pb-padding-content ays_divider_left ays-pb-padding-content-default">
                                        <div class="ays_toggle_parent">
                                            <div>
                                                <div class="ays_pb_current_device_name ays_pb_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_padding_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 225px;"><?php echo esc_html__('Desktop', "ays-popup-box") ?></div>
                                                <div style="display: flex; gap: 10px">
                                                    <div style="max-width: 225px; margin-top: 2px;">
                                                        <input type="number" id="ays_popup_content_padding"  class="ays-pb-text-input ays-pb-text-input-short ays_pb_padding"  name="ays_popup_content_padding" value="<?php echo $padding; ?>"/>
                                                        <p style="font-weight: 600;" class="ays-pb-small-hint-text">
                                                            <?php echo esc_html__("Default value = ", "ays-popup-box");?>
                                                            <span class="ays-pb-padding-default-value" style="font-weight: 800;"><?php echo $default_padding_value; ?></span>
                                                        </p>
                                                    </div>
                                                    <div class="ays_pb_padding_by_percentage_px_box">
                                                        <select name="ays_popup_padding_by_percentage_px" id="ays_popup_padding_by_percentage_px" class="ays_pb_aysDropdown ays-pb-percent">
                                                            <option value="pixels" <?php echo $popup_padding_by_percentage_px == "pixels" ? "selected" : ""; ?>>
                                                                <?php echo esc_html__( "px", "ays-popup-box" ); ?>
                                                            </option>
                                                            <option value="percentage" <?php echo $popup_padding_by_percentage_px == "percentage" ? "selected" : ""; ?>>
                                                                <?php echo esc_html__( "%", "ays-popup-box" ); ?>
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ays_toggle_target ays_pb_padding_mobile_container" style=" <?php echo ( $enable_padding_mobile ) ? '' : 'display:none'; ?>">
                                                <div class="ays_pb_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 225px;"><?php echo esc_html__('Mobile', "ays-popup-box") ?></div>
                                                <div style="display: flex; gap: 10px">
                                                    <div style="max-width: 225px; margin-top: 2px;">
                                                        <input type="number" id="ays_popup_content_padding_mobile"  class="ays-pb-text-input ays-pb-text-input-short ays_pb_padding"  name="ays_popup_content_padding_mobile" value="<?php echo $padding_mobile; ?>"/>
                                                        <p style="font-weight: 600;" class="ays-pb-small-hint-text">
                                                            <?php echo esc_html__("Default value = ", "ays-popup-box");?>
                                                            <span class="ays-pb-padding-default-value" style="font-weight: 800;"><?php echo $default_padding_value; ?></span>
                                                        </p>
                                                    </div>
                                                    <div class="ays_pb_padding_by_percentage_px_box">
                                                        <select name="ays_popup_padding_by_percentage_px_mobile" id="ays_popup_padding_by_percentage_px_mobile" class="ays_pb_aysDropdown ays-pb-percent">
                                                            <option value="pixels" <?php echo $popup_padding_by_percentage_px_mobile == "pixels" ? "selected" : ""; ?>>
                                                                <?php echo esc_html__( "px", "ays-popup-box" ); ?>
                                                            </option>
                                                            <option value="percentage" <?php echo $popup_padding_by_percentage_px_mobile == "percentage" ? "selected" : ""; ?>>
                                                                <?php echo esc_html__( "%", "ays-popup-box" ); ?>
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ays_pb_mobile_settings_container">
                                                <input type="checkbox" class="ays_toggle_checkbox ays-pb-onoffswitch-checkbox" id="ays_pb_enable_padding_mobile" name="ays_pb_enable_padding_mobile" <?php echo $enable_padding_mobile ? 'checked' : '' ?>>
                                                <label for="ays_pb_enable_padding_mobile" class="<?php echo $enable_padding_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="ays-pb-accordion-options-main-container">
                            <div class="ays-pb-accordion-header">
                                <?php echo wp_kses($pb_acordion_svg_html, $allow_tags_acordion_arrow); ?>
                                <p class="ays-subtitle"><?php echo  esc_html__('Text style', "ays-popup-box") ?></p>
                            </div>
                            <hr class="ays-pb-bolder-hr"/>
                            <div class="ays-pb-accordion-body">
                                <!-- Text color start -->
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="<?php echo esc_attr($this->plugin_name); ?>-ays_pb_textcolor">
                                            <span>
                                                <?php echo  esc_html__('Text color',"ays-popup-box") ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Specify the text color written inside the popup.", "ays-popup-box"); ?>">
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 ays_divider_left">
                                        <input id="<?php echo esc_attr($this->plugin_name); ?>-ays_pb_textcolor" type="text" class="ays_pb_color_input ays_pb_textcolor_change" name="<?php echo esc_attr($this->plugin_name); ?>[ays_pb_textcolor]" value="<?php echo wp_unslash($textcolor); ?>" data-default-color="#000000" data-alpha="true">
                                    </div>
                                </div>
                                <!-- Text color end -->
                                <hr class="ays_pb_hide_for_image_type <?php echo ($modal_content == 'image_type') ? 'display_none' : ''; ?>">
                                <!-- Popup Font Family Start -->
                                <div class="form-group row ays_pb_hide_for_image_type <?php echo ($modal_content == 'image_type') ? 'display_none' : ''; ?>">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_font_family">
                                            <?php echo  esc_html__('Font family',"ays-popup-box") ?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Choose the popup text font family.", "ays-popup-box"); ?>">
                                               <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 ays_divider_left">
                                        <select id="ays_pb_font_family" class="ays_pb_aysDropdown" name="ays_pb_font_family">
                                        <?php
                                            $selected  = "";
                                            foreach ($font_families as $key => $pb_font_family) {
                                                if(is_array($pb_font_family)){
                                                    if (in_array($font_family_option,$pb_font_family)) {
                                                       $selected = "selected";
                                                    }
                                                    else{
                                                        $selected = "";
                                                    }
                                                }else{
                                                    if (isset($font_families[$font_family_option]) && $font_families[$font_family_option] ) {
                                                        $selected_font_family = $font_families[$font_family_option];
                                                    } else {
                                                        $selected_font_family = $font_family_option;
                                                    }
        
                                                    if($pb_font_family == $selected_font_family){
                                                        $selected = "selected";
                                                    }else{
                                                        $selected = "";
                                                    }
                                                }
                                        ?>
                                            <option value="<?php echo $key ;?>" <?php echo $selected ;?>>
                                                <?php echo $pb_font_family; ?>
                                            </option>
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- Popup Font Family End -->
                                <hr class="ays_pb_hide_for_image_type ays_pb_hide_for_notification_type <?php echo ($modal_content == 'image_type' || $modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                                <!-- Font Size start -->
                                <div class="form-group row ays_pb_hide_for_image_type ays_pb_hide_for_notification_type <?php echo ($modal_content == 'image_type' || $modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_font_size">
                                            <?php echo  esc_html__('Description font size',"ays-popup-box") ?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Define the font size of the popup description in pixels.", "ays-popup-box"); ?>">
                                               <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 ays_divider_left">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for="ays_pb_font_size_for_pc">
                                                    <?php echo  esc_html__('On desktop',"ays-popup-box") ?>  
                                                        <a class="ays_help" data-toggle="tooltip" title="" data-original-title="Define the font size for desktop devices.">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="number" id="ays_pb_font_size_for_pc" class="ays-pb-text-input ays-pb-text-input-short" name="ays_pb_font_size" value="<?php echo $pb_font_size;?>"/>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for="ays_pb_font_size_for_mobile">
                                                    <?php echo  esc_html__('On mobile',"ays-popup-box") ?>  
                                                        <a class="ays_help" data-toggle="tooltip" title="" data-original-title="Define the font size for mobile devices.">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="number" id="ays_pb_font_size_for_mobile" class="ays-pb-text-input ays-pb-text-input-short" name="ays_pb_font_size_for_mobile" value="<?php echo $pb_font_size_for_mobile;?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Font Size end -->
                                <hr class="ays_pb_hide_for_image_type ays_pb_hide_for_notification_type <?php echo ($modal_content == 'image_type' || $modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                                <!-- Description Alignment start -->
                                <div class="form-group row ays_pb_hide_for_image_type ays_pb_hide_for_notification_type <?php echo ($modal_content == 'image_type' || $modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_description_alignment">
                                            <?php echo  esc_html__('Description alignment',"ays-popup-box") ?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Define the alignment of the popup description.", "ays-popup-box"); ?>">
                                               <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 ays_divider_left">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for="ays_pb_description_alignment_for_pc">
                                                    <?php echo  esc_html__('On desktop',"ays-popup-box") ?>  
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Define the description alignment for desktop devices.', 'ays-popup-box'); ?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select id="ays_pb_description_alignment_for_pc" class="ays-pb-text-input ays-pb-text-input-short" name="ays_pb_description_alignment_for_pc">
                                                    <option value="left" <?php echo $pb_text_align == 'left' ? 'selected' : ''; ?>><?php echo esc_html__('Left', 'ays-popup-box');  ?></option>
                                                    <option value="center" <?php echo $pb_text_align == 'center' ? 'selected' : ''; ?>  ><?php echo esc_html__('Center', 'ays-popup-box'); ?></option>
                                                    <option value="right" <?php echo $pb_text_align == 'right' ? 'selected' : ''; ?>><?php  echo esc_html__('Right', 'ays-popup-box'); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for="ays_pb_description_alignment_for_mobile">
                                                    <?php echo  esc_html__('On mobile',"ays-popup-box") ?>  
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Define the description alignment for mobile devices.', 'ays-popup-box'); ?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select id="ays_pb_description_alignment_for_mobile" class="ays-pb-text-input ays-pb-text-input-short" name="ays_pb_description_alignment_for_mobile">
                                                    <option value="left" <?php echo $pb_text_align_mobile == 'left' ? 'selected' : ''; ?>><?php echo esc_html__('Left', 'ays-popup-box'); ?></option>
                                                    <option value="center" <?php echo $pb_text_align_mobile == 'center' ? 'selected' : ''; ?>><?php echo esc_html__('Center', 'ays-popup-box'); ?></option>
                                                    <option value="right" <?php echo $pb_text_align_mobile == 'right' ? 'selected' : ''; ?>><?php echo esc_html__('Right', 'ays-popup-box'); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Description Alignment end -->
                                <hr class="ays_pb_hide_for_image_type ays_pb_hide_for_notification_type <?php echo ($modal_content == 'image_type' || $modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                                <!-- title styles start -->
                                <!-- title text shadow start -->
                                <div class="form-group row ays_pb_hide_for_image_type ays_pb_hide_for_notification_type <?php echo ($modal_content == 'image_type' || $modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                                    <div class="col-sm-4">
                                        <label for="ays_enable_title_text_shadow">
                                            <?php echo esc_html__('Title text shadow',"ays-popup-box")?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Add text shadow to the popup title.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                            <span style="<?php if($show_popup_title == 'On'){ echo 'display:none';} else { echo '';} ?>" class="ays-pb-small-hint-text ays-pb-title-shadow-small-hint"><?php echo esc_html__("This option is not available currently as the Show title Option is disable.", "ays-popup-box");?></span>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 ays_divider_left ays-pb-title-shadow">
                                        <div class="ays_toggle_slide_mobile_option_container">
                                            <div class="form-group row" style="align-items: center;">
                                                <div class="col-sm-3">
                                                    <label for="ays_enable_title_text_shadow">
                                                        <?php echo  esc_html__('On desktop',"ays-popup-box") ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Define the title text shadow for desktop devices.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="checkbox" class="ays_toggle ays_toggle_slide ays_toggle_slide_mobile_option" id="ays_enable_title_text_shadow" name="ays_enable_title_text_shadow" <?php echo ($enable_pb_title_text_shadow) ? 'checked' : ''; ?>/>
                                                    <label for="ays_enable_title_text_shadow" class="ays_switch_toggle">Toggle</label>
                                                </div>
                                            </div>
                                            <div class="row ays_toggle_target" style="margin: 10px 0 0 0; padding-top: 10px; <?php echo ($enable_pb_title_text_shadow) ? '' : 'display:none;' ?>">
                                                <div class="col-sm-12 ays_divider_top" style="margin-top: 10px; padding-top: 15px; padding-bottom: 15px;">
                                                    <label for='ays_title_text_shadow_color'>
                                                        <?php echo esc_html__('Color', "ays-popup-box"); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Specify text shadow color.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                    <input type="text" class="ays-text-input" id='ays_title_text_shadow_color' data-alpha="true" name='ays_title_text_shadow_color' value="<?php echo $pb_title_text_shadow; ?>"/>
                                                </div>
                                                <hr class="ays_toggle_target" style="<?= $enable_pb_title_text_shadow ? '' : 'display:none'; ?>">
                                                <div class="form-group row ays_toggle_target" style="<?= $enable_pb_title_text_shadow ? '' : 'display:none' ?>">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-3" style="display: inline-block;">
                                                            <span class="ays_pb_small_hint_text"><?php echo esc_html__('X', "ays-popup-box"); ?></span>
                                                            <input type="number" class="ays-text-input ays-text-input-90-width ays-box-shadow-coord-change" id='ays_pb_title_text_shadow_x_offset' name='ays_pb_title_text_shadow_x_offset' value="<?php echo $pb_title_text_shadow_x_offset; ?>" />
                                                        </div>
                                                        <div class="col-sm-3 ays_divider_left" style="display: inline-block;">
                                                            <span class="ays_pb_small_hint_text"><?php echo esc_html__('Y', "ays-popup-box"); ?></span>
                                                            <input type="number" class="ays-text-input ays-text-input-90-width ays-box-shadow-coord-change" id='ays_pb_title_text_shadow_y_offset' name='ays_pb_title_text_shadow_y_offset' value="<?php echo $pb_title_text_shadow_y_offset; ?>" />
                                                        </div>
                                                        <div class="col-sm-3 ays_divider_left" style="display: inline-block;">
                                                            <span class="ays_pb_small_hint_text"><?php echo esc_html__('Z', "ays-popup-box"); ?></span>
                                                            <input type="number" class="ays-text-input ays-text-input-90-width ays-box-shadow-coord-change" id='ays_pb_title_text_shadow_z_offset' name='ays_pb_title_text_shadow_z_offset' value="<?php echo $pb_title_text_shadow_z_offset; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="ays_toggle_slide_mobile_option_container">
                                            <div class="form-group row" style="align-items: center;">
                                                <div class="col-sm-3">
                                                    <label for="ays_enable_title_text_shadow_mobile">
                                                        <?php echo  esc_html__('On Mobile',"ays-popup-box") ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Define the title text shadow for mobile devices.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="checkbox" class="ays_toggle ays_toggle_slide ays_toggle_slide_mobile_option" id="ays_enable_title_text_shadow_mobile" name="ays_enable_title_text_shadow_mobile" <?php echo ($enable_pb_title_text_shadow_mobile) ? 'checked' : ''; ?>/>
                                                    <label for="ays_enable_title_text_shadow_mobile" class="ays_switch_toggle">Toggle</label>
                                                </div>
                                            </div>
                                            <div class="row ays_toggle_target" style="margin: 10px 0 0 0; padding-top: 10px; <?php echo ($enable_pb_title_text_shadow_mobile) ? '' : 'display:none;' ?>">
                                                <div class="col-sm-12 ays_divider_top" style="margin-top: 10px; padding-top: 15px; padding-bottom: 15px;">
                                                    <label for='ays_title_text_shadow_color_mobile'>
                                                        <?php echo esc_html__('Color', "ays-popup-box"); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Specify text shadow color.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                    <input type="text" class="ays-text-input" id='ays_title_text_shadow_color_mobile' data-alpha="true" name='ays_title_text_shadow_color_mobile' value="<?php echo $pb_title_text_shadow_mobile; ?>"/>
                                                </div>
                                                <hr class="ays_toggle_target" style="<?= $enable_pb_title_text_shadow_mobile ? '' : 'display:none'; ?>">
                                                <div class="form-group row ays_toggle_target" style="<?= $enable_pb_title_text_shadow_mobile ? '' : 'display:none' ?>">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-3" style="display: inline-block;">
                                                            <span class="ays_pb_small_hint_text"><?php echo esc_html__('X', "ays-popup-box"); ?></span>
                                                            <input type="number" class="ays-text-input ays-text-input-90-width ays-box-shadow-coord-change" id='ays_pb_title_text_shadow_x_offset_mobile' name='ays_pb_title_text_shadow_x_offset_mobile' value="<?php echo $pb_title_text_shadow_x_offset_mobile; ?>" />
                                                        </div>
                                                        <div class="col-sm-3 ays_divider_left" style="display: inline-block;">
                                                            <span class="ays_pb_small_hint_text"><?php echo esc_html__('Y', "ays-popup-box"); ?></span>
                                                            <input type="number" class="ays-text-input ays-text-input-90-width ays-box-shadow-coord-change" id='ays_pb_title_text_shadow_y_offset_mobile' name='ays_pb_title_text_shadow_y_offset_mobile' value="<?php echo $pb_title_text_shadow_y_offset_mobile; ?>" />
                                                        </div>
                                                        <div class="col-sm-3 ays_divider_left" style="display: inline-block;">
                                                            <span class="ays_pb_small_hint_text"><?php echo esc_html__('Z', "ays-popup-box"); ?></span>
                                                            <input type="number" class="ays-text-input ays-text-input-90-width ays-box-shadow-coord-change" id='ays_pb_title_text_shadow_z_offset_mobile' name='ays_pb_title_text_shadow_z_offset_mobile' value="<?php echo $pb_title_text_shadow_z_offset_mobile; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- title text shadow end -->
                                <hr class="ays_pb_hide_for_image_type <?php echo ($modal_content == 'image_type') ? 'display_none' : ''; ?>">
                                <div class="col-sm-12 ays-pro-features-v2-main-box ays_pb_hide_for_image_type <?php echo ($modal_content == 'image_type') ? 'display_none' : ''; ?>">
                                    <div class="ays-pro-features-v2-big-buttons-box-main-container">
                                        <div class="ays-pro-features-v2-big-buttons-box">
                                            <a href="https://popup-plugin.com/" target="_blank" class="ays-pro-features-v2-upgrade-button">
                                                <div class="ays-pro-features-v2-upgrade-icon" style="background-image: url('<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg');" data-img-src="<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg"></div>
                                                <div class="ays-pro-features-v2-upgrade-text">
                                                    <?php echo esc_html__("Upgrade" , "ays-popup-box"); ?>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ays-pro-features-v2-small-buttons-box">
                                        <a href="https://popup-plugin.com/" target="_blank" class="ays-pro-features-v2-upgrade-button">
                                            <div class="ays-pro-features-v2-upgrade-icon" style="background-image: url('<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg');" data-img-src="<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg"></div>
                                            <div class="ays-pro-features-v2-upgrade-text">
                                                <?php echo esc_html__("Upgrade" , "ays-popup-box"); ?>
                                            </div>
                                        </a>
                                    </div>                        
                                    <div class="form-group row" style="padding: 10px 0; margin:0px;">
                                        <div class="col-sm-3">
                                            <label for="ays_enable_title_styles">
                                                <?php echo esc_html__('Title style',"ays-popup-box")?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Enable the option to customize the style of the popup title.',"ays-popup-box");?>">
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-7 ays_divider_left">
                                            <input type="checkbox" class="ays_toggle ays_toggle_slide" id="ays_enable_title_styles"
                                                name="enable_title_styles" checked>
                                            <label for="ays_enable_title_styles" class="ays_switch_toggle">Toggle</label>
                                            <div class="row ays_toggle_target ays_pb_pro_feature" style="margin: 10px 0 0 0; padding-top: 10px;">
                                                <div class="col-sm-12 ays_divider_top row" style="margin-top: 10px; padding-top: 10px;">
                                                    <div class="col-sm-5">
                                                        <label for='ays_title_font_family'>
                                                            <?php echo esc_html__('Font family', "ays-popup-box"); ?>
                                                            <a class="ays_help ays-pb-help-pro" data-toggle="tooltip" title="<?php echo esc_html__('Choose your preferred font family from the suggested variants for the popup title.',"ays-popup-box")?>">
                                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                            </a>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-7 ays_divider_left">
                                                        <select name="title_font_family" id="ays_title_font_family" class="ays-text-input-max-width-100 ays_pb_aysDropdown">
                                                            <option>
                                                                <?php echo esc_html__('Arial', "ays-popup-box"); ?>
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 ays_divider_top row" style="margin-top: 10px; padding-top: 10px;">
                                                    <div class="col-sm-5">
                                                        <label for='ays_title_font_weight'>
                                                            <?php echo esc_html__('Font weight', "ays-popup-box"); ?>
                                                            <a class="ays_help ays-pb-help-pro" data-toggle="tooltip" title="<?php echo esc_html__('Define the boldness of the popup title.',"ays-popup-box")?>">
                                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                            </a>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-7 ays_divider_left">
                                                        <select name="title_font_weight" id="ays_title_font_weight" class="ays-text-input-max-width-100 ays_pb_aysDropdown">
                                                            <option>
                                                                <?php echo esc_html__('Normal', "ays-popup-box"); ?>
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 ays_divider_top row" style="margin-top: 10px; padding-top: 10px;">
                                                    <div class="col-sm-5">
                                                        <label for='ays_title_font_size'>
                                                            <?php echo esc_html__('Font size(px)', "ays-popup-box"); ?>
                                                            <a class="ays_help ays-pb-help-pro" data-toggle="tooltip" title="<?php echo esc_html__('Define the font size of the popup title in pixels.',"ays-popup-box")?>">
                                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                            </a>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-7 ays_divider_left">
                                                        <input type="number" id="ays_title_font_size" name="title_font_size" class="ays-text-input-max-width-100"> 
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 ays_divider_top row" style="margin-top: 10px; padding-top: 10px;">
                                                    <div class="col-sm-5">
                                                        <label for='ays_title_letter_spacing'>
                                                            <?php echo esc_html__('Letter spacing(px)', "ays-popup-box"); ?>
                                                            <a class="ays_help ays-pb-help-pro" data-toggle="tooltip" title="<?php echo esc_html__('Define the space between characters in a text of the popup title in pixels.',"ays-popup-box")?>">
                                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                            </a>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-7 ays_divider_left">
                                                        <input type="number" id="ays_title_letter_spacing" name="title_letter_spacing" class="ays-text-input-max-width-100"> 
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 ays_divider_top row" style="margin-top: 10px; padding-top: 10px;">
                                                    <div class="col-sm-5">
                                                        <label for='ays_title_line_height'>
                                                            <?php echo esc_html__('Line height', "ays-popup-box"); ?>
                                                            <a class="ays_help ays-pb-help-pro" data-toggle="tooltip" title="<?php echo esc_html__('Define the height of a line of the popup title.',"ays-popup-box")?>">
                                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                            </a>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-7 ays_divider_left">
                                                        <input type="number" id="ays_title_line_height" name="title_line_height" class="ays-text-input-max-width-100"> 
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 ays_divider_top row" style="margin-top: 10px; padding-top: 10px;">
                                                    <div class="col-sm-5">
                                                        <label for='ays_title_text_alignment'>
                                                            <?php echo esc_html__('Text alignment', "ays-popup-box"); ?>
                                                            <a class="ays_help ays-pb-help-pro" data-toggle="tooltip" title="<?php echo esc_html__('Choose the horizontal alignment of the text of the popup title.',"ays-popup-box")?>">
                                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                            </a>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-7 ays_divider_left">
                                                        <select name="title_text_alignment" id="ays_title_text_alignment" class="ays-text-input-max-width-100 ays_pb_aysDropdown">
                                                            <option>
                                                                <?php echo esc_html__('Center', "ays-popup-box"); ?>
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 ays_divider_top row" style="margin-top: 10px; padding-top: 10px;">
                                                    <div class="col-sm-5">
                                                        <label for='ays_title_text_transform'>
                                                            <?php echo esc_html__('Text transform', "ays-popup-box"); ?>
                                                            <a class="ays_help ays-pb-help-pro" data-toggle="tooltip" data-html="true" title="<?php echo "<p>" .
                                                            esc_html__('Choose the capitalization of the text of the popup title. ', "ays-popup-box" ) . " </p> 
                                                            <p style='text-indent:10px;margin:0;'> " .
                                                            esc_html__(' None - No capitalization. The text renders as it is.', "ays-popup-box" ) ." </p> 
                                                            <p style='text-indent:10px;margin:0;'> " .
                                                            esc_html__( 'Capitalize - Transforms the first character of each word to uppercase.', "ays-popup-box" ). " </p> 
                                                            <p style='text-indent:10px;margin:0;'> " .
                                                                esc_html__('Uppercase - Transforms all characters to uppercase.', "ays-popup-box" )." </p> 
                                                                <p style='text-indent:10px;margin:0;'> " .
                                                            esc_html__(' Lowercase - Transforms all characters to lowercase.',"ays-popup-box"). "</p>" ?>" 
                    
                                                            >
                                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                            </a>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-7 ays_divider_left">
                                                        <select name="title_text_transform" id="ays_title_text_transform" class="ays-text-input-max-width-100 ays_pb_aysDropdown">
                                                            <option>
                                                                <?php echo esc_html__('None', "ays-popup-box"); ?>
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 ays_divider_top row" style="margin-top: 10px; padding-top: 10px;">
                                                    <div class="col-sm-5">
                                                        <label for='ays_title_text_transform'>
                                                            <?php echo esc_html__('Text decoration', "ays-popup-box"); ?>
                                                            <a class="ays_help ays-pb-help-pro" data-toggle="tooltip" title="<?php echo esc_html__('Choose the kind of decoration added to text of the popup title.',"ays-popup-box")?>">
                                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                            </a>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-7 ays_divider_left">
                                                        <select name="title_text_decoration" id="ays_title_text_decoration" class="ays-text-input-max-width-100 ays_pb_aysDropdown">
                                                            <option>
                                                                <?php echo esc_html__('None', "ays-popup-box"); ?>
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- title styles end -->
                                <hr class="ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>"> 
                            </div>
                        </div>
                        <div class="ays-pb-accordion-options-main-container">
                            <div class="ays-pb-accordion-header ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                                <?php echo wp_kses($pb_acordion_svg_html, $allow_tags_acordion_arrow); ?>
                                <p class="ays-subtitle"><?php echo  esc_html__('Opening and Closing effects', "ays-popup-box") ?></p>
                            </div>
                            <hr class="ays-pb-bolder-hr ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>"/>
                            <div class="ays-pb-accordion-body ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                                <div class="form-group row ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                                    <div class="col-sm-4">
                                        <label for="<?php echo esc_attr($this->plugin_name); ?>-animate_in">
                                            <span>
                                                <?php echo  esc_html__('Opening animation',"ays-popup-box") ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Choose the entry effect for the popup opening.", "ays-popup-box"); ?>">
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 ays_divider_left">
                                        <div class="ays_toggle_parent">
                                            <div>
                                                <div class="ays_pb_current_device_name ays_pb_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_animate_in_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 225px;"><?php echo esc_html__('Desktop', "ays-popup-box") ?></div>
                                                <select id="<?php echo esc_attr($this->plugin_name); ?>-animate_in" class="ays-pb-text-input ays-pb-text-input-short ays_pb_aysDropdown" name="<?php echo esc_attr($this->plugin_name); ?>[animate_in]">
                                                    <optgroup label="Fading Entrances">
                                                        <option <?php echo 'fadeIn' == $animate_in ? 'selected' : ''; ?> value="fadeIn">Fade In</option>
                                                        <option <?php echo 'fadeInDown' == $animate_in ? 'selected' : ''; ?> value="fadeInDown">Fade In Down</option>
                                                        <option <?php echo 'fadeInDownBig' == $animate_in ? 'selected' : ''; ?> value="fadeInDownBig">Fade In Down Big</option>
                                                        <option <?php echo 'fadeInLeft' == $animate_in ? 'selected' : ''; ?> value="fadeInLeft">Fade In Left</option>
                                                        <option <?php echo 'fadeInLeftBig' == $animate_in ? 'selected' : ''; ?> value="fadeInLeftBig">Fade In Left Big</option>
                                                        <option <?php echo 'fadeInRight' == $animate_in ? 'selected' : ''; ?> value="fadeInRight">Fade In Right</option>
                                                        <option <?php echo 'fadeInRightBig' == $animate_in ? 'selected' : ''; ?> value="fadeInRightBig">Fade In Right Big</option>
                                                        <option <?php echo 'fadeInUp' == $animate_in ? 'selected' : ''; ?> value="fadeInUp">Fade In Up</option>
                                                        <option <?php echo 'fadeInUpBig' == $animate_in ? 'selected' : ''; ?> value="fadeInUpBig">Fade In Up Big</option>
                                                    </optgroup>
                                                    <optgroup label="Bouncing Entrances">
                                                        <option <?php echo 'bounceIn' == $animate_in ? 'selected' : ''; ?> value="bounceIn">Bounce In</option>
                                                        <option <?php echo 'bounceInDown' == $animate_in ? 'selected' : ''; ?> value="bounceInDown">Bounce In Down</option>
                                                        <option <?php echo 'bounceInLeft' == $animate_in ? 'selected' : ''; ?> value="bounceInLeft">Bounce In Left</option>
                                                        <option <?php echo 'bounceInRight' == $animate_in ? 'selected' : ''; ?> value="bounceInRight">Bounce In Right</option>
                                                        <option <?php echo 'bounceInUp' == $animate_in ? 'selected' : ''; ?> value="bounceInUp">Bounce In Up</option>
                                                    </optgroup>
                                                    <optgroup label="Sliding Entrances">
                                                        <option <?php echo 'slideInUp' == $animate_in ? 'selected' : ''; ?> value="slideInUp">Slide In Up</option>
                                                        <option <?php echo 'slideInDown' == $animate_in ? 'selected' : ''; ?> value="slideInDown">Slide In Down</option>
                                                        <option <?php echo 'slideInLeft' == $animate_in ? 'selected' : ''; ?> value="slideInLeft">Slide In Left</option>
                                                        <option <?php echo 'slideInRight' == $animate_in ? 'selected' : ''; ?> value="slideInRight">Slide In Right</option>
                                                    </optgroup>
                                                    <optgroup label="Zoom Entrances">
                                                        <option <?php echo 'zoomIn' == $animate_in ? 'selected' : ''; ?> value="zoomIn">Zoom In</option>
                                                        <option <?php echo 'zoomInDown' == $animate_in ? 'selected' : ''; ?> value="zoomInDown">Zoom In Down</option>
                                                        <option <?php echo 'zoomInLeft' == $animate_in ? 'selected' : ''; ?> value="zoomInLeft">Zoom In Left</option>
                                                        <option <?php echo 'zoomInRight' == $animate_in ? 'selected' : ''; ?> value="zoomInRight">Zoom In Right</option>
                                                        <option <?php echo 'zoomInUp' == $animate_in ? 'selected' : ''; ?> value="zoomInUp">Zoom In Up</option>
                                                    </optgroup>
                                                    <optgroup label="Rotating Entrances">
                                                        <option <?php echo 'rotateIn' == $animate_in ? 'selected' : ''; ?> value="rotateIn">Rotating In</option>
                                                        <option <?php echo 'rotateInDownLeft' == $animate_in ? 'selected' : ''; ?> value="rotateInDownLeft">Rotating In Down Left</option>
                                                        <option <?php echo 'rotateInDownRight' == $animate_in ? 'selected' : ''; ?> value="rotateInDownRight">Rotating In Down Right</option>
                                                        <option <?php echo 'rotateInUpLeft' == $animate_in ? 'selected' : ''; ?> value="rotateInUpLeft">Rotating In Up Left</option>
                                                        <option <?php echo 'rotateInUpRight' == $animate_in ? 'selected' : ''; ?> value="rotateInUpRight">Rotating In Up Right</option>
                                                    </optgroup>
                                                    <optgroup label="Fliping Entrances">
                                                        <option <?php echo 'flipInY' == $animate_in ? 'selected' : ''; ?> value="flipInY">Flip In Y</option>
                                                        <option <?php echo 'flipInX' == $animate_in ? 'selected' : ''; ?> value="flipInX">Flip In X</option>
                                                    </optgroup>
                                                    <option <?php echo  $animate_in == 'none' ? 'selected' : ''; ?> value="none">None</option>
                                                </select>
                                            </div>
                                            <div class="ays_toggle_target ays_pb_animate_in_mobile_container" style=" <?php echo ( $enable_animate_in_mobile ) ? '' : 'display:none'; ?>">
                                                <hr>
                                                <div class="ays_pb_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 225px;"><?php echo esc_html__('Mobile', "ays-popup-box") ?></div>
                                                <select id="<?php echo esc_attr($this->plugin_name); ?>-animate_in_mobile" class="ays-pb-text-input ays-pb-text-input-short ays_pb_aysDropdown" name="ays_pb_animate_in_mobile">
                                                    <optgroup label="Fading Entrances">
                                                        <option <?php echo 'fadeIn' == $animate_in_mobile ? 'selected' : ''; ?> value="fadeIn">Fade In</option>
                                                        <option <?php echo 'fadeInDown' == $animate_in_mobile ? 'selected' : ''; ?> value="fadeInDown">Fade In Down</option>
                                                        <option <?php echo 'fadeInDownBig' == $animate_in_mobile ? 'selected' : ''; ?> value="fadeInDownBig">Fade In Down Big</option>
                                                        <option <?php echo 'fadeInLeft' == $animate_in_mobile ? 'selected' : ''; ?> value="fadeInLeft">Fade In Left</option>
                                                        <option <?php echo 'fadeInLeftBig' == $animate_in_mobile ? 'selected' : ''; ?> value="fadeInLeftBig">Fade In Left Big</option>
                                                        <option <?php echo 'fadeInRight' == $animate_in_mobile ? 'selected' : ''; ?> value="fadeInRight">Fade In Right</option>
                                                        <option <?php echo 'fadeInRightBig' == $animate_in_mobile ? 'selected' : ''; ?> value="fadeInRightBig">Fade In Right Big</option>
                                                        <option <?php echo 'fadeInUp' == $animate_in_mobile ? 'selected' : ''; ?> value="fadeInUp">Fade In Up</option>
                                                        <option <?php echo 'fadeInUpBig' == $animate_in_mobile ? 'selected' : ''; ?> value="fadeInUpBig">Fade In Up Big</option>
                                                    </optgroup>
                                                    <optgroup label="Bouncing Entrances">
                                                        <option <?php echo 'bounceIn' == $animate_in_mobile ? 'selected' : ''; ?> value="bounceIn">Bounce In</option>
                                                        <option <?php echo 'bounceInDown' == $animate_in_mobile ? 'selected' : ''; ?> value="bounceInDown">Bounce In Down</option>
                                                        <option <?php echo 'bounceInLeft' == $animate_in_mobile ? 'selected' : ''; ?> value="bounceInLeft">Bounce In Left</option>
                                                        <option <?php echo 'bounceInRight' == $animate_in_mobile ? 'selected' : ''; ?> value="bounceInRight">Bounce In Right</option>
                                                        <option <?php echo 'bounceInUp' == $animate_in_mobile ? 'selected' : ''; ?> value="bounceInUp">Bounce In Up</option>
                                                    </optgroup>
                                                    <optgroup label="Sliding Entrances">
                                                        <option <?php echo 'slideInUp' == $animate_in_mobile ? 'selected' : ''; ?> value="slideInUp">Slide In Up</option>
                                                        <option <?php echo 'slideInDown' == $animate_in_mobile ? 'selected' : ''; ?> value="slideInDown">Slide In Down</option>
                                                        <option <?php echo 'slideInLeft' == $animate_in_mobile ? 'selected' : ''; ?> value="slideInLeft">Slide In Left</option>
                                                        <option <?php echo 'slideInRight' == $animate_in_mobile ? 'selected' : ''; ?> value="slideInRight">Slide In Right</option>
                                                    </optgroup>
                                                    <optgroup label="Zoom Entrances">
                                                        <option <?php echo 'zoomIn' == $animate_in_mobile ? 'selected' : ''; ?> value="zoomIn">Zoom In</option>
                                                        <option <?php echo 'zoomInDown' == $animate_in_mobile ? 'selected' : ''; ?> value="zoomInDown">Zoom In Down</option>
                                                        <option <?php echo 'zoomInLeft' == $animate_in_mobile ? 'selected' : ''; ?> value="zoomInLeft">Zoom In Left</option>
                                                        <option <?php echo 'zoomInRight' == $animate_in_mobile ? 'selected' : ''; ?> value="zoomInRight">Zoom In Right</option>
                                                        <option <?php echo 'zoomInUp' == $animate_in_mobile ? 'selected' : ''; ?> value="zoomInUp">Zoom In Up</option>
                                                    </optgroup>
                                                    <optgroup label="Rotating Entrances">
                                                        <option <?php echo 'rotateIn' == $animate_in_mobile ? 'selected' : ''; ?> value="rotateIn">Rotating In</option>
                                                        <option <?php echo 'rotateInDownLeft' == $animate_in_mobile ? 'selected' : ''; ?> value="rotateInDownLeft">Rotating In Down Left</option>
                                                        <option <?php echo 'rotateInDownRight' == $animate_in_mobile ? 'selected' : ''; ?> value="rotateInDownRight">Rotating In Down Right</option>
                                                        <option <?php echo 'rotateInUpLeft' == $animate_in_mobile ? 'selected' : ''; ?> value="rotateInUpLeft">Rotating In Up Left</option>
                                                        <option <?php echo 'rotateInUpRight' == $animate_in_mobile ? 'selected' : ''; ?> value="rotateInUpRight">Rotating In Up Right</option>
                                                    </optgroup>
                                                    <optgroup label="Fliping Entrances">
                                                        <option <?php echo 'flipInY' == $animate_in_mobile ? 'selected' : ''; ?> value="flipInY">Flip In Y</option>
                                                        <option <?php echo 'flipInX' == $animate_in_mobile ? 'selected' : ''; ?> value="flipInX">Flip In X</option>
                                                    </optgroup>
                                                    <option <?php echo  $animate_in_mobile == 'none' ? 'selected' : ''; ?> value="none">None</option>
                                                </select>
                                            </div>
                                            <div class="ays_pb_mobile_settings_container">
                                                <input type="checkbox" class="ays_toggle_checkbox ays-pb-onoffswitch-checkbox" id="ays_pb_enable_animate_in_mobile" name="ays_pb_enable_animate_in_mobile" <?php echo $enable_animate_in_mobile ? 'checked' : '' ?>>
                                                <label for="ays_pb_enable_animate_in_mobile" class="<?php echo $enable_animate_in_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                                <div class="form-group row ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                                    <div class="col-sm-4">
                                        <label for="<?php echo esc_attr($this->plugin_name); ?>-animate_out">
                                            <span>
                                                <?php echo  esc_html__('Closing animation',"ays-popup-box") ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Choose the exit effect for the popup closing.", "ays-popup-box"); ?>">
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 ays_divider_left">
                                        <div class="ays_toggle_parent">
                                            <div>
                                                <div class="ays_pb_current_device_name ays_pb_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_animate_out_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 225px;"><?php echo esc_html__('Desktop', "ays-popup-box") ?></div>
                                                <select id="<?php echo esc_attr($this->plugin_name); ?>-animate_out" class="ays-pb-text-input ays-pb-text-input-short ays_pb_aysDropdown" name="<?php echo esc_attr($this->plugin_name); ?>[animate_out]">
                                                    <optgroup label="Fading Exits">
                                                        <option <?php echo  $animate_out == 'fadeOut' ? 'selected' : ''; ?> value="fadeOut">Fade Out</option>
                                                        <option <?php echo  $animate_out == 'fadeOutDown' ? 'selected' : ''; ?> value="fadeOutDown">Fade Out Down</option>
                                                        <option <?php echo  $animate_out == 'fadeOutDownBig' ? 'selected' : ''; ?> value="fadeOutDownBig">Fade Out Down Big</option>
                                                        <option <?php echo  $animate_out == 'fadeOutLeft' ? 'selected' : ''; ?> value="fadeOutLeft">Fade Out Left</option>
                                                        <option <?php echo  $animate_out == 'fadeOutLeftBig' ? 'selected' : ''; ?> value="fadeOutLeftBig">Fade Out Left Big</option>
                                                        <option <?php echo  $animate_out == 'fadeOutRight' ? 'selected' : ''; ?> value="fadeOutRight">Fade Out Right</option>
                                                        <option <?php echo  $animate_out == 'fadeOutRightBig' ? 'selected' : ''; ?> value="fadeOutRightBig">Fade Out Right Big</option>
                                                        <option <?php echo  $animate_out == 'fadeOutUp' ? 'selected' : ''; ?> value="fadeOutUp">Fade Out Up</option>
                                                        <option <?php echo  $animate_out == 'fadeOutUpBig' ? 'selected' : ''; ?> value="fadeOutUpBig">Fade Out Up Big</option>
                                                    </optgroup>
                                                    <optgroup label="Bouncing Exits">
                                                        <option <?php echo 'bounceOut' == $animate_out ? 'selected' : ''; ?> value="bounceOut">Bounce Out</option>
                                                        <option <?php echo 'bounceOutDown' == $animate_out ? 'selected' : ''; ?> value="bounceOutDown">Bounce Out Down</option>
                                                        <option <?php echo 'bounceOutLeft' == $animate_out ? 'selected' : ''; ?> value="bounceOutLeft">Bounce Out Left</option>
                                                        <option <?php echo 'bounceOutRight' == $animate_out ? 'selected' : ''; ?> value="bounceOutRight">Bounce Out Right</option>
                                                        <option <?php echo 'bounceOutUp' == $animate_out ? 'selected' : ''; ?> value="bounceOutUp">Bounce Out Up</option>
                                                    </optgroup>
                                                    <optgroup label="Sliding Exits">
                                                        <option <?php echo 'slideOutUp' == $animate_out ? 'selected' : ''; ?> value="slideOutUp">Slide Out Up</option>
                                                        <option <?php echo 'slideOutDown' == $animate_out ? 'selected' : ''; ?> value="slideOutDown">Slide Out Down</option>
                                                        <option <?php echo 'slideOutLeft' == $animate_out ? 'selected' : ''; ?> value="slideOutLeft">Slide Out Left</option>
                                                        <option <?php echo 'slideOutRight' == $animate_out ? 'selected' : ''; ?> value="slideOutRight">Slide Out Right</option>
                                                    </optgroup>
                                                    <optgroup label="Zoom Exits">
                                                        <option <?php echo 'zoomOut' == $animate_out ? 'selected' : ''; ?> value="zoomOut">Zoom Out</option>
                                                        <option <?php echo 'zoomOutDown' == $animate_out ? 'selected' : ''; ?> value="zoomOutDown">Zoom Out Down</option>
                                                        <option <?php echo 'zoomOutLeft' == $animate_out ? 'selected' : ''; ?> value="zoomOutLeft">Zoom Out Left</option>
                                                        <option <?php echo 'zoomOutRight' == $animate_out ? 'selected' : ''; ?> value="zoomOutRight">Zoom Out Right</option>
                                                        <option <?php echo 'zoomOutUp' == $animate_out ? 'selected' : ''; ?> value="zoomOutUp">Zoom Out Up</option>
                                                    </optgroup>
                                                    <optgroup label="Rotating Exits">
                                                        <option <?php echo 'rotateOut' == $animate_out ? 'selected' : ''; ?> value="rotateOut">Rotating Out</option>
                                                        <option <?php echo 'rotateOutDownLeft' == $animate_out ? 'selected' : ''; ?> value="rotateOutDownLeft">Rotating Out Down Left</option>
                                                        <option <?php echo 'rotateOutDownRight' == $animate_out ? 'selected' : ''; ?> value="rotateOutDownRight">Rotating Out Down Right</option>
                                                        <option <?php echo 'rotateOutUpLeft' == $animate_out ? 'selected' : ''; ?> value="rotateOutUpLeft">Rotating Out Up Left</option>
                                                        <option <?php echo 'rotateOutUpRight' == $animate_out ? 'selected' : ''; ?> value="rotateOutUpRight">Rotating Out Up Right</option>
                                                    </optgroup>
                                                    <optgroup label="Fliping Exits">
                                                        <option <?php echo 'flipOutY' == $animate_out ? 'selected' : ''; ?> value="flipOutY">Flip Out Y</option>
                                                        <option <?php echo 'flipOutX' == $animate_out ? 'selected' : ''; ?> value="flipOutX">Flip Out X</option>
                                                    </optgroup>
                                                    <option <?php echo  $animate_out == 'none' ? 'selected' : ''; ?> value="none">None</option>
                                                </select>
                                            </div>
                                            <div class="ays_toggle_target ays_pb_animate_out_mobile_container" style=" <?php echo ( $enable_animate_out_mobile ) ? '' : 'display:none'; ?>">
                                                <hr>
                                                <div class="ays_pb_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 225px;"><?php echo esc_html__('Mobile', "ays-popup-box") ?></div>
                                                <select id="<?php echo esc_attr($this->plugin_name); ?>-animate_out_mobile" class="ays-pb-text-input ays-pb-text-input-short ays_pb_aysDropdown" name="ays_pb_animate_out_mobile">
                                                    <optgroup label="Fading Exits">
                                                        <option <?php echo  $animate_out_mobile == 'fadeOut' ? 'selected' : ''; ?> value="fadeOut">Fade Out</option>
                                                        <option <?php echo  $animate_out_mobile == 'fadeOutDown' ? 'selected' : ''; ?> value="fadeOutDown">Fade Out Down</option>
                                                        <option <?php echo  $animate_out_mobile == 'fadeOutDownBig' ? 'selected' : ''; ?> value="fadeOutDownBig">Fade Out Down Big</option>
                                                        <option <?php echo  $animate_out_mobile == 'fadeOutLeft' ? 'selected' : ''; ?> value="fadeOutLeft">Fade Out Left</option>
                                                        <option <?php echo  $animate_out_mobile == 'fadeOutLeftBig' ? 'selected' : ''; ?> value="fadeOutLeftBig">Fade Out Left Big</option>
                                                        <option <?php echo  $animate_out_mobile == 'fadeOutRight' ? 'selected' : ''; ?> value="fadeOutRight">Fade Out Right</option>
                                                        <option <?php echo  $animate_out_mobile == 'fadeOutRightBig' ? 'selected' : ''; ?> value="fadeOutRightBig">Fade Out Right Big</option>
                                                        <option <?php echo  $animate_out_mobile == 'fadeOutUp' ? 'selected' : ''; ?> value="fadeOutUp">Fade Out Up</option>
                                                        <option <?php echo  $animate_out_mobile == 'fadeOutUpBig' ? 'selected' : ''; ?> value="fadeOutUpBig">Fade Out Up Big</option>
                                                    </optgroup>
                                                    <optgroup label="Bouncing Exits">
                                                        <option <?php echo 'bounceOut' == $animate_out_mobile ? 'selected' : ''; ?> value="bounceOut">Bounce Out</option>
                                                        <option <?php echo 'bounceOutDown' == $animate_out_mobile ? 'selected' : ''; ?> value="bounceOutDown">Bounce Out Down</option>
                                                        <option <?php echo 'bounceOutLeft' == $animate_out_mobile ? 'selected' : ''; ?> value="bounceOutLeft">Bounce Out Left</option>
                                                        <option <?php echo 'bounceOutRight' == $animate_out_mobile ? 'selected' : ''; ?> value="bounceOutRight">Bounce Out Right</option>
                                                        <option <?php echo 'bounceOutUp' == $animate_out_mobile ? 'selected' : ''; ?> value="bounceOutUp">Bounce Out Up</option>
                                                    </optgroup>
                                                    <optgroup label="Sliding Exits">
                                                        <option <?php echo 'slideOutUp' == $animate_out_mobile ? 'selected' : ''; ?> value="slideOutUp">Slide Out Up</option>
                                                        <option <?php echo 'slideOutDown' == $animate_out_mobile ? 'selected' : ''; ?> value="slideOutDown">Slide Out Down</option>
                                                        <option <?php echo 'slideOutLeft' == $animate_out_mobile ? 'selected' : ''; ?> value="slideOutLeft">Slide Out Left</option>
                                                        <option <?php echo 'slideOutRight' == $animate_out_mobile ? 'selected' : ''; ?> value="slideOutRight">Slide Out Right</option>
                                                    </optgroup>
                                                    <optgroup label="Zoom Exits">
                                                        <option <?php echo 'zoomOut' == $animate_out_mobile ? 'selected' : ''; ?> value="zoomOut">Zoom Out</option>
                                                        <option <?php echo 'zoomOutDown' == $animate_out_mobile ? 'selected' : ''; ?> value="zoomOutDown">Zoom Out Down</option>
                                                        <option <?php echo 'zoomOutLeft' == $animate_out_mobile ? 'selected' : ''; ?> value="zoomOutLeft">Zoom Out Left</option>
                                                        <option <?php echo 'zoomOutRight' == $animate_out_mobile ? 'selected' : ''; ?> value="zoomOutRight">Zoom Out Right</option>
                                                        <option <?php echo 'zoomOutUp' == $animate_out_mobile ? 'selected' : ''; ?> value="zoomOutUp">Zoom Out Up</option>
                                                    </optgroup>
                                                    <optgroup label="Rotating Exits">
                                                        <option <?php echo 'rotateOut' == $animate_out_mobile ? 'selected' : ''; ?> value="rotateOut">Rotating Out</option>
                                                        <option <?php echo 'rotateOutDownLeft' == $animate_out_mobile ? 'selected' : ''; ?> value="rotateOutDownLeft">Rotating Out Down Left</option>
                                                        <option <?php echo 'rotateOutDownRight' == $animate_out_mobile ? 'selected' : ''; ?> value="rotateOutDownRight">Rotating Out Down Right</option>
                                                        <option <?php echo 'rotateOutUpLeft' == $animate_out_mobile ? 'selected' : ''; ?> value="rotateOutUpLeft">Rotating Out Up Left</option>
                                                        <option <?php echo 'rotateOutUpRight' == $animate_out_mobile ? 'selected' : ''; ?> value="rotateOutUpRight">Rotating Out Up Right</option>
                                                    </optgroup>
                                                    <optgroup label="Fliping Exits">
                                                        <option <?php echo 'flipOutY' == $animate_out_mobile ? 'selected' : ''; ?> value="flipOutY">Flip Out Y</option>
                                                        <option <?php echo 'flipOutX' == $animate_out_mobile ? 'selected' : ''; ?> value="flipOutX">Flip Out X</option>
                                                    </optgroup>
                                                    <option <?php echo  $animate_out_mobile == 'none' ? 'selected' : ''; ?> value="none">None</option>
                                                </select>
                                            </div>
                                            <div class="ays_pb_mobile_settings_container">
                                                <input type="checkbox" class="ays_toggle_checkbox ays-pb-onoffswitch-checkbox" id="ays_pb_enable_animate_out_mobile" name="ays_pb_enable_animate_out_mobile" <?php echo $enable_animate_out_mobile ? 'checked' : '' ?>>
                                                <label for="ays_pb_enable_animate_out_mobile" class="<?php echo $enable_animate_out_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>" >
                                <div class="form-group row ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_animation_speed">
                                            <span>
                                                <?php echo  esc_html__('Opening animation speed',"ays-popup-box") ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Specify the entry effect speed of the popup in seconds.", "ays-popup-box"); ?>">
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 ays_divider_left">
                                        <div class="ays_toggle_parent">
                                            <div>
                                                <div class="ays_pb_current_device_name ays_pb_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_animation_speed_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 225px;"><?php echo esc_html__('Desktop', "ays-popup-box") ?></div>
                                                <input id="ays_pb_animation_speed" type="number" class="ays-pb-text-input ays-pb-text-input-short" name="ays_pb_animation_speed" value="<?php echo $animation_speed; ?>" step="0.1" <?php echo $animate_in == 'none' ? 'disabled' : ''; ?>>
                                            </div>
                                            <div class="ays_toggle_target ays_pb_animation_speed_mobile_container" style=" <?php echo ( $enable_animation_speed_mobile ) ? '' : 'display:none'; ?>">
                                                <hr>
                                                <div class="ays_pb_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 225px;"><?php echo esc_html__('Mobile', "ays-popup-box") ?></div>
                                                <input id="ays_pb_animation_speed_mobile" type="number" class="ays-pb-text-input ays-pb-text-input-short" name="ays_pb_animation_speed_mobile" value="<?php echo $animation_speed_mobile; ?>" step="0.1" <?php echo $animate_in_mobile == 'none' ? 'disabled' : ''; ?> />
                                            </div>
                                            <div class="ays_pb_mobile_settings_container">
                                                <input type="checkbox" class="ays_toggle_checkbox ays-pb-onoffswitch-checkbox" id="ays_pb_enable_animation_speed_mobile" name="ays_pb_enable_animation_speed_mobile" <?php echo $enable_animation_speed_mobile ? 'checked' : '' ?>>
                                                <label for="ays_pb_enable_animation_speed_mobile" class="<?php echo $enable_animation_speed_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                                <div class="form-group row ays_pb_hide_for_notification_type <?php echo ($modal_content == 'notification_type') ? 'display_none' : ''; ?>">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_close_animation_speed">
                                            <span>
                                                <?php echo  esc_html__('Closing animation speed',"ays-popup-box") ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Specify the ending animation speed of the popup in seconds.", "ays-popup-box"); ?>">
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 ays_divider_left">
                                        <div class="ays_toggle_parent">
                                            <div>
                                                <div class="ays_pb_current_device_name ays_pb_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_close_animation_speed_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 225px;"><?php echo esc_html__('Desktop', "ays-popup-box") ?></div>
                                                <input id="ays_pb_close_animation_speed" type="number" class="ays-pb-text-input ays-pb-text-input-short" name="ays_pb_close_animation_speed" value="<?php echo $close_animation_speed; ?>" step="0.1" <?php echo $animate_out == 'none' ? 'disabled' : ''; ?>>
                                            </div>
                                            <div class="ays_toggle_target ays_pb_close_animation_speed_mobile_container" style=" <?php echo ( $enable_close_animation_speed_mobile ) ? '' : 'display:none'; ?>">
                                                <hr>
                                                <div class="ays_pb_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 225px;"><?php echo esc_html__('Mobile', "ays-popup-box") ?></div>
                                                <input id="ays_pb_close_animation_speed_mobile" type="number" class="ays-pb-text-input ays-pb-text-input-short" name="ays_pb_close_animation_speed_mobile" value="<?php echo $close_animation_speed_mobile; ?>" step="0.1" <?php echo $animate_out_mobile == 'none' ? 'disabled' : ''; ?> />
                                            </div>
                                            <div class="ays_pb_mobile_settings_container">
                                                <input type="checkbox" class="ays_toggle_checkbox ays-pb-onoffswitch-checkbox" id="ays_pb_enable_close_animation_speed_mobile" name="ays_pb_enable_close_animation_speed_mobile" <?php echo $enable_close_animation_speed_mobile ? 'checked' : '' ?>>
                                                <label for="ays_pb_enable_close_animation_speed_mobile" class="<?php echo $enable_close_animation_speed_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="ays-pb-accordion-options-main-container">
                            <div class="ays-pb-accordion-header">
                                <?php echo wp_kses($pb_acordion_svg_html, $allow_tags_acordion_arrow); ?>
                                <p class="ays-subtitle"><?php echo  esc_html__('Background style', "ays-popup-box") ?></p>
                            </div>
                            <hr class="ays-pb-bolder-hr"/>
                            <div class="ays-pb-accordion-body">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="<?php echo esc_attr($this->plugin_name); ?>-bgcolor">
                                            <span>
                                                <?php echo esc_html__('Background color', "ays-popup-box"); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Specify the background color of the popup.", "ays-popup-box"); ?>">
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 ays_divider_left">
                                        <div class="ays_toggle_parent">
                                            <div>
                                                <div class="ays_pb_current_device_name ays_pb_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_bgcolor_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 110px;"><?php echo esc_html__('Desktop', "ays-popup-box") ?></div>
                                                <input type="text" id="<?php echo esc_attr($this->plugin_name); ?>-bgcolor"  data-alpha="true" class="ays_pb_color_input ays_pb_bgcolor_change ays_pb_background_color" name="<?php echo esc_attr($this->plugin_name); ?>[bgcolor]" value="<?php echo $bgcolor; ?>"  data-default-color="#FFFFFF"/>
                                            </div>
                                            <div class="ays_toggle_target ays_pb_bgcolor_mobile_container" style=" <?php echo ( $enable_bgcolor_mobile ) ? '' : 'display:none'; ?>">
                                                <hr>
                                                <div class="ays_pb_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 110px;"><?php echo esc_html__('Mobile', "ays-popup-box") ?></div>
                                                <input type="text" id="<?php echo esc_attr($this->plugin_name); ?>-bgcolor-mobile"  data-alpha="true" class="ays_pb_color_input ays_pb_background_color_mobile" name="ays_pb_bgcolor_mobile" value="<?php echo $bgcolor_mobile; ?>"  data-default-color="#FFFFFF"/>
                                            </div>
                                            <div class="ays_pb_mobile_settings_container">
                                                <input type="checkbox" class="ays_toggle_checkbox ays-pb-onoffswitch-checkbox" id="ays_pb_enable_bgcolor_mobile" name="ays_pb_enable_bgcolor_mobile" <?php echo $enable_bgcolor_mobile ? 'checked' : '' ?>>
                                                <label for="ays_pb_enable_bgcolor_mobile" class="<?php echo $enable_bgcolor_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="ays_pb_hide_for_video_type <?php echo ($modal_content == 'video_type') ? 'display_none' : ''; ?>">
                                <div class="form-group row ays_pb_hide_for_video_type <?php echo ($modal_content == 'video_type') ? 'display_none' : ''; ?>" id="ays-popup-box-background-image-container">
                                    <div class="col-sm-4">
                                        <label for='ays-pb-bg-image'>
                                            <?php echo esc_html__('Background Image', "ays-popup-box"); ?>
                                            <a class="ays_help" data-toggle="tooltip" data-placement="top"
                                            title="<?php echo esc_html__("Add a background image to the popup. Note: If you want to apply background color, remove the image or don't add it.", "ays-popup-box"); ?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 ays_divider_left">
                                        <div class="ays_toggle_parent">
                                            <div>
                                                <div>
                                                    <div class="ays_pb_current_device_name ays_pb_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_bg_image_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 85px;"><?php echo esc_html__('Desktop', "ays-popup-box") ?></div>
                                                    <a href="javascript:void(0)" class="button ays-pb-add-bg-image" data-add='<?php echo $bg_image != '' ? 'true' : 'false'; ?>'>
                                                        <?php echo $bg_image != '' ? esc_html__('Edit Image', "ays-popup-box") : esc_html__('Add Image', "ays-popup-box"); ?>
                                                    </a>
                                                </div>
                                                <div style="<?php echo $bg_image != '' ? 'display: block' : 'display: none'; ?>">
                                                    <div class="ays-pb-bg-image-container ays-pb-edit-image-container">
                                                        <span class="ays-remove-bg-img ays-pb-edit-image-container-remove-img"></span>
                                                        <img src="<?php echo $bg_image ; ?>" id="ays-pb-bg-img"/>
                                                        <input type="hidden" name="ays_pb_bg_image" id="ays-pb-bg-image" value="<?php echo $bg_image; ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ays_toggle_target ays_pb_bg_image_mobile_container" style=" <?php echo ( $enable_bg_image_mobile ) ? '' : 'display:none'; ?>">
                                                <hr>
                                                <div>
                                                    <div class="ays_pb_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 85px;"><?php echo esc_html__('Mobile', "ays-popup-box") ?></div>
                                                    <a href="javascript:void(0)" class="button ays-pb-add-bg-image-mobile" data-add='<?php echo $bg_image != '' ? 'true' : 'false'; ?>'>
                                                        <?php echo $bg_image_mobile != '' ? esc_html__('Edit Image', "ays-popup-box") : esc_html__('Add Image', "ays-popup-box"); ?>
                                                    </a>
                                                </div>
                                                <div style="<?php echo $bg_image != '' ? 'display: block' : 'display: none'; ?>">
                                                    <div class="ays-pb-bg-image-container-mobile ays-pb-edit-image-container">
                                                        <span class="ays-remove-bg-img-mobile ays-pb-edit-image-container-remove-img"></span>
                                                        <img src="<?php echo $bg_image_mobile ; ?>" id="ays-pb-bg-img-mobile"/>
                                                        <input type="hidden" name="ays_pb_bg_image_mobile" id="ays-pb-bg-image-mobile" value="<?php echo $bg_image_mobile; ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ays_pb_mobile_settings_container">
                                                <input type="checkbox" class="ays_toggle_checkbox ays-pb-onoffswitch-checkbox" id="ays_pb_enable_bg_image_mobile" name="ays_pb_enable_bg_image_mobile" <?php echo $enable_bg_image_mobile ? 'checked' : '' ?>>
                                                <label for="ays_pb_enable_bg_image_mobile" class="<?php echo $enable_bg_image_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="ays_pb_hide_for_video_type <?php echo ($modal_content == 'video_type') ? 'display_none' : ''; ?>">
                                <div class="form-group row ays_pb_hide_for_video_type <?php echo ($modal_content == 'video_type') ? 'display_none' : ''; ?>" id="ays-popup-box-background-image-position-container">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_bg_image_position">
                                            <?php echo esc_html__( "Background image position", "ays-popup-box" ); ?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Select the position of the background image of the popup.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="pb_position_block col-sm-8 ays_divider_left ays_toggle_parent">
                                        <div class="ays_pb_bg_image_position_tables_container" style="display: flex;">
                                            <div>
                                                <div class="ays_pb_current_device_name ays_pb_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_pb_bg_image_position_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 120px;"><?php echo esc_html__('Desktop', "ays-popup-box") ?></div>
                                                <table id="ays_pb_bg_image_position_table" data-flag="bg_image_position">
                                                    <tr>
                                                        <td data-value="left-top" data-id='1'></td>
                                                        <td data-value="top-center"data-id='2'></td>
                                                        <td data-value="right-top" data-id='3'></td>
                                                    </tr>
                                                    <tr>
                                                        <td data-value="left-center" data-id='4'></td>
                                                        <td id="pb_position_center" data-value="center-center" data-id='5'></td>
                                                        <td data-value="right-center" data-id='6'></td>
                                                    </tr>
                                                    <tr>
                                                        <td data-value="left-bottom" data-id='7'></td>
                                                        <td data-value="center-bottom" data-id='8'></td>
                                                        <td data-value="right-bottom" data-id='9'></td>
                                                    </tr>
                                                </table>
                                                <input type="hidden" name="ays_pb_bg_image_position" id="ays_pb_bg_image_position" value="<?php echo $pb_bg_image_position; ?>" class="ays-pb-position-val-class">
                                            </div>
                                            <div class="ays_toggle_target ays_divider_left ays_pb_bg_image_position_mobile_container" style=" <?php echo ( $enable_pb_bg_image_position_mobile ) ? '' : 'display:none'; ?>">
                                                <div class="ays_pb_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 120px;"><?php echo esc_html__('Mobile', "ays-popup-box") ?></div>
                                                <table id="ays_pb_bg_image_position_table_mobile" data-flag="bg_image_position_mobile">
                                                    <tr>
                                                        <td data-value="left-top" data-id='1'></td>
                                                        <td data-value="top-center"data-id='2'></td>
                                                        <td data-value="right-top" data-id='3'></td>
                                                    </tr>
                                                    <tr>
                                                        <td data-value="left-center" data-id='4'></td>
                                                        <td id="pb_position_center" data-value="center-center" data-id='5'></td>
                                                        <td data-value="right-center" data-id='6'></td>
                                                    </tr>
                                                    <tr>
                                                        <td data-value="left-bottom" data-id='7'></td>
                                                        <td data-value="center-bottom" data-id='8'></td>
                                                        <td data-value="right-bottom" data-id='9'></td>
                                                    </tr>
                                                </table>
                                                <input type="hidden" name="ays_pb_bg_image_position_mobile" id="ays_pb_bg_image_position_mobile" value="<?php echo $pb_bg_image_position_mobile; ?>" class="ays-pb-position-val-class-mobile">
                                            </div>
                                        </div>
                                        <div class="ays_pb_mobile_settings_container">
                                            <input type="checkbox" class="ays_toggle_checkbox ays-pb-onoffswitch-checkbox" id="ays_pb_enable_bg_image_position_mobile" name="ays_pb_enable_bg_image_position_mobile" <?php echo $enable_pb_bg_image_position_mobile ? 'checked' : '' ?>>
                                            <label for="ays_pb_enable_bg_image_position_mobile" class="<?php echo $enable_pb_bg_image_position_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                        </div>
                                    </div>
                                </div>
                                <hr class="ays_pb_hide_for_video_type <?php echo ($modal_content == 'video_type') ? 'display_none' : ''; ?>">
                                <div class="form-group row ays_pb_hide_for_video_type <?php echo ($modal_content == 'video_type') ? 'display_none' : ''; ?>" id="ays-popup-box-background-image-sizing-container">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_bg_image_sizing">
                                            <?php echo esc_html__('Background image sizing', "ays-popup-box" ); ?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Define the background image size if needed.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 ays_divider_left ays_toggle_parent">
                                        <div>
                                            <div class="ays_pb_current_device_name ays_pb_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_pb_bg_image_sizing_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 225px;"><?php echo esc_html__('Desktop', "ays-popup-box") ?></div>
                                            <select name="ays_pb_bg_image_sizing" id="ays_pb_bg_image_sizing" class="ays-pb-text-input ays-pb-text-input-short ays_pb_aysDropdown" style="display:block;">
                                                <option value="cover" <?php echo $pb_bg_image_sizing == 'cover' ? 'selected' : ''; ?>><?php echo esc_html__( "Cover", "ays-popup-box" ); ?></option>
                                                <option value="contain" <?php echo $pb_bg_image_sizing == 'contain' ? 'selected' : ''; ?>><?php echo esc_html__( "Contain", "ays-popup-box" ); ?></option>
                                                <option value="none" <?php echo $pb_bg_image_sizing == 'none' ? 'selected' : ''; ?>><?php echo esc_html__( "None", "ays-popup-box" ); ?></option>
                                                <option value="unset" <?php echo $pb_bg_image_sizing == 'unset' ? 'selected' : ''; ?>><?php echo esc_html__( "Unset", "ays-popup-box" ); ?></option>
                                            </select>
                                        </div>
                                        <div class="ays_toggle_target ays_pb_bg_image_sizing_mobile_container" style=" <?php echo ( $enable_pb_bg_image_sizing_mobile ) ? '' : 'display:none'; ?>">
                                            <hr>
                                            <div class="ays_pb_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 225px;"><?php echo esc_html__('Mobile', "ays-popup-box") ?></div>
                                            <select name="ays_pb_bg_image_sizing_mobile" id="ays_pb_bg_image_sizing_mobile" class="ays-pb-text-input ays-pb-text-input-short ays_pb_aysDropdown" style="display:block;">
                                                <option value="cover" <?php echo $pb_bg_image_sizing_mobile == 'cover' ? 'selected' : ''; ?>><?php echo esc_html__( "Cover", "ays-popup-box" ); ?></option>
                                                <option value="contain" <?php echo $pb_bg_image_sizing_mobile == 'contain' ? 'selected' : ''; ?>><?php echo esc_html__( "Contain", "ays-popup-box" ); ?></option>
                                                <option value="none" <?php echo $pb_bg_image_sizing_mobile == 'none' ? 'selected' : ''; ?>><?php echo esc_html__( "None", "ays-popup-box" ); ?></option>
                                                <option value="unset" <?php echo $pb_bg_image_sizing_mobile == 'unset' ? 'selected' : ''; ?>><?php echo esc_html__( "Unset", "ays-popup-box" ); ?></option>
                                            </select>
                                        </div>
                                        <div class="ays_pb_mobile_settings_container">
                                            <input type="checkbox" class="ays_toggle_checkbox ays-pb-onoffswitch-checkbox" id="ays_pb_enable_bg_image_sizing_mobile" name="ays_pb_enable_bg_image_sizing_mobile" <?php echo $enable_pb_bg_image_sizing_mobile ? 'checked' : '' ?>>
                                            <label for="ays_pb_enable_bg_image_sizing_mobile" class="<?php echo $enable_pb_bg_image_sizing_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                        </div>
                                    </div>
                                </div>
                                <hr class="ays_pb_hide_for_video_type <?php echo ($modal_content == 'video_type') ? 'display_none' : ''; ?>">
                                <div class="form-group row ays_pb_hide_for_video_type <?php echo ($modal_content == 'video_type') ? 'display_none' : ''; ?>" id="ays-popup-box-background-gradient-container">
                                    <div class="col-sm-4">
                                        <label for="ays-enable-background-gradient">
                                            <?php echo esc_html__('Background gradient',"ays-popup-box")?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Add background gradient for the popup, choose gradient color stops and direction.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 ays_divider_left ayspb-enable-background-gradient">
                                        <div class="ays_toggle_slide_mobile_option_container">
                                            <div class="form-group row" style="align-items: center;">
                                                <div class="col-sm-3">
                                                    <label for="ays-enable-background-gradient">
                                                        <?php echo  esc_html__('On desktop',"ays-popup-box") ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Define the background gradient for desktop devices.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="checkbox" class="ays_toggle ays_toggle_slide ays_toggle_slide_mobile_option" id="ays-enable-background-gradient" name="ays_enable_background_gradient" <?php echo ($enable_background_gradient) ? 'checked' : ''; ?>/>
                                                    <label for="ays-enable-background-gradient" class="ays_switch_toggle">Toggle</label>
                                                </div>
                                            </div>
                                            <div class="row ays_toggle_target" style="margin: 10px 0 0 0; padding-top: 10px; <?php echo ($enable_background_gradient) ? '' : 'display:none;' ?>">
                                                <div class="col-sm-12 ays_divider_top" style="margin-top: 10px; padding-top: 10px;">
                                                    <label for='ays-background-gradient-color-1'>
                                                        <?php echo esc_html__('Color 1', "ays-popup-box"); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Select the first color stop.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                    <input type="text" class="ays-text-input" id='ays-background-gradient-color-1' data-alpha="true" name='ays_background_gradient_color_1' value="<?php echo $background_gradient_color_1; ?>"/>
                                                </div>
                                                <div class="col-sm-12 ays_divider_top" style="margin-top: 10px; padding-top: 10px;">
                                                    <label for='ays-background-gradient-color-2'>
                                                        <?php echo esc_html__('Color 2', "ays-popup-box"); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Select the second color stop.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                    <input type="text" class="ays-text-input" id='ays-background-gradient-color-2' data-alpha="true" name='ays_background_gradient_color_2' value="<?php echo $background_gradient_color_2; ?>"/>
                                                </div>
                                                <div class="col-sm-12 ays_divider_top" style="margin-top: 10px; padding-top: 10px;">
                                                    <label for="ays_pb_gradient_direction">
                                                        <?php echo esc_html__('Gradient direction',"ays-popup-box")?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('The direction of the color gradient',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                    <select id="ays_pb_gradient_direction" name="ays_pb_gradient_direction" class="ays-text-input ays_pb_aysDropdown">
                                                        <option <?php echo ($pb_gradient_direction == 'vertical') ? 'selected' : ''; ?> value="vertical"><?php echo esc_html__( 'Vertical', "ays-popup-box"); ?></option>
                                                        <option <?php echo ($pb_gradient_direction == 'horizontal') ? 'selected' : ''; ?> value="horizontal"><?php echo esc_html__( 'Horizontal', "ays-popup-box"); ?></option>
                                                        <option <?php echo ($pb_gradient_direction == 'diagonal_left_to_right') ? 'selected' : ''; ?> value="diagonal_left_to_right"><?php echo esc_html__( 'Diagonal left to right', "ays-popup-box"); ?></option>
                                                        <option <?php echo ($pb_gradient_direction == 'diagonal_right_to_left') ? 'selected' : ''; ?> value="diagonal_right_to_left"><?php echo esc_html__( 'Diagonal right to left', "ays-popup-box"); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="ays_toggle_slide_mobile_option_container">
                                            <div class="form-group row" style="align-items: center;">
                                                <div class="col-sm-3">
                                                    <label for="ays-enable-background-gradient-mobile">
                                                        <?php echo  esc_html__('On Mobile',"ays-popup-box") ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Define the background gradient for mobile devices.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="checkbox" class="ays_toggle ays_toggle_slide ays_toggle_slide_mobile_option" id="ays-enable-background-gradient-mobile" name="ays_enable_background_gradient_mobile" <?php echo ($enable_background_gradient_mobile) ? 'checked' : ''; ?>/>
                                                    <label for="ays-enable-background-gradient-mobile" class="ays_switch_toggle">Toggle</label>
                                                </div>
                                            </div>
                                            <div class="row ays_toggle_target" style="margin: 10px 0 0 0; padding-top: 10px; <?php echo ($enable_background_gradient_mobile) ? '' : 'display:none;' ?>">
                                                <div class="col-sm-12 ays_divider_top" style="margin-top: 10px; padding-top: 10px;">
                                                    <label for='ays-background-gradient-color-1-mobile'>
                                                        <?php echo esc_html__('Color 1', "ays-popup-box"); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Select the first color stop.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                    <input type="text" class="ays-text-input" id='ays-background-gradient-color-1-mobile' data-alpha="true" name='ays_background_gradient_color_1_mobile' value="<?php echo $background_gradient_color_1_mobile; ?>"/>
                                                </div>
                                                <div class="col-sm-12 ays_divider_top" style="margin-top: 10px; padding-top: 10px;">
                                                    <label for='ays-background-gradient-color-2-mobile'>
                                                        <?php echo esc_html__('Color 2', "ays-popup-box"); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Select the second color stop.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                    <input type="text" class="ays-text-input" id='ays-background-gradient-color-2-mobile' data-alpha="true" name='ays_background_gradient_color_2_mobile' value="<?php echo $background_gradient_color_2_mobile; ?>"/>
                                                </div>
                                                <div class="col-sm-12 ays_divider_top" style="margin-top: 10px; padding-top: 10px;">
                                                    <label for="ays_pb_gradient_direction_mobile">
                                                        <?php echo esc_html__('Gradient direction',"ays-popup-box")?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('The direction of the color gradient',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                    <select id="ays_pb_gradient_direction_mobile" name="ays_pb_gradient_direction_mobile" class="ays-text-input ays_pb_aysDropdown">
                                                        <option <?php echo ($pb_gradient_direction_mobile == 'vertical') ? 'selected' : ''; ?> value="vertical"><?php echo esc_html__( 'Vertical', "ays-popup-box"); ?></option>
                                                        <option <?php echo ($pb_gradient_direction_mobile == 'horizontal') ? 'selected' : ''; ?> value="horizontal"><?php echo esc_html__( 'Horizontal', "ays-popup-box"); ?></option>
                                                        <option <?php echo ($pb_gradient_direction_mobile == 'diagonal_left_to_right') ? 'selected' : ''; ?> value="diagonal_left_to_right"><?php echo esc_html__( 'Diagonal left to right', "ays-popup-box"); ?></option>
                                                        <option <?php echo ($pb_gradient_direction_mobile == 'diagonal_right_to_left') ? 'selected' : ''; ?> value="diagonal_right_to_left"><?php echo esc_html__( 'Diagonal right to left', "ays-popup-box"); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="ays_pb_hide_for_video_type ays_pb_hide_for_image_type ays_pb_hide_for_notification_type <?php echo ($modal_content == 'video_type' || $modal_content == 'image_type' || $modal_content == 'notification_type') ? 'display_none' : ''; ?>" />
                                <div class="form-group row ays_pb_hide_for_video_type ays_pb_hide_for_image_type ays_pb_hide_for_notification_type <?php echo ($modal_content == 'video_type' || $modal_content == 'image_type' || $modal_content == 'notification_type') ? 'display_none' : ''; ?>" id="ays-popup-box-header-background-color-container">
                                    <div class="col-sm-4">
                                        <label for="<?php echo esc_attr($this->plugin_name); ?>-header_bgcolor">
                                            <span>
                                                <?php echo esc_html__('Header background color', "ays-popup-box"); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Specify the background color of the box's header. Note: It works with the following themes: Red, Sale.", "ays-popup-box"); ?>">
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 ays_divider_left">
                                        <div class="ays_toggle_parent">
                                            <div>
                                                <div class="ays_pb_current_device_name ays_pb_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_bgcolor_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 110px;"><?php echo esc_html__('Desktop', "ays-popup-box") ?></div>
                                                <input type="text" id="<?php echo esc_attr($this->plugin_name); ?>-header_bgcolor"  data-alpha="true" class="ays_pb_color_input ays_pb_header_bgcolor_change" name="<?php echo esc_attr($this->plugin_name); ?>[header_bgcolor]" value="<?php echo $header_bgcolor; ?>"  Fdata-default-color="#FFFFF"/>
                                            </div>
                                            <div class="ays_toggle_target ays_pb_bgcolor_mobile_container" style=" <?php echo ( $enable_bgcolor_mobile ) ? '' : 'display:none'; ?>">
                                                <hr>
                                                <div class="ays_pb_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 110px;"><?php echo esc_html__('Mobile', "ays-popup-box") ?></div>
                                                <input type="text" id="<?php echo esc_attr($this->plugin_name); ?>-header_bgcolor_mobile"  data-alpha="true" class="ays_pb_color_input ays_pb_header_bgcolor_change" name="<?php echo esc_attr($this->plugin_name); ?>[header_bgcolor_mobile]" value="<?php echo $header_bgcolor_mobile; ?>"  Fdata-default-color="#FFFFF"/>
                                            </div>
                                            <div class="ays_pb_mobile_settings_container">
                                                <input type="checkbox" class="ays_toggle_checkbox ays-pb-onoffswitch-checkbox" id="ays_pb_enable_header_bgcolor_mobile" name="ays_pb_enable_header_bgcolor_mobile" <?php echo $enable_header_bgcolor_mobile ? 'checked' : '' ?>>
                                                <label for="ays_pb_enable_header_bgcolor_mobile" class="<?php echo $enable_header_bgcolor_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="ays_pb_hide_for_notification_type <?php echo $modal_content == 'notification_type' ? 'display_none' : ''; ?>">
                                <div class="form-group row ays_pb_hide_for_notification_type <?php echo $modal_content == 'notification_type' ? 'display_none' : ''; ?>">
                                    <div class="col-sm-4">
                                        <label for="<?php echo esc_attr($this->plugin_name); ?>-ays_pb_overlay_color">
                                            <span>
                                                <?php echo  esc_html__('Overlay color',"ays-popup-box") ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Specify the overlay color.", "ays-popup-box"); ?>">
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 ays_divider_left">
                                        <div class="ays_toggle_parent">
                                            <div>
                                                <div class="ays_pb_current_device_name ays_pb_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_overlay_color_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 110px;"><?php echo esc_html__('Desktop', "ays-popup-box") ?></div>
                                                <input id="<?php echo esc_attr($this->plugin_name); ?>-overlay_color" type="text" data-alpha="true" class="color-picker ays_pb_color_input ays_pb_overlay_color_change" name="ays_pb_overlay_color" value="<?php echo $overlay_color; ?>" data-default-color="#000">
                                            </div>
                                            <div class="ays_toggle_target ays_pb_overlay_color_mobile_container" style=" <?php echo ( $enable_overlay_color_mobile ) ? '' : 'display:none'; ?>">
                                                <hr>
                                                <div class="ays_pb_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 110px;"><?php echo esc_html__('Mobile', "ays-popup-box") ?></div>
                                                <input id="<?php echo esc_attr($this->plugin_name); ?>-overlay_color_mobile" type="text" data-alpha="true" class="color-picker ays_pb_color_input ays_pb_overlay_color_mobile_change" name="ays_pb_overlay_color_mobile" value="<?php echo $overlay_color_mobile; ?>"  data-default-color="#000"/>
                                            </div>
                                            <div class="ays_pb_mobile_settings_container">
                                                <input type="checkbox" class="ays_toggle_checkbox ays-pb-onoffswitch-checkbox" id="ays_pb_enable_overlay_color_mobile" name="ays_pb_enable_overlay_color_mobile" <?php echo $enable_overlay_color_mobile ? 'checked' : '' ?>>
                                                <label for="ays_pb_enable_overlay_color_mobile" class="<?php echo $enable_overlay_color_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="ays-pb-accordion-options-main-container">
                            <div class="ays-pb-accordion-header">
                                <?php echo wp_kses($pb_acordion_svg_html, $allow_tags_acordion_arrow); ?>
                                <p class="ays-subtitle"><?php echo  esc_html__('Border style', "ays-popup-box") ?></p>
                            </div>
                            <hr class="ays-pb-bolder-hr"/>
                            <div class="ays-pb-accordion-body">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="<?php echo esc_attr($this->plugin_name); ?>-ays_pb_bordersize">
                                            <span>
                                                <?php echo  esc_html__('Border Width',"ays-popup-box") ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Specify the border size of the popup in pixels.", "ays-popup-box"); ?>">
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 ays_divider_left">
                                        <div class="ays_toggle_parent">
                                            <div>
                                                <div class="ays_pb_current_device_name ays_pb_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_border_size_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 225px;"><?php echo esc_html__('Desktop', "ays-popup-box") ?></div>
                                                <input id="<?php echo esc_attr($this->plugin_name); ?>-ays_pb_bordersize" type="number" class="ays-pb-text-input ays-pb-text-input-short" name="<?php echo esc_attr($this->plugin_name); ?>[ays_pb_bordersize]" value="<?php echo wp_unslash($border_size); ?>">
                                            </div>
                                            <div class="ays_toggle_target ays_pb_bordersize_mobile_container" style=" <?php echo ( $enable_border_size_mobile ) ? '' : 'display:none'; ?>">
                                                <hr>
                                                <div class="ays_pb_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 225px;"><?php echo esc_html__('Mobile', "ays-popup-box") ?></div>
                                                <input id="<?php echo esc_attr($this->plugin_name); ?>-ays_pb_bordersize_mobile" type="number" class="ays-pb-text-input ays-pb-text-input-short" name="ays_pb_bordersize_mobile" value="<?php echo wp_unslash($border_size_mobile); ?>"/>
                                            </div>
                                            <div class="ays_pb_mobile_settings_container">
                                                <input type="checkbox" class="ays_toggle_checkbox ays-pb-onoffswitch-checkbox" id="ays_pb_enable_bordersize_mobile" name="ays_pb_enable_bordersize_mobile" <?php echo $enable_border_size_mobile ? 'checked' : '' ?>>
                                                <label for="ays_pb_enable_bordersize_mobile" class="<?php echo $enable_border_size_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_border_style">
                                            <span>
                                                <?php echo  esc_html__('Border style',"ays-popup-box") ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Choose your preferred style of the border.", "ays-popup-box"); ?>">
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 ays_divider_left">
                                        <div class="ays_toggle_parent">
                                            <div>
                                                <div class="ays_pb_current_device_name ays_pb_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_border_style_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 225px;"><?php echo esc_html__('Desktop', "ays-popup-box") ?></div>
                                                <select name="ays_pb_border_style" id="ays_pb_border_style" class="ays_pb_aysDropdown">
                                                    <?php
                                                        $selected  = "";
                                                        foreach ($border_styles as $key => $border_style) {
                                                            // checking for versions compatibility (earlier saving in bd option name and not value)
                                                            if (isset($border_styles[$ays_pb_border_style]) && $border_styles[$ays_pb_border_style] !== '') {
                                                                $selected_border_style = $border_styles[$ays_pb_border_style];
                                                            } else {
                                                                $selected_border_style = $ays_pb_border_style;
                                                            }
    
                                                            if($border_style == $selected_border_style) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                    ?>
                                                    <option value="<?php echo $key ;?>" <?php echo $selected ;?>>
                                                        <?php echo $border_style; ?>
                                                    </option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="ays_toggle_target ays_pb_border_style_mobile_container" style=" <?php echo ( $enable_border_style_mobile ) ? '' : 'display:none'; ?>">
                                                <hr>
                                                <div class="ays_pb_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 225px;"><?php echo esc_html__('Mobile', "ays-popup-box") ?></div>
                                                <select name="ays_pb_border_style_mobile" id="ays_pb_border_style_mobile" class="ays_pb_aysDropdown">
                                                    <?php
                                                        $selected  = "";
                                                        foreach ($border_styles as $key => $border_style_mobile) {
                                                            // checking for versions compatibility (earlier saving in bd option name and not value)
                                                            if (isset($border_styles[$ays_pb_border_style_mobile]) && $border_styles[$ays_pb_border_style_mobile] !== '') {
                                                                $selected_border_style_mobile = $border_styles[$ays_pb_border_style_mobile];
                                                            } else {
                                                                $selected_border_style_mobile = $ays_pb_border_style_mobile;
                                                            }
    
                                                            if($border_style_mobile == $selected_border_style_mobile) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                    ?>
                                                    <option value="<?php echo $key ;?>" <?php echo $selected ;?>>
                                                        <?php echo $border_style_mobile; ?>
                                                    </option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="ays_pb_mobile_settings_container">
                                                <input type="checkbox" class="ays_toggle_checkbox ays-pb-onoffswitch-checkbox" id="ays_pb_enable_border_style_mobile" name="ays_pb_enable_border_style_mobile" <?php echo $enable_border_style_mobile ? 'checked' : '' ?>>
                                                <label for="ays_pb_enable_border_style_mobile" class="<?php echo $enable_border_style_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <!-- Border color start -->
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="<?php echo esc_attr($this->plugin_name); ?>-bordercolor">
                                            <span>
                                                <?php echo  esc_html__('Border color',"ays-popup-box") ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Specify the border color of the popup.", "ays-popup-box"); ?>">
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 ays_divider_left">
                                        <div class="ays_toggle_parent">
                                            <div>
                                                <div class="ays_pb_current_device_name ays_pb_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_bordercolor_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 110px;"><?php echo esc_html__('Desktop', "ays-popup-box") ?></div>
                                                <input id="<?php echo esc_attr($this->plugin_name); ?>-bordercolor" class="ays_pb_color_input ays_pb_bordercolor_change" type="text" name="<?php echo esc_attr($this->plugin_name); ?>[ays_pb_bordercolor]" value="<?php echo wp_unslash($bordercolor); ?>" data-default-color="#FFFFFF" data-alpha="true">
                                            </div>
                                            <div class="ays_toggle_target ays_pb_bordercolor_mobile_container" style=" <?php echo ( $enable_bordercolor_mobile ) ? '' : 'display:none'; ?>">
                                                <hr>
                                                <div class="ays_pb_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 110px;"><?php echo esc_html__('Mobile', "ays-popup-box") ?></div>
                                                <input id="<?php echo esc_attr($this->plugin_name); ?>-bordercolor-mobile" class="ays_pb_color_input ays_pb_bordercolor_mobile_change" type="text" name="ays_pb_bordercolor_mobile" value="<?php echo wp_unslash($bordercolor_mobile); ?>" data-default-color="#FFFFFF" data-alpha="true">
                                            </div>
                                            <div class="ays_pb_mobile_settings_container">
                                                <input type="checkbox" class="ays_toggle_checkbox ays-pb-onoffswitch-checkbox" id="ays_pb_enable_bordercolor_mobile" name="ays_pb_enable_bordercolor_mobile" <?php echo $enable_bordercolor_mobile ? 'checked' : '' ?>>
                                                <label for="ays_pb_enable_bordercolor_mobile" class="<?php echo $enable_bordercolor_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Border color end -->
                                <hr>
                                <!-- Border radius start -->
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="<?php echo esc_attr($this->plugin_name); ?>-ays_pb_border_radius">
                                            <span>
                                                <?php echo  esc_html__('Border radius',"ays-popup-box") ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Specify the radius of the border. Allows adding rounded corners to the popup.", "ays-popup-box"); ?>">
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 ays_divider_left">
                                        <div class="ays_toggle_parent">
                                            <div>
                                                <div class="ays_pb_current_device_name ays_pb_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_border_radius_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 225px;"><?php echo esc_html__('Desktop', "ays-popup-box") ?></div>
                                                <input id="<?php echo esc_attr($this->plugin_name); ?>-ays_pb_border_radius" type="number" class="ays-pb-text-input ays-pb-text-input-short" name="<?php echo esc_attr($this->plugin_name); ?>[ays_pb_border_radius]" value="<?php echo wp_unslash($border_radius); ?>">
                                            </div>
                                            <div class="ays_toggle_target ays_pb_border_radius_mobile_container" style=" <?php echo ( $enable_border_radius_mobile ) ? '' : 'display:none'; ?>">
                                                <hr>
                                                <div class="ays_pb_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 225px;"><?php echo esc_html__('Mobile', "ays-popup-box") ?></div>
                                                <input id="<?php echo esc_attr($this->plugin_name); ?>-ays_pb_border_radius_mobile" type="number" class="ays-pb-text-input ays-pb-text-input-short" name="ays_pb_border_radius_mobile" value="<?php echo wp_unslash($border_radius_mobile); ?>">
                                            </div>
                                            <div class="ays_pb_mobile_settings_container">
                                                <input type="checkbox" class="ays_toggle_checkbox ays-pb-onoffswitch-checkbox" id="ays_pb_enable_border_radius_mobile" name="ays_pb_enable_border_radius_mobile" <?php echo $enable_border_radius_mobile ? 'checked' : '' ?>>
                                                <label for="ays_pb_enable_border_radius_mobile" class="<?php echo $enable_border_radius_mobile ? 'active' : '' ?>" ><?php echo esc_html__('Use a different setting for Mobile', "ays-popup-box") ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Border radius end -->
                                <hr>
                            </div>
                        </div>
                        <div class="ays-pb-accordion-options-main-container">
                            <div class="ays-pb-accordion-header">
                                <?php echo wp_kses($pb_acordion_svg_html, $allow_tags_acordion_arrow); ?>
                                <p class="ays-subtitle"><?php echo  esc_html__('Button Style', "ays-popup-box") ?></p>
                            </div>
                            <hr class="ays-pb-bolder-hr"/>
                            <div class="ays-pb-accordion-body">
                                <div class="col-sm-12 ays-pro-features-v2-main-box">
                                    <div class="ays-pro-features-v2-big-buttons-box-main-container">
                                        <!-- <div class="ays-pro-features-v2-big-buttons-box-view-demo">
                                            <a href="https://youtu.be/BdwSmLbsCC4?list=PL4ufu1uAjjWQTYn0O_72TLzmqgmVIYKI2" target="_blank" class="ays-pro-features-v2-upgrade-button ays-pro-features-v2-upgrade-button-view-demo">
                                                <div class="ays-pro-features-v2-upgrade-text">
                                                    <img src="<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Video_40x40.svg" class="ays-pb-new-button-img-hide">
                                                    <img src="<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Video_40x40_Hover.svg" class="ays-pb-new-watch-video-button-hover">
                                                    <?php echo esc_html__("Watch Video" , "ays-popup-box"); ?>
                                                </div>
                                            </a>
                                        </div> -->
                                        <div class="ays-pro-features-v2-big-buttons-box">
                                            <a href="https://popup-plugin.com/" target="_blank" class="ays-pro-features-v2-upgrade-button">
                                                <div class="ays-pro-features-v2-upgrade-icon" style="background-image: url('<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg');" data-img-src="<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg"></div>
                                                <div class="ays-pro-features-v2-upgrade-text">
                                                    <?php echo esc_html__("Upgrade" , "ays-popup-box"); ?>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ays-pro-features-v2-small-buttons-box">
                                        <!-- <div>
                                            <a href="https://youtu.be/BdwSmLbsCC4?list=PL4ufu1uAjjWQTYn0O_72TLzmqgmVIYKI2" target="_blank" class="ays-pro-features-v2-video-button">
                                                <div>
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/pro-features-icons/Video_24x24.svg" ?>">
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/pro-features-icons/Video_24x24_Hover.svg" ?>" class="ays-pb-new-video-button-hover">
                                                </div>
                                                <div class="ays-pro-features-v2-video-text">
                                                    <?php echo esc_html__("Watch Video" , "ays-popup-box"); ?>
                                                </div>
                                            </a>
                                        </div> -->
                                        <a href="https://popup-plugin.com/" target="_blank" class="ays-pro-features-v2-upgrade-button">
                                            <div class="ays-pro-features-v2-upgrade-icon" style="background-image: url('<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg');" data-img-src="<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg"></div>
                                            <div class="ays-pro-features-v2-upgrade-text">
                                                <?php echo esc_html__("Upgrade" , "ays-popup-box"); ?>
                                            </div>
                                        </a>
                                    </div>     
                                    <!-- Buttons Size start-->
                                    <div class="form-group" id="ays_pb_button_size_content" style="margin:0;">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for="ays_pb_buttons_size">
                                                    <?php echo esc_html__('Button size',"ays-popup-box")?>
                                                    <a class="ays_help ays-pb-help-pro" data-toggle="tooltip" title="<?php echo esc_html__('The default sizes of buttons.',"ays-popup-box")?>">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-7 ays_divider_left">
                                                <select class="ays-text-input ays-pb-text-input ays-pb-text-input-short ays_pb_aysDropdown" id="ays_pb_buttons_size" name="ays_pb_buttons_size">
                                                    <option value="small">
                                                        <?php echo esc_html__('Small',"ays-popup-box")?>
                                                    </option>
                                                    <option value="medium">
                                                        <?php echo esc_html__('Medium',"ays-popup-box")?>
                                                    </option>
                                                    <option value="large">
                                                        <?php echo esc_html__('Large',"ays-popup-box")?>
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr> <!-- Button text Color -->
                                        <div class="form-group row ays-pb-button-color-content" id="ays-pb-button-color-content-first">
                                            <div class="col-sm-3">
                                                <label for='ays_pb_button_text_color'>
                                                    <?php echo esc_html__('Button text color', "ays-popup-box"); ?>
                                                    <a class="ays_help ays-pb-help-pro" data-toggle="tooltip" title="<?php echo esc_html__('Specify the text color of buttons inside the popup.',"ays-popup-box")?>">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-7 ays_divider_left">
                                                <input type="text" class="ays-text-input" id='ays_pb_button_text_color' data-alpha="true" name='ays_pb_button_text_color' value="#000"/>
                                            </div>
                                        </div> 
                                        <hr> <!-- Button Bg Color -->
                                        <div class="form-group row <?php echo $modal_content == 'yes_or_no' ? 'display_none' : ''; ?> ays-pb-button-color-content">
                                            <div class="col-sm-3">
                                                <label for='ays_pb_button_background_color'>
                                                    <?php echo esc_html__('Button background color', "ays-popup-box"); ?>
                                                    <a class="ays_help ays-pb-help-pro" data-toggle="tooltip" title="<?php echo esc_html__('Specify the backgound color of buttons inside the popup.',"ays-popup-box")?>">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-7 ays_divider_left">
                                                <input type="text" class="ays-text-input" id='ays_pb_button_background_color' data-alpha="true" name='ays_pb_button_background_color'value="#13aff0"/>
                                            </div>
                                        </div> <!-- Buttons BG Color -->
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for='ays_pb_buttons_font_size'>
                                                    <?php echo esc_html__('Button font-size', "ays-popup-box"); ?> (px)
                                                    <a class="ays_help ays-pb-help-pro" data-toggle="tooltip" title="<?php echo esc_html__('The font size of the buttons in pixels in the popup. It accepts only numeric values.',"ays-popup-box")?>">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-7 ays_divider_left">
                                                <input type="number" class="ays-text-input ays-pb-text-input ays-pb-text-input-short" id='ays_pb_buttons_font_size'name='ays_pb_buttons_font_size' value="17"/>
                                            </div>
                                        </div> <!-- Buttons font size -->
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for='ays_pb_buttons_width'>
                                                    <?php echo esc_html__('Button width', "ays-popup-box"); ?> (px)
                                                    <a class="ays_help ays-pb-help-pro" data-toggle="tooltip" title="<?php echo esc_html__('Set the button width in pixels. For an initial width, leave the field blank.', "ays-popup-box"); ?>">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-7 ays_divider_left">
                                                <input type="number" class="ays-text-input ays-pb-text-input ays-pb-text-input-short" id='ays_pb_buttons_width'name='ays_pb_buttons_width' value="">
                                                <span style="display:block;" class="ays-pb-small-hint-text"><?php echo esc_html__('For an initial width, leave the field blank.', "ays-popup-box"); ?></span>
                                            </div>
                                        </div> <!-- Buttons font size -->
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for="ays_pb_buttons_padding">
                                                    <?php echo esc_html__('Button padding',"ays-popup-box")?> (px)
                                                    <a class="ays_help ays-pb-help-pro" data-toggle="tooltip" title="<?php echo esc_html__('Padding of buttons.',"ays-popup-box")?>">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-7 ays_divider_left">
                                                <div class="col-sm-5" style="display: inline-block; padding-left: 0;">
                                                    <span style="display:block;" class="ays-pb-small-hint-text"><?php echo esc_html__('Left / Right',"ays-popup-box")?></span>
                                                    <input type="number" class="ays-text-input" id='ays_pb_buttons_left_right_padding' name='ays_pb_buttons_left_right_padding' value="20" style="width: 100px;" />
                                                </div>
                                                <div class="col-sm-5 ays_divider_left ays-buttons-top-bottom-padding-box" style="display: inline-block;">
                                                    <span style="display:block;" class="ays-pb-small-hint-text"><?php echo esc_html__('Top / Bottom',"ays-popup-box")?></span>
                                                    <input type="number" class="ays-text-input" id='ays_pb_buttons_top_bottom_padding' name='ays_pb_buttons_top_bottom_padding' value="10" style="width: 100px;" />
                                                </div>
                                            </div>
                                        </div> <!-- Buttons padding -->
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for="ays_pb_buttons_border_radius">
                                                    <?php echo esc_html__('Button border-radius', "ays-popup-box"); ?> (px)
                                                    <a class="ays_help ays-pb-help-pro" data-toggle="tooltip" title="<?php echo esc_html__('Popup buttons border-radius in pixels. It accepts only numeric values.',"ays-popup-box")?>">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-7 ays_divider_left">
                                                <input type="number" class="ays-text-input ays-pb-text-input ays-pb-text-input-short" id="ays_pb_buttons_border_radius" name="ays_pb_buttons_border_radius" value="3"/>
                                            </div>
                                        </div> <!-- Buttons border radius -->
                                    </div>
                                    <!-- Buttons Size End -->
                                </div>
                                <hr class="ays_pb_close_bttn_option <?php echo $close_button == 'on' ? 'display_none' : ''; ?>">
                                <!-- close button image start  -->
                                <div class="form-group row ays_pb_close_bttn_option <?php echo $close_button == 'on' ? 'display_none' : ''; ?>" id="ays-popup-box-close-button-image-container">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_close_button_image">
                                            <span>
                                                <?php echo  esc_html__('Close button image',"ays-popup-box") ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Add an image which will be displayed instead of the close button or choose from predefined icons.", "ays-popup-box"); ?>">
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 ays_divider_left">
                                        <!-- Predefined SVG Icons -->
                                        <div class="ays-pb-close-button-icons-list">
                                            <div class="ays-pb-close-button-icons-wrapper" style="display: flex; gap: 10px; margin-bottom: 10px;">
                                                <?php
                                                $svg_icons = array(
                                                    '1' => AYS_PB_ADMIN_URL . "/images/icons/close-icon-1.svg",
                                                    '2' => AYS_PB_ADMIN_URL . "/images/icons/close-icon-2.svg",
                                                    '3' => AYS_PB_ADMIN_URL . "/images/icons/close-icon-3.svg",
                                                    '4' => AYS_PB_ADMIN_URL . "/images/icons/close-icon-4.svg"
                                                );
                                                
                                                foreach ($svg_icons as $key => $icon_url) {
                                                    $checked = ($close_btn_background_img == $icon_url) ? 'checked' : '';
                                                    ?>
                                                    <div class="ays-pb-close-icon-item" style="text-align: center;">
                                                        <label style="display: block; cursor: pointer;">
                                                            <input type="radio" name="ays_pb_close_btn_icon" value="<?php echo esc_url($icon_url); ?>" <?php echo $checked; ?>>
                                                            <img src="<?php echo esc_url($icon_url); ?>" style="width: 30px; height: 30px; border: 1px solid #ccc; padding: 5px; border-radius: 3px;">
                                                        </label>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        
                                        <!-- Custom Image Upload Button -->
                                        <div>
                                            <a href="javascript:void(0)" class="button ays_pb_add_close_btn_bg_image">
                                                <?php echo $close_btn_background_img != '' ? esc_html__('Edit Image', "ays-popup-box") : esc_html__('Add Image', "ays-popup-box"); ?>
                                            </a>
                                        </div>
                                        <div class="ays_pb_close_btn_bg_img_container ays-pb-edit-image-container" style="<?php echo $close_btn_background_img != '' ? 'display: block' : 'display: none'; ?>">
                                            <div class="ays_pb_close_btn_bg_img">
                                                <span class="ays_remove_bg_img ays-pb-edit-image-container-remove-img"></span>
                                                <img src="<?php echo $close_btn_background_img ; ?>" id="ays_close_btn_bg_img"/>
                                                <input type="hidden" name="ays_pb_close_btn_bg_img" id="close_btn_bg_img"
                                                    value="<?php echo $close_btn_background_img; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- close button image end  -->
                                <hr class="ays_pb_close_bttn_option <?php echo $close_button == 'on' ? 'display_none' : ''; ?>">
                                <!-- close button color start  -->
                                <div class="form-group row ays_pb_close_bttn_option <?php echo $close_button == 'on' ? 'display_none' : ''; ?>">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_close_button_color">
                                            <span>
                                                <?php echo  esc_html__('Close button color',"ays-popup-box") ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Define the close button color.", "ays-popup-box"); ?>">
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 ays_divider_left">
                                        <input type="text" id="ays_pb_close_button_color"  data-alpha="true" class="" name="ays_pb_close_button_color" value="<?php echo $close_button_color; ?>"  Fdata-default-color="#000000">
                                    </div>
                                </div>
                                <!-- close button color end  -->
                                <hr class="ays_pb_close_bttn_option <?php echo $close_button == 'on' ? 'display_none' : ''; ?>">
                                <!-- close button hover color start  -->
                                <div class="form-group row ays_pb_close_bttn_option <?php echo $close_button == 'on' ? 'display_none' : ''; ?>">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_close_button_hover_color">
                                            <span>
                                                <?php echo  esc_html__('Close button hover color',"ays-popup-box") ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Define the close button color on hover.", "ays-popup-box"); ?>">
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 ays_divider_left">
                                        <input type="text" id="ays_pb_close_button_hover_color"  data-alpha="true" class="" name="ays_pb_close_button_hover_color" value="<?php echo $close_button_hover_color; ?>"  Fdata-default-color="#000000">
                                    </div>
                                </div>
                                <!-- close button hover color end  -->
                                <hr class="ays_pb_close_bttn_option <?php echo $close_button == 'on' ? 'display_none' : ''; ?>">
                                <!-- close button size start  -->
                                <div class="form-group row ays_pb_close_bttn_option <?php echo $close_button == 'on' ? 'display_none' : ''; ?>">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_close_button_size">
                                            <span>
                                                <?php echo  esc_html__('Close button size',"ays-popup-box") ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__("Define the close button size in pixels.", "ays-popup-box"); ?>">
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 ays_divider_left">
                                        <input id="ays_pb_close_button_size" type="number" class="ays-pb-text-input ays-pb-text-input-short" name="ays_pb_close_button_size" value="<?php echo $ays_close_button_size; ?>">
                                    </div>
                                </div>
                                <!-- close button size end  -->
                                <hr>
                            </div>
                        </div>
                        <div class="ays-pb-accordion-options-main-container">
                            <div class="ays-pb-accordion-header">
                                <?php echo wp_kses($pb_acordion_svg_html, $allow_tags_acordion_arrow); ?>
                                <p class="ays-subtitle"><?php echo  esc_html__('Advanced style', "ays-popup-box") ?></p>
                            </div>
                            <hr class="ays-pb-bolder-hr"/>
                            <div class="ays-pb-accordion-body">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_enable_box_shadow">
                                            <?php echo esc_html__('Box shadow',"ays-popup-box"); ?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Allow popup container box shadow.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 ays_divider_left ays-pb-box-shadow">
                                        <div class="ays_toggle_slide_mobile_option_container">
                                            <div class="form-group row" style="align-items: center;">
                                                <div class="col-sm-3">
                                                    <label for="ays_pb_enable_box_shadow">
                                                        <?php echo  esc_html__('On desktop',"ays-popup-box") ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Define the box shadow for desktop devices.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="checkbox" class="ays_toggle ays_toggle_slide ays_toggle_slide_mobile_option" id="ays_pb_enable_box_shadow" name="ays_pb_enable_box_shadow" <?php echo ($enable_box_shadow == 'on') ? 'checked' : ''; ?>/>
                                                    <label for="ays_pb_enable_box_shadow" class="ays_switch_toggle">Toggle</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 ays_toggle_target ays_divider_top" style="margin-top: 10px; padding-top: 10px; <?php echo ($enable_box_shadow == 'on') ? '' : 'display:none;' ?>">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label for="ays_pb_box_shadow_color">
                                                            <?php echo esc_html__('Color',"ays-popup-box")?>
                                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('The color of the shadow of the popup container',"ays-popup-box" ); ?>">
                                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                            </a>
                                                        </label>
                                                        <input type="text" class="ays-text-input" id='ays_pb_box_shadow_color' name='ays_pb_box_shadow_color' data-alpha="true" data-default-color="#000000" value="<?php echo $box_shadow_color; ?>"/>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <div class="col-sm-4" style="display: inline-block;">
                                                        <span class="ays_pb_small_hint_text"><?php echo esc_html__('X', "ays-popup-box"); ?></span>
                                                        <input type="number" class="ays-text-input ays-text-input-90-width" id='ays_pb_box_shadow_x_offset' name='ays_pb_box_shadow_x_offset' value="<?php echo $pb_box_shadow_x_offset; ?>" />
                                                    </div>
                                                    <div class="col-sm-4 ays_divider_left" style="display: inline-block;">
                                                        <span class="ays_pb_small_hint_text"><?php echo esc_html__('Y', "ays-popup-box"); ?></span>
                                                        <input type="number" class="ays-text-input ays-text-input-90-width" id='ays_pb_box_shadow_y_offset' name='ays_pb_box_shadow_y_offset' value="<?php echo $pb_box_shadow_y_offset; ?>" />
                                                    </div>
                                                    <div class="col-sm-4 ays_divider_left" style="display: inline-block;">
                                                        <span class="ays_pb_small_hint_text"><?php echo esc_html__('Z', "ays-popup-box"); ?></span>
                                                        <input type="number" class="ays-text-input ays-text-input-90-width" id='ays_pb_box_shadow_z_offset' name='ays_pb_box_shadow_z_offset' value="<?php echo $pb_box_shadow_z_offset; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="ays_toggle_slide_mobile_option_container">
                                            <div class="form-group row" style="align-items: center;">
                                                <div class="col-sm-3">
                                                    <label for="ays_pb_enable_box_shadow_mobile">
                                                        <?php echo  esc_html__('On Mobile',"ays-popup-box") ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Define the box shadow for mobile devices.',"ays-popup-box")?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="checkbox" class="ays_toggle ays_toggle_slide ays_toggle_slide_mobile_option" id="ays_pb_enable_box_shadow_mobile" name="ays_pb_enable_box_shadow_mobile" <?php echo ($enable_box_shadow_mobile == 'on') ? 'checked' : ''; ?>/>
                                                    <label for="ays_pb_enable_box_shadow_mobile" class="ays_switch_toggle">Toggle</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 ays_toggle_target ays_divider_top" style="margin-top: 10px; padding-top: 10px; <?php echo ($enable_box_shadow_mobile == 'on') ? '' : 'display:none;' ?>">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label for="ays_pb_box_shadow_color_mobile">
                                                            <?php echo esc_html__('Color',"ays-popup-box")?>
                                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('The color of the shadow of the popup container',"ays-popup-box" ); ?>">
                                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                            </a>
                                                        </label>
                                                        <input type="text" class="ays-text-input" id='ays_pb_box_shadow_color_mobile' name='ays_pb_box_shadow_color_mobile' data-alpha="true" data-default-color="#000000" value="<?php echo $box_shadow_color_mobile; ?>"/>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <div class="col-sm-4" style="display: inline-block;">
                                                        <span class="ays_pb_small_hint_text"><?php echo esc_html__('X', "ays-popup-box"); ?></span>
                                                        <input type="number" class="ays-text-input ays-text-input-90-width" id='ays_pb_box_shadow_x_offset_mobile' name='ays_pb_box_shadow_x_offset_mobile' value="<?php echo $pb_box_shadow_x_offset_mobile; ?>" />
                                                    </div>
                                                    <div class="col-sm-4 ays_divider_left" style="display: inline-block;">
                                                        <span class="ays_pb_small_hint_text"><?php echo esc_html__('Y', "ays-popup-box"); ?></span>
                                                        <input type="number" class="ays-text-input ays-text-input-90-width" id='ays_pb_box_shadow_y_offset_mobile' name='ays_pb_box_shadow_y_offset_mobile' value="<?php echo $pb_box_shadow_y_offset_mobile; ?>" />
                                                    </div>
                                                    <div class="col-sm-4 ays_divider_left" style="display: inline-block;">
                                                        <span class="ays_pb_small_hint_text"><?php echo esc_html__('Z', "ays-popup-box"); ?></span>
                                                        <input type="number" class="ays-text-input ays-text-input-90-width" id='ays_pb_box_shadow_z_offset_mobile' name='ays_pb_box_shadow_z_offset_mobile' value="<?php echo $pb_box_shadow_z_offset_mobile; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- popup box shadow -->
                                <hr>    
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="ays_pb_bg_image_direction_on_mobile">
                                            <?php echo esc_html__('Background image style on mobile',"ays-popup-box"); ?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('On mobile mode the background image will change it style and it will be displayed at the top of the text. Note: It will work only for the Sale template.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 ays_divider_left">
                                        <input type="checkbox" class="" id='ays_pb_bg_image_direction_on_mobile' name='ays_pb_bg_image_direction_on_mobile' value="on" <?php echo $pb_bg_image_direction_on_mobile ? 'checked' : ''; ?>>
                                    </div>
                                </div> <!-- Image position for mobile -->
                                <hr>    
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="custom_class">
                                            <?php echo esc_html__('Custom class for popup container ',"ays-popup-box")?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Use your custom HTML class for adding your custom styles to popup container.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 ays_divider_left">
                                        <input type="text" class="ays-pb-text-input ays-pb-text-input-short" name="<?php echo esc_attr($this->plugin_name); ?>[custom-class]" id="custom_class" placeholder="myClass myAnotherClass..." value="<?php echo $custom_class; ?>">
                                    </div>
                                </div>
                                <hr>
                                <div class="ays-field">
                                    <label for="<?php echo esc_attr($this->plugin_name); ?>-custom-css">
                                        <span><?php echo esc_html__('Custom CSS', "ays-popup-box"); ?></span>
                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Field for entering your own CSS code.',  "ays-popup-box")?>">
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                        </a>
                                    </label>
                                    <textarea id="<?php echo esc_attr($this->plugin_name); ?>-custom-css"  class="ays-textarea" name="<?php echo esc_attr($this->plugin_name); ?>[custom-css]"><?php echo esc_attr($custom_css); ?></textarea>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="custom_class">
                                            <?php echo esc_html__('Reset styles',"ays-popup-box")?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Reset popup styles to default values',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 ays_divider_left">
                                        <input type="button" class="ays-pb-reset-styles button btn" value="Reset">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 ays_pb_hide_for_facebook_type ays_pb_hide_for_notification_type <?php echo $modal_content == 'facebook_type' || $modal_content == 'notification_type' ? 'display_none' : ''; ?>">
                        <div class="popup_preview" >
                            <p style="font-weight: normal; font-style: italic; font-size: 14px; color: grey; margin:0; padding:0;"><?php echo esc_html__("See PopupBox in live preview", "ays-popup-box"); ?></p>
                            <div class='ays-pb-modals'>
                                <input type='hidden' id='ays_pb_modal_animate_in'>
                                <input type='hidden' id='ays_pb_modal_animate_out'>
                                <input id='ays-pb-modal-checkbox' class='ays-pb-modal-check' type='checkbox' checked/>
                                <div class='ays-pb-live-container ays-pb-live-container-main ays-pb-modal ays_bg_image_box <?php echo ($view_type == 'default') ? 'ays_active' : 'display_none'; ?>' id="ays-pb-live-container">
                                    <label class='ays-pb-modal-close ays-close-button-on-off close_btn_label ays-close-button-text <?php $close_button == "on" ? "display_none_important" : ""; ?>'>
                                        <img class='close_btn_img' src='<?php echo $close_btn_background_img; ?>' width='30' height='30' style='<?php echo $close_btn_img_display; ?>'>
                                        <?php
                                                if ($close_button_text === '✕') {
                                                    echo "<img src='" . esc_url(AYS_PB_ADMIN_URL) . "/images/icons/times-2x.svg' class='close_btn_text' style='".$close_btn_text_display."'>";
                                                }else{
                                                   echo $close_button_text;
                                                }
                                        ?>
                                    </label>
                                    
                                    <h2 class="ays_title" style='<?php echo $hide_title ;?>; color: <?php echo $textcolor;?>'></h2>
                                    <p class="desc" style='font-size:<?php echo $pb_font_size?>px; color: <?php echo $textcolor; ?>  '></p>
                                    <hr class="title_hr" style="<?php echo $hide_title ;?>" />
                                    <div class="ays_modal_content"><span><?php echo esc_html__("Here can be custom HTML or shortcode", "ays-popup-box"); ?></span></div>
                                    <?php echo $ays_pb_timer_desc; ?>
                                </div>
                                <div class='ays-pb-live-container ays-pb-live-container-main ays_window ays_bg_image_box <?php echo ($view_type == 'mac') ? 'ays_active' : 'display_none'; ?>'>
                                    <div class='ays_topBar'>
                                        <label class='ays-pb-modal-close ays_close ays-close-button-on-off <?php $close_button == 'on' ? 'display_none_important' : ''; ?>'><img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/times-2x.svg"?>"></label>
                                        <a class='ays_hide'></a>
                                        <a class='ays_fullScreen'></a>
                                        <h2 class="ays_title" style='<?php echo $hide_title ;?>; color: <?php echo $textcolor; ?>'></h2>
                                    </div>
                                    <hr />
                                    <div class='ays_text'>
                                        <div class='ays_text-inner'>
                                            <p class="desc" style='font-size:<?php echo $pb_font_size?>px <?php echo $hide_desc ;?>'></p>
                                            <hr />
                                            <div class="ays_modal_content"><span><?php echo esc_html__("Here can be custom HTML or shortcode", "ays-popup-box"); ?></span></div>
                                        </div>
                                    </div>
                                    <?php echo $ays_pb_timer_desc; ?>
                                </div>
                                <div class='ays-pb-live-container ays-pb-live-container-main ays_cmd_window ays_bg_image_box <?php echo ($view_type == 'cmd') ? 'ays_active' : 'display_none'; ?>'>
                                    <header class='ays_cmd_window-header'>
                                        <div class='ays_cmd_window_title'><h2 class="ays_title" style='<?php echo $hide_title ;?>; color: <?php echo $textcolor; ?>'></h2></div>
                                        <nav class='ays_cmd_window-controls'>
                                            <span class='ays_cmd_control-item ays_cmd_control-minimize ays_cmd_js-minimize'>-</span>
                                            <span class='ays_cmd_control-item ays_cmd_control-maximize ays_cmd_js-maximize'>□</span>
                                            <label for='ays-pb-modal-checkbox' class='ays_cmd_control-item ays_cmd_control-close ays-close-button-on-off'><span class='ays_cmd_control-close ays_cmd_js-close'>˟</span></label>
                                        </nav>
                                    </header>
                                    <div class='ays_cmd_window-cursor'>
                                        <span class='ays_cmd_i-cursor-indicator'>></span>
                                        <span class='ays_cmd_i-cursor-underscore'></span>
                                        <input type='text' disabled class='ays_cmd_window-input ays_cmd_js-prompt-input' />
                                    </div>
                                    <main class='ays_cmd_window-content'>
                                        <div class='ays_text'>
                                            <div class='ays_text-inner'>
                                                <p class="desc" style='font-size:<?php echo $pb_font_size?>px  <?php echo $hide_desc ;?>'></p>
                                                <div class="ays_modal_content"><span><?php echo esc_html__("Here can be custom HTML or shortcode", "ays-popup-box"); ?></span></div>
                                            </div>
                                        </div>
                                        <?php echo $ays_pb_timer_desc; ?>
                                    </main>
                                </div>
                                <div class='ays-pb-live-container ays-pb-live-container-main ays_ubuntu_window ays_bg_image_box <?php echo ($view_type == 'ubuntu') ? 'ays_active' : 'display_none'; ?>'>
                                    <div class='ays_ubuntu_topbar'>
                                        <div class='ays_ubuntu_icons'>
                                            <div class='ays_ubuntu_close ays-close-button-on-off'></div>
                                            <div class='ays_ubuntu_hide'></div>
                                            <div class='ays_ubuntu_maximize'></div>
                                        </div>
                                        <h2 class="ays_title" style='<?php echo $hide_title ;?>; color: <?php echo $textcolor; ?>'></h2>
                                    </div>
                                    <div class='ays_ubuntu_tools'>
                                        <ul>
                                            <li><span>File</span></li>
                                            <li><span>Edit</span></li>
                                            <li><span>Go</span></li>
                                            <li><span>Bookmarks</span></li>
                                            <li><span>Tools</span></li>
                                            <li><span>Help</span></li>
                                        </ul>
                                    </div>
                                    <div class='ays_ubuntu_window_content'>
                                        <p class="desc" style='font-size:<?php echo $pb_font_size?>px <?php echo $hide_desc ;?>'></p>
                                        <hr />
                                        <div class="ays_modal_content"><span><?php echo esc_html__("Here can be custom HTML or shortcode", "ays-popup-box"); ?></span></div>
                                    </div>
                                    <div class='ays_ubuntu_folder-info'>
                                    <?php echo $ays_pb_timer_desc; ?>
                                    </div>
                                </div>
                                <div class='ays-pb-live-container-main ays_winxp_window <?php echo ($view_type == 'winXP') ? 'ays_active' : 'display_none'; ?>'>
                                    <div class='ays_winxp_title-bar'>
                                        <div class='ays_winxp_title-bar-title'>
                                            <h2 class="ays_title" style='<?php echo $hide_title ;?>; color: <?php echo $textcolor; ?>'></h2>
                                        </div>
                                        <div class='ays_winxp_title-bar-close ays-close-button-on-off'>
                                            <label for='ays-pb-modal-checkbox' class='ays_winxp_close ays-pb-modal-close'></label>
                                        </div>
                                        <div class='ays_winxp_title-bar-max'></div>
                                        <div class='ays_winxp_title-bar-min'></div>
                                    </div>
                                    <div class='ays_winxp_content ays-pb-live-container ays_bg_image_box'>
                                        <p class="desc" style='font-size:<?php echo $pb_font_size?>px <?php echo $hide_desc ;?>'></p>
                                        <hr />
                                        <div class="ays_modal_content"><span><?php echo esc_html__("Here can be custom HTML or shortcode", "ays-popup-box"); ?></span></div>
                                        <?php echo $ays_pb_timer_desc; ?>
                                    </div>
                                </div>
                                <div class='ays-pb-live-container ays-pb-live-container-main ays_win98_window ays_bg_image_box <?php echo ($view_type == 'win98') ? 'ays_active' : 'display_none'; ?>'>
                                    <header class='ays_win98_head'>
                                        <div class='ays_win98_header'>
                                            <div class='ays_win98_title'>
                                                <h2 class="ays_title" style='<?php echo $hide_title ;?>; color: <?php echo $textcolor; ?>'></h2>
                                            </div>
                                            <div class='ays_win98_btn-close ays-close-button-on-off'><label for='ays-pb-modal-checkbox' class='ays-pb-modal-close'><span class="ays-close-button-text"><?php echo $close_button_text ?></span></label></div>
                                        </div>
                                    </header>
                                    <div class='ays_win98_main '>
                                        <div class='ays_win98_content'>
                                            <p class="desc" style='font-size:<?php echo $pb_font_size?>px <?php echo $hide_desc ;?>'></p>
                                            <hr />
                                            <div class="ays_modal_content"><span><?php echo esc_html__("Here can be custom HTML or shortcode", "ays-popup-box"); ?></span></div>
                                            <?php echo $ays_pb_timer_desc; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class='ays-pb-live-container ays-pb-live-container-main ays_lil_window ays_bg_image_box <?php echo ($view_type == 'lil') ? 'ays_active' : 'display_none'; ?>' data-name="red">
                                    <header class='ays_lil_head'>
                                    <label class='close-lil-btn ays-close-button-take-text-color ays-close-button-on-off ays-close-button-text close_btn_label <?php $close_button == 'on' ? 'display_none_important' : ''; ?>'>
                                        <img class='close-image-btn ays-close-button-take-text-color ays-close-button-on-off ays-close-button-text close_btn_img' src='<?php echo $close_btn_background_img; ?>' width='50' height='50' style='<?php echo $close_btn_img_display; ?>'/>
                                        <a class='ays-close-button-take-text-color ays-close-button-on-off ays-close-button-text close_btn_text' style='<?php echo $close_btn_text_display ?>'>        
                                            <?php echo $close_button_text; ?>
                                        </a>
                                    </label>
                                        <h2 class="ays_title_lil ays_title" style='<?php echo $hide_title ;?> color: <?php echo $textcolor; ?>'></h2>
                                    </header>
                                    <div class='ays_lil_content'>
                                        <p class="desc" style='font-size:<?php echo $pb_font_size?>px margin: 0; <?php echo $hide_desc ;?>'></p>
                                        <div class="ays_modal_content"><span><?php echo esc_html__("Here can be custom HTML or shortcode", "ays-popup-box"); ?></span></div>
                                        <?php echo $ays_pb_timer_desc; ?>
                                    </div>
                                </div>
                                <div class='ays-pb-live-container ays-pb-live-container-main ays_image_window ays_bg_image_box <?php echo ($view_type == 'image') ? 'ays_active' : 'display_none'; ?>' id="ays-image-window">
                                    <header class='ays_image_head'>
                                        <label for='ays-pb-modal-checkbox' class='close_btn_label <?php $close_button == 'on' ? 'display_none_important' : ''; ?>'>
                                            
                                                <img class='close-image-btn ays-close-button-take-text-color ays-close-button-on-off ays-close-button-text close_btn_img' src='<?php echo $close_btn_background_img; ?>' width='30' height='30' style='<?php echo $close_btn_img_display; ?>' />
                                                <a class='close-image-btn ays-close-button-on-off ays-close-button-text ays-close-button-take-text-color close_btn_text' style='<?php echo $close_btn_text_display;?>'>
                                                    <?php echo $close_button_text;?>
                                                </a>
                                        <h2 class="ays_title_image ays_title" style='<?php echo $hide_title ;?> color: <?php echo $textcolor; ?>'></h2>
                                        <p class="desc" style='font-size:<?php echo $pb_font_size?>px margin: 0; <?php echo $hide_desc ;?> color: <?php echo $textcolor; ?>'></p>
                                    </header>
                                    <div class='ays_image_content '>
                                        <div class="ays_modal_content"><span><?php echo esc_html__("Here can be custom HTML or shortcode", "ays-popup-box"); ?></span></div>
                                        <?php echo $ays_pb_timer_desc; ?>
                                    </div>
                                </div>
                                <div class='ays-pb-live-container ays-pb-live-container-main ays_minimal_window ays_bg_image_box <?php echo ($view_type == 'minimal') ? 'ays_active' : 'display_none'; ?>' id="ays-minimal-window">
                                    <header class='ays_minimal_head'>
                                        <label for='ays-pb-modal-checkbox' class='close_btn_label <?php $close_button == 'on' ? 'display_none_important' : ''; ?>'>
                                            
                                                <img class='close-image-btn close-minimal-btn ays-close-button-take-text-color ays-close-button-on-off ays-close-button-text close_btn_img' src='<?php echo $close_btn_background_img; ?>' width='30' height='30' style='<?php echo $close_btn_img_display; ?>' />
                                                <a class='close-image-btn ays-close-button-on-off ays-close-button-text ays-close-button-take-text-color close_btn_text' style='<?php echo $close_btn_text_display;?>'>
                                                     <?php
                                                if ($close_button_text === '✕') {
                                                    echo "<img src='" . esc_url(AYS_PB_ADMIN_URL) . "/images/icons/times-circle.svg'>";
                                                }else{
                                                    echo $close_button_text;
                                                }
                                        ?>
                                                </a>
                                        <h2 class="ays_title_minimal ays_title" style='<?php echo $hide_title ;?> color: <?php echo $textcolor; ?>'></h2>
                                        <p class="desc" style='font-size:<?php echo $pb_font_size?>px margin: 0; <?php echo $hide_desc ;?> color: <?php echo $textcolor; ?>'></p>
                                    </header>
                                    <div class='ays_image_content '>
                                        <div class="ays_modal_content"><span><?php echo esc_html__("Here can be custom HTML or shortcode", "ays-popup-box"); ?></span></div>
                                        <?php echo $ays_pb_timer_desc; ?>
                                    </div>
                                </div>
                                <div class='ays-pb-live-container ays-pb-live-container-main ays_template_window <?php echo ($view_type == 'template') ? 'ays_active' : 'display_none'; ?>'>
                                    <header class='ays_template_head' style='<?php echo $header_height;?>;<?php echo $header_padding; ?>'>
                                        <label for='ays-pb-modal-checkbox' class='close_btn_label <?php $close_button == 'on' ? 'display_none_important' : ''; ?>' style='margin-bottom:0;'>
                                            <img class='close-template-btn ays-close-button-take-text-color ays-close-button-on-off ays-close-button-text close_btn_img' src='<?php echo $close_btn_background_img; ?>' width='30' height='30' style='<?php echo $close_btn_img_display ?>'/>
                                            <a class='close-template-btn ays-close-button-take-text-color ays-close-button-on-off ays-close-button-text close_btn_text' style='<?php echo $close_btn_text_display;?>'>
                                                <?php echo $close_button_text; ?>
                                            </a>
                                        </label>
                                        <h2 class="ays_title_template ays_title" style='<?php echo $hide_title ;?> color: <?php echo $textcolor; ?>'></h2>
                                    </header>
                                    <footer class='ays_template_footer' style='<?php echo $calck_template_footer; ?>'>
                                        <div class="ays_bg_image_box"></div>
                                        <div class='ays_template_content '>
                                            <p class="desc" style='font-size:<?php echo $pb_font_size?>px margin: 0; <?php echo $hide_desc ;?> color: <?php echo $textcolor; ?>'></p>
                                            <div class="ays_modal_content"><span><?php echo esc_html__("Here can be custom HTML or shortcode", "ays-popup-box"); ?></span></div>
                                            <?php echo $ays_pb_timer_desc; ?>
                                        </div>
                                    </footer>
                                </div>
                                <!-- Video type | Video theme start -->
                                <div class='ays-pb-live-container ays-pb-live-container-main ays_video_window <?php echo ($view_type == 'video') ? 'ays_active' : 'display_none'; ?>'>
                                    <div class='ays_video_head'>
                                        <label for='ays-pb-modal-checkbox ' class="close_btn_label <?php $close_button == 'on' ? 'display_none_important' : ''; ?>" style='margin-bottom:0;'>
                                            <img class='close-video-btn ays-close-button-take-text-color ays-close-button-on-off ays-close-button-text close_btn_img' src='<?php echo $close_btn_background_img; ?>' width='30' height='30' style='<?php echo $close_btn_img_display ?>'/>
                                            <a class="close-video-btn ays-close-button-on-off ays-close-button-text close_btn_text" style='<?php echo $close_btn_text_display;?>'><?php echo $close_button_text ?></a></label>
                                    </div>
                                    <div class="ays_modal_content ays_video_content"> 
                                        <video controls autoplay src="<?php echo $live_container_video_src; ?>" class="video_theme" style="border-radius:<?php echo wp_unslash( $border_radius );?>px; width:680px;" ></video>
                                    </div>
                                    <div class="ays_pb_timer_container">
                                        <p class='ays_pb_timer'><?php echo esc_html__("This will close in ", "ays-popup-box"); ?><span data-seconds='20'>20</span> <?php echo esc_html__("seconds", "ays-popup-box"); ?></p>
                                    </div>
                                    <input type="hidden" value="<?php echo esc_url(AYS_PB_ADMIN_URL.'/videos/video_theme.mp4'); ?>">
                                </div>
                                <!-- Video type | Video theme end -->
                                <!-- Image type | image theme start -->
                                <div class='ays-pb-live-container ays-pb-live-container-main ays_image_type_img_window ays_bg_image_box <?php echo ($view_type == 'image_type_img_theme') ? 'ays_active' : 'display_none'; ?>' style="border-radius:<?php echo wp_unslash( $border_radius );?>px;">
                                    <label class='ays-pb-modal-close ays-close-button-on-off close_btn_label ays-close-button-text <?php $close_button == 'on' ? 'display_none_important' : ''; ?>'>
                                        <img class='close_btn_img' src='<?php echo $close_btn_background_img; ?>' width='30' height='30' style='<?php echo $close_btn_img_display; ?>'>
                                        <?php
                                            if ($close_button_text === '✕') {
                                                echo "<img src='" . esc_url(AYS_PB_ADMIN_URL) . "/images/icons/times-2x.svg' class='close_btn_text' style='".$close_btn_text_display."'>";
                                            }else{
                                                echo $close_button_text;
                                            }
                                        ?>
                                    </label>
                                    <div class="ays_modal_content ays_image_type_img_content"> 
                                        <img src="<?php echo $image_type_img_src; ?>" class="image_type_img_live"></video>
                                    </div>
                                    <?php echo $ays_pb_timer_desc; ?>
                                </div>
                                <!-- Image type | image theme end -->
                                <!-- Facebook theme start -->
                                <div class='ays-pb-live-container ays-pb-live-container-main ays_facebook_window ays_bg_image_box <?php echo ($view_type == 'facebook') ? 'ays_active' : 'display_none'; ?>'>
                                    <label class='ays-pb-modal-close ays-close-button-on-off close_btn_label ays-close-button-text <?php $close_button == 'on' ? 'display_none_important' : ''; ?>'>
                                        <img class='close_btn_img' src='<?php echo $close_btn_background_img; ?>' width='30' height='30' style='<?php echo $close_btn_img_display; ?>'>
                                        <?php
                                                if ($close_button_text === '✕') {
                                                    echo "<img src='" . esc_url(AYS_PB_ADMIN_URL) . "/images/icons/times-2x.svg' class='close_btn_text' style='".$close_btn_text_display."'>";
                                                }else{
                                                   echo $close_button_text;
                                                }
                                        ?>
                                    </label>
                                    <h2 class="ays_title" style='<?php echo $hide_title ;?>; color: <?php echo $textcolor; ?>'></h2>
                                    <p class="desc" style='font-size:<?php echo $pb_font_size?>px;'></p>
                                    <hr class="title_hr" style="<?php echo $hide_title ;?>" />
                                    <div class="ays_modal_content"><span></span></div>
                                    <?php echo $ays_pb_timer_desc; ?>
                                </div>
                                <!-- Facebook theme end -->
                                <div id='ays-pb-screen-shade'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Limitation user start -->
            <div id="tab4" class="ays-pb-tab-content  <?php echo ($ays_pb_tab == 'tab4') ? 'ays-pb-tab-content-active' : ''; ?>">
                <div class="ays-pb-accordion-options-main-container">
                    <div class="d-flex justify-content-end align-items-center">
                        <div class="d-flex justify-content-between align-items-center" style="gap: 5px; font-size: 13px">
                            <div>
                                <a href="javascript:void(0);" class="ays-pb-collapse-all-options"><?php echo esc_html__("Collapse All", "ays-popup-box"); ?></a>
                            </div>    
                            |               
                            <div>
                                <a href="javascript:void(0);" class="ays-pb-expand-all-options"><?php echo esc_html__("Expand All", "ays-popup-box"); ?></a>
                            </div>                   
                        </div>
                    </div>
                    <div class="ays-pb-accordion-header">
                        <?php echo wp_kses($pb_acordion_svg_html, $allow_tags_acordion_arrow); ?>
                        <p class="ays-subtitle"><?php echo esc_html__('Limitation of Users', "ays-popup-box") ?></p>
                    </div>
                    <hr class="ays-pb-bolder-hr"/>
                    <div class="ays-pb-accordion-body">
                        <div class="ays_toggle_parent">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="ays_pb_show_only_once">
                                        <span><?php echo esc_html__('Display popup once per user', "ays-popup-box"); ?></span>
                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Enable this option to display the popup once per visitor.', "ays-popup-box"); ?>">
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                        </a>
                                    </label>
                                </div>
                                <div class="col-sm-9">
                                    <p class="onoffswitch">
                                        <input type="checkbox" name="ays_pb_show_only_once" class="ays-pb-onoffswitch-checkbox ays_toggle_checkbox" id="ays_pb_show_only_once" <?php echo ($show_only_once == 'on') ? 'checked' : '' ?> >
                                    </p>
                                </div>
                            </div>
                            <div class="ays_toggle_target" style="<?php echo ($show_only_once == 'on') ? '' : 'display:none;' ?>">
                                <div class="ays_pb_cookie_warning_message_container">
                                    <div class="ays_pb_cookie_warning_message_image_content">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/warning.svg"?>">
                                    </div>
                                    <div class="ays_pb_cookie_warning_message_text_content">
                                        <p>
                                            <?php echo esc_html__('Note: This option works via cookies. If you are using a plugin that disables cookies, there may be a conflict leading to the incorrect operation of this feature.', "ays-popup-box"); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="ays_toggle_parent">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="<?php echo esc_attr($this->plugin_name); ?>-ays_pb_cookie">
                                        <span style="font-size: 15px;"><?php echo esc_html__("Display once per session", "ays-popup-box"); ?></span>
                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Define the interval between the popup sessions in minutes. To disable the option, set 0. E.g. set it to 1440 to show the popup once a day to each user.', "ays-popup-box"); ?>">
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                        </a>
                                    </label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="number" id="<?php echo esc_attr($this->plugin_name); ?>-ays_pb_cookie" name="<?php echo esc_attr($this->plugin_name); ?>[cookie]" class="ays-pb-text-input ays-pb-text-input-short ays_toggle_input" value="<?php echo $cookie; ?>" />
                                </div>
                            </div>
                            <div class="ays_toggle_target" style="<?php echo ($cookie > 0) ? '' : 'display:none;' ?>">
                                <div class="ays_pb_cookie_warning_message_container">
                                    <div class="ays_pb_cookie_warning_message_image_content">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/warning.svg"?>">
                                    </div>
                                    <div class="ays_pb_cookie_warning_message_text_content">
                                        <p>
                                            <?php echo esc_html__('Note: This option works via cookies. If you are using a plugin that disables cookies, there may be a conflict leading to the incorrect operation of this feature.', "ays-popup-box"); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="ays_toggle_parent">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="<?php echo esc_attr($this->plugin_name); ?>-log-user">
                                        <span><?php echo esc_html__('Display for logged-in users', "ays-popup-box"); ?></span>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo esc_html__('Enable this option to display the popup for logged-in users.', "ays-popup-box") ?>">
                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                        </a>
                                    </label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="onoffswitch col-sm-2">
                                            <input type="checkbox" name="<?php echo esc_attr($this->plugin_name); ?>[log_user]" class="ays-pb-onoffswitch-checkbox ays_toggle_checkbox" id="<?php echo esc_attr($this->plugin_name); ?>-log-user" <?php if($log_user == 'On'){ echo 'checked';} else { echo '';} ?> />
                                        </div>
                                        <div class="col-sm-10 ays_toggle_target ays_divider_left" style="<?php echo ($log_user == 'On') ? '' : 'display:none;' ?>:">
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label for="<?php echo esc_attr($this->plugin_name); ?>-users_role">
                                                        <span><?php echo esc_html__('Display for certain user roles', "ays-popup-box"); ?></span>
                                                        <a class="ays_help" data-toggle="tooltip"
                                                        title="<?php echo esc_html__('Show the popup only to certain user role(s) mentioned in the list. Leave it blank for showing the popup to all user roles.', "ays-popup-box") ?>">
                                                            <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-9 ays-pb-users-roles ays_pb_users_roles">
                                                    <select name="<?php echo esc_attr($this->plugin_name); ?>[ays_users_roles][]" id="ays_users_roles" multiple class="">
                                                        <?php
                                                        foreach ($ays_users_roles as $key => $user_role) {
                                                            $selected_role = "";
                                                            if(is_array($users_role)){
                                                                if(in_array($user_role['name'], $users_role)){
                                                                    $selected_role = 'selected';
                                                                }else{
                                                                    $selected_role = '';
                                                                }
                                                            }else{
                                                                if($users_role == $user_role['name']){
                                                                    $selected_role = 'selected';
                                                                }else{
                                                                    $selected_role = '';
                                                                }
                                                            }
                                                            echo "<option value='" . $user_role['name'] . "' " . $selected_role . ">" . $user_role['name'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="<?php echo esc_attr($this->plugin_name); ?>-guest">
                                    <span><?php echo esc_html__('Display for guests', "ays-popup-box"); ?></span>
                                    <a class="ays_help" data-toggle="tooltip"
                                       title="<?php echo esc_html__('Enable this option to display the popup for guest visitors.', "ays-popup-box") ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <p class="onoffswitch">
                                    <input type="checkbox" name="<?php echo esc_attr($this->plugin_name); ?>[guest]" class="ays-pb-onoffswitch-checkbox" id="<?php echo esc_attr($this->plugin_name); ?>-guest" <?php if($guest == 'On'){ echo 'checked';} else { echo '';} ?> />
                                </p>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="ays-pb-mobile">
                                    <span><?php echo esc_html__('Hide popup on mobile', "ays-popup-box"); ?></span>
                                    <a class="ays_help" data-toggle="tooltip"
                                       title="<?php echo esc_html__('Disable the popup on mobile devices.', "ays-popup-box") ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <p class="onoffswitch">
                                    <input type="checkbox" name="ays_pb_mobile" class="ays-pb-onoffswitch-checkbox" id="ays-pb-mobile" value='on' <?php if($ays_pb_mobile == 'on'){ echo 'checked';} else { echo '';} ?> />
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="ays_pb_hide_on_pc">
                                    <span><?php echo esc_html__('Hide popup on desktop', "ays-popup-box"); ?></span>
                                    <a class="ays_help" data-toggle="tooltip"
                                       title="<?php echo esc_html__('Disable the popup on desktop.', "ays-popup-box") ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <p class="onoffswitch">
                                    <input type="checkbox" name="ays_pb_hide_on_pc" class="ays-pb-onoffswitch-checkbox" id="ays_pb_hide_on_pc" value='on' <?php echo $ays_pb_hide_on_pc ? 'checked' : ''; ?> />
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="ays_pb_hide_on_tablets">
                                    <span><?php echo esc_html__('Hide popup on tablets', "ays-popup-box"); ?></span>
                                    <a class="ays_help" data-toggle="tooltip"
                                       title="<?php echo esc_html__('Disable the popup on tablets.', "ays-popup-box") ?>">
                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <p class="onoffswitch">
                                    <input type="checkbox" name="ays_pb_hide_on_tablets" class="ays-pb-onoffswitch-checkbox" id="ays_pb_hide_on_tablets" value='on' <?php echo $ays_pb_hide_on_tablets ? 'checked' : ''; ?> />
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row" style="margin:0;">
                            <div class="col-sm-12 ays-pro-features-v2-main-box">
                                <div class="ays-pro-features-v2-small-buttons-box">
                                    <!-- <div>
                                        <a href="https://youtu.be/aFrtPsznVx4?list=PL4ufu1uAjjWQTYn0O_72TLzmqgmVIYKI2" target="_blank" class="ays-pro-features-v2-video-button">
                                            <div>
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/pro-features-icons/Video_24x24.svg" ?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/pro-features-icons/Video_24x24_Hover.svg" ?>" class="ays-pb-new-video-button-hover">
                                            </div>
                                            <div class="ays-pro-features-v2-video-text">
                                                <?php echo esc_html__("Watch Video" , "ays-popup-box"); ?>
                                            </div>
                                        </a>
                                    </div> -->
                                    <a href="https://popup-plugin.com/" target="_blank" class="ays-pro-features-v2-upgrade-button">
                                        <div class="ays-pro-features-v2-upgrade-icon" style="background-image: url('<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg');" data-img-src="<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg"></div>
                                        <div class="ays-pro-features-v2-upgrade-text">
                                            <?php echo esc_html__("Upgrade" , "ays-popup-box"); ?>
                                        </div>
                                    </a>
                                </div>
                                <div class="form-group row" style="margin-top:1rem; margin-bottom:0;"> 
                                    <div class="col-sm-3">
                                        <label for="ays_enable_tackers_count">
                                            <?php echo esc_html__('Disable by view count', "ays-popup-box")?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Disable the popup after certain views.',"ays-popup-box")?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="checkbox" class="ays-enable-timer1 ays_toggle_checkbox" id="ays_enable_tackers_count"/>
                                    </div>
                                    <div class="col-sm-8 ays_toggle_target ays_divider_left">
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                <label for="ays_tackers_count">
                                                    <?php echo esc_html__('Count',"ays-popup-box")?>
                                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_html__('Specify the count of views.',"ays-popup-box")?>">
                                                        <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="number" id="ays_tackers_count" class="ays-enable-timerl ays-text-input">
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>    
                        </div>
                        <hr/>
                        <!-- Tigran -->
                        <div class="form-group row" style="margin:0;">
                            <div class="col-sm-12 ays-pro-features-v2-main-box">
                                <div class="ays-pro-features-v2-small-buttons-box">
                                    <!-- <div>
                                        <a href="https://youtu.be/UCk-qohzhIU?list=PL4ufu1uAjjWQTYn0O_72TLzmqgmVIYKI2" target="_blank" class="ays-pro-features-v2-video-button">
                                            <div>
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/pro-features-icons/Video_24x24.svg" ?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/pro-features-icons/Video_24x24_Hover.svg" ?>" class="ays-pb-new-video-button-hover">
                                            </div>
                                            <div class="ays-pro-features-v2-video-text">
                                                <?php echo esc_html__("Watch Video" , "ays-popup-box"); ?>
                                            </div>
                                        </a>
                                    </div> -->
                                    <a href="https://popup-plugin.com/" target="_blank" class="ays-pro-features-v2-upgrade-button">
                                        <div class="ays-pro-features-v2-upgrade-icon" style="background-image: url('<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg');" data-img-src="<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg"></div>
                                        <div class="ays-pro-features-v2-upgrade-text">
                                            <?php echo esc_html__("Upgrade" , "ays-popup-box"); ?>
                                        </div>
                                    </a>
                                </div>
                                <div class="form-group row" style="margin-top: 1rem;">
                                    <div class="col-sm-3">
                                        <label for="ays-pb-users-os">
                                            <span><?php echo esc_html__('Display for certain OS', "ays-popup-box"); ?></span>
                                            <a class="ays_help" data-toggle="tooltip"
                                               title="<?php echo esc_html__('Set on which operating systems your popup will be displayed.', "ays-popup-box") ?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-9 ays-pb-users-roles">
                                        <select id="ays-pb-users-os" multiple class="ays_pb_aysDropdown">
                                            <?php
                                            foreach ($ays_users_os_array as $key => $user_os) {
                                                echo "<option value='" . $user_os . "' selected>" . $user_os . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label for="ays-pb-users-browser">
                                            <span><?php echo esc_html__('Display for certain browser', "ays-popup-box"); ?></span>
                                            <a class="ays_help ays-pb-help-pro" data-toggle="tooltip"
                                               title="<?php echo esc_html__('Show the popup only to visitors using certain browser(s) mentioned in the list. Leave it blank for showing the popup to all browsers users.', "ays-popup-box") ?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-9 ays-pb-users-roles">
                                        <select id="ays-pb-users-browser" multiple class="ays_pb_aysDropdown">
                                            <?php
                                            foreach ($ays_users_browser_array as $key => $user_browser) {
                                                echo "<option value='" . $user_browser . "' selected>" . $user_browser . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row" style="margin:0px;">
                            <div class="col-sm-12 ays-pro-features-v2-main-box">
                                <div class="ays-pro-features-v2-small-buttons-box">
                                    <!-- <div>
                                        <a href="https://youtu.be/q6ai1WhpLfc?list=PL4ufu1uAjjWQTYn0O_72TLzmqgmVIYKI2" target="_blank" class="ays-pro-features-v2-video-button">
                                            <div>
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/pro-features-icons/Video_24x24.svg" ?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/pro-features-icons/Video_24x24_Hover.svg" ?>" class="ays-pb-new-video-button-hover">
                                            </div>
                                            <div class="ays-pro-features-v2-video-text">
                                                <?php echo esc_html__("Watch Video" , "ays-popup-box"); ?>
                                            </div>
                                        </a>
                                    </div> -->
                                    <a href="https://popup-plugin.com/" target="_blank" class="ays-pro-features-v2-upgrade-button">
                                        <div class="ays-pro-features-v2-upgrade-icon" style="background-image: url('<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg');" data-img-src="<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg"></div>
                                        <div class="ays-pro-features-v2-upgrade-text">
                                            <?php echo esc_html__("Upgrade" , "ays-popup-box"); ?>
                                        </div>
                                    </a>
                                </div>
                                <div class="form-group row ">
                                    <div class="col-sm-3">
                                        <label for="enable_limit_by_country">
                                            <?php echo esc_html__('Limit by country', "ays-popup-box"); ?> 
                                                <a class="ays_help" data-toggle="tooltip"
                                                    title="<?php echo esc_html__('Show the popup only to visitors using certain browser(s) mentioned in the list. Leave it blank for showing the popup to all browsers users.', "ays-popup-box") ?>">
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="checkbox" class="ays-enable-timer1">
                                    </div>
                                    <div class="col-sm-8 ays_toggle_target ays_divider_left">
                                        <select class="ays-text-input ays-pb-text-input ays-pb-text-input-short ays_pb_aysDropdown" style="width: 15vw;" multiple>                            
                                            <option selected>USA</option>
                                            <option selected>Germany</option>
                                            <option selected>France</option>
                                        </select>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row" style="margin:0px;">
                            <div class="col-sm-12 ays-pro-features-v2-main-box">
                                <div class="ays-pro-features-v2-small-buttons-box">
                                    <!-- <div>
                                        <a href="https://youtu.be/q6ai1WhpLfc?list=PL4ufu1uAjjWQTYn0O_72TLzmqgmVIYKI2" target="_blank" class="ays-pro-features-v2-video-button">
                                            <div>
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/pro-features-icons/Video_24x24.svg" ?>">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/pro-features-icons/Video_24x24_Hover.svg" ?>" class="ays-pb-new-video-button-hover">
                                            </div>
                                            <div class="ays-pro-features-v2-video-text">
                                                <?php echo esc_html__("Watch Video" , "ays-popup-box"); ?>
                                            </div>
                                        </a>
                                    </div> -->
                                    <a href="https://popup-plugin.com/" target="_blank" class="ays-pro-features-v2-upgrade-button">
                                        <div class="ays-pro-features-v2-upgrade-icon" style="background-image: url('<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg');" data-img-src="<?php echo esc_attr(AYS_PB_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg"></div>
                                        <div class="ays-pro-features-v2-upgrade-text">
                                            <?php echo esc_html__("Upgrade" , "ays-popup-box"); ?>
                                        </div>
                                    </a>
                                </div>
                                <div class="form-group row ">
                                    <div class="col-sm-3">
                                        <label for="enable_limit_by_country">
                                            <?php echo esc_html__('Dismiss by closing', "ays-popup-box"); ?> 
                                                <a class="ays_help" data-toggle="tooltip"
                                                    title="<?php echo esc_html__('After clicking on the x button the popup will not be displayed for the user.', "ays-popup-box") ?>">
                                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/info-circle.svg"?>">
                                                </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="checkbox" class="ays-enable-timer1">
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Limitation user end -->
            <!-- Integrations start -->
            <div id="tab5" class="ays-pb-tab-content  <?php echo ($ays_pb_tab == 'tab5') ? 'ays-pb-tab-content-active' : ''; ?>">
                <div class="ays-pb-accordion-options-main-container">
                    <div class="d-flex justify-content-end align-items-center">
                        <div class="d-flex justify-content-between align-items-center" style="gap: 5px; font-size: 13px">
                            <div>
                                <a href="javascript:void(0);" class="ays-pb-collapse-all-options"><?php echo esc_html__("Collapse All", "ays-popup-box"); ?></a>
                            </div>    
                            |               
                            <div>
                                <a href="javascript:void(0);" class="ays-pb-expand-all-options"><?php echo esc_html__("Expand All", "ays-popup-box"); ?></a>
                            </div>                   
                        </div>
                    </div>
                    <div class="ays-pb-accordion-header">
                        <?php echo wp_kses($pb_acordion_svg_html, $allow_tags_acordion_arrow); ?>
                        <p class="ays-subtitle"><?php echo  esc_html__('Integrations', "ays-popup-box") ?></p>
                    </div>
                    <hr class="ays-pb-bolder-hr"/>
                    <div class="ays-pb-accordion-body">
                        <blockquote class="ays-pb-integration-tab-note">
                            <p><?php echo esc_html__('The Integrations tab works only with Contact Form, Subscription and Send File after subscription types',"ays-popup-box");?>
                        </blockquote>
                        <hr/>
                        <?php 
                            $args = apply_filters( 'ays_pb_popup_page_integrations_options', array(), $options );
                            do_action( 'ays_pb_popup_page_integrations', $args );
                        ?>
                    </div>
                </div>
            </div>
            <!-- Integrations end -->
            </div>
            <div style="clear:both;" ></div>
            <hr/>
            <div class="ays-pb-bottom-buttons-content ays_save_buttons_content  ays_save_buttons_bottom_content">      
                <h1 style="display:flex">
                    <?php
                    wp_nonce_field('pb_action', 'pb_action');
                    $save_close_bottom_attributes = array('id' => 'ays-button');
                    $save_bottom_attributes = array(
                        'id' => 'ays-button-apply',
                        'title' => 'Ctrl + s',
                        'data-toggle' => 'tooltip',
                        'data-delay'=> '{"show":"300"}'
                    );
                    submit_button(esc_html__('Save', "ays-popup-box"), 'primary ays-save-buttons-just-save-button', 'ays_apply', false, $save_bottom_attributes);
                    submit_button(esc_html__('Save and close', "ays-popup-box"), 'ays-save-buttons-just-save-button', 'ays_submit', false, $save_close_bottom_attributes);
                    ?>
                    <a href="<?php echo $ays_pb_page_url; ?>" class="button" style="margin-left:10px;" ><?php echo esc_html__('Cancel',"ays-popup-box");?></a>
                    <?php
                        echo $loader_image;
                    ?>
                </h1>
                <div class="ays-pb-prev-next-button-content">
                    <?php
                        if ( $prev_popup_id != "" && !is_null( $prev_popup_id ) ) {

                            $other_attributes = array(
                                'id' => 'ays-popups-prev-button',
                                'href' => sprintf( '?page=%s&action=%s&popupbox=%d', esc_attr( $_REQUEST['page'] ), 'edit', absint( $prev_popup_id ) ),
                                'data-message' => esc_html__( 'Are you sure you want to go to the previous popup page?', "ays-popup-box"),
                            );
                            submit_button(esc_html__('Prev popup', "ays-popup-box"), 'button ays-button ays-popup-prev-popup-button', 'ays_popup_prev_button', false, $other_attributes);
                        }
                        if ( $next_popup_id != "" && !is_null( $next_popup_id ) ) {
                        
                            $other_attributes = array(
                                'id' => 'ays-popups-next-button',
                                'href' => sprintf( '?page=%s&action=%s&popupbox=%d', esc_attr( $_REQUEST['page'] ), 'edit', absint( $next_popup_id )),
                                'data-message' => esc_html__( 'Are you sure you want to go to the next popup page?', "ays-popup-box"),
                            );
                            submit_button(esc_html__('Next Popup', "ays-popup-box"), 'button button-primary ays-button', 'ays_popup_next_button', false, $other_attributes);
                        }
                    ?>
                </div>
            </div>
            <?php if($id === null): ?>
                <div class="ays_pb_layer_container">
                    <div class="ays_pb_layer_content">
                        <div class="ays_pb_layer_box">
                            <div class="ays-pb-close-type">
                                <a href="?page=ays-pb">
                                    <img src="<?php echo esc_url(AYS_PB_ADMIN_URL); ?>/images/icons/cross.png">
                                </a>
                            </div>
                            <div class="ays-pb-choose-type">
                                <p style="margin: 0;"><?php echo  esc_html__('Choose Your Popup Type', "ays-popup-box") ?></p>
                            </div>
                            <div class="ays_pb_layer_box_blocks">
                                <label for="<?php echo esc_attr($this->plugin_name); ?>-modal_content_custom_html" class='ays-pb-dblclick-layer'>
                                    <input id="<?php echo esc_attr($this->plugin_name); ?>-modal_content_custom_html" type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[modal_content]" class="ays-pb-content-type" value="custom_html" <?php echo $modal_content == 'custom_html' ? 'checked' : ''; ?>>
                                    <div class="ays_pb_layer_item">
                                        <div class="ays_pb_layer_item_logo">
                                            <div class="ays_pb_layer_item_logo_overlay">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/file-code.svg"?>">
                                            </div>
                                        </div>
                                        <div class="ays_pb_layer_item_title">
                                            <div class="ays-pb-type-name">
                                                <p style="margin:0px; font-size:19px;"><?php echo  esc_html__('Custom Content', "ays-popup-box") ?></p>
                                            </div>
                                            <div class="ays_pb_layer_buttons">
                                                <a href="https://demo.popup-plugin.com/custom-content-popup/" class="ays-pb-view-demo-content" target="_blank"><?php echo  esc_html__('View demo', "ays-popup-box") ?></a>
                                                <div class="ays-pb-select-type">
                                                    <p><?php echo esc_html__('Select', 'ays-popup-box') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <label for="<?php echo esc_attr($this->plugin_name); ?>-modal_content_shortcode" class='ays-pb-dblclick-layer'>
                                    <input id="<?php echo esc_attr($this->plugin_name); ?>-modal_content_shortcode" type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[modal_content]" class="ays-pb-content-type" value="shortcode" <?php echo $modal_content == 'shortcode' ? 'checked' : ''; ?>>
                                    <div class="ays_pb_layer_item">
                                        <div class="ays_pb_layer_item_logo">
                                            <div class="ays_pb_layer_item_logo_overlay">
                                                <span class="ays_pb_layer_item_logo_shortcode">[/]</span>
                                            </div>
                                        </div>
                                        <div class="ays_pb_layer_item_title">
                                            <div class="ays-pb-type-name">
                                                <p style="margin:0px; font-size:19px;"><?php echo esc_html__('Shortcode', "ays-popup-box") ?></p>
                                            </div>
                                            <div class="ays_pb_layer_buttons">
                                                <a href="https://demo.popup-plugin.com/shortcode-popup/" class="ays-pb-view-demo-content" target="_blank"><?php echo  esc_html__('View demo', "ays-popup-box") ?></a>
                                                <div class="ays-pb-select-type">
                                                    <p><?php echo esc_html__('Select', 'ays-popup-box') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <label for="<?php echo esc_attr($this->plugin_name); ?>-modal_content_video_type" class='ays-pb-dblclick-layer'>
                                    <input id="<?php echo esc_attr($this->plugin_name); ?>-modal_content_video_type" type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[modal_content]" class="ays-pb-content-type" value="video_type" <?php echo $modal_content == 'video_type' ? 'checked' : ''; ?>>
                                    <div class="ays_pb_layer_item">
                                        <div class="ays_pb_layer_item_logo">
                                            <div class="ays_pb_layer_item_logo_overlay">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/video.svg"?>">
                                            </div>
                                        </div>
                                        <div class="ays_pb_layer_item_title">
                                            <div class="ays-pb-type-name">
                                                <p style="margin:0px; font-size:19px;"><?php echo  esc_html__('Video', "ays-popup-box") ?></p>
                                            </div>
                                            <div class="ays_pb_layer_buttons">
                                                <a href="https://demo.popup-plugin.com/video-popup/" class="ays-pb-view-demo-content" target="_blank"><?php echo  esc_html__('View demo', "ays-popup-box") ?></a>
                                                <div class="ays-pb-select-type">
                                                    <p><?php echo esc_html__('Select', 'ays-popup-box') ?></p>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </label>
                                <label for="<?php echo esc_attr($this->plugin_name); ?>-modal_content_image_type" class='ays-pb-dblclick-layer'>
                                    <input id="<?php echo esc_attr($this->plugin_name); ?>-modal_content_image_type" type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[modal_content]" class="ays-pb-content-type" value="image_type" <?php echo $modal_content == 'image_type' ? 'checked' : ''; ?>>
                                    <div class="ays_pb_layer_item">
                                        <div class="ays_pb_layer_item_logo">
                                            <div class="ays_pb_layer_item_logo_overlay">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/popup-image-type.svg"?>">
                                            </div>
                                        </div>
                                        <div class="ays_pb_layer_item_title">
                                            <div class="ays-pb-type-name">
                                                <p style="margin:0px; font-size:19px;"><?php echo  esc_html__('Image', "ays-popup-box") ?></p>
                                            </div>
                                            <div class="ays_pb_layer_buttons">
                                                <!-- <a href="" class="ays-pb-view-demo-content" target="_blank"></a> -->
                                                <div class="ays-pb-select-type">
                                                    <p><?php echo esc_html__('Select', 'ays-popup-box') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <label for="<?php echo esc_attr($this->plugin_name); ?>-modal_content_facebook_type" class='ays-pb-dblclick-layer'>
                                    <input id="<?php echo esc_attr($this->plugin_name); ?>-modal_content_facebook_type" type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[modal_content]" class="ays-pb-content-type" value="facebook_type" <?php echo $modal_content == 'facebook_type' ? 'checked' : ''; ?>>
                                    <div class="ays_pb_layer_item">
                                        <div class="ays_pb_layer_item_logo">
                                            <div class="ays_pb_layer_item_logo_overlay">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/popup-facebook-type.svg"?>">
                                            </div>
                                        </div>
                                        <div class="ays_pb_layer_item_title">
                                            <div class="ays-pb-type-name">
                                                <p style="margin:0px; font-size:19px;"><?php echo  esc_html__('Facebook', "ays-popup-box") ?></p>
                                            </div>
                                            <div class="ays_pb_layer_buttons">
                                                <!-- <a href="" class="ays-pb-view-demo-content" target="_blank"></a> -->
                                                <div class="ays-pb-select-type">
                                                    <p><?php echo esc_html__('Select', 'ays-popup-box') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <label for="<?php echo esc_attr($this->plugin_name); ?>-modal_content_notification" class='ays-pb-dblclick-layer'>
                                    <input id="<?php echo esc_attr($this->plugin_name); ?>-modal_content_notification" type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[modal_content]" class="ays-pb-content-type" value="notification_type" <?php echo $modal_content == 'notification_type' ? 'checked' : ''; ?>>
                                    <div class="ays_pb_layer_item">
                                        <div class="ays_pb_layer_item_logo">
                                            <div class="ays_pb_layer_item_logo_overlay">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/popup-notification-type.svg"?>">
                                            </div>
                                        </div>
                                        <div class="ays_pb_layer_item_title">
                                            <div class="ays-pb-type-name">
                                                <p style="margin:0px; font-size:19px;"><?php echo  esc_html__('Notification', "ays-popup-box") ?></p>
                                            </div>
                                            <div class="ays_pb_layer_buttons">
                                                <div class="ays-pb-select-type">
                                                    <p><?php echo esc_html__('Select', 'ays-popup-box') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <label class="ays-pb-pro-type-layer">
                                    <div class="ays_pb_layer_item ays_pb_layer_item_pro">
                                        <div class="ays_pb_layer_item_logo">
                                            <div class="ays_pb_layer_item_logo_overlay">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/envelope.svg"?>">
                                            </div>
                                        </div>
                                        <div class="ays_pb_layer_item_title">
                                            <div class="ays-pb-type-name">
                                                <p style="margin:0px; font-size:19px;"><?php echo  esc_html__('Subscription', "ays-popup-box") ?></p>
                                            </div>
                                            <a href="https://popup-plugin.com/" target="_blank" class="ays-pb-select-type-pro">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Locked_24x24.svg" class="ays-pb-locked-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Unlocked_24_24.svg" class="ays-pb-unlocked-img">
                                                <p><?php echo esc_html__('Upgrade Now', 'ays-popup-box') ?></p>
                                            </a>
                                            <div class="ays-pb-view-demo-content">
                                                <a href="https://demo.popup-plugin.com/subscription-popup/" target="_blank"><?php echo  esc_html__('View demo', "ays-popup-box") ?></a>
                                            </div>
                                        </div> 
                                    </div>

                                </label>
                                <label class="ays-pb-pro-type-layer">
                                    <div class="ays_pb_layer_item ays_pb_layer_item_pro">
                                        <div class="ays_pb_layer_item_logo">
                                                <div class="ays_pb_layer_item_logo_overlay">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) . "/images/icons/check.svg"?>">
                                            </div>
                                        </div>
                                        <div class="ays_pb_layer_item_title">
                                            <div class="ays-pb-type-name">
                                                <p style="margin:0px; font-size:19px;"><?php echo  esc_html__('Yes or No', "ays-popup-box") ?></p>
                                            </div>
                                            <a href="https://popup-plugin.com/" target="_blank" class="ays-pb-select-type-pro">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Locked_24x24.svg" class="ays-pb-locked-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Unlocked_24_24.svg" class="ays-pb-unlocked-img">
                                                <p><?php echo esc_html__('Upgrade Now', 'ays-popup-box') ?></p>
                                            </a>
                                            <div class="ays-pb-view-demo-content">
                                                <a href="https://demo.popup-plugin.com/yes-no-popup/" target="_blank"><?php echo  esc_html__('View demo', "ays-popup-box") ?></a>
                                            </div>
                                        </div> 
                                    </div>
                                </label>
                                <label class="ays-pb-pro-type-layer">
                                    <div class="ays_pb_layer_item ays_pb_layer_item_pro">
                                        <div class="ays_pb_layer_item_logo">
                                            <div class="ays_pb_layer_item_logo_overlay">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL); ?>/images/icons/coding.png">
                                            </div>
                                        </div>
                                        <div class="ays_pb_layer_item_title">
                                            <div class="ays-pb-type-name">
                                                <p style="margin:0px; font-size:19px;"><?php echo  esc_html__('Embed( Iframe )', "ays-popup-box") ?></p>
                                            </div>
                                            <a href="https://popup-plugin.com/" target="_blank" class="ays-pb-select-type-pro">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Locked_24x24.svg" class="ays-pb-locked-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Unlocked_24_24.svg" class="ays-pb-unlocked-img">
                                                <p><?php echo esc_html__('Upgrade Now', 'ays-popup-box') ?></p>
                                            </a>
                                            <div class="ays-pb-view-demo-content">
                                                <a href="https://demo.popup-plugin.com/iframe-popup/" target="_blank"><?php echo  esc_html__('View demo', "ays-popup-box") ?></a>
                                            </div>
                                        </div> 
                                    </div>
                                </label> 
                                <label class="ays-pb-pro-type-layer">
                                    <div class="ays_pb_layer_item ays_pb_layer_item_pro">
                                        <div class="ays_pb_layer_item_logo">
                                            <div class="ays_pb_layer_item_logo_overlay">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL); ?>/images/icons/comments.svg">
                                            </div>
                                        </div>
                                        <div class="ays_pb_layer_item_title">
                                            <div class="ays-pb-type-name">
                                                <p style="margin:0px; font-size:19px;"><?php echo  esc_html__('Contact form', "ays-popup-box") ?></p>
                                            </div>
                                            <a href="https://popup-plugin.com/" target="_blank" class="ays-pb-select-type-pro">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Locked_24x24.svg" class="ays-pb-locked-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Unlocked_24_24.svg" class="ays-pb-unlocked-img">
                                                <p><?php echo esc_html__('Upgrade Now', 'ays-popup-box') ?></p>
                                            </a>
                                            <div class="ays-pb-view-demo-content">
                                                <a href="https://demo.popup-plugin.com/contact-form-popup/" target="_blank"><?php echo  esc_html__('View demo', "ays-popup-box") ?></a>
                                            </div>
                                        </div> 
                                    </div>
                                </label> 
                                <label class="ays-pb-pro-type-layer">
                                    <div class="ays_pb_layer_item ays_pb_layer_item_pro">
                                        <div class="ays_pb_layer_item_logo">
                                            <div class="ays_pb_layer_item_logo_overlay">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL); ?>/images/icons/file-upload.svg">
                                            </div>
                                        </div>
                                        <div class="ays_pb_layer_item_title">
                                            <div class="ays-pb-type-name">
                                                <p style="margin:0px; font-size:19px;"><?php echo  esc_html__('Subscribe and get file', "ays-popup-box") ?></p>
                                            </div>
                                            <a href="https://popup-plugin.com/" target="_blank" class="ays-pb-select-type-pro">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Locked_24x24.svg" class="ays-pb-locked-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Unlocked_24_24.svg" class="ays-pb-unlocked-img">
                                                <p><?php echo esc_html__('Upgrade Now', 'ays-popup-box') ?></p>
                                            </a>
                                            <div class="ays-pb-view-demo-content">
                                                <a href="https://demo.popup-plugin.com/subscribe-and-get-file-popup/" target="_blank"><?php echo  esc_html__('View demo', "ays-popup-box") ?></a>
                                            </div>
                                        </div> 
                                    </div>
                                </label> 
                                <label class="ays-pb-pro-type-layer">
                                    <div class="ays_pb_layer_item ays_pb_layer_item_pro">
                                        <div class="ays_pb_layer_item_logo">
                                            <div class="ays_pb_layer_item_logo_overlay">
                                                <img src= "<?php echo esc_url(AYS_PB_ADMIN_URL) ;?>/images/icons/coupon.svg" style="width:40px;height:40px;">
                                            </div>
                                        </div>
                                        <div class="ays_pb_layer_item_title">
                                            <div class="ays-pb-type-name">
                                                <p style="margin:0px; font-size:19px;"><?php echo  esc_html__('Coupon', "ays-popup-box") ?></p>
                                            </div>
                                            <a href="https://popup-plugin.com/" target="_blank" class="ays-pb-select-type-pro">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Locked_24x24.svg" class="ays-pb-locked-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Unlocked_24_24.svg" class="ays-pb-unlocked-img">
                                                <p><?php echo esc_html__('Upgrade Now', 'ays-popup-box') ?></p>
                                            </a>
                                            <div class="ays-pb-view-demo-content">
                                                <a href="https://demo.popup-plugin.com/coupon-popup/" target="_blank"><?php echo  esc_html__('View demo', "ays-popup-box") ?></a>
                                            </div>
                                        </div> 
                                    </div>
                                </label>
                                <label class="ays-pb-pro-type-layer">
                                    <div class="ays_pb_layer_item ays_pb_layer_item_pro">
                                        <div class="ays_pb_layer_item_logo">
                                            <div class="ays_pb_layer_item_logo_overlay">
                                                <img src= "<?php echo esc_url(AYS_PB_ADMIN_URL); ?>/images/icons/countdown.svg">
                                            </div>
                                        </div>
                                        <div class="ays_pb_layer_item_title">
                                            <div class="ays-pb-type-name">
                                                <p style="margin:0px; font-size:19px;"><?php echo  esc_html__('Countdown', "ays-popup-box") ?></p>
                                            </div>
                                            <a href="https://popup-plugin.com/" target="_blank" class="ays-pb-select-type-pro">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Locked_24x24.svg" class="ays-pb-locked-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Unlocked_24_24.svg" class="ays-pb-unlocked-img">
                                                <p><?php echo esc_html__('Upgrade Now', 'ays-popup-box') ?></p>
                                            </a>
                                            <div class="ays-pb-view-demo-content">
                                                <a href="https://demo.popup-plugin.com/countdown-popup/" target="_blank"><?php echo  esc_html__('View demo', "ays-popup-box") ?></a>
                                            </div>
                                        </div> 
                                    </div>
                                </label>
                                <label class="ays-pb-pro-type-layer">
                                    <div class="ays_pb_layer_item ays_pb_layer_item_pro">
                                        <div class="ays_pb_layer_item_logo">
                                            <div class="ays_pb_layer_item_logo_overlay">
                                                <img src= "<?php echo esc_url(AYS_PB_ADMIN_URL) ;?>/images/icons/cookie.svg">
                                            </div>
                                        </div>
                                        <div class="ays_pb_layer_item_title">
                                            <div class="ays-pb-type-name">
                                                <p style="margin:0px; font-size:19px;"><?php echo  esc_html__('Accept Cookie', "ays-popup-box") ?></p>
                                            </div>
                                            <a href="https://popup-plugin.com/" target="_blank" class="ays-pb-select-type-pro">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Locked_24x24.svg" class="ays-pb-locked-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Unlocked_24_24.svg" class="ays-pb-unlocked-img">
                                                <p><?php echo esc_html__('Upgrade Now', 'ays-popup-box') ?></p>
                                            </a>
                                            <div class="ays-pb-view-demo-content">
                                                <a href="https://demo.popup-plugin.com/cookies-popup/" target="_blank"><?php echo  esc_html__('View demo', "ays-popup-box") ?></a>
                                            </div>
                                        </div> 
                                    </div>
                                </label> 
                                <label class="ays-pb-pro-type-layer">
                                    <div class="ays_pb_layer_item ays_pb_layer_item_pro">
                                        <div class="ays_pb_layer_item_logo">
                                            <div class="ays_pb_layer_item_logo_overlay">
                                                <img src= "<?php echo esc_url(AYS_PB_ADMIN_URL) ;?>/images/icons/download.svg">
                                            </div>
                                        </div>
                                        <div class="ays_pb_layer_item_title">
                                            <div class="ays-pb-type-name">
                                                <p style="margin:0px; font-size:19px;"><?php echo  esc_html__('Download', "ays-popup-box") ?></p>
                                            </div>
                                            <a href="https://popup-plugin.com/" target="_blank" class="ays-pb-select-type-pro">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Locked_24x24.svg" class="ays-pb-locked-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Unlocked_24_24.svg" class="ays-pb-unlocked-img">
                                                <p><?php echo esc_html__('Upgrade Now', 'ays-popup-box') ?></p>
                                            </a>
                                            <div class="ays-pb-view-demo-content">
                                                <a href="https://demo.popup-plugin.com/download-popup/" target="_blank"><?php echo  esc_html__('View demo', "ays-popup-box") ?></a>
                                            </div>
                                        </div> 
                                    </div>
                                </label> 
                                <label class="ays-pb-pro-type-layer">
                                    <div class="ays_pb_layer_item ays_pb_layer_item_pro">
                                        <div class="ays_pb_layer_item_logo">
                                            <div class="ays_pb_layer_item_logo_overlay">
                                                <img src= "<?php echo esc_url(AYS_PB_ADMIN_URL) ;?>/images/icons/woo.svg">
                                            </div>
                                        </div>
                                        <div class="ays_pb_layer_item_title">
                                            <div class="ays-pb-type-name">
                                                <p style="margin:0px; font-size:19px;"><?php echo  esc_html__('WooCommerce', "ays-popup-box") ?></p>
                                            </div>
                                            <a href="https://popup-plugin.com/" target="_blank" class="ays-pb-select-type-pro">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Locked_24x24.svg" class="ays-pb-locked-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Unlocked_24_24.svg" class="ays-pb-unlocked-img">
                                                <p><?php echo esc_html__('Upgrade Now', 'ays-popup-box') ?></p>
                                            </a>
                                        </div> 
                                    </div>
                                </label> 
                                <label>
                                    <div class="ays_pb_layer_item ays_pb_layer_item_pro">
                                        <div class="ays_pb_layer_item_logo">
                                            <div class="ays_pb_layer_item_logo_overlay">
                                                <img src= "<?php echo esc_url(AYS_PB_ADMIN_URL) ;?>/images/icons/sign-in.svg">
                                            </div>
                                        </div>
                                        <div class="ays_pb_layer_item_title">
                                            <div class="ays-pb-type-name">
                                                <p style="margin:0px; font-size:19px;"><?php echo  esc_html__('Login Form', "ays-popup-box") ?></p>
                                            </div>
                                            <a href="https://popup-plugin.com/" target="_blank" class="ays-pb-select-type-pro">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Locked_24x24.svg" class="ays-pb-locked-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Unlocked_24_24.svg" class="ays-pb-unlocked-img">
                                                <p><?php echo esc_html__('Upgrade Now', 'ays-popup-box') ?></p>
                                            </a>
                                            <div class="ays-pb-view-demo-content">
                                                <a href="https://demo.popup-plugin.com/login-form-popup/" target="_blank"><?php echo  esc_html__('View demo', "ays-popup-box") ?></a>
                                            </div>
                                        </div> 
                                    </div>
                                </label> 
                                <label>
                                    <div class="ays_pb_layer_item ays_pb_layer_item_pro">
                                        <div class="ays_pb_layer_item_logo">
                                            <div class="ays_pb_layer_item_logo_overlay">
                                                <img src= "<?php echo esc_url(AYS_PB_ADMIN_URL) ;?>/images/icons/map-marker.svg">
                                            </div>
                                        </div>
                                        <div class="ays_pb_layer_item_title">
                                            <div class="ays-pb-type-name">
                                                <p style="margin:0px; font-size:19px;"><?php echo  esc_html__('Google Map', "ays-popup-box") ?></p>
                                            </div>
                                            <a href="https://popup-plugin.com/" target="_blank" class="ays-pb-select-type-pro">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Locked_24x24.svg" class="ays-pb-locked-img">
                                                <img src="<?php echo esc_url(AYS_PB_ADMIN_URL) ?>/images/icons/pro-features-icons/Unlocked_24_24.svg" class="ays-pb-unlocked-img">
                                                <p><?php echo esc_html__('Upgrade Now', 'ays-popup-box') ?></p>
                                            </a>
                                            <div class="ays-pb-view-demo-content">
                                                <a href="https://demo.popup-plugin.com/google-map-popup/" target="_blank"><?php echo  esc_html__('View demo', "ays-popup-box") ?></a>
                                            </div>
                                        </div> 
                                    </div>
                                </label> 
                            </div>
                        </div>
                    </div>
                    <div class="ays_pb_select_button_layer" style="display: none;">
                        <div class="ays_pb_select_button_item">
                            <input type="button" class="ays_pb_layer_button" name="" value="Select" disabled> 
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="ays_pb_layer_box" style="display: none;">
                    <label>
                        <div class="ays_pb_layer_item">
                            <?php echo esc_html__('Shortcode', "ays-popup-box") ?>
                            <input id="<?php echo esc_attr($this->plugin_name); ?>-modal_content_shortcode" type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[modal_content]" value="shortcode" <?php echo ($modal_content == 'shortcode') ? 'checked': '' ?>>
                        </div>
                    </label>
                    <label>
                        <div class="ays_pb_layer_item">
                            <?php echo  esc_html__('Custom Content', "ays-popup-box") ?>
                            <input id="<?php echo esc_attr($this->plugin_name); ?>-modal_content_custom_html" type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[modal_content]" value="custom_html" <?php echo ($modal_content == 'custom_html') ? 'checked' : ''; ?>>
                      </div>
                    </label>
                    <label>
                        <div class="ays_pb_layer_item">
                            <?php echo  esc_html__('Video', "ays-popup-box") ?>
                            <input id="<?php echo esc_attr($this->plugin_name); ?>-modal_content_video_type" type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[modal_content]" value="video_type" <?php echo ($modal_content == 'video_type') ? 'checked' : ''; ?>>
                        </div>
                    </label>
                    <label>
                        <div class="ays_pb_layer_item">
                            <?php echo  esc_html__('Image', "ays-popup-box") ?>
                            <input id="<?php echo esc_attr($this->plugin_name); ?>-modal_content_image_type" type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[modal_content]" value="image_type" <?php echo ($modal_content == 'image_type') ? 'checked' : ''; ?>>
                        </div>
                    </label>
                    <label>
                        <div class="ays_pb_layer_item">
                            <?php echo  esc_html__('Facebook', "ays-popup-box") ?>
                            <input id="<?php echo esc_attr($this->plugin_name); ?>-modal_content_facebook_type" type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[modal_content]" value="facebook_type" <?php echo ($modal_content == 'facebook_type') ? 'checked' : ''; ?>>
                        </div>
                    </label>
                    <label>
                        <div class="ays_pb_layer_item">
                            <?php echo  esc_html__('Notification', "ays-popup-box") ?>
                            <input id="<?php echo esc_attr($this->plugin_name); ?>-modal_content_notification_type" type="radio" name="<?php echo esc_attr($this->plugin_name); ?>[modal_content]" value="notification_type" <?php echo ($modal_content == 'notification_type') ? 'checked' : ''; ?>>
                        </div>
                    </label>
                </div>
            <?php endif; ?>
            <?php if( !$if_dismiss_cookie_exists && !$if_fox_lms_plugin_exists && !$if_fox_lms_plugin_installed_flag ): ?>
                <!-- Popup Box and Fox LMS integration main page 2025 | Start -->
                <div id="ays-pb-fox-lms-all-pages-popup" class="bounceInRight_2022" style="display: none;">
                    <div id="ays-pb-fox-lms-all-pages-popup-main">
                        <div class="ays-pb-fox-lms-all-pages-popup-layer">
                            <div id="ays-pb-fox-lms-all-pages-popup-close-main">
                                <div id="ays-pb-fox-lms-all-pages-popup-close"><div>&times;</div></div>
                            </div>
                            <div id="ays-pb-fox-lms-all-pages-popup-heading-title">
                                <div class="ays-pb-fox-lms-all-pages-popup-heading-center">
                                    <a href="https://bit.ly/43MyeyB" target="_blank">
                                        <?php echo esc_html__("WordPress LMS Plugin", 'ays-popup-box'); ?>
                                    </a>    
                                </div>
                            </div>
                            <div id="ays-pb-fox-lms-all-pages-popup-heading">
                                <div class="ays-pb-fox-lms-all-pages-popup-heading-center">
                                    <a href="https://bit.ly/43MyeyB" target="_blank">
                                        <img loading="lazy" src="<?php echo AYS_PB_ADMIN_URL; ?>/images/ays-pb-and-lms-popup-logo.svg">
                                        <img loading="lazy" class="ays-pb-fox-lms-all-pages-icon" src="<?php echo AYS_PB_ADMIN_URL; ?>/images/ays-pb-and-lms-popup-icon.svg">
                                    </a>
                                </div>
                            </div>
                            <div class="ays-pb-fox-lms-all-pages-popup-footer">
                                <div id="ays-pb-fox-lms-all-pages-popup-button" class="ays-pb-fox-lms-all-pages-popup-st">
                                    <div class="ays-pb-fox-lms-all-pages-popup-btn">
                                        <a href="https://bit.ly/43MyeyB" id="ays-pages-submit-popup" class="ays-pb-fox-lms-all-pages-popup-fields ays-pb-fox-lms-all-pages-popup-fields-submit" target="_blank"><?php echo esc_html__("Download FREE version", 'pb-maker'); ?></a>
                                    </div>
                                </div>
                            </div>
                            <div id="ays-pb-fox-lms-all-pages-popup-content">
                                <div class="ays-pb-fox-lms-all-pages-popup-content-description"><?php echo esc_html__("Get Learning Management System and online course solution in WordPress now.", 'pb-maker'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Popup Box and Fox LMS integration main page 2025 | End -->
            <?php endif; ?>
        </form>
    </div>

    <script>
        jQuery("#<?php echo esc_attr($this->plugin_name); ?>-show_all_except").on('click', function(){
            jQuery('.ays_pb_view_place_tr').show(250);
        });
        jQuery("#<?php echo esc_attr($this->plugin_name); ?>-show_all_selected").on('click', function(){
            jQuery('.ays_pb_view_place_tr').show(250);
        });
        jQuery("#<?php echo esc_attr($this->plugin_name); ?>-show_all_yes").on('click', function(){
            jQuery('.ays_pb_view_place_tr').hide(250);
        });
    </script>
    <script>
        (function ($) {
            $(document).ready(function () {
                var ays_pb_view_type;
                var default_template_img;
                var modal_content = '<?php echo $modal_content; ?>';
                var checked = $(document).find('input#ays-enable-background-gradient').prop('checked');
                let pb_gradient_direction = $(document).find('#ays_pb_gradient_direction').val();
                var pb_bg_image_position_val = $(document).find('#ays_pb_bg_image_position').val();
                var pb_bg_image_position = pb_bg_image_position_val.replace('-', ' ');

                var pb_bg_image_sizing = $(document).find('#ays_pb_bg_image_sizing').val();

                var bg_img_val = '';
                if($(document).find('input#ays-pb-bg-image').val() == '') {
                    if(checked){
                        bg_img_val = $(document).find('.ays-pb-live-container').css({'background-image': "linear-gradient(" + pb_gradient_direction + ", " + $(document).find('input#ays-background-gradient-color-1').val() + ", " + $(document).find('input#ays-background-gradient-color-2').val()+")"});
                    }else{
                        bg_img_val = $(document).find('.ays-pb-live-container').css({'background-image': "none"});
                    }
                }else{
                    bg_img_val = $(document).find('.ays-pb-live-container').not('.ays_template_window').css({'background-image': 'url('+$("#<?php echo esc_attr($this->plugin_name); ?>-bg-image").val()+ ')'});
                }

                var pbTitleVal = $(document).find('#ays-pb-popup_title').val();
                var pbTitle = aysPopupstripHTML( pbTitleVal );

                var textShadowColor = $('#ays_title_text_shadow_color').val();
                var textShadowX = $("#ays_pb_title_text_shadow_x_offset").val();
                var textShadowY = $("#ays_pb_title_text_shadow_y_offset").val();
                var textShadowZ = $("#ays_pb_title_text_shadow_z_offset").val();

                var boxShadowColor = $('#ays_pb_box_shadow_color').val();
                var boxShadowX = $("#ays_pb_box_shadow_x_offset").val();
                var boxShadowY = $("#ays_pb_box_shadow_y_offset").val();
                var boxShadowZ = $("#ays_pb_box_shadow_z_offset").val();

                $(document).find(".ays-pb-live-container-main").addClass('display_none');
                $(document).find(".ays-pb-live-container-main").removeClass('ays_active');
                switch ($("input[name='<?php echo esc_attr($this->plugin_name); ?>[view_type]']:checked").val()) {
                    case 'default':
                        $(document).find(".ays-pb-live-container-main.ays-pb-modal").removeClass('display_none');
                        $(document).find(".ays-pb-live-container-main.ays-pb-modal").addClass('ays_active');
                        $(document).find('.ays_bg_image_box').css({
                            bg_img_val,
                            'background-repeat' : 'no-repeat',
                            'background-size' : pb_bg_image_sizing,
                            'background-position' : pb_bg_image_position
                        });
                        changeCloseButtonPosition();
                        ays_pb_view_type = '.ays-pb-modal';
                        break;
                    case 'mac':
                        $(document).find(".ays-pb-live-container-main.ays_window").removeClass('display_none');
                        $(document).find(".ays-pb-live-container-main.ays_window").addClass('ays_active');
                        $(document).find('.ays_bg_image_box').css({
                            bg_img_val,
                            'background-repeat' : 'no-repeat',
                            'background-size' : pb_bg_image_sizing,
                            'background-position' : pb_bg_image_position
                        });
                        ays_pb_view_type = '.ays_window';
                        break;
                    case 'cmd':
                        $(document).find(".ays-pb-live-container-main.ays_cmd_window").removeClass('display_none');
                        $(document).find(".ays-pb-live-container-main.ays_cmd_window").addClass('ays_active');
                        $(document).find('.ays_bg_image_box').css({
                            bg_img_val,
                            'background-repeat' : 'no-repeat',
                            'background-size' : pb_bg_image_sizing,
                            'background-position' : pb_bg_image_position
                        });
                        ays_pb_view_type = '.ays_cmd_window';
                        break;
                    case 'ubuntu':
                        $(document).find(".ays-pb-live-container-main.ays_ubuntu_window").removeClass('display_none');
                        $(document).find(".ays-pb-live-container-main.ays_ubuntu_window").addClass('ays_active');;
                        $(document).find('.ays_bg_image_box').css({
                            bg_img_val,
                            'background-repeat' : 'no-repeat',
                            'background-size' : pb_bg_image_sizing,
                            'background-position' : pb_bg_image_position
                        });
                        ays_pb_view_type = '.ays_ubuntu_window';
                        break;
                    case 'winXP':
                        $(document).find(".ays-pb-live-container-main.ays_winxp_window").removeClass('display_none');
                        $(document).find(".ays-pb-live-container-main.ays_winxp_window").addClass('ays_active');
                        $(document).find('.ays_bg_image_box').css({
                            bg_img_val,
                            'background-repeat' : 'no-repeat',
                            'background-size' : pb_bg_image_sizing,
                            'background-position' : pb_bg_image_position
                        });
                        $(document).find('.ays_winxp_content').css({
                            'background-color': $("#<?php echo esc_attr($this->plugin_name); ?>-bgcolor").val()
                        });
                        ays_pb_view_type = '.ays_winxp_window';
                        break;
                    case 'win98':
                        $(document).find(".ays-pb-live-container-main.ays_win98_window").removeClass('display_none');
                        $(document).find(".ays-pb-live-container-main.ays_win98_window").addClass('ays_active');
                        $(document).find('.ays_bg_image_box').css({
                            bg_img_val,
                            'background-repeat' : 'no-repeat',
                            'background-size' : pb_bg_image_sizing,
                            'background-position' : pb_bg_image_position
                        });
                        ays_pb_view_type = '.ays_win98_window';
                        break;
                    case 'lil':
                        $(document).find(".ays-pb-live-container-main.ays_lil_window").removeClass('display_none');
                        $(document).find(".ays-pb-live-container-main.ays_lil_window").addClass('ays_active');
                        $(document).find('.ays_bg_image_box').css({
                            bg_img_val,
                            'background-repeat' : 'no-repeat',
                            'background-size' : pb_bg_image_sizing,
                            'background-position' : pb_bg_image_position
                        });
                        ays_pb_view_type = '.ays_lil_window';
                        $(document).find('.ays_lil_head .ays-close-button-take-text-color').css('background-color', $("#<?php echo esc_attr($this->plugin_name); ?>-header_bgcolor").val() + ' !important');
                        $(document).find('.ays_lil_head .ays-close-button-take-text-color').css('color', $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_textcolor").val() + ' !important');
                        changeCloseButtonPosition();
                        break;
                    case 'image':
                        $(document).find(".ays-pb-live-container-main.ays_image_window").removeClass('display_none');
                        $(document).find(".ays-pb-live-container-main.ays_image_window").addClass('ays_active');
                        if ($("#<?php echo esc_attr($this->plugin_name); ?>-bg-image").val() == '') {
                            default_template_img = 'url("https://quiz-plugin.com/wp-content/uploads/2020/02/elefante.jpg")';
                        }else{
                            default_template_img = 'url(' + $("#<?php echo esc_attr($this->plugin_name); ?>-bg-image").val() + ')';
                        }
                        $(document).find('.ays_bg_image_box').css({
                            'background-image' : default_template_img,
                            'background-repeat' : 'no-repeat',
                            'background-size' : pb_bg_image_sizing,
                            'background-position' : pb_bg_image_position
                        });
                        ays_pb_view_type = '.ays_image_window';
                        changeCloseButtonPosition();
                        break;
                    case 'minimal':
                        $(document).find(".ays-pb-live-container-main.ays_minimal_window").removeClass('display_none');
                        $(document).find(".ays-pb-live-container-main.ays_minimal_window").addClass('ays_active');
                        $(document).find('.ays_bg_image_box').css({
                            'background-repeat' : 'no-repeat',
                            'background-size' : pb_bg_image_sizing,
                            'background-position' : pb_bg_image_position
                        });
                        ays_pb_view_type = '.ays_minimal_window';
                        changeCloseButtonPosition();
                        break;
                    case 'template':
                        $(document).find(".ays-pb-live-container-main.ays_template_window").removeClass('display_none');
                        $(document).find(".ays-pb-live-container-main.ays_template_window").addClass('ays_active');
                        $(document).find('.ays_template_head').css('background-color', $("#<?php echo esc_attr($this->plugin_name); ?>-header_bgcolor").val() + ' !important');
                        if ($("#<?php echo esc_attr($this->plugin_name); ?>-bg-image").val() == '') {
                            default_template_img = 'url("https://quiz-plugin.com/wp-content/uploads/2020/02/girl-scaled.jpg")';
                        }else{
                            default_template_img = 'url(' + $("#<?php echo esc_attr($this->plugin_name); ?>-bg-image").val() + ')';
                        }
                        $(document).find('.ays_bg_image_box').css({
                            'background-image' : default_template_img,
                            'background-repeat' : 'no-repeat',
                            'background-size' : pb_bg_image_sizing,
                            'background-position' : pb_bg_image_position
                        });
                        ays_pb_view_type = '.ays_template_window';
                        changeCloseButtonPosition();
                        break;
                    case 'video':
                        if(modal_content == 'video_type'){
                            $(document).find(".ays-pb-live-container-main.ays_video_window").removeClass('display_none');
                            $(document).find(".ays-pb-live-container-main.ays_video_window").addClass('ays_active');
                            ays_pb_view_type = '.ays_video_window';
                            $(document).find('.ays_bg_image_box').css({
                                bg_img_val,
                                'background-repeat' : 'no-repeat',
                                'background-size' : pb_bg_image_sizing,
                                'background-position' : pb_bg_image_position
                            });
                        }
                        changeCloseButtonPosition();
                        break;
                    case 'image_type_img_theme':
                        $(document).find(".ays-pb-live-container-main.ays_image_type_img_window").removeClass('display_none');
                        $(document).find(".ays-pb-live-container-main.ays_image_type_img_window").addClass('ays_active');
                        $(document).find('.ays_bg_image_box').css({
                            bg_img_val,
                            'background-repeat' : 'no-repeat',
                            'background-size' : pb_bg_image_sizing,
                            'background-position' : pb_bg_image_position
                        });
                        ays_pb_view_type = '.ays_image_type_img_window';
                        changeCloseButtonPosition();
                        break;
                    case 'facebook':
                        $(document).find(".ays-pb-live-container-main.ays_facebook_window").removeClass('display_none');
                        $(document).find(".ays-pb-live-container-main.ays_facebook_window").addClass('ays_active');
                        $(document).find('.ays_bg_image_box').css({
                            bg_img_val,
                            'background-repeat' : 'no-repeat',
                            'background-size' : pb_bg_image_sizing,
                            'background-position' : pb_bg_image_position
                        });
                        ays_pb_view_type = '.ays_facebook_window';
                        changeCloseButtonPosition();
                        break;
                    default:
                        $(document).find(".ays-pb-modal").removeClass('display_none');
                        $(document).find(".ays-pb-modal").addClass('ays_active');
                        $(document).find('.ays_bg_image_box').css({
                            bg_img_val,
                            'background-repeat' : 'no-repeat',
                            'background-size' : pb_bg_image_sizing,
                            'background-position' : pb_bg_image_position
                        });
                        changeCloseButtonPosition();
                        ays_pb_view_type = '.ays-pb-modal';
                        break;
                }

                $(document).on('click','input[name="<?php echo esc_attr($this->plugin_name); ?>[view_type]"], .ays-pb-template-choose-template-btn',function () {
                    var bgImage = $("#<?php echo esc_attr($this->plugin_name); ?>-bg-image").val();
                    var bgGradient = $("#ays-enable-background-gradient").prop('checked');
                    var pb_bg_image_position = $(document).find('#ays_pb_bg_image_position').val();
                    var pb_bg_image_sizing = $(document).find('#ays_pb_bg_image_sizing').val();

                    var bg_image_css = '';
                    if(bgImage != ''){
                        bg_image_css ='url(' + bgImage + ')';
                    }else if (bgGradient) {
                        var bgGradientColor1 = $("#ays-background-gradient-color-1").val();
                        var bgGradientColor2 = $("#ays-background-gradient-color-2").val();
                        var bgGradientDir = $("#ays-background-gradient-color-2").val();
                        var pb_gradient_direction;
                        switch(bgGradientDir) {
                            case "horizontal":
                                pb_gradient_direction = "to right";
                                break;
                            case "diagonal_left_to_right":
                                pb_gradient_direction = "to bottom right";
                                break;
                            case "diagonal_right_to_left":
                                pb_gradient_direction = "to bottom left";
                                break;
                            default:
                                pb_gradient_direction = "to bottom";
                        }
                        bg_image_css = 'linear-gradient('+pb_gradient_direction+', '+bgGradientColor1+', '+bgGradientColor2;
                    }

                    var pbTitleVal = $(document).find('#ays-pb-popup_title').val();
                    var pbTitle = aysPopupstripHTML( pbTitleVal );

                    $(document).find(".ays-pb-live-container-main").addClass('display_none');
                    $(document).find(".ays-pb-live-container-main").removeClass('ays_active');
                    switch ($("input[name='<?php echo esc_attr($this->plugin_name); ?>[view_type]']:checked").val()) {
                        case 'default':
                            $(document).find(".ays-pb-live-container-main.ays-pb-modal").removeClass('display_none');
                            $(document).find(".ays-pb-live-container-main.ays-pb-modal").addClass('ays_active');
                            ays_pb_view_type = '.ays-pb-modal';

                            $(document).find('.ays_bg_image_box').css({
                                'background-image' : bg_image_css,
                                'background-repeat' : 'no-repeat',
                                'background-size' : pb_bg_image_sizing,
                                'background-position' : pb_bg_image_position
                            });
                            $(document).find(ays_pb_view_type + ' .desc').html($("#<?php echo esc_attr($this->plugin_name); ?>-popup_description").val());
                            $(document).find(ays_pb_view_type + ' .ays_title').html( pbTitle );
                            $(document).find("#ays-pb-close-button-text").on('change', function () {
                                if($("#ays-pb-close-button-text").val() == '✕'){
                                     $(ays_pb_view_type + ' .ays-close-button-text').html("<img src='<?php echo esc_url(AYS_PB_ADMIN_URL) ?>" + "/images/icons/times-2x.svg'>");
                                }else{
                                    $(ays_pb_view_type + ' .ays-close-button-text').html($("#ays-pb-close-button-text").val());
                                }
                            });
                            if($(document).find('#ays_enable_title_text_shadow').prop('checked')){
                                if($(document).find('#ays_enable_title_text_shadow').prop('checked')){
                                    $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow' , textShadowX+'px '+textShadowY +'px '+textShadowZ+'px '+textShadowColor);
                                }else{
                                    $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow', 'unset');
                                }
                            }else{
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow', 'unset');
                            }

                            if($(document).find('#ays_pb_enable_box_shadow').prop('checked')){
                                if($(document).find('#ays_enable_box_shadow').prop('checked')){
                                    $(document).find(ays_pb_view_type).css('box-shadow' , boxShadowX+'px '+boxShadowY +'px '+boxShadowZ+'px '+boxShadowColor);
                                }else{
                                    $(document).find(ays_pb_view_type).css('box-shadow', 'unset');
                                }
                            }else{
                                $(document).find(ays_pb_view_type).css('box-shadow', 'unset');
                            }

                            $(ays_pb_view_type).css({
                                'background-color': $("#<?php echo esc_attr($this->plugin_name); ?>-bgcolor").val(),
                                'color': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_textcolor").val() + ' !important',
                                'border': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_bordersize").val() + "px "+$('#ays_pb_border_style').val()+ $("#<?php echo esc_attr($this->plugin_name); ?>-bordercolor").val(),
                                'border-radius': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_border_radius").val() + 'px',
                                'font-family': $('#ays_pb_font_family').val(),
                            });
                            var closeBtnDefaultColor = $(document).find('#ays_pb_close_button_color').val('#000');
                            changeCloseButtonPosition();
                            break;
                        case 'mac':
                            $(document).find(".ays-pb-live-container-main.ays_window").removeClass('display_none');
                            $(document).find(".ays-pb-live-container-main.ays_window").addClass('ays_active');
                            
                            ays_pb_view_type = '.ays_window';
                            $(document).find('.ays_bg_image_box').css({
                                'background-image' : bg_image_css,
                                'background-repeat' : 'no-repeat',
                                'background-size' : pb_bg_image_sizing,
                                'background-position' : pb_bg_image_position
                            });
                            $(document).find(ays_pb_view_type + ' .desc').html($("#<?php echo esc_attr($this->plugin_name); ?>-popup_description").val());
                            $(document).find(ays_pb_view_type + ' .ays_title').html( pbTitle );
                            $(ays_pb_view_type).css({
                                'background-color': $("#<?php echo esc_attr($this->plugin_name); ?>-bgcolor").val(),
                                'color': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_textcolor").val() + ' !important',
                                'border': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_bordersize").val() + "px"+ $('#ays_pb_border_style').val()+ $("#<?php echo esc_attr($this->plugin_name); ?>-bordercolor").val(),
                                'border-radius': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_border_radius").val() + 'px','font-family': $('#ays_pb_font_family').val(),
                            });
                            if($(document).find('#ays_enable_title_text_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow' , textShadowX+'px '+textShadowY +'px '+textShadowZ+'px '+textShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow', 'unset');
                            }

                            if($(document).find('#ays_pb_enable_box_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type).css('box-shadow' , boxShadowX+'px '+boxShadowY +'px '+boxShadowZ+'px '+boxShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type).css('box-shadow', 'unset');
                            }

                            break;
                        case 'cmd':
                            $(document).find(".ays-pb-live-container-main.ays_cmd_window").removeClass('display_none');
                            $(document).find(".ays-pb-live-container-main.ays_cmd_window").addClass('ays_active');

                            ays_pb_view_type = '.ays_cmd_window';
                            $(document).find('.ays_bg_image_box').css({
                                'background-image' : bg_image_css,
                                'background-repeat' : 'no-repeat',
                                'background-size' : pb_bg_image_sizing,
                                'background-position' : pb_bg_image_position
                            });
                            $(document).find(ays_pb_view_type + ' .desc').html($("#<?php echo esc_attr($this->plugin_name); ?>-popup_description").val());
                            $(document).find(ays_pb_view_type + ' .ays_title').html( pbTitle );
                            $(ays_pb_view_type).css({
                                'background-color': $("#<?php echo esc_attr($this->plugin_name); ?>-bgcolor").val(),
                                'color': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_textcolor").val() + ' !important',
                                'border': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_bordersize").val() + "px "+$('#ays_pb_border_style').val()+ $("#<?php echo esc_attr($this->plugin_name); ?>-bordercolor").val(),
                                'border-radius': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_border_radius").val() + 'px','font-family': $('#ays_pb_font_family').val(),
                            });
                            if($(document).find('#ays_enable_title_text_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow' , textShadowX+'px '+textShadowY +'px '+textShadowZ+'px '+textShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow', 'unset');
                            }

                            if($(document).find('#ays_pb_enable_box_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type).css('box-shadow' , boxShadowX+'px '+boxShadowY +'px '+boxShadowZ+'px '+boxShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type).css('box-shadow', 'unset');
                            }
                            
                            break;
                        case 'ubuntu':
                            $(document).find(".ays-pb-live-container-main.ays_ubuntu_window").removeClass('display_none');
                            $(document).find(".ays-pb-live-container-main.ays_ubuntu_window").addClass('ays_active');

                            ays_pb_view_type = '.ays_ubuntu_window';
                            $(document).find('.ays_bg_image_box').css({
                                'background-image' : bg_image_css,
                                'background-repeat' : 'no-repeat',
                                'background-size' : pb_bg_image_sizing,
                                'background-position' : pb_bg_image_position
                            });
                            $(document).find(ays_pb_view_type + ' .desc').html($("#<?php echo esc_attr($this->plugin_name); ?>-popup_description").val());
                            $(document).find(ays_pb_view_type + ' .ays_title').html( pbTitle );
                            $(ays_pb_view_type).css({
                                'background-color': $("#<?php echo esc_attr($this->plugin_name); ?>-bgcolor").val(),
                                'color': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_textcolor").val() + ' !important',
                                'border': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_bordersize").val() + "px "+$('#ays_pb_border_style').val()+ $("#<?php echo esc_attr($this->plugin_name); ?>-bordercolor").val(),
                                'border-radius': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_border_radius").val() + 'px','font-family': $('#ays_pb_font_family').val(),
                            });
                            if($(document).find('#ays_enable_title_text_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow' , textShadowX+'px '+textShadowY +'px '+textShadowZ+'px '+textShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow', 'unset');
                            }

                            if($(document).find('#ays_pb_enable_box_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type).css('box-shadow' , boxShadowX+'px '+boxShadowY +'px '+boxShadowZ+'px '+boxShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type).css('box-shadow', 'unset');
                            }
                            
                            break;
                        case 'winXP':
                            $(document).find(".ays-pb-live-container-main.ays_winxp_window").removeClass('display_none');
                            $(document).find(".ays-pb-live-container-main.ays_winxp_window").addClass('ays_active');

                            ays_pb_view_type = '.ays_winxp_window';
                            $(document).find(ays_pb_view_type + ' .desc').html($("#<?php echo esc_attr($this->plugin_name); ?>-popup_description").val());
                            $(document).find(ays_pb_view_type + ' .ays_title').html( pbTitle );
                            $(document).find(ays_pb_view_type + ' .ays_winxp_content').css({
                                'background-color': $("#<?php echo esc_attr($this->plugin_name); ?>-bgcolor").val()
                            });
                            $(document).find('.ays_bg_image_box').css({
                                'background-image' : bg_image_css,
                                'background-repeat' : 'no-repeat',
                                'background-size' : pb_bg_image_sizing,
                                'background-position' : pb_bg_image_position
                            });
                            $(ays_pb_view_type).css({
                                'color': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_textcolor").val() + ' !important',
                                'border': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_bordersize").val() + "px "+$('#ays_pb_border_style').val()+ $("#<?php echo esc_attr($this->plugin_name); ?>-bordercolor").val(),
                                'border-radius': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_border_radius").val() + 'px','font-family': $('#ays_pb_font_family').val(),
                            });
                            if($(document).find('#ays_enable_title_text_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow' , textShadowX+'px '+textShadowY +'px '+textShadowZ+'px '+textShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow', 'unset');
                            }

                            if($(document).find('#ays_pb_enable_box_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type).css('box-shadow' , boxShadowX+'px '+boxShadowY +'px '+boxShadowZ+'px '+boxShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type).css('box-shadow', 'unset');
                            }
                            
                            break;
                        case 'win98':
                            $(document).find(".ays-pb-live-container-main.ays_win98_window").removeClass('display_none');
                            $(document).find(".ays-pb-live-container-main.ays_win98_window").addClass('ays_active');

                            ays_pb_view_type = '.ays_win98_window';
                            $(document).find('.ays_bg_image_box').css({
                                'background-image' : bg_image_css,
                                'background-repeat' : 'no-repeat',
                                'background-size' : pb_bg_image_sizing,
                                'background-position' : pb_bg_image_position
                            });
                            $(document).find(ays_pb_view_type + ' .desc').html($("#<?php echo esc_attr($this->plugin_name); ?>-popup_description").val());
                            $(document).find(ays_pb_view_type + ' .ays_title').html( pbTitle );
                            $(document).find("#ays-pb-close-button-text").on('change', function () {
                                $(ays_pb_view_type + ' .ays-close-button-text').html($("#ays-pb-close-button-text").val());
                            });
                            $(ays_pb_view_type).css({
                                'background-color': $("#<?php echo esc_attr($this->plugin_name); ?>-bgcolor").val(),
                                'color': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_textcolor").val() + ' !important',
                                'border': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_bordersize").val() + "px "+$('#ays_pb_border_style').val()+ $("#<?php echo esc_attr($this->plugin_name); ?>-bordercolor").val(),
                                'border-radius': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_border_radius").val() + 'px','font-family': $('#ays_pb_font_family').val(),
                            });
                            $(document).find('.ays_bg_image_box').css({
                                'background-image' : bg_image_css,
                                'background-repeat' : 'no-repeat',
                                'background-size' : pb_bg_image_sizing,
                                'background-position' : pb_bg_image_position
                            });
                            if($(document).find('#ays_enable_title_text_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow' , textShadowX+'px '+textShadowY +'px '+textShadowZ+'px '+textShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow', 'unset');
                            }

                            if($(document).find('#ays_pb_enable_box_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type).css('box-shadow' , boxShadowX+'px '+boxShadowY +'px '+boxShadowZ+'px '+boxShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type).css('box-shadow', 'unset');
                            }
                            
                            break;
                        case 'lil':
                            $(document).find(".ays-pb-live-container-main.ays_lil_window").removeClass('display_none');
                            $(document).find(".ays-pb-live-container-main.ays_lil_window").addClass('ays_active');

                            ays_pb_view_type = '.ays_lil_window';
                            $(document).find(ays_pb_view_type + ' .desc').html($("#<?php echo esc_attr($this->plugin_name); ?>-popup_description").val());
                            $(document).find(ays_pb_view_type + ' .ays_title').html( pbTitle );
                            $(document).find("#ays-pb-close-button-text").on('change', function () {
                                $(ays_pb_view_type + ' .ays-close-button-text').html($("#ays-pb-close-button-text").val());
                            });
                            $(ays_pb_view_type).css({
                                'background-color': $("#<?php echo esc_attr($this->plugin_name); ?>-bgcolor").val(),
                                'color': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_textcolor").val() + ' !important',
                                'border': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_bordersize").val() + "px "+$('#ays_pb_border_style').val()+ $("#<?php echo esc_attr($this->plugin_name); ?>-bordercolor").val(),
                                'border-radius': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_border_radius").val() + 'px','font-family': $('#ays_pb_font_family').val(),
                            });
                            $(document).find('.ays_bg_image_box').css({
                                'background-image' : bg_image_css,
                                'background-repeat' : 'no-repeat',
                                'background-size' : pb_bg_image_sizing,
                                'background-position' : pb_bg_image_position
                            });
                            $(document).find('.ays_lil_head').css('background-color', $("#<?php echo esc_attr($this->plugin_name); ?>-header_bgcolor").val() + ' !important');
                            $(document).find('.ays_lil_head .ays-close-button-take-text-color').css('background-color', $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_textcolor").val() + ' !important');
                            $(document).find('.ays_lil_head .ays-close-button-take-text-color').css('color', $("#<?php echo esc_attr($this->plugin_name); ?>-header_bgcolor").val() + " !important");
                            changeCloseButtonPosition();
                            if($(document).find('#ays_enable_title_text_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow' , textShadowX+'px '+textShadowY +'px '+textShadowZ+'px '+textShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow', 'unset');
                            }

                            if($(document).find('#ays_pb_enable_box_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type).css('box-shadow' , boxShadowX+'px '+boxShadowY +'px '+boxShadowZ+'px '+boxShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type).css('box-shadow', 'unset');
                            }
                            $(document).find("#ays_pb_close_button_color").val('#ffffff');
                            var closeBtnDefaultColor = $(document).find('#ays_pb_close_button_color').val('#fff');
                            break;
                        case 'image':
                            $(document).find(".ays-pb-live-container-main.ays_image_window").removeClass('display_none');
                            $(document).find(".ays-pb-live-container-main.ays_image_window").addClass('ays_active');

                            ays_pb_view_type = '.ays_image_window';
                            $(document).find(ays_pb_view_type + ' .desc').html($("#<?php echo esc_attr($this->plugin_name); ?>-popup_description").val());
                            $(document).find(ays_pb_view_type + ' .ays_title').html( pbTitle );
                            $(document).find("#ays-pb-close-button-text").on('change', function () {
                                $(ays_pb_view_type + ' .ays-close-button-text').html($("#ays-pb-close-button-text").val());
                            });
                            $(ays_pb_view_type).css({
                                'background-color': $("#<?php echo esc_attr($this->plugin_name); ?>-bgcolor").val(),
                                'color': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_textcolor").val() + ' !important',
                                'border': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_bordersize").val() + "px "+$('#ays_pb_border_style').val()+ $("#<?php echo esc_attr($this->plugin_name); ?>-bordercolor").val(),
                                'border-radius': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_border_radius").val() + 'px','font-family': $('#ays_pb_font_family').val(),
                            });
                            var bg_img_default = $("#<?php echo esc_attr($this->plugin_name); ?>-bg-image").val();
                            if(!bg_img_default)
                                bg_img_default="https://quiz-plugin.com/wp-content/uploads/2020/02/elefante.jpg";
                            $(document).find('.ays_bg_image_box').css({
                                'background-image' : 'url('+ bg_img_default +')',
                                'background-repeat' : 'no-repeat',
                                'background-size' : pb_bg_image_sizing,
                                'background-position' : pb_bg_image_position
                            });
                            changeCloseButtonPosition();
                            if($(document).find('#ays_enable_title_text_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow' , textShadowX+'px '+textShadowY +'px '+textShadowZ+'px '+textShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow', 'unset');
                            }

                            if($(document).find('#ays_pb_enable_box_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type).css('box-shadow' , boxShadowX+'px '+boxShadowY +'px '+boxShadowZ+'px '+boxShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type).css('box-shadow', 'unset');
                            }
                            var closeBtnDefaultColor = $(document).find('#ays_pb_close_button_color').val('#000');
                            break;
                        case 'minimal':
                            $(document).find(".ays-pb-live-container-main.ays_minimal_window").removeClass('display_none');
                            $(document).find(".ays-pb-live-container-main.ays_minimal_window").addClass('ays_active');

                            ays_pb_view_type = '.ays_minimal_window';

                            $(document).find(ays_pb_view_type + ' .desc').html($("#<?php echo esc_attr($this->plugin_name); ?>-popup_description").val());
                            $(document).find(ays_pb_view_type + ' .ays_title').html( pbTitle );

                            $(document).find("#ays-pb-close-button-text").on('change', function () {
                                if($("#ays-pb-close-button-text").val() == '✕'){
                                     $(ays_pb_view_type + ' .ays-close-button-text').html("<img src='<?php echo esc_url(AYS_PB_ADMIN_URL) ?>" + "/images/icons/times-circle.svg'>");
                                }else{
                                    $(ays_pb_view_type + ' .ays-close-button-text').html($("#ays-pb-close-button-text").val());
                                }
                            });
                            $(ays_pb_view_type).css({
                                'background-color': $("#<?php echo esc_attr($this->plugin_name); ?>-bgcolor").val(),
                                'color': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_textcolor").val() + ' !important',
                                'border': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_bordersize").val() + "px "+$('#ays_pb_border_style').val()+ $("#<?php echo esc_attr($this->plugin_name); ?>-bordercolor").val(),
                                'border-radius': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_border_radius").val() + 'px','font-family': $('#ays_pb_font_family').val(),
                            });

                            $(document).find('.ays_bg_image_box').css({
                                'background-image' : bg_image_css,
                                'background-repeat' : 'no-repeat',
                                'background-size' : pb_bg_image_sizing,
                                'background-position' : pb_bg_image_position
                            });
                            changeCloseButtonPosition();
                            if($(document).find('#ays_enable_title_text_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow' , textShadowX+'px '+textShadowY +'px '+textShadowZ+'px '+textShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow', 'unset');
                            }

                            if($(document).find('#ays_pb_enable_box_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type).css('box-shadow' , boxShadowX+'px '+boxShadowY +'px '+boxShadowZ+'px '+boxShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type).css('box-shadow', 'unset');
                            }
                            var closeBtnDefaultColor = $(document).find('#ays_pb_close_button_color').val('#000');
                            break;
                        case 'template':
                            $(document).find(".ays-pb-live-container-main.ays_template_window").removeClass('display_none');
                            $(document).find(".ays-pb-live-container-main.ays_template_window").addClass('ays_active');

                            ays_pb_view_type = '.ays_template_window';
                            $(document).find(ays_pb_view_type + ' .desc').html($("#<?php echo esc_attr($this->plugin_name); ?>-popup_description").val());
                            $(document).find(ays_pb_view_type + ' .ays_title').html( pbTitle );
                            $(document).find("#ays-pb-close-button-text").on('change', function () {
                                $(ays_pb_view_type + ' .ays-close-button-text').html($("#ays-pb-close-button-text").val());
                            });
                            $(ays_pb_view_type).css({
                                'background-color': $("#<?php echo esc_attr($this->plugin_name); ?>-bgcolor").val(),
                                'color': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_textcolor").val() + ' !important',
                                'border': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_bordersize").val() + "px "+$('#ays_pb_border_style').val()+ $("#<?php echo esc_attr($this->plugin_name); ?>-bordercolor").val(),
                                'border-radius': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_border_radius").val() + 'px','font-family': $('#ays_pb_font_family').val(),
                            });
                            $(document).find('.ays_template_head').css('background-color', $("#<?php echo esc_attr($this->plugin_name); ?>-header_bgcolor").val() + ' !important');
                            var bg_img_default = $("#<?php echo esc_attr($this->plugin_name); ?>-bg-image").val();
                            if(!bg_img_default)
                                bg_img_default="https://quiz-plugin.com/wp-content/uploads/2020/02/girl-scaled.jpg";
                            $(document).find('.ays_bg_image_box').css({
                                'background-image' : 'url(' + bg_img_default + ')',
                                'background-repeat' : 'no-repeat',
                                'background-size' : pb_bg_image_sizing,
                                'background-position' : pb_bg_image_position
                            });
                            changeCloseButtonPosition();
                            if($(document).find('#ays_enable_title_text_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow' , textShadowX+'px '+textShadowY +'px '+textShadowZ+'px '+textShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow', 'unset');
                            }

                            if($(document).find('#ays_pb_enable_box_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type).css('box-shadow' , boxShadowX+'px '+boxShadowY +'px '+boxShadowZ+'px '+boxShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type).css('box-shadow', 'unset');
                            }
                            var closeBtnDefaultColor = $(document).find('#ays_pb_close_button_color').val('#000');
                            break;
                        case 'video':
                            if(modal_content == 'video_type'){
                                $(document).find(".ays-pb-live-container-main.ays_video_window").removeClass('display_none');
                                $(document).find(".ays-pb-live-container-main.ays_video_window").addClass('ays_active');

                                ays_pb_view_type = '.ays_video_window';
                                $(document).find('.ays_bg_image_box').css({
                                    'background-image' : bg_image_css,
                                    'background-repeat' : 'no-repeat',
                                    'background-size' : pb_bg_image_sizing,
                                    'background-position' : pb_bg_image_position
                                });
                                $(document).find(ays_pb_view_type + ' .desc').html($("#<?php echo esc_attr($this->plugin_name); ?>-popup_description").val());
                                $(document).find(ays_pb_view_type + ' .ays_title').html( pbTitle );
                                $(document).find("#ays-pb-close-button-text").on('change', function () {
                                    $(ays_pb_view_type + ' .ays-close-button-text').html($("#ays-pb-close-button-text").val());
                                });
                                $(ays_pb_view_type).css({
                                
                                    'color': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_textcolor").val() + ' !important',
                                    'border': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_bordersize").val() + "px "+$('#ays_pb_border_style').val()+ $("#<?php echo esc_attr($this->plugin_name); ?>-bordercolor").val(),
                                    'border-radius': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_border_radius").val() + 'px','font-family': $('#ays_pb_font_family').val(),
                                });
                            }
                            changeCloseButtonPosition();
                            if($(document).find('#ays_enable_title_text_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow' , textShadowX+'px '+textShadowY +'px '+textShadowZ+'px '+textShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow', 'unset');
                            }

                            if($(document).find('#ays_pb_enable_box_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type).css('box-shadow' , boxShadowX+'px '+boxShadowY +'px '+boxShadowZ+'px '+boxShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type).css('box-shadow', 'unset');
                            }
                            var closeBtnDefaultColor = $(document).find('#ays_pb_close_button_color').val('#000');
                            break;
                        default:
                            $(document).find(".ays-pb-live-container-main.ays-pb-modal").removeClass('display_none');
                            $(document).find(".ays-pb-live-container-main.ays-pb-modal").addClass('ays_active');

                            $(document).find('.ays_bg_image_box').css({
                                'background-image' : 'url(' + $("#<?php echo esc_attr($this->plugin_name); ?>-bg-image").val() + ')',
                                'background-repeat' : 'no-repeat',
                                'background-size' : pb_bg_image_sizing,
                                'background-position' : pb_bg_image_position
                            });
                            ays_pb_view_type = '.ays-pb-modal';
                            $(document).find(ays_pb_view_type + ' .desc').html($("#<?php echo esc_attr($this->plugin_name); ?>-popup_description").val());
                            $(document).find(ays_pb_view_type + ' .ays_title').html( pbTitle );
                            $(document).find("#ays-pb-close-button-text").on('change', function () {
                                $(ays_pb_view_type + ' .ays-close-button-text').html($("#ays-pb-close-button-text").val());
                            });
                            $(ays_pb_view_type).css({
                                'background-color': $("#<?php echo esc_attr($this->plugin_name); ?>-bgcolor").val(),
                                'color': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_textcolor").val() + ' !important',
                                'border': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_bordersize").val() + "px "+$('#ays_pb_border_style').val()+ $("#<?php echo esc_attr($this->plugin_name); ?>-bordercolor").val(),
                                'border-radius': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_border_radius").val() + 'px','font-family': $('#ays_pb_font_family').val(),
                            });
                            changeCloseButtonPosition();
                            if($(document).find('#ays_enable_title_text_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow' , textShadowX+'px '+textShadowY +'px '+textShadowZ+'px '+textShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow', 'unset');
                            }

                            if($(document).find('#ays_pb_enable_box_shadow').prop('checked')){
                                $(document).find(ays_pb_view_type).css('box-shadow' , boxShadowX+'px '+boxShadowY +'px '+boxShadowZ+'px '+boxShadowColor);
                            }else{
                                $(document).find(ays_pb_view_type).css('box-shadow', 'unset');
                            }
                            var closeBtnDefaultColor = $(document).find('#ays_pb_close_button_color').val('#000');
                            break;
                    }
                });

                $(ays_pb_view_type).css({
                    'background-color': $("#<?php echo esc_attr($this->plugin_name); ?>-bgcolor").val(),
                    'color': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_textcolor").val() + ' !important',
                    'border': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_bordersize").val() + "px "+$('#ays_pb_border_style').val()+ $("#<?php echo esc_attr($this->plugin_name); ?>-bordercolor").val(),
                    'border-radius': $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_border_radius").val() + 'px',
                    'font-family': $('#ays_pb_font_family').val(),
                });

                $(document).find(ays_pb_view_type + ' .desc').html($("#<?php echo esc_attr($this->plugin_name); ?>-popup_description").val());
                $(document).find(ays_pb_view_type + ' .ays_title').html( pbTitle );

                $(document).find("#<?php echo esc_attr($this->plugin_name); ?>-popup_title").on('change', function () {
                    var pbTitleVal = $(this).val();
                    var pbTitle = aysPopupstripHTML( pbTitleVal );

                    $(ays_pb_view_type + ' .ays_title').html( pbTitle );
                });
                $(document).find("#<?php echo esc_attr($this->plugin_name); ?>-popup_description").on('change', function () {
                    $(ays_pb_view_type + ' .desc').html($("#<?php echo esc_attr($this->plugin_name); ?>-popup_description").val());
                });
                $(document).find("#ays-pb-close-button-text").on('change', function () {
                    let $this      = $(document).find('.ays-pb-modal .ays-close-button-text');
                    let buttonText = $(this).val();
                    if (buttonText == '') {
                        buttonText = '✕'
                    }
                    $(document).find('.ays-close-button-text').html(buttonText);
                    if ((buttonText == '✕' || buttonText == '') && $(document).find('a.close-lil-btn').hasClass('close-lil-btn-text')) {
                        $(document).find('a.close-lil-btn').removeClass('close-lil-btn-text');
                    }
                    else if (!$(document).find('a.close-lil-btn').hasClass('close-lil-btn-text')){
                        if (buttonText != '') {
                            $(document).find('a.close-lil-btn').addClass('close-lil-btn-text');
                        }
                    }
                    if($("#ays-pb-close-button-text").val() == '✕'){
                          $(document).find('.ays_minimal_window .ays-close-button-text').html("<img src='<?php echo esc_url(AYS_PB_ADMIN_URL) ?>" + "/images/icons/times-circle.svg'>");
                    }else{
                         $(document).find('.ays_minimal_window .ays-close-button-text').html($("#ays-pb-close-button-text").val());
                    }

                    if($("#ays-pb-close-button-text").val() == '✕'){
                         $(document).find('.ays-pb-modal .ays-close-button-text').html("<img src='<?php echo esc_url(AYS_PB_ADMIN_URL) ?>" + "/images/icons/times-2x.svg'>");
                    }else{
                         $(document).find('.ays-pb-modal .ays-close-button-text').html($("#ays-pb-close-button-text").val());
                    }
                });

                $(document).find("#ays-pb-close-button-position").on('change',function(){
                    changeCloseButtonPosition()
                });

                function changeCloseButtonPosition(){
                    let position = $(document).find('#ays-pb-close-button-position').val();
                    let ays_pb_radius = Math.abs($(document).find('#ays-pb-ays_pb_bordersize').val());
                    let checkedTheme = $(document).find("input[name='<?php echo esc_attr($this->plugin_name); ?>[view_type]']:checked").val();
                    let tb,tb_value,rl,rl_value,auto_1,auto_2,res;
                    let ays_pb_checked_theme_class = '';

                    switch(checkedTheme){
                        case "lil": //top 3 right 3 
                            ays_pb_checked_theme_class = ".ays_lil_window .close-lil-btn";
                            switch(position){
                                case "left-top":
                                    tb = "top"; tb_value = "10px";
                                    rl = "left"; rl_value = "10px";
                                    auto_1 = 'bottom'; auto_2 = 'right';
                                    break;
                                case "left-bottom":
                                    tb = "bottom"; tb_value = "10px";
                                    rl = "left"; rl_value = "10px";
                                    auto_1 = 'top'; auto_2 = 'right';
                                    break;
                                case "right-bottom":
                                    tb = "bottom"; tb_value = "10px";
                                    rl = "right"; rl_value = "10px";
                                    auto_1 = 'top'; auto_2 = 'left';
                                    break;
                                default:
                                    tb = "top"; tb_value = "10px";
                                    rl = "right"; rl_value = "10px";
                                    auto_1 = 'bottom'; auto_2 = 'left';
                            }
                            break;
                        case "image"://top -20px right 0
                            ays_pb_checked_theme_class = ".ays_image_window .close-image-btn";
                             switch(position){
                                case "left-top":
                                    res = -20 - ays_pb_radius;
                                    tb = "top"; tb_value = res+"px";
                                    rl = "left"; rl_value = -ays_pb_radius+"px";
                                    auto_1 = 'bottom'; auto_2 = 'right';
                                    break;
                                case "left-bottom":
                                    res = -20 - ays_pb_radius;
                                    tb = "bottom"; tb_value = res+"px";
                                    rl = "left"; rl_value = -ays_pb_radius+"px";
                                    auto_1 = 'top'; auto_2 = 'right';
                                    break;
                                case "right-bottom":
                                    res = -20 - ays_pb_radius;
                                    tb = "bottom"; tb_value = res+"px";
                                    rl = "right"; rl_value = -ays_pb_radius+"px";
                                    auto_1 = 'top'; auto_2 = 'left';
                                    break;
                                default:
                                    res = -20 - ays_pb_radius;
                                    tb = "top"; tb_value = res+"px";
                                    rl = "right"; rl_value = -ays_pb_radius+"px";
                                    auto_1 = 'bottom'; auto_2 = 'left';
                            }
                            break;
                        case "minimal"://top -20px right 0
                            ays_pb_checked_theme_class = ".ays_minimal_window .close-image-btn";
                             switch(position){
                                case "left-top":
                                    res = -20 - ays_pb_radius;
                                    tb = "top"; tb_value = res+"px";
                                    rl = "left"; rl_value = -ays_pb_radius+"px";
                                    auto_1 = 'bottom'; auto_2 = 'right';
                                    break;
                                case "left-bottom":
                                    res = -20 - ays_pb_radius;
                                    tb = "bottom"; tb_value = res+"px";
                                    rl = "left"; rl_value = -ays_pb_radius+"px";
                                    auto_1 = 'top'; auto_2 = 'right';
                                    break;
                                case "right-bottom":
                                    res = -20 - ays_pb_radius;
                                    tb = "bottom"; tb_value = res+"px";
                                    rl = "right"; rl_value = -ays_pb_radius+"px";
                                    auto_1 = 'top'; auto_2 = 'left';
                                    break;
                                default:
                                    res = -20 - ays_pb_radius;
                                    tb = "top"; tb_value = res+"px";
                                    rl = "right"; rl_value = -ays_pb_radius+"px";
                                    auto_1 = 'bottom'; auto_2 = 'left';
                            }
                            break;
                        case "template"://top 0 right 7px 
                            ays_pb_checked_theme_class = ".ays_template_window .close-template-btn";
                            switch(position){
                                case "left-top":
                                    tb = "top"; tb_value = "14px";
                                    rl = "left"; rl_value = "14px";
                                    auto_1 = 'bottom'; auto_2 = 'right';
                                    break;
                                case "left-bottom":
                                    tb = "bottom"; tb_value = "7px";
                                    rl = "left"; rl_value = "14px";
                                    auto_1 = 'top'; auto_2 = 'right';
                                    break;
                                case "right-bottom":
                                    tb = "bottom"; tb_value = "7px";
                                    rl = "right"; rl_value = "14px";
                                    auto_1 = 'top'; auto_2 = 'left';
                                    break;
                                default:
                                    tb = "top"; tb_value = "14px";
                                    rl = "right"; rl_value = "14px";
                                    auto_1 = 'bottom'; auto_2 = 'left';
                            }
                            break;
                        case "video"://top -20px right 0
                            ays_pb_checked_theme_class = ".ays_video_window .close-video-btn";
                             switch(position){
                                case "left-top":
                                    res = -20 - ays_pb_radius;
                                    tb = "top"; tb_value = res+"px";
                                    rl = "left"; rl_value = -ays_pb_radius+"px";
                                    auto_1 = 'bottom'; auto_2 = 'right';
                                    break;
                                case "left-bottom":
                                    res = -20 - ays_pb_radius;
                                    tb = "bottom"; tb_value = res+"px";
                                    rl = "left"; rl_value = -ays_pb_radius+"px";
                                    auto_1 = 'top'; auto_2 = 'right';
                                    break;
                                case "right-bottom":
                                    res = -20 - ays_pb_radius;
                                    tb = "bottom"; tb_value = res+"px";
                                    rl = "right"; rl_value = -ays_pb_radius+"px";
                                    auto_1 = 'top'; auto_2 = 'left';
                                    break;
                                default:
                                    res = -20 - ays_pb_radius;
                                    tb = "top"; tb_value = res+"px";
                                    rl = "right"; rl_value = -ays_pb_radius+"px";
                                    auto_1 = 'bottom'; auto_2 = 'left';
                            }
                            break;
                        case "default":
                        case "image_type_img_theme":
                        case "facebook"://top 0 right 10px
                            ays_pb_checked_theme_class = ".ays-pb-modal .ays-pb-modal-close, .ays_image_type_img_window .ays-pb-modal-close";
                            switch(position){
                                case "left-top":
                                    tb = "top"; tb_value = "0";
                                    rl = "left"; rl_value = "10px";
                                    auto_1 = 'bottom'; auto_2 = 'right';
                                    break;
                                case "left-bottom":
                                    tb = "bottom"; tb_value = "10px";
                                    rl = "left"; rl_value = "10px";
                                    auto_1 = 'top'; auto_2 = 'right';
                                    break;
                                case "right-bottom":
                                    tb = "bottom"; tb_value = "10px";
                                    rl = "right"; rl_value = "10px";
                                    auto_1 = 'top'; auto_2 = 'left';
                                    break;
                                default:
                                    tb = "top"; tb_value = "0";
                                    rl = "right"; rl_value = "10px";
                                    auto_1 = 'bottom'; auto_2 = 'left';
                            }
                            break;
                        default:
                            ays_pb_checked_theme_class = '';
                            tb = "top"; tb_value = "0";
                            rl = "right"; rl_value = "0";
                            auto_1 = 'bottom'; auto_2 = 'left';
                    }
                    $(document).find(ays_pb_checked_theme_class).css(tb,tb_value).css(rl,rl_value).css(auto_1,'auto').css(auto_2,'auto');
                }

                var optionsForBgColor = {
                    change: function (e) {
                        setTimeout(function() {
                            if (ays_pb_view_type == '.ays_winxp_window') {
                                $(ays_pb_view_type + ' .ays_winxp_content').css('background-color', e.target.value);
                            } else {
                                ".ays_image_type_img_window"
                                $(ays_pb_view_type + ", .ays_image_type_img_window").css('background-color', e.target.value);
                            }
                        }, 100, e.target.value)
                    }
                }

                var optionsForTextColor = {
                    change: function (e) {
                        setTimeout(function() {
                            $(ays_pb_view_type + ", .ays_image_type_img_window").css('color', e.target.value + " !important");
                        }, 100, e.target.value)
                    }
                }

                var optionsForBorderColor = {
                    change: function (e) {
                        setTimeout(function() {
                            $(ays_pb_view_type + ", .ays_image_type_img_window").css('border-color', e.target.value);
                        }, 100, e.target.value)
                    }
                }

                var optionsForOverlayColor = {
                    change: function (e) {
                        setTimeout(function() {
                            $(document).find('.ays-pb-modals').css('background-color', e.target.value + " !important");
                        }, 100, e.target.value)
                    }
                }

                var optionsForTextShadowColor = {
                    change: function (e) {
                        setTimeout(function() {
                            var x = $("#ays_pb_title_text_shadow_x_offset").val();
                            var y = $("#ays_pb_title_text_shadow_y_offset").val();
                            var z = $("#ays_pb_title_text_shadow_z_offset").val();
                            $(document).find(ays_pb_view_type+' h2.ays_title').css("text-shadow", x+"px "+y+"px "+z+"px "+e.target.value);
                        }, 100, e.target.value)
                    }
                }

                var optionsForBoxShadowColor = {
                    change: function (e) {
                        setTimeout(function() {
                            var x = $("#ays_pb_box_shadow_x_offset").val();
                            var y = $("#ays_pb_box_shadow_y_offset").val();
                            var z = $("#ays_pb_box_shadow_z_offset").val();
                            $(document).find(ays_pb_view_type + ", .ays_image_type_img_window").css("box-shadow", x+"px "+y+"px "+z+"px "+e.target.value);
                        }, 100, e.target.value)
                    }
                }

                $(document).find('table#ays_pb_bg_image_position_table tr td').on('click', function(e){
                    var bg_image_position_val= $(document).find('#ays_pb_bg_image_position').val();
                    var bg_image_position = bg_image_position_val.replace( '-', ' ' );
                    
                    $(document).find(ays_pb_view_type + ", .ays_image_type_img_window").css({'background-position':bg_image_position});
                });

                var optionsForBgHeader = {
                    change: function (e) {
                        setTimeout(function() {
                            $(document).find('.ays_lil_head').css('background-color', $("#<?php echo esc_attr($this->plugin_name); ?>-header_bgcolor").val()+ " !important");
                            $(document).find('.ays_template_head').css('background-color', $("#<?php echo esc_attr($this->plugin_name); ?>-header_bgcolor").val()+ " !important");
                        }, 100, e.target.value)
                    }
                }

                function aysPopupstripHTML( dirtyString ) {
                    var container = document.createElement('div');
                    var text = document.createTextNode(dirtyString);
                    container.appendChild(text);

                    return container.innerHTML; // innerHTML will be a xss safe string
                }

                $(document).find('.ays_pb_bgcolor_change').wpColorPicker(optionsForBgColor);
                $(document).find('.ays_pb_textcolor_change').wpColorPicker(optionsForTextColor);
                $(document).find('.ays_pb_bordercolor_change').wpColorPicker(optionsForBorderColor);
                $(document).find('.ays_pb_overlay_color_change').wpColorPicker(optionsForOverlayColor);
                $(document).find('#<?php echo esc_attr($this->plugin_name); ?>-header_bgcolor').wpColorPicker(optionsForBgHeader);
                $(document).find('#ays_title_text_shadow_color').wpColorPicker(optionsForTextShadowColor);
                $(document).find('#ays_pb_box_shadow_color').wpColorPicker(optionsForBoxShadowColor);

                if($(document).find('#ays_enable_title_text_shadow').prop('checked')){
                    if($(document).find('#ays_enable_title_text_shadow').prop('checked')){
                    $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow' , textShadowX+'px '+textShadowY +'px '+textShadowZ+'px '+textShadowColor);
                }else{
                    $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow', 'unset');
                }
                }else{
                    $(document).find(ays_pb_view_type+' h2.ays_title').css('text-shadow', 'unset');
                }

                if($(document).find('#ays_pb_enable_box_shadow').prop('checked')){
                    if($(document).find('#ays_pb_enable_box_shadow').prop('checked')){
                    $(document).find(ays_pb_view_type + ", .ays_image_type_img_window").css('box-shadow' , boxShadowX+'px '+boxShadowY +'px '+boxShadowZ+'px '+boxShadowColor);
                }else{
                    $(document).find(ays_pb_view_type + ", .ays_image_type_img_window").css('box-shadow', 'unset');
                }
                }else{
                    $(document).find(ays_pb_view_type + ", .ays_image_type_img_window").css('box-shadow', 'unset');
                }
                
                $(document).find("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_textcolor").on('change', function () {
                    $(ays_pb_view_type + ", .ays_image_type_img_window").css('color', $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_textcolor").val() + ' !important');
                });

                $(document).find("#ays_pb_title_text_shadow_x_offset").on('change', function () {
                    var textShadowColor = $('#ays_title_text_shadow_color').val();
                    var x = $(this).val();
                    var y = $("#ays_pb_title_text_shadow_y_offset").val();
                    var z = $("#ays_pb_title_text_shadow_z_offset").val();
                    $(document).find(ays_pb_view_type+' h2.ays_title').css("text-shadow", x+"px "+y+"px "+z+"px " +textShadowColor);
                });
                $(document).find("#ays_pb_title_text_shadow_y_offset").on('change', function () {
                    var textShadowColor = $('#ays_title_text_shadow_color').val();
                    var x = $('#ays_pb_title_text_shadow_x_offset').val();
                    var y = $(this).val();
                    var z = $("#ays_pb_title_text_shadow_z_offset").val();
                    $(document).find(ays_pb_view_type+' h2.ays_title').css("text-shadow", x+"px "+y+"px "+z+"px "+textShadowColor);
                });
                $(document).find("#ays_pb_title_text_shadow_z_offset").on('change', function () {
                    var textShadowColor = $('#ays_title_text_shadow_color').val();
                    var x = $('#ays_pb_title_text_shadow_x_offset').val();
                    var y = $("#ays_pb_title_text_shadow_y_offset").val();
                    var z = $(this).val();
                    $(document).find(ays_pb_view_type+' h2.ays_title').css("text-shadow", x+"px "+y+"px "+z+"px "+textShadowColor);
                });

                $(document).find("#ays_pb_box_shadow_x_offset").on('change', function () {
                    var boxShadowColor = $('#ays_box_shadow_color').val();
                    var x = $(this).val();
                    var y = $("#ays_pb_box_shadow_y_offset").val();
                    var z = $("#ays_pb_box_shadow_z_offset").val();
                    $(document).find(ays_pb_view_type + ", .ays_image_type_img_window").css("box-shadow", x+"px "+y+"px "+z+"px " +boxShadowColor);
                });

                $(document).find("#ays_pb_box_shadow_y_offset").on('change', function () {
                    var boxShadowColor = $('#ays_box_shadow_color').val();
                    var x = $('#ays_pb_box_shadow_x_offset').val();
                    var y = $(this).val();
                    var z = $("#ays_pb_box_shadow_z_offset").val();
                    $(document).find(ays_pb_view_type + ", .ays_image_type_img_window").css("box-shadow", x+"px "+y+"px "+z+"px "+boxShadowColor);
                });

                $(document).find("#ays_pb_box_shadow_z_offset").on('change', function () {
                    var boxShadowColor = $('#ays_box_shadow_color').val();
                    var x = $('#ays_pb_box_shadow_x_offset').val();
                    var y = $("#ays_pb_box_shadow_y_offset").val();
                    var z = $(this).val();
                    $(document).find(ays_pb_view_type + ", .ays_image_type_img_window").css("box-shadow", x+"px "+y+"px "+z+"px "+boxShadowColor);
                });

                $(document).find("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_bordersize").on('change', function () {
                    let ays_pb_radius = Math.abs($(this).val());
                    let ays_pb_bottom = (-40 - ays_pb_radius);
                    let closeBtnPosition = $(document).find('#ays-pb-close-button-position').val();
                    let tb,tb_value,rl,rl_value,auto_1,auto_2,res;
                    $(ays_pb_view_type + ", .ays_image_type_img_window").css('border', $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_bordersize").val() + "px "+$('#ays_pb_border_style').val()+ $("#<?php echo esc_attr($this->plugin_name); ?>-bordercolor").val());
                    $(document).find('.ays-pb-live-container.ays_image_window .ays_pb_timer').css('bottom', ays_pb_bottom+'px');
                    $(document).find('.ays-pb-live-container.ays_minimal_window .ays_pb_timer').css('bottom', ays_pb_bottom+'px');
                    switch(closeBtnPosition){
                         case "left-top":
                            res = -20 - ays_pb_radius;
                            tb = "top"; tb_value = res+"px";
                            rl = "left"; rl_value = -ays_pb_radius+"px";
                            auto_1 = 'bottom'; auto_2 = 'right';
                            break;
                        case "left-bottom":
                            res = -20 - ays_pb_radius;
                            tb = "bottom"; tb_value = res+"px";
                            rl = "left"; rl_value = -ays_pb_radius+"px";
                            auto_1 = 'top'; auto_2 = 'right';
                            break;
                        case "right-bottom":
                            res = -20 - ays_pb_radius;
                            tb = "bottom"; tb_value = res+"px";
                            rl = "right"; rl_value = -ays_pb_radius+"px";
                            auto_1 = 'top'; auto_2 = 'left';
                            break;
                        default:
                            res = -20 - ays_pb_radius;
                            tb = "top"; tb_value = res+"px";
                            rl = "right"; rl_value = -ays_pb_radius+"px";
                            auto_1 = 'bottom'; auto_2 = 'left';
                    }
                    $(document).find('.ays-pb-live-container .close-image-btn').css(tb,tb_value).css(rl,rl_value).css(auto_1,'auto').css(auto_2,'auto');

                });
                $(document).find("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_border_radius").on('change', function () {
                    $(ays_pb_view_type + ", .ays_image_type_img_window").css('border-radius', $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_border_radius").val() + 'px');
                    $(document).find('.ays_video_content>video').css('border-radius', $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_border_radius").val() + 'px');
                });
                $(document).find("#<?php echo esc_attr($this->plugin_name); ?>-animate_in").on('change', function () {
                    if($(this).val() == 'none'){
                        $(document).find('#ays_pb_animation_speed').prop( "disabled", true );
                        // $(document).find('#ays_pb_animation_speed_mobile').prop( "disabled", true );
                    }else{
                        $(document).find('#ays_pb_animation_speed').prop( "disabled", false );
                        // $(document).find('#ays_pb_animation_speed_mobile').prop( "disabled", false );
                    }
                    let animation_speed = Math.abs($(document).find('#ays_pb_animation_speed').val() ) +"s";
                    $(ays_pb_view_type + ", .ays_image_type_img_window").css('animation', $("#<?php echo esc_attr($this->plugin_name); ?>-animate_in").val() + " " + animation_speed);
                });
                $(document).find("#<?php echo esc_attr($this->plugin_name); ?>-animate_in_mobile").on('change', function () {
                    if($(this).val() == 'none'){
                        $(document).find('#ays_pb_animation_speed_mobile').prop( "disabled", true );
                    }else{
                        $(document).find('#ays_pb_animation_speed_mobile').prop( "disabled", false );
                    }
                });
                $(document).find("#<?php echo esc_attr($this->plugin_name); ?>-animate_out").on('change', function () {
                    if($(this).val() == 'none'){
                        $(document).find('#ays_pb_close_animation_speed').prop( "disabled", true );
                    }else{
                        $(document).find('#ays_pb_close_animation_speed').prop( "disabled", false );
                    }
                    let animation_speed = Math.abs($(document).find('#ays_pb_close_animation_speed').val() ) +"s";
                    $(ays_pb_view_type + ", .ays_image_type_img_window").css('animation', $("#<?php echo esc_attr($this->plugin_name); ?>-animate_out").val() + " " + animation_speed);
                });
                $(document).find("#<?php echo esc_attr($this->plugin_name); ?>-animate_out_mobile").on('change', function () {
                    if($(this).val() == 'none'){
                        $(document).find('#ays_pb_close_animation_speed_mobile').prop( "disabled", true );
                    }else{
                        $(document).find('#ays_pb_close_animation_speed_mobile').prop( "disabled", false );
                    }
                });
                $(document).find("#ays_pb_font_family").on('change', function () {
                    $(ays_pb_view_type).css('font-family', $('#ays_pb_font_family').val());
                });
                $(document).find("#ays_pb_font_size").on('change', function () {
                    $(ays_pb_view_type).find('p.desc').css('font-size', $('#ays_pb_font_family').val()+'px !important');
                });
                $(document).find("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_bordercolor").on('change', function () {
                    $(ays_pb_view_type).css('border', $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_bordersize").val() + "px "+$('#ays_pb_border_style').val()+ $("#<?php echo esc_attr($this->plugin_name); ?>-ays_pb_bordercolor").val());
                });
                $(document).find("#ays-active ,#ays-deactive").on('click',function(){
                    $(document).find("#ui-datepicker-div").css('z-index', '10010');
                });
                $(document).find("#ays_pb_close_button_size").on('change',function(){
                    $close_btn_size = $(document).find("#ays_pb_close_button_size").val();
                    if($close_btn_size == 0){
                        $close_btn_size = $(document).find("#ays_pb_close_button_size").val(1);
                        $(document).find('.ays-close-button-text').css({'transform': 'scale('+$close_btn_size+')'});
                    }else{
                        $(document).find('.ays-close-button-text').css({'transform': 'scale('+$close_btn_size+')'});
                    }
                });
                $(document).find('.close-lil-btn').hover(function(){
                    $close_btn_size = $(document).find("#ays_pb_close_button_size").val();
                    $('.close-lil-btn').css({'transform':'rotate(180deg) scale('+$close_btn_size+')'});
                },function(){
                    $close_btn_size = $(document).find("#ays_pb_close_button_size").val();
                    $('.close-lil-btn').css({'transform':'scale('+$close_btn_size+')'});
                });
                $(document).find("#ays_pb_close_button_color").on('change',function(){
                    $close_btn_color = $(document).find("#ays_pb_close_button_color").val();
                    $(document).find('.ays-close-button-text').css({'color': $close_btn_color});
                });

                var aysUnsavedChanges = false;
                $(document).on('change input', '#ays_pb_form .ays-pb-tab-content input, #ays_pb_form .ays-pb-tab-content select, #ays_pb_form .ays-pb-tab-content textarea', function() {
                    aysUnsavedChanges = true;
                });

                $(window).on('beforeunload', function(event) {
                    var saveButtons = $(document).find('.button#ays-button-top-apply, .button#ays-button-top, .button#ays-button-apply, .button#ays-button')
                    var savingButtonsClicked = saveButtons.filter('.ays-save-button-clicked').length > 0;

                    if (aysUnsavedChanges && !savingButtonsClicked) {
                        event.preventDefault();
                        event.returnValue = true;
                    }
                });
            });
        })(jQuery);
    </script>