<?php

return [
    'title' => 'Casa de Leilões',
    'new' => 'Criar Leilão',
    'your' => 'Seus Leilões',
    'no-filter' => 'Sem filtros',

    'add' => [
        'title' => 'Adicionar item à Casa de Leilões',
        'back' => 'Voltar',
        'form' => [
            'web-inventory' => 'Inventário Virtual:',
            'selected-item' => 'Item Selecionado:',
            'gold-lost' => 'Cuidado, você vai perder :percent% do ouro como como um imposto quando alguém compra seu item. ',
            'price' => 'Preço',
            'price_help' => 'O preço inicial para apostar.',
            'price_instead_help' => 'O preço para comprar esse item agora. Se você deixar vazio, nenhuma compra estará disponível.',
            'price_instead' => 'Preço Atual',
            'until' => 'Até que',
            'until_help' => 'A data e hora que o leilão termina.',
            'submit-item' => 'Criar Leilão',
            'no-item-help' => 'Se você quer adicionar um item, por favor, vá até essa página',
            'no-item-help-href' => 'Inventário Virtual',
        ]
    ],

    'own' => [
        'title' => 'Seus Leilões',
        'back' => 'Voltar',
        'cancel-title' => 'Cancelar esse Leilão',
        'cancel-message' => 'Tem certeza que deseja cancelar leilão para :item ?',
    ],

    'sidebar' => [
        'filter' => 'Filtro',
        'weapon' => 'Armas',
        'equipment' => 'Equipamentos',
    ],

    'table' => [
        'name' => 'Nome',
        'price' => 'Preço',
        'price_instead' => 'Preço atual',
        'until' => 'Until',
        'actions' => 'Ações',
    ],

    'showitem' => [
        'title' => ':name',
        'own-item' => 'Você não pode fazer um lance ou comprar seu próprio item.',
        'expired' => 'Esse leilão expirou',
        'gold' => 'Ouro',
        'npc_price' => 'NPC Preço',
        'price' => 'Preço do lance atual',
        'price_instead' => 'Preço atual',
        'until' => 'Data até o leilão começar',
        'bid_price' => 'Seu lance',
        'bid' => 'Oferta',
        'highest-user' => 'Seu lance é o mais alto atualmente',
        'current_bids' => '(Atualmente há :amount lances nesse item.)',
        'buy_now_text' => 'Você pode comprar esse item agora',
        'buy_now' => 'Comprar agora!',
    ],

    'notification' => [
        'add' => [
            'successfully' => 'Item adicionado a Casa de Leilões com sucesso',
            'price' => 'O lance para comprar agora não pode ser menor que o preço normal.',
            'not-item' => 'Esse item não é seu, o que você está tentando?',
        ],
        'buy' => [
            'successfully' => 'Você comprou esse item com sucesso, cheque o seu Inventário virtual.',
            'not-enough-gold' => 'Você não tem ouro o suficiente no seu Inventário virtual.',
            'until' => 'O tempo para dar um lance nesse item já acabou.',
            'price-0' => 'O preço para compra agora é 0, então você não pode compra-lo!',
            'error' => 'Algo deu errado, por favor tente novamente.',
        ],
        'cancel' => [
            'successfully' => 'Esse Leilão foi cancelado com sucesso!',
        ],
        'bid' => [
            'successfully' => 'Você agora é o maior nesse Leilão',
            'not-enough-gold' => 'Você não tem ouro o suficiente no seu Inventário virtual.',
            'until' => 'O tempo para dar um lance nesse item já acabou.',
            'not-highest' => 'Alguém acabou de fazer um lance maior que o seu atual',
            'error' => 'Algo deu errado, por favor tente novamente.',
            'already' => 'Você já é o maior lance.',
            'bid-higher' => 'Você não pode dar um lance maior do que o preço de compra imediato',
        ]
    ],
];
