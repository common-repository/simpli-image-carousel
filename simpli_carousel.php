<?php
/*
plugin Name: Simpli Image Carousel
Plugin URI: www.webbuggs.com/simpliplugin
Description:  Use this plugin to show images in a carousel with different type of options. We are using OWL Carousel Library in order to show image in a slide show manner. 
Feel Free to contact for support and other customization . 
Author: Raza Imran Khan
Author URI: www.webbuggs.com
License:GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html
version:1.0.0
*/
/*
Simpli Image Carousel is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Simpli Image Carousel is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Simpli Image Carousel. If not, see  https://www.gnu.org/licenses/gpl-3.0.html.
*/

//Prevent to Direct Access
if (!defined("ABSPATH")):
    die("You Can't Access This File Directly ");
endif;

//Register Custom Post Type
add_action("init", "simpli_carousel");

function simpli_carousel()
{
    $supports = [
        "title", // post title
        "thumbnail", // featured images
    ];
    $labels = [
        "name" => _x("Simpli Carousel", "plural"),
        "singular_name" => _x("Simpli Carousel", "singular"),
        "menu_name" => _x("Simpli Carousel", "admin menu"),
        "name_admin_bar" => _x("Simpli Carousel", "admin bar"),
        "add_new" => _x("Add Simpli Images", "add new"),
        "add_new_item" => __("Add Simpli Images"),
        "new_item" => __("New Simpli Images"),
        "edit_item" => __("Edit Simpli Images"),
        "view_item" => __("View Simpli Images"),
        "all_items" => __("All Simpli Images"),
    ];
    $args = [
        "supports" => $supports,
        "labels" => $labels,
        "public" => true,
        "menu_position" => 5,
        "has_archive" => false,
        "rewrite" => ["slug" => "simpli_carousel"],
    ];

    register_post_type("simpli_carousel", $args);
}
//Register Custom taxonomy
function simpli_carousel_taxonomies()
{
    $labels = [
        "name" => _x(
            "Simpli Category",
            "taxonomies general name",
            "simpli-category"
        ),
    ];
    $args = [
        "labels" => $labels,
        "rewrite" => ["slug" => "simpli-category"],
        "hierarchical" => true,
        "public" => true,
        "show_ui" => true,
    ];
    register_taxonomy("simpli-category", "simpli_carousel", $args);
}

add_action("init", "simpli_carousel_taxonomies");

//Register Setting or Options Page
function sic_post_info_menu()
{
    add_menu_page(
    'Simpli Nav Settings',
    'Simpli Options',
    'manage_options',
    'simpli_nav_settings',
    'sic_show_settings'
    );
    
}

add_action("admin_menu", "sic_post_info_menu");

add_action("admin_menu", "sic_process_form");
function sic_process_form()
{
    register_setting("simpli_setting_group", "simpli_option_name");
    if(isset($_POST["arrows"])){
        if (isset($_POST["action"]) && current_user_can("manage_options")) {
            update_option("arrows", sanitize_text_field($_POST["arrows"]));
        }
    }
}

register_activation_hook(__FILE__, function () {
    add_option("arrows", "");
});
register_deactivation_hook(__FILE__, function () {
    delete_option("arrows");
});

