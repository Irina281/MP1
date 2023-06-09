<?php
/*
* Get packages
*/
if( !function_exists('adifier_get_packs') ){
function adifier_get_packs( $pack, $include_free = false ){
	$packages = adifier_get_option( $pack );
	$tax = adifier_get_option( 'tax' );
	$packs = array();
	$descriptions = array(
		'Get %s ads with this package',
		'Buy this package and get %s ads',
		'Purchase this package to receive %s ads',
		'Top up your account with %s ads using this package'
	);
	if( $include_free === true ){
		if( $pack == 'packages' ){
			$free = adifier_get_option( 'package_free_ads' );
			if( !empty( $free ) ){
				$packs[] = array(
					'name'		=> esc_html__( 'Free', 'adifier' ),
					'price'		=> '-',
					'adverts'	=> $free
				);
			}
		}
		else if( $pack == 'subscriptions' ){
			$free = adifier_get_option( 'subscription_free_time' );
			if( !empty( $free ) ){
				$packs[] = array(
					'name'		=> esc_html__( 'Free', 'adifier' ),
					'price'		=> '-',
					'days'		=> $free
					
				);
			}
		}
		else if( $pack == 'hybrids' ){
			$free = adifier_get_option( 'hybrid_free_stuff' );
			if( !empty( $free ) ){
				$temp = explode( '|', $free );
				$packs[] = array(
					'name'		=> esc_html__( 'Free', 'adifier' ),
					'price'		=> '-',
					'adverts'	=> !empty( $temp[0] ) ? $temp[0] : '',
					'days'		=> !empty( $temp[1] ) ? $temp[1] : ''
				);
			}
		}
	}
	if( !empty( $packages ) ){
		$packages = explode( '+', $packages );
		foreach( $packages as $package ){
			$temp = explode( '|', $package );
			$price = $pack == 'hybrids' ? $temp[3] : $temp[2];
			$packs[] = array(
				'name'		=> $temp[0],
				'price'		=> !empty( $tax ) ? $price * ( 1 + $tax/100 ) : $price,
			);
			if( $pack == 'packages' ){
				$packs[sizeof( $packs )-1]['adverts'] = $temp[1];
			}
			else if( $pack == 'subscriptions' ){
				$packs[sizeof( $packs )-1]['days'] = $temp[1];	
			}
			else if( $pack == 'hybrids' ){
				$packs[sizeof( $packs )-1]['adverts'] = $temp[1];
				$packs[sizeof( $packs )-1]['days'] = $temp[2];	
			}
		}
	}
	return $packs;
}




/*
* Create text for pricing tables
*/
if( !function_exists('adifier_packs_message') ){
	function adifier_packs_message( $account_payment, $pack ){
		if( $account_payment == 'packages' ){
			if( $pack['price'] == '-' ){
				echo sprintf( __( 'Create your account now and receive <b>%s</b> ads as a welcome gift', 'adifier'), $pack['adverts'] );
			}
			else {
				echo sprintf( __( 'With this package you can post ads on marketplace, promote your ads, have detailed analytics, easily buy and sell, get access to user-oriented dashboard', 'adifier'), $pack['adverts'] );
			}
		}
		else if( $account_payment == 'subscriptions' ){
			if( $pack['price'] == '-' ){
				if( stristr( $pack['days'], '+' ) ){
					$time = str_replace( '+', '', $pack['days'] );
					$period = $time == 1 ? esc_html__( 'hour', 'adifier' ) : esc_html__( 'hours', 'adifier' );
				}
				else{
					$time = $pack['days'];
					$period = $time == 1 ? esc_html__( 'day', 'adifier' ) : esc_html__( 'days', 'adifier' );
				}
	
				echo sprintf( __( 'Create your account and get <b>%s</b> %s subscription as a welcome gift', 'adifier'), $pack['days'], $pack['days'] == 1 ? esc_html__( 'day', 'adifier' ) : esc_html__( 'days', 'adifier' ) );
			}
			else if ( $pack['price'] == '12' ){
				echo sprintf( __( 'With this package you can post ads on marketplace, promote your ads, have detailed analytics, easily buy and sell, get access to user-oriented dashboard', 'adifier'), $pack['days'] );
			}
			else if ( $pack['price'] == '24' ){
				echo sprintf( __( 'With this package you receive all benefits of first package and become our partner. You will get separate page which will include one image and description', 'adifier'), $pack['days'] );
			}
			else if ( $pack['price'] == '48' ){
				echo sprintf( __( 'With this package you receive all benefits of second package. You will get separate page which will include five images, video and detailed description', 'adifier'), $pack['days'] );
			}
			else if ( $pack['price'] == '72' ){
				echo sprintf( __( 'With this package you receive all benefits of third package. You will get separate page which will include page fully customized for you and premium support'), $pack['days'] );
			}
		}
	

	
	else if( $account_payment == 'hybrids' ){
		if( $pack['price'] == '-' ){
			if( stristr( $pack['days'], '+' ) ){
				$time = str_replace( '+', '', $pack['days'] );
				$period = $time == 1 ? esc_html__( 'hour', 'adifier' ) : esc_html__( 'hours', 'adifier' );
			}
			else{
				$time = $pack['days'];
				$period = $time == 1 ? esc_html__( 'day', 'adifier' ) : esc_html__( 'days', 'adifier' );
			}
			
			echo sprintf( __( 'Create your account now and get <b>%s</b> %s to submit <b>%s</b> ads as a welcome gift', 'adifier'), $time, $period, $pack['adverts'] );
		}
		else{
			echo sprintf( __( 'Purchase this package and top up your account with <b>%s</b> days to submit <b>%s</b> ads', 'adifier'), $pack['days'], $pack['adverts'] );
		}
	}
}
}
}
?>

