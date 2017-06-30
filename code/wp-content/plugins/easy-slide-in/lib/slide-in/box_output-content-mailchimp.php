<?php
$id = md5(microtime() . rand());
$admin_url = admin_url('admin-ajax.php');

if ('after' == $mailchimp_position) echo apply_filters('esi_content', $message->post_content);

echo '<form id="esi-mailchimp-' . $id . '" class="esi-mailchimp-root esi-clearfix">';
echo '<input type="hidden" class="esi-mailchimp-post_id" value="' . esc_attr($message->ID) . '" />';
echo '<label for="esi-mailchimp-' . $id . '-email" class="esi-mailchimp-label">' . __('Email:', 'esi') . '</label>';
echo '<input type="text" id="esi-mailchimp-' . $id . '-email" class="esi-mailchimp-email" placeholder="' . esc_attr($mailchimp_placeholder) . '" />';
echo '<button class="esi-mailchimp-subscribe" type="button">' . __('Get 15% Off', 'esi') . '</button>';
echo '<div class="esi-mailchimp-result"></div>';
echo '</form>';

if ('before' == $mailchimp_position) echo apply_filters('esi_content', $message->post_content);

?>

<script>
(function ($) {

function mailchimp_subscribe (root) {
	var $email = root.find(".esi-mailchimp-email"),
		$post_id = root.find(".esi-mailchimp-post_id"),
		$result = root.find(".esi-mailchimp-result")
	;
	if (!$email.length || !$email.val()) return false;
	$.post("<?php echo $admin_url; ?>", {
		"action": "esi_mailchimp_subscribe",
		'post_id': $post_id.val(),
		"email": $email.val()
	}, function (data) {
		var is_error = data && data.is_error && parseInt(data.is_error, 10),
			msg = (data && data.message ? data.message : "<?php echo esc_js(__('Error', 'esi')); ?>"),
			error_class = 'esi-mailchimp_error',
			success_class = 'esi-mailchimp_success',
			wrapper = (is_error ? error_class : success_class)
		;
		$result
			.removeClass(error_class).removeClass(success_class)
			.addClass(wrapper)
			.html(msg)
		;
	}, 'json');
	return false;
}

$(function () {
$(".esi-mailchimp-subscribe").click(function () {
	mailchimp_subscribe($(this).parents(".esi-mailchimp-root"));
	return false;
});
});
})(jQuery);
</script>