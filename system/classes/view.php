<?
class View {
    
	function __construct() {
	}
	
	 
	
	function render ($templateFile,$vars) {
		//header
		require_once(ROOT . '/application/views/_header.php');

		$TPL = $vars;
		require_once(ROOT . '/application/views/'. strtolower($templateFile) . '.php');

		//footer
		require_once(ROOT . '/application/views/_footer.php');
	}
}
?>