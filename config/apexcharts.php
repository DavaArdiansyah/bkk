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

        // Alternatif warna yang lebih user-friendly
        'colors' => [
            '#FF6F61', // Merah Coral
            '#6F9CFF', // Biru Pastel
            '#FFCE54', // Kuning Emas
            '#4CAF50', // Hijau
            '#FF9F40', // Oranye Lembut
            '#B57EDC', // Ungu Lembut
            '#00BFFF', // Biru Laut
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
                '#FF6F61',
                '#6F9CFF',
                '#FFCE54',
                '#4CAF50',
                '#FF9F40',
                '#B57EDC',
                '#00BFFF',
            ],
            'hover' => [
                'size' => 5,
            ],
        ],

        'stroke' => [
            'show' => true,
            'width' => 2,
            'colors' => [
                '#FF6F61',
                '#6F9CFF',
                '#FFCE54',
                '#4CAF50',
                '#FF9F40',
                '#B57EDC',
                '#00BFFF',
            ]
        ],
    ],

];
