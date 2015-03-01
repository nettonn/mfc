<?php
return [
    ''=>'main/default/index',
    'user/<_a:(login|logout|request-password-reset|reset-password)>' => 'user/default/<_a>',
//    'user/<_a:(login|logout|signup|confirm-email|request-password-reset|reset-password)>' => 'user/default/<_a>',

    'admin'=>'admin/default/index',
    'admin/<_m:[\w\-]+>/<_c:[\w\-]+>' => '<_m>/<_c>-admin/index',
    'admin/<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>' => '<_m>/<_c>-admin/view',
    'admin/<_m:[\w\-]+>/<_c:[\w\-]+>/<_a:[\w\-]+>/<id:\d+>' => '<_m>/<_c>-admin/<_a>',
    'admin/<_m:[\w\-]+>/<_c:[\w\-]+>/<_a:[\w\-]+>' => '<_m>/<_c>-admin/<_a>',
    'debug/<_c>/<_a>' => 'debug/<_c>/<_a>',
];