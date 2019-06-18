<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    GeDiCur
 * @subpackage GeDiCur/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    GeDiCur
 * @subpackage GeDiCur/includes
 * @author     Your Name <email@example.com>
 */
class GeDiCur_Activator {

	public static function create_table_cursos () {
		global $wpdb;
		$table_name = $wpdb->prefix . 'cursos';
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
			ID mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
			status mediumint(3) unsigned NOT NULL DEFAULT 0,
			name varchar(100) NOT NULL,
			description varchar(1000) NOT NULL,
			init_date date,
			end_date date,
			previous_edition mediumint(3) unsigned,
			memory BLOB,
			budget BLOB,
			bill BLOB,				
			PRIMARY KEY (ID),
			FOREIGN KEY (previous_edition) REFERENCES $table_name (ID)
		) $charset_collate;";
		
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

	public static function create_table_cursos_temp_data () {
		global $wpdb;
		$table_name = $wpdb->prefix . 'cursos_temp_data';
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
			ID mediumint(3) unsigned NOT NULL,
			Metadata varchar(1000) NOT NULL,
			FOREIGN KEY(ID) REFERENCES ".$wpdb->prefix."cursos(ID)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

	private static function create_table_profesor () {
		global $wpdb;
		$table_name = $wpdb->prefix . 'profesor';
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
			DNI mediumint(3) unsigned NOT NULL,
			name varchar(100) NOT NULL,
			surname varchar(100) NOT NULL,
			email varchar(100) NOT NULL,
			pdi tinyint(1) DEFAULT 0,
			PRIMARY KEY (DNI)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

	private static function create_table_profesor_curso () {
		global $wpdb;
		$table_name = $wpdb->prefix . 'profesor_curso';
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
			ID mediumint(3) unsigned NOT NULL,
			DNI mediumint(3) unsigned NOT NULL,
			FOREIGN KEY(ID) REFERENCES ".$wpdb->prefix ."cursos(ID),
			FOREIGN KEY(DNI) REFERENCES ".$wpdb->prefix ."profesor(DNI)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

	private static function jal_install_data() {
		global $wpdb;
		
		$welcome_name = 'Mr. WordPress';
		$welcome_text = 'Congratulations, you just completed the installation!';
		
		$table_name = $wpdb->prefix . 'liveshoutbox';
		
		$wpdb->insert(
			$table_name, 
			array( 
				'time' => current_time( 'mysql' ), 
				'name' => $welcome_name, 
				'text' => $welcome_text, 
			) 
		);
	}

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'profesor_curso';
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "SHOW TABLES LIKE $table_name $charset_collate;";	
		$results = $wpdb->get_results("SHOW TABLES LIKE '".$wpdb->prefix."cursos'");

		if (count($results) == 0) {
			GeDiCur_Activator::create_table_cursos();
			GeDiCur_Activator::create_table_cursos_temp_data();
			GeDiCur_Activator::create_table_profesor();
			GeDiCur_Activator::create_table_profesor_curso();
		}
	}

}
