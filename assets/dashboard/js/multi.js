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


	// Multi groups
	Sortable.create(byId('multi'), {
		animation: 150,
		draggable: '.tile',
		handle: '.multi-handle',
		onAdd: function (evt){ //console.log('onAdd.foo-dish:', [evt.item, evt.from]); 
			},
			onUpdate: function (evt){ 
				var itemid=$(evt.item).attr('data-attr');
				//alert(itemid);
				var optAr=Array();
				$('.opt_'+itemid).each(function() {
					optAr.push($(this).attr('data-val'));
				});
				console.log(optAr);
				$.ajax({
					data:{'optionlist':optAr},
					//data: data,
					type: 'POST',
					url: '/chef/menu/optionsortorder',
					success: function(response){
							//$('.addmoresides').hide();
							//$('.tbodyOpt_'+opt_id).html(response);
							var sid=$(this).attr('data-attr')
							//alert(sid);
							var rowCount = $('.sort_'+sid).length;
							//alert(rowCount);
						}
				});
				//console.log('onUpdate.foo-dish:', [evt.item, evt.from]); 
			
			},
			onRemove: function (evt){ //console.log('onRemove.foo-dish:', [evt.item, evt.from]); 
			},
			onStart:function(evt){ //console.log('onStart.foo-dish:', [evt.item, evt.from]);
			},
			onSort:function(evt){ //console.log('onStart.foo-dish:', [evt.item, evt.from]);
			},
			onEnd: function(evt){ //console.log('onEnd.foo-dish:', [evt.item, evt.from]);
			}
	});

	[].forEach.call(byId('multi').getElementsByClassName('tile__list'), function (el){
		Sortable.create(el, {
			animation: 150,
			
			onAdd: function (evt){ //console.log('onAdd.foo-dish:', [evt.item, evt.from]); 
			},
			onUpdate: function (evt){ 
				var catid=$(evt.item).attr('data-attr');
				//alert(catid);
				var sideAr=Array();
				$('.tr_opt_'+catid).each(function() {
					sideAr.push($(this).attr('data-val'));
				});
				console.log(sideAr);
				$.ajax({
					data:{'sideslist':sideAr},
					//data: data,
					type: 'POST',
					url: '/chef/menu/sortorder',
					success: function(response){
							//$('.addmoresides').hide();
							//$('.tbodyOpt_'+opt_id).html(response);
							var sid=$(this).attr('data-attr')
							//alert(sid);
							var rowCount = $('.sort_'+sid).length;
							//alert(rowCount);
						}
				});
				//console.log('onUpdate.foo-dish:', [evt.item, evt.from]); 
			
			},
			onRemove: function (evt){ //console.log('onRemove.foo-dish:', [evt.item, evt.from]); 
			},
			onStart:function(evt){ //console.log('onStart.foo-dish:', [evt.item, evt.from]);
			},
			onSort:function(evt){ //console.log('onStart.foo-dish:', [evt.item, evt.from]);
			},
			onEnd: function(evt){ //console.log('onEnd.foo-dish:', [evt.item, evt.from]);
			}
			});
	});
})();
