<?php
/*
Hipay Wallet & Direct Extension for Opencart 2.1.x
Author: diogojosferreira@gmail.com
*/
?>
<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-hipaycc" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-hipaycc" class="form-horizontal">

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="hipaycc_status" id="input-status" class="form-control">
                <?php if ($hipaycc_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>          

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sandbox"><?php echo $entry_sandbox; ?></label>
            <div class="col-sm-10">
              <select name="hipaycc_sandbox" id="input-sandbox" class="form-control">
                <?php if ($hipaycc_sandbox) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>          


          <div class="form-group">

            <label class="col-sm-2 control-label" for="hipaycc_sandbox_account"><?php echo $entry_sandbox_account; ?></label>
            <div class="col-sm-4">
              <input type="text" name="hipaycc_sandbox_account" value="<?php echo $hipaycc_sandbox_account; ?>" placeholder="" id="hipaycc_sandbox_account" class="form-control">
              <?php if ($error_mandatory_sandbox_1) { ?>
              <div class="text-danger"><?php echo $error_mandatory_sandbox_1; ?></div>
              <?php } ?>
            </div>

            <label class="col-sm-2 control-label" for="hipaycc_sandbox_website"><?php echo $entry_sandbox_website; ?></label>
            <div class="col-sm-4">
              <input type="text" name="hipaycc_sandbox_website" value="<?php echo $hipaycc_sandbox_website; ?>" placeholder="" id="hipaycc_sandbox_website" class="form-control">
              <?php if ($error_mandatory_sandbox_2) { ?>
              <div class="text-danger"><?php echo $error_mandatory_sandbox_2; ?></div>
              <?php } ?>
            </div>

            <label class="col-sm-2 control-label" for="hipaycc_sandbox_password"><?php echo $entry_sandbox_password; ?></label>
            <div class="col-sm-4">
              <input type="text" name="hipaycc_sandbox_password" value="<?php echo $hipaycc_sandbox_password; ?>" placeholder="" id="hipaycc_sandbox_password" class="form-control">
              <?php if ($error_mandatory_sandbox_3) { ?>
              <div class="text-danger"><?php echo $error_mandatory_sandbox_3; ?></div>
              <?php } ?>
            </div>

            <label class="col-sm-2 control-label" for="hipaycc_sandbox_shopid"><?php echo $entry_sandbox_shopid; ?></label>
            <div class="col-sm-4">
              <input type="text" name="hipaycc_sandbox_shopid" value="<?php echo $hipaycc_sandbox_shopid; ?>" placeholder="" id="hipaycc_sandbox_shopid" class="form-control">
            </div>

            <label class="col-sm-2 control-label" for="hipaycc_sandbox_category"><?php echo $entry_sandbox_category; ?></label>
            <div class="col-sm-4">
              <input type="text" name="hipaycc_sandbox_category" value="<?php echo $hipaycc_sandbox_category; ?>" placeholder="" id="hipaycc_sandbox_category" class="form-control">
              <?php if ($error_mandatory_sandbox_4) { ?>
              <div class="text-danger"><?php echo $error_mandatory_sandbox_4; ?></div>
              <?php } ?>
            </div>

          </div>

          <div class="form-group">

            <label class="col-sm-2 control-label" for="hipaycc_account"><?php echo $entry_account; ?></label>
            <div class="col-sm-4">
              <input type="text" name="hipaycc_account" value="<?php echo $hipaycc_account; ?>" placeholder="" id="hipaycc_account" class="form-control">
              <?php if ($error_mandatory_live_1) { ?>
              <div class="text-danger"><?php echo $error_mandatory_live_1; ?></div>
              <?php } ?>
            </div>

            <label class="col-sm-2 control-label" for="hipaycc_website"><?php echo $entry_website; ?></label>
            <div class="col-sm-4">
              <input type="text" name="hipaycc_website" value="<?php echo $hipaycc_website; ?>" placeholder="" id="hipaycc_website" class="form-control">
              <?php if ($error_mandatory_live_2) { ?>
              <div class="text-danger"><?php echo $error_mandatory_live_2; ?></div>
              <?php } ?>
            </div>

            <label class="col-sm-2 control-label" for="hipaycc_password"><?php echo $entry_password; ?></label>
            <div class="col-sm-4">
              <input type="text" name="hipaycc_password" value="<?php echo $hipaycc_password; ?>" placeholder="" id="hipaycc_password" class="form-control">
              <?php if ($error_mandatory_live_3) { ?>
              <div class="text-danger"><?php echo $error_mandatory_live_3; ?></div>
              <?php } ?>
            </div>

            <label class="col-sm-2 control-label" for="hipaycc_shopid"><?php echo $entry_shopid; ?></label>
            <div class="col-sm-4">
              <input type="text" name="hipaycc_shopid" value="<?php echo $hipaycc_shopid; ?>" placeholder="" id="hipaycc_shopid" class="form-control">
             </div>

            <label class="col-sm-2 control-label" for="hipaycc_category"><?php echo $entry_category; ?></label>
            <div class="col-sm-4">
              <input type="text" name="hipaycc_category" value="<?php echo $hipaycc_category; ?>" placeholder="" id="hipaycc_category" class="form-control">
              <?php if ($error_mandatory_live_4) { ?>
              <div class="text-danger"><?php echo $error_mandatory_live_4; ?></div>
              <?php } ?>
            </div>
          </div>


          <div class="form-group">


            <label class="col-sm-2 control-label" for="hipaycc_payment_title"><?php echo $entry_payment_title; ?></label>
            <div class="col-sm-10">
              <input type="text" name="hipaycc_payment_title" value="<?php echo $hipaycc_payment_title; ?>" placeholder="" id="hipaycc_payment_title" class="form-control">
              <?php if ($error_mandatory_1) { ?>
              <div class="text-danger"><?php echo $error_mandatory_1; ?></div>
              <?php } ?>
            </div>


            <label class="col-sm-2 control-label" for="hipaycc_payment_info"><?php echo $entry_payment_info; ?></label>
            <div class="col-sm-10">
              <input type="text" name="hipaycc_payment_info" value="<?php echo $hipaycc_payment_info; ?>" placeholder="" id="hipaycc_payment_info" class="form-control">
              <?php if ($error_mandatory_2) { ?>
              <div class="text-danger"><?php echo $error_mandatory_2; ?></div>
              <?php } ?>
            </div>



         </div>



          <div class="form-group">

            <label class="col-sm-2 control-label" for="hipaycc_email"><?php echo $entry_email; ?></label>
            <div class="col-sm-4">
              <input type="text" name="hipaycc_email" value="<?php echo $hipaycc_email; ?>" placeholder="" id="hipaycc_email" class="form-control">
            </div>


            <label class="col-sm-2 control-label" for="hipaycc_backcolor"><?php echo $entry_backcolor; ?></label>
            <div class="col-sm-4">
              <input type="text" name="hipaycc_backcolor" value="<?php echo $hipaycc_backcolor; ?>" placeholder="" id="hipaycc_backcolor" class="form-control">

            </div>

            <label class="col-sm-2 control-label" for="hipaycc_logo"><?php echo $entry_logo; ?></label>
            <div class="col-sm-4">
              <input type="text" name="hipaycc_logo" value="<?php echo $hipaycc_logo; ?>" placeholder="" id="hipaycc_logo" class="form-control">
            </div>


            <label class="col-sm-2 control-label" for="hipaycc_payment_currency"><?php echo $entry_payment_currency; ?></label>
            <div class="col-sm-4">
              <?php if ($hipaycc_payment_currency == "" ) $hipaycc_payment_currency = "EUR";?>
             <select name="hipaycc_payment_currency" id="hipaycc_payment_currency" class="form-control">
                <option value="EUR" <?php if ($hipaycc_payment_currency == "EUR") echo 'selected="selected";' ?>>Euro</option>
                <option value="GBP" <?php if ($hipaycc_payment_currency == "GBP") echo 'selected="selected";' ?>>Pound</option>
                <option value="USD" <?php if ($hipaycc_payment_currency == "USD") echo 'selected="selected";' ?>>Dolar</option>
              </select>
            </div>

            <label class="col-sm-2 control-label" for="hipaycc_payment_rating"><?php echo $entry_payment_rating; ?></label>
            <div class="col-sm-4">
              <?php if ($hipaycc_payment_rating == "" ) $hipaycc_payment_rating = "ALL";?>
             <select name="hipaycc_payment_rating" id="hipaycc_payment_rating" class="form-control">
                <option value="ALL" <?php if ($hipaycc_payment_currency == "ALL") echo 'selected="selected";' ?>>ALL</option>
                <option value="+12" <?php if ($hipaycc_payment_currency == "+12") echo 'selected="selected";' ?>>+12</option>
                <option value="+16" <?php if ($hipaycc_payment_currency == "+16") echo 'selected="selected";' ?>>+16</option>
                <option value="+18" <?php if ($hipaycc_payment_currency == "+18") echo 'selected="selected";' ?>>+18</option>
              </select>
            </div>


            <label class="col-sm-2 control-label" for="hipaycc_sort_order"><?php echo $entry_sort_order; ?></label>
            <div class="col-sm-4">
              <input type="text" name="hipaycc_sort_order" value="<?php echo $hipaycc_sort_order; ?>" placeholder="<?php echo $hipaycc_sort_order; ?>" id="hipaycc_sort_order" class="form-control" />
            </div>

            <label class="col-sm-2 control-label" for="hipaycc_sort_order"><?php echo $entry_payment_status; ?></label>
            <div class="col-sm-4">
              <select name="hipaycc_order_status_id" id="input-order-status" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                  <?php if ($order_status['order_status_id'] == $hipaycc_order_status_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                  <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                  <?php } ?>
                <?php } ?>
              </select>

            </div>


            <label class="col-sm-2 control-label" for="hipaycc_sort_order"><?php echo $entry_secret_key; ?></label>
            <div class="col-sm-4">
              <input type="text" name="hipaycc_secret_key" value="<?php echo $hipaycc_secret_key; ?>" placeholder="<?php echo $hipaycc_secret_key; ?>" id="hipaycc_secret_key" class="form-control" />
              <?php if ($error_mandatory_3) { ?>
              <div class="text-danger"><?php echo $error_mandatory_3; ?></div>
              <?php } ?>              
            </div>


          </div>






          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-help">SOAP</label>
            <div class="col-sm-2">
                <?php if ($hipaycc_soap) { 
                  echo '<span class="label label-info pull-left">OK</span><br>' . $text_enabled; 
                  } else { 
                   echo '<span class="label label-danger pull-left">KO</span><br>' . $text_disabled; 
                 } ?>
            </div>

            <label class="col-sm-2 control-label" for="input-help">SimpleXML</label>
            <div class="col-sm-2">
                <?php if ($hipaycc_simplexml) { 
                  echo '<span class="label label-info pull-left">OK</span><br>' . $text_enabled; 
                  } else { 
                   echo '<span class="label label-danger pull-left">KO</span><br>' . $text_disabled; 
                 } ?>
            </div>


            <label class="col-sm-2 control-label" for="input-help">cURL</label>
            <div class="col-sm-2">
                 
                <?php if ($hipaycc_curl) { 
                  echo '<span class="label label-info pull-left">OK</span><br>' . $text_enabled; 
                  } else { 
                   echo '<span class="label label-danger pull-left">KO</span><br>' . $text_disabled; 
                 } ?>
            </div>
          </div>  

          <div class="form-group">
            <label class="col-sm-12 control-label" for="input-help"><?php echo $hipaycc_help; ?></label>
          </div>  



        
        </form>
      </div>
  </div>
  </div>
</div>

<?php echo $footer; ?>