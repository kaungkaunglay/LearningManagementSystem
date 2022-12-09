<?php require_once "../GETPageName.php"; ?>
<?php
$get_name = GETPageName::GETPageName();
?>
<div class="fxt-heading-content">
    <div class="fxt-inner-wrap fxt-transformX-R-50 fxt-transition-delay-3">
<!--        <div class="fxt-transformX-R-50 fxt-transition-delay-10">-->
<!--            <a href="index.php" class="fxt-logo"><img src="img/logo-33.png" alt="Logo"></a>-->
<!--        </div>-->
        <div class="fxt-transformX-R-50 fxt-transition-delay-10">
            <div class="fxt-middle-content">
                <div class="fxt-sub-title">Welcome to</div>
                <h1 class="fxt-main-title"><?php echo Details::getTitle(); ?></h1>
                <p class="fxt-description"><?php echo "Made with love from ".Details::getSchool()." Student -".Details::getAuthorName(); ?></p>
            </div>
        </div>
        <?php
        if($get_name == "index"){
        ?>
        <div class="fxt-transformX-R-50 fxt-transition-delay-10">
            <div class="fxt-switcher-description">Don't have an account?<a href="register.php" class="fxt-switcher-text">Register</a></div>
        </div>
        <?php } ?>
        <?php
        if($get_name == "register"){
        ?>
        <div class="fxt-transformX-R-50 fxt-transition-delay-10">
            <div class="fxt-switcher-description">Already have an account?<a href="index.php" class="fxt-switcher-text">Login</a></div>
        </div>
        <?php } ?>
    </div>
</div>