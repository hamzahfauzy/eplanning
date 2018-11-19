<!--Topbar Start Here -->
<header class="top-bar">
    <div class="container-fluid top-nav">
        <div class="search-form search-bar">
            <form>
                <input name="searchbox" value="" placeholder="Search Topic..." class="search-input">
            </form>
            <span class="search-close waves-effect"><i class="ico-cross"></i></span>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="judul-aplikasi">
                    <?= $judul_aplikasi ?>
                </div>
                <div class="clearfix top-bar-action">
                    <span class="leftbar-action-mobile waves-effect"><i class="fa fa-bars "></i></span>
                    <span class="leftbar-action desktop waves-effect"><i class="fa fa-bars "></i></span>
                    <span class="rightbar-action waves-effect"><i class="fa fa-bars"></i></span>
                </div>
            </div>
            <div class="col-md-4 responsive-fix top-mid">
            </div>
            <div class="col-md-6 responsive-fix">
                <div class="top-aside-right">
                    <div class="user-nav">
                        <ul>
                            <li class="dropdown">
                                <a data-toggle="dropdown" href="#" class="clearfix dropdown-toggle waves-effect waves-block waves-classic">
                                    <span class="user-info">Tumino<cite>Lingkungan I SITIREJO, Kecamatan Medan Amplas</cite></span>
                                    <span class="user-thumb"><img src="images/avatar/jaman.jpg" alt="image"></span>
                                </a>
                                <ul role="menu" class="dropdown-menu fadeInUp">
                                    <li><a href="#"><span class="user-nav-icon"><i class="fa fa-briefcase"></i></span><span class="user-nav-label">My Account</span></a>
                                    </li>
                                    <li><a href="#"><span class="user-nav-icon"><i class="fa fa-user"></i></span><span class="user-nav-label">View Profile</span></a>
                                    </li>
                                    <li><a href="#"><span class="user-nav-icon"><i class="fa fa-cogs"></i></span><span class="user-nav-label">Settings</span></a>
                                    </li>
                                    <li><a href="#"><span class="user-nav-icon"><i class="fa fa-lock"></i></span><span class="user-nav-label">Logout</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="pull-right desktop-search">
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>