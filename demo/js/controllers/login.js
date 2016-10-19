OrderWeb.controller('loginCntrl', function($scope,$http,config,$rootScope,Facebook,$location,$localstorage,Scopes) {

	var restaurant_id=$localstorage.get('restaurant_id');
	var restaurantname=$rootScope.restaurantname;
	//var Urlcall="http://newagesme.com/forkourse/weborder/";
	var Urlcall=config.clientUrl;
	
	if(typeof Scopes.get('OneController') != 'undefined' )
	{	
		$scope.orderArray =[];
		$scope.orderArray = Scopes.get('OneController');
		
	}else{
		$scope.orderArray=[];		
	}
	
	var member_id=$localstorage.get('member_id');
	if(typeof member_id != 'undefined' ){
		$location.path('/');  
		return false;
	}
	
	
	
	$scope.cancelLogin=function(){
		var prevUrl=$localstorage.get('path');
		//alert(prevUrl);
		$location.path(prevUrl);  
		
	}
	
	
	$scope.login=function(){
		
		$location.path('/login');	
	}
	  $scope.loginStatus = 'disconnected';
      $scope.facebookIsReady = false;
      $scope.user = null;
	  
      $scope.loginFB = function () {
		    
            Facebook.login(function(response) {
			  //console.log(response);
              $scope.loginStatus = response.status;
			  
			   if($scope.loginStatus=='connected'){
				 var prevUrl=$localstorage.get('path');
				 //console.log("OneController");
 				 //console.log(Scopes.get('OneController'));
       			 Facebook.api('/me', {fields: 'first_name,last_name,middle_name,name,gender,email'}, function(response) {
				 $scope.user = response;
				 //console.log($scope.user);
				 //alert($scope.user.last_name);
				   $http({
					method : 'POST',
					url : Urlcall+'FbLoginWeb',
						data : {'email':$scope.user.email,'restaurant_id':restaurant_id,'name':$scope.user.name,'auth_id':$scope.user.id}
				}).success(function(response){
					//console.log (response);
					if(response.status=='success'){
						$localstorage.set('member_id',response.member_id);
						$localstorage.set('name',$scope.user.first_name);
						$location.path(prevUrl);  
						$localstorage.set('userType','FB');
							//if(response.type==3){			//new user
							//}else if(response.type==2){  	// general login 
							//}else{						// facebook user 
							//}
						}else{	
							
						}
					});	
				});
				
				//alert(prevUrl);
			   }
            },{ scope: 'email' });
          };


		$scope.logout = function () {
			Facebook.logout(function(response) {
				console.log(response);					 
			});
		}
		
		
		$scope.loginFN	=	function(){
			//console.log($scope.lg_email);	
			//console.log($scope.lg_password);
			
			var prevUrl=$localstorage.get('path');
			//alert(prevUrl);
			$http({
						method : 'POST',
						url : Urlcall+'loginWeb',
						data : {'email':$scope.lg_email,'restaurant_id':restaurant_id,'password':$scope.lg_password}
					}).success(function(response){
						console.log (response);
						if(response.status=='success'){
							$localstorage.set('userType','GMAIL');
							$localstorage.set('member_id',response.member_id);
							$localstorage.set('name',response.first_name);
							$location.path(prevUrl);  
							
						}else{	
							$scope.errorMsg=response.message;
						}
					});	
			
			
		}
          $scope.removeAuth = function () {
            Facebook.api({
              method: 'Auth.revokeAuthorization'
            }, function(response) {
              Facebook.getLoginStatus(function(response) {
                $scope.loginStatus = response.status;
              });
            });
          };

          $scope.api = function () {
            Facebook.api('/me', function(response) {
              $scope.user = response;
			  console.log(user);
            });
          };
		  $scope.$watch(function() {
              return Facebook.isReady();
            }, function(newVal) {
              if (newVal) {
                $scope.facebookIsReady = true;
              }
            }
          );
		  
		  
		  $scope.forgotPWD	=	function(){
			//alert($scope.fg_email);  
			
			$http({
						method : 'POST',
						url : Urlcall+'webForgot',
						data : {'email':$scope.fg_email}
					}).success(function(response){
						
						if(response.status=='success'){
							$location.path('/verifyPassword');  
						}else{	
							$scope.errorMsg=response.message;
						}
					});	
		  }

});