function sic_show_settings()
{
    $setting = get_option("sic_arrows"); ?>
    <form method="post" action="options.php">
    
    <h1 style="text-align: center;margin-top: 40px !important;font-family: 'Montserrat', sans-serif;font-size: 30px;padding-bottom: 2%;border-bottom: 2px solid #000000;width: 50%;margin: auto;">SIMPLI CAROUSEL SETTINGS</h1>
    <h1 style="text-align: center;margin-top: 30px !important;font-family: 'Montserrat', sans-serif;font-size: 20px;padding-bottom: 2%;width: 100%;">Here You can Add and Remove Carousel Arrows and Add Animation, just Simply select drop down value.</h1>
    <h1 style="margin-left:50px;margin-top: 30px !important;font-family: 'Montserrat', sans-serif;font-size: 20px;padding-bottom: 1%;width: 100%;">Choose Your Carousel Settings.</h1>
    <?php settings_fields("simpli_setting_group"); ?>
    <?php $selected = get_option("arrows"); ?>
    <select id="arrows" name="arrows" style="margin-left:50px;">
      <option value="">Select Style</option>
      <option value="show_arrows" <?php selected(
            "show_arrows",
            $selected
        ); ?>>Show Arrows</option>
        <option value="hide_arrows" <?php selected(
            "hide_arrows",
            $selected
        ); ?>>Hide Arrows</option>
        <option value="anim_with_arrows" <?php selected(
            "anim_with_arrows",
            $selected
        ); ?>>Animation With Arrows</option>
        <option value="anim_without_arrows" <?php selected(
            "anim_without_arrows",
            $selected
        ); ?>>Animation WithOut Arrows</option>
</select>
<button  style="margin-left:50px;margin-top:5px;font-family: 'Montserrat', sans-serif;padding-bottom: 2%;width: 100%;border:none;"> 
    <?php submit_button("Save Change"); ?>
</button>
    <?php settings_errors(); ?>
    </form>
<p>
<h1 style="margin-left:50px;margin-top: 30px !important;font-family: 'Montserrat', sans-serif;font-size: 20px;width: 100%;">Steps to use Short Code: </h1>
<h1 style="margin-left:50px;font-family: 'Montserrat', sans-serif;font-size: 17px;padding-bottom: 1%;width: 100%;">There are 2 type of shortcodes that we can use. </h1>
<h1 style="margin-left:60px;font-family: 'Montserrat', sans-serif;font-size: 16px;width: 100%;">1) In order to show all the posts , here is the short code : </h1>
<input style="margin-left:70px;font-family: 'Montserrat', sans-serif;font-size: 14px;width: 20%;" type="text" value="[simpli_carousel_shortcode]" readonly />
<h1 style="margin-left:60px;font-family: 'Montserrat', sans-serif;font-size: 16px;width: 100%;">2) In order to show specific category images , here is the short code :</h1> 
<input style="margin-left:70px;font-family: 'Montserrat', sans-serif;font-size: 14px;width: 40%;" type="text" value='[simpli_carousel_shortcode simpli-category="Your Category Slug"]' readonly />



<?php
}

add_action("admin_init", "sic_metabox");
function sic_metabox()
{
    add_meta_box(
        "custom_metabox_01",
        "Show Title on Image",
        "sic_metabox_filde",
        "simpli_carousel",
        "normal",
        "low"
    );
}
function sic_metabox_filde()
{
    global $post;
    $sic_title_checkbox = get_post_meta($post->ID, "sic_title_checkbox", true);
    if ($sic_title_checkbox == "yes") {
        $sic_title_checkbox_val = 'checked="checked"';
    }

    echo '<input type="checkbox" name="sic_title_checkbox" value="yes" ' .
    $sic_title_checkbox_val .
        " />";
}
add_action("save_post", "sic_save_detail");

function sic_save_detail()
{
    global $post;

    if (@define("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
        return $post->ID;
    }
    update_post_meta($post->ID, "sic_title_checkbox", sanitize_text_field($_POST["sic_title_checkbox"]));
}
//ShortCode Function
function sic_carousel_shortcode($atts)
{
    $atts = shortcode_atts(
        [
            "post_type" => "simpli_carousel", //Show Images by Post Type
            "orderby" => "ID", // menu_order, title, date, rand, popularity, rating, or id.
            "order" => "DESC", // ASC or DESC.
            "post_status" => "publish", // base on publish
            "simpli-category" => "", //Images get by simpli-category
        ],
        $atts
    );
    $query = new WP_Query([
        "post_type" => $atts["post_type"],
        "orderby" => $atts["orderby"],
        "order" => $atts["order"],
        "post_status" => "publish",
        "simpli-category" => $atts["simpli-category"],
    ]);
    ob_start();
    include plugin_dir_path(__FILE__) . "views/header_sic.php";
    ?>
<div class="sp_carousel">
<div class="row owl-carousel owl-theme ">
<?php while ($query->have_posts()):

    $query->the_post();
    $simpli_carousel = get_post(get_the_ID());
    $title_checkbox = get_post_meta(get_the_ID(), "sic_title_checkbox", true);
    ?>

    <div class="sp_images">
            <figure><a href="<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a></figure>
            <?php if ($title_checkbox == true) { ?>
            <p class="sp_title"><a href="<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
        <?php } ?>
    </div>

        
<?php
endwhile; 
?>
</div>
</div>
<?php
include plugin_dir_path(__FILE__) . "views/footer_sic.php";
wp_reset_postdata();
return ob_get_clean();

}

//register the Shortcode handler
add_shortcode("simpli_carousel_shortcode", "sic_carousel_shortcode");
