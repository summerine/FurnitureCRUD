<?php 

class Barang {
	private $mysqli;

	function __construct($conn) {
		$this->mysqli = $conn;

	}

	public function tampil($id = null) {
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM tb_barang";
		if($id != null){
			$sql .= " WHERE id_brg = $id";
		}
		$query = $db->query($sql) or die($db->error);
		return $query;

	}

	public function tambah($nama_brg, $harga_brg, $stok_brg, $gbr_brg){
		$db = $this->mysqli->conn;
		$db->query("INSERT INTO tb_barang VALUES('','$nama_brg','$harga_brg','$stok_brg','$gbr_brg')") or die($db->error);
	}
}


 ?>