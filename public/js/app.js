(function(){
	"use strict";

	var app = angular.module('app',
		[
		'app.controllers',
		'app.filters',
		'app.services',
		'app.directives',
		'app.routes',
		'app.config'
		]);


	angular.module('app.routes', ['ui.router', 'ngStorage', 'satellizer']);
	angular.module('app.controllers', ['ui.router', 'ngMaterial', 'ngStorage', 'restangular', 'ngMdIcons', 'angular-loading-bar']);
	angular.module('app.filters', []);
	angular.module('app.services', ['ui.router', 'ngStorage', 'restangular']);
	angular.module('app.directives', []);
	angular.module('app.config', []);

})();
(function () {
    "use strict";

    angular.module('app.routes').config(["$stateProvider", "$urlRouterProvider", function ($stateProvider, $urlRouterProvider) {

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

    }]);
})();

(function(){
	"use strict";

	angular.module('app.routes').run(["$rootScope", "$mdSidenav", function($rootScope, $mdSidenav){
		$rootScope.$on("$stateChangeStart", function(event, toState){

			if (toState.data && toState.data.pageName){
				$rootScope.current_page = toState.data.pageName;
			}


		});
		$rootScope.$on("$viewContentLoaded", function(event, toState){
			window.Prism.highlightAll();
		});

		$rootScope.$on("$stateChangeSuccess", function(event, toState){
			$mdSidenav('left').close();
		});
	}]);

})();

(function (){
    "use strict";

    angular.module('app.config').config(["$authProvider", function ($authProvider){
        // Satellizer configuration that specifies which API
        // route the JWT should be retrieved from
        $authProvider.loginUrl = '/api/authenticate/auth';
    }]);

})();

(function (){
	"use strict";

	angular.module('app.config').config(["cfpLoadingBarProvider", function (cfpLoadingBarProvider){
		cfpLoadingBarProvider.includeSpinner = false;
	}]);

})();

(function(){
	"use strict";

	angular.module('app.config').config( ["RestangularProvider", function(RestangularProvider) {
		RestangularProvider
		.setBaseUrl('/api/')
		.setDefaultHeaders({ accept: "application/x.laravel.v1+json" });
	}]);

})();

(function(){
	"use strict";

	angular.module('app.config').config(["$mdThemingProvider", function($mdThemingProvider) {
		/* For more info, visit https://material.angularjs.org/#/Theming/01_introduction */
		$mdThemingProvider.theme('default')
		.primaryPalette('indigo')
		.accentPalette('grey')
		.warnPalette('red');
	}]);

})();

(function(){
	"use strict";

	angular.module('app.filters').filter( 'capitalize', function(){
		return function(input, all) {
			return (!!input) ? input.replace(/([^\W_]+[^\s-]*) */g,function(txt){
				return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
			}) : '';
		};
	});
})();

(function(){
	"use strict";

	angular.module('app.filters').filter( 'humanReadable', function(){
		return function humanize(str) {
			if ( !str ){
				return '';
			}
			var frags = str.split('_');
			for (var i=0; i<frags.length; i++) {
				frags[i] = frags[i].charAt(0).toUpperCase() + frags[i].slice(1);
			}
			return frags.join(' ');
		};
	});
})();
(function(){
    'use strict';

    angular.module('app.filters').filter('truncateCharacters', function () {
        return function (input, chars, breakOnWord) {
            if (isNaN(chars)) {
                return input;
            }
            if (chars <= 0) {
                return '';
            }
            if (input && input.length > chars) {
                input = input.substring(0, chars);

                if (!breakOnWord) {
                    var lastspace = input.lastIndexOf(' ');
                    // Get last space
                    if (lastspace !== -1) {
                        input = input.substr(0, lastspace);
                    }
                } else {
                    while (input.charAt(input.length-1) === ' ') {
                        input = input.substr(0, input.length - 1);
                    }
                }
                return input + '...';
            }
            return input;
        };
    });
})();
(function(){
    'use strict';

    angular.module('app.filters').filter('truncateWords', function () {
        return function (input, words) {
            if (isNaN(words)) {
                return input;
            }
            if (words <= 0) {
                return '';
            }
            if (input) {
                var inputWords = input.split(/\s+/);
                if (inputWords.length > words) {
                    input = inputWords.slice(0, words).join(' ') + '...';
                }
            }
            return input;
        };
    });
})();
(function(){
	"use strict";

	angular.module('app.filters').filter( 'trustHtml', ["$sce", function( $sce ){
		return function( html ){
			return $sce.trustAsHtml(html);
		};
	}]);
})();
(function(){
	"use strict";

	angular.module('app.filters').filter('ucfirst', function() {
		return function( input ) {
			if ( !input ){
				return null;
			}
			return input.substring(0, 1).toUpperCase() + input.substring(1);
		};
	});

})();

(function(){
	"use strict";

	angular.module("app.services").factory('DialogService', ["$mdDialog", function($mdDialog){

		return {
			fromTemplate: function(template, $scope){

				var options = {
					templateUrl: './views/dialogs/' + template + '/' + template + '.html'
				};

				if ($scope){
					options.scope = $scope.$new();
				}

				return $mdDialog.show(options);
			},

			hide: function(){
				return $mdDialog.hide();
			},

			alert: function(title, content){
				$mdDialog.show(
					$mdDialog.alert()
						.title(title)
						.content(content)
						.ok('Ok')
				);
			}
		};
	}]);
})();
(function(){
	"use strict";

	angular.module("app.services").factory('ToastService', ["$mdToast", function($mdToast){

		var delay = 6000,
			position = 'top right',
			action = 'OK';

		return {
			show: function(content){
				if (!content){
					return false;
				}

				return $mdToast.show(
					$mdToast.simple()
						.content(content)
						.position(position)
						.action(action)
						.hideDelay(delay)
				);
			},
			error: function(content){
				if (!content){
					return false;
				}

				return $mdToast.show(
					$mdToast.simple()
						.content(content)
						.position(position)
						.theme('warn')
						.action(action)
						.hideDelay(delay)
				);
			}
		};
	}]);
})();
(function () {
    "use strict";

    angular.module('app.controllers').controller('AuthLoginCtrl', ["$scope", "$http", "$mdToast", "$localStorage", function ($scope, $http, $mdToast, $localStorage) {

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
    }]);

})();

(function () {
    "use strict";

    angular.module('app.controllers').controller('BukuCtrl', ["$scope", function ($scope) {
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
    }]);

})();

(function(){
	"use strict";

	angular.module('app.controllers').controller('DialogsCtrl', ["$scope", "DialogService", function($scope, DialogService){
		$scope.alertDialog = function(){
			DialogService.alert('This is an alert title', 'You can specify some description text in here.');
		};

		$scope.customDialog = function(){
			DialogService.fromTemplate('add_users', $scope);
		};
	}]);

})();

(function(){
    "use strict";

    angular.module('app.controllers').controller('ElixirCtrl', function(){
        //
    });

})();

(function(){
    "use strict";

    angular.module('app.controllers').controller('FavoriteCtrl', function(){
        //
    });

})();

(function(){
    "use strict";

    angular.module('app.controllers').controller('GeneratorsCtrl', function(){
        //
    });

})();

(function () {
    "use strict";

    angular.module('app.controllers').controller('HeaderCtrl', ["$scope", "$rootScope", "$mdSidenav", "$log", "DialogService", function ($scope, $rootScope, $mdSidenav, $log, DialogService) {

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

    }]);

})();
(function(){
    "use strict";

    angular.module('app.controllers').controller('HeaderTopCtrl', function(){
        //
    });

})();


(function(){
	"use strict";

	angular.module('app.controllers').controller('JwtAuthCtrl', ["$scope", "$auth", "Restangular", function($scope, $auth, Restangular){

		var credentials = {};

		$scope.requestToken = function(){
			// Use Satellizer's $auth service to login because it'll automatically save the JWT in localStorage
			$auth.login(credentials).then(function (data){
				// If login is successful, redirect to the users state
				//$state.go('dashboard');
			});
		};

		// This request will hit the getData method in the AuthenticateController
		// on the Laravel side and will return your data that require authentication
		$scope.getData = function(){
			Restangular.all('authenticate/data').get().then(function (response){

			}, function (error){});
		};



	}]);

})();

(function(){
	"use strict";

	angular.module('app.controllers').controller('LandingCtrl', ["$scope", "$mdToast", "$mdDialog", "$interval", "ToastService", "DialogService", function($scope, $mdToast, $mdDialog, $interval, ToastService, DialogService){

		$scope.promoImage = 'https://i.imgur.com/ZbLzOPP.jpg';
		$scope.icon = 'send';

		var icons = [
				'office', 'facebook', 'twitter', 'apple', 'whatsapp', 'linkedin', 'windows', 'accessibility', 'alarm', 'aspect_ratio',
				'autorenew', 'bookmark_outline', 'dashboard', 'dns', 'favorite_outline', 'get_app', 'highlight_remove', 'history', 'list',
				'picture_in_picture', 'print', 'settings_ethernet', 'settings_power', 'shopping_cart', 'spellcheck', 'swap_horiz', 'swap_vert',
				'thumb_up', 'thumbs_up_down', 'translate', 'trending_up', 'visibility', 'warning', 'mic', 'play_circle_outline', 'repeat',
				'skip_next', 'call', 'chat', 'clear_all', 'dialpad', 'dnd_on', 'forum', 'location_on', 'vpn_key', 'filter_list', 'inbox',
				'link', 'remove_circle_outline', 'save', 'text_format', 'access_time', 'airplanemode_on', 'bluetooth', 'data_usage',
				'gps_fixed', 'now_wallpaper', 'now_widgets', 'storage', 'wifi_tethering', 'attach_file', 'format_line_spacing',
				'format_list_numbered', 'format_quote', 'vertical_align_center', 'wrap_text', 'cloud_queue', 'file_download', 'folder_open',
				'cast', 'headset', 'keyboard_backspace', 'mouse', 'speaker', 'watch', 'audiotrack', 'edit', 'brush', 'looks', 'crop_free',
				'camera', 'filter_vintage', 'hdr_strong', 'photo_camera', 'slideshow', 'timer', 'directions_bike', 'hotel', 'local_library',
				'directions_walk', 'local_cafe', 'local_pizza', 'local_florist', 'my_location', 'navigation', 'pin_drop', 'arrow_back', 'menu',
				'close', 'more_horiz', 'more_vert', 'refresh', 'phone_paused', 'vibration', 'cake', 'group', 'mood', 'person',
				'notifications_none', 'plus_one', 'school', 'share', 'star_outline'
			],
			counter = 0;

		$interval(function(){
			$scope.icon = icons[++counter];
			if (counter > 112){
				counter = 0;
			}
		}, 2000);

	}]);

})();

(function (){
    "use strict";

    angular.module('app.controllers').controller('LoginCtrl', function (){

    });

})();

(function(){
    "use strict";

    angular.module('app.controllers').controller('MiscCtrl', function(){
        //
    });

})();

(function () {
    "use strict";

    angular.module('app.controllers').controller('PenerbitCtrl', ["$scope", "$http", function ($scope, $http) {

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

    }]);

})();

(function () {
    "use strict";

    angular.module('app.controllers').controller('PenulisCtrl', ["$scope", "$http", function ($scope, $http) {

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


    }]);

})();

(function(){
    "use strict";

    angular.module('app.controllers').controller('RestApiCtrl', function(){
        //
    });

})();

(function(){
    "use strict";

    angular.module('app.controllers').controller('ReviewsCtrl', function(){
        //
    });

})();

(function(){
	"use strict";

	angular.module('app.controllers').controller('SidebarCtrl', ["$scope", "$state", function($scope, $state){


	}]);

})();
(function(){
    "use strict";

    angular.module('app.controllers').controller('SidebarLeftCtrl', function(){
        //
    });

})();

(function(){
    "use strict";

    angular.module('app.controllers').controller('SidebarRightCtrl', function(){
        //
    });

})();

(function(){
	"use strict";

	angular.module('app.controllers').controller('DashboardCtrl', function(){

	});

})();

(function(){
	"use strict";

	angular.module('app.controllers').controller('ToastsCtrl', ["$scope", "ToastService", function($scope, ToastService){

		$scope.toastSuccess = function(){
			ToastService.show('User added successfully!');
		};

		$scope.toastError = function(){
			ToastService.error('Connection interrupted!');
		};

	}]);

})();

