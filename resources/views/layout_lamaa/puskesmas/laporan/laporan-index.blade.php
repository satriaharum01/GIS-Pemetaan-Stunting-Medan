{{-- 
<div class="form-group row">
  <div class="col-sm-1">
  </div>
<label for="staticEmail" class="col-sm-7 col-form-label">Pilih Tahun untuk melihat laporan yang akan di tampilkan :</label>
</div>

<form action="{{ url('beranda/laporan/' . $laporan[0]['idPuskesmas'] . '/info')  }}" method="POST">
@csrf
<input type="hidden" name="idPus" value="{{ $laporan[0]['idPuskesmas'] }}" disabled>
<div class="form-group row">
    <div class="col-sm-1">
    </div>
  <label for="staticEmail" class="col-sm-2 col-form-label">Tahun</label>
  <div class="col-sm-2">
    <select name="idLap" id="" class="form-control">
    @foreach ($laporan as $lp)      
        <option value="{{$lp->idLaporan}}">{{ $lp->tahun }}</option>
    @endforeach      
    </select>
  </div>
</div>
<div class="form-group row">
  <div class="col-sm-1">
  </div>
  <button type="submit" class="btn btn-primary mb-2" name="submit">Pilih</button>
</div>
</form> --}}




<form>
  <fieldset disabled>
    <legend>Disabled fieldset example</legend>
    <div class="mb-3">
      <label for="disabledTextInput" class="form-label">Disabled input</label>
      <input type="text" id="disabledTextInput" class="form-control" placeholder="Disabled input">
    </div>
    <div class="mb-3">
      <label for="disabledSelect" class="form-label">Disabled select menu</label>
      <select id="disabledSelect" class="form-select">
        <option>Disabled select</option>
      </select>
    </div>
    <div class="mb-3">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="disabledFieldsetCheck" disabled>
        <label class="form-check-label" for="disabledFieldsetCheck">
          Can't check this
        </label>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </fieldset>
</form>