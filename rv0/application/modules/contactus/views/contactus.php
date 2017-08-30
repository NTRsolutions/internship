<div class="main-content news-page">
  <div class="col-lg-12">
    <div class="contact-form">
      <div class="page-header">
        <h1>Contact us</h1>
      </div>
      <div id="contactform"></div>
      <div class="page-content">
        <form class="" method="POST" id="contactus" action="<?php echo base_url();?>contactus/sendcontact" onSubmit="return false">
          <div class="form-group col-lg-8">
            <label for="exampleInputEmail1">Your Name <span>*</span></label>
            <input type="text" class="form-control required" alt="Name" name="name" id="exampleInputEmail1" placeholder="">
          </div>
          <div class="form-group col-lg-8">
            <label for="exampleInputPassword1">Your Email <span>*</span></label>
            <input type="text" class="form-control required email"  name="email"  alt="Email" id="exampleInputPassword1" placeholder="">
          </div>
          <div class="form-group col-lg-8">
            <label for="exampleInputEmail1">Subject <span>*</span></label>
            <input type="text" class="form-control required"  name="subject" id="exampleInputEmail1" alt="Subject" placeholder="">
          </div>
          <div class="form-group col-lg-12">
            <label for="exampleInputEmail1">Your Message <span>*</span></label>
            <textarea class="form-control required" name="message" alt="Message"rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-default" onClick="savecontact()">Send</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script  type="text/javascript"  src="<?php echo ASSETS;?>assets/js/validation.js"></script> 
<script  type="text/javascript"  src="<?php echo ASSETS;?>assets/js/contact.js"></script> 
