<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       betadevs.netlify.com
 * @since      1.0.0
 *
 * @package    Lightpop
 * @subpackage Lightpop/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Lightpop
 * @subpackage Lightpop/admin
 * @author     Professor <nice.arslan@outlook.com>
 */
class Lightpop_Admin {

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

	private $settings_api;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	// $this->settings_api = new $plugin_name;
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
		 * defined in Lightpop_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Lightpop_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/lightpop-admin.css', array(), $this->version, 'all' );

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
		 * defined in Lightpop_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Lightpop_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/lightpop-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function admin_Nav(){

		add_menu_page( 
			'Light Popups' , //text in browser title bar when the page item is display
			'Lights PopUps' , //Text to be displayed in menu bar
			'manage_options' , //Compatibiltiy of users
			'Lights' , // A unique identifier to identify this menu item from menu
			array($this, 'Lights_function') , //callback function 
			//Menu Icon URL
			//Positiojn in int in the menu
			
		);

			// to add in Dashboard Menu  
			// add_menu_page( 
			// 	'Theme Option',
			// 	'Themes Option',
			// 	'manage_options',
			// 	'Lights',
			// 	array($this, 'call_back')
			//  );


	}
	public function Lights_function(){

		
		
		add_settings_section( 'text_Section', 'Light Popup Settings' , 'callback' , 'Text' );
		add_settings_field( 'Header', 'Header Text ', 'header_Text', 'Text', 'text_Section' );
		add_settings_field( 'Popup_text', 'Body ', 'body_Text', 'Text', 'text_Section' );
	
		//2nd section
		add_settings_section( 'style_Section', 'Popup Styling' , '' , 'Style' );
		add_settings_field( 'bgColor', 'Popup Background Color ', 'bgColor', 'Style', 'style_Section' );

			//3rd section
			add_settings_section( 'plugin_settings', 'plugin_settings' , '' , 'plugin_settings' );
			add_settings_field( 'Roles', 'Roles ', 'settings', 'plugin_settings', 'plugin_settings' );
			
			add_settings_section( 'Count', 'Count' , 'Count' , 'Count' );
			add_settings_field( 'Count', 'COuntDown ', 'Countdown', 'Count', 'Count' );
		
			
			add_settings_section( 'Location', 'Location' , '' , 'Location' );
			add_settings_field( 'location', 'Show on this Page ', 'Pages', 'Location', 'Location' ); //Where to be Shown Page
			add_settings_field( 'Post', 'Show on this post ', '', 'Post', 'Post', 'Location' ); //Where to be Shown Page
	
		
		function header_Text(){
		?>
			<input type="text" name="header_Text" value="<?php echo get_option( 'header_Text', 'Blue' )?>">
		
		<?php
		}

	
		
		function body_Text(){
		
			$body_option = get_option( 'pop_Text' );
			wp_editor( $body_option , 'pop_Text', array(
				'wpautop'       => true,
				'media_buttons' => false,
				'textarea_name' => 'pop_Text',
				'editor_class'  => 'my_custom_class',
				'textarea_rows' => 10
			) );
			
		?>
	
	
	
			<?php
			 
			}
		
			function bgColor(){
				?>
				<input type="color"  name="bgColor" value="<?php echo get_option( 'bgColor', 'Blue' )?>">				
				
				<?php
					 
					}
			function callback(){

	
			}

			function settings(){
				require_once( ABSPATH . 'wp-includes/capabilities.php');
				
				
				?>

				<select name="role" id="cars">
	<?php		global $wp_roles;
				$roles = $wp_roles->roles; 
				
				// print it to the screen
				// echo '<pre>' . print_r( $roles, true ) . '</pre>';
				echo '<option value="">';

				if(get_option("Roles") == ""){ echo esc_attr( __( "Select Role" ) );}
				else{
				echo get_option("Roles");
				}
				?>
				</option>';
				<?php foreach ($roles as $role=>$key){
					?>
					 <option value="<?php echo $role?>"><?php echo $role; ?></option>

<?php
				}						
			?>
			  </select>
<?php
			}

function Countdown(){
?>
<input type="text" name="count" value="<?php echo get_option( 'count' )?>">

<?php
}
	

			function Pages(){?>

<select name="location" id="location">

<?php 
$pages = get_pages();
?> <option value="">

<?php if(get_option('location') == ''){ echo esc_attr( __( 'Select page' ) );}
else{
echo get_option('location');
}
 ?></option> 
 <?php 
  $pages = get_pages(); 
  foreach ( $pages as $page ) {
    $option = '<option value="' . $page->post_title . '">';
    $option .= $page->post_title;
    $option .= '</option>';
    echo $option;
  }
 ?>
</select>
			
			<?php 
			}



			function Post(){?>

<select name="Post" id="Post">
<?php while(have_posts(  )){?>
<option value=""></option>
<?php }?>
</select>

			<?php 
			}
		

		?>
		<form action="options.php" method="post">
		<?php
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php');
		
		settings_fields('text_Section');
		do_settings_sections('Text');

		//2nd section
		settings_fields('style_Section');
		do_settings_sections('Style');
echo "<br><br>";
		settings_fields('plugin_settings');
		do_settings_sections('plugin_settings');
		echo "<br>";
		settings_fields('Count');
		do_settings_sections('Count');
		
		echo "<br><br>";
		settings_fields('Location');
		do_settings_sections('Location');
		do_settings_sections('Post');
		submit_button( );
		
		?>
		</form>
		
<?php


}

function process_form(){

	
	if( isset($_POST['action']) && current_user_can( 'manage_options' ) ){
	
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php');

		register_setting( 'text_Section' , 'option_name'  );
		register_setting( 'style_Section' , 'option_name'  );
		register_setting( 'plugin_settings' , 'option_name'  );
		register_setting( 'Location' , 'option_name'  );
		register_setting( 'body' , 'option_name'  );
		register_setting( 'count' , 'option_name'  );

		update_option( 'header_Text' , sanitize_text_field($_POST['header_Text']) );
		update_option( 'pop_Text' , sanitize_text_field($_POST['pop_Text']) );
		update_option( 'bgColor' , sanitize_text_field($_POST['bgColor']) );
		update_option( 'Roles' , sanitize_text_field($_POST['role']) );
		update_option( 'Location' , sanitize_text_field($_POST['location']) );
		update_option( 'count' , sanitize_text_field($_POST['count']) );
	}

}


}
