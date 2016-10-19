OrderWeb.controller('homeCntrl', function($scope,$http,config,$rootScope,$location,Facebook,Scopes,$localstorage) {
	var restaurant_id=1;
	
	$localstorage.set('restaurant_id',1);
	$scope.member_id	=	$localstorage.get('member_id');
	$scope.name		=	 $localstorage.get('name');
	$rootScope.orderType="";	
	$scope.errormsg='';
	window.scrollTo(0, 0);
	//$scope.resname='';
	//$scope.orderTimeTitle='';						
	//$scope.restaurantList=[];
	//$scope.resname='';
	//$scope.title='';
	//$scope.orderTimeTitle='';
	//$scope.orderTimeLater='';
	//$scope.laterDate='';
	//$scope.orderTime='';
	//config.clientUr="https://newagesme.com/forkourse/weborder/";
	//var Urlcall="http://newagesme.com/forkourse/weborder/";
	var Urlcall=config.clientUrl;
	
	//$scope.tab = 1;
		$http({
		  
            method : 'POST',
            url : Urlcall+'restaurantList',
			data : {'restaurant_id':restaurant_id}
        }).success(function(response){
			if(response.status=='success'){
				$scope.restaurantList=response.result;
				//console.log ($scope.restaurantList);
			}else{	
				
			}
		});	
	//$scope.orderType='';
	//$scope.orderTypeDelivery='';
	
	
	
	
	
	$scope.selectRes = function(resname,id,city){
		$("#pic_del").addClass("active");

		$rootScope.restaurantname=resname;
		$rootScope.city=city;
		
		$scope.location_id=id;
		$localstorage.set('location_id',id);
		$scope.timings=[];
		
		$scope.title=resname;
		$('#div_res_list').hide();
		
		$('#div_orderTime').show();
		
		
		//$('#div_orderTimeTitle').show();
		//$('#choose_location_div').hide();
		//$('#div_orderTimeLater').hide();
			                  
				
		$http({
            method : 'POST',
            url : Urlcall+'restaurantDetails',
			data : {'location_id':id,'restaurant_id':$localstorage.get('restaurant_id')}
        }).success(function(response){
			if(response.status=='success'){
				$scope.restaurantdatails=response.result;
				$scope.max_later_days=response.max_later_days;
			}else{	
				
			}
		});	
		
		
	}
	
	$scope.removeRes = function(){
		$("#pic_del").removeClass("active");
		
		
		$('#div_res_list').show();
		$scope.title='';
		$('#div_orderTime').hide();
		
		$scope.orderTypeDelivery='';
		$('#div_delivery').hide();
		
		$('#div_time_sel').hide();
		$('#div_later').hide();
		$('#div_orderTimeLater').hide();
		$('#chooseTime_div').hide();
		
		$('#orderTypeContifm').hide();
		//$scope.orderTime='';
		$scope.orderType='';
		//$scope.orderTimeLater='';
		//$scope.laterDate='';
		//$scope.orderTimeTitle='';
		//$scope.orderTypeContifm='';
		//$('#choose_location_div').show();
		//$('#chooseTime_div').hide();
		
	}
	
	$scope.toTime = function(timeString){
   		var timeTokens = timeString.split(':');
    	return new Date(1970,0,1, timeTokens[0], timeTokens[1], timeTokens[2]);
	}
	
	
	$scope.closepop = function(){
		$('#resclosed').hide();
	}
	$scope.selectOrderType = function(orderType){
		$("#div_time_sel").addClass("active");
		$scope.errormsg='';
			var now = new Date();
			$scope.orderMonth=now.getMonth()+1;
			
			$scope.laterDateValue=now.getDate();
			$scope.orderYear=now.getFullYear();
			
			var dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
			var dayNamesNew = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
			var today = dayNames[now.getDay()];
			//var fullDay = dayNamesNew[now.getDay()];
			var fullDay = "Today";
			
			$http({
				method : 'POST',
				url : Urlcall+'getResTime',
				data : {'day':today,'type':'PickUP','location_id':$localstorage.get('location_id'),'restaurant_id':$localstorage.get('restaurant_id')}
			}).success(function(response){
				if(response.status=='success'){
						
						var serverTime=response.time;
						var today_date=response.today_date;
						var today_time=response.today_time;
						var today_am=response.today_am;
						//alert(response.nextDay);
						$scope.fullDay=response.nextDay;
						if(response.res_status=='closed'){
							$('#resclosed').show();
						}
						//alert(response.today_time);
						//var now = new Date(response.time * 1000);
						
						//alert(response.today_date +' '+ response.today_time +' '+today_am + ' America/New_York');
						
						//var date = new Date(response.today_date +' '+ response.today_time +' '+today_am + ' ');
						//date.toString();
						//alert(date.toString());
		
						var orderTime=today_time + ' ' +today_am;
						$scope.startTime=orderTime;
						$scope.orderTime=orderTime;
						$scope.orderTimeTitle=orderTime;
						$rootScope.orderTimeTitle=$scope.orderTimeTitle;	
						$rootScope.fullDay=$scope.fullDay;	
						//alert($scope.fullDay);
						//alert($rootScope.orderTimeTitle);
					}else{	
					
				}
			});		
			
		$rootScope.orderType=orderType;
		if(orderType=='Delivery'){
			$scope.orderType=orderType;
			$scope.orderTypeDelivery=orderType;
			//$('#div_orderType').hide();
			$('#div_delivery').show();
			
		}else{
			$scope.orderType=orderType;
			//$scope.orderTypeContifm=orderType;
			//$('#div_orderTypeDelivery').hide();
			//$('#div_orderType').hide();
			
			//$('#chooseTime_div').show();
			$('#div_time_sel').show();
			$('#orderTypeContifm').show();
			
			//alert($scope.orderTime);
			
		}
	}
	$scope.removeOrderType = function(){
		$scope.orderType='';
		$scope.errormsg='';
		$scope.orderTypeDelivery='';
		$('#div_delivery').hide();
		
		$('#div_time_sel').hide();
		$('#div_later').hide();
		$('#div_orderTimeLater').hide();
		$('#chooseTime_div').hide();
		
		$('#orderTypeContifm').hide();
		//$scope.orderTypeContifm='';
		//$('#div_orderType').show();
		//$('#div_orderTypeDelivery').hide();
	}
	
	$scope.selectOrderTime = function(orderTime){
		
		
		$('#div_later').show();
		$('#div_orderTimeLater').show();
		$('#chooseTime_div').show();
		$('#orderTypeContifm').hide();
		
		var dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
			var now = new Date();
			
			if(now.getDay()==1){
				var daysArray= ["Today", dayNames[now.getDay()+1],dayNames[now.getDay()+2], dayNames[now.getDay()+3],dayNames[now.getDay()+4],dayNames[now.getDay()+5],dayNames[now.getDay()-1]];
			}else if(now.getDay()==2){
				var daysArray= ["Today", dayNames[now.getDay()+1],dayNames[now.getDay()+2], dayNames[now.getDay()+3],dayNames[now.getDay()+4],dayNames[now.getDay()-2],dayNames[now.getDay()-1]];
			}else if(now.getDay()==3){
				var daysArray= ["Today", dayNames[now.getDay()+1],dayNames[now.getDay()+2], dayNames[now.getDay()+3],dayNames[now.getDay()-3],dayNames[now.getDay()-2],dayNames[now.getDay()-1]];
			}else if(now.getDay()==4){
				var daysArray= ["Today", dayNames[now.getDay()+1],dayNames[now.getDay()+2], dayNames[now.getDay()-4],dayNames[now.getDay()-3],dayNames[now.getDay()-2],dayNames[now.getDay()-1]];
			}else if(now.getDay()==5){
				var daysArray= ["Today", dayNames[now.getDay()+1],dayNames[now.getDay()-5], dayNames[now.getDay()-4],dayNames[now.getDay()-3],dayNames[now.getDay()-2],dayNames[now.getDay()-1]];
			}else if(now.getDay()==6){
				var daysArray= ["Today", dayNames[now.getDay()-6],dayNames[now.getDay()-5], dayNames[now.getDay()-4],dayNames[now.getDay()-3],dayNames[now.getDay()-2],dayNames[now.getDay()-1]];
			}else{
				var daysArray= ["Today", dayNames[now.getDay()+1],dayNames[now.getDay()+2], dayNames[now.getDay()+3],dayNames[now.getDay()+4],dayNames[now.getDay()+5],dayNames[now.getDay()+6]];
			}
			var date1=now.getDate();
			var month1=now.getMonth();
			var year1=now.getFullYear();
			
			now.setDate(now.getDate() + 1);
			var date2=now.getDate();
			now.setDate(now.getDate() + 1);
			var date3=now.getDate();
			now.setDate(now.getDate() + 1);
			var date4=now.getDate();
			now.setDate(now.getDate() + 1);
			var date5=now.getDate();
			now.setDate(now.getDate() + 1);
			var date6=now.getDate();
			now.setDate(now.getDate() + 1);
			var date7=now.getDate();
			var month2=now.getMonth();
			var year2=now.getFullYear();
			var dateArray= [date1,date2,date3,date4,date5,date6,date7];
			var laterDates = new Array();
			
			
			var obj = {};
			
			if($scope.max_later_days==0 || $scope.max_later_days==''){
				$scope.max_later_days=7;
			}else if($scope.max_later_days > 7){
				$scope.max_later_days=7;
			}
			
			for(var i=0;i<$scope.max_later_days;i++){
				obj[daysArray[i]] = dateArray[i];
			}
			laterDates.push(obj);
			
			$scope.laterDates=laterDates;
					
		
		
	}
	$scope.delError = function(laterDate,laterDateValue){
		$scope.errormsg='';
	}
	$scope.selectLaterDate = function(laterDate,laterDateValue){
		$scope.laterDate=laterDate;
		$scope.laterDateValue=laterDateValue;
		
		var location_id=$scope.location_id;
		var dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
		var now = new Date();
		var today = dayNames[now.getDay()];
		if(laterDate=='Today'){
			var laterDateValue='Today';
			laterDate=today;
			var now	=	new Date();
			var cur_day	=	now.getDay();
			var curTime=now.getHours()+':'+now.getMinutes()+':00';
				
		}
			
		$('#div_laterDate').show();
		$http({
            method : 'POST',
            url : Urlcall+'gerRestaurantTimings',
			data : {'location_id':location_id,'day':laterDate}
        }).success(function(response){
			if(response.status=='success'){
				$scope.timeArray=response.result;
				//$scope.fullDay=response.today;
				//alert(response.startAt);
				//$rootScope.fullDay=$scope.fullDay;	
				$rootScope.fullDay=response.today;
				if($scope.timeArray.time.length==0){
					$scope.resClosed="Closed";
				}else{
					$scope.resClosed="";
				}
			}else{	
				
			}
		});		
	}
	
	
	$scope.removeOrderTime = function(){
		
		$('#div_later').hide();
		$('#div_orderTimeLater').hide();
		$('#chooseTime_div').hide();
		$('#orderTypeContifm').show();
		
		//$scope.orderTime='';
		//$scope.orderType='';
		//$scope.orderTimeLater='';
		//$scope.orderTimeTitle='';
		//$scope.laterDate='';
		//$scope.orderTypeContifm='';
		//$scope.orderTypeDelivery='';
		//$('#div_orderTimeTitle').show();
		//$('#div_orderTimeLater').hide();
		//$('#div_orderTime').hide();
	
	}
	
	$scope.showConfirm = function(timeAr)
	{
		
		timeAr.showfull = !timeAr.showfull;
		for (var i = 0; i < $scope.timeArray.time.length; i++)
		{
			var currentItem = $scope.timeArray.time[i];
			
			if (currentItem != timeAr)
			{
				currentItem .showfull = false;
			}else{
			
			}
		}
	}
	
	$scope.selectLaterOrderTime = function(laterorderTime){
		$('#div_later').hide();
		$('#div_orderTimeLater').hide();
		$('#chooseTime_div').hide();
		$('#orderTypeContifm').show();
		
		
		//alert(laterorderTime);
		$scope.startTime=laterorderTime.start;
		//$scope.orderTimeTitle='Later '+$scope.laterDate +' at '+laterorderTime.start;
		$scope.orderTimeTitle=laterorderTime.start;
		$scope.orderTime='Later'
		$scope.orderTimeLater='';
		$rootScope.orderTimeTitle=$scope.orderTimeTitle;
		$scope.fullDay=$rootScope.fullDay;
		
		//alert($scope.startTime);
		
		//$('#div_orderTime').show();
		//$('#div_orderType').show();
		//$('#div_orderTimeTitle').hide();
		//$('#div_orderTimeLater').hide();
		//$('#div_orderTypeDelivery').hide();
		
		
	}
	
	
	$scope.saveDeliveryAddress = function(){  
		
		$('#spinner').show();
		
		
		var location_id=$scope.location_id;
		
		var address=$scope.delivery.zip+','+$scope.delivery.city+','+$scope.delivery.state+','+$scope.delivery.address;
		var delAdd={'zip':$scope.delivery.zip,'appartment':$scope.delivery.appartment,'city':$scope.delivery.city,'state':$scope.delivery.state,'instruction':$scope.delivery.instruction,'address':$scope.delivery.address};
		
							
							
							
		$scope.deliveryAddress=delAdd;
		
		$http({
            method : 'POST',
            url : Urlcall+'checkDeliveryAddress',
			data : {'location_id':location_id,'address':address,'restaurant_id':restaurant_id}
        }).success(function(response){
			
			if(response.status=='success'){
				
						$scope.errormsg='';
						var now = new Date();
						var dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
						var today = dayNames[now.getDay()];
						//var dayNamesNew = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
						//$scope.fullDay = dayNamesNew[now.getDay()];
						
						$http({
							method : 'POST',
							url : Urlcall+'getResTime',
							data : {'day':today,'type':'Delivery','location_id':$localstorage.get('location_id'),'restaurant_id':$localstorage.get('restaurant_id')}
						}).success(function(response){
							if(response.status=='success'){
								
								//var today_date=response.today_date;
								//var today_time=response.today_time;
								//var today_am=response.today_am;
								//var orderTime=today_time + ' ' +today_am;
								//$scope.startTime=orderTime;
								//$scope.orderTime=orderTime;
								//$scope.orderTimeTitle=orderTime;
								//$rootScope.orderTimeTitle=$scope.orderTimeTitle;	
								
							
								
									$scope.saveDetails();	
									$scope.orderTypeContifm='Delivery';
									//$scope.fullDay=response.today;
									//alert($scope.today );	
									
									$('#div_delivery').hide();
									$('#div_time_sel').show();
									$('#orderTypeContifm').show();
									
									//var now = new Date();
									//$scope.orderMonth=now.getMonth();
									//$scope.laterDateValue=now.getDate();
									//$scope.orderYear=now.getFullYear();
									

				
								
								
							}else{	
										
						}
					});				
		
			
			}else if(response.status=='error'){	
				$scope.errormsg=response.message;
			}else{
				$scope.errormsg=response.message;
			}
			
			$('#spinner').hide();
		});	
		
		
		
	}	
	
	$scope.saveDetails=function(){
		
		/*if($scope.orderType=='Delivery'){
			if($scope.month1==$scope.month2){
				$scope.orderMonth=$scope.month1+1;
			}else{
				if($scope.laterDateValue<7){
					$scope.orderMonth=$scope.month2+1;
				}else{
					$scope.orderMonth=$scope.month1+1;
				}
			}
			
			if($scope.year1==$scope.year2){
				$scope.orderYear=$scope.year1;
			}else{
				if($scope.laterDateValue<7){
					$scope.orderYear=$scope.year2;
				}else{
					$scope.orderYear=$scope.year1;
				}
				
			}
		}
		*/
		var date1= $scope.orderYear+'/'+$scope.orderMonth+'/'+$scope.laterDateValue;
		//alert(date1);
		var details={'orderType':$scope.orderType,'orderTime':$scope.orderTime,'deliveryAddress':$scope.deliveryAddress,'orderTimeTitle':$scope.orderTimeTitle,'laterDateValue':$scope.laterDateValue,'orderMonth':$scope.orderMonth,'orderYear':$scope.orderYear,'resDetails':$scope.restaurantdatails,'startTime':$scope.startTime,'startDate':date1};
		Scopes.store('details',details);
	}


	$scope.confirmMenu = function(resname,id){

		$scope.saveDetails();	
		$scope.title='';
		$scope.orderTime='';
		$scope.orderType='';
		$scope.orderTimeLater='';
		$scope.laterDate='';
		$scope.orderTimeTitle='';
		$scope.orderTypeContifm='';
		$scope.orderTypeDelivery='';
		$location.path('/items');
	}
	$scope.logout = function () {
			var userType=$localstorage.get('userType');
			//alert(userType);
			if(userType=='FB'){
				$localstorage.remove('member_id');
				$localstorage.remove('name');
				$location.path('#/');	
					
				/*Facebook.logout(function(response) {
					//console.log(response);					 
					$localstorage.remove('member_id');
					$localstorage.remove('name');
					$scope.orderArray =[];
					Scopes.store('OneController',$scope.orderArray);
					$scope.totalPrice=0;
					Scopes.store('totalPrice',$scope.totalPrice);
					$location.path('#/');	
				});*/
			}else{
				$localstorage.remove('member_id');
				$localstorage.remove('name');
				$scope.orderArray =[];
				Scopes.store('OneController',$scope.orderArray);
				$scope.totalPrice=0;
				Scopes.store('totalPrice',$scope.totalPrice);
				$location.path('#/');	
			}
	}	
	$scope.login=function(){
		//alert("here");
		$scope.orderArray=Scopes.store('OneController', $scope.orderArray);
		$localstorage.set('path','/');
		$location.path('/login');	
	}	
});
