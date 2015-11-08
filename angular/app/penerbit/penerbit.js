(function () {
    "use strict";

    angular.module('app.controllers').controller('PenerbitCtrl', function ($scope, $http) {

        // Initial variable
        $scope.result = '';

        // post
        $scope.submitData = function () {
            $http.post('/api/v1/penerbit', $scope.value,
                {
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    }

                }).success(function (res) {
                    $scope.result = res;

                }).error(function (res) {
                    $scope.result = res.error;
                });
        };

    });

})();
