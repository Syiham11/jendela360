<?php

namespace App\Http\Controllers;

use App\Sale;
use Illuminate\Http\Request;
use Validator;
use DataTables;
use DB;
use Illuminate\Support\Facades\Mail;
use Session;

class SaleController extends Controller
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

      $mobil = DB::table('cars')->get();
        if(request()->ajax())
        {
          $sale = DB::table('sales')->join('cars','sales.car_id','cars.id')->select('sales.*','cars.nm_mobil')->get();
            return datatables()->of($sale)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('sale',['car'=>$mobil]);
      }
    }


    public function store(Request $request)
    {
        $rules = array(
            'nm_pembeli'  =>  'required',
            'email'       =>  'required',
            'tlp'         =>  'required',
            'car_id'      =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'nm_pembeli'      =>  $request->nm_pembeli,
            'email'           =>  $request->email,
            'tlp'             =>  $request->tlp,
            'car_id'          =>  $request->car_id
        );

        Sale::create($form_data);

        // this update stock
        $check = DB::table('cars')->where('id',$request->car_id)->first();
        DB::table('cars')
        ->where('id',$request->car_id)
        ->update([
            'stock' => (int)$check->stock-1
        ]);

        //send email
        $to_name = 'Jendela360';
        $to_email = $request->email;
        $nama_pembeli = $request->nm_pembeli;
        $mobil = $check->nm_mobil;
        $harga = $check->harga;

        Mail::send('mail', ['nama_pembeli' => $nama_pembeli, 'mobil'=>$mobil, 'harga' => $harga], function ($m) use ($request) {
            $m->from('office@gmail.com', 'Invoice Pembelian');

            $m->to($request->email, 'Store')->subject('Invoice Pembelian');
        });

        return response()->json(['success' => 'Data Added successfully.']);
    }

}
