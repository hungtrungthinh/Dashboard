OrderWeb.controller('homeCntrl', function($scope,$http,config,$rootScope,$location,Facebook,Scopes,$localstorage) {
	var restaurant_id=1;
	//$scope = $scope.$new(true);
	$localstorage.set('restaurant_id',1);
	$scope.member_id	=	$localstorage.get('member_id');
	$scope.name		=	 $localstorage.get('name');
	//alert($scope.name);						
	$scope.orderTimeTitle='';						
	$scope.restaurantList=[];
	$scope.resname='';
	$scope.title='';
	$scope.orderTimeTitle='';
	$scope.orderTimeLater='';
	$scope.laterDate='';
	$scope.orderTime='';
	//config.clientUr="https://newagesme.com/forkourse/weborder/";
	var Urlcall="http://newagesme.com/forkourse/weborder/";
	var Urlcall=config.clientUrl;
	$scope.member_id='';
	$scope.tab = 1;
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
	$scope.orderType='';
	$scope.orderTypeDelivery='';
	
	$scope.login=function(){
		$localstorage.set('path','/');
		$location.path('/login');	
		
	}
	$scope.logout = function () {
			var userType=$localstorage.get('userType');
			if(userType=='FB'){
				$localstorage.remove('member_id');
				$localstorage.remove('name');
				$location.path('#/');	
				/*Facebook.logout(function(response) {
					//console.log(response);					 
					$localstorage.remove('member_id');
					$localstorage.remove('name');
					$location.path('#/');	
				});*/
			}else{
				$localstorage.remove('member_id');
				$localstorage.remove('name');
				$location.path('#/');	
			}
	}
		
	$scope.saveDeliveryAddress = function(){  
		
		$('#spinner').show();
		var location_id=$scope.location_id;
		var address=$scope.delivery.zip+','+$scope.delivery.city+','+$scope.delivery.state+','+$scope.delivery.address;
		var delAdd={'zip':$scope.delivery.zip,'city':$scope.delivery.city,'state':$scope.delivery.state,'address':$scope.delivery.address};
		$scope.deliveryAddress=delAdd;
		
		$http({
            method : 'POST',
            url : Urlcall+'checkDeliveryAddress',
			data : {'location_id':location_id,'address':address,'restaurant_id':restaurant_id}
        }).success(function(response){
			
			if(response.status=='success'){
				$scope.saveDetails();	
				$scope.orderTypeContifm='Delivery';
				
				$location.path('/items');
			}else if(response.status=='error'){	
				$scope.errormsg=response.message;
			}else{
				$scope.errormsg=response.message;
			}
			$('#spinner').hide();
		});		
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
	$scope.saveDetails=function(){
		
		if($scope.orderType=='Delivery'){
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
		var date1= $scope.orderMonth+'/'+$scope.laterDateValue+'/'+$scope.orderYear;
		
		var details={'orderType':$scope.orderType,'orderTime':$scope.orderTime,'deliveryAddress':$scope.deliveryAddress,'orderTimeTitle':$scope.orderTimeTitle,'laterDateValue':$scope.laterDateValue,'orderMonth':$scope.orderMonth,'orderYear':$scope.orderYear,'resDetails':$scope.restaurantdatails,'startTime':$scope.startTime,'startDate':date1};
		Scopes.store('details',details);
	}
	
	$scope.toTime = function(timeString){
   		var timeTokens = timeString.split(':');
    	return new Date(1970,0,1, timeTokens[0], timeTokens[1], timeTokens[2]);
	}
	
	
	$scope.selectRes = function(resname,id,city){
		
		$rootScope.restaurantname=resname;
		$rootScope.city=city;
		$scope.title=resname;
		$scope.location_id=id;
		$localstorage.set('location_id',id);
		$scope.timings=[];
		
		//alert("here");
		$('#div_orderTime').show();
		
		
		$('#div_orderTimeTitle').show();
		$('#choose_location_div').hide();
		$('#div_orderTimeLater').hide();
			                  
				
		$http({
            method : 'POST',
            url : Urlcall+'restaurantDetails',
			data : {'location_id':id,'restaurant_id':$localstorage.get('restaurant_id')}
        }).success(function(response){
			if(response.status=='success'){
				$scope.restaurantdatails=response.result;
				
				
				for(var i=0;i<7;i++){
					if(typeof response.result['timings'][i]!='undefined'){
						$scope.timings[i]=[];
						$scope.timings[i]['start_at']=$scope.toTime(response.result['timings'][i]['start_at']);
						$scope.timings[i]['end_at']=$scope.toTime(response.result['timings'][i]['end_at']);
						
					}else{
						$scope.timings[i]='';
					}
					
				}
				var now	=	new Date();
				var cur_day	=	now.getDay();
				
				if(now.getHours()==0){ //At 00 hours we need to show 12 am
					hours=12;
				}
				else if(now.getHours()>12)
				{
					hours=now.getHours()%12;
				}else{
					hours=now.getHours();
				}
				
				var curTime=now.getHours()+':'+now.getMinutes()+':00';
				
				if(response.is_closed==0){
					$scope.resClosed="";
					$('#div_order_unavailable').hide();
					$('#div_order_available').show();
				}else{
					$scope.resClosed="Closed";
					$('#div_order_available').hide();
					$('#div_order_unavailable').show();
				}
			
			}else{	
				
			}
		});	
		
		
	}
	$scope.removeRes = function(){
		$scope.title='';
		$scope.orderTime='';
		$scope.orderType='';
		$scope.orderTimeLater='';
		$scope.laterDate='';
		$scope.orderTimeTitle='';
		$scope.orderTypeContifm='';
		$('#choose_location_div').show();
		$('#chooseTime_div').hide();
		$('#div_orderTime').hide();
		
		
	}
	$scope.viewOpeningTimes=function(){
		$("#resClosedModal").modal('show');
	}
	$scope.selectOrderTime = function(orderTime){
		$scope.orderTimeTitle=orderTime;
		
		if(orderTime=='Later'){
			$('#div_laterDate').hide();

			
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
			for(var i=0;i<7;i++){
				obj[daysArray[i]] = dateArray[i];
			}
			laterDates.push(obj);
			
			$scope.laterDates=laterDates;
			$scope.month1=month1;
			$scope.month2=month2;
			$scope.year1=year1;
			$scope.year2=year2;

			$scope.orderTimeLater=orderTime;
			$('#div_orderTimeLater').show();
			$('#div_orderTimeTitle').hide();
			$('#div_orderTime').hide();
			
		}else{
			$('#div_orderTimeLater').hide();
			$('#div_orderTime').show();
			
			
			$('#div_orderType').show();
			$('#div_orderTimeTitle').hide();
			$('#div_orderTypeDelivery').hide();
			
			var now = new Date();
			$scope.orderMonth=now.getMonth();
			$scope.laterDateValue=now.getDate();
			$scope.orderYear=now.getFullYear();
			
			var mid='am';
			if(now.getHours()==0){ //At 00 hours we need to show 12 am
				hours=12;
			}
			else if(now.getHours()>12)
			{
				hours=now.getHours()%12;
				mid='pm';
			}else{
				hours=now.getHours();
				mid='am';
			}
			$scope.startTime=hours+':'+now.getMinutes()+' '+mid;
			$scope.orderTime=orderTime;
			$scope.orderTimeTitle=orderTime;
			$rootScope.orderTimeTitle=$scope.orderTimeTitle;
		}
	}
	$scope.selectLaterOrderTime = function(laterorderTime){
		$scope.startTime=laterorderTime.start;
		$scope.orderTimeTitle='Later '+$scope.laterDate +' at '+laterorderTime.start;
		$scope.orderTime='Later'
		$scope.orderTimeLater='';
		$rootScope.orderTimeTitle=$scope.orderTimeTitle;
		
		$('#div_orderTime').show();
		$('#div_orderType').show();
		$('#div_orderTimeTitle').hide();
		$('#div_orderTimeLater').hide();
		$('#div_orderTypeDelivery').hide();
		
		
	}
	
	
	$scope.removeOrderTime = function(){
		$scope.orderTime='';
		$scope.orderType='';
		$scope.orderTimeLater='';
		$scope.orderTimeTitle='';
		$scope.laterDate='';
		$scope.orderTypeContifm='';
		$scope.orderTypeDelivery='';
		$('#div_orderTimeTitle').show();
		$('#div_orderTimeLater').hide();
		$('#div_orderTime').hide();
	
	}
	$scope.selectOrderType = function(orderType){
		$rootScope.orderType=orderType;
		if(orderType=='Delivery'){
			$scope.orderTypeDelivery=orderType;
			$scope.orderType=orderType;
			$('#div_orderType').hide();
			
			$('#div_orderTypeDelivery').show();
		}else{
			$scope.orderType=orderType;
			$scope.orderTypeContifm=orderType;
			$('#div_orderTypeDelivery').hide();
			$('#div_orderType').hide();
			//$('#orderTypeContifm').show();
			$('#chooseTime_div').show();
		}
	}
	$scope.removeOrderType = function(){
		$scope.orderType='';
		$scope.orderTypeDelivery='';
		$scope.orderTypeContifm='';
		$('#div_orderType').show();
		$('#div_orderTypeDelivery').hide();
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
				
				if($scope.timeArray.time.length==0){
					$scope.resClosed="Closed";
				}else{
					$scope.resClosed="";
				}
			}else{	
				
			}
		});		
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
	
	
});

