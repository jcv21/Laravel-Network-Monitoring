<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>

    <?php echo $__env->make("layout.header", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('css'); ?>

</head>
<body class="nav-md">
    <?php echo $__env->make('vendor.lara-izitoast.toast', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container body">
        <div class="main_container">

            <?php echo $__env->make("layout.sidebar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->make("layout.topbar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="right_col" role="main" style="min-height: 100vh;">

                <?php echo $__env->yieldContent("content"); ?>
                
            </div>
        
            <?php echo $__env->make("layout.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>
    </div>

    <?php echo $__env->yieldContent('js'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\eyenet\eyenet\resources\views/layout/app.blade.php ENDPATH**/ ?>