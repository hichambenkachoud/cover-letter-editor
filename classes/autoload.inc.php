<?php
/*
*Fonction represantant un autoload
*/
	function autoload($classname)
	{
		if (file_exists($file = dirname ( __FILE__ ) . '/' . $classname . '.class.php')) {
			require $file;
		}
		else
		{
			echo("Not Founded");
			$file = dirname ( __FILE__ ) . '/' . $classname . '.class.php';
			echo $file;
		}
	}

	spl_autoload_register('autoload');
?>