<?php
/**
 * @package Portfolio
 * @version 1
 */
/*
Plugin Name: Captcha
Plugin URI:  http://bestwebsoft.com/plugin/
Description: Plugin Captcha intended to prove that the visitor is a human being and not a spam robot. Plugin asks the visitor to answer a math question.
Author: BestWebSoft
Version: 1.02
Author URI: http://bestwebsoft.com/
License: GPLv2 or later
*/

/*  © Copyright 2011  BestWebSoft  ( admin@bestwebsoft.com )

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


// These fields for the 'Enable CAPTCHA on the' block which is located at the admin setting captcha page
$cptch_admin_fields_enable = array (
		array( 'cptch_login_form', 'Login form', 'Login form' ),
		array( 'cptch_register_form', 'Register form', 'Register form' ),
		array( 'cptch_lost_password_form', 'Lost password form', 'Lost password form' ),
		array( 'cptch_comments_form', 'Comments form', 'Comments form' ),
		array( 'cptch_hide_register', 'Hide CAPTCHA for registered users', 'Hide CAPTCHA for registered users' ),		
);

// These fields for the 'Arithmetic actions for CAPTCHA' block which is located at the admin setting captcha page
$cptch_admin_fields_actions = array (
		array( 'cptch_math_action_plus', 'Plus (+)', 'Plus' ),
		array( 'cptch_math_action_minus', 'Minus (-)', 'Minus' ),
		array( 'cptch_math_action_increase', 'Multiply (*)', 'Increase' ),
);

// This fields for the 'Difficulty for CAPTCHA' block which is located at the admin setting captcha page
$cptch_admin_fields_difficulty = array (
		array( 'cptch_difficulty_number', 'Numbers', 'Numbers' ),
		array( 'cptch_difficulty_word', 'Words', 'Words' ),
);

add_action( 'admin_menu', 'add_cptch_admin_menu' );

function add_cptch_admin_menu() {
	add_options_page( "Captcha Options", "Captcha", 'manage_options',  __FILE__, 'cptch_settings_page' );

	//call register settings function
	add_action( 'admin_init', 'register_cptch_settings' );
}

// register settings function
function register_cptch_settings() {
	global $wpmu;
	global $cptch_options;

	$cptch_option_defaults = array(
		'cptch_login_form' => '1',
		'cptch_register_form' => '1',
		'cptch_lost_password_form' => '1',
		'cptch_comments_form' => '1',
		'cptch_hide_register' => '1',
		'cptch_math_action_plus' => '1',
		'cptch_math_action_minus'  => '1',
		'cptch_math_action_increase' => '1',
		'cptch_label_form' => '',
		'cptch_difficulty_number' => '1',
		'cptch_difficulty_word' => '1',
  );

  // install the option defaults
	if ( 1 == $wpmu ) {
		if( !get_site_option( 'cptch_options' ) ) {
			add_site_option( 'cptch_options', $cptch_option_defaults, '', 'yes' );
		}
	} 
	else {
		if( !get_option( 'cptch_options' ) )
			add_option( 'cptch_options', $cptch_option_defaults, '', 'yes' );
	}

  // get options from the database
  if ( 1 == $wpmu )
   $cptch_options = get_site_option( 'cptch_options' ); // get options from the database
  else
   $cptch_options = get_option( 'cptch_options' );// get options from the database

  // array merge incase this version has added new options
  $cptch_options = array_merge( $cptch_option_defaults, $cptch_options );
}

// Add global setting for Captcha
global $wpmu;

if ( 1 == $wpmu )
   $cptch_options = get_site_option( 'cptch_options' ); // get the options from the database
  else
   $cptch_options = get_option( 'cptch_options' );// get the options from the database

// Add captcha into login form
if( 1 == $cptch_options['cptch_login_form'] ) {
	add_action( 'login_form', 'cptch_login_form' );
	add_filter( 'login_errors', 'cptch_login_post' );
	add_filter( 'login_redirect', 'cptch_login_check', 10, 3 ); 
}
// Add captcha into comments form
if( 1 == $cptch_options['cptch_comments_form'] ) {
	global $wp_version;
	if( version_compare($wp_version,'3','>=') ) { // wp 3.0 +
		add_action( 'comment_form_after_fields', 'cptch_comment_form');
		add_action( 'comment_form_logged_in_after', 'cptch_comment_form');
		add_filter( 'preprocess_comment', 'cptch_comment_post' );
	} else {
	// for WP before WP 3.0
	add_action( 'comment_form', 'cptch_comment_form' );
	add_filter( 'preprocess_comment', 'cptch_comment_post' );	
	}
}
// Add captcha in the register form
if( 1 == $cptch_options['cptch_register_form'] ) {
	add_action( 'register_form', 'cptch_register_form' );
	add_action( 'register_post', 'cptch_register_post', 10, 3 );
}
// Add captcha into lost password form
if( 1 == $cptch_options['cptch_lost_password_form'] ) {
	add_action( 'lostpassword_form', 'cptch_register_form' );
	add_action( 'lostpassword_post', 'cptch_lostpassword_post', 10, 3 );
}

// adds "Settings" link to the plugin action page
add_filter( 'plugin_action_links', 'cptch_plugin_action_links',10,2);

//Additional links on the plugin page
add_filter('plugin_row_meta', 'cptch_register_plugin_links',10,2);

function cptch_plugin_action_links( $links, $file ) {
		//Static so we don't call plugin_basename on every plugin row.
	static $this_plugin;
	if ( ! $this_plugin ) $this_plugin = plugin_basename(__FILE__);

	if ( $file == $this_plugin ){
			 $settings_link = '<a href="options-general.php?page=captcha/captcha.php">' . __('Settings', 'captcha') . '</a>';
			 array_unshift( $links, $settings_link );
		}
	return $links;
} // end function cptch_plugin_action_links

function cptch_register_plugin_links($links, $file) {
	$base = plugin_basename(__FILE__);
	if ($file == $base) {
		$links[] = '<a href="options-general.php?page=captcha/captcha.php">' . __('Settings','captcha') . '</a>';
		$links[] = '<a href="http://wordpress.org/extend/plugins/captcha/faq/" target="_blank">' . __('FAQ','captcha') . '</a>';
		$links[] = '<a href="Mailto:plugin@bestwebsoft.com">' . __('Support','captcha') . '</a>';
	}
	return $links;
}

// Function for display captcha settings page in the admin area
function cptch_settings_page() {
	global $cptch_admin_fields_enable;
	global $cptch_admin_fields_actions;
	global $cptch_admin_fields_difficulty;
	global $cptch_options;

	$error = "";
	
	// Save data for settings page
	if( isset( $_REQUEST['cptch_form_submit'] ) ) {
		$cptch_request_options = array();

		foreach( $cptch_options as $key => $val ) {
			if( isset( $_REQUEST[$key] ) ) {
				if( $key != 'cptch_label_form' )
					$cptch_request_options[$key] = 1;
				else
					$cptch_request_options[$key] = $_REQUEST[$key];
			} else {
				if( $key != 'cptch_label_form' )
					$cptch_request_options[$key] = 0;
				else
					$cptch_request_options[$key] = "";
			}
		}

		// array merge incase this version has added new options
		$cptch_options = array_merge( $cptch_options, $cptch_request_options );

		// Check select one point in the blocks Arithmetic actions and Difficulty on settings page
		if( ( ! isset ( $_REQUEST['cptch_difficulty_number'] ) && ! isset ( $_REQUEST['cptch_difficulty_word'] ) ) || 	
			( ! isset ( $_REQUEST['cptch_math_action_plus'] ) && ! isset ( $_REQUEST['cptch_math_action_minus'] ) && ! isset ( $_REQUEST['cptch_math_action_increase'] ) ) ) {
			$error = "Please select one point in the blocks Arithmetic actions and Difficulty for CAPTCHA";
		} else {
			// Update options in the database
			update_option( 'cptch_options', $cptch_request_options, '', 'yes' );
			$message = "Options saved.";
		}
	}

	// Display form on the setting page
?>
<div class="wrap">
	<div class="icon32" id="icon-options-general"><br></div>
	<h2>Captcha Options</h2>
	<div class="updated fade" <?php if( ! isset( $_REQUEST['cptch_form_submit'] ) || $error != "" ) echo "style=\"display:none\""; ?>><p><strong><?php echo $message; ?></strong></p></div>
	<div class="error" <?php if( "" == $error ) echo "style=\"display:none\""; ?>><p><strong><?php echo $error; ?></strong></p></div>
	<form method="post" action="options-general.php?page=captcha/captcha.php">
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Enable CAPTCHA on the: </th>
				<td>
			<?php foreach( $cptch_admin_fields_enable as $fields ) { ?>
					<input type="checkbox" name="<?php echo $fields[0]; ?>" value="<?php echo $cptch_options[ $fields[0] ]; ?>" <?php if( 1 == $cptch_options[$fields[0]] ) echo "checked=\"checked\""; ?> /><label for="<?php echo $fields[0]; ?>"><?php echo $fields[1]; ?></label><br />
			<?php } ?>
					<span style="color: #888888;font-size: 10px;">If you would like to customize this plugin for a custom form, please contact us via <a href="Mailto:plugin@bestwebsoft.com">plugin@bestwebsoft.com</a> or fill in our contact form on our site <a href="http://bestwebsoft.com/contact/" target="_blank">http://bestwebsoft.com/contact/</a></span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Label for CAPTCHA in form</th>
				<td><input type="text" name="cptch_label_form" value="<?php echo $cptch_options['cptch_label_form']; ?>" <?php if( 1 == $cptch_options['cptch_label_form'] ) echo "checked=\"checked\""; ?> /></td>
			</tr>
			<tr valign="top">
				<th scope="row">Arithmetic actions for CAPTCHA</th>
				<td>
			<?php foreach($cptch_admin_fields_actions as $actions) { ?>
					<div style="float:left; width:100px;"><input type="checkbox" name="<?php echo $actions[0]; ?>" value="<?php echo $cptch_options[$actions[0]]; ?>" <?php if( 1 == $cptch_options[$actions[0]] ) echo "checked=\"checked\""; ?> /><label for="<?php echo $actions[0]; ?>"><?php echo $actions[1]; ?></label></div><img src="<?php echo plugins_url( 'images/'.$actions[0].'.jpg' , __FILE__ );?>" alt="" title="" width="" height="" /><br />
			<?php } ?>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Difficulty for CAPTCHA</th>
				<td>
			<?php foreach($cptch_admin_fields_difficulty as $diff) { ?>
					<div style="float:left; width:100px;"><input type="checkbox" name="<?php echo $diff[0]; ?>" value="<?php echo $cptch_options[$diff[0]]; ?>" <?php if( 1 == $cptch_options[$diff[0]] ) echo "checked=\"checked\""; ?> /><label for="<?php echo $diff[0]; ?>"><?php echo $diff[1]; ?></label></div><img src="<?php echo plugins_url( 'images/'.$diff[0].'.jpg' , __FILE__ );?>" alt="" title="" width="" height="" /><br />
			<?php } ?>
				</td>
			</tr>
		</table>    
		<input type="hidden" name="cptch_form_submit" value="submit" />
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
	</form>
</div>
<?php } 

// this function adds captcha to the login form
function cptch_login_form() {
	session_start();
	global $cptch_options;
	
	// captcha html - login form
	echo '<p>';
	if( "" != $cptch_options['cptch_label_form'] )	
		echo '<label>'. $cptch_options['cptch_label_form'] .'</label><br />';
	if( isset( $_SESSION['cptch_error'] ) )
	{
		echo "<br /><span style='color:red'>". $_SESSION['cptch_error'] ."</span><br />";
		unset( $_SESSION['cptch_error'] );
	}
	echo '<br />';
	cptch_display_captcha();
	echo '</p>
	<br />';

	return true;

} //  end function cptch_login_form

// this function checks captcha posted with a login
function cptch_login_post($errors) {
	global $str_key;
	$str_key = "123";

	// Delete errors, if they set
	if( isset( $_SESSION['cptch_error'] ) )
		unset( $_SESSION['cptch_error'] );

	if( $_REQUEST['action'] == 'register' )
		return($errors);

	// If captcha not complete, return error
	if ( "" ==  $_POST['cptch_number'] ) {	
		return $errors.'<strong>'. __('ERROR', 'cptch') .'</strong>: '. __('Please complete the CAPTCHA.', 'cptch');
	}

	if ( 0 == strcasecmp( trim( decode( $_POST['cptch_result'], $str_key ) ), $_POST['cptch_number'] ) ) {
		// captcha was matched						
	} else {
		return $errors.'<strong>'. __('ERROR', 'cptch') .'</strong>: '. __('That CAPTCHA was incorrect.', 'cptch');
	}
  return($errors);
} // end function cptch_login_post

// this function checks the captcha posted with a login when login errors are absent
function cptch_login_check($url) {
	global $str_key;
	session_start();

	$str_key = "123";
	// Add error if captcha is empty
	if ( isset( $_POST['cptch_number'] ) && "" ==  $_POST['cptch_number'] ) {
		$_SESSION['cptch_error'] = __('Please complete the CAPTCHA.', 'cptch');
		// Redirect to wp-login.php
		return $_SERVER["REQUEST_URI"];
	}

	if ( 0 == strcasecmp( trim( decode( $_POST['cptch_result'], $str_key ) ), $_POST['cptch_number'] ) ) {
		return $url;		// captcha was matched						
	} else {
		// Add error if captcha is incorrect
		$_SESSION['cptch_error'] = __('That CAPTCHA was incorrect.', 'cptch');
		// Redirect to wp-login.php
		return $_SERVER["REQUEST_URI"];
	}
} // end function cptch_login_post

// this function adds captcha to the comment form
function cptch_comment_form() {
	global $cptch_options;

	// skip captcha if user is logged in and the settings allow
	if ( is_user_logged_in() && 1 == $cptch_options['cptch_hide_register'] ) {
		return true;
	}

	// captcha html - comment form
	echo '<p>';
	if( "" != $cptch_options['cptch_label_form'] )	
		echo '<label>'. $cptch_options['cptch_label_form'] .'</label>';
	echo '<br />';
	cptch_display_captcha();
	echo '</p>';

	return true;
} // end function cptch_comment_form  2.0

// this function checks captcha posted with the comment
function cptch_comment_post($comment) {	
	global $cptch_options;

	if ( is_user_logged_in() && 1 == $cptch_options['cptch_hide_register'] ) {
		return $comment;
	}
    
	global $str_key;
	$str_key = "123";
	// added for compatibility with WP Wall plugin
	// this does NOT add CAPTCHA to WP Wall plugin,
	// it just prevents the "Error: You did not enter a Captcha phrase." when submitting a WP Wall comment
	if ( function_exists( 'WPWall_Widget' ) && isset( $_POST['wpwall_comment'] ) ) {
			// skip capthca
			return $comment;
	}

	// skip captcha for comment replies from the admin menu
	if ( isset( $_POST['action'] ) && $_POST['action'] == 'replyto-comment' &&
	( check_ajax_referer( 'replyto-comment', '_ajax_nonce', false ) || check_ajax_referer( 'replyto-comment', '_ajax_nonce-replyto-comment', false ) ) ) {
				// skip capthca
				return $comment;
	}

	// Skip captcha for trackback or pingback
	if ( $comment['comment_type'] != '' && $comment['comment_type'] != 'comment' ) {
						 // skip captcha
						 return $comment;
	}
	
	// If captcha is empty
	if ( "" ==  $_POST['cptch_number'] )
		wp_die( __('Please complete the CAPTCHA.', 'cptch' ) );

	if ( 0 == strcasecmp( trim( decode( $_POST['cptch_result'], $str_key ) ), $_POST['cptch_number'] ) ) {
		// captcha was matched
		return($comment);
	} else {
		wp_die( __('Error: You entered in the wrong CAPTCHA phrase. Press your browser\'s back button and try again.', 'cptch'));
	}
} // end function cptch_comment_post

// this function adds the captcha to the register form
function cptch_register_form() {
	global $cptch_options;

	// the captcha html - register form
	echo '<p>';
	if( "" != $cptch_options['cptch_label_form'] )	
		echo '<label>'.$cptch_options['cptch_label_form'].'</label><br />';
	echo '<br />';
	cptch_display_captcha();
	echo '</p>
	<br />';

  return true;
} // end function cptch_register_form

// this function checks captcha posted with registration
function cptch_register_post($login,$email,$errors) {
	global $str_key;
	$str_key = "123";

	// If captcha is blank - add error
	if ( "" ==  $_POST['cptch_number'] ) {
		$errors->add('captcha_blank', '<strong>'.__('ERROR', 'cptch').'</strong>: '.__('Please complete the CAPTCHA.', 'cptch'));
		return $errors;
	}

	if ( 0 == strcasecmp( trim( decode( $_POST['cptch_result'], $str_key ) ), $_POST['cptch_number'] ) ) {
					// captcha was matched						
	} else {
		$errors->add('captcha_wrong', '<strong>'.__('ERROR', 'cptch').'</strong>: '.__('That CAPTCHA was incorrect.', 'cptch'));
	}
  return($errors);
} // end function cptch_register_post

// this function checks the captcha posted with lostpassword form
function cptch_lostpassword_post() {
	global $str_key;
	$str_key = "123";

	// If field 'user login' is empty - return
	if( "" == $_POST['user_login'] )
		return;

	// If captcha doesn't entered
  if ( "" ==  $_POST['cptch_number'] ) {
		wp_die( __('Please complete the CAPTCHA.', 'cptch' ) );
	}
	
	// Check entered captcha
	if ( 0 == strcasecmp( trim( decode( $_POST['cptch_result'], $str_key ) ), $_POST['cptch_number'] ) ) {
		return;
	} else {
		wp_die( __('Error: You entered in the wrong CAPTCHA phrase. Press your browser\'s back button and try again.', 'cptch'));
	}
} // function cptch_lostpassword_post

// Functionality of the captcha logic work
function cptch_display_captcha()
{
	global $cptch_options;

	// Key for encoding
	global $str_key;
	$str_key = "123";
	
	// In letters presentation of numbers 0-9
	$number_string = array('null', 'one','two','three','four','five','six','seven','eight','nine');
	// In letters presentation of numbers 11 -19
	$number_two_string = array(1=>'eleven','twelve','thirteen','fourteen','fifteen','sixteen','seventeen','eighteen','nineteen');
	// In letters presentation of numbers 10, 20, 30, 40, 50, 60, 70, 80, 90
	$number_three_string = array(1=>'ten','twenty','thirty','forty','fifty','sixty','seventy','eighty','ninety');
	// The array of math actions
	$math_actions = array();

	// If value for Plus on the settings page is set
	if( 1 == $cptch_options['cptch_math_action_plus'] )
		$math_actions[] = '+';
	// If value for Minus on the settings page is set
	if( 1 == $cptch_options['cptch_math_action_minus'] )
		$math_actions[] = '-';
	// If value for Increase on the settings page is set
	if( 1 == $cptch_options['cptch_math_action_increase'] )
		$math_actions[] = '*';
		
	// Which field from three will be the input to enter required value
	$rand_input = rand( 0, 2 );
	// Which field from three will be the letters presentation of numbers
	$rand_number_string = rand( 0, 2 );
	// If don't check Word in setting page - $rand_number_string not display
	if( 0 == $cptch_options["cptch_difficulty_word"])
		$rand_number_string = -1;
	// Set value for $rand_number_string while $rand_input = $rand_number_string
	while($rand_input == $rand_number_string) {
		$rand_number_string = rand( 0, 2 );
	}
	// What is math action to display in the form
	$rand_math_action = rand( 0, count($math_actions) - 1 );

	$array_math_expretion = array();

	// Add first part of mathematical expression
	$array_math_expretion[0] = rand( 1, 9 );
	// Add second part of mathematical expression
	$array_math_expretion[1] = rand( 1, 9 );
	// Calculation of the mathematical expression result
	switch( $rand_math_action ) {
		case "0":
			$array_math_expretion[2] = $array_math_expretion[0] + $array_math_expretion[1];
			break;
		case "1":
			// Result must not be equal to the negative number
			if($array_math_expretion[0] < $array_math_expretion[1]) {
				$number										= $array_math_expretion[0];
				$array_math_expretion[0]	= $array_math_expretion[1];
				$array_math_expretion[1]	= $number;
			}
			$array_math_expretion[2] = $array_math_expretion[0] - $array_math_expretion[1];
			break;
		case "2":
			$array_math_expretion[2] = $array_math_expretion[0] * $array_math_expretion[1];
			break;
	}
	
	// String for display
	$str_math_expretion = "";
	// First part of mathematical expression
	if( 0 == $rand_input )
		$str_math_expretion .= "<input type=\"text\" name=\"cptch_number\" value=\"\" maxlength=\"1\" size=\"1\" style=\"width:20px;\" />";
	else if ( 0 == $rand_number_string || 0 == $cptch_options["cptch_difficulty_number"] )
		$str_math_expretion .= $number_string[$array_math_expretion[0]];
	else
		$str_math_expretion .= $array_math_expretion[0];
	
	// Add math action
	$str_math_expretion .= " ".$math_actions[$rand_math_action];
	
	// Second part of mathematical expression
	if( 1 == $rand_input )
		$str_math_expretion .= " <input type=\"text\" name=\"cptch_number\" value=\"\" maxlength=\"1\" size=\"1\" style=\"width:20px;\" />";
	else if ( 1 == $rand_number_string || 0 == $cptch_options["cptch_difficulty_number"] )
		$str_math_expretion .= " ".$number_string[$array_math_expretion[1]];
	else
		$str_math_expretion .= " ".$array_math_expretion[1];
	
	// Add =
	$str_math_expretion .= " = ";
	
	// Add result of mathematical expression
	if( 2 == $rand_input ) {
		$str_math_expretion .= " <input type=\"text\" name=\"cptch_number\" value=\"\" maxlength=\"2\" size=\"1\" style=\"width:20px;\" />";
	} else if ( 2 == $rand_number_string || 0 == $cptch_options["cptch_difficulty_number"] ) {
		if( $array_math_expretion[2] < 10 )
			$str_math_expretion .= " ".$number_string[$array_math_expretion[2]];
		else if( $array_math_expretion[2] < 20 && $array_math_expretion[2] > 10 )
			$str_math_expretion .= " ".$number_two_string[ $array_math_expretion[2] % 10 ];
		else
			$str_math_expretion .= " ".$number_three_string[ $array_math_expretion[2] / 10 ]." ".( 0 != $array_math_expretion[2] % 10 ? $number_string[ $array_math_expretion[2] % 10 ] : '');
	} else {
		$str_math_expretion .= $array_math_expretion[2];
	}
	// Add hidden field with encoding result
?>
	<input type="hidden" name="cptch_result" value="<?php echo $str = encode( $array_math_expretion[$rand_input], $str_key ); ?>" />
	<?php echo $str_math_expretion; ?>
<?php
}

// Function for encodinf number
function encode( $String, $Password )
{
	// Check if key for encoding is empty
	if ( ! $Password ) die ( "The password of encipherement is not set" );

	$Salt		= 'BGuxLWQtKweKEMV4';
	$String = substr( pack( "H*", sha1( $String ) ), 0, 1 ).$String;
	$StrLen = strlen( $String );
	$Seq		= $Password;
	$Gamma	= '';
	while ( strlen( $Gamma ) < $StrLen ) {
			$Seq = pack( "H*", sha1( $Seq . $Gamma . $Salt ) );
			$Gamma.=substr( $Seq, 0, 8 );
	}

	return base64_encode( $String ^ $Gamma );
}

// Function for decoding number
function decode( $String, $Key )
{
	// Check if key for encoding is empty
	if ( ! $Key ) die ( "The password of decoding is not set" );

	$Salt		=	'BGuxLWQtKweKEMV4';
	$StrLen = strlen( $String );
	$Seq		= $Key;
	$Gamma	= '';
	while ( strlen( $Gamma ) < $StrLen ) {
			$Seq = pack( "H*", sha1( $Seq . $Gamma . $Salt ) );
			$Gamma.= substr( $Seq, 0, 8 );
	}

	$String = base64_decode( $String );
	$String = $String^$Gamma;

	$DecodedString = substr( $String, 1 );
	$Error = ord( substr( $String, 0, 1 ) ^ substr( pack( "H*", sha1( $DecodedString ) ), 0, 1 )); 

	if ( $Error ) 
		return false;
	else 
		return $DecodedString;
}

?>