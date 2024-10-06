<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use File;

//Models
use App\Models\Kecamatan;
use App\Models\Puskesmas;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class PuskesmasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isPuskesmas');
    }

    public function get_rank()
    {
        $id_puskesmas = 0;
        $data = array();
        $laporan = Laporan::select('*')
            ->where('id_puskesmas', '=', Auth::user()->id_puskesmas)
            ->orderBy('id_puskesmas', 'ASC')
            ->get();
        foreach ($laporan as $row) {
            $hasil = 0;
            if ($id_puskesmas != $row->id_puskesmas) {
                $id_puskesmas = $row->id_puskesmas;
                $hasil = $hasil + $row->sangat_pendek + $row->pendek;
                $data[] = array('nama' => $row->puskesmas->nama_upt, 'val' => $hasil);
            }
        }
        $column = array_column($data, 'val');
        array_multisort($column, SORT_DESC, $data);

        return $data[0]['nama'];
    }

    public function get_sp()
    {
        $laporan = Laporan::select('*')
            ->where('id_puskesmas', '=', Auth::user()->id_puskesmas)
            ->orderBy('id_puskesmas', 'ASC')
            ->get()->sum('sangat_pendek');

        return $laporan;
    }

    public function get_p()
    {
        $laporan = Laporan::select('*')
            ->where('id_puskesmas', '=', Auth::user()->id_puskesmas)
            ->orderBy('id_puskesmas', 'ASC')
            ->get()->sum('pendek');

        return $laporan;
    }
    
    public function get_balita()
    {
        $laporan = Laporan::select('*')
            ->where('id_puskesmas', '=', Auth::user()->id_puskesmas)
            ->orderBy('id_puskesmas', 'ASC')
            ->get()->sum('jumlah');

        return $laporan;
    }

    public function get_puskesmas()
    {
        $laporan = Puskesmas::select('*')
            ->where('id_puskesmas', '=', Auth::user()->id_puskesmas)
            ->orderBy('id_puskesmas', 'ASC')
            ->get()->count();

        return $laporan;
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
        $this->data['balita'] = $this->get_balita();
        $this->data['sp_upt'] = $this->get_sp();
        $this->data['p_upt'] = $this->get_p();
        $this->data['upt_rank'] = $this->get_rank();
        $this->data['newData'] = $this->graph_bar();
        $this->data['labels'] = json_encode($get['labels']);
        $this->data['graph_area'] = json_encode($get['result']);
        return view('puskesmas.dashboard.index', $this->data);
    }

    public function upt()
    {
        $this->data['title'] = 'Unit Pelaksana Teknis';
        return view('puskesmas.puskesmas.upt', $this->data);
    }

    public function laporan()
    {
        $this->data['title'] = 'Laporan Stunting';
        return view('puskesmas.laporan.index', $this->data);
    }

    public function data_users()
    {
        $this->data['title'] = 'Users';
        return view('puskesmas.users.index', $this->data);
    }

    public function peta()
    {
        $pusek = Puskesmas::find(Auth::user()->id_puskesmas);
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
                if ($pusek->kelurahan->id_kecamatan == $row->id_kecamatan) {
                    $laporan = Laporan::select('*')
                        ->where('id_puskesmas', '=', $pusek->id_puskesmas)
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
        $this->data['sectorArea'] = $pusek->kelurahan->kecamatan->nama;
        $this->data['datakecamatan'] = json_encode($result);
        return view('puskesmas.laporan.peta', $this->data);
    }

    public function json_stunting($tahun)
    {
        if ($tahun == 0) {
            $data = Laporan::select('*')
                ->where('id_puskesmas', '=', Auth::user()->id_puskesmas)
                ->orderby('id_puskesmas', 'ASC')
                ->get();
        } else {
            $data = Laporan::select('*')
                ->where('id_puskesmas', '=', Auth::user()->id_puskesmas)
                ->where('tahun', '=', $tahun)
                ->orderby('id_puskesmas', 'ASC')
                ->get();
        }

        foreach ($data as $row) {
            $row->nama_upt = $row->puskesmas->nama_upt;
            $row->total = ($row->sangat_pendek) + ($row->pendek);
            $row->rasio = round(($row->total / $row->jumlah)*100, 3);
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
    public function json_map($tahun)
    {
        $pusek = Puskesmas::find(Auth::user()->id_puskesmas);
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
                if ($pusek->kelurahan->id_kecamatan == $row->id_kecamatan) {
                    if ($tahun == 0) {
                        $laporan = Laporan::select('*')
                            ->where('id_puskesmas', '=', $pusek->id_puskesmas)
                            ->get();
                    } else {
                        $laporan = Laporan::select('*')
                            ->where('id_puskesmas', '=', $pusek->id_puskesmas)
                            ->where('tahun', '=', $tahun)
                            ->get();
                    }

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
        return json_encode($result);
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
                ->where('id_puskesmas', '=', Auth::user()->id_puskesmas)
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
        $laporan = Laporan::select('tahun')
            ->orderby('tahun', 'ASC')
            ->get();
        foreach ($laporan as $row) {
            if ($compare != $row->tahun) {
                $compare = $row->tahun;
                $data[]['year'] = $row->tahun;
            }
        }
        $dummy = array(array());
        foreach ($data as $row) {
            $SP = 0;
            $P = 0;
            $laporan = Laporan::select('*')
                ->where('tahun', '=', $row['year'])
                ->where('id_puskesmas', '=', Auth::user()->id_puskesmas)
                ->get();
            foreach ($laporan as $rowed) {
                $P = $P + $rowed->pendek;
                $SP = $SP + $rowed->sangat_pendek;
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
    //END JSON
}
