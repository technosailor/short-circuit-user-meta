<?php
/*
Plugin Name: Short Circuit Usermeta
Description: Short Circuits Usermeta and saves DB Queries. At scale, you may want to predefine certain meta values that you don't want a user to set (or they don't have access to). Saves DB queries when the meta table is HUUUUUUUUUUUUUUGE.
Author: Aaron Brazell
Author URI: http://technosailor.com
License: MIT
License URI: https://github.com/technosailor/short-circuit-user-meta/blob/master/LICENSE
Version: 0.1
*/

class Short_Circuit_User_Meta {

	/**
	 * @var array $metas An array of meta_key/meta_value pairs
	 */
	public $metas;

	/**
	 * PHP Constructor
	 *
	 * @return null
	 */
	public function __construct() {
		$metas = array(
			'admin_color'		=> 'fresh',
			'comment_shortcuts'	=> true,
			'use_ssl'			=> 0,
			'aim'				=> '',
			'yim'				=> '',
			'jabber'			=> '',
			'googleplus'		=> '',
			'primary_blog'		=> '1',
			'nickname'			=> ''
		);
		$this->metas = apply_filters( 'ac_user_metas', $metas );
		$this->hooks();
	}

	/**
	 * Method to execute callbacks on WordPress hooks
	 *
	 * @return null
	 */
	public function hooks() {
		add_filter( 'get_user_metadata', array( $this, 'short_circuit' ), 15, 4 );
	}

	/**
	 * Handler for defining user meta value without a trip to the database
	 *
	 * @param string|boolean|integer $meta_value Value to set (i.e. true, 'fresh' or 34 )
	 * @param integer $object_id The WordPress user ID that will be modified. WordPress passes this in by default
	 * @param string $meta_key The WordPress user meta key to modify (i.e. admin_color, rich_editing, etc ). WordPress passes this in by default
	 * @param boolean $single Whether this should affect only the first meta_key found for the user or all. WordPress passes this in by default
	 * @return string|boolean|integer The modified $meta_value
	 */
	public function short_circuit( $meta_value, $object_id, $meta_key, $single ) {
		foreach( $this->metas as $k => $v ) {
			if( $meta_key != $k )
				continue;

			return $v;
		}
	} 
}
new Short_Circuit_User_Meta;
