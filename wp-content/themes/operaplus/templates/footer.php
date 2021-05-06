<?php the_ad(309812); ?><footer class="content-info" role="contentinfo">
	<div class="container">
		<div class="row footer-items">
			<div class="col-md-4 footer-item">
				<h4 class="box-title">Užitečné informace</h4>
				<?php // WP_Query arguments
				$args = array(
					'post_type' => 'footer',
					'orderby' => 'menu_order'
				);

				// The Query
				$query = new WP_Query($args);

				echo '<ul>';
				// The Loop
				if ($query->have_posts()) {
					while ($query->have_posts()) {
						$query->the_post();
						$post = get_post();
							echo '<li><a href="'. get_permalink() .'">' .get_the_title(). '</a></li>';
						}
					}

				echo '</ul>';

				// Restore original Post Data
				wp_reset_postdata();
				?>
				</div><!-- /.footer-item-->

			<div class="col-md-4 footer-item">
				<h4 class="box-title">Archiv</h4>
				<ul>
					<li><a href="/archiv-clanku/jmenny-rejstrik/?filter=A">Jmenný rejstřík</a></li>
					<li><a href="/ptali-jste-se/">Ptali jste se</a></li>
					<li><a href="/archiv-clanku/dila/?filter=1">Díla</a></li>
					<li><a href="/archiv-clanku/serialy/">Seriály</a></li>
					<li><a href="/zpravy">Zprávy</a></li>
					<li><a href="/archiv-clanku/rozhovory/?filter=A">Rozhovory</a></li>
					<li><a href="/archiv-clanku/divadla-soubory-orchestry-festivaly/?filter=A">Divadla - soubory - orchestry - festivaly</a></li>
					<li><a href="/archiv-clanku/autori-clanku/?filter=A">Autoři článků</a></li>
				</ul>
			</div>
			
			<div class="col-md-4 footer-item">
				<h4 class="box-title">&nbsp;</h4><br>
<span id="fbiframe"></span>
				<script>
console.log("fb1");
jQuery( document ).ready(function() {
console.log("fb");
jQuery("#fbiframe").html('<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Foperapluscz%2F&tabs=timeline&width=340&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="100%" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>			</div>');
//jQuery("#fbiframe").html('<iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&width=62&layout=box_count&action=like&size=small&share=false&height=65&appId" width="62" height="65" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; ');
//jQuery("#fbiframe").html('<iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&width=450&layout=standard&action=like&size=small&share=true&height=35&appId" width="450" height="35" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>');
});

</script>
		</div>
		<p><small>&nbsp;</small> <br><br><br></p>
	</div>
</footer>

<?php if (is_single()) { ?>

<script defer async>
jQuery( document ).ready(function() {

(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/cs_CZ/sdk.js#xfbml=1&version=v2.4&appId=1608682716049457";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
});

</script>
<?php } ?>

<script efer async>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-27040447-1', 'auto');
        ga('send', 'pageview');
</script>
<script efer async>
//(function(){var w=window,C='___grecaptcha_cfg',cfg=w[C]=w[C]||{},N='grecaptcha';var gr=w[N]=w[N]||{};gr.ready=gr.ready||function(f){(cfg['fns']=cfg['fns']||[]).push(f);};(cfg['render']=cfg['render']||[]).push('onload');w['__google_recaptcha_client']=true;var d=document,po=d.createElement('script');po.type='text/javascript';po.async=true;po.src='https://www.gstatic.com/recaptcha/releases/nuX0GNR875hMLA1LR7ayD9tc/recaptcha__cs.js';var e=d.querySelector('script[nonce]'),n=e&&(e['nonce']||e.getAttribute('nonce'));if(n){po.setAttribute('nonce',n);}var s=d.getElementsByTagName('script')[0];s.parentNode.insertBefore(po, s);})();
</script>