<div class="wrapper">
       <div data-ng-view> </div>
</div>

<div id="fb-root"></div>
 

<div class="wrapper" id="main_wrapper"  ng-controller="homeCntrl">

<div id="locationdetails" class="layout-main col yelp__col--main" style="width: 1025px;">
<!-- ---------header area login/ogout ---------------- -->
    <input type="hidden" id="testInput"   ng-model="data.resID"  ng-init="test(<?php echo $resID; ?>)"/>
    
    
    <div id="" class="ember-view loc-picker container--with-fixed-header">
    <div class="drawer-header container__fixed-header clearfix accordion-offset" style="width: 1025px;">
    
    
  	<span class="pull-left heading--comp heading--xsm header-brand">
        <div id="" class="ember-view cn-powered-logo">
        <a href="http://newagesme.com/forkourse/" target="_blank">
        <img height="19" class="cn-logo" alt="Powered by Forkourse" src="">
        </a>
    </div>
    </span>
    <span class="pull-right session-header drawer-header__action" ng-hide="member_id">
    <a class="heading pull-right session-header drawer-header__action" data-ember-action="1277" ng-click="login()">
    	<span class="ss-gizmo ss-user"></span> Log In <?php echo $test;?>
        
        
    </a>
    </span>
    <span class="pull-right session-header drawer-header__action" ng-show="member_id">
    	<span class="session-header__greet">Hi, {{name}}</span>
    	<a href="javascript:" ng-click="logout()"> Log Out</a>
    </span>
</div>


<!-- ---------Choose Location Area ---------------- -->



<ul id="" class="ember-view accordion">
    <li id="" class="ember-view accordion__pane is-active">
    
        <div class="accordion__pane-header" ng-click="removeRes()">
          <span ng-if="title" class="heading heading--med heading--accordion" ng-model="title">
          {{title}}
          </span>
          <span ng-if="!title" class="heading heading--med heading--accordion" ng-model="title">
          Choose Location
          </span>
          <span class="accordion__pane-header-step ss-gizmo ss-write"></span>
        </div>
        
        <div class="accordion__pane-body js-locations-list-container" style="">
          <ul class="accordion__pane-menu" id="choose_location_div" >
            <li  ng-repeat="list in restaurantList" ng-click="selectRes(list.restaurant_name,list.location_id,list.city)">
              <a href="javascript:" data-ember-action="1280" class="accordion__pane-choice ">
                <span class="heading heading--link">{{list.restaurant_name}} - {{list.city}}</span> <!---->
                <input type="hidden" ng-model="list.restaurant_name"  />
                  <address>
                      {{list.address}}, {{list.city}} {{list.state}} {{list.zip_code}}
                  </address>
              </a>
            </li>
          </ul>
        </div>
    </li>

<!-- ---------choose Order Now/Later area ---------------- -->


<li id="" class="ember-view accordion__pane is-active">
    <div class="accordion__pane-header" data-ember-action="3559"  ng-click="removeOrderTime()">
      <span ng-if="orderTimeTitle" class="heading heading--med heading--accordion" ng-model="orderTimeTitle">
      {{orderTimeTitle}}
      </span>
      <span ng-if="!orderTimeTitle" class="heading heading--med heading--accordion" ng-model="orderTimeTitle">
      Choose a Time
      </span>
    </div>

    <div class="accordion__pane-body" id="chooseTime_div" style="display:none;">
    
      <ul class="accordion__pane-menu" id="div_orderTimeTitle" >
      
        <li ng-click="selectOrderTime('Now')" style="display:none" id="div_order_available">
          <a href="javascript:" data-ember-action="3560" class="accordion__pane-choice ">
              <span class="heading heading--link">Order for Now</span>
              <p>Have your ordered prepared as soon as possible.</p>
          </a>
        </li>
        
        <li ng-click="viewOpeningTimes()" style="display:none" id="div_order_unavailable">
          <a href="javascript:" data-ember-action="3560" class="accordion__pane-choice ">
              <span class="heading heading--link">Order for Now(Unavailable)</span>
              <p>Order for Now is not available at this time. Click here to see hours.</p>
          </a>
        </li>
        
        <li ng-click="selectOrderTime('Later')">
            <a class="accordion__pane-choice" href="javascript:" data-ember-action="4168">
                <span class="heading heading--link">Order for Later</span>
                <p>Have your order prepared at a specified future date &amp; time.</p>
            </a>
        </li>
      </ul>
      
    <div class="ember-view  order-ahead" id="div_orderTimeLater" style="display:none;">
        <div class="order-ahead__days">
            <div class="order-ahead__header">
               <span>Choose a Date &amp; Time</span>
                  <a href="javascript:" ng-click="removeOrderTime()" class="order-ahead__close" data-ember-action="3563">
                  Back</a>
            </div>
            <ul class=" day-picker">
                <li class="" ng-repeat="(key, value) in laterDates[0]" ng-click="selectLaterDate(key,value)">
                    <a class="  ">
                        <span class="day-picker__day-word">
                            {{key}}
                        </span>
                        <span class="day-picker__day-number">{{value}}</span>
                    </a>
                </li>
            </ul>     
        </div>
    
    
    <div class="order-ahead__times">
    	<div id="div_laterDate" class="ember-view time-picker">           
             <ul style="overflow:scroll; max-height: 500px;">
                 <li ng-show="resClosed">Unavailable</li>
                    <li class="" ng-repeat="timeAr in timeArray.time"  id="{{$index}}">
                        <span  ng-hide="timeAr.showfull" ng-click="showConfirm(timeAr)" >{{timeAr.start}} </span>
                        <ul class="time-picker__methods">
                          <li> <span class="ss-icon ss-check text--success"></span><strong>pickup </strong></li>
                         
                        </ul>
                        <a ng-show="timeAr.showfull"  href="javascript:"  ng-click="selectLaterOrderTime(timeAr)" class="btn btn-success btn-block">
                            Confirm {{timeAr.start}} 
                        </a>
                        
                 </li>
             </ul>
         </div>     
    </div>
        
    
    
    </div></div>
