<?php

use Imagine\Image\Box;
use Imagine\Image\Point;

class ImageResize
{
	public  $imagine;

	public function __construct()
	{
		$this->imagine = new Imagine\Gd\Imagine();
	}

	public function resizeAllImages($dir)
	{
		$files = scandir($dir);

		foreach ($files as $key => $value) {
			$path = realpath($dir . DIRECTORY_SEPARATOR . $value);
			if (!is_dir($path)) {
				/*Resize Image */
				$extinction =  pathinfo($path,PATHINFO_EXTENSION);
				if (in_array($extinction,['jpg','png','jpeg'])){
					$this->imagine->open($path)
						->thumbnail(new \Imagine\Image\Box(500,500))
						->save($path);
				}

			} else if ($value != "." && $value != "..") {
				$this->resizeAllImages($path);
			}
		}

	}
}