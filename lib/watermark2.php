<?
	$IMAGE_PATH = $_SERVER['DOCUMENT_ROOT'].'/'.$_GET['path'];

	list($IMAGE_W, $IMAGE_H) = getimagesize($IMAGE_PATH);

	if($IMAGE_W > 2848) $WATERMARK_PATH = $_SERVER['DOCUMENT_ROOT'].'/img/watermark6.png';
	else $WATERMARK_PATH = $_SERVER['DOCUMENT_ROOT'].'/img/watermark4.png';

	$IMAGE_TYPE = strtolower(substr($IMAGE_PATH, strlen($IMAGE_PATH)-4, 4));

	$WATERMARK_TYPE = strtolower(substr($WATERMARK_PATH, strlen($WATERMARK_PATH)-4, 4));

	if($IMAGE_TYPE == '.bmp') $image = imagecreatefromwbmp($IMAGE_PATH);

	if($IMAGE_TYPE == '.gif') $image = imagecreatefromgif($IMAGE_PATH);

	if($IMAGE_TYPE == '.jpg') $image = imagecreatefromjpeg($IMAGE_PATH);

	if($IMAGE_TYPE == '.png') $image = imagecreatefrompng($IMAGE_PATH);

	if($image) {

		if($WATERMARK_TYPE == '.bmp') $watermark = imagecreatefromwbmp($WATERMARK_PATH);

		if($WATERMARK_TYPE == '.gif') $watermark = imagecreatefromgif($WATERMARK_PATH);

		if($WATERMARK_TYPE == '.jpg') $watermark = imagecreatefromjpeg($WATERMARK_PATH);

		if($WATERMARK_TYPE == '.png') $watermark = imagecreatefrompng($WATERMARK_PATH);

		if($watermark) {

			list($IMAGE_W, $IMAGE_H) = getimagesize($IMAGE_PATH);

			list($WATERMARK_W, $WATERMARK_H) = getimagesize($WATERMARK_PATH);

			if($ALIGN_CENTER) { // Center

				$POS_X = (($IMAGE_W - $WATERMARK_W)/2);

				$POS_Y = (($IMAGE_H - $WATERMARK_H)/2);

			}

			else {

				$POS_X = ($IMAGE_W - $WATERMARK_W);
				$POS_Y = ($IMAGE_H - $WATERMARK_H);
//				$POS_X = $WATERMARK_W - $WATERMARK_W + 20;
//				$POS_Y = ($IMAGE_H - $WATERMARK_H) - 20;

			}

			imagealphablending($image, true);

			imagecopy($image, $watermark, $POS_X, $POS_Y, 0, 0, $WATERMARK_W, $WATERMARK_H);

			header("Content-type: image/jpeg");

			imagejpeg($image);

			imagedestroy($image);

			imagedestroy($watermark);

		}

	}
?>