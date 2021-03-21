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
				<a  href = "/index"><i class="fa fa-home"></i> <?= $sidebar_links_homepage ?> </a> 
			</li>
			<li class="link">
				<a  href = "/index"><i class="fa fa-user-circle"></i> <?= $sidebar_links_supplier ?></a> 
			</li>
			<li class="link">
				<a  href = "/index"><i class="fa fa-user"></i> <?= $sidebar_links_client ?></a> 
			</li>
			<li class="link">
				<a class="toggle-menu" href="#"><i class="fa fa-user"></i> <?= $sidebar_links_user?> </a>
				<ul class="menu-group list-unstyled">
					<li class="link">
						<a href="/privilege"><i class="fa fa-key"></i> <?= $sidebar_links_privilege ?></a>
					</li>
					<li class="link">
						<a href="#"><i class="fa fa-users"></i><?= $sidebar_links_group?></a>
					</li>
				</ul> 
			</li>
			<li class="link">
				<a class="toggle-menu" href="#"><i class="fa fa-shopping-cart"></i><?= $sidebar_links_store?></a> 
				<ul class="menu-group list-unstyled">
					<li class="link">
						<a href="#"><i class="fa fa-key"></i> <?= $sidebar_links_category?></a>
					</li>
					<li class="link">
						<a href="#"><i class="fa fa-user"></i><?= $sidebar_links_product ?></a>
					</li>
				</ul> 
			</li>
			<li class="link">
				<a href="/language"> <i class="fa fa-file"></i> <?= $sidebar_links_report ?>  </a> 
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