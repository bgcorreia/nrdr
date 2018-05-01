<!-- Fixed navbar -->
<div class="">
<div class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Databases<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="insertdatabase.php">Insert a new database</a></li>
                        <li><a href="managedatabase.php">Manage databases</a></li>
                        <li class="hidden"><a href="managedatabaseorganism.php">Associate databases with organisms</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Organisms<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="insertorganism.php">Insert a new organism</a></li>
                        <li><a href="manageorganism.php">Manage organisms</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sequences<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="insertsequence.php">Insert a new sequence</a></li>
                        <li><a href="managesequence.php">Manage sequences</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['USER']->email; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu" style="min-width: 100%">
                        <li class="navbar-text" style="margin-left: 20px">Last login in 10/18/2013</li>
                        <li><a href="#">Change my password</a></li>
                        <li><a href="index.php?action=logout">Log out</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.navbar-collapse -->
    </div>
</div>
</div>