</li>


<!-- ---------Choose method Pickup/Delivery area ---------------- -->


<li class="ember-view accordion__pane is-active" >
    <div class="accordion__pane-header" data-ember-action="3567" ng-click="removeOrderType()">
      <span ng-if="orderType" class="heading heading--med heading--accordion" ng-model="orderType">
      {{orderType}}
      </span>
      <span ng-if="!orderType" class="heading heading--med heading--accordion" ng-model="orderType">
      Choose a Method
      </span>
    
     
     </span>
    </div>
    
    
    <div id="div_orderTime" class="accordion__pane-body" style="display:none; ">
    
      <ul class="accordion__pane-menu"  id="div_orderType">
        <li ng-click="selectOrderType('Pickup')">
          <a href="javascript:" data-ember-action="4195" class="accordion__pane-choice ">
            <span class="heading heading--link">Pickup</span>
            <p>Pickup your order at the <strong>{{city}}</strong> location.</p>
          </a>
        </li>
        <li ng-click="selectOrderType('Delivery')">
          <a href="javascript:" data-ember-action="4198" class="accordion__pane-choice ">
              <span class="heading heading--link">Delivery</span>
              <p>
                Your order will be delivered to you
                  as soon as possible.
              </p>
          </a>
        </li>
      </ul>
    
    <div id="div_orderTypeDelivery" class="ember-view ember-view__accordion-overlay" >
    <div class="ember-view ember-view__delivery-address-checker">
    <form ng-submit="saveDeliveryAddress()">
      
    
      <div id="" class="ember-view">  
      <div class="row pad-top">
        <h4>Delivery Address </h4>
    
          <div class="">
            <div id="" class="ember-view">  
            <div class="form-group">
        <input type="text" id="" class="form-control" ng-model="delivery.address" placeholder="Street Address" name="street address 1" required>
        
      </div>
        <div class="form-group">
          <input type="text" id="" class=" form-control" ng-model="delivery.instruction" placeholder="Delivery Instructions" name="street address 2">
        </div>
      <div class="form-group ">
        <div class="col col--6">
          <input type="text" id="" class=" form-control" placeholder="City" ng-model="delivery.city" name="city" required>
         
        </div>
        <div class="col col--3 col--4--sm">
          <div id="ember3840" class="ember-view">
          <div class="">
      <select id="ember3847" class=" form-control"  ng-model="delivery.state"  name="state" required>
      <option value="">State</option>
      <option class="ember-view" value="AL">AL</option>
      <option  value="AK">AK</option>
      <option  value="AS">AS</option>
      <option  value="AZ">AZ</option>
      <option  value="AR">AR</option>
      <option  value="CA">CA</option>
      <option  value="CO">CO</option>
      <option  value="CT">CT</option>
      <option  value="DC">DC</option>
      <option  value="DE">DE</option>
      <option  value="FL">FL</option>
      <option  value="GA">GA</option>
      <option  value="GU">GU</option>
      <option  value="HI">HI</option>
      <option  value="ID">ID</option>
      <option  value="IL">IL</option>
      <option  value="IN">IN</option>
      <option  value="IA">IA</option>
      <option  value="KS">KS</option>
      <option  value="KY">KY</option>
      <option  value="LA">LA</option>
      <option  value="ME">ME</option>
      <option  value="MD">MD</option>
      <option  value="MA">MA</option>
      <option  value="MI">MI</option>
      <option  value="MN">MN</option>
      <option  value="MO">MO</option>
      <option  value="MP">MP</option>
      <option  value="MS">MS</option>
      <option  value="MT">MT</option>
      <option  value="NE">NE</option>
      <option  value="NV">NV</option>
      <option  value="NH">NH</option>
      <option  value="NJ">NJ</option>
      <option  value="NM">NM</option>
      <option  value="NY">NY</option>
      <option  value="NC">NC</option>
      <option  value="ND">ND</option>
      <option  value="OH">OH</option>
      <option  value="OK">OK</option>
      <option  value="OR">OR</option>
      <option  value="PA">PA</option>
      <option  value="RI">RI</option>
      <option  value="SC">SC</option>
      <option  value="SD">SD</option>
      <option  value="TN">TN</option>
      <option  value="TX">TX</option>
      <option  value="UM">UM</option>
      <option  value="UT">UT</option>
      <option  value="VT">VT</option>
      <option  value="VA">VA</option>
      <option  value="VI">VI</option>
      <option  value="WA">WA</option>
      <option  value="WV">WV</option>
      <option  value="WI">WI</option>
      <option  value="WY">WY</option>
    </select>
    </div>
    </div>
          
        </div>
        <div class="col col--3 col--4--sm">
          <input type="text" id="ember3842" class="ember-view ember-text-field form-control" ng-model="delivery.zip"  placeholder="Zip" name="zip" required>
          
        </div>
      </div>
      
      
      <div id="ember3837" class="ember-view alert alert--error" ng-show="errormsg">{{errormsg}}</div>
      
      
    </div>
          </div>
      </div>
    </div>
    
    <div id="spinner" class="ember-view spinner-overlay is-transparent is-hidden">
    <div class="spinner spinner spinner--absolute"></div>
    </div>
    
    
    <!---->
    <!---->
        <hr>
    
        <div class="actions">
          <div class="col col--6">
            <a class="btn btn-default btn--sm btn-block" ng-click="removeOrderType()">Cancel</a>
          </div>
          <div class="col col--6">
            <button class="btn btn-primary btn--sm btn-block" data-ember-action="3701">Next</button>
          </div>
        </div>
    
    </div>
    </div></div>
