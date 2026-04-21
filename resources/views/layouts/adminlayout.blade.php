<!DOCTYPE html>
<html lang="en-IN" class="js">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="CreativeMaker">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<!-- Fav Icon  -->
		<link rel="shortcut icon" href="{{ PUBLICFOLDER }}assets/images/yw-logo-m.png" type="image/x-icon"/>
		<title>{{ $page_title }} | {{ APP_NAME }}</title>
		<!-- StyleSheets  -->
		<link id="skin-default" rel="stylesheet" href="{{ PUBLICFOLDER }}assets/css/style.css?ver={{ SCRIPT_VERSION }}" />
		<link id="skin-default" rel="stylesheet" href="{{ PUBLICFOLDER }}assets/css/skins/theme-ywgreen.css?ver={{ SCRIPT_VERSION }}" />
		<link id="skin-default" rel="stylesheet" href="{{ PUBLICFOLDER }}assets/css/libs/fontawesome-icons.css" />
		<link id="skin-default" rel="stylesheet" href="{{ PUBLICFOLDER }}assets/css/libs/jquery-ui-1.9.2.custom.css" />
		<link id="skin-default" rel="stylesheet" href="{{ PUBLICFOLDER }}assets/css/jquery-ui.css">
		<link id="skin-default" rel="stylesheet" href="{{ PUBLICFOLDER }}assets/css/jqueryui-editable.css">
		<link id="skin-default" rel="stylesheet" href="{{ PUBLICFOLDER }}assets/css/editors/summernote.css">
		@yield('stylesheet')
	</head>
	<body class="nk-body bg-lighter npc-default has-sidebar ">
	<div class="js-preloader" style="display: none"><div class="loading-animation"><img style="width:100px;height:100px" src="{{ ASSETSFOLDER.'images/loading.gif' }}" /></div></div>
	<div class="nk-app-root">
		<!-- main @s -->

		<div class="nk-main ">
			<!-- sidebar @s -->
			<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
				<div class="nk-sidebar-element nk-sidebar-head">
					<div class="nk-sidebar-brand">
						<a href="{{ ADMIN_DASHBOARD }}" class="logo-link nk-sidebar-logo">
							<img class="logo-light logo-img" src="{{ ALLOCATE_LOGO }}" srcset="{{ ALLOCATE_LOGO }}" alt="Logo" />
							<img class="logo-small logo-img logo-img" src="{{ ALLOCATE_LOGO }}" srcset="{{ ALLOCATE_LOGO }}" alt="Logo" />
						</a>
					</div>

					<div class="nk-menu-trigger mr-n2">
						<a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
						<a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-exchange"></em></a>
					</div>
				</div><!-- .nk-sidebar-element -->
				<div class="nk-sidebar-element">
					<div class="nk-sidebar-content">

						<div class="nk-sidebar-menu" data-simplebar>
							<ul class="nk-menu">
								<li class="nk-menu-item">
									<a href="{{ ADMIN_PROFILE }}" class="nk-menu-link">
										<div class="user-card">
											<div class="user-avatar"><span><img src="<?php if(!empty($user->image)){ echo $user->image; }else{ echo PUBLICFOLDER.'assets/images/yw-logo.png'; }?>" title="<?php echo $user->firstname?> <?php echo $user->lastname?>" width="40" /></span></div>
											<div class="user-info"><span class="lead-text color-white">{{ ucwords($user->firstname.' '.$user->lastname) }}</span>
												<span class="sub-text color-white">{{ ucwords($user->email) }}</span>
											</div>
										</div>
									</a>
								</li>

								<?php if($user->role == ALLOCATE_ADMIN){?>
								<li class="nk-menu-item">
									<a href="{{ ADMIN_USERS_LIST }}" class="nk-menu-link">
										<span class="nk-menu-icon"><em class="icon ni ni-layers"></em></span>
										<span class="nk-menu-text">Users</span>
									</a>
								</li>
								<?php }?>

								<!-- .nk-menu-item -->
							</ul><!-- .nk-menu -->
						</div><!-- .nk-sidebar-menu -->
					</div><!-- .nk-sidebar-content -->
				</div><!-- .nk-sidebar-element -->
			</div>
			<!-- sidebar @e -->
			<!-- wrap @s -->
			<div class="nk-wrap ">
				<!-- main header @s -->
				<div class="nk-header nk-header-fixed is-light">
					<div class="container-fluid">
						<div class="nk-header-wrap">
							<div class="nk-menu-trigger d-xl-none ms-n1 me-3"><a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a></div>
							<div class="nk-header-brand d-xl-none">
								<a href="{{ ADMIN_DASHBOARD }}" class="logo-link">
									<img class="logo-light logo-img" src="{{ ALLOCATE_LOGO }}" srcset="{{ ALLOCATE_LOGO }} " alt="logo">
									<img class="logo-dark logo-img" src="{{ ALLOCATE_LOGO }}" srcset="{{ ALLOCATE_LOGO }} " alt="logo-dark">
								</a>
							</div>
							<div class="nk-header-app-name">
								<div class="nk-header-app-name">
									@yield('headerleftnav')
								</div>
							</div>
							<div class="nk-header-tools">
								<ul class="nk-quick-nav">

									@yield('headerrightnav')

									<li class="dropdown user-dropdown"><a href="#" class="dropdown-toggle me-n1" data-toggle="dropdown">
											<div class="user-toggle">
												<div class="user-toggle">
													<div class="user-avatar sm"><img src="<?php if(!empty($user->image)){ echo $user->image; }else{ echo PUBLICFOLDER.'assets/images/yw-logo.png'; }?>" title="<?php echo $user->firstname?> <?php echo $user->lastname?>" width="40" /></div>
													<div class="user-info d-none d-xl-block"><div class="user-status user-status-active">{{ ucwords($user->role) }}</div>
														<div class="user-name dropdown-indicator">{{ $user->firstname.' '.$user->lastname }}</div>
													</div>
												</div>
											</div>
										</a>
										<div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
											<div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
												<div class="user-card">
													<div class="user-avatar"><span><img src="<?php if(!empty($user->image)){ echo $user->image; }else{ echo PUBLICFOLDER.'assets/images/yw-logo.png'; }?>" title="<?php echo $user->firstname?> <?php echo $user->lastname?>" width="40" /></span></div>
													<div class="user-info"><span class="lead-text">{{ ucwords($user->firstname.' '.$user->lastname) }}</span><span class="sub-text">{{ ucwords($user->email) }}</span></div>
												</div>
											</div>
											<div class="dropdown-inner">
												<ul class="link-list">
													<li><a href="{{ ADMIN_LOGOUT }}"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
												</ul>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div><!-- .container-fluid -->
				</div>
				<!-- main header @e -->
				@yield('content')
			</div>
			<!-- wrap @e -->
		</div>
		<!-- main @e -->
	</div>

	<div class="toast" id="toastvisible" role="alert" aria-live="assertive" aria-atomic="true">
		<div class="toast-header">
			<strong class="me-auto text-primary toast-title"></strong>
			<button type="button" class="close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>
		<div class="toast-body"></div>
	</div>

	<!-- app-root @e -->

	<!-- JavaScript -->
	<script src="{{ PUBLICFOLDER }}assets/js/bundle.js?ver={{ SCRIPT_VERSION  }}"></script>
	<script src="{{ PUBLICFOLDER }}assets/js/scripts.js?ver={{ SCRIPT_VERSION  }}"></script>
	<script src="{{ PUBLICFOLDER }}assets/js/jquery-validation/jquery.validate.min.js"></script>
	<script src="{{ PUBLICFOLDER }}assets/js/easyTooltip.js"></script>
	<script src="{{ PUBLICFOLDER }}assets/js/charts/chart-lms.js"></script>
	<script src="{{ PUBLICFOLDER }}assets/js/libs/jquery-ui.1.12.1.min.js"></script>
	<script src="{{ PUBLICFOLDER }}assets/js/libs/editors/summernote.js?ver={{ SCRIPT_VERSION  }}"></script>
	<script src="{{ PUBLICFOLDER }}assets/js/global.js?ver={{ SCRIPT_VERSION  }}"></script>
	<script src="{{ PUBLICFOLDER }}assets/js/editors.js?ver={{ SCRIPT_VERSION  }}"></script>
	<script src="{{ PUBLICFOLDER }}assets/js/jquery.tablesorter.min.js?ver={{ SCRIPT_VERSION  }}"></script>
	<script src="{{ PUBLICFOLDER }}assets/js/jquery.tablesorter.widgets.js?ver={{ SCRIPT_VERSION  }}"></script>
	<script src="{{ PUBLICFOLDER }}assets/js/table/sortable_table.js?ver={{ SCRIPT_VERSION  }}"></script>
	<script src="{{ PUBLICFOLDER }}assets/js/jqueryui-editable.min.js?ver={{ SCRIPT_VERSION  }}"></script>
	<script src="{{ PUBLICFOLDER }}assets/js/charts/gd-campaign.js?ver={{ SCRIPT_VERSION  }}"></script>

	<script>
		$('.tooltip').easyTooltip();

		function copyToClipboard(copy)
		{
			var tempItem = document.createElement('input');
			var e = document.getElementById(copy);
			tempItem.setAttribute('type','text');
			tempItem.setAttribute('display','none');

			let content = e;
			if (e instanceof HTMLElement) {
				content = e.innerHTML;
			}

			tempItem.setAttribute('value',content);
			document.body.appendChild(tempItem);

			tempItem.select();
			document.execCommand('Copy');

			tempItem.parentElement.removeChild(tempItem);
		}

		function showNotifications(title, desc, alert = false)
		{
			$("#toastvisible").removeClass('hide').removeClass('show');
			$("#toastvisible").addClass('show');
			$("#toastvisible .toast-title").html('');
			$("#toastvisible .toast-title").html(title);
			if(alert)
			{
				$("#toastvisible .toast-header").css('background-color', '#ff9b9b');
				$("#toastvisible .toast-title").attr('style', 'color: #000 !important');
			}
			else
			{
				$("#toastvisible .toast-header").css('background-color', '#CADA35');
				$("#toastvisible .toast-title").attr('style', 'color: #000 !important');
			}
			$("#toastvisible .toast-body").html('');
			$("#toastvisible .toast-body").html(desc);

			setInterval(function () {
				$("#toastvisible").removeClass('show').addClass('hide');
				$("#toastvisible .toast-title").html('');
				$("#toastvisible .toast-body").html('');
			}, 10000);
		}

		$('#tablesorter, #tablesorter1, #tablesorter2').tablesorter(
		{
			ignoreCase: true,
			dateFormat : "ddmmyyyy",
			widgets: ['filter'],
			widgetOptions: {
				filter_childRows  : true,
				filter_cssFilter  : 'tablesorter-filter',
				filter_startsWith : false,
				filter_ignoreCase : true,
				filter_saveFilters : true
			}
		}).bind('filterEnd', function () {
			const visibleRows = $('tbody tr:visible', this).length;
			$('.tablesorter_count').html(visibleRows);
		});

		function fetch_date_picker(id_name){
			var dateToday = new Date();
			$('.'+id_name).datepicker(
				{
					dateFormat: 'dd/mm/yy',
					constrainInput: true,
					changeMonth: true,
					changeYear: true,
					firstDay: 1,
					yearRange: '<?php echo date('Y')?>:<?php echo date('Y')+1?>',
					minDate: dateToday,
					appendTo: 'body'
				});
		}

	</script>

	@yield('footerscripts')

	@yield('innerjqueryscripts')
	</body>
</html>
