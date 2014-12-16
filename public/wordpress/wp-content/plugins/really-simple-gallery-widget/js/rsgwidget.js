jQuery(document).ready(function($){
	$('body').on('change', '.rsgw_from_options', function(e){
		var t = $(this);

		t.siblings('span').hide();

		if ( 'post' === t.val() )
			t.siblings('.post_id_option').show();
		else if ( 'ids' === t.val() )
			t.siblings('.att_ids_option').show();
	});

	$('body').on('change', '.rsgw_orderby_options', function(e){
		var t = $(this);

		if ( 'rand' === t.val() )
			t.siblings('.rsgw_order_option').hide();
		else
			t.siblings('.rsgw_order_option').show();
	});

	$('body').on('click', '.toggle', function(e){
		e.preventDefault();
		$(this).parent().next().toggle();
	});
});
