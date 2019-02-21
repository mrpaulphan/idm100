<?php
/**
 * Comments Template
 */
if (post_password_required()) {
	return;
}

$bifrost_comments_args = array(
    'style'        => 'div',
	'callback'     => 'bifrost_comments_open',
	'end-callback' => 'bifrost_comments_close'
);

$bifrost_comment_form =  array(
    'logged_in_as' => null,
    'comment_notes_before' => null,
    'title_reply_before' => '<h4 id="reply-title" class="o-comments__title d-flex align-items-center">',
    'title_reply_after' => '</h4>',
    'title_reply' => 'Leave a Reply',
    'submit_button' => '<div class="o-comments__form__submit d-flex"><div class="ml-auto"><input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" /></div></div>',
    'comment_field' => "<div class='o-comments__form__textarea row'><div class='col-12'><textarea placeholder=". esc_attr__('Comment', 'bifrost') ." type='text' name='comment' aria-required='true'/></textarea></div></div>",
    'fields' => apply_filters('comment_form_default_fields', array(
            'author' => "<div class='o-comments__form__inputs row'><div class='col-sm-4'><input placeholder=". esc_attr__('Name', 'bifrost') ." name='author' type='text' aria-required='true'/></div>",
        	'email' => "<div class='col-sm-4'><input placeholder=". esc_attr__('Email', 'bifrost') ." name='email' type='text' aria-required='true'/></div>",
        	'website' => "<div class='col-sm-4'><input placeholder=". esc_attr__('Website', 'bifrost') ." name='website' type='text'/></div></div>",
        )
    ),
);

if (have_comments() || comments_open()) :
?>
    <div class="o-comments" id="comments">
        <div class="o-comments__area">
            <div class="container">
                <h4 class="o-comments__title"><?php comments_number(esc_attr__('No Comments', 'bifrost'), esc_attr__('One Comment', 'bifrost'), esc_attr__('% Comments', 'bifrost')); ?></h4>
                <div class="row">
                    <?php wp_list_comments($bifrost_comments_args) ?>
                </div>
                <?php paginate_comments_links(); ?>
            </div>
        </div>
        <?php if (comments_open()) : ?>
            <div class="o-comments__form">
                <div class="container">
                    <?php comment_form($bifrost_comment_form); ?>
                </div>
            </div>
        <?php elseif (!comments_open() && get_theme_mod('comments_closed', '1') !== '2') : ?>
            <div class="o-comments__closed">
                <div class="container">
                    <h4 class="o-comments__closed__title"><?php echo esc_attr__('Comments are closed!', 'bifrost') ?></h4>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php 
endif;