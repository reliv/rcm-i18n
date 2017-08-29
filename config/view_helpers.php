<?php
/**
 * view_helpers.php
 */
return [
    'factories' => [
        'translate'
        => \RcmI18n\ViewHelper\TranslateHtmlFactory::class,

        'paramTranslate'
        => \RcmI18n\ViewHelper\ParamTranslatorFactory::class,
    ]
];
