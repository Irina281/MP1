<div class="author-panel packages-purchase">
	<div class="row">
		<?php
		if( !adifier_mandatory_profile_fields_populated() )
		{
			?>
			<div class="col-sm-12">
				<div class="alert-error">
					<?php 
						echo sprintf( 
							esc_html__( 'Go to your %s and populate mandatory fields in order to purchase', 'adifier' ), 
							'<a href="'.esc_url( add_query_arg( 'screen', 'profile', $author_url ) ).'">'.esc_html__( 'profile', 'adifier' ).'</a>'
						);
					?>
				</div>
			</div>
			<?php
		}
		else
		{
			$account_payment = adifier_get_option( 'account_payment' );
			$packs = adifier_get_packs( $account_payment );
			if( !empty( $packs ) ) {
				foreach( $packs as $key => $pack ){
					?>
					<div class="col-sm-3">
						<div class="white-block price-table">
							<div class="pt-title">
								<h5><?php echo esc_html( $pack['name'] ) ?></h5>
							</div>
							<div class="pt-price">
								<?php echo adifier_price_format( $pack['price'] ); ?>
								<?php adifier_tax_included(); ?>
							</div>						
							<div class="pt-content">
								<?php adifier_packs_message( $account_payment, $pack ); ?>
							</div>
							<a href="javascript:void(0);" class="af-button purchase-pack" data-pack="<?php echo esc_attr( $key ) ?>"><?php esc_html_e( 'Purchase Now', 'adifier' ) ?></a>
						</div>
					</div>
					<?php
				}
			}
		}		
		?>
	</div>
</div>