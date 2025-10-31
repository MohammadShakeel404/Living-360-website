<div class="page-header">
    <div class="container">
        <h1 class="text-gradient">Our Services</h1>
        <p>We offer comprehensive interior design services tailored to your unique needs and preferences.</p>
    </div>
</div>

<div class="section services-section">
    <div class="container">
        <div class="section-title">
            <h2 class="text-gradient">Our Services</h2>
            <p>Discover what we can do for you.</p>
        </div>

        <div class="services-grid">
            <?php
            $services = getActiveServices();
            // Default feature bullets per service title (fallback)
            $defaultFeatures = [
                'residential design' => [
                    'Custom furniture design', 'Space planning', 'Color consultation', 'Lighting design'
                ],
                'commercial design' => [
                    'Office layout', 'Brand integration', 'Ergonomic design', 'Sustainable solutions'
                ],
                'renovation' => [
                    'Structural changes', 'Modern updates', 'Historic preservation', 'Budget management'
                ],
                'consultation' => [
                    'Design consultation', 'Material selection', 'Budget planning', 'Project management'
                ]
            ];

            foreach ($services as $service) {
                $title = trim($service['title']);
                $key = strtolower($title);
                $excerpt = strip_tags($service['description']);
                $excerpt = strlen($excerpt) > 160 ? substr($excerpt, 0, 160) . '...' : $excerpt;
                $features = $defaultFeatures[$key] ?? ['Bespoke solutions', 'Quality materials', 'Expert guidance', 'On-time delivery'];
                echo '<div class="service-card animate-on-scroll no-image">
                        <div class="service-icon">
                            <span class="icon-badge round"><i class="' . $service['icon'] . '"></i></span>
                        </div>
                        <h3>' . htmlspecialchars($title) . '</h3>
                        <p>' . htmlspecialchars($excerpt) . '</p>
                        <ul class="service-features">';
                foreach ($features as $feat) {
                    echo '<li><i class="fas fa-check-circle"></i><span>' . htmlspecialchars($feat) . '</span></li>';
                }
                echo '  </ul>
                    </div>';
            }
            ?>
        </div>

        <div class="text-center" style="margin-top:24px;">
            <a href="index.php?page=contact" class="btn btn-primary">Inquire About Services</a>
        </div>
    </div>
</div>

<div class="section process-section">
    <div class="container">
        <div class="section-title">
            <h2 class="text-gradient">Our Design Process</h2>
            <p>We follow a systematic approach to deliver exceptional results, from the first conversation to the final reveal.</p>
        </div>

        <div class="why-grid">
            <div class="why-item">
                <span class="icon-badge round"><i class="fas fa-comments"></i></span>
                <div>
                    <h4>Consultation</h4>
                    <p>We understand your goals, preferences, and budget to set the foundation for success.</p>
                </div>
            </div>
            <div class="why-item">
                <span class="icon-badge round"><i class="fas fa-lightbulb"></i></span>
                <div>
                    <h4>Concept Development</h4>
                    <p>We craft a design direction that reflects your style and functional needs.</p>
                </div>
            </div>
            <div class="why-item">
                <span class="icon-badge round"><i class="fas fa-ruler-combined"></i></span>
                <div>
                    <h4>Design Planning</h4>
                    <p>Detailed layouts, materials, and color palettes are prepared for alignment.</p>
                </div>
            </div>
            <div class="why-item">
                <span class="icon-badge round"><i class="fas fa-hammer"></i></span>
                <div>
                    <h4>Implementation</h4>
                    <p>Skilled craftsmen and project oversight bring the design to life.</p>
                </div>
            </div>
            <div class="why-item">
                <span class="icon-badge round"><i class="fas fa-check-circle"></i></span>
                <div>
                    <h4>Quality Assurance</h4>
                    <p>Rigorous checks ensure workmanship and finish are up to our standards.</p>
                </div>
            </div>
            <div class="why-item">
                <span class="icon-badge round"><i class="fas fa-door-open"></i></span>
                <div>
                    <h4>Final Reveal</h4>
                    <p>We unveil your transformed space and finalize any last details.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="text-gradient">Ready to Start Your Project?</h2>
            <p>Contact us today to schedule a consultation and take the first step toward your dream space.</p>
            <a href="index.php?page=contact" class="btn btn-primary">Get in Touch</a>
        </div>
    </div>
</div>