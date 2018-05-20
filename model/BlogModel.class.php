<?php
	class BlogModel extends Model {
		// public $mysqli;
		// function __construct() {
		// 	$this->mysqli = new mysqli("127.0.0.1","root","","blog");
		// 	$this->mysqli->query('set names utf8');
		// }
		public $table = "blog";
		public $field = array(
			'id',
			'title',
			'content',
			'classfy_id',
			'createtime',);

		public function addBlog($data){
			$res = $this->add($data);
			return $res;
		}
		public function getBlogLists($offset=0, $limit=20,$order='id asc',$where='1') {
			$data = $this->getLists($offset, $limit,$order,$where);
			return $data;
		}
		function getBlogCount () {
			$num = $this->getCount();
			return $num;
		}
		public function audit($id, $status=0) {
			$sql = "update blog set status = {$status} where id = {$id}";
			return $this->mysqli->query($sql);
		}
		public function editBlog($data, $id) {
			$where = array('id ='=> $id);
			return $this->edit($where, $data);
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