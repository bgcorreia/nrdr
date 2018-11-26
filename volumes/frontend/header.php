<div class="container">
    <img src="<?php echo BASE_URL ?>img/smenu.png" style="position: absolute; margin-top: 50px; margin-left: -40px" >
</div>
<!-- Fixed navbar -->
<div class="navbar navbar-default" id="menu">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="<?php echo BASE_URL ?>">

               <!--
                <div class="logoName">NRDR
                    <div>Non-coding RNA Databases Resource</div>
                </div>
               -->
               <!--
                <div class="logoName"><img src="img/nrdr-logo-1.png" style="height: 47px; width: auto; margin-top: -8px!important"></div>
               -->
                <!-- <img src="img/mini-logo.png" style="height: 65px; width: auto; position: absolute; margin-top: -14px" > -->
                <img src="img/mini-logo.png" style="height: 60px; width: auto; position: absolute; margin-top: -14px">
                <div class="logoName" style="margin-left: 50px!important">
                    <img src="img/nrdr-font.png" style="height: 45px; margin-top: -5px">
                    <div>Non-coding RNA Databases Resource</div>
                </div>

            </a>
        </div>
	<div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li id="menu-index">     <a href="https://ncrnadatabases.org">Home</a></li>
                <li id="menu-about">     <a href="<?php echo BASE_URL ?>about.php">About NRDR</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Search</a>
                    <ul class="dropdown-menu" role="menu">
                        <li id="menu-search" class="submenu">    <a href="<?php echo BASE_URL ?>search.php">Advanced Search</a></li>
                        <li id="menu-sequences" class="submenu">    <a href="<?php echo BASE_URL ?>sequences.php">Sequences</a></li>
                    </ul>
                </li>
                <li id="menu-browser">   <a href="<?php echo BASE_URL ?>browser.php">Browser</a></li>
                <li id="menu-statistics"><a href="<?php echo BASE_URL ?>statistics.php">Statistics</a></li>
                <li id="menu-team">   <a href="<?php echo BASE_URL ?>team.php">Team</a></li>
                <li id="menu-download">   <a href="https://nr2.ncrnadatabases.org">NR2 Database</a></li>
                <li id="menu-submitdatabase">   <a href="<?php echo BASE_URL ?>submitdatabase.php">Submit</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

