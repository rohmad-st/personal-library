(function () {
    "use strict";

    angular.module('app.controllers').controller('HeaderCtrl', function ($scope, $rootScope, $mdSidenav, $log, DialogService) {

        $scope.$watch(function () {
            return $rootScope.current_page;
        }, function (newPage) {
            $scope.current_page = newPage || 'Page Name';
        });

        $scope.openSideNav = function () {
            $mdSidenav('left').open();
        };

        // open login dialog
        $scope.openLogin = function () {
            DialogService.fromTemplate('login', $scope);
        };

    });

})();