<?php

$info =
[ 
        [   'correct' => 1,
            'img' => './animals/a.jpg'
        ],
        [
            'correct' => 2,
            'img' => './animals/b.jpg'
        ],
        [
            'correct' => 3,
            'img' => './animals/c.jpg'
        ],
        [
            'correct' => 4,
            'img' => './animals/d.jpg'
        ]
];

file_put_contents('duomenys.json',json_encode($info));