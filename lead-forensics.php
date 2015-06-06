<?php
	/*
	Plugin Name: Lead Forensics
	Plugin URI: http://wordpress.org/extend/plugins/leadforensics/
	Description: Easily implement your Lead Forensics tracking code in WordPress
	Version: 1.0
	Author: Douglas Karr
	Author URI: http://www.dknewmedia.com

	Copyright 2015 DK New Media  (email : info@dknewmedia.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	*/


	// add the admin options page
	add_action('admin_menu', 'plugin_admin_add_wplf_page');
	add_action('admin_init', 'wplf_register_settings' );
	add_action('wp_head', 'wplf_place_tracking_code');
	add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'wplf_plugin_action_links' );

	function wplf_plugin_action_links( $links ) {
   		$links[] = '<a href="'. esc_url( get_admin_url(null, 'options-general.php?page=wplf_plugin') ) .'">Settings</a>';
   		return $links;
	}

	function plugin_admin_add_wplf_page() {
		add_options_page('Lead Forensics Tracking Code', 'Lead Forensics', 'manage_options', 'wplf_plugin', 'wplf_plugin_options_page');
	}

	function wplf_plugin_options_page() {
		?>
		<h2>Lead Forensics</h2>
		<p><a href='https://www.marketingtechblog.com/b2b-identify-website-visitors/' target='_blank'>Lead Forensics</a> is a B2B tool used to identify the unidentified visitors that are arriving at your site.</p><p>This is a simple plugin to assist you in placing the <a href='https://portal.leadforensics.com/TrackingCode' target='blank'>Tracking Code</a> into your WordPress site or blog.</p>
		
		<form method="post" action="options.php">
    	<?php settings_fields( 'wplf-settings-group' ); ?>
    	<?php do_settings_sections( 'wplf-settings-group' ); ?>
    	<table class="form-table">
        	<tr valign="top">
        	<th scope="row">Tracking Code</th>
        	<td><textarea rows='3' columns='100' style='width:640px' name='wplf_code'><?php echo esc_textarea( get_option('wplf_code') ); ?></textarea></td>
        	</tr>
       </table>
    	
    	<?php submit_button(); ?>

		</form>
		<h3>About Lead Forensics</h3>
		<p><iframe width="640" height="360" src="https://www.youtube.com/embed/gP-Ol1AfBoQ?showinfo=0" frameborder="0" allowfullscreen></iframe></p>
		<p><small>This plugin was developed by <a href="http://www.dknewmedia.com" target="_blank">DK New Media</a> at no cost to <a href="https://www.marketingtechblog.com/b2b-identify-website-visitors/">Lead Forensics</a>, but we've included a landing page where we are compensated for referrals.</small></p>
		<?php
	}
	
	function wplf_register_settings() {
		register_setting( 'wplf-settings-group', 'wplf_code' );
	}
	
	function wplf_place_tracking_code() {
		echo get_option('wplf_code');
	}

?>
