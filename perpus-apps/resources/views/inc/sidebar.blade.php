 <aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">
         <li class="nav-item">
             <a class="nav-link collapsed" href="{{ url('dashboard') }}">
                 <i class="bi bi-grid"></i>
                 <span>Dashboard</span>
             </a>
         </li><!-- End Dashboard Nav -->

         @if (auth()->user()->hasRole('Administrator'))
             <li class="nav-item">
                 <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                     <i class="bi bi-menu-button-wide"></i><span>Master Data</span><i
                         class="bi bi-chevron-down ms-auto"></i>
                 </a>
                 <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                     <li>
                         <a href="{{ url('anggota') }}">
                             <i class="bi bi-circle"></i><span>Anggota</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ route('lokasi.index') }}">
                             <i class="bi bi-circle"></i><span>Lokasi Buku</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ route('kategori.index') }}">
                             <i class="bi bi-circle"></i><span>Kategori Buku</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ route('buku.index') }}">
                             <i class="bi bi-circle"></i><span>Buku</span>
                         </a>
                     </li>
                     <a href="{{ route('role.index') }}">
                         <i class="bi bi-circle"></i><span>Role</span>
                     </a>
                     <a href="{{ route('user.index') }}">
                         <i class="bi bi-circle"></i><span>User</span>
                     </a>
             </li>
         @endif
     </ul>

     @if (auth()->user()->hasAnyRole(['Administrator', 'user']))
         <li class="nav-item">
             <a class="nav-link collapsed" href="{{ route('transaction.index') }}">
                 <i class="bi bi-journal-text"></i>
                 <span>Pinjam Buku</span>
             </a>
         </li><!-- End Forms Nav -->
     @endif
     </ul>

 </aside><!-- End Sidebar-->
