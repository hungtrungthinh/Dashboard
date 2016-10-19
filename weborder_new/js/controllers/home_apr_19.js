OrderWeb.controller('homeCntrl', function($scope,$http,config,$rootScope,$location,Facebook,Scopes,$localstorage) {
	var restaurant_id=1;
	
	$localstorage.set('restaurant_id',1);
	$scope.member_id	=	$localstorage.get('member_id');
	$scope.name		=	 $localstorage.get('name');
	$rootScope.orderType="";	
	$scope.errormsg='';
	var itemprice	=0;
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
		//$location.path('/items');
		$('#locationdetails').hide();
		$('#itemdetails').show();
		
			
	//$('#spinner2').show();
	$scope.member_id	=	$localstorage.get('member_id');
	$scope.name		=	 $localstorage.get('name');
	$scope.TipPer=0;
	
	$scope.selection=[];									  
	$scope.optionArray=[];	
	$scope.totalPrice=0;
	$scope.subtotal=0;
	$scope.salesTax=0;
	var itemprice	=0;
	$scope.testPrice=0;
	$scope.details = Scopes.get('details');
	//alert($scope.details.startDate+' '+$scope.details.startTime);
	$scope.newArray=[];
	$scope.newSidesArray=[];
	$scope.arrayTest=[];
	$scope.selectedRequiredID=[];
	$scope.selectedRequiredIDAll=[];
	$scope.promoDiscout=0;
	
	//var Urlcall="http://newagesme.com/forkourse/weborder/";
	var Urlcall=config.clientUrl;
	
	//console.log(typeof Scopes.get('OneController'));	
	if(typeof Scopes.get('OneController') != 'undefined' )
	{	
		$scope.orderArray =[];
		$scope.orderArray = Scopes.get('OneController');
		$scope.totalPrice = Scopes.get('totalPrice');
		$scope.selection = Scopes.get('selection');
		$scope.totalQty = Scopes.get('totalQty');

		//console.log($scope.selection);
		
		if ($scope.orderArray.length > 0) {
			$scope.salesTax = Scopes.get('salesTax');
			$scope.salesTax=($scope.totalPrice*$scope.salesTax)/100;
			$scope.total=$scope.salesTax + $scope.totalPrice;
		}
		
	}else{
		$scope.orderArray=[];		
	}
	
	
	var restaurant_id=$localstorage.get('restaurant_id');
	var location_id=$localstorage.get('location_id');
	var restaurantname=$rootScope.restaurantname;
	
	//go to home page if restaurant is not selected
	if(typeof restaurantname!='undefined'){
		
		$scope.resDetails=$scope.details['resDetails'];
		//console.log($scope.details);
		
		$scope.latitude=$scope.resDetails['latitude'];
		$scope.longitude=$scope.resDetails['longitude'];
		
		$http({
            method : 'POST',
            url : Urlcall+'getRestaurantMenu',
			data : {'location_id':location_id,'restaurant_id':restaurant_id}
        }).success(function(response){
			if(response.status=='success'){
				$scope.categoryList=response.result;
				//console.log ($scope.restaurantList);
				$scope.orderType=$rootScope.orderType;
				$scope.orderTimeTitle=$rootScope.orderTimeTitle;
				$scope.googleMapload();
			}else{	
				
			}
		});	
		$http({
					method : 'POST',
					url : Urlcall+'getTaxDetails',
					data : {'restaurant_id':$localstorage.get('restaurant_id'),'location_id':location_id}
					}).success(function(response){
						if(response.status=='success'){
							$scope.tax=response.salesTax;
							$scope.min_delivery_amount=response.min_delivery_amount;
							$scope.delivery_charge=response.delivery_charge;
							$scope.is_delivery_taxable=response.is_delivery_taxable;
							$scope.minimum_delivery_time=response.minimum_delivery_time;
							
							
							Scopes.store('salesTax',$scope.tax);
							Scopes.store('min_delivery_amount',$scope.min_delivery_amount);
							Scopes.store('minimum_delivery_time',$scope.minimum_delivery_time);
							Scopes.store('is_delivery_taxable',$scope.is_delivery_taxable);
							
							if($scope.details.orderType=='Delivery'){
								Scopes.store('delivery_charge',$scope.delivery_charge);
								Scopes.store('is_delivery_taxable',$scope.is_delivery_taxable);
								
							}
							if($scope.details.orderTimeTitle=='Now'){
								
								var now	=	new Date();
								
								var now = new Date("Thu Nov 26 2015 23:59:15 GMT+0530 (India Standard Time)");
								
								
								var cur_day	=	now.getDay();
								var minutes=now.getMinutes();
								$scope.minimum_delivery_time=60;
								minutes=minutes+parseFloat($scope.minimum_delivery_time);
								
								
								
								if(Math.floor(minutes/60) > 0){
									if(Math.floor(minutes/60)==1){
										if(now.getHours()==11){ //At 00 hours we need to show 12 am
											hours=12;
										}
										else if(now.getHours()==23){ //At 00 hours we need to show 12 am
											hours=00;
										}
										else if(now.getHours()>12)
										{
											hours=now.getHours()%12;
										}else{
											hours=now.getHours();
										}										
									}else if(Math.floor(minutes/60)==2){
										if(now.getHours()==10){ //At 00 hours we need to show 12 am
											hours=12;
										}
										else if(now.getHours()>12)
										{
											hours=now.getHours()%12;
										}else{
											hours=now.getHours();
										}	
									}else{
										
									}
									
								}else{
									if(now.getHours()==0){ //At 00 hours we need to show 12 am
										hours=12;
									}
									else if(now.getHours()>12)
									{
										hours=now.getHours()%12;
									}else{
										hours=now.getHours();
									}
								}
								
								if(hours==0){
									var curTime='00:'+minutes%60+':00';
								}else if(hours < 10){
									var curTime='0'+hours+':'+minutes%60+':00';
								}else{
									var curTime=hours+':'+minutes%60+':00';
								}
								$scope.orderTimeTitle='Today at '+curTime;
							}
							
							//alert($scope.orderTimeTitle);
							
							//$scope.totalPrice=$scope.salesTax + $scope.totalPrice;
						
						}else{	
							
						}
		});	
		
		
	}
	
	
	
	
	}
	$scope.logout = function () {
			var userType=$localstorage.get('userType');
			//alert(userType);
			if(userType=='FB'){
				$localstorage.remove('member_id');
				$localstorage.remove('name');
				
				//$location.path('#/');	
				window.location.reload();	
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
				//$location.path('#/');	
				window.location.reload();
			}
	}	
	$scope.registerPop=function(){
		$('#loginDiv').hide();
		$('#forgotDiv').hide();
		$('#registerDiv').show();
	}
	$scope.forgotPwdShow=function(){
		$('#loginDiv').hide();
		$('#registerDiv').hide();
		$('#forgotDiv').show();
	}
	
	$scope.cancelLogin=function(){
		var prevUrl=$localstorage.get('path');
		//alert(prevUrl);
		//$location.path(prevUrl); 
		if(prevUrl=='/'){
			$scope.title='';
			$('#div_res_list').show();
			$('#div_orderTime').hide();
		
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
		
		
				$('#loginDiv').hide();
				$('#locationdetails').show();
			}else if(prevUrl=='/items'){
				$('#itemdetails').show();
				$('#loginDiv').hide();
				
			
			$('.pricevalue').show();
			$scope.item_id='';
			$scope.edititem_id='';
			$scope.testPrice=0;
			$scope.editindex='undefined';
			$scope.authLogin='';
			$scope.notMenu='';
			$scope.mobilecart='';
			$scope.check='';
			$('#menulist').show();
			$('#editmenu').hide();
			$scope.totalFN();
				
			if(typeof $scope.tip != 'undefined'){
				if($scope.tip!='' && $scope.tip!=0 ){
					//alert($scope.tip);
					$scope.findTipText();
				}
			}else if($scope.TipPer!=0){
				//alert($scope.TipPer);
				$scope.findTip($scope.TipPer);
			}
		
		//$location.path('/items');
	
	
	
	
		}else{
			
		}
		
	}
	$scope.redirectLogin=function(prevUrl){
		var prevUrl=$localstorage.get('path');
		if(prevUrl=='/'){
			$('#loginDiv').hide();
			$('#locationdetails').show();
		}else if(prevUrl=='/items'){
			$('#loginDiv').hide();
			$('#itemdetails').show();
		}
	} 
	$scope.login=function(){
		//alert("here");
		$scope.orderArray=Scopes.store('OneController', $scope.orderArray);
		$localstorage.set('path','/');
		//$location.path('/login');	
		$('#loginDiv').show();
		$('#registerDiv').hide();
		$('#forgotDiv').hide();
		$('#locationdetails').hide();

	}	
	
	
	
	
	
	
	//function of items control
	
	$scope.loginitem=function(){
		//$scope.orderArray=Scopes.store('OneController', $scope.orderArray);
		Scopes.store('OneController',$scope.orderArray);
		Scopes.store('totalPrice',$scope.totalPrice);
		Scopes.store('selection',$scope.selection);
		Scopes.store('totalQty',$scope.totalQty);
		
		//$('#locationdetails').hide();
		$('#itemdetails').hide();
		$('#loginDiv').show();
		
		
		$localstorage.set('path','/items');
		//$location.path('/login');	
	}
	
	$scope.googleMapload = function(){
		var cities = [
              {
                  city : 'US',
                  lat : $scope.latitude,
                  long :$scope.longitude
              }
          ];
		var mapOptions = {
                  zoom: 12,
                  center: new google.maps.LatLng($scope.latitude,$scope.longitude),
                  mapTypeId: google.maps.MapTypeId.TERRAIN
              }
        $scope.map = new google.maps.Map(document.getElementById('map'), mapOptions);
        $scope.markers = [];
        var infoWindow = new google.maps.InfoWindow();
        var createMarker = function (info){
        var marker = new google.maps.Marker({
					  //url: "http://www.google.com",
                      map: $scope.map,
                      position: new google.maps.LatLng(info.lat, info.long),
                      title: info.city
                  });
		
	
		
       		marker.content = '<div class="infoWindowContent">' + info.desc + '</div>';
            google.maps.event.addListener(marker, 'click', function(){
                      //infoWindow.setContent('<h2>' + marker.title + '</h2>' + marker.content);
                      //infoWindow.open($scope.map, marker);
					   //window.open(marker.url);
            });
        	$scope.markers.push(marker);
        }  
        for (i = 0; i < cities.length; i++){
           createMarker(cities[i]);
        }
        $scope.openInfoWindow = function(e, selectedMarker){
            e.preventDefault();
            google.maps.event.trigger(selectedMarker, 'click');
		}
	}
	
	$scope.checkout=function(){
		$('#menulist').hide();
		$('#editmenu').hide();
		$('#itemdetails').hide();
		$scope.notMenu=1;
		$scope.min_delivery_amount = Scopes.get('min_delivery_amount');
		//alert($scope.min_delivery_amount);
		//alert($scope.totalPrice);
		//console.log($scope.details.orderType);
		if($scope.details.orderType =='Pickup'){	
			var flg=1;
		}else{
			if($scope.min_delivery_amount <= $scope.totalPrice){
				var flg=1;
			}else{
				var flg=0;
			}
			
		}
		
		if(flg==1){
			$scope.errorDelAmt='';
			Scopes.store('OneController', $scope.orderArray);
			Scopes.store('totalPrice',$scope.totalPrice);
			Scopes.store('selection',$scope.selection);
			Scopes.store('totalQty',$scope.totalQty);
			
			//console.log($scope.orderArray);
			
			if(typeof $scope.member_id != 'undefined'){
				
				$('#itemdetails').show();
				$('.checkout').show();
				$('#spinnerr').show();
				$scope.check=1;
				$scope.mobilecart='';
				$('.pricevalue').hide();
				$scope.authLogin='yes';
				$scope.item_id='';
				$http({
					method : 'POST',
					url : Urlcall+'getAllDetails',
					data : {'restaurant_id':$localstorage.get('restaurant_id'),'location_id':$localstorage.get('location_id'),'member_id':$localstorage.get('member_id')}
					}).success(function(response){
						if(response.status=='success'){
							$scope.orderArray = Scopes.get('OneController');
							
							$scope.totalPrice = Scopes.get('totalPrice');
							$scope.selection = Scopes.get('selection');
							
							
							//alert($scope.details.deliveryAddress.instruction);
							
							
							$scope.profile_details=response.profile_details;
							$scope.subtotal=$scope.totalPrice;
							$scope.salesTax=($scope.subtotal*response.salesTax)/100;
							$scope.salesTaxValue=response.salesTax;
							$scope.subtotal=$scope.salesTax + $scope.subtotal;
							$scope.total=$scope.subtotal;
							Stripe.setPublishableKey(response.stripe_public_key);
							
							$scope.totalFN();
							if(typeof $scope.tip != 'undefined'){
								if($scope.tip!='' && $scope.tip!=0 ){
									//alert($scope.tip);
									$scope.findTipText();
								}
							}else if($scope.TipPer!=0){
								//alert($scope.TipPer);
								$scope.findTip($scope.TipPer);
							}
		
							
						}else{	
							
						}
						$('#spinnerr').hide();
				});	
			}else{
				$scope.check='';
				$localstorage.set('path','/items');
				//$location.path('/login');	
				$('#loginDiv').show();
			}
		}else{
			$scope.errorDelAmt="Minimum Delivery Amount: $"+$scope.min_delivery_amount+" Adjust quantity or add new items. ";
		}
	}	
	
	$scope.validatePhone=function(){
		var phone 	= $scope.pay_phone ;
		var PHONE_REGEXP = /^\+?\d{2}[- ]?\d{3}[- ]?\d{5}$/;
		if(PHONE_REGEXP.test(phone)) {
		   $scope.errorphone="";
		   $scope.phoneNo=phone;
		   return true;
        }else{
		   $scope.errorphone="Invalid phone number.";
		   window.scrollTo(0, 0);
		   $('#phoneNo').focus();
		   return false;
		}
	}
	$scope.formatDetails = function ()
	{	
		$('input.cc-num').payment('formatCardNumber');
		$('.cc-exp').payment('formatCardExpiry');
		$('.cc-cvv').payment('formatCardCVC');
		
		//alert($scope.errorPaymentInfo);
		$scope.errorPaymentInfo='';
	}
	
	$scope.payment=function(){
		
		var memberID = $localstorage.get('member_id');
		//Stripe.setPublishableKey("pk_test_T3Vj6s3bW9jDEXoldVYJBoQx");
		$http({
				method : 'POST',
				url : Urlcall+'checkUserData',
				data : {'member_id':memberID}
				}).success(function(response){
					
				if(response.status=='success'){
					
				}else{	
					$("#getBlockModal").modal('show');
					return false;
				}
		});	
		
		
		
		
		var phone 	= $scope.pay_phone ;
		var cardno	= $scope.cardno ;
		var month 	= $scope.card_month ;
		var year 	= $scope.card_year ;
		var cvv 	= $scope.card_cvv ;
		
		if(typeof phone == 'undefined' || phone==''){
			window.scrollTo(0, 0);
			$scope.errorphone="Phone number is empty";
			$('#phoneNo').focus();
			return false;
		}else if($scope.errorphone==''){						
			  if(!Stripe.card.validateCardNumber(cardno)){				
					$scope.errorPaymentInfo="Invalid card number";
					$('#cardNo').focus();
			  }else if(!Stripe.card.validateExpiry(month, year)){
					$scope.errorPaymentInfo="Invalid expiry date";
			  }else if(!Stripe.card.validateCVC(cvv)){
					$scope.errorPaymentInfo="Invalid CVV code";
			  }else{
				  $('#spinn').show();
						Stripe.card.createToken({
						  number: cardno,
						  cvc: cvv,
						  exp_month: month,
						  exp_year: year
					}, stripeResponseHandler);	
			 }
		}else{
			window.scrollTo(0, 0);
			//alert($scope.pay_phone);
		}
			
		
		
	}
	var stripeResponseHandler = function(status, response){
		
		if (response.error) {
			$scope.errorPaymentInf=response.error.message;
			$('#spinn').hide();
			return false;
		}else{
			var token = response.id;
			var last4 = response.card.last4;
			var brand = response.card.brand;
			var data = {'token':token,'last4':last4,'brand':brand};
			$scope.payment_data = data;
			$scope.addOrder();
			
		}
	 }
	 
	 
	 
	  $scope.addOrder = function(){
		  	
			var select_option_name={};
			var select_side_price={};
			var select_side_name={};
			var i=0;
			$scope.orderArray=Scopes.get('OneController');	

					var cart_data = $scope.orderArray;
					var promo = $scope.promocodeDetails;
					var promo_data={};
					if(promo){
						promo_data.promocode = promo.promocode;
						promo_data.discount_type = promo.discount_type;
						promo_data.discount_amount = promo.discount_amount;
						promo_data.location_id = promo.location_id;
						promo_data.restaurant_id = promo.restaurant_id;
						promo_data.promo_id = promo.promo_id;
					}
					if($scope.details.orderType=='Delivery')
						var delivery_address = $scope.details.deliveryAddress;
					else
						var delivery_address ='';
					if($scope.details.orderTime=='Now')
						var is_later='N';
					else
						var is_later='Y';
						
					var order_data = {'user_id':$localstorage.get('member_id'),
									  'restaurant_id':$localstorage.get('restaurant_id'),
									  'location_id':$localstorage.get('location_id'),
									  'cart_data':cart_data,
									  //'total_quantity': $rootScope.cart_qty,
									  'sub_total':$scope.totalPrice,
									  'promo_data' : promo_data,
									  'order_type':$scope.details.orderType,
									  'is_later':is_later,
									  'delivery_time':$scope.details.startDate+' '+$scope.details.startTime,
									  'delivery_address':$scope.details.deliveryAddress,
									  'tip':$scope.tip,
									  'phone':$scope.pay_phone,
									  'payment_data':$scope.payment_data
									  }
									  
					////OrderDetailsFactory.getData('delivery_time').toString()
					
					$http({
						method : 'POST',
						url : Urlcall+'checkout',
						data : {'order_data':order_data,'facebook':'FB'}
						}).success(function(response){
							$('#spinn').hide();
							//console.log(response);
							if(response.error)
							{
								$scope.errorPaymentInfo=response.error;
							}else if(response.status!='error'){
								$("#getCodeModal").modal('show');
								Scopes.store('totalPrice',0);
							}else{ 
								
							}
						
						}).error(function(data, status, headers, config) {
					});
					
					
											  
			
		}
		
	$scope.completeOrder = function(){
		
		$(".modal-backdrop").hide();
		//$location.path('/');
		$scope = $scope.$new(true);
		$scope.array=[];	
		Scopes.store('details',$scope.array);
		Scopes.store('OneController',$scope.array);
		$scope.delivery_charge=0;
		$scope.min_delivery_amount=0;
		Scopes.store('min_delivery_amount',$scope.min_delivery_amount);
		Scopes.store('delivery_charge',$scope.delivery_charge);
		window.location.reload();	
	}
	 
	 
	$scope.findTip = function(percentage){
		$scope.TipPer = percentage;
		var tip=($scope.totalPrice*percentage)/100;
		$scope.tip=tip.toFixed(2);
		//alert(percentage);
		//alert($scope.tip);
		if($scope.promoDiscout!=''){
			var pri=parseFloat($scope.totalPrice)-parseFloat($scope.promoDiscout);
		}else{
			var pri=parseFloat($scope.totalPrice);
		}
		$scope.total=parseFloat($scope.tip)+parseFloat(pri)+parseFloat($scope.salesTax);
		//alert($scope.total);
	}
	$scope.findTipText = function(){
		
		//var tip=$scope.tip;
		//$scope.tip=tip;
		if($scope.tip==''){
			$scope.tip=0;
		}
		var pri=parseFloat($scope.totalPrice)-parseFloat($scope.promoDiscout);
		$scope.total=parseFloat($scope.tip)+parseFloat(pri)+parseFloat($scope.salesTax);
	}
	
	$scope.promocodeApply = function(){
		var promocode=$scope.promocode;
		$http({
				method : 'POST',
				url : Urlcall+'checkPromocode',
				data : {'restaurant_id':$localstorage.get('restaurant_id'),'location_id':$localstorage.get('location_id'),'promocode':promocode}
				}).success(function(response){
				
				if(response.status=='success'){
					$scope.promoError='';
					$scope.promocodeDetails=response.data;
					if($scope.promocodeDetails.discount_type=='Fixed amount'){
						$scope.promoDiscout=$scope.promocodeDetails.discount_amount;
					}else{
						$scope.promoDiscout=($scope.totalPrice*$scope.promocodeDetails.discount_amount)/100;
					}
					var tot=$scope.totalPrice-$scope.promoDiscout;
					$scope.salesTax=(tot*$scope.salesTaxValue)/100;
					$scope.total=$scope.salesTax + tot;
					
					
					
				}else{	
					$scope.promoError=response.message;
				}
		});	
		
	}
	
	$scope.selectItem = function(item_id){
		$('#spinner').show();
		$scope.edititem_id='';
		$scope.item_id=item_id;
		$scope.specialIns='';
		$scope.notMenu=1;
		//$scope.arrayTest=[];
		$scope.selectedRequiredID=[];
		$http({
            method : 'POST',
            url : Urlcall+'getRestaurantMenuDetail',
			data : {'item_id':item_id}
        }).success(function(response){
			if(response.status=='success'){
				$scope.itemDetail=response.result;
				$scope.quantity=1;
				$scope.item_name=response.result.item_name;
				$scope.price=$scope.itemDetail.sizes[0].price;
				//$scope.size=$scope.itemDetail.sizes[0].size;
				$scope.size='';
				
			
				$scope.selection[item_id]=[];
				$scope.newArray=[];
				$scope.requiredIDS=[];
				$scope.Sideindex='';
				
				$scope.oneSize=[];
				$scope.multipleSize=[];
				$scope.selecteSize=[];
				//$scope.multipleSize='select';
				if($scope.itemDetail.sizes.length==1){
					$scope.oneSize.push({'size':$scope.itemDetail.sizes[0]['size'],'price':$scope.itemDetail.sizes[0]['price']});
				}else{
					angular.forEach($scope.itemDetail.sizes, function (val) {
						//$scope.multipleSize.push({'size':val['size'],'price':val['price']});
						$scope.multipleSize.push({'size':val['size'],'price':val['price']});
						$scope.selecteSize.push({'size':val['size']});
					});
				}
				
				angular.forEach($scope.itemDetail.option_id, function (item) {
					angular.forEach($scope.itemDetail.side_id[item], function (item1) {
						$scope.arrayTest[item1]=[];
						$scope.arrayTest[item1].push({'checkid':item1,'selected':false});
					});
					
					if($scope.itemDetail.is_mandatory[item]=='Y'){
				 		$scope.requiredIDS.push({'optid':item,'opname':$scope.itemDetail.option_name[item]}); 
					}
					
				});
				$scope.config=[];
				$scope.config = $scope.multipleSize[0];
				//console.log($scope.config);
			}else{	
				
			}
			$('#spinner').hide();
		});	
		
		
	}
	
	$scope.editItem = function(item_id,index){
		$('.pricevalue').show();
		$scope.check='';
		$scope.edititem_id='';
		$scope.item_id=item_id;
		$scope.edititem_id=item_id;
		$scope.editindex=index;
		$scope.selectedRequiredID=[];
		$scope.arrayTest=[];
		
		$scope.oneSize=[];
		$scope.multipleSize=[];
		$scope.selecteSize=[];
		
		$('#menulist').show();
		$('#editmenu').hide();
		$scope.notMenu=1;
		$scope.mobilecart='';
		$http({
            method : 'POST',
            url : Urlcall+'getRestaurantMenuDetail',
			data : {'item_id':item_id}
        }).success(function(response){
			if(response.status=='success'){
				//console.log(response);
				//return false;
				$scope.itemDetail=response.result;
				$scope.quantity=$scope.orderArray[index]['quantity'];
				$scope.specialIns=$scope.orderArray[index]['specialIns'];
				$scope.Sideindex=$scope.orderArray[index]['Sideindex'];
				
				$scope.item_name=response.result.item_name;
				$scope.requiredIDS=[];
				
				
				
				if($scope.itemDetail.sizes.length==1){
					$scope.oneSize.push({'size':$scope.itemDetail.sizes[0]['size'],'price':$scope.itemDetail.sizes[0]['price']});
				}else{
					angular.forEach($scope.itemDetail.sizes, function (val) {
						//$scope.multipleSize.push({'size':val['size'],'price':val['price']});
						$scope.multipleSize.push({'size':val['size'],'price':val['price']});
						$scope.selecteSize.push({'size':val['size']});
					});
				}
				
				
				angular.forEach($scope.itemDetail.option_id, function (item) {
					if($scope.itemDetail.is_mandatory[item]=='Y'){
				 		$scope.requiredIDS.push({'optid':item,'opname':$scope.itemDetail.option_name[item]}); 
					}
				});
				
				angular.forEach($scope.itemDetail.option_id, function (item) {
					angular.forEach($scope.itemDetail.side_id[item], function (item1) {
						//console.log(item1);	
						//console.log('checkid: '+item1+',selected:false');	
						
						$scope.arrayTest[item1]=[];
						$scope.arrayTest[item1].push({'checkid':item1,'selected':false});
						//console.log($scope.arrayTest[item1]);	
						//console.log($scope.arrayTest);
					});
					
				});
		
			$scope.size=$scope.orderArray[index].size;	
			$scope.price=$scope.orderArray[index].price;
				
			//console.log($scope.size);	
			//console.log($scope.orderArray[index]);	
			var nprice=$scope.orderArray[index]['price'];
				angular.forEach($scope.orderArray[index]['options'], function (valu) {
					//console.log($scope.selectedRequiredID);
					//console.log(valu['optid']);
					
					if($scope.itemDetail.is_mandatory[valu['optid']]=='Y'){
						//alert(valu['optid']);
						var val=valu['optid'].toString();
						$scope.selectedRequiredID.push(val);
					}
					
					angular.forEach(valu['sides'], function (item2) {
						if(item2['sidePrice']=='')
							item2['sidePrice']=0;
						nprice=parseFloat(item2['sidePrice'])+parseFloat(nprice);
						
						var myArray = new Object();
						myArray["checkid"] = item2['sideid'];
						myArray["selected"] = true;
						var myArray1 = new Object();
						myArray1[0]=myArray;
						$scope.arrayTest[item2['sideid']]=myArray1;
					});
					
					
				});	
				
				$scope.testPrice=parseFloat(nprice);
				//$scope.testPrice=parseFloat($scope.testPrice)-parseFloat(nprice);
				//alert($scope.testPrice);
				//console.log($scope.arrayTest);
			}else{	
				
			}
		});	
	}
	

	$scope.goToLocation = function() {
	  $scope.showModal = true;
	  $("#getshowModal").modal('show');
	  //$scope.orderArray=[];
	  //$scope.orderArray=Scopes.store('OneController',$scope.orderArray);
	  //$scope.selection=[];
	  //$scope.selection=Scopes.store('selection',$scope.selection);
	  
	  //$scope.totalPrice=0;
	  //Scopes.store('totalPrice',$scope.totalPrice);
	  //$scope.salesTax=0;
	  //Scopes.store('salesTax',$scope.salesTax);
	  //$scope.min_delivery_amount=0;
	  //Scopes.store('min_delivery_amount',$scope.min_delivery_amount);
	  //$scope.delivery_charge=0;
	  //Scopes.store('delivery_charge',$scope.delivery_charge);
	  
	};
		
	$scope.notCancelOrder = function() {
	  $scope.showModal = false;
	};
		
	$scope.cancelOrder = function() {
	  	//$scope.showModal = false;
	 	//$scope.item_id='';
		window.location.reload();
	 	//$location.path('/');
	};
  
	$scope.goToMenu = function(){
		$('.pricevalue').show();
		$scope.item_id='';
		$scope.edititem_id='';
		$scope.testPrice=0;
		$scope.editindex='undefined';
		$scope.authLogin='';
		$scope.notMenu='';
		$scope.mobilecart='';
		$scope.check='';
		$('#menulist').show();
		$('#editmenu').hide();
		$scope.totalFN();
				
		if(typeof $scope.tip != 'undefined'){
			if($scope.tip!='' && $scope.tip!=0 ){
				//alert($scope.tip);
				$scope.findTipText();
			}
		}else if($scope.TipPer!=0){
			//alert($scope.TipPer);
			$scope.findTip($scope.TipPer);
		}
		
		//$location.path('/items');
	}
	$scope.changeQantity = function(type){
		if(type=='add'){
			$scope.quantity=$scope.quantity+1;
		}else{
			if($scope.quantity!=1)
				$scope.quantity=$scope.quantity-1;
		}
	}
	
	
	  // toggle selection for a given employee by name
	  $scope.toggleSelection = function toggleSelection(sideid,item_id,optid,limit,isMand) {
			
			 if(isMand=='Y' && limit==''){
				 limit=1;
			 }
			 
			 $scope.newArray[item_id] = ( typeof $scope.newArray[item_id] != 'undefined' && $scope.newArray[item_id] instanceof Array ) ? $scope.newArray[item_id] : [];
			 
			 $scope.selectedRequiredIDAll[optid] = ( typeof $scope.selectedRequiredIDAll[optid] != 'undefined' && $scope.selectedRequiredIDAll[optid] instanceof Array ) ? $scope.selectedRequiredIDAll[optid] : [];
			 var idx3 = $scope.selectedRequiredIDAll[optid].indexOf(sideid);
			 var idx2 = $scope.newArray[item_id].indexOf(sideid);
			 if (idx2 > -1) {
				$scope.newArray[item_id].splice(idx2, 1);
			 }
			 // is newly selected
			 else {
			    $scope.newArray[item_id].push(sideid);
			 }
			 
			 if (idx3 > -1) {
				$scope.selectedRequiredIDAll[optid].splice(idx3, 1);
			 }
			 else {
			    $scope.selectedRequiredIDAll[optid].push(sideid);
			 }
			 
			 //------------old code--------------
			 $scope.selection[item_id][optid] = ( typeof $scope.selection[item_id][optid] != 'undefined' && $scope.selection[item_id][optid] instanceof Array ) ? $scope.selection[item_id][optid] : [];
			 var idx = $scope.selection[item_id][optid].indexOf(sideid);
			 if (idx > -1) {
			   $scope.selection[item_id][optid].splice(idx, 1);
			 }
			 
			 else {
			   $scope.selection[item_id][optid].push(sideid);
			 }
			 
			 
			 if(limit!=''){
				 if($scope.selection[item_id][optid].length > limit ){
					
					$scope.arrayTest[sideid].splice(idx, 1);
					$scope.arrayTest[sideid].push({'checkid':sideid,'selected':false}); 
					$scope.selection[item_id][optid].splice(idx, 1);
					$("#errormodal").modal('show');
				 }else if($scope.selection[item_id][optid].length == limit ){
					 if($scope.itemDetail.is_mandatory[optid]=='Y'){
					 	//alert(optid);
						$scope.selectedRequiredID.push(optid); 
					 }
				 }else{
					
					var indexar = $scope.selectedRequiredID.indexOf(optid);
					if (indexar >= 0) {
					  $scope.selectedRequiredID.splice(indexar, 1 );
					  //console.log($scope.selectedRequiredID);
					} 
				 }
			 }else{
				var flg=0;
				
				
				
				if($scope.itemDetail.is_mandatory[optid]=='Y'){
					
					angular.forEach($scope.selectedRequiredID, function(valu) {
						if(valu==optid){//alert("2");
							flg=1;
							var indexar = $scope.selectedRequiredID.indexOf(optid);
							
							if (indexar >= 0) {
							} 
							}
					});
					if(flg!=1){
				 		$scope.selectedRequiredID.push(optid); 
					}
					
					if($scope.selectedRequiredIDAll[optid].length==0){
						var indexar = $scope.selectedRequiredID.indexOf(optid);
						$scope.selectedRequiredID.splice(indexar, 1 );
					}
				}
			 }

	   }
	   
	   $scope.addToOrder=function(item_id,Sideindex){
		  var erFlag=0;
		   
		  if($scope.multipleSize.length > 1 ){
			  if($scope.size==''){
				erFlag=1;
				//alert($scope.size);
		  	 	//console.log($scope.multipleSize);
		   	 	//alert($scope.multipleSize.length);
			  }else{
				  erFlag=0;
			  }
		 	 
		  }else{
			  erFlag=0;
		  }
		  
		  if(erFlag==0){
		  
			   $scope.notSelectOptID=[];
				//console.log($scope.itemDetail);
			   //console.log($scope.selectedRequiredID);
				//alert($scope.selectedRequiredID.length);	 
				//alert($scope.requiredIDS.length);	 
				$scope.newAr=[];
				$scope.newsideAr=[];
			   if($scope.selectedRequiredID.length==$scope.requiredIDS.length){
				   $('#spinner').show();
				   
				   $scope.subtotal=0;
				   $scope.optionArray =  [];
				   //alert($scope.selection[item_id]);
				   angular.forEach($scope.selection[item_id], function(value, key) {
						
						$scope.sidesArray =  [];
						angular.forEach(value,function(value1, key1) {
							$scope.sidesArray.push({'sideid':value1,'sideitem':$scope.itemDetail.side_item[key][value1],'sidePrice':$scope.itemDetail.side_price[key][value1]});
						//$scope.newsideAr[$scope.itemDetail.side_sortorder[key][value1]]={'sideid':value1,'sideitem':$scope.itemDetail.side_item[key][value1],'sidePrice':$scope.itemDetail.side_price[key][value1]};
							
							if($scope.itemDetail.side_price[key][value1]!='' && $scope.itemDetail.side_price[key][value1]!=0 )
								$scope.subtotal	=parseFloat($scope.subtotal)+ parseFloat($scope.itemDetail.side_price[key][value1]);
						});
						
						//alert($scope.itemDetail.sortorder[key]);
						$scope.optionArray.push({'optid':key,'optTitle':$scope.itemDetail.option_name[key],'sortorder':$scope.itemDetail.sortorder[key],'sides':$scope.sidesArray});
						
						//alert($scope.sidesArray.length);
						if($scope.sidesArray.length!=0){
							$scope.newAr[$scope.itemDetail.sortorder[key]]={'optid':key,'optTitle':$scope.itemDetail.option_name[key],'sortorder':$scope.itemDetail.sortorder[key],'sides':$scope.sidesArray};
						}else{
							$scope.newAr.splice($scope.itemDetail.sortorder[key], 1);	
						}
						//$scope.newAr.push($scope.itemDetail.sortorder[key]);
						
					});
				   
				   
						
				   //console.log($scope.newAr);
				   //console.log($scope.optionArray);
				  // console.log($scope.newAr);
				   
				   
				   var qnty=$scope.quantity;
				   var specialIns=$scope.specialIns;
				   var price=$scope.price;
				   var item_name=$scope.item_name;
				   
				   $scope.subtotal	=	parseFloat($scope.subtotal)+parseFloat($scope.price);
				   $scope.subtotal	=  qnty * parseFloat($scope.subtotal);
				   $scope.totalPrice	= parseFloat($scope.totalPrice)+ parseFloat($scope.subtotal);
				   if($scope.edititem_id!=''){
					   $scope.orderArray.splice($scope.editindex, 1);
				   
				   }
		
				  
				   if(typeof Sideindex == 'undefined' )
				   {
						var ind	=	$scope.newSidesArray.push($scope.newArray[item_id]);
						$scope.orderArray.push({'item_id':item_id,'quantity':qnty,'specialIns':specialIns,'item_name':item_name,'salesTax':$scope.tax,'price':price,'size':$scope.size,'options':$scope.newAr,'optionsOLD':$scope.optionArray,'Sideindex':ind-1});
				   }else{
						var ind	=Sideindex;
						$scope.orderArray.push({'item_id':item_id,'quantity':qnty,'specialIns':specialIns,'item_name':item_name,'salesTax':$scope.tax,'price':price,'size':$scope.size,'options':$scope.newAr,'optionsOLD':$scope.optionArray,'Sideindex':ind});
				   }
				   //console.log($scope.orderArray);
				   $scope.item_id='';
				   $('#spinner').hide();
				  
					
					var iprice=0;
					angular.forEach($scope.orderArray, function(value, key) {
						var sideprice=0;
						
						angular.forEach(value['options'],function(optionsvalue, key1) {
																  
							angular.forEach(optionsvalue['sides'],function(sidesvalue, key1) {
								if(sidesvalue['sidePrice']==''){
									var valsidesvalue=0;
								}else{
									var valsidesvalue=sidesvalue['sidePrice'];	
								}
								sideprice	=	parseFloat(sideprice) + parseFloat(valsidesvalue);
							});
						});
						iprice	= value['quantity'] * (parseFloat(sideprice)+ parseFloat(value['price']));
					});
					///$scope.testPrice=parseFloat($scope.testPrice)+parseFloat(iprice);
					//alert(itemprice);
					
					itemprice=parseFloat(iprice)+parseFloat(itemprice);	
					itemprice=parseFloat(itemprice)-parseFloat($scope.testPrice);	
					$scope.totalPrice=itemprice;
					$scope.salesTax=(parseFloat($scope.totalPrice)*parseFloat($scope.tax))/100;
					$scope.total=parseFloat($scope.salesTax) + parseFloat($scope.totalPrice);
					$scope.testPrice=0;
					
			   }else{
				   
				   angular.forEach($scope.requiredIDS, function(value) {
						if($scope.selectedRequiredID.indexOf(value['optid']) > -1){
							//alert(value['optid']);alert($scope.selectedRequiredID.indexOf(value['optid']));
						}else{
							$scope.notSelectOptID.push(value);
						}
				   });
				   
				   $("#errorRequired").modal('show');
			   }
			 $scope.authLogin='';
		 
			 $scope.totalFN();
				if(typeof $scope.tip != 'undefined'){
					if($scope.tip!='' && $scope.tip!=0 ){
						//alert($scope.tip);
						$scope.findTipText();
					}
				}else if($scope.TipPer!=0){
					//alert($scope.TipPer);
					$scope.findTip($scope.TipPer);
				}
			
			 //$location.path('/items'); 
		  }else{
			  $("#errorSelect").modal('show');
			  //alert("Please select a size");
		  }
		 
		 
	   }
	   
	   
	   $scope.removeFromCart=function(remItemid,index){
			if($scope.editindex!=index){
				//console.log($scope.orderArray);
				var itempricenew = 0;
				angular.forEach($scope.orderArray, function(value, key) {
					var sideprice=0;
					if(value['item_id']==remItemid){
						angular.forEach(value['options'],function(optionsvalue, key1) {
							angular.forEach(optionsvalue['sides'],function(sidesvalue, key1) {
								if(sidesvalue['sidePrice']=='')
									sidesvalue['sidePrice']=0;
								sideprice	=	parseFloat(sideprice) + parseFloat(sidesvalue['sidePrice']);
							});
						});
						itempricenew	= parseFloat(value['quantity']) * (parseFloat(sideprice)+ parseFloat(value['price']));
					}
				});
				$scope.totalPrice=parseFloat($scope.totalPrice)-parseFloat(itempricenew);
				//alert(itempricenew);
				itemprice=parseFloat(itemprice)-parseFloat(itempricenew);
				//alert(itemprice);
				$scope.salesTax=($scope.totalPrice*$scope.tax)/100;
				$scope.total=$scope.salesTax + $scope.totalPrice;
				if($scope.total=='')	
					$scope.total=0;
		   		$scope.orderArray.splice(index, 1);
				$scope.testPrice=0;
				
				$scope.totalFN();
		    }
	   }
	   $scope.totalFN=function(){
		   $scope.totalQty=0;
		   //console.log($scope.orderArray);
		   if($scope.details.orderType=='Delivery'){
				$scope.delivery_charge=Scopes.get('delivery_charge');
				$scope.is_delivery_taxable=Scopes.get('is_delivery_taxable');
		   }else{
			    $scope.delivery_charge=0;
		   }
	  	   var itempricenew = 0;
		   $scope.totalPrice=0;
		   
				angular.forEach($scope.orderArray, function(value, key) {
					var sideprice=0;
						angular.forEach(value['options'],function(optionsvalue, key1) {
							angular.forEach(optionsvalue['sides'],function(sidesvalue, key1) {
								if(sidesvalue['sidePrice']=='')
									sidesvalue['sidePrice']=0;
								sideprice	=	parseFloat(sideprice) + parseFloat(sidesvalue['sidePrice']);
							});
						});
						itempricenew	= parseFloat(value['quantity']) * (parseFloat(sideprice)+ parseFloat(value['price']));
						//alert(itempricenew);
						$scope.totalPrice=parseFloat($scope.totalPrice)+parseFloat(itempricenew);
						$scope.totalQty=parseFloat($scope.totalQty)+parseFloat(value['quantity']);
				});
				
				//alert($scope.totalQty);
				
				
				if($scope.details.orderType=='Delivery'){
					if($scope.is_delivery_taxable=='Y' || $scope.is_delivery_taxable=='y')
					{
						$scope.totalPrice=parseFloat($scope.totalPrice);
						$scope.salesTax=((parseFloat($scope.totalPrice)+ parseFloat($scope.delivery_charge)) *$scope.tax)/100;
						$scope.total=$scope.salesTax + $scope.totalPrice + parseFloat($scope.delivery_charge);
						//$scope.total=parseFloat($scope.total)+ parseFloat($scope.delivery_charge);
					}else{
						//alert($scope.totalPrice);
						//alert($scope.tax);
						$scope.salesTax=($scope.totalPrice*$scope.tax)/100;
						//alert($scope.salesTax);
						$scope.total=$scope.salesTax + $scope.totalPrice;
						$scope.total=parseFloat($scope.total)+ parseFloat($scope.delivery_charge);	
					}
					
					if($scope.min_delivery_amount <= $scope.totalPrice){
						$scope.errorDelAmt="";
					}else{
						$scope.errorDelAmt="Minimum Delivery Amount: $"+$scope.min_delivery_amount+" Adjust quantity or add new items. ";
					}
				
				
			    }else{
					$scope.salesTax=($scope.totalPrice*$scope.tax)/100;
					$scope.total=$scope.salesTax + $scope.totalPrice;
					$scope.total=parseFloat($scope.total)+ parseFloat($scope.delivery_charge);
			    }
		   
		   
				if($scope.total=='')	
					$scope.total=0;
					
				
	
	   }
	    $scope.changeSize=function(){
		   //console.log($scope.size);
		   //alert($scope.size);
		   //alert($scope.size.size);
		   angular.forEach($scope.multipleSize, function(value) {
				if(value['size']==$scope.size.size){
					$scope.price=value['price'];
					//$scope.size=value['size'];
					$scope.size=$scope.size;
				}
		   });
	   }
	   
	  /* $scope.changeSize=function(){
		   console.log($scope.size);
		   alert($scope.size.size);
		   alert($scope.size.size);
		   angular.forEach($scope.multipleSize, function(value) {
				if(value['size']==$scope.size.size){
					$scope.price=value['price'];
					//$scope.size=value['size'];
					$scope.size=value['size'];
				}
		   });
	   }*/
	   $scope.showcart=function(){
		   if(typeof $scope.totalQty != 'undefined' && $scope.totalQty!=''){
		  	   $('#menulist').hide();
			   $('#editmenu').show();
			   $scope.notMenu=1;
			   $scope.item_id='';
			   $scope.editcart=1;
			   $scope.mobilecart=1;
			   $scope.check='';
			   $('.checkout').hide();
		   }else{
			   //alert($scope.totalQty);
		   }
		   
		   
		   //alert($scope.mobilecart);
	   }
	   $scope.showmenu=function(){
		   $('#menulist').show();
	   }
	   
	   	 
	//login control
	
	
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
						
						$scope.member_id=response.member_id;
						$scope.name=$scope.user.first_name;
							
						$location.path(prevUrl);  
						$scope.redirectLogin(prevUrl);
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
							//$location.path(prevUrl); 
							$scope.member_id=response.member_id;
							$scope.name=response.first_name;
							$scope.redirectLogin(prevUrl);
							$('#menulist').show();
							
							
						}else{	
							$scope.errorMsg=response.message;
						}
					});	
			
			
		}
		
		
	 $scope.registerFN 	=	function(){
		//alert("here");
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
							
							$scope.member_id=response.member_id;
							$scope.name=response.name;
							
							$("#regSuccessModal").modal('show');
							return true;
						}else{	
							$scope.errorSignUp=response.message;
							return false;
						}
					});	
		  }
		}
		
	$scope.forgotPWD	=	function(){
			
			
			$http({
						method : 'POST',
						url : Urlcall+'webForgot',
						data : {'email':$scope.fg_email}
					}).success(function(response){
						console.log (response);
						if(response.status=='success'){
							$localstorage.set('userType','GMAIL');
							$localstorage.set('member_id',response.member_id);
							$localstorage.set('name',response.first_name);
							//$location.path(prevUrl);  
							
							$('#loginDiv').hide();
							$('#registerDiv').hide();
							$('#forgotDiv').hide();
							$('#verifyDiv').show();
						}else{	
							$scope.errorMsg=response.message;
						}
					});	
		  }
		
		
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
									//$location.path('/'); 
									$scope.member_id=response.member_id;
									$scope.name=response.first_name;
									$('#loginDiv').hide();
									$('#registerDiv').hide();
									$('#forgotDiv').hide();
									$('#verifyDiv').hide();
									$('#locationdetails').show();
									
								}else{	
									$scope.errorMsg=response.message;
								}
							});	
							
							
						}else{	
							$scope.resetError=response.message;
						}
					});	
		  }		
});
