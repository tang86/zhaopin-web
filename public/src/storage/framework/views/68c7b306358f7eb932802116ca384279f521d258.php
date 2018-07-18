<div class="form-group <?php echo !$errors->has($label) ?: 'has-error'; ?>">

    <label for="<?php echo e($id); ?>" class="col-sm-2 control-label"><?php echo e($label); ?></label>

    <div class="<?php echo e($viewClass['field']); ?>">

        <?php echo $__env->make('admin::form.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div id="<?php echo e($id); ?>" style="width: 100%; height: 100%;">
            <p><?php echo old($column, $value); ?></p>
        </div>

        <input type="hidden" name="<?php echo e($name); ?>" value="<?php echo e(old($column, $value)); ?>" />

    </div>
</div>