
$(document).ready(function() {
	$('.collapsible').collapsible({
		accordion: false
	});

	$('.modal-trigger').leanModal();

	$(document).on('click', '.delete-option', function() {
		$(this).parent(".input-field").remove();
	});

	// will replace .form-g class when referenced
	var material = '<div class="input-field col input-g s12">' +
	'<input name="option_name[]" id="option_name[]" type="text">' +
	'<span style="float:right; cursor:pointer;"class="delete-option">Delete</span>' +
	'<label for="option_name">Options</label>' +
	'<span class="add-option" style="cursor:pointer;">Add Another</span>' +
	'</div>';

	// for adding new option
	$(document).on('click', '.add-option', function() {
		$(".form-g").append(material);
	});
	// allow for more options if radio or checkbox is enabled
	$(document).on('change', '.js-question-type', function() {
		var selected_option = $(this).val();
		if (selected_option === "radio" || selected_option === "checkbox" || selected_option === "select") {
		  $(this).closest('.qd-subview-container').parent().find('.form-g').html(material);
		} else {
		  $(".input-g").remove();
		}
	});
	$( ".js-datepicker" ).datepicker();
	$(".js-edit-field").on('click', function(e){
		e.preventDefault();
		e.stopPropagation();
		var rootEl = $(this).closest('.collapsible-body');

		var selected_option = rootEl.find(".js-question-type").val();
		var optionNames = [];
		var data = {
			is_mandatory: rootEl.find(".js-is-mandatory").prop('checked') == true ? '1' : '0',
			question_type: selected_option,
			title: rootEl.find(".js-title").val()
		}
		console.log(rootEl.find(".js-title"))
		if (selected_option === "radio" || selected_option === "checkbox" || selected_option === "select") {
			rootEl.find('input[name="option_name[]"]').each(function(){
				optionNames.push($(this).val());
			})
			data['option_name'] = optionNames;
		}
		$.ajax({
			url: '/question/' + rootEl.find('.qd-subview-container').data('question-id') + '/update',
			data: data,
			method: 'get',
			dataType: 'json',
			success: function(success){
				$(".collapsible-header.active").trigger('click');
				$('<div style="background: #26a69a;color: white;position: absolute; top: 100px; right: 45%;padding: 10px;" id="msgBox">Question has been updated</div>').
					appendTo($('body'));
			 	setTimeout(function(){
			 		$("#msgBox").fadeOut('slow', function(){
						$(this).remove();
			 		});
			 	}, 1000);
			}
		});
	})
});
