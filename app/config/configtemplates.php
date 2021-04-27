<?php
/* 
 * Author: Mostafa Shawky
 * Email: mostafa.shawky47@mail.ru
 * FileName: Configiration Template
 * Description: The App Template Data 
*/

// Check If Session Contain Language 
$language = isset( $session->lang ) ? $session->lang : DEFAULT_LANGUAGE;

return [
    'templates_header' => [
        'starttemplateheader' => TEMPLATE_PATH . 'starttemplateheader.php',
        'header_resources'    => [
            'fonts'           => CSS . 'fonts.css',
            'normalize'       => CSS . 'normalize.css',
            'fontawesome'     => CSS . 'font-awesome.min.css',
            'maincss'         => CSS . 'main.' .$language.'.css',
        ],
        
        'endtemplateheader' => TEMPLATE_PATH . 'endtemplateheader.php', 
    ],
    'template_blocks'   => [
            'startwrapper'         => TEMPLATE_PATH . 'startwrapper.php',
            'sidebar'              => TEMPLATE_PATH . 'sidebar.php',
            'start_wrapper_action' => TEMPLATE_PATH . 'startwrapperaction.php',
            'header'               => TEMPLATE_PATH . 'header.php',
            ':action'              => 'action_view',
            'end_wrapper_action'   => TEMPLATE_PATH . 'endwrapperaction.php',
    ],
    'templates_footer' => [
        'scripts' => [
            'mainjs' => JS . 'main.js',
        ],
        'template_footer' => TEMPLATE_PATH . 'footertemplate.php'
    ],
];

?>
