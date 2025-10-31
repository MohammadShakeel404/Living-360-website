<header class="main-header">
    <div class="container">
        <div class="logo">
            <a href="index.php">
                <img src="assets/images/logo.png" alt=" Living 360 Interiors">
            </a>
        </div>

        <?php 
            // Fetch contact settings with sensible fallbacks
            $phone = function_exists('getSetting') ? (getSetting('contact_phone') ?: '+91-98450-61004') : '+91-98450-61004';
            $email = function_exists('getSetting') ? (getSetting('contact_email') ?: 'design@living360.in') : 'design@living360.in';
            $telHref = 'tel:' . preg_replace('/[^0-9+]/', '', $phone);
            $mailHref = 'mailto:' . $email;
        ?>

        <div class="header-actions">
            <!-- Desktop/Laptop: show text with icons -->
            <a href="<?php echo $telHref; ?>" class="action-item desktop" aria-label="Call us">
                <i class="fas fa-phone"></i>
                <span><?php echo htmlspecialchars($phone); ?></span>
            </a>
            <a href="<?php echo $mailHref; ?>" class="action-item desktop" aria-label="Email us">
                <i class="fas fa-envelope"></i>
                <span><?php echo htmlspecialchars($email); ?></span>
            </a>
            <a href="index.php?page=contact" class="btn btn-primary desktop" aria-label="Send enquiry">Get Quote</a>

            <!-- Mobile: show only icons -->
            <a href="<?php echo $telHref; ?>" class="action-icon mobile" aria-label="Call">
                <i class="fas fa-phone"></i>
            </a>
            <a href="index.php?page=contact" class="action-icon mobile" aria-label="Enquiry">
                <i class="fas fa-comment-dots"></i>
            </a>
            <a href="<?php echo $mailHref; ?>" class="action-icon mobile" aria-label="Email">
                <i class="fas fa-envelope"></i>
            </a>
        </div>
    </div>
</header>