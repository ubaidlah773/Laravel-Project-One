<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Pengunjung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS yang disesuaikan agar mirip dengan register.blade.php */
        body {
            background-color: #000000ff; /* Latar belakang gelap */
            font-family: 'Arial', sans-serif;
            color: #f8f9fa; /* Teks default putih */
        }
        .container {
            background: #ffffffff; /* Kontainer utama putih */
            color: #333; /* Warna teks di dalam kontainer */
            padding: 30px;
            border-radius: 12px;
            margin-top: 50px;
            box-shadow: 0 4px 20px rgba(255, 255, 255, 0.1); /* Shadow ringan */
        }
        h1 {
            text-align: center;
            color: #007bff; /* Biru terang */
            margin-bottom: 30px;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 15px;
        }
        .table-striped > tbody > tr:nth-of-type(odd) > * {
            background-color: #f1f1f1; /* Warna striping */
        }
        .table {
            border-radius: 8px;
            overflow: hidden; /* Penting agar border-radius terlihat pada tabel */
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            background-color: #fff;
        }
        .table thead th {
            background-color: #007bff; /* Header biru */
            color: white;
            border: none;
            vertical-align: middle;
        }
        .table tbody tr:hover {
            background-color: #e2f0ff; /* Hover effect */
            cursor: default;
        }
        .alert-success, .alert-danger {
            background-color: #13fe03ff; /* Warna hijau terang dari register.blade.php */
            color: #155724;
            border-color: #c3e6cb;
            font-weight: bold;
            border-radius: 8px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-outline-primary {
            border-color: #007bff;
            color: #007bff;
        }
        .btn-outline-primary:hover {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>List Pengunjung Terdaftar</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        <div class="row mb-4 align-items-end">
            <div class="col-md-4">
                <form action="{{ route('visitors.list') }}" method="GET" class="d-flex">
                    <div class="input-group">
                        <input type="date" class="form-control" name="filter_date" required 
                               value="{{ request('filter_date') }}" title="Pilih Tanggal Kunjungan">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div>
            
            @if(request('filter_date'))
                <div class="col-md-2">
                    <a href="{{ route('visitors.list') }}" class="btn btn-secondary">Reset Filter</a>
                </div>
            @endif

            <div class="col-md-4 @if(!request('filter_date')) offset-md-4 @endif text-end">
                <a href="{{ route('visitors.recap') }}" class="btn btn-success">
                    Recap Bulanan (CSV)
                </a>
            </div>
        </div>

        <div class="mb-3 d-flex justify-content-end gap-2">
            <a href="{{ route('visitors.list', ['sort' => 'asc', 'filter_date' => request('filter_date')]) }}" class="btn btn-outline-primary">Urutkan Tanggal Ascending</a>
            <a href="{{ route('visitors.list', ['sort' => 'desc', 'filter_date' => request('filter_date')]) }}" class="btn btn-outline-primary">Urutkan Tanggal Descending</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>No. Antrian</th>
                    <th>NIK</th>
                    <th>Nama Pengunjung</th>
                    <th>Nama yang Dikunjungi</th>
                    <th>Tanggal Kunjungan</th>
                    <th>Didaftarkan Pada</th>
                </tr>
            </thead>
            <tbody>
                @forelse($visitors as $visitor)
                    <tr>
                        <td>{{ $visitor->id }}</td>
                        <td><span class="fw-bold text-danger">{{ $visitor->queue_number }}</span></td>
                        <td>{{ $visitor->nik }}</td>
                        <td>{{ $visitor->visitor_name }}</td>
                        <td>{{ $visitor->person_visited_name }}</td>
                        <td>{{ $visitor->visit_date->format('d-m-Y') }}</td>
                        <td>{{ $visitor->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada pengunjung terdaftar @if(request('filter_date')) pada tanggal ini. @endif</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <a href="{{ route('visitors.create') }}" class="btn btn-primary mt-3">Kembali ke Pendaftaran</a>
    </div>
</body>
</html>