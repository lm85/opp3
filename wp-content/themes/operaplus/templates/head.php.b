<?php
global $post;
if (get_post_meta($post->ID,OPERAPLUS_PREFIX.'disable_cache',true) == 'on') {
    header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
    define( 'DONOTCACHEPAGE', true );
}

?>
<?php global $hash; ?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri() .'/build/img/favicon.png?' . $hash ?>" sizes="16x16">
	<?php if ( is_home() ) { ?>
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate, max-age=60">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Expires" content="-1">
	<?php } ?>
	<?php wp_head(); ?>
<?php /* ToDo: Add script to function  */ ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php // if(strpos($_SERVER['REFERER'],"seznam.cz")!==false) { ?>
	<script src="//ssp.imedia.cz/static/js/ssp.js"></script>
	<script>
		sssp.config({ source: "hp_feed" });
	// pokud byla návštěva realizována z Newsfeedu ze Seznam.cz
	if (sssp.displaySeznamAds()) {
		// vykreslení reklamy
		
		var d = new Date();
  		d.setTime(d.getTime() + (30*60*1000));
  		var expires = "expires="+ d.toUTCString();
  			document.cookie = "sspop=1;" + expires + ";path=/";
		sssp.getAds([
			// identifikace volaných reklamních zón
    	]);
	}
</script>
<?php // } ?>
<script>

jQuery( window  ).scroll(function() {
var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

//console.log(sticky);
  if (window.pageYOffset > sticky) {
if (window.innerWidth>800)    
        header.classList.add("stickymenu");
  } else {
    header.classList.remove("stickymenu");
  }
});
</script>
<style>
.sidebar {border-left: 1px solid #ffb04fa8;}

/*.violin {border-top:1px solid #DDD;}*/
.box .box-content-title {margin-top:5px !important;}

.nav li a {border-bottom:0px}
.center{margin-right:auto;margin-left:auto;}
.box .box-image a img {margin-bottom:12px;	}

/*.header {
  padding: 10px 16px;
  background: #555;
  color: #f1f1f1;
}

.content {
  padding: 16px;
}

*/

/* .wpd-rating-left, .wpd-rating-right {display:none;}*/

.stickymenu {
  position: fixed !important;
  top: 0px !important;
    left:0;
  width: 100%;
    z-index:999999999;
background: rgba(255,255,255,0.95);
margin-top:0;
padding-bottom:10px;
/*    border-bottom: 1px solid #ffb04fa8;*/

}
.brand-title {border:0;padding-left: 47px;padding-top:0;}
.brand-title,		.brand {text-align:left;}
.brand-logo {width:61%}
.excerpt {font-size:1.2em}
.content-page p, .content-post p {font-size:1.1em}

.stickymenu nav {width:1200px;margin:auto;}

.grecaptcha-badge {display:none;}

#menu-menunove {
display: flex;
text-align: right !important;
justify-content: center;
font-weight:bold;

}
/*.container {position:relative}*/
.stickymenu + .wrap {
  padding-top: 102px;
} 
#myHeader.stickymenu img {height:30px;display:block !important;
    position: relative;

    left: 58px;
}

.nav {padding-left: 15px;}
.stickyimg {height:45px;float: left;}

#myHeader .brand-logo {display:none;}
#myHeader img {display:none !important}

.nav li a {font-weight:bold;}
.main  {padding-top:15px;}
#myHeader  {border-bottom: 1px solid #ffb04fa8;border-top: 1px solid #ffb04fa8;margin:0px auto 0 auto;}

.header {margin-bottom:0;}

@media (min-width: 801px)
{

#mainrow { display: grid;grid-template-columns: 71.25% 28.75%;}
#mainrow .main, #mainrow .sidebar {width:100%;}
}


	
@media (max-width: 539px) {
.ad-full-banner {min-height:90px;}
#myHeader  {
padding-top:5px;
border-top: 0px;position: relative;
top: -38px;}
#myHeader .brand-logo {display:block;}
#myHeader.stickymenu img{left:0;}
.stickymenu nav {width:100%;}
#navbarMenu {margin-top:50px;}
/*.sub-menu {display:none;}*/

.brand-logo{ z-index: 9999;  position: relative; }
	.sssp-resizeCont  iframe, .sssp-resizeCont  iframe {
    height: 300px !important; 
}
	}
</style>
</head>
