<?php
include( 'lib/csc_curl.php' );

$c = new curl;
if ( $_csc->format != 'dev' ) header( 'Content-Type: application/json' );
$_opt = $_csc->uri[4] ? explode( '-', $_csc->uri[4] ) : null;

if ( $_csc->uri[2] == 'tweetsearch' || $_csc->uri[2] == 'tweet' ) {
	$_url = 'https://twitter.com';

	if ( $_csc->uri[3] ) {
		if ( $_csc->uri[4] ) {
			$first = $_opt[1];
			$end = $_opt[0];
			$rand =
				'BD1UO2FFu9QAAAAAAAAETAAAAAcAAAASAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
				'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA' .
				'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'
				;

			$u = $_csc->uri[2] == 'tweet'
			?
				$_url .
				'/i/profiles/show/' . $_csc->uri[3] .
				'/timeline/tweets' .
				'?include_available_features=1' .
				'&include_entities=1&last_note_ts=231' .
				'&max_position=' . $_csc->uri[4] .
				'&oldest_unread_id=0' .
				'&reset_error_state=false'

			:
				$_url .
				'/i/search/timeline' .
				'?vertical=default' .
				'&q=' . str_replace( '+', '%20', $_csc->uri[3] ) .
				'&include_available_features=1' .
				'&include_entities=1&last_note_ts=1316' .
				'&max_position=TWEET-' . $end . '-' . $first . '-' . $rand .
				'&reset_error_state=false'
			;
			//'https://twitter.com/i/search/timeline?vertical=default&q=bingung%20kuliah&src=typd&composed_count=0&include_available_features=1&include_entities=1&include_new_items_bar=true&interval=30000&last_note_ts=556&latent_count=1&min_position=TWEET-760088988048850944-763433049979695104-BD1UO2FFu9QAAAAAAAAETAAAAAcAAAASAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'
			//'https://twitter.com/i/search/timeline?vertical=default&q=bingung%20kuliah&src=typd&include_available_features=1&include_entities=1&last_note_ts=571&max_position=TWEET-725195855846846465-763387211748225024-BD1UO2FFu9QAAAAAAAAETAAAAAcAAAASAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA&reset_error_state=false'

			$i = json_decode( file_get_contents( $u ) );
			$Arr['continued'] = $i->has_more_items;
			$Arr['min_position'] = $i->min_position;
			$c->bc = $i->items_html;

		} elseif ( $_csc->uri[2] == 'tweet' ) {
			$c->bc = $c->get( $_url . '/' . $_csc->uri[3] );
			$Arr['bio'] = strip_tags( $c->xp( "<p class=\"ProfileHeaderCard-bio u-dir\"\n      \n      dir=\"ltr\">", '</p>' ) );
			$Arr['min_position'] = $c->xp( 'data-min-position="', '"' );
			$Arr['continued'] = $Arr['min_position'] ? true : false;

		} else $c->bc = $c->get( $_url . '/search?q=' . str_replace( '+', '%20', $_csc->uri[3] ) );

		for ( $x=1; $x<=20; $x++ ) { $y = $x-1;
			$li = $c->xp( '<li class="js-stream-item stream-item stream-item', '</li>', $x );
			if ( ! $li ) break;
			$Arr['tweet'][$y]['id'] = $c->xp( 'data-tweet-id="', '"', $li );
			$Arr['tweet'][$y]['lokasi'] = $c->xp( '<span class="Tweet-geo u-floatRight js-tooltip" title="', '"', $li );
			$Arr['tweet'][$y]['oleh'] = $c->xp( 'profile-link js-nav" href="/', '"', $li );
			$Arr['tweet'][$y]['tweet'] = trim( strip_tags( $c->xp( '<div class="js-tweet-text-container">', '</div>', $li ) ) );
			$Arr['tweet'][$y]['waktu'] = $c->xp( 'data-time="', '"', $li );
		}

	} else $Arr['error'] = 'Include the second argument.';

} elseif ( $_csc->uri[2] == 'tweetfollower' ) {
	$_url = 'https://twitter.com';
	if ( $_csc->uri[3] == 'login' ) {
		$c->bc = $c->get( $_url );
		$token = $c->xp( 'name="authenticity_token" value="', '"' );

		$array = array(
			//'session[username_or_email]' => 'kp@harun.id',
			'session[username_or_email]=buatkp',
			'session[password]=xDR1TC5sTDWE09rySCs5u7BZYRkKXmti',
			'return_to_ssl=true',
			'scribe_log=',
			'redirect_after_login=%2F',
			'authenticity_token=' . $token			
		);

		//echo $c->post( $_url . '/sessions', implode( '&', $array ) );
		
	} elseif ( $_csc->uri[3] ) {
		if ( $_csc->uri[4] ) {
			$o = 'followers/users?include_available_features=1&include_entities=1&max_position=' . $_csc->uri[4] . '&reset_error_state=false';
			$c->bc = $c->get( $_url . '/' . $_csc->uri[3] . '/' . $o );
			$json = json_decode( $c->bc );
			$Arr['min_position'] = $json->min_position;
			$Arr['has_more_items'] = $json->has_more_items;
			$c->bc = $json->items_html;

		} else {
			$c->bc = $c->get( $_url . '/' . $_csc->uri[3] . '/followers' );
			$Arr['min_position'] = $c->xp( 'data-min-position="', '"' );
			$follower = $c->xp( 'js-tooltip js-nav" title="', ' Followers"' );
			$Arr['has_more_items'] = str_replace( ',', '', $follower ) > 18 ? true : false;
		}

		if ( ! $Arr['min_position'] ) $Arr['has_more_items'] = false;
		for ( $x=1; $x<=18; $x++ ) {
			$li = $c->xp( '<div class="ProfileCard-content">', '</span>', $x );
			if ( ! $li ) break;
			$Arr['follower'][$x-1]['id'] = $c->xp( 'data-user-id="', '"', $li );
			$Arr['follower'][$x-1]['name'] = $c->xp( 'title="', '"', $li );
			$Arr['follower'][$x-1]['link'] = ltrim( $c->xp( 'href="', '"', $li ), '/' );
		}

	} else $Arr['error'] = 'Include the second argument.';

} elseif ( $_csc->uri[2] == 'instasearch' ) {
	$_url = 'https://www.instagram.com';

	if ( ! $_csc->uri[4] ) {
		$c->bc = $c->get( $_url . '/' . $_csc->uri[3] . '/' );
		$x = 1;
		$json = json_decode( $c->xp( '<script type="text/javascript">window._sharedData = ', ';</script>' ) );
		foreach ( $json->entry_data->ProfilePage[0]->user->media->nodes as $r ) {
			$y = $x-1;
			$Arr['photo'][$y]['code'] = $r->code;
			$Arr['photo'][$y]['waktu'] = $r->date;
			$Arr['photo'][$y]['caption'] = $r->caption;
			$Arr['photo'][$y]['display_src'] = $r->display_src;
			$x++;
		}

	} else {
		$c->bc = $c->get( $_url . '/p/' . $_csc->uri[4] . '/' );
		$x = 1;
		$json = json_decode( $c->xp( '<script type="text/javascript">window._sharedData = ', ';</script>' ) );
		foreach ( $json->entry_data->ProfilePage[0]->user->media->nodes as $r ) {
			$y = $x-1;
			$Arr['photo'][$y]['code'] = $r->code;
			$Arr['photo'][$y]['waktu'] = $r->date;
			$Arr['photo'][$y]['caption'] = $r->caption;
			$x++;
		}
		

	}

} elseif ( $_csc->uri[2] == 'facebook' ) {
	if ( $_csc->uri[3] == 'login' ) {
		$c->bc = $c->get( 'https://www.facebook.com' );
		$lgnrnd = $c->xp( 'name="lgnrnd" value="', '"' );
		$lsd = $c->xp( 'name="lsd" value="', '"' );

		$array = array(
			'lsd' => $lsd,
//			'email' => 'kp@harun.id',
//			'pass' => 'xDR1TC5sTDWE09rySCs5u7BZYRkKXmti',
//			'email' => 'xigojagoja@extremail.ru',
//			'pass' => 'kxYALxSM2hxx8UC6mxNfSXh19MRnzdEK',
//			'email' => 'rufinucgfgffgf@extremail.ru',
//			'pass' => 'hoahoahoa',
//			'email' => 'banebone@kismail.ru',
//			'pass' => 'AWkh9fQwmWfmF7Tk61xen5nkxprR50Jw',
//			'email' => 'nanonaqua@divismail.ru',
//			'pass' => 'FmNFOCHCHZFaCxkCMLX07uExUd3MkLXR',
			'email' => 'm.patten12@divismail.ru',
			'pass' => 'XUhZEreheaATf8edyR23mjFXxT2J6DFS',
			'persistent' => 1,
			'default_persistent' => 1,
			'lgnrnd' => $lgnrnd,
			'locale' => 'en_GB'
		);

		echo $c->post( 'https://m.facebook.com/login.php', $array );

	} elseif( $_csc->uri[3] == 'friends' ) {
		$start = $_GET['p'] ?: 1;
		$_url = 'https://m.facebook.com';
		$c->bc = $c->get( $_url . '/' . $_GET['q'] . '?v=friends&startindex=' . $start );
		for ( $x=1; $x<=40; $x++ ) {
			$friend = $c->xp( '<td class="u r">', '</a>', $x );
			if ( $friend ) {
				$table = $c->xp( '<table class="k">', '</table>', $x+1 );
				$Arr['friend'][$x-1]['name'] = strip_tags( $friend );
//				$Arr['friend'][$x-1]['sub'] =  strip_tags( $c->xp( '<div class="cc cd">', '</div>', $x ) );
				$Arr['friend'][$x-1]['sub'] =  strip_tags( $c->xp( '<div class="bl bm">', '</div>', $x ) );
				$idnya = $c->xp( '<a class="bk" href="/', '?', $table );
				$Arr['friend'][$x-1]['link'] = $idnya == 'profile.php' ? $c->xp( '<a class="bk" href="/profile.php?id=', '&', $table ) : $idnya;
			}
		}
		$Arr['next'] = (int) $c->xp( 'startindex=', '"' );
		$Arr['total'] = (int) str_replace( ',', '', $c->xp( '<h3 class="bf h">Friends (', ')' ) );
//		echo $c->bc;

	} else {
		$_url = 'https://www.facebook.com';
		$c->bc = $c->get( $_url . '/' . $_GET['q'] );
		$Arr['nama'] = $c->xp( '<strong class="bp">', '</strong>' );
		
		for ( $x=1; $x<=10; $x++ ) {
			$opt = $c->xp( '<span class="bo bq">', '</span>', $x );
			if ( $opt ) $Arr['bq'][$x-1] = strip_tags( $opt );
			else break;
		}

		for ( $x=1; $x<=10; $x++ ) {
			$opt = $c->xp( '<span class="da db ci dc">', '</span>', $x );
			if ( $opt ) $Arr['work'][$x-1] = strip_tags( $opt );
			else break;
		}

		$Arr['location'] = strip_tags( $c->xp( '<div class="dn">', '</div>' ) );

	}

} elseif ( $_csc->uri[2] == 'geo' ) {
	$i = $_csc->uri[3];
	$json = apiJson( 'http://maps.google.com/maps/api/geocode/json?address=' . $i . '&sensor=false' );
	$Arr['name'] = $json->results[0]->formatted_address;
	$Arr['location'] = $json->results[0]->geometry->location;

} elseif ( $_csc->uri[2] == 'tw3' ) {
	$f = $db->r( 'mhs_bot', 'id,nama,twitter', 'WHERE udah<1 AND twitter!="" ORDER BY RAND() LIMIT 5' );
	foreach ( $f as $r ) {
		$Arr['twitter'][] = $r;
	}

} elseif ( $_csc->uri[2] == 'tw4' ) {
	$f = $db->r( 'mhs_bot', '*', 'WHERE twitter != "" AND c_t<1 ORDER BY RAND() LIMIT 5' );
	foreach ( $f as $r ) {
		$Arr['twitter'][] = $r;
	}

} else $Arr['error'] = 'Include the first argument.';

if ( $_csc->format == 'dev' ) echo $c->bc;
else echo json_encode( $Arr );