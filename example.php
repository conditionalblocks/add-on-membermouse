<?php 

/**
 * We need to check if the current user should be able to see the block based on MemberMouse.
 *
 * https://support.membermouse.com/support/solutions/articles/9000020526-member-data-smarttag-mm-member-data-
 *
 * @return boolean true/false to show the block or not.
 */
function cb_days_since_membermouse_registration( $days_since = 0 ) {

	$user_id = get_current_user_id();

	// Make sure the Membermouse function is available.
	if ( function_exists( 'mm_member_data' ) && ! empty( $user_id ) ) {

		// Check if X days since the current user has registered through membermouse.
		$registered_date_text = mm_member_data( array( 'name' => 'registrationDate' ) );

		// Make sure we have a registration date.
		if ( empty( $registered_date_text ) ) {
			return false;
		}

		$registered_date_time = new DateTime( $registered_date_text );
		$now_date_time = new DateTime( 'NOW' );
		$difference = $registered_date_time->diff( $now_date_time );
		$difference_days = $difference->format( '%a' );

		if ( (int) $difference_days >= (int) $days_since ) {
			return true;
		}
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

	array_push( $allowed_functions, 'cb_days_since_membermouse_registration' );

	return $allowed_functions;
}
  add_filter( 'conditional_blocks_filter_php_logic_functions', 'custom_add_allowed_function_conditional_blocks', 10, 1 );
