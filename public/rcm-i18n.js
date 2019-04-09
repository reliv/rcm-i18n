window.rcmI18nTranslations = {
    defaultLocale: window._RELIV_APP_STATE.rcmi18n.defaultLocale,
    translations: window._RELIV_APP_STATE.rcmi18n.translations,
    get: function (defaultText, locale) {
        console.log(defaultText, locale);
        if (!locale) {
            locale = window.rcmI18nTranslations.defaultLocale;
        }
        if (typeof window.rcmI18nTranslations.translations[locale][defaultText] === "string") {
            return window.rcmI18nTranslations.translations[locale][defaultText];
        }
        return defaultText;
    }
}

/**
 * rcm-i18n
 */
angular.module('rcmI18n', ['pascalprecht.translate'])
    .config(
        [
            '$translateProvider',
            function ($translateProvider) {

                if (typeof window.rcmI18nTranslations !== 'object') {
                    console.warn('rcmI18nTranslations was not defined, translations not loaded.');
                    return;
                }
                $translateProvider.translations(
                    window.rcmI18nTranslations.defaultLocale,
                    window.rcmI18nTranslations.translations[window.rcmI18nTranslations.defaultLocale]
                );

                $translateProvider.preferredLanguage(window.rcmI18nTranslations.defaultLocale);

                // Sanitation is to be done on the server
                $translateProvider.useSanitizeValueStrategy(null);
            }
        ]
    );

if (typeof rcm != 'undefined') {
    rcm.addAngularModule(
        'rcmI18n'
    );
}
