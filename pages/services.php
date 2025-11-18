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

        <div class="projects-grid">
            <?php
            $services = getActiveServices();
            foreach ($services as $service) {
                $title = trim($service['title']);
                $excerpt = strip_tags($service['description']);
                $excerpt = strlen($excerpt) > 160 ? substr($excerpt, 0, 160) . '...' : $excerpt;
                $img = isset($service['image']) && $service['image'] ? 'assets/images/uploads/' . $service['image'] : 'assets/images/about-image.jpg';
                echo '<div class="project-card animate-on-scroll" data-service-id="' . (int)$service['id'] . '">
                        <div class="project-image">
                            <img src="' . htmlspecialchars($img) . '" alt="' . htmlspecialchars($title) . '">
                            <div class="project-overlay">
                                <button type="button" class="btn btn-secondary view-service-details" data-service-id="' . (int)$service['id'] . '">View Details</button>
                            </div>
                        </div>
                        <div class="project-info">
                            <h3>' . htmlspecialchars($title) . '</h3>
                            <p>' . htmlspecialchars($excerpt) . '</p>
                        </div>
                    </div>';
            }
            ?>
        </div>

        <div class="text-center" style="margin-top:24px;">
            <a href="index.php?page=contact" class="btn btn-primary">Inquire About Services</a>
        </div>
    </div>
</div>

<!-- Service Modal -->
<div id="serviceModal" class="modal">
    <div class="modal-content">
        <span class="close-modal" id="closeServiceModal">&times;</span>
        <div id="serviceModalBody"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const sModal = document.getElementById('serviceModal');
  const sBody  = document.getElementById('serviceModalBody');
  const sClose = document.getElementById('closeServiceModal');

  function openServiceModal(data){
    const title = data.title ? data.title : '';
    const desc  = data.description ? data.description : '';
    const img   = data.image ? 'assets/images/uploads/' + data.image : '';
    sBody.innerHTML = `
      <div class="project-detail">
        <div class="project-gallery">
          <div class="main-image">${img ? `<img src="${img}" alt="${title || 'Service image'}">` : ''}</div>
        </div>
        <div class="project-description">
          <h2 class="text-gradient">Project Description</h2>
          <p>${desc}</p>
          <div class="project-cta"><a href="index.php?page=contact" class="btn btn-primary">Enquire Now</a></div>
        </div>
      </div>`;
    sModal.style.display = 'block';
    document.body.style.overflow = 'hidden';
  }

  document.querySelectorAll('.view-service-details').forEach(btn => {
    btn.addEventListener('click', (e) => {
      const id = e.currentTarget.getAttribute('data-service-id');
      if (!id) return;
      fetch('api/service.php?id=' + encodeURIComponent(id))
        .then(r => r.json())
        .then(res => {
          if (res && res.success && res.data) { openServiceModal(res.data); }
          else { sBody.innerHTML = '<p>Unable to load service details.</p>'; sModal.style.display = 'block'; }
        })
        .catch(() => { sBody.innerHTML = '<p>Unable to load service details.</p>'; sModal.style.display = 'block'; });
    });
  });

  function closeSModal(){ sModal.style.display = 'none'; sBody.innerHTML=''; document.body.style.overflow=''; }
  sClose.addEventListener('click', closeSModal);
  window.addEventListener('click', (e) => { if (e.target === sModal) closeSModal(); });
  window.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeSModal(); });
});
</script>

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