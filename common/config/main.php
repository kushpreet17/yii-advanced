<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
//to download the document in pdf format
return [
'modules' => [
   'gridview' =>  [
        'class' => '\kartik\grid\Module'
    ]
]
 ];