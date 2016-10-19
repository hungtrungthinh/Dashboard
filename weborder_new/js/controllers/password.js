OrderWeb.controller('passwordCntrl', function($scope,$http,config,$rootScope,Facebook,$location,$localstorage,Scopes,$routeParams) {
	var email = $routeParams.verEmail;
	var code = $routeParams.verCode;
	var restaurant_id=$localstorage.get('restaurant_id');

	//console.log(email); 
	//console.log(code); 
	$scope.verEmail=email;
	$scope.vercode=code;
	//var Urlcall="http://newagesme.com/forkourse/weborder/";
	var Urlcall=config.clientUrl;
	
	
	
    $scope.verifyPWD 	=	function(){
		//alert($scope.verEmail);
		
		$http({
						method : 'POST',
						url : Urlcall+'getUserDetails',
						data : {'verEmail':$scope.verEmail,'verpassword':$scope.verpassword,'vercode':$scope.vercode}
					}).success(function(response){
						
						if(response.status=='success'){
							$http({
								method : 'POST',
								url : Urlcall+'loginWeb',
								data : {'email':$scope.verEmail,'restaurant_id':restaurant_id,'password':$scope.verpassword}
							}).success(function(response){
								console.log (response);
								if(response.status=='success'){
									$localstorage.set('userType','GMAIL');
									$localstorage.set('member_id',response.member_id);
									$localstorage.set('name',response.first_name);
									$location.path('/');  
									
								}else{	
									$scope.errorMsg=response.message;
								}
							});	
							
							
						}else{	
							$scope.resetError=response.message;
						}
					});	
		  }
		
	
	$scope.forgotPWD	=	function(){
			//alert($scope.fg_email);  
			
			$http({
						method : 'POST',
						url : Urlcall+'webForgot',
						data : {'email':$scope.fg_email}
					}).success(function(response){
						console.log (response);return false;
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

});

