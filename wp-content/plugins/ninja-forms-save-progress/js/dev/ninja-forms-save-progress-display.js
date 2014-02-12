jQuery(document).ready(function(jQuery) {
	jQuery(".ninja-forms-save-progress-delete-sub").click(function(e){
		var answer = confirm(ninja_forms_save_progress_settings.delete);
		if( !answer ){
			return false;
		}
	});
});