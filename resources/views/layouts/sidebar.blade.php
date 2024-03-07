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
                @php
                    $showCategory = true;
                @endphp
                @foreach ($menus as $mm)
                    @can('read ' . $mm->url)
                        @if ($showCategory)
                            <li class="menu-category">
                                <span class="text-uppercase">{{ $category }}</span>
                            </li>
                            @php
                                $showCategory = false;
                            @endphp
                        @endif
                        <li @class(['active open' => str_contains(request()->path(), $mm->url)])>
                            @if (count($mm->subMenus))
                                <a href="#" class="main-menu has-dropdown">
                                    <i class="ti-{{ $mm->icon }}"></i>
                                    <span>{{ $mm->name }}</span>
                                </a>
                                <ul @class(['sub-menu', 'expand' => str_contains(request()->path(), $mm->url)])>
                                    @foreach ($mm->subMenus as $sm)
                                        @can('read ' . $sm->url)
                                            <li @class(['active' => str_contains(request()->path(), $sm->url)])>
                                                <a href="{{ url($sm->url) }}"class="link">
                                                    <span>{{ $sm->name }}</span>
                                                </a>
                                            </li>
                                        @endcan
                                    @endforeach
                                </ul>
                            @else
                                <a href="{{ url($mm->url) }}" class="link">
                                    <i class="ti-{{ $mm->icon }}"></i>
                                    <span>{{ $mm->name }}</span>
                                </a>
                            @endif

                        </li>
                    @endcan
                @endforeach
            @endforeach

        </ul>
    </div>
</nav>
