<section class="content-header">
    <h1>
        Data Nasabah
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="far fa-address-book"></i></a></li>
        <li class="active">data nasabah</li>
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
                        <th>Nama</th>
                        <th>Date From</th>
                        <th>Date To</th>
                        <th>Pertanggungan</th>
                        <th>Harga</th>
                        <th>Jenis</th>
                        <th>Banjir</th>
                        <th>Gempa</th>
                        <th>Created By</th>
                        <th>Created Date</th>
                        <th>Updated By</th>
                        <th>Update Date</th>
                        <th>Computer</th>
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
                            <label>Nama</label>
                            <input type="text" id ="nama" name="nama" class="form-control"></input>
                        </div>
                        <div class="form-group">
                            <label>Date From</label>
                            <input type="date" class="mr-4" id="date_from" name="date_from">
                            <label>Date To</label>
                            <input type="date"  id="date_to" name="date_to" style="margin-right:50px;"> 
                        </div>
                        <div class="form-group">
                            <label>Pertanggungan</label>
                            <input type="text" id ="pertanggungan" name="pertanggungan" class="form-control"></input>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" id ="harga" name="harga" class="form-control" ></input>
                        </div>
                        <div class="form-group">
                            <label for="jenis" style="width: 100%">Jenis</label>
                            <select class="form-control select2" name="jenis" id="jenis" style="width:100%">
                                <?php foreach ($jenis as $row) : ?>
                                    <option value="<?= $row->id_jenis; ?>"><?= $row->jenis; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label >Risiko Pertanggungan</label> 
                            <input type="checkbox" name="banjir"  value="1" > Banjir
                            <input type="checkbox" name="gempa"  value="1" > Gempa
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
                            <label >ID</label>
                            <input type="text" name="idnasabah_edit" class="form-control"></input>
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" id ="nama_edit" name="nama_edit" class="form-control"></input>
                        </div>
                        <div class="form-group">
                            <label>Date From</label>
                            <input type="date" class="mr-4" id="date_from_edit" name="date_from_edit">
                            <label>Date To</label>
                            <input type="date"  id="date_to_edit" name="date_to_edit" style="margin-right:50px;"> 
                        </div>
                        <div class="form-group">
                            <label>Pertanggungan</label>
                            <input type="text" id ="pertanggungan_edit" name="pertanggungan_edit" class="form-control"></input>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" id ="harga_edit" name="harga_edit" class="form-control" ></input>
                        </div>
                        <div class="form-group">
                            <label for="jenis" style="width: 100%">Jenis</label>
                            <select class="form-control select2" name="jenis_edit" id="jenis_edit" style="width:100%">
                                <?php foreach ($jenis as $row) : ?>
                                    <option value="<?= $row->id_jenis; ?>"><?= $row->jenis; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label >Risiko Pertanggungan</label> 
                            <input type="checkbox" name="banjir_edit"  value="1" > Banjir
                            <input type="checkbox" name="gempa_edit"  value="1" > Gempa
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
<script>
    var mat = document.getElementById('harga');
    mat.addEventListener('keyup', function(e){
        mat.value = formatDe(this.value);
    });
    var mat2 = document.getElementById('harga_edit');
    mat2.addEventListener('keyup', function(e){
        mat2.value = formatDe(this.value);
    });
    function formatDe(angka){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return rupiah;
    }
