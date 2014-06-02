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
