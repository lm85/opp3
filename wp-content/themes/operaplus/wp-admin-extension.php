<?php
add_action ( 'admin_menu', 'register_competition_submenu' );
function register_competition_submenu() {
	//TODO use translations
	$submenuTitle = __ ( 'Competition list', 'wp-admin-extension' );
	$submenuTitle = 'Výpis odpovědí na souteže';
	add_submenu_page ( 'edit.php?post_type=soutez', $submenuTitle, $submenuTitle, 'read_private_posts', 'competition-responses-list', 'competition_list_callback' );
}
function competition_list_callback() {
	echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
	//TODO use translations
	$submenuTitle = __ ( 'Competition list', 'wp-admin-extension' );
	$submenuTitle = 'Výpis odpovědí na souteže';
	echo "<h2>$submenuTitle</h2>";
	echo "<form method='GET'>";
	echo "<select name='competition' id='competition'>";
	$competitions = get_posts ( 'post_type=soutez' );
	$selected = isset($_GET ['competition'])? $_GET ['competition'] : null;
	if($selected === null) {
		echo "<option></option>";
	}
	foreach ( $competitions as $competation ) {
		$selectedAttr = '';
		if($selected == $competation->ID) {			
			$selectedAttr = 'selected';
		}
		echo "<option $selectedAttr value='{$competation->ID}'>{$competation->post_title}</option>";
	}
	echo "</select>";
	echo "</form>";
	echo '</div>';
	
	$filter = isset ( $_GET ['competition'] ) ? sprintf ( 'filter="post_id=%s"', $_GET ['competition'] ) : '';
	$grid = apply_filters ( 'the_content', '[cfdb-table form="odpoved" show="Submitted,jmeno,email,adresa,odpoved,poznamka" ' . $filter . ']' );
	echo $grid;
	
	// TODO use WP templating, awful spagethi
	echo "<script type='text/javascript'>
		jQuery('#competition').on('change',function(event){
 			var val = jQuery('#competition').val();
			var url = location.href.replace(/&{0,1}competition=[^&]*/,'');
			location.href = url + '&competition=' + val;
		});
	</script>";	
}

add_action ( 'admin_menu', 'register_questions_submenu' );
function register_questions_submenu() {
	//TODO use translations
	$submenuTitle = __ ( 'Questions list', 'wp-admin-extension' );
	$submenuTitle = 'Výpis "zeptejte se"';
	add_submenu_page ( 'edit.php?post_type=zeptejte_se', $submenuTitle, $submenuTitle, 'read_private_posts', 'questions-responses-list', 'questions_list_callback' );
}
function questions_list_callback() {
	echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
	//TODO use translations
	$submenuTitle = __ ( 'Questions list', 'wp-admin-extension' );
	$submenuTitle = 'Výpis "zeptejte se"';
	echo "<h2>$submenuTitle</h2>";
	echo "<form method='GET'>";
	echo "<select name='question' id='question'>";
	$questions = get_posts ( 'post_type=zeptejte_se' );
	$selected = isset($_GET ['question'])? $_GET ['question'] : null;
	if($selected === null) {
		echo "<option></option>";
	}
	foreach ( $questions as $question ) {
		$selectedAttr = '';
		if($selected == $question->ID) {
			$selectedAttr = 'selected';
		}
		echo "<option $selectedAttr value='{$question->ID}'>{$question->post_title}</option>";
	}
	echo "</select>";
	echo "</form>";
	echo '</div>';

	$filter = isset ( $_GET ['question'] ) ? sprintf ( 'filter="post_id=%s"', $_GET ['question'] ) : '';
	$grid = apply_filters ( 'the_content', '[cfdb-table form="zeptejte_se" show="Submitted,jmeno,email,adresa,odpoved,poznamka" ' . $filter . ']' );
	echo $grid;

	// TODO use WP templating, awful spagethi
	echo "<script type='text/javascript'>
		jQuery('#question').on('change',function(event){
 			var val = jQuery('#question').val();
			var url = location.href.replace(/&{0,1}question=[^&]*/,'');
			location.href = url + '&question=' + val;
		});
	</script>";
}