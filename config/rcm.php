<?php
/**
 * rcm.php
 */
return [
    'HtmlIncludes' => [
        'scripts' => [
            'libraries' => [
                '/bower_components/angular-translate/angular-translate.min.js' => [],
            ],
        ],
        'headScriptFile' => [
            /**
             * Must not be in combined scripts because this is
             * a php generated list of translations
             */
            '/rcmi18n/translations.js' => [],
        ],
    ],
];
