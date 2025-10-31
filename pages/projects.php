<div class="page-header">
    <div class="container">
        <h1 class="text-gradient">Our Projects</h1>
        <p>Explore our portfolio of completed interior design projects.</p>
    </div>
</div>

<div class="section projects-filter-section">
    <div class="container">
        <div class="projects-filter">
            <button class="filter-btn active" data-filter="all">All Projects</button>
            <?php $services = getActiveServices(); foreach ($services as $service) { ?>
                <button class="filter-btn" data-filter="<?php echo $service['id']; ?>"><?php echo htmlspecialchars($service['title']); ?></button>
            <?php } ?>
        </div>
    </div>
</div>

<div class="section projects-grid-section">
    <div class="container">
        <div class="projects-grid">
            <?php $projects = getActiveProjects(); foreach ($projects as $project) {
                $images = json_decode($project['images'], true);
                $mainImage = isset($images[0]) ? $images[0] : 'default-project.jpg'; ?>
                <div class="project-card animate-on-scroll" data-category="<?php echo htmlspecialchars($project['service_id']); ?>">
                    <div class="project-image">
                        <img src="assets/images/uploads/<?php echo htmlspecialchars($mainImage); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                        <div class="project-overlay">
                            <button type="button" class="btn btn-secondary view-details" data-project-id="<?php echo $project['id']; ?>">View Details</button>
                        </div>
                    </div>
                    <div class="project-info">
                        <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                        <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($project['location']); ?></p>
                        <p><i class="fas fa-tag"></i> <?php echo htmlspecialchars($project['service_name']); ?></p>
                    </div>
                    <div class="project-detail-template" style="display:none;">
                        <div class="project-detail">
                            <h2><?php echo htmlspecialchars($project['title']); ?></h2>
                            <div class="project-meta">
                                <p><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> <?php echo htmlspecialchars($project['location']); ?></p>
                                <p><i class="fas fa-tag"></i> <strong>Service:</strong> <?php echo htmlspecialchars($project['service_name']); ?></p>
                            </div>
                            <div class="project-gallery">
                                <div class="main-image">
                                    <img src="assets/images/uploads/<?php echo htmlspecialchars($mainImage); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                                </div>
                                <div class="thumbnail-grid">
                                    <?php if (!empty($images)) { foreach ($images as $img) { ?>
                                        <img src="assets/images/uploads/<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                                    <?php } } ?>
                                </div>
                            </div>
                            <div class="project-description">
                                <h3>Project Description</h3>
                                <p><?php echo $project['description']; ?></p>
                            </div>
                            <div class="project-cta">
                                <a href="index.php?page=contact" class="btn btn-primary">Start Your Project</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Project Modal -->
<div id="projectModal" class="modal">
    <div class="modal-content">
        <span class="close-modal" id="closeProjectModal">&times;</span>
        <div id="projectModalBody"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Filter buttons logic
  const buttons = document.querySelectorAll('.filter-btn');
  const cards = document.querySelectorAll('.project-card');
  buttons.forEach(btn => {
    btn.addEventListener('click', () => {
      buttons.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const filter = btn.getAttribute('data-filter');
      cards.forEach(card => {
        const cat = card.getAttribute('data-category');
        const show = (filter === 'all') || (filter === cat);
        card.style.display = show ? '' : 'none';
      });
    });
  });

  // Modal logic
  const modal = document.getElementById('projectModal');
  const body = document.getElementById('projectModalBody');
  const closeBtn = document.getElementById('closeProjectModal');
  document.querySelectorAll('.view-details').forEach(btn => {
    btn.addEventListener('click', (e) => {
      const card = e.target.closest('.project-card');
      if (!card) return;
      const template = card.querySelector('.project-detail-template');
      if (!template) return;
      body.innerHTML = template.innerHTML;
      modal.style.display = 'block';
      document.body.style.overflow = 'hidden';
      const mainImg = modal.querySelector('.main-image img');
      modal.querySelectorAll('.thumbnail-grid img').forEach(img => {
        img.addEventListener('click', () => { if (mainImg) mainImg.src = img.src; });
      });
    });
  });
  function closeModal(){ modal.style.display = 'none'; body.innerHTML = ''; document.body.style.overflow = ''; }
  closeBtn.addEventListener('click', closeModal);
  window.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });
  window.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });
});
</script>