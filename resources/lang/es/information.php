<?php

return [
    'player' => [
        'title' => 'Personaje :charname16',
        'table' => [
            'name' => 'Nombre:',
            'level' => 'Nivel:',
            'guild' => 'Gremio:',
            'guild-none' => 'ninguno',
            'values' => 'Valores *:',
            'values-data' => '<b>Fuerza:</b> :str Puntos <b>Intelecto:</b> :int Puntos',
            'experience' => 'Experiencia *:',
            'skillpoints' => 'Puntos de habilidad *:',
            'health' => 'HP *:',
            'mana' => 'MP *:',
            'gold' => 'Oro *:',
            'online-state' => 'Estado Online:',
            'last-logout' => 'Último cierre de sesión:',
            'logged-in' => 'Sesión iniciada',
            'logged-out' => 'Sesión cerrada',
            'gm-info' => 'Info GM **',
            'gm-info-data' => 'Usuario :jid',
            'silk' => config('siteSettings.sro_silk_name', 'Silk') . '**',
            'silk-no-entry' => 'Sin Información',

            'only-visible-user' => '* Solo visible para tí',
            'only-visible-gm' => '** Solo visible para GMs',
            'only-visible-gm-user' => '* Solo visible para el Usuario correcto',

            'avatar' => 'Avatar:',
            'map-user' => 'Posición actual *:',
            'map-info' => 'Habilitado para todos los jugadores',
            'map-all' => 'Posición actual:',
        ],

        'equipment' => [
            'title' => 'Equipamiento',
            'inventory' => 'Inventario',
            'avatar' => 'Avatar',
        ]
    ],

    'guild' => [
        'title' => 'Gremio :name',
        'itempoints' => 'Puntos del Ítem de Gremio: :points',
        'master' => 'Maestro del Gremio: :name',
        'table' => [
            'char' => 'Personaje',
            'level' => 'Nivel',
            'join' => 'Se unió el',
            'gp' => 'Puntos de Gremio donados',
            'itempoints' => 'Puntos de Ítem',
        ],
    ]
];
