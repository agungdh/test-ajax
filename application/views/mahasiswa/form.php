<div class="modal fade" id="form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h3>Tambah Data Mahasiswa</h3>
      </div>

      <table class="table">
        <input type="hidden" name="id" value="">
        <tr>
          <td>NPM</td>
          <td><input type="number" name="npm" id="npm" placeholder="NPM" class="form-control"></td>
        </tr>
        <tr>
          <td>Nama</td>
          <td><input type="text" name="nama" id="nama" placeholder="Nama" class="form-control"></td>
        </tr>
        <tr>
          <td>Tanggal Lahir</td>
          <td><input type="text" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" class="form-control"></td>
        </tr>
        <tr>
          <td>Foto</td>
          <td><input type="file" name="foto" id="foto" class="form-control"></td>
        </tr>
        <tr>
          <td></td>
          <td>
            <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
            <button type="button" id="btn-tambah" onclick="tambah()" class="btn btn-success">Tambah</button>
            <button type="button" id="btn-ubah" onclick="ubah()" class="btn btn-primary">Ubah</button>
          </td>
        </tr>
      </table>

    </div>
  </div>
</div>

<script type="text/javascript">
$('#tanggal_lahir').datepicker({
  format: 'dd-mm-yyyy',
  todayBtn: "linked",
  autoclose: true
});
</script>