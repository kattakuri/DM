add_filter( 'comment_form_defaults', 'bourncreative_custom_comment_form' );
function bourncreative_custom_comment_form($fields) {
	$fields['comment_notes_before'] = ''; 
        $fields['title_reply'] = __( 'Ingin Bertanya ?', 'customtheme' );
	$fields['label_submit'] = __( 'Kirim Komentar', 'customtheme' ); 
	$fields['comment_notes_after'] = '';
    return $fields;
}

function wpsites_modify_text_before_comment_form($arg) {
    $arg['comment_notes_before'] = '<p class="comment-notes">' . __( 'Tulis pesan mu pada kolom di bawah ini, kami akan segera membalas nya' ) . '</p>';
    return $arg;
}

add_filter('comment_form_defaults', 'wpsites_modify_text_before_comment_form');

add_filter( 'comment_form_default_fields', 'youruniqueprefix_modify_comment_author_email_url_labels' );
function youruniqueprefix_modify_comment_author_email_url_labels( $fields ) {
	$commenter = wp_get_current_commenter();
	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$args = wp_parse_args( $args );
	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
	$html5    = 'html5' === $args['format'];
	$fields   =  array(
		'author' => '<p class="comment-form-author">' . '<i class="fa fa-user"></i> <label for="author">' . __( 'Nama' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><i class="fa fa-envelope"></i> <label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		            '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		'url'    => '<p class="comment-form-url"><i class="fa fa-link"></i> <label for="url">' . __( 'Website' ) . '</label> ' .
		            '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
	);
	return $fields;
}

add_filter( 'comment_form_defaults', 'youruniqueprefix_change_comment_label' );
function youruniqueprefix_change_comment_label( $args ) {
	$args['comment_field'] = '<p class="comment-form-comment"><i class="fa fa-comment"></i> <label for="comment">' . _x( 'Komentar', 'noun' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';
	return $args;
}
