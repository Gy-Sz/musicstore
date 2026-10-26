<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [

                    //['label' => 'Products', 'header'=>true],    
                    ['label' => 'Products', 'icon' => 'cube', 'url' => ['product/index']],
                    ['label' => 'Orders', 'icon' => 'box', 'url' => ['order/index']],
                    
                    //['label' => 'Prices', 'icon' => 'tag', 'url' => ['price/index']],

                    ['label' => 'Catalog', 'header'=>true],
                    ['label' => 'Artists', 'icon' => 'microphone', 'url' => ['artist/index']],
                    ['label' => 'Releases', 'icon' => 'music', 'url' => ['release/index']],

                    ['label' => 'Maintenance', 'header'=>true],
                    ['label' => 'Product Medias', 'icon' => 'th', 'url' => ['product-media/index']],
                    ['label' => 'Release Types', 'icon' => 'th', 'url' => ['release-type/index']],
                    ['label' => 'Order Statuses', 'icon' => 'th', 'url' => ['order-status/index']],
                    
                    
                    ['label'=>'DevTools', 'header'=>true],
                    ['label'=>'gii', 'icon'=>'file-code', 'url'=>['/gii'], 'target'=>'_blank'],
                    //['label'=>'Swagger', 'icon'=>'file-code', 'url'=>['/swagger']],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>