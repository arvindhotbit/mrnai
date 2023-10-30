<?php if($this->session->userdata('user_type')=='Super Admin' || $this->session->userdata('user_type')=='Admin'){ ?>
    <div class="content-wrapper">
        <section class="content-header">
            <h1> Dashboard </h1>
            <ol class="breadcrumb">

                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        <section class="content">
          
        </section>
    </div> 
<?php }else{ ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1> Dashboard </h1>
        <ol class="breadcrumb">

            <?php foreach ($breadcrumbs as  $breadcrumb) { ?>
                <li class="<?php echo $breadcrumb['class'];?>"> 
                    <?php if(!empty($breadcrumb['link'])) { ?>
                        <a href="<?php echo $breadcrumb['link'];?>"><?php echo $breadcrumb['icon'].$breadcrumb['title'];?></a>
                    <?php } else {
                        echo $breadcrumb['icon'].$breadcrumb['title'];
                    } ?>
                </li>
            <?php }?>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="box">
                <div class="box-header with-border">  
                    <div class="box-body">
                    	<h4 style="text-align: center;">You do not have permission to view this section.</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php } ?>
