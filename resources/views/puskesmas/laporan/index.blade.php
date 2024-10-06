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
            <div class="d-flex flex-row mb-5">
                <div class="d-flex flex-row col-sm-4">
                    <label style="width: 75%; padding-top:3%;" for="">Pilih Tahun :</label>
                    <select onchange="changetahun(this.value)" class="form-control" name="tahun" id="tahun">
                        <option value="0">Semua</option>
                    </select>
                </div>
                <div class="d-flex flex-row mb-5 col-sm-6"></div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="data-width" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align:center; vertical-align: middle;">No</th>
                            <th style="text-align:center; vertical-align: middle;">Tahun</th>
                            <th style="text-align:center; vertical-align: middle;">Jumlah Sasaran</th>
                            <th style="text-align:center; vertical-align: middle;">Jumlah Balita</th>
                            <th style="text-align:center; vertical-align: middle;">Balita Sangat Pendek</th>
                            <th style="text-align:center; vertical-align: middle;">Balita Pendek</th>
                            <th style="text-align:center; vertical-align: middle;">Balita Normal</th>
                            <th style="text-align:center; vertical-align: middle;">Total</th>
                            <th style="text-align:center; vertical-align: middle;">%</th>
                            <th style="text-align:center; vertical-align: middle;" width="15%">#</th>
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
                        <label>Puskesmas</label>
                        <select name="puskesmas" class="form-control" id="puskesmas">
                            <option value="0" selected disabled>-- Pilih Puskesmas --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="number" name="tahun" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Sasaran</label>
                        <input type="number" name="sasaran" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Balita Sangat Pendek</label>
                        <input type="number" name="SP" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Balita Pendek</label>
                        <input type="number" name="P" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Balita Normal</label>
                        <input type="number" name="N" class="form-control" autocomplete="off">
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
    var stat = 0;
    $(function() {
        var id = <?= Auth::user()->id_puskesmas ?>;
        $.ajax({
            url: "<?= url('data/puskesmas/'); ?>/getjson/" + id,
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
        jQuery("#compose-form select[name=puskesmas]").val(id);
        $.ajax({
            url: "{{ url('/data/laporan/filter/getyear')}}",
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function(dataResult) {
                console.log(dataResult);
                var resultData = dataResult.data;
                $.each(resultData, function(index, row) {
                    $('#tahun').append('<option value="' + row.year + '">' + row.year + '</option>');
                })
            }
        });

        table = $('#data-width').DataTable({
            processing: true,
            serverSide: true,
            order: [], //init datatable not ordering
            ajax: {
                url: '{{url("puskesmas/stunting/json/0")}}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'tahun'
                },
                {
                    data: 'sasaran'
                },
                {
                    data: 'jumlah'
                },
                {
                    data: 'sangat_pendek'
                },
                {
                    data: 'pendek'
                },
                {
                    data: 'normal'
                },
                {
                    data: 'total'
                },
                {
                    data: 'rasio'
                },
                {
                    data: 'id_laporan',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return '<button type="button" class="btn btn-success btn-sm btn-edit" data-id="' + data + '"><span class="fa fa-edit"></span></button>\
                        <a class="btn btn-danger btn-sm btn-hapus" data-id="' + data + '" data-handler="laporan" href="<?= url('laporan/stunting/delete') ?>/' + data + '">\
                        <span class="fa fa-trash"></span></a> \
					              <form id="delete-form-' + data + '-laporan" action="<?= url('laporan/stunting/delete') ?>/' + data + '" \
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
        jQuery("#compose-form").attr("action", '<?= url('laporan/stunting'); ?>/store');
        jQuery("#compose .modal-title").html("Tambah Data <?= $title; ?>");
        jQuery("#compose").modal("toggle");

    });

    $("body").on("click", ".btn-edit", function() {
        var id = jQuery(this).attr("data-id");
        kosongkan();
        jQuery("#compose-form input[name=_method]").attr("value", "patch");
        $.ajax({
            url: "<?= url('laporan/stunting'); ?>/getjson/" + id,
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function(dataResult) {
                console.log(dataResult);
                var resultData = dataResult;
                $.each(resultData, function(index, row) {
                    jQuery("#compose-form input[name=tahun]").val(row.tahun);
                    jQuery("#compose-form input[name=sasaran]").val(row.sasaran);
                    jQuery("#compose-form input[name=jumlah]").val(row.jumlah);
                    jQuery("#compose-form input[name=SP]").val(row.sangat_pendek);
                    jQuery("#compose-form input[name=P]").val(row.pendek);
                    jQuery("#compose-form input[name=N]").val(row.normal);
                })
            }
        });
        jQuery("#compose-form").attr("action", '<?= url('laporan/stunting'); ?>/update/' + id);
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

    function changetahun(val) {

        table.ajax.url('{{url("puskesmas/stunting/json")}}/' + val).load();
        if (val === '0') {
            if (stat === 1) {
                var column = table.column(1);
                // Toggle the visibility
                column.visible(!column.visible());
            }
            stat = 0;
        } else {
            if (stat === 0) {
                //$('#show_hide').prop('hidden', true);
                var column = table.column(1);
                // Toggle the visibility
                column.visible(!column.visible());
            }
            stat = 1;
        }
    }

    function kosongkan() {
        jQuery("#compose-form input[name=tahun]").val("");
        jQuery("#compose-form input[name=sasaran]").val("");
        jQuery("#compose-form input[name=jumlah]").val("");
        jQuery("#compose-form input[name=SP]").val("");
        jQuery("#compose-form input[name=P]").val("");
        jQuery("#compose-form input[name=N]").val("");
        jQuery("#compose-form select[name=puskesmas]").val(<?= Auth::user()->id_puskesmas ?>);
        jQuery("#compose-form input[name=_method]").val("");
    }
</script>
@endsection