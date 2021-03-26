<div class="sidebar" id="sidebar">
	<!-- Admin Information -->
	<div class="admin-information">
		<div class="image-admin"></div>
		<a class="admin-name">
			مصطفي شوقي
		</a>
		<span class="admin-role"><?= $sidebar_admin_role ?></span>
	</div>
	<!-- End Admin Information -->

	<!-- Sidebar -->
	<div class="sidebar-links">
		<ul class="links list-unstyled">
			<li class="link <?= $this->checkActive('index')?>">
				<a  href = "/index"><i class="fa fa-home"></i> <?= $sidebar_links_homepage ?> </a> 
			</li>
			<li class="link <?= $this->checkActive('supplier')?>">
				<a  href = "/index"><i class="fa fa-user-circle"></i> <?= $sidebar_links_supplier ?></a> 
			</li>
			<li class="link <?= $this->checkActive('client')?>">
				<a  href = "/index"><i class="fa fa-user"></i> <?= $sidebar_links_client ?></a> 
			</li>
			<li class="link <?= $this->checkActive('privilege')?>">
				<a class="toggle-submenu" href="#"><i class="fa fa-user"></i> <?= $sidebar_links_user?> </a>
				<!-- Submenu Users -->
				<ul class="submenu list-unstyled">
					<li class="link <?= $this->checkActive('group') ?> ">
						<a href="/users"><i class="fa fa-user"></i> <?= $sidebar_links_user ?></a>
					</li>
					<li class="link <?= $this->checkActive('group') ?> ">
						<a href="/group"><i class="fa fa-users"></i><?= $sidebar_links_group?></a>
					</li>	
					<li class="link <?= $this->checkActive('privilege')?>">
						<a href="/privilege"><i class="fa fa-key"></i> <?= $sidebar_links_privilege ?></a>
					</li>
				</ul> 
				<!-- End Submenu Users -->
			</li>
			<li class="link <?= $this->checkActive('store')?>">
				<a class="toggle-submenu" href="#"><i class="fa fa-shopping-cart"></i><?= $sidebar_links_store?></a> 
				<!-- Submenu Store -->
				<ul class="submenu list-unstyled">
					<li class="link">
						<a href="#"><i class="fa fa-key"></i> <?= $sidebar_links_category?></a>
					</li>
					<li class="link">
						<a href="#"><i class="fa fa-user"></i><?= $sidebar_links_product ?></a>
					</li>
				</ul> 
				<!-- End Submenu Store -->
			</li>
			<li class="link <?= $this->checkActive('report')?>" >
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