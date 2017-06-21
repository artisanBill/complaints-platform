<?php

$config = [
	/**
	 * The enable user profile.
	 *
	 * @var  bool
	 */
	'public_user_profile'	=> FALSE,

	/**
	 *	A database column which is used to login with.
	 *
	 *	@var		string
	 */
	'identity'	=> 'account',

	/**
	 *	Salt Length
	 *
	 *	@var		int
	 */
	'salt-length'	=> 8,

	/**
	 *	Minimum Required Length of Password.
	 *
	 *	@var		int
	 */
	'min-password-length'	=> 6,

	/**
	 *	Maximum Allowed Length of Password
	 *
	 *	@var		int
	 */
	'max-password-length'	=> 24,

	/**
	 *	Allow users to be remembered and enable auto-login
	 *
	 *	@var		bool
	 */
	'remember-user'	=> FALSE,

	/**
	 *	How long to remember the user (seconds)
	 *
	 *	@var		int
	 */
	'user-expire'	=> 94520,

	/**
	 *	Extend the users cookies everytime they auto-login
	 *
	 *	@var		bool
	 */
	'user-extend-on-login'	=> FALSE,
];