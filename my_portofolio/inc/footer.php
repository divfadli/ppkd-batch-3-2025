<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p>&copy; <?= date("Y") . " " . $rowAbout['name_user']; ?>. All rights reserved.</p>
                <div class="footer-social">
                    <a href="<?= $rowSetting['linkedin'] ?>" class="social-link-footer"><i class="fab fa-linkedin"></i></a>
                    <a href="<?= $rowSetting['github'] ?>" class="social-link-footer"><i class="fab fa-github"></i></a>
                    <a href="<?= $rowSetting['twitter'] ?>" class="social-link-footer"><i class="fab fa-twitter"></i></a>
                    <a href="<?= $rowSetting['instagram'] ?>" class="social-link-footer"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
