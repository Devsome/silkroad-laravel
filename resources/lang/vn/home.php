<?php

return [
    'title' => 'Dashboard',
    'grid' => [
        'char-list' => 'Danh Sách Nhân Vật',
        'char-list-desc' => 'Tại Đây Bạn Có Thể Xem Các Nhân Vật Của Riêng Mình Với Thông Tin Bổ Sng.',
        'settings' => 'Cài Đặt',
        'settings-desc' => 'Trong Phần Cài Đặt, Bạn Có Thể Thay Đổi Mật Khẩu, e-mail Và Các Thay Đổi Khác. Nếu Bạn Bỏ Lỡ Điều Gì Đó, Hãy Cho Chúng Tôi Biết.',
        'donation' => 'Nạp Silk',
        'donation-desc' => 'Tại Thời Điểm Này , Bạn Có Thể Làm Điều Gì Đó Tốt Và Hỗ Trợ Chúng Tôi! Như Một Lời Cảm Ơn Bạn Sẽ Nhận Được :silk in the game.',
        'other' => 'Misc',
        'other-desc' => 'Mọi Thứ Vẫn Chưa Được Đặt Chính Xác, Có Thể Được Tìm Thấy Tại Thời Điểm Này.',
        'ref' => 'Giới Thiệu',
        'ref-desc' => 'Để Xem Bạn Đã Mời Ai Và Bạn Đã Kiếm Được Bao Nhiêu, Hãy Nhấp Vào Đây.',
        'tickets' => 'Thư',
        'tickets-desc' => 'Bạn Có Một Vấn Đề Hoặc Một Yêu Cầu? Tại Đây Bạn Có Thể Tạo Một Thư Và Chúng Tôi Sẽ Giải Quyết.',
        'voucher' => 'Phiếu thưởng',
        'voucher-desc' => 'Bạn Có Một Phiếu Và Muốn Đổi Nó Lấy :silk? Sau Đó, Bạn Có Thể Đổi Cái Này',
        'web-inventory' => 'Thùng Đồ Website',
        'web-inventory-help' => 'Tại Đây Bạn Có Thể Tìm Thấy "Thùng Đồ" Nơi Mà Bạn Đã Mua Hoặc Bán Vật Phẩm',
    ],

    'chars-list' => [
        'title' => 'Danh Sách Nhân Vật',
        'no-chars' => 'Vui Lòng Tạo Một Nhân Vật Cho Các Chức Năng Khác.',
        'last-logout' => 'Lần Đăng Xuất Cuối Cùng:',
        'level' => 'Level:',
        'gold' => 'Gold:',
        'guild' => 'Guild:',
        'logged-in' => 'Đăng Nhập',
        'logged-out' => 'Đã Đăng Xuất',
    ],

    'donations' => [
        'title' => 'Náp Silk',
        'text' => 'Bạn Có Thể Chọn Một Trong Nhiều Nhà Cung Cấp Mà Bạn Có Thể Nạp Silk. Đổi Lại Bạn Nhận Được ' . config('siteSettings.sro_silk_name', 'Silk') . ' on our server.',
        'no_methods' => 'Không Tìm Thấy Phương Pháp Nào, Quản Trị Viên Đã Không Kích Hoạt.',
    ],

    'settings' => [
        'title' => 'Cài Đặt',
        'form' => [
            'name' => 'Tên',
            'email' => 'E-Mail',
            'map' => 'Bản Đồ Thế Giới',
            'referral' => 'Liên Kết Giới Thiệu',
            'show-map' => 'Hiển Thị Tài Khoản Của Bạn Trên Bản Đồ',
            'silkroad-password' => 'Mật Khẩu Silkroad Mới',
            'silkroad-password-confirmation' => 'Xác Nhận Mật Khẩu Silkroad',
            'web-password' => 'Mật Khẩu Websiteeb Mới',
            'web-password-confirmation' => 'Xác Nhận Mật Khâu Website Mới',
            'current-web-password' => 'Mật Khẩu Website Hiện Tại',
            'current-web-password-help' => 'Bạn Cần Điền Vào Phần Này Để Thay Đổi Dữ Liệu!',
            'submit' => 'Lưu Cài Đặt',
            'wrong-current-web-password' => 'Mật Khẩu Đã Nhập Sai',
            'successfully' => 'Bạn Đã Thay Đổi Thành Công Dữ Liệu Của Mình.',
        ]
    ],

    'ref' => [
        'title' => 'Giới Thiệu',
        'signature' => 'Chữ Ký',
        'no-signature' => 'Hiện Tại Không Có Chữ Ký Nào Được Thêm Vào.',
        'your-ref' => 'Sự Giới Thiệu Của Bạn',
        'table' => [
            'name' => 'Tên Tài Khoản',
            'date' => 'Ngày',
        ]
    ],

    'voucher' => [
        'title' => 'Đổi Phiếu Thưởng',
        'table' => [
            'voucher' => 'Phiếu Thưởng',
            'amount' => 'Số Tiền',
            'used-at' => 'Được Sử Dụng Tại',
        ],
        'form' => [
            'voucher' => 'Phiếu Thưởng',
            'voucher-help' => 'Tại Đây, Bạn Có Thể Đổi Phiếu Thưởng Của Mình',
            'submit' => 'Quy Đổi'
        ],
    ],

    'tickets' => [
        'title' => 'Thư',
        'create-new' => 'Thư Mới',
        'table' => [
            'title' => 'Tiêu Đề',
            'state' => 'Tình Trạng',
            'priority' => 'Sự Ưu Tiên',
            'updated-at' => 'Cập Nhật Tại',
            'action' => 'Hoạt Động'
        ],

        'new' => [
            'title' => 'Thư Mới',
            'form' => [
                'title' => 'Tiêu Đề',
                'category' => 'Thể Loại',
                'no-categories' => 'Hiện Tại Chưa Có Danh Mục Nào',
                'priority' => 'Sự Ưu Tiên',
                'no-priorities' => 'Hiện Tại Chưa Có Ưu Tiên',
                'body' => 'Văn Bản',
                'body-placeholder' => 'Tại Đây Bạn Có Thể Mô Tả Yêu Cầu Của Mình',
                'submit' => 'Tạo Thư',
                'successfully' => 'Bạn Đã Tạo Thành Công Một Thư.',
            ]
        ],
        'show' => [
            'title' => 'Hiển Thị Thư',
            'form' => [
                'title' => 'Thư:',
                'category' => 'Thể Loại:',
                'priority' => 'Sự Ưu Tiên:',
                'state' => 'Tình Trạng:',
                'reply' => 'Trả Lời Văn Bản',
                'reply-placeholder' => 'Tại Đây Bạn Có Thể Viết Câu Trả Lời Của Mình',
                'submit' => 'Trả Lời Thư',
                'submit-close' => 'Đóng Thư!',
                'closed-state' => 'Khi Trả Lời Bạn Mở Thư',
                'wrong-owner' => 'Something\'s not right, looks like you\'re not the ticket holder.',
                'successfully' => 'Bạn Đã Trả Lời Thư Thành Công.',
            ],
        ]
    ]
];
