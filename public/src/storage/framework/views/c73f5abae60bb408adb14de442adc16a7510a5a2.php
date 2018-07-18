<h2>兴趣得分</h2>
<table>
    <tr>
        <th>名称</th>
        <th>分数</th>
        <th>排名</th>
        <th>权重</th>
    </tr>
    <?php $__currentLoopData = $interest_grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($grade['name']); ?></td>
        <td><?php echo e($grade['grade']); ?></td>
        <td><?php echo e($grade['rank']); ?></td>
        <td><?php echo e($grade['weight']); ?></td>

    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>

<h2>才干（能力）得分</h2>
<table>
    <tr>
        <th>名称</th>
        <th>分数</th>
        <th>排名</th>
        <th>权重</th>
        <th>对应相应风格加权重</th>
    </tr>
    <?php $__currentLoopData = $ability_grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($grade['name']); ?></td>
            <td><?php echo e($grade['grade']); ?></td>
            <td><?php echo e($grade['rank']); ?></td>
            <td><?php echo e($grade['weight']); ?></td>
            <td><?php echo e($grade['personality_type_weight']); ?></td>

        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>

<h2>风格得分</h2>
<table>
    <tr>
        <th>名称</th>
        <th>分数</th>
        <th>排名</th>
        <th>权重</th>
    </tr>
    <?php $__currentLoopData = $personality_grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($grade['name']); ?></td>
            <td><?php echo e($grade['grade']); ?></td>
            <td><?php echo e($grade['rank']); ?></td>
            <td><?php echo e($grade['weight']); ?></td>

        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>

<h2>素质模型得分</h2>
<table>
    <tr>
        <th>名称</th>
        <th>分数</th>
        <th>排名</th>
        <th>权重</th>
    </tr>
    <?php $__currentLoopData = $quality_grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($grade['name']); ?></td>
            <td><?php echo e($grade['grade']); ?></td>
            <td><?php echo e($grade['rank']); ?></td>
            <td><?php echo e($grade['weight']); ?></td>

        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
<h2>专业得分</h2>
<table>
    <tr>
        <th>名称</th>
        <th>分数</th>
        <th>排名</th>
        <th>权重</th>
    </tr>
    <?php $__currentLoopData = $major_grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($grade['name']); ?></td>
            <td><?php echo e($grade['grade']); ?></td>
            <td><?php echo e($grade['rank']); ?></td>
            <td><?php echo e($grade['weight']); ?></td>

        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>D