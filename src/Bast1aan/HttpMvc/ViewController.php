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

	/**
	 * Controller that sets up and renders Views
	 * @see \Bast1aan\HttpMvc\View\View
	 */
	abstract class ViewController extends AbstractController {

		public function preRequest(Request $request, Response $response) {
			parent::preRequest($request, $response);
			$view = $this->newView();
			$request->setView($view);
		}

		public function postRequest(Request $request, Response $response) {
			parent::postRequest($request, $response);
			// render view, if available
			$view = $request->getView();
			if ($view != null) {
				$response->appendBody($view->render());
			}
		}

		/**
		 * Create a new View object for a request.
		 *
		 * @return \Bast1aan\HttpMvc\View\View
		 */
		abstract public function newView();

	}
}