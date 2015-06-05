/**
 * rcm-i18n
 */
angular.module('rcmI18n', ['pascalprecht.translate'])
    .config(
    [
        '$translateProvider',
        function ($translateProvider) {

            if (typeof rcmI18nTranslations !== 'object') {
                console.warn('rcmI18nTranslations was not defined');
            }
            $translateProvider.translations(
                rcmI18nTranslations.locale,
                rcmI18nTranslations.translations
            );
            $translateProvider.preferredLanguage(rcmI18nTranslations.locale);
        }
    ]
);

rcm.addAngularModule(
    'rcmI18n'
);
