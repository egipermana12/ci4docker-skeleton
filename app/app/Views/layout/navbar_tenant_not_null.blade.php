<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid container-hight-two">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item me-3">
                    <a class="nav-link {{service('uri')->getSegment(1) == 'dashboard' ? 'active' : '' }}"
                        aria-current="page" href="<?= base_url('dashboard') ?>">Dashboard</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link {{service('uri')->getSegment(1) == 'tenants' ? 'active' : '' }}"
                        href="{{base_url('tenants')}}">Tenants</a>
                </li>
                <li class="nav-item me-3 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Page
                    </a>
                    <ul class="dropdown-menu dropdown-menu-custom">
                        <li><a class="dropdown-item" href="#">About</a></li>
                        <li><a class="dropdown-item" href="#">Our Team</a></li>
                        <li><a class="dropdown-item" href="#">Contac Us</a></li>
                    </ul>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" href="#">Help</a>
                </li>
            </ul>
        </div>
    </div>
</nav>