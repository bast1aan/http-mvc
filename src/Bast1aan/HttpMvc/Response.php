<?php

namespace Bast1aan\HttpMvc {
	class Response {
		private $body = '';

		private $headers = array();

		private $responseCode = 200;

		/**
		 * @param string $body
		 */
		public function setBody($body) {
			$this->body = $body;
		}

		/**
		 * @param string $body
		 */
		public function appendBody($body) {
			$this->body .= $body;
		}

		/**
		 * @param array|string[] $headers
		 */
		public function setHeaders(array $headers) {
			$this->headers = $headers;
		}

		/**
		 * @param string $header
		 */
		public function addHeader($header) {
			$this->headers[] = $header;
		}

		/**
		 * @param int $code
		 */
		public function setResponseCode($code) {
			$this->responseCode = $code;
		}

		/**
		 * @return string
		 */
		public function getBody()
		{
			return $this->body;
		}

		/**
		 * @return array
		 */
		public function getHeaders()
		{
			return $this->headers;
		}

		/**
		 * @return int
		 */
		public function getResponseCode()
		{
			return $this->responseCode;
		}

	}
}
