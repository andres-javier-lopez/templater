<?php

// Author: Andrés Javier López <ajavier.lopez@gmail.com>
// Version: 0.1
// Licenced under LGPLv3

$moondragon = '../moondragon/moondragon.core.php';
$template_dir = 'templates';

require_once $moondragon;
require_once 'moondragon.render.php';
require_once 'moondragon.manager.php';
require_once 'moondragon.caller.php';

Template::addDir($template_dir);

class Templater extends Manager
{
	public function index() {
		return "Thank you for using Templater";
	}
	
	public function __call($template, $params) {
		try {
			$vars = Json::decode(file_get_contents('php://input'), true);
		}
		catch(JsonException $e) {
			$vars = array();
		}
		
		try{
			$return = Template::load($template, $vars);
		}
		catch(TemplateNotFoundException $e) {
			$return = 'Unexistent';
		}
		
		return $return;
	}
}

MoonDragon::run(new Templater());

// Fin del archivo
