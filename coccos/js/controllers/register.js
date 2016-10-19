OrderWeb.controller('registerCntrl', function($scope,$http,config,$rootScope,Facebook,$location,$localstorage,Scopes) {

	var restaurant_id=$localstorage.get('restaurant_id');

	
	//var Urlcall="http://newagesme.com/forkourse/weborder/";
	var Urlcall=config.clientUrl;
	$scope.formData='';
		 
		  //$location.path(prevUrl);
		  
		  
	
	
	$scope.completeSignUp =	function(){
		$('#regSuccessModal').modal('hide');
		var prevUrl=$localstorage.get('path');
		//alert(prevUrl);
		$location.path(prevUrl);  
	}
	$scope.removeEr =	function(){
		var firstname=$scope.formData.firstname;
		var lastname=$scope.formData.lastname;
		var email=$scope.formData.email;
		var password=$scope.pw1;
		var password_c=$scope.pw2;
		//alert(firstname);
		if(firstname!='' && typeof firstname != 'undefined' ){
			$scope.error1="";
			return true;
		}
		if(email!='' || typeof email != 'undefined' ){
			$scope.error2="";
			return true;
		}
		if(password!='' || typeof password != 'undefined'  ){
			$scope.error3="";
			return true;
		}
		if( password_c!='' || typeof password_c != 'undefined' ){
			$scope.error4="";
			return true;
		}
		if(password==password_c){
			$scope.error5="";
			return true;
		}
	}
	
    $scope.registerFN 	=	function(){
		
		var firstname=$scope.formData.firstname;
		var lastname=$scope.formData.lastname;
		
		var email=$scope.formData.email;
		var password=$scope.pw1;
		var password_c=$scope.pw2;
		$scope.error1=$scope.error2=$scope.error3=$scope.error4=$scope.error5='';
		if(firstname=='' || typeof firstname == 'undefined' ){
			$scope.error1="required";
			return false;
		}else if(email=='' || typeof email == 'undefined' ){
			$scope.error2="required";
			return false;
		}else if(password=='' || typeof password == 'undefined'  ){
			$scope.error3="required";
			return false;
		}else if( password_c=='' || typeof password_c == 'undefined' ){
			$scope.error4="required";
			return false;
		}else if(password!=password_c){
			$scope.error5="required";
			return false;
		}else{
			
			$http({
						method : 'POST',
						url : Urlcall+'signUpWeborder',
						data : {'firstname':firstname,'lastname':lastname,'email':email,'password':password,'restaurant_id':restaurant_id}
					}).success(function(response){
						console.log(response);
						if(response.status=='success'){
							$localstorage.set('member_id',response.member_id);
							$localstorage.set('name',response.first_name);
							$("#regSuccessModal").modal('show');
							return true;
						}else{	
							$scope.errorSignUp=response.message;
							return false;
						}
					});	
		  }
		}
		
		
		
		
		
	
});

