<div class="wrap">
	<h2><?php esc_html_e( 'Messages', 'adifier' ) ?> </h2>

	<?php echo !empty( $message ) ? $message : ''; ?>

	<form id="posts-filter" method="post" action="<?php echo esc_url( add_query_arg(null, null) ); ?>">

		<div class="tablenav top">
			<div class="alignleft actions bulkactions">
				<label for="bulk-action-selector-top" class="screen-reader-text"><?php _e( 'Select bulk action', 'adifier' ) ?></label>
				<select name="action" id="bulk-action-selector-top">
					<option value="" selected="selected"><?php _e( 'Bulk Actions', 'adifier' ) ?></option>
					<option value="delete"><?php _e( 'Delete', 'adifier' ) ?></option>
				</select>
				<input type="submit" id="doaction" class="button action" value="Apply">
			</div>
			<br class="clear">
		</div>
		<table class="wp-list-table widefat fixed striped posts">
			<thead>
				<tr>
					<td scope="col" id="cb" class="manage-column column-cb check-column" style="">
						<label class="screen-reader-text" for="cb-select-all-1"><?php _e( 'Select All', 'adifier' ) ?></label>
						<input id="cb-select-all-1" type="checkbox">
					</td>
					<td scope="col" id="title" class="manage-column column-date" style="">
						<?php esc_html_e( 'From', 'adifier' ) ?>
					</td>
					<td scope="col" id="title" class="manage-column column-title column-primary" style="">
						<?php esc_html_e( 'Message', 'adifier' ) ?>
					</td>
					<td scope="col" id="title" class="manage-column column-date" style="">
						<?php esc_html_e( 'Date', 'adifier' ) ?>
					</td>
				</tr>
			</thead>

			<tbody id="the-list">
				<?php
				if( !empty( $messages ) ){
					foreach( $messages as $message ){
						?>
						<tr class="hentry alternate">
							<th scope="row" class="check-column">
								<input id="cb-select-<?php echo esc_attr( $message->message_id ) ?>" type="checkbox" name="message_ids[]" value="<?php echo esc_attr( $message->message_id ) ?>">
								<div class="locked-indicator"></div>
							</th>
							<td class="manage-column column-date">
								<a href="<?php echo esc_url( get_author_posts_url( $message->source_id ) ) ?>" target="_blank" class="message-admin-from">
									<?php echo get_avatar( $message->source_id, 50 ); ?>
									<?php echo get_the_author_meta( 'display_name', $message->source_id ); ?>
								</a>
							</td>
							<td class="title column-title column-primary page-title">
								<?php echo stripslashes( $message->message ) ?>
							</td>
							<td class="manage-column column-date">
								<?php echo date_i18n( get_option('date_format'), $message->created ) ?>
								<br />
								<?php echo date_i18n( get_option('time_format'), $message->created ) ?>
							</td>
						</tr>
						<?php
					}
				}
				else{ ?>
					<tr class="no-items">
						<td class="colspanchange" colspan="4">
							<?php _e( 'No messages found.', 'adifier' ) ?>
						</td>
					</tr>				
				<?php 
				}
				?>
			</tbody>

		</table>
		<input type="hidden" name="active_con_id" value="<?php echo esc_attr( $_GET['con_id'] ) ?>">
		<?php wp_nonce_field( 'adifier_nonce', 'adifier_nonce' ); ?>
	</form>
	<br class="clear">
</div>