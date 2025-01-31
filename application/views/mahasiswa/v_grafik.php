<!DOCTYPE html>
<html>
<head>
    <title>Grafik dengan Chart.js</title>
    <!-- Load file plugin Chart.js -->
    <script src="<?php echo base_url()?>/assets/chart/Chart.js"></script>
</head>
<body>
    <br>
    <h4>Grafik Data Mahasiswa Berdasarkan Jurusan</h4>
    <canvas id="myChart"></canvas>
    <?php
    // Inisialisasi nilai variabel awal
    $nama_jurusan = "";
    $jumlah = "";
    if (isset($hasil)) {
        foreach ($hasil as $item) {
            $jur = $item->nama_jurusan;
            $nama_jurusan .= "'$jur', ";
            $jum = $item->total_mahasiswa;
            $jumlah .= "$jum, ";
        }
    }
    ?>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar', // Jenis chart
            data: {
                labels: [<?php echo $nama_jurusan; ?>],
                datasets: [{
                    label: 'Jumlah Mahasiswa per Jurusan',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    data: [<?php echo $jumlah; ?>]
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>
</html>