</li>


<!-- --------- Confirm Area ---------------- -->




<li id="orderTypeContifm" class="ember-view accordion__pane is-active" style="display:none;">
<div class="accordion__pane-body accordion__pane-body--confirm" style="height: 629px;">
  <div class="wrap-pad">
    <a class="btn btn-primary btn-block" ng-click="confirmMenu()" >Confirm and View Menu</a>
  </div>
</div>
</li>
</form>

</ul>
</div>
</div>



 


<!-- -----------------------item list starting------------------------ -->


<div id="itemdetails" class="ember-view ember-view__application" style="display:none">
<div id="" class="ember-view ember-view__order">
<div class="drawer clearfix">
  

  <div class="layout-main col yelp__col--main" style="width: 1008px;">
    <div id="" class="ember-view ember-view__menu-items container--with-fixed-header" style="display: block; opacity: 1;">
	  <div class="drawer-header menu-header clearfix container__fixed-header" style="position: fixed; top: 0px; width: 1008px;">

      <a href="javascript:" class="back drawer-header__action"  ng-hide="item_id" ng-click="goToLocation()">
      	<span class="ss-icon ss-navigateleft"></span>Locations
      </a>
      
      <a href="javascript:" class="back drawer-header__action" ng-show="item_id" ng-click="goToMenu()">
        <span ng-show="edititem_id">
        	<span class="ss-icon ss-navigateleft"></span>Cancel Edit
        </span>
        <span ng-hide="edititem_id">
        	<span class="ss-icon ss-navigateleft"></span>Menu
        </span>
        
        
      </a>
      
    <span class="pull-right session-header drawer-header__action" ng-hide="member_id">
    <a class="heading pull-right session-header drawer-header__action" ng-click="login()">
    	<span class="ss-gizmo ss-user"></span> Log In
    </a>
    </span>
    <span class="pull-right session-header drawer-header__action"  ng-show="member_id">
    	<span class="session-header__greet">Hi, {{name}}</span>
    	<a href="javascript:" ng-click="logout()"> Log Out</a>
    </span>
    
    
  </div>
  
  
