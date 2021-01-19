
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

	<!-- Sidebar mobile toggler -->
	<div class="sidebar-mobile-toggler text-center">
		<a href="#" class="sidebar-mobile-main-toggle">
			<i class="icon-arrow-left8"></i>
		</a>
		Navigation
		<a href="#" class="sidebar-mobile-expand">
			<i class="icon-screen-full"></i>
			<i class="icon-screen-normal"></i>
		</a>
	</div>
	<!-- /sidebar mobile toggler -->


	<!-- Sidebar content -->
	<div class="sidebar-content">

		<!-- Main navigation -->
		<div class="card card-sidebar-mobile">
			<ul class="nav nav-sidebar" data-nav-type="accordion">

				<!-- Main -->
				<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Menu</div> <i class="icon-menu" title="Main"></i></li>

				@if ( \Auth::user()->role == 1 )
					<li class="nav-item">
						<a href="{{ url('/home') }}" class="nav-link {{ (request()->is('home*')) ? 'active' : '' }}">
							<i class="icon-home4"></i>
							<span>
								Dashboard
							</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ url('/users') }}" class="nav-link {{ (request()->is('users*')) ? 'active' : '' }}">
							<i class="icon-users"></i>
							<span>
								Users
							</span>
						</a>
					</li>
					<li class="nav-item nav-item-submenu {{ (request()->is('data-employees*')) ? 'nav-item-expanded nav-item-open' : '' }}">
						<a href="data-employees" class="nav-link"><i class="fas fa-user-friends"></i> <span>Data Employees</span></a>
						<ul class="nav nav-group-sub">
							<li class="nav-item"><a href="{{ url('/data-employees/employees') }}" class="nav-link {{ (request()->is('data-employees/employees*')) ? 'active' : '' }}">Employees</a></li>
							<li class="nav-item"><a href="{{ url('/data-employees/salaries') }}" class="nav-link {{ (request()->is('data-employees/salaries*')) ? 'active' : '' }}">Salary</a></li>
							<li class="nav-item"><a href="{{ url('/data-employees/absent') }}" class="nav-link {{ (request()->is('data-employees/absent*')) ? 'active' : '' }}">Absent</a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a href="{{ url('/settings') }}" class="nav-link {{ (request()->is('settings*')) ? 'active' : '' }}">
							<i class="icon-gear"></i>
							<span>
								Settings
							</span>
						</a>
					</li>
				@endif

				@if ( \Auth::user()->role == 20 )
					<li class="nav-item">
						<a href="{{ url('/karyawan') }}" class="nav-link {{ (request()->is('karyawan*')) ? 'active' : '' }}">
							<i class="icon-home4"></i>
							<span>
								Dashboard
							</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ url('/cek-data') }}" class="nav-link {{ (request()->is('cek-data*')) ? 'active' : '' }}">
							<i class="icon-user"></i>
							<span>
								Cek Data Ku
							</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ url('/cek-gaji') }}" class="nav-link {{ (request()->is('cek-gaji*')) ? 'active' : '' }}">
							<i class="icon-cash"></i>
							<span>
								Cek Gaji Ku
							</span>
						</a>
					</li>
				@endif
			</ul>
		</div>
		<!-- /main navigation -->

	</div>
	<!-- /sidebar content -->
	
</div>