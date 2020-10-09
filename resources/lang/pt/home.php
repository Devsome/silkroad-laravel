<?php

return [
    'title' => 'Dashboard',
    'grid' => [
        'char-list' => 'Lista de caracteres',
        'char-list-desc' => 'Aqui você pode ver seus caracteres com informações adicionais.',
        'settings' => 'Configurações',
        'settings-desc' => 'Nas configurações você pode mudar sua senha, e-mail e outras. Se você perder algo, nos contate.',
        'donation' => 'Doações',
        'donation-desc' => 'Nesse ponto você pode fazer algo bom e nos apoiar! Como um agradecimento, você receberá :silk no jogo.',
        'other' => 'Misc',
        'other-desc' => 'Tudo que ainda não foi colocado exatamente, pode ser encontrado nesse ponto.',
        'ref' => 'Referência',
        'ref-desc' => 'Para ver se você já convidou alguém e quanto você ganhou, clique aqui.',
        'tickets' => 'Tickets',
        'tickets-desc' => 'Você tem um problema ou um pedido? Aqui você pode criar um ticket e nós vamos cuidar disso.',
        'voucher' => 'Voucher',
        'voucher-desc' => 'Você tem um bilhete de crédito e quer resgatar para :silk? Aqui você pode resgatá-lo',
        'web-inventory' => 'Inventário virtual',
        'web-inventory-help' => 'Aqui você pode encontrar o seu "Inventário" onde seus intens comprados e vendidos estão.',
    ],

    'chars-list' => [
        'title' => 'Lista de caracteres',
        'no-chars' => 'Por favor crie um caractere para outras funções.',
        'last-logout' => 'Último acesso:',
        'level' => 'Nível:',
        'gold' => 'Ouro:',
        'guild' => 'Guilda:',
        'logged-in' => 'Logado em',
        'logged-out' => 'Desconectado em',
    ],

    'donations' => [
        'title' => 'Doações',
        'text' => 'Você pode escolher um dos provedores onde você pode doar dinheiro. Em retorno você ganhará ' . config('siteSettings.sro_silk_name', 'Silk') . ' no seu servidor.',
        'no_methods' => 'Nenhum metódo foi encontrado, o administrado não ativou nenhum.',
    ],

    'settings' => [
        'title' => 'Configurações',
        'form' => [
            'name' => 'Nome',
            'email' => 'E-Mail',
            'map' => 'Mapa mundial',
            'referral' => 'Link de referência',
            'show-map' => 'Mostrar suas contas no mapa',
            'silkroad-password' => 'Nova senha silkroad',
            'silkroad-password-confirmation' => 'Confirmar senha silkroad',
            'web-password' => 'Nova senha de acesso',
            'web-password-confirmation' => 'Confirmar senha de acesso',
            'current-web-password' => 'Senha de acesso atual',
            'current-web-password-help' => 'Você precisa preencher isso para alterar quaisquer dados!',
            'submit' => 'Salvar configurações',
            'wrong-current-web-password' => 'A senha inserida está errada',
            'successfully' => 'Você mudou seus dados com sucesso.',
        ]
    ],

    'ref' => [
        'title' => 'Referência',
        'signature' => 'Assinatura',
        'no-signature' => 'Nenhuma assinatura inserida atualmente.',
        'your-ref' => 'Sua referência',
        'table' => [
            'name' => 'Nome da conta',
            'date' => 'Data',
        ]
    ],

    'voucher' => [
        'title' => 'Regastar Voucher',
        'table' => [
            'voucher' => 'Voucher',
            'amount' => 'Valor',
            'used-at' => 'Usado em',
        ],
        'form' => [
            'voucher' => 'Voucher',
            'voucher-help' => 'Aqui você pode resgatar o seu código de crédito',
            'submit' => 'Resgatar'
        ],
    ],

    'tickets' => [
        'title' => 'Tickets',
        'create-new' => 'Novo ticket',
        'table' => [
            'title' => 'Título',
            'state' => 'Estado',
            'priority' => 'Prioridade',
            'updated-at' => 'Atualizado em',
            'action' => 'Ação'
        ],

        'new' => [
            'title' => 'Novo ticket',
            'form' => [
                'title' => 'Título',
                'category' => 'Categoria',
                'no-categories' => 'Atualmente ainda não há categorias',
                'priority' => 'Prioridade',
                'no-priorities' => 'Atualmente ainda não há prioridades',
                'body' => 'Texto',
                'body-placeholder' => 'Aqui você pode descrever a sua solicitação',
                'submit' => 'Criar ticket',
                'successfully' => 'Você criou um ticket com sucesso.',
            ]
        ],
        'show' => [
            'title' => 'Mostrando Ticket',
            'form' => [
                'title' => 'Título:',
                'category' => 'Categoria:',
                'priority' => 'Prioridade:',
                'state' => 'Estado:',
                'reply' => 'Resposta',
                'reply-placeholder' => 'Aqui você pode escrever sua resposta',
                'submit' => 'Responder o ticket',
                'submit-close' => 'Ticket fechado!',
                'closed-state' => 'Quando você responde um ticket, ele será reaberto',
                'wrong-owner' => 'Alguma coisa deu errado, parece que você não é dono do ticket.',
                'successfully' => 'Você respondeu o ticket com sucesso.',
            ],
        ]
    ]
];
