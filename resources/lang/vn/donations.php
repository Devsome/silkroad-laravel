<?php

return [
    'paypal' => [
        'title' => 'Thanh Toán Bằng PayPal',
        'disabled' => 'Phương Pháp Này Hiện Đang Bị Vô Hiệu Hóa.',
        'empty' => 'Hiện Tại Không Có Gói Giá Nào Được Thêm Vào, Vui Lòng Liên Hệ Với Bộ Phận Hỗ Trợ.',
        'pay-text' => 'Thanh Toán :price :currency Cho :amount :silk_name',
        'submit' => 'Mua Ngay!',

        'pending' => 'Đang Đợi Sử Lý!',
    ],
    'maxicard' => [
        'title' => 'Thanh Toán Bằng MaxiCard E-Pin',
        'disabled' => 'Phương Pháp Này Hiện Đang Bị Vô Hiệu Hóa.',
        'empty' => 'Hiện Tại Không Có Gói Giá Nào Được Thêm Vào, Vui Lòng Liên Hệ Với Bộ Phận Hỗ Trợ.',
        'pay-text' => 'Thanh Toán :price :currency Cho :amount :silk_name',
        'submit' => 'Mua Ngay!',
    ],
    'stripe' => [
        'title' => 'Thanh Toán Bằng Stripe',
        'disabled' => 'Phương Pháp Này Hiện Đang Bị Vô Hiệu Hóa.',
        'empty' => 'Hiện Tại Không Có Gói Giá Nào Được Thêm Vào, Vui Lòng Liên Hệ Với Bộ Phận Hỗ Trợ.',
        'pay-text' => 'Thanh Toán :price :currency Cho :amount :silk_name',
        'submit' => 'Chọn Cái Này',

        'pending' => 'Đang Đợi Sử Lý!',

        'buy' => [
            'title' => 'Mua Ngay Với Stripe',
            'info' => 'Thông Tin Của Bạn',
            'info-body' => 'Bạn Sắp Mua :silk ' . config('siteSettings.sro_silk_name', 'Silk') . ' for :amount :currency',
            'card-holder' => 'Tên Chủ Thẻ',
            'submit' => 'Thanh Toán Ngay!',
        ],
        'error' => [
            'error-title' => 'Giao Dịch Của Bạn Đã Bị Hủy!',
            'error-body' => 'Giao Dịch Của Bạn Đã Được Lưu, Bất Cứ Khi Nào Bạn Muốn Thanh Toán Mới, Bạn Có Thể Thực Hiện.',
        ]
    ],
    'notification' => [
        'buy' => [
            'success-title' => 'Hoàn Thành',
            'success-message' => 'Khoản Đóng Góp Của Bạn Đã Được Xử Lý Thành Công, Cảm Ơn!',
            'success-help' => 'Bạn Vừa Được Ghi Có :amount ' . config('siteSettings.sro_silk_name', 'Silk') . ' to your account. Have fun with it!',
            'success-back' => 'Quay Lại Dashboard',
            'invoice-closed-title' => 'Xử Lý',
            'invoice-closed-message' => 'Khoản Đóng Góp Này Đã Được Xử Lý, Cảm Ơn!',
            'invoice-help' => 'Có Vẻ Như Paypal Cần Một Chút Thời Gian Nữa Để Gửi Câu Trả Lời Cho Chúng Tôi, Vui Lòng Đợi Một Chút, Giao Dịch Đang Được Thực Hiện Ngay Bây Giờ.',
            'invoice-ahref' => 'Quay Lại',
            'error-title' => 'Ups!',
            'error' => 'Đã Xảy Ra Lỗi, Vui Lòng Thử Lại Hoặc Viết Phiếu Phạt.',
            'error-helper' => 'Bạn Có Thể Thử Lại, Chúng Tôi Đang Ghi Nhật Ký Từng Bước Bạn Đang Làm.',
            'error-ahref' => 'Quay lại',

            'notification' => 'Đã Mua Thành Công :amount ' . config('siteSettings.sro_silk_name', 'Silk'),
        ],
        'error' => [
            'missing-keys' => 'Chúng Tôi Thiếu Một Số Thứ Cho Phương Thức Thanh Toán, Vui Lòng Liên Hệ Với Quản Trị Viên.',
            'missing-methods' => 'Thiếu Phương Thức Thanh Toán',
        ]
    ],
];
