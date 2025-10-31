<div class="hero-section">
    <div class="container">
        <div class="hero-content centered">
            <span class="hero-badge">Professional Interior Design</span>
            <h1>Transform Your Space with<br> Living 360 Interiors</h1>
            <p>We create beautiful, functional spaces that inspire and delight. From residential homes to commercial spaces, we bring your vision to life.</p>
            <div class="hero-buttons">
                <a href="index.php?page=contact" class="btn btn-primary">Get Free Consultation</a>
                <a href="index.php?page=projects" class="btn btn-outline">View Our Projects</a>
            </div>
        </div>
    </div>
    
</div>

<div class="section about-section">
    <div class="container">
        <div class="about-content">
            <div class="about-text">
                <p>At Living 360 Interiors, we believe that your space should be a reflection of who you are. With over a decade of experience in the industry, our team of talented designers is dedicated to creating spaces that are not only beautiful but also functional and tailored to your lifestyle.</p>
                <p>We take a holistic approach to interior design, considering every aspect of your space from the layout and lighting to the furniture and accessories. Our goal is to create a harmonious environment that enhances your quality of life and brings you joy every day.</p>
                <a href="index.php?page=about" class="btn btn-primary">Learn More About Us</a>
            </div>
            <div class="about-image">
                <img src="assets/images/about-image.jpg" alt="About Living 360">
            </div>
        </div>
    </div>
</div>

<div class="section services-section">
    <div class="container">
        <div class="section-title">
            <h2 class="text-gradient">Our Services</h2>
            <p>We offer comprehensive interior design services tailored to your unique needs and preferences.</p>
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
            <a href="index.php?page=services" class="btn btn-primary">View All Services</a>
        </div>
    </div>
</div>

<div class="section values-section">
    <div class="container">
        <div class="section-title">
            <h2 class="text-gradient">Our Values</h2>
            <p>The principles that guide our work and define our commitment to excellence.</p>
        </div>
        <div class="values-grid">
            <div class="value-card animate-on-scroll">
                <div class="value-icon"><span class="icon-badge round"><i class="fas fa-heart"></i></span></div>
                <h3>Client-Centered Approach</h3>
                <p>We put clients at the heart of everything we do, letting their vision guide the design.</p>
            </div>
            <div class="value-card animate-on-scroll">
                <div class="value-icon"><span class="icon-badge round"><i class="fas fa-award"></i></span></div>
                <h3>Excellence in Craftsmanship</h3>
                <p>We maintain high standards of quality and attention to detail in every aspect.</p>
            </div>
            <div class="value-card animate-on-scroll">
                <div class="value-icon"><span class="icon-badge round"><i class="fas fa-lightbulb"></i></span></div>
                <h3>Innovation & Creativity</h3>
                <p>We explore new ideas, materials, and technologies for cutting-edge solutions.</p>
            </div>
            <div class="value-card animate-on-scroll">
                <div class="value-icon"><span class="icon-badge round"><i class="fas fa-seedling"></i></span></div>
                <h3>Sustainable Design</h3>
                <p>We prioritize eco‑friendly practices and materials for beautiful, responsible spaces.</p>
            </div>
        </div>
    </div>
</div>

<div class="section why-section">
    <div class="container">
        <div class="section-title">
            <h2 class="text-gradient">Why Choose Living 360?</h2>
            <p>We combine creativity, expertise, and a client‑centered approach to deliver exceptional design solutions.</p>
        </div>
        <div class="why-grid">
            <div class="why-item">
                <span class="icon-badge round"><i class="fas fa-medal"></i></span>
                <div>
                    <h4>Award‑Winning Design</h4>
                    <p>Recognized with multiple industry awards and publications.</p>
                </div>
            </div>
            <div class="why-item">
                <span class="icon-badge round"><i class="fas fa-layer-group"></i></span>
                <div>
                    <h4>Comprehensive Services</h4>
                    <p>End‑to‑end design solutions tailored to your needs.</p>
                </div>
            </div>
            <div class="why-item">
                <span class="icon-badge round"><i class="fas fa-users"></i></span>
                <div>
                    <h4>Experienced Team</h4>
                    <p>Decades of combined experience in residential and commercial design.</p>
                </div>
            </div>
            <div class="why-item">
                <span class="icon-badge round"><i class="fas fa-leaf"></i></span>
                <div>
                    <h4>Sustainable Practices</h4>
                    <p>Eco‑friendly materials and sustainable methods in all projects.</p>
                </div>
            </div>
            <div class="why-item">
                <span class="icon-badge round"><i class="fas fa-star"></i></span>
                <div>
                    <h4>Client Satisfaction</h4>
                    <p>We maintain a high satisfaction rate through our commitment to excellence.</p>
                </div>
            </div>
            <div class="why-item">
                <span class="icon-badge round"><i class="fas fa-heart"></i></span>
                <div>
                    <h4>Personalized Approach</h4>
                    <p>Every project is unique—we tailor our services to your requirements.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section projects-section">
    <div class="container">
        <div class="section-title">
            <h2 class="text-gradient">Recent Projects</h2>
            <p>Take a look at some of our recent interior design projects.</p>
        </div>
        
        <div class="projects-grid">
            <?php
            $projects = getActiveProjects(6);
            foreach ($projects as $project) {
                $images = json_decode($project['images'], true);
                $mainImage = isset($images[0]) ? $images[0] : 'default-project.jpg';
                
                echo '
                <div class="project-card animate-on-scroll">
                    <div class="project-image">
                        <img src="assets/images/uploads/' . $mainImage . '" alt="' . $project['title'] . '">
                        <div class="project-overlay">
                            <a href="index.php?page=projects#' . $project['id'] . '" class="btn btn-secondary">View Details</a>
                        </div>
                    </div>
                    <div class="project-info">
                        <h3>' . $project['title'] . '</h3>
                        <p><i class="fas fa-map-marker-alt"></i> ' . $project['location'] . '</p>
                    </div>
                </div>
                ';
            }
            ?>
        </div>
        
        <div class="text-center">
            <a href="index.php?page=projects" class="btn btn-primary">View All Projects</a>
        </div>
    </div>
</div>

<div class="section cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="text-gradient">Ready to Transform Your Space?</h2>
            <p>Get in touch with us today to schedule a consultation and bring your vision to life.</p>
            <a href="index.php?page=contact" class="btn btn-primary">Contact Us Now</a>
        </div>
    </div>
</div>

<div class="section blogs-section">
    <div class="container">
        <div class="section-title">
            <h2 class="text-gradient">Latest from Our Blog</h2>
            <p>Stay up to date with the latest trends and tips in interior design.</p>
        </div>
        
        <div class="blogs-grid">
            <?php
            $blogs = getActiveBlogs(3);
            foreach ($blogs as $blog) {
                echo '
                <div class="blog-card animate-on-scroll">
                    <div class="blog-image">
                        <img src="assets/images/uploads/' . $blog['featured_image'] . '" alt="' . $blog['title'] . '">
                    </div>
                    <div class="blog-content">
                        <h3>' . $blog['title'] . '</h3>
                        <p>' . $blog['excerpt'] . '</p>
                        <a href="index.php?page=blogs&slug=' . $blog['slug'] . '" class="btn btn-outline">Read More</a>
                    </div>
                </div>
                ';
            }
            ?>
        </div>
        
        <div class="text-center">
            <a href="index.php?page=blogs" class="btn btn-primary">View All Blogs</a>
        </div>
    </div>
</div>