<?php

return [
    'paypal' => [
        'title' => 'دفع بواسطة PayPal',
        'disabled' => 'طريقة الدفع هذه معطلة حاليا.',
        'empty' => 'لم يتم إضافة خطط أسعار ، يرجى الاتصال بالدعم.',
        'pay-text' => 'دفع :price :currency مقابل :amount :silk_name',
        'submit' => 'اشتري الأن!',

        'pending' => 'لديك مدفوعات معلقة!',
    ],
    'notification' => [
        'buy' => [
            'success-title' => 'تم',
            'success-message' => 'تمت معالجة الدفع الخاص بك بنجاح, شكراً!',
            'success-help' => 'لقد تم ايداع للتو :amount ' . config('siteSettings.sro_silk_name', 'Silk') . ' فى حسابك. استمتع بها!',
            'success-back' => 'رجوع للوحة التحكم',
            'invoice-closed-title' => 'تمت المعالجة',
            'invoice-closed-message' => 'تمت معالجة هذا الدفع بالفعل, شكراً!',
            'invoice-help' => 'يبدو أن Paypal يحتاج إلى وقت أطول قليلاً لإرسال الإجابة إلينا, من فضلك انتظر قليلا, تتم المعاملة في الوقت الحالي.',
            'invoice-ahref' => 'رجوع',
            'error-title' => 'حدث خطأ!',
            'error' => 'حدث خطأ ما, يرجى المحاولة مرة أخرى أو إرسال تذكرة.',
            'error-helper' => 'يمكنك أن تجرب ذلك مرة أخرى, نحن نسجل كل خطوة تقوم بها.',
            'error-ahref' => 'رجوع',

            'notification' => 'تم شراء بنجاح :amount ' . config('siteSettings.sro_silk_name', 'Silk'),
        ]
    ],
];
