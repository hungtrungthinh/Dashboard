// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'companyApp.controllers' is found in controllers.js

var OrderWeb = angular.module('OrderWeb', ['ngRoute','ui.bootstrap.modal','facebook', 'OrderWeb.directives']);

OrderWeb.config( function($routeProvider,$locationProvider) {
   			
		  $routeProvider
		  	
		  
	  		/*.when('/', {
					controller: 'homeCntrl',
					templateUrl: "templates/home.html"
	  		}).when('/items', {
					controller: 'itemCntrl',
					templateUrl: "http://192.168.1.254/forkourse/weborder/home1"
	  		})
			.when('/home', {
					controller: 'homeCntrl',
					templateUrl: "templates/home.html"
	  		})
			
			
			.when('/login', {
					controller: 'loginCntrl',
					templateUrl: "templates/login.html"
	  		})
			.when('/checkout', {
					controller: 'itemCntrl',
					templateUrl: "templates/checkout.html"
	  		})
			.otherwise({redirectTo : '/'});		*/
			
			//$locationProvider.html5Mode(true);
})

OrderWeb.config(function(FacebookProvider) {
				 
	FacebookProvider.init('186341771705015');
	
})

OrderWeb.factory('config', function() {
		return {
			siteName	: 'Forkours',
			//clientUrl	: 'http://192.168.1.254/forkourse/weborder/',
			//baseUrl		: 'http://192.168.1.254/forkourse/',
			//clientUrl	: 'https://newagesme.com/forkourse/weborder/',
			//baseUrl		: 'https://newagesme.com/forkourse/',
			clientUrl	: 'https://dashboard.forkourse.com/weborder/',
			baseUrl		: 'https://dashboard.forkourse.com/',
		};
})
OrderWeb.factory('$localstorage', ['$window', function($window) {
  return {
    set: function(key, value) {
      $window.localStorage[key] = value;
    },
    get: function(key, defaultValue) {
      return $window.localStorage[key] || defaultValue;
    },
    setObject: function(key, value) {
      $window.localStorage[key] = JSON.stringify(value);
    },
    getObject: function(key) {
      return JSON.parse($window.localStorage[key] || '{}');
    },
	remove: function(key, value) {
      $window.localStorage.removeItem(key);
    }
	
  }
}])
;