<!--    menu listing   --> 
  <div class="menus" ng-hide="item_id || authLogin">
   <div class="wrap-pad">
      <div class="menus-actions">
        <ul class="menus-actions__btns">
          <li><a href="javascript:" ng-click="showAllDetails = ! showAllDetails">
          <span ng-show="showAllDetails">Collapse All</span>
          <span ng-hide="showAllDetails">Expand All</span>
          </a>
          <span class="divider"> </span>
          </li>
        </ul>
      </div>
   	  <div id="" class="ember-view menu" ng-repeat="category in categoryList" ng-click="showDetails = ! showDetails"> 
          <a class="menu__category--selected heading menu__category">
            <span class="menu__category--name">{{category.category_name}}</span> <span class="ss-gizmo pull-right ss-navigatedown"></span>
          </a>
          <hr>
          <ul class="menu__items" style="display: block;">
              <li ng-repeat="itemslist in category.items"  ng-show="showDetails || showAllDetails" ng-click="selectItem(itemslist.item_id)">
                <a class="menu-item" >
                  <span class="heading heading--link">{{itemslist.item_name}}</span>
                  <p class="menu-item__description"><!----></p>
                  <span class="price">${{itemslist.price | number:2}}</span>
                </a>
              </li>
          </ul>
		</div>
    </div>
  </div>
  
<!--    menu listing   --> 
<!--   selected  menu details    --> 
  
<div id="" class="ember-view  ember-view__menu-item" ng-show="item_id">
<div class="item-details">
  <div class="item-details-main">
    <div class="wrap-pad">
      <div class="heading heading--lrg" ng-model="item_name">{{itemDetail.item_name}}</div>
      <span class="price" ng-model="price">${{price | number:2 }}</span>
      <p class="description">{{itemDetail.item_description}}</p>
      
      <div class="col-lg-12" style="padding-left:0px; padding-bottom:20px;">
      <div class="col-lg-6"  style="padding-left:0px;">
        <div class="heading heading--sm">Choose a Quantity</div>
        <div class="col col--6">
          <div class="quantity">
            <div id="" class="ember-view">
            <button type="button" class="btn quantity__minus" ng-click="changeQantity('minus')" ><span class="ss-icon ss-hyphen">-</span></button>
            
			<span class="num-quantity text--center">{{quantity}}</span>
            
            
			<button type="button" class="btn quantity__plus" ng-click="changeQantity('add')" ><span class="ss-icon ss-plus">+</span></button>
			</div>
          </div>
        </div>
      </div>
      
      <div class="col-lg-6"  style="padding-left:0px;" ng-show="multipleSize.length">
        <div class="heading heading--sm">Choose a Size</div>
        <div class="col col--12">
            <div id="" class="ember-view">
           	<select style="width:100%; height:37px;" ng-change="changeSize()" ng-model="size">
            	<option ng-repeat="sizes in multipleSize">{{sizes.size}}</option>
            </select> 
			</div>
        </div>
      </div>
      
      </div>
      
      
    </div>
  </div>
  
    <div class="item-options">
    	<div class="wrap-pad">
       
         <div class="ember-view ember-view__mod-group is-invalid" ng-repeat="optid in itemDetail.option_id" id="{{$index}}" >
            <header class="heading--sm">{{itemDetail.option_name[optid]}}
            <span class="mod-qty" ng-show="itemDetail.multiple_limit[optid]">({{itemDetail.multiple_limit[optid]}})</span>
            
            <span class="is-invalid required" ng-show="itemDetail.is_mandatory[optid]=='Y'">Required</span>
        </header>
        <ul class="item-options-list">
            <li ng-repeat="sideid in itemDetail.side_id[optid]" >
              <a href="javascript:">
                
                <input id="{{sideid}}" type="checkbox" value="{{itemDetail.side_item[optid][sideid]}}" ng-model="arrayTest[sideid][0].selected"  ng-click="toggleSelection(sideid,itemDetail.item_id,optid,itemDetail.multiple_limit[optid])"  ng-disabled="checked" />
                
                
                <!--<input id="{{sideid}}" type="checkbox" value="{{itemDetail.side_item[optid][sideid]}}" ng-model="arrayTest[sideid][0].selected"  ng-checked="newSidesArray[Sideindex].indexOf(sideid) > -1" ng-click="toggleSelection(sideid,itemDetail.item_id,optid,itemDetail.multiple_limit[optid])"  ng-disabled="checked" />-->
              
                
                <span class=" mod-label">
                  {{itemDetail.side_item[optid][sideid]}}
                </span>
                <span class="price" ng-show="itemDetail.side_price[optid][sideid]">
                  ${{itemDetail.side_price[optid][sideid] | number:2 }}
                </span>
                <span class="price" ng-hide="itemDetail.side_price[optid][sideid]">
                  &ndash;
                </span>
              </a>
            </li>
          </ul>
          
          
    		</div>
   		</div>
    </div>
  

    <div class="item-instructions">
      <div class="wrap-pad">
        <span class="heading heading--sm"><span class="ss-icon ss-compose"></span> Special Instructions (Optional)</span>
        <div class="form-group">
          <div class="col col--12">
            <input type="text" id="" ng-model="specialIns" class="ember-view ember-text-field form-control" maxlength="80" placeholder="e.g. No salt. (Add food items like Shrimp via options above.)">
            <div id="" class="ember-view alert alert--error is-hidden">false
