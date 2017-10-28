<?php
	class HomeController {
		function index()
		{
			$blogModel = new BlogModel();
			$res = $blogModel->getBlogLists();
		// var_dump($res);
		// die();
			include"./view/home/index.html";
		}

	}