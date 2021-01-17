<script>
            <?php $__currentLoopData = session('toasts', collect())->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $toast): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    var options = {
            title: '<?php echo e($toast['title']); ?>',
            message: '<?php echo e($toast['message']); ?>',
            messageColor: '<?php echo e($toast['messageColor']); ?>',
            messageSize: '<?php echo e($toast['messageSize']); ?>',
            titleLineHeight: '<?php echo e($toast['titleLineHeight']); ?>',
            messageLineHeight: '<?php echo e($toast['messageLineHeight']); ?>',
            position: '<?php echo e($toast['position']); ?>',
            titleSize: '<?php echo e($toast['titleSize']); ?>',
            titleColor: '<?php echo e($toast['titleColor']); ?>',
            closeOnClick: '<?php echo e($toast['closeOnClick']); ?>',

        };

    var type = '<?php echo e($toast["type"]); ?>';

    show(type, options);

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    function show(type, options) {
        if (type === 'info'){
            iziToast.info(options);
        }
        else if (type === 'success'){
            iziToast.success(options);
        }
        else if  (type === 'warning'){
            iziToast.warning(options);
        }
        else if (type === 'error'){
            iziToast.error(options);
        } else {
            iziToast.show(options);
        }

    }
</script>

<?php echo e(session()->forget('toasts')); ?><?php /**PATH /var/www/html/eyenet/resources/views/vendor/lara-izitoast/toast.blade.php ENDPATH**/ ?>