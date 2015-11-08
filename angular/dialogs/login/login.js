(function(){
    "use strict";

    angular.module('app.controllers').controller('LoginCtrl', function($scope, DialogService){

        $scope.save = function(){
            //
        };

        $scope.hide = function(){
        	DialogService.hide();
        };

    });

})();
