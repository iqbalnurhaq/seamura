<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use Yajra\DataTables\Facades\DataTables;
use App\Ongkir;

class OngkirController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $p = District::where('id', 1101010)->with(['ongkirs', 'regency'])->get()->toArray();
        // $p = District::where('id', 1101010)->with(array('regency' => function($query){$query->select('id', 'name AS name_regency');}))->with(array('ongkirs' => function($query){$query->select('id', 'district_id', 'ongkir');}))->get()->toArray();
        // $p =Ongkir::with(['district', 'district.regency'])->get()->toArray();
        // print_r($p);
        // exit();
        // $query = District::where('id', 1101010)->with(array('regency' => function($query){$query->select('id', 'name AS name_regency');}))->with(array('ongkirs' => function($query){$query->select('id', 'district_id', 'ongkir');}));
      
        if (request()->ajax()) {
            
        $query = Ongkir::query()->with(['district', 'district.regency']);
            return Datatables::of($query)
                    ->addIndexColumn()
                    ->addColumn('action', function($item){
                        return '
                            <div class="btn-group">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button"
                                            data-toggle="dropdown">
                                            Aksi
                                    
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="' . route('ongkir.edit', $item->id) . '">
                                            Sunting
                                        </a>
                                        <form action="' . route('ongkir.destroy', $item->id) . '" method="POST">
                                            ' . method_field('delete') . csrf_field() .'
                                            <button type="submit" class="dropdown-item text-danger">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        ';
                    })
                  
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('pages.admin.ongkir.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('pages.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $data['photo'] = $request->file('photo')->store('assets/category', 'public');

        Category::create($data);

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Ongkir::with(['district', 'district.regency'])->findOrFail($id);
    
        return view('pages.admin.ongkir.edit', [
            'item' => $item
        ]);
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
         $data = $request->all();

        $item = Ongkir::findOrFail($id);

        $item->update($data);

        return redirect()->route('ongkir.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $item = Ongkir::findOrFail($id);
        $item->delete();

        return redirect()->route('ongkir.index');
    }
}
