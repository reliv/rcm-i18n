/**
 * rcm-i18n-admin
 * Created by idavis on 7/2/14.
 */
angular.module('rcmI18nAdmin', ['RcmLoading']);

/**
 * Controller
 */
angular.module('rcmI18nAdmin').controller(
    'rcmTranslations', [
        '$scope',
        '$element',
        '$log',
        '$http',
        '$sce',
        'rcmLoading',
        function (
            $scope,
            $element,
            $log,
            $http,
            $sce,
            rcmLoading
        ) {
            var self = this;
            self.url = {
                locales: '/rcmi18n/locales'
            };
            $scope.locales = [];
            $scope.loading = false;//loadin ng-show set to false
            $scope.messageQuery = '';
            $scope.editorsLoading = {};
            $scope.selectedLocale = null;
            $scope.messages = {};
            $scope.translations = false;
            $scope.filterType = null;
            $scope.filterTypes = [
                {
                    label: 'All',
                    value: null,
                },
                {
                    label: 'Untranslated',
                    value: 'untranslated',
                }
            ];

            $scope.safeApply = function (fn) {
                var phase = this.$root.$$phase;
                if (phase == '$apply' || phase == '$digest') {
                    if (fn && (typeof(fn) === 'function')) {
                        fn();
                    }
                } else {
                    this.$apply(fn);
                }
            };

            self.getLocales = function () {
                $scope.loading = true;//loadin ng-show set to true when getLocales is called

                $http(
                    {
                        method: 'GET',
                        url: self.url.locales
                    }
                ).//method get to get all locales
                success(
                    function (data) {
                        $scope.locales = data.locales;
                        $scope.selectedLocale = data['currentSiteLocale'];
                        $scope.loading = false;
                        $scope.OpenLocale();
                        // this callback will be called asynchronously
                        // when the response is available
                    }
                ).error(
                    function () {
                        $scope.loading = false;
                        // called asynchronously if an error occurs
                        // or server returns response with an error status.
                    }
                );

            };

            self.getLocales();

            $scope.messageChange = function (message) {
                message.dirty = true;
                message.textHtml = $sce.trustAsHtml(message.text);
            };

            $scope.OpenLocale = function () {
                $scope.loading = true;//loadin ng-show set to true when ng change OpenLocale() is called
                var locale = $scope.selectedLocale;
                if (locale) {
                    $scope.loading = true;
                    $http(
                        {
                            method: 'GET',//method get to get selected locale
                            url: '/rcmi18n/messages/'
                            + encodeURIComponent($scope.selectedLocale)
                        }
                    ).success(
                        function (data) {
                            //adding id to match up keys
                            var id = '';
                            angular.forEach(
                                data,
                                function (value, key) {
                                    id = 'trans' + key;
                                    value.id = id;
                                    value.textHtml = $sce.trustAsHtml(value.text);
                                    value.hasTranslation = (value.text && value.text != '');
                                    $scope.messages[id] = value;
                                }
                            );
                            $scope.loading = false;
                        }
                    ).error(
                        function () {
                            alert('Couldn\'t load messages!');
                            $scope.loading = false;
                            // called asynchronously if an error occurs
                            // or server returns response with an error status.
                        }
                    );

                }
            };

            var loadingKey = 'i18n';

            $scope.saveText = function (message) {
                rcmLoading.setLoading(loadingKey, 0);
                $http(
                    {
                        method: 'PUT',//method put to update selected locale
                        url: '/rcmi18n/messages/'
                        + encodeURIComponent($scope.selectedLocale)
                        + '/' + encodeURIComponent(message['messageId']),
                        data: message
                    }
                ).success(
                    function (data) {
                        message.dirty = false;
                        message.textHtml = $sce.trustAsHtml(message.text);
                        message.hasTranslation = (message.text && message.text != '');
                        rcmLoading.setLoading(loadingKey, 1);
                    }
                ).error(
                    function () {
                        alert('Couldn\'t save!');
                        // called asynchronously if an error occurs
                        // or server returns response with an error status.
                    }
                );
            }
        }
    ]
);

/**
 * Controller
 */
angular.module('rcmI18nAdmin').filter(
    'rcmi18nMessageFilter',
    function () { //search for text and Default text

        var compareStr = function (stra, strb) {
            stra = ("" + stra).toLowerCase();
            strb = ("" + strb).toLowerCase();

            return stra.indexOf(strb) !== -1;
        };

        return function (input, query) {
            if (!query) {
                return input
            }
            var result = {};
            angular.forEach(
                input,
                function (message) {
                    if (compareStr(message['defaultText'], query) || compareStr(message.text, query)) {
                        result[message.id] = message;
                    }
                }
            );

            return result;
        };
    }
);

angular.module('rcmI18nAdmin').filter(
    'rcmi18nMessageFilterTypeFilter',
    function () { //search for text and Default text

        return function (input, filterType) {
            if (!filterType) {
                return input
            }
            var result = {};
            angular.forEach(
                input,
                function (message) {
                    if (filterType == 'untranslated' && !message.hasTranslation) {
                        result[message.id] = message;
                    }
                }
            );

            return result;
        };
    }
);


rcm.addAngularModule(
    'rcmI18nAdmin'
);
