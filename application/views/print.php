<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }

        button {
            padding: 10px 15px;
            margin-bottom: 20px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            max-width: 1200px; /* Mengatur lebar maksimum tabel */
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px; /* Meningkatkan padding untuk sel */
            text-align: left;
            border: 1px solid #dee2e6;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        img {
            width: 3cm;  /* Mengatur lebar foto menjadi 3 cm */
            height: 4cm; /* Mengatur tinggi foto menjadi 4 cm */
            object-fit: cover; /* Memastikan foto tidak terdistorsi */
        }

        @media print {
            button {
                display: none; /* Sembunyikan tombol saat mencetak */
            }
        }
    </style>
</head>
<body>
    <h1>Data Mahasiswa</h1>
    <button onclick="window.history.back();">Kembali</button>
    <button onclick="window.print();">Print Ulang</button> <!-- Tombol Print Ulang -->

    <table>
        <tr>
            <th>No</th>
            <th>Nama Mahasiswa</th>
            <th>Tanggal Lahir</th>
            <th>Jurusan</th>
            <th>Alamat</th>
            <th>No Telepon</th>
            <th>Email</th>
            <th>Foto</th> <!-- Kolom Foto -->
        </tr>

        <?php foreach ($mahasiswa as $index => $mhs): ?>
        <tr>
            <td><?php echo $index + 1; ?></td>
            <td><?php echo htmlspecialchars($mhs['nama_mhs']); ?></td>
            <td><?php echo htmlspecialchars($mhs['tgl_lahir']); ?></td>
            <td><?php echo htmlspecialchars($mhs['jurusan']); ?></td>
            <td><?php echo htmlspecialchars($mhs['alamat']); ?></td>
            <td><?php echo htmlspecialchars($mhs['no_telepon']); ?></td>
            <td><?php echo htmlspecialchars($mhs['email']); ?></td>
            <td>
                <img src="<?php echo base_url('assets/foto/' . $mhs['foto']); ?>" alt="Foto Mahasiswa">
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    
    <script>
        window.print(); // Cetak halaman secara otomatis saat halaman dibuka
    </script>
</body>
</html>
