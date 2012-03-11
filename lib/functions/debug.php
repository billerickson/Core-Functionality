<?php
/**
 * WordPress Error Debugging
 * @link http://wp.tutsplus.com/tutorials/display-php-errors-as-wordpress-admin-alerts/
 *
 * @package      Core_Functionality
 * @since        1.2.0
 * @link         https://github.com/billerickson/Core-Functionality
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

function be_admin_alert_errors( $errno, $errstr, $errfile, $errline ) {
	$errortype = array(
		E_ERROR => 'Error',
		E_WARNING => 'Warning',
		E_PARSE => 'Parsing Error',
		E_NOTICE => 'Notice',
		E_CORE_ERROR => 'Core Error',
		E_CORE_WARNING => 'Core Warning',
		E_COMPILE_ERROR => 'Compile Error',
		E_COMPILE_WARNING => 'Compile Warning',
		E_USER_ERROR => 'User Error',
		E_USER_WARNING => 'User Warning',
		E_USER_NOTICE => 'User Notice',
		E_STRICT => 'Strict',
		E_RECOVERABLE_ERROR => 'Catchable Fatal Error',
		E_DEPRECATED => 'Deprecated',
		E_USER_DEPRECATED => 'User Deprecated',
	);

	if ( array_key_exists( $errno, $errortype ) ) {
		$errname = $errortype[$errno];
	} else {
		$errname = 'Unknown Error';
	}
	ob_start();
?>
<div class="error">
  <p>
  	<strong><?php echo $errname; ?> (<?php echo $errno; ?>): </strong><?php echo $errstr; ?><strong> <?php echo $errfile; ?></strong> on line <strong><?php echo $errline; ?></strong>
  </p>
</div>
<?php
	echo ob_get_clean();
}
set_error_handler( 'be_admin_alert_errors', E_ERROR ^ E_WARNING ^ E_PARSE ^ E_NOTICE ^ E_CORE_ERROR ^ E_CORE_WARNING ^ E_COMPILE_ERROR ^ E_COMPILE_WARNING ^ E_USER_ERROR ^ E_USER_WARNING ^ E_USER_NOTICE ^ E_STRICT ^ E_RECOVERABLE_ERROR ^ E_DEPRECATED ^ E_USER_DEPRECATED );