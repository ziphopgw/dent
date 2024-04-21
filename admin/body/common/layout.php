<!DOCTYPE html>
<html lang="ko">
<head>
	<?include_once $_template['header'];?>
</head>
<body>
    <div id="viewport">
        <!-- 헤더 -->
        <div id="header">
			<?include_once $_template['left'];?>
        </div>
        <div id="header_mask"></div>
        
        <!-- 컨텐츠 -->
        <div id="contents">
            <div class="contitle">
				<?include_once $_template['top'];?>
            </div>
            <div class="content_wrap">
				<?include_once $_template['body'];?>
            </div>
        </div>
    </div>
</body>
</html>