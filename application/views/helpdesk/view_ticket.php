<div class="container">
  <div class="row">
    <div class="col-md-12 content-area">

<?php $prioritys = array(0 => "<span class='label label-info'>".lang("ctn_429")."</span>", 1 => "<span class='label label-primary'>".lang("ctn_430")."</span>", 2=> "<span class='label label-warning'>".lang("ctn_431")."</span>", 3 => "<span class='label label-danger'>".lang("ctn_432")."</span>"); ?>

 <h3 class="home-label">#<?php echo "ID" ?> - <?php echo $this->security->xss_clean("tittle") ?></h3> 

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("client/tickets") ?>"><?php echo lang("ctn_461") ?></a></li>
  <li class="active"><?php echo lang("ctn_773") ?> #<?php echo "ID" ?></li>
</ol>

 

<div class="row">
<div class="col-md-8">

<div class="panel panel-default">
<div class="panel-body">
<div class="col-md-12" style="word-wrap:break-word; overflow: visible !important;">
    <div class="pull-left">
      <?php echo "ucup"?>
  </div>
<h3 class="media-title"><?php echo "Yusuf" ?> <?php echo "Fadilah" ?></h3>
<p><?php echo "test oke" ?></p>

<!-- <div class="small-text">
<?php if($ticket_fields) : ?>
    <?php foreach($ticket_fields->result() as $r) : ?>
      <?php if(!$r->hide_clientside) : ?>
        <?php if($r->type == 5) : ?>
          <p><strong><?php echo $this->security->xss_clean($r->name) ?></strong><br /><?php echo $this->security->xss_clean($r->value) ?></p>
            <?php if(isset($r->itemname) && !empty($r->itemname)) : ?>
                  <p><?php echo lang("ctn_680") ?>: <strong><?php echo $this->security->xss_clean($r->itemname) ?></strong></p>
              <?php endif; ?>
              <?php if(isset($r->support) && !empty($r->support)) : ?>
                  <p><?php echo lang("ctn_681") ?>: <strong><?php echo date($this->settings->info->date_format, $r->support) ?></strong></p>
              <?php endif; ?>
              <?php if(isset($r->error) && !empty($r->error)) : ?>
                  <p><?php echo lang("ctn_682") ?>: <?php echo $r->error ?></p>
              <?php endif; ?> 
        <?php else :?>
          <p><strong><?php echo $this->security->xss_clean($r->name) ?></strong><br /><?php echo $this->security->xss_clean($r->value) ?></p>
        <?php endif; ?>
      <?php endif; ?>
    <?php endforeach; ?>
  <?php endif; ?>
  </div> -->

  </div>

</div>
</div>

</div>
<div class="col-md-4">

<div class="panel panel-default">
<div class="panel-body">
  <h4 class="media-title"><?php echo "Ticket Detials" ?></h4>
<table class="table">
<tr><td class="ticket-label-info"><?php echo "#" ?></td><td> <?php echo "1" ?></td></tr>
<tr><td class="ticket-label-info"><?php echo "username" ?></td><td><?php echo "yusufdilah"; ?></td></tr>
<tr><td class="ticket-label-info"><?php echo "Created" ?></td><td><?php echo "18/08/2021 11:11" ?></td></tr>
<tr><td class="ticket-label-info"><?php echo "Priority" ?></td><td><?php echo "Medium" ?></td></tr>
<tr><td class="ticket-label-info"><?php echo "Last Update" ?></td><td><?php echo "23/08/2021 03:37 " ?></td></tr>
<tr><td class="ticket-label-info"><?php echo "Category" ?></td><td><?php echo "Default" ?></td></tr>
<tr><td class="ticket-label-info"><?php echo "Status" ?></td><td><button class="btn btn-default btn-xs" type="button" id="status-button" ><?php echo "New" ?></button></td></tr>
</table>

     <?php if($this->settings->info->enable_ticket_edit) : ?>
    <hr>
    <p><a href="<?php echo site_url("client/edit_ticket/" . $ticket->ID) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="right" title="<?php echo lang("ctn_55") ?>"><span class="glyphicon glyphicon-cog"></span></a></p>
  <?php endif; ?>

