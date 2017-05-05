<?php


namespace MKA\Helpers;


class CheckCDNReadability {
	private $url;

	/**
	 * checkReachability constructor.
	 *
	 * @param $url
	 */
	public function __construct( $url ) {
		$this->url = $url;
	}

	/**
	 * @return $this
	 */
	public function check() {
		$ch = curl_init( $this->url );
		curl_setopt_array( $ch, [
			CURLOPT_AUTOREFERER    => true,
			CURLOPT_CONNECTTIMEOUT => 5,
			CURLOPT_ENCODING       => '',
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_MAXREDIRS      => 1,
			CURLOPT_NOBODY         => true,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_TIMEOUT        => 5,
			// It's very important to let other webmasters know who's probing their servers.
			CURLOPT_USERAGENT      => 'Mozilla/5.0 (compatible; StackOverflow/0.0.1; +https://codereview.stackexchange.com/)',
		] );
		curl_exec( $ch );
		$code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
		curl_close( $ch );
		if ( 200 !== $code ) {
			return false;
		} else {
			return true;
		}

	}

}