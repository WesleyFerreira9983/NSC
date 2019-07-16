<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$page = isset($_GET['p']) ? $_GET['p'] : "inicio";
		$type = "";
		
		if(isset($_GET['typ']))
		{
			 if($_GET['typ'] == 0)
			 {
				$type = "cadastrar-";
			 }
			 else{ 
			  if($_GET['typ'] == 1)
			  {
				$type = "consultar-";
			  }
			  else{ 
				$type = "autentica-";
			  };
			 }
		}
		
        if ( ! file_exists(APPPATH.'views/pages/'.$type.$page.'.php'))
        {			
			$page = "inicio";
			$type = "";
        }
		
        $this->load->view('templates/header');
		$this->load->view('templates/menuTop');
		$this->load->view('templates/menuLeft');
        $this->load->view('pages/'.$type.$page);
        $this->load->view('templates/footer');
	}
}
