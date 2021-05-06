<form role="search" method="get" class="search-form form-inline" action="<?= esc_url(home_url('/')); ?>">
	<div class="input-group">
		<input type="search" value="<?= get_search_query(); ?>" name="s" class="search-field form-control" placeholder="Vyhledat" required>
		<span class="input-group-addon">
			<button type="submit" class="search-submit"><span>Vyhledat</span><i class="icon-search"></i></button>
		</span>
	</div>
</form>
