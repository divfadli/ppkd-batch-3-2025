<?php
// ========================
// Ringkasan data
// ========================
$count_projects = $koneksi->query("SELECT COUNT(*) AS total FROM projects")->fetch_assoc()['total'];
$count_services = $koneksi->query("SELECT COUNT(*) AS total FROM services")->fetch_assoc()['total'];
$count_messages = $koneksi->query("SELECT COUNT(*) AS total FROM messages")->fetch_assoc()['total'];
$count_testi    = $koneksi->query("SELECT COUNT(*) AS total FROM testimonials")->fetch_assoc()['total'];

// ========================
// Data skill growth untuk chart
// ========================
$skill_growth = $koneksi->query("SELECT start_year, end_year, skills FROM skill_growth ORDER BY start_year ASC");
$years  = [];
$skills = [];

while ($row = $skill_growth->fetch_assoc()) {
    $years[] = $row['start_year'] . ' - ' . $row['end_year'];
    $decoded = json_decode($row['skills'], true);
    $skills[] = is_array($decoded) ? count($decoded) : 0;
}

// ========================
// Data kategori project
// ========================
$projects_cat = $koneksi->query("
    SELECT s.name AS section, COUNT(p.id) AS total 
    FROM projects p 
    JOIN sections s ON p.section_id = s.id 
    GROUP BY s.name
");

$categories  = [];
$proj_counts = [];

while ($row = $projects_cat->fetch_assoc()) {
    $categories[]  = htmlspecialchars($row['section']);
    $proj_counts[] = (int)$row['total'];
}
?>

<div class="container my-5">
  <h2 class="mb-4 fw-bold text-primary text-center">📊 Admin Dashboard</h2>

  <!-- Ringkasan -->
  <div class="row g-4 mb-5 text-center">
    <div class="col-md-3">
      <div class="card dashboard-card text-white p-4 gradient-primary">
        <div class="icon-box bg-white bg-opacity-25"><i class="bi bi-folder-fill"></i></div>
        <h2 class="fw-bold"><?= $count_projects ?></h2>
        <p class="mb-0">Projects</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card dashboard-card text-white p-4 gradient-success">
        <div class="icon-box bg-white bg-opacity-25"><i class="bi bi-gear-fill"></i></div>
        <h2 class="fw-bold"><?= $count_services ?></h2>
        <p class="mb-0">Services</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card dashboard-card text-dark p-4 gradient-warning">
        <div class="icon-box bg-dark bg-opacity-25 text-white"><i class="bi bi-envelope-fill"></i></div>
        <h2 class="fw-bold"><?= $count_messages ?></h2>
        <p class="mb-0">Messages</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card dashboard-card text-white p-4 gradient-info">
        <div class="icon-box bg-white bg-opacity-25"><i class="bi bi-chat-square-quote-fill"></i></div>
        <h2 class="fw-bold"><?= $count_testi ?></h2>
        <p class="mb-0">Testimonials</p>
      </div>
    </div>
  </div>

  <!-- Chart section -->
  <div class="row g-4">
    <div class="col-md-6">
      <div class="card dashboard-card shadow-sm border-0 p-4 chart-card">
        <h6 class="mb-3 fw-bold">📈 Skill Growth per Period</h6>
        <div class="chart-container">
          <canvas id="skillChart"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card dashboard-card shadow-sm border-0 p-4 chart-card">
        <h6 class="mb-3 fw-bold">📂 Projects by Category</h6>
        <div class="chart-container">
          <canvas id="projChart"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Skill Growth Chart
new Chart(document.getElementById('skillChart'), {
  type: 'line',
  data: {
    labels: <?= json_encode($years) ?>,
    datasets: [{
      label: 'Skills Count',
      data: <?= json_encode($skills) ?>,
      borderColor: '#0d6efd',
      backgroundColor: 'rgba(13,110,253,0.15)',
      tension: 0.4,
      pointBackgroundColor: '#0d6efd',
      pointRadius: 5,
      fill: true
    }]
  },
  options: {
    maintainAspectRatio: false, // biar ikut container
    responsive: true,
    plugins: {
      legend: { display: true, labels: { usePointStyle: true } }
    },
    scales: { y: { beginAtZero: true } }
  }
});

// Projects by Category Chart
new Chart(document.getElementById('projChart'), {
  type: 'doughnut',
  data: {
    labels: <?= json_encode($categories) ?>,
    datasets: [{
      data: <?= json_encode($proj_counts) ?>,
      backgroundColor: ['#0d6efd','#198754','#ffc107','#dc3545','#6f42c1','#20c997','#fd7e14'],
      borderWidth: 2
    }]
  },
  options: {
    maintainAspectRatio: false,
    responsive: true,
    cutout: '65%',   // besar lubang tengah
    radius: '85%',  // perkecil radius donut
    plugins: {
      legend: { position: 'bottom' },
      tooltip: { enabled: true }
    },
    animation: {
      animateScale: true,
      animateRotate: true
    }
  }
});
</script>
