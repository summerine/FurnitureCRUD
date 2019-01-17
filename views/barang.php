<?php 
include "models/m_barang.php";

$brg = new Barang($connection);
 ?>

<div class="row">
          <div class="col-lg-12">
            <h1>Barang<small>Data Barang</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.html"><i class="icon-dashboard"></i> Barang</a></li>
            </ol>
          </div>
        </div>

<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
      <table class="table table-bordered table-hover table-striped">
        <tr>
          <th>No.</th>
          <th>Nama Barang</th>
          <th>Harga Barang</th>
          <th>Stok Barang</th>
          <th>Gambar Barang</th>
          <th>Opsi</th>
        </tr>
        <?php 

        $no = 1;
        $tampil = $brg->tampil();
        while($data = $tampil->fetch_object()){
        ?>
        <tr>
          <td><?php echo $no++."."; ?></td>
          <td><?php echo $data->nama_brg; ?></td>
          <td><?php echo $data->harga_brg; ?></td>
          <td><?php echo $data->stok_brg; ?></td>
          <td>
            <img src="assets/img/barang/<?php echo $data->gbr_brg; ?>">
          </td>
          <td>
            <button class="btn btn-info btn-xs"><i class="fa fa-edit"></i>Edit</button>
            <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>Delete</button>
          </td>
        </tr>
        <?php 
        }
         ?>
      </table>
    </div>

    <button type="button" class="btn btn-success"data-toggle="modal" data-target="#tambah">Tambah Data</button>

    <div id="tambah" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah Barang</h4>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label class="control-label" for="nama_brg">Nama Barang</label>
                <input type="text" name="nama_brg" class="form-control" id="nama_brg" required>
              </div>
              <div class="form-group">
                <label class="control-label" for="harga_brg">Harga Barang</label>
                <input type="number" name="harga_brg" class="form-control" id="harga_brg" required>
              </div>
              <div class="form-group">
                <label class="control-label" for="stok_brg">Stok Barang</label>
                <input type="number" name="stok_brg" class="form-control" id="stok_brg" required>
              </div>
              <div class="form-group">
                <label class="control-label" for="gbr_brg">Gambar Barang</label>
                <input type="file" name="gbr_brg" class="form-control" id="gbr_brg" required>
              </div>
            </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-danger">Reset</button>
                <input type="submit" class="btn btn-success" name="tambah" value="Simpan"></button>
              </div>
          </form>
          <?php 
          if(@$_POST['tambah']){
            $nama_brg = $connection->conn->real_escape_string($_POST['nama_brg']);
             $harga_brg = $connection->conn->real_escape_string($_POST['harga_brg']);
              $stok_brg = $connection->conn->real_escape_string($_POST['stok_brg']);

              $extensi = explode(".", $_FILES['gbr_brg']['name']);
              $gbr_brg = "brg-".round(microtime(true)).".".end($extensi);
              $sumber = $_FILES['gbr_brg']['tmp_name'];
              $upload = move_uploaded_file($sumber, "assets/img/barang/".$gbr_brg);
              if($upload){
                $brg->tambah($nama_brg, $harga_brg, $stok_brg, $gbr_brg);
                header("location: ?page=barang");
              } else{
                echo "<script>alert('Upload gambar gagal!')</script>";
              }
          }
           ?>
        </div>
      </div>
    </div>
	</div>
</div> 