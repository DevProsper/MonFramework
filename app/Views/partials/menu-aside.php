<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Administration du site</strong>
                             </span> <span class="text-muted text-xs block">Quiter<b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="index.php?page=logout">Déconnexion</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    JENNY+
                </div>
            </li>
            <li class="<?php echo ($page=="accueil")? "active" : "";  ?>">
                <a href="index.php?page=accueil"><i class="fa fa-th-large"></i> <span class="nav-label">Tableau de bord </span></span></a>
            </li>
            <li class="<?php echo ($page=="posts")? "active" : "";  ?>">
                <a href="index.php?page=posts"><i class="fa fa-cutlery"></i> <span class="nav-label">Menu du jour </span></span></a>
            </li>
            <li class="<?php echo ($page=="categories")? "active" : "";  ?>">
                <a href="index.php?page=categories"><i class="fa fa-cutlery"></i> <span class="nav-label">Categories des plats</span></span></a>
            </li>
            <li class="<?php echo ($page=="group_boisson")? "active" : "";  ?>">
                <a href="index.php?page=group_boisson"><i class="fa fa-list"></i> <span class="nav-label">Group des boissons</span></span></a>
            </li>
            <li class="<?php echo ($page=="boissons")? "active" : "";  ?>">
                <a href="index.php?page=boissons"><i class="fa fa-list"></i> <span class="nav-label">Boissons</span></span></a>
            </li>
            <li class="<?php echo ($page=="sous_categories_boisson")? "active" : "";  ?>">
                <a href="index.php?page=sous_categories_boisson"><i class="fa fa-list"></i> <span class="nav-label">Categories (boissons)</span></span></a>
            </li>
            <li class="<?php echo ($page=="commandes")? "active" : "";  ?>">
                <a href="index.php?page=commandes"><i class="fa fa-shopping-bag"></i> <span class="nav-label">Commandes </span></span></a>
            </li>
            <li class="<?php echo ($page=="contacts")? "active" : "";  ?>">
                <a href="index.php?page=contacts"><i class="fa fa-envelope"></i> <span class="nav-label">Contacts </span></span></a>
            </li>
            <li class="<?php echo ($page=="galeries")? "active" : "";  ?>">
                <a href="index.php?page=galeries"><i class="fa fa-envelope"></i> <span class="nav-label">Nos evénements </span></span></a>
            </li>
            <li class="<?php echo ($page=="utilisateurs")? "active" : "";  ?>">
                <a href="index.php?page=utilisateurs"><i class="fa fa-users"></i> <span class="nav-label">Utilisateurs </span></span></a>
            </li>
        </ul>

    </div>
</nav>