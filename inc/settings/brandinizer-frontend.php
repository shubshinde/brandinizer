<?php

$brandinizer_brand_name             = sanitize_text_field(get_option('brandinizer_brand_name')); //sanitize text
$brandinizer_brand_tagline          = sanitize_text_field(get_option('brandinizer_brand_tagline')); //sanitize text
$brandinizer_brand_description      = sanitize_textarea_field(get_option('brandinizer_brand_description')); //sanitize textarea
$brandinizer_brand_logo_shape       = sanitize_text_field(get_option('brandinizer_brand_logo_shape')); //sanitize text
$brandinizer_status                 = sanitize_text_field(get_option('brandinizer_status')); //sanitize text
$brandinizer_image_id               = sanitize_text_field(get_option('brandinizer_brand_logo')); //sanitize text

if (isset($brandinizer_image_id) && $brandinizer_image_id == 0) {
    $brandinizer_logo_url = BRANDINIZER_LOGO;
} else {
    $brandinizer_logo_url = wp_get_attachment_url(isset($brandinizer_image_id) ? (int) $brandinizer_image_id : 0);
}

$shape_style = (isset($brandinizer_brand_logo_shape) && $brandinizer_brand_logo_shape == 'circle')  ? '100%' : '0%';


// For Dasboard Page
if (strstr($_SERVER['REQUEST_URI'], 'wp-admin/index.php') || $_SERVER['REQUEST_URI'] == '/wp-admin/') {

    if (isset($brandinizer_status) && $brandinizer_status == 'yes') {

    ?>
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {

                var brandInfoHtml = `
                                <div class="brandinizer-brand-info welcome-panel" style="box-shadow: 5px 5px 5px 5px #ddd; margin-top: 30px !important; background-color: #fff; margin-bottom: 30px !important; padding: 15px;">
                                    <center>
                                        <img src="<?php echo esc_url($brandinizer_logo_url); ?>" class="brand-logo" style="border-radius: <?php echo esc_attr($shape_style); ?>; background-color: #ddd; height: 170px; width: 170px; ">

                                        <br><br><span style="font-size: 30px; font-weigth: 500 !important; margin-top: 30px !important;"><?php echo  esc_attr($brandinizer_brand_name); ?></span>
                                        <br><span><?php echo  esc_attr($brandinizer_brand_tagline); ?></span>
                                    </center>

                                    <small style="color: #999; float: right;" class"brandinizer-watermark">Brandinizer</small>

                                </div>
                            </center>
                        `;

                jQuery(brandInfoHtml).insertBefore('.welcome-panel');

            });
        </script>
    <?php
    }
}

// For Login Page
if (strstr($_SERVER['REQUEST_URI'], 'wp-login.php')) {

    if (isset($brandinizer_status) && $brandinizer_status == 'yes') {


    ?>
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {

                var brandInfoHtml = `   
                            <h5 style="margin-top: -20px; margin-bottom: 5px;"><?php echo  esc_attr($brandinizer_brand_name); ?></h5>
                            <p style=" margin-top: -5px; margin-bottom: 25px; font-size: 13px; font-weight: 450;"><?php echo  esc_attr($brandinizer_brand_tagline); ?></p>`;

                jQuery('#login h1 a').css('background-image', 'none, url(<?php echo  esc_attr($brandinizer_logo_url); ?>)');
                jQuery('#login h1 a').css('background-color', 'white');
                jQuery('#login h1 a').css('border-radius', '<?php echo  esc_attr($shape_style); ?>');
                jQuery(brandInfoHtml).insertAfter("#login h1 a");
            });
        </script>
<?php
    }
}
