<?php

return [
    'paypal' => [
        'title' => 'Pago con PayPal',
        'disabled' => 'Este método está deshabilitado actualmente.',
        'empty' => 'Actualmente no hay paquetes de precio añadidos, por favor ponte en contacto con el soporte.',
        'pay-text' => 'Pagar :price :currency por :amount :silk_name',
        'submit' => '¡Comprar ahora!',

        'pending' => '¡Tienes pagos pendientes!',
    ],
    'maxicard' => [
        'title' => 'Pago con MaxiCard E-Pin',
        'disabled' => 'Este método está deshabilitado actualmente.',
        'empty' => 'Actualmente no hay paquetes de precio añadidos, por favor ponte en contacto con el soporte.',
        'pay-text' => 'Pagar :price :currency por :amount :silk_name',
        'submit' => '¡Comprar ahora!',
    ],
    'notification' => [
        'buy' => [
            'success-title' => 'Realizado',
            'success-message' => 'Tu donación ha sido procesada exitosamente, ¡gracias!',
            'success-help' => 'Has recibido crédito por :amount ' . config('siteSettings.sro_silk_name', 'Silk') . ' en tu cuenta. ¡Diviértete con él!',
            'success-back' => 'Regresa a tu Tablero',
            'invoice-closed-title' => 'Procesado',
            'invoice-closed-message' => 'Esta donación ya fue procesada, ¡gracias!',
            'invoice-help' => 'Parece que Paypal necesita más tiempo para respondernos, por favor espera un momento, la transacción se está llevando a cabo en este momento.',
            'invoice-ahref' => 'Regresar',
            'error-title' => '¡Ups!',
            'error' => 'Ocurrió un error, por favor intenta de nuevo o escribe un tícket.',
            'error-helper' => 'Puedes volver a intentar, estamos procesando cada paso que das.',
            'error-ahref' => 'Regresar',

            'notification' => 'Compraste exitosamente :amount ' . config('siteSettings.sro_silk_name', 'Silk'),
        ]
    ],
];
