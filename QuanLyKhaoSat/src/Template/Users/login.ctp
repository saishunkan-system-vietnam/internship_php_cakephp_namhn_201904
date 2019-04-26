<?php echo $this->Html->css('login'); ?>
    <div class="container" style="margin-top: 100px;">
        <section id="content">
            <form action="" method="post">
                <h1>Login Form</h1>
                <div>
                    <input type="text" placeholder="Username" name="email"/>
                </div>
                <div>
                    <input type="password" placeholder="Password" name="password"/>
                </div>
                <div>
                    <input type="submit" value="Log in"/>
                    <a style="font-size: 16px;" href="<?= SITE_URL ?>Regists/regist">Register</a>
                </div>
            </form>
            <div class="button">
                <a href>Hoàng Ngọc Nam</a>
            </div>
        </section>
    </div>
<?php echo $this->Html->script('validate'); ?>