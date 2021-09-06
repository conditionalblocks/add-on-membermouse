<?php 

/**
 * We need to check if the current user should be able to see the block based on MemberMouse.
 *
 * @return boolean true/false to show the block or not.
 */
function cb_check_days_since_membermouse_registration( $days_since = 0, $other_param_if_needed ) {

  $user_id = get_current_user_id();
  
  if ( ! empty( $user_id ) {
  
  // Check if X days since the current user has registered through membermouse.
  
  // return true;
  }

	return false;
}


/**
 * Add custom functions to be used with PHP Logic conditions.
 *
 * @param array $allowed_functions
 * @return array $allowed_functions
 */
function custom_add_allowed_function_conditional_blocks( $allowed_functions ) {

	array_push( $allowed_functions, 'cb_check_days_since_membermouse_registration' );

	return $allowed_functions;
}
add_filter( 'conditional_blocks_filter_php_logic_functions', 'custom_add_allowed_function_conditional_blocks', 10, 1 );
