<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <title> {{config('app.name')}} - {{$title}}</title>
    <style>
        .login-form-title img {
            width: 100%;
            margin: auto;
        }

        .login-form-title {
            margin-left: 1%;
            margin-right: 5%;
        }

        th {
            text-align: center;
        }

        .hr1 {
            margin-left: auto;
            margin-top: 1%;
            margin-bottom: 0;
            margin-right: auto;
            border: 2px solid black;
            width: 95%;
        }

        .hr2 {
            margin-left: auto;
            margin-top: 5px;
            margin-right: auto;
            border: 1px solid black;
            width: 95.3%;
        }

        body {
            background: rgba(0, 0, 0, 0.2);
        }

        .tanda-tangan {
            float: right;
            margin-top: 50px;
            position: relative;
            right: 10px;
        }

        page[size="A4"] {
            background: white;
            width: 29.7cm;
            /*height: 21cm;
                */
            display: block;
            margin: 0 auto;
            margin-bottom: 2.54cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
            padding-left: 1cm;
            padding-right: 1cm;
            padding-top: 0.5cm;
            padding-bottom: 1.5cm;
        }

        @media print {

            body,
            page[size="A4"] {
                margin: 0;
                box-shadow: 0;
                margin-bottom: 2.54cm;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <br />
        <div class="pull-left">
            {{config('app.name')}} - {{$title}}
        </div>
        <div class="pull-right">
            <button type="button" class="btn btn-success btn-md" onclick="printDiv('printableArea')">
                <i class="fa fa-print"> </i> Print File
            </button>
        </div>
    </div>
    <br />
    <div id="printableArea">
        <page size="A4">
            <section class="content" style="color:black;">
                <span class="login-form-title">
                    <img src="{{asset('assets/img')}}/kopsurat.png">
                </span>
                <hr class="hr1">
                <hr class="hr2">
                <center>
                    <br>
                    <h3>Data Laporan Stunting Puskesmas</h3>
                    <h3>Kota Medan</h3>
                    <br>
                </center>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="data-cetak" style="margin:auto;" class="table table-bordered table-striped table-hover" width="95%">
                                    <thead>
                                        <tr>
                                            <th width="5%">No.</th>
                                            <th>Puskesmas</th>
                                            <th>Sangat Pendek</th>
                                            <th>Pendek</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align:center;">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </page>
    </div>
</body>
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
    $(function() {

        //alert(link+tanggal+"/1");
        table = $('#data-cetak').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            paging: false,
            ordering: false,
            bInfo: false,
            ajax: {
                url: '{{url("test/3")}}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'Puskesmas'
                },
                {
                    data: 'SP'
                },
                {
                    data: 'P'
                },
                {
                    data: 'total'
                }
            ]
        });
    })
</script>

</html>