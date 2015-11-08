(function () {
    "use strict";

    angular.module('app.controllers').controller('AuthLoginCtrl', function ($scope, $http, $mdToast, $localStorage) {

        // notification toast
        $scope.openToast = function (message) {
            if (message != '' && message != null) {
                $mdToast.show($mdToast.simple()
                        .content(message)
                        //.position('top right')
                        .position('bottom right')
                        .hideDelay(6000)
                );
            }
        };

        // variable data
        $scope.data = {
            api: '/api/auth/login',
            input: $scope.input
        };

        // variable result
        $scope.result = {
            success: false,
            msg: '',
            status: ''
        };

        // post login
        $scope.submitData = function () {
            $http.post($scope.data.api, $scope.data.input,
                {
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }

                }).success(function (response) {
                    // set response success in result
                    setSuccessResponse(response.messages.msg);

                    // save token to local storage
                    saveToken(response.messages.token);

                }).error(function (response, status) {
                    // set response error in result
                    setErrorResponse(response, status);
                });
        };

        // save token to local storage
        function saveToken(token) {
            $localStorage.token = token;
        }

        // load token in local storage
        $scope.getToken = function () {
            $scope.token = $localStorage.token;
        };

        // set success result from method
        function setSuccessResponse(message) {
            $scope.result.success = true;
            $scope.result.msg = message;
        }

        // set error result from method
        function setErrorResponse(response, status) {
            $scope.result.success = false;
            $scope.result.status = status;

            // if error about validation
            var validate = response.validation;
            var message = response.messages;
            if (validate) {
                // message validation
                $scope.openToast(validate.email + ", " + validate.password);

            } else if (message) {
                // other message
                var msg = response.messages.msg;
                $scope.result.msg = msg;

                // set notify
                $scope.openToast(msg);
            }
        }
    });

})();
