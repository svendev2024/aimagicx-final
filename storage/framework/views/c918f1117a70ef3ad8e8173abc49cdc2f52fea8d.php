

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <div class="section-title">
                    <!-- SECTION TITLE -->
                    <div class="text-center mb-9 mt-9 pt-5" id="contact-row">

                        <div class="title">
                            <h6><span><?php echo e(__('Privacy Policy')); ?></span></h6>
                        </div>

                    </div> <!-- END SECTION TITLE -->
                </div>
            </div>
        </div>
    </div>

    <section id="about-wrapper">

        <div class="container">
            <div class="row justify-content-center background-white">
                <div class="col-md-10 col-sm-12 policy">                
                    <div class="card-body pt-9 pb-9"> 

                        <div class="mb-7">
                            <?php echo $pages['privacy']; ?>

                        </div>
    
                        <div class="form-group mt-6 text-center">                        
                            <a href="<?php echo e(route('register')); ?>" class="btn btn-primary mr-2"><?php echo e(__('I Agree, Let\'s Sign Up')); ?></a> 
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary mr-2"><?php echo e(__('I Agree, Let\'s Login')); ?></a>                               
                        </div>
                    
                    </div>       
                </div>
            </div>
        </div>
    </section>
    <?php $__env->startSection('js'); ?>
        <script src="<?php echo e(URL::asset('js/minimize.js')); ?>"></script>
    <?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/privacy-policy.blade.php ENDPATH**/ ?>