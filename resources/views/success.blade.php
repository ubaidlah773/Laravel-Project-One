<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tampilan Layar (Screen View) */
        body {
            background-color: #000000ff;
            font-family: 'Arial', sans-serif;
        }
        .notification-box {
            border: 2px solid #007bff;
            border-radius: 12px;
            padding: 40px;
            text-align: center;
            background-color: #ffffffff;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            color: #333;
        }
        .queue-number {
            font-size: 5em;
            font-weight: bold;
            color: #dc3545;
            margin: 30px 0;
            border: 5px dashed #dc3545;
            display: inline-block;
            padding: 15px 30px;
            border-radius: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-print {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #333;
        }
        
        /* === MEDIA QUERY KHUSUS PENCETAKAN (@media print) === */
        @media print {
            /* HANYA sembunyikan tombol dan elemen navigasi */
            .no-print {
                display: none !important;
            }
            
            /* Pastikan latar belakang halaman menjadi putih untuk hemat tinta */
            body {
                background-color: white !important;
            }

            /* Hilangkan border dan shadow dari kotak notifikasi saat dicetak */
            .notification-box {
                border: none !important;
                box-shadow: none !important;
                padding: 10px; /* Atur ulang padding agar lebih efisien di kertas */
            }
            
            /* Nomor Antrian dibuat sedikit lebih jelas */
            .queue-number {
                font-size: 5em;
                border: 3px solid #dc3545; 
                margin: 15px 0;
            }

            /* Memaksa layout agar sesuai lebar kertas */
            .container, .row, .col-md-8 {
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
                max-width: none !important;
            }
        }
    </style>
</head>
<body>
    
    <div id="print-container" class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="notification-box">
                    <h1 class="text-success">✅ Pendaftaran Berhasil!</h1>
                    <p class="lead">Terima kasih, <span class="fw-bold">{{ $visitor->visitor_name }}</span>, Anda telah berhasil terdaftar untuk kunjungan pada tanggal <span class="fw-bold">{{ $visitor->visit_date->format('d F Y') }}</span>.</p>
                    
                    <h3>Nomor Antrian Anda</h3>
                    <div class="queue-number">
                        {{ $visitor->queue_number }}
                    </div>

                    <p class="text-muted mt-4">Mohon simpan nomor antrian ini. Harap datang tepat waktu.</p>
                    
                    <div class="d-flex justify-content-center gap-3 mt-4 no-print">
                        <button onclick="window.print()" class="btn btn-print fw-bold">
                            Cetak / Simpan PDF
                        </button>
                        <a href="{{ route('visitors.create') }}" class="btn btn-primary">Kembali ke Pendaftaran</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>