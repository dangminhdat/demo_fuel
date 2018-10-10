<div class="col-xs-6 col-sm-offset-3" style="float: none">
    <?php echo \Fuel\Core\Form::open(array('method' => 'post', 'class' => 'form-horizontal', 'onsubmit' => 'return false;')); ?>
    <h1>Signup</h1>
    <div class="form-group">
        <?php echo \Fuel\Core\Form::label('Username', '', array('class' => 'control-label col-xs-2')); ?>
        <div class="col-xs-10">
            <?php echo \Fuel\Core\Form::input('username', $data['username'], array('class' => 'form-control', 'id' => 'username')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo \Fuel\Core\Form::label('Email', '', array('class' => 'control-label col-xs-2')); ?>
        <div class="col-xs-10">
            <?php echo \Fuel\Core\Form::input('email', $data['email'], array('class' => 'form-control', 'id' => 'email')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo \Fuel\Core\Form::label('Password', '', array('class' => 'control-label col-xs-2')); ?>
        <div class="col-xs-10">
            <?php echo \Fuel\Core\Form::input('password', $data['password'], array('type' => 'password', 'class' => 'form-control', 'id' => 'password')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo \Fuel\Core\Form::label('Fullname', '', array('class' => 'control-label col-xs-2')); ?>
        <div class="col-xs-10">
            <?php echo \Fuel\Core\Form::input('fullname', $data['fullname'], array('type' => 'text', 'class' => 'form-control', 'id' => 'fullname')); ?>
        </div>
    </div>
    <div class="form-group text-center">
        <?php echo \Fuel\Core\Form::button('Register', 'Register', array('class' => 'btn btn-primary', 'id' => 'btnSignup')); ?>
    </div>
    <?php echo \Fuel\Core\Form::close(); ?>
</div>