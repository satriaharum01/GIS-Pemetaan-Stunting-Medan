<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>
    
    <title>For Testing</title>
</head>
<body>

    <label for="idKecamatan">Kecamatan</label>
    <select id="idKecamatan" name="nameKecamatan" class="custom-select col-ms-6 col-md-6">
        <option value="" disabled selected>Pilih Kecamatan ...</option>
        @foreach ($kecamatan as $a)
            <option value="{{$a->id}}">{{$a->nama_kecamatan}}</option>
        @endforeach
    </select><br><br>

    <label for="idPuskesmas">Puskesmas</label>
    <select id="idPuskesmas" name="namePuskesmas" class="custom-select col-ms-6 col-md-6">
        <option value="" disabled selected>Pilih Puskesmas ...</option>
    </select><br><br>

    <label for="idKelurahan">Kelurahan</label>
    <select id="idKelurahan" name="nameKelurahan" class="custom-select col-ms-6 col-md-6">
        <option value="" disabled selected>Pilih Kelurahan ...</option>
    </select><br><br>

<script>
    $(function(){
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}
        })
    });

    $(function(){
        $('#idKecamatan').on('change', function(){
            let id_kecamatan = $('#idKecamatan').val();
            
            $.ajax({
                type: 'POST',
                url: "{{route('getpuskesmas')}}",
                data: {id_kecamatan_kirim: id_kecamatan},
                cache: false,

                success: function(msg){
                    $('#idPuskesmas').html(msg);
                    $('#idKelurahan').html('<option value="" disabled selected>Pilih Kelurahan ...</option>');

                },
                error: function(data){
                    console.log('error:', data)
                },
            })
        })
    })
    
    $(function(){
        $('#idPuskesmas').on('change', function(){
            let id_puskesmas = $('#idPuskesmas').val();
            
            $.ajax({
                type: 'POST',
                url: "{{route('getkelurahan')}}",
                data: {id_puskesmas_kirim: id_puskesmas},
                cache: false,

                success: function(msg){
                    $('#idKelurahan').html(msg);
                },
                error: function(data){
                    console.log('error:', data)
                },
            })
        })
    })

</script>
</div>
</body>
</html>