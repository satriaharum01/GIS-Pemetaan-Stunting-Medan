@extends('template.header')

@section('content')
<style>
    #togglePassword {
        position: absolute;
        right: 0;
        cursor: pointer;
        margin-right: 5%;
        margin-top: 9%;
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- Page Heading
<h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p>
 -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" style="padding: 12px 6px;">Data {{$title}}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="data-width" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align:center; vertical-align: middle;">No</th>
                            <th style="text-align:center; vertical-align: middle;">Email</th>
                            <th style="text-align:center; vertical-align: middle;">Berkas</th>
                            <th style="text-align:center; vertical-align: middle;">#</th>
                        </tr>
                    </thead>
                    <tbody style="text-align:center; vertical-align: middle;">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- ============ MODAL DATA JADWAL =============== -->

<div class="modal fade" id="compose" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <center><b>
                        <h4 class="modal-title" id="exampleModalLabel">Tambah UPT</h4>
                    </b></center>
            </div>
            <form action="#" method="post" id="compose-form">
                @csrf
                <input name="_method" type="hidden" value="patch">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="nama" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <i class="far fa-eye btn-eye" id="togglePassword"></i>
                        <input type="password" name="password" class="form-control" id="passinput">
                    </div>
                    <div class="form-group">
                        <label>Puskesmas</label>
                        <select name="puskesmas" id="puskesmas" class="form-control">
                            <option value="0">-- Pilih Puskesmas --</option>
                        </select>
                    </div>
                    <button type="reset" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!--- END MODAL DATA JADWAL--->

<!-- /.container-fluid -->
@endsection
@section('custom_script')
<script>
    $(function() {
        $.ajax({
            url: "{{ url('/data/puskesmas/json')}}",
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function(dataResult) {
                console.log(dataResult);
                var resultData = dataResult.data;
                $.each(resultData, function(index, row) {
                    $('#puskesmas').append('<option value="' + row.id_puskesmas + '">' + row.id_puskesmas + ' - ' + row.nama_upt + '</option>');
                })
            }
        });
        $('#data-width').DataTable({
            processing: true,
            serverSide: true,
            order: [], //init datatable not ordering
            ajax: {
                url: '{{url("data/register/json")}}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'email'
                },
                {
                    data: 'file',
                    render: function(data, type, row) {
                        return '<a href="<?= url('document/file') . "/" ?>' + data + '"><span class="fa fa-file"></span> ' + data + '</a>'
                    }
                },
                {
                    data: 'id_register',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return '<button type="button" class="btn btn-primary btn-sm btn-opsi" data-id="' + data + '"><span class="fa fa-edit"></span> Buat User</button>\
                        <a class="btn btn-danger btn-sm btn-hapus" data-id="' + data + '" data-handler="register" href="<?= url('data/register/delete') ?>/' + data + '">\
                        <span class="fa fa-trash"></span> Hapus</a> \
					              <form id="delete-form-' + data + '-register" action="<?= url('data/register/delete') ?>/' + data + '" \
                        method="GET" style="display: none;"> \
                        </form>'
                    }
                },
            ]
        });
    });


    $("body").on("click", ".btn-opsi", function() {
        var id = jQuery(this).attr("data-id");
        jQuery("#compose-form input[name=_method]").attr("value", "");
        $.ajax({
            url: "<?= url('data/register'); ?>/getjson/" + id,
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function(dataResult) {
                console.log(dataResult);
                var resultData = dataResult;
                $.each(resultData, function(index, row) {
                    jQuery("#compose-form input[name=email]").val(row.email);
                })
            }
        });
        jQuery("#compose-form").attr("action", '<?= url('data/users'); ?>/store/');
        jQuery("#compose .modal-title").html("Buat User");
        jQuery("#compose").modal("toggle");
    });

    $("body").on("click", ".btn-simpan", function() {
        var email = jQuery("#compose-form input[name=email]").val();
        var pass = jQuery("#compose-form input[name=password]").val();
        var puskesmas = jQuery("#compose-form select[name=puskesmas] option:selected").val();
        var uname = jQuery("#compose-form input[name=nama]").val();
        if (email === "" || pass === "" || puskesmas === "0" || uname === "") {
            alert('Data Tidak Boleh Kosong !!!');
            return false;
        } else {
            Swal.fire(
                'Data Disimpan!',
                '',
                'success'
            )
        }
    });

    $("body").on("click", ".btn-eye", function() {
        var x = document.getElementById("passinput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    })
</script>
@endsection