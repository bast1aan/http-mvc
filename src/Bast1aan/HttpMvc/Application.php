<?php
/*
 * Http MVC
 * Copyright (C) 2014 Bastiaan Welmers, bastiaan@welmers.net
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 2 as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * version 2 along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 */

namespace Bast1aan\HttpMvc;

class Application {

	const HTTP_METHOD_NOT_ALLOWED = "<h1>Method not allowed</h1>\nUnknown HTTP method";

	/**
	 * @var Config
	 */
	private $config;

	/**
	 * @param Config $config
	 */
	public function setConfig(Config $config) {
		$this->config = $config;
	}

	/**
	 * @return Config
	 */
	public function getConfig() {
		return $this->config;
	}

	public function run(Request $request = null) {
		if ($request == null) {
			$request = new Request();
		}

		$response = new Response();

		$pathInfo = $request->getPathInfo();
		$controller = $this->config->getControllerByPath($pathInfo, $this);

		try {
			$controller->doRequest($request, $response);
			switch($request->getRequestMethod()) {
				case Request::HTTP_METHOD_DELETE:
					$controller->doDelete($request, $response);
					break;
				case Request::HTTP_METHOD_GET:
					$controller->doGet($request, $response);
					break;
				case Request::HTTP_METHOD_POST:
					$controller->doPost($request, $response);
					break;
				case Request::HTTP_METHOD_PUT:
					$controller->doPut($request, $response);
					break;
				default:
					$response->setResponseCode(400);
					$response->setBody(self::HTTP_METHOD_NOT_ALLOWED);
					$this->output($response);
					return;
			}
			$view = $request->getView();
			if ($view != null) {
				$response->setBody($view->render());
			}
		} catch (NotFoundException $e) {
			$response->setResponseCode(404);
			$response->setBody($e->getMessage());
		} catch (ServerErrorException $e) {
			$response->setResponseCode(500);
			$response->setBody($e->getMessage());
		}

		$this->output($response);

	}

	private function output(Response $response) {
		foreach($response->getHeaders() as $header) {
			header($header, true);
		}
		$this->http_response_code($response->getResponseCode());

		print $response->getBody();

	}

	private function http_response_code($code) {
		switch ($code) {
			case 100: $text = 'Continue'; break;
			case 101: $text = 'Switching Protocols'; break;
			case 200: $text = 'OK'; break;
			case 201: $text = 'Created'; break;
			case 202: $text = 'Accepted'; break;
			case 203: $text = 'Non-Authoritative Information'; break;
			case 204: $text = 'No Content'; break;
			case 205: $text = 'Reset Content'; break;
			case 206: $text = 'Partial Content'; break;
			case 300: $text = 'Multiple Choices'; break;
			case 301: $text = 'Moved Permanently'; break;
			case 302: $text = 'Moved Temporarily'; break;
			case 303: $text = 'See Other'; break;
			case 304: $text = 'Not Modified'; break;
			case 305: $text = 'Use Proxy'; break;
			case 400: $text = 'Bad Request'; break;
			case 401: $text = 'Unauthorized'; break;
			case 402: $text = 'Payment Required'; break;
			case 403: $text = 'Forbidden'; break;
			case 404: $text = 'Not Found'; break;
			case 405: $text = 'Method Not Allowed'; break;
			case 406: $text = 'Not Acceptable'; break;
			case 407: $text = 'Proxy Authentication Required'; break;
			case 408: $text = 'Request Time-out'; break;
			case 409: $text = 'Conflict'; break;
			case 410: $text = 'Gone'; break;
			case 411: $text = 'Length Required'; break;
			case 412: $text = 'Precondition Failed'; break;
			case 413: $text = 'Request Entity Too Large'; break;
			case 414: $text = 'Request-URI Too Large'; break;
			case 415: $text = 'Unsupported Media Type'; break;
			case 500: $text = 'Internal Server Error'; break;
			case 501: $text = 'Not Implemented'; break;
			case 502: $text = 'Bad Gateway'; break;
			case 503: $text = 'Service Unavailable'; break;
			case 504: $text = 'Gateway Time-out'; break;
			case 505: $text = 'HTTP Version not supported'; break;
			default:
				throw new \RuntimeException('Unknown http status code "' . $code . '"');
		}

		$protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');

		header($protocol . ' ' . $code . ' ' . $text);
	}

}
