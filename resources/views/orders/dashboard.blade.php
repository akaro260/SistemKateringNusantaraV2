<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dasbor Admin - Sistem Katering Nusantara</title>
    <style>
        body { font-family: -apple-system, Arial, sans-serif; margin: 24px; background: #f6f5f2; color: #2b2b2b; }
        h1 { margin-bottom: 4px; }
        p.subtitle { color: #6b6b6b; margin-top: 0; }
        table { border-collapse: collapse; width: 100%; background: #fff; box-shadow: 0 1px 4px rgba(0,0,0,0.08); }
        th, td { border: 1px solid #e2e0da; padding: 10px 12px; vertical-align: top; text-align: left; font-size: 14px; }
        th { background: #3c2f2f; color: #fff; }
        tr:nth-child(even) { background: #faf9f6; }
        .badge-city { color: #8a6d3b; font-size: 12px; }
        ul.order-items { margin: 0; padding-left: 18px; }
        ul.order-items li { margin-bottom: 2px; }
        .kategori { color: #8a8a8a; font-style: italic; }
        .status { display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 12px; background: #e8f0e3; color: #3a6b35; }
        .pagination { margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Dasbor Admin — Sistem Katering Nusantara</h1>
    <p class="subtitle">Total order: {{ $orders->total() }} (Nested Eager Loading aktif ✅)</p>

    <table>
        <thead>
            <tr>
                <th>ID Order</th>
                <th>Pelanggan</th>
                <th>Pesanan</th>
                <th>Pengiriman &amp; Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>

                    <td>
                        {{ $order->customer->name }}<br>
                        <span class="badge-city">{{ $order->customer->city->name }}</span>
                    </td>

                    <td>
                        <ul class="order-items">
                            @foreach ($order->orderItems as $item)
                                <li>
                                    {{ $item->qty }}x {{ $item->menu->name }}
                                    <span class="kategori">({{ $item->menu->category->name }})</span>
                                </li>
                            @endforeach
                        </ul>
                    </td>

                    <td>
                        {{ $order->courier->name }} - {{ $order->paymentMethod->name }}<br>
                        <span class="status">{{ $order->status }}</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada order.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $orders->links() }}
    </div>
</body>
</html>
