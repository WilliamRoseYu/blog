<?php
	class CommentModel extends Model {
		public $table = "comment";
		public function add($blog_id,$user_id, $parent_id=0,$content='') {
			$date = date('Y-m-d H:i:s');
			$sql = "insert into comment(blog_id, parent_id,user_id,content,createtime) values ('{$blog_id}', {$parent_id}, {$user_id}, '{$content}','{$date}')";
			return $this->mysqli->query($sql);
		}
	}