<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeeExport;
use App\Imports\EmployeeImport;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = Employee::where('nama', 'LIKE', '%' . $request->search . '%')->paginate(5);
        } else {
            // $data = Employee::all();
            $data = Employee::paginate(5);
        }

        return view('datapegawai', compact('data'));
    }

    public function tambahpegawai()
    {
        return view('tambahpegawai');
    }

    public function insertpegawai(Request $request)
    {
        $data = Employee::create($request->all());
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('pegawai')->with('success', 'Data berhasil ditambahkan');
    }

    public function editpegawai($id)
    {
        $data = Employee::find($id);
        return view('editpegawai', compact('data'));
    }

    public function updatepegawai(Request $request, $id)
    {
        $data = Employee::find($id);
        $data->update($request->all());
        return redirect()->route('pegawai')->with('success', 'Data berhasil diubah');
    }

    public function deletepegawai($id)
    {
        $data = Employee::find($id);
        $data->delete();
        return redirect()->route('pegawai')->with('success', 'Data berhasil dihapus');
    }

    public function exportpdf()
    {
        $data = Employee::all();
        view()->share('data', $data);
        $pdf = PDF::loadView('datapegawai-pdf', $data);
        return $pdf->download('data.pdf');
        // return view('datapegawai-pdf');
    }

    public function exportexcel()
    {
        return Excel::download(new EmployeeExport, 'datapegawai.xlsx');
    }

    public function importexcel(Request $request)
    {
        $data = $request -> file('file');

        $namafile = $data->getClientOriginalName();
        $data->move('EmployeeData', $namafile);

        Excel::import(new EmployeeImport, \public_path('/EmployeeData/'.$namafile));
        return \redirect()->back();
    }
}