</div>
</div>

<?php if($this->settings->info->enable_ticket_uploads && $owner) : ?>
<div class="panel panel-default">
<div class="panel-body">
  <ul>
    <?php
    $view = false;
    if($this->common->has_permissions(array(
          "admin", "ticket_manager"), $this->user)) {
         $view = true;
        }
    ?>
  <?php foreach($files->result() as $r) : ?>
    <li><?php echo $r->upload_file_name ?> (<?php echo $r->file_type ?>) (<?php echo $r->file_size ?>kb) 
      <?php if($view) : ?>[<a href="<?php echo $r->google_drive_url ?>" target="_blank">Drive Link</a>]<?php endif; ?></li>
  <?php endforeach; ?>
</ul>
<hr>
 <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal"><?php echo lang("ctn_436") ?></button>
  </div>
</div>
<?php endif; ?>

</div>
</div>



<?php foreach($replies->result() as $r) : ?>
  <?php
    if($r->userid == 0 || $r->userid == $ticket->userid) {
      $class = "panel-primary";
    } else {
      $class = "panel-admin";
    }
  ?>
<div class="panel <?php echo $class ?>">
<div class="panel-body">
  <?php if( (isset($_SESSION['ticketid']) && isset($_SESSION['ticketpass']) && $r->userid == 0) || ($this->user->loggedin && $r->userid == $this->user->info->ID) || $this->common->has_permissions(array("admin", "ticket_manager", "ticket_worker"), $this->user)) : ?>
    <div class="ticket-reply-options">
    <a href="<?php echo site_url("client/edit_ticket_reply/" . $r->ID) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="right" title="<?php echo lang("ctn_55") ?>"><span class="glyphicon glyphicon-cog"></span></a>
    <a href="<?php echo site_url("client/delete_ticket_reply/" . $r->ID . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo lang("ctn_317") ?>')" data-toggle="tooltip" data-placement="right" title="<?php echo lang("ctn_57") ?>"><span class="glyphicon glyphicon-trash"></span></a>
    </div>
  <?php endif; ?>
  <div class="media">
  <div class="media-left">
    <?php echo $this->common->get_user_display(array("username" => $r->username, "avatar" => $r->avatar, "online_timestamp" => $r->online_timestamp)) ?>
  </div>
  <div class="media-body">
    <h4 class="media-title"><?php if(isset($r->username)) : ?><a href="<?php echo site_url("profile/" . $r->username) ?>"><?php echo $r->username ?></a><?php else : ?><strong><?php echo $ticket->guest_email ?></strong><?php endif; ?></h4>
<p><?php echo $this->security->xss_clean($r->body) ?></p>
<p class="small-text"><?php echo date($this->settings->info->date_format, $r->timestamp); ?></p>

</div>
</div>
</div>
</div>
<?php endforeach; ?>

<?php if($ticket->status_close && $this->settings->info->close_ticket_reply) : ?>
<div class="panel panel-default">
<div class="panel-body">
<h4><?php echo lang("ctn_774") ?></h4>
</div>
</div>
<?php else : ?>
  <?php if($ticket->public && !$owner) : ?>
    <div class="panel panel-default">
<div class="panel-body">
<h4><?php echo lang("ctn_775") ?></h4>
</div>
</div>
  <?php else : ?>
<div class="panel panel-default">
<div class="panel-body">
<h4><?php echo lang("ctn_473") ?></h4>
<?php echo form_open(site_url("client/ticket_reply/" . $ticket->ID), array("class" => "form-horizontal")) ?>
<p><textarea name="body" id="ticket-body" class="form-control" rows="8"></textarea></p>

<p><input type="submit" class="btn btn-primary btn-sm form-control" value="<?php echo lang("ctn_474") ?>"></p>
<?php echo form_close() ?>
</div>
</div>
<?php endif; ?>

