<?php
class konek{
    var $host = "localhost";
	var $username = "root";
	var $password = "";
	var $database = "kumb";
    var $con;

    function __construct(){
		$this->con = mysqli_connect($this->host, $this->username, $this->password,$this->database);
	}   

    function register($username,$password,$nama,$nip,$pangkat,$jabatan,$unit_kerja){	
		$insert = mysqli_query($this->con,"insert into user values ('','$username','$password','$nama','$nip','$pangkat','$jabatan','$unit_kerja')");
		return $insert;
	}

    function login($username,$password,$remember){
		$query = mysqli_query($this->con,"select * from user where username='$username'");
		$data_user = $query->fetch_array();
		if(password_verify($password,$data_user['password']))
		{
			
			if($remember)
			{
				setcookie('username', $username, time() + (60 * 60 * 24 * 5), '/');
				setcookie('nama', $data_user['nama'], time() + (60 * 60 * 24 * 5), '/');
			}
			$_SESSION['username'] = $username;
			$_SESSION['nama'] = $data_user['nama'];
			$_SESSION['is_login'] = TRUE;
			return TRUE;
		}
	}

	function relogin($username){
		$query = mysqli_query($this->con,"select * from user where username='$username'");
		$data_user = $query->fetch_array();
		$_SESSION['username'] = $username;
		$_SESSION['id_user'] = $data_user['iduser'];
		$_SESSION['nama'] = $data_user['nama'];
		$_SESSION['is_login'] = TRUE;
	}

	
}