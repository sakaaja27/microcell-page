<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice - {{ $order->id }}</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; color: #333; line-height: 1.5; }
        .container { width: 100%; padding: 20px; }
        .header { border-bottom: 2px solid #10B981; padding-bottom: 20px; margin-bottom: 20px; display: table; width: 100%; }
        .header-left { display: table-cell; width: 50%; vertical-align: top; }
        .header-right { display: table-cell; width: 50%; text-align: right; vertical-align: top; }
        .logo { font-size: 28px; font-weight: bold; color: #10B981; margin-bottom: 5px; }
        .title { font-size: 32px; font-weight: bold; color: #333; margin-top: 0; margin-bottom: 10px; }
        .status-paid { color: #10B981; font-weight: bold; border: 3px solid #10B981; padding: 5px 15px; border-radius: 5px; display: inline-block; margin-top: 15px; font-size: 20px; transform: rotate(-5deg); }
        .details { margin-bottom: 30px; display: table; width: 100%; }
        .details-col { display: table-cell; width: 50%; vertical-align: top; }
        table.items { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        table.items th { background: #10B981; color: white; padding: 12px; text-align: left; }
        table.items td { padding: 12px; border-bottom: 1px solid #ddd; vertical-align: top; }
        .total-row td { font-weight: bold; font-size: 16px; border-top: 2px solid #333; }
        .footer { text-align: center; color: #777; font-size: 12px; margin-top: 50px; border-top: 1px solid #ddd; padding-top: 20px; }
        h4 { margin: 0 0 5px 0; color: #10B981; font-size: 16px; }
        p { margin: 0 0 5px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-left">
                <div class="logo">MicroCell</div>
                <p>Jl.  Mastrip, Sumbersari, Jember, Jawa Timur</p>
                <p>Email: microcell.team2026@gmail.com</p>
                <p>Telp: 085812749419</p>
            </div>
            <div class="header-right">
                <h1 class="title">INVOICE</h1>
                <p>No. Order: <strong>{{ $order->id }}</strong></p>
                <p>Tanggal: {{ \Carbon\Carbon::parse($order->created_at)->format('d F Y') }}</p>
                <div class="status-paid">LUNAS / {{ strtoupper($order->status) }}</div>
            </div>
        </div>

        @php
            $realCustomer = \App\Models\Customer::find($order->customer_id);
        @endphp

        <div class="details">
            <div class="details-col">
                <h4>Ditagihkan Kepada:</h4>
                <p><strong>{{ $realCustomer->nama ?? $order->customer }}</strong></p>
                <p>{{ $realCustomer->email ?? '-' }}</p>
                <p>{{ $realCustomer->phone ?? '-' }}</p>
            </div>
            <div class="details-col" style="text-align: right;">
                <h4>Metode Pembayaran:</h4>
                <p><strong>{{ $order->paymentMethod->nama ?? 'Transfer Bank' }}</strong></p>
                <p>{{ $order->paymentMethod->jenis ?? '-' }} - {{ $order->paymentMethod->va ?? '-' }}</p>
            </div>
        </div>

        <table class="items">
            <thead>
                <tr>
                    <th>Deskripsi Layanan / Produk</th>
                    <th style="text-align: center; width: 10%;">Qty</th>
                    <th style="text-align: right; width: 25%;">Harga Satuan</th>
                    <th style="text-align: right; width: 25%;">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $order->skema }}</strong>
                        @if($order->is_preorder)
                            <br><small style="color: #d97706;">(Pesanan Pre-Order)</small>
                        @endif
                        @if($order->duration)
                            <br><small>Durasi Kontrak: {{ $order->duration }} Bulan</small>
                        @endif
                    </td>
                    <td style="text-align: center;">{{ $order->qty }}</td>
                    <td style="text-align: right;">
                        @php
                            $hargaAsli = $order->schema->harga ?? ($order->total / $order->qty);
                            $diskonAmount = $order->diskon > 0 ? ($hargaAsli * ($order->diskon / 100)) : 0;
                            $hargaSatuanDiskon = $hargaAsli - $diskonAmount;
                        @endphp
                        @if($order->diskon > 0)
                            <span style="text-decoration: line-through; color: #888; font-size: 11px;">Rp {{ number_format($hargaAsli, 0, ',', '.') }}</span><br>
                            <strong>Rp {{ number_format($hargaSatuanDiskon, 0, ',', '.') }}</strong>
                            <br><small style="color: #ef4444;">(Diskon {{ $order->diskon }}%)</small>
                        @else
                            Rp {{ number_format($hargaAsli, 0, ',', '.') }}
                        @endif
                    </td>
                    <td style="text-align: right;">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="3" style="text-align: right;">Total Keseluruhan</td>
                    <td style="text-align: right; color: #10B981;">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div style="margin-top: 40px;">
            <p><strong>Catatan:</strong></p>
            <p>Terima kasih telah berbelanja di MicroCell. Pembayaran Anda telah kami terima dan pesanan Anda sedang diproses. Simpan invoice ini sebagai bukti transaksi yang sah.</p>
        </div>

        <div class="footer">
            <p>Invoice ini dibuat secara otomatis oleh sistem MicroCell dan sah tanpa tanda tangan.</p>
            <p>&copy; {{ date('Y') }} MicroCell Subscription & Order Management.</p>
        </div>
    </div>
</body>
</html>
