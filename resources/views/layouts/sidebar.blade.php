<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item"><a href="{{ route('home') }}"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>
        </li>
        <li class=" nav-item"><a href="#"><i class="la la-television"></i><span class="menu-title" data-i18n="nav.templates.main">Inventory</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="#" data-i18n="nav.templates.horz.main">Customers</a>
              <ul class="menu-content">
                <li><a class="menu-item" href="{{ route('customer.index') }}" data-i18n="nav.templates.horz.classic">Data</a>
                </li>
                <li><a class="menu-item" href="{{ route('customer.create') }}" data-i18n="nav.templates.horz.top_icon">Add New</a>
                </li>
              </ul>
            </li>
            <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">Master Part Name</a>
              <ul class="menu-content">
                <li><a class="menu-item" href="{{ route('satuan.index') }}" data-i18n="nav.templates.vert.classic_menu">Unit</a>
                </li>
                <li><a class="menu-item" href="{{ route('category.index') }}" data-i18n="nav.templates.vert.classic_menu">Category</a>
                </li>
                <li><a class="menu-item" href="{{ route('partnamectr.index') }}" data-i18n="nav.templates.vert.classic_menu">List Part Name</a>
                </li>
              </ul>
            </li>
            <li><a class="menu-item" href="#" data-i18n="nav.templates.horz.main">Good Receipt</a>
              <ul class="menu-content">
                <li><a class="menu-item" href="#" data-i18n="nav.templates.horz.classic">Transaksi</a>
                </li>
                <li><a class="menu-item" href="{{ route('goodreceipt.index') }}" data-i18n="nav.templates.horz.top_icon">Record</a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li class=" nav-item"><a href="#"><i class="la la-archive"></i><span class="menu-title" data-i18n="nav.dash.main">Shipping</span></a>
        </li>
      </ul>
    </div>
  </div>