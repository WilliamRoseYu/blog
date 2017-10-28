<?php
	class Upload {
		private $ext;
		private $fileInfo;
		public function run($file) {
			$path = "./public/upload/";
		$this->fileInfo = $_FILES[$file];
		if (!$this->checkType($_FILES[$file]["type"])){
				return 'type error';
			}
		
		if (!$this->checkSize($_FILES[$file]["size"])){
			return 'size error';
		}
		$ext = $this->getExt($_FILES[$file]["name"]);
		$fileName = 'img_'.time().rand(1,1000000).$ext;
		$fileName = $path.$fileName;
		move_uploaded_file($_FILES[$file]["tmp_name"],$fileName);

		return $fileName;

	}   public function checkType($type) {
			$base = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif');
			if (in_array($type, $base)) {
				return true;
			} 
			return false;
		}

		public function checkSize($size) {
			if ($size <= 200000){
				return true;
			}
			return false;
		}


		public function getExt($name) {
			$pos = strrpos($name, '.');
			$ext = substr($name, $pos);
			$this->ext = $ext;
			return $ext;
		}

		public function returnExt() {
			return $this->ext;
		}

		public function returnSize() {
			return $this->fileInfo['size'];
		}
	}