<div class="header">
	<div class="container-fluid">
		 <div class="control-container float-right">
			<div class="toggle" id="toggle">
				<i class="fa fa-exchange"></i>
			</div>
			<div class="control">
				<?= $header_control  ?>
			</div>
		</div>
		<div class="notification float-left">
			<div class="icon-notification">
				<i class="fa fa-bell fa-lg"></i>
				<i class="fa fa-envelope fa-lg"></i>
				<i class="fa fa-language fa-lg"></i>
			</div>
			<div class="admin-settings" data-menu="menu-settings">
				<a class="admin-name">
					<?= $this->session->user->profile->first_name  . " " . $this->session->user->profile->last_name ?>
				</a>
				<i class="fa fa-chevron-down"></i>
				<ul class="menu-settings list-unstyled" id="menu-settings">
					<li><a href="#">الصفحة الشخصيه</a></li>
					<li><a href="#">تغيير كلمة المرور</a></li>
					<li><a href="/authentication/logout">تسجيل الخروج</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>

