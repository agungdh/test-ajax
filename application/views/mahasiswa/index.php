<?php 
// var_dump($data['versi_borang']);
// exit();
?>
<script type="text/javascript">
 
var table;
 
$(document).ready(function() {
 
    //datatables
    table = $('#lookup').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('mahasiswa/ajax')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0, 4 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
 
});
</script>

<div class="box box-primary">
  <div class="box-header with-border">
    <h4><strong><font color=blue>DATA MAHASISWA</font></strong></h4>
  </div><!-- /.box-header -->

    <div class="box-body">

    <div class="form-group">
      
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#form" onclick="submit('tambah')">
        <i class="fa fa-plus"></i> 
        Mahasiswa
      </button>
    </div>

    <table id="lookup" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
      <thead>
        <tr>
                    <th>NO</th>
                    <th>NPM</th>
                    <th>NAMA</th>
                    <th>TANGGAL LAHIR</th>
                    <th>PROSES</th>
        </tr>
      </thead>
    </table>
  </div><!-- /.boxbody -->
</div><!-- /.box -->

<?php $this->load->view('mahasiswa/form'); ?>

<script type="text/javascript">
$("#form").on("hidden.bs.modal", function () {
    $("[name='id']").val('');
    $("[name='npm']").val('');
    $("[name='nama']").val('');
    $("[name='tanggal_lahir']").val('');
});

function hapus(id) {
  swal({
    title: "Hapus Data ?",
    text: "Data Anda Akan Hilang !!!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false,
    html: false
  }, function(){
    $.ajax({
      type: 'POST',
      data: 'id=' + id,
      url: "<?php echo base_url('mahasiswa/hapus'); ?>",
      dataType: 'json',
      success: function (hasil) {
        table.ajax.reload();
        swal("Terhapus!", "File Anda Telah Terhapus !!!", "success");
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        swal("Oops...", "Something went wrong!", "error");
      }
    });
  });
}

function ubah() {
  var id = $("[name='id']").val();
  var npm = $("[name='npm']").val();
  var nama = $("[name='nama']").val();
  
  var tanggal_lahir_raw = $("[name='tanggal_lahir']").val();
  
  if (tanggal_lahir_raw != '') {
    var tanggal = tanggal_lahir_raw.substring(0,2);
    var bulan = tanggal_lahir_raw.substring(3,5);
    var tahun = tanggal_lahir_raw.substring(6,10);
    var tanggal_lahir = tahun + '-' + bulan + '-' + tanggal;
  } else {
    var tanggal_lahir = '';
  }

  $.ajax({
    type: 'POST',
    data: 'id=' + id
           + '&npm=' + npm
           + '&nama=' + nama
           + '&tanggal_lahir=' + tanggal_lahir,
    url: "<?php echo base_url('mahasiswa/ubah'); ?>",
    dataType: 'json',
    success: function (hasil) {
      if (hasil.pesan != '') {
        swal("Peringatan", hasil.pesan, "error");
      } else {
        table.ajax.reload();
        $('#form').modal('hide');
      }
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      swal("Oops...", "Something went wrong!", "error");
    }
  });

}

function tambah() {
  var npm = $("[name='npm']").val();
  var nama = $("[name='nama']").val();
  
  var tanggal_lahir_raw = $("[name='tanggal_lahir']").val();
  
  if (tanggal_lahir_raw != '') {
    var tanggal = tanggal_lahir_raw.substring(0,2);
    var bulan = tanggal_lahir_raw.substring(3,5);
    var tahun = tanggal_lahir_raw.substring(6,10);
    var tanggal_lahir = tahun + '-' + bulan + '-' + tanggal;
  } else {
    var tanggal_lahir = '';
  }

  $.ajax({
    type: 'POST',
    data: 'npm=' + npm 
          + '&nama=' + nama 
          + '&tanggal_lahir=' + tanggal_lahir,
    url: "<?php echo base_url('mahasiswa/tambah'); ?>",
    dataType: 'json',
    success: function (hasil) {
      if (hasil.pesan != '') {
        swal("Peringatan", hasil.pesan, "error");
      } else {
        table.ajax.reload();
        $('#form').modal('hide');
      }
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      swal("Oops...", "Something went wrong!", "error");
    }
  });
}

function submit(aksi, id = '') {
  if (aksi == 'tambah') {
    $('#btn-tambah').show();
    $('#btn-ubah').hide();
  } else if (aksi == 'ubah' && id != '') {
    $('#btn-tambah').hide();
    $('#btn-ubah').show();

    $.ajax({
      type: 'POST',
      data: 'id=' + id,
      url: '<?php echo base_url("mahasiswa/ambil_id"); ?>',
      dataType: 'json',
      success: function (hasil) {
        $("[name='npm']").val(hasil.npm);
        $("[name='nama']").val(hasil.nama);
        var tanggal_lahir_raw = hasil.tanggal_lahir;
        var tanggal = tanggal_lahir_raw.substr(8,2);
        var bulan = tanggal_lahir_raw.substr(5,2);
        var tahun = tanggal_lahir_raw.substr(0,4);
        var tanggal_lahir = tanggal + '-' + bulan + '-' + tahun;
        $("[name='tanggal_lahir']").val(tanggal_lahir);
        $("[name='id']").val(id);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        swal("Oops...", "Something went wrong!", "error");
      }
    });
  }
}
</script>