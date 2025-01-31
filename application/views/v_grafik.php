<!DOCTYPE html>
<html>
<head>
    <title>Grafik dengan Chart.js</title>
    <!-- Load file plugin Chart.js -->
    <script src="<?php echo base_url()?>/assets/chart/Chart.js"></script>
</head>
<body>
    <br>
    <h4>Grafik Data Mahasiswa</h4>
    <canvas id="myChart"></canvas>
    <?php
    // Inisialisasi nilai variabel awal
    $nama_jurusan = "";
    $jumlah = null;
    foreach ($hasil as $item) {
        $jur = $item->jurusan;
        $nama_jurusan .= "'$jur', ";
        $jum = $item->total;
        $jumlah .= "$jum, ";
    }
    ?>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar', // Jenis chart
            data: {
                labels: [<?php echo $nama_jurusan; ?>],
                datasets: [{
                    label: 'Data Jurusan Mahasiswa',
                    backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)', 'rgb(175, 238, 239)'],
                    borderColor: ['rgb(255, 99, 132)'],
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
