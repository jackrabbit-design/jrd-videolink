<!DOCTYPE html>
<html lang="en" class="lb">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/><meta name="MSSmartTagsPreventParsing" content="true" />
	<link type="text/css" rel="stylesheet" media="all" href="/ui/css/style.css" />
    <link type="text/plain" rel="author" href="/authors.txt" />
    <link type="image/x-icon" rel="shortcut icon" href="/favicon.ico" />
    <script src="/ui/js/modernizr.js"></script>
    <script src="/ui/js/jquery.js" type="text/javascript"></script>
</head>
<body>

<?php if($_GET['id']) $video = $_GET['id']; ?>
<?php if($_GET['name']) $name = $_GET['name']; ?>

    <div id="lb-video">
        <div style="height:407px">
            <script type="text/javascript" id="vidyard_embed_code_<?= $video ?>" src="//play.vidyard.com/<?= $video ?>.js?v=3.1&type=inline&width=725&height=407&autoplay=true"></script>
        </div>
        <div id="lb-text">
            <h3><?= $name ?></h3>
        </div>
    </div>
    
</body>
</html>