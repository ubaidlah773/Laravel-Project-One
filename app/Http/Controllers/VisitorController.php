<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    // Tampilkan form pendaftaran
    public function create()
    {
        return view('register');
    }

    // Simpan data pendaftaran dan hitung nomor antrian
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|max:20|unique:visitors,nik',
            'visitor_name' => 'required|string|max:255',
            'person_visited_name' => 'required|string|max:255',
            'visit_date' => 'required|date|after_or_equal:today', 
        ]);

        // 1. Hitung Nomor Antrian (Berdasarkan tanggal kunjungan yang sama)
        $latestQueue = Visitor::whereDate('visit_date', $request->visit_date)
                              ->max('queue_number');
        
        $newQueueNumber = $latestQueue ? $latestQueue + 1 : 1;

        // 2. Simpan data pengunjung dan nomor antrian
        $visitor = Visitor::create(array_merge($request->only([
            'nik', 
            'visitor_name', 
            'person_visited_name', 
            'visit_date'
        ]), [
            'queue_number' => $newQueueNumber,
        ]));

        // 3. Alihkan ke Halaman Notifikasi
        return redirect()->route('visitors.success', $visitor->id);
    }

    // Metode baru untuk menampilkan notifikasi nomor antrian
    public function showSuccess($id)
    {
        $visitor = Visitor::findOrFail($id);
        return view('success', compact('visitor'));
    }

    // Tampilkan list pengunjung dengan sorting dan filtering
    public function index(Request $request)
    {
        $query = Visitor::query();
        $sort = $request->get('sort', 'asc'); // Default ascending
        $filterDate = $request->get('filter_date'); // Ambil tanggal filter dari URL

        // Logika Filter Tanggal
        if ($filterDate) {
            $query->whereDate('visit_date', $filterDate);
        }

        // Terapkan Sorting
        $visitors = $query->orderBy('visit_date', $sort)->get();

        return view('list', compact('visitors', 'sort', 'filterDate'));
    }

    // Export CSV Recap Bulanan
    public function exportRecap()
    {
        // Mengambil data untuk bulan ini
        $visitor = Visitor::create(array_merge($request->only([
                'nik', 
                'visitor_name', 
                'person_visited_name', 
                'visit_date'
            ]), [
                'queue_number' => $newQueueNumber,
            ]));

        if ($visitors->isEmpty()) {
            return redirect()->route('visitors.list')->with('error', 'Tidak ada data pengunjung bulan ini untuk diekspor.');
        }

        $filename = 'rekap_pengunjung_' . now()->format('Y_m') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '";',
        ];

        $callback = function() use ($visitors)
        {
            $file = fopen('php://output', 'w');
            
            // Tulis Header CSV
            fputcsv($file, ['ID', 'NIK', 'Nama Pengunjung', 'Nama yang Dikunjungi', 'Tanggal Kunjungan', 'Nomor Antrian', 'Waktu Pendaftaran']);
            
            // Tulis Data Pengunjung
            foreach ($visitors as $visitor) {
                fputcsv($file, [
                    $visitor->id,
                    $visitor->nik,
                    $visitor->visitor_name,
                    $visitor->person_visited_name,
                    $visitor->visit_date->format('Y-m-d'),
                    $visitor->queue_number,
                    $visitor->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}