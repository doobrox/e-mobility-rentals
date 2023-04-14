<?php
//
/**
* Class handler for the Theme's document output to start
* a buffer to avoid Widgets to call Assets after wp_head has
* been called. The class should be used only if the VikWp Theme
* starts a buffer, otherwise Widgets would echo the Assets tags.
*/
final class VikWpDocument
{
	/**
	 * @var 	string
	 */
	private $page = '';
	
	/**
	 * @var 	boolean 
	 */
	private static $loadedOnce = false;

	/**
	 * Starts the output buffering to store the HTML code
	 * sent to output after this call.
	 * 
	 * @return 	void
	 */
	public static function getInstance()
	{
		if (!static::$loadedOnce)
		{
			// disable WPCOM function used to wrap the footer links within a buffer
			add_filter('wpcom_better_footer_credit_apply', function() {
				return false;
			});
			
			static::$loadedOnce = true;
		}
		
		return new static();
	}

	public function __construct()
	{
		// start output buffering
		ob_start();
	}

	/**
	 * Stops the output buffering and registers the HTML.
	 * 
	 * @return 	string
	 */
	public function display()
	{
		// stop output buffering for the page
		$this->page = ob_get_contents();
		ob_end_clean();

		// start output buffering for the HTML file
		ob_start();
		include get_template_directory() . DIRECTORY_SEPARATOR . 'html.php';
		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}
}
