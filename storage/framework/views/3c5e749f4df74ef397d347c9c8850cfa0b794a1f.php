<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Device<small></small></h2>
                <div class="clearfix"></div>
            </div>  
            <div>
                <br>
                <div id="device_container">
                    <div class="row">
                        <div class="form-group col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            Device IP: <?php echo e($object['ip_address']); ?>

                        </div>
                        <div class="form-group col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            Device MAC Address: <?php echo e($object['mac_address']); ?>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            Incoming Bytes: <?php echo e($object['incoming_bytes']); ?>

                        </div>
                        <div class="form-group col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            Outgoing Bytes: <?php echo e($object['outgoing_bytes']); ?>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        Incoming Packets: <?php echo e($object['incoming_packets']); ?>

                        </div>
                        <div class="form-group col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        Outgoing Packets: <?php echo e($object['outgoing_packets']); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Network Traffic<small></small></h2>
                <div class="clearfix"></div>
            </div>  
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div style="height: 500px; overflow: auto;" id="bytes" data-id="<?php echo e(request()->traffic_sourceIP); ?>"></div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(url('js/details.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eyenet\eyenet\resources\views/details.blade.php ENDPATH**/ ?>