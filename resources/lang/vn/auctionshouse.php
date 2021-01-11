<?php

return [
    'title' => 'Đấu Giá',
    'new' => 'Tạo Đấu Giá',
    'your' => 'Đấu Giá Của Bạn',
    'no-filter' => 'Hiện Tại Không Có',

    'add' => [
        'title' => 'Thêm Vật Phẩm Vào Đấu Giá',
        'back' => 'Quay Lại',
        'form' => [
            'web-inventory' => 'Thùng Đồ Web:',
            'selected-item' => 'Chọn Vật Phẩm:',
            'gold-lost' => 'Cảnh Báo, Bạn Sẽ Mất :percent% Của Gold Như Một Loại Thuế Khi Ai Đó Mua Mặt Hàng Của Bạn.',
            'price' => 'Giá',
            'price_help' => 'Giá Khởi Điểm.',
            'price_instead_help' => 'Giá Mua Hàng Bây Giờ, Nếu Bạn Để Trống Bạn Sẽ Không Mua',
            'price_instead' => 'Mua Ngay Với Giá Này',
            'until' => 'Cho Đến Khi',
            'until_help' => 'Ngày Kết Thúc Phiên Đấu Giá.',
            'submit-item' => 'Tạo Đấu Giá',
            'no-item-help' => 'Nếu Bạn Muốn Thêm Vật Phâm , Hãy Vào Trang Này',
            'no-item-help-href' => 'Thùng Đồ Web',
        ]
    ],

    'own' => [
        'title' => 'Đâu Giá Của Bạn',
        'back' => 'Quay Lại',
        'cancel-title' => 'Hủy Bỏ Đấu Giá',
        'cancel-message' => 'Bạn Có Chắc Là Muốn Hủy Bỏ :item ?',
    ],

    'sidebar' => [
        'filter' => 'Bộ Lọc',
        'weapon' => 'Vũ Khí',
        'equipment' => 'Trang Bị',
    ],

    'table' => [
        'name' => 'Tên',
        'price' => 'Giá',
        'price_instead' => 'Mua Ngay',
        'until' => 'Cho Đến Khi',
        'actions' => 'Hành Động',
    ],

    'showitem' => [
        'title' => ':name',
        'own-item' => 'Bạn Không Thể Trả Giá Hoặc Mua Mặt Hàng Của Riêng Bạn.',
        'expired' => 'Phiên Đấu Giá Này Đã Hết Hạn',
        'gold' => 'Gold',
        'npc_price' => 'Giá NPC',
        'price' => 'Giá Hiện Tại',
        'price_instead' => 'Mua Ngay',
        'until' => 'Ngày Cho Đến Khi Cuộc Đấu Giá Diễn Ra',
        'bid_price' => 'Giá Của Bạn',
        'bid' => 'Trả giá',
        'highest-user' => 'Bạn Là Người Trả Giá Cao Nhất',
        'current_bids' => '(Không Có :amount Ai Trả Giá Cho Vật Phẩm.)',
        'buy_now_text' => 'Bạn Có Thể Mua Vật Phẩm Ngay Bây Giờ',
        'buy_now' => 'Mua ngay!',
    ],

    'notification' => [
        'add' => [
            'successfully' => 'Đã Thêm Vật Phẩm Vào Đấu Giá',
            'price' => 'Giá Mua Bây Giờ Không Thể Thấp Hơn Giá Bình Thường.',
            'not-item' => 'Đây Không Phải Vật Phẩm Của Bạn?',
        ],
        'buy' => [
            'successfully' => 'Bạn Đã Mua Vật Phẩm Thành Công , Kiểm Tra Thùng Đồ Web.',
            'not-enough-gold' => 'Bạn Không Có Đủ Gold Ở Thùng Đồ Web.',
            'until' => 'Thời Gian Để Mua Vật Phẩm Đã Hết.',
            'price-0' => 'Giá Mua Bây Giờ Là 0, Không Thể Mua!',
            'error' => 'Đã Xảy Ra Lỗi, Vui Lòng Thử Lại.',
        ],
        'cancel' => [
            'successfully' => 'Bạn Đã Hủy Đấu Giá Thành Công!',
        ],
        'bid' => [
            'successfully' => 'Bạn Là Người Cao Nhất Ở Đấu Giá',
            'not-enough-gold' => 'Bạn Không Có Đủ Gold Ở Thùng Đồ Web.',
            'until' => 'Thời Gian Để Mua Vật Phẩm Đã Hết.',
            'not-highest' => 'Ai Đó Đã Trả Giá\'s Và Cao Hơn Giá Hiện Tại Của Bạn',
            'error' => 'Đã Xảy Ra Lỗi, Vui Lòng Thử Lại.',
            'already' => 'Bạn Là Người Trả Giá Cao Nhất.',
            'bid-higher' => 'Bạn Không Thể Đặt Giá Cao Hơn Giá Mua Ngay',
        ]
    ],
];
