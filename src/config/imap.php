<?php

return [
    'server'     => env('IMAP_AUTH_SERVER', 'localhost'),
    'port'       => env('IMAP_PORT', 993),
    'parameters' => env('IMAP_PARAMETERS', ''),
];
