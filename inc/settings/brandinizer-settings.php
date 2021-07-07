<?php

/**
 * Create Settings Menu
 */
function brandinizer_settings_menu()
{

    $hook = add_menu_page(
        __('', 'brandinizer-plugin'),
        __('Brandinizer', 'brandinizer-plugin'),
        'manage_options',
        'brandinizer-settings-page',
        'brandinizer_settings_template_callback',
        'dashicons-schedule',
        null
    );

    add_action('admin_head-' . $hook, 'brandinizer_image_uplaoder_assets', 10, 1);
}
add_action('admin_menu', 'brandinizer_settings_menu');

/**
 * Enqueue Image Uploader Assets
 */
function brandinizer_image_uplaoder_assets()
{
    wp_enqueue_media();

    wp_enqueue_style('froosty-bootstrap-css');
    wp_enqueue_script('froosty-bootstrap-js');

    wp_enqueue_style('brandinizer-image-uplaoder');
    wp_enqueue_script('brandinizer-image-uploader');

?>
    <script>
        const BRANDINIZER_PLUGIN_URL = '<?php echo  BRANDINIZER_PLUGIN_URL ?>';
        const BRANDINIZER_LOGO = '<?php echo  BRANDINIZER_LOGO ?>';
    </script>
<?php
}



/**
 * Settings Template Page
 */
function brandinizer_settings_template_callback()
{
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

        <form action="options.php" method="post">
            <?php
            // security field
            settings_fields('brandinizer-settings-page');

            // output settings section
            do_settings_sections('brandinizer-settings-page');

            // save settings button
            // submit_button('Save Settings');
            ?>
        </form>
    </div>
<?php
}

/**
 * Settings Template
 */
function brandinizer_settings_init()
{

    // Setup settings section
    add_settings_section(
        'brandinizer_settings_section',
        '',
        '',
        'brandinizer-settings-page'
    );

    // Register input field
    register_setting(
        'brandinizer-settings-page',
        'brandinizer_brand_name',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        )
    );

    // Display All fields
    add_settings_field(
        'brandinizer_brand_name',
        __('', 'brandinizer-plugin'),
        'brandinizer_all_settings_fields_callback',
        'brandinizer-settings-page',
        'brandinizer_settings_section'
    );

    // Register brandinizer_brand_tagline
    register_setting(
        'brandinizer-settings-page',
        'brandinizer_brand_tagline',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        )
    );

    // brandinizer_brand_tagline
    add_settings_field(
        'brandinizer_brand_tagline',
        __('', 'brandinizer-plugin'),
        'brandinizer_all_settings_fields_callback',
        'brandinizer-settings-page',
        ''
    );

    // Registe textarea field
    register_setting(
        'brandinizer-settings-page',
        'brandinizer_brand_description',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_textarea_field',
            'default' => ''
        )
    );

    // Add textarea fields
    add_settings_field(
        'brandinizer_brand_description',
        __('Textarea Field', 'brandinizer-plugin'),
        'brandinizer_brand_description_callback',
        'brandinizer-settings-page',
        ''
    );


    // Register radio field
    register_setting(
        'brandinizer-settings-page',
        'brandinizer_brand_logo_shape',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        )
    );

    // Add radio fields
    add_settings_field(
        'brandinizer_brand_logo_shape',
        __('Radio Field', 'brandinizer-plugin'),
        'brandinizer_brand_logo_shape_callback',
        'brandinizer-settings-page',
        ''
    );

    // Register checkbox field
    register_setting(
        'brandinizer-settings-page',
        'brandinizer_status',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_key',
            'default' => ''
        )
    );

    // Add checkbox fields
    add_settings_field(
        'brandinizer_status',
        __('Checkbox Field', 'brandinizer-plugin'),
        'brandinizer_status_callback',
        'brandinizer-settings-page',
        '' //section
    );

    // Register image uploader field
    register_setting(
        'brandinizer-settings-page',
        'brandinizer_brand_logo',
        array(
            'type' => 'integer',
            'sanitize_callback' => 'brandinizer_sanitize_image_uploader',
            'default' => ''
        )
    );

    // Add radio fields
    add_settings_field(
        'brandinizer_brand_logo',
        __('Image Uplaoder', 'brandinizer-plugin'),
        'brandinizer_brand_logo_callback',
        'brandinizer-settings-page',
        ''
    );
}
add_action('admin_init', 'brandinizer_settings_init');

/**
 * Sanitize Image Uploader
 */
function brandinizer_sanitize_image_uploader($value)
{
    if (isset($value)) {
        return intval($value);
    } else {
        return false;
    }
}


