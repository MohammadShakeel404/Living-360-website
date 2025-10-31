$(document).ready(function() {

    // Chatbot toggle
    $('#chatbotToggle').click(function() {
        $('#chatbotWindow').slideToggle();
    });
    
    // Close chatbot
    $('.close-chatbot').click(function() {
        $('#chatbotWindow').slideUp();
    });
    
    // Send message
    $('#sendMessage').click(sendMessage);
    $('#chatbotInput').keypress(function(e) {
        if (e.which == 13) {
            sendMessage();
        }
    });
    
    function addMessage(message, sender) {
        var messageClass = sender === 'user' ? 'user-message' : 'bot-message';
        var messageHtml = '<div class="message ' + messageClass + '"><div class="message-content">' + message + '</div></div>';
        $('#chatbotMessages').append(messageHtml);
        $('#chatbotMessages').scrollTop($('#chatbotMessages')[0].scrollHeight);
    }

    function showTyping(show) {
        var id = '#typingIndicator';
        if (show) {
            if ($(id).length) return;
            var html = '<div class="message bot-message" id="typingIndicator"><div class="message-content">Typing<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></div></div>';
            $('#chatbotMessages').append(html);
            $('#chatbotMessages').scrollTop($('#chatbotMessages')[0].scrollHeight);
        } else {
            $(id).remove();
        }
    }

    function showOptions(options) {
        var optionsHtml = '<div class="message bot-message"><div class="message-content options-container">';
        for (var i = 0; i < options.length; i++) {
            optionsHtml += '<button class="option-btn" data-option="' + options[i].value + '">' + options[i].label + '</button>';
        }
        optionsHtml += '</div></div>';
        $('#chatbotMessages').append(optionsHtml);
        $('#chatbotMessages').scrollTop($('#chatbotMessages')[0].scrollHeight);
        $('.option-btn').off('click').on('click', function() {
            var option = $(this).data('option');
            $('#chatbotInput').val(option);
            sendMessage();
        });
    }

    function renderEnquiryForm() {
        var html = ''+
        '<div class="message bot-message"><div class="message-content">'+
            '<div class="chat-enquiry">'+
                '<div class="chat-enquiry-title"><strong>Quick Enquiry</strong></div>'+
                '<form class="chat-enquiry-form">'+
                    '<div class="row"><input type="text" name="name" placeholder="Your name" required></div>'+
                    '<div class="row"><input type="email" name="email" placeholder="Email address" required></div>'+
                    '<div class="row"><input type="tel" name="phone" placeholder="Phone (optional)"></div>'+
                    '<div class="row"><textarea name="message" rows="3" placeholder="Tell us briefly about your project"></textarea></div>'+
                    '<input type="hidden" name="project_type" value="">'+
                    '<input type="hidden" name="referral" value="chatbot">'+
                    '<input type="hidden" name="newsletter" value="0">'+
                    '<button type="submit" class="btn btn-primary">Submit Enquiry</button>'+
                '</form>'+
            '</div>'+
        '</div></div>';
        $('#chatbotMessages').append(html);
        $('#chatbotMessages').scrollTop($('#chatbotMessages')[0].scrollHeight);

        $('.chat-enquiry-form').off('submit').on('submit', function(e){
            e.preventDefault();
            var form = this;
            var btn = $(form).find('button[type="submit"]');
            var original = btn.html();
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Sending...');

            var fd = new FormData(form);
            fetch('api/enquiry.php', { method: 'POST', body: fd })
                .then(function(r){ return r.json(); })
                .then(function(data){
                    if (data && data.success) {
                        addMessage('Thank you! Your enquiry has been submitted. We\'ll contact you shortly.', 'bot');
                        // Offer to open full contact page
                        var link = '<div class="message bot-message"><div class="message-content"><a href="pages/contact.php?success=1" class="btn btn-primary" target="_self">Open Contact Page</a></div></div>';
                        $('#chatbotMessages').append(link);
                        $('#chatbotMessages').scrollTop($('#chatbotMessages')[0].scrollHeight);
                    } else {
                        addMessage((data && data.message) ? data.message : 'Unable to submit right now. Please try again.', 'bot');
                    }
                })
                .catch(function(){
                    addMessage('Network error while submitting. Please try again.', 'bot');
                })
                .finally(function(){
                    btn.prop('disabled', false).html(original);
                });
        });
    }
    
    function sendMessage() {
        var message = $('#chatbotInput').val().trim();
        if (!message) return;

        // Add user message to chat
        addMessage(message, 'user');
        // Clear input
        $('#chatbotInput').val('');

        // Show typing indicator
        showTyping(true);

        // Send to API
        $.ajax({
            url: 'api/chatbot.php',
            type: 'POST',
            data: { message: message },
            success: function(response) {
                showTyping(false);
                try {
                    if (typeof response === 'string') response = JSON.parse(response);
                } catch (e) {
                    response = { message: "Sorry, I couldn't process that. Please try again." };
                }

                var botText = (response && response.message) ? response.message : "I couldn't find an answer. Please try again.";
                addMessage(botText, 'bot');

                if (response && response.options && response.options.length > 0) {
                    showOptions(response.options);
                }

                if (response && response.suggest_enquiry) {
                    renderEnquiryForm();
                }
            },
            error: function() {
                showTyping(false);
                addMessage("Sorry, I'm having trouble responding right now. Please try again later.", 'bot');
            }
        });
    }
    
    // Welcome message
    setTimeout(function() {
        addMessage("Hello! I'm the Living 360 Assistant. How can I help you today? You can ask me about our services, request a budget estimate, or schedule a consultation.", 'bot');
        
        // Show initial options
        showOptions([
            { label: "Tell me about your services", value: "Tell me about your services" },
            { label: "I want a budget estimate", value: "I want a budget estimate" },
            { label: "Schedule a consultation", value: "Schedule a consultation" }
        ]);
    }, 500);
});