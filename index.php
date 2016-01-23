<?php

use infrajs\path\Path;
use infrajs\access\Access;
use infrajs\template\Template;
use infrajs\load\Load;
use infrajs\ans\Ans;
use Michelf\Markdown;

if (!is_file('vendor/autoload.php')) {
	chdir('../../../');	
	require_once('vendor/autoload.php');
}

$src = Ans::GET('src');
$src = Path::theme($src);
if (!$src) $src = 'vendor/infrajs/mdreader/README.md';


$map = Access::cache('mdreader', function () {
	$map = array('vendors'=>array());
	$dir = 'vendor/';
	array_map(function ($file) use (&$map, $dir) {
		if ($file{0} == '.') return;
		if (!is_dir($dir.$file)) return;
		$dir = $dir.$file.'/';
		$vendor = Path::toutf($file);

		if (!$map['vendors'][$vendor]) $map[$vendor] = array();

		array_map(function ($file) use (&$map, $dir, $vendor) {
			if ($file{0} == '.') return;
			if (!is_dir($dir.$file)) return;
			$dir = $dir.$file.'/';
			$name = Path::toutf($file);

			if (!$map['vendors'][$vendor][$name]) {
				$map['vendors'][$vendor][$name] = array(
					'vendor' => $vendor,
					'name' => $name,
					'is' => is_file($dir.'README.md'),
					'list'=>array()
				);
			}
				
			array_map(function ($file) use (&$map, $dir, $vendor, $name) {
				if ($file{0} == '.') return;
				if (!is_file($dir.$file)) return;
				$ext=Path::getExt($file);
				if ($ext != 'md') return;

				$res=array(
					'src' => $dir.$file,
					'vendor' => $vendor,
					'name' => $name,
					'file' => $file
				);
				
				
				
				$map['vendors'][$vendor][$name]['list'][] = $res;
				$map['names'][$dir] = &$map['vendors'][$vendor][$name];

			}, scandir($dir));
		}, scandir($dir));
	}, scandir($dir));
	return $map;
});

$fd=Load::srcInfo($src);
if(isset($map['names'][$fd['folder']])){
	$namedata = $map['names'][$fd['folder']];
} else {
	$namedata = array();
}

$text = file_get_contents(Path::theme($src));
$body = Markdown::defaultTransform($text);
$data['files']=$files;
$data['map']=$map;
$data['src']=$src;
$data['namedata']=$namedata;
$data['body']=$body;

$html = Template::parse('-mdreader/index.tpl', $data);

echo $html;
