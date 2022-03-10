<?php 
return [ 
    'client_id' => 'AQtLjApdXxrf0IxzDU8S-gFTFq9P2Jt-rPoXHcpM4Qb9vZOuLOhtqJ52baFchHBA0L-UKVVt7u_87_IA',
	'secret' => 'EDbhYutwTkxTU29bPFF7KYnJASaoMtTYUkKB3BLlt9lPQPcAjAlDONHiAA7kG0JNEQqE60v6pIxCmgKS',
    'settings' => array(
        'mode' => 'sandbox',
        'http.ConnectionTimeOut' => 1000,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE'
    ),
];