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

namespace Bast1aan\HttpMvc\View {

	use Bast1aan\HttpMvc\AbstractController;

	abstract class View {

		/**
		 * @var AbstractController
		 */
		protected $controller;

		/**
		 * @var string
		 */
		protected $script;

		public function __construct(AbstractController $controller) {
			$this->controller = $controller;
		}

		/**
		 * @return string
		 * @throws NoViewScriptFoundException
		 */
		public function render() {
			$viewRoot = $this->controller->getApplication()->getConfig()->getViewRoot();
			$script = '';
			if (strlen($this->script) > 0 && $this->script[0] == '/') {
				$script = $viewRoot . $this->script;
			} else {
				$script = $viewRoot . '/' . $this->script;
			}

			if (!file_exists($script)) {
				throw new NoViewScriptFoundException(sprintf("Script %s not found", $this->script));
			}

			ob_start();
			require $script;
			$body = ob_get_clean();

			return $body;
		}

		/**
		 * @return string
		 */
		public function getScript() {
			return $this->script;
		}

	}
}
