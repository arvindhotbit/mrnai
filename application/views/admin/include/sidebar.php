<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?php $sidemenulist=get_sidemenu();?>
        <ul class="sidebar-menu">
        <?php foreach ($sidemenulist as $sidemenu) { ?>
            <li class="treeview">
                <a href="<?php echo base_url().$sidemenu['link']; ?>">
                    <i class="<?php echo $sidemenu['icon']; ?>"></i> <span><?php echo $sidemenu['name']; ?></span>
                    <?php if(!empty($sidemenu['children'])) { ?>
                     <i class="fa fa-angle-right pull-right"></i>
                    <?php } ?>
                </a>
                <?php if(!empty($sidemenu['children'])) { ?>
                    <ul class="treeview-menu"> 
                        <?php foreach ($sidemenu['children'] as $submenu) { ?>
                        <li>
                            <a href="<?php echo base_url().$submenu['link']; ?>">
                                <i class="<?php echo $submenu['icon']; ?>"></i> <span><?php echo $submenu['name']; ?></span> 
                            </a> 
                        </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </li> 

        <?php } ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>