function get_tags_friends(user_id){
	var students = new Array();	
		 //alert('helo');
		$('.search-query').typeahead({
			source: function (query, process) {
				return $.get("http://localhost/Secretags/json/json_get_tags_friends.php",{ query: query , user_id : user_id}, function (data) {
				//alert(data);
					students = JSON.parse(data);
					var results = _.map(students, function(product) {
						   return (product.tag);
						});
						process(results);
				});
			},
		
			matcher: function(item) {
				if (item.toLowerCase().indexOf(this.query.trim().toLowerCase()) != -1) {
					return true;
				}
            },
			 
            highlighter: function(tag) {
               var product = _.find(students, function(p) {
                   return p.tag == tag;
                });
				if(product.tag_friend==0)
					return '#'+product.tag;
				else
					return '@'+product.tag;
                
            },
 
            updater: function(tag) {
				var product = _.find(students, function(p) {
                   return p.tag == tag;
                });
				if(product.tag_friend==0)
					window.location.assign('http://localhost/Secretags/tags/tag/'+product.tag_id);
				else
					window.location.assign('http://localhost/Secretags/home/profile/'+product.tag_id);
            }
 
        });
				
	}