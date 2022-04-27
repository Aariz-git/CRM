<!-- HEADER MOBILE-->
<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="./Dashboard.php">
                    <img src="./Admin_Dashboard/Dashboard/images/icon/logo.png" alt="CoolAdmin" style="height: 60px; width:100%;" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li class="">
                    <a href="Dashboard.php">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-user"></i>Admin</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="Add_admin.php">
                                <i class="zmdi zmdi-account-add"></i>Add Admin</a>
                        </li>
                        <li>
                            <a href="Edit_admin.php">
                                <i class="zmdi zmdi-wrench"></i>Edit Admin</a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="Customer.php">
                        <i class="fas fa-users"></i>Customer</a>
                </li>
                <li class="has-sub">
                    <a href="#" class="js-arrow">
                        <i class="fas fa-box"></i>Buyer</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="Buyer_item.php">
                                <i class="fas fa-boxes"></i>Buyer Item</a>
                        </li>
                        <li class="">
                            <a href="our_supplied.php">
                                <i class="fas fa-shipping-fast"></i>Our Supplied</a>
                        </li>
                        <li>
                            <a href="Buyer_quotation.php">
                                <i class="fas fa-file-alt"></i>Buyer Quotation Register</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#" class="js-arrow">
                        <i class="fas fa-truck"></i>Supplier</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li class="">
                            <a href="supplier_item.php">
                                <i class="fas fa-boxes"></i>Supplier Items</a>
                        </li>
                        <li class="">
                            <a href="Dtl_supplier_item.php">
                                <i class="fas fa-info-circle"></i>Details of Supplier Item</a>
                        </li>
                        <li class="">
                            <a href="supplier_db.php">
                                <i class="fas fa-database"></i>Supplier Database</a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="indent_register.php">
                        <i class="fas fa-registered"></i>Indent Register</a>
                </li>

                <li class="">
                    <a href="Pay_term.php">
                        <i class="fas fa-credit-card"></i>Payment Term</a>
                </li>
                <li class="">
                    <a href="Dashboard.php">
                        <i class="fas fa-dolly"></i>Goods Not Shipped</a>
                </li>
                <li class="">
                    <a href="Dashboard.php">
                        <i class="fas fa-clipboard"></i>Sample Record</a>
                </li>
                <li class="">
                    <a href="Proposal.php">
                        <i class="fas fa-file"></i>Proposal</a>
                </li>
                <li class="">
                    <a href="DWR.php">
                        <i class="fas fa-print"></i>Daily Working Report</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- END HEADER MOBILE-->



<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block" style="background-color:black">
    <div class="logo" style="background-color:black">
        <a href="./Dashboard.php">
            <img src="./Admin_Dashboard/Dashboard/images/icon/logo.png" alt="Cool Admin" style="height: 85px;" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">

                <li class="">
                    <a href="Dashboard.php">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="">
                    <a class="js-arrow" href="#">

                        <i class="fa fa-user"></i>Admin</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="Add_admin.php">
                                <i class="zmdi zmdi-account-add"></i>Add Admin</a>
                        </li>
                        <li>
                            <a href="Edit_admin.php">
                                <i class="zmdi zmdi-wrench"></i>Edit Admin</a>
                        </li>

                    </ul>
                </li>
                <li class="">
                    <a href="Customer.php">
                        <i class="fas fa-users"></i>Customer</a>
                </li>
                <li class="">
                    <a href="#" class="js-arrow">
                        <i class="fas fa-box"></i>Buyer</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li class="">
                            <a href="Buyer_item.php">
                                <i class="fas fa-boxes"></i>Buyer Item</a>
                        </li>
                        <li class="">
                            <a href="our_supplied.php">
                                <i class="fas fa-shipping-fast"></i>Our Supplied</a>
                        </li>
                        <li class="">
                            <a href="Buyer_quotation.php">
                                <i class="fas fa-file-alt"></i>Buyer Quotation Register</a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="#" class="js-arrow">
                        <i class="fas fa-truck"></i>Supplier</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li class="">
                            <a href="supplier_item.php">
                                <i class="fas fa-boxes"></i>Supplier Items</a>
                        </li>
                        <li class="">
                            <a href="Dtl_supplier_item.php">
                                <i class="fas fa-info-circle"></i>Details of Supplier Item</a>
                        </li>
                        <li class="">
                            <a href="supplier_db.php">
                                <i class="fas fa-database"></i>Supplier Database</a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="indent_register.php">
                        <i class="fas fa-registered"></i>Indent Register</a>
                </li>

                <li class="">
                    <a href="Pay_term.php">
                        <i class="fas fa-credit-card"></i>Payment Term</a>
                </li>
                <li class="">
                    <a href="Dashboard.php">
                        <i class="fas fa-dolly"></i>Goods Not Shipped</a>
                </li>
                <li class="">
                    <a href="Dashboard.php">
                        <i class="fas fa-clipboard"></i>Sample Record</a>
                </li>
                <li class="">
                    <a href="Proposal.php">
                        <i class="fas fa-file"></i>Proposal</a>
                </li>
                <li class="">
                    <a href="DWR.php">
                        <i class="fas fa-print"></i>Daily Working Report</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->