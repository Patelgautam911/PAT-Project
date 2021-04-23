$(document).ready(function() {
	if ($.cookie('csrf_cookie_pat') == undefined) {
		var csrf = $("input[name='csrf_pat']").val();
	} else {
		var csrf = $.cookie('csrf_cookie_pat');
	}
	$.validator.addMethod("remote_valid", function(value, element, jdata) {
		var x = $.ajax({
			type: "POST",
			url: jdata.url,
			async: false,
			dataType: "json",
			data: {
				query: jdata.query,
				'csrf_pat': csrf,
			},
		}).responseText;
		return (x === 'false') ? false : true;
	}, function(value, element) {
		return value.msg;
	});
	/* LOGIN Validation START:*/
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
					error.insertAfter(".email");
				} else if (element.attr("name") == "password") {
					error.insertAfter(".password");
				} else {
					error.insertAfter(element);
				}
			}
		});
	}
	/* LOGIN Validation END:*/

	/* Student add  Validation START:*/
	if ($('#student_form').length > 0) {
		$("#student_form").validate({
			rules: {
				username: {
					required: true,
				},
				surname: {
					required: true,
				},
				email: {
					required: true,
					email: true,
					remote_valid: {
						url: BASE_URL + "admin/email_exists",
						msg: 'Email already exists.',
						query: {
							email: function() {
								return $("#email").val();
							},
						}
					},
				},
				deviceid: {
					required: true,
				},
				parent: {
					required: true,
					remote_valid: {
						url: BASE_URL + "admin/parent_exists",
						msg: 'Email already exists.',
						query: {
							parent: function() {
								return $("#parentedit").val();
							},
						}
					},
				},
				school: {
					required: true,
				},
				class: {
					required: true,
				},
			},
			messages: {
				username: {
					required: "Please enter name.",
				},
				surname: {
					required: "Please enter surname.",
				},
				email: {
					required: "Please enter email.",
					email: "Please enter valid email.",
					//remote: " Email already exists."
				},
				deviceid: {
					required: "Please enter device id.",
				},
				parent: {
					required: "Please select parent name.",
					remote: " Parent already exists."
				},
				school: {
					required: "Please selcet school.",
				},
				class: {
					required: "Please selcet class.",
				},
			},
		});
	}

	if ($('#student_edit_form').length > 0) {
		$("#student_edit_form").validate({
			rules: {
				username: {
					required: true,
				},
				surname: {
					required: true,
				},
				email: {
					required: true,
					email: true,
				},
				school: {
					required: true,
				},
				class: {
					required: true,
				},
			},
			messages: {
				username: {
					required: "Please enter name.",
				},
				surname: {
					required: "Please enter surname.",
				},
				email: {
					required: "Please enter email.",
					email: "Please enter valid email.",
				},
				school: {
					required: "Please selcet school.",
				},
				class: {
					required: "Please selcet class.",
				},
			},
		});
	}
	/* Student add  Validation END:*/
	if ($('#school_form').length > 0) {
		$("#school_form").validate({
			rules: {
				schoolname: {
					required: true,
				},
				schoolemail: {
					required: true,
					email: true,
					remote_valid: {
						url: BASE_URL + "/check_parent_email",
						msg: 'Email already exists.',
						query: {
							email: function() {
								return $("#schoolemail").val();
							},
						}
					},
				},
				schoolphone: {
					required: true,
					number: true,
					minlenght: 10,
					maxlength: 10,
				}
			},
			messages: {
				schoolname: {
					required: "Please enter school name.",
				},
				schoolemail: {
					required: "Please Enter Email.",
					email: "Please Enter Valid Email.",
				},
				schoolphone: {
					required: "Please Enter Phone Number",
					number: "Please Enter Valid Phone Number",
					minlenght: "Please Enter Valid Phone Number",
					maxlength: "Please Enter Valid Phone Number",
				}
			},
		});
	}

	if ($('#class_form').length > 0) {
		$("#class_form").validate({
			rules: {
				schoolname: {
					required: true,
				},
				classname: {
					required: true,
				},
			},
			messages: {
				schoolname: {
					required: "Please select school name.",
				},
				classname: {
					required: "Please enter class name.",
				},
			},
		});
	}

	if ($('#teacher_form').length > 0) {
		$("#teacher_form").validate({
			rules: {
				username: {
					required: true,
				},
				surname: {
					required: true,
				},
				email: {
					required: true,
					email: true,
					// remote: {
					// 	url: "teacher_email_exists",
					// 	csrf_pat: $('input[name=csrf_pat]').val(),
					// 	type: "post",
					// },
				},
				school: {
					required: true,
				},
				class: {
					required: true,
				},
			},
			messages: {
				username: {
					required: "Please enter name.",
				},
				surname: {
					required: "Please enter surname.",
				},
				email: {
					required: "Please enter email.",
					email: "Please enter valid email.",
					//remote: " Email already exists."
				},
				school: {
					required: "Please selcet school.",
				},
				class: {
					required: "Please selcet class.",
				},
			},
		});
	}

	if ($('#edit_teacher_form').length > 0) {
		$("#edit_teacher_form").validate({
			rules: {
				username: {
					required: true,
				},
				surname: {
					required: true,
				},
				email: {
					required: true,
					email: true,
				},
				school: {
					required: true,
				},
				class: {
					required: true,
				},
			},
			messages: {
				username: {
					required: "Please enter name.",
				},
				surname: {
					required: "Please enter surname.",
				},
				email: {
					required: "Please enter email.",
					email: "Please enter valid email.",
				},
				school: {
					required: "Please selcet school.",
				},
				class: {
					required: "Please selcet class.",
				},
			},
		});
	}

	if ($('#parent_form').length > 0) {
		$("#parent_form").validate({
			rules: {
				username: {
					required: true,
				},
				email: {
					required: true,
					email: true,
					remote_valid: {
						url: BASE_URL + "/check_parent_email",
						msg: 'Email already exists.',
						query: {
							email: function() {
								return $("#email").val();
							},
						}
					},

				},
				phone: {
					required: true,
					number: true,
					minlength: 10,
					maxlength: 10,
				}
			},
			messages: {
				username: {
					required: "Please enter name.",
				},
				email: {
					required: "Please enter email.",
					email: "Please enter valid email.",

				},
				phone: {
					required: "Please Enter Phone Number",
					number: "Please Enter Valid Phone Number",
					minlength: "Please Enter Valid Phone Number",
					maxlength: "Please Enter Valid Phone Number",
				}

			},
		});
	}

	if ($('#edit_parent_form').length > 0) {
		$("#edit_parent_form").validate({
			rules: {
				username: {
					required: true,
				},
			},
			messages: {
				username: {
					required: "Please enter name.",
				},
			},
		});
	}

	/* ON change School to class data load */
	$('#school').change(function() {
		var id = $(this).val();
		if ($(this).val().length > 0) {
			$.ajax({
				type: "POST",
				url: "getclass",
				data: { 
					"csrf_pat": $("[name='csrf_pat']").val(),
					id: id,
					 },
				async: false,
				success: function(response) {
					console.log(response);
					$(".classscls").html(response);
				},
				error: function() {

				}
			});
		}
	});

	$('#schooledit').change(function() {
		var id = $(this).val();
		if ($(this).val().length > 0) {
			$.ajax({
				type: "POST",
				url: BASE_URL +"admin/getclass",
				data: { 
					"csrf_pat": $("[name='csrf_pat']").val(),
						id: id,
					},
				async: false,
				success: function(response) {
					console.log(response);
					$(".studentclasscls").html(response);
				},
				error: function() {

				}
			});
		}
	});
	/* ON change School to class data load */

	/* Ajax through datatable Student START*/
	$('#studenttable').DataTable({
		"processing": true,
		"serverSide": true,
		'serverMethod': 'post',
		"ajax": {
			"url": "getStudentList",
			"data":{
				'csrf_pat': $('input[name=csrf_pat]').val(),
			},
			"type": "POST",
		},
		order: [
			[7, 'desc']
		],
		"columns": [
			{ data: 'S_Name' },
			{ data: 'S_Surname' },
			{ data: 'S_Email' },
			{ data: 'S_BraceletID' },
			{ data: 'S_P_ID' },
			{ data: 'Sc_Name' },
			{ data: 'C_Class_Name' },
			{ data: 'Created_date' },
			{ data: '' },
		],
	});

	$('#classtable').DataTable({
		"processing": true,
		"serverSide": true,
		'serverMethod': 'post',
		"ajax": {
			"url": "getClassList",
			"data":{
				'csrf_pat': $('input[name=csrf_pat]').val(),
			},
			"type": "POST",
		},
		order: [
			[2, 'desc']
		],
		"columns": [
			{ data: 'Sc_Name' },
			{ data: 'C_Class_Name' },
			{ data: 'Created_date' },
			{ data: '' },
		],
	});

	$('#teachertable').DataTable({
		"processing": true,
		"serverSide": true,
		'serverMethod': 'post',
		"ajax": {
			"url": "getTeacherList",
			"data":{
				'csrf_pat': $('input[name=csrf_pat]').val(),
			},
			"type": "POST",
		},
		order: [
			[5, 'desc']
		],
		"columns": [
			{ data: 'T_Username' },
			{ data: 'T_Dob' },
			{ data: 'T_Email' },
			{ data: 'T_Phone' },
			{ data: 'Sc_Name' },
			{ data: 'T_Created_date' },
			{ data: '' },
		],
	});

	$('#parenttable').DataTable({
		"processing": true,
		"serverSide": true,
		'serverMethod': 'post',
		"ajax": {
			"url": "getParentList",
			"data":{
				'csrf_pat': $('input[name=csrf_pat]').val(),
			},
			"type": "POST",
		},
		order: [
			[2, 'desc']
		],
		"columns": [
			{ data: 'P_Name' },
			{ data: 'P_Email' },
			{ data: 'P_Created_date' },
			{ data: '' },
		],
	});

	/* Ajax through datatable Student END*/
	$('#schooltable').DataTable();

	$(document).on("click", ".removestudent", function() {
		var id = $(this).attr('data-id');
		if (confirm('Are you sure to remove this record ?')) {
			$.ajax({
				url: 'deleteStudent/' + id,
				type: 'post',
				success: function(response) {
					location.reload();
					$(".successmsg").html(response);
				},
				error: function() {

				},
			});
		}
	});

	$(document).on("click", ".removeteacher", function() {
		var id = $(this).attr('data-id');
		if (confirm('Are you sure to remove this record ?')) {
			$.ajax({
				url: 'deleteteacher/' + id,
				type: 'post',
				success: function(response) {
					location.reload();
					$(".successmsg").html(response);
				},
				error: function() {

				},
			});
		}
	});

	$(document).on("click", ".removeparent", function() {
		var id = $(this).attr('data-id');
		if (confirm('Are you sure to remove this record ?')) {
			$.ajax({
				url: 'deleteparent/' + id,
				type: 'post',
				success: function(response) {
					location.reload();
					$(".successmsg").html(response);
				},
				error: function() {

				},
			});
		}
	});

	$(document).on("click", ".classesremove", function() {
		var id = $(this).attr('data-id');
		if (confirm('Are you sure to remove this record ?')) {
			$.ajax({
				url: 'deleteclass/' + id,
				type: 'post',
				success: function(response) {
					location.reload();
					$(".successmsg").html(response);
				},
				error: function() {

				},
			});
		}
	});

	/*Select 2 for class*/
	$('.classcls').select2({
		placeholder: "-Select Class-"
	});
	/*Select 2 for class*/
});