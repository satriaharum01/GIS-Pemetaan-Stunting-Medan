
  <div class="container ">
<form action="/beranda/puskesmas" method="post">
    @csrf
      <div class="row mt-5 ml-4 mb-4">
        <div class="col col-lg-3">
            <label for="idKecamatan" class="col-ms-1 col-md-2 text-dark">Kecamatan</label>
          </div>
          <div class="col col-lg-6">  
            <select id="idKecamatan" name="nameKecamatan" class="custom-select col-ms-6 col-md-6">
                <option value="" disabled selected>Pilih Kecamatan ...</option>
                @foreach ($kecamatan as $a)
                    <option value="{{$a->id}}">{{$a->nama_kecamatan}}</option>
                @endforeach
            </select>
          </div>
      </div>

      <div class="row ml-4 mb-4">
          <div class="col col-lg-3">
            <label for="idPuskesmas" class="col-ms-1 col-md-2 text-dark">Puskesmas</label>
          </div>
          <div class="col col-lg-6">  
            <select id="idPuskesmas" name="namePuskesmas" class="custom-select col-ms-6 col-md-6">
                <option value="" disabled selected>Pilih Puskesmas ...</option>
            </select>
          </div>
      </div>

      <div class="row ml-4 mb-4">
          <div class="col col-lg-3">
            <label for="idKelurahan" class="col-ms-1 col-md-2 text-dark">Kelurahan</label>
          </div>
          <div class="col col-lg-6">  
            <select id="idKelurahan" name="nameKelurahan" class="custom-select col-ms-6 col-md-6">
                <option value="" disabled selected>Pilih Kelurahan ...</option>
            </select>
          </div>
      </div>

    
      <div class="row mt-2 ml-4 mb-4">
        <div class="col col-lg-3">
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
    </div>

</div>
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