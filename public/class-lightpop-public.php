<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       betadevs.netlify.com
 * @since      1.0.0
 *
 * @package    Lightpop
 * @subpackage Lightpop/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Lightpop
 * @subpackage Lightpop/public
 * @author     Professor <nice.arslan@outlook.com>
 */
class Lightpop_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Lightpop_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Lightpop_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/lightpop-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Lightpop_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Lightpop_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/lightpop-public.js', array( 'jquery' ), $this->version, false );

	}
	
	

	function popup(){

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php');

		register_setting( 'text_Section' , 'option_name'  );
		register_setting( 'style_Section' , 'option_name'  );
		register_setting( 'plugin_settings' , 'option_name'  );
		register_setting( 'Location' , 'option_name'  );
		register_setting( 'body' , 'option_name'  );
		
		//all options 
		$Header = get_option( 'header_Text');
			$body = get_option( 'pop_Text');
			$bgcolor = get_option( 'bgColor');
			$roles = get_option( 'Roles' );
			$location = get_option( 'Location' );
			$count = get_option( 'count' );
	

		//finding th current user logged in
				global $current_user;
			    get_currentuserinfo();
				$user_info = get_userdata($current_user->ID);

				//global post will give us the page id and title using $post->
				global $post;
				// echo $post->post_title;
				
				
// echo "<pre>";
// print_r($post->post_title);
// echo "</pre>";

//if role from options_panel is equal to current user and current page is also which we wanted
	if (in_array($roles, $user_info->roles) && $location == $post->post_title && $count > 0) {
//Modal Box
    $count = $count - 1;
?>
<div id="modal" >
    <div class="modalconent" style="background-color: <?php echo $bgcolor;?>">
        <h3><?php echo $Header; ?></h3>

        <p><?php echo $body; ?></p>
       <div class="modal-footer"> <button id="button">Close</button></div>
    </div>
</div>

<?php
update_option( 'count' , sanitize_text_field($count) );
			}
	//so this is not changed git		
	?>
	<?php  
	
	
}
}



