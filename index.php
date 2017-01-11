<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>360 gallery maker</title>
<?php include_once("header.php") ?>
</head>
<script>
function resetGalleries(){
	document.cookie="GalleryMaker=; Path=/; expires=Thu, 01 Jan 1970 00:00:00 GMT";
	location.reload();
}

$(document).on('click', '.browse', function(){   var file = $(this).parent().parent().parent().find('.file');   file.trigger('click'); });
$(document).on('change', '.file', function(){   $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, '')); });

function showProgressBar(){
	$('#progressbar').css('visibility', 'visible');
	$(".progress-bar").animate({     width: "99%" }, 15000);
};
// via https://codepen.io/CSWApps/pen/GKtvH

</script>

<body>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="http://fabien.benetou.fr">Home</a></li>
            <li role="presentation"><a href="http://fabien.benetou.fr/VR">About</a></li>
            <li role="presentation"><a href="http://fabien.benetou.fr/Contact/Contact">Contact</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">360 gallery maker</h3>
      </div>

      <div class="jumbotron">
        <h1>Generate your 360 gallery</h1>
        <p class="lead">Simply select your favourite 360 images and upload them. Get a link to share with family and friends to showcase your favorite moments in VR!</p>


         <p>Select your 360 photos (max 20 photos up to 8Mb each) for your gallery</p>
	 <form action="upload.php" method="post" multipart="" enctype="multipart/form-data">
   <div class="form-group">     <input type="file" name="img[]" class="file" style="visibility:hidden;" multiple>     <div class="input-group col-xs-12">       <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>       <input type="text" class="form-control input-lg" disabled placeholder="Upload Image">       <span class="input-group-btn">         <button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>       </span>     </div>   </div>

	 <input class="btn btn-lg btn-success" type="submit" value="Send and generate gallery" onclick="showProgressBar()">
	 </form>

 <div class="progress" style="visibility:hidden;" id="progressbar">
  <div class="progress-bar progress-bar-striped active" role="progressbar"
  aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:10%">
  </div>
</div>

      </div>

      <div class="row marketing">
        <div class="col-lg-6">

          <h4>Your galleries:</h4>
<?php
$cookie_name = "GalleryMaker";

if(!isset($_COOKIE[$cookie_name])) {
    echo "No galleries made on this computer found.";
} else {
	echo "<ul>";
	$galleries = explode(",",$_COOKIE[$cookie_name]);
	foreach ($galleries as $gallery){
		echo "<li><a href='./viewer/?data=$gallery'>$gallery</a>";
	}
	echo "</ul>";
	echo "<input type='button' class='btn' value='Forget my galleries' onclick='resetGalleries()' />";
}

?>

          <h4>Coming soon</h4>
          <p>Customize your gallery using a name, title for images, world globe of destinations and more! Need another feature? Please <a href="mailto:fabien-services@benetou.fr?subject=360 gallery maker feature request">suggest it now</a>!</p>

          <h4>Example as W3C webVR workshop trip</h4>
	<a href="http://fabien.benetou.fr/pub/360/BayAreaTrip/"><img src="visuals/previewBayArea.jpg"/></a>

        </div>
        <div class="col-lg-6">


          <h4>Pick your 360 photos :</h4>
	<img src="visuals/flat.jpg"/>
          <h4>Select in VR a photo :</h4>
	<img src="visuals/start.jpg"/>
          <h4>Feel immersed again :</h4>
	<img src="visuals/selected.jpg"/>

        </div>
      </div>
<hr>

      <footer class="footer">
        <p>Condition of usage : you revoke all rights according to local legislation to minimize my risks because you know, I do it for you and I dont want trouble.  </p>
      </footer>

    </div> <!-- /container -->
<?php include_once("analyticstracking.php") ?>
</body>
</html>
