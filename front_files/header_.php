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
                <img src="img/mini-logo.png" style="height: 49px; width: auto; position: absolute; margin-top: -14px" >
                <div class="logoName" style="margin-left: 50px!important">
                    <img src="img/nrdr-font.png" style="height: 30px; margin-top: -5px">
                    <div>Non-coding RNA Databases Resource</div>
                </div>

            </a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li id="menu-index">     <a href="<?php echo BASE_URL ?>index.php">Home</a></li>
                <li id="menu-about">     <a href="<?php echo BASE_URL ?>about.php">About</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Search <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li id="menu-search">    <a href="<?php echo BASE_URL ?>search.php">Advanced Search</a></li>
                        <li id="menu-sequences">    <a href="<?php echo BASE_URL ?>sequences.php">Advanced Search</a></li>
                    </ul>
                </li>
                <li id="menu-browser">   <a href="<?php echo BASE_URL ?>browser.php">Browser</a></li>
                <li id="menu-statistics"><a href="<?php echo BASE_URL ?>statistics.php">Statistics</a></li>
                <li id="menu-team">   <a href="<?php echo BASE_URL ?>team.php">Team</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

