<?php namespace Config;

/**
 * Holds the settings that are used by the authentication system 
 **/
class Authenticator
{

/** 
 * settings used for phpauth\phpauth 
 */
	public $authconfig = array(
	"allow_concurrent_sessions" => "0",
	"attack_mitigation_time" => "+30 minutes",
	"attempts_before_ban" => "30",
	"attempts_before_verify" => "5",
	"bcrypt_cost" => "10",
	"cookie_domain" => null,	
	"cookie_forget" => "+30 minutes",
	"cookie_http" => "0",
	"cookie_name" => "phpauth_session_cookie",
	"cookie_path" => "/",
	"cookie_remember" => "+1 month",
	"cookie_renew" => "+5 minutes",
	"cookie_secure" => "0",
	"emailmessage_suppress_activation" => "0",
	"emailmessage_suppress_reset" => "0",
	"mail_charset" => "UTF-8",
	"password_min_score" => "2",
	"recaptcha_enabled" => "0",
	"recaptcha_secret_key" => "",
	"recaptcha_site_key" => "",
	"request_key_expiration" => "+10 minutes",
	"site_activation_page" => "secure/activate",
	"site_email" => "no-reply@.com",
	"site_key" => "fghuior.)/!/jdUkd8s2!7HVHG7777ghg",
	"site_language" => "en_GB",
	"site_name" => "CI4Auth",
	"site_password_reset_page" => "secure/resetpassword",
	"site_timezone" => "America/Chicago",
	"site_url" => "https://example.com",
	"smtp" => "0",
	"smtp_auth" => "1",
	"smtp_debug" => "0",
	"smtp_host" => "smtp.example.com",
	"smtp_password" => "password",
	"smtp_port" => "25",
	"smtp_secuurity" => null,
	"smtp_username" => "email@example.com",
	"table_attempts" => "auth_attempts",
	"table_emails_banned" => "auth_emails_banned",
	"table_requests" => "auth_requests",
	"table_sessions" => "auth_sessions",
	"table_translations" => "auth_translation_dictionary",
	"table_users" => "auth_users",
	"translation_source" => "php",
	"verify_email_max_length" => "100",
	"verify_email_min_length" => "5",
	"verify_email_use_banlist" => "1",
	"verify_password_min_length" => "3"
);
}