$(document).ready(function() {
	/*Jquery additional Methods*/
	// email full
	if ($.cookie('csrf_cookie_pat') == undefined) {
		var csrf = $("input[name='csrf_pat']").val();
	} else {
		var csrf = $.cookie('csrf_cookie_pat');
	}
	$.validator.addMethod("remote_valid", function(value, element, jdata) {
		$('#cover-spin').show();
		var x = $.ajax({
			type: "POST",
			url: jdata.url,
			async: false,
			cache: false,
			dataType: "json",
			data: {
				query: jdata.query,
				'csrf_pat': csrf,
			},
		}).responseText;
		if(x === 'false'){
			$('#cover-spin').hide();
			return false;
		}else{
			$('#cover-spin').hide();
			return true;
		}
		//return (x === 'false') ? false : true;
	}, function(value, element) {
		$('#cover-spin').hide();
		return value.msg;
	});
	$.validator.addMethod("maxDate", function(value, element) {
		var curDate = new Date();
		var inputDate = new Date(value);
		if (inputDate < curDate)
			return true;
		return false;
	}, "Invalid Date!");
	jQuery.validator.addMethod("emailfull", function(value, element) {
		return this.optional(element) || /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i.test(value);
	}, "Please enter valid email address.");
	/*Jquery additional Methods END*/
	/*$.validator.setDefaults({
		ignore: []
	});*/
	/*password*/
	$('.eye').click(function(event) {
		if ($(this).css("color") == 'rgb(0, 128, 0)') {
			$(this).css('color', 'rgb(75, 71, 152)');
			$('input[type=text]').prop('type', 'password');
		} else {
			$(this).css('color', 'green');
			$('input[type=password]').prop('type', 'text');
		}
	});
	/*Home Day Selection Filter*/
	$('.dayFilter').on('click', function(event) {
		$('.dayFilter').removeClass('active');
		$(this).addClass('active');
	});
	/*$('.dayFilter').on('click', function(event) {
	var text = $(this).text();
	$(this).html(text);
	$(this).html("<i class=\"material-icons sel\">check_circle</i>" + text);
});*/
	$('.daterange').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
		var url = BASE_URL + "dashboard?days=" + $('.daterange').val();
		window.location.href = url;
	});
	/*
	image preview
	*/
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#profile_img').css('background-image', "url(" + e.target.result + ")");
				$('#person_font').hide();
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#profile_image").change(function() {
		readURL(this);
	});
	$('form').each(function(index, el) {
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#profile_img_edit' + index).css('background-image', "url(" + e.target.result + ")");
					$('#person_font').hide();
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		$("#profile_image" + index).change(function() {
			readURL(this);
		});
	});
	/*student page validation*/
	$("#add_student").validate({
		rules: {
			name: {
				required: true,
			},
			class: {
				required: true,
					minlength: 1,
			},
			email: {
				required: true,
				email: true,
				remote_valid: {
					url: BASE_URL + "check_parent_email",
					msg: 'Email already exists.',
					query: {
						email: function() {
							return $("#email").val();
						},
					}
				},
			},
			gender: {
				required: true,
			},
			phone: {
				required: true,
				digits: true,
				minlength: 11,
				maxlength: 11,
			},
			password: {
				required: true,
			},
			weight: {
				required: true,
				digits: true,
			},
			bmi: {
				required: true,
				digits: true,
			},
			dob: {
				required: true,
				maxDate: true,
			},
			braceletid: {
				required: true,
				remote_valid: {
					url: BASE_URL + "check_bracelet_id",
					msg: 'Bracelet ID already exists.',
					query: {
						braceletid: function() {
							return $("#braceletid").val();
						},
					}
				},
			},
			heightft: {
				required: true,
			},
			heightinch: {
				required: true,
			}
		},
		messages: {
			name: {
				required: "Please Enter Username",
			},
			class: {
				required: "Please Select One Class",
					minlength: "Please Select One Class",
			},
			email: {
				required: "Please Enter Email.",
				email: "Please Enter Valid Email.",
			},
			gender: {
				required: "Please Enter Gender",
			},
			phone: {
				required: "Please Enter Phone Number",
				digits: "Please Enter Valid Phone Number",
				minlength: "Please Enter Valid Phone Number",
				maxlength: "Please Enter Valid Phone Number",
			},
			password: {
				required: "Please Enter Password",
			},
			weight: {
				required: "Please Enter Weight",
				digits: "Please Enter Valid Weight",
			},
			bmi: {
				required: "Please Enter BMI",
				digits: "Please Enter Valid BMI",
			},
			dob: {
				required: "Please Enter Date of Birth",
			},
			braceletid: {
				required: "Please Enter Bracelet ID",
			},
		},
		errorPlacement: function(error, element) {
			if (element.attr("name") == "name") {
				$(".namecls").html("");
				error.appendTo(".namecls");
			} else if (element.attr("name") == "class") {
				$(".classcls").html("");
				error.appendTo(".classcls");
			} else if (element.attr("name") == "email") {
				$(".emailcls").html("");
				error.appendTo(".emailcls");
			} else if (element.attr("name") == "phone") {
				$(".phonecls").html("");
				error.appendTo(".phonecls");
			} else if (element.attr("name") == "password") {
				$(".passwordcls").html("");
				error.appendTo(".passwordcls");
			} else if (element.attr("name") == "weight") {
				$(".weightcls").html("");
				error.appendTo(".weightcls");
			} else if (element.attr("name") == "bmi") {
				$(".bmicls").html("");
				error.appendTo(".bmicls");
			} else if (element.attr("name") == "dob") {
				$(".dobcls").html("");
				error.appendTo(".dobcls");
			} else if (element.attr("name") == "braceletid") {
				$(".braceletidcls").html("");
				error.appendTo(".braceletidcls");
			} else if (element.attr("name") == "gender") {
				$(".gendercls").html("");
				error.appendTo(".gendercls");
			}
		}
	});
	$('#add_student').on('keyup blur', function() { // fires on every keyup & blur
		/*if ($(this).valid()) { // checks form for validity
			$('#save').prop('disabled', false); // enables button
		} else {
			$("#save").prop('disabled', 'disabled'); // disables button
		}*/
	});
	$('form').each(function(index, value) {
		$("#edit_student" + index).validate({
			rules: {
				edit_name: {
					required: true,
				},
				edit_class: {
					required: true,
					minlength: 1,
				},
				edit_email: {
					required: true,
					email: true,
					remote_valid: {
						url: BASE_URL + "update_check_parent_email",
						msg: 'Email ID already exists.',
						query: {
							email: function() {
								return $("#edit_email" + index).val();
							},
							id: function() {
								return $("#s_id" + index).val();
							}
						}
					},
				},
				edit_gender: {
					required: true,
				},
				edit_phone: {
					required: true,
					digits: true,
					minlength: 11,
					maxlength: 11,
				},
				edit_password: {
					required: true,
				},
				edit_weight: {
					required: true,
					digits: true,
				},
				edit_bmi: {
					required: true,
					digits: true,
				},
				edit_dob: {
					required: true,
					maxDate: true,
				},
				edit_braceletid: {
					required: true,
					remote_valid: {
						url: BASE_URL + "update_check_bracelet_id",
						msg: 'Bracelet ID already exists.',
						query: {
							braceletid: function() {
								return $("#edit_braceletid" + index).val();
							},
							id: function() {
								return $("#s_id" + index).val();
							},
							class: function() {
								return $("#s_class" + index).val();
							}
						}
					},
				}
			},
			messages: {
				edit_name: {
					required: "Please Enter Username",
				},
				edit_class: {
					required: "Please Select One Class",
					minlength: "Please Select One Class",
				},
				edit_email: {
					required: "Please Enter Email.",
					email: "Please Enter Valid Email.",
				},
				edit_gender: {
					required: "Please Enter Gender",
				},
				edit_phone: {
					required: "Please Enter Phone Number",
					digits: "Please Enter Valid Phone Number",
					minlength: "Please Enter Valid Phone Number",
					maxlength: "Please Enter Valid Phone Number",
				},
				edit_password: {
					required: "Please Enter Password",
				},
				edit_weight: {
					required: "Please Enter Weight",
					digits: "Please Enter Valid Weight",
				},
				edit_bmi: {
					required: "Please Enter BMI",
					digits: "Please Enter Valid BMI",
				},
				edit_dob: {
					required: "Please Enter Date of Birth",
				},
				edit_braceletid: {
					required: "Please Enter Bracelet ID",
				}
			},
			errorPlacement: function(error, element) {
				if (element.attr("name") == "edit_name") {
					$(".edit_namecls" + index).html("");
					error.appendTo(".edit_namecls" + index);
				} else if (element.attr("name") == "edit_class") {
					$(".edit_classcls" + index).html("");
					error.appendTo(".edit_classcls" + index);
				} else if (element.attr("name") == "edit_email") {
					$(".edit_emailcls" + index).html("");
					error.appendTo(".edit_emailcls" + index);
				} else if (element.attr("name") == "edit_phone") {
					$(".edit_phonecls" + index).html("");
					error.appendTo(".edit_phonecls" + index);
				} else if (element.attr("name") == "edit_password") {
					$(".edit_passwordcls" + index).html("");
					error.appendTo(".edit_passwordcls" + index);
				} else if (element.attr("name") == "edit_weight") {
					$(".edit_weightcls" + index).html("");
					error.appendTo(".edit_weightcls" + index);
				} else if (element.attr("name") == "edit_bmi") {
					$(".edit_bmicls" + index).html("");
					error.appendTo(".edit_bmicls" + index);
				} else if (element.attr("name") == "edit_dob") {
					$(".edit_dobcls" + index).html("");
					error.appendTo(".edit_dobcls" + index);
				} else if (element.attr("name") == "edit_braceletid") {
					$(".edit_braceletidcls" + index).html("");
					error.appendTo(".edit_braceletidcls" + index);
				} else if (element.attr("name") == "edit_gender") {
					$(".edit_gendercls" + index).html("");
					error.appendTo(".edit_gendercls" + index);
				}
			}
		});
		$(this).on('keyup blur', function() { // fires on every keyup & blur
			if ($(this).valid()) { // checks form for validity
				//$('#edit' + index).prop('disabled', false); // enables button
			} else {
				//$("#edit" + index).prop('disabled', 'disabled'); // disables button
			}
		});
	});
	/*CLASS PAGE VALIDATION*/
	$('#add_class').validate({
		//ignore: [],
		rules: {
			class_name: {
				required: true,
			},
			// "teachers[]": {
			// 	minlength: 1,
			// 	required: true,
			// }
		},
		messages: {
			class_name: {
				required: "Please Enter Class Name"
			},
			// "teachers[]": {
			// 	required: "Please Select At least one teacher",
			// 	minlength: "Please Select At least one teacher"
			// }
		},
		errorPlacement: function(error, element) {
           if (element.attr("name") == "class_name") {
				$('.class_namecls').html("");
				$(error).appendTo('.class_namecls')
			} else {
                error.insertAfter(element);
            }
        },
	});
	$('#add_class_model').validate({
		rules: {
			class_name: {
				required: true,
			},
			// "teachers[]": {
			// 	minlength: 1,
			// 	required: true,
			// }
		},
		messages: {
			class_name: {
				required: "Please Enter Class Name"
			},
			// "teachers[]": {
			// 	required: "Please Select At least one teacher",
			// 	minlength: "Please Select At least one teacher"
			// }
		},
		errorPlacement: function(error, element) {
           if (element.attr("name") == "class_name") {
				$('.class_namecls').html("");
				$(error).appendTo('.class_namecls')
			} else {
                error.insertAfter(element);
            }
        },
	});
	/*teachers page*/
	$('[id^="y_delete"]').on('click', function() {
		var location = (event.target.id).replace('y_delete', '');
		var id = $('#delete_id' + location).val();
		var email = $('#delete_email' + location).val();
		var value = $('#y_delete_token' + location).val();
		var tr = $(this).closest($('#teacher_row' + location));
		$.ajax({
			url: BASE_URL + '/delete_teacher',
			type: 'POST',
			data: {
				delete_id: id,
				delete_email: email,
				csrf_pat: value,
			},
			success: function(response) {
				$('#teacher_row' + location).fadeOut(500, function() {
					$('#teacher_row' + location).remove();
				});
				//window.location.reload();
			},
		});
	});
	$('[id^="s_delete"]').on('click', function() {
		var location = (event.target.id).replace('s_delete', '');
		var id = $('#delete_id' + location).val();
		var email = $('#delete_email' + location).val();
		var value = $('#s_delete_token' + location).val();
		var tr = $(this).closest($('#student_row' + location));
		$.ajax({
			url: BASE_URL + 'delete_student',
			type: 'POST',
			data: {
				delete_id: id,
				delete_email: email,
				csrf_pat: value,
			},
			success: function(response) {
				$('#student_row' + location).fadeOut(500, function() {
					$('#student_row' + location).remove();
				});
				setTimeout(function() { window.location.reload(); }, 500);
			},
		});
	});
	$('[id^="c_delete"]').on('click', function() {
		var location = (event.target.id).replace('c_delete', '');
		var id = $('#delete_id' + location).val();
		var value = $('#s_delete_token' + location).val();
		var tr = $(this).closest($('#class_row' + location));
		$.ajax({
			url: BASE_URL + 'delete_class',
			type: 'POST',
			data: {
				delete_id: id,
				csrf_pat: value,
			},
			success: function(response) {
				$('#class_row' + location).fadeOut(500, function() {
					$('#class_row' + location).remove();
				});
				setTimeout(function() { window.location.reload(); }, 500);
			},
		});
	});
	$('form').each(function(index, value) {
		$("#edit_teacher" + index).validate({
			rules: {
				username: {
					required: true,
				},
				"class[]": {
					required: true,
					minlength: 1,
				},
				email: {
					required: true,
					email: true,
				},
				phone: {
					required: true,
					digits: true,
					minlength: 11,
					maxlength: 11,
				},
				password: {
					required: true,
				},
				weight: {
					required: true,
					digits: true,
				},
				bmi: {
					required: true,
					digits: true,
				},
				dob: {
					required: true,
					maxDate: true,
				},
				userid: {
					required: true,
				}
			},
			messages: {
				username: {
					required: "Please Enter Username",
				},
				"class[]": {
					required: "Please Select One Class",
					minlength: "Please Select One Class",
				},
				email: {
					required: "Please Enter Email.",
					email: "Please Enter Valid Email.",
				},
				phone: {
					required: "Please Enter Phone Number",
					digits: "Please Enter Valid Phone Number",
					minlength: "Please Enter Valid Phone Number",
					maxlength: "Please Enter Valid Phone Number",
				},
				password: {
					required: "Please Enter Password",
				},
				weight: {
					required: "Please Enter Weight",
					digits: "Please Enter Valid Weight",
				},
				bmi: {
					required: "Pleaseb Enter BMI",
					digits: "Please Enter Valid BMI",
				},
				dob: {
					required: "Please Enter Date of Birth",
				},
				userid: {
					required: "Please Enter User ID",
				}
			},
			errorPlacement: function(error, element) {
				if (element.attr("name") == "username") {
					$(".usernamecls").html("");
					error.appendTo(".usernamecls");
				} else if (element.attr("name") == "class[]") {
					$(".classcls").html("");
					error.appendTo(".classcls");
				} else if (element.attr("name") == "email") {
					$(".emailcls").html("");
					error.appendTo(".emailcls");
				} else if (element.attr("name") == "phone") {
					$(".phonecls").html("");
					error.appendTo(".phonecls");
				} else if (element.attr("name") == "password") {
					$(".passwordcls").html("");
					error.appendTo(".passwordcls");
				} else if (element.attr("name") == "weight") {
					$(".weightcls").html("");
					error.appendTo(".weightcls");
				} else if (element.attr("name") == "bmi") {
					$(".bmicls").html("");
					error.appendTo(".bmicls");
				} else if (element.attr("name") == "dob") {
					$(".dobcls").html("");
					error.appendTo(".dobcls");
				} else if (element.attr("name") == "userid") {
					$(".useridcls").html("");
					error.appendTo(".useridcls");
				}
			}
		});
		//$('[id^="edit_teacher"]').prop('disabled', 'disabled'); // disables button
		$(this).on('keyup blur', function() { // fires on every keyup & blur
			if ($(this).valid()) { // checks form for validity
				//	$('#edit' + index).prop('disabled', false); // enables button
			} else {
				//	$("#edit" + index).prop('disabled', 'disabled'); // disables button
			}
		});
	});
	if ($('#add_teacher').length > 0) {
		$('#add_teacher').validate({
			ignore: [],
			rules: {
				addusername: {
					required: true,
				},
				"addclass[]": {
					required: true,
					minlength: 1,
				},
				addemail: {
					required: true,
					emailfull: true,
				},
				addphone: {
					required: true,
					digits: true,
					minlength: 11,
					maxlength: 11,
				},
				addpassword: {
					required: true,
				},
				addweight: {
					required: true,
					digits: true,
				},
				addbmi: {
					required: true,
					digits: true,
				},
				adddob: {
					required: true,
					maxDate: true,
				},
				adduserid: {
					required: true,
				}
			},
			messages: {
				addusername: {
					required: "Please Enter Username.",
				},
				"addclass[]": {
					required: "Please Select Class.",
					minlength: "Please Select One Class.",
				},
				addemail: {
					required: "Please Enter Email.",
					email: "Please Enter Valid Email.",
				},
				addphone: {
					required: "Please Enter Phone Number.",
					digits: "Please Enter Valid Phone Number.",
					minlength: "Please Enter Valid Phone Number.",
					maxlength: "Please Enter Valid Phone Number.",
				},
				addpassword: {
					required: "Please Enter Password.",
				},
				addweight: {
					required: "Please Enter Weight",
					digits: "Please Enter Valid Weight.",
				},
				addbmi: {
					required: "Please Enter BMI",
					digits: "Please Enter Valid BMI.",
				},
				adddob: {
					required: "Please Enter Date of Birth.",
				},
				adduserid: {
					required: "Please Enter User ID.",
				}
			},
			errorPlacement: function(error, element) {
				if (element.attr("name") == "addusername") {
					error.appendTo(".addusernamecls");
				} else if (element.attr("name") == "addclass[]") {
					error.appendTo(".addclasscls");
				} else if (element.attr("name") == "addemail") {
					error.appendTo(".addemailcls");
				} else if (element.attr("name") == "addphone") {
					error.appendTo(".addphonecls");
				} else if (element.attr("name") == "addpassword") {
					error.appendTo(".addpasswordcls");
				} else if (element.attr("name") == "addweight") {
					error.appendTo(".addweightcls");
				} else if (element.attr("name") == "addbmi") {
					error.appendTo(".addbmicls");
				} else if (element.attr("name") == "adddob") {
					error.appendTo(".adddobcls");
				} else if (element.attr("name") == "adduserid") {
					error.appendTo(".adduseridcls");
				}
			}
		});
		//$('#save').prop('disabled', 'disabled');
		$('#add_teacher input').on('keyup blur', function() {
			// fires on every keyup & blur
			if ($('#add_teacher').valid()) { // checks form for validity
				//$('#save').prop('disabled', false); // enables button
			} else {
				//$('#save').prop('disabled', 'disabled'); // disables button
			}
		});
	}
	/*LOGIN VALIDATION STARTS:*/
	if ($('#login_form').length > 0) {
		$("#login_form").validate({
			rules: {
				email: {
					required: true,
					email: true,
				},
				password: {
					required: true,
				},
			},
			messages: {
				email: {
					required: "Please enter email.",
					email: "Please enter valid email."
				},
				password: {
					required: "Please enter password.",
				},
			},
			errorPlacement: function(error, element) {
				if (element.attr("name") == "email") {
					error.insertAfter(".emailcls");
				} else if (element.attr("name") == "password") {
					error.insertAfter(".pwdcls");
				} else {
					error.insertAfter(element);
				}
			}
		});
	}
	if ($('#forgotpassword_form').length > 0) {
		$("#forgotpassword_form").validate({
			rules: {
				email: {
					required: true,
					email: true,
				},
			},
			messages: {
				email: {
					required: "Please enter email.",
					email: "Please enter valid email."
				},
			},
			errorPlacement: function(error, element) {
				if (element.attr("name") == "email") {
					error.insertAfter(".emailcls");
				} else {
					error.insertAfter(element);
				}
			}
		});
	}
	if ($('#resetpassword_form').length > 0) {
		$("#resetpassword_form").validate({
			rules: {
				newpassword: {
					required: true,
				},
				confirmpassword: {
					required: true,
					equalTo: '#newpassword',
				},
			},
			messages: {
				newpassword: {
					required: "Please enter newpassword.",
				},
				confirmpassword: {
					required: "Please enter confirm password.",
					equalTo: "Confirm password does not match."
				},
			},
			errorPlacement: function(error, element) {
				if (element.attr("name") == "newpassword") {
					error.insertAfter(".newpasswordcls");
				} else if (element.attr("name") == "confirmpassword") {
					error.insertAfter(".confirmpasswordcls");
				} else {
					error.insertAfter(element);
				}
			}
		});
	}
	if ($('#parent_register_form').length > 0) {
		$("#parent_register_form").validate({
			rules: {
				email: {
					required: true,
					email: true,
					remote_valid: {
						url: BASE_URL + "check_parent_email",
						msg: 'Email already exists.',
						query: {
							email: function() {
								return $("#email").val();
							},
						}
					},
				},
				password: {
					required: true,
				},
				username: {
					required: true,
				},
				braceletid: {
					required: true,
				},
				phone: {
					required: true,
					digits: true,
					minlength: 10,
					maxlength: 10,
				}
			},
			messages: {
				email: {
					required: "Please enter email.",
					email: "Please enter valid email."
				},
				password: {
					required: "Please enter password.",
				},
				username: {
					required: "Please enter username.",
				},
				braceletid: {
					required: "Please enter series digits.",
				},
				phone: {
					required: "Please Enter Phone Number",
					digits: "Please Enter Valid Phone Number",
					minlength: "Please Enter Valid Phone Number",
					maxlength: "Please Enter Valid Phone Number",
				}
			},
			errorPlacement: function(error, element) {
				if (element.attr("name") == "email") {
					error.insertAfter(".emailcls");
				} else if (element.attr("name") == "password") {
					error.insertAfter(".pwdcls");
				} else if (element.attr("name") == "username") {
					error.insertAfter(".usernamecls");
				} else if (element.attr("name") == "braceletid") {
					error.insertAfter(".braceletcls");
				} else if (element.attr("name") == "phone") {
					error.insertAfter(".phonecls");
				} else {
					error.insertAfter(element);
				}
			}
		});
	}
	if ($('#profile_parent').length > 0) {
		$("#profile_parent").validate({
			rules: {
				parent_phone: {
					required: true,
					digits: true,
					minlength: 11,
					maxlength: 11,
				}
			},
			messages: {
				parent_phone: {
					required: "Please Enter Phone Number",
					digits: "Please Enter Valid Phone Number",
					minlength: "Please Enter Valid Phone Number",
					maxlength: "Please Enter Valid Phone Number",
				}
			},
			errorPlacement: function(error, element) {
				if (element.attr("name") == "parent_phone") {
					error.insertAfter(".parent_phonecls");
				} else {
					error.insertAfter(element);
				}
			}
		});
	}
	if ($('#profile_teacher').length > 0) {
		$("#profile_teacher").validate({
			rules: {
				teacher_phone: {
					required: true,
					digits: true,
					minlength: 11,
					maxlength: 11,
				}
			},
			messages: {
				teacher_phone: {
					required: "Please Enter Phone Number",
					digits: "Please Enter Valid Phone Number",
					minlength: "Please Enter Valid Phone Number",
					maxlength: "Please Enter Valid Phone Number",
				}
			},
			errorPlacement: function(error, element) {
				if (element.attr("name") == "teacher_phone") {
					error.insertAfter(".teacher_phonecls");
				} else {
					error.insertAfter(element);
				}
			}
		});
	}
	if ($('#profile_school').length > 0) {
		$("#profile_school").validate({
			rules: {
				school_phone: {
					required: true,
					digits: true,
					minlength: 11,
					maxlength: 11,
				}
			},
			messages: {
				school_phone: {
					required: "Please Enter Phone Number",
					digits: "Please Enter Valid Phone Number",
					minlength: "Please Enter Valid Phone Number",
					maxlength: "Please Enter Valid Phone Number",
				}
			},
			errorPlacement: function(error, element) {
				if (element.attr("name") == "school_phone") {
					error.insertAfter(".edit_phonecls");
				} else {
					error.insertAfter(element);
				}
			}
		});
	}
	if ($('#support_form').length > 0) {
		$("#support_form").validate({
			rules: {
				uname: {
					required: true,
				},
				email: {
					required: true,
					email: true,
				},
				phone: {
					number: true,
					minlength: 11,
					maxlength: 11,
				},
				message: {
					required: true,
				},
			},
			messages: {
				uname: {
					required: "Please enter name.",
				},
				email: {
					required: "Please enter email.",
					email: "Please enter valid email.",
				},
				phone: {
					number: "Please Enter Valid Phone Number.",
					minlength: "Please Enter Valid Phone Number.",
					maxlength: "Please Enter Valid Phone Number.",
				},
				message: {
					required: "Please enter message.",
				},
			},
			errorPlacement: function(error, element) {
				if (element.attr("name") == "uname") {
					error.insertAfter(".name-cls");
				} else if (element.attr("name") == "email") {
					error.insertAfter(".email_address-cls");
				} else if (element.attr("name") == "phone") {
					error.insertAfter(".phone-cls");
				} else if (element.attr("name") == "message") {
					error.insertAfter(".message-cls");
				} else {
					error.insertAfter(element);
				}
			}
		});
	}
});