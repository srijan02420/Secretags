<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Json extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
		}
	
	public function get_conff()
	{

		$response = array();
		$time = time();
		$conff = array();
		$liked_arr = array();
		$commented = array();
		$liked_comment = array();
		
		$user_id = $_GET['user_id'];
		
		$this->security->xss_clean($user_id);
		
		$tags = $this->db->query("SELECT * FROM user_tag where user_id = ".$user_id." ;");
		
		foreach($tags->result() as $row){
			$tag_conff = $this->db->query("SELECT * FROM conff_tag where tag_id = ".$row->tag_id." limit 100 ;");
			//many conff_id
			foreach($tag_conff->result() as $arow){
					array_push($conff, $arow->conff_id);
			}
		}
		
		$friends = 'user_id = '.$user_id;
		$this->db->select('friend_id');
		$this->db->where('user_id', $user_id); 
		$get_friends = $this->db->get('user_friend');
			foreach($get_friends->result() as $w){
				$friends = $friends.' or user_id = '.$w['friend_id'];
			}	
		
		$query_comment = $this->db->query("SELECT conff_id FROM comment where $friends limit 100 ;");
			foreach($query_comment->result() as $w){
				array_push($conff, $w->conff_id);
				array_push($commented, $w->conff_id);
			}
				
		$like_conff = $this->db->query("SELECT conff_id FROM conff_like where $friends limit 100 ;");
		//many conff_id
		foreach($like_conff->result() as $w)
			{
				array_push($conff, $w->conff_id);
				array_push($liked_arr, $w->conff_id);
			}
		
		$result = array_unique($conff);
		$conff = array_values($result);
		
		if(sizeof($conff)>0)
		{
			$orconff = "conff_id = ".$conff[0];
				for($i=1;$i<sizeof($conff);$i++)
					{
					$orconff = $orconff." or conff_id = ".$conff[$i];
					}
								
			$get_conff = $this->db->query("SELECT * FROM conff where $orconff order by activity_time desc limit 100;");
						$response["conff"] = array();
					if ($get_conff->num_rows() > 0) 
					{
							foreach($get_conff->result() as $row){
							
								if( $time - $row->activity_time < 50 || $_GET['first']==1){
								
								$time = $this->time_elapsed_string($row->time);
								$activity_time = $row->activity_time;
								//echo time();
								//echo $row->conff_id;
								$conff_id = $row->conff_id;
								
								$get_likes = $this->db->query("SELECT * FROM conff_like where conff_id = ".$conff_id." ;");
								$total_likes = $get_likes->num_rows();
								if($total_likes==null)
									$total_likes = 0;
								$liked = false;
								foreach($get_likes->result() as $row1){
								{
									if($row1->user_id==$user_id)
										$liked = true;
								}
								$conff = array();
								$conff["special_name"] = '';
								$conff["special_id"] = 0;
								$conff["special_type"] = 0;

								if(in_array($row->conff_id, $liked_arr))
									{
										$get_person_id = $this->db->query("SELECT user_id FROM conff_like where conff_id = ".$conff_id." ORDER BY id DESC LIMIT 1 ;");
										if ($get_person_id->num_rows() > 0) 
										{
											$row1 = $get_person_id->row();
											$get_person_name = $this->db->query("SELECT name FROM users where user_id = $row1->user_id ;");
											$person = $get_person_name->row();
											$conff["special_name"] = $person->name;
											$conff["special_id"] = $row1->user_id;
											$conff["special_type"] = 2;
										}
									}
								
								else if(in_array($row->conff_id, $commented))
									{
										$get_person_id = $this->db->query("SELECT user_id FROM comment where conff_id = ".$conff_id." ORDER BY comment_id DESC LIMIT 1 ;");
										if ($get_person_id->num_rows() > 0) 
										{
											$row1 = $get_person_id->row();
											$get_person_name = $this->db->query("SELECT name FROM users where user_id = $row1->user_id ;");
											$person = $get_person_name->row();
											$conff["special_name"] = $person->name;
											$conff["special_id"] = $row1->user_id;
											$conff["special_type"] = 1;
										}
									}
									
									$get_who_is = mysql_query("SELECT * FROM users where user_id = ".$user_id." ;");
									$get_who_is_info = mysql_fetch_row($get_who_is);
									$s_pic = $get_who_is_info[8];
									$name = $get_who_is_info[2];
															
									// temp user array
									
									$conff["conff_id"] = $row->conff_id;
									$conff["user_id"] = $row->user_id;
									$conff["conff"] = $row->conff;
									$conff["type"] = $row->type;
									$conff["gender"] = $row->gender;
									$conff["time"] = $time;
									$conff["shares"] = $row->share;
									$conff["user_liked"] = $liked;
									$conff["total_likes"] = $total_likes;
									$conff["user_name"] = $name;
									$conff["photo"] = $s_pic;
									$conff["activity_time"] = $activity_time;

									$conff["tags"] = array();
									
									$conff["tags"] = array();
								
						
								$get_tags_id = mysql_query("SELECT * FROM conff_tag where conff_id = ".$conff_id." ;");
											while($row2 = mysql_fetch_array($get_tags_id))
											{
												$get_tags_names = mysql_query("SELECT * FROM tag where tag_id = ".$row2['tag_id']." ;");
												$tags = mysql_fetch_row($get_tags_names);
												$tag = $tags[1];
												
												$taga = array();
												$taga["tag_id"] = $row2['tag_id'];
												$taga["tag"] = $tag;
												
												array_push($conff["tags"], $taga);
											}
								/////////////////////////////////comments////////////////////////////////////////////////////////////////
								$get_comments = mysql_query("SELECT * FROM comment where conff_id = ".$conff_id." ;");
								
									$conff["comment"] = array();
									while($row = mysql_fetch_array($get_comments))
									{
											$time = $this->time_elapsed_string($row['time']);
											
											$comment_id = $row['comment_id'];
											
											$get_likes_comments = mysql_query("SELECT * FROM comment_like where comment_id = ".$comment_id." ;");
											$total_likes_comments = mysql_num_rows($get_likes_comments);
											if($total_likes_comments==null)
												$total_likes_comments = 0;
											$liked = false;
											while($row1 = mysql_fetch_array($get_likes_comments))
											{
												if($row1['user_id']==$user_id)
													$liked = true;
												//print_r($row->user_id);
												 
											}
											$user_id = $row["user_id"];
											$get_who_commented = mysql_query("SELECT * FROM users where user_id = ".$user_id." ;");
											$get_who_commented_info = mysql_fetch_row($get_who_commented);
											$s_pic = $get_who_commented_info[8];
											$name = $get_who_commented_info[2];
							
											// temp user array
											$comment = array();
											$comment["conff_id"] = $row['conff_id'];
											$comment["comment_id"] = $row['comment_id'];
											$comment["user_id"] = $row["user_id"];
											$comment["comment"] = $row["comment"];
											$comment["gender"] = $row["gender"];
											$comment["time"] = $time;
											$comment["user_liked"] = $liked;
											$comment["total_likes"] = $total_likes_comments;
											$comment["user_name"] = $name;
											$comment["photo"] = $s_pic;
											
											array_push($conff["comment"], $comment);
									}
								
								//////////////////////////////////////////////////////////////////////////////////////////////////////////
								
								// push single product into final response array
								array_push($response["conff"], $conff);
								//echo $conff["conff_id"];\\
							}
						}
						}
						
						
				
							// success
							$response["success"] = 1;

							// echoing JSON response
						echo json_encode($response);
				
					}
		}
	}

	public function share_conff()
	{
	
		$time = time();
		
		$conff = array(
		   'conff_id' => $_POST['conff_id'] ,
		   'user_id' => $_POST['user_id'] ,
		   'time' => $time
		);
		$share = "share";
		$r = 1;
		$this->security->xss_clean($conff);
		
		$this->db->where('conff_id', $conff['conff_id']);
		$this->db->update('conff', array('share' => $share+$r));
						
		$this->db->select('id');
		$this->db->where('user_id', $conff['user_id']); 
		$this->db->where('conff_id', $conff['conff_id']); 
		$check = $this->db->get('user_share');
		if($check->num_rows()==0)
				{			
					$this->db->insert('user_share', $conff);
				}	
	}
	
	public function like_conff()
	{

		$time = time();
		
		$conff = array(
		   'conff_id' => $_POST['conff_id'] ,
		   'user_id' => $_POST['user_id'] ,
		   'time' => $time
		);
		
		$this->security->xss_clean($conff);
			
				
		$this->db->select('id');
		$this->db->where('user_id', $conff['user_id']); 
		$this->db->where('conff_id', $conff['conff_id']); 
		$check = $this->db->get('conff_like');
		if($check->num_rows()==0)
				{			
					$this->db->insert('conff_like', $conff);
					
					$this->db->where('conff_id', $conff['conff_id']);
					$this->db->update('conff', array('activity_time' => $time));
				}
		else
			{
			$this->db->where('user_id', $conff['user_id']); 
			$this->db->where('conff_id', $conff['conff_id']); 
			$this->db->delete('conff_like'); 
			}
	}

	public function like_comment()
	{

		$time = time();
		$conff = array(
		   'comment_id' => $_POST['comment_id'] ,
		   'user_id' => $_POST['user_id'] ,
		   'time' => $time
		);
		
		$this->security->xss_clean($conff);
			
		$this->db->select('id');
		$this->db->where('user_id', $conff['user_id']); 
		$this->db->where('comment_id', $conff['comment_id']); 
		$check = $this->db->get('comment_like');
		if($check->num_rows()==0)
				{			
					$this->db->insert('comment_like', $conff);
					
					$get_who_commented = mysql_query("SELECT * FROM comment WHERE comment_id = '$comment_id'");
					$this->db->select('conff_id');
					$this->db->where('comment_id', $conff['comment_id']); 
					$row = $this->db->get('comment');
					
					$this->db->where('conff_id', $conff['conff_id']);
					$this->db->update('conff', array('activity_time' => $time));
				}
		else
			{
			$this->db->where('user_id', $conff['user_id']); 
			$this->db->where('comment_id', $conff['comment_id']);
			$this->db->delete('comment_like'); 
			}
	}

	public function post_comment()
	{

		$time = time();
		$conff = array(
		   'conff_id' => $_POST['conff_id'] ,
		   'user_id' => $_POST['user_id'] ,
		   'comment' => $_POST['comment'] ,
		   'gender' => $_POST['gender'] ,
		   'time' => $time
		);
		
		$this->security->xss_clean($conff);
					
		$this->db->insert('comment', $conff);
		$this->db->update('conff', array('activity_time' => $time), array('conff_id' => $conff['conff_id']));	//check it
				
	}

	public function follow_tag()
	{

		$time = time();
		
		$tag = array(
		   'tag_id' => $_POST['tag_id'] ,
		   'user_id' => $_POST['user_id'] ,
		   'time' => $time
		);
		
		$this->security->xss_clean($tag);
			
		$this->db->select('id');
		$this->db->where('user_id', $tag['user_id']); 
		$this->db->where('tag_id', $tag['tag_id']); 
		$check = $this->db->get('user_tag');
		if($check->num_rows()==0)
			{			
				$this->db->insert('user_tag', $tag);
			}
		else
			{
				$this->db->where('user_id', $tag['user_id']); 
				$this->db->where('tag_id', $tag['tag_id']); 
				$this->db->delete('user_tag'); 
			}
	}
	
	public function time_elapsed_string($ptime) {
			$etime = time() - $ptime;
			
			if ($etime < 1) {
				return '0 seconds ago';
			}
			
			$a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
						30 * 24 * 60 * 60       =>  'month',
						24 * 60 * 60            =>  'day',
						60 * 60                 =>  'hour',
						60                      =>  'minute',
						1                       =>  'second'
						);
			
			foreach ($a as $secs => $str) {
				$d = $etime / $secs;
				if ($d >= 1) {
					$r = round($d);
					return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
				}
			}
		}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
