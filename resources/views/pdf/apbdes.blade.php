<!DOCTYPE html>
<html>
<head>
    <title>Transparansi APBDes {{ $tahun }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 18px; }
        .header p { margin: 5px 0 0; color: #666; }
        .summary { display: table; width: 100%; margin-bottom: 20px; text-align: center; }
        .summary-box { display: table-cell; padding: 10px; border: 1px solid #ddd; background: #f9f9f9; }
        .summary-box h3 { margin: 0 0 5px; font-size: 12px; text-transform: uppercase; color: #555; }
        .summary-box p { margin: 0; font-size: 14px; font-weight: bold; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 6px 8px; text-align: left; }
        .table th { background-color: #f0f0f0; font-weight: bold; }
        .text-right { text-align: right !important; }
        .text-center { text-align: center !important; }
        .font-bold { font-weight: bold; }
        .bg-gray { background-color: #f9f9f9; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Transparansi APBDes</h1>
        <p>Pemerintah Desa Olobaru - Tahun Anggaran {{ $tahun }}</p>
    </div>

    <div class="summary">
        <div class="summary-box">
            <h3>Total Pendapatan</h3>
            <p>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>
        <div class="summary-box">
            <h3>Total Belanja</h3>
            <p>Rp {{ number_format($totalBelanja, 0, ',', '.') }}</p>
        </div>
        <div class="summary-box">
            <h3>Pembiayaan Netto</h3>
            <p>Rp {{ number_format($totalPembiayaan, 0, ',', '.') }}</p>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Kode Rekening</th>
                <th>Uraian Anggaran</th>
                <th class="text-right">Jumlah Anggaran (Rp)</th>
                <th class="text-center">Sumber Dana</th>
            </tr>
        </thead>
        <tbody>
            @foreach($apbdesData as $item)
            <tr class="{{ $item->level == 0 ? 'bg-gray font-bold' : '' }}">
                <td style="width: 100px;">{{ $item->kode_rekening }}</td>
                <td style="padding-left: {{ 8 + ($item->level * 15) }}px;">
                    {{ $item->uraian }}
                </td>
                <td class="text-right" style="width: 120px;">
                    {{ number_format($item->anggaran, 0, ',', '.') }}
                </td>
                <td class="text-center" style="width: 80px;">
                    {{ $item->sumber_dana ?? '-' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="text-align: right; margin-top: 30px;">
        <p>Dicetak pada: {{ date('d-m-Y H:i') }}</p>
    </div>
</body>
</html>
