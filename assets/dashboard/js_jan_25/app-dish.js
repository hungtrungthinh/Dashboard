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


	Sortable.create(byId('foo-dish'), {
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
		onAdd: function (evt){ console.log('onAdd.foo-dish:', [evt.item, evt.from]); },
		onUpdate: function (evt){ 
			var catid=$(evt.item).attr('data-attr');
			var dishArr=Array();
			$('.dish_tr_'+catid).each(function() {
				dishArr.push($(this).attr('data-val'));
			});
			//console.log(dishArr);
			$.ajax({
					data:{'dishlist':dishArr},
					type: 'POST',
					url: 'http://192.168.1.254/forkourse/chef/menu/sortDIshItem',
					success: function(response){
					//alert(rowCount);
				}
			});
			//console.log('onUpdate.foo-dish:', [evt.item, evt.from]); 
		
		},
		onRemove: function (evt){ console.log('onRemove.foo-dish:', [evt.item, evt.from]); },
		onStart:function(evt){ console.log('onStart.foo-dish:', [evt.item, evt.from]);},
		onSort:function(evt){ console.log('onStart.foo-dish:', [evt.item, evt.from]);},
		onEnd: function(evt){ console.log('onEnd.foo-dish:', [evt.item, evt.from]);}
	});


	Sortable.create(byId('bar'), {
		group: "words",
		animation: 150,
		onAdd: function (evt){ console.log('onAdd.bar:', evt.item); },
		onUpdate: function (evt){ console.log('onUpdate.bar:', evt.item); },
		onRemove: function (evt){ console.log('onRemove.bar:', evt.item); },
		onStart:function(evt){ console.log('onStart.foo-dish:', evt.item);},
		onEnd: function(evt){ console.log('onEnd.foo-dish:', evt.item);}
	});
})();