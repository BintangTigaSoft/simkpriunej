    <?php
    // Helper function for recursive menu rendering
    if (!function_exists('renderMenu')) {
        function renderMenu($items) {
            foreach ($items as $item) {
                // If the item acts as a caption/section header (based on some logic, or just a specific type if added later)
                // For now, assume all top level items without URL are not captions unless specified.
                
                $hasSubmenu = isset($item->children) && !empty($item->children);
                
                $url = 'javascript:void(0);';
                if (isset($item->nama_url) && !empty($item->nama_url)) {
                    if ($item->nama_url === 'javascript:void(0);' || $item->nama_url === '#') {
                        $url = $item->nama_url;
                    } else {
                        $url = base_url($item->nama_url);
                    }
                }
                
                // Determine icon
                $iconClass = !empty($item->icon) ? $item->icon : 'feather-circle';

                echo '<li class="nxl-item ' . ($hasSubmenu ? 'nxl-hasmenu' : '') . '">';
                echo '<a href="' . $url . '" class="nxl-link">';
                
                echo '<span class="nxl-micon"><i class="' . $iconClass . '"></i></span>';
                
                echo '<span class="nxl-mtext">' . $item->nama_modul . '</span>';
                
                if ($hasSubmenu) {
                    echo '<span class="nxl-arrow"><i class="feather-chevron-right"></i></span>';
                }
                
                echo '</a>';

                if ($hasSubmenu) {
                    echo '<ul class="nxl-submenu">';
                    renderMenu($item->children);
                    echo '</ul>';
                }

                echo '</li>';
            }
        }
    }
    ?>

    <nav class="nxl-navigation">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="index.html" class="b-brand">
                    <!-- ========   change your logo hear   ============ -->
                    <img src="assets/images/logo-full.png" alt="" class="logo logo-lg" />
                    <img src="assets/images/logo-abbr.png" alt="" class="logo logo-sm" />
                </a>
            </div>
            <div class="navbar-content">
                <ul class="nxl-navbar">
                    <li class="nxl-item nxl-caption">
                        <label>Navigation</label>
                    </li>
                    <?php if (isset($menu) && is_array($menu)) renderMenu($menu); ?>
                </ul>
            </div>
        </div>
    </nav>
