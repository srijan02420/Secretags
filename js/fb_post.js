		  // Additional JS functions here
		  
		  
				//var global_baseurl = <?=site_url('signup/register')?>;		  
		  window.fbAsyncInit = function() {
			FB.init({
			  appId      : '481439511903117', // App ID
			  channelUrl : '//riklr.com/channel.html', // Channel File
			  status     : true, // check login status
			  cookie     : true, // enable cookies to allow the server to access the session
			  xfbml      : true  // parse XFBML
			});
			
						// Additional init code here
			FB.getLoginStatus(function(response) {
				if (response.status === 'connected') {
					// connected
					//self.location="home";
					id = response.authResponse.userID;
					//alert(id);
				} else if (response.status === 'not_authorized') {
					//self.location="http://localhost/Secretags/landing";
				} else {
					//self.location="http://localhost/Secretags/landing";
				}
			});

		  };
		
		function postToFeed(conff_id,tags,type,gender,conff) {
        // calling the API ...
		//alert(type);
		if(type = 1)
				type = 'Confession';
		else if(type = 2)
				type = 'Proposal';
		else if(type = 3)
				type = 'Compliment';
		else
			type = 'Secret Post';
		FB.ui(
		  {
			method: 'feed',
          link: 'http://localhost/Secretags/secretpost/post/'+conff_id,
          picture: 'http://localhost/Secretags/images/'+gender+'.jpg',
          name: type,
          caption: tags,
          description: conff
		  },
		  function(response) {
			if (response && response.post_id) {
			  share(conff_id);
			} else {
			  // alert('Post was not published.');
			}
		  }
		);
		
      }
	  
	  
		  function logout() {
				FB.logout(function(response) {
					  // user is now logged out
					  self.location="http://localhost/Secretags/session/logout";
					});
				
			}
		
		function liketofb(url){	
			
			FB.api('/me/og.likes', 'post', {
				object: url
			},

			function (response) {
				console.log(response);
				if (!response || response.error) {
					//alert(response.error.message);
					
				} else {
					//alert('Demo was liked successfully! Action ID: ' + response.id);
					
				}
			});
		}
		
		function commenttofb(url){	
		
			FB.api(
			  'me/riklrapp:comment',
			  'post',
			  {
				post: url
			  },
			  function(response) {
				console.log(response);
				if (!response || response.error) {
					//alert(response.error.message);
				} else {
					//alert('Demo was liked successfully! Action ID: ' + response.id);
				}
			  }
			);

			// function (response) {
				// console.log(response);
				// if (!response || response.error) {
					// alert(response.error.message);
				// } else {
					// alert('Demo was liked successfully! Action ID: ' + response.id);
				// }
			// });
		}
			
		  // Load the SDK Asynchronously
		  (function(d){
			 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
			 if (d.getElementById(id)) {return;}
			 js = d.createElement('script'); js.id = id; js.async = true;
			 js.src = "//connect.facebook.net/en_US/all.js";
			 ref.parentNode.insertBefore(js, ref);
		   }(document));
		   
		function share(conff_id){
			
		   $.post("http://localhost/Secretags/post/share_conff", { conff_id: conff_id,user_id: id} )
			.done(function(data) {
				//longPollpost(id,conff_id);
			});
				//$('.noofshares'+conff_id).text(parseInt($('.noofshares'+conff_id).text(),10)+1);
			}
		   
		function like(conff_id,i){
			//alert(id);
			if($(i).html() == 'Unlike')
				{
				$(i).html("Like");
				$('.nooflikes'+conff_id).html(parseInt($('.nooflikes'+conff_id).html())-1);
				}
			else
				{
				$(i).html("Unlike");
				$('.nooflikes'+conff_id).html(parseInt($('.nooflikes'+conff_id).html())+1);
				}
				
		   $.post("http://localhost/Secretags/post/like_conff", { conff_id: conff_id, user_id: id } )
			.done(function(data) {
				//longPollpost(id,conff_id);
				liketofb('http://localhost/Secretags/secretpost/post/'+conff_id);
			});
			
			}
			
		function like_comment(comment_id,conff_id,i){
			if($(i).html() == 'Unlike')
				{
				$(i).html("Like");
				$('.noofcommentlikes'+comment_id).html(parseInt($('.noofcommentlikes'+comment_id).html())-1);
				}
			else
				{
				$(i).html("Unlike");
				$('.noofcommentlikes'+comment_id).html(parseInt($('.noofcommentlikes'+comment_id).html())+1);
				}
		   $.post("http://localhost/Secretags/post/like_comment", { comment_id: comment_id, user_id: id } )
			.done(function(data) {
				//longPollpost(id,conff_id);
				//$("#"+conff_id).toggle(500);
			});
			}
				
		function add_comment(conff_id){
			if($('#commnt'+conff_id).val().length > 0)
			{
			   $.post("http://localhost/Secretags/post/post_comment", { gender: $('#gender'+conff_id).val(), user_id: id, conff_id: conff_id, comment: $('#commnt'+conff_id).val().replace(/\n/g, "<br />") } )
				.done(function(data) {
					longPollpost(id,conff_id);
					$('#commnt'+conff_id).val('');
					if($('#gender'+conff_id).val() == 0)
						commenttofb('http://localhost/Secretags/secretpost/post/'+conff_id);
				});
			}
			else
				alert("You forgot to write anything!");
			}
		function delete_comment(comment_id){
		   $.post("http://localhost/Secretags/del_comment.php", { comment_id: comment_id } )
			.done(function(data) {
				longPoll(id,0) ;
			});
		}
		
		function follow_tag(tag_id,user_id){
		//alert(tag_id);
		   $.post("http://localhost/Secretags/post/follow_tag", { tag_id: tag_id ,user_id : user_id} )
			.done(function(data) {
				location.reload();
			});
		}
		
		function refreshScore(id)
		{
			$.get("http://localhost/Secretags/json/json_get_scoreboard.php", 
					//async = true,
					{ user_id : id})
					.done(function(data)
					{
						 score = JSON.parse(data); 
						$('#user_score').html(score.points[0].score);
					});	
		}

		