<?php
	class ClassifyController {
		public function __construct() {
		}
		public function add () {
			$classifyModel = new ClassifyModel();
			$classify = $classifyModel->getLists();
			include "./view/classify/add.html";
		}
		public function doAdd() {
			$classifyModel = new ClassifyModel();
			$name = $_POST['name'];
			$parent_id = $_POST['parent_id'];
			$data = array(
				'name' 	=> $name,
				'parent_id' => $parent_id,
				);
			// var_dump($data);
			// die();
			$status = $classifyModel->addclassify($data);
			// var_dump($status);
			// die();
			if ($status) {

				header('Refresh:1,Url=index.php?c=classify&a=lists');
				echo '成功';
				die();
			} else {
				echo'错误';
				header('Refresh:1,Url=index.php?c=classify&a=lists');
			}

		}
		public function getall(){
			$classifyModel = new ClassifyModel();
			$data = $classifyModel->getall();

			include "./view/classify/lists.html";
		}
		public function lists() {
			$classifyModel = new ClassifyModel();
			$data = $classifyModel->getLists();
			
			include "./view/classify/lists.html";
			}
		public function onLine() {
		$id = $_GET['id'];
		$classifyModel = new ClassifyModel();	
		$data = $classifyModel->audit($id,1);
		if ($data) {
			header('Refresh:1,Url=index.php?c=classify&a=lists');
			echo "上线成功";
			die();
		}
	}
		public function offLine() {
		$id = $_GET['id'];
		$classifyModel = new ClassifyModel();
		$data = $classifyModel->audit($id,0);
		if ($data) {
			header('Refresh:1,Url=index.php?c=classify&a=lists');
			echo "下线成功";
			die();

		}
	}
		public function edit(){
			$id = $_GET['id'];
			$classmodel = new ClassifyModel();
			$classifyParent = $classmodel ->getParentLists();
			$data = $classmodel ->getClassifyByID($id);

			include "./view/classify/edit.html";

		}
		public function doedit() {
			$id = $_POST['id'];
			$name = $_POST['name'];
			$parent_id = $_POST['parent_id'];
			$data = array(
				'name' 	=> $name,
				'parent_id' => $parent_id,
				'id'=>$id,
				);
			// var_dump($data);
			// die();
			$classifyModel = new ClassifyModel();
			$status = $classifyModel->edit($data);
			// var_dump($status);
			// die();
			if ($status) {

				header('Refresh:1,Url=index.php?c=classify&a=lists');
				echo '修改成功';
				die();

			} 
			else {
				echo'修改失败';
				header('Refresh:1,Url=index.php?c=classify&a=lists');
			}

		}

		}
