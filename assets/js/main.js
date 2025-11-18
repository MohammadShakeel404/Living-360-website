// Form validation function
window.validateForm = function(form) {
    let isValid = true;
    const requiredFields = form.querySelectorAll('[required]');
    
    // Reset previous errors
    requiredFields.forEach(field => {
        field.classList.remove('error');
    });
    
    // Check required fields
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('error');
            isValid = false;
        }
    });
    
    // Validate email format
    const emailField = form.querySelector('input[type="email"]');
    if (emailField && emailField.value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailField.value)) {
            emailField.classList.add('error');
            isValid = false;
        }
    }
    
    if (!isValid) {
        // Scroll to first error
        const firstError = form.querySelector('.error');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        return false;
    }
    
    // Show loading state
    const submitBtn = form.querySelector('button[type="submit"]');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
    }
    
    return true;
};

$(document).ready(function() {
    
    // Offer modal
    if ($('.offer-modal').length > 0) {
        setTimeout(function() {
            $('.offer-modal').fadeIn();
        }, 2000);
        
        $('.close-modal').click(function() {
            $('.offer-modal').fadeOut();
        });
        
        $(window).click(function(event) {
            if ($(event.target).hasClass('offer-modal')) {
                $('.offer-modal').fadeOut();
            }
        });
    }
    
    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 100
            }, 1000);
        }
    });
    
    // Form validation
    $('form').on('submit', function(e) {
        var requiredFields = $(this).find('[required]');
        var isValid = true;
        
        requiredFields.each(function() {
            if ($(this).val() === '') {
                $(this).addClass('error');
                isValid = false;
            } else {
                $(this).removeClass('error');
            }
        });
        
        if (!isValid) { e.preventDefault(); }
    });
    
    // Enquiry form submission handler
    window.submitEnquiryForm = function(form) {
        var formData = new FormData(form);
        // Force JSON mode server-side by removing redirect param if present
        formData.delete('redirect');
        var $submitBtn = $(form).find('button[type="submit"]');
        var originalBtnText = $submitBtn.html();
        var originalMinWidth = $submitBtn.css('min-width');
        // Prevent layout shift: lock min-width
        $submitBtn.css('min-width', $submitBtn.outerWidth() + 'px');
        $submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Submitting...');

        // Clear previous inline error
        $('#enquiryInlineError').remove();

        return fetch(form.action, { method: 'POST', body: formData })
        .then(resp => resp.text())
        .then(text => {
            var data = null; try { data = JSON.parse(text); } catch(e) {}
            if (!data || typeof data.success === 'undefined') {
                // Treat as success if server didn't return JSON but processing likely completed
                $('#successMessage').show();
                $('.contact-form-container').hide();
                return false;
            }
            if (data.success){
                $('#successMessage').show();
                $('.contact-form-container').hide();
            } else {
                var msg = data.message || 'Unable to submit your enquiry right now. Please try again.';
                var $err = $('<div id="enquiryInlineError" class="alert alert-error"></div>').text(msg);
                $(form).before($err);
                $('html, body').animate({ scrollTop: $err.offset().top - 80 }, 300);
            }
            return false;
        })
        .catch(err => {
            console.error('Enquiry submit error:', err);
            var $err = $('<div id="enquiryInlineError" class="alert alert-error"></div>').text('Network error. Please try again.');
            $(form).before($err);
            return false;
        })
        .finally(() => {
            $submitBtn.prop('disabled', false).html(originalBtnText).css('min-width', originalMinWidth || '');
        });
    };
    
    // Check for success parameter on page load
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('success') && urlParams.get('success') === '1') {
        // Show success message and hide the form/content area
        $('#successMessage').show();
        $('#formContent').hide();
        $('.enquiry-form').hide();
        // Scroll to success message
        $('html, body').animate({
            scrollTop: $('#successMessage').offset().top - 100
        }, 500);
    }
    
    // Remove error class on input
    $('input, textarea').on('input', function() {
        $(this).removeClass('error');
    });
    
    // Enquiry form steps
    if ($('.enquiry-form').length > 0) {
        // Define progress update function before first use
        function updateProgressBar(current, total) {
            var percent = (current / total) * 100;
            $('.progress-bar').css('width', percent + '%');
            $('.step-indicator').text('Step ' + current + ' of ' + total);
        }

        // Cache steps and manage by index so hidden inputs or other nodes don't break nth-child logic
        var $steps = $('.enquiry-form .form-step');
        var totalSteps = $steps.length;
        var currentStep = 1; // 1-based for display, index = currentStep - 1

        if (totalSteps === 0) {
            console.warn('No .form-step elements found inside .enquiry-form');
            return;
        }

        // Show first step reliably
        $steps.hide();
        $steps.eq(0).show();
        updateProgressBar(currentStep, totalSteps);
        $('.prev-step').hide();
        $('.submit-form').hide();
        
        // Next step button
        $('.next-step').click(function() {
            var currentStepElement = $steps.eq(currentStep - 1);
            var requiredFields = currentStepElement.find('[required]');
            var isValid = true;
            
            requiredFields.each(function() {
                if ($(this).val() === '') {
                    $(this).addClass('error');
                    isValid = false;
                } else {
                    $(this).removeClass('error');
                }
            });
            
            if (isValid) {
                currentStepElement.hide();
                currentStep++;
                $steps.eq(currentStep - 1).show();
                
                // Update progress bar
                updateProgressBar(currentStep, totalSteps);
                
                // Show/hide buttons based on step
                if (currentStep === totalSteps) {
                    $('.next-step').hide();
                    $('.submit-form').show();
                } else {
                    $('.prev-step').show();
                }
            }
        });
        
        // Previous step button
        $('.prev-step').click(function() {
            $steps.eq(currentStep - 1).hide();
            currentStep--;
            $steps.eq(currentStep - 1).show();
            
            // Update progress bar
            updateProgressBar(currentStep, totalSteps);
            
            // Show/hide buttons based on step
            if (currentStep === 1) {
                $('.prev-step').hide();
            }
            
            $('.next-step').show();
            $('.submit-form').hide();
        });
        
        // updateProgressBar already defined above
    }
    
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // Initialize popovers
    $('[data-toggle="popover"]').popover();
    
    // Add animation to elements when they come into view
    $(window).scroll(function() {
        $('.animate-on-scroll').each(function() {
            var elementPos = $(this).offset().top;
            var topOfWindow = $(window).scrollTop();
            
            if (elementPos < topOfWindow + $(window).height() - 100) {
                $(this).addClass('animated');
            }
        });
    });
    
    // Trigger scroll event on page load
    $(window).trigger('scroll');
});