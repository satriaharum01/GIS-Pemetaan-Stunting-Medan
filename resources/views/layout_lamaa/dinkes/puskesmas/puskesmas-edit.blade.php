
{{-- <input name="_method" type="hidden" value="PUT"> --}}
{{-- <p>{{ Request::url() }}</p> --}}
{{-- <p>{{ URL::to('/')."/beranda/puskesemas/".$ds->id; }}</p> --}}
{{--     
<input type="hidden" id="memid" name="id" value="{{ $ds->id }}">

    <div class="form-group row">
        <div class="col-sm-1">
        </div>
      <label for="staticEmail" class="col-sm-2 col-form-label">Username</label>
      <div class="col-sm-9">
        <input type="text" readonly class="form-control-plaintext" value="{{$ds->username}}">
      </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-1">
        </div>
      <label for="inputPassword" class="col-sm-2 col-form-label">Nama Puskesmas</label>
      <div class="col-sm-7">
        <input type="text" readonly class="form-control-plaintext"value="{{$ds->name}}">
      </div>
    </div>
    
    <div class="form-group row">
        <div class="col-sm-1">
        </div>
      <label for="staticEmail" class="col-sm-2 col-form-label">ID Puskesmas</label>
      <div class="col-sm-7">
       <input type="text" readonly class="form-control-plaintext" value="{{$ds->idPuskesmas}}">
      </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-1">
        </div>
      <label for="inputPassword" class="col-sm-2 col-form-label">Password Lama (BCRYPT)</label>
      <div class="col-sm-7">
        <input type="text" class="form-control-plaintext" value="{{$ds->password}}" readonly>
      </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-1">
        </div>
      <label for="inputPassword" class="col-sm-2 col-form-label">Password Baru</label>
      <div class="col-sm-7">
        <input type="password" name="passNew" class="form-control" value="" placeholder="Masukkan Password Baru">
      </div>
    </div>
    
    <div class="form-group row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-1">
            <a href="{{ url('beranda/puskesmas') }}" class="btn btn-danger" tabindex="-1" role="button" aria-disabled="true">Kembali</a>
        </div>
        <div class="col-sm-1">
            <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
        </div>
    </div>
    
  </form> --}}



  <div class="container">
      @foreach ($dataUser as $ds)
      <form action="{{  url('beranda/puskesmas')."/".$ds->id; }}" method="POST" >
      {{ method_field('PUT') }}
      {{ csrf_field() }}
      <div class="row mt-5 ml-4 mb-4">
          <div class="col col-lg-3">
            <label for="exampleInputEmail1" class="form-label text-dark">Username</label>
          </div>
          <div class="col col-lg-6">  
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$ds->username}}">
          </div>
      </div>

      <div class="row mt-2 ml-4 mb-4">
          <div class="col col-lg-3">
            <label for="exampleInputEmail1" class="form-label text-dark">Nama Puskesmas</label>
          </div>
          <div class="col col-lg-6">  
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$ds->name}}">
          </div>
      </div>
      <div class="row mt-2 ml-4 mb-4">
          <div class="col col-lg-3">
            <label for="exampleInputEmail1" class="form-label text-dark">ID Puskesmas</label>
          </div>
          <div class="col col-lg-6">  
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$ds->idPuskesmas}}">
          </div>
      </div>

      <div class="row mt-2 ml-4 mb-4">
          <div class="col col-lg-3">
            <label for="exampleInputEmail1" class="form-label text-dark">Password Lama</label>
          </div>
          <div class="col col-lg-6">  
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$ds->password}}">
          </div>
      </div>
      <div class="row mt-2 ml-4 mb-4">
          <div class="col col-lg-3">
            <label for="exampleInputEmail1" class="form-label text-dark">Password Baru</label>
          </div>
          <div class="col col-lg-6">  
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Password Baru">
          </div>
      </div>


      <div class="row mt-2 ml-4 mb-4">
        <div class="col col-lg-3">          
          
            <a href="{{ url('beranda/puskesmas') }}" class="btn btn-danger" tabindex="-1" role="button" aria-disabled="true">Kembali</a>
          
        </div>
        <div class="col col-lg-6">  
          
              <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
          
        </div>
    </div>
      
        
      </div>
  </form>

  </div>
@endforeach
    