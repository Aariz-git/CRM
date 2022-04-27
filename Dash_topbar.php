            <?php
            
            require_once("./config.php");
            ?>
            <!-- HEADER DESKTOP-->
            <header class="header-desktop" style="background-color:black">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        <div class="account-wrap" style="float:right;">
                            <div class="account-item clearfix js-item-menu">
                                <div class="image">
                                <?php 
                                     if(isset($_SESSION["admin_id"])){
                                        $query = "SELECT * FROM admins WHERE a_id ='$_SESSION[admin_id]'";
                                        $result = mysqli_query($con, $query);
                                        $row = $result->fetch_assoc();
                                      
                                     }
                                     ?>
                                    <img src="./Upload/Admin/<?php echo $row['image'] ?>" alt="John Doe"/>
                                </div>
                                <div class="content">
                                     
                                    <a class="js-acc-btn" href="#"><?php echo $row['username'] ?></a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="info clearfix">
                                        <div class="image">
                                            <a href="#">
                                            <img src="./Upload/Admin/<?php echo $row['image'] ?>" alt="John Doe" width="100%" height="100%"/>

                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="name">
                                                <a href="#"><?php echo $row['username'] ?></a>
                                            </h5>
                                            <span class="email"><?php echo $row['email'] ?></span>
                                        </div>
                                    </div>

                                    <div class="account-dropdown__footer">
                                        <a href="Logout.php">
                                            <i class="zmdi zmdi-power"></i>Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </header>
            <!-- HEADER DESKTOP-->