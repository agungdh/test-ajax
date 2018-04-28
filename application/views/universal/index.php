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
        "scrollX": false,
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('universal/' . 'ajax/' . $data['table'])?>",
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
    <h4><strong><font color=blue>DATA <?php echo strtoupper($data['table']); ?></font></strong></h4>
  </div><!-- /.box-header -->

    <div class="box-body">

    <div class="form-group">
      
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#form" onclick="submit('tambah')">
        <i class="fa fa-plus"></i> 
        <?php echo ucwords($data['table']); ?>
      </button>
    </div>

    <table id="lookup" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
      <thead>
        <tr>
                    <th>NO</th>
                    <?php
                    foreach ($this->db->query("SHOW COLUMNS FROM " . $table . " WHERE Field != 'id'")->result() as $item) {
                      echo '<th>' . strtoupper(str_replace('_', ' ', $item->Field))  . '</th>';  
                    }
                    ?>
                    <th>PROSES</th>
        </tr>
      </thead>
    </table>
  </div><!-- /.boxbody -->
</div><!-- /.box -->

<?php $this->load->view($data['table'] . '/form'); ?>

<script type="text/javascript">
$("#form").on("hidden.bs.modal", function () {
    $('input, select, textarea').each(
        function(index){  
            $(this).val('');
        }
    );
});

function hapus(id) {
  swal({
    title: "Hapus Data ?",
    text: "Data Anda Akan Hilang !!!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: true,
    html: false
  }, function(){
    var fd = new FormData();    
    fd.append('where[id]', id);

    $.ajax({
      type: 'POST',
      data: fd,
      contentType: false,
      processData: false,
      url: "<?php echo base_url('universal/' . 'hapus/' . $data['table']); ?>",
      dataType: 'json',
      success: function (hasil) {
        table.ajax.reload();
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        swal("Oops...", "Something went wrong!", "error");
      }
    });
  });
}

function ubah() {
  var data;

  var fd = new FormData();
  
  $('input, select, textarea').each(
      function(index){  
         var nama_form = $(this).attr('name');
         fd.append(nama_form, $(this).val());
      }
  );

  $.ajax({
    type: 'POST',
    data: fd,
    contentType: false,
    processData: false,
    url: "<?php echo base_url('universal/' . 'ubah/' . $data['table']); ?>",
    dataType: 'json',
    success: function (hasil) {
      if (hasil.status != 'ok') {
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
  var npm = $("input[name='npm']").val();
  var nama = $("input[name='nama']").val();
  
  var tanggal_lahir_raw = $("input[name='tanggal_lahir']").val();
  
  if (tanggal_lahir_raw != '') {
    var tanggal = tanggal_lahir_raw.substring(0,2);
    var bulan = tanggal_lahir_raw.substring(3,5);
    var tahun = tanggal_lahir_raw.substring(6,10);
    var tanggal_lahir = tahun + '-' + bulan + '-' + tanggal;
  } else {
    var tanggal_lahir = '';
  }

  var fd = new FormData();
  fd.append('data[npm]', npm);
  fd.append('data[nama]', nama);
  fd.append('data[tanggal_lahir]', tanggal_lahir);
  $.ajax({
    type: 'POST',
    data: fd,
    contentType: false,
    processData: false,
    url: "<?php echo base_url('universal/' . 'tambah/' . $data['table']); ?>",
    dataType: 'json',
    success: function (hasil) {
      if (hasil.status != 'ok') {
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

    var fd = new FormData();
    fd.append('where[id]', id);
    $.ajax({
      type: 'POST',
      data: fd,
      contentType: false,
      processData: false,
      url: '<?php echo base_url('universal/' . "ambil_where/" . $data['table']); ?>',
      dataType: 'json',
      success: function (hasil) {
        $("input[name='npm']").val(hasil.npm);
        $("input[name='nama']").val(hasil.nama);
        var tanggal_lahir_raw = hasil.tanggal_lahir;
        var tanggal = tanggal_lahir_raw.substr(8,2);
        var bulan = tanggal_lahir_raw.substr(5,2);
        var tahun = tanggal_lahir_raw.substr(0,4);
        var tanggal_lahir = tanggal + '-' + bulan + '-' + tahun;
        $("input[name='tanggal_lahir']").val(tanggal_lahir);
        $("input[name='id']").val(id);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        swal("Oops...", "Something went wrong!", "error");
      }
    });
  }
}
</script>
