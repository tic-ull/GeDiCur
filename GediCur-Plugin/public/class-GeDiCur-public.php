<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    GeDiCur
 * @subpackage GeDiCur/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    GeDiCur
 * @subpackage GeDiCur/public
 * @author     Your Name <email@example.com>
 */
class GeDiCur_Public {

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
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/plugin-name-public.css', array(), $this->version, 'all' );

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
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/plugin-name-public.js', array( 'jquery' ), $this->version, false );

	}

	private function html_form_code() {
		  echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
		  echo '<p>';
		  echo 'Nombre<br />';
		  echo '<input type="text" name="cf-name" value="' . ( isset( $_POST["cf-name"] ) ? esc_attr( $_POST["cf-name"] ) : '' ) . '" size="40" />';
		  echo '</p>';
		  echo '<p>';
		  echo 'Email<br />';
		  echo '<input type="email" name="cf-email" value="' . ( isset( $_POST["cf-email"] ) ? esc_attr( $_POST["cf-email"] ) : '' ) . '" size="40" />';
		  echo '</p>';
		  echo '<p>';
		  echo 'DNI<br />';
		  echo '<input type="text" name="cf-dni" pattern="[0-9]{8}[a-zA-Z ]?" value="' . ( isset( $_POST["cf-dni"] ) ? esc_attr( $_POST["cf-dni"] ) : '' ) . '" size="40" />';
		  echo '</p>';
		  echo 'Nombre curso<br />';
		  echo '<input type="text" name="cf-subject" pattern="[a-zA-Z ]+" value="' . ( isset( $_POST["cf-subject"] ) ? esc_attr( $_POST["cf-subject"] ) : '' ) . '" size="40" />';
		  echo '</p>';
		  echo '<p>';
		  echo 'Your Message (required) <br />';
		  echo '<textarea rows="10" cols="35" name="cf-message">' . ( isset( $_POST["cf-message"] ) ? esc_attr( $_POST["cf-message"] ) : '' ) . '</textarea>';
		  echo '</p>';
		  echo '<p><input type="submit" name="cf-submitted" value="Send"/></p>';
		  echo '</form>';
	}

	private function manage_input() {
	 
		if ( isset( $_POST['cf-submitted'] ) ) {
			// sanitize form values
			$name    = sanitize_text_field( $_POST["cf-name"] );
			$email   = sanitize_email( $_POST["cf-email"] );
			$dni	 = sanitize_text_field( $_POST["cf-dni"] );
			$subject = sanitize_text_field( $_POST["cf-subject"] );
			$message = esc_textarea( $_POST["cf-message"] );


			// Check DNI
			if (strlen ($dni) == 9)
				$dni = substr($dni, 0, 8);

			$headers = "From: $name <$email>" . "\r\n";

			$mydb = new wpdb('root','','TestCursos2','localhost');
			if (!$mydb->query("INSERT INTO profesor (DNI, Name, Surname) 
												 Values(".$dni.", '".$name."', 'asdasd')")) {
				// Check if value is repeated
				$rows = $mydb->get_results("SELECT DNI FROM profesor WHERE DNI=".$dni);
				if (!empty($rows))
					echo "Error, Database already has an entry for DNI=".$dni;
				else
					echo "Unknown error";
			} else {
				esc_html__ ("Info has been sent", "osl-text-domain");

				$to = $name;
				$subject = "La cuestión";
				$message = "Esto es un mensaje";
				$headers = "AA";
				$attachments = "BB";

				wp_mail( $to, $subject, $message, $headers, $attachments );
			}
		}
	}

	public function generate_cursos_list () {
		function cf_shortcode_list() {
		  require_once plugin_dir_path(__FILE__). 'partials/Gedicur-list.php';
		}
		add_shortcode( 'GeDiCur_cursos_list', 'cf_shortcode_list' );
	}

	public function generate_cursos_form () {
		function cf_shortcode_form() {
		  require_once plugin_dir_path(__FILE__). 'partials/Gedicur-mainform.php';
		}		
		add_shortcode( 'GeDiCur_cursos_form', 'cf_shortcode_form' );
	}

}
