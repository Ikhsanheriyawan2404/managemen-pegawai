<?php
namespace application\controllers;
use \Controller;

class MainController extends Controller {

   public function __construct()
   {
      $this->model('user');
      // $user = $_SESSION['username'];
      if (empty($_SESSION['username']) && empty($_SESSION['password'])){
         $this->redirect('auth');
      }
   }

   public function template($viewName, $data=array()){
      $view = $this->view('template/app');
      $view->bind('viewName', $viewName);
      $view->bind('data', $data);   
   }
} 