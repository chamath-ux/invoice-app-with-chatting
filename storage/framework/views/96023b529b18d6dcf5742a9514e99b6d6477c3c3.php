<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header font-bold text-lg" ><?php echo e(__('Be With Friends')); ?></div>

                <div class="card-body">
                    <div class='grid grid-rows-1'>
                        <div class='grid grid-cols-2 gap-4'>
                            <div class='w-100'>
                                <ul>
                                 <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <li class='bg-blue-500 py-1 px-2 border rounded-xl text-uppercase font-bold text-white w-40'   onclick='open_chat(<?php echo e($key); ?>)'>
                                        <input type='hidden' name='user_id_<?php echo e($key); ?>' id='user_id_<?php echo e($key); ?>' value='<?php echo e($user->id); ?>'>
                                        <?php echo e($user->name); ?>


                                        <?php if($user->online == '1'): ?>
                                            <img src="<?php echo e(asset('images/dot1.ico')); ?>" alt="description of myimage" class='text-green-500 px-5' style='display:inline-block'>
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('images/dot3.ico')); ?>" alt="description of myimage" class='text-green-500 px-5' style='display:inline-block'>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <div class='w-full' id='chat_window'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   function open_chat(key){

    var user_id = $('#user_id_'+key).val();


    $('#chat_window').html('');
    $.ajax({
                url: "<?php echo e(url('/chat_window')); ?>",
                type: "post",
                data: {
                         "_token": "<?php echo e(csrf_token()); ?>",
                        user_id:user_id
                    } ,
                success: function (html) {


                        $('#chat_window').html(html);

                        console.log(html);
                },
        });
   }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel learning\multi_login_hr\resources\views/chat/chat.blade.php ENDPATH**/ ?>