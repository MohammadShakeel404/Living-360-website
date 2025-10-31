<?php
session_start();
require_once 'includes/database.php';
require_once 'includes/functions.php';

 $page = isset($_GET['page']) ? $_GET['page'] : 'home';
 $validPages = ['home', 'services', 'about', 'contact', 'privacy-policy', 'blogs', 'projects', 'terms-conditions'];

if (!in_array($page, $validPages)) {
    $page = 'home';
}

// Get offer status
 $offerStatus = getSetting('offer_status');
 $offer = $offerStatus == '1' ? getActiveOffer() : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo getSetting('site_description'); ?>">
    <title><?php echo ucfirst($page) . ' - ' . getSetting('site_title'); ?></title>
    
    <!-- Preconnect for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Afacad:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="main-container">
        <?php include 'includes/sidebar.php'; ?>
        
        <div class="content-area">
            <?php include 'pages/' . $page . '.php'; ?>
        </div>
    </div>

    <?php include 'includes/bottom-nav.php'; ?>

    <?php include 'includes/footer.php'; ?>

    <!-- Offer Modal -->
    <?php if ($offer): ?>
    <div class="modal offer-modal" id="offerModal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div class="offer-container">
                <div class="offer-image">
                    <img src="assets/images/uploads/<?php echo $offer['image']; ?>" alt="<?php echo $offer['title']; ?>">
                </div>
                <div class="offer-details">
                    <h2><?php echo $offer['title']; ?></h2>
                    <p><?php echo $offer['description']; ?></p>
                    <a href="<?php echo $offer['cta_link']; ?>" class="btn btn-primary"><?php echo $offer['cta_text']; ?></a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Chatbot -->
    <div class="chatbot-container">
        <div class="chatbot-toggle" id="chatbotToggle">
            <i class="fas fa-comments"></i>
        </div>
        <div class="chatbot-window" id="chatbotWindow">
            <div class="chatbot-header">
                <h3>Living 360 Assistant</h3>
                <span class="close-chatbot">&times;</span>
            </div>
            <div class="chatbot-messages" id="chatbotMessages">
                <div class="message bot-message">
                    <p>Hello! I'm the Living 360 Assistant. How can I help you today?</p>
                </div>
            </div>
            <div class="chatbot-input">
                <input type="text" id="chatbotInput" placeholder="Type your message...">
                <button id="sendMessage"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
    
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/chatbot.js"></script>
</body>
</html>