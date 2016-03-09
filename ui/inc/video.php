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


<?php echo '
    <div id="lb-video">
        <div style="height:407px">
            <!-- Start of Brightcove Player -->
            <script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
            <object id="myExperience' . $video . '" class="BrightcoveExperience">
              <param name="bgcolor" value="#FFFFFF" />
              <param name="width" value="725" />
              <param name="height" value="407" />
              <param name="wmode" value="opaque" />
              <param name="playerID" value="3167640819001" />
              <param name="playerKey" value="AQ~~,AAABuqDKP9E~,asvTTGETRYhhyxAUsc_XNvjFowzEWTWK" />
              <param name="isVid" value="true" />
              <param name="isUI" value="true" />
              <param name="dynamicStreaming" value="true" />
              <param name="@videoPlayer" value="' . $video . '" />
            </object>
            <!-- <script type="text/javascript">brightcove.createExperiences();</script> -->
            <!-- End of Brightcove Player -->
        </div>
        <div id="lb-text">
            <h3>' . $name . '</h3>
        </div>
    </div>'; ?>
    
</body>
</html>