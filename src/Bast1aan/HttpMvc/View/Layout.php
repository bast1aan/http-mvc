<?php

namespace Bast1aan\HttpMvc\View {
	abstract class Layout extends View {

		protected $layout = null;

		private $body;

		/**
		 * @return string
		 */
		public function getBody() {
			return $this->body;
		}

		/**
		 * @param string $body
		 */
		public function setBody($body) {
			$this->body = $body;
		}
	}
}
