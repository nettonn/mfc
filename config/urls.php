<?php
return [
    ''=>'main/default/index',
    'user/<_a:(login|logout|request-password-reset|reset-password)>' => 'user/default/<_a>',
//    'user/<_a:(login|logout|signup|confirm-email|request-password-reset|reset-password)>' => 'user/default/<_a>',

    'admin'=>'admin/default/index',
    'admin/<_m:[\w\-]+>/<_c:[\w\-]+>/<_a:[\w\-]+>/<id:\d+>' => '<_m>/<_c>Admin/<_a>',
    'admin/<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>' => '<_m>/<_c>Admin/view',
    'admin/<_m:[\w\-]+>/<_c:[\w\-]+>' => '<_m>/<_c>Admin/index',
];