<section class="content-header">
    <h1>
        Data Karyawan
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="far fa-address-book"></i></a></li>
        <li class="active">data karyawan</li>
    </ol>
</section>

<section class="content">
    <div class="panel panel-primary">
        <div class="panel-heading">

            <div>
                <button data-toggle="modal" data-target="#addModal" class="btn btn-success fa fa-plus"> Tambah Data</button>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table id="tbl_data" class="table table-striped table-hover custom-table text-nowrap table-bordered form-group" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Password</th>
                        <th>Jabatan</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>
<section>
    <!-- Modal Tambah-->
    <div id="addModal" class="modal" role="dialog" data-backdrop="false">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Tambah Data</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" id ="nama" name="nama" class="form-control"></input>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id ="username" name="username" class="form-control"></input>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" id ="password" name="password" class="form-control"></input>
                        </div>
                        <div class="form-group">
                            <label for="jabatan" style="width: 100%">Jabatan</label>
                            <select class="form-control select2" name="jabatan" id="jabatan" style="width:100%">
                                <?php foreach ($jabatan as $row) : ?>
                                    <option value="<?= $row->id_jabatan; ?>"><?= $row->jabatan; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success fa fa-floppy-o" id="btn_add_data"> Simpan</button>
                    <button type="button" class="btn btn-default fa fa-times" data-dismiss="modal"> Close</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal Edit-->
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Edit Data</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group" hidden="true">
                            <label for="username">ID</label>
                            <input type="text" name="username_edit" class="form-control"></input>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" id ="nama_edit" name="nama_edit" class="form-control"></input>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" id ="password_edit" name="password_edit" class="form-control"></input>
                        </div>
                        <div class="form-group">
                            <label for="jabatan" style="width: 100%">Jabatan</label>
                            <select class="form-control select2" name="jabatan_edit" id="jabatan_edit" style="width:100%">
                                <?php foreach ($jabatan as $row) : ?>
                                    <option value="<?= $row->id_jabatan; ?>"><?= $row->jabatan; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>                      
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success fa fa-floppy-o" id="btn_update_data"> Update</button>
                    <button type="button" class="btn btn-default fa fa-times" data-dismiss="modal"> Close</button>
                </div>
            </div>

        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $("#jabatan").select2({
            placeholder: "Pilih Jabatan",
        });
        $("#jabatan_edit").select2({
            placeholder: "Pilih Jabatan",
        });
        
        tampil_data();
        //Menampilkan Data di tabel
        function tampil_data() {
            var dataTable = $('#tbl_data').DataTable({
                "destroy": true,
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "ordering": true,
                "order": [],
                "ajax": {
                    url: "<?php echo base_url() . 'User/table'; ?>",
                    type: "POST"
                },
                "columnDefs": [{
                        "className": "dt-center",
                        "targets": "_all",
                    },
                    {
                        "className": "dt-head-center",
                        "targets": "_all",
                    },
                    {
                        "className": "dt-body-center",
                        "targets": "_all",
                    },

                ],
            });
        }
        //Hapus Data dengan konfirmasi
        $("#tbl_data").on('click', '.btn_hapus', function() {
            var username = $(this).attr('data-id');
            var status = confirm('Yakin ingin menghapus?');
            if (status) {
                $.ajax({
                    url: '<?php echo base_url(); ?>User/hapusData',
                    type: 'POST',
                    data: {
                        username: username
                    },
                    success: function(response) {
                        tampil_data();
                    }
                })
            }
        })
        $("#btn_add_data").on('click', function() {
            var nama = $('input[name="nama"]').val();
            var username = $('input[name="username"]').val();
            var password = $('input[name="password"]').val();
            var jabatan = $('select[name="jabatan"] option:selected').val();
            if (nama.length == "") {
                Swal.fire({
                    type: 'warning',
                    title: 'Nama',
                    text: 'Belum diisi'
                });
             }else if (username.length == "") {
                Swal.fire({
                    type: 'warning',
                    title: 'Username',
                    text: 'Belum diisi'
                });
             }else if (password.length == "") {
                Swal.fire({
                    type: 'warning',
                    title: 'Password',
                    text: 'Belum diisi'
                });
             }else if (jabatan.length == 0) {
                Swal.fire({
                    type: 'warning',
                    title: 'Jabatan',
                    text: 'Belum dipilih'
                });
             } else {
                $.ajax({
                    url: '<?php echo base_url(); ?>User/tambahData',
                    type: 'POST',
                    data: {
                        nama:nama,
                        username:username,
                        password:password,
                        jabatan:jabatan
                    },
                    success: function(response) {
                       
                        $('input[name="nama"]').val("");
                        $('input[name="username"]').val("");
                        $('input[name="password"]').val("");
                        $("#jabatan").val('').trigger('change');
                        $("#addModal").modal('hide');
                        tampil_data();

                    }
                })
            }

        });
        //Memunculkan modal edit
        $("#tbl_data").on('click', '.btn_edit', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: '<?php echo base_url(); ?>User/ambilDataByid',
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $("#editModal").modal('show');
                    $('input[name="username_edit"]').val(response[0].username);
                    $('input[name="nama_edit"]').val(response[0].nama);
                    $("#jabatan_edit").select2().val(response[0].id_jabatan).trigger('change');
                }
            })
        });

        //Meng-Update Data
        $("#btn_update_data").on('click', function() {
            var username = $('input[name="username_edit"]').val();
            var nama = $('input[name="nama_edit"]').val();
            var password = $('input[name="password_edit"]').val();
            var jabatan = $('select[name="jabatan_edit"] option:selected').val();
            if (nama.length == "") {
                Swal.fire({
                    type: 'warning',
                    title: 'Nama',
                    text: 'Belum diisi'
                });
             }else if (username.length == "") {
                Swal.fire({
                    type: 'warning',
                    title: 'Username',
                    text: 'Belum diisi'
                });
             }else if (jabatan.length == 0) {
                Swal.fire({
                    type: 'warning',
                    title: 'Jabatan',
                    text: 'Belum dipilih'
                });
             } else {
                $.ajax({
                    url: '<?php echo base_url(); ?>User/perbaruiData',
                    type: 'POST',
                    data: {
                        username:username,
                        nama:nama,
                        password:password,
                        jabatan:jabatan
                    },
                    success: function(response) {
                       
                        $('input[name="nama_edit"]').val("");
                        $('input[name="username_edit"]').val("");
                        $('input[name="password_edit"]').val("");
                        $("#jabatan_edit").val('').trigger('change');
                        $("#editModal").modal('hide');
                        tampil_data();

                    }
                })
            }
        });
    });
</script>