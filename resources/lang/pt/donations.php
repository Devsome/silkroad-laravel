<?php

return [
    'paypal' => [
        'title' => 'Pague com PayPal',
        'disabled' => 'Esse método está desativado atualmente.',
        'empty' => 'Não há pacotes de preço adicionados atualmente, por favor entre em contato com o suporte.',
        'pay-text' => 'Pague :price :currency por :amount :silk_name',
        'submit' => 'Comprar agora!',

        'pending' => 'Você tem pagamentos pendentes!',
    ],
    'notification' => [
        'buy' => [
            'success-title' => 'Feito',
            'success-message' => 'Sua doação está sendo processada com sucesso, obrigado!',
            'success-help' => 'Você acabou de creditar :amount ' . config('siteSettings.sro_silk_name', 'Silk') . ' na sua conta. Divirta-se!',
            'success-back' => 'Volte para sua Dashboard',
            'invoice-closed-title' => 'Processado',
            'invoice-closed-message' => 'Essa doação já foi processada, obrigado!',
            'invoice-help' => 'Parece que o PayPal precisa de um tempo maior para nos enviar a resposta, por favor espere um pouco mais, a transação está sendo feita agora.',
            'invoice-ahref' => 'Voltar',
            'error-title' => 'Ups!',
            'error' => 'Algo deu errado, por favor tente novamente ou escreva um ticket.',
            'error-helper' => 'Você pode tentar novamente, estamos processando cada etapa que você está fazendo.',
            'error-ahref' => 'Voltar',

            'notification' => 'Comprado com sucesso :amount ' . config('siteSettings.sro_silk_name', 'Silk'),
        ]
    ],
];
