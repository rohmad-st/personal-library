(function () {
    "use strict";

    angular.module('app.routes').config(function ($stateProvider, $urlRouterProvider) {

        var getView = function (viewName) {
            return './views/app/' + viewName + '/' + viewName + '.html';
        };

        $urlRouterProvider.otherwise('/');

        $stateProvider
            .state('app', {
                abstract: true,
                views: {
                    sidebar_left: {
                        templateUrl: getView('sidebar_left')
                    },
                    sidebar_right: {
                        templateUrl: getView('sidebar_right')
                    },
                    header_top: {
                        templateUrl: getView('header_top')
                    },

                    main: {}
                }
            })
            .state('app.buku', {
                url: '/',
                data: {pageName: 'Daftar Buku'},
                views: {
                    'main@': {
                        templateUrl: getView('buku')
                    }
                }
            })
            .state('app.penulis', {
                url: '/penulis',
                data: {pageName: 'Halaman Penulis'},
                views: {
                    'main@': {
                        templateUrl: getView('penulis')
                    }
                }
            })
            .state('app.penerbit', {
                url: '/penerbit',
                data: {pageName: 'Penerbit features'},
                views: {
                    'main@': {
                        templateUrl: getView('penerbit')
                    }
                }
            })
            .state('app.favorite', {
                url: '/favorite',
                data: {pageName: 'Favorite features'},
                views: {
                    'main@': {
                        templateUrl: getView('favorite')
                    }
                }
            })
            .state('app.auth_login', {
                url: '/login',
                data: {pageName: 'Authenticate Login'},
                views: {
                    'main@': {
                        templateUrl: getView('auth_login')
                    }
                }
            })
        ;

    });
})();
