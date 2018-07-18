<div class="<?php echo e($viewClass['form-group']); ?> <?php echo !$errors->has($errorKey) ? '' : 'has-error'; ?>">

    <label for="<?php echo e($id); ?>" class="<?php echo e($viewClass['label']); ?> control-label"><?php echo e($label); ?></label>

    <div class="<?php echo e($viewClass['field']); ?>">

        <?php echo $__env->make('admin::form.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!$inline): ?><div class="radio"><?php endif; ?>
                <label <?php if($inline): ?>class="radio-inline"<?php endif; ?>>
                    <input type="radio" name="<?php echo e($name); ?>" value="<?php echo e($option); ?>" class="minimal <?php echo e($class); ?>" <?php echo e(($option == old($column, $value))?'checked':''); ?> />&nbsp;<?php echo e($label); ?>&nbsp;&nbsp;
                </label>
            <?php if(!$inline): ?></div><?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php echo $__env->make('admin::form.help-block', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </div>
</div>
