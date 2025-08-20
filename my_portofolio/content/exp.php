
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="page-title">Pengalaman Kerja</h1>
                    <p class="page-subtitle">Perjalanan karir dan pencapaian profesional selama 5+ tahun</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Experience Timeline -->
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="timeline">
                        <?php
                        $experiences = [
                            [
                                'year' => '2021 - Sekarang',
                                'position' => 'Senior Full Stack Developer',
                                'company' => 'Tech Solutions Inc.',
                                'location' => 'Jakarta, Indonesia',
                                'type' => 'Full-time',
                                'description' => 'Memimpin tim pengembangan dalam menciptakan aplikasi web dan mobile yang scalable. Bertanggung jawab dalam arsitektur sistem dan mentoring junior developer.',
                                'achievements' => [
                                    'Meningkatkan performa aplikasi hingga 40% melalui optimasi database dan caching',
                                    'Memimpin tim 8 developer dalam pengembangan platform e-commerce',
                                    'Mengimplementasikan CI/CD pipeline yang mengurangi deployment time 60%',
                                    'Mentoring 5 junior developer dan meningkatkan skill tim secara keseluruhan'
                                ],
                                'technologies' => ['React.js', 'Node.js', 'AWS', 'Docker', 'PostgreSQL']
                            ],
                            [
                                'year' => '2019 - 2021',
                                'position' => 'Full Stack Developer',
                                'company' => 'Digital Agency Pro',
                                'location' => 'Jakarta, Indonesia',
                                'type' => 'Full-time',
                                'description' => 'Mengembangkan berbagai aplikasi web untuk klien dari berbagai industri. Fokus pada pengembangan frontend dan backend menggunakan teknologi modern.',
                                'achievements' => [
                                    'Berhasil menyelesaikan 25+ project web application dengan tingkat kepuasan klien 95%',
                                    'Mengembangkan CMS custom yang digunakan oleh 10+ klien perusahaan',
                                    'Meningkatkan SEO score rata-rata website klien dari 60 menjadi 85',
                                    'Mengimplementasikan responsive design yang meningkatkan mobile traffic 50%'
                                ],
                                'technologies' => ['Vue.js', 'Laravel', 'MySQL', 'Bootstrap', 'jQuery']
                            ],
                            [
                                'year' => '2018 - 2019',
                                'position' => 'Frontend Developer',
                                'company' => 'StartUp Innovate',
                                'location' => 'Jakarta, Indonesia',
                                'type' => 'Full-time',
                                'description' => 'Mengembangkan interface pengguna yang responsif dan user-friendly. Berkolaborasi dengan tim design untuk mengimplementasikan mockup menjadi kode.',
                                'achievements' => [
                                    'Mengembangkan dashboard admin yang meningkatkan efisiensi operasional 30%',
                                    'Mengimplementasikan design system yang mempercepat development 25%',
                                    'Berkolaborasi dengan UX designer untuk meningkatkan user engagement 40%',
                                    'Mengoptimalkan loading time website dari 5 detik menjadi 2 detik'
                                ],
                                'technologies' => ['React.js', 'JavaScript', 'SASS', 'Webpack', 'Git']
                            ],
                            [
                                'year' => '2017 - 2018',
                                'position' => 'Junior Web Developer',
                                'company' => 'Web Studio Creative',
                                'location' => 'Jakarta, Indonesia',
                                'type' => 'Full-time',
                                'description' => 'Memulai karir sebagai web developer dengan fokus pada pengembangan website menggunakan HTML, CSS, JavaScript, dan PHP.',
                                'achievements' => [
                                    'Menyelesaikan 15+ website company profile dengan kualitas tinggi',
                                    'Mempelajari dan menguasai framework Laravel dalam 3 bulan',
                                    'Berkontribusi dalam pengembangan sistem inventory management',
                                    'Mendapat promosi menjadi Frontend Developer dalam 1 tahun'
                                ],
                                'technologies' => ['HTML5', 'CSS3', 'JavaScript', 'PHP', 'MySQL']
                            ]
                        ];

                        foreach($experiences as $index => $exp): ?>
                        <div class="timeline-item <?php echo $index % 2 == 0 ? 'left' : 'right'; ?>">
                            <div class="timeline-content">
                                <div class="timeline-header">
                                    <div class="timeline-year"><?php echo $exp['year']; ?></div>
                                    <div class="timeline-type"><?php echo $exp['type']; ?></div>
                                </div>
                                <h4 class="timeline-position"><?php echo $exp['position']; ?></h4>
                                <h5 class="timeline-company">
                                    <i class="fas fa-building me-2"></i><?php echo $exp['company']; ?>
                                </h5>
                                <p class="timeline-location">
                                    <i class="fas fa-map-marker-alt me-2"></i><?php echo $exp['location']; ?>
                                </p>
                                <p class="timeline-description"><?php echo $exp['description']; ?></p>
                                
                                <div class="timeline-achievements">
                                    <h6><i class="fas fa-trophy me-2"></i>Key Achievements:</h6>
                                    <ul>
                                        <?php foreach($exp['achievements'] as $achievement): ?>
                                        <li><?php echo $achievement; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                
                                <div class="timeline-technologies">
                                    <h6><i class="fas fa-code me-2"></i>Technologies Used:</h6>
                                    <div class="tech-tags">
                                        <?php foreach($exp['technologies'] as $tech): ?>
                                        <span class="tech-tag"><?php echo $tech; ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Growth -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="section-title">Perkembangan Keahlian</h2>
                    <p class="section-subtitle">Evolusi teknologi yang saya kuasai selama perjalanan karir</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="skill-evolution-card">
                        <div class="skill-year">2017-2018</div>
                        <h5>Foundation</h5>
                        <div class="skill-list">
                            <span class="skill-badge">HTML5</span>
                            <span class="skill-badge">CSS3</span>
                            <span class="skill-badge">JavaScript</span>
                            <span class="skill-badge">PHP</span>
                            <span class="skill-badge">MySQL</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="skill-evolution-card">
                        <div class="skill-year">2018-2019</div>
                        <h5>Frontend Focus</h5>
                        <div class="skill-list">
                            <span class="skill-badge">React.js</span>
                            <span class="skill-badge">SASS</span>
                            <span class="skill-badge">Webpack</span>
                            <span class="skill-badge">Git</span>
                            <span class="skill-badge">Bootstrap</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="skill-evolution-card">
                        <div class="skill-year">2019-2021</div>
                        <h5>Full Stack</h5>
                        <div class="skill-list">
                            <span class="skill-badge">Vue.js</span>
                            <span class="skill-badge">Laravel</span>
                            <span class="skill-badge">Node.js</span>
                            <span class="skill-badge">MongoDB</span>
                            <span class="skill-badge">REST API</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="skill-evolution-card">
                        <div class="skill-year">2021-Now</div>
                        <h5>Advanced & Leadership</h5>
                        <div class="skill-list">
                            <span class="skill-badge">AWS</span>
                            <span class="skill-badge">Docker</span>
                            <span class="skill-badge">Microservices</span>
                            <span class="skill-badge">Team Lead</span>
                            <span class="skill-badge">DevOps</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="section-title">Testimoni</h2>
                    <p class="section-subtitle">Apa kata rekan kerja dan klien tentang kinerja saya</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <i class="fas fa-quote-left"></i>
                            <p>"John adalah developer yang sangat kompeten dan reliable. Kemampuan problem solving-nya luar biasa dan selalu memberikan solusi yang efisien."</p>
                        </div>
                        <div class="testimonial-author">
                            <img src="https://images.pexels.com/photos/3785079/pexels-photo-3785079.jpeg?auto=compress&cs=tinysrgb&w=100" alt="Sarah Manager">
                            <div class="author-info">
                                <h6>Sarah Johnson</h6>
                                <span>Project Manager - Tech Solutions Inc.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <i class="fas fa-quote-left"></i>
                            <p>"Bekerja dengan John sangat menyenangkan. Dia tidak hanya skilled secara teknis, tapi juga excellent dalam komunikasi dan teamwork."</p>
                        </div>
                        <div class="testimonial-author">
                            <img src="https://images.pexels.com/photos/3785081/pexels-photo-3785081.jpeg?auto=compress&cs=tinysrgb&w=100" alt="Mike Developer">
                            <div class="author-info">
                                <h6>Mike Chen</h6>
                                <span>Senior Developer - Digital Agency Pro</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <i class="fas fa-quote-left"></i>
                            <p>"John berhasil mengembangkan website kami dengan hasil yang melebihi ekspektasi. Profesional dan tepat waktu dalam delivery."</p>
                        </div>
                        <div class="testimonial-author">
                            <img src="https://images.pexels.com/photos/3785083/pexels-photo-3785083.jpeg?auto=compress&cs=tinysrgb&w=100" alt="Lisa Client">
                            <div class="author-info">
                                <h6>Lisa Wong</h6>
                                <span>CEO - StartUp Innovate</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
