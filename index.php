<?php
/**
 * Plugin Name: MainWP Multiple Email Notifications
 * Plugin URI: http://blog.incognitech.in
 * Description: Multiple Email support for MainWP Notifications
 * Version: 0.0.1
 * Author: Udit Desai
 * Author URI: http://blog.incognitech.in
 * License: GPL
 * Text Domain: mwp-men
 */

/**
 * Don't load this file directly!
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'MWP_MEN_VERSION' ) ) {
	define( 'MWP_MEN_VERSION', '0.0.1' );
}
if ( ! defined( 'MWP_MEN_TEXT_DOMAIN' ) ) {
	define( 'MWP_MEN_TEXT_DOMAIN', 'mwp-men' );
}

function mwp_me_add_multiple_email_field( $website ) { ?>
	<tr>
		<th scope="row">
			<?php _e( 'Notification Emails after Offline Checks', MWP_MEN_TEXT_DOMAIN ); ?>
			<?php MainWPUtility::renderToolTip( 'Add one email on one line.' ); ?>
		</th>
		<td>
			<?php
			$emails = MainWPDB::Instance()->getWebsiteOption( $website, 'mwp_me_emails' );
			if ( empty( $emails ) ) {
				$emails = '';
			}
			?>
			<textarea style="height: 140px; width: 100%;" name="mwp-me-emails" id="mwp-me-emails"><?php echo $emails; ?></textarea>
		</td>
	</tr>
<?php }
add_action( 'mainwp_extension_sites_edit_tablerow', 'mwp_me_add_multiple_email_field' );

function mwp_me_update_site( $website_id ) {
	$website = MainWPDB::Instance()->getWebsiteById( $website_id );
	if ( ! empty( $_POST['mwp-me-emails'] ) ) {
		MainWPDB::Instance()->updateWebsiteOption( $website, 'mwp_me_emails', trim( $_POST['mwp-me-emails'] ) );
	} else {
		MainWPDB::Instance()->updateWebsiteOption( $website, 'mwp_me_emails', '' );
	}
}
add_action( 'mainwp_update_site', 'mwp_me_update_site' );