function brandinizer_all_settings_fields_callback()
{
    $brandinizer_brand_name             = sanitize_text_field(get_option('brandinizer_brand_name')); //sanitize text
    $brandinizer_brand_tagline          = sanitize_text_field(get_option('brandinizer_brand_tagline')); //sanitize text
    $brandinizer_brand_description      = sanitize_textarea_field(get_option('brandinizer_brand_description')); //sanitize textarea
    $brandinizer_brand_logo_shape       = sanitize_text_field(get_option('brandinizer_brand_logo_shape')); //sanitize text
    $brandinizer_status                 = sanitize_text_field(get_option('brandinizer_status')); //sanitize text
    $brandinizer_image_id               = sanitize_text_field(get_option('brandinizer_brand_logo')); //sanitize text

    if (isset($brandinizer_image_id) && $brandinizer_image_id == 0) {
        $brandinizer_logo_url = BRANDINIZER_LOGO;
    } else {
        $brandinizer_logo_url = esc_url(wp_get_attachment_url(isset($brandinizer_image_id) ? (int) $brandinizer_image_id : 0));
    }
?>

    <div class="froosty brandinizer-masthead">
        <div class="bg-white p-2 mb-1 shadow-sm col-lg-4">

            <img id="brandinizer-logo" class="" src="<?php echo  esc_attr(BRANDINIZER_LOGO); ?>" alt="">

            <div style="display: inline-block;" class="align-middle ml-3">
                <h5 style="margin-bottom: -2px;">Brandinizer</h5>
                <a style="text-decoration: none;" href="https://froosty.tech/about/" target="_blank">
                    <small class="text-muted" style="margin-bottom: -5px !important;">by - <span class="text-info">Shubham Shinde</span></small>
                </a>
            </div>
        </div>
    </div>


    <div class="froosty ">
        <div class="bg-white p-5 mb-1 shadow-sm col-lg-8">

            <form class="row g-3">

                <div class="form-group text-center mb-3">
                    <label for="inputZip" class="form-label">Brand Logo</label>
                    <center>
                        <div class="brandinizer-upload-wrap">
                        
                            <img style=" width: 130px; height: 130px;" class=" brandinizer-brand-logo <?php echo esc_attr(isset($brandinizer_brand_logo_shape) && esc_attr($brandinizer_brand_logo_shape) == 'circle')  ? 'rounded-circle' : ''; ?> " src="<?php echo esc_url($brandinizer_logo_url); ?>">

                            <div class="brandinizer-upload-action">
                                <input type="hidden" name="brandinizer_brand_logo" value="<?php echo esc_attr(isset($brandinizer_image_id) ? (int) $brandinizer_image_id : 0); ?>" />

                                <button type="button" class="brandinizer_upload_image_button"><span class="dashicons dashicons-format-image"></span></button>
                                
                                <button type="button" class="brandinizer_remove_image_button"><span class="dashicons dashicons-trash"></span></button>
                            </div>
                        </div>
                    </center>
                </div>

                <div class="row">
                    <div class="col-lg-6 mt-3">
                        <label for="inputEmail4" class="form-label">Brand Name</label>

                        <input type="text" id="inputEmail4" name="brandinizer_brand_name" class="form-control" value="<?php echo isset($brandinizer_brand_name) ? esc_attr($brandinizer_brand_name) : ''; ?>" />
                    </div>

                    <div class="col-lg-6 mt-3">
                        <label for="inputPassword4" class="form-label">Brand Tagline</label>
                        <input type="text" id="inputEmail4" name="brandinizer_brand_tagline" class="form-control" value="<?php echo isset($brandinizer_brand_tagline) ? esc_attr($brandinizer_brand_tagline) : ''; ?>" />
                    </div>
                </div>


                <div class="col-lg-12 mt-3">
                    <label for="inputAddress2" class="form-label">Brand Description</label>
                    <textarea class="form-control" id="inputPassword4" name="brandinizer_brand_description" class="large-text" rows="3"><?php echo isset($brandinizer_brand_description) ? esc_textarea($brandinizer_brand_description) : ''; ?></textarea>
                </div>

                <div class="col-lg-4 mt-3">
                    <div class="form-group">

                        Logo shape :

                        <input class="brandinizer_shape_selector" style="margin-left:20px;" type="radio" name="brandinizer_brand_logo_shape" value="circle" <?php checked('circle', esc_attr($brandinizer_brand_logo_shape)); ?> /> Circle

                        <input class="brandinizer_shape_selector" style="margin-left:20px;" type="radio" name="brandinizer_brand_logo_shape" value="square" <?php checked('square', esc_attr($brandinizer_brand_logo_shape)); ?> /> Square

                    </div>
                </div>

                <div class="col-lg-12 mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck" name="brandinizer_status" value="yes" <?php checked('yes', esc_attr($brandinizer_status)); ?> />

                        <label class="form-check-label" for="gridCheck">
                            Allow Brandinizer to customize branding
                        </label>
                    </div>

                </div>
                <div class="col-12">
                    <button type="submit" class="mt-3 btn btn-dark">Save</button>
                </div>

            </form>

        </div>
    </div>


<?php
}


/**
 * textarea template
 */
function brandinizer_brand_description_callback()
{
}

/**
 * radio field tempalte
 */
function brandinizer_brand_logo_shape_callback()
{
}

/**
 * Chekcbox Tempalte
 */
function brandinizer_status_callback()
{
}

/**
 * Image Uploader Template
 */
function brandinizer_brand_logo_callback()
{
}
