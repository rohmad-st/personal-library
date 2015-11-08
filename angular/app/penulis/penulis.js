(function () {
    "use strict";

    angular.module('app.controllers').controller('PenulisCtrl', function ($scope, $http) {

        // index
        $http.get('/api/v1/penulis').success(function (response) {
            $scope.result = response.data;
        });

        //$scope.getData = function () {
        //    $http({
        //        method: 'get',
        //        url: '/api/v1/penulis',
        //        //data: $.param({fkey: "key"}),
        //        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        //    })
        //        .success(function (response) {
        //            $scope.result = response;
        //        });
        //};


    });

})();
