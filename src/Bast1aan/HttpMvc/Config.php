<?php

namespace Bast1aan\HttpMvc {

	interface Config {
		/** @return AbstractController */ function getControllerByPath($path, Application $application);
		/** @return string */ function getProjectRoot();
		/** @return string */ function getViewRoot();
	}
}
