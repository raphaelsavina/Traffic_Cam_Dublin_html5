<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Dublin Traffic Cams</title>
	<link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" /> 
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no"/>
	<meta name="description" content="Mobile optimised Dublin Traffic Cams" />
	<meta name="keywords" content="Dublin, traffic, camera, livedrive, AA roadwatch, traffic cams" />
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />

	<script src="jquery-1.6.1.min.js"></script>
	<script src="jquery.scrollTo-1.4.2-min.js"></script>

	<!--Analytics-->
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-23963982-1']);
	  _gaq.push(['_trackPageview']);
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>

	<script type="text/javascript">
	$(document).ready(function() {
		$.scrollTo({top:0, left:1600},{duration:2000});
		var $scrollingDiv = $("#container");
		$(window).scroll(function(){
			$scrollingDiv
				.stop()
				.animate({"left": ($(window).scrollLeft()) + "px"}, "slow" );
		});
	});
	</script>	
	
	<script type="text/javascript">
	$(document).ready(function() {
		var $scrollingDiv = $("#container");
		$(window).scroll(function(){
			$scrollingDiv
				.stop()
				.animate({"left": ($(window).scrollLeft()) + "px"}, "slow" );
		});
	});
	</script>
		
	<script>
	$(window).load(function() {
	  $('img').each(function() {
	    if (!this.complete) {
	      // image was broken, replace with your new image
	      this.src = 'images/placeholder.png';
	    }
	  });
	});	</script>
	
</head>

<body>
<!--[if lt IE 7]>
	<script type="text/javascript">
	alert ("Still using an old version of Internet Explorer!\nTo see our site correctly, please update it\n or maybe you can install Google Chrome or Firefox.")
	</script>
<![endif]-->	
		
<?php
$webcam = $_GET['webcam'];
if ($webcam == "") {
	$webcam = "Site0Camera6";
};
# List of cameras
$arr_cam = array("Site0Camera10" => "The Quays from Liberty Hall",
"Site0Camera100" => "N11-Fosters",
"Site0Camera101" => "N11-Mont Merrion",
"Site0Camera102" => "N11-Kilmacud Rd",
"Site0Camera103" => "N11-Trees Road",
"Site0Camera104" => "N11-Newtownpark Avenue",
"Site0Camera105" => "N11-Kill Lane",
"Site0Camera106" => "N11-Clonkeen",
"Site0Camera107" => "N11-Johnstown",
"Site0Camera108" => "N11-Wyattville",
"Site0Camera109" => "M1-Balbriggan",
"Site0Camera110" => "M1-Airport",
"Site0Camera111" => "M1-Drynam",
"Site0Camera112" => "M1-Malahide Estuary",
"Site0Camera113" => "M1-Lissenhall",
"Site0Camera122" => "North Wall Quay",
"Site0Camera127" => "Guild Street-Mayor Street",
"Site0Camera131" => "Constitution Hill",
"Site0Camera135" => "Dublin Port Tunnel Toll Plaza",
"Site0Camera136" => "Samuel Beckett Bridge",
"Site0Camera137" => "Sir John Rogersons Quay",
"Site0Camera139" => "Guild Street-Seville Place",
"Site0Camera15" => "John's Road-SCR",
"Site0Camera163" => "John's Road West",
"Site0Camera21" => "Dame Street from Civic Offices",
"Site0Camera22" => "North Quays from Civic Offices",
"Site0Camera23" => "Pearse Street",
"Site0Camera24" => "North Strand Road",
"Site0Camera27" => "Drumcondra Road",
"Site0Camera31" => "Harolds Cross Bridge",
"Site0Camera32" => "Cabra Road",
"Site0Camera6" => "O'Connell Bridge",
"Site0Camera66" => "Longmile Road",
"Site0Camera71" => "M50-Blanchardstown Roundabout",
"Site0Camera73" => "M50-Ballinteer",
"Site0Camera74" => "M50-Edmondstown",
"Site0Camera75" => "M50-Firhouse",
"Site0Camera77" => "M50-Tallaght",
"Site0Camera78" => "M50-Ballymount",
"Site0Camera79" => "M50-Red Cow",
"Site0Camera80" => "M50-Red Cow Slip",
"Site0Camera81" => "M50-Greenhills Park",
"Site0Camera82" => "M50-Lucan",
"Site0Camera85" => "Naas road-Newlands cross",
"Site0Camera87" => "M50-South of Finglas Roundabout",
"Site0Camera91" => "N32-Malahide Road",
"Site0Camera94" => "M1-M50",
"Site0Camera95" => "M1-Port Tunnel Works",
"Site0Camera96" => "M50-Ballymun",
"BelgardAirton" => "Belgard Airton",
"belgardcook" => "Belgard Cookstown",
"belgardmayberry" => "Belgard Mayberry",
"BelgardSqE" => "Belgard Square East",
"Castleroad" => "Castle Road/ORR",
"FonthillRon" => "Fonthill/Ronanstown",
"Greenhillsairton" => "Greenhills Airton",
"Greenhillsmayberry" => "Greenhills Mayberry",
"Greenhillstallaght" => "Greenhills Tallaght",
"Greenhillstymon" => "Greenhills Tymon",
"Jobstown" => "Jobstown",
"Lucanwood" => "Lucan Road at Woodvale",
"N7citywest" => "N7/City West Junction",
"N7Longmile" => "N7 Longmile",
"N4newcastle" => "N4 Newcastle",
"Rathcoole" => "N7/Rathcoole",
"N81belgard" => "N81/Belgard Road",
"N81Citywest" => "N81/City West",
"N81oldbawn" => "N81 Oldbawn",
"N81white" => "N81 Whitestown",
"Bawneouge" => "Nangor Road/Bawneouge Junction",
"Deansrath" => "Nangor Road/Deansrath Junction",
"killen" => "Nangor Road/Killeen",
"Parkwest" => "Nangor/Park West Junction",
"m50redcow" => "M50–Red Cow",
"ORRFetter" => "ORR Fettercairn",
"ORRFox" => "ORR at Foxhunter",
"ORRGrange" => "ORR Grange Castle",
"ORRnangor" => "ORR Nangor");
?>

