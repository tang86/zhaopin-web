<ul>
    <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li><a href="<?php echo e(url('/grade-detail/'.$report->member_id.'/'.$report->order_number)); ?>"><?php echo e($report->user_name); ?>-的报告</a>-<?php echo e($report->created_at > 0 ? date('Y-m-d H:i:s', $report->created_at) : ''); ?></li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>