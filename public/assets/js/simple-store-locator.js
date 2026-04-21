'use strict';

let Simple_store_locator = (function() {

	/* ---
	| CONSTRUCTOR
	--- */

	return function(cfg) {

		let thiss = this, tmp;

		//set config
		cfg.cntr = $(cfg.cntr);
		cfg.unit = cfg.unit || 'miles';
		cfg.radii = cfg.radii || [5, 10, 15, 20, 30, 40, 50];
		cfg.zoom = cfg.zoom || 10;
		cfg.noun = cfg.noun || 'places';
		cfg.place_template = cfg.place_template || '<p>{name}</p>';
		cfg.map_options = cfg.map_options || {};
		cfg.new_tabs = typeof cfg.new_tabs == 'undefined' ? 1 : cfg.new_tabs;
		cfg.directions_layout = cfg.directions_layout || 'hide-places';
		cfg.directions_optimism = cfg.directions_optimism || 'best_guess';
		cfg.directions_times = cfg.directions_times || 1;
		cfg.directions_mode = cfg.directions_mode || 'DRIVING';
		cfg.directions_alt_routes = cfg.directions_alt_routes || false;
		cfg.bad_postcode_notif = cfg.bad_postcode_notif || 'Sorry, the postcode "{postcode}" is invalid or was not found.';
		cfg.bad_date_notif = cfg.bad_date_notif || 'Please ensure the date and time are not in the past and that the date is entered in the format YYYY-MM-DD';
		cfg.no_radius_circle = cfg.no_radius_circle || false;
		cfg.radius_circle = $.extend(cfg.radius_circle, tmp = {
			fillColor: '#ff9900',
			fillOpacity: .2,
			strokeColor: '#666666',
			strokeWeight: 2
		}) || tmp;
		cfg.start_pos_icon = cfg.start_icon || 'https://maps.google.com/mapfiles/ms/icons/red-dot.png',
		cfg.location_icon = cfg.location_icon || 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png';
		cfg.instance = this;

		//log some stuff on container
		cfg.cntr.addClass(cfg.directions_layout+' '+cfg.directions_mode.toLowerCase()+' allow_dirs_options_'+cfg.directions_options);

		//set up Google objects (except map, which is initiated only once we've built container)
		cfg.instance.geocoder = new google.maps.Geocoder();
		cfg.instance.dirs = new google.maps.DirectionsService;
		cfg.instance.dirs_renderer = new google.maps.DirectionsRenderer;
		cfg.dirs_modes = {driving: 'driving', walking: 'walking', transit: 'public transport', bicycling: 'cycling'};

		cfg.postcode_default = cfg.postcode_default || '';

		//build HTML
		build_html.call(cfg);

		//establish/load places data - may be passed as file URI, object or JSON
		let data_file_dfd = (function() {
			if (cfg.data_file) return $.getJSON(cfg.data_file);
			else if (typeof cfg.data == 'object') return cfg.data;
			else if (typeof cfg.data == 'string') return JSON.parse(cfg.data);

			console.log(cfg.data_file);
		})();
		$.when(data_file_dfd)
			.done(function(data) { this.places_data = cfg.places_data = data; }.bind(this))
			.fail(function() { console.error('Could not establish places data.'+(cfg.data_file ? ' Could not load from '+cfg.data_file : '')); });

		//once got data...
		$.when(data_file_dfd).then(function() {

			//...detect location where possible (if config allows) and build map if successful. Run the detected location through the Google Geocoder service to
			//ensure it's a reasonable detection
			let p = cfg.cntr.find('form p');
			if (navigator.geolocation && !cfg.no_geolocation)
				navigator.geolocation.getCurrentPosition(
					function(geodata) {
						if (geodata.coords) 
						{
							cfg.instance.geocoder.geocode({location: {lat: geodata.coords.latitude, lng: geodata.coords.longitude}}, function(data) 
							{
								p.show()
								if (data) {
									cfg.use_curr_loc = 1;
									build_list_and_map.call(cfg, geodata.coords.latitude, geodata.coords.longitude);
									p.nextAll().hide();
								} else
									geopos_error_cb();
							});
						} else
							geopos_error_cb();
					},
					geopos_error_cb,
					{timeout:1500}
				);

			//...geopos error callback
			function geopos_error_cb() { 
				//p.text('Your current location could not be accurately established. Please enter a postcode instead.').show(); 
				p.text('').show(); 
			}

			//...init events
			init_events.call(cfg);

		});

	}

	/* ---
	| BUILD HTML - build UI form and map area container
	--- */

	function build_html() {

		//options & places list
		let html = "<div class='options-and-list'>"+
			"<a>&#10153;</a>"+
			"<form>"+
				"<p>We've used your current detected location. Perhaps you'd prefer to <a>Enter a postcode</a>.</p>"+
				"<div class='form-group'>"+
					"<label for='postcode'>Postcode:</label> "+
					"<input type='text' id='postcode' name='postcode' class='form-control' value='"+this.postcode_default+"' pattern='[a-zA-Z\\d ]{5,9}' />"+
				"</div>"+
				"<div class='form-group'>"+
				"<label>Show clients within:</label> "+
				"<select class='form-control' name='within'>"+
					function() {
						let ret = '';
						this.radii.forEach(function(num) { ret += '<option'+(this.default_radius != num ? '' : ' selected')+' value="'+num+'">'+num+' '+this.unit+'</option>'; }.bind(this));
						return ret;
					}.call(this)+
				"</select>"+
				"</div>"+
			"<div class='form-group cl'>"+
				"<button class='btn btn-primary'>"+(!this.btn_text ? "Find "+this.noun : this.btn_text)+"</button>"+
			"</div>"+
			"</form>"+
			"<p></p>"+
			"<ul></ul>"+
		"</div>";
		this.cntr.append(html);
		this.list_cntr = this.cntr.children('.options-and-list');

		//directions list container inc. mode/time options
		html = 
		"<a title='Hide directions'>x</a>"+
		"<ul>"+
			function() {
				let ret = '';
				for (let mode in this.dirs_modes)
					ret += '<li style="background-image: url(\'/assets/images/simple-store-locator/'+mode+'.png\');" data-mode="'+mode+'" title="'+this.dirs_modes[mode]+'"'+(mode != this.directions_mode.toLowerCase() ? '' : ' class="on"')+'></li>';
				return ret;
			}.call(this)+
		"</ul>"+
		"<div class='cl'></div>"+
		(this.directions_times ? '' : '')+
		/*"<div id='sl_leave'>"+
			"<input type='radio' checked id='sl_leave_now' name='sl_leave' />"+
			"<label for='sl_leave_now'>Leave now</label>"+
			"<input type='radio' id='sl_leave_at' name='sl_leave' />"+
			"<label for='sl_leave_at'>Leave at...</label>"+
			"<div>"+
				"<select id='sl_time'>"+
					(function() {
						let ret = '', now = new Date;
						for (let i=0; i<24; i++)
							for (let s=0; s<3; s++)
								ret += "<option"+(!(now.getHours() == i && !s) ? '' : " selected")+">"+("0"+i).replace(/.(?=..)/, '')+":"+((s*20)+"0").substr(0, 2)+"</option>";
						return ret;
					})()+
				"</select>"+
				"<input type='text' id='sl_date' pattern='^\\d{4}-\\d{2}-\\d{2}' value='"+(function() {
					let date = new Date, ptn; return date.getFullYear()+'-'+(date.getMonth() + 1 + '').replace(ptn = /^(?=\d$)/, '0')+'-'+(date.getDate()+'').replace(ptn, '0');
				})()+"' />"+
			"</div>"*/
		"</div>";
		this.dirs_cntr = $('<div />').append(html).addClass('dirs').appendTo(this.cntr);

		//map container
		this.map_cntr = $('<div />').addClass('map').appendTo(this.cntr);

		//clear
		this.cntr.append($('<div />').addClass('cl'));

	}

	/* ---
	| EVENTS - listen for stuff happening
	--- */

	function init_events() {

		//requests to enter a postcode rather than use current location
		this.cntr.on('click', 'form p a', function() { $(this).parent().hide().nextAll().show(); });

		//form submission...
		this.cntr.on('submit', 'form', function(evt) {

			//...prep
			evt.preventDefault();
			this.pc = $(evt.target).find('input').val();
			this.use_curr_loc = !this.pc;
			this.cntr.find('form p').remove();

			//update the postcode_filter id filter
			$('#postcode_filter').val(this.pc);

			//...using current location - go building
			if (this.use_curr_loc)
				build_list_and_map.call(this);

			//...using entered postcode - resolve to geos then go building
			else {
				$(evt.target).addClass('loading');
				this.instance.geocoder.geocode({address: this.pc+(this.country ? ' '+this.country : '')}, function(data, status) {
					$(evt.target).removeClass('loading');
					if (status == 'OK') {
						build_list_and_map.call(this, data[0].geometry.location.lat(), data[0].geometry.location.lng());
						if (window.store_locator_lookup_cb) store_locator_lookup_cb();
					} else
						alert(this.bad_postcode_notif.replace(/\{postcode\}/, this.pc));
				}.bind(this));
			}

		}.bind(this));

		//clicks to show list items on map
		this.cntr.on('click', '.show_on_map', function(evt) {
			new google.maps.event.trigger(this.markers[$(evt.target).closest('li').index()], 'click');
			evt.preventDefault();
		}.bind(this));

		//clicks to show/hide directions, if showing them inline rather than on the GM site
		this.cntr.on('click', '.toggle_dirs', function(evt) {

			//...prep
			if (this.directions_layout == 'external') return;
			evt.preventDefault();
			let li = $(evt.target).closest('li');

			//...curr state
			let curr_showing = $(evt.target).is('.showing');
			if (!curr_showing) this.list_cntr.find('.toggle_dirs.showing').trigger('click');

			//...show or hide directions
			!curr_showing ? get_dirs.call(this, li.data('lat'), li.data('lng')) : this.instance.dirs_renderer.setMap(null);
			
			//handle toggle
			this.dirs_cntr[!curr_showing ? 'show' : 'hide']();
			this.cntr.toggleClass('show_dirs', !curr_showing);
			$(evt.target).text((!curr_showing ? 'Hide' : 'Show')+' directions').toggleClass('showing');

		}.bind(this));

		//clicks to hide directions (via X in dirs panel or 'back to list' link in list)
		this.cntr.on('click', '.options-and-list > a, .dirs > a', function() {
			this.cntr.find('.toggle_dirs.showing').trigger('click');
		}.bind(this));

		//toggle directions transport mode - show/hide 'leave at' options. Reload directions with new mode.
		this.dirs_cntr.on('click', 'li:not(.on)', function(evt) {
			$(evt.target).addClass('on').siblings().removeClass('on');
			this.directions_mode = $(evt.target).data('mode');
			get_dirs.call(this);
		}.bind(this));

		//toggle leave now/leave at in directions options
		this.dirs_cntr.on('change', '[name=sl_leave]', function() {
			$(this).nextAll('div').css('display', $(this).is('#sl_leave_now') ? 'none' : 'inline-block');
		});

		//update directions as 'leave at' time changes - check date valid and not in past
		this.dirs_cntr.on('change', '#sl_leave div *', function(evt) {
			let date = $(evt.target).parent().children('input'), time = date.siblings('select'), date_obj = new Date(date.val()+'T'+time.val());
			if (date_obj == 'Invalid Date' || date_obj < new Date) { alert(this.bad_date_notif); return; }
			get_dirs.call(this, null, null, date_obj);
		}.bind(this));

	}

	/* ---
	| BUILD MAP - once we have the user's location, find the places within an acceptable distance and show in list and on map. Args:
	|	@lat (float) - user's latitude stamp
	|	@lng (float) - user's longitude stamp
	| Args will be missing if call was triggered from change to distance dropdfg. In this case, use last-known coords.
	--- */

	function build_list_and_map(lat, lng) {

		//prep
		if (lat && lng) this.coords = {lat: lat, lng: lng};
		let within = this.cntr.find('form [name=within]').val();

		//find places within acceptable range
		let places = [];
		$.each(this.places_data, function(key, data) {
			let distance = check_distance.call(this, this.coords.lat, this.coords.lng, data.latitude, data.longitude);
			if (this.crow_modifier) distance += distance * (this.crow_modifier / 100);
			if (distance <= within) places.push($.extend(data, {distance: (Math.round(distance * 10) / 10)+''+(this.unit == 'miles' ? ' miles' : 'km'),distance_to_order: (Math.round(distance * 10) / 10)}));
		}.bind(this));

		//build results notif
		let notif_html = (places.length ? 'Found '+places.length+' '+this.noun : 'Sorry, no '+this.noun+' were found')+' within '+within+' '+(this.unit == 'miles' ? 'miles' : 'kilometres');
		this.list_cntr.children('p').attr('class', 'found-'+places.length).html(notif_html).attr('style', 'margin-top: 25px');

		//build list of found places
		let ul = this.list_cntr.children('ul').empty();

		//sort the object by distance_to_order and not name
		places = sortByKey(places, 'distance_to_order');

		$.each(places, function(key, data) {
			let html = insert_lets.call(this, this.place_template, data);
			if (this.new_tabs) html = html.replace(/<a (?!=href="javascript)/g, '<a target="_blank" ');
			$('<li />', {html: html, 'data-lat': data.latitude, 'data-lng': data.longitude, 'data-hospital_id': data.hospital_id}).appendTo(ul);
			//console.log(data.hospital_id);
		}.bind(this));
		this.list_cntr.children().fadeIn();

		//build map or, if already have, center it on required location. Note: when creating map, user may have specified an existing map obj to use instead
		this.map_cntr.fadeIn();
		if (!this.instance.map)
			this.instance.map = !this.map ? new google.maps.Map(this.map_cntr[0], $.extend(this.map_options, {
				center: this.coords,
				zoom: this.zoom
			})) : this.map;
		else
			this.instance.map.setCenter(this.coords);

		//add user location/postcode marker, if required
		if (this.show_user_location) {
			if (this.user_marker) this.user_marker.setMap(null);
			this.user_marker = new google.maps.Marker({
				position: this.coords,
				icon: this.start_pos_icon,
				map: this.instance.map,
				title: this.use_curr_loc ? 'Your location (approx.)' : this.pc.toUpperCase()
			});
		}

		//show radius area, if required (specified in metres)
		if (!this.no_radius_circle) {
			if (this.circle) this.circle.setMap(null);
			this.circle = new google.maps.Circle($.extend(this.radius_circle, {
				map: this.instance.map,
				clickable: false,
				radius: within * (this.unit == 'miles' ? 1609.34 : 1000)
			}));
			this.circle.bindTo('center', this.user_marker, 'position');
		}

		//add balloons and info windows for found places...
		this.markers = [];
		let iw = null; //so we can try and close the info windows on click each time

		$.each(places, function(key, data) {

			//...balloon
			let marker = new google.maps.Marker({
				position: {lat: parseFloat(data.latitude), lng: parseFloat(data.longitude)},
				map: this.instance.map,
				title: this.tooltip_field ? data[this.tooltip_field] : null,
				icon: this.location_icon
			});
			this.markers.push(marker);

			//...info window (i.e. tooltip) - set as HTML the list item HTML in places list, minus links to show on map and directions
			let clone = this.cntr.find('li:nth-child('+this.markers.length+')').clone();
			//clone.find('.show_on_map, .toggle_dirs').remove();
			clone.find('.show_on_map').remove();
			clone.find('p').css('margin', 0);

			marker.addListener('click', function() 
			{ 
				iw?.close();
				iw = new google.maps.InfoWindow({content: clone.html()});
				iw.open(this.instance.map, marker);

			}.bind(this));

		}.bind(this));

	};

	/* ---
	| SHOW DIRECTIONS - get and show directions from user to clicked place from the list. Args:
	|	@to_lat - the latitude of the clicked place. If omitted, uses last-used lat.
	|	@to_lng - " longitude " " " ". If ", " "-" lng.
	|	@leave_at (date) - a date object denoting when to leave
	--- */

	function get_dirs(to_lat, to_lng, leave_date) {

		if (to_lat && to_lng) this.dirs_coords = {lat: to_lat, lng: to_lng};
		if (!leave_date) leave_date = new Date;

		//get and show directions on map
		this.instance.dirs.route({
			origin: this.coords,
			destination: this.dirs_coords,
			provideRouteAlternatives: !!this.directions_alt_routes,
			travelMode: google.maps.TravelMode[this.directions_mode.toUpperCase()],
			drivingOptions: {
				departureTime: leave_date,
				trafficModel: google.maps.TrafficModel[this.directions_optimism.toUpperCase()]
			},
			unitSystem: google.maps.UnitSystem[this.unit == 'miles' ? 'IMPERIAL' : 'METRIC']
		}, function(response, status) {
			if (status == google.maps.DirectionsStatus.OK) this.instance.dirs_renderer.setDirections(response);
		}.bind(this));
		this.instance.dirs_renderer.setMap(this.instance.map);

		//show text directions in panel
		this.instance.dirs_renderer.setPanel(this.dirs_cntr[0]);

	}

	/* ---
	| CHECK DISTANCE - establish which places are within acceptable distance of the user. Uses the Haversine formula. Returns distance in active unit. Args:
	|	@lat1 (float) - user's latitude stamp
	|	@lng1 (float) - user's longitude stamp
	|	@lat2 (float) - place's latitude stamp
	|	@lng2 (float) - place's longitude stamp
	--- */

	function check_distance(lat1, lon1, lat2, lon2) {
        let
        radlat1 = Math.PI * lat1/180,
        radlat2 = Math.PI * lat2/180,
        radlon1 = Math.PI * lon1/180,
        radlon2 = Math.PI * lon2/180,
        theta = lon1-lon2,
        radtheta = Math.PI * theta/180,
        dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
        dist = Math.acos(dist);
        dist = dist * 180/Math.PI;
        dist = dist * 60 * 1.1515;
        if (this.unit == 'km') { dist = dist * 1.609344 }
        return dist;
	}

	/* ---
	| UTILS
	--- */

	//radius
	function toRad(num) { return num * Math.PI / 180; }

	//let templates - replace {foo} with let values within string
	function insert_lets(str, data) {
		return str.replace(/\{[^\}]+\}/g, function($0) {
			let let_name = $0.replace(/^\{|\}$/g, '');
			if (let_name == 'show_dirs')
				return '<a class="toggle_dirs" href="https://www.google.com/maps/dir/'+(this.use_curr_loc ? 'Current+Location' : this.pc)+'/'+data.latitude+','+data.longitude+'">Get directions</a>';
			else if (let_name == 'show_on_map')
				return '<a href="javascript:void(0);" class="show_on_map">Show on map</a>';
			else if (let_name == 'distance')
				return 'approx. '+data.distance;
			return data[let_name] ? data[let_name] : this.let_not_found_placeholder || '('+let_name+' unknown)';
		}.bind(this));
	}

	function sortByKey(array, key) {
	    return array.sort(function(a, b) {
	        var x = a[key]; var y = b[key];
	        return ((x < y) ? -1 : ((x > y) ? 1 : 0));
	    });
	}

})();