// Menu Function
$(".menu-toggle").on('click', function() {
	$(this).toggleClass("on");
	$('.menu-section').toggleClass("on");
	$("nav ul").toggleClass('hidden');
    $("header, footer, .main-sec, .res-small-dropDown, .preferences, .profile").toggleClass("dissable");
});
//==========================================


// Modal When Each Table (tr) Click
	$('#tab-new .table tbody tr').on('click',function(){
		$("#myModal1").modal("show");
	});
	
	$('#tab-late .table tbody tr').on('click',function(){
		$("#myModal2").modal("show");
	});
	
	$('#tab-all .table tbody tr').on('click',function(){
		$("#myModal3").modal("show");
	});
//==========================================


// Line Creating
$(".customer-detail.desktop dl dd").after("<div class='line-bottom'></div>")
jQuery('#myModal2 .line-bottom').last().addClass('no-line');

$(".customer-detail.tablet-res dl dd").after("<div class='line-bottom'></div>")
jQuery('#myModal2 .line-bottom').last().addClass('no-line');

$(".customer-detail.ipad-mob dl dd").after("<div class='line-bottom'></div>")
jQuery('#myModal2 .line-bottom').last().addClass('no-line');

jQuery('#myModal3 .customer-detail.ipad-mob dl .line-bottom').last().addClass('no-line');


jQuery('#myModal2 .order-detail-tablet-view .order-detail-text .customer-detail .line-bottom').last().removeClass('no-line');
//==========================================


// Order Modal Close
$(function() {
    $.fn.modal.Constructor.DEFAULTS.backdrop = 'static';
});
//==========================================


// Check Password
function checkPasswordMatch() {
    var password = $("#txtNewPassword").val();
    var confirmPassword = $("#txtConfirmPassword").val();

    if (password != confirmPassword)
        $(".check-match").html("<i class='fa fa-times'></i>");
    else
        $(".check-match").html("<i class='fa fa-check'></i>");
}

$(document).ready(function () {
   $("#txtConfirmPassword").keyup(checkPasswordMatch);
});
//==========================================


// Order Detail Toggle
$('.customer-detail button').click(function() {
    $(this).toggleClass('in-active active');
});
//==========================================


// Opening Time
$('.profile-container form').on('click', '.title-day', function(){
	var val=$(this).attr("data-id");
	if ($(this).is(":checked")){
		
		$(".start_at_"+val).removeAttr("disabled");
		$(".end_at_"+val).removeAttr("disabled");   
		
	} else {
		
		$(".start_at_"+val).attr("disabled","disabled");
		$(".end_at_"+val).attr("disabled","disabled");
	}	
});
//==========================================


// Edit Option
$('.editCat').click(function(){
	var $row = $(this).closest('tr');
	$('.edit-cat .modal-dialog .modal-content form .modal-body label input[name="editCatName"]').val($('td:first-child',$row).text());
	$('.edit-cat .modal-dialog .modal-content form .modal-body label textarea[name="editCatSubtitle"]').val($('td:nth-child(2)',$row).text());
});

$('.editCat2').click(function(){
	var $row = $(this).closest('tr');
	$('.edit-cat .modal-dialog .modal-content form .modal-body label input[name="editCatName"]').val($('td:nth-child(2) .td-name p',$row).text());
	$('.edit-cat .modal-dialog .modal-content form .modal-body label textarea[name="editCatSubtitle"]').val($('td:nth-child(2) .td-subtitle p',$row).text());
});
//==========================================


// Search: Select Category
var $rows = $('.search-cat tr');
$('.search-slct').change(function() {
    var val = $.trim($(this).val())
    
    $rows.show().filter(function() {
        var text = $(this).text()
        return !~text.indexOf(val);
    }).hide();
	
	$('#tab-dish table.for-view-higher-481 tbody tr td:first-child').addClass('my-handle');
	$('#tab-dish table.for-view-lower-481 tbody tr td:first-child').addClass('my-handle');
});
//==========================================


// Show Hide
$(".uncheckedShow").show();
$(".checkedShow").hide();
$(".max-input-box1").hide();
$(".max-input-box2").hide();
$('table.option-table tbody.after-768-none tr td:first-child').addClass('first-td');
$('table.option-table tbody.after-768-none tr td:nth-child(2)').addClass('second-td');
$('table.option-table tbody.after-768-none tr td:nth-child(3)').addClass('third-td');
$('table.option-table tbody.after-768-none tr td:nth-child(4)').addClass('fourth-td');
$('table.option-table tbody.after-768-none tr td:last-child').addClass('fifth-td');

$("#sizeCheckbox").click(function() {
	if($(this).is(":checked")) {
		$(".checkedShow").fadeIn( "slow" ).show();
		$(".uncheckedShow").fadeOut( "slow" ).hide()
	} else {
		$(".checkedShow").fadeOut( "slow" ).hide();
		$(".uncheckedShow").fadeIn( "slow" ).show();
	}
});

