<!doctype html>
<html>
<head>
  <title>BayArea 360s</title>
  <script src="https://aframe.io/releases/0.3.0/aframe.min.js"></script>
  <script src="https://rawgit.com/ngokevin/aframe-layout-component/master/dist/aframe-layout-component.min.js"></script>
</head>

<body>
  <a-scene>
    <a-entity camera look-controls>
  <a-entity cursor="fuse: true; fuseTimeout: 500" position="0 0 -20"
            geometry="primitive: ring" 
            material="color: black; shader: flat">
  <a-animation begin="cursor-fusing" easing="ease-in" attribute="scale"
               fill="forwards" from="1 1 1" to="0.1 0.1 0.1"></a-animation>

  </a-entity>
</a-entity>
  
    <a-entity rotation="0 70 0" position="0 -2 0" layout="type: circle; radius: 21" id="content">
      </a-entity>
        
    <a-sky color="lightblue" id="sky"></a-sky>
  </a-scene>
  <script>

  var getJSON = function(url, callback) {
	  var xhr = new XMLHttpRequest();
	  xhr.open("get", url, true);
	  xhr.responseType = "json";
	  xhr.onload = function() {
		  var status = xhr.status;
		  if (status == 200) {
			  callback(null, xhr.response);
		  } else {
			  callback(status);
		  }
	  };
	  xhr.send();
  };

function getJsonFromUrl() {
  var query = location.search.substr(1);
  var result = {};
  query.split("&").forEach(function(part) {
    var item = part.split("=");
    result[item[0]] = decodeURIComponent(item[1]);
  });
  return result;
}

myData = getJsonFromUrl().data;
url = "../galleries/"+myData+".js";
console.log("url",url);

if (myData) {
	getJSON(url,
			function(err, data) {
			if (err != null) {
			console.log("Something went wrong: " + err);
			} else {
			console.log("Your data : " + data);
				contentUpdater(data);
			}
			});
	}

      var url = "../uploads/";
      var urlPreview = url + "previews/";
      var urlFull = url + "";
      
      var scene = document.querySelector('a-scene');
      if (scene.hasLoaded) {
        run();
      } else {
        scene.addEventListener('loaded', run);
      }
      function run () {
	/* optional
	# move close and rotate on hover (mosueenter)
	# anchor URL to jump directly to the right image
	# animation to expand current preview to full content (a la The Lab)
	# Globe from to on start
	# Colored named curved stackable background
	# Upload and annotate option 
	*/
      }

function contentUpdater(data){
	for (var i=0;i<data.length;i++){
          var node = document.createElement("a-sphere");
          document.getElementById("content").appendChild(node);
          node.setAttribute("src", urlPreview + data[i] );
          node.setAttribute("fullsrc", urlFull + data[i] );
          node.addEventListener('click', function() {
              document.getElementById('sky').setAttribute("src",  this.getAttribute("fullsrc"));
              this.setAttribute("opacity", "0.5");
              console.log(this.getAttribute("fullsrc"));
          });
        }
}
      
    </script>

<?php include_once("../analyticstracking.php") ?>
</body>
</html>
