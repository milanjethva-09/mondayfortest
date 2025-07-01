<?php
$current = $_SERVER['REQUEST_URI'];
function isActive($slug) {
    global $current;
    return str_starts_with($current, $slug) ? ' active' : '';
}
?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-white" id="sidenav-main">

  <!-- Brand -->
  <div class="sidenav-header d-flex flex-column align-items-start p-3 mb-2">
    <span class="fw-bold" style="font-size:2rem;color:#000;">MONDAY</span>
    <span style="font-size:.95rem;color:#888;margin-top:.25rem;">by milan jethva</span>
  </div>
  <hr class="horizontal dark mt-0 mb-2">

  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">

      <!-- Dashboard -->
      <li class="nav-item mb-2">
        <a class="nav-link d-flex align-items-center<?= isActive('/dashboard') ?>" href="/dashboard">
          <span class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center" style="width:32px;height:32px;">
            <i class="material-icons opacity-10" style="font-size:1.4rem;color:#000;">dashboard</i>
          </span>
          <span class="nav-link-text ms-1" style="color:#000;">Dashboard</span>
        </a>
      </li>

      <!-- Costing -------------------------------------------------->
      <li class="nav-item mb-2">
        <a class="nav-link d-flex align-items-center" data-bs-toggle="collapse" href="#costingMenu" aria-expanded="false" aria-controls="costingMenu">
          <span class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center" style="width:32px;height:32px;">
            <i class="material-icons opacity-10" style="font-size:1.4rem;color:#000;">calculate</i>
          </span>
          <span class="nav-link-text ms-1" style="color:#000;">Costing</span>
          <i class="material-icons ms-auto">expand_more</i>
        </a>
        <div class="collapse" id="costingMenu">
          <ul class="nav flex-column ms-4">
            <li class="nav-item"><a class="nav-link" href="/costing/detailed" style="color:#000;">Detailed Costing</a></li>
            <li class="nav-item"><a class="nav-link" href="/costing/quick" style="color:#000;">Quick Costing</a></li>
            <li class="nav-item"><a class="nav-link" href="/costing/past" style="color:#000;">View Past Costing</a></li>
            <li class="nav-item"><a class="nav-link" href="/costing/amazon" style="color:#000;">Amazon</a></li>
            <li class="nav-item"><a class="nav-link" href="/costing/flipkart" style="color:#000;">Flipkart</a></li>
            <li class="nav-item"><a class="nav-link" href="/costing/meesho" style="color:#000;">Meesho</a></li>
            <li class="nav-item"><a class="nav-link" href="/costing/shopsy" style="color:#000;">Shopsy</a></li>
            <li class="nav-item"><a class="nav-link" href="/costing/myntra" style="color:#000;">Myntra</a></li>
          </ul>
        </div>
      </li>

      <!-- Inventory & SKU ----------------------------------------->
      <li class="nav-item mb-2">
        <a class="nav-link d-flex align-items-center" data-bs-toggle="collapse" href="#stockSkuMenu" aria-expanded="false" aria-controls="stockSkuMenu">
          <span class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center" style="width:32px;height:32px;">
            <i class="material-icons opacity-10" style="font-size:1.4rem;color:#000;">inventory</i>
          </span>
          <span class="nav-link-text ms-1" style="color:#000;">Inventory</span>
          <i class="material-icons ms-auto">expand_more</i>
        </a>
        <div class="collapse" id="stockSkuMenu">
          <ul class="nav flex-column ms-4">
            <li class="nav-item"><a class="nav-link" href="/stock/sellers" style="color:#000;">Sellers</a></li>
            <li class="nav-item"><a class="nav-link" href="/stock/brands" style="color:#000;">Brands</a></li>
            <li class="nav-item"><a class="nav-link" href="/stock/productLines" style="color:#000;">Product Lines</a></li>
            <li class="nav-item"><a class="nav-link" href="/stock/products" style="color:#000;">Main Products</a></li>
            <li class="nav-item"><a class="nav-link" href="/stock/variations" style="color:#000;">Variations</a></li>
            <li class="nav-item"><a class="nav-link" href="/stock/skuGenerator" style="color:#000;">SKU Generation</a></li>
            <li class="nav-item"><a class="nav-link" href="/stock/mastersku" style="color:#000;">Master SKUs</a></li>
            <li class="nav-item"><a class="nav-link" href="/stock/map" style="color:#000;">Marketplace SKU Mapping</a></li>
            <li class="nav-item"><a class="nav-link" href="/stock/inventory" style="color:#000;">Inventory Overview</a></li>
          </ul>
        </div>
      </li>

      <!-- Code Masters -------------------------------------------->
      <li class="nav-item mb-2">
        <a class="nav-link d-flex align-items-center" data-bs-toggle="collapse" href="#codeMenu" aria-expanded="false" aria-controls="codeMenu">
          <span class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center" style="width:32px;height:32px;">
            <i class="material-icons opacity-10" style="font-size:1.4rem;color:#000;">code</i>
          </span>
          <span class="nav-link-text ms-1" style="color:#000;">Code Masters</span>
          <i class="material-icons ms-auto">expand_more</i>
        </a>
        <div class="collapse" id="codeMenu">
          <ul class="nav flex-column ms-4">
            <li class="nav-item"><a class="nav-link" href="/stock/brandCodes" style="color:#000;">Brand Codes</a></li>
            <li class="nav-item"><a class="nav-link" href="/stock/classCodes" style="color:#000;">Class Codes</a></li>
            <li class="nav-item"><a class="nav-link" href="/stock/categoryCodes" style="color:#000;">Category Codes</a></li>
            <li class="nav-item"><a class="nav-link" href="/stock/skuGenerator" style="color:#000;">SKU Generation</a></li>
          </ul>
        </div>
      </li>

      <!-- Tables -->
      <li class="nav-item mb-2">
        <a class="nav-link d-flex align-items-center<?= isActive('/tables') ?>" href="/tables">
          <span class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center" style="width:32px;height:32px;">
            <i class="material-icons opacity-10" style="font-size:1.4rem;color:#000;">table_view</i>
          </span>
          <span class="nav-link-text ms-1" style="color:#000;">Tables</span>
        </a>
      </li>

      <!-- Billing -->
      <li class="nav-item mb-2">
        <a class="nav-link d-flex align-items-center<?= isActive('/billing') ?>" href="/billing">
          <span class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center" style="width:32px;height:32px;">
            <i class="material-icons opacity-10" style="font-size:1.4rem;color:#000;">receipt_long</i>
          </span>
          <span class="nav-link-text ms-1" style="color:#000;">Billing</span>
        </a>
      </li>

    </ul>
  </div>

  <div class="sidenav-footer mx-3">
    <a class="btn bg-gradient-dark mt-4 w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard">
      Documentation
    </a>
  </div>
</aside>
