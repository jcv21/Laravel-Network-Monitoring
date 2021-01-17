<div class="top_nav">
    <div class="nav_menu">
        <nav>
            

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <?php echo e(ucfirst(Auth()->user()->name)); ?>

                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        
                        <li>
                            <a href="<?php echo e(route('logout')); ?>"" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                            <form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div><?php /**PATH C:\xampp\htdocs\eyenet\eyenet\resources\views/layout/topbar.blade.php ENDPATH**/ ?>