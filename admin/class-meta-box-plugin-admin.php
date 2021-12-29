<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       cedcommerce.com
 * @since      1.0.0
 *
 * @package    Meta_Box_Plugin
 * @subpackage Meta_Box_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Meta_Box_Plugin
 * @subpackage Meta_Box_Plugin/admin
 * @author     Abhishek shukla <abhishekshukla2021dec@cedcoss.com>
 */
class Meta_Box_Plugin_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Meta_Box_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Meta_Box_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/meta-box-plugin-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Meta_Box_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Meta_Box_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		 wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/meta-box-plugin-admin.js', array( 'jquery' ), $this->version, false );
		 wp_localize_script( $this->plugin_name, 'frontendajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));

	}

	public function save_meta_box_text_data()
{
    $post_id = $_POST["post_id"];
    $meta_box_text_value = $_POST["text_name"]; 
    update_post_meta($post_id, "text_name", $meta_box_text_value);


}

}

// function for add meta box plugin text
function add_custom_meta_box_for_text()
{
    add_meta_box("demo-meta-box", "Text", "custom_meta_box_for_text", "post", "side", "high", null);
}

// hook for add meta box 
add_action("add_meta_boxes", "add_custom_meta_box_for_text");

// function for add meta box plugin text form
function custom_meta_box_for_text($object)
{
    wp_nonce_field("meta-box-submit", "meta-box-nonce");
?>             
            <label for="meta-box-text-for-post">Text</label>
			<input name="post_id" type="hidden" id="id_ajax" value="<?php echo get_the_ID(); ?>">
            <input name="meta-box-text-for-post" type="text" id="text_ajax" value="<?php //echo get_post_meta($object->ID, "meta-box-text", true); ?>">
			<br><br>
			<input type="button" class="button button-primary" value="Text"  id="submit_ajax" name="text_ajax" /> 
<?php 
}





