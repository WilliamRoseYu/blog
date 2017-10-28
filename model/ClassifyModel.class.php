<?php
	class ClassifyModel {
		public $mysqli;
		public function __construct() {
			$this->mysqli = new mysqli("127.0.0.1","root","","blog");
			$this->mysqli->query('set names utf8');
		}
		public function getLists() {
			$sql = "select * from classify where parent_id = 0";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			foreach ($data as $key => $value) {
				$sqlChild = "select * from classify where parent_id = {$value['id']}";
				$resChild = $this->mysqli->query($sqlChild);
				$child = $resChild->fetch_all(MYSQL_ASSOC);
				$data[$key]['child'] = $child;
			}
			return $data;
		}
		public function addclassify($data){
			$sql = "insert into classify(name,parent_id) value ('{$data['name']}','{$data['parent_id']}')";
			// echo $sql;
			// die();
			$res = $this->mysqli->query($sql);
			return $res;
		}
		public function getall(){
			$sql = "select * from classify";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data;
		}
		public function audit($id,$status){
			$sql = "update  classify set status={$status} where id = {$id}";
			$res = $this->mysqli->query($sql);
			return $res;
		}
		public function getClassifyByID($id){
			$sql = "select * from classify where id= {$id}";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return isset($data[0]) ? $data[0] :array();
		}
		public function edit($name,$parent_id,$id){
			$sql = "update  classify set name='{$name}',parent_id={$parent_id} where id = {$id}";
			$res = $this->mysqli->query($sql);
			return $res;
		}
		public function getParentLists(){
			$sql = "select * from classify where parent_id = 0";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data;
		}
		public function getBclassify($parent_id){
			$sql = "select * from classify where parent_id = {$parent_id}";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data;
		}

	}