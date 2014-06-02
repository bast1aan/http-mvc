<?php

namespace Bast1aan\HttpMvc;

use ArrayAccess;
use BadMethodCallException;

class Request implements ArrayAccess {

	private $get;

	private $post;

	private $server;

	private $cookie;

	private $session;

	const HTTP_METHOD_GET = 'GET';

	const HTTP_METHOD_PUT = 'PUT';

	const HTTP_METHOD_POST = 'POST';

	const HTTP_METHOD_DELETE = 'DELETE';

	public function __construct(array $get = null, array $post = null, array $server = null, array $cookie = null, array $session = null) {
		if ($get == null) {
			$get = $_GET;
		}

		if ($post == null) {
			$post = $_POST;
		}

		if ($server == null) {
			$server = $_SERVER;
		}
		if ($cookie == null) {
			$cookie = $_COOKIE;
		}
		if ($session == null) {
			$session = $_SESSION;
		}
		$this->get = $get;
		$this->post = $post;
		$this->server = $server;
		$this->cookie = $cookie;
		$this->session = $session;
	}

	/**
	 * @param string $key
	 * @return string|string[]
	 */
	public function get($key) {
		return $this->offsetGet($key);
	}

	/**
	 * @param string $key
	 * @return string
	 */
	public function getServer($key) {
		return $this->server[$key];
	}

	/**
	 * @param string $key
	 * @return string
	 */
	public function getCookie($key) {
		return $this->cookie[$key];
	}

	/**
	 * @param string $key
	 * @return mixed
	 */
	public function getSession($key) {
		return $this->session[$key];
	}


	/**
	 * @param string $key
	 * @return bool
	 */
	public function serverExists($key) {
		return isset($this->server[$key]);
	}

	/**
	 * @param string $key
	 * @return bool
	 */
	public function cookieExists($key) {
		return isset($this->cookie[$key]);
	}

	/**
	 * @param string $key
	 * @return bool
	 */
	public function sessionExists($key) {
		return isset($this->session[$key]);
	}

	/**
	 * @param string $key
	 * @return bool
	 */
	public function keyExists($key) {
		return $this->offsetExists($key);
	}

	/**
	 * @return string
	 */
	public function getPathInfo() {
		return $this->server['REQUEST_URI'];
	}

	public function getRequestMethod() {
		return $this->server['REQUEST_METHOD'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function offsetExists($offset) {
		return isset($this->get[$offset]) || isset($this->post[$offset]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function offsetGet($offset) {
		if (!empty($this->get[$offset])) {
			return $this->get[$offset];
		} elseif (!empty($this->post[$offset])) {
			return $this->post[$offset];
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function offsetSet($offset, $value) {
		throw new BadMethodCallException(sprintf("instance of %s is read-only", __CLASS__));
	}

	/**
	 * {@inheritdoc}
	 */
	public function offsetUnset($offset) {
		throw new BadMethodCallException(sprintf("instance of %s is read-only", __CLASS__));
	}

}
