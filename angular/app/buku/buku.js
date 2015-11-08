(function () {
    "use strict";

    angular.module('app.controllers').controller('BukuCtrl', function ($scope) {
        $scope.ProImage = 'https://i.imgur.com/ZbLzOPP.jpg';

        //$mdIconProvider.iconSet('communication', 'https://material.angularjs.org/1.0.0-rc2/img/icons/sets/communication-icons.svg', 24);

        var imagePath = 'https://material.angularjs.org/1.0.0-rc2/img/list/60.jpeg';
        $scope.phones = [
            {type: 'Home', number: '(555) 251-1234'},
            {type: 'Cell', number: '(555) 786-9841'},
            {type: 'Office', number: '(555) 314-1592'}
        ];
        $scope.todos = [
            {
                face: imagePath,
                what: 'Brunch this weekend?',
                who: 'Min Li Chan',
                when: '3:08PM',
                notes: " I'll be in your neighborhood doing errands"
            },
            {
                face: imagePath,
                what: 'Brunch this weekend?',
                who: 'Min Li Chan',
                when: '3:08PM',
                notes: " I'll be in your neighborhood doing errands"
            },
            {
                face: imagePath,
                what: 'Brunch this weekend?',
                who: 'Min Li Chan',
                when: '3:08PM',
                notes: " I'll be in your neighborhood doing errands"
            },
            {
                face: imagePath,
                what: 'Brunch this weekend?',
                who: 'Min Li Chan',
                when: '3:08PM',
                notes: " I'll be in your neighborhood doing errands"
            },
            {
                face: imagePath,
                what: 'Brunch this weekend?',
                who: 'Min Li Chan',
                when: '3:08PM',
                notes: " I'll be in your neighborhood doing errands"
            }
        ];
    });

})();
