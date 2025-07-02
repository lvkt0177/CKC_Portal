<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VN Pay - Kết quả thanh toán</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/client/css/style.css') }}">
    <link rel="icon" type="image/png"
        href="https://cdn.haitrieu.com/wp-content/uploads/2023/01/Logo-Truong-Cao-dang-Ky-thuat-Cao-Thang.png">
    <link rel="stylesheet" href="{{ asset('assets/client/css/hocphi.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/payment.css') }}">
</head>

<body class="mb-5">
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="">
                <div>
                    <div>
                        <div class="container">
                            <div class="main-content" style=" margin: 0 !important;">
                                <div class="success-container">
                                    <!-- Header Section -->
                                    <div
                                        class="header-section {{ $data['status'] == 'success' ? 'success' : 'error' }}">
                                        <div class="{{ $data['status'] == 'success' ? 'success-icon' : 'error-icon' }}">
                                            @if ($data['status'] == 'success')
                                                <i class="fas fa-check"></i>
                                            @else
                                                <i class="fas fa-times"></i>
                                            @endif
                                        </div>

                                        <h1
                                            class="{{ $data['status'] == 'success' ? 'success-title' : 'error-title' }}">
                                            {{ $data['status'] == 'success' ? 'Thanh toán thành công!' : 'Thanh toán thất bại!' }}
                                        </h1>
                                        <p
                                            class="{{ $data['status'] == 'success' ? 'success-subtitle' : 'error-subtitle' }}">
                                            {{ $data['status'] == 'success' ? 'Giao dịch của bạn đã được xử lý thành công' : 'Vui lòng thử lại hoặc liên hệ hỗ trợ' }}
                                        </p>
                                    </div>

                                    <!-- Content Section -->
                                    <div class="content-section">
                                        <div class="vnpay-logo">
                                            <i class="fas fa-credit-card"
                                                style="color: #ff6b6b; font-size: 1.5rem;"></i>
                                            <span class="vnpay-text">VN PAY</span>
                                        </div>

                                        <div class="transaction-info">
                                            <div class="info-row">
                                                <span class="info-label">Mã giao dịch</span>
                                                <span class="info-value">#{{ $data['transactionId'] }}</span>
                                            </div>
                                            <div class="info-row">
                                                <span class="info-label">Số tiền</span>
                                                <span class="info-value">{{ $data['amount'] }}</span>
                                            </div>
                                            <div class="info-row">
                                                <span class="info-label">Thời gian</span>
                                                <span class="info-value">{{ $data['time'] }}</span>
                                            </div>
                                            <div class="info-row">
                                                <span class="info-label">Nội dung</span>
                                                <span class="info-value">{{ $data['orderInfo'] }}</span>
                                            </div>
                                            <div class="info-row">
                                                <span class="info-label">Phương thức</span>
                                                <span class="info-value">{{ $data['paymentMethod'] }}</span>
                                            </div>
                                            <div class="info-row">
                                                <span class="info-label">Trạng thái</span>
                                                <span
                                                    class="status-badge {{ $data['status'] == 'success' ? 'success' : 'error' }}">
                                                    {{ $data['status'] == 'success' ? 'Thành công' : 'Thất bại' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
