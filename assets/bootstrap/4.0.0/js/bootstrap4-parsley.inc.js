<script type="text/javascript">
	$(document).ready(function () {
		$(".parsley-form").parsley({
			errorsContainer: function (ParsleyField) {
				return ParsleyField.$element.attr("title");
			},
			errorsWrapper: false
		});
		window.Parsley.on('field:error', function (fieldInstance) {
			var messages = ParsleyUI.getErrorsMessages(fieldInstance);
			var errorMsg = messages.join(';');
			fieldInstance.$element.tooltip('dispose');
			fieldInstance.$element.tooltip({
				animation: true,
				container: 'body',
				placement: 'top',
				title: errorMsg
			});
		});
		window.Parsley.on('field:success', function (fieldInstance) {
			fieldInstance.$element.tooltip('dispose');
		});
	});
</script>
