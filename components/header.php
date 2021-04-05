<header>
    <div class="container-header">
        <div class="title">
            <h2><a href="index.php">Diễn đàn</a></h2>
        </div>
        <?php if(!isset($_SESSION['user'])):?>
            <div class="user">
                <div class="user-login">
                    <h2><a href="/login.php">Login</a></h2>
                </div>
                <div class="user-register">
                    <h2><a href="register.php">Register</a></h2>
                </div>
            </div>
        <?php else:?>
            <div class="user">
                <a class="button post-button" href="post.php">Đăng bài</a>
                <a class="button post-button" href="infor.php">Xem thông tin cá nhân</a>
                <div class="user-login">
                    <h2><?php echo $_SESSION['user']['fullname']?> | <a href="logout.php">Đăng xuất</a> </h2>
                </div>
            </div>
        <?php endif;?>
    </div>
</header>