</div>
          </div>
        </div>
      </div>
    </div>
</div>

<div id="" class="ember-view item__anchor" style="position: fixed; bottom: 0px; z-index: 5; display: block;">  
  <button type="button" class="btn btn-success btn-sml btn-block item__add-to-cart" ng-hide="edititem_id" ng-click="addToOrder(item_id)">Add to Order</button>
  
  <button type="button" class="btn btn-success btn-sml item__add-to-cart btn-block" ng-show="edititem_id" ng-click="addToOrder(item_id,Sideindex)">Save &amp; Continue</button>
  
</div>

</div>

<!--   selected  menu details  end  --> 
<!--   checkout page  start  -->


<div class="checkout" ng-show="authLogin && item_id=='' ">
  <form ng-submit="payment()" name="form" >
    <div class="wrap-pad">
      <div class="block block-contact block--first">
        <div class=" block__header">
          <h5>Contact</h5>
        </div>
        <div class="block__content ">
        
        
              <div class="col-lg-4 col-md-4 ">
                <h4>Name</h4>
              </div>
              <div class="col-lg-8 col-md-8">
                    {{profile_details.first_name}} {{profile_details.last_name}}
                    <a class="block__action" ><span class="ss-icon ss-write"></span></a>
              </div>
           	  <div class="clearfix"></div>
              <div class="col-lg-4 col-md-4">
                <h4>Email</h4>
              </div>
              <div class="col-lg-8 col-md-8">
                {{profile_details.email}}
              </div>
              <div class="clearfix"></div>
              <div class="col-lg-4 col-md-4">
                <h4>Phone</h4>
              </div>
              <div class="col-lg-8 col-md-8">
              	{{phoneNo}}
                <input type="tel" id="" class="ember-view ember-text-field form-control" placeholder="Phone" ng-hide="phoneNo" ng-model="pay_phone" ng-blur="validatePhone()" name="phone number" required>
                
                <div id="ember798" class="ember-view alert alert--error" ng-show="errorphone">{{errorphone}}</div>
                
              </div>
              <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
      </div>

      <div class="block">
        <div class="block__header" >
          <h5>Order Details</h5>
        </div>
        <div class="block__content"  ng-show="details.orderType=='Pickup'">
            <div class="">
                <!--<li class="col col--6">
                <button id="ember835" class="ember-view btn btn-option btn-block active" type="button">Pickup</button>
                </li>-->
            </div>
            <hr>
            <h4>Pickup Location</h4>
            <span>{{restaurantname}}</span>
            <div id="ember849" class="ember-view">
            <address>
                <span class="address__street-address">{{details.resDetails.address}}</span><br>
                <span class="address__city">{{details.resDetails.city}}, </span><br>
                <span class="address__state">{{details.resDetails.state}} </span><br>
                <span class="address__zip">{{details.resDetails.zip_code}}</span>
              </address>
            </div>
        </div>
        
        <div class="block__content"  ng-show="details.orderType=='Delivery'">
            <div class="">
               <!-- <li class="col col--6" ng-show="details.orderType=='Delivery'">
                <button id="ember837" class="ember-view btn btn-option btn-block" type="button">Delivery</button>
                </li>-->
            </div>
            <hr>

            <h4>Delivery Address</h4>
            <div id="ember849" class="ember-view">
            	<address>
                <span class="address__street-address">{{details.deliveryAddress.address}}</span><br>
                <span class="address__city">{{details.deliveryAddress.city}}, </span><br>
                <span class="address__state">{{details.deliveryAddress.state}} </span><br>
                <span class="address__zip">{{details.deliveryAddress.zip}}</span>
                </address>
            </div>
        </div>
        
        
      </div>

      <div class="block block-payment">
        <div class="block__header">
          <h5>Payment</h5>
        </div>
        <div class="block__content">
            <div id="ember865" class="ember-view"><div class="row is-hidden">
  <div class="col col--12">
    <ul class="card-options-list">
        <li >
          <div class="is-checked cc-wrapper">
            <span class="ss-icon ss-record ss-check"></span>
            <div class="cc--details">
                <span>Add New Card</span>
            </div>
        </div>
        </li>
    </ul>

  </div>
</div>

  <div class="billing-form ">

    <div class="form-group ">

      <input type="text" id="" class="ember-view ember-text-field form-control" placeholder="Cardholder Name" ng-model="holdername" name="cardholder name" >
      <div id="" class="ember-view alert alert--error is-hidden">false
