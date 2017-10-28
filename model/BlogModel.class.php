<?php
	class BlogModel {
		public $mysqli;
		function __construct() {
			$this->mysqli = new mysqli("127.0.0.1","root","","blog");
			$this->mysqli->query('set names utf8');
		}
		function addBlog($title,$content,$image,$createtime){
			$sql = "insert into blog(title,content,image,createtime) value ('{$title}','{$content}','{$image}','{$createtime}')";
			$res = $this->mysqli->query($sql);
			return $res;
		}
		function getBlogLists() {
			$sql = "select * from blog";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data;
		}
		function getUserInfoByName($name) {
			$sql = "select * from user where name = '{$name}'";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data[0];
		}
		function getUserInfoById($id) {
			$sql = "select * from blog where id = '{$id}'";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);

			return isset($data[0]) ? $data[0] : array();
		}

		
	}