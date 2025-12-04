<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Antrian Kunjungan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* ... CSS dari register.blade.php ... */
        body {
            background-color: #06018aff;
            font-family: 'Arial', sans-serif;
            color: #333;
        }
        .container {
            gap: 20px;
            background: #ffffffff;
            padding: 30px;
            border-radius: 5px;
            margin-top: 30px;
        }
        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
            margin-top: 20px;
            padding: 15px;
            box-shadow: 0 4px 20px rgba(255, 255, 255, 0.3);
        }
        .form-container {
            flex: 1;
            margin-right: 20px;
        }
        .form-label {
            font-weight: bold;
        }
        .form-control {
            border-radius: 12px;
            border: 1px solid #ccc;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
            padding: 8px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            width: 100%;
        }
        .info-box {
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 5px;
            border-left: 5px solid #007bff;
        }
        .info-box h4 {
            color: #007bff;
            margin-bottom: 15px;
        }
        .info-box ul {
            padding-left: 20px;
        }
        .info-box li {
            margin-bottom: 10px;
        }
        .info-container {
            flex: 1; 
            background-color: #13fe03ff; 
            color: #333;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            text-align: left;
        }

        .info-container h2 {
            text-align: center;
            color: #0d47a1; 
            border-bottom: 3px solid #0d47a1;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .info-block {
            margin-bottom: 25px;
        }

        .info-block h3 {
            color: #c62828; 
            font-size: 1.2em;
            margin-bottom: 10px;
            text-align: center;
        }
        
        /* Jadwal */
        .schedule-box {
            background-color: white;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
            font-weight: bold;
        }
        .schedule-box.yellow {
            background-color: #fdfdfdff;
        }

        /* Peraturan */
        .rules-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 15px;
        }
        .rule-item {
            background-color: white;
            padding: 10px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9em;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .rule-text {
            line-height: 1.4; 
        }
        .rule-icon {
            font-size: 2em;
            flex-shrink: 0; 
        }
        .rule-icon.prohibited {
            color: #d32f2f; 
        }
        .rule-icon.required {
            color: #2e7d32; 
        }
        .logo-styling {
            max-width: 150px; /* Atur lebar maksimum logo */
            height: auto;
            border-radius: 8px; 
            margin-bottom: 10px; /* Jarak antara logo dan header */
        }
        
    </style>
</head>
<body>
    <h1>
        <img src="{{ asset('Img.png') }}" alt="Logo Instansi" class="img-fluid logo-styling">
        <strong>Pendaftaran Antrian Kunjungan LAPAS TUBAN</strong>
    </h1>
    <div class="container">
        <div class="row">
            <div class="form-container">
                <form action="{{ route('visitors.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" required>
                    </div>
                    <div class="mb-3">
                        <label for="visitor_name" class="form-label">Nama Pengunjung</label>
                        <input type="text" class="form-control" id="visitor_name" name="visitor_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="person_visited_name" class="form-label">Nama yang Dikunjungi</label>
                        <input type="text" class="form-control" id="person_visited_name" name="person_visited_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="visit_date" class="form-label">Tanggal Kunjungan</label>
                        <input type="date" class="form-control" id="visit_date" name="visit_date" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Daftar</button>
                </form>
            </div>
            <div class="info-container">
            <h2>PERHATIAN</h2>
            
            <div class="info-block">
                <h3>JADWAL KUNJUNGAN</h3>
                <div class="schedule-box">
                    <strong>Senin - Rabu</strong>: Blok A dan C
                </div>
                <div class="schedule-box yellow">
                    <strong>Selasa - Kamis</strong>: Blok B dan D
                </div>
                <p style="text-align: center; font-size: 0.9em; margin-top: 10px;">*Jadwal dapat berubah sewaktu-waktu. Harap cek pengumuman resmi.</p>
            </div>

            <hr style="border: 0; height: 1px; background-color: #333;">

            <div class="info-block">
                <h3>DEMI KENYAMANAN BERSAMA DIHARAPKAN UNTUK:</h3>
                <div class="rules-grid">
                    <div class="rule-item">
                        <span class="rule-icon prohibited">🚫</span>
                        <span class="rule-text">
                            Tidak membawa <strong>senjata tajam</strong> <br>dan sejenisnya
                        </span>
                    </div>
                    <div class="rule-item">
                        <span class="rule-icon prohibited">🚭</span>
                        <span class="rule-text">
                            Tidak <strong>merokok</strong> <br>di dalam area kunjungan
                        </span>
                    </div>
                    <div class="rule-item">
                        <span class="rule-icon prohibited">🐾</span>
                        <span class="rule-text">
                            Tidak membawa <strong>binatang</strong> <br><strong>peliharaan</strong>
                        </span>
                    </div>
                    <div class="rule-item">
                        <span class="rule-icon required">♻️</span>
                        <span class="rule-text">
                            Selalu <strong>menjaga</strong> <br><strong>kebersihan</strong>
                        </span>
                    </div>
                </div>
            </div>

            <h2 style="margin-top: 30px; color: #1a237e; border-bottom: none; font-size: 2em;">TERIMA KASIH</h2>
        </div>
        </div>
    </div>
</body>
</html>