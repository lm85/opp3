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
    <?php remove_action('wp_head', 'rel_canonical');wp_head(); ?>
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

jQuery( document ).ready(function() {

$(window).scroll( function(){
    

        $('#nl-box').each( function(i){
            
            var bottom_of_object = $(this).offset().top + $(this).outerHeight();
            var bottom_of_window = $(window).scrollTop() + $(window).height();
            

            if( bottom_of_window > bottom_of_object ){
                
                $(this).animate({'opacity':'1'},2500);
                    
            }
            
        }); 
    
    });


if (jQuery(".tag #generated_padding p:first").length>0) {
//console.log("ole");
jQuery(".tag #generated").height(jQuery(".tag #generated_padding p:first").outerHeight(true)+1);
//jQuery(".tag #generated").addClass("pack");
jQuery(".tag #generated").after("<a href='#generated' class='sipka'> </a>");
jQuery(".tag #generated").slideDown(750);

jQuery(".tag #generated_padding p:first").append("&nbsp;&nbsp; <a href='#sipka3' class='sipka3' style='color:#4a90cb'>>> více</a>");

jQuery(".tag .sipka,.sipka3").click(function() {
//jQuery(".tag #generated_padding .sipka").hide();
//console.log(jQuery(".tag #generated").height());
if (!jQuery(".tag #generated").hasClass("pack")) {

    jQuery(".tag #generated").addClass("pack");
    jQuery(".sipka").toggleClass("sipka2");
    jQuery(".tag #generated").height(jQuery(".tag #generated_padding p:first").outerHeight(true)+1);
    jQuery(".sipka3").show();
}
else
{
    jQuery(".tag #generated").height("auto").slideDown(750);

    jQuery(".tag #generated").removeClass("pack");
    jQuery(".sipka").toggleClass("sipka2");
    jQuery(".sipka3").hide();

}
});
}else {jQuery(".tag #generated").css("border-bottom",0);}

var urlHash = window.location.href.split("#")[1];
   var target = window.location.hash;
   target = target.replace('#', '');
    hop(target);

$("a[href*='#']").click(function(event){
        //prevent the default action for the click event
        var full_url = this.href;


        var parts = full_url.split("#");

    if (parts==undefined) return;
    if (parts[1]=="art11") return;
    if (parts[0].includes("?pa=")) return;
    if (parts[1].includes("comme")) return;
        var trgt = parts[1];
        event.preventDefault();
    
hop(trgt);

});

function hop(trgt) {
    var target_offset = $("#"+trgt).offset();

    if (target_offset.top==undefined) return;


        var target_top = target_offset.top-80;

        $('html, body').animate({scrollTop:target_top}, 1500, 'easeInSine');


}


});//ready

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
nav.jps-slider-nav {float:none;}
.single-post main h2,
.tag main h2 {

font-weight: 700;
font-size: 1.25rem;
line-height: 1.375rem;
padding-bottom: 3px;
margin: 0;
}
.single-post main h3+p,.single-post main h3+p, .tag main h3+p:empty {margin:0}

.single-post main h3+p:empty+p, .tag main h3+p:empty+p, .single-post main h2+p, 
.tag main h2+p {margin:8px 0}

.single-post main h3, .tag main h3 {font-style:italic;font-size:15pt;margin-bottom:0px;}


.ad-square {min-height:1px}
#nl-box {
border-width: 1px;
border-color: #ffb04f;
border-style: solid;
box-shadow: 10px 10px 10px gray;
width: 80%;
margin: auto;
margin-top:15px;
padding:10px;
opacity:0;
/*display:NONE;*/
}

#nl-box p, #nl-box form {display:inline-block;}



.content-page h2, .content-page h3, .content-page h4, .content-page h5, .content-page h6, .content-post h2, .content-post h3, .content-post h4, .content-post h5, .content-post h6 {
    margin-top: 3px;
}

.content-page p, .content-post p {
    font-size: 14pt;
margin-bottom:5px;
}

.content-post h4 {
    font-style: italic;
    font-weight: bold;
    font-size: 14pt;
}



.ad-square {min-height:1px}
.brand-social svg {
height: 34px;
width: 34px;
margin: 2px;}
.enflag:hover svg#Layer_3 circle{fill:#fff!important}
.enflag:hover svg path,.enlag:hover svg g path{fill:#3f3d38!important}

.cpwp-wrap-text-stage .catp-post-title, .cpwp-wrap-text-stage  .cpwp-excerpt-text.cpwp-wrap-text {
display:block;float:none;clear:both;}

#category-posts-2-internal .cat-post-current .cat-post-title {text-transform: none;}

.cpwp-wrap-text-stage #category-posts-2-internal .cat-post-thumbnail
{text-align:center}

#category-posts-2-internal .cat-post-thumbnail {float:none;}
#category-posts-2-internal .cat-post-title {font-weight:bold;}

.cpwp-wrap-text-stage img
{
margin:auto !important;
float:none;}
.widget.category-posts-2.cat-post-widget {padding-bottom: 5px;border-bottom::1px solid grey;}

[class*="advads-"] {
    padding: 0px;}
.widget.anniversary div > a, .widget.anniversary div img {margin-right:10px !important}
@media not print {
img.decoded { background: none!important; }
}
.brand img {height:48px;}

#cc-window.cc-floating {    min-width: 100%;    height: 100%;    padding-top: 25%;
background:rgba(0,0,0,0.5);z-index:9999999;
}
.cc-window.cc-floating .cc-compliance {flex:none;}
#cc-window.cc-type-categories.cc-floating .cc-compliance .cc-save,#cc-window.cc-type-categories.cc-floating .cc-compliance .cc-dismiss, #cc-window  .cc-btn {width:80% !important;
margin:5px auto !important;border:1px solid !important;min-width:80% !important;float:none;clear:both;}
#cc-window.cc-type-categories.cc-floating.cc-theme-edgeless div,
#cc-window.cc-type-categories.cc-floating.cc-theme-edgeless
 .cc-message,.cc-message,  .cc-compliance {background:#FFF;margin-bottom:0;width: 70%;
padding-top: 20px;
padding-bottom: 20px;
margin-left: auto;
margin-right: auto;}
 .cc-message {text-align:center}
