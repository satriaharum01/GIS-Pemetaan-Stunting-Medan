{{-- <h3>Tahun : 2020</h3>
<div class="form-group row">
    <div class="col-sm-1">
    </div>
  <label for="staticEmail" class="col-sm-3 col-form-label">Id Laporan</label>
  <div class="col-sm-7">
    <p class="col-sm-2 col-form-label">Pertama</p>
  </div>
</div>

<div class="form-group row">
    <div class="col-sm-1">
    </div>
  <label for="inputPassword" class="col-sm-3 col-form-label">Id Puskesmas</label>
  <div class="col-sm-7">
    <p class="col-sm-5 col-form-label">Kedua</p>
  </div>
</div>

<div class="form-group row">
    <div class="col-sm-1">
    </div>
  <label for="staticEmail" class="col-sm-3 col-form-label">Jumlah Sasaran</label>
  <div class="col-sm-7">
    <p class="col-sm-5 col-form-label">Ketiga</p>
  </div>
</div>

<div class="form-group row">
    <div class="col-sm-1">
    </div>
  <label for="staticEmail" class="col-sm-3 col-form-label">Jumlah Balita</label>
  <div class="col-sm-7">
    <p class="col-sm-2 col-form-label">Keempat</p>
  </div>
</div>

<div class="form-group row">
    <div class="col-sm-1">
    </div>
  <label for="staticEmail" class="col-sm-3 col-form-label">Balita Status Sangat Pendek</label>
  <div class="col-sm-7">
    <p class="col-sm-5 col-form-label">Kelima</p>
  </div>
</div>

<div class="form-group row">
    <div class="col-sm-1">
    </div>
  <label for="staticEmail" class="col-sm-3 col-form-label">Balita Status Pendek</label>
  <div class="col-sm-7">
    <p class="col-sm-5 col-form-label">Keenam</p>
  </div>
</div>

<div class="form-group row">
    <div class="col-sm-1">
    </div>
  <label for="inputPassword" class="col-sm-3 col-form-label">Balita Normal</label>
  <div class="col-sm-7">
    <p class="col-sm-5 col-form-label">Ketujuh</p>
  </div>
</div>

<div class="form-group row">
    <div class="col-sm-1">
    </div>
  <label for="inputPassword" class="col-sm-3 col-form-label">Total</label>
  <div class="col-sm-7">
    <p class="col-sm-5 col-form-label">Sepuluh</p>
  </div>
</div>

<div class="form-group row">
    <div class="col-sm-1">
    </div>
  <label for="inputPassword" class="col-sm-3 col-form-label">Persentase</label>
  <div class="col-sm-7">
    <p class="col-sm-5 col-form-label">Sebelas</p>
  </div>
</div>

<div class="form-group row">
    <div class="col-sm-1">
    </div>
  <label for="inputPassword" class="col-sm-3 col-form-label">Data Dibuat</label>
  <div class="col-sm-7">
    <p class="col-sm-5 col-form-label">Dua Belas</p>
  </div>
</div>

<div class="form-group row">
    <div class="col-sm-1">
    </div>
  <label for="inputPassword" class="col-sm-3 col-form-label">Data Dibuat</label>
  <div class="col-sm-7">
    <p class="col-sm-5 col-form-label">Tiga Belas</p>
  </div>
</div> --}}




  
  {{-- <form action="{{ url('beranda/laporan/' . $laporan[0]['idPuskesmas'] . '/info')  }}" method="POST"> --}}
  @csrf
  {{-- <input type="hidden" name="idPus" value="{{ $laporan[0]['idPuskesmas'] }}" disabled> --}}

  
  <div class="container ">
    <form>
      <div class="row mt-5 ml-4 mb-4">
          <div class="col col-lg-12">
            <label for="staticEmail" class=" text-dark">Pilih Tahun untuk melihat laporan yang akan di tampilkan:</label>
          </div>
      </div>
      <div class="row ml-4 mb-4">
          <div class="col col-lg-3">
            <label for="exampleInputEmail1" class="form-label text-dark">Tahun</label>
          </div>
          <div class="col col-lg-1">  
            <select name="idLap" id="" class="form-control">
      
              <option value="#">2020</option>
              <option value="#">2021</option>
       
          </select>
          </div>
      </div>

    
      <div class="row mt-2 ml-4 mb-4">
        <div class="col col-lg-3">
          <button type="submit" class="btn btn-primary">Lihat</button>
        </div>
    </div>
      
        
      </div>
  </form>

  </div>