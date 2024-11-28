<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(){
        // $invoice = Invoice::select('id_jenis_pembayaran')->groupBy('id_jenis_pembayaran')->get();
        // $count_invoice = Invoice::all()->count();
        // $count_cash = Invoice::where('id_jenis_pembayaran', 1)->get()->count();
        // $count_transfer = Invoice::where('id_jenis_pembayaran', 2)->get()->count();

        // $data1 = Invoice::select('id_jenis_pembayaran', DB::raw('count(*) as total'))
        //         ->groupBy('id_jenis_pembayaran')
        //         ->get();

        // // Ambil nama armada berdasarkan id_jenis_pembayaran
        // $labels1 = $data1->map(function($invoice) {
        //     return Pembayaran::find($invoice->id_jenis_pembayaran)->nama_pembayaran;
        // });

        // $totals1 = $data1->pluck('total');

        // $armadas = Invoice::select('id_armada', DB::raw('SUM(tarif) as total_tarif'))
        //         ->groupBy('id_armada')
        //         ->get();

        // $count_armada = Armada::all()->count();


        // // Dapatkan tahun saat ini
        // $year = Carbon::now()->year;
        // // Ambil bulan dan tahun saat ini
        // $month = Carbon::now()->month;

        // $income = Invoice::whereYear('created_at', $year)->sum('tarif');

        // // Ambil data tarif per bulan untuk tahun yang dipilih
        // $tarifData = Invoice::selectRaw('SUM(tarif) as total, MONTH(created_at) as bulan')
        //             ->whereYear('created_at', $year)
        //             ->groupBy('bulan')
        //             ->orderBy('bulan')
        //             ->get();

        // // Kirim data tarif per bulan sebagai array
        // $tarifPerBulan = array_fill(1, 12, 0); // Isi default untuk 12 bulan
        // foreach ($tarifData as $data) {
        //     $tarifPerBulan[$data->bulan] = $data->total; // Isi bulan yang ada datanya
        // }

        // // Ambil total tarif untuk bulan ini
        // $totalTarifBulanIni = Invoice::whereMonth('created_at', $month)
        //         ->whereYear('created_at', $year)
        //         ->sum('tarif');


        return view('admin.dashboard');
    }
}
