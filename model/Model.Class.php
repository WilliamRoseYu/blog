<?php
	class Model {
		public $mysqli;
		function __construct() {
			include "./conf/config.php";
			$this->mysqli = new mysqli($conf['host'],$conf['user'],$conf['password'],$conf['dbname']);
			$this->mysqli->query('set names utf8');
		}
		public function getInfoById($id) {
			$sql = "select * from {$this->table} where id = {$id}";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQLI_ASSOC);
			return isset($data[0]) ? $data[0] : array();
		}
		public function getLists($offset=0, $limit=20,$order='id asc',$where='1') {
			$sql = "select * from {$this->table} where {$where} order by {$order} limit {$offset},{$limit}";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQLI_ASSOC);
			return $data;
		}
		public function getCount ($where='1') {
			$sql = "select count(*) as num from {$this->table} where {$where}";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQLI_ASSOC);
			return $data[0]['num'];
		}
		public function add($data) {
			$data['createtime'] = date('Y-m-d H:i:s');
			$sql ="insert into {$this->table} ";
			$keys = "(";
			$values = "(";
			foreach ($data as $key=>$value) {
				if (!in_array($key, $this->field)) {
					continue;
				}
				$keys .= $key .",";
				if (is_string($value)) {
					$value = "'".$value."'";
				}
				$values .= $value . ",";
			}
			$keys = rtrim($keys, ',') . ")";
			$values = rtrim($values, ',') . ")";
			$sql = "{$sql} {$keys} value {$values}";
			$res = $this->mysqli->query($sql);
			return $res;
		}
		public function edit($where, $data) {
			$sql = "update {$this->table} set ";
			foreach ($data as $key=>$value) {
				if (!in_array($key, $this->field)) {
					continue;
				}
				if (is_string($value)) {
					$value = "'".$value."'";
				}
				$sql .= $key . '=' . $value . ",";
			}
			
			$sql = rtrim($sql, ',');
			$sql .= " where ";
			foreach ($where as $key=>$value) {
				if (is_string($value)) {
					$value = "'".$value."'";
				}
				$sql .= $key . $value . " and ";
			}
			$sql = rtrim($sql, 'and ');
			
			$res = $this->mysqli->query($sql);
			return $res;
		}
	}
