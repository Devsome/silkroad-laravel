<?php

return [
    'player' => [
        'title' => 'Caractere :charname16',
        'table' => [
            'name' => 'Nome:',
            'level' => 'Nível:',
            'guild' => 'Guilda:',
            'guild-none' => 'nenhuma',
            'values' => 'Valores *:',
            'values-data' => '<b>Força:</b> :str Pontos <b>Intellect:</b> :int Pontos',
            'experience' => 'Experiência *:',
            'skillpoints' => 'Pontos de habilidade *:',
            'health' => 'HP *:',
            'mana' => 'MP *:',
            'gold' => 'Ouro *:',
            'online-state' => 'Estado-online:',
            'last-logout' => 'Último acesso:',
            'logged-in' => 'Logado em',
            'logged-out' => 'Deslogado em',
            'gm-info' => 'GM Info **',
            'gm-info-data' => 'Usuário :jid',
            'silk' => config('siteSettings.sro_silk_name', 'Silk') . '**',
            'silk-no-entry' => 'Sem informações',

            'only-visible-user' => '* Visível apenas pra você',
            'only-visible-gm' => '** Visível apenas para GMs',
            'only-visible-gm-user' => '* Visível apenas para o usuário',

            'avatar' => 'Avatar:',
            'map-user' => 'Posição atual *:',
            'map-info' => 'Disponível para todos os jogadores',
            'map-all' => 'Posição atual:',
        ],

        'equipment' => [
            'title' => 'Equipamento',
            'inventory' => 'Inventário',
            'avatar' => 'Avatar',
        ]
    ],

    'guild' => [
        'title' => 'Guilda :name',
        'itempoints' => 'Pontos de item da Guilda: :points',
        'master' => 'Guilda Master: :name',
        'table' => [
            'char' => 'Caractere',
            'level' => 'Nível',
            'join' => 'Se juntou em',
            'gp' => 'Pontos doados para a Guila',
            'itempoints' => 'Pontos de item',
        ],
    ]
];
