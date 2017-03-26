<!DOCTYPE html>
<html lang="en">
  <head>
    <title>RpiStreamer</title>
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
         <div class="navbar-header"><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="/">RpiStreamer</a></div>
         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
               <li id="statusmenu"><a id="statuslink" href="sysstatus.php">System status</a></li>
		<li id="optionsmenu"><a id="streamingLink" href="playerstatus.php">Player status</a></li>
		<li id="optionsmenu"><a id="configurationLink" href="playerconf.php">Player configuration</a></li>
		<li id="optionsmenu"><a id="configurationLink" href="sysconf.php">System configuration</a></li>
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">About <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                     <li class="dropdown-header"> <b>RpiStreamer</b></li>
                     <li><a href="http://www.storybel.com/" data-toggle="modal">Help</a></li>
                     <li><a href="/#License" data-toggle="modal">License</a></li>
                     <li><a href="/#About" data-toggle="modal">About</a></li>
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
