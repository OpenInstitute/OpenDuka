<?php
//If the form is submitted
if(isset($_POST['submit'])) {

	//Check to make sure that the name field is not empty
	if(trim($_POST['contactname']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['contactname']);
	}
/*
	//Check to make sure that the name field is not empty
	if(trim($_POST['weburl']) == '') {
		// $hasError = true;
		$weburl = "not listed";
	} else {
		$weburl = trim($_POST['weburl']);
	}
*/
	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) == '')  {
		$hasError = true;
	} else if (!filter_var( trim($_POST['email'], FILTER_VALIDATE_EMAIL ))) {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	//Check to make sure comments were entered
	if(trim($_POST['message']) == '') {
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['message']));
		} else {
			$comments = trim($_POST['message']);
		}
	}

	//If there is no error, send the email
	if(!isset($hasError)) {
		$emailTo = 'anne+openduka@openinstitute.com'; // Put your own email address here
		$subject = 'Open Duka Contact Form';
		$headers = 'From: Open Duka <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
		$body = "Name: $name \n\nEmail: $email  \n\nComments:\n $comments";
		

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}
}
?>

<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.pack.js" type="text/javascript"></script>
<script src="js/bootstrap-contact.js" type="text/javascript"></script>

<div id="contact-us" class="row">

	<h1>Feedback</h1>
	
	<div class="col-md-8 col-md-push-2">
        <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="contactform">
          <fieldset>
            <legend>We'd love to hear your feedback and suggestions</legend>

            <?php if(isset($hasError)) { //If errors are found ?>
              <p class="alert alert-danger">Please check if you've filled all the fields with valid information and try again. Thank you.</p>
            <?php } ?>

            <?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
              <div class="alert alert-success">
                <p><strong>Message Successfully Sent!</strong></p>
                <p>Thank you for using our contact form, <strong><?php echo $name;?></strong>! Your email was successfully sent and we&rsquo;ll be in touch with you soon.</p>
              </div>
            <?php } ?>

            <div class="form-group">
              <label for="name">Your Name<span class="help-required">*</span></label>
              <input type="text" name="contactname" id="contactname" value="" class="form-control required" role="input" aria-required="true" />
            </div>

            <div class="form-group">
              <label for="email">Your Email<span class="help-required">*</span></label>
              <input type="text" name="email" id="email" value="" class="form-control required email" role="input" aria-required="true" />
            </div>	
<!--
            <div class="form-group">
              <label for="weburl">Your Website</label>
              <input type="text" name="weburl" id="weburl" value="" class="form-control url" role="input" aria-required="false" />
            </div>
-->
            <div class="form-group">
              <label for="message">Your Feedback<span class="help-required">*</span></label>
              <textarea rows="8" name="message" id="message" class="form-control required" role="textbox" aria-required="true"></textarea>
            </div>

            <div class="actions">
              <input type="submit" value="Send Your Feedback" name="submit" id="submitButton" class="btn btn-default" title="Click here to submit your message!" />
              <input type="reset" value="Clear Form" class="btn btn-info" title="Remove all the data from the form." />
            </div>
          </fieldset>
        </form>
      </div><!-- col -->
    </div><!-- row -->
</div>
