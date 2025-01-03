<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fatura - {{ $order->order_number }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
        }
        .header {
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .company-info {
            float: left;
            width: 50%;
        }
        .invoice-info {
            float: right;
            width: 50%;
            text-align: right;
        }
        .clear {
            clear: both;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
        .totals {
            float: right;
            width: 300px;
        }
        .totals table {
            width: 100%;
        }
        .totals table td {
            border: none;
        }
        .totals table tr:last-child {
            font-weight: bold;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <div class="company-info">
                <h2>HAWKMARKT</h2>
                <p>Şirket Adresi<br>
                Vergi Dairesi: XXX<br>
                Vergi No: XXXXXXXXXX</p>
            </div>
            <div class="invoice-info">
                <h3>FATURA</h3>
                <p>Fatura No: {{ $order->invoice_no ?? $order->order_number }}<br>
                Tarih: {{ $order->created_at->format('d.m.Y') }}<br>
                Sipariş No: {{ $order->order_number }}</p>
            </div>
            <div class="clear"></div>
        </div>

        <div class="customer-info">
            <h4>ALICI BİLGİLERİ</h4>
            <p>{{ $order->user->name }}<br>
            {{ $order->address }}<br>
            {{ $order->city }}<br>
            Tel: {{ $order->phone }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Ürün</th>
                    <th>Birim Fiyat</th>
                    <th>Adet</th>
                    <th>Toplam</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ number_format($item->unit_price, 2) }} TL</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->total, 2) }} TL</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals">
            <table>
                <tr>
                    <td>Ara Toplam:</td>
                    <td>{{ number_format($order->subtotal, 2) }} TL</td>
                </tr>
                <tr>
                    <td>KDV (%18):</td>
                    <td>{{ number_format($order->tax, 2) }} TL</td>
                </tr>
                <tr>
                    <td>Kargo:</td>
                    <td>{{ number_format($order->shipping, 2) }} TL</td>
                </tr>
                <tr>
                    <td>Genel Toplam:</td>
                    <td>{{ number_format($order->total, 2) }} TL</td>
                </tr>
            </table>
        </div>

        <div class="clear"></div>

        <div style="margin-top: 40px; text-align: center;">
            <p>Bu bir e-fatura örneğidir.</p>
        </div>
    </div>
</body>
</html>
