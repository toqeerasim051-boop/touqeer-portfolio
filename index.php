<?php
/**
 * index.php — Portfolio main page (v2 — mobile nav fixed)
 */
session_start();
require_once __DIR__ . '/config/db.php';

$is_admin = !empty($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// Load published projects from DB
$projects_result = $conn->query('SELECT * FROM projects WHERE is_published = 1 ORDER BY display_order ASC, id ASC');
$projects = [];
while ($p = $projects_result->fetch_assoc()) {
    $p['tags'] = array_filter(array_map('trim', explode(',', $p['tech_stack'])));
    $projects[] = $p;
}

// Load profile photo path
$profile_photo = 'image.png'; // default
if (file_exists(__DIR__ . '/uploads/profile/photo.jpg'))  $profile_photo = 'uploads/profile/photo.jpg';
elseif (file_exists(__DIR__ . '/uploads/profile/photo.png')) $profile_photo = 'uploads/profile/photo.png';
elseif (file_exists(__DIR__ . '/uploads/profile/photo.webp')) $profile_photo = 'uploads/profile/photo.webp';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Touqeer Asim | Full Stack Web Developer</title>
  <meta name="description" content="Touqeer Asim — Aspiring Full Stack Web Developer from Lahore, Pakistan.">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700;800;900&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
 
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <!-- ══════════════════════════════════════
       NAVBAR — fixed layout, mobile-first
  ══════════════════════════════════════ -->
  <nav id="navbar" class="navbar navbar-expand-lg fixed-top">
  <div class="container navbar-inner">
    <!-- Brand -->
    <a class="navbar-brand logo" href="#home">Touqeer<span>.</span></a>

    <!-- Right side controls -->
    <div class="nav-right-controls">
      <?php if ($is_admin): ?>
        <a href="admin/index.php" class="nav-admin-pill" title="Admin Panel">
          <i class="bi bi-shield-fill-check"></i>
          <span class="admin-pill-text">Admin</span>
        </a>
      <?php endif; ?>

      <button id="theme-toggle" class="theme-toggle-btn" aria-label="Toggle theme">
        <i class="bi bi-sun-fill"></i>
      </button>

      <!-- Hamburger button - make sure data-bs-target matches id -->
      <button class="navbar-toggler" type="button" 
              data-bs-toggle="collapse" 
              data-bs-target="#navbarNav" 
              aria-controls="navbarNav" 
              aria-expanded="false" 
              aria-label="Toggle navigation">
        <i class="bi bi-list"></i>
      </button>
    </div>

    <!-- Collapsible menu - id must match data-bs-target -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto align-items-lg-center gap-lg-1">
        <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
        <li class="nav-item"><a class="nav-link" href="#experience">Experience</a></li>
        <li class="nav-item"><a class="nav-link" href="#projects">Projects</a></li>
        <li class="nav-item"><a class="nav-link" href="#skills">Skills</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>
  <!-- ══════════════════════════════════════
       HERO
  ══════════════════════════════════════ -->
  <section id="home" class="hero-section">
    <div class="hero-bg-glow" aria-hidden="true"></div>
    <div class="hero-particles" aria-hidden="true">
      <span></span><span></span><span></span><span></span><span></span>
    </div>

    <div class="container">
      <div class="row min-vh-100 align-items-center">
        <div class="col-12 col-md-10 col-lg-8 mx-auto hero-content-col">

          <!-- ★ Available badge — outside collapse, always visible & white -->
          <div class="hero-available fade-up">
            <span class="avail-dot"></span>
            Available for new opportunities
          </div>

          <div class="hero-decorative-top fade-up delay-1">
            <div class="decorative-line"></div>
            <span class="decorative-text">Welcome to my portfolio</span>
            <div class="decorative-line"></div>
          </div>

          <h1 class="hero-heading fade-up delay-1">
            Hi, I'm <span class="highlight">Touqeer Asim</span>
          </h1>

          <div class="hero-decorative-bottom fade-up delay-2">
            <div class="decorative-dots"><span></span><span></span><span></span></div>
          </div>

          <p class="hero-sub fade-up delay-3">Aspiring Full Stack Web Developer</p>
          <p class="hero-desc fade-up delay-4">
            I craft clean, purposeful web applications using HTML, CSS, JavaScript, PHP &amp; MySQL.
            Passionate about building things that actually work and look great doing it.
          </p>

          <div class="hero-btns fade-up delay-5">
            <a href="#contact" class="btn-cyan">Let's Work Together</a>
            <a href="#projects" class="btn-outline-cyan">View My Work</a>
          </div>

          <div class="hero-socials fade-up delay-6">
            <a href="https://github.com/toqeerasim051-boop" target="_blank" rel="noopener" title="GitHub"><i class="bi bi-github"></i></a>
            <a href="https://www.linkedin.com/in/touqeer-asim-960b06395/" target="_blank" rel="noopener" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
<a href="https://wa.me/923150640664" target="_blank" rel="noopener" title="Chat on WhatsApp">
    <i class="bi bi-whatsapp"></i>
</a>
            <a href="https://www.facebook.com/toqeer.asim.568" target="_blank" rel="noopener" title="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=toqeerasim051@gmail.com" target="_blank" rel="noopener" title="Email"><i class="bi bi-envelope-fill"></i></a>
          </div>
        </div>
      </div>
    </div>

    <a href="#about" class="hero-scroll-hint" aria-label="Scroll down">
      <i class="bi bi-chevron-down"></i>
    </a>
  </section>

  <!-- ══════════════════════════════════════
       ABOUT
  ══════════════════════════════════════ -->
  <section id="about" class="section-pad">
    <div class="container">
      <div class="section-header reveal">
        <p class="sec-label">Get to know me</p>
        <h2 class="sec-title">About <span class="highlight">Me</span></h2>
      </div>
      <div class="row align-items-center g-5 mt-2">
        <div class="col-lg-5 d-flex justify-content-center">
          <div class="profile-photo-wrap reveal">
            <div class="profile-ring-1"></div>
            <div class="profile-ring-2"></div>
            <div class="profile-img-box">
              <img id="profileImg" src="<?= htmlspecialchars($profile_photo) ?>" alt="Touqeer Asim" />
            </div>
            <div class="profile-dot dot-tr"></div>
            <div class="profile-dot dot-bl"></div>
          </div>
        </div>
        <div class="col-lg-7">
          <h3 class="about-name reveal">I'm Touqeer Asim</h3>
          <p class="about-role reveal"><span class="highlight">Aspiring Full Stack Web Developer</span></p>
          <p class="body-text reveal mt-3">
            I'm a passionate web developer from Lahore, Pakistan, focused on building clean,
            functional, and visually appealing web applications. I enjoy turning ideas into real,
            working products using PHP, MySQL, and modern frontend tools.
          </p>
          <p class="body-text reveal mt-2">
            I believe in writing maintainable code and creating user experiences that genuinely
            help people. Every project I build teaches me something new.
          </p>
          <div class="about-stats reveal mt-4">
            <div class="astat"><span class="astat-n">04+</span><span class="astat-l">Projects Done</span></div>
            <div class="astat"><span class="astat-n">1+</span><span class="astat-l">Years Coding</span></div>
          </div>
          <div class="about-info reveal mt-4">
            <div class="ainfo-row"><span>Name:</span><strong>Touqeer Asim</strong></div>
            <div class="ainfo-row"><span>Location:</span><strong>Lahore, Pakistan</strong></div>
            <div class="ainfo-row"><span>Email:</span><strong>toqeerasim051@gmail.com</strong></div>
            <div class="ainfo-row"><span>Status:</span><strong class="highlight">Available for work</strong></div>
          </div>
          <div class="about-socials reveal mt-4">
            <a href="https://github.com/toqeerasim051-boop" target="_blank" rel="noopener"><i class="bi bi-github"></i></a>
            <a href="https://www.linkedin.com/in/touqeer-asim-960b06395/" target="_blank" rel="noopener"><i class="bi bi-linkedin"></i></a>
<a href="https://wa.me/923150640664" target="_blank" rel="noopener" title="Chat on WhatsApp">
    <i class="bi bi-whatsapp"></i>
</a>            <a href="https://www.facebook.com/toqeer.asim.568" target="_blank" rel="noopener"><i class="bi bi-facebook"></i></a>
            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=toqeerasim051@gmail.com" target="_blank" rel="noopener"><i class="bi bi-envelope-fill"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ══════════════════════════════════════
       EXPERIENCE
  ══════════════════════════════════════ -->
  <section id="experience" class="section-pad section-alt">
    <div class="container">
      <div class="section-header reveal">
        <p class="sec-label">My journey</p>
        <h2 class="sec-title">Professional <span class="highlight">Experience</span></h2>
        <p class="sec-desc">A timeline of my career growth and the skills I've built along the way</p>
      </div>
      <div class="timeline mt-5">
        <div class="timeline-item reveal">
          <div class="tl-dot"></div>
          <div class="tl-card">
            <div class="tl-card-header">
              <div>
                <h4 class="tl-role">Web Developer Intern</h4>
                <p class="tl-company"><i class="bi bi-building"></i> Asian-Sol</p>
              </div>
              <span class="tl-badge"><i class="bi bi-calendar3"></i> Jun 2025 – Oct 2025 · 4 months</span>
            </div>
            <p class="tl-desc">
              Completed a 4-month internship at Asian-Sol building real-world web projects.
              Gained hands-on experience applying modern web technologies in a production environment.
            </p>
            <div class="tl-highlights">
              <h6><i class="bi bi-star-fill"></i> What I Did &amp; Learned</h6>
              <ul>
                <li>Built responsive pages using HTML5, CSS3, Bootstrap, and JavaScript</li>
                <li>Developed and managed MySQL databases with proper schema design</li>
                <li>Created PHP backend logic for form handling and data management</li>
                <li>Collaborated with senior developers and learned professional Git workflow</li>
                <li>Participated in team meetings, code reviews, and agile sprints</li>
              </ul>
            </div>
            <div class="tl-tags">
              <span>HTML5</span><span>CSS3</span><span>JavaScript</span>
              <span>PHP</span><span>MySQL</span><span>Bootstrap</span><span>Tailwind</span><span>Git</span>
            </div>
          </div>
        </div>
        <div class="tl-end reveal">
          <div class="tl-end-dot"></div>
          <p>My journey continues — more experience coming soon!</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ══════════════════════════════════════
       PROJECTS — DB-Driven
  ══════════════════════════════════════ -->
  <section id="projects" class="section-pad">
    <div class="container">
      <div class="section-header reveal">
        <p class="sec-label">What I've built</p>
        <h2 class="sec-title">Featured <span class="highlight">Projects</span></h2>
        <p class="sec-desc">A showcase of projects that blend functionality with clean design</p>
      </div>

      <?php if ($is_admin): ?>
      <div class="d-flex justify-content-end mb-4 reveal">
        <a href="admin/projects.php?action=add" class="btn-cyan-sm">
          <i class="bi bi-plus-circle-fill"></i> Add New Project
        </a>
      </div>
      <?php endif; ?>

      <div class="row g-4" id="projectsGrid">
        <?php if (empty($projects)): ?>
          <div class="col-12 text-center py-5">
            <i class="bi bi-kanban" style="font-size:3rem;color:var(--text-3)"></i>
            <p style="color:var(--text-2);margin-top:1rem">No projects yet. Add some from the admin panel.</p>
          </div>
        <?php else: ?>
          <?php foreach ($projects as $p): ?>
          <div class="col-md-6 col-xl-4 reveal">
            <div class="proj-card">
              <?php if ($p['image_path']): ?>
              <div class="proj-card-img">
                <img src="<?= htmlspecialchars($p['image_path']) ?>" alt="<?= htmlspecialchars($p['title']) ?>" loading="lazy">
              </div>
              <?php endif; ?>
              <div class="proj-card-top">
                <div class="proj-icon"><i class="bi <?= htmlspecialchars($p['icon_class']) ?>"></i></div>
                <div class="proj-type"><?= htmlspecialchars($p['project_type']) ?></div>
              </div>
              <h3 class="proj-title"><?= htmlspecialchars($p['title']) ?></h3>
              <p class="proj-desc"><?= htmlspecialchars($p['description']) ?></p>
              <div class="proj-stack">
                <?php foreach ($p['tags'] as $tag): ?>
                  <span><?= htmlspecialchars($tag) ?></span>
                <?php endforeach; ?>
              </div>
              <div class="proj-links">
                <?php if ($p['live_url']): ?>
                <a class="plnk live" href="<?= htmlspecialchars($p['live_url']) ?>" target="_blank" rel="noopener">
                  <i class="bi bi-box-arrow-up-right"></i> Live Demo
                </a>
                <?php else: ?>
                <span class="plnk live plnk-disabled"><i class="bi bi-box-arrow-up-right"></i> Live Demo</span>
                <?php endif; ?>

                <?php if ($p['github_url']): ?>
                <a class="plnk gh" href="<?= htmlspecialchars($p['github_url']) ?>" target="_blank" rel="noopener">
                  <i class="bi bi-github"></i> GitHub
                </a>
                <?php else: ?>
                <span class="plnk gh plnk-disabled"><i class="bi bi-github"></i> GitHub</span>
                <?php endif; ?>

                <?php if ($is_admin): ?>
                <a class="plnk edit" href="admin/projects.php?action=edit&id=<?= (int)$p['id'] ?>">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <div class="text-center mt-5 reveal">
        <a href="https://github.com/toqeerasim051-boop" target="_blank" rel="noopener" class="btn-outline-cyan">
          <i class="bi bi-github"></i> Explore All on GitHub
        </a>
      </div>
    </div>
  </section>

  <!-- ══════════════════════════════════════
       SKILLS
  ══════════════════════════════════════ -->
  <section id="skills" class="section-pad section-alt">
    <div class="container">
      <div class="section-header reveal">
        <p class="sec-label">What I work with</p>
        <h2 class="sec-title">Skills &amp; <span class="highlight">Technologies</span></h2>
      </div>
      <div class="skills-grid mt-5">
        <div class="skill-box reveal">
          <div class="skill-box-icon"><i class="bi bi-display"></i></div>
          <h5>Frontend</h5>
          <div class="skill-tags">
            <span>HTML5</span><span>CSS3</span><span>JavaScript</span>
            <span>Bootstrap 5</span><span>Tailwind CSS</span><span>Responsive Design</span>
          </div>
        </div>
        <div class="skill-box reveal">
          <div class="skill-box-icon"><i class="bi bi-server"></i></div>
          <h5>Backend</h5>
          <div class="skill-tags">
            <span>PHP</span><span>MySQL</span><span>REST APIs</span>
            <span>Form Handling</span><span>Sessions</span>
          </div>
        </div>
        <div class="skill-box reveal">
          <div class="skill-box-icon"><i class="bi bi-tools"></i></div>
          <h5>Tools</h5>
          <div class="skill-tags">
            <span>Git</span><span>GitHub</span><span>VS Code</span>
            <span>XAMPP</span><span>Figma</span><span>DevTools</span>
          </div>
        </div>
        <div class="skill-box reveal">
          <div class="skill-box-icon"><i class="bi bi-lightbulb-fill"></i></div>
          <h5>Concepts</h5>
          <div class="skill-tags">
            <span>OOP</span><span>MVC</span><span>DB Design</span>
            <span>SQL Queries</span><span>Web Security</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ══════════════════════════════════════
       CONTACT
  ══════════════════════════════════════ -->
  <section id="contact" class="section-pad">
    <div class="container">
      <div class="section-header reveal">
        <p class="sec-label">Get in touch</p>
        <h2 class="sec-title">Let's Build Something <span class="highlight">Amazing</span></h2>
        <p class="sec-desc">Ready to bring your ideas to life? Let's collaborate and create something great.</p>
      </div>
      <div class="row g-5 mt-2">
        <div class="col-lg-5">
          <div class="contact-info reveal">
            <div class="ci-item">
              <div class="ci-icon"><i class="bi bi-envelope-fill"></i></div>
              <div>
                <p class="ci-label">Email Address</p>
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=toqeerasim051@gmail.com" target="_blank" rel="noopener" class="ci-val">toqeerasim051@gmail.com</a>
              </div>
            </div>
            <div class="ci-item">
              <div class="ci-icon"><i class="bi bi-telephone-fill"></i></div>
              <div>
                <p class="ci-label">Phone Number</p>
                <a href="tel:+923150640664" class="ci-val">(+92) 315-0640664</a>
              </div>
            </div>
            <div class="ci-item">
              <div class="ci-icon"><i class="bi bi-geo-alt-fill"></i></div>
              <div>
                <p class="ci-label">Location</p>
                <span class="ci-val">Lahore, Pakistan</span>
              </div>
            </div>
          </div>
          <div class="contact-socials reveal mt-4">
            <p class="cs-label">Connect With Me</p>
            <div class="cs-links">
              <a href="https://github.com/toqeerasim051-boop" target="_blank" rel="noopener"><i class="bi bi-github"></i></a>
              <a href="https://www.linkedin.com/in/touqeer-asim-960b06395/" target="_blank" rel="noopener"><i class="bi bi-linkedin"></i></a>
<a href="https://wa.me/923150640664" target="_blank" rel="noopener" title="Chat on WhatsApp">
    <i class="bi bi-whatsapp"></i>
</a>              <a href="https://www.facebook.com/toqeer.asim.568" target="_blank" rel="noopener"><i class="bi bi-facebook"></i></a>
              <a href="https://mail.google.com/mail/?view=cm&fs=1&to=toqeerasim051@gmail.com" target="_blank" rel="noopener"><i class="bi bi-envelope-fill"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <form id="contactForm" class="contact-form reveal" action="contact.php" method="POST" novalidate>
            <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">
            <div class="row g-3">
              <div class="col-sm-6">
                <div class="fg">
                  <label for="fname">Your Name</label>
                  <input type="text" id="fname" name="name" placeholder="Touqeer Asim" required maxlength="100"/>
                  <span class="ferr" id="nameError"></span>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="fg">
                  <label for="femail">Email Address</label>
                  <input type="email" id="femail" name="email" placeholder="toqeerasim051@gmail.com" required maxlength="254"/>
                  <span class="ferr" id="emailError"></span>
                </div>
              </div>
              <div class="col-12">
                <div class="fg">
                  <label for="fsubject">Subject</label>
                  <input type="text" id="fsubject" name="subject" placeholder="Project collaboration / hiring / just saying hi" required maxlength="200"/>
                  <span class="ferr" id="subjectError"></span>
                </div>
              </div>
              <div class="col-12">
                <div class="fg">
                  <label for="fmessage">Message</label>
                  <textarea id="fmessage" name="message" rows="6" placeholder="Tell me about your project or idea…" required maxlength="5000"></textarea>
                  <span class="ferr" id="messageError"></span>
                </div>
              </div>
            </div>
            <div id="formStatus" class="form-status mt-3" aria-live="polite"></div>
            <button type="submit" class="btn-cyan w-100 mt-3" id="submitBtn">
              <span class="btn-text">Send Message <i class="bi bi-send-fill"></i></span>
              <span class="btn-loading d-none"><i class="bi bi-hourglass-split spin"></i> Sending…</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- ══════════════════════════════════════
       FOOTER
  ══════════════════════════════════════ -->
  <footer id="footer">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-4">
          <a href="#home" class="footer-logo">Touqeer<span>.</span></a>
          <p class="footer-bio mt-3">Aspiring Full Stack Web Developer passionate about creating clean web experiences.</p>
          <div class="footer-socials mt-3">
            <a href="https://github.com/toqeerasim051-boop" target="_blank" rel="noopener"><i class="bi bi-github"></i></a>
            <a href="https://www.linkedin.com/in/touqeer-asim-960b06395/" target="_blank" rel="noopener"><i class="bi bi-linkedin"></i></a>
<a href="https://wa.me/923150640664" target="_blank" rel="noopener" title="Chat on WhatsApp">
    <i class="bi bi-whatsapp"></i>
</a>            <a href="https://www.facebook.com/toqeer.asim.568" target="_blank" rel="noopener"><i class="bi bi-facebook"></i></a>
            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=toqeerasim051@gmail.com" target="_blank" rel="noopener"><i class="bi bi-envelope-fill"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <h6 class="footer-heading">Quick Links</h6>
          <ul class="footer-links">
            <li><a href="#home"><i class="bi bi-chevron-right"></i> Home</a></li>
            <li><a href="#about"><i class="bi bi-chevron-right"></i> About</a></li>
            <li><a href="#experience"><i class="bi bi-chevron-right"></i> Experience</a></li>
            <li><a href="#projects"><i class="bi bi-chevron-right"></i> Projects</a></li>
            <li><a href="#skills"><i class="bi bi-chevron-right"></i> Skills</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-sm-6">
          <h6 class="footer-heading">Services</h6>
          <ul class="footer-links">
            <li><a href="#contact"><i class="bi bi-chevron-right"></i> Web Development</a></li>
            <li><a href="#contact"><i class="bi bi-chevron-right"></i> PHP Backend</a></li>
            <li><a href="#contact"><i class="bi bi-chevron-right"></i> MySQL Database</a></li>
            <li><a href="#contact"><i class="bi bi-chevron-right"></i> Responsive Design</a></li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; <span id="year"></span> Touqeer Asim. All rights reserved. Built with HTML · CSS · Bootstrap · PHP · MySQL</p>
        <a href="#home" class="footer-top-btn" aria-label="Back to top"><i class="bi bi-arrow-up"></i></a>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>
