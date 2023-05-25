<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

// /usr/local/lib/libzint.so
(new FFIMe\FFIMe("libzint.so"))
    ->showWarnings(true)
    ->include('zint.h')
//    ->include(__DIR__ . '/code.h')
    ->codeGen('library\\Zint', '../library/Zint.php');