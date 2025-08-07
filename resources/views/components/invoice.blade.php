
<div class="d-flex justify-content-end mb-4 no-print">
    <button onclick="printDiv('printableArea')" class="btn btn-success">
        <i class="fas fa-print mr-2"></i> Print Invoice
    </button>
</div>

<div id="printableArea">
    <div class="invoice-container">
        <div class="invoice-header">
            <div class="logo">
               <img src="{{Settings::setting('site_logo')}}" alt="Logo" style="max-width: 150px; max-height: 50px;">
            </div>
            <div class="invoice-title">
                <h2>INVOICE</h2>
                <p>#{{ $order->id }}</p>
                {{-- <span class="status-badge status-paid">Paid</span> --}}
            </div>
        </div>

        <div class="invoice-info">
            <div class="info-box">
                <h4>Bill To</h4>
                <p><strong>{{ $order->first_name }} {{ $order->last_name }}</strong></p>
                <p>{{ $order->email }}</p>
                <p>{{ $order->phone }}</p>
                <p>{{ $order->address }}</p>
                <p>{{ $order->city }}, {{ $order->state }} {{ $order->zip_code }}</p>
            </div>
            <div class="info-box">
                <h4>Invoice Details</h4>
                <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
                <p><strong>Order ID:</strong> {{ $order->id }}</p>
                <p><strong>Order Status:</strong> {{ $order->status == 0 ? 'Pending' : ($order->status == 1 ? 'Paid' : ($order->status == 2 ? 'On the Way' : ($order->status == 3 ? 'Canceled' : 'Delivered'))) }}</p>
                <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                <p><strong>Payment Status:</strong> {{ $order->payment_status == 1 ? 'Paid' : 'Unpaid' }}</p>
                <p><strong>Transaction ID:</strong> {{ $order->transaction_id }}</p>
            </div>
        </div>

        <div class="shop-info">
            <h5>Shop Information</h5>
            <p><strong>{{ $order->shop->name }}</strong> (ID: {{ $order->shop->id }})</p>
            <p>{{ $order->shop->address }}</p>
            <p>{{ $order->shop->city }}, {{ $order->shop->state }}</p>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Price</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $order->product->name }}</strong>
                        <div>{{ $order->quantity }} × {{ Sohoj::price($order->subtotal) }}</div>
                        {{-- @php
                            $variation = $order->orderproduct->variation
                                ? json_decode($order->orderproduct->variation)
                                : null;
                        @endphp
                        @if ($variation)
                            <div class="text-muted">
                                @foreach ($variation as $key => $item)
                                    {{ ucfirst($key) }}: {{ $item }}@if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </div>
                        @endif --}}
                    </td>
                    <td>{{ Sohoj::price($order->subtotal) }}</td>
                    <td class="text-right">{{ Sohoj::price($order->subtotal * $order->quantity) }}</td>
                </tr>
                <tr>
                    {{-- <td colspan="2">Platform Fee</td>
                    <td class="text-right">{{ Sohoj::price($order->platform_fee) }}</td> --}}
                </tr>
                <tr>
                    <td colspan="2">Shipping Cost</td>
                    <td class="text-right">{{ Sohoj::price($order->shipping_total) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="total-section">
            <div class="total-row">
                <span>Subtotal:</span>
                <span>{{ Sohoj::price($order->subtotal * $order->quantity) }}</span>
            </div>
            <div class="total-row">
                {{-- <span>Platform Fee:</span>
                <span>{{ Sohoj::price($order->platform_fee) }}</span> --}}
            </div>
            <div class="total-row">
                <span>Shipping:</span>
                <span>{{ Sohoj::price($order->shipping_total) }}</span>
            </div>
            <div class="total-row">
                <span>Total:</span>
                <span>{{ Sohoj::price($order->total) }}</span>
            </div>
        </div>

        <div class="additional-info">
            <h5>Additional Information</h5>
            <p>Thank you for your purchase! If you have any questions about this invoice, please contact our
                customer service.</p>
            <p><strong>Transaction Number:</strong> {{ $order->transaction_id }}</p>
            <p class="text-center mt-3" style="font-size: 18px;">
                <strong>Total Paid:</strong>
                <span
                    style="font-size: 24px; color: #2c3e50;">{{ Sohoj::price($order->total) }}</span>
                USD
            </p>
        </div>

        <div class="footer">
            <p>Afrikartt E-commerce | New York, USA | Info@afrikartt.com</p>
            <p>This is a computer generated invoice. No signature required.</p>
        </div>
    </div>
</div>

<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
