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

abstract class AbstractController {

	/**
	 * @var Application
	 */
	protected $application;

	public function __construct(Application $application) {
		$this->application = $application;
	}

	/**
	 * @return Application
	 */
	public function getApplication() {
		return $this->application;
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 * @throws NotFoundException|ServerErrorException
	 */
	public function preRequest(Request $request, Response $response) {}


	/**
	 * @param Request $request
	 * @param Response $response
	 * @throws NotFoundException|ServerErrorException
	 */
	public function doRequest(Request $request, Response $response) {}

	/**
	 * @param Request $request
	 * @param Response $response
	 * @throws NotFoundException|ServerErrorException
	 */
	public function postRequest(Request $request, Response $response) {}


}
