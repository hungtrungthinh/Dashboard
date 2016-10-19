angular.module('OrderWeb.directives', [])

/*.constant('WEATHER_ICONS', {
  'partlycloudy': 'ion-ios7-partlysunny-outline',
  'mostlycloudy': 'ion-ios7-partlysunny-outline',
  'cloudy': 'ion-ios7-cloudy-outline',
  'rain': 'ion-ios7-rainy-outline',
  'tstorms': 'ion-ios7-thunderstorm-outline',
  'sunny': 'ion-ios7-sunny-outline',
  'clear-day': 'ion-ios7-sunny-outline',
  'nt_clear': 'ion-ios7-moon-outline',
  'clear-night': 'ion-ios7-moon-outline'
})*/


/*.directive('validPasswordC', function () {
    return {
        require: 'ngModel',
        link: function (scope, elm, attrs, ctrl) {
            ctrl.$parsers.unshift(function (viewValue, $scope) {
                var noMatch = viewValue != scope.myForm.password.$viewValue;
				ctrl.$setValidity('noMatch', !noMatch);
            })
        }
    }
})*/
.directive('pwCheck', [function () {
    return {
      require: 'ngModel',
      link: function (scope, elem, attrs, ctrl) {
        var firstPassword = '#' + attrs.pwCheck;
        elem.add(firstPassword).on('keyup', function () {
          scope.$apply(function () {
            var v = elem.val()===$(firstPassword).val();
            ctrl.$setValidity('pwmatch',v);
          });
        });
      }
    }
  }])

.directive('myEnter', function () {
    return function (scope, element, attrs) {
        element.bind("click", function (event) {
           
		  $('#cssmenu li').removeClass('active');
		  $(element).closest('li').addClass('active');	
		
		  var checkElement = $(element).next();
		  if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
			$(element).closest('li').removeClass('active');
			checkElement.slideUp('normal');
		  }
		  if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
			$('#cssmenu ul ul:visible').slideUp('normal');
			checkElement.slideDown('normal');
		  }
		  if($(element).closest('li').find('ul').children().length == 0) {
			return true;
		  } else {
			return false;	
		  }		
		
        });
    };
	
});
;


