<nav class="main-sidebar ps-menu">
    <!-- <div class="sidebar-toggle action-toggle">
        <a href="#">
            <i class="fas fa-bars"></i>
        </a>
    </div> -->
    <!-- <div class="sidebar-opener action-toggle">
        <a href="#">
            <i class="ti-angle-right"></i>
        </a>
    </div> -->
    <div class="sidebar-header">
        <div class="text">AR</div>
        <div class="close-sidebar action-toggle">
            <i class="ti-close"></i>
        </div>
    </div>
    <div class="sidebar-content">
        <ul>
            <li class="active">
                <a href="index.html" class="link">
                    <i class="ti-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @foreach (menus() as $category => $menus)
                <li class="menu-category">
                    <span class="text-uppercase">{{ $category }}</span>
                </li>

                @foreach ($menus as $mm)
                    <li>
                        <a href="#" class="main-menu has-dropdown">
                            <i class="ti-{{ $mm->icon }}"></i>
                            <span>{{ $mm->name }}</span>
                        </a>
                        <ul class="sub-menu ">
                            @foreach ($mm->subMenus as $sm)
                                <li><a href="{{ $sm->url }}" class="link"><span>{{ $sm->name }}</span></a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            @endforeach
            
        </ul>
    </div>
</nav>
