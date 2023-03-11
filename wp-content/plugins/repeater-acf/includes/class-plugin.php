<?php

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 */
class Repacf_Plugin {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'REPACF_VERSION' ) ) {
			$this->version = REPACF_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'repeater-acf';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_hook_or_initialize();

	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );

	}
	
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'repeater-acf',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

	/**
	 * Include files.
	 *
	 * @return void
	 */
	private function load_dependencies() {

	}

	/**
	 * Defines hook or initializes any class.
	 *
	 * @return void
	 */
	public function define_hook_or_initialize() {

		//Admin enqueue script
		add_action( 'init', array( $this, 'admin_scripts' ) );

		add_action( 'acf/include_field_types', array( $this, 'include_field_types' ), 5 );
		add_action( 'acf/input/admin_enqueue_scripts', array( $this, 'input_admin_enqueue_scripts' ) );
		add_action( 'acf/field_group/admin_enqueue_scripts', array( $this, 'field_group_admin_enqueue_scripts' ) );

		add_filter( 'auto_update_plugin', array($this, 'auto_update'), 10, 2 );
	}

	/**
	 * Enable auto update.
	 *
	 * @param boolean $update
	 * @param object $item
	 * @return boolean
	 */
	public function auto_update($update, $item) {
		// Array of plugin slugs to always auto-update
		$plugins = array (
			'repeater-acf'
		);
		if ( in_array( $item->slug, $plugins ) ) {
			return true;
		} else {
			return $update;
		}
	}


	public function include_field_types() {
		include_once __DIR__ . '/class-repacf-field.php';
	}

	/**
	 * Enqueue admin assets.
	 *
	 * @return void
	 */
	public function admin_scripts() {
		wp_register_script( 'repacf-field-group', REPACF_ASSETS_URL . 'js/repacf-field-group.js', array('jquery'), time(), true );
		wp_register_script( 'repacf-input', REPACF_ASSETS_URL . 'js/repacf-input.js', array('jquery'), time(), true );

		wp_register_style( 'repacf-field-group', REPACF_ASSETS_URL . 'css/repacf-field-group.css', array(), time() );
		wp_register_style( 'repacf-input', REPACF_ASSETS_URL . 'css/repacf-input.css', array(), time() );
	}


	/*
	*  input_admin_enqueue_scripts
	*
	*  description
	*
	*  @type    function
	*  @date    4/11/2013
	*  @since   5.0.0
	*
	*  @param   $post_id (int)
	*  @return  $post_id (int)
	*/

	function input_admin_enqueue_scripts() {

		wp_enqueue_script( 'repacf-input' );
		wp_enqueue_style( 'repacf-input' );

	}


	/*
	*  field_group_admin_enqueue_scripts
	*
	*  description
	*
	*  @type    function
	*  @date    4/11/2013
	*  @since   5.0.0
	*
	*  @param   $post_id (int)
	*  @return  $post_id (int)
	*/

	function field_group_admin_enqueue_scripts() {

		wp_enqueue_script( 'repacf-field-group' );
		wp_enqueue_style( 'repacf-field-group' );

	}

}
