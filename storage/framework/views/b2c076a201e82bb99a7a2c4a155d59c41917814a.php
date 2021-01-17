<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php echo $__env->make("layout.header", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</head>

<body class="login">
  <div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
            <?php if(Session::has('success')): ?>
              <div class="alert alert-success" role="alert">
                  <?php echo e(Session::get('success')); ?>

                  <?php
                      Session::forget('success');
                  ?>
              </div>
            <?php elseif(Session::has('error')): ?>
              <div class="alert alert-danger" role="alert">
                <?php echo e(Session::get('error')); ?>

                <?php
                    Session::forget('error');
                ?>
              </div>
            <?php endif; ?>
          <form action="<?php echo e(route('login')); ?>" method="POST">
            <?php echo csrf_field(); ?>
              <h1>Login Form</h1>
            <div>
              <label>Email</label> <span id="email_error"></span>
              <input type="text" name="email" id="email" class="form-control" placeholder="Enter your Email ID" required="" />
            </div>
            <div>
              <label>Password</label><span id="password_error"></span>
              <input type="Password" name="password" id="password" class="form-control" placeholder="Enter your password" required="" />
            </div>
            <div>
              <button type="submit" name="submit" class="btn btn-default submit">Login</button>
            </div>

            <div class="clearfix"></div>

            <div class="separator">
              <p class="change_link">New to site?
                <a href="#signup" class="to_register"> Create Account </a>
              </p>

              <div class="clearfix"></div>
              <br />

              <div>
                <h1><i class="fa fa-paw"></i> Eyenet</h1>
                <p>©2019 All Rights Reserved. Eyenet! is a network monitoring system for decision support with descriptive analytics.</p>
              </div>
            </div>
          </form>
        </section>
      </div>

      <div id="register" class="animate form registration_form">
        <section class="login_content">
          <?php if(Session::has('success')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo e(Session::get('success')); ?>

                <?php
                    Session::forget('success');
                ?>
            </div>
          <?php elseif(Session::has('error')): ?>
            <div class="alert alert-danger" role="alert">
              <?php echo e(Session::get('error')); ?>

              <?php
                  Session::forget('error');
              ?>
            </div>
          <?php endif; ?>
        <form method="POST" action="<?php echo e(route('register')); ?>">
          <?php echo csrf_field(); ?>
        <h1>Create Account</h1>
        <div>
          <input type="text" class="form-control" placeholder="Username" id="name" name="name" required="" />
          <?php echo $errors->first('name', '<small class="text-danger">:message</small>'); ?>

        </div>
        <div>
          <input type="email" class="form-control" placeholder="Email" id="email" name="email" required />
          <?php echo $errors->first('email', '<small class="text-danger">:message</small>'); ?>

        </div>
        <div>
          <input type="password" class="form-control" placeholder="Password" id="password" name="password" required="" />
          <?php echo $errors->first('password', '<small class="text-danger">:message</small>'); ?>

        </div>
        <div>
          <input type="password" class="form-control" placeholder="Confirm Password" id="confirm_password" name="confirm_password" required="" />
          <?php echo $errors->first('confirm_password', '<small class="text-danger">:message</small>'); ?>

        </div>
        <div>
          <button class="btn btn-default submit" type="submit">Submit</button>
        </div>
        <div class="clearfix"></div>
        <div class="separator">
          <p class="change_link">Already a member ?
          <a href="#signin" class="to_register"> Log in </a>
        </p>
        <div class="clearfix"></div>
        <br />
        <div>
          <h1><i class="fa fa-paw"></i> Eyenet</h1>
          <p>©2019 All Rights Reserved. Eyenet! is a network monitoring system for decision support with descriptive analytics.</p>
        </div>
      </div>
    </div>

  </div>

</body>
</html><?php /**PATH /var/www/html/eyenet/resources/views/login.blade.php ENDPATH**/ ?>