(function(){
    "use strict";

    angular.module('app.controllers').controller('UnsupportedBrowserCtrl', function(){
        //
    });

})();

(function(){
    "use strict";

    angular.module('app.controllers').controller('AddUsersCtrl', ["$scope", "DialogService", function($scope, DialogService){

        $scope.save = function(){
	        //do something useful
            DialogService.hide();
        };

        $scope.hide = function(){
        	DialogService.hide();
        };

    }]);

})();

(function(){
    "use strict";

    angular.module('app.controllers').controller('LoginCtrl', ["$scope", "DialogService", function($scope, DialogService){

        $scope.save = function(){
            //
        };

        $scope.hide = function(){
        	DialogService.hide();
        };

    }]);

})();

(function(){
	"use strict";

	angular.module( 'app.controllers' ).controller( 'DataListingCtrl', function(){
		//
    });

})();

(function(){
	"use strict";

	angular.module('app.directives').directive( 'dataListing', function() {

		return {
			restrict: 'EA',
			templateUrl: 'views/directives/data_listing/data_listing.html',
			controller: 'DataListingCtrl',
			link: function( scope, element, attrs ){
				//
			}
		};

	});

})();

//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm1haW4uanMiLCJyb3V0ZXMuanMiLCJyb3V0ZXMucnVuLmpzIiwiY29uZmlnL2F1dGguanMiLCJjb25maWcvbG9hZGluZ19iYXIuanMiLCJjb25maWcvcmVzdGFuZ3VsYXIuanMiLCJjb25maWcvdGhlbWUuanMiLCJmaWx0ZXJzL2NhcGl0YWxpemUuanMiLCJmaWx0ZXJzL2h1bWFuX3JlYWRhYmxlLmpzIiwiZmlsdGVycy90cnVuY2F0ZV9jaGFyYWN0ZXJzLmpzIiwiZmlsdGVycy90cnVuY2F0ZV93b3Jkcy5qcyIsImZpbHRlcnMvdHJ1c3RfaHRtbC5qcyIsImZpbHRlcnMvdWNmaXJzdC5qcyIsInNlcnZpY2VzL2RpYWxvZy5qcyIsInNlcnZpY2VzL3RvYXN0LmpzIiwiYXBwL2F1dGhfbG9naW4vYXV0aF9sb2dpbi5qcyIsImFwcC9idWt1L2J1a3UuanMiLCJhcHAvZGlhbG9ncy9kaWFsb2dzLmpzIiwiYXBwL2VsaXhpci9lbGl4aXIuanMiLCJhcHAvZmF2b3JpdGUvZmF2b3JpdGUuanMiLCJhcHAvZ2VuZXJhdG9ycy9nZW5lcmF0b3JzLmpzIiwiYXBwL2hlYWRlci9oZWFkZXIuanMiLCJhcHAvaGVhZGVyX3RvcC9oZWFkZXJfdG9wLmpzIiwiYXBwL2p3dF9hdXRoL2p3dF9hdXRoLmpzIiwiYXBwL2xhbmRpbmcvbGFuZGluZy5qcyIsImFwcC9sb2dpbi9sb2dpbi5qcyIsImFwcC9taXNjL21pc2MuanMiLCJhcHAvcGVuZXJiaXQvcGVuZXJiaXQuanMiLCJhcHAvcGVudWxpcy9wZW51bGlzLmpzIiwiYXBwL3Jlc3RfYXBpL3Jlc3RfYXBpLmpzIiwiYXBwL3Jldmlld3MvcmV2aWV3cy5qcyIsImFwcC9zaWRlYmFyL3NpZGViYXIuanMiLCJhcHAvc2lkZWJhcl9sZWZ0L3NpZGViYXJfbGVmdC5qcyIsImFwcC9zaWRlYmFyX3JpZ2h0L3NpZGViYXJfcmlnaHQuanMiLCJhcHAvdGFicy90YWJzLmpzIiwiYXBwL3RvYXN0cy90b2FzdHMuanMiLCJhcHAvdW5zdXBwb3J0ZWRfYnJvd3Nlci91bnN1cHBvcnRlZF9icm93c2VyLmpzIiwiZGlhbG9ncy9hZGRfdXNlcnMvYWRkX3VzZXJzLmpzIiwiZGlhbG9ncy9sb2dpbi9sb2dpbi5qcyIsImRpcmVjdGl2ZXMvZGF0YV9saXN0aW5nL2RhdGFfbGlzdGluZy5qcyIsImRpcmVjdGl2ZXMvZGF0YV9saXN0aW5nL2RlZmluaXRpb24uanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUEsQ0FBQSxVQUFBO0NBQ0E7O0NBRUEsSUFBQSxNQUFBLFFBQUEsT0FBQTtFQUNBO0VBQ0E7RUFDQTtFQUNBO0VBQ0E7RUFDQTtFQUNBOzs7O0NBSUEsUUFBQSxPQUFBLGNBQUEsQ0FBQSxhQUFBLGFBQUE7Q0FDQSxRQUFBLE9BQUEsbUJBQUEsQ0FBQSxhQUFBLGNBQUEsYUFBQSxlQUFBLGFBQUE7Q0FDQSxRQUFBLE9BQUEsZUFBQTtDQUNBLFFBQUEsT0FBQSxnQkFBQSxDQUFBLGFBQUEsYUFBQTtDQUNBLFFBQUEsT0FBQSxrQkFBQTtDQUNBLFFBQUEsT0FBQSxjQUFBOzs7QUNuQkEsQ0FBQSxZQUFBO0lBQ0E7O0lBRUEsUUFBQSxPQUFBLGNBQUEsZ0RBQUEsVUFBQSxnQkFBQSxvQkFBQTs7UUFFQSxJQUFBLFVBQUEsVUFBQSxVQUFBO1lBQ0EsT0FBQSxpQkFBQSxXQUFBLE1BQUEsV0FBQTs7O1FBR0EsbUJBQUEsVUFBQTs7UUFFQTthQUNBLE1BQUEsT0FBQTtnQkFDQSxVQUFBO2dCQUNBLE9BQUE7b0JBQ0EsY0FBQTt3QkFDQSxhQUFBLFFBQUE7O29CQUVBLGVBQUE7d0JBQ0EsYUFBQSxRQUFBOztvQkFFQSxZQUFBO3dCQUNBLGFBQUEsUUFBQTs7O29CQUdBLE1BQUE7OzthQUdBLE1BQUEsWUFBQTtnQkFDQSxLQUFBO2dCQUNBLE1BQUEsQ0FBQSxVQUFBO2dCQUNBLE9BQUE7b0JBQ0EsU0FBQTt3QkFDQSxhQUFBLFFBQUE7Ozs7YUFJQSxNQUFBLGVBQUE7Z0JBQ0EsS0FBQTtnQkFDQSxNQUFBLENBQUEsVUFBQTtnQkFDQSxPQUFBO29CQUNBLFNBQUE7d0JBQ0EsYUFBQSxRQUFBOzs7O2FBSUEsTUFBQSxnQkFBQTtnQkFDQSxLQUFBO2dCQUNBLE1BQUEsQ0FBQSxVQUFBO2dCQUNBLE9BQUE7b0JBQ0EsU0FBQTt3QkFDQSxhQUFBLFFBQUE7Ozs7YUFJQSxNQUFBLGdCQUFBO2dCQUNBLEtBQUE7Z0JBQ0EsTUFBQSxDQUFBLFVBQUE7Z0JBQ0EsT0FBQTtvQkFDQSxTQUFBO3dCQUNBLGFBQUEsUUFBQTs7OzthQUlBLE1BQUEsa0JBQUE7Z0JBQ0EsS0FBQTtnQkFDQSxNQUFBLENBQUEsVUFBQTtnQkFDQSxPQUFBO29CQUNBLFNBQUE7d0JBQ0EsYUFBQSxRQUFBOzs7Ozs7Ozs7QUNyRUEsQ0FBQSxVQUFBO0NBQ0E7O0NBRUEsUUFBQSxPQUFBLGNBQUEsaUNBQUEsU0FBQSxZQUFBLFdBQUE7RUFDQSxXQUFBLElBQUEscUJBQUEsU0FBQSxPQUFBLFFBQUE7O0dBRUEsSUFBQSxRQUFBLFFBQUEsUUFBQSxLQUFBLFNBQUE7SUFDQSxXQUFBLGVBQUEsUUFBQSxLQUFBOzs7OztFQUtBLFdBQUEsSUFBQSxzQkFBQSxTQUFBLE9BQUEsUUFBQTtHQUNBLE9BQUEsTUFBQTs7O0VBR0EsV0FBQSxJQUFBLHVCQUFBLFNBQUEsT0FBQSxRQUFBO0dBQ0EsV0FBQSxRQUFBOzs7Ozs7QUNqQkEsQ0FBQSxXQUFBO0lBQ0E7O0lBRUEsUUFBQSxPQUFBLGNBQUEseUJBQUEsVUFBQSxjQUFBOzs7UUFHQSxjQUFBLFdBQUE7Ozs7O0FDTkEsQ0FBQSxXQUFBO0NBQ0E7O0NBRUEsUUFBQSxPQUFBLGNBQUEsaUNBQUEsVUFBQSxzQkFBQTtFQUNBLHNCQUFBLGlCQUFBOzs7OztBQ0pBLENBQUEsVUFBQTtDQUNBOztDQUVBLFFBQUEsT0FBQSxjQUFBLGdDQUFBLFNBQUEscUJBQUE7RUFDQTtHQUNBLFdBQUE7R0FDQSxrQkFBQSxFQUFBLFFBQUE7Ozs7O0FDTkEsQ0FBQSxVQUFBO0NBQ0E7O0NBRUEsUUFBQSxPQUFBLGNBQUEsOEJBQUEsU0FBQSxvQkFBQTs7RUFFQSxtQkFBQSxNQUFBO0dBQ0EsZUFBQTtHQUNBLGNBQUE7R0FDQSxZQUFBOzs7OztBQ1JBLENBQUEsVUFBQTtDQUNBOztDQUVBLFFBQUEsT0FBQSxlQUFBLFFBQUEsY0FBQSxVQUFBO0VBQ0EsT0FBQSxTQUFBLE9BQUEsS0FBQTtHQUNBLE9BQUEsQ0FBQSxDQUFBLENBQUEsU0FBQSxNQUFBLFFBQUEsc0JBQUEsU0FBQSxJQUFBO0lBQ0EsT0FBQSxJQUFBLE9BQUEsR0FBQSxnQkFBQSxJQUFBLE9BQUEsR0FBQTtRQUNBOzs7OztBQ1BBLENBQUEsVUFBQTtDQUNBOztDQUVBLFFBQUEsT0FBQSxlQUFBLFFBQUEsaUJBQUEsVUFBQTtFQUNBLE9BQUEsU0FBQSxTQUFBLEtBQUE7R0FDQSxLQUFBLENBQUEsS0FBQTtJQUNBLE9BQUE7O0dBRUEsSUFBQSxRQUFBLElBQUEsTUFBQTtHQUNBLEtBQUEsSUFBQSxFQUFBLEdBQUEsRUFBQSxNQUFBLFFBQUEsS0FBQTtJQUNBLE1BQUEsS0FBQSxNQUFBLEdBQUEsT0FBQSxHQUFBLGdCQUFBLE1BQUEsR0FBQSxNQUFBOztHQUVBLE9BQUEsTUFBQSxLQUFBOzs7O0FDWkEsQ0FBQSxVQUFBO0lBQ0E7O0lBRUEsUUFBQSxPQUFBLGVBQUEsT0FBQSxzQkFBQSxZQUFBO1FBQ0EsT0FBQSxVQUFBLE9BQUEsT0FBQSxhQUFBO1lBQ0EsSUFBQSxNQUFBLFFBQUE7Z0JBQ0EsT0FBQTs7WUFFQSxJQUFBLFNBQUEsR0FBQTtnQkFDQSxPQUFBOztZQUVBLElBQUEsU0FBQSxNQUFBLFNBQUEsT0FBQTtnQkFDQSxRQUFBLE1BQUEsVUFBQSxHQUFBOztnQkFFQSxJQUFBLENBQUEsYUFBQTtvQkFDQSxJQUFBLFlBQUEsTUFBQSxZQUFBOztvQkFFQSxJQUFBLGNBQUEsQ0FBQSxHQUFBO3dCQUNBLFFBQUEsTUFBQSxPQUFBLEdBQUE7O3VCQUVBO29CQUNBLE9BQUEsTUFBQSxPQUFBLE1BQUEsT0FBQSxPQUFBLEtBQUE7d0JBQ0EsUUFBQSxNQUFBLE9BQUEsR0FBQSxNQUFBLFNBQUE7OztnQkFHQSxPQUFBLFFBQUE7O1lBRUEsT0FBQTs7OztBQzNCQSxDQUFBLFVBQUE7SUFDQTs7SUFFQSxRQUFBLE9BQUEsZUFBQSxPQUFBLGlCQUFBLFlBQUE7UUFDQSxPQUFBLFVBQUEsT0FBQSxPQUFBO1lBQ0EsSUFBQSxNQUFBLFFBQUE7Z0JBQ0EsT0FBQTs7WUFFQSxJQUFBLFNBQUEsR0FBQTtnQkFDQSxPQUFBOztZQUVBLElBQUEsT0FBQTtnQkFDQSxJQUFBLGFBQUEsTUFBQSxNQUFBO2dCQUNBLElBQUEsV0FBQSxTQUFBLE9BQUE7b0JBQ0EsUUFBQSxXQUFBLE1BQUEsR0FBQSxPQUFBLEtBQUEsT0FBQTs7O1lBR0EsT0FBQTs7OztBQ2pCQSxDQUFBLFVBQUE7Q0FDQTs7Q0FFQSxRQUFBLE9BQUEsZUFBQSxRQUFBLHNCQUFBLFVBQUEsTUFBQTtFQUNBLE9BQUEsVUFBQSxNQUFBO0dBQ0EsT0FBQSxLQUFBLFlBQUE7Ozs7QUNMQSxDQUFBLFVBQUE7Q0FDQTs7Q0FFQSxRQUFBLE9BQUEsZUFBQSxPQUFBLFdBQUEsV0FBQTtFQUNBLE9BQUEsVUFBQSxRQUFBO0dBQ0EsS0FBQSxDQUFBLE9BQUE7SUFDQSxPQUFBOztHQUVBLE9BQUEsTUFBQSxVQUFBLEdBQUEsR0FBQSxnQkFBQSxNQUFBLFVBQUE7Ozs7OztBQ1JBLENBQUEsVUFBQTtDQUNBOztDQUVBLFFBQUEsT0FBQSxnQkFBQSxRQUFBLCtCQUFBLFNBQUEsVUFBQTs7RUFFQSxPQUFBO0dBQ0EsY0FBQSxTQUFBLFVBQUEsT0FBQTs7SUFFQSxJQUFBLFVBQUE7S0FDQSxhQUFBLHFCQUFBLFdBQUEsTUFBQSxXQUFBOzs7SUFHQSxJQUFBLE9BQUE7S0FDQSxRQUFBLFFBQUEsT0FBQTs7O0lBR0EsT0FBQSxVQUFBLEtBQUE7OztHQUdBLE1BQUEsVUFBQTtJQUNBLE9BQUEsVUFBQTs7O0dBR0EsT0FBQSxTQUFBLE9BQUEsUUFBQTtJQUNBLFVBQUE7S0FDQSxVQUFBO09BQ0EsTUFBQTtPQUNBLFFBQUE7T0FDQSxHQUFBOzs7Ozs7QUM1QkEsQ0FBQSxVQUFBO0NBQ0E7O0NBRUEsUUFBQSxPQUFBLGdCQUFBLFFBQUEsNkJBQUEsU0FBQSxTQUFBOztFQUVBLElBQUEsUUFBQTtHQUNBLFdBQUE7R0FDQSxTQUFBOztFQUVBLE9BQUE7R0FDQSxNQUFBLFNBQUEsUUFBQTtJQUNBLElBQUEsQ0FBQSxRQUFBO0tBQ0EsT0FBQTs7O0lBR0EsT0FBQSxTQUFBO0tBQ0EsU0FBQTtPQUNBLFFBQUE7T0FDQSxTQUFBO09BQ0EsT0FBQTtPQUNBLFVBQUE7OztHQUdBLE9BQUEsU0FBQSxRQUFBO0lBQ0EsSUFBQSxDQUFBLFFBQUE7S0FDQSxPQUFBOzs7SUFHQSxPQUFBLFNBQUE7S0FDQSxTQUFBO09BQ0EsUUFBQTtPQUNBLFNBQUE7T0FDQSxNQUFBO09BQ0EsT0FBQTtPQUNBLFVBQUE7Ozs7OztBQ2xDQSxDQUFBLFlBQUE7SUFDQTs7SUFFQSxRQUFBLE9BQUEsbUJBQUEsV0FBQSxrRUFBQSxVQUFBLFFBQUEsT0FBQSxVQUFBLGVBQUE7OztRQUdBLE9BQUEsWUFBQSxVQUFBLFNBQUE7WUFDQSxJQUFBLFdBQUEsTUFBQSxXQUFBLE1BQUE7Z0JBQ0EsU0FBQSxLQUFBLFNBQUE7eUJBQ0EsUUFBQTs7eUJBRUEsU0FBQTt5QkFDQSxVQUFBOzs7Ozs7UUFNQSxPQUFBLE9BQUE7WUFDQSxLQUFBO1lBQ0EsT0FBQSxPQUFBOzs7O1FBSUEsT0FBQSxTQUFBO1lBQ0EsU0FBQTtZQUNBLEtBQUE7WUFDQSxRQUFBOzs7O1FBSUEsT0FBQSxhQUFBLFlBQUE7WUFDQSxNQUFBLEtBQUEsT0FBQSxLQUFBLEtBQUEsT0FBQSxLQUFBO2dCQUNBO29CQUNBLFNBQUE7d0JBQ0EsZ0JBQUE7d0JBQ0Esb0JBQUE7OzttQkFHQSxRQUFBLFVBQUEsVUFBQTs7b0JBRUEsbUJBQUEsU0FBQSxTQUFBOzs7b0JBR0EsVUFBQSxTQUFBLFNBQUE7O21CQUVBLE1BQUEsVUFBQSxVQUFBLFFBQUE7O29CQUVBLGlCQUFBLFVBQUE7Ozs7O1FBS0EsU0FBQSxVQUFBLE9BQUE7WUFDQSxjQUFBLFFBQUE7Ozs7UUFJQSxPQUFBLFdBQUEsWUFBQTtZQUNB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Q0EsYUFBQSxNQUFBOzs7Ozs7O0FDVkEsQ0FBQSxVQUFBO0lBQ0E7O0lBRUEsUUFBQSxPQUFBLG1CQUFBLFdBQUEsMEJBQUEsVUFBQTs7Ozs7O0FDSEEsQ0FBQSxVQUFBO0lBQ0E7O0lBRUEsUUFBQSxPQUFBLG1CQUFBLFdBQUEsNENBQUEsU0FBQSxRQUFBLGNBQUE7O1FBRUEsT0FBQSxPQUFBLFVBQUE7O1lBRUEsY0FBQTs7O1FBR0EsT0FBQSxPQUFBLFVBQUE7U0FDQSxjQUFBOzs7Ozs7O0FDWEEsQ0FBQSxVQUFBO0lBQ0E7O0lBRUEsUUFBQSxPQUFBLG1CQUFBLFdBQUEseUNBQUEsU0FBQSxRQUFBLGNBQUE7O1FBRUEsT0FBQSxPQUFBLFVBQUE7Ozs7UUFJQSxPQUFBLE9BQUEsVUFBQTtTQUNBLGNBQUE7Ozs7Ozs7QUNWQSxDQUFBLFVBQUE7Q0FDQTs7Q0FFQSxRQUFBLFFBQUEsb0JBQUEsWUFBQSxtQkFBQSxVQUFBOzs7Ozs7QUNIQSxDQUFBLFVBQUE7Q0FDQTs7Q0FFQSxRQUFBLE9BQUEsa0JBQUEsV0FBQSxlQUFBLFdBQUE7O0VBRUEsT0FBQTtHQUNBLFVBQUE7R0FDQSxhQUFBO0dBQ0EsWUFBQTtHQUNBLE1BQUEsVUFBQSxPQUFBLFNBQUEsT0FBQTs7Ozs7Ozs7QUFRQSIsImZpbGUiOiJhcHAuanMiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKXtcblx0XCJ1c2Ugc3RyaWN0XCI7XG5cblx0dmFyIGFwcCA9IGFuZ3VsYXIubW9kdWxlKCdhcHAnLFxuXHRcdFtcblx0XHQnYXBwLmNvbnRyb2xsZXJzJyxcblx0XHQnYXBwLmZpbHRlcnMnLFxuXHRcdCdhcHAuc2VydmljZXMnLFxuXHRcdCdhcHAuZGlyZWN0aXZlcycsXG5cdFx0J2FwcC5yb3V0ZXMnLFxuXHRcdCdhcHAuY29uZmlnJ1xuXHRcdF0pO1xuXG5cblx0YW5ndWxhci5tb2R1bGUoJ2FwcC5yb3V0ZXMnLCBbJ3VpLnJvdXRlcicsICduZ1N0b3JhZ2UnLCAnc2F0ZWxsaXplciddKTtcblx0YW5ndWxhci5tb2R1bGUoJ2FwcC5jb250cm9sbGVycycsIFsndWkucm91dGVyJywgJ25nTWF0ZXJpYWwnLCAnbmdTdG9yYWdlJywgJ3Jlc3Rhbmd1bGFyJywgJ25nTWRJY29ucycsICdhbmd1bGFyLWxvYWRpbmctYmFyJ10pO1xuXHRhbmd1bGFyLm1vZHVsZSgnYXBwLmZpbHRlcnMnLCBbXSk7XG5cdGFuZ3VsYXIubW9kdWxlKCdhcHAuc2VydmljZXMnLCBbJ3VpLnJvdXRlcicsICduZ1N0b3JhZ2UnLCAncmVzdGFuZ3VsYXInXSk7XG5cdGFuZ3VsYXIubW9kdWxlKCdhcHAuZGlyZWN0aXZlcycsIFtdKTtcblx0YW5ndWxhci5tb2R1bGUoJ2FwcC5jb25maWcnLCBbXSk7XG5cbn0pKCk7IiwiKGZ1bmN0aW9uICgpIHtcbiAgICBcInVzZSBzdHJpY3RcIjtcblxuICAgIGFuZ3VsYXIubW9kdWxlKCdhcHAucm91dGVzJykuY29uZmlnKGZ1bmN0aW9uICgkc3RhdGVQcm92aWRlciwgJHVybFJvdXRlclByb3ZpZGVyKSB7XG5cbiAgICAgICAgdmFyIGdldFZpZXcgPSBmdW5jdGlvbiAodmlld05hbWUpIHtcbiAgICAgICAgICAgIHJldHVybiAnLi92aWV3cy9hcHAvJyArIHZpZXdOYW1lICsgJy8nICsgdmlld05hbWUgKyAnLmh0bWwnO1xuICAgICAgICB9O1xuXG4gICAgICAgICR1cmxSb3V0ZXJQcm92aWRlci5vdGhlcndpc2UoJy8nKTtcblxuICAgICAgICAkc3RhdGVQcm92aWRlclxuICAgICAgICAgICAgLnN0YXRlKCdhcHAnLCB7XG4gICAgICAgICAgICAgICAgYWJzdHJhY3Q6IHRydWUsXG4gICAgICAgICAgICAgICAgdmlld3M6IHtcbiAgICAgICAgICAgICAgICAgICAgc2lkZWJhcl9sZWZ0OiB7XG4gICAgICAgICAgICAgICAgICAgICAgICB0ZW1wbGF0ZVVybDogZ2V0Vmlldygnc2lkZWJhcl9sZWZ0JylcbiAgICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAgICAgc2lkZWJhcl9yaWdodDoge1xuICAgICAgICAgICAgICAgICAgICAgICAgdGVtcGxhdGVVcmw6IGdldFZpZXcoJ3NpZGViYXJfcmlnaHQnKVxuICAgICAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgICAgICBoZWFkZXJfdG9wOiB7XG4gICAgICAgICAgICAgICAgICAgICAgICB0ZW1wbGF0ZVVybDogZ2V0VmlldygnaGVhZGVyX3RvcCcpXG4gICAgICAgICAgICAgICAgICAgIH0sXG5cbiAgICAgICAgICAgICAgICAgICAgbWFpbjoge31cbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KVxuICAgICAgICAgICAgLnN0YXRlKCdhcHAuYnVrdScsIHtcbiAgICAgICAgICAgICAgICB1cmw6ICcvJyxcbiAgICAgICAgICAgICAgICBkYXRhOiB7cGFnZU5hbWU6ICdEYWZ0YXIgQnVrdSd9LFxuICAgICAgICAgICAgICAgIHZpZXdzOiB7XG4gICAgICAgICAgICAgICAgICAgICdtYWluQCc6IHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHRlbXBsYXRlVXJsOiBnZXRWaWV3KCdidWt1JylcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pXG4gICAgICAgICAgICAuc3RhdGUoJ2FwcC5wZW51bGlzJywge1xuICAgICAgICAgICAgICAgIHVybDogJy9wZW51bGlzJyxcbiAgICAgICAgICAgICAgICBkYXRhOiB7cGFnZU5hbWU6ICdIYWxhbWFuIFBlbnVsaXMnfSxcbiAgICAgICAgICAgICAgICB2aWV3czoge1xuICAgICAgICAgICAgICAgICAgICAnbWFpbkAnOiB7XG4gICAgICAgICAgICAgICAgICAgICAgICB0ZW1wbGF0ZVVybDogZ2V0VmlldygncGVudWxpcycpXG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KVxuICAgICAgICAgICAgLnN0YXRlKCdhcHAucGVuZXJiaXQnLCB7XG4gICAgICAgICAgICAgICAgdXJsOiAnL3BlbmVyYml0JyxcbiAgICAgICAgICAgICAgICBkYXRhOiB7cGFnZU5hbWU6ICdQZW5lcmJpdCBmZWF0dXJlcyd9LFxuICAgICAgICAgICAgICAgIHZpZXdzOiB7XG4gICAgICAgICAgICAgICAgICAgICdtYWluQCc6IHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHRlbXBsYXRlVXJsOiBnZXRWaWV3KCdwZW5lcmJpdCcpXG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KVxuICAgICAgICAgICAgLnN0YXRlKCdhcHAuZmF2b3JpdGUnLCB7XG4gICAgICAgICAgICAgICAgdXJsOiAnL2Zhdm9yaXRlJyxcbiAgICAgICAgICAgICAgICBkYXRhOiB7cGFnZU5hbWU6ICdGYXZvcml0ZSBmZWF0dXJlcyd9LFxuICAgICAgICAgICAgICAgIHZpZXdzOiB7XG4gICAgICAgICAgICAgICAgICAgICdtYWluQCc6IHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHRlbXBsYXRlVXJsOiBnZXRWaWV3KCdmYXZvcml0ZScpXG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KVxuICAgICAgICAgICAgLnN0YXRlKCdhcHAuYXV0aF9sb2dpbicsIHtcbiAgICAgICAgICAgICAgICB1cmw6ICcvbG9naW4nLFxuICAgICAgICAgICAgICAgIGRhdGE6IHtwYWdlTmFtZTogJ0F1dGhlbnRpY2F0ZSBMb2dpbid9LFxuICAgICAgICAgICAgICAgIHZpZXdzOiB7XG4gICAgICAgICAgICAgICAgICAgICdtYWluQCc6IHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHRlbXBsYXRlVXJsOiBnZXRWaWV3KCdhdXRoX2xvZ2luJylcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pXG4gICAgICAgIDtcblxuICAgIH0pO1xufSkoKTtcbiIsIihmdW5jdGlvbigpe1xuXHRcInVzZSBzdHJpY3RcIjtcblxuXHRhbmd1bGFyLm1vZHVsZSgnYXBwLnJvdXRlcycpLnJ1bihmdW5jdGlvbigkcm9vdFNjb3BlLCAkbWRTaWRlbmF2KXtcblx0XHQkcm9vdFNjb3BlLiRvbihcIiRzdGF0ZUNoYW5nZVN0YXJ0XCIsIGZ1bmN0aW9uKGV2ZW50LCB0b1N0YXRlKXtcblxuXHRcdFx0aWYgKHRvU3RhdGUuZGF0YSAmJiB0b1N0YXRlLmRhdGEucGFnZU5hbWUpe1xuXHRcdFx0XHQkcm9vdFNjb3BlLmN1cnJlbnRfcGFnZSA9IHRvU3RhdGUuZGF0YS5wYWdlTmFtZTtcblx0XHRcdH1cblxuXG5cdFx0fSk7XG5cdFx0JHJvb3RTY29wZS4kb24oXCIkdmlld0NvbnRlbnRMb2FkZWRcIiwgZnVuY3Rpb24oZXZlbnQsIHRvU3RhdGUpe1xuXHRcdFx0d2luZG93LlByaXNtLmhpZ2hsaWdodEFsbCgpO1xuXHRcdH0pO1xuXG5cdFx0JHJvb3RTY29wZS4kb24oXCIkc3RhdGVDaGFuZ2VTdWNjZXNzXCIsIGZ1bmN0aW9uKGV2ZW50LCB0b1N0YXRlKXtcblx0XHRcdCRtZFNpZGVuYXYoJ2xlZnQnKS5jbG9zZSgpO1xuXHRcdH0pO1xuXHR9KTtcblxufSkoKTtcbiIsIihmdW5jdGlvbiAoKXtcbiAgICBcInVzZSBzdHJpY3RcIjtcblxuICAgIGFuZ3VsYXIubW9kdWxlKCdhcHAuY29uZmlnJykuY29uZmlnKGZ1bmN0aW9uICgkYXV0aFByb3ZpZGVyKXtcbiAgICAgICAgLy8gU2F0ZWxsaXplciBjb25maWd1cmF0aW9uIHRoYXQgc3BlY2lmaWVzIHdoaWNoIEFQSVxuICAgICAgICAvLyByb3V0ZSB0aGUgSldUIHNob3VsZCBiZSByZXRyaWV2ZWQgZnJvbVxuICAgICAgICAkYXV0aFByb3ZpZGVyLmxvZ2luVXJsID0gJy9hcGkvYXV0aGVudGljYXRlL2F1dGgnO1xuICAgIH0pO1xuXG59KSgpO1xuIiwiKGZ1bmN0aW9uICgpe1xuXHRcInVzZSBzdHJpY3RcIjtcblxuXHRhbmd1bGFyLm1vZHVsZSgnYXBwLmNvbmZpZycpLmNvbmZpZyhmdW5jdGlvbiAoY2ZwTG9hZGluZ0JhclByb3ZpZGVyKXtcblx0XHRjZnBMb2FkaW5nQmFyUHJvdmlkZXIuaW5jbHVkZVNwaW5uZXIgPSBmYWxzZTtcblx0fSk7XG5cbn0pKCk7XG4iLCIoZnVuY3Rpb24oKXtcblx0XCJ1c2Ugc3RyaWN0XCI7XG5cblx0YW5ndWxhci5tb2R1bGUoJ2FwcC5jb25maWcnKS5jb25maWcoIGZ1bmN0aW9uKFJlc3Rhbmd1bGFyUHJvdmlkZXIpIHtcblx0XHRSZXN0YW5ndWxhclByb3ZpZGVyXG5cdFx0LnNldEJhc2VVcmwoJy9hcGkvJylcblx0XHQuc2V0RGVmYXVsdEhlYWRlcnMoeyBhY2NlcHQ6IFwiYXBwbGljYXRpb24veC5sYXJhdmVsLnYxK2pzb25cIiB9KTtcblx0fSk7XG5cbn0pKCk7XG4iLCIoZnVuY3Rpb24oKXtcblx0XCJ1c2Ugc3RyaWN0XCI7XG5cblx0YW5ndWxhci5tb2R1bGUoJ2FwcC5jb25maWcnKS5jb25maWcoZnVuY3Rpb24oJG1kVGhlbWluZ1Byb3ZpZGVyKSB7XG5cdFx0LyogRm9yIG1vcmUgaW5mbywgdmlzaXQgaHR0cHM6Ly9tYXRlcmlhbC5hbmd1bGFyanMub3JnLyMvVGhlbWluZy8wMV9pbnRyb2R1Y3Rpb24gKi9cblx0XHQkbWRUaGVtaW5nUHJvdmlkZXIudGhlbWUoJ2RlZmF1bHQnKVxuXHRcdC5wcmltYXJ5UGFsZXR0ZSgnaW5kaWdvJylcblx0XHQuYWNjZW50UGFsZXR0ZSgnZ3JleScpXG5cdFx0Lndhcm5QYWxldHRlKCdyZWQnKTtcblx0fSk7XG5cbn0pKCk7XG4iLCIoZnVuY3Rpb24oKXtcblx0XCJ1c2Ugc3RyaWN0XCI7XG5cblx0YW5ndWxhci5tb2R1bGUoJ2FwcC5maWx0ZXJzJykuZmlsdGVyKCAnY2FwaXRhbGl6ZScsIGZ1bmN0aW9uKCl7XG5cdFx0cmV0dXJuIGZ1bmN0aW9uKGlucHV0LCBhbGwpIHtcblx0XHRcdHJldHVybiAoISFpbnB1dCkgPyBpbnB1dC5yZXBsYWNlKC8oW15cXFdfXStbXlxccy1dKikgKi9nLGZ1bmN0aW9uKHR4dCl7XG5cdFx0XHRcdHJldHVybiB0eHQuY2hhckF0KDApLnRvVXBwZXJDYXNlKCkgKyB0eHQuc3Vic3RyKDEpLnRvTG93ZXJDYXNlKCk7XG5cdFx0XHR9KSA6ICcnO1xuXHRcdH07XG5cdH0pO1xufSkoKTtcbiIsIihmdW5jdGlvbigpe1xuXHRcInVzZSBzdHJpY3RcIjtcblxuXHRhbmd1bGFyLm1vZHVsZSgnYXBwLmZpbHRlcnMnKS5maWx0ZXIoICdodW1hblJlYWRhYmxlJywgZnVuY3Rpb24oKXtcblx0XHRyZXR1cm4gZnVuY3Rpb24gaHVtYW5pemUoc3RyKSB7XG5cdFx0XHRpZiAoICFzdHIgKXtcblx0XHRcdFx0cmV0dXJuICcnO1xuXHRcdFx0fVxuXHRcdFx0dmFyIGZyYWdzID0gc3RyLnNwbGl0KCdfJyk7XG5cdFx0XHRmb3IgKHZhciBpPTA7IGk8ZnJhZ3MubGVuZ3RoOyBpKyspIHtcblx0XHRcdFx0ZnJhZ3NbaV0gPSBmcmFnc1tpXS5jaGFyQXQoMCkudG9VcHBlckNhc2UoKSArIGZyYWdzW2ldLnNsaWNlKDEpO1xuXHRcdFx0fVxuXHRcdFx0cmV0dXJuIGZyYWdzLmpvaW4oJyAnKTtcblx0XHR9O1xuXHR9KTtcbn0pKCk7IiwiKGZ1bmN0aW9uKCl7XG4gICAgJ3VzZSBzdHJpY3QnO1xuXG4gICAgYW5ndWxhci5tb2R1bGUoJ2FwcC5maWx0ZXJzJykuZmlsdGVyKCd0cnVuY2F0ZUNoYXJhY3RlcnMnLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgIHJldHVybiBmdW5jdGlvbiAoaW5wdXQsIGNoYXJzLCBicmVha09uV29yZCkge1xuICAgICAgICAgICAgaWYgKGlzTmFOKGNoYXJzKSkge1xuICAgICAgICAgICAgICAgIHJldHVybiBpbnB1dDtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICAgIGlmIChjaGFycyA8PSAwKSB7XG4gICAgICAgICAgICAgICAgcmV0dXJuICcnO1xuICAgICAgICAgICAgfVxuICAgICAgICAgICAgaWYgKGlucHV0ICYmIGlucHV0Lmxlbmd0aCA+IGNoYXJzKSB7XG4gICAgICAgICAgICAgICAgaW5wdXQgPSBpbnB1dC5zdWJzdHJpbmcoMCwgY2hhcnMpO1xuXG4gICAgICAgICAgICAgICAgaWYgKCFicmVha09uV29yZCkge1xuICAgICAgICAgICAgICAgICAgICB2YXIgbGFzdHNwYWNlID0gaW5wdXQubGFzdEluZGV4T2YoJyAnKTtcbiAgICAgICAgICAgICAgICAgICAgLy8gR2V0IGxhc3Qgc3BhY2VcbiAgICAgICAgICAgICAgICAgICAgaWYgKGxhc3RzcGFjZSAhPT0gLTEpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIGlucHV0ID0gaW5wdXQuc3Vic3RyKDAsIGxhc3RzcGFjZSk7XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgICAgICB3aGlsZSAoaW5wdXQuY2hhckF0KGlucHV0Lmxlbmd0aC0xKSA9PT0gJyAnKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBpbnB1dCA9IGlucHV0LnN1YnN0cigwLCBpbnB1dC5sZW5ndGggLSAxKTtcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICByZXR1cm4gaW5wdXQgKyAnLi4uJztcbiAgICAgICAgICAgIH1cbiAgICAgICAgICAgIHJldHVybiBpbnB1dDtcbiAgICAgICAgfTtcbiAgICB9KTtcbn0pKCk7IiwiKGZ1bmN0aW9uKCl7XG4gICAgJ3VzZSBzdHJpY3QnO1xuXG4gICAgYW5ndWxhci5tb2R1bGUoJ2FwcC5maWx0ZXJzJykuZmlsdGVyKCd0cnVuY2F0ZVdvcmRzJywgZnVuY3Rpb24gKCkge1xuICAgICAgICByZXR1cm4gZnVuY3Rpb24gKGlucHV0LCB3b3Jkcykge1xuICAgICAgICAgICAgaWYgKGlzTmFOKHdvcmRzKSkge1xuICAgICAgICAgICAgICAgIHJldHVybiBpbnB1dDtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICAgIGlmICh3b3JkcyA8PSAwKSB7XG4gICAgICAgICAgICAgICAgcmV0dXJuICcnO1xuICAgICAgICAgICAgfVxuICAgICAgICAgICAgaWYgKGlucHV0KSB7XG4gICAgICAgICAgICAgICAgdmFyIGlucHV0V29yZHMgPSBpbnB1dC5zcGxpdCgvXFxzKy8pO1xuICAgICAgICAgICAgICAgIGlmIChpbnB1dFdvcmRzLmxlbmd0aCA+IHdvcmRzKSB7XG4gICAgICAgICAgICAgICAgICAgIGlucHV0ID0gaW5wdXRXb3Jkcy5zbGljZSgwLCB3b3Jkcykuam9pbignICcpICsgJy4uLic7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfVxuICAgICAgICAgICAgcmV0dXJuIGlucHV0O1xuICAgICAgICB9O1xuICAgIH0pO1xufSkoKTsiLCIoZnVuY3Rpb24oKXtcblx0XCJ1c2Ugc3RyaWN0XCI7XG5cblx0YW5ndWxhci5tb2R1bGUoJ2FwcC5maWx0ZXJzJykuZmlsdGVyKCAndHJ1c3RIdG1sJywgZnVuY3Rpb24oICRzY2UgKXtcblx0XHRyZXR1cm4gZnVuY3Rpb24oIGh0bWwgKXtcblx0XHRcdHJldHVybiAkc2NlLnRydXN0QXNIdG1sKGh0bWwpO1xuXHRcdH07XG5cdH0pO1xufSkoKTsiLCIoZnVuY3Rpb24oKXtcblx0XCJ1c2Ugc3RyaWN0XCI7XG5cblx0YW5ndWxhci5tb2R1bGUoJ2FwcC5maWx0ZXJzJykuZmlsdGVyKCd1Y2ZpcnN0JywgZnVuY3Rpb24oKSB7XG5cdFx0cmV0dXJuIGZ1bmN0aW9uKCBpbnB1dCApIHtcblx0XHRcdGlmICggIWlucHV0ICl7XG5cdFx0XHRcdHJldHVybiBudWxsO1xuXHRcdFx0fVxuXHRcdFx0cmV0dXJuIGlucHV0LnN1YnN0cmluZygwLCAxKS50b1VwcGVyQ2FzZSgpICsgaW5wdXQuc3Vic3RyaW5nKDEpO1xuXHRcdH07XG5cdH0pO1xuXG59KSgpO1xuIiwiKGZ1bmN0aW9uKCl7XG5cdFwidXNlIHN0cmljdFwiO1xuXG5cdGFuZ3VsYXIubW9kdWxlKFwiYXBwLnNlcnZpY2VzXCIpLmZhY3RvcnkoJ0RpYWxvZ1NlcnZpY2UnLCBmdW5jdGlvbigkbWREaWFsb2cpe1xuXG5cdFx0cmV0dXJuIHtcblx0XHRcdGZyb21UZW1wbGF0ZTogZnVuY3Rpb24odGVtcGxhdGUsICRzY29wZSl7XG5cblx0XHRcdFx0dmFyIG9wdGlvbnMgPSB7XG5cdFx0XHRcdFx0dGVtcGxhdGVVcmw6ICcuL3ZpZXdzL2RpYWxvZ3MvJyArIHRlbXBsYXRlICsgJy8nICsgdGVtcGxhdGUgKyAnLmh0bWwnXG5cdFx0XHRcdH07XG5cblx0XHRcdFx0aWYgKCRzY29wZSl7XG5cdFx0XHRcdFx0b3B0aW9ucy5zY29wZSA9ICRzY29wZS4kbmV3KCk7XG5cdFx0XHRcdH1cblxuXHRcdFx0XHRyZXR1cm4gJG1kRGlhbG9nLnNob3cob3B0aW9ucyk7XG5cdFx0XHR9LFxuXG5cdFx0XHRoaWRlOiBmdW5jdGlvbigpe1xuXHRcdFx0XHRyZXR1cm4gJG1kRGlhbG9nLmhpZGUoKTtcblx0XHRcdH0sXG5cblx0XHRcdGFsZXJ0OiBmdW5jdGlvbih0aXRsZSwgY29udGVudCl7XG5cdFx0XHRcdCRtZERpYWxvZy5zaG93KFxuXHRcdFx0XHRcdCRtZERpYWxvZy5hbGVydCgpXG5cdFx0XHRcdFx0XHQudGl0bGUodGl0bGUpXG5cdFx0XHRcdFx0XHQuY29udGVudChjb250ZW50KVxuXHRcdFx0XHRcdFx0Lm9rKCdPaycpXG5cdFx0XHRcdCk7XG5cdFx0XHR9XG5cdFx0fTtcblx0fSk7XG59KSgpOyIsIihmdW5jdGlvbigpe1xuXHRcInVzZSBzdHJpY3RcIjtcblxuXHRhbmd1bGFyLm1vZHVsZShcImFwcC5zZXJ2aWNlc1wiKS5mYWN0b3J5KCdUb2FzdFNlcnZpY2UnLCBmdW5jdGlvbigkbWRUb2FzdCl7XG5cblx0XHR2YXIgZGVsYXkgPSA2MDAwLFxuXHRcdFx0cG9zaXRpb24gPSAndG9wIHJpZ2h0Jyxcblx0XHRcdGFjdGlvbiA9ICdPSyc7XG5cblx0XHRyZXR1cm4ge1xuXHRcdFx0c2hvdzogZnVuY3Rpb24oY29udGVudCl7XG5cdFx0XHRcdGlmICghY29udGVudCl7XG5cdFx0XHRcdFx0cmV0dXJuIGZhbHNlO1xuXHRcdFx0XHR9XG5cblx0XHRcdFx0cmV0dXJuICRtZFRvYXN0LnNob3coXG5cdFx0XHRcdFx0JG1kVG9hc3Quc2ltcGxlKClcblx0XHRcdFx0XHRcdC5jb250ZW50KGNvbnRlbnQpXG5cdFx0XHRcdFx0XHQucG9zaXRpb24ocG9zaXRpb24pXG5cdFx0XHRcdFx0XHQuYWN0aW9uKGFjdGlvbilcblx0XHRcdFx0XHRcdC5oaWRlRGVsYXkoZGVsYXkpXG5cdFx0XHRcdCk7XG5cdFx0XHR9LFxuXHRcdFx0ZXJyb3I6IGZ1bmN0aW9uKGNvbnRlbnQpe1xuXHRcdFx0XHRpZiAoIWNvbnRlbnQpe1xuXHRcdFx0XHRcdHJldHVybiBmYWxzZTtcblx0XHRcdFx0fVxuXG5cdFx0XHRcdHJldHVybiAkbWRUb2FzdC5zaG93KFxuXHRcdFx0XHRcdCRtZFRvYXN0LnNpbXBsZSgpXG5cdFx0XHRcdFx0XHQuY29udGVudChjb250ZW50KVxuXHRcdFx0XHRcdFx0LnBvc2l0aW9uKHBvc2l0aW9uKVxuXHRcdFx0XHRcdFx0LnRoZW1lKCd3YXJuJylcblx0XHRcdFx0XHRcdC5hY3Rpb24oYWN0aW9uKVxuXHRcdFx0XHRcdFx0LmhpZGVEZWxheShkZWxheSlcblx0XHRcdFx0KTtcblx0XHRcdH1cblx0XHR9O1xuXHR9KTtcbn0pKCk7IiwiKGZ1bmN0aW9uICgpIHtcbiAgICBcInVzZSBzdHJpY3RcIjtcblxuICAgIGFuZ3VsYXIubW9kdWxlKCdhcHAuY29udHJvbGxlcnMnKS5jb250cm9sbGVyKCdBdXRoTG9naW5DdHJsJywgZnVuY3Rpb24gKCRzY29wZSwgJGh0dHAsICRtZFRvYXN0LCAkbG9jYWxTdG9yYWdlKSB7XG5cbiAgICAgICAgLy8gbm90aWZpY2F0aW9uIHRvYXN0XG4gICAgICAgICRzY29wZS5vcGVuVG9hc3QgPSBmdW5jdGlvbiAobWVzc2FnZSkge1xuICAgICAgICAgICAgaWYgKG1lc3NhZ2UgIT0gJycgJiYgbWVzc2FnZSAhPSBudWxsKSB7XG4gICAgICAgICAgICAgICAgJG1kVG9hc3Quc2hvdygkbWRUb2FzdC5zaW1wbGUoKVxuICAgICAgICAgICAgICAgICAgICAgICAgLmNvbnRlbnQobWVzc2FnZSlcbiAgICAgICAgICAgICAgICAgICAgICAgIC8vLnBvc2l0aW9uKCd0b3AgcmlnaHQnKVxuICAgICAgICAgICAgICAgICAgICAgICAgLnBvc2l0aW9uKCdib3R0b20gcmlnaHQnKVxuICAgICAgICAgICAgICAgICAgICAgICAgLmhpZGVEZWxheSg2MDAwKVxuICAgICAgICAgICAgICAgICk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH07XG5cbiAgICAgICAgLy8gdmFyaWFibGUgZGF0YVxuICAgICAgICAkc2NvcGUuZGF0YSA9IHtcbiAgICAgICAgICAgIGFwaTogJy9hcGkvYXV0aC9sb2dpbicsXG4gICAgICAgICAgICBpbnB1dDogJHNjb3BlLmlucHV0XG4gICAgICAgIH07XG5cbiAgICAgICAgLy8gdmFyaWFibGUgcmVzdWx0XG4gICAgICAgICRzY29wZS5yZXN1bHQgPSB7XG4gICAgICAgICAgICBzdWNjZXNzOiBmYWxzZSxcbiAgICAgICAgICAgIG1zZzogJycsXG4gICAgICAgICAgICBzdGF0dXM6ICcnXG4gICAgICAgIH07XG5cbiAgICAgICAgLy8gcG9zdCBsb2dpblxuICAgICAgICAkc2NvcGUuc3VibWl0RGF0YSA9IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICRodHRwLnBvc3QoJHNjb3BlLmRhdGEuYXBpLCAkc2NvcGUuZGF0YS5pbnB1dCxcbiAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgIGhlYWRlcnM6IHtcbiAgICAgICAgICAgICAgICAgICAgICAgICdDb250ZW50LVR5cGUnOiAnYXBwbGljYXRpb24vanNvbicsXG4gICAgICAgICAgICAgICAgICAgICAgICAnWC1SZXF1ZXN0ZWQtV2l0aCc6ICdYTUxIdHRwUmVxdWVzdCdcbiAgICAgICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgfSkuc3VjY2VzcyhmdW5jdGlvbiAocmVzcG9uc2UpIHtcbiAgICAgICAgICAgICAgICAgICAgLy8gc2V0IHJlc3BvbnNlIHN1Y2Nlc3MgaW4gcmVzdWx0XG4gICAgICAgICAgICAgICAgICAgIHNldFN1Y2Nlc3NSZXNwb25zZShyZXNwb25zZS5tZXNzYWdlcy5tc2cpO1xuXG4gICAgICAgICAgICAgICAgICAgIC8vIHNhdmUgdG9rZW4gdG8gbG9jYWwgc3RvcmFnZVxuICAgICAgICAgICAgICAgICAgICBzYXZlVG9rZW4ocmVzcG9uc2UubWVzc2FnZXMudG9rZW4pO1xuXG4gICAgICAgICAgICAgICAgfSkuZXJyb3IoZnVuY3Rpb24gKHJlc3BvbnNlLCBzdGF0dXMpIHtcbiAgICAgICAgICAgICAgICAgICAgLy8gc2V0IHJlc3BvbnNlIGVycm9yIGluIHJlc3VsdFxuICAgICAgICAgICAgICAgICAgICBzZXRFcnJvclJlc3BvbnNlKHJlc3BvbnNlLCBzdGF0dXMpO1xuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICB9O1xuXG4gICAgICAgIC8vIHNhdmUgdG9rZW4gdG8gbG9jYWwgc3RvcmFnZVxuICAgICAgICBmdW5jdGlvbiBzYXZlVG9rZW4odG9rZW4pIHtcbiAgICAgICAgICAgICRsb2NhbFN0b3JhZ2UudG9rZW4gPSB0b2tlbjtcbiAgICAgICAgfVxuXG4gICAgICAgIC8vIGxvYWQgdG9rZW4gaW4gbG9jYWwgc3RvcmFnZVxuICAgICAgICAkc2NvcGUuZ2V0VG9rZW4gPSBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAkc2NvcGUudG9rZW4gPSAkbG9jYWxTdG9yYWdlLnRva2VuO1xuICAgICAgICB9O1xuXG4gICAgICAgIC8vIHNldCBzdWNjZXNzIHJlc3VsdCBmcm9tIG1ldGhvZFxuICAgICAgICBmdW5jdGlvbiBzZXRTdWNjZXNzUmVzcG9uc2UobWVzc2FnZSkge1xuICAgICAgICAgICAgJHNjb3BlLnJlc3VsdC5zdWNjZXNzID0gdHJ1ZTtcbiAgICAgICAgICAgICRzY29wZS5yZXN1bHQubXNnID0gbWVzc2FnZTtcbiAgICAgICAgfVxuXG4gICAgICAgIC8vIHNldCBlcnJvciByZXN1bHQgZnJvbSBtZXRob2RcbiAgICAgICAgZnVuY3Rpb24gc2V0RXJyb3JSZXNwb25zZShyZXNwb25zZSwgc3RhdHVzKSB7XG4gICAgICAgICAgICAkc2NvcGUucmVzdWx0LnN1Y2Nlc3MgPSBmYWxzZTtcbiAgICAgICAgICAgICRzY29wZS5yZXN1bHQuc3RhdHVzID0gc3RhdHVzO1xuXG4gICAgICAgICAgICAvLyBpZiBlcnJvciBhYm91dCB2YWxpZGF0aW9uXG4gICAgICAgICAgICB2YXIgdmFsaWRhdGUgPSByZXNwb25zZS52YWxpZGF0aW9uO1xuICAgICAgICAgICAgdmFyIG1lc3NhZ2UgPSByZXNwb25zZS5tZXNzYWdlcztcbiAgICAgICAgICAgIGlmICh2YWxpZGF0ZSkge1xuICAgICAgICAgICAgICAgIC8vIG1lc3NhZ2UgdmFsaWRhdGlvblxuICAgICAgICAgICAgICAgICRzY29wZS5vcGVuVG9hc3QodmFsaWRhdGUuZW1haWwgKyBcIiwgXCIgKyB2YWxpZGF0ZS5wYXNzd29yZCk7XG5cbiAgICAgICAgICAgIH0gZWxzZSBpZiAobWVzc2FnZSkge1xuICAgICAgICAgICAgICAgIC8vIG90aGVyIG1lc3NhZ2VcbiAgICAgICAgICAgICAgICB2YXIgbXNnID0gcmVzcG9uc2UubWVzc2FnZXMubXNnO1xuICAgICAgICAgICAgICAgICRzY29wZS5yZXN1bHQubXNnID0gbXNnO1xuXG4gICAgICAgICAgICAgICAgLy8gc2V0IG5vdGlmeVxuICAgICAgICAgICAgICAgICRzY29wZS5vcGVuVG9hc3QobXNnKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgIH0pO1xuXG59KSgpO1xuIiwiKGZ1bmN0aW9uICgpIHtcbiAgICBcInVzZSBzdHJpY3RcIjtcblxuICAgIGFuZ3VsYXIubW9kdWxlKCdhcHAuY29udHJvbGxlcnMnKS5jb250cm9sbGVyKCdCdWt1Q3RybCcsIGZ1bmN0aW9uICgkc2NvcGUpIHtcbiAgICAgICAgJHNjb3BlLlByb0ltYWdlID0gJ2h0dHBzOi8vaS5pbWd1ci5jb20vWmJMek9QUC5qcGcnO1xuXG4gICAgICAgIC8vJG1kSWNvblByb3ZpZGVyLmljb25TZXQoJ2NvbW11bmljYXRpb24nLCAnaHR0cHM6Ly9tYXRlcmlhbC5hbmd1bGFyanMub3JnLzEuMC4wLXJjMi9pbWcvaWNvbnMvc2V0cy9jb21tdW5pY2F0aW9uLWljb25zLnN2ZycsIDI0KTtcblxuICAgICAgICB2YXIgaW1hZ2VQYXRoID0gJ2h0dHBzOi8vbWF0ZXJpYWwuYW5ndWxhcmpzLm9yZy8xLjAuMC1yYzIvaW1nL2xpc3QvNjAuanBlZyc7XG4gICAgICAgICRzY29wZS5waG9uZXMgPSBbXG4gICAgICAgICAgICB7dHlwZTogJ0hvbWUnLCBudW1iZXI6ICcoNTU1KSAyNTEtMTIzNCd9LFxuICAgICAgICAgICAge3R5cGU6ICdDZWxsJywgbnVtYmVyOiAnKDU1NSkgNzg2LTk4NDEnfSxcbiAgICAgICAgICAgIHt0eXBlOiAnT2ZmaWNlJywgbnVtYmVyOiAnKDU1NSkgMzE0LTE1OTInfVxuICAgICAgICBdO1xuICAgICAgICAkc2NvcGUudG9kb3MgPSBbXG4gICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgZmFjZTogaW1hZ2VQYXRoLFxuICAgICAgICAgICAgICAgIHdoYXQ6ICdCcnVuY2ggdGhpcyB3ZWVrZW5kPycsXG4gICAgICAgICAgICAgICAgd2hvOiAnTWluIExpIENoYW4nLFxuICAgICAgICAgICAgICAgIHdoZW46ICczOjA4UE0nLFxuICAgICAgICAgICAgICAgIG5vdGVzOiBcIiBJJ2xsIGJlIGluIHlvdXIgbmVpZ2hib3Job29kIGRvaW5nIGVycmFuZHNcIlxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICBmYWNlOiBpbWFnZVBhdGgsXG4gICAgICAgICAgICAgICAgd2hhdDogJ0JydW5jaCB0aGlzIHdlZWtlbmQ/JyxcbiAgICAgICAgICAgICAgICB3aG86ICdNaW4gTGkgQ2hhbicsXG4gICAgICAgICAgICAgICAgd2hlbjogJzM6MDhQTScsXG4gICAgICAgICAgICAgICAgbm90ZXM6IFwiIEknbGwgYmUgaW4geW91ciBuZWlnaGJvcmhvb2QgZG9pbmcgZXJyYW5kc1wiXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgIGZhY2U6IGltYWdlUGF0aCxcbiAgICAgICAgICAgICAgICB3aGF0OiAnQnJ1bmNoIHRoaXMgd2Vla2VuZD8nLFxuICAgICAgICAgICAgICAgIHdobzogJ01pbiBMaSBDaGFuJyxcbiAgICAgICAgICAgICAgICB3aGVuOiAnMzowOFBNJyxcbiAgICAgICAgICAgICAgICBub3RlczogXCIgSSdsbCBiZSBpbiB5b3VyIG5laWdoYm9yaG9vZCBkb2luZyBlcnJhbmRzXCJcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgZmFjZTogaW1hZ2VQYXRoLFxuICAgICAgICAgICAgICAgIHdoYXQ6ICdCcnVuY2ggdGhpcyB3ZWVrZW5kPycsXG4gICAgICAgICAgICAgICAgd2hvOiAnTWluIExpIENoYW4nLFxuICAgICAgICAgICAgICAgIHdoZW46ICczOjA4UE0nLFxuICAgICAgICAgICAgICAgIG5vdGVzOiBcIiBJJ2xsIGJlIGluIHlvdXIgbmVpZ2hib3Job29kIGRvaW5nIGVycmFuZHNcIlxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICBmYWNlOiBpbWFnZVBhdGgsXG4gICAgICAgICAgICAgICAgd2hhdDogJ0JydW5jaCB0aGlzIHdlZWtlbmQ/JyxcbiAgICAgICAgICAgICAgICB3aG86ICdNaW4gTGkgQ2hhbicsXG4gICAgICAgICAgICAgICAgd2hlbjogJzM6MDhQTScsXG4gICAgICAgICAgICAgICAgbm90ZXM6IFwiIEknbGwgYmUgaW4geW91ciBuZWlnaGJvcmhvb2QgZG9pbmcgZXJyYW5kc1wiXG4gICAgICAgICAgICB9XG4gICAgICAgIF07XG4gICAgfSk7XG5cbn0pKCk7XG4iLCIoZnVuY3Rpb24oKXtcblx0XCJ1c2Ugc3RyaWN0XCI7XG5cblx0YW5ndWxhci5tb2R1bGUoJ2FwcC5jb250cm9sbGVycycpLmNvbnRyb2xsZXIoJ0RpYWxvZ3NDdHJsJywgZnVuY3Rpb24oJHNjb3BlLCBEaWFsb2dTZXJ2aWNlKXtcblx0XHQkc2NvcGUuYWxlcnREaWFsb2cgPSBmdW5jdGlvbigpe1xuXHRcdFx0RGlhbG9nU2VydmljZS5hbGVydCgnVGhpcyBpcyBhbiBhbGVydCB0aXRsZScsICdZb3UgY2FuIHNwZWNpZnkgc29tZSBkZXNjcmlwdGlvbiB0ZXh0IGluIGhlcmUuJyk7XG5cdFx0fTtcblxuXHRcdCRzY29wZS5jdXN0b21EaWFsb2cgPSBmdW5jdGlvbigpe1xuXHRcdFx0RGlhbG9nU2VydmljZS5mcm9tVGVtcGxhdGUoJ2FkZF91c2VycycsICRzY29wZSk7XG5cdFx0fTtcblx0fSk7XG5cbn0pKCk7XG4iLCIoZnVuY3Rpb24oKXtcbiAgICBcInVzZSBzdHJpY3RcIjtcblxuICAgIGFuZ3VsYXIubW9kdWxlKCdhcHAuY29udHJvbGxlcnMnKS5jb250cm9sbGVyKCdFbGl4aXJDdHJsJywgZnVuY3Rpb24oKXtcbiAgICAgICAgLy9cbiAgICB9KTtcblxufSkoKTtcbiIsIihmdW5jdGlvbigpe1xuICAgIFwidXNlIHN0cmljdFwiO1xuXG4gICAgYW5ndWxhci5tb2R1bGUoJ2FwcC5jb250cm9sbGVycycpLmNvbnRyb2xsZXIoJ0Zhdm9yaXRlQ3RybCcsIGZ1bmN0aW9uKCl7XG4gICAgICAgIC8vXG4gICAgfSk7XG5cbn0pKCk7XG4iLCIoZnVuY3Rpb24oKXtcbiAgICBcInVzZSBzdHJpY3RcIjtcblxuICAgIGFuZ3VsYXIubW9kdWxlKCdhcHAuY29udHJvbGxlcnMnKS5jb250cm9sbGVyKCdHZW5lcmF0b3JzQ3RybCcsIGZ1bmN0aW9uKCl7XG4gICAgICAgIC8vXG4gICAgfSk7XG5cbn0pKCk7XG4iLCIoZnVuY3Rpb24gKCkge1xuICAgIFwidXNlIHN0cmljdFwiO1xuXG4gICAgYW5ndWxhci5tb2R1bGUoJ2FwcC5jb250cm9sbGVycycpLmNvbnRyb2xsZXIoJ0hlYWRlckN0cmwnLCBmdW5jdGlvbiAoJHNjb3BlLCAkcm9vdFNjb3BlLCAkbWRTaWRlbmF2LCAkbG9nLCBEaWFsb2dTZXJ2aWNlKSB7XG5cbiAgICAgICAgJHNjb3BlLiR3YXRjaChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICByZXR1cm4gJHJvb3RTY29wZS5jdXJyZW50X3BhZ2U7XG4gICAgICAgIH0sIGZ1bmN0aW9uIChuZXdQYWdlKSB7XG4gICAgICAgICAgICAkc2NvcGUuY3VycmVudF9wYWdlID0gbmV3UGFnZSB8fCAnUGFnZSBOYW1lJztcbiAgICAgICAgfSk7XG5cbiAgICAgICAgJHNjb3BlLm9wZW5TaWRlTmF2ID0gZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgJG1kU2lkZW5hdignbGVmdCcpLm9wZW4oKTtcbiAgICAgICAgfTtcblxuICAgICAgICAvLyBvcGVuIGxvZ2luIGRpYWxvZ1xuICAgICAgICAkc2NvcGUub3BlbkxvZ2luID0gZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgRGlhbG9nU2VydmljZS5mcm9tVGVtcGxhdGUoJ2xvZ2luJywgJHNjb3BlKTtcbiAgICAgICAgfTtcblxuICAgIH0pO1xuXG59KSgpOyIsIihmdW5jdGlvbigpe1xuICAgIFwidXNlIHN0cmljdFwiO1xuXG4gICAgYW5ndWxhci5tb2R1bGUoJ2FwcC5jb250cm9sbGVycycpLmNvbnRyb2xsZXIoJ0hlYWRlclRvcEN0cmwnLCBmdW5jdGlvbigpe1xuICAgICAgICAvL1xuICAgIH0pO1xuXG59KSgpO1xuIiwiKGZ1bmN0aW9uKCl7XG5cdFwidXNlIHN0cmljdFwiO1xuXG5cdGFuZ3VsYXIubW9kdWxlKCdhcHAuY29udHJvbGxlcnMnKS5jb250cm9sbGVyKCdKd3RBdXRoQ3RybCcsIGZ1bmN0aW9uKCRzY29wZSwgJGF1dGgsIFJlc3Rhbmd1bGFyKXtcblxuXHRcdHZhciBjcmVkZW50aWFscyA9IHt9O1xuXG5cdFx0JHNjb3BlLnJlcXVlc3RUb2tlbiA9IGZ1bmN0aW9uKCl7XG5cdFx0XHQvLyBVc2UgU2F0ZWxsaXplcidzICRhdXRoIHNlcnZpY2UgdG8gbG9naW4gYmVjYXVzZSBpdCdsbCBhdXRvbWF0aWNhbGx5IHNhdmUgdGhlIEpXVCBpbiBsb2NhbFN0b3JhZ2Vcblx0XHRcdCRhdXRoLmxvZ2luKGNyZWRlbnRpYWxzKS50aGVuKGZ1bmN0aW9uIChkYXRhKXtcblx0XHRcdFx0Ly8gSWYgbG9naW4gaXMgc3VjY2Vzc2Z1bCwgcmVkaXJlY3QgdG8gdGhlIHVzZXJzIHN0YXRlXG5cdFx0XHRcdC8vJHN0YXRlLmdvKCdkYXNoYm9hcmQnKTtcblx0XHRcdH0pO1xuXHRcdH07XG5cblx0XHQvLyBUaGlzIHJlcXVlc3Qgd2lsbCBoaXQgdGhlIGdldERhdGEgbWV0aG9kIGluIHRoZSBBdXRoZW50aWNhdGVDb250cm9sbGVyXG5cdFx0Ly8gb24gdGhlIExhcmF2ZWwgc2lkZSBhbmQgd2lsbCByZXR1cm4geW91ciBkYXRhIHRoYXQgcmVxdWlyZSBhdXRoZW50aWNhdGlvblxuXHRcdCRzY29wZS5nZXREYXRhID0gZnVuY3Rpb24oKXtcblx0XHRcdFJlc3Rhbmd1bGFyLmFsbCgnYXV0aGVudGljYXRlL2RhdGEnKS5nZXQoKS50aGVuKGZ1bmN0aW9uIChyZXNwb25zZSl7XG5cblx0XHRcdH0sIGZ1bmN0aW9uIChlcnJvcil7fSk7XG5cdFx0fTtcblxuXG5cblx0fSk7XG5cbn0pKCk7XG4iLCIoZnVuY3Rpb24oKXtcblx0XCJ1c2Ugc3RyaWN0XCI7XG5cblx0YW5ndWxhci5tb2R1bGUoJ2FwcC5jb250cm9sbGVycycpLmNvbnRyb2xsZXIoJ0xhbmRpbmdDdHJsJywgZnVuY3Rpb24oJHNjb3BlLCAkbWRUb2FzdCwgJG1kRGlhbG9nLCAkaW50ZXJ2YWwsIFRvYXN0U2VydmljZSwgRGlhbG9nU2VydmljZSl7XG5cblx0XHQkc2NvcGUucHJvbW9JbWFnZSA9ICdodHRwczovL2kuaW1ndXIuY29tL1piTHpPUFAuanBnJztcblx0XHQkc2NvcGUuaWNvbiA9ICdzZW5kJztcblxuXHRcdHZhciBpY29ucyA9IFtcblx0XHRcdFx0J29mZmljZScsICdmYWNlYm9vaycsICd0d2l0dGVyJywgJ2FwcGxlJywgJ3doYXRzYXBwJywgJ2xpbmtlZGluJywgJ3dpbmRvd3MnLCAnYWNjZXNzaWJpbGl0eScsICdhbGFybScsICdhc3BlY3RfcmF0aW8nLFxuXHRcdFx0XHQnYXV0b3JlbmV3JywgJ2Jvb2ttYXJrX291dGxpbmUnLCAnZGFzaGJvYXJkJywgJ2RucycsICdmYXZvcml0ZV9vdXRsaW5lJywgJ2dldF9hcHAnLCAnaGlnaGxpZ2h0X3JlbW92ZScsICdoaXN0b3J5JywgJ2xpc3QnLFxuXHRcdFx0XHQncGljdHVyZV9pbl9waWN0dXJlJywgJ3ByaW50JywgJ3NldHRpbmdzX2V0aGVybmV0JywgJ3NldHRpbmdzX3Bvd2VyJywgJ3Nob3BwaW5nX2NhcnQnLCAnc3BlbGxjaGVjaycsICdzd2FwX2hvcml6JywgJ3N3YXBfdmVydCcsXG5cdFx0XHRcdCd0aHVtYl91cCcsICd0aHVtYnNfdXBfZG93bicsICd0cmFuc2xhdGUnLCAndHJlbmRpbmdfdXAnLCAndmlzaWJpbGl0eScsICd3YXJuaW5nJywgJ21pYycsICdwbGF5X2NpcmNsZV9vdXRsaW5lJywgJ3JlcGVhdCcsXG5cdFx0XHRcdCdza2lwX25leHQnLCAnY2FsbCcsICdjaGF0JywgJ2NsZWFyX2FsbCcsICdkaWFscGFkJywgJ2RuZF9vbicsICdmb3J1bScsICdsb2NhdGlvbl9vbicsICd2cG5fa2V5JywgJ2ZpbHRlcl9saXN0JywgJ2luYm94Jyxcblx0XHRcdFx0J2xpbmsnLCAncmVtb3ZlX2NpcmNsZV9vdXRsaW5lJywgJ3NhdmUnLCAndGV4dF9mb3JtYXQnLCAnYWNjZXNzX3RpbWUnLCAnYWlycGxhbmVtb2RlX29uJywgJ2JsdWV0b290aCcsICdkYXRhX3VzYWdlJyxcblx0XHRcdFx0J2dwc19maXhlZCcsICdub3dfd2FsbHBhcGVyJywgJ25vd193aWRnZXRzJywgJ3N0b3JhZ2UnLCAnd2lmaV90ZXRoZXJpbmcnLCAnYXR0YWNoX2ZpbGUnLCAnZm9ybWF0X2xpbmVfc3BhY2luZycsXG5cdFx0XHRcdCdmb3JtYXRfbGlzdF9udW1iZXJlZCcsICdmb3JtYXRfcXVvdGUnLCAndmVydGljYWxfYWxpZ25fY2VudGVyJywgJ3dyYXBfdGV4dCcsICdjbG91ZF9xdWV1ZScsICdmaWxlX2Rvd25sb2FkJywgJ2ZvbGRlcl9vcGVuJyxcblx0XHRcdFx0J2Nhc3QnLCAnaGVhZHNldCcsICdrZXlib2FyZF9iYWNrc3BhY2UnLCAnbW91c2UnLCAnc3BlYWtlcicsICd3YXRjaCcsICdhdWRpb3RyYWNrJywgJ2VkaXQnLCAnYnJ1c2gnLCAnbG9va3MnLCAnY3JvcF9mcmVlJyxcblx0XHRcdFx0J2NhbWVyYScsICdmaWx0ZXJfdmludGFnZScsICdoZHJfc3Ryb25nJywgJ3Bob3RvX2NhbWVyYScsICdzbGlkZXNob3cnLCAndGltZXInLCAnZGlyZWN0aW9uc19iaWtlJywgJ2hvdGVsJywgJ2xvY2FsX2xpYnJhcnknLFxuXHRcdFx0XHQnZGlyZWN0aW9uc193YWxrJywgJ2xvY2FsX2NhZmUnLCAnbG9jYWxfcGl6emEnLCAnbG9jYWxfZmxvcmlzdCcsICdteV9sb2NhdGlvbicsICduYXZpZ2F0aW9uJywgJ3Bpbl9kcm9wJywgJ2Fycm93X2JhY2snLCAnbWVudScsXG5cdFx0XHRcdCdjbG9zZScsICdtb3JlX2hvcml6JywgJ21vcmVfdmVydCcsICdyZWZyZXNoJywgJ3Bob25lX3BhdXNlZCcsICd2aWJyYXRpb24nLCAnY2FrZScsICdncm91cCcsICdtb29kJywgJ3BlcnNvbicsXG5cdFx0XHRcdCdub3RpZmljYXRpb25zX25vbmUnLCAncGx1c19vbmUnLCAnc2Nob29sJywgJ3NoYXJlJywgJ3N0YXJfb3V0bGluZSdcblx0XHRcdF0sXG5cdFx0XHRjb3VudGVyID0gMDtcblxuXHRcdCRpbnRlcnZhbChmdW5jdGlvbigpe1xuXHRcdFx0JHNjb3BlLmljb24gPSBpY29uc1srK2NvdW50ZXJdO1xuXHRcdFx0aWYgKGNvdW50ZXIgPiAxMTIpe1xuXHRcdFx0XHRjb3VudGVyID0gMDtcblx0XHRcdH1cblx0XHR9LCAyMDAwKTtcblxuXHR9KTtcblxufSkoKTtcbiIsIihmdW5jdGlvbiAoKXtcbiAgICBcInVzZSBzdHJpY3RcIjtcblxuICAgIGFuZ3VsYXIubW9kdWxlKCdhcHAuY29udHJvbGxlcnMnKS5jb250cm9sbGVyKCdMb2dpbkN0cmwnLCBmdW5jdGlvbiAoKXtcblxuICAgIH0pO1xuXG59KSgpO1xuIiwiKGZ1bmN0aW9uKCl7XG4gICAgXCJ1c2Ugc3RyaWN0XCI7XG5cbiAgICBhbmd1bGFyLm1vZHVsZSgnYXBwLmNvbnRyb2xsZXJzJykuY29udHJvbGxlcignTWlzY0N0cmwnLCBmdW5jdGlvbigpe1xuICAgICAgICAvL1xuICAgIH0pO1xuXG59KSgpO1xuIiwiKGZ1bmN0aW9uICgpIHtcbiAgICBcInVzZSBzdHJpY3RcIjtcblxuICAgIGFuZ3VsYXIubW9kdWxlKCdhcHAuY29udHJvbGxlcnMnKS5jb250cm9sbGVyKCdQZW5lcmJpdEN0cmwnLCBmdW5jdGlvbiAoJHNjb3BlLCAkaHR0cCkge1xuXG4gICAgICAgIC8vIEluaXRpYWwgdmFyaWFibGVcbiAgICAgICAgJHNjb3BlLnJlc3VsdCA9ICcnO1xuXG4gICAgICAgIC8vIHBvc3RcbiAgICAgICAgJHNjb3BlLnN1Ym1pdERhdGEgPSBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAkaHR0cC5wb3N0KCcvYXBpL3YxL3BlbmVyYml0JywgJHNjb3BlLnZhbHVlLFxuICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgaGVhZGVyczoge1xuICAgICAgICAgICAgICAgICAgICAgICAgJ0NvbnRlbnQtVHlwZSc6ICdhcHBsaWNhdGlvbi94LXd3dy1mb3JtLXVybGVuY29kZWQnLFxuICAgICAgICAgICAgICAgICAgICAgICAgJ1gtUmVxdWVzdGVkLVdpdGgnOiAnWE1MSHR0cFJlcXVlc3QnXG4gICAgICAgICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICAgIH0pLnN1Y2Nlc3MoZnVuY3Rpb24gKHJlcykge1xuICAgICAgICAgICAgICAgICAgICAkc2NvcGUucmVzdWx0ID0gcmVzO1xuXG4gICAgICAgICAgICAgICAgfSkuZXJyb3IoZnVuY3Rpb24gKHJlcykge1xuICAgICAgICAgICAgICAgICAgICAkc2NvcGUucmVzdWx0ID0gcmVzLmVycm9yO1xuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICB9O1xuXG4gICAgfSk7XG5cbn0pKCk7XG4iLCIoZnVuY3Rpb24gKCkge1xuICAgIFwidXNlIHN0cmljdFwiO1xuXG4gICAgYW5ndWxhci5tb2R1bGUoJ2FwcC5jb250cm9sbGVycycpLmNvbnRyb2xsZXIoJ1BlbnVsaXNDdHJsJywgZnVuY3Rpb24gKCRzY29wZSwgJGh0dHApIHtcblxuICAgICAgICAvLyBpbmRleFxuICAgICAgICAkaHR0cC5nZXQoJy9hcGkvdjEvcGVudWxpcycpLnN1Y2Nlc3MoZnVuY3Rpb24gKHJlc3BvbnNlKSB7XG4gICAgICAgICAgICAkc2NvcGUucmVzdWx0ID0gcmVzcG9uc2UuZGF0YTtcbiAgICAgICAgfSk7XG5cbiAgICAgICAgLy8kc2NvcGUuZ2V0RGF0YSA9IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgLy8gICAgJGh0dHAoe1xuICAgICAgICAvLyAgICAgICAgbWV0aG9kOiAnZ2V0JyxcbiAgICAgICAgLy8gICAgICAgIHVybDogJy9hcGkvdjEvcGVudWxpcycsXG4gICAgICAgIC8vICAgICAgICAvL2RhdGE6ICQucGFyYW0oe2ZrZXk6IFwia2V5XCJ9KSxcbiAgICAgICAgLy8gICAgICAgIGhlYWRlcnM6IHsnQ29udGVudC1UeXBlJzogJ2FwcGxpY2F0aW9uL3gtd3d3LWZvcm0tdXJsZW5jb2RlZCd9XG4gICAgICAgIC8vICAgIH0pXG4gICAgICAgIC8vICAgICAgICAuc3VjY2VzcyhmdW5jdGlvbiAocmVzcG9uc2UpIHtcbiAgICAgICAgLy8gICAgICAgICAgICAkc2NvcGUucmVzdWx0ID0gcmVzcG9uc2U7XG4gICAgICAgIC8vICAgICAgICB9KTtcbiAgICAgICAgLy99O1xuXG5cbiAgICB9KTtcblxufSkoKTtcbiIsIihmdW5jdGlvbigpe1xuICAgIFwidXNlIHN0cmljdFwiO1xuXG4gICAgYW5ndWxhci5tb2R1bGUoJ2FwcC5jb250cm9sbGVycycpLmNvbnRyb2xsZXIoJ1Jlc3RBcGlDdHJsJywgZnVuY3Rpb24oKXtcbiAgICAgICAgLy9cbiAgICB9KTtcblxufSkoKTtcbiIsIihmdW5jdGlvbigpe1xuICAgIFwidXNlIHN0cmljdFwiO1xuXG4gICAgYW5ndWxhci5tb2R1bGUoJ2FwcC5jb250cm9sbGVycycpLmNvbnRyb2xsZXIoJ1Jldmlld3NDdHJsJywgZnVuY3Rpb24oKXtcbiAgICAgICAgLy9cbiAgICB9KTtcblxufSkoKTtcbiIsIihmdW5jdGlvbigpe1xuXHRcInVzZSBzdHJpY3RcIjtcblxuXHRhbmd1bGFyLm1vZHVsZSgnYXBwLmNvbnRyb2xsZXJzJykuY29udHJvbGxlcignU2lkZWJhckN0cmwnLCBmdW5jdGlvbigkc2NvcGUsICRzdGF0ZSl7XG5cblxuXHR9KTtcblxufSkoKTsiLCIoZnVuY3Rpb24oKXtcbiAgICBcInVzZSBzdHJpY3RcIjtcblxuICAgIGFuZ3VsYXIubW9kdWxlKCdhcHAuY29udHJvbGxlcnMnKS5jb250cm9sbGVyKCdTaWRlYmFyTGVmdEN0cmwnLCBmdW5jdGlvbigpe1xuICAgICAgICAvL1xuICAgIH0pO1xuXG59KSgpO1xuIiwiKGZ1bmN0aW9uKCl7XG4gICAgXCJ1c2Ugc3RyaWN0XCI7XG5cbiAgICBhbmd1bGFyLm1vZHVsZSgnYXBwLmNvbnRyb2xsZXJzJykuY29udHJvbGxlcignU2lkZWJhclJpZ2h0Q3RybCcsIGZ1bmN0aW9uKCl7XG4gICAgICAgIC8vXG4gICAgfSk7XG5cbn0pKCk7XG4iLCIoZnVuY3Rpb24oKXtcblx0XCJ1c2Ugc3RyaWN0XCI7XG5cblx0YW5ndWxhci5tb2R1bGUoJ2FwcC5jb250cm9sbGVycycpLmNvbnRyb2xsZXIoJ0Rhc2hib2FyZEN0cmwnLCBmdW5jdGlvbigpe1xuXG5cdH0pO1xuXG59KSgpOyIsIihmdW5jdGlvbigpe1xuXHRcInVzZSBzdHJpY3RcIjtcblxuXHRhbmd1bGFyLm1vZHVsZSgnYXBwLmNvbnRyb2xsZXJzJykuY29udHJvbGxlcignVG9hc3RzQ3RybCcsIGZ1bmN0aW9uKCRzY29wZSwgVG9hc3RTZXJ2aWNlKXtcblxuXHRcdCRzY29wZS50b2FzdFN1Y2Nlc3MgPSBmdW5jdGlvbigpe1xuXHRcdFx0VG9hc3RTZXJ2aWNlLnNob3coJ1VzZXIgYWRkZWQgc3VjY2Vzc2Z1bGx5IScpO1xuXHRcdH07XG5cblx0XHQkc2NvcGUudG9hc3RFcnJvciA9IGZ1bmN0aW9uKCl7XG5cdFx0XHRUb2FzdFNlcnZpY2UuZXJyb3IoJ0Nvbm5lY3Rpb24gaW50ZXJydXB0ZWQhJyk7XG5cdFx0fTtcblxuXHR9KTtcblxufSkoKTtcbiIsIihmdW5jdGlvbigpe1xuICAgIFwidXNlIHN0cmljdFwiO1xuXG4gICAgYW5ndWxhci5tb2R1bGUoJ2FwcC5jb250cm9sbGVycycpLmNvbnRyb2xsZXIoJ1Vuc3VwcG9ydGVkQnJvd3NlckN0cmwnLCBmdW5jdGlvbigpe1xuICAgICAgICAvL1xuICAgIH0pO1xuXG59KSgpO1xuIiwiKGZ1bmN0aW9uKCl7XG4gICAgXCJ1c2Ugc3RyaWN0XCI7XG5cbiAgICBhbmd1bGFyLm1vZHVsZSgnYXBwLmNvbnRyb2xsZXJzJykuY29udHJvbGxlcignQWRkVXNlcnNDdHJsJywgZnVuY3Rpb24oJHNjb3BlLCBEaWFsb2dTZXJ2aWNlKXtcblxuICAgICAgICAkc2NvcGUuc2F2ZSA9IGZ1bmN0aW9uKCl7XG5cdCAgICAgICAgLy9kbyBzb21ldGhpbmcgdXNlZnVsXG4gICAgICAgICAgICBEaWFsb2dTZXJ2aWNlLmhpZGUoKTtcbiAgICAgICAgfTtcblxuICAgICAgICAkc2NvcGUuaGlkZSA9IGZ1bmN0aW9uKCl7XG4gICAgICAgIFx0RGlhbG9nU2VydmljZS5oaWRlKCk7XG4gICAgICAgIH07XG5cbiAgICB9KTtcblxufSkoKTtcbiIsIihmdW5jdGlvbigpe1xuICAgIFwidXNlIHN0cmljdFwiO1xuXG4gICAgYW5ndWxhci5tb2R1bGUoJ2FwcC5jb250cm9sbGVycycpLmNvbnRyb2xsZXIoJ0xvZ2luQ3RybCcsIGZ1bmN0aW9uKCRzY29wZSwgRGlhbG9nU2VydmljZSl7XG5cbiAgICAgICAgJHNjb3BlLnNhdmUgPSBmdW5jdGlvbigpe1xuICAgICAgICAgICAgLy9cbiAgICAgICAgfTtcblxuICAgICAgICAkc2NvcGUuaGlkZSA9IGZ1bmN0aW9uKCl7XG4gICAgICAgIFx0RGlhbG9nU2VydmljZS5oaWRlKCk7XG4gICAgICAgIH07XG5cbiAgICB9KTtcblxufSkoKTtcbiIsIihmdW5jdGlvbigpe1xuXHRcInVzZSBzdHJpY3RcIjtcblxuXHRhbmd1bGFyLm1vZHVsZSggJ2FwcC5jb250cm9sbGVycycgKS5jb250cm9sbGVyKCAnRGF0YUxpc3RpbmdDdHJsJywgZnVuY3Rpb24oKXtcblx0XHQvL1xuICAgIH0pO1xuXG59KSgpO1xuIiwiKGZ1bmN0aW9uKCl7XG5cdFwidXNlIHN0cmljdFwiO1xuXG5cdGFuZ3VsYXIubW9kdWxlKCdhcHAuZGlyZWN0aXZlcycpLmRpcmVjdGl2ZSggJ2RhdGFMaXN0aW5nJywgZnVuY3Rpb24oKSB7XG5cblx0XHRyZXR1cm4ge1xuXHRcdFx0cmVzdHJpY3Q6ICdFQScsXG5cdFx0XHR0ZW1wbGF0ZVVybDogJ3ZpZXdzL2RpcmVjdGl2ZXMvZGF0YV9saXN0aW5nL2RhdGFfbGlzdGluZy5odG1sJyxcblx0XHRcdGNvbnRyb2xsZXI6ICdEYXRhTGlzdGluZ0N0cmwnLFxuXHRcdFx0bGluazogZnVuY3Rpb24oIHNjb3BlLCBlbGVtZW50LCBhdHRycyApe1xuXHRcdFx0XHQvL1xuXHRcdFx0fVxuXHRcdH07XG5cblx0fSk7XG5cbn0pKCk7XG4iXSwic291cmNlUm9vdCI6Ii9zb3VyY2UvIn0=
