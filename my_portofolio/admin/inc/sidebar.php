<?php
// Ambil page saat ini
$currentPage = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
$currentSectionId = isset($_GET['section_id']) ? intval($_GET['section_id']) : null;

// Ambil sub menu skills dari database
$qSkillSections = mysqli_query($koneksi, "SELECT id, name, type FROM sections WHERE type IN ('prolanguage','technology','development')");
$skillSections = mysqli_fetch_all($qSkillSections, MYSQLI_ASSOC);

// Menu Sidebar
$menu = [
    ['title' => 'Dashboard', 'icon' => 'bi bi-grid', 'link' => 'dashboard', 'children' => []],
    ['title' => 'Page', 'icon' => 'bi bi-menu-button-wide', 'link' => '#', 'children' => [
        ['title' => 'About', 'link' => '?page=about'],
        [
            'title' => 'Section',
            'link' => '#',
            'children' => [
                ['title' => 'Values', 'link' => '?page=add-sections&type=values_section'],
                ['title' => 'Soft Skills', 'link' => '?page=add-sections&type=soft_skills'],
                ['title' => 'Services', 'link' => '?page=add-sections&type=services'],
                ['title' => 'Floating Card', 'link' => '?page=add-sections&type=floating_card'],
            ]
        ],
        [
            'title' => 'Skills',
            'link' => '#',
            'children' => [
                [
                    'title' => 'Programming Language',
                    'link' => '#',
                    'children' => array_map(fn($s) => [
                        'title' => ucfirst($s['name']),
                        'link'  => '?page=skills&section_id=' . $s['id']
                    ], array_filter($skillSections, fn($s) => $s['type'] === 'prolanguage'))
                ],
                [
                    'title' => 'Technology',
                    'link' => '#',
                    'children' => array_map(fn($s) => [
                        'title' => ucfirst($s['name']),
                        'link'  => '?page=skills&section_id=' . $s['id']
                    ], array_filter($skillSections, fn($s) => $s['type'] === 'technology'))
                ],
                [
                    'title' => 'Development',
                    'link' => '#',
                    'children' => array_map(fn($s) => [
                        'title' => ucfirst($s['name']),
                        'link'  => '?page=skills&section_id=' . $s['id']
                    ], array_filter($skillSections, fn($s) => $s['type'] === 'development'))
                ],
                [
                    'title' => 'Skill Growth',
                    'link' => '?page=skill-growth',
                ],
            ]
        ],
        [
            'title' => 'Edu & Cert',
            'link' => '#',
            'children' => [
                ['title' => 'Education', 'link' => '?page=edu-cert&type=education'],
                ['title' => 'Certification', 'link' => '?page=edu-cert&type=certification'],
            ]
        ],
        ['title' => 'Portofolio', 'link' => '?page=portofolio'],
        ['title' => 'Experience', 'link' => '?page=experience'],
        ['title' => 'Testimonial', 'link' => '?page=testimonial'],
        ['title' => 'FAQ and Answer', 'link' => '?page=faq'],
    ]],
    ['heading' => 'Pages'],
    ['title' => 'User', 'icon' => 'bi bi-person', 'link' => '?page=user', 'children' => []],
    ['title' => 'Pengaturan', 'icon' => 'bi bi-gear', 'link' => '?page=setting', 'children' => []],
    ['title' => 'Master Section', 'icon' => 'bi bi-envelope', 'link' => '?page=master-sections', 'children' => []],
    ['title' => 'Messages', 'icon' => 'bi bi-envelope', 'link' => '?page=messages', 'children' => []],
];

// cek recursive apakah ada active child
function hasActiveChild($items, $currentPage, $currentSectionId) {
    foreach ($items as $child) {
        // cek anak-anak
        if (!empty($child['children']) && hasActiveChild($child['children'], $currentPage, $currentSectionId)) {
            return true;
        }

        // ambil page dari link (misalnya ?page=edu-cert&type=education → hasil: edu-cert)
        if (preg_match('/\?page=([^&]+)/', $child['link'], $match)) {
            $pageFromLink = $match[1];
            if ($currentPage === $pageFromLink) {
                return true;
            }
        }

        // cek khusus skills dengan section_id
        if ($currentPage === 'skills' && strpos($child['link'], 'section_id='.$currentSectionId) !== false) {
            return true;
        }
    }
    return false;
}


// fungsi recursive render menu
function renderMenu($items, $currentPage, $currentSectionId, $parentId = '') {
    foreach ($items as $index => $item) {
        if (isset($item['heading'])) {
            echo '<li class="nav-heading">'.$item['heading'].'</li>';
        } elseif (!empty($item['children'])) {
            $id = strtolower(str_replace(' ', '-', $item['title'])) . '-nav' . $index . $parentId;

            // cek apakah ada child active
            $isActiveParent = hasActiveChild($item['children'], $currentPage, $currentSectionId);

            echo '<li class="nav-item">';
            echo '<a class="nav-link '.($isActiveParent ? '' : 'collapsed').'" data-bs-target="#'.$id.'" data-bs-toggle="collapse" href="#">';
            if (isset($item['icon'])) echo '<i class="'.$item['icon'].'"></i>';
            echo '<span>'.$item['title'].'</span><i class="bi bi-chevron-down ms-auto"></i>';
            echo '</a>';
            echo '<ul id="'.$id.'" class="nav-content collapse '.($isActiveParent ? 'show' : '').'">';
                renderMenu($item['children'], $currentPage, $currentSectionId, $id);
            echo '</ul>';
            echo '</li>';
        } else {
            $isActive = ($currentPage === str_replace('?page=','',$item['link']));
            if ($currentPage === 'skills' && strpos($item['link'], 'section_id='.$currentSectionId) !== false) {
                $isActive = true;
            }
            echo '<li class="nav-item">';
            echo '<a href="'.$item['link'].'" class="nav-link '.($isActive?'active':'').'">';
            echo '<span>'.$item['title'].'</span></a></li>';
        }
    }
}
?>

<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <?php renderMenu($menu, $currentPage, $currentSectionId); ?>
    </ul>
</aside>

<style>
/* --- Global Sidebar --- */
.sidebar .nav-item a.nav-link {
    display: flex;
    align-items: center;
    padding: 8px 15px;
    font-size: 14px;
    border-radius: 8px;
    transition: all 0.2s;
}

.sidebar .nav-item a.nav-link:hover {
    background: #f0f2f5;
}

.sidebar .nav-item a.active {
    background: #0d6efd;
    /* biru solid utk menu utama */
    color: #fff;
    font-weight: 600;
}

/* --- Submenu / Children --- */
.sidebar .nav-content {
    padding-left: 15px;
}

.sidebar .nav-content a {
    display: block;
    padding: 6px 12px;
    font-size: 13px;
    color: #444;
    border-radius: 6px;
    transition: all 0.2s;
}

.sidebar .nav-content a:hover {
    background: #f8f9fa;
    color: #0d6efd;
}

.sidebar .nav-content a.active {
    background: #e9f2ff;
    /* biru muda agar kontras */
    color: #0d6efd;
    font-weight: 600;
}

/* --- Animasi panah collapse --- */
.sidebar .nav-link i.bi-chevron-down {
    transition: transform 0.3s ease;
}

.sidebar .nav-link:not(.collapsed) i.bi-chevron-down {
    transform: rotate(180deg);
}
</style>