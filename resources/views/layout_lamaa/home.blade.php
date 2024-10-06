@extends('layout.main')

@section('judul')
    
@endsection

@section('isi')    
    

    @if ($user->level == 1)
        {{-- index --}}
        @if(Request::is('beranda'))
             @include('layout.dinkes.index')
        @endif

      
                
        
        {{-- laporan --}}
        {{-- tambah --}}
        @if(Request::is('beranda/laporan'))
            @include('layout.dinkes.laporan.laporan-index')   
        {{-- tambah --}}
        @elseif(Request::is('beranda/laporan/create'))
            @include('layout.dinkes.laporan.laporan-tambah')   
        {{-- edit --}}
        @elseif(Request::is('beranda/laporan/{id}/edit'))
            @include('layout.dinkes.laporan.laporan-tambah')    
        {{-- info --}}
        @elseif(Request::is('beranda/laporan/{id}/info'))
            @include('layout.dinkes.laporan.laporan-tambah')
        @endif    
            


        {{-- map --}}
        {{-- beranda --}}
        @if(Request::is('beranda/map'))
            @include('layout.dinkes.map.map-index')
            
        @elseif(Request::is('beranda/map/create'))
            @include('layout.dinkes.map.map-tambah')   
        {{-- edit --}}
        @elseif(Request::is('beranda/map/{id}/edit'))
            @include('layout.dinkes.map.map-tambah')    
        {{-- info --}}
        @elseif(Request::is('beranda/map/{id}/info'))
            @include('layout.dinkes.map.map-tambah')    
        @endif



        {{-- puskesmas --}}
        {{-- index data --}}
        @if(Request::is('beranda/puskesmas'))
            @include('layout.dinkes.puskesmas.puskesmas-index')   
        {{-- tambah --}}
        @elseif(Request::is('beranda/puskesmas/create'))
            @include('layout.dinkes.puskesmas.puskesmas-tambah')   
        {{-- edit --}}
        @elseif(Request::is('beranda/puskesmas/'.$ambilID.'/edit'))
            @include('layout.dinkes.puskesmas.puskesmas-edit')    
        {{-- info --}}
        @elseif(Request::is('beranda/puskesmas/'.$ambilID.'/info'))
            @include('layout.dinkes.puskesmas.puskesmas-info')    
        @endif
    @endif


    @if ($user->level == 2)
        {{-- index --}}
        @if(Request::is('beranda'))
             @include('layout.puskesmas.index')
             
        {{-- laporan --}}
        {{-- show --}}

        {{-- laporan --}}
        {{-- index --}}
        @elseif(Request::is('beranda/laporan'))
            @include('layout.puskesmas.laporan.laporan-index')   
        {{-- tambah --}}
        @elseif(Request::is('beranda/laporan/create'))
            @include('layout.puskesmas.laporan.laporan-tambah')   
        {{-- info --}}
        @elseif(Request::is('beranda/laporan/'.$ambilID))
            @include('layout.puskesmas.laporan.laporan-info')    
        {{-- edit --}}
        @elseif(Request::is('beranda/laporan/'.$ambilID.'/edit'))
            @include('layout.puskesmas.laporan.laporan-edit')    
            
      
        @endif
    @endif
    
@endsection


@section('ajaxFile')
<script>
$(document).ready( function(){
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.deletePus', function(event){
                event.preventDefault();
                var id = $(this).data('id');
                $('#hapusModal').modal('show');
                $('#memid').val(id);
            })

            $('#hapusForm').on('submit', function(e){
                e.preventDefault();
                var form = $(this).serialize();
                var url = $(this).attr('action');
                $.post(url,form,function(data){
                    $('#hapusModal').modal('hide');
                    window.location = '/beranda/puskesmas/';
                    //  top.location.href="/beranda/puskesmas/";//redirection
                    // window.location.href = "/beranda/puskesmas/";
                })
            });
        });
         
</script>
@endsection