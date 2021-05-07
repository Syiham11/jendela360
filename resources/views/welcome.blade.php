@extends('template.app')
@section('content')

        <style>
           .loader{
           visibility:hidden;
           }
        </style>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <!--section starts-->
                <h1>Data Repot</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/">
                            <i class="livicon" data-name="home" data-size="14" data-loop="true"></i> Home
                        </a>
                    </li>
                    <li>
                        <a href="#">Data Repot</a>
                    </li>
                </ol>
            </section>
            <!--section ends-->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet box primary">

                            <div class="portlet-body flip-scroll">
                                 <div class="row">
                                   <div class="col-md-6">
                                     <h5>DATA HARI INI</h5>
                                     <table class="table table-bordered">
                                           <thead>

                                               <tr>
                                                   <th>Mobil yang paling banyak dijual</th>
                                                   <td>{{@$mobil[0]->nm_mobil}}</td>
                                               </tr>
                                               <tr>
                                                   <th>Penjualan Hari ini</th>
                                                   <td>{{@$harian->jumlah}} ( {{$today}} )</td>
                                               </tr>
                                               <tr>
                                                   <th>Total Penjualan Hari ini</th>
                                                   <td> <?php echo "Rp " . number_format($harian->total,0,',','.'); ?> ( {{$today}} )</td>
                                               </tr>
                                           </thead>

                                       </table>
                                   </div>
                                   <div class="col-md-6">
                                     <h5>Report Mingguan</h5>
                                        <table class="table table-bordered">
                                            <thead>

                                                <tr>
                                                    <th>Mobil yang paling banyak dijual</th>
                                                    <td>{{@$mobil_day[0]->nm_mobil}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Penjualan 7 hari terakhir</th>
                                                    <td>{{@$penjualan_day[0]->Total}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Penjualan 7 hari terakhir</th>
                                                    <td><?php echo "Rp " . number_format(@$penjualan_day[0]->jumlah,0,',','.'); ?></td>
                                                </tr>
                                            </thead>

                                        </table>
                                   </div>
                                 </div>
                            </div>
                        </div>
                        <!-- END SAMPLE TABLE PORTLET-->
                    </div>
                </div>
            </section>
            <!-- content -->
        </aside>
        <!-- right-side -->
    </div>
     

@endsection
