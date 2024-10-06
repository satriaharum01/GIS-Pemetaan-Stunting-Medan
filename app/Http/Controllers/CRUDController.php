<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use File;

//Models
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Puskesmas;
use App\Models\Laporan;
use App\Models\Register;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isEmpty;

class CRUDController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
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
        if (isset(Auth::user()->id)) {
            $userdetect = Auth::user()->name;
        } else {
            $userdetect = 'Guest';
        }
        $this->data['title'] = 'GIS Stunting';
        $this->data['userthis'] = $userdetect;
        $this->data['datakecamatan'] = json_encode($result);
        return view('template.map', $this->data);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    //Puskesmas
    public function json_puskesmas()
    {
        $data = Puskesmas::select('*')
            ->orderby('id_puskesmas', 'ASC')
            ->get();

        foreach ($data as $row) {
            $row->nama_kecamatan = $row->kelurahan->kecamatan->nama;
            $row->nama_kelurahan = $row->kelurahan->nama;
        }
        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store_puskesmas(Request $request)
    {
        DB::table('puskesmas')->insert([
            'nama_upt' => $request->puskesmas,
            'id_kelurahan' => $request->kelurahan
        ]);

        return redirect(route('data.puskesmas'));
    }

    public function update_puskesmas(Request $request, $id)
    {
        $rows = Puskesmas::find($id);
        $rows->update([
            'nama_upt' => $request->puskesmas,
            'id_kelurahan' => $request->kelurahan
        ]);

        return redirect(route('data.puskesmas'));
    }

    public function destroy_puskesmas($id)
    {
        $rows = Puskesmas::findOrFail($id);
        $rows->delete();

        return redirect(route('data.puskesmas'));
    }

    public function getjson_puskesmas($id)
    {
        $data = Puskesmas::select('*')
            ->where('id_puskesmas', '=', $id)
            ->get();
        foreach ($data as $row) {
            $row->kecamatan_id = $row->kelurahan->kecamatan->id_kecamatan;
        }
        return json_encode(array('data' => $data));
    }

    //Kecamatan
    public function json_kecamatan()
    {
        $data = Kecamatan::select('*')
            ->orderby('id_kecamatan', 'ASC')
            ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store_kecamatan(Request $request)
    {
        DB::table('kecamatan')->insert([
            'nama' => $request->nama
        ]);

        return redirect(route('data.kecamatan'));
    }

    public function update_kecamatan(Request $request, $id)
    {
        $rows = Kecamatan::find($id);
        $rows->update([
            'nama' => $request->nama
        ]);

        return redirect(route('data.kecamatan'));
    }

    public function destroy_kecamatan($id)
    {
        $rows = Kecamatan::findOrFail($id);
        $rows->delete();

        return redirect(route('data.kecamatan'));
    }

    public function getjson_kecamatan($id)
    {
        $data = Kecamatan::find($id);

        return json_encode(array('data' => $data));
    }

    //Kelurahan
    public function json_kelurahan()
    {
        $data = Kelurahan::select('*')
            ->orderby('id_kelurahan', 'ASC')
            ->get();
        foreach ($data as $row) {
            $row->nama_kecamatan = $row->kecamatan->nama;
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store_kelurahan(Request $request)
    {
        DB::table('kelurahan')->insert([
            'nama' => $request->nama,
            'id_kecamatan' => $request->kecamatan
        ]);

        return redirect(route('data.kelurahan'));
    }

    public function update_kelurahan(Request $request, $id)
    {
        $rows = Kelurahan::find($id);
        $rows->update([
            'nama' => $request->nama,
            'id_kecamatan' => $request->kecamatan
        ]);

        return redirect(route('data.kelurahan'));
    }

    public function destroy_kelurahan($id)
    {
        $rows = Kelurahan::findOrFail($id);
        $rows->delete();

        return redirect(route('data.kelurahan'));
    }

    public function getjson_kelurahan($id)
    {
        $data = Kelurahan::find($id);

        return json_encode(array('data' => $data));
    }


    //Stunting
    public function json_stunting($tahun)
    {
        if ($tahun == 0) {
            $data = Laporan::select('*')
                ->orderby('id_puskesmas', 'ASC')
                ->get();
        } else {
            $data = Laporan::select('*')
                ->where('tahun', '=', $tahun)
                ->orderby('id_puskesmas', 'ASC')
                ->get();
        }

        foreach ($data as $row) {
            $row->nama_puskesmas = $row->puskesmas->nama_upt;
            $row->total = ($row->sangat_pendek) + ($row->pendek);
            $row->rasio = round(($row->total / $row->jumlah) * 100, 3);
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store_stunting(Request $request)
    {
        DB::table('laporan')->insert([
            'tahun' => $request->tahun,
            'sasaran' => $request->sasaran,
            'jumlah' => $request->jumlah,
            'sangat_pendek' => $request->SP,
            'pendek' => $request->P,
            'normal' => $request->N,
            'id_puskesmas' => $request->puskesmas
        ]);
        if (Auth::user()->level == 'Puskesmas') {
            return redirect(route('puskesmas.stunting'));
        } else {
            return redirect(route('laporan.stunting'));
        }
    }

    public function update_stunting(Request $request, $id)
    {
        $rows = Laporan::find($id);
        $rows->update([
            'tahun' => $request->tahun,
            'sasaran' => $request->sasaran,
            'jumlah' => $request->jumlah,
            'sangat_pendek' => $request->SP,
            'pendek' => $request->P,
            'normal' => $request->N,
            'id_puskesmas' => $request->puskesmas
        ]);

        if (Auth::user()->level == 'Puskesmas') {
            return redirect(route('puskesmas.stunting'));
        } else {
            return redirect(route('laporan.stunting'));
        }
    }

    public function destroy_stunting($id)
    {
        $rows = Laporan::findOrFail($id);
        $rows->delete();

        if (Auth::user()->level == 'Puskesmas') {
            return redirect(route('puskesmas.stunting'));
        } else {
            return redirect(route('laporan.stunting'));
        }
    }

    public function getjson_stunting($id)
    {
        $data = Laporan::find($id);

        return json_encode(array('data' => $data));
    }

    //Users
    public function json_users()
    {
        $data = User::select('*')
            ->orderby('id_puskesmas', 'ASC')
            ->where('level', '!=', 'Admin')
            ->get();

        foreach ($data as $row) {
            if ($row->id_puskesmas == 0) {
                $row->nama_puskesmas = 'Dinkes';
            } else {
                $row->nama_puskesmas = $row->puskesmas->nama_upt;
            }
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store_users(Request $request)
    {
        DB::table('users')->insert([
            'name' => $request->nama,
            'email' => $request->email,
            'level' => 'Puskesmas',
            'password' => Hash::make($request->password),
            'id_puskesmas' => $request->puskesmas
        ]);

        return redirect(route('data.users'));
    }

    public function update_users(Request $request, $id)
    {
        if ($request->password) {
            $rows = User::find($id);
            $rows->update([
                'password' => Hash::make($request->password)
            ]);

            return redirect($request->page);
        } else {
            $rows = User::find($id);
            $rows->update([
                'name' => $request->nama,
                'email' => $request->email,
                'id_puskesmas' => $request->puskesmas
            ]);

            return redirect(route('data.users'));
        }
    }

    public function destroy_users($id)
    {
        $rows = User::findOrFail($id);
        $rows->delete();

        return redirect(route('data.users'));
    }

    public function getjson_users($id)
    {
        $data = User::find($id);

        return json_encode(array('data' => $data));
    }

    //Register
    public function json_register()
    {
        $data = Register::select('*')
            ->orderby('created_at', 'DESC')
            ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store_register(Request $request)
    {
        $parts = explode('@', $request->email);
        $user = $parts[0];

        $file = $request->file('file');
        $ext = '.' . $file->getClientOriginalExtension();
        $filename =  'surat_' . $user . $ext;
        $this->file_destroy($filename);
        $file->storeAs('file', $filename, ['disk' => 'public_uploads']);

        DB::table('register')->insert([
            'email' => $request->email,
            'file' => $filename
        ]);

        return redirect(route('login'));
    }

    public function destroy_register($id)
    {
        $rows = Register::findOrFail($id);
        $rows->delete();

        return redirect(route('data.registrasi'));
    }

    public function getjson_register($id)
    {
        $data = Register::find($id);

        return json_encode(array('data' => $data));
    }
    //MAP
    public function json_map($tahun)
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
                    if ($tahun == 0) {
                        $laporan = Laporan::select('*')
                            ->where('id_puskesmas', '=', $puskemas->id_puskesmas)
                            ->get();
                    } else {
                        $laporan = Laporan::select('*')
                            ->where('id_puskesmas', '=', $puskemas->id_puskesmas)
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
    //END MAP
    //Patching
    public function patching($id, $start, $end)
    {
        for ($i = $start; $i <= $end; $i++) {
            $rows = Puskesmas::find($i);
            $rows->update([
                'id_puskesmas' => $id
            ]);
        }
    }

    public function new_patching()
    {
        $data = Puskesmas::select('*')->get();
        foreach ($data as $row) {
            $i = 2 + $row->id_puskesmas;
            $nama = strtolower($row->nama_upt);
            $email = str_replace(' ', '_', $nama) . '@gmail.com';
            DB::table('users')->insert([
                'name' => $nama,
                'email' => $email,
                'password' => Hash::make('123456'),
                'id_puskesmas' => $row->id_puskesmas
            ]);
        }
    }
    //Filter

    public function file_destroy($filename)
    {
        if (File::exists(public_path('document/file/' . $filename . ''))) {
            File::delete(public_path('document/file/' . $filename . ''));
        }
    }

    public function get_year_laporan()
    {
        $data = array();
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
        return json_encode(array('data' => $data));
    }

    public function getjson_select($id)
    {
        $raw = Kecamatan::find($id);

        $result = Kelurahan::select('*')
            ->where('id_kecamatan', '=', $raw->id_kecamatan)
            ->get();
        return json_encode(array('data' => $result));
    }

    public function getjson_filter($id)
    {
        $result = Puskesmas::select('*')
            ->where('id_puskesmas', '=', $id)
            ->get();

        return json_encode(array('data' => $result));
    }

    public function getjson_get_laporan($id)
    {
        $laporan = Laporan::find($id);
        $result = Puskesmas::select('*')
            ->where('id_puskesmas', '=', $laporan->id_puskesmas)
            ->get();

        return json_encode(array('data' => $result));
    }
}
