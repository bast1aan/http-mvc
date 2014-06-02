<?php

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
			$view = $controller->getView();
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
		http_response_code($response->getResponseCode());

		print $response->getBody();

	}


}
