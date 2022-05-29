<div>
    <div class='grid grid-rows-1'>
        <span class='bg-gray-200 w-full py-3 px-3 mb-2 text-capitalize text-xl font-bold'>
            <?php echo e($receiver_name['name']); ?>

            <?php if($receiver_name['online'] == '1'): ?>

                <span class='text-sm'>online</span>
            <?php else: ?>

               <br> <span class='text-sm'> online <?php echo e($receiver_name['updated_at']->diffForHumans()); ?></span>
            <?php endif; ?>

        </span>
    </div>
    <input type='hidden' name='receiver_id' id='receiver_id' value='<?php echo e($receiver_id); ?>'>
<div style='overflow-y:scroll;max-height:300px'>
    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($item['s_id'] == auth()->user()->id): ?>
            <div class='grid grid-rows-1 px-2'>
                <div class="grid grid-cols-1 inline-block w-full flex" >

                    <div>
                        <img src="<?php echo e(asset('images/user.png')); ?>" alt="description of myimage" class='w-8 inline-block'>
                               <span class='bg-blue-300 font-bold pt-2 px-2 w-40 border rounded-xl'> <?php echo e($item['sent_message']); ?></span>
                    </div>
                    <span class='text-sm px-3 pb-2'><?php echo e($item['created_at']->diffForHumans()); ?></span>
                </div>
            </div>
        <?php else: ?>
                <div class='grid grid-rows-1 px-2 pb-2'>
                    <div class="grid grid-cols-1">
                        <div class='col-end-3'>
                            <img src="<?php echo e(asset('images/user.png')); ?>" alt="description of myimage" class='w-8 inline-block'>
                                <span class='bg-green-200 font-bold py-2 px-2 w-40 border rounded-xl col-end-3'><?php echo e($item['sent_message']); ?></span>
                        </div>
                        <span class='text-sm px-3 pb-2 col-end-3'><?php echo e($item['created_at']->diffForHumans()); ?></span>
                    </div>
                </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class='grid grid-rows-1 px-2'>
                <div class="grid grid-cols-1"  id='chat'>


                </div>
            </div>

</div>
    <div class='grid grid-rows-1'>
        <div class="grid grid-cols-2 gap-4">
           <div class='col-start-1 col-end-4'> <input type='text' class='w-full py-1 px-1 mt-2 border rounded-xl ' name='user_message' id='user_message'></div>
            <div class='col-end-7 col-span-3 '> <button  class='w-full py-1 px-2 mt-2 border rounded-xl bg-blue-400 font-bold text-white' onclick='sent()'>sent</button> </div>
        </div>
    </div>

</div>
<script>
    setInterval(function(){
  update_last_activity();
  fetch_user();
 }, 5000);

    function sent(){

        var user_message = $('#user_message').val();
        var receiver_id = $('#receiver_id').val();

        $.ajax({
                url: "<?php echo e(url('/message_sent')); ?>",
                type: "post",
                data: {
                         "_token": "<?php echo e(csrf_token()); ?>",
                        user_message:user_message,
                        receiver_id:receiver_id,

                    } ,
                success: function (data) {

                    $('#chat').append("<div><img src='./images/user.png' alt='description of myimage' class='w-8 inline-block'><span class='bg-blue-300 font-bold pt-2 px-2 w-40 border rounded-xl'>"+data['sent_message']+"</span></div>");
                    $('#user_message').val("");

                },
        });


    }
    </script>
<?php /**PATH D:\laravel learning\multi_login_hr\resources\views/chat/chat_window.blade.php ENDPATH**/ ?>