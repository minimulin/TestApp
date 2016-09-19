$(document).ready(function(){

	$.fn.extend({
		showValidationErrors: function() {
			var form = $(this);

			$.each(data.errors,function(name, errors){
				var input = form.find('[name="' + name + '"]');
				var formGroup = input.parents('.form-group');

				$.each(errors,function(key, message){
					var errorContainer = $('<span></span>').addClass('help-block').text(message);
					formGroup.addClass('has-error').append(errorContainer);
				});
			});
		},
		clearValidationErrors: function() {
			var form = $(this);

			form.find('.help-block').remove();
			form.find('.has-error').removeClass('has-error');
		},
		validateFileExtension: function() {
			var filename = $(this).val();

			var validExts = [".jpg", ".jpeg", ".gif", ".png"];    

			if (filename.length > 0) {
				var blnValid = false;
				for (var j = 0; j < validExts.length; j++) {
					var sCurExtension = validExts[j];
					if (filename.substr(filename.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
						blnValid = true;
						break;
					}
				}

				if (!blnValid) {
					return false;
				}
			}

			return true;
		}
	});

	$('#sortButtons button').on('click', function(event){
		event.preventDefault();

		var button = $(this);

		$.ajax({
			url: '/replies/sort',
			type: 'post',
			data: {
				'sort': button.data('sort')
			},
			success: function(data){
				if (typeof(data.result) != 'undefined') {
					if (data.result == 'success') {
						$('#sortButtons button').removeClass('btn-primary');
						button.addClass('btn-primary');
						location.reload();
					}
				} else {
					alert('Произошла непредвиденная ошибка');
				}
			},
			dataType: 'json'
		});
	});

	function progressHandlingFunction(event){
		if (event.lengthComputable) {  
			var percentComplete = (event.loaded / event.total) * 100;
			$('.progress-bar').css('width',percentComplete + '%');
		}
	}

	$('#replyForm').on('submit', function(event){
		event.preventDefault();

		var form = $(this);
		var formData = new FormData(form[0]);
		form.clearValidationErrors();

		$.ajax({
			url: form.attr('action'),
			type: form.attr('method'),
			data: formData,
			xhr: function() {
				$('.progress-bar').fadeIn(500);
				var myXhr = $.ajaxSettings.xhr();
				if(myXhr.upload){
					myXhr.upload.addEventListener("progress", progressHandlingFunction, false);
				}
				return myXhr;
			},
			success: function(data){
				if (typeof(data.result) != 'undefined') {
					if (data.result == 'error') {
						if (typeof(data.message) != 'undefined') {
							alert(data.message);
						}
						if (typeof(data.errors) != 'undefined') {
							form.showValidationErrors(data.errors);
						}
					}
					if (data.result == 'success') {
						alert('Комментарий появится после проверки администратором');
						location.reload();
					}
				} else {
					alert('Произошла непредвиденная ошибка');
				}
			},
			dataType: 'json',
			cache: false,
			contentType: false,
			processData: false
		});
	});

	$('#messagePreview').on('click', function(event){
		event.preventDefault();

		var form = $('#replyForm');
		var formData = new FormData(form[0]);
		var previewContainer = $('#previewContainer');
		var fileInput = form.find('[name=image]');
		previewContainer.hide().find('.previewHtml').html('');

		form.find('.help-block').remove();
		form.find('.has-error').removeClass('has-error');

		if (!fileInput.validateFileExtension()) {
			var errorContainer = $('<span></span>').addClass('help-block').text('Неверный формат файла');
			fileInput.parents('.form-group').addClass('has-error').append(errorContainer);

			return false;
		}

		$.ajax({
			url: '/replies/preview',
			type: form.attr('method'),
			data: formData,
			xhr: function() {
				$('.progress-bar').fadeIn(500);
				var myXhr = $.ajaxSettings.xhr();
				if(myXhr.upload){
					myXhr.upload.addEventListener("progress", progressHandlingFunction, false);
				}
				return myXhr;
			},
			success: function(data){
				$('.progress-bar').fadeOut(500);
				if (typeof(data.result) != 'undefined') {
					if (data.result == 'error') {
						if (typeof(data.message) != 'undefined') {
							alert(data.message);
						}
						if (typeof(data.errors) != 'undefined') {
							$.each(data.errors,function(name, errors){
								var input = form.find('[name="' + name + '"]');
								var formGroup = input.parents('.form-group');

								$.each(errors,function(key, message){
									var errorContainer = $('<span></span>').addClass('help-block').text(message);
									formGroup.addClass('has-error').append(errorContainer);
								});
							});
						}
					}
					if (data.result == 'success') {
						if (typeof(data.preview) != 'undefined') {
							previewContainer.show().find('.previewHtml').html(data.preview);
							$('html, body').animate({
								scrollTop: previewContainer.offset().top
							}, 500);
						}
					}
				} else {
					alert('Произошла непредвиденная ошибка');
				}
			},
			dataType: 'json',
			cache: false,
			contentType: false,
			processData: false
		});
	});

	$('.replyEdit').on('click',function(event){
		event.preventDefault();

		var replyId = $(this).data('id');
		var modal = $('#replyEditModal');
		$.ajax({
			url: '/replies/getData',
			type: 'post',
			data: {
				id: replyId
			},
			success: function(data){
				if (typeof(data.result) != 'undefined') {
					if (data.result == 'error') {
						if (typeof(data.message) != 'undefined') {
							alert(data.message);
						}
					}
					if (data.result == 'success') {
						modal.find('.modal-body').html(data.form);
						modal.modal({});
					}
				} else {
					alert('Произошла непредвиденная ошибка');
				}
			},
			dataType: 'json',
		});
	});

	$('.saveReplyModal').on('click',function(event){
		event.preventDefault();

		var modal = $('#replyEditModal');
		var form = modal.find('form');

		$.ajax({
			url: '/replies/update',
			type: 'post',
			data: form.serialize(),
			success: function(data){
				if (typeof(data.result) != 'undefined') {
					if (data.result == 'error') {
						if (typeof(data.message) != 'undefined') {
							alert(data.message);
						}
						if (typeof(data.errors) != 'undefined') {
							form.showValidationErrors(data.errors);
						}
					}
					if (data.result == 'success') {
						modal.modal('hide')
						location.reload();
					}
				} else {
					alert('Произошла непредвиденная ошибка');
				}
			},
			dataType: 'json',
		});
	});

	$('.replyChangeStatus').on('click',function(event){
		event.preventDefault();

		var button = $(this);
		var replyId = button.data('id');
		var status = button.data('status');

		$.ajax({
			url: '/replies/changeStatus',
			type: 'post',
			data: {
				id: replyId,
				status: status
			},
			success: function(data){
				if (typeof(data.result) != 'undefined') {
					if (data.result == 'error') {
						if (typeof(data.message) != 'undefined') {
							alert(data.message);
						}
					}
					if (data.result == 'success') {
						location.reload();
					}
				} else {
					alert('Произошла непредвиденная ошибка');
				}
			},
			dataType: 'json',
		});
	});

});