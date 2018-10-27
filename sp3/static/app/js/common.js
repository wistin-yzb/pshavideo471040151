function _clipboard(){
	if(typeof clipboard_text == 'undefined' || !clipboard_text || clipboard_text == '') return;

	$('body').attr('data-clipboard-text', clipboard_text);

	var clipboard = new Clipboard('body');
	clipboard.on('success', function(e) {
		if (e.trigger.disabled == false || e.trigger.disabled == undefined) {
			e.trigger.disabled = true;
			setTimeout(function() {
				e.trigger.disabled = false;
			}, 2000);
		}
	});
}
