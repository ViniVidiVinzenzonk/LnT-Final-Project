<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\karyawan;
class karyawanController extends Controller
{
    public function index(){
        $karyawans = karyawan::all();
        return view('karyawans.index', compact('karyawans'));
    }

    public function create(){
        return view('karyawans.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required|string|min:5|max:20',
            'umur' => 'required|integer|min:20',
            'alamat' => 'required|string|min:10|max:40',
            'no_telp' => 'required|string|starts_with:08|min:9|max:12'
        ]);

        karyawan::create($request->all());
        return redirect('/karyawans');
    }

    public function edit($id){
        $karyawan = karyawan::find($id);
        return view('karyawans.edit', compact('karyawan'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama' => 'required | string| min:5|max:20',
            'umur' => 'required | integer | min:20',
            'alamat' => 'required | string | min:10 | max: 40',
            'no_telp' => 'required | string | starts_with:08| min:9 | max:12|'
        ]);

        karyawan::find($id)->update($request->all());
        return redirect('/karyawans');
    }

    public function destroy($id){
        karyawan::find($id)->delete();
        return redirect('/karyawans');
    }
}
