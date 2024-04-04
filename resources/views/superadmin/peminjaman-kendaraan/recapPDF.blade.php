<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Rekap Data</title>
  <style>
    .table {
      width: 100%;
      border-collapse: collapse;
    }

    .table td,
    .table th {
      border: 1px solid #dee2e6;
      padding: 8px;
    }

    .table thead th {
      background-color: #f8f9fa;
      border-bottom-width: 2px;
    }

    .table tbody tr:nth-child(odd) {
      background-color: #f2f2f2;
    }

    .table tbody tr:nth-child(even) {
      background-color: #fff;
    }
  </style>
</head>

<body>
  <div class="container">
    <h4>Rekap Data Peminjaman</h4>
    <table class="table table-bordered mt-4">
      <thead>
        <tr>
          <th>No</th>
          <th>Peminjam</th>
          <th>Tanggal Pinjam</th>
          <th>Tanggal Kembali</th>
          <th>Jenis Plat Kendaraan</th>
          <th>Agenda</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($peminjaman as $item)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->PenanggungJawab->name }}</td>
            <td>{{ $item->tanggal_pinjam }}</td>
            <td>{{ $item->tanggal_kembali }}</td>
            <td>{{ $item->Kendaraan->jenis_plat }}</td>
            <td>{{ $item->agenda }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>

</html>
