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
function be_admin_alert_errors($errno, $errstr, $errfile, $errline){

	$errorType = array (
		 E_ERROR 				=> 'ERROR',
		 E_CORE_ERROR     		=> 'CORE ERROR',
		 E_COMPILE_ERROR  		=> 'COMPILE ERROR',
		 E_USER_ERROR     		=> 'USER ERROR',
		 E_RECOVERABLE_ERROR    => 'RECOVERABLE ERROR',
		 E_WARNING        		=> 'WARNING',
		 E_CORE_WARNING   		=> 'CORE WARNING',
		 E_COMPILE_WARNING 		=> 'COMPILE WARNING',
		 E_USER_WARNING   		=> 'USER WARNING',
		 E_NOTICE         		=> 'NOTICE',
		 E_USER_NOTICE    		=> 'USER NOTICE',
		 E_DEPRECATED			=> 'DEPRECATED',
		 E_USER_DEPRECATED		=> 'USER_DEPRECATED',
		 E_PARSE          		=> 'PARSING ERROR'
	);

	if (array_key_exists($errno, $errorType)) {
		$errname = $errorType[$errno];
	} else {
		$errname = 'UNKNOWN ERROR';
	}
ob_start();?>
<div class="error">
  <p>
  	<strong><?php echo $errname; ?> Error: [<?php echo $errno; ?>] </strong><?php echo $errstr; ?><strong> <?php echo $errfile; ?></strong> on line <strong><?php echo $errline; ?></strong>
  <p/>
</div>
<?php
echo ob_get_clean();
}

set_error_handler("be_admin_alert_errors", E_ERROR ^ E_CORE_ERROR ^ E_COMPILE_ERROR ^ E_USER_ERROR ^ E_RECOVERABLE_ERROR ^  E_WARNING ^  E_CORE_WARNING ^ E_COMPILE_WARNING ^ E_USER_WARNING ^ E_NOTICE ^  E_USER_NOTICE ^ E_DEPRECATED	^  E_USER_DEPRECATED	^  E_PARSE );
