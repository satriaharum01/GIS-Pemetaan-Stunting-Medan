<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Puskesmas</th>
        <th scope="col">Username</th>
        <th scope="col">Id Puskesmas</th>
        <th scope="col">Aksi</th>        
      </tr>
    </thead>
    @php
        $no = 1;
    @endphp
    @foreach ($dataUser as $u)        
    <tbody>
    <tr>        
        <th scope="row">{{ $no++ }}</th>
        <td>{{$u->name}}</td>
        <td>{{$u->username}}</td>
        <td>{{$u->idPuskesmas}}</td>
        <td>
            <a href="{{ url('beranda/puskesmas/'. $u->id. '/info')  }}">  <i class="material-icons">info</i></a>
            <a href="{{ url('beranda/puskesmas/'. $u->id. '/edit')  }}" ><i class="material-icons">edit</i></a> 
            <a href="#" class="deletePus" data-toggle="modal" data-id="{{$u->id}}"><i class="material-icons">delete</i></a>
        </td>
    </tr>
    </tbody>
    @endforeach
  </table>


  {{-- ini pihlain pake @section('ajaxFile') kalo script gak bisa --}}