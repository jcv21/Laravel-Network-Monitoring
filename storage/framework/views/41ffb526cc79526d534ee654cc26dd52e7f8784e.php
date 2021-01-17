<?php $__env->startSection('content'); ?>


<div class="row tile_count">
    <div class="col-md-4 col-sm-2 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
            <div class="count" id="myDivCount"></div>
        <hr></hr>
    </div>
    <div class="col-md-4 col-sm-2 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-clock-o"></i> Total Bandwidth Used</span>
            <div class="count" id="myDivBand"></div>
        <hr></hr>
    </div>
    <div class="col-md-4 col-sm-2 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Activity Done of all IP's</span>
            <div class="count" id="myDivTut"></div>
        <hr></hr>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <div class="row x_title">
                <div class="col-12 col-sm-12 col-md-12">
                    <h3>Network Traffic (In/Out) 
                        <small>       
                        <button type="button" class="btn btn-danger btn-sm" id="btn_clear_ips" name="btn_clear_ips" data-toggle="modal" data-target="#modal_for_confirmation">Clear Network Usage</button>
                        </small>
                    </h3>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div id="container" style="height: 500px;"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 col-12">
        <div class="dashboard_graph">
          <div class="row x_title">
            <div class="col-md-12">
              <h3>IP (Traffic Activity) </h3>
            </div>
          </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div id="container2" style="height: 500px;"></div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-sm-12 col-12 col-lg-6 col-xl-6">
        <div class="dashboard_graph">
            <div class="col-md-12 col-sm-12 col-xs-12 bg-white">
                <div class="x_title">
                    <h2>IP Address</h2>
                    <div class="clearfix"></div>
                </div>

                <div id="myDiv2" style="height: 500px;overflow: auto;" class="col-md-12 col-sm-12 col-xs-6"></div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_for_confirmation" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">Clear IP and Usage</h3>
            </div>
            <form method="POST" action="/ClearTraffic">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <p style="font-size: 16px;">Clear Data?</p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" id="btn_confirm">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(url('js/dashboard.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\eyenet\eyenet\resources\views/dashboard.blade.php ENDPATH**/ ?>