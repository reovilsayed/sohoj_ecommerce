@extends('layouts.user_dashboard')
@section('dashboard-content')
    <style>
       :root {
            --primary-color: #01949a;
            --primary-dark: #01949a;
            --primary-light: #e8f5e8;
            --secondary-color: #2c3e50;
            --accent-color: #f39c12;
            --light-gray: #f8f9fa;
            --medium-gray: #e9ecef;
            --dark-gray: #6c757d;
            --danger-color: #dc3545;
            --success-color: #28a745;
            --info-color: #17a2b8;
            --border-radius: 12px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        .order-header {
            background: var(--primary-color);
            color: #fff;
            border-radius: 1rem 1rem 0 0;
            padding: 1rem 2rem;
            margin-bottom: 1.5rem;
        }

        .order-status-badge {
            background: rgba(1, 153, 154, 0.1);
            color: var(--primary-color);
            border-radius: 0.5rem;
            padding: 0.25rem 0.75rem;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .order-card {
            border-radius: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border: none;
            margin-bottom: 2rem;
        }

        .order-card .card-body {
            padding: 2rem 1.5rem;
        }

        .order-product-img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
        }

        .btn-green,
        .btn-green:active,
        .btn-green:focus {
            background: #01949a !important;
            color: #fff !important;
            border: none !important;
        }

        .btn-green:hover {
            background: #01787a !important;
            color: #fff !important;
        }

        .order-meta-label {
            color: #495057;
            font-size: 0.95rem;
        }

        .order-meta-value {
            color: #01949a;
            font-weight: 600;
        }

        .order-action-btns .btn {
            margin-bottom: 0.5rem;
        }

        .order-date {
            color: #fff;
            font-size: 1rem;
            font-weight: 400;
        }

        .btn-danger {
            color: #fff !important;
            background-color: #dc3545 !important;
            border-color: #dc3545;
        }

        .btn-edit-profile {
            background: rgb(1 153 154 / 19%);   
            color: var(--primary-color);
            border: none;
            padding: 0.5rem 1rem;
            /* border-radius: 8px; */
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            font-size: 0.85rem;
        }

        .btn-edit-profile:hover {
            background: var(--primary-color);
            color: white;
        }
    </style>
    <div class="ec-shop-rightside col-lg-9 col-md-12 mt-2">
        <div class="order-header d-flex align-items-center justify-content-between">
            <div>
                <i class="fas fa-shopping-bag me-2"></i>
                <span style="font-size:1.3rem; font-weight:600;">My Orders</span>
            </div>
            <div class="btn-group">
                <button class="btn btn-green btn-sm dropdown-toggle d-flex align-items-center rounded" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    @if (request()->status === '0')
                        Pending order
                    @elseif (request()->status === '1')
                        Paid
                    @elseif(request()->status === '2')
                        On the way
                    @elseif(request()->status === '3')
                        Canceled
                    @else
                        All
                    @endif
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('user.ordersIndex') }}">All</a></li>
                    <li><a class="dropdown-item" href="{{ route('user.ordersIndex', ['status' => 1]) }}">Paid</a></li>
                    <li><a class="dropdown-item" href="{{ route('user.ordersIndex', ['status' => 0]) }}">Pending order</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('user.ordersIndex', ['status' => 2]) }}">On the way</a></li>
                    <li><a class="dropdown-item" href="{{ route('user.ordersIndex', ['status' => 3]) }}">Canceled</a></li>
                </ul>
            </div>
        </div>
        <div class="container">
            @if ($latest_orders->count() > 0)
                @foreach ($latest_orders as $order)
                    <div class="card order-card">
                        <div class="card-body row align-items-center">
                            <div class="col-md-2 text-center mb-3 mb-md-0">
                                <img class="order-product-img" src="{{ Storage::url($order->product->image) }}"
                                    alt="">
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('user.invoice', $order) }}" class="text-decoration-none">
                                    <h5 class="mb-1" style="color: var(--primary-green);">{{ $order->product->name }}</h5>
                                </a>
                                <div class="text-muted mb-2" style="font-size:0.95rem;">
                                    {{ Str::limit(strip_tags($order->product->short_description), $limit = 100, $end = '...') }}
                                </div>
                                <div class="order-meta-label">Items: <span
                                        class="order-meta-value">{{ $order->quantity }}</span></div>
                                <div class="order-meta-label">Price: <span
                                        class="order-meta-value">{{ Sohoj::price($order->subtotal) }}</span></div>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="order-status-badge">
                                    @if ($order->status == 0)
                                        Pending
                                    @elseif ($order->status == 1)
                                        Processing
                                    @elseif ($order->status == 2)
                                        On the way
                                    @elseif ($order->status == 3)
                                        Canceled
                                    @elseif ($order->status == 4)
                                        Delivered
                                    @elseif ($order->status == 5)
                                        Cancelled
                                    @endif
                                </div>
                                <div class="order-date mt-2">{{ $order->created_at->format('M-d-Y') }}</div>
                            </div>
                            <div class="col-md-4 order-action-btns">
                                <div class="mb-2">
                                    <span class="order-meta-label">Order ID:</span> <span
                                        class="order-meta-value">{{ $order->id }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="order-meta-label">Tracking Info:</span>
                                    <input type="text" value="{{ $order->shipping_url }}"
                                        class="form-control d-inline-block w-100  ">
                                </div>
                                @if ($order->shipping_url)
                                    @if ($order->shipping_method == 'DHL')
                                        <a class="btn btn-green w-100 mb-2" target="_blank"
                                            href="https://nolp.dhl.de/nextt-online-public/set_identcodes.do?lang=de&idc={{ $order->tracking_Id }}">Tracking
                                            order</a>
                                    @endif
                                    @if ($order->shipping_method == 'Hermes')
                                        <a class="btn btn-green w-100 mb-2" target="_blank"
                                            href="https://www.myhermes.de/empfangen/sendungsverfolgung/suchen/sendungsinformation/{{ $order->tracking_Id }}">Tracking
                                            order</a>
                                    @endif
                                    @if ($order->shipping_method == 'DPD')
                                        <a class="btn btn-green w-100 mb-2" target="_blank"
                                            href="https://tracking.dpd.de/parcelstatus?query={{ $order->tracking_Id }}&locale=de_DE">Tracking
                                            order</a>
                                    @endif
                                    @if ($order->shipping_method == 'UPS')
                                        <a class="btn btn-green w-100 mb-2" target="_blank"
                                            href="http://wwwapps.ups.com/WebTracking/processInputRequest?sort_by=status&tracknums_displayed=1&TypeOfInquiryNumber=T&loc=de_DE&InquiryNumber1={{ $order->tracking_Id }}&track.x=0&track.y=0">Tracking
                                            order</a>
                                    @endif
                                    @if ($order->shipping_method == 'GLS')
                                        <a class="btn btn-green w-100 mb-2" target="_blank"
                                            href="https://www.gls-pakete.de/sendungsverfolgung?match={{ $order->tracking_Id }}&txtAction=71000">Tracking
                                            order</a>
                                    @endif
                                    @if ($order->shipping_method == 'Fedex')
                                        <a class="btn btn-green w-100 mb-2" target="_blank"
                                            href="https://www.fedex.com/fedextrack/?tracknumbers={{ $order->tracking_Id }}&locale=de_DE&cntry_code=de">Tracking
                                            order</a>
                                    @endif
                                @endif
                                <a href="{{ route('user.invoice', $order) }}" class="btn btn-edit-profile d-flex justify-content-center w-100 mb-2">View
                                    Invoice</a>
                                @if ($order->status == 4)
                                    <form action="{{ route('user.order.accept', $order) }}" method="post">
                                        @csrf
                                        @if ($order->order_accept == 0)
                                            <button type="submit" class="btn btn-green w-100 mb-2"
                                                title="Click the button to let us know you received the order."
                                                onclick="return confirm('Are you sure you want to confirm receipt of the order?')">Received
                                                the order?</button>
                                        @elseif ($order->order_accept == 1)
                                            <div class="text-center mb-3">
                                                <span style="background-color: gray; color: #fff" class="p-3">Order has
                                                    been received</span>
                                            </div>
                                        @endif
                                    </form>
                                    <button type="button" class="btn btn-warning w-100 mb-2" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" data-id="{{ $order->id }}">Return Order</button>
                                    <a href="{{ route('product_details', ['slug' => $order->product->parentproduct ? $order->product->parentproduct->slug : $order->product->slug, 'id' => 'ratings']) }}#ratings"
                                        class="btn btn-outline-success w-100 mb-2 feedback-btn">Give Feedback</a>
                                @endif
                                @if ($order->status == 5)
                                    <a href="#" class="btn btn-secondary w-100 mb-2">Return requested</a>
                                @endif
                                @if ($order->status == 0 || $order->status == 1)
                                    @if ($order->cancel_request == 0)
                                        <a href="{{ route('user.order.cancel', $order) }}"
                                            class="btn btn-danger w-100 mb-2">Order Cancel Request?</a>
                                    @elseif($order->cancel_request == 1)
                                        <a href="#" class="btn btn-danger w-100 mb-2">Order Cancel Request Sent</a>
                                    @else
                                        <a href="#" class="btn btn-green w-100 mb-2">Order Cancelled</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h3 class="text-center" style="color: var(--primary-green);">No order has been placed</h3>
            @endif
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="returnOrderForm" action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="reason">Reason for Return</label>
                            <textarea name="return_reason" id="reason" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="input-group my-3">
                            <label class="input-group-text" for="inputGroupFile01">Attach File (optional)</label>
                            <input type="file" name="return_file" class="form-control"
                                style="height: 37px; min-height: 37px" id="inputGroupFile01">
                        </div>
                        <div class="modal-footer mt-2">
                            <button type="submit" class="btn btn-green">Submit Return Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $("#exampleModal").on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var orderId = button.data('id');
                var url = "{{ route('user.return-order.store', ['order' => ':order']) }}";
                var route = url.replace(':order', orderId);
                $("#returnOrderForm").attr("action", route);
            });
        });
    </script>
@endsection
