/* This file contains JavaScript for setting.blade.php
Created By: Ronak Patel */

$(document).ready(function(){
	var userID = $("#userID").text();
	$("#alert").addClass("d-none");
	var d = new Date(Date.now());
	var maxDate = d.toISOString().split('T')[0];
	$("#birthday").attr("max", maxDate);
	$.ajax({
		url: '/public/getProfileDetails',
		type: 'GET',
		success: function(data){
			$("#name").val(data.name);
			$("#birthday").attr("value", data.birthday);
			if(data.gender){
				if(data.gender == "Male"){
					 $("#male").prop("checked", true);
				}else if(data.gender == "Female"){
					$("#female").prop("checked", true);
				}else if(data.gender == "Prefer Not To Say"){
					$("#notToSay").prop("checked", true);
				}
			}
			if(data.isPrivate){
				$("#private").prop("checked", true);
			}else{
				$("#public").prop("checked", true);
			}
		},
		error: function(error){
			alert("Couldn't get profile data");
		}
	});
	
	$('.card-body').on('click','a', function(){
		$("#alert").addClass("d-none");
		var bookId = $(this).attr('id');
		$.ajax({
			url: '/public/deleteShelfBook/' + bookId,
			type: 'GET',
			success: function(data){
					location.reload(true);
				},
			error: function(error){
				alert("Deletion Failed");
			}
		});
	});
	
	//Validate Form and Update Database
	$('form').submit(function(){
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var birthday = $("#birthday").val();
		var name = $("#name").val();
		var gender = "";
		if($("#male").prop("checked")){
			gender = "Male";
		}else if($("#female").prop("checked")){
			gender = "Female";
		}else if($("#notToSay").prop("checked")){
			gender = "Prefer Not To Say";
		}
		var isPrivate = false;
		if($("#private").prop("checked")){
			isPrivate = true
		}
		$.ajax({
			url: '/public/editProfile',
			type: 'POST',
			data: {_token: CSRF_TOKEN, name: name, birthday: birthday, gender: gender, isPrivate: isPrivate},
			success: function(data){
				if(data == "success"){
					$("#message").html("Changes to your <a href='/public/profile'>Profile</a> has been saved.");
					$("#alert").removeClass("d-none");
				}
			},
			error: function(error){
				alert("Something went wrong while updating your Profile");
			}
			
		});
		return false;
	});
});