<img id="past" class="past" src="images/past.png">
<img id="imgCamera4" class="webcam4" src="http://trafficcam-fetcher.savina.net/serve_single_pic/<?php echo $webcam;?>/4">
<img id="imgCamera3" class="webcam3" src="http://trafficcam-fetcher.savina.net/serve_single_pic/<?php echo $webcam;?>/3"> 
<img id="imgCamera2" class="webcam2" src="http://trafficcam-fetcher.savina.net/serve_single_pic/<?php echo $webcam;?>/2"> 
<img id="imgCamera1" class="webcam1" src="http://trafficcam-fetcher.savina.net/serve_single_pic/<?php echo $webcam;?>/1">
<img id="imgCamera0" class="webcam0" src="http://trafficcam-fetcher.savina.net/serve_single_pic/<?php echo $webcam;?>/0">
<a href="#right"><img id="now" class="now" src="images/now.png"></a>

<div class="container" id="container">
	<div class="about" id="about">
		<a class="linktab" href="about.html">about</a>
	</div>
	<div class="changeCam" id="changeCam">
		<a class="linktab" href="camera.html">cameras</a>
	</div>
	<div class="Cam_name" id="Cam_name">
		View of: <?php echo $arr_cam[$webcam];?>
	</div>
	<div class="feedback" id="feedback">
		<a  class="linktab" href="feedback.html">feedback</a>
	</div>

	<div class="ad_mobile" id="ad_mobile">
	<script type="text/javascript"><!--
	  // XHTML should not attempt to parse these strings, declare them CDATA.
	  /* <![CDATA[ */
	  window.googleAfmcRequest = {
	    client: 'ca-mb-pub-0058068697090854',
	    format: '320x50_mb',
	    output: 'html',
	    slotname: '8950700253',
	  };
	  /* ]]> */
	//--></script>
	<script type="text/javascript"    src="http://pagead2.googlesyndication.com/pagead/show_afmc_ads.js"></script>
	</div>


</div>

</body>
</html>