<?php endif; ?>

</div>
</div>
</div>

<?php if($this->settings->info->enable_ticket_uploads && $owner) : ?>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang("ctn_436") ?></h4>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart(site_url("client/ticket_upload/" . $ticket->ID), array("class" => "form-horizontal")) ?>
            <div class="form-group">
                    <label for="email-in" class="col-md-3 label-heading"><?php echo lang("ctn_438") ?></label>
                    <div class="col-md-9">
                        <input type="file" class="form-control" id="email-in" name="userfile">
                    </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
        <input type="submit" class="btn btn-primary" value="<?php echo lang("ctn_436") ?>" />
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<script type="text/javascript">
   "use strict";


function changeStatus(ticketid, id) {
  $('#status-button-update').fadeIn(100);
  $.ajax({
    url: global_base_url + "tickets/change_status",
    type: "GET",
    data: {
      status : id,
      ticketid : ticketid
    },
    dataType : 'json',
    success: function(msg) {
      if(msg.error) {
        alert(msg.error_msg);
        return;
      }
      if(id == 0) {
        $('#status-button').removeClass();
        $('#status-button').addClass("btn btn-info btn-xs dropdown-toggle");
        $('#status-button').html('<?php echo lang("ctn_465") ?>  <span class="caret"></span>');
      } else if(id == 1) {
        $('#status-button').removeClass();
        $('#status-button').addClass("btn btn-primary btn-xs dropdown-toggle");
        $('#status-button').html('<?php echo lang("ctn_466") ?>  <span class="caret"></span>');
      } else if(id == 2) {
        $('#status-button').removeClass();
        $('#status-button').addClass("btn btn-danger btn-xs dropdown-toggle");
        $('#status-button').html('<?php echo lang("ctn_467") ?>  <span class="caret"></span>');
      }
      //$('#status-button-update').html(msg);
      $('#status-button-update').fadeOut(500);
    }
  })
}

$(document).ready(function() {
 "use strict";
  var rated = 0; 
  $('#ticket1').hover(function() {
    fill_stars(1);
  }, function() {
    empty_stars(5);
  });

  $('#ticket2').hover(function() {
    fill_stars(2);
  }, function() {
    empty_stars(5);
  });

  $('#ticket3').hover(function() {
    fill_stars(3);
  }, function() {
    empty_stars(5);
  });

  $('#ticket4').hover(function() {
    fill_stars(4);
  }, function() {
    empty_stars(5);
  });

  $('#ticket5').hover(function() {
    fill_stars(5);
  }, function() {
    empty_stars(5);
  });

  function fill_stars(stars) 
  {
    for(var i = 0; i<=stars;i++) {
      $('#ticket'+i).removeClass("glyphicon glyphicon-star-empty");
      $('#ticket'+i).addClass("glyphicon glyphicon-star");
    }
  }

  function empty_stars(stars) 
  {
    for(var i = 0; i<=stars;i++) {
      if(rated < i) {
        $('#ticket'+i).removeClass("glyphicon glyphicon-star");
        $('#ticket'+i).addClass("glyphicon glyphicon-star-empty");
      }
    }
  }

  

  $('#ticket1').click(function() {
    rate_ticket(1);
    fill_stars(1);
  });

  $('#ticket2').click(function() {
    rate_ticket(2);
    fill_stars(2);
  });

  $('#ticket3').click(function() {
    rate_ticket(3);
    fill_stars(3);
  });

  $('#ticket4').click(function() {
    rate_ticket(4);
    fill_stars(4);
  });

  $('#ticket5').click(function() {
    rate_ticket(5);
    fill_stars(5);
  });

  function rate_ticket(stars) 
  {
    rated = stars;
    $.ajax({
      url: global_base_url + "client/rate_ticket/" + <?php echo "ID" ?> + "/" + global_hash,
      type: "get",
      data: {
        rating : stars
      },
      success: function(msg) {
        
      }
    });
  }
});

</script>