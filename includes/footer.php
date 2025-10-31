<footer class="main-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <div class="footer-logo">
                    <img src="assets/images/logo.png" alt=" Living 360 Interiors">
                    <h3 class="brand-name text-gradient" style="margin-top:10px;">Living 360</h3>
                </div>
                <p>Transforming spaces into beautiful, functional environments that reflect your unique style and personality.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.php?page=home">Home</a></li>
                    <li><a href="index.php?page=services">Services</a></li>
                    <li><a href="index.php?page=projects">Projects</a></li>
                    <li><a href="index.php?page=blogs">Blogs</a></li>
                    <li><a href="index.php?page=about">About Us</a></li>
                    <li><a href="index.php?page=contact">Contact</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Services</h3>
                <ul>
                    <?php
                    $services = getActiveServices();
                    foreach ($services as $service) {
                        echo '<li><a href="index.php?page=services#' . $service['id'] . '">' . $service['title'] . '</a></li>';
                    }
                    ?>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Contact Us</h3>
                <div class="contact-info">
                    <p><i class="fas fa-map-marker-alt"></i> 103/25, 2nd Cross, Puttenahalli Main Rd, J.P Nagar 7th Phase, Bengaluru - 560078</p>
                    <p><i class="fas fa-phone"></i> +91-98450-61004</p>
                    <p><i class="fas fa-envelope"></i> design@living360.in</p>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="copyright">
                <p>&copy; <?php echo date('Y'); ?> Living 360 Interiors. All Rights Reserved.</p>
            </div>
            <div class="footer-links">
                <a href="index.php?page=privacy-policy">Privacy Policy</a>
                <a href="index.php?page=terms-conditions">Terms & Conditions</a>
            </div>
        </div>
    </div>
</footer>