$("#mul-options1").click(function() {
	if($(this).is(":checked")) {
		$(".max-input-box1").fadeIn( "slow" ).show();
		$('table.option-table tbody.after-768-none tr td:first-child').removeClass('first-td');
		$('table.option-table tbody.after-768-none tr td:nth-child(2)').removeClass('second-td');
		$('table.option-table tbody.after-768-none tr td:nth-child(3)').removeClass('third-td');
		$('table.option-table tbody.after-768-none tr td:nth-child(4)').removeClass('fourth-td');
		$('table.option-table tbody.after-768-none tr td:last-child').removeClass('fifth-td');
	} else {
		$(".max-input-box1").fadeOut( "slow" ).hide();
		$('table.option-table tbody.after-768-none tr td:first-child').addClass('first-td');
		$('table.option-table tbody.after-768-none tr td:nth-child(2)').addClass('second-td');
		$('table.option-table tbody.after-768-none tr td:nth-child(3)').addClass('third-td');
		$('table.option-table tbody.after-768-none tr td:nth-child(4)').addClass('fourth-td');
		$('table.option-table tbody.after-768-none tr td:last-child').addClass('fifth-td');
	}
});

$("#mul-options2").click(function() {
	if($(this).is(":checked")) {
		$(".max-input-box2").fadeIn( "slow" ).show();
		$('table.option-table tbody.after-768-none tr td:first-child').removeClass('first-td');
		$('table.option-table tbody.after-768-none tr td:nth-child(2)').removeClass('second-td');
		$('table.option-table tbody.after-768-none tr td:nth-child(3)').removeClass('third-td');
		$('table.option-table tbody.after-768-none tr td:nth-child(4)').removeClass('fourth-td');
		$('table.option-table tbody.after-768-none tr td:last-child').removeClass('fifth-td');
	} else {
		$(".max-input-box2").fadeOut( "slow" ).hide();
		$('table.option-table tbody.after-768-none tr td:first-child').addClass('first-td');
		$('table.option-table tbody.after-768-none tr td:nth-child(2)').addClass('second-td');
		$('table.option-table tbody.after-768-none tr td:nth-child(3)').addClass('third-td');
		$('table.option-table tbody.after-768-none tr td:nth-child(4)').addClass('fourth-td');
		$('table.option-table tbody.after-768-none tr td:last-child').addClass('fifth-td');
	}
});

$(".max-input-box-mob1").hide();
$("#mul-options-mob1").click(function() {
	if($(this).is(":checked")) {
		$(".max-input-box-mob1").fadeIn( "slow" ).show();
	}else {
		$(".max-input-box-mob1").fadeOut( "slow" ).hide();
	}
});

$(".max-input-box-mob2").hide();
$("#mul-options-mob2").click(function() {
	if($(this).is(":checked")) {
		$(".max-input-box-mob2").fadeIn( "slow" ).show();
	}else {
		$(".max-input-box-mob2").fadeOut( "slow" ).hide();
	}
});
//==========================================


$( ".option-table-container table.tble-drag tbody tr:last-child td:last-child" ).append( '<a href="javascript:void(0);"><i class="fa fa-plus"></i></a>' );


// Section Drag
$(function() {
	$( "#sortable" ).sortable({ 
		placeholder: "ui-sortable-placeholder" 
	});
});
//==========================================


// Draggable Function
$('#tab-category table.for-view-higher-481 tbody tr td:first-child').addClass('my-handle');
$('#tab-category table.for-view-lower-481 tbody tr td:first-child').addClass('my-handle');

$('.option-table-container table.tble-drag tbody tr td:first-child').addClass('my-handle');
$('.option-table-container table.tble-drag tbody tr td:first-child').addClass('my-handle');

(function () {
	'use strict';

	var byId = function (id) { return document.getElementById(id); },

		loadScripts = function (desc, callback) {
			var deps = [], key, idx = 0;

			for (key in desc) {
				deps.push(key);
			}

			(function _next() {
				var pid,
					name = deps[idx],
					script = document.createElement('script');

				script.type = 'text/javascript';
				script.src = desc[deps[idx]];

				pid = setInterval(function () {
					if (window[name]) {
						clearTimeout(pid);

						deps[idx++] = window[name];

						if (deps[idx]) {
							_next();
						} else {
							callback.apply(null, deps);
						}
					}
				}, 30);

				document.getElementsByTagName('head')[0].appendChild(script);
			})()
		},
		console = window.console;


	if (!console.log) {
		console.log = function () {
			alert([].join.apply(arguments, ' '));
		};
	}


	Sortable.create(byId('foo-mob'), {
		group: "words",
		animation: 150,
		store: {
			get: function (sortable) {
				var order = localStorage.getItem(sortable.options.group);
				return order ? order.split('|') : [];
			},
			set: function (sortable) {
				var order = sortable.toArray();
				localStorage.setItem(sortable.options.group, order.join('|'));
			}
		},
		onAdd: function (evt){ console.log('onAdd.foo-mob:', [evt.item, evt.from]); },
		onUpdate: function (evt){ console.log('onUpdate.foo-mob:', [evt.item, evt.from]); },
		onRemove: function (evt){ console.log('onRemove.foo-mob:', [evt.item, evt.from]); },
		onStart:function(evt){ console.log('onStart.foo-mob:', [evt.item, evt.from]);},
		onSort:function(evt){ console.log('onStart.foo-mob:', [evt.item, evt.from]);},
		onEnd: function(evt){ console.log('onEnd.foo-mob:', [evt.item, evt.from]);}
	});


	Sortable.create(byId('bar'), {
		group: "words",
		animation: 150,
		onAdd: function (evt){ console.log('onAdd.bar:', evt.item); },
		onUpdate: function (evt){ console.log('onUpdate.bar:', evt.item); },
		onRemove: function (evt){ console.log('onRemove.bar:', evt.item); },
		onStart:function(evt){ console.log('onStart.foo-mob:', evt.item);},
		onEnd: function(evt){ console.log('onEnd.foo-mob:', evt.item);}
	});
})();
//==========================================