<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use File;

//Models
use App\Models\Upt;
use App\Models\Kecamatan;
use App\Models\Puskesmas;
use App\Models\Laporan;

use function PHPUnit\Framework\isEmpty;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    public function get_rank()
    {
        $result = array();
        $data = Kecamatan::select('*')
            ->orderby('id_kecamatan', 'ASC')
            ->get();
        $upt = Puskesmas::select('*')
            ->get();
        $sumkecamatan = 0;

        foreach ($data as $row) {
            $total = 0;
            $result[$row->nama]['val'] = 0;
            foreach ($upt as $pow) {
                $puskemas = Puskesmas::find($pow->id_puskesmas);
                if ($puskemas->kelurahan->id_kecamatan == $row->id_kecamatan) {

                    $laporan = Laporan::select('*')
                        ->where('id_puskesmas', '=', $puskemas->id_puskesmas)
                        ->get();

                    foreach ($laporan as $hasil) {
                        $total = $total + $hasil->sangat_pendek + $hasil->pendek;
                    }
                }
                $result[] = array('nama' => $row->nama, 'val' => $total);
            }
        }

        $column = array_column($result, 'val');
        array_multisort($column, SORT_DESC, $result);

        return $result[0]['nama'];
    }

    public function get_sp()
    {
        $laporan = Laporan::select('*')
            ->orderBy('id_puskesmas', 'ASC')
            ->get()->sum('sangat_pendek');

        return $laporan;
    }

    public function get_p()
    {
        $laporan = Laporan::select('*')
            ->orderBy('id_puskesmas', 'ASC')
            ->get()->sum('pendek');

        return $laporan;
    }

    public function get_upt()
    {
        $laporan = Puskesmas::select('*')
            ->orderBy('id_puskesmas', 'ASC')
            ->get()->count();

        return $laporan;
    }

    public function get_kec()
    {
        $labels = array();
        $kecamatan = Kecamatan::select('nama')
            ->get();
        foreach ($kecamatan as $row) {
            $labels[] = $row->nama;
        }

        return json_encode($labels);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $get = $this->graph_area();
        $this->data['title'] = 'Dashboard';
        $this->data['upt'] = $this->get_upt();
        $this->data['kecLabel'] = $this->get_kec();
        $this->data['pusLabel'] = $this->graph_pus();
        $this->data['sp_upt'] = $this->get_sp();
        $this->data['p_upt'] = $this->get_p();
        $this->data['upt_rank'] = $this->get_rank();
        $this->data['newData'] = $this->graph_bar();
        $this->data['pusData'] = $this->graph_pus(1);
        $this->data['labels'] = json_encode($get['labels']);
        $this->data['graph_area'] = json_encode($get['result']);
        return view('admin.dashboard.index', $this->data);
    }

    public function puskesmas()
    {
        $this->data['title'] = 'Puskesmas';
        return view('admin.puskesmas.index', $this->data);
    }

    public function upt()
    {
        $this->data['title'] = 'Unit Pelaksana Teknis';
        return view('admin.puskesmas.upt', $this->data);
    }

    public function kecamatan()
    {
        $this->data['title'] = 'Kecamatan';
        return view('admin.kecamatan.index', $this->data);
    }

    public function kelurahan()
    {
        $this->data['title'] = 'Kelurahan';
        return view('admin.kelurahan.index', $this->data);
    }

    public function laporan()
    {
        $this->data['title'] = 'Laporan Stunting';
        return view('admin.laporan.index', $this->data);
    }

    public function data_users()
    {
        $this->data['title'] = 'Users';
        return view('admin.users.index', $this->data);
    }

    public function data_register()
    {
        $this->data['title'] = 'Registrasi';
        return view('admin.users.registrasi', $this->data);
    }
    
    public function cetak_stunting()
    {
        $this->data['title'] = 'Cetak Data';
        return view('admin.dashboard.print', $this->data);
    }

    public function peta()
    {
        $result = array(array());
        $data = Kecamatan::select('*')
            ->orderby('id_kecamatan', 'ASC')
            ->get();
        $upt = Puskesmas::select('*')
            ->get();
        $sumkecamatan = 0;

        foreach ($data as $row) {
            $result[$row->nama]['jumlah'] = 0;
            $result[$row->nama]['val'] = 0;
            $result[$row->nama]['sangat'] = 0;
            $result[$row->nama]['pendek'] = 0;
            $result[$row->nama]['normal'] = 0;
            foreach ($upt as $pow) {
                $puskemas = Puskesmas::find($pow->id_puskesmas);
                if ($puskemas->kelurahan->id_kecamatan == $row->id_kecamatan) {
                    $laporan = Laporan::select('*')
                        ->where('id_puskesmas', '=', $puskemas->id_puskesmas)
                        ->get();
                    foreach ($laporan as $hasil) {
                        $result[$row->nama]['jumlah'] = $result[$row->nama]['jumlah'] + $hasil->jumlah;
                        $result[$row->nama]['val'] = $result[$row->nama]['val'] + $hasil->sangat_pendek + $hasil->pendek;
                        $result[$row->nama]['sangat'] = $result[$row->nama]['sangat'] + $hasil->sangat_pendek;
                        $result[$row->nama]['pendek'] = $result[$row->nama]['pendek'] + $hasil->pendek;
                        $result[$row->nama]['normal'] = $result[$row->nama]['normal'] + $hasil->normal;
                    }
                }
            }
        }
        unset($result[0]);

        $this->data['title'] = 'Stunting';
        $this->data['datakecamatan'] = json_encode($result);
        return view('admin.laporan.peta', $this->data);
    }

    public function graph_area()
    {
        $data = array();
        $result = array();
        $labels = array();
        $compare = 0;
        $laporan = Laporan::select('tahun')
            ->orderby('tahun', 'ASC')
            ->get();
        foreach ($laporan as $row) {
            if ($compare != $row->tahun) {
                $compare = $row->tahun;
                $data[]['year'] = $row->tahun;
            }
        }
        foreach ($data as $row) {
            $hasil = 0;
            $laporan = Laporan::select('*')
                ->where('tahun', '=', $row['year'])
                ->get();
            foreach ($laporan as $rowed) {
                $rowed->total = ($rowed->sangat_pendek) + ($rowed->pendek);
                $hasil = $hasil + $rowed->total;
            }
            $result[] = $hasil;
            $labels[] = $row['year'];
        }
        return array('result' => $result, 'labels' => $labels);
    }

    public function graph_bar()
    {
        $data = array();
        $result = array();
        $compare = 0;

        $kecamatan = Kecamatan::select('*')
            ->get();

        $upt = Puskesmas::select('*')
            ->get();
        foreach ($kecamatan as $row) {
            if ($compare != $row->id_kecamatan) {
                $compare = $row->id_kecamatan;
                $data[]['kecamatan'] = $row->id_kecamatan;
            }
        }
        $dummy = array(array());
        foreach ($kecamatan as $row) {
            $SP = 0;
            $P = 0;
            foreach ($upt as $pow) {
                $puskemas = Puskesmas::find($pow->id_puskesmas);
                if ($puskemas->kelurahan->id_kecamatan == $row->id_kecamatan) {
                    $laporan = Laporan::select('*')
                        ->where('id_puskesmas', '=', $puskemas->id_puskesmas)
                        ->get();
                    foreach ($laporan as $rowed) {
                        $P = $P + $rowed->pendek;
                        $SP = $SP + $rowed->sangat_pendek;
                    }
                }
            }
            $dummy[0][] = $SP;
            $dummy[1][] = $P;
        }
        $result[] = array(
            'label' =>  'Sangat Pendek',
            'data' => $dummy[0],
            'backgroundColor' => '#e74a3b'
        );
        $result[] = array(
            'label' =>  'Pendek',
            'data' => $dummy[1],
            'backgroundColor' => '#f6c23e '
        );

        return json_encode($result);
    }

    public function graph_pus($a = 0)
    {
        $data = array();
        $temp = array();
        $result = array();
        $pusLabel = array();
        $compare = 0;

        $upt = Puskesmas::select('*')
            ->get();
        $dummy = array(array());

        foreach ($upt as $row) {
            $SP = 0;
            $P = 0;
            $total = 0;

            $laporan = Laporan::select('*')
                ->where('id_puskesmas', '=', $row->id_puskesmas)
                ->get();

            foreach ($laporan as $rowed) {
                $P = $P + $rowed->pendek;
                $SP = $SP + $rowed->sangat_pendek;
               
            }
            $total = $P + $SP;
            $temp[] = array(
                'SP' =>  $SP,
                'P' => $P,
                'total' => $total,
                'Puskesmas' => $row->nama_upt
            );
        }

        $columns = array_column($temp, 'total');
        array_multisort($columns, SORT_DESC, $temp);

        for ($i = 0; $i < 10; $i++) {
            $dummy[0][] = $temp[$i]['SP'];
            $dummy[1][] = $temp[$i]['P'];
            $pusLabel[] = $temp[$i]['Puskesmas'];
        }

        $result[] = array(
            'label' =>  'Sangat Pendek',
            'data' => $dummy[0],
            'backgroundColor' => '#e74a3b'
        );
        $result[] = array(
            'label' =>  'Pendek',
            'data' => $dummy[1],
            'backgroundColor' => '#f6c23e '
        );
        /*
        foreach ($upt as $row) {
            $SP = 0;
            $P = 0;
            $total = 0;
            $puskemas = Puskesmas::find($pow->id_puskesmas);
            if ($puskemas->kelurahan->id_kecamatan == $row->id_kecamatan) {
                $laporan = Laporan::select('*')
                    ->where('id_puskesmas', '=', $puskemas->id_puskesmas)
                    ->get();
                foreach ($laporan as $rowed) {
                    $P = $P + $rowed->pendek;
                    $SP = $SP + $rowed->sangat_pendek;
                    $total = $total + $P + $SP;
                }
            }

            $dummy[0][] = $SP;
            $dummy[1][] = $P;
            $dummy[2][] = $total;

            $result[] = array(
                'label' =>  'Sangat Pendek',
                'data' => $dummy[0],
                'backgroundColor' => '#e74a3b'
            );
            $result[] = array(
                'label' =>  'Pendek',
                'data' => $dummy[1],
                'backgroundColor' => '#f6c23e '
            );
            $result[] = array(
                'label' =>  'Total',
                'data' => $dummy[2],
                'backgroundColor' => '#f6c23e '
            );
        }
        */
        if ($a == 0) {
            return json_encode($pusLabel);
        } else if($a == 3){
            return Datatables::of($temp)
            ->addIndexColumn()
            ->make(true);
        }else{
            return json_encode($result);
        }
    }
}
