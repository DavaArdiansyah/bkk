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
            '#2E91E5', // Biru cerah
            '#E15F99', // Merah muda
            '#1CA71C', // Hijau cerah
            '#FB0D0D', // Merah terang
            '#DA16FF', // Ungu cerah
            '#222A2A', // Abu gelap
            '#B68100', // Emas
            '#750D86', // Ungu gelap
            '#EB663B', // Oranye merah
            '#511CFB', // Biru tua
            '#00A08B', // Hijau kebiruan
            '#FB00D1', // Pink cerah
            '#FC0080', // Magenta cerah
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
                '#2E91E5', '#E15F99', '#1CA71C', '#FB0D0D', '#DA16FF',
                '#222A2A', '#B68100', '#750D86', '#EB663B', '#511CFB',
                '#00A08B', '#FB00D1', '#FC0080'
            ],
            'hover' => [
                'size' => 5,
            ],
        ],

        'stroke' => [
            'show' => true,
            'width' => 2,
            'colors' => [
                '#2E91E5', '#E15F99', '#1CA71C', '#FB0D0D', '#DA16FF',
                '#222A2A', '#B68100', '#750D86', '#EB663B', '#511CFB',
                '#00A08B', '#FB00D1', '#FC0080'
            ]
        ],
    ],

];
