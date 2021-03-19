<div class="sidebar" id="sidebar">
	<div class="admin-information">
		<div class="image-admin"></div>
		<a class="admin-name">
			مصطفي شوقي
		</a>
		<span class="admin-role"><?= $sidebar_admin_role ?></span>
	</div>
	<div class="sidebar-links">
		<ul class="links list-unstyled">
			<li class="link">
				<a  href = "/index"><i class="fa fa-home"></i> 	<?= $sidebar_links_homepage ?> </a> 
			</li>
			<li class="link">
				<a  href = "/index"><i class="fa fa-home"></i> الموردين</a> 
			</li>
			<li class="link">
				<a class="toggle-menu" href="#"><i class="fa fa-user"></i> المستخدمين</a>
				<ul class="menu-group list-unstyled">
					<li class="link">
						<a href="#"><i class="fa fa-key"></i> الصلاحيات</a>
					</li>
					<li class="link">
						<a href="#"><i class="fa fa-user"></i>المجموعات</a>
					</li>
				</ul> 
			</li>
			<li class="link">
				<a class="toggle-menu" href="#"><i class="fa fa-home"></i> المخزن</a> 
				<ul class="menu-group list-unstyled">
					<li class="link">
						<a href="#"><i class="fa fa-key"></i> الاقسام</a>
					</li>
					<li class="link">
						<a href="#"><i class="fa fa-user"></i>المنتجات</a>
					</li>
				</ul> 
			</li>
			<li class="link">
				<a href="/language"> <i class="fa fa-language"></i> <?= $sidebar_links_changelanguage ?>  </a> 
			</li>
			<li class="link">
				<a href="/employee"> <i class="fa fa-sign-out"></i> <?= $sidebar_links_logout ?> </a> 
			</li>
		</ul>
	</div>
</div>