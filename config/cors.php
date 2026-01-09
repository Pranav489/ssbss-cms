<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:5173', 
    'https://shivsahyadringo.org', 
    'https://www.shivsahyadringo.org',
    'http://shivsahyadringo.org', 
    'http://www.shivsahyadringo.org'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