</div>
    </div>
    <div class="form-group ">
      <div class="col col--12">
        <div class="input-wrapper input-wrapper--icon">
          <input type="tel"  class="ember-view ember-text-field form-control form-control--credit-card cc-num" placeholder="Card Number" name="card number" ng-model="cardno" autocomplete="cc-number" data-ng-change="formatDetails()">
         
        </div>
      </div>
      
      <div class="clearfix"></div><br />
      <div class="col col--4 col--4--sm">
        <div class="">
          <select id="" class="ember-view ember-select form-control" name="month expire" ng-model="card_month">  
          <option value="">Month</option>
          <option id="" class="ember-view" value="1">1</option>
          <option id="" class="ember-view" value="2">2</option>
          <option id="" class="ember-view" value="3">3</option>
          <option id="" class="ember-view" value="4">4</option>
          <option id="" class="ember-view" value="5">5</option>
          <option id="" class="ember-view" value="6">6</option>
          <option id="" class="ember-view" value="7">7</option>
          <option id="" class="ember-view" value="8">8</option>
          <option id="" class="ember-view" value="9">9</option>
          <option id="" class="ember-view" value="10">10</option>
          <option id="" class="ember-view" value="11">11</option>
          <option id="" class="ember-view" value="12">12</option>
</select>
        </div>
      </div>
      <div class="col col--4 col--4--sm">
        <div class="">
          <select id="" class="ember-view ember-select form-control" name="year expire" ng-model="card_year">
          <option value="">Year</option>
          <option id="" class="ember-view" value="2015">2015</option>
          <option id="" class="ember-view" value="2016">2016</option>
          <option id="" class="ember-view" value="2017">2017</option>
          <option id="" class="ember-view" value="2018">2018</option>
          <option id="" class="ember-view" value="2019">2019</option>
          <option id="" class="ember-view" value="2020">2020</option>
          <option id="" class="ember-view" value="2021">2021</option>
          <option id="" class="ember-view" value="2022">2022</option>
          <option id="" class="ember-view" value="2023">2023</option>
          <option id="" class="ember-view" value="2024">2024</option>
          <option id="" class="ember-view" value="2025">2025</option>
          <option id="" class="ember-view" value="2026">2026</option>
          <option id="" class="ember-view" value="2027">2027</option>
          <option id="" class="ember-view" value="2028">2028</option>
          <option id="" class="ember-view" value="2029">2029</option>
          <option id="" class="ember-view" value="2030">2030</option>
          <option id="" class="ember-view" value="2031">2031</option>
          <option id="" class="ember-view" value="2032">2032</option>
          <option id="" class="ember-view" value="2033">2033</option>
          <option id="" class="ember-view" value="2034">2034</option>
          <option id="" class="ember-view" value="2035">2035</option>
</select>
        </div>
      </div>
      <div class="col col--4 col--4--sm">
        <input type="tel" id="ember1194" class="ember-view ember-text-field form-control form-control--cvv cc-cvv"  data-ng-change="formatDetails()" ng-model="card_cvv" placeholder="CVV" autocomplete="off" name="cvv" style="height:44px;">
      </div>
    </div>
	<div id="ember798" class="ember-view alert alert--error" ng-show="errorPaymentInfo">{{errorPaymentInfo}}</div>
    
  </div>
</div>

<!---->        </div>
      </div>

      <div class=" promo-code">
        <div class="block">
          <div class="block__header ">
            <h5>Promo Code</h5>
          </div>
          <div class="block__content ">
            <div class="input-wrapper input-wrapper--icon" ng-hide="promoDiscout">
              <input type="text" id="" class="ember-view ember-text-field form-control promo" ng-model="promocode" placeholder="">
              <a href="javascript:" class="heading btn-apply" ng-click="promocodeApply()">Apply</a>
            </div>
            
            <div class="input-wrapper input-wrapper--icon" ng-show="promoDiscout">
              <input type="text" id="" class="ember-view ember-text-field form-control promo" ng-model="promocode" placeholder="">
              <a href="javascript:" class="heading btn-apply" style="cursor:default">Applied</a>
            </div>
            
            
            <div class="alert alert--error " ng-show="promoError">{{promoError}}</div>
            
              
          </div>
        </div>
      </div>

      <div class="block block-payment">
        <div class="block__header row">
          <h5>Tip</h5>
        </div>
        <div class="block__content row">
          <div id="" class="ember-view"><div class="row">
  <div class="col-lg-6">
    <ul>
      <li class="col-lg-3" style="padding:3px;">
        <button type="button" class="btn btn-option " ng-click="findTip(10)">10<span class="percent">%</span></button>
      </li>
      <li class="col-lg-3" style="padding:3px;">
        <button type="button" class="btn btn-option " ng-click="findTip(15)">15<span class="percent">%</span></button>
      </li>
      <li class="col-lg-3" style="padding:3px;">
        <button type="button" class="btn btn-option " ng-click="findTip(18)">18<span class="percent">%</span></button>
      </li>
      <li class="col-lg-3" style="padding:3px;">
        <button type="button" class="btn btn-option " ng-click="findTip(20)">20<span class="percent">%</span></button>
      </li>
    </ul>
  </div>
  <div class="col col--6">
    <input type="text" id="ember881" class="ember-view ember-text-field form-control tip-input" ng-model="tip" ng-blur="findTipText()" placeholder="0.00" name="tip">
  </div>
