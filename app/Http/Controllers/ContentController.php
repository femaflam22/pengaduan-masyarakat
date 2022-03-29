<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citizen;
use App\Models\Content;
use Carbon\Carbon;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Content::with('citizen')->orderBy('created_at', 'DESC')->limit(5)->get();
        // dd($data);
        return view('index', compact('data'));
    }

    public function all()
    {
        $data = Content::with('citizen')->orderBy('created_at', 'DESC')->get();
        return view('report.report', compact('data'));
    }

    public function reportAdmin()
    {
        $data = Content::with('citizen')->orderBy('created_at', 'DESC')->get();
        $no = 1;
        return view('admin.report_admin', compact('data', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'name' => 'required',
            'telp' => 'required',
            'message' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $citizen = Citizen::where('nik', str_replace(' ', '', $request->nik))->first();

        if (!$citizen) {
            Citizen::create([
                'nik' => str_replace(' ', '', $request->nik),
                'name' => $request->name,
                'telp' => $request->telp,
            ]);
        }

        $image = $request->file('image');
        $nameImage = time() . rand() . '.' . $image->extension();

        if (!file_exists(public_path('/images/' . str_replace(' ', '', $request->nik) . '/' . $image->getClientOriginalName()))) {
            $destinationPath = public_path('/images/' . str_replace(' ', '', $request->nik) . '/');
            $image->move($destinationPath, $nameImage);
        }

        Content::create([
            'nik' => str_replace(' ', '', $request->nik),
            'message' => $request->message,
            'image' => $nameImage,
            'status' => 0,
            'date' => Carbon::now(),
        ]);

        return redirect()->route('index')
        ->with('success', 'Pengaduan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Content::where('id', $id)->first();
        return view('report.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = Content::where('id', $id)->update([
            'status' => $request->status,
        ]);

        if($update) {
            return redirect()->back()->with('success', 'Status pengaduan berhasil diperbarui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Content::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data pengaduan berhasil dihapus!');
    }
}
