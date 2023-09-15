<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use App\Organisasi;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KaryawanImport;
use App\Exports\KaryawanExport;
use App\Exports\TesExport;

class KaryawanController extends Controller
{
    public function index(Request $request, $jenis)
    {
    	$data ['jenis'] = $jenis;
    	$data ['PARENTTAG'] = 'karyawan';
    	$data ['CHILDTAG'] = $jenis;
        $data ['list_organisasi'] = Organisasi::all();
    	return view('pages.karyawan',$data);
    }

    public function data(Request $request,$jenis)
    {
        $jenis = str_replace('-', ' ', $jenis);
    	$orderBy = 'karyawan.merk_comm_device';
        switch($request->input('order.0.column')){
            case "1":
                $orderBy = 'karyawan.merk_comm_device';
                break;
            case "2":
                $orderBy = 'karyawan.nama';
                break;
            case "3":
                $orderBy = 'karyawan.merk_meter';
                break;
            case "4":
                $orderBy = 'karyawan.telp';
                break;
            case "5":
                $orderBy = 'organisasi.nama';
                break;
            case "6":
                $orderBy = 'karyawan.provider';
                break;
            case "7":
                $orderBy = 'karyawan.ip_address';
                break;
        }

        $data = Karyawan::select([
            'karyawan.*',
            'organisasi.nama as nama_organisasi'
        ])
        ->where('status',$jenis)
        ->join('organisasi','organisasi.id','=','karyawan.organisasi_id')
        ;

        if($request->input('search.value')!=null){
            $data = $data->where(function($q)use($request){
                $q->whereRaw('LOWER(karyawan.merk_comm_device) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(karyawan.nama) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(karyawan.merk_meter) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(karyawan.telp) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(karyawan.status) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(karyawan.status) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(organisasi.nama) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ;
            });
        }

        if($request->input('organisasi')!=null){
            $data = $data->where('organisasi_id',$request->organisasi);
        }

        $recordsFiltered = $data->get()->count();
        if($request->input('length')!=-1) $data = $data->skip($request->input('start'))->take($request->input('length'));
        $data = $data->orderBy($orderBy,$request->input('order.0.dir'))->get();
        $recordsTotal = $data->count();
        return response()->json([
            'draw'=>$request->input('draw'),
            'recordsTotal'=>$recordsTotal,
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$data
        ]);
    }

    public function create(Request $request)
    {
        #AMBIL SEMUA REQUEST KECUALI TOKEN DAN ip_address. SOALNYA ip_address = FILE BUKAN TEKS
        $will_insert = $request->except(['ip_address','_token']);

        #JIKA USER UPLOAD ip_address
        if($request->hasFile('ip_address')){
            $extension = $request->file('ip_address')->getClientOriginalExtension();#AMBIL EXTENSION
            #STORE KE SOTRAGE
            $path_ip_address = $request->file('ip_address')->storeAs(
                'ip_address', $request->input('merk_comm_device').'.'.$extension
            );
            #SET KE VARIABLE YANG AKAN DI INSERT KE KARYAWAN TABLE
            $will_insert['ip_address'] = $path_ip_address;
        }

        Karyawan::create($will_insert);
        // return redirect('/karyawan/aktif');
        return response()->json(true);
    }

    public function edit(Request $request)
    {
        $will_update = $request->except(['ip_address','_token','_method']);
        #JIKA USER UPLOAD ip_address
        if($request->hasFile('ip_address')){
            $extension = $request->file('ip_address')->getClientOriginalExtension();#AMBIL EXTENSION
            #STORE KE SOTRAGE
            $path_ip_address = $request->file('ip_address')->storeAs(
                'ip_address', $request->input('merk_comm_device').'.'.$extension
            );
            #SET KE VARIABLE YANG AKAN DI INSERT KE KARYAWAN TABLE
            $will_update['ip_address'] = $path_ip_address;
        }
        Karyawan::where('id',$request->input('id'))->update($will_update);

        return response()->json(true);
    }

    public function updateStatus(Request $request)
    {
        $karyawan = Karyawan::find($request->input('id'));
        $karyawan->status = $request->status;
        $karyawan->save();
        return response()->json(true);
    }

    public function importDataKaryawan(Request $request)
    {
        $file = $request->file('excel-karyawan');
        Excel::import(new KaryawanImport,$file);
        return redirect()->back();
    }

    public function exportData(Request $request)
    {
        return Excel::download(new KaryawanExport, 'karyawan.xlsx');
    }

    public function exportDataTerpilih(Request $request)
    {
        $ids = explode(',', $request->ids);
        return Excel::download(new KaryawanExport($ids), 'karyawan.xlsx');
    }

    public function tesExport(Request $request)
    {
        return Excel::download(new TesExport, 'tes.xlsx');
    }

    public function nonAktifkanBanyak(Request $request)
    {
        Karyawan::whereIn('id',$request->ids)->update(['status'=>'non aktif']);
        return response()->json(true);
    }

    public function aktifkanBanyak(Request $request)
    {
        Karyawan::whereIn('id',$request->ids)->update(['status'=>'aktif']);
        return response()->json(true);
    }    

    public function downloadPdf(Request $request,$id)
    {
        $data['karyawan'] = Karyawan::select([
            'karyawan.*',
            'organisasi.nama as nama_organisasi'
        ])
        ->join('organisasi','organisasi.id','=','karyawan.organisasi_id')
        ->find($id)
        ;
        $pdf = \PDF::loadView('pdf.karyawan', $data);
        return $pdf->stream('karyawan.pdf');
    }

    public function getip_address(Request $request,$id)
    {
        $karyawan = Karyawan::whereNotNull('ip_address')->find($id);
        if($karyawan == null) abort(404);
        $path = storage_path('app/'.$karyawan->ip_address);
        // $file = \Storage::get($path);
        // $type = \Storage::mimeType($path);
        // $response = \Response::make($file, 200)->header("Content-Type", $type);
        // return $response;
        return response()->file($path);
    }
}
