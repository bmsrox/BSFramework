<?php

namespace BSFramework;
use BSFramework\WebApplication;

class Controllers extends WebApplication {

	/**
	 * getPathViewLayout get file layout/main.php
	 * @return string
	 */
	private function getPathViewLayout() {
		return $this->getPathView() . '/' . $this->_view . '.php';
	}

	/**
	 * getPathView get path of views
	 * @return string
	 */
	private function getPathView() {
		return  "../module/" . $this->_namespace . "/views";
	}

	/**
	 * getViewFile get the file view
	 * @param  string $view receive the file for render
	 * @return string       return path of file that exist
	 */
	private function getViewFile($view) {

		$path = $this->getPathView() . '/' . $this->_action . '/' . $view . '.php';

		if(file_exists($path))
			return $path;

	}

	/**
	 * getPathLayout get the layout file
	 * @return string
	 */
	private function getPathLayout() {

		$layout = $this->getPathView() . "/" . $this->layout . ".php";

		if(file_exists($layout))
			return $layout;

	}

	/**
	 * processOutput render the output in layout/main.php
	 * @param string $output
	 * @return string         file rendering
	 */
	private function processOutput($output) {

		if(file_exists($this->getPathViewLayout()))
			return $this->renderFile($this->getPathViewLayout(), array('content'=>$output), true);

		return $output;
	}

	/**
	 * render render a view file
	 * @param  string  $view   view file path
	 * @param  array   $data   data to be extracted and made available to the view
	 * @param  boolean $return whether the rendering result should be returned instead of being echoed
	 * @return string          the rendering result. Null if the rendering result is not required.
	 */
	public function render($view, $data=null, $return=false) {

		$output = $this->renderPartial($view, $data, true);

		if($layoutFile = $this->getPathLayout()){
			$output = $this->renderFile($layoutFile, array('content'=>$output), true);
		}

		$output = $this->processOutput($output);

		if($return)
			return $output;
		else
			echo $output;

	}

	/**
	 * renderPartial render a view file
	 * @param  string  $view   view file path
	 * @param  array   $data   data to be extracted and made available to the view
	 * @param  boolean $return whether the rendering result should be returned instead of being echoed
	 * @return string          the rendering result. Null if the rendering result is not required.
	 */
	public function renderPartial($view, $data = null, $return=false) {

		if($viewFile = $this->getViewFile($view)) {

			$output = $this->renderFile($viewFile, $data, true);

			if($return)
				return $output;
			else
				echo $output;

		}else{
			throw new \Exception($this->_controller . ' cannot find the requested view "'.$view.'".');
		}

	}

	/**
	 * renderFile render a view file
	 * @param  string  $view   view file path
	 * @param  array   $data   data to be extracted and made available to the view
	 * @param  boolean $return whether the rendering result should be returned instead of being echoed
	 * @return string          the rendering result. Null if the rendering result is not required.
	 */
	public function renderFile($view, $data = null, $return=false) {
		$output = $this->renderInternal($view, $data, $return);
		if($return)
			return $output;
		else
			echo $output;
	}

	/**
	 * renderInternal render a view file
	 * @param  string  $view   view file path
	 * @param  array   $data   data to be extracted and made available to the view
	 * @param  boolean $return whether the rendering result should be returned instead of being echoed
	 * @return string          the rendering result. Null if the rendering result is not required.
	 */
	public function renderInternal($view, $data = null, $return=false) {

		if(is_array($data))
			extract($data);

		if($return)
		{
			ob_start();
			ob_implicit_flush(false);
			require($view);
			return ob_get_clean();
		}
		else
			require($view);
	}

}