<?php
/*
Plugin Name: Amazon AWS for Wordpress
Plugin URI: https://github.com/bradt/wp-tantan-s3
Description: Automatically copies media uploads to Amazon S3 for storage and delivery. Optionally configure Amazon CloudFront for even faster delivery. Add Google Authentication for increased site security.
Author: Cloudsafe365
Version: 0.5
Author URI: http://www.cloudsafe365.com

// Copyright (c) 2013 Cloudsafe365. All rights reserved.
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// **********************************************************************
//
// Forked Amazon S3 for WordPress with CloudFront (http://wordpress.org/extend/plugins/tantan-s3-cloudfront/)
// which is a fork of Amazon S3 for WordPress (http://wordpress.org/extend/plugins/tantan-s3/).
*/

class Cloudsafe365AwsForWordpress {

	private $option_name = 'aws_for_wp';

	static $instance; // to store a reference to the plugin, allows other plugins to remove actions

	/**
	 * Constructor, entry point of the plugin
	 */
	function __construct()
	{
		self::$instance = $this;

		register_activation_hook(__FILE__, array(&$this, 'activate'));

		if (is_admin()) {
			add_action('admin_init', array($this, 'init'));
			add_action('admin_menu', array($this, 'create_admin_menu'));
		}
	}

	/**
	 * Create our initial options
	 */
	function activate()
	{
		// Set our defaults if they don't already exist
		if (! get_option($this->option_name)) {
			update_option($this->option_name, array(
				'cloudmanager_signup'   => false,
				'cloudmanager_email'    => '',
				'save_ga_key'           => false,
			));
		}
	}

	/**
	 *
	 */
	function init()
	{
		wp_enqueue_script('jquery');

		wp_register_style('aws-for-wp-style', plugins_url('css/style.css', __FILE__));
		wp_enqueue_style('aws-for-wp-style');
	}

	/**
	 * Create sidebar menu.
	 *
	 *
	 */
	function create_admin_menu()
	{
		// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
		add_menu_page('AWS for WP','AWS for WP','manage_options', 'aws_for_wp', array($this, 'dashboard'), WP_PLUGIN_URL . '/aws-for-wp/images/cloudicon.png');

		// add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
		add_submenu_page('aws_for_wp', 'AWS for WP | Dashboard', 'Dashboard', 'manage_options', 'aws_for_wp', array($this, 'dashboard'));

		// Add Amazon S3 submenu
		global $TanTanWordPressS3Plugin;
		$TanTanWordPressS3Plugin->addSubmenu();

		// Add Google Authenticator submenu
		add_submenu_page(
			'aws_for_wp',
			'AWS for WP | Google Authenticator',
			'Google Authenticator',
			'manage_options',
			'aws_for_wp_google_authenticator',
			array($this, 'google_authenticator')
		);

		// Add Cloudmanager signup submenu
		add_submenu_page(
			'aws_for_wp',
			'AWS for WP | Cloudmanager',
			'Cloudmanager',
			'manage_options',
			'aws_for_wp_cloudmanager_signup',
			array($this, 'cloudmanager_signup')
		);
	}

	function cloudmanager_signup()
	{
		// In this case we know that we have a valid account
		if ($_POST) {
			update_option($this->option_name, array(
				'cloudmanager_signup'   => true,
				'cloudmanager_email'    => $_POST['email'],
				'save_ga_key'           => isset($_POST['save_ga_key']),
			));

			// Save the Google Authenticator key now if requested
			if (isset($_POST['save_ga_key'])) {
				$this->save_google_authenticator_key();
			}
		}

		require('screens/cloudmanager_signup.php');
	}

	function dashboard()
	{
		require('screens/dashboard.php');
	}

	// Redirect to the S3 settings page
	function amazon_s3()
	{
		$this->do_redirect(admin_url().'options-general.php?page=wordpress-for-amazon-aws/amazon-s3-and-cloudfront/wordpress-s3/class-plugin.php');
	}

	function google_authenticator()
	{
		require('screens/google_authenticator.php');
	}

	function do_redirect($url)
	{
		// The easiest way to redirect in Wordpress
		echo "<meta http-equiv='refresh' content='0;url=$url' />";
	}

	function save_google_authenticator_key()
	{
		// Load our current user
		get_currentuserinfo();
		global $current_user;

		// Get user's Google Authenticator secret key (if any)
		$ga_secret = trim(get_user_option('googleauthenticator_secret', $current_user->ID));

		// Save it to Cloudmanager if it exists
		if ($ga_secret) {
			wp_remote_post('https://aws.cloudsafe365.com/plugin/save_ga_key', array(
				'method' => 'POST',
				'timeout' => 45,
				'redirection' => 5,
				'httpversion' => '1.0',
				'blocking' => true,
				'headers' => array(),
				'body' => array(
					'url'       => get_bloginfo('siteurl'),
					'email'     => $current_user->user_email,
					'ga_key'    => $ga_secret,
				),
				'sslverify' => false,
				'cookies' => array()
			));
		}
	}

}

// Include our S3 plugin
require(__DIR__.'/amazon-s3-and-cloudfront/wordpress-s3.php');

//if (is_admin()) {
//	require_once(dirname(__FILE__).'/tantan-s3/class-plugin.php');
//	global $TanTanWordPressS3Plugin;
//	$TanTanWordPressS3Plugin = new TanTanWordPressS3Plugin();
//}
//else {
//	require_once(dirname(__FILE__).'/tantan-s3/class-plugin-public.php');
//	$TanTanWordPressS3Plugin = new TanTanWordPressS3PluginPublic();
//}

// Include our Google Authenticator plugin
require(__DIR__.'/google-authenticator/google-authenticator.php');

global $Cloudsafe365AwsForWordpress;
$Cloudsafe365AwsForWordpress = new Cloudsafe365AwsForWordpress;

