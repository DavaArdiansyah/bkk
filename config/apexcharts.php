<?php

return [

    'options' => [
        'chart' => [
            'height' => 300,
            'width' => '100%',
            'toolbar' => [
                'show' => true,
            ],
            'stacked' => false,
            'zoom' => [
                'enabled' => false,
            ],
            'fontFamily' => 'inherit',
            'foreColor' => '#373d3f',
        ],

        'plotOptions' => [
            'bar' => [
                'horizontal' => true,
            ],
        ],

        'colors' => [
            '#5369E8', '#EF5F4C', '#feb019', '#ff455f', '#775dd0', '#80effe',
            '#0077B5', '#ff6384', '#c9cbcf', '#0057ff', '#00a9f4', '#2ccdc9', '#5e72e4'
        ],

        'series' => [],

        'dataLabels' => [
            'enabled' => false
        ],

        'labels' => [],

        'title' => [
            'text' => '',
            'align' => 'center',
        ],

        'subtitle' => [
            'text' => '',
            'align' => 'left',
        ],

        'xaxis' => [
            'categories' => [],
            'title' => [
                'text' => '',
            ],
            'tickAmount' => 5,
            'stepSize' => 1
        ],

        'yaxis' => [
            'title' => [
                'text' => '',
            ],
            'tickAmount' => 5,
            'stepSize' => 1
        ],

        'grid' => [
            'show' => true
        ],

        'markers' => [
            'size' => 3,
            'colors' => [
                '#5369E8', '#EF5F4C', '#feb019', '#ff455f', '#775dd0', '#80effe',
                '#0077B5', '#ff6384', '#c9cbcf', '#0057ff', '#00a9f4', '#2ccdc9', '#5e72e4'
            ],
            'hover' => [
                'size' => 5,
            ],
        ],

        'stroke' => [
            'show' => true,
            'width' => 2,
            'colors' => [
                '#5369E8', '#EF5F4C', '#feb019', '#ff455f', '#775dd0', '#80effe',
                '#0077B5', '#ff6384', '#c9cbcf', '#0057ff', '#00a9f4', '#2ccdc9', '#5e72e4'
            ]
        ],
    ],

];
