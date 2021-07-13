<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\ProductRequest;
use App\Category;


use Yajra\DataTables\Facades\DataTables;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Order::with(['regency', 'district', 'village']);
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
                                       
                                        <form action="' . route('order.destroy', $item->id) . '" method="POST">
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
        return view('pages.admin.order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $categories = Category::all();

        return view('pages.admin.product.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $data['photo'] = $request->file('photo')->store('assets/product', 'public');
        $data['size'] = $request->size . ' ' . $request->satuan;  
        Product::create($data);

        return redirect()->route('product.index');
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
        $item = Product::findOrFail($id);
      
        $categories = Category::all();

        $s = explode(" ", $item->size);
       
        $satuan = $s[1];

        return view('pages.admin.product.edit', [
            'item' => $item,
            'categories' => $categories,
            'satuan' => $satuan,
            'ukuran' => $s[0]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        if ($request->file('photo')) {
            $data['photo'] = $request->file('photo')->store('assets/category', 'public');
        }
        $data['size'] = $request->size . ' ' . $request->satuan;  


        $item = Product::findOrFail($id);

        $item->update($data);

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Order::findOrFail($id);
        $item->delete();

        return redirect()->route('order.index');
    }


    public function accept($id) {
        
    }
}