</script>
<script type="text/javascript">
   $(document).ready(function() {
       // $('input:checkbox').click(function() {
       // $('input:checkbox').not(this).prop('checked', false);
   // });
    $("#jenis").select2({
            placeholder: "Pilih Jenis",
    });
    $("#jenis_edit").select2({
            placeholder: "Pilih Jenis",
    });
        tampil_data();
        function tampil_data() {
            var dataTable = $('#tbl_data').DataTable({
                "destroy": true,
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "ordering": true,
                "order": [],
                "ajax": {
                    url: "<?php echo base_url() . 'Nasabah/table'; ?>",
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
                    { targets: [ 5 ],
                        render: function (data, type, row) {
                        return data === 0 ? 0 : $.fn.dataTable.render.number( '.', ',', ).display( data );
                    }}

                ],
            });
        }
        //Hapus Data dengan konfirmasi
        $("#tbl_data").on('click', '.btn_hapus', function() {
            var id_nasabah = $(this).attr('data-id');
            var status = confirm('Yakin ingin menghapus?');
            if (status) {
                $.ajax({
                    url: '<?php echo base_url(); ?>Nasabah/hapusData',
                    type: 'POST',
                    data: {
                        id_nasabah: id_nasabah
                    },
                    success: function(response) {
                        tampil_data();
                    }
                })
            }
        })
        $("#tbl_data").on('click', '.btn_print', function() {
            var id_nasabah = $(this).attr('data-id');
            var status = confirm('Print Data?');
            if (status) {
                $.ajax({
                    url: '<?php echo base_url(); ?>Nasabah/getDat',
                    type: 'GET',
                    data: {
                        id_nasabah: id_nasabah
                    }, dataType: 'html',
                    success: function(response){ 
                        console.log(response);
                        var aw ="http://localhost:8080/made/Nasabah/getDat?id_nasabah="+id_nasabah           
                        window.location.href = aw;
                    },
                    error: function(response){
                        
                    }     
                            
                })
            }
        })
        $("#btn_add_data").on('click', function() {
            var nama = $('input[name="nama"]').val();
            var date_from = $('input[name="date_from"]').val();
            var date_to = $('input[name="date_to"]').val();
            var pertanggungan = $('input[name="pertanggungan"]').val();
            var harga = $('input[name="harga"]').val();
            var jenis = $('select[name="jenis"]').val();
            var banjir = $('input[name="banjir"]:checked').val();
            var gempa = $('input[name="gempa"]:checked').val();

            if(banjir ==  1){
                banjir == 1;
            }else{
                banjir = 0;
            }
            if(gempa ==  1){
                gempa == 1;
            }else{
                gempa = 0;
            }
            if (nama.length == "") {
                Swal.fire({
                    type: 'warning',
                    title: 'Nama',
                    text: 'Belum diisi'
                });
             }else if (date_to.length == "") {
                Swal.fire({
                    type: 'warning',
                    title: 'Date To',
                    text: 'Belum diisi'
                });
             }else if (date_from.length == "") {
                Swal.fire({
                    type: 'warning',
                    title: 'Date From',
                    text: 'Belum diisi'
                });
             }else if (pertanggungan.length == "") {
                Swal.fire({
                    type: 'warning',
                    title: 'Pertanggungan',
                    text: 'Belum diisi'
                });
             }else if (harga.length == "") {
                Swal.fire({
                    type: 'warning',
                    title: 'Harga',
                    text: 'Belum diisi'
                });
             }else if (jenis.length == 0) {
                Swal.fire({
                    type: 'warning',
                    title: 'Jenis',
                    text: 'Belum dipilih'
                });
             }else {
                $.ajax({
                    url: '<?php echo base_url(); ?>Nasabah/tambahData',
                    type: 'POST',
                    data: {
                        nama:nama,
                        date_from:date_from,
                        date_to:date_to,
                        pertanggungan:pertanggungan,
                        harga:harga,
                        jenis:jenis,
                        banjir:banjir,
                        gempa:gempa
                    },
                    success: function(response) {
                        $('input[name="nama"]').val("");
                        $('input[name="date_from"]').val("");
                        $('input[name="date_to"]').val("");
                        $('input[name="pertanggungan"]').val("");
                        $('input[name="harga"]').val("");
                        $('input[type="checkbox"][name="banjir"]').prop('checked', false);
                        $('input[type="checkbox"][name="gempa"]').prop('checked', false);
                        $("#jenis").val('').trigger('change');
                        $("#addModal").modal('hide');
                        tampil_data();

                    }
                })
            }

        });
        //Memunculkan modal edit
        $("#tbl_data").on('click', '.btn_edit', function() {
            var id_nasabah = $(this).attr('data-id');
            $.ajax({
                url: '<?php echo base_url(); ?>Nasabah/ambilDataByid',
                type: 'POST',
                data: {
                    id_nasabah: id_nasabah
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $("#editModal").modal('show');
                    $('input[name="idnasabah_edit"]').val(response[0].id_nasabah);
                    $('input[name="nama_edit"]').val(response[0].nama);
                    $('input[name="date_from_edit"]').val(response[0].date_from);
                    $('input[name="date_to_edit"]').val(response[0].date_to);
                    $('input[name="pertanggungan_edit"]').val(response[0].pertanggungan);
                    $('input[name="harga_edit"]').val(response[0].harga);
                    $("#jenis_edit").select2().val(response[0].id_jenis).trigger('change');
                    $('input[type="checkbox"][name="banjir_edit"]').prop('checked', false);
                    $('input[type="checkbox"][name="gempa_edit"]').prop('checked', false);
                    if(response[0].banjir=='1'){
                        $('input[type="checkbox"][name="banjir_edit"][value="'+response[0].banjir+'"]').prop('checked', true);
                    }
                    if(response[0].gempa=='1'){
                        $('input[type="checkbox"][name="gempa_edit"][value="'+response[0].gempa+'"]').prop('checked', true);
                    }
                }
            })
        });

        //Meng-Update Data
        $("#btn_update_data").on('click', function() {
            var id_nasabah = $('input[name="idnasabah_edit"]').val();
            var nama = $('input[name="nama_edit"]').val();
            var date_from = $('input[name="date_from_edit"]').val();
            var date_to = $('input[name="date_to_edit"]').val();
            var pertanggungan = $('input[name="pertanggungan_edit"]').val();
            var harga = $('input[name="harga_edit"]').val();
            var jenis = $('select[name="jenis_edit"]').val();
            var banjir = $('input[name="banjir_edit"]:checked').val();
            var gempa = $('input[name="gempa_edit"]:checked').val();

            if(banjir ==  1){
                banjir == 1;
            }else{
                banjir = 0;
            }
            if(gempa ==  1){
                gempa == 1;
            }else{
                gempa = 0;
            }
            if (nama.length == "") {
                Swal.fire({
                    type: 'warning',
                    title: 'Nama',
                    text: 'Belum diisi'
                });
             }else if (date_to.length == "") {
                Swal.fire({
                    type: 'warning',
                    title: 'Date To',
                    text: 'Belum diisi'
                });
             }else if (date_from.length == "") {
                Swal.fire({
                    type: 'warning',
                    title: 'Date From',
                    text: 'Belum diisi'
                });
             }else if (pertanggungan.length == "") {
                Swal.fire({
                    type: 'warning',
                    title: 'Pertanggungan',
                    text: 'Belum diisi'
                });
             }else if (harga.length == "") {
                Swal.fire({
                    type: 'warning',
                    title: 'Harga',
                    text: 'Belum diisi'
                });
             }else if (jenis.length == 0) {
                Swal.fire({
                    type: 'warning',
                    title: 'Jenis',
                    text: 'Belum dipilih'
                });
             }else {
                $.ajax({
                    url: '<?php echo base_url(); ?>Nasabah/perbaruiData',
                    type: 'POST',
                    data: {
                        id_nasabah:id_nasabah,
                        nama:nama,
                        date_from:date_from,
                        date_to:date_to,
                        pertanggungan:pertanggungan,
                        harga:harga,
                        jenis:jenis,
                        banjir:banjir,
                        gempa:gempa
                    },
                    success: function(response) {
                        $('input[name="idnasabah_edit"]').val("");
                        $('input[name="nama_edit"]').val("");
                        $('input[name="date_from_edit"]').val("");
                        $('input[name="date_to_edit"]').val("");
                        $('input[name="pertanggungan_edit"]').val("");
                        $('input[name="harga_edit"]').val("");
                        $('input[type="checkbox"][name="banjir_edit"]').prop('checked', false);
                        $('input[type="checkbox"][name="gempa_edit[]"]').prop('checked', false);
                        $("#jenis_edit").val('').trigger('change');
                        $("#editModal").modal('hide');
                        tampil_data();

                    }
                })
            }
        });
    });
</script>