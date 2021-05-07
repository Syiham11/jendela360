<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use carsbon\carsbon;
use Illuminate\Support\Facades\Session;


class MasterController extends Controller
{
  public function masuk()
  {
    // this code get token from session
    $session   = Session::get('token');
    // this code check session
    if($session == null)
    {
      return view('login');

    }else {
      return redirect()->to('welcome');
    }


  }

    public function index()
    {
      // this code get token from session
      $session   = Session::get('token');
      // this code check session
      if($session == null)
      {
        return view('login');
      }else {

        // begin query check total where date now
        $date_now = date('Y-m-d');
        // this query check mobil terbanyak dijual
        $mobil = DB::select( DB::raw("SELECT nm_mobil, Total FROM (SELECT  COUNT(nm_mobil) AS Total, nm_mobil FROM sales join cars on sales.car_id = cars.id where sales.created_at = '$date_now' GROUP BY cars.nm_mobil ORDER BY Total DESC Limit 1) AS A"));
        // begin query check total penjualan hari ini


        $harian = DB::table("sales")
        ->leftJoin('cars','sales.car_id','cars.id')
        ->select(DB::raw("COUNT(*) as jumlah, SUM(harga) as total, sum(stock) as total_stock"))
        ->where('sales.created_at',$date_now)
        ->first();
        // end query check total where date now

        // begin query check total where date yesterday
        $yesterday = date('Y-m-d', strtotime(' - 1 days'));
        $kemarin = DB::table("sales")
        ->leftJoin('cars','sales.car_id','cars.id')
        ->select(DB::raw("COUNT(*) as jumlah, SUM(harga) as total, sum(stock) as total_stock"))
        ->where('sales.created_at',$yesterday)
        ->first();

        // end query check total where date yesterday


        // this conver string to int
        $stock_today = (int)$harian->total_stock;
        $stock_yesterday = (int)$kemarin->total_stock;
        $convert_today = (int)$harian->jumlah;
        $convert_kemarin = (int)$kemarin->jumlah;
        // this sum penjualan/stock*100
        @$total_today = ($convert_today/$stock_today)*100;
        $total_kemarin = ($convert_kemarin/$stock_yesterday)*100;
        if($total_today < $total_kemarin)
        {
          $today = '+'.ceil($total_today).'%';
        }else if ($total_today > $total_kemarin){
          $today = '-'.ceil($total_today).'%';
        }else if ($total_today == $total_kemarin){
          $today = 'stabil'.ceil($total_today).'%';
        }else {
          $today = '0%';
        }

        // this qeury mobil yg laris 7 hari yg lalu
        $daysseven = date('Y-m-d', strtotime(' - 7 days'));
        $mobil_day = DB::select( DB::raw("SELECT nm_mobil, Total FROM (SELECT  COUNT(nm_mobil) AS Total, nm_mobil FROM sales join cars on sales.car_id = cars.id where  (sales.created_at BETWEEN '$daysseven' AND '$date_now') GROUP BY cars.nm_mobil ORDER BY Total DESC Limit 1) AS A"));
        $penjualan_day = DB::select( DB::raw("SELECT  COUNT(nm_mobil) AS Total, SUM(harga) AS jumlah FROM sales join cars on sales.car_id = cars.id where  (sales.created_at BETWEEN '$daysseven' AND '$date_now')  ORDER BY Total DESC"));
        return view('welcome', compact('today','mobil','harian','mobil_day','penjualan_day'));
      }
    }

}
