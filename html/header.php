<!DOCTYPE html>
<html lang="en">
  <head>
    <title>OpenOb GUI | <?=MODE ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Cache-control" content="public" />

    <!-- CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/streamer.css" rel="stylesheet">

    <!-- Favicon-->
    <link rel="shortcut icon" type="image/png" href="/img/favicon.png">
  </head>

  <body>

    <!-- Fixed navbar -->
    <div id="topmenu">
   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
         <div class="navbar-header"><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="/">OpenOb GUI</a></div>
         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
				<li id="statusmenu"><a id="statuslink" href="sysstatus.php">System status</a></li>
				<?php if(MODE=='outstreamer'): ?>
				<li id="optionsmenu"><a id="playerLink" href="playerstatus.php">Player status</a></li>
				<li id="optionsmenu"><a id="playerconfLink" href="playerconf.php">Player configuration</a></li>
				<?php elseif(MODE=='instreamer'): ?>
				<li id="optionsmenu"><a id="encoderLink" href="encoderstatus.php">Encoder status</a></li>
				<li id="optionsmenu"><a id="encoderconfLink" href="encoderconf.php">Encoder configuration</a></li>
				<?php endif; ?>
				<li id="optionsmenu"><a id="sysconfLink" href="sysconf.php">System configuration</a></li>

				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">About <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					 <li class="dropdown-header"> <b>OpenOb GUI</b></li>
					 <li><a href="https://github.com/mickaelmonsieur/openob-gui/issues">Help</a></li>
					 <li><a href="https://www.gnu.org/licenses/agpl-3.0.en.html">License</a></li>
					 <li><a href="/#About">About</a></li>
					 <li class="dropdown-header"> <b>Author</b></li>
					 <li><a href="http://www.mickael.be">Personnal website</a></li>
					 <li><a href="http://www.storybel.com">Sponsoring company website</a></li>
				</ul>
				</li>
            </ul>
         </div>
         <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
   </nav>
    </div>

    <!-- Begin page content -->
    <div class="container-fluid">
      <div id="insertionPoint">