</div>
</div>
          
          <div id="" class="ember-view alert alert--error is-hidden">false</div>
        </div>
      </div>

      <div class="block">
        <div class="block__header row">
          <div class="col col--6">
            <h5>Order Summary</h5>
          </div>
        </div>
        <div class="block__content">
          <div class="row">
            <div class="col">

              <div id="" class="ember-view">  
              <ul class="cart-checkout__list">
              
                <li>
                  <span>Subtotal</span>
                  <span class="text--bold price">${{totalPrice | number:2 }}</span>
                </li>
                <li ng-show="promoDiscout">
                  <span>Discount</span>
                  <span class="text--bold price">${{promoDiscout | number:2 }}</span>
                </li>
                
                <li class="cart-taxes">
                  <span>Taxes</span>
                  <span class="text--bold price">${{salesTax | number:2 }}</span>
                </li>
                <li class="cart-tip" ng-show="tip">
                    <span>Tip</span>
                    <span class="text--bold price">${{tip | number:2 }}</span>
                </li>
      
      
	  			</ul>
</div>

              <ul class="cart-checkout__list checkout-total">
                <li>
                  <span>Total</span>
                  <span class="price">${{total | number:2}}</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div id="" class="ember-view is-hidden"><!----></div>

      <div class="btn-wrap">
        <div id="" class="ember-view spinner-overlay is-hidden"><div class="spinner spinner spinner--absolute"></div>
</div>
        <div id="" class="ember-view"><div class="alert alert--error cart__alert is-hidden">
  <span class="message"><!----></span>
</div>
</div>

        <button class="btn btn-primary btn-block" >
          Complete Order
        </button>
      </div>
    </div>
  </form>
</div>

 
<!--   checkout page  end  --> 
  
  

  
  
  
  
  
  
</div>

  </div>



  <div class="layout-side col  yelp__col--side" style="left: 550px;">
    <div id="" class="ember-view ember-view__cart" style="left: 0px; position: relative;"><div class="drawer-header">
  <a href="#" class="back drawer-header__action" ><span class="ss-icon ss-navigateleft"></span> Back</a>
</div>
<!----><div class="pane-stack">
  <div class="pane-stack__pane order-particulars">
  <div id="map" class="ember-view ember-view__google-map" style="display: block; position: relative; background-color: rgb(229, 227, 223); overflow: hidden;"></div>
        
    <div class="order-particulars__info heading">{{restaurantname}}</div>
    <div class="order-particulars__info heading">{{orderType}} -  {{orderTimeTitle}}</div>
  </div>




<div class="pane-stack__pane pane-stack__pane-scroller-wrap cart" style=" height:50%; overflow-y:auto; overflow-x:hidden;" >
   
    <ul class="pane-stack__pane-scroller cart-list "  ng-repeat="orderlist in orderArray">
    
    <div id="ember4414" class="ember-view"> 
    
    <li  class="cart-list-item " ng-click="editItem(orderlist.item_id,$index)">
    <div class="wrap-pad">
      <div class="item">
        <span class="cart-item__quantity text--center ">{{orderlist.quantity}}</span>
        <span class="cart-item-name" title="Create Your Own">{{orderlist.item_name}}</span>
        <div class="price">${{orderlist.price | number:2}}</div>
        <a class="ss-gizmo ss-delete remove" href="javascript:" ng-click="removeFromCart(orderlist.item_id,$index)">
        	<img src="images/close.png"  />
        </a>
        
      </div>
    </div>
    
    
    <div class="cart-item__quantity-counter ">
      <div class="wrap-pad">
        <div id="ember4420" class="ember-view"><button class="btn quantity__minus" ><span class="ss-icon ss-hyphen"></span></button>
            <span class="num-quantity text--center">
                1
            </span>
            <button class="btn quantity__plus" ><span class="ss-icon ss-plus"></span></button>
        </div>
        <button class="btn close" >Close</button>
      </div>
     </div>
        
        
        <div class="wrap-pad" ng-repeat="optlist in orderlist.options">
          <div class="mods">
            <strong>{{optlist.optTitle}}</strong>
            <ul>
                <li ng-repeat="sideslist in optlist.sides">
                {{sideslist.sideitem}}<!----> <span class="mod-price">${{sideslist.sidePrice | number:2}}</span>
                </li>
                
            </ul>
          </div>
        </div>
        
	  </li>


		</div>
      <div class="discount-item">
      </div>
    </ul>
  </div>
  
  
  
  
  
  
  
  
  
  
  
  <div class="pane-stack__pane cart-checkout"  >
    <div id="" class="ember-view">
    
    <ul class="cart-checkout__list">
    <li class="cart-delivery" ng-if="orderType=='Delivery'">
      <span >Delivery</span>
      <span class="text--bold price ">${{delivery_charge | number:2}}</span>
    </li>
    <li>
      <span>Subtotal</span>
      <span class="text--bold price">${{totalPrice | number:2 }}</span>
    </li>
    <li class="cart-taxes">
      <span>Taxes</span>
      <span class="text--bold price">${{salesTax | number:2}}</span>
    </li>
  </ul>
