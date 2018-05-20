<?php
	class BlogController {	
	public function add () {
			$classifyModel = new ClassifyModel();
			$classify = $classifyModel->getLists();
			include "./view/blog/add.html";
		}
	public function doAdd() {
			$upload = L("Upload");
			$uploadRes = $upload->run('image');
			if ($uploadRes['status'] == 'error') {
				die($uploadRes['msg']);
			}
			$filename = $upload->run('image');
			$content = $_POST['content'];
			$classify = $_POST['classify'];
			$title = $_POST['title'];
			$data = array(
				'content' 	=> $content,
				'classify_id' 	=> $classify,
				'title' 	=> $title,
				'image' 	=> $filename,
				);
			$blogModel = new BlogModel();
			$status = $blogModel->addBlog($data);
			if ($status) {
				header('Refresh:1,Url=index.php?c=Blog&a=lists');
				echo '发布成功，1秒后跳转到list';
				die();
			}
		}

	public function lists() {
			$blogModel = new BlogModel();
			$data = $blogModel->getBlogLists();
			foreach ($data as $key => $value) {
				$model_info = $userModel->getModelInfoById($value['']);
				$data[$key]['user_name'] = $user_info['name'];
			}
			include "./view/blog/lists.html";
		}
		public function Image(){
			include "./view/blog/upload.html";
		}
		public function doImage(){
			// echo "<pre>";
			
			//move_uploaded_file($_FILES['file']["tmp_name"], './public/upload/'.$_FILES['file']['name']);
			//move_uploaded_file($_FILES['file']["tmp_name"],"./public/uplode/".$_FILES['file']['name']);
			// echo "</pre>";
			include "./library/Upload.class.php";
			$upload = new Upload();
			$filename = $upload->run('file');
			echo $filename;
			echo $upload->returnSize();

		}
		public function info(){
			$id = $_GET['id'];
			$blogModel = new BlogModel();
			$info = $blogModel->getUserInfoById($id);


			include "./view/blog/info.html";
		}
	}
		