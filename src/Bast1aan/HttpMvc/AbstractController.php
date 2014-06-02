<?php

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
	public function doGet(Request $request, Response $response) {}

	/**
	 * @param Request $request
	 * @param Response $response
	 * @throws NotFoundException|ServerErrorException
	 */
	public function doPut(Request $request, Response $response) {}

	/**
	 * @param Request $request
	 * @param Response $response
	 * @throws NotFoundException|ServerErrorException
	 */
	public function doPost(Request $request, Response $response) {}

	/**
	 * @param Request $request
	 * @param Response $response
	 * @throws NotFoundException|ServerErrorException
	 */
	public function doDelete(Request $request, Response $response) {}


	/** @return View */ public abstract function getView();

}