</div>

<div id="" class="ember-view">
<div class="alert alert--error cart__alert " ng-show="errorDelAmt">
  <span class="message" >Minimum Delivery Amount: ${{min_delivery_amount}} Adjust quantity or add new items.</span>
</div>

</div>
    <div class=" btn-group--primary"  ng-class='{disabled:!orderArray.length}'>
      <span ng-hide="member_id">
      	<a href="javascript:" class="btn"  ng-click="checkout()">Checkout</a>
      </span>
      <span ng-show="member_id">
      	<a href="javascript:" class="btn"  ng-click="checkout()">Checkout</a>
      </span>
      
      <span class="" style="font-size:22px; float:right;">${{total | number:2 }}</span>
    </div>
 
  </div>
  
  
  
  
</div>
</div>
  </div>
</div>
</div>
</div>


<div id="spinner" class="ember-view spinner-overlay is-transparent is-hidden">
<div class="spinner spinner spinner--absolute"></div>
</div>


<div class="modal-dialog" modal="showModal" ng-show="showModal" close="cancel()" style="margin-left:28%;margin-top:20%;position:fixed;z-index:2000000;">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"  ng-click="notCancelOrder()" >&times;</button>
      <h4 class="modal-title">Cancel Order</h4>
    </div>
    <div class="modal-body">
      Are you sure you want to cancel this order?
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal"  ng-click="cancelOrder()" > Yes</button>
      <button type="button" class="btn btn-primary" ng-click="notCancelOrder()">No, don't cancel.</button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

 <div class="modal" id="getCodeModal" data-backdrop="static" data-keyboard="false" style="z-index:111111; overflow-y:hidden;" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="">
      <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="completeOrder()"><span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title" id="myModalLabel">MESSAGE</h4>
       </div>
       <div class="modal-body" id="getCode">
          Order Placed Successfully
          <button type="button" class="btn btn-primary" style="width:20%; padding: 12px; margin-left:15px;" data-dismiss="modal" ng-click="completeOrder()"> OK</button>
       </div>
    
    </div>
   </div>
 </div>
 
 
 <div class="modal" id="errormodal" data-backdrop="static" data-keyboard="false" style="z-index:111111; overflow-y:hidden;" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="">
      <div class="modal-content">
       <div class="modal-header">
         
         <h4 class="modal-title" id="myModalLabel">Oops!</h4>
       </div>
       <div class="modal-body" id="getCode">
          You've reached the max amount of options allowed. Unselect an item to choose another option.<br /><br />
          <button type="button" class="btn btn-primary" style="width:20%; padding: 12px; margin-left:0px;" data-dismiss="modal"> OK</button>
       </div>
    
    </div>
   </div>
 </div>
<div id="spinn" class="ember-view spinner-overlay is-hidden" style="position: fixed;'">
<div class="spinner spinner spinner--absolute"></div>
</div>

 <div class="modal" id="errorRequired" data-backdrop="static" data-keyboard="false" style="z-index:111111; overflow-y:hidden;" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="">
      <div class="modal-content">
       <div class="modal-header">
         
         <h4 class="modal-title" id="myModalLabel">Forgot Something?</h4>
       </div>
       <div class="modal__body" style="margin-left:13px;">
          <p>The following items are required: 
            <ul class="modal__list">
            <li ng-repeat="notOpt in notSelectOptID">{{notOpt.opname}}</li>
            </ul> 
          </p>
          <p align="right" style="margin-right:13px;">
          <button type="button" class="btn btn-primary" style="width:20%; padding: 12px; margin-left:0px;" data-dismiss="modal"> OK</button>
          </p>
       </div>
       
    
    </div>
   </div>
 </div>
<div id="spinn" class="ember-view spinner-overlay is-hidden" style="position: fixed;'">
<div class="spinner spinner spinner--absolute"></div>
</div>
 

<!--end of items--> 








</div>