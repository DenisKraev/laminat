<?php
class Image {
    private $file;
    private $image;
    private $info;
    private $type;

	public function __construct($file) {
		if (file_exists($file)) {
			$this->file = $file;

			$info = getimagesize($file);

			$this->info = array(
            	'width'  => $info[0],
            	'height' => $info[1],
            	'bits'   => $info['bits'],
            	'mime'   => $info['mime']
        	);

        	$this->image = $this->create($file);
    	} else {
      		exit('Error: Could not load image ' . $file . '!');
    	}
	}

	private function create($image) {
		$mime = $this->info['mime'];

		if ($mime == 'image/gif') {
			return imagecreatefromgif($image);
		} elseif ($mime == 'image/png') {
			return imagecreatefrompng($image);
		} elseif ($mime == 'image/jpeg') {
			return imagecreatefromjpeg($image);
		}
    }

    public function save($file, $quality = 90) {
		$info = pathinfo($file);

		$extension = strtolower($info['extension']);

		if (is_resource($this->image)) {
			if ($extension == 'jpeg' || $extension == 'jpg') {
				imagejpeg($this->image, $file, $quality);
			} elseif($extension == 'png') {
				imagepng($this->image, $file);
			} elseif($extension == 'gif') {
				imagegif($this->image, $file);
			}

			imagedestroy($this->image);
		}
    }

	/**
	*
	*	@param width
	*	@param height
	*	@param default char [default, w, h]
	*				   default = scale with white space,
	*				   w = fill according to width,
	*				   h = fill according to height
	*
	*/
  public function resize($width = 0, $height = 0, $default = '') {
    $h = $height;
    $w = $width;

    if ($h == null) {
      $k = $w / $this->info['width'];
      $h = round($this->info['height'] * $k);
      $this->trueResize($w, $h);
      // 0-1
    } else if ($w == null) {
      $k = $h / $this->info['height'];
      $w = round($this->info['width'] * $k);
      $this->trueResize($w, $h);
      // 1-1
    } else {

      $w2 = $w;
      $h2 = intval(($w / $this->info['width']) * $this->info['height']);

      if ($h2 > $h) {
        $h2 = $h;
        $w2 = intval(($h / $this->info['height']) * $this->info['width']);
      }

      $w = $w2;
      $h = $h2;
      $this->trueResize($w, $h);
    }

  }

  public function crop($w, $h, $cropType=null) {
    $srcW = $this->info['width'];
    $srcH = $this->info['height'];
    $ks   = $srcW / $srcH; // растянутость по ширине
    $kd   = $w / $h;
    $ofX  = $ofXr  = 0;
    $ofY  = $ofYr  = 0;
    if ($kd > $ks) {
      $a    = $srcW / $kd;
      $ofY  = round(($srcH - $a) / 2);
      $ofYr = round($srcH - $a);
      $srcH = $a;
      if ($cropType == 'top') {
        $cropType = 'left';
      }
    } else {
      $a    = $srcH * $kd;
      $ofX  = round(($srcW - $a) / 2);
      $ofXr = round($srcW - $a);
      $srcW = $a;
    }
    if ($cropType == 'height') {
      $k = $w / $this->info['width'];
      $hd = round($this->info['height'] * $k);
      if ($hd < $h) {
        $this->trueResize($w, $hd);
        return;
      }
      $cropType = 'left';
    }
    $imd = imagecreatetruecolor($w, $h);

    if (isset($this->info['mime']) && $this->info['mime'] == 'image/png') {
      imagealphablending($imd, false);
      imagesavealpha($imd, true);
      $background = imagecolorallocatealpha($imd, 255, 255, 255, 127);
      imagecolortransparent($imd, $background);
    } else {
      $background = imagecolorallocate($imd, 255, 255, 255);
    }

    imagefilledrectangle($imd, 0, 0, $w, $w, $background);

    if ($cropType == 'right') {
      imagecopyresampled($imd, $this->image, 0, 0, $ofXr, $ofYr, $w, $h, $srcW, $srcH);
    } else if ($cropType == 'left') {
      imagecopyresampled($imd, $this->image, 0, 0, 0, 0, $w, $h, $srcW, $srcH);
    } else {
      imagecopyresampled($imd, $this->image, 0, 0, $ofX, $ofY, $w, $h, $srcW, $srcH);
    }
    $this->image = $imd;
  }

  function trueResize($width, $height){
    $old = $this->image;
    $this->image = imagecreatetruecolor ($width, $height);

    if (isset($this->info['mime']) && $this->info['mime'] == 'image/png') {
      imagealphablending($this->image, false);
      imagesavealpha($this->image, true);
      $background = imagecolorallocatealpha($this->image, 255, 255, 255, 127);
      imagecolortransparent($this->image, $background);
    } else {
      $background = imagecolorallocate($this->image, 255, 255, 255);
    }

    imagefilledrectangle($this->image, 0, 0, $width, $height, $background);

    imagecopyresampled ($this->image, $old, 0, 0, 0, 0, $width, $height, imagesx($old), imagesy($old));
  }

  public function watermark($file, $position = 'bottomright') {
      $watermark = $this->create($file);

      $watermark_width = imagesx($watermark);
      $watermark_height = imagesy($watermark);

      switch($position) {
          case 'topleft':
              $watermark_pos_x = 0;
              $watermark_pos_y = 0;
              break;
          case 'topright':
              $watermark_pos_x = $this->info['width'] - $watermark_width;
              $watermark_pos_y = 0;
              break;
          case 'bottomleft':
              $watermark_pos_x = 0;
              $watermark_pos_y = $this->info['height'] - $watermark_height;
              break;
          case 'bottomright':
              $watermark_pos_x = $this->info['width'] - $watermark_width;
              $watermark_pos_y = $this->info['height'] - $watermark_height;
              break;
      }

      imagecopy($this->image, $watermark, $watermark_pos_x, $watermark_pos_y, 0, 0, 120, 40);

      imagedestroy($watermark);
  }



  public function rotate($degree, $color = 'FFFFFF') {
  $rgb = $this->html2rgb($color);

      $this->image = imagerotate($this->image, $degree, imagecolorallocate($this->image, $rgb[0], $rgb[1], $rgb[2]));

  $this->info['width'] = imagesx($this->image);
  $this->info['height'] = imagesy($this->image);
  }

  private function filter($filter) {
      imagefilter($this->image, $filter);
  }

  private function text($text, $x = 0, $y = 0, $size = 5, $color = '000000') {
  $rgb = $this->html2rgb($color);

  imagestring($this->image, $size, $x, $y, $text, imagecolorallocate($this->image, $rgb[0], $rgb[1], $rgb[2]));
  }

  private function merge($file, $x = 0, $y = 0, $opacity = 100) {
      $merge = $this->create($file);

      $merge_width = imagesx($image);
      $merge_height = imagesy($image);

      imagecopymerge($this->image, $merge, $x, $y, 0, 0, $merge_width, $merge_height, $opacity);
  }

	private function html2rgb($color) {
		if ($color[0] == '#') {
			$color = substr($color, 1);
		}

		if (strlen($color) == 6) {
			list($r, $g, $b) = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
		} elseif (strlen($color) == 3) {
			list($r, $g, $b) = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
		} else {
			return false;
		}

		$r = hexdec($r);
		$g = hexdec($g);
		$b = hexdec($b);

		return array($r, $g, $b);
	}
}
?>