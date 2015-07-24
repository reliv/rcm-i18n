/**
 * rcm-i18n
 */
angular.module('rcmI18n', ['pascalprecht.translate'])
    .config(
    [
        '$translateProvider',
        function ($translateProvider) {

            if (typeof rcmI18nTranslations !== 'object') {
                console.warn('rcmI18nTranslations was not defined, translations not loaded.');
                return;
            }
            $translateProvider.translations(
                rcmI18nTranslations.defaultLocale,
                rcmI18nTranslations.translations[rcmI18nTranslations.defaultLocale]
            );

            $translateProvider.preferredLanguage(rcmI18nTranslations.defaultLocale);

            // Sanitation is to be done on the server
            $translateProvider.useSanitizeValueStrategy(null);
        }
    ]
);

rcm.addAngularModule(
    'rcmI18n'
);
