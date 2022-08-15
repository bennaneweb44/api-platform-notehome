<?php

namespace App\Tools;

class Constants
{
    public const NOTES_TYPES = [
        1 => 'elements',
        2 => 'contenu'
    ];

    public const CATEGORIES_DEFAULT = [
        1 => [
            'nom' => 'Courses',
            'couleur' => '#F5846C',
            'icone' => 'shopping-cart'
        ],
        2 => [
            'nom' => 'Administratif',
            'couleur' => '#B7DC88',
            'icone' => 'edit'
        ],
        3 => [
            'nom' => 'Santé',
            'couleur' => '#63B4F4',
            'icone' => 'ambulance'
        ],
        4 => [
            'nom' => 'Ecole',
            'couleur' => '#CA87E7',
            'icone' => 'graduation-cap'
        ],
        5 => [
            'nom' => 'Bricolage',
            'couleur' => '#FE82A6',
            'icone' => 'wrench'
        ],
        6 => [
            'nom' => 'Animaux',
            'couleur' => '#FFDC59',
            'icone' => 'paw'
        ]
    ];

    public const NOTES_DEFAULT = [
        0 => [
            "title" => "Première note contenu",
            "content" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            "type" => 2,
            "category_indice" => 0
        ],
        1 => [
            "title" => "Deuxième note contenu",
            "content" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            "type" => 2,
            "category_indice" => 1
        ],
        2 => [
            "title" => "Troisième note contenu",
            "content" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            "type" => 2,
            "category_indice" => 2
        ],
        3 => [
            "title" => "Première note elements",
            "content" => null,
            "type" => 1,
            "category_indice" => 3
        ],
        4 => [
            "title" => "Deuxième note elements",
            "content" => null,
            "type" => 1,
            "category_indice" => 4
        ],
        5 => [
            "title" => "Troisième note elements",
            "content" => null,
            "type" => 1,
            "category_indice" => 5
        ],
    ];
}