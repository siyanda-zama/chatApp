<?php require_once 'header.php'; ?>

<div class="container-fluid">

       
        
        <!-- end of success and error messsages -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold" style="color: #0D1644; float:left; padding-top: 11px;">
                    Messages
              </h6>
            </div>
            <div class="card-body">
              <h6 class="text-gray-400">
              Select message sender
              </h4>
              <form action="" method="POST" id="frmSenders">
              <select class="form-control" name="cbo-senders" onchange="document.getElementById('frmSenders').submit();">   
              <option  disabled>
                Select Sender
              </option> 
              <?php while($sender = $senders->fetch(PDO::FETCH_ASSOC)): ?>
                <option>
                <?php $receiver = $sender['sender_name'];?>
                <?php echo $sender['sender_name']; ?>
                </option>
              <?php endwhile;?>
              </select>
              </form><br>

              <p class="text-black-400">
                <?php foreach($messages->fetchAll() as $msg): ?>
                    <b><?php echo $msg['sender_name']; ?> <i>(<?php echo $msg['sent_datetime'];?>)</i></b>:<?php echo $msg['message'];?><br>  
                <?php endforeach;?>
              </p>
                <form action="" method="POST">
                    <textarea class="form-control" name="txtMsg" id="" cols="4" rows="2"></textarea><p></p>
                    <input type="hidden" name="receiver" value="<?php echo $receiver; ?>">
                    <input class="form-control" name="btnSendMsg" type="submit" class="btn" style="background:rgb(42,56,108);color:#fff;font-weight:bold;" value="Send!">
                </form><br>
            </div>
          </div>
 
        </div>
        <!-- /.container-fluid -->

      </div>

<?php require_once 'footer.php'; ?>