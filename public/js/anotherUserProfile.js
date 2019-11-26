/* This file contains JavaScript for anotherUserProfile.blade.php
Created By: Ronak Patel */

$(document).ready(function(){
	
	//Decline Friend Request or UnFriend
	var anotherUserId = $("#anotherUserId").html();
	$("#removeFriend, #decline").click(function(){
		$.ajax({
			url: '/public/removeFriendRecord/'+anotherUserId,
			type: 'GET',
			success: function(data){
				location.reload(true);
			},
			error: function(error){
				console.log("Something Went Wrong while removing Friend/declining request");
				console.log(error);
			}
		});
	});
	
	
	//Accept friend Request
	$("#acceptRequest").click(function(){
		$.ajax({
			url: '/public/acceptRequest/'+anotherUserId,
			type: 'GET',
			success: function(data){
				location.reload(true);
			},
			error: function(error){
				console.log("Something Went wrong while Accepting Request.");
				console.log(error);
			}
		});
	});
});