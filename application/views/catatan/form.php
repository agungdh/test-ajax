<div class="modal fade" id="form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h3>Tambah Data Mahasiswa</h3>
      </div>

      <table class="table">
        <input type="hidden" name="where[id]" value="">
        <tr>
          <td>NPM</td>
          <td><input type="number" name="data[npm]" placeholder="NPM" class="form-control"></td>
        </tr>
        <tr>
          <td>Nama</td>
          <td><input type="text" name="data[nama]" placeholder="Nama" class="form-control"></td>
        </tr>
        <tr>
          <td>Tanggal Lahir</td>
          <td><input type="text" name="data[tanggal_lahir]" placeholder="Tanggal Lahir" class="form-control"></td>
        </tr>
        <tr>
          <td></td>
          <td>
            <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
            <button type="button" id="btn-tambah" class="btn btn-success">Tambah</button>
            <button type="button" id="btn-ubah" class="btn btn-primary">Ubah</button>
          </td>
        </tr>
      </table>

    </div>
  </div>
</div>

<script type="text/javascript">
$("input[name='tanggal_lahir']").datepicker({
  format: 'dd-mm-yyyy',
  todayBtn: "linked",
  autoclose: true
});

$("#btn-tambah").click(function() {
  tambah();
});

$("#btn-ubah").click(function() {
  ubah();
});
</script>