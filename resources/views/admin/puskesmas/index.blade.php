@extends('template.header')

@section('content')

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
            <button type="button" class="btn btn-primary btn-add" style="float: right;" data-toggle="modal" data-target="#compose"><i class="fa fa-plus"></i> Tambah Data
            </button>
            <h6 class="m-0 font-weight-bold text-primary" style="padding: 12px 6px;">Data {{$title}}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="data-width" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align:center; vertical-align: middle;">No</th>
                            <th style="text-align:center; vertical-align: middle;">Puskesmas</th>
                            <th style="text-align:center; vertical-align: middle;">Kecamatan</th>
                            <th style="text-align:center; vertical-align: middle;">Kelurahan</th>
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
                        <h4 class="modal-title" id="exampleModalLabel">Tambah Pelanggan</h4>
                    </b></center>
            </div>
            <form action="#" method="post" id="compose-form">
                @csrf
                <input name="_method" type="hidden" value="patch">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Puskesmas</label>
                        <input type="text" name="puskesmas" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <select name="kecamatan" class="form-control" id="kecamatan" onchange="get_lurah()">
                            <option value="0" selected disabled>-- Pilih Kecamatan --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kelurahan</label>
                        <select name="kelurahan" class="form-control" id="kelurahan">
                            <option value="0" selected disabled>-- Pilih Kelurahan --</option>
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
            url: "{{ url('/data/kecamatan/json')}}",
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function(dataResult) {
                console.log(dataResult);
                var resultData = dataResult.data;
                $.each(resultData, function(index, row) {
                    $('#kecamatan').append('<option value="' + row.id_kecamatan + '">' + row.id_kecamatan + ' - ' + row.nama + '</option>');
                })
            }
        });

        $('#data-width').DataTable({
            processing: true,
            serverSide: true,
            order: [], //init datatable not ordering
            ajax: {
                url: '{{url("data/puskesmas/json")}}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama_upt'
                },
                {
                    data: 'nama_kecamatan'
                },
                {
                    data: 'nama_kelurahan'
                },
                {
                    data: 'id_puskesmas',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return '<button type="button" class="btn btn-success btn-sm btn-edit" data-id="' + data + '"><span class="fa fa-edit"></span> Edit</button>\
                        <a class="btn btn-danger btn-sm btn-hapus" data-id="' + data + '" data-handler="puskesmas" href="<?= url('data/puskesmas/delete') ?>/' + data + '">\
                        <span class="fa fa-trash"></span> Hapus</a> \
					              <form id="delete-form-' + data + '-puskesmas" action="<?= url('data/puskesmas/delete') ?>/' + data + '" \
                        method="GET" style="display: none;"> \
                        </form>'
                    }
                },
            ]
        });
    });

    //Button Trigger
    $("body").on("click", ".btn-add", function() {
        kosongkan();
        jQuery("#compose-form").attr("action", '<?= url('data/puskesmas'); ?>/store');
        jQuery("#compose .modal-title").html("Tambah Data <?= $title; ?>");
        jQuery("#compose").modal("toggle");

    });

    $("body").on("click", ".btn-edit", function() {

        $('#kelurahan').children().remove().end();
        $('#kelurahan').append('<option value="0" disabled selected>-- Pilih Kelurahan --</option>');
        var id = jQuery(this).attr("data-id");
        jQuery("#compose-form input[name=_method]").attr("value", "patch");

        $.ajax({
            url: "<?= url('data/puskesmas'); ?>/getjson/" + id,
            type: "GET",
            cache: false,
            async: false,
            dataType: 'json',
            success: function(dataResult) {
                console.log(dataResult);
                var resultData = dataResult.data;
                $.each(resultData, function(index, row) {
                    jQuery("#compose-form select[name=kecamatan]").val(row.kecamatan_id);
                    $.ajax({
                        url: "{{ url('/data/puskesmas/filter')}}/" + row.kecamatan_id,
                        type: "GET",
                        cache: false,
                        dataType: 'json',
                        success: function(dataResult) {
                            console.log(dataResult);
                            var resultData = dataResult.data;
                            $.each(resultData, function(index, rowed) {
                                $('#kelurahan').append('<option value="' + rowed.id_kelurahan + '">' + rowed.id_kelurahan + ' - ' + rowed.nama + '</option>');
                            })
                        }
                    });
                })
            }
        });

        $.ajax({
            url: "<?= url('data/puskesmas'); ?>/getjson/" + id,
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function(dataResult) {
                console.log(dataResult);
                var resultData = dataResult.data;
                $.each(resultData, function(index, row) {
                    jQuery("#compose-form input[name=puskesmas]").val(row.nama_upt);
                    $("#kelurahan").val(row.id_kelurahan);
                })
            }
        });
        jQuery("#compose-form").attr("action", '<?= url('data/puskesmas'); ?>/update/' + id);
        jQuery("#compose .modal-title").html("Update Data <?= $title ?>");
        jQuery("#compose").modal("toggle");
    });

    $("body").on("click", ".btn-simpan", function() {
        Swal.fire(
            'Data Disimpan!',
            '',
            'success'
        )
    });

    function kosongkan() {
        jQuery("#compose-form input[name=puskesmas]").val("");
        jQuery("#compose-form select[name=kecamatan]").val("0");
        jQuery("#compose-form input[name=_method]").val("");
    }

    function get_lurah() {
        $('#kelurahan').children().remove().end();
        $('#kelurahan').append('<option value="0" disabled selected>-- Pilih Kelurahan --</option>');
        var id = $("#kecamatan option:selected").val();
        $.ajax({
            url: "{{ url('/data/puskesmas/filter')}}/" + id,
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function(dataResult) {
                console.log(dataResult);
                var resultData = dataResult.data;
                $.each(resultData, function(index, row) {
                    $('#kelurahan').append('<option value="' + row.id_kelurahan + '">' + row.id_kelurahan + ' - ' + row.nama + '</option>');
                })
            }
        });
    }
</script>
@endsection