<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Emisi Kapal</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h2, h3 {
            text-align: center;
            margin: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td, table th {
            border: 1px solid #000;
            padding: 6px;
        }

        .no-border td {
            border: none;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            color: #fff;
            font-size: 11px;
        }

        .success { background: green; }
        .warning { background: orange; }
        .danger { background: red; }
        .info { background: blue; }
        .dark { background: black; }

        .kesimpulan {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #000;
        }
    </style>
</head>
<body>

    {{-- ================= HEADER ================= --}}
    <div class="header">
        <h2>LAPORAN EMISI KAPAL</h2>
        <p>Berdasarkan MARPOL Annex VI</p>
    </div>

    {{-- ================= INFO KAPAL ================= --}}
    <div class="section">
        <h3>Data Kapal</h3>
        <table>
            <tr>
                <td>Jenis Kapal</td>
                <td>{{ $data->jenis_kapal }}</td>
            </tr>
            <tr>
                <td>Tahun Kapal</td>
                <td>{{ $data->tahun_kapal }}</td>
            </tr>
            <tr>
                <td>Kapasitas Kapal </td>
                <td>{{ $data->kapasitas_kapal }} GT</td>
            </tr>
        </table>
    </div>

    {{-- ================= OPERASIONAL ================= --}}
    <div class="section">
        <h3>Data Operasional</h3>
        <table>
            <tr>
                <td>Kecepatan Kapal </td>
                <td>{{ $data->rpm }} Rpm</td>
                <td>Daya Mesin </td>
                <td>{{ $data->daya_mesin }} kW</td>
            </tr>
            <tr>
                <td>Lama Operasi </td>
                <td>{{ $data->lama_operasi }} Jam</td>
                <td>Jarak Tempuh </td>
                <td>{{ $data->jarak_tempuh }} Nautical Mile</td>
            </tr>
            <tr>
                <td>Konsumsi BBM </td>
                <td>{{ $data->konsumsi_bbm }} Ton</td>
                <td>Jenis BBM</td>
                <td>{{ $data->bbm->jenis_bbm ?? '-' }}</td>
            </tr>
        </table>
    </div>

    {{-- ================= EMISI ================= --}}
    <div class="section">
        <h3>Hasil Emisi</h3>
        <table>
            <tr>
                <th>Parameter</th>
                <th>Nilai</th>
                <th>Status</th>
            </tr>
            <tr>
                <td>CO2</td>
                <td>{{ $data->co2 }} g/kWh</td>
                <td><span class="badge {{ $co2_color }}">{{ $co2_status }}</span></td>
            </tr>
            <tr>
                <td>NOx</td>
                <td>{{ $data->nox }} g/kWh</td>
                <td><span class="badge {{ $nox_color }}">{{ $nox_status }}</span></td>
            </tr>
            <tr>
                <td>SOx</td>
                <td>{{ $data->sox }} % sulfur</td>
                <td><span class="badge {{ $sox_color }}">{{ $sox_status }}</span></td>
            </tr>
            <tr>
                <td>CII</td>
                <td>{{ $data->cii }} gCO2/ton·NM</td>
                <td><span class="badge {{ $cii_color }}">{{ $cii_status }}</span></td>
            </tr>
        </table>
    </div>

    {{-- ================= REKOMENDASI ================= --}}
    <div class="section">
        <h3>Rekomendasi</h3>
        <ul>
            <li><strong>CO2:</strong>
                @if($co2_color == 'success')
                    Pertahankan efisiensi bahan bakar.
                @elseif($co2_color == 'warning')
                    Optimalkan konsumsi bahan bakar.
                @else
                    Evaluasi operasional dan gunakan BBM ramah lingkungan.
                @endif
            </li>

            <li><strong>NOx:</strong>
                @if($nox_color == 'success')
                    Mesin sudah sesuai standar IMO Tier III.
                @elseif($nox_color == 'warning')
                    Lakukan monitoring berkala mesin.
                @else
                    Gunakan teknologi SCR atau perawatan mesin.
                @endif
            </li>

            <li><strong>SOx:</strong>
                @if($sox_color == 'success')
                    Sudah sesuai MARPOL Annex VI.
                @elseif($sox_color == 'warning')
                    Perhatikan jika masuk area ECA.
                @else
                    Gunakan bahan bakar rendah sulfur atau scrubber.
                @endif
            </li>

            <li><strong>CII:</strong>
                @if($cii_color == 'success')
                    Efisiensi sangat baik (Rating A).
                @elseif($cii_color == 'info')
                    Efisien (Rating B).
                @elseif($cii_color == 'warning')
                    Perlu peningkatan efisiensi.
                @else
                    Perlu evaluasi menyeluruh operasional.
                @endif
            </li>
        </ul>
    </div>

    {{-- ================= KESIMPULAN ================= --}}
    <div class="kesimpulan">
        <strong>Kesimpulan:</strong><br>
        Kondisi emisi kapal saat ini <strong>{{ $overall }}</strong> berdasarkan parameter
        CO2, NOx, SOx, dan CII yang mengacu pada MARPOL Annex VI.
    </div>

</body>
</html>
