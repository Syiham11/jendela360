<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use Validator;
use DataTables;
use Session;

class CarController extends Controller
{


    public function index()
    {
      // this code get token from session
      $session   = Session::get('token');
      // this code check session
      if($session == null)
      {
        return view('login');
      }else {
        if(request()->ajax())
        {
            return datatables()->of(Car::latest()->get())
                    ->addIndexColumn()->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('car');
      }
    }


    public function store(Request $request)
    {
        $rules = array(
            'nm_mobil'  =>  'required',
            'harga'     =>  'required',
            'stock'     =>  'required'

        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'nm_mobil'      =>  $request->nm_mobil,
            'stock'         =>  $request->stock,
            'harga'         =>  $request->harga,
        );

        Car::create($form_data);
        return response()->json(['success' => 'Data Added successfully.']);
    }


    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Car::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }


    public function update(Request $request)
    {
        $form_data = array(
            'nm_mobil'      =>  $request->nm_mobil,
            'stock'         =>  $request->stock,
            'harga'         =>  $request->harga,
        );
        Car::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }


    public function destroy($id)
    {
        $data = Car::findOrFail($id);
        $data->delete();
    }
}
