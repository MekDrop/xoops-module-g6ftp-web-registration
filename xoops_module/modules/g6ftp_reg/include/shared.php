<?
if (!function_exists('getmoduleoption')) {

	function getmoduleoption($option, $repmodule='news') { 
		global $xoopsModuleConfig, $xoopsModule; 
	    static $tbloptions= Array();
		if(is_array($tbloptions) && array_key_exists($option,$tbloptions)) { 
			return $tbloptions[$option]; 
	    } 

		$retval=false; 
	    if (isset($xoopsModuleConfig) && (is_object($xoopsModule) && $xoopsModule->getVar('dirname') == $repmodule && $xoopsModule->getVar('isactive')))     { 
	        if(isset($xoopsModuleConfig[$option])) { 
		        $retval= $xoopsModuleConfig[$option]; 
			} 
	    } else {
			$module_handler =& xoops_gethandler('module'); 
			$module =& $module_handler->getByDirname($repmodule); 
	        $config_handler =& xoops_gethandler('config'); 
		    if ($module) { 
			    $moduleConfig =& $config_handler->getConfigsByCat(0, $module->getVar('mid')); 
				if(isset($moduleConfig[$option])) { 
					$retval= $moduleConfig[$option]; 
	            } 
		    } 
	    } 
		$tbloptions[$option]=$retval; 
	    return $retval; 
	} 
}
?>