#wpd-post-rating {justify-content: left;}
#wpd-post-rating .wpd-rating-wrap .wpd-rating-right,#wpd-post-rating .wpd-rating-wrap .wpd-rating-left,.wpd-rating-value {display:none;}
.content-page ul, .content-page ol, .content-post ul, .content-post ol {
    color: #544f4a;
    font-size: 1.1em;}
#wpdcom .wpd-thread-filter .wpd-filter,#wpdcom .wpd-thread-head {border-bottom: 2px solid #ffb04fa8;}
#wpdcom .wpd-blog-subscriber .wpd-comment-author, #wpdcom .wpd-blog-subscriber .wpd-comment-author a {color:#ffb04fa8;}
.sidebar {border-left: 1px solid #ffb04fa8;}

/*.violin {border-top:1px solid #DDD;}*/
.box .box-content-title {margin-top:5px !important;}
.content-page p, .content-post p {font-size:14pt}
.content-post h3 {font-weight:bold;}
main h3,.content-post h3 {font-size:16pt;/*margin-top:30pt;padding-bottom:16pt;*/}
.content-post h2 {font-size:18pt;margin-top:30pt;font-weight:bold;}
.content-post h1 {font-weight:bold;font-size: 2.45rem;justify-content: center;}
.content-post h2+h3  {margin-top:18pt}
p:empty {display:none;}



.nav li+li a { margin-top:0;border-bottom:0};
.nav li a {border-bottom:0px !important}
.center{margin-right:auto;margin-left:auto;}
.box .box-image a img {margin-bottom:12px;	}
.sfcr {    height: 90px !important;     width: auto;     margin-top: 25px;     float: none !important;}

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

.row-header {display: grid;}
.brand {text-align:left;}
.row-header .brand-logo {grid-column-start: 1;grid-column-end: 2;width:auto;float:none;}
.row-header .right_header {grid-column-start: 3;grid-column-end: 4;text-align: right;}

#wpdcom .wpd-thread-head .wpd-thread-info {border-bottom:1px solid #ffb04f}

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
.brand-title {border:0;padding-left: 21px;padding-top:0;}
.brand-title {text-align:left;padding-bottom: 4px;}
/*.brand-logo {width:61%}*/
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
.stickyimg {height:45px;display:inline-block;float:left}

#myHeader .brand-logo {display:none;}
#myHeader img {display:none !important}

.nav li a {font-weight:bold;}
.main  {padding-top:15px;}
#myHeader  {border-bottom: 1px solid #ffb04fa8;border-top: 1px solid #ffb04fa8;margin:0px auto 0 auto;}

.header {margin-bottom:0;}

.tag #generated {overflow:hidden;height:0;border-bottom:2px solid #ffb04f;}
.tag #generated #generated_padding p:first-child {font-weight:bold;font-size: 1.2em;}
.tag .sipka {content:'\25BC';font-size:150%;position:relative;left:47%;top:-2px;text-decoration:none;}
.tag .sipka:after {content:'\25BC';color:#ffb04f}
.tag .sipka2:after {content:'\25B2';color:#ffb04f}
.tag #generated a {color: rgb(74, 144, 203);}

.enflag:hover svg#Layer_3 circle{fill:#fff!important}
      
.enflag:hover svg path,.enlag svg g path{fill:#3f3d38!important}

.ad-full-banner, .ad-leaderboard {
    min-height: 60px;
    
}
@media (min-width: 960px) {
.nav li a {border-bottom:0}
main .ad-full-banner {margin-bottom:30px;}
}

@media (min-width: 801px)
{



/*.brand img {height:auto;}*/
#mainrow { display: grid;grid-template-columns: 71.25% 28.75%;}
#mainrow .main, #mainrow .sidebar {width:100%;}
}

#partneri td {width:50% !important;height:auto}
#partneri td {text-align:center;}
    



@media (max-width: 539px) {
/*.wrap {margin-top:-14px}*/
/*.header {height:151px}*/
#wpdcom .wpd-thread-filter .wpd-filter,#wpdcom .wpd-thread-head {border-bottom:0}
/*.ad-full-banner {min-height:90px;}*/
.ad-full-banner, .ad-leaderboard {
    min-height: 30px;
}

#myHeader  {
padding-top:5px;
border-top: 0px;
/*position: relative;*/
padding-bottom: 5px;
margin-top: -45px;}
#myHeader .brand-logo {display:block;}
#myHeader.stickymenu img{left:0;}
.stickymenu nav {width:100%;}
#navbarMenu {margin-top:50px;}
/*.sub-menu {display:none;}*/
.brand-logo {width:71% !important}
.brand-logo{ z-index: 9999;  position: relative; }
    .sssp-resizeCont  iframe, .sssp-resizeCont  iframe {
    height: 300px !important; 
}
    }
@media (max-width: 420px) {
#myHeader .brand-logo {display:none;}
.brand img,
.brand-logo {width:90% !important;height:auto;}
.brand-logo a {width:260px;}

}
@media (max-width: 321px) {
#myHeader .brand-logo {display:none;}
.brand img,
.brand-logo {width:90% !important;height:auto;}
.brand-logo a {width:210px;}

}
</style>
<!-- Hotjar Tracking Code for https://operaplus.cz -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:2215721,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
</head>

