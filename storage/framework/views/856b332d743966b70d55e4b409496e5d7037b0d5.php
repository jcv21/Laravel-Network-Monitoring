<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>ADMIN <small>Registration Form</small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />

          <form action="<?php echo e(route('register')); ?>" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
        <div class="form-group">
              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input name="name" id="name" placeholder="Enter your name" class="form-control col-md-7 col-xs-12" type="text"><span id="name_error" style="color:red;"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="email" id="email" placeholder="Enter your Email ID" required="required" class="form-control col-md-7 col-xs-12"><span id="email_error" style="color:red;"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Password <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="password" name="password" id="password" placeholder="Enter your password" required="required" class="form-control col-md-7 col-xs-12"><span id="password_error" style="color:red;"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Confirm Password <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="password" name="confirm_pasword" id="confirm_pasword" placeholder="Re-enter your password" required="required" class="form-control col-md-7 col-xs-12"><span id="confirm_password_error" style="color:red;"></span>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success" name="submit">Submit</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/eyenet/resources/views/users.blade.php ENDPATH**/ ?>