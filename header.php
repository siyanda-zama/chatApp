<?php
  session_start();

  require_once 'scripts/chat.php';
  $chat = new Chat;
  $senders = $chat->getSenders($_SESSION['number']);
  $messages = $chat->getMsgs($_SESSION['number'],$chat->getFirstSender($_SESSION['number']));
  #get senders
  if(isset($_POST['cboSenders']))
  {
    $senders = $chat->getSenders($_SESSION['number']);
  }

  # send message
  if(isset($_POST['btnSendMsg']) && isset($_POST['txtMsg']) && clean($_POST['txtMsg']) != '')
  {
    $response = $chat->sendMsg($_SESSION['number'],$_POST['receiver'],clean($_POST['txtMsg']));
    $senders = $chat->getSenders($_SESSION['number']);
    $messages = $chat->getMsgs($_SESSION['number'],$_POST['receiver']);
    exit(header('Location: dash.php'));
  }
  
  # logout
  if(isset($_POST['btnLogout']))
  {
    session_destroy();
    exit(header('Location: /'));
  }

  #sanitize inputs
  function clean($data)
	{
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = trim($data);
		return $data;
  }
  

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>
    Results Portal
  </title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="icon" type="image/png" href="login/images/icons/favicon.ico"/>
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body id="page-top">
<!-- thekwini college rgb(42,56,108); -->

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light prim-bg topbar mb-4 static-top shadow">
              <a href="dash.php">
                <img src="login/images/chat.png" style="height: 9vh;width: 20vh;">
              </a>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                </h6>
                <br>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  <br>
                
                <a class="dropdown-item text-center small text-gray-500" href="#" data-toggle="modal" data-target="#mdlMessage">
                  <b>
                    Send a message
                  </b>
                </a>
                <br>

              </div>
            </li>

            

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline">
                <?php echo $_SESSION['number']; ?>
                </span>
                <img class="img-profile rounded-circle" src="img/user.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  <?php echo $_SESSION['number']; ?>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->