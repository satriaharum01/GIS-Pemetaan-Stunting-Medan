{{-- <form action="{{ url('beranda/laporan') }}" method="POST" >
 {{ csrf_field() }}    
    <div class="form-group row">
        <div class="col-sm-1">
        </div>
      <label for="staticEmail" class="col-sm-2 col-form-label">Tahun</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="tahun" placeholder="Masukkan Tahun">
      </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-1">
        </div>
      <label for="inputPassword" class="col-sm-2 col-form-label">Jumlah Sasaran</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="jumlahSasaran" placeholder="Masukkan Berupa Angka">
      </div>
    </div>
    
    <div class="form-group row">
        <div class="col-sm-1">
        </div>
      <label for="staticEmail" class="col-sm-2 col-form-label">Jumlah Balita</label>
      <div class="col-sm-7">
       <input type="text" class="form-control" name="jumlahBalita"  placeholder="Masukkan Berupa Angka">
      </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-1">
        </div>
      <label for="inputPassword" class="col-sm-2 col-form-label">Jumlah Balita Status Sangat Pendek</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="jumlahBalitaStatusSangatPendek" placeholder="Masukkan Berupa Angka">
      </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-1">
        </div>
      <label for="inputPassword" class="col-sm-2 col-form-label">Jumlah Balita Status Pendek</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="jumlahBalitaStatusPendek" placeholder="Masukkan Berupa Angka">
      </div>
    </div>
    
    <div class="form-group row">
        <div class="col-sm-1">
        </div>
      <label for="staticEmail" class="col-sm-2 col-form-label">Jumlah Balita Normal</label>
      <div class="col-sm-7">
       <input type="text" class="form-control" name="jumlahBalitaNormal"  placeholder="Masukkan Berupa Angka">
      </div>
    </div>


    <div class="form-group row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-1">
            <a href="{{ route('laporan.index') }}" class="btn btn-danger" tabindex="-1" role="button" aria-disabled="true">Kembali</a>
        </div>
        <div class="col-sm-1">
            <button type="submit" name="kirim" class="btn btn-primary">kirim</button>
        </div>
    </div>
    
  </form>
     --}}




     
     <div class="container " >
      <form>
        <div class="row mt-5 ml-4 mb-4">
            <div class="col col-lg-3">
              <label for="exampleInputEmail1" class="form-label text-dark">Tahun</label>
            </div>
            <div class="col col-lg-6">  
                <input type="email" class="form-control text-dark" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
        </div>

        <div class="row mt-2 ml-4 mb-4">
            <div class="col col-lg-3">
              <label for="exampleInputEmail1" class="form-label text-dark">Jumlah Sasaran</label>
            </div>
            <div class="col col-lg-6">  
                <input type="email" class="form-control text-dark" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
        </div>
        <div class="row mt-2 ml-4 mb-4">
            <div class="col col-lg-3">
              <label for="exampleInputEmail1" class="form-label text-dark">Jumlah Balita</label>
            </div>
            <div class="col col-lg-6">  
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
        </div>

        <div class="row mt-2 ml-4 mb-4">
            <div class="col col-lg-3">
              <label for="exampleInputEmail1" class="form-label text-dark">Jumlah Balita Sangat Pendek</label>
            </div>
            <div class="col col-lg-6">  
                <input type="email" class="form-control text-dark" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
        </div>
        <div class="row mt-2 ml-4 mb-4">
            <div class="col col-lg-3">
              <label for="exampleInputEmail1" class="form-label text-dark">Jumlah Balita Pendek</label>
            </div>
            <div class="col col-lg-6">  
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
        </div>

        <div class="row mt-2 ml-4 mb-4">
            <div class="col col-lg-3">
              <label for="exampleInputEmail1" class="form-label text-dark">Jumlah Balita Normal</label>
            </div>
            <div class="col col-lg-6">  
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
        </div>

        <div class="row mt-2 ml-4 mb-4">
          <div class="col col-lg-3">
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
      </div>
        
          
        </div>
    </form>

    </div>