 <?php  
 error_reporting(E_ALL);  
  
 $title = 'Data Barang';  
 include_once 'login_session.php';  
 include_once 'koneksi.php';  
  
 if (isset($_POST['submit']))   
 {  
    $id = $_POST['id'];  
    $nama = $_POST['nama'];  
    $kategori = $_POST['kategori'];  
    $harga_jual = $_POST['harga_jual'];  
    $harga_beli = $_POST['harga_beli'];  
    $stok = $_POST['stok'];  
    $file_gambar = $_FILES['file_gambar'];  
    $gambar = null;  
      
    if ($file_gambar['error'] == 0)   
    {  
        $filename = str_replace(' ', '_', $file_gambar['na me']);  
        $destination = dirname(__FILE__) . '/gambar/' . $f ilename;  
        if (move_uploaded_file($file_gambar['tmp_name'], $ destination))  
        {  
            $gambar = 'gambar/' . $filename;;  
        }  
    }  
  
    $sql = 'UPDATE data_barang SET ';  
    $sql .= "nama = '{$nama}', kategori = '{$kategori}', " ;  
    $sql .= "harga_jual = '{$harga_jual}', harga_beli = '{ $harga_beli}', stok = '{$stok}' ";  
    if (!emptyempty($gambar))  
        $sql .= ", gambar = '{$gambar}' ";  
    $sql .= "WHERE id_barang = '{$id}'";  
    $result = mysqli_query($conn, $sql);  
      
    header('location: index.php');  
 }  
  
 $id = $_GET['id'];  

 $sql = "SELECT * FROM data_barang WHERE id_barang = '{$id} '";  
 $result = mysqli_query($conn, $sql);  
 if (!$result) die('Error: Data tidak tersedia');  
 $data = mysqli_fetch_array($result);  
  
 function is_select($var, $val) {  
    if ($var == $val) return 'selected="selected"';  
    return false;  
 }  
  
 include_once 'header.php';  
 ?>  
  
 <h2>Ubah Barang</h2>  
 <form method="post" action="edit_barang.php" enctype="mult ipart/form-data">  
    <div class="input">  
        <label>Nama Barang</label>  
        <input type="text" name="nama" value="<?php echo $ data['nama'];?>" />  
    </div>  
    <div class="input">  
        <label>Kategori</label>  
        <select name="kategori">  
            <option value="Komputer" <?php echo is_select ('Komputer', $data['kategori']);?>>Komputer</option>  
            <option value="Elektronik" <?php echo is_selec t('Elektronik', $data['kategori']);?>>Elektronik</option>  
            <option value="Hand Phone" <?php echo is_selec t('Hand Phone', $data['kategori']);?>>Hand Phone</option>  
        </select>  
    </div>  
    <div class="input">  
        <label>Harga Jual</label>  
        <input type="text" name="harga_jual" value="<?php echo $data['harga_jual'];?>" />  
    </div>  
    <div class="input">  
        <label>Harga Beli</label>  
        <input type="text" name="harga_beli" value="<?php echo $data['harga_beli'];?>" />  
    </div>  
    <div class="input">  
        <label>Stok</label>  
        <input type="text" name="stok" value="<?php echo $ data['stok'];?>" />  
    </div>  
    <div class="input">  
        <label>File Gambar</label>  
        <input type="file" name="file_gambar" />  
    </div>  
    <div class="submit">  
        <input type="hidden" name="id" value="<?php echo $ data['id_barang'];?>" />  
        <input type="submit" name="submit" value="Simpan" />  
    </div>  
 </form>  
 <?php  
 include_once 'footer.php';  
 ?>  
