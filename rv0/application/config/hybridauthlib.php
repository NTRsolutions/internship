<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

$config =
	array(
		// set on "base_url" the relative url that point to HybridAuth Endpoint
		'base_url' => '/hauth/endpoint',

		"providers" => array (
			// openid providers
			"OpenID" => array (
				"enabled" => true
			),

			"Yahoo" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "", "secret" => "" ),
			),

			"AOL"  => array (
				"enabled" => true
			),

			"Google" => array (
			    
				"enabled" => true,
				"keys"    => array ( "id" => "491288315936-sofvtu7rgh7r5331a0i6oabltut9s5pk.apps.googleusercontent.com", "secret" => "eFCbuyRW4rb7ZUhOC1kCLvTg" ),
			),

			"Facebook" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "826397467466973", "secret" => "4189863ac0638050e36bb9c3691fcfd8" ),
				 "display" => "popup" ,
				 "scope"   => "email, user_about_me, user_birthday, user_hometown",
			),

			"Twitter" => array (
				"enabled" => true,
				"includeEmail"=>true,
				"keys"    => array ( "key" => "4sZrbVkbERfVidUwgRghBUHsN", "secret" => "Lts4lDvky8upvctkKG245Lokat0wThXYukN78493IwX8VtR0Rw")
			),

			// windows live
			"Live" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "", "secret" => "" )
			),

			"MySpace" => array (
				"enabled" => true,
				"keys"    => array ( "key" => "", "secret" => "" )
			),

			"LinkedIn" => array (
				"enabled" => true,
				"keys"    => array ( "key" => "75341jx0wr5igv", "secret" => "LNfCACMwo7TzoJlQ" )
			),

			"Foursquare" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "", "secret" => "" )
			),
		),

		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => (ENVIRONMENT == 'development'),

		"debug_file" => APPPATH.'/logs/hybridauth.log',
	);


/* End of file hybridauthlib.php */
/* Location: ./application/config/hybridauthlib.php */
