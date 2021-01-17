<?php $__env->startSection('content'); ?>

<br>
  <h4>Reporting</h4>
<br>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <form action="<?php echo e(route('report')); ?>" method="post">
              <?php echo csrf_field(); ?>
              <div class="form-group col-12 col-sm-12 col-md-3 col-lg-3">
                <select class="form-control" name="InputReportType" id="InputReportType">
                  <option value selected disabled>Report Type</option>
                  <option value="1">Bandwidth Used</option>
                  <option value="2">Network Traffic</option>
                </select>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-3 col-lg-3">
                <input id="InputSDate" name="InputSDate" class="date-picker form-control" placeholder="Start Date" type="text" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
              </div>
              <div class="form-group col-12 col-sm-12 col-md-3 col-lg-3">
                <input id="InputEDate" name="InputEDate" class="date-picker form-control" placeholder="End Date" type="text" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
              </div>
              <div class="co-12 col-sm-12 col-md-3 col-lg-3">
                <button class="btn btn-primary" type="submit" id="BtnGenerateReport" name="BtnGenerateReport">Generate</button>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/eyenet/resources/views/report.blade.php ENDPATH**/ ?>