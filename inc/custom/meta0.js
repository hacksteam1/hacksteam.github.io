function ctlow(tp){
	switch(tp){
		case '1':
			$('div.ct_filmes').addClass('d_fall');
			$('div.ct_series').removeClass('d_fall');
			$('div.ct_tv').removeClass('d_fall');
			break;
		case '2':
			$('div.ct_series').addClass('d_fall');
			$('div.ct_filmes').removeClass('d_fall');
			$('div.ct_tv').removeClass('d_fall');
			break;
			case '3':
			$('div.ct_tv').addClass('d_fall');
			$('div.ct_filmes').removeClass('d_fall');
			$('div.ct_series').removeClass('d_fall');
			break;
	}
}