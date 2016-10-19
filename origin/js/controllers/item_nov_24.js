OrderWeb.controller('itemCntrl', function($scope,$http,config,$rootScope,$location,$localstorage,Scopes,Facebook) {
	
	$scope.member_id	=	$localstorage.get('member_id');
	$scope.name		=	 $localstorage.get('name');
	
	$scope.selection=[];									  
								  
	$scope.optionArray=[];	
	$scope.totalPrice=0;
	$scope.subtotal=0;
	$scope.salesTax=0;
	var itemprice	=0;
	$scope.details = Scopes.get('details');
	//console.log($scope.details);
	$scope.newArray=[];
	$scope.newSidesArray=[];
	$scope.arrayTest=[];
	$scope.selectedRequiredID=[];
	$scope.selectedRequiredIDAll=[];
	//$localstorage.set('orderArray','');
	//console.log(typeof Scopes.get('OneController'));	
	if(typeof Scopes.get('OneController') != 'undefined' )
	{	
		$scope.orderArray =[];
		$scope.orderArray = Scopes.get('OneController');
		$scope.totalPrice = Scopes.get('totalPrice');
		console.log($scope.orderArray);
		
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
		$http({
            method : 'POST',
            url : config.clientUrl+'getRestaurantMenu',
			data : {'location_id':location_id,'restaurant_id':restaurant_id}
        }).success(function(response){
			if(response.status=='success'){
				$scope.categoryList=response.result;
				//console.log ($scope.restaurantList);
			}else{	
				
			}
		});	
	}else{
		$location.path('/');
	}
		
		/*$http({
            method : 'POST',
            url : config.clientUrl+'getRestaurantMenu',
			data : {'location_id':location_id,'restaurant_id':restaurant_id}
        }).success(function(response){
			if(response.status=='success'){
				$scope.categoryList=response.result;
				//console.log ($scope.restaurantList);
			}else{	
				
			}
	});	*/
		
	$scope.login=function(){
		//$localstorage.set('orderArray',$scope.orderArray);
		//console.log($localstorage.get('orderArray'));
		$scope.orderArray=Scopes.store('OneController', $scope.orderArray);
		//console.log($scope.orderArray);
		$localstorage.set('path','/items');
		$location.path('/login');	
	}
	$scope.checkout=function(){
		//console.log($scope.orderArray);
		Scopes.store('OneController', $scope.orderArray);
		Scopes.store('totalPrice',$scope.totalPrice);
		//alert($scope.member_id);
		//console.log($scope.orderArray);
		//alert($scope.totalPrice);
		if(typeof $scope.member_id != 'undefined'){
			$scope.authLogin='yes';
			$scope.item_id='';
			$http({
				method : 'POST',
				url : config.clientUrl+'getAllDetails',
				data : {'restaurant_id':$localstorage.get('restaurant_id'),'location_id':$localstorage.get('location_id'),'member_id':$localstorage.get('member_id')}
				}).success(function(response){
					if(response.status=='success'){
						$scope.orderArray = Scopes.get('OneController');
						
						$scope.totalPrice = Scopes.get('totalPrice');
						//console.log($scope.orderArray);
						
						$scope.profile_details=response.profile_details;
						//var salesTax=($scope.totalPrice*response.salesTax)/100;
						$scope.subtotal=$scope.totalPrice;
						//alert($scope.totalPrice);
						$scope.salesTax=($scope.subtotal*response.salesTax)/100;
						$scope.salesTaxValue=response.salesTax;
						$scope.subtotal=$scope.salesTax + $scope.subtotal;
						$scope.total=$scope.subtotal;
						//alert($scope.totalPrice);
						Stripe.setPublishableKey(response.stripe_public_key);
						//console.log (response);
					}else{	
						
					}
			});	
			//alert($scope.item_id);
			//$location.path('/checkout');	
		}else{
			$localstorage.set('path','/items');
			$location.path('/login');	
		}
		
	}
	/*$scope.logout = function () {
			Facebook.logout(function(response) {
				//console.log(response);					 
				$localstorage.remove('member_id');
				$localstorage.remove('name');
				$location.path('#/');	
			});
	}*/
	$scope.logout = function () {
			var userType=$localstorage.get('userType');
			//alert(userType);
			if(userType=='FB'){
				$localstorage.remove('member_id');
				$localstorage.remove('name');
				$location.path('#/');	
					
				Facebook.logout(function(response) {
					//console.log(response);					 
					$localstorage.remove('member_id');
					$localstorage.remove('name');
					$scope.orderArray =[];
					Scopes.store('OneController',$scope.orderArray);
					$scope.totalPrice=0;
					Scopes.store('totalPrice',$scope.totalPrice);
					$location.path('#/');	
				});
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
	
	$scope.validatePhone=function(){
		var phone 	= $scope.pay_phone ;
		var PHONE_REGEXP = /^\+?\d{2}[- ]?\d{3}[- ]?\d{5}$/;
		if(PHONE_REGEXP.test(phone)) {
		   $scope.errorphone="";
		   $scope.phoneNo=phone;
		   return true;
        }else{
		   $scope.errorphone="Invalid phone number.";
		   return false;
		}
	}
	$scope.payment=function(){
		
		Stripe.setPublishableKey("pk_test_T3Vj6s3bW9jDEXoldVYJBoQx");
		
		var phone 	= $scope.pay_phone ;
		var cardno	= $scope.cardno ;
		var month 	= $scope.card_month ;
		var year 	= $scope.card_year ;
		var cvv 	= $scope.card_cvv ;
		
		  if(!Stripe.card.validateCardNumber(cardno)){				
		   		$scope.errorPaymentInfo="Invalid card number";
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

			
		
		
	}
	var stripeResponseHandler = function(status, response){
		
		if (response.error) {
			//alert(response.error.message);
			$scope.errorPaymentInf=response.error.message;
			//console.log(response);
			$('#spinn').hide();
			return false;
		}else{
			var token = response.id;
			var last4 = response.card.last4;
			var brand = response.card.brand;
			var data = {'token':token,'last4':last4,'brand':brand};
			//console.log(response);
			$scope.payment_data = data;
			$scope.addOrder();
			//console.log(response);
			
		}
	 }
	 
	 
	  $scope.addOrder = function(){
		  	
			var select_option_name={};
			var select_side_price={};
			var select_side_name={};
			var i=0;
			$scope.orderArray=Scopes.get('OneController');	

					var cart_data = $scope.orderArray;
					//console.log(cart_data);
					//cart_data.selected_option_array = {};
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
					//alert($scope.orderArray);
					//console.log($scope.orderArray);
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
									  'payment_data':$scope.payment_data
									  }
									  
					////OrderDetailsFactory.getData('delivery_time').toString()
					
					//console.log(order_data);
					$http({
						method : 'POST',
						url : config.clientUrl+'checkout',
						data : {'order_data':order_data}
						}).success(function(response){
						$('#spinn').hide();
						//console.log(response);
							if(response.error)
							{
								$scope.errorPaymentInfo=response.error;
							}else if(response.status!='error'){
								//$scope.errorPaymentInfo=response.error;
								$("#getCodeModal").modal('show');
								//$state.go('app.ordersuccess',{id:result.order_id},{reload:true}); 
							}else{ 
								
							}
						
						}).error(function(data, status, headers, config) {
					});
					
					
											  
			
		}
		
	$scope.completeOrder = function(){
		
		$(".modal-backdrop").hide();
		$location.path('/');
	 	//$scope.item_id='';
		$scope = $scope.$new(true);
		Scopes.store('details','');
		//$scope.details = Scopes.get('details');
		//$scope.OneController = Scopes.get('OneController');
		Scopes.store('OneController','');
		//console.log($scope.details );
		//console.log($scope.OneController);
	}
	 
	 
	$scope.findTip = function(percentage){
		//alert($scope.totalPrice);
		var tip=($scope.totalPrice*percentage)/100;
		$scope.tip=tip;
		
	}
	$scope.promocodeApply = function(){
		//alert($scope.totalPrice);
		var promocode=$scope.promocode;
		$http({
				method : 'POST',
				url : config.clientUrl+'checkPromocode',
				data : {'restaurant_id':$localstorage.get('restaurant_id'),'location_id':$localstorage.get('location_id'),'promocode':promocode}
				}).success(function(response){
				
				if(response.status=='success'){
					$scope.promocodeDetails=response.data;
					if($scope.promocodeDetails.discount_type=='Fixed amount'){
						//alert("Fixed amount");
						$scope.promoDiscout=$scope.promocodeDetails.discount_amount;
						//$scope.promoDiscout=$scope.totalPrice-$scope.promoDiscout;
					}else{
						$scope.promoDiscout=($scope.totalPrice*$scope.promocodeDetails.discount_amount)/100;
						//alert("%");
					}
					var tot=$scope.totalPrice-$scope.promoDiscout;
					$scope.salesTax=(tot*$scope.salesTaxValue)/100;
					$scope.total=$scope.salesTax + tot;
						
						
					//$scope.promoDiscout=
					//var salesTax=($scope.totalPrice*response.salesTax)/100;
					//console.log (response);
				}else{	
					$scope.promoError=response.message;
					//console.log (response);
					//alert($scope.promoError);
				}
		});	
		
	}
	
	$scope.selectItem = function(item_id){
		$('#spinner').show();
		$scope.edititem_id='';
		$scope.item_id=item_id;
		$scope.specialIns='';
		$scope.arrayTest=[];
		$scope.selectedRequiredID=[];
		$http({
            method : 'POST',
            url : config.clientUrl+'getRestaurantMenuDetail',
			data : {'item_id':item_id}
        }).success(function(response){
			if(response.status=='success'){
				$scope.itemDetail=response.result;
				$scope.quantity=1;
				$scope.item_name=response.result.item_name;
				$scope.price=$scope.itemDetail.sizes[0].price;
				$scope.selection[item_id]=[];
				$scope.newArray=[];
				$scope.requiredIDS=[];
				$scope.Sideindex='';
				//console.log ($scope.selection[item_id]);
				$scope.oneSize=[];
				$scope.multipleSize=[];
				
				if($scope.itemDetail.sizes.length==1){
					//alert($scope.itemDetail.sizes.length);
					$scope.oneSize.push({'size':$scope.itemDetail.sizes[0]['size'],'price':$scope.itemDetail.sizes[0]['price']});
				}else{
					angular.forEach($scope.itemDetail.sizes, function (val) {
						$scope.multipleSize.push({'size':val['size'],'price':val['price']});
					});
					//alert($scope.itemDetail.sizes.length);
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
				
				//console.log($scope.requiredIDS);	 
				//console.log($scope.arrayTest);	
				
				
			}else{	
				
			}
			$('#spinner').hide();
		});	
		
		
	}
	
	$scope.editItem = function(item_id,index){
		$scope.edititem_id='';
		$scope.item_id=item_id;
		$scope.edititem_id=item_id;
		$scope.editindex=index;
		$scope.selectedRequiredID=[];
		//alert($scope.selection[item_id][optid]);
		//alert($scope.selection[item_id][88]);
		$scope.arrayTest=[];
		
		angular.forEach($scope.orderArray[index]['options'], function (item) {
			angular.forEach(item['sides'], function (item1) {
				//console.log(item1);
				angular.forEach($scope.itemDetail.side_id[item], function (item1) {
					$scope.arrayTest[item1]=[];
					$scope.arrayTest[item1].push({'checkid':item1,'selected':false});
				});
				$scope.arrayTest[item1.sideid]=[];
				$scope.arrayTest[item1.sideid].push({'checkid':item1.sideid,'selected':true});
			});
			
			
        });
		//console.log( $scope.orderArray[index]);
		$http({
            method : 'POST',
            url : config.clientUrl+'getRestaurantMenuDetail',
			data : {'item_id':item_id}
        }).success(function(response){
			if(response.status=='success'){
				$scope.itemDetail=response.result;
				$scope.quantity=$scope.orderArray[index]['quantity'];
				$scope.specialIns=$scope.orderArray[index]['specialIns'];
				$scope.Sideindex=$scope.orderArray[index]['Sideindex'];
				
				$scope.item_name=response.result.item_name;
				$scope.price=$scope.itemDetail.sizes[0].price;
				$scope.requiredIDS=[];
				
				angular.forEach($scope.itemDetail.option_id, function (item) {
					if($scope.itemDetail.is_mandatory[item]=='Y'){
				 		$scope.requiredIDS.push({'optid':item,'opname':$scope.itemDetail.option_name[item]}); 
					}
				});
				
				//$scope.selection[item_id]=[];
				//console.log ($scope.itemDetail);
			}else{	
				
			}
		});	
	}
	

	$scope.goToLocation = function() {
	  $scope.showModal = true;
	  $scope.orderArray=[];
	  $scope.orderArray=Scopes.store('OneController',$scope.orderArray);
	  $scope.totalPrice=0;
	  Scopes.store('totalPrice',$scope.totalPrice);
	  $scope.salesTax=0;
	  Scopes.store('salesTax',$scope.salesTax);
	};
		
	$scope.notCancelOrder = function() {
	  $scope.showModal = false;
	};
		
	$scope.cancelOrder = function() {
	  	$scope.showModal = false;
	  
	 	
	  $scope.item_id='';
	  $location.path('/');
	  
	  
	};
  
	$scope.goToMenu = function(){
		$scope.item_id='';
		$scope.edititem_id='';
		$scope.editindex='undefined';
		//$scope.selection='';
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
	  $scope.toggleSelection = function toggleSelection(sideid,item_id,optid,limit) {
			 //alert(limit);
			 $scope.newArray[item_id] = ( typeof $scope.newArray[item_id] != 'undefined' && $scope.newArray[item_id] instanceof Array ) ? $scope.newArray[item_id] : [];
			 
			
			 $scope.selectedRequiredIDAll[optid] = ( typeof $scope.selectedRequiredIDAll[optid] != 'undefined' && $scope.selectedRequiredIDAll[optid] instanceof Array ) ? $scope.selectedRequiredIDAll[optid] : [];
			 
			 //alert($scope.selectedRequiredIDAll[optid]);
			 var idx3 = $scope.selectedRequiredIDAll[optid].indexOf(sideid);
			 
			 var idx2 = $scope.newArray[item_id].indexOf(sideid);
			 if (idx2 > -1) {
				$scope.newArray[item_id].splice(idx2, 1);
				//$scope.arrayTest[sideid].splice(idx2, 1);
				//$scope.arrayTest[sideid].push({'checkid':sideid,'selected':false});
			 }
			 // is newly selected
			 else {
			    $scope.newArray[item_id].push(sideid);
				//$scope.arrayTest[sideid].splice(0, 1);
				//$scope.arrayTest[sideid].push({'checkid':sideid,'selected':true});
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
			 // is newly selected
			 else {
			   $scope.selection[item_id][optid].push(sideid);
			 }
			 
			 
			 if(limit!=''){
				 if($scope.selection[item_id][optid].length > limit ){
					//alert(idx);
					// console.log($scope.arrayTest[sideid]);
					$scope.arrayTest[sideid].splice(idx, 1);
					$scope.arrayTest[sideid].push({'checkid':sideid,'selected':false}); 
					$scope.selection[item_id][optid].splice(idx, 1);
					$("#errormodal").modal('show');
				 }else if($scope.selection[item_id][optid].length == limit ){
					 if($scope.itemDetail.is_mandatory[optid]=='Y'){
					 	$scope.selectedRequiredID.push(optid); 
					 }
				 }else{
					var indexar = $scope.selectedRequiredID.indexOf(optid);
					if (indexar >= 0) {
					  $scope.selectedRequiredID.splice(indexar, 1 );
					} 
				 }
			 }else{
				//alert($scope.itemDetail.is_mandatory[optid]);
				var flg=0;
				
				
				 
				if($scope.itemDetail.is_mandatory[optid]=='Y'){
					//alert("1");
					angular.forEach($scope.selectedRequiredID, function(valu) {
						if(valu==optid){//alert("2");
							flg=1;
							var indexar = $scope.selectedRequiredID.indexOf(optid);
							
							if (indexar >= 0) {
							  //$scope.selectedRequiredID.splice(indexar, 1 );
							} 
							}
					});
					if(flg!=1){//alert("3");
				 		$scope.selectedRequiredID.push(optid); 
					}else{//alert("4");
						//$scope.selectedRequiredID.push(optid); 
					}
					if($scope.selectedRequiredIDAll[optid].length==0){
						var indexar = $scope.selectedRequiredID.indexOf(optid);
						$scope.selectedRequiredID.splice(indexar, 1 );
					}
				}
			 }
			 console.log($scope.selectedRequiredID);
			 //console.log($scope.selectedRequiredIDAll[optid]);
			 
			 //alert($scope.itemDetail.is_mandatory[optid]);
			 //console.log($scope.selectedRequiredID);
			 //alert($scope.selection[item_id][optid].length);
			 //console.log($scope.arrayTest[sideid]);
			 //$scope.selection[item_id][optid].push(sideid);
			 //console.log($scope.selection[item_id]);
			 //alert($scope.selection[item_id][optid]);
			 //alert($scope.selection[item_id][optid].indexOf(sideid));
	   }
	   
	   $scope.addToOrder=function(item_id,Sideindex){
		  //$scope.requiredIDS;
		  //$scope.selectedRequiredID;
		   $scope.notSelectOptID=[];
		   //alert($scope.selectedRequiredID.length);
		   //alert($scope.requiredIDS.length);
		   if($scope.selectedRequiredID.length==$scope.requiredIDS.length){
			   $('#spinner').show();
			   //$scope.optionArray = ( typeof $scope.optionArray != 'undefined' && $scope.optionArray instanceof Array ) ? $scope.optionArray : [];
			   $scope.subtotal=0;
			   
			   //alert($scope.selection[item_id]);
			   $scope.optionArray =  [];
		   
			   angular.forEach($scope.selection[item_id], function(value, key) {
					
					$scope.sidesArray =  [];
					angular.forEach(value,function(value1, key1) {
						$scope.sidesArray.push({'sideid':value1,'sideitem':$scope.itemDetail.side_item[key][value1],'sidePrice':$scope.itemDetail.side_price[key][value1]});
						if($scope.itemDetail.side_price[key][value1]!='' && $scope.itemDetail.side_price[key][value1]!=0 )
							$scope.subtotal	=parseFloat($scope.subtotal)+ parseFloat($scope.itemDetail.side_price[key][value1]);
					});
					
					$scope.optionArray.push({'optid':key,'optTitle':$scope.itemDetail.option_name[key],'sides':$scope.sidesArray});
					//console.log($scope.itemDetail.side_item[key][value[0]]);
					//console.log($scope.sidesArray);								   
					//$scope.array.push({'JobId' : JobId});
				});
		   
		   //$scope.orderArray=[];
			   var qnty=$scope.quantity;
			   var specialIns=$scope.specialIns;
			   var price=$scope.price;
			   var item_name=$scope.item_name;
			   //$scope.subtotal	=	parseFloat($scope.subtotal)+parseFloat($scope.price);
			   //$scope.totalPrice	=  qnty * parseFloat($scope.subtotal);
			   //$scope.totalPrice	= parseFloat($scope.totalPrice)+ parseFloat($scope.subtotal);
			   
			   $scope.subtotal	=	parseFloat($scope.subtotal)+parseFloat($scope.price);
			   $scope.subtotal	=  qnty * parseFloat($scope.subtotal);
			   $scope.totalPrice	= parseFloat($scope.totalPrice)+ parseFloat($scope.subtotal);
			   if($scope.edititem_id!=''){
				   $scope.orderArray.splice($scope.editindex, 1);
			   
			   }
		   
		   //alert($scope.totalPrice);
		   
		   //tax details 
			   $http({
					method : 'POST',
					url : config.clientUrl+'getTaxDetails',
					data : {'restaurant_id':$localstorage.get('restaurant_id')}
					}).success(function(response){
						if(response.status=='success'){
							$scope.tax=response.salesTax;
							$scope.salesTax=($scope.totalPrice*response.salesTax)/100;
							$scope.salesTaxValue=response.salesTax;
							Scopes.store('salesTax',$scope.salesTax);
	
							//$scope.totalPrice=$scope.salesTax + $scope.totalPrice;
							$scope.total=$scope.salesTax + $scope.totalPrice;
						}else{	
							
						}
				});	
		   
			   if(typeof Sideindex == 'undefined' )
			   {
					var ind	=	$scope.newSidesArray.push($scope.newArray[item_id]);
					$scope.orderArray.push({'item_id':item_id,'quantity':qnty,'specialIns':specialIns,'item_name':item_name,'salesTax':$scope.salesTax,'price':price,'options':$scope.optionArray,'Sideindex':ind-1});
			   }else{
					var ind	=Sideindex;
					$scope.orderArray.push({'item_id':item_id,'quantity':qnty,'specialIns':specialIns,'item_name':item_name,'salesTax':$scope.salesTax,'price':price,'options':$scope.optionArray,'Sideindex':ind});
			   }
			   
			   
			   $scope.item_id='';
			   $('#spinner').hide();
			  
				//console.log($scope.orderArray);
				//alert($scope.totalPrice);
				var iprice=0;
				angular.forEach($scope.orderArray, function(value, key) {
					var sideprice=0;
					//console.log(value['options']);
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
				//alert(itemprice);
				itemprice=parseFloat(iprice)+parseFloat(itemprice);	
				
				$scope.totalPrice=itemprice;
				
				//alert($scope.totalPrice);
				
		   }else{
			   
			   angular.forEach($scope.requiredIDS, function(value) {
					if($scope.selectedRequiredID.indexOf(value['optid']) > -1){
						//alert(value['optid']);alert($scope.selectedRequiredID.indexOf(value['optid']));
					}else{
						$scope.notSelectOptID.push(value);
					}
			   		//$scope.selectedRequiredID.length==$scope.requiredIDS.length
			   });
			   
			   $("#errorRequired").modal('show');
		   }
		   				   
	   }
	   
	   
	   $scope.removeFromCart=function(remItemid,index){
			if($scope.editindex!=index){
				//console.log($scope.orderArray);
				var itempricenew	=0;
				angular.forEach($scope.orderArray, function(value, key) {
					var sideprice=0;
					if(value['item_id']==remItemid){
						angular.forEach(value['options'],function(optionsvalue, key1) {
							angular.forEach(optionsvalue['sides'],function(sidesvalue, key1) {
								sideprice	=	parseFloat(sideprice) + parseFloat(sidesvalue['sidePrice']);
							});
						});
						itempricenew	= value['quantity'] * (parseFloat(sideprice)+ parseFloat(value['price']));
					}
				});
				$scope.totalPrice=parseFloat($scope.totalPrice)-parseFloat(itempricenew);
				itemprice=parseFloat(itemprice)-parseFloat(itempricenew);
				
				$scope.salesTax=($scope.totalPrice*$scope.tax)/100;
				$scope.total=$scope.salesTax + $scope.totalPrice;
						
		   		$scope.orderArray.splice(index, 1);

				//alert(itemprice);
		    }
	   }
	   $scope.changeSize=function(){
		   //alert($scope.multipleSize.indexOf($scope.selSize));
		   console.log($scope.multipleSize);
		   /*angular.forEach($scope.multipleSize, function(value) {
				if(value['size']==$scope.selSize){
					alert();	
				}
		   }
		   alert($scope.selSize);*/
	   }
	
});

