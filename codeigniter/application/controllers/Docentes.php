<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docentes extends CI_Controller {

	public function index($page="tabladocentes")
	{
		$this->load->view($page);
	}
	public function agrega(){
		$this->load->view('agregarnuevo');
	}
	public function elimina($param=""){
		$conn = mysqli_connect("localhost","root","");
		if ($conn == false){
    			echo "Ocurrio un error";
    			die();
		}
		mysqli_select_db($conn, "FCPN");
		$query="delete from usuario where ci=".$param.";";
		$res=$conn->query($query);
		$this->load->view('tabladocentes');
	}
	public function terminar(){
		$conn = mysqli_connect("localhost","root","");
		if ($conn == false){
			echo "Ocurrio un error";
			die();
		}
		mysqli_select_db($conn, "FCPN");
		$query='insert into usuario(ci, nombre, departamento, usuario, fecha_nac, password_u, tipo) values('.$_POST['ci'].', "'.$_POST['nombre'].'", "'.$_POST['depa'].'", "'.$_POST['usuario'].'","'.$_POST['fecha'].'","'.$_POST['pass'].'","D");';
		$res=$conn->query($query);
		$this->load->view('tabladocentes');
	}
	public function editar($ci=0){
		$_POST['var']=$ci;
		$this->load->view('editar');
	}
	public function editado(){
		$conn = mysqli_connect("localhost", "root", "");
		if($conn == false){
			echo "ocurrio error BD";
			die();
		}
		mysqli_select_db($conn, "FCPN");
		$query = 'update usuario set nombre="'.$_POST['nombre'].'", departamento="'.$_POST['depa'].'", usuario="'.$_POST['usuario'].'", fecha_nac="'.$_POST['fecha'].'", tipo="D", password_u="'.$_POST['pass'].'" where ci='.$_POST['ci'].';';
		$res=$conn->query($query);
		$this->load->view('tabladocentes');
	}
}

