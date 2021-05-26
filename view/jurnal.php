<?php   

// echo $kode;
?>
<script type="text/javascript">
  function bank(sel) {
    var hasil = sel.value;
    if (hasil=="B"){
      document.getElementById("banku").disabled = false;
      document.getElementById("kasku").disabled = true;
    } else if(hasil=="K") {
      document.getElementById("banku").disabled = true;
      document.getElementById("kasku").disabled = false;
    }
    else {
      document.getElementById("nomerkus").disabled = false;
      document.getElementById("banku").disabled = true;
    }
  }
</script>
<?php 

if(isset($_POST['simpan'])){
  $bulan = date('n', strtotime($_POST['tanggal_transaksi']));
  $tahun = date('Y', strtotime($_POST['tanggal_transaksi']));
 $sql = "select COUNT(*) from (SELECT a.jenis_transaksi, a.tanggal_transaksi FROM tabel_transaksi a where ((a.jenis_transaksi like '%BKK%') OR (a.jenis_transaksi like '%BKM%') OR (a.jenis_transaksi like '%BBK%') OR (a.jenis_transaksi like '%BBM%')) AND MONTH(tanggal_transaksi) = ".$bulan." and year(tanggal_transaksi) = ".$tahun." GROUP by a.jenis_transaksi) as s";
  $query = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($query);
  $hitung = $row[0];
  $hitung = $hitung+1;
  if ($hitung>=1&&$hitung<=9) {
    $kodei = "00".$hitung."/SH-B".$_POST['mt']."".$_POST['tr']."/".$bulan."/".$tahun;
  } else if ($hitung>=10&&$hitung<=99) {
    $kodei = "0".$hitung."/SH-B".$_POST['mt']."".$_POST['tr']."/".$bulan."/".$tahun;
  } else if ($hitung>=100&&$hitung<=999) {
    $kodei = $hitung."/SH-B".$_POST['mt']."".$_POST['tr']."/".$bulan."/".$tahun;
  }
  $jumlah = count($_POST['koderek']);
  // echo $jumlah;
  for ($i=0; $i < $jumlah; $i++) { 
    $kode_transaksi=$kodei;
    $tanggal_transaksi=$_POST['tanggal_transaksi'];
    $keterangan_transaksi=ucwords($_POST['Keterangan'][$i]);
    $kode_rekening=$_POST['koderek'][$i];
    $kode_rekening1=$_POST['kode_rekening'];
    $penanggung=$_POST['penanggung'][$i];
    $kode_bukti=$kodei;
    // $kode_bukti=$_POST['jenis_transaksi'];
    $jumlah_dk=ucwords($_POST['jumlah'][$i]);
    $id_admin=ucwords($_SESSION['id_admin']);
    // kode_rekening1 = utama
    if (strstr($kode_transaksi, 'BKK')) {
      $query=mysqli_query($conn, "insert into tabel_transaksi(kode_transaksi,kode_rekening,tanggal_transaksi, jenis_transaksi, keterangan_transaksi,kredit,id_admin,penanggung) values('$kode_transaksi','$kode_rekening1','$tanggal_transaksi','$kode_bukti','$keterangan_transaksi','$jumlah_dk','$id_admin','$penanggung')");
      $query=mysqli_query($conn, "insert into tabel_transaksi(kode_transaksi,kode_rekening,tanggal_transaksi, jenis_transaksi, keterangan_transaksi,debet,id_admin,penanggung) values('$kode_transaksi','$kode_rekening','$tanggal_transaksi','$kode_bukti','$keterangan_transaksi','$jumlah_dk','$id_admin','$penanggung')");
    } elseif (strstr($kode_transaksi, 'BKM')) {
      $query=mysqli_query($conn, "insert into tabel_transaksi(kode_transaksi,kode_rekening,tanggal_transaksi, jenis_transaksi, keterangan_transaksi,debet,id_admin,penanggung) values('$kode_transaksi','$kode_rekening1','$tanggal_transaksi','$kode_bukti','$keterangan_transaksi','$jumlah_dk','$id_admin','$penanggung')");
      $query=mysqli_query($conn, "insert into tabel_transaksi(kode_transaksi,kode_rekening,tanggal_transaksi, jenis_transaksi, keterangan_transaksi,kredit,id_admin,penanggung) values('$kode_transaksi','$kode_rekening','$tanggal_transaksi','$kode_bukti','$keterangan_transaksi','$jumlah_dk','$id_admin','$penanggung')");

    } elseif (strstr($kode_transaksi, 'BBK')) {
      $query=mysqli_query($conn, "insert into tabel_transaksi(kode_transaksi,kode_rekening,tanggal_transaksi, jenis_transaksi, keterangan_transaksi,kredit,id_admin,penanggung) values('$kode_transaksi','$kode_rekening1','$tanggal_transaksi','$kode_bukti','$keterangan_transaksi','$jumlah_dk','$id_admin','$penanggung')");
      $query=mysqli_query($conn, "insert into tabel_transaksi(kode_transaksi,kode_rekening,tanggal_transaksi, jenis_transaksi, keterangan_transaksi,debet,id_admin,penanggung) values('$kode_transaksi','$kode_rekening','$tanggal_transaksi','$kode_bukti','$keterangan_transaksi','$jumlah_dk','$id_admin','$penanggung')");
    } elseif (strstr($kode_transaksi, 'BBM')) {
      $query=mysqli_query($conn, "insert into tabel_transaksi(kode_transaksi,kode_rekening,tanggal_transaksi, jenis_transaksi, keterangan_transaksi,debet,id_admin,penanggung) values('$kode_transaksi','$kode_rekening1','$tanggal_transaksi','$kode_bukti','$keterangan_transaksi','$jumlah_dk','$id_admin','$penanggung')");
      $query=mysqli_query($conn, "insert into tabel_transaksi(kode_transaksi,kode_rekening,tanggal_transaksi, jenis_transaksi, keterangan_transaksi,kredit,id_admin,penanggung) values('$kode_transaksi','$kode_rekening','$tanggal_transaksi','$kode_bukti','$keterangan_transaksi','$jumlah_dk','$id_admin','$penanggung')");
    }

    
  }

  if($query){
    $jenis_alert = "success";
    $alert = "Sukses Insert Data";
    echo '<script language="javascript">document.location.href="voucher_laporan.php?jenis='.$kode_bukti.'";</script>';
  }else{
    $jenis_alert = "danger";
    $alert = mysqli_error($conn);
  }
}else{
  unset($_POST['simpan']);
}
?>
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h5 mb-0 text-gray-800">Jurnal Umum</h1>
  </div>
  <p id="jwb"></p>
  <div class="row">
    
  <div class="col-md-12">
    <div class="card  mb-4">
      <div class="card-header py-3">
        <h6 class="font-weight-bold text-primary">List Data Jurnal Umum</h6>
      </div>
      <div class="card-body">
        <form action="" method="GET">
          <div class='container row' >
            <input type="hidden" name="page" value="jurnal">
            <input type='date' name="awal" class="form-control col-md-3 col-xs-12" id='datepicker' placeholder='Tanggal Awal' style="margin-right: 10px;"> 
            <input type='date' name="akhir" class="form-control col-md-3 col-xs-12" id='datepicker2' placeholder='Tanggal Akhir' style="margin-right: 10px;">
            <input type="submit" value="submit" class="col-md-1 col-xs-12 btn btn-success">
          </div>
        </form>
        <div class="table-responsive">
          <table class="table" id="dataTable1" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kode Voucher</th>
                <th>Keterangan</th>
                <th>Debet</th>
                <th>Kredit</th>
                <th>Penanggung Jawab</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <!-- <th colspan="7" style="text-align:right">Total:</th> -->
              </tr>
            </tfoot>
            <tbody>
              <?php
              $saldo = 0;
              $no = 0;
              if (isset($_GET['awal']) AND isset($_GET['akhir'])) {
                $djndn = "SELECT * FROM `tabel_transaksi` where (a.jenis_transaksi like '%BKK%' or a.jenis_transaksi like '%BKM%' or a.jenis_transaksi like '%BBK%' or a.jenis_transaksi like '%BBM%') AND tanggal_transaksi between '".$_GET['awal']."' and '".$_GET['akhir']."' order by 1 DESC";
              } else {
                $djndn = "select * from tabel_transaksi a where a.jenis_transaksi like '%BKK%' or a.jenis_transaksi like '%BKM%' or a.jenis_transaksi like '%BBK%' or a.jenis_transaksi like '%BBM%' ORDER BY `id_transaksi` DESC";
              }
              $result = mysqli_query($conn, $djndn);
              while ($row = mysqli_fetch_array($result)) {
                $saldo+=$row['debet'];
                $saldo-=$row['kredit'];
                $debet=$row['debet'];
                $no++;
                $kredit=$row['kredit'];
                $id_transaksi=$row['id_transaksi'];
                echo "<tr onclick=\"window.open('voucher_laporan.php?jenis=$row[jenis_transaksi]')\">
                <td>$no</td>
                <td>$row[tanggal_transaksi]</td>
                <td>$row[jenis_transaksi]</td>
                <td>".$row['keterangan_transaksi']."</td>
                <td>".number_format($debet,2,'.',',')."</td>
                <td>".number_format($kredit,2,'.',',')."</td>
                <td>".$row['penanggung']."</td>";
                ?>
                <?php
                echo"</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- modal upload import excel -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="?page=jurnal" method="GET" id="saveexl" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Upload Excel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_upload_87y9.svg" alt="">
          </div>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" name="fileToUpload" class="custom-file-input" id="file">
              <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
              <div id='preview'></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button name="export" id="submit" type="button" class="btn btn-primary">Save changes</button>
          <!-- <input type='button' class='btn btn-primary' value='Save changes' id='upload'> -->
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
  var c = 0;
  var i=0;
  $('#add').click(function(){

    i++;
     $('#dynamic_field2 tbody').append('<tr id="row'+i+'"><td align="center"><input class="text-center" style="width: 100%;border: none;background: #fff;" id="kode'+i+'" name="koderek[]" type="text" readonly><input class="text-center" style="width: 100%;border: none;background: #fff;" id="nama'+i+'" name="nama[]" type="hidden" readonly></td><td><input onchange="sjsj'+i+'(value);" list="browsers" style="width: 100%;border: none;"></td><td><input class="text-center" style="width: 100%;border: none;background: #fff;" id="harga'+i+'" name="Keterangan[]"  type="text"></td><td><input class=" text-center qty" value="0" style="width: 100%;border: none;" type="number" id="qty'+i+'" name="jumlah[]" onchange="sum'+i+'();" required></td><td><input class="text-center tot" style="width: 100%;border: none;background: #fff;" id="total'+i+'" name="penanggung[]" type="text" ></td><td align="center"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-sm btn_remove">hapus</button></td></tr>');
    c=i;
  });
  $(document).on('click', '.btn_remove', function(){
    var button_id = $(this).attr("id");
    $('#row'+button_id+'').remove();
  });
</script>
<datalist id="browsers"><?php $rdcjn = mysqli_query($conn, "SELECT * FROM `tabel_master`");while ($rdjc = mysqli_fetch_array($rdcjn)) { echo '<option value="'.$rdjc['kode_rekening']." ".$rdjc['nama_rekening'].'">'; } ?></datalist>
<script type="text/javascript">
 $(document).ready(function(){
  $('#submit').click(function(){
    $('#exampleModal1').modal('hide');
    var fd = new FormData();
    var files = $('#file')[0].files[0];
    fd.append('fileToUpload',files);
    $.ajax({
      url: 'upload.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response){
        var obj = jQuery.parseJSON(response);
        alertku(obj.jenis_alert, obj.alert);
      }
    });
  });
});
 <?php
 for ($i=1; $i <= 1000; $i++) {
  ?>
  function sjsj<?php echo $i; ?>(value){
    $.ajax({
      type: "POST",
      url: "autosuggest.php?koderek=1",
      data: {
        rek: value
      },
      success: function (data) {
        var json = JSON.parse(data);
        $('#kode<?php echo $i; ?>').val(json.kode);
        $('#nama<?php echo $i; ?>').val(json.nama);
      }
    });
  }
<?php } ?>
</script>

