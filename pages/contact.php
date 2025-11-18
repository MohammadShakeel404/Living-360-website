<?php
// Simple flags to control UI based on query params
$showSuccess = isset($_GET['success']) && $_GET['success'] == '1';
$error = isset($_GET['error']) ? 'An error occurred while submitting your enquiry. Please try again.' : null;
?>

<div class="page-header">
    <div class="container">
        <h1 class="text-gradient">Contact Us</h1>
        <p>We'd love to hear from you. Get in touch with us today.</p>
    </div>
</div>

<div class="section contact-info-section">
    <div class="container">
        <div class="contact-info-grid">
            <div class="contact-info-card animate-on-scroll">
                <div class="contact-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3>Visit Us</h3>
                <p>103/25, 2nd Cross, Puttenahalli Main Rd,<br>J.P Nagar 7th Phase, Bengaluru - 560078</p>
            </div>
            
            <div class="contact-info-card animate-on-scroll">
                <div class="contact-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <h3>Call Us</h3>
                <p>+91-98450-61004<br>+91-80950-50360</p>
            </div>
            
            <div class="contact-info-card animate-on-scroll">
                <div class="contact-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3>Email Us</h3>
                <p>design@living360.in</p>
            </div>
        </div>
    </div>
</div>

<div class="section contact-form-section">
    <div class="container">
        <!-- Success Message (shown when ?success=1 is in URL) -->
        <div id="successMessage" class="success-message" style="display: <?php echo $showSuccess ? 'block' : 'none'; ?>; margin-bottom: 16px;">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2>Thank You!</h2>
            <p>Your enquiry has been submitted successfully.</p>
            <p class="small">We'll get back to you as soon as possible. A confirmation email has been sent to your inbox.</p>
            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <a href="/pages/contact.php" class="btn btn-primary">Submit Another Enquiry</a>
                <button type="button" id="submitAnotherInline" class="btn btn-outline">Submit Another Without Reload</button>
            </div>
        </div>

        <div class="contact-form-container">
            
            
            <div class="contact-form-text" id="formContent">
                <h2 class="text-gradient">Get in Touch</h2>
                <p>Ready to start your project? Fill out the form below and we'll get back to you as soon as possible.</p>
                
                <div class="contact-form-steps">
                    <div class="progress-container">
                        <div class="progress-bar" style="width: 25%;"></div>
                    </div>
                    <div class="step-indicator">Step 1 of 4</div>
                </div>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <form class="enquiry-form" id="enquiryForm" method="post" action="/api/enquiry.php" onsubmit="return contactSubmit(this);">
                <input type="hidden" name="redirect" value="1">
                
                <!-- Step 2: Project Details -->
                <div class="form-step">
                    <h3>Project Details</h3>
                    <div class="form-group">
                        <label>Project Type *</label>
                        <div class="radio-group">
                            <label class="radio-option">
                                <input type="radio" name="project_type" value="residential" required>
                                <span>Residential</span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="project_type" value="commercial" required>
                                <span>Commercial</span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="project_type" value="hospitality" required>
                                <span>Hospitality</span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="project_type" value="other" required>
                                <span>Other</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="space_size">Space Size (sq ft)</label>
                        <select id="space_size" name="space_size">
                            <option value="">Select size</option>
                            <option value="less-1000">Less than 1,000 sq ft</option>
                            <option value="1000-2000">1,000 - 2,000 sq ft</option>
                            <option value="2000-3000">2,000 - 3,000 sq ft</option>
                            <option value="3000-5000">3,000 - 5,000 sq ft</option>
                            <option value="more-5000">More than 5,000 sq ft</option>
                        </select>
                    </div>
                    
                    <div class="form-buttons">
                        <button type="button" class="btn btn-primary next-step">Next</button>
                    </div>
                </div>
                
                <!-- Step 3: Budget & Timeline -->
                <div class="form-step">
                    <h3>Budget & Timeline</h3>
                    <div class="form-group">
                        <label>Budget Range *</label>
                        <div class="radio-group">
                            <label class="radio-option">
                                <input type="radio" name="budget" value="under-1L" required>
                                <span>Under ₹1,00,000</span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="budget" value="1L-2.5L" required>
                                <span>₹10,000 - ₹2,50,000</span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="budget" value="2.5L-5L" required>
                                <span>₹2,50,000 - ₹5,00,000</span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="budget" value="5L-10L" required>
                                <span>₹5,00,000 - ₹10,00,000</span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="budget" value="over-10L" required>
                                <span>Over ₹10,00,000</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Timeline *</label>
                        <div class="radio-group">
                            <label class="radio-option">
                                <input type="radio" name="timeline" value="asap" required>
                                <span>ASAP</span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="timeline" value="1-3-months" required>
                                <span>1-3 months</span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="timeline" value="3-6-months" required>
                                <span>3-6 months</span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="timeline" value="6-12-months" required>
                                <span>6-12 months</span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="timeline" value="flexible" required>
                                <span>Flexible</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-buttons">
                        <button type="button" class="btn btn-outline prev-step">Previous</button>
                        <button type="button" class="btn btn-primary next-step">Next</button>
                    </div>
                </div>
                
                <!-- Step 4: Additional Information -->
                <div class="form-step">
                    <h3>Additional Information</h3>
                    <div class="form-group">
                        <label for="message">Tell us more about your project</label>
                        <textarea id="message" name="message" rows="5"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>How did you hear about us?</label>
                        <select id="referral" name="referral">
                            <option value="">Select an option</option>
                            <option value="google">Google Search</option>
                            <option value="social-media">Social Media</option>
                            <option value="referral">Referral from a friend</option>
                            <option value="advertisement">Advertisement</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="checkbox-option">
                            <input type="checkbox" name="newsletter" value="1">
                            <span>I would like to receive newsletters and updates from Living 360 Interiors</span>
                        </label>
                    </div>
                    
                    <div class="form-buttons">
                        <button type="button" class="btn btn-outline prev-step">Previous</button>
                        <button type="button" class="btn btn-primary next-step">Next</button>
                    </div>
                </div>
                
                <!-- Step 1: Basic Information -->
                <div class="form-step">
                    <h3>Basic Information</h3>
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                    
                    <div class="form-buttons">
                        <button type="button" class="btn btn-outline prev-step">Previous</button>
                        <button type="submit" class="btn btn-primary submit-form" style="display: none;">Submit Enquiry</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="section map-section">
    <div class="container">
        <h2 class="text-gradient">Find Us</h2>
        <div class="map-container">
            
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3889.1614871799584!2d77.57970307358768!3d12.89733561650514!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae152ccaab89a7%3A0x812cad341d68deec!2sLiving%20360%20Interiors!5e0!3m2!1sen!2sin!4v1759567218385!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            
        </div>
    </div>
</div>