<body>
<!-- <body onload="offcanvasOpen()"> -->
    <div class="wrapper">
        <div class="topSection">
            <div class="container mini-container">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center py-2">
                            <div>
                                <a href="<?php echo site_url('more');?>">
                                    <img src="<?php echo site_url();?>assets/front/images/ic_settings.svg" alt=""></a>
                            </div>
                            <div class="heading"><h6><?php echo $this->lang->line('lab_search_text');?> 
                            <span><?php echo $this->lang->line('lab_home_top_search_title');?></span></h6></div>
                            <div>
                                <a class="me-1 cursor-pointer" data-bs-toggle="offcanvas" data-bs-target="#demo1">
                                  <img src="<?php echo site_url();?>assets/front/images/new/lang_hindi_a.svg" alt="">
                                </a>
                                <a class="cursor-pointer" data-bs-target="#demo" data-bs-toggle="offcanvas">
                                  <img src="<?php echo site_url();?>assets/front/images/ic_location.svg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="py-3">

                            <div class="owl-carousel owl-theme">
                                <div class="item">
                                <img src="<?php echo site_url();?>assets/front/images/img_pattern.png" alt="" class="img-fluid">
                                </div>
                                <div class="item">
                                <img src="<?php echo site_url();?>assets/front/images/img_pattern.png" alt="" class="img-fluid">
                                </div>
                                <div class="item">
                                <img src="<?php echo site_url();?>assets/front/images/img_pattern.png" alt="" class="img-fluid">
                                </div>

                            </div>
                           
                        </div>
                        <div class="py-3">
                            <div class="input-group shadow position-relative">
                                <select name="category" id="category" onchange="filter('reset')">
                                    <option value=""><?php echo $this->lang->line('lab_category_text');?></option>
                                    <?php if($categories){ ?>
                                      <?php foreach ($categories as $cat) { ?>
                                        <option value="<?php echo $cat['id'];?>"><?php echo $cat['name'];?></option>
                                    <?php }} ?>
                                </select>
                                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="<?php echo $this->lang->line('input_search_placeholder_text');?>" onchange="filter('reset')">
                                <span class="input-group-text " onclick="filter('reset')">
                                    <img src="<?php echo site_url();?>assets/front/images/ic_search.svg" alt="">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottomSection my-3">
            <div class="container mini-container">
                <div class="row">
                    <div class="col-12 position-relative" id="records">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="footerBtn">
            <div class="container mini-container">
                <div class="row">
                    <div class="col-12">
                        <a href="<?php echo site_url('my_booking');?>" class="position-relative">
                        <span></span>
                        <h4 class="mb-0">
                          <?php echo $this->lang->line('lab_view_booking_text');?>
                        </h4>
                        <img  src="<?php echo site_url();?>assets/front/images/btn_arrow.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>

  <!-- popups -->
    <div class="offcanvas offcanvas-bottom _setLocation" id="demo">
        <div class="offcanvas-header ">
            <h1 class="offcanvas-title"><?php echo $this->lang->line('lab_your_location_text');?></h1>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button> -->
        </div>
        <div class="offcanvas-body py-1">
           <!--  <div class="mb-3">
                <select name="" id="" class="form-control">
                <option value="Select State"><?php echo $this->lang->line('lab_select_state_text');?></option>
                <option value="Madhya pradesh">Madhya pradesh</option>
                <option value="Uttar pradesh">Uttar pradesh</option>

                </select>
            </div>
            <div class="mb-3">
                <select name="" id="" class="form-control">
                    <option value="Select City"><?php echo $this->lang->line('lab_select_city_text');?></option>
                    <option value="Bhopal">Bhopal</option>
                    <option value="Indore">Indore</option>
                </select>
            </div> -->
            <div class="mb-3">
                <input type="text" name="user_address" id="user_address" placeholder="<?php echo $this->lang->line('lab_address_text');?>" class="form-control google_address">
            </div>
            <a class="btn orangeBtn shadow" onclick="closepopup()"> 
                <span></span>
                <h4 class="mb-0"><?php echo $this->lang->line('lab_set_location_title');?></h4>
                <img class="position-absolute right-8" src="<?php echo site_url();?>assets/front/images/btn_arrow.svg" alt="">
            </a>
        </div>
    </div>
    
    <div class="offcanvas offcanvas-bottom _setLocation _langmodal" id="demo1">
        <div class="offcanvas-header ">
            <h1 class="offcanvas-title"><?php echo $this->lang->line('lab_select_language_text');?></h1>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button> -->
        </div>
        <div class="offcanvas-body py-1">
            <?php  
            $siteLang = $this->session->userdata('site_lang'); 
            $sellang = ($siteLang != "") ? $siteLang : "hindi";
            ?>
            <div class="d-flex row my-3 langBtn">
                <div class="mb-3 col-md-6 col-6">

                    <input type="radio" name="lang" value="english" id="eng" class="d-none" <?php echo ($sellang=='english')?'checked':'';?>>
                    <label for="eng" class="btn btn-outline-primary w-100 ">
                        <div>
                            <img src="<?php echo site_url();?>assets/front/images/new/lang_eng_a.svg" alt="a">
                            <img src="<?php echo site_url();?>assets/front/images/new/lang_eng_b.svg" alt="b">
                        </div>
                        <div> <h5 class="mb-0">English</h5></div>
                        <div>&nbsp;</div>     
                    </label>
                </div>
                <div class="mb-3 col-md-6 col-6">
                    <input type="radio" name="lang" value="hindi" id="hindi" class="d-none" <?php echo ($sellang=='hindi')?'checked':'';?>>
                    <label for="hindi" class="btn btn-outline-primary w-100">
                    <div>
                        <img src="<?php echo site_url();?>assets/front/images/new/lang_hindi_a.svg" alt="a">
                        <img src="<?php echo site_url();?>assets/front/images/new/lang_hindi_b.svg" alt="b">
                    </div>
                    <div><h5 class="mb-0">Hindi</h5></div>
                    <div>&nbsp;</div>     
                    </label>
                </div>
            </div>
            <a class="btn orangeBtn shadow" onclick="setLang();">
                <span></span>
                <h4 class="mb-0"><?php echo $this->lang->line('lab_set_language_text');?></h4>
                <img class="position-absolute right-8" src="<?php echo site_url();?>assets/front/images/btn_arrow.svg" alt="">
            </a>
        </div>
    </div>
  </div>
  <!-- END FIRST DIV -->

<style type="text/css">
    div.pac-container {
    z-index: 99999999999 !important;
}
</style>
<script>
  /*offcanvasOpen = ()=>{
   document.querySelector("#demo1").classList.add("show");
  }
  closeCanvas = () => { 
    document.querySelector("#demo1").classList.remove('show')
    var backdrop = document.querySelectorAll('.modal-backdrop');
    backdrop[0].classList.remove('show');
  }*/

  $(".owl-carousel").owlCarousel({
    loop:true
})

</script>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?libraries=places&key=<?php echo PLACES_API_KEY;?>&sensor=false"></script>
<script type="text/javascript">
var options = {
    componentRestrictions: {
        country: 'in'
    }
};
var autocomplete = new google.maps.places.Autocomplete(document.getElementsByClassName('google_address')[0], options);
google.maps.event.addListener(autocomplete, 'place_changed', function () {
    var place = autocomplete.getPlace();
    var lat = place.geometry.location.lat();
    var long = place.geometry.location.lng();
    // console.log(lat+'=='+long)
    // console.log(place)
    // console.log(place.formatted_address)
    var loc=lat+"||"+long+"||"+$('#user_address').val();
    localStorage.setItem("openseatlocation",loc);
    // alert($('#user_address').val())
}); 
function closepopup(){
    // filter('');
    document.querySelector("#demo").classList.remove('show')
    var backdrop = document.querySelectorAll('.modal-backdrop');
    backdrop[0].classList.remove('show');
    location.reload();
}
$(document).ready(function(){
 
    if(localStorage.getItem("openseatlocation")){
        var openseatlocation=localStorage.getItem("openseatlocation");
        openseatlocation=openseatlocation.split("||");
        if(openseatlocation[2]){
            $('#user_address').val(openseatlocation[2]);
            filter('');
        }
    }else{
        document.querySelector("#demo").classList.add("show");
    }
});
var page=0;
// filter('');
function setLang(){
    var val=$("input[name='lang']:checked").val();
    window.location.href="<?php echo site_url('switch_lang');?>/"+val;
}
function filter(type) {
    if(type=='reset'){
        $("#records").html('loading...');
        page=0;
    }
    // $("#loader").show(); 
    var lat="";
    var long="";
    if(localStorage.getItem("openseatlocation")){
        var openseatlocation=localStorage.getItem("openseatlocation");
        openseatlocation=openseatlocation.split("||");
        lat=openseatlocation[0];
        long=openseatlocation[1];
        if(openseatlocation[2]){
            // $('#user_address').val(openseatlocation[2]);
        }
    }

    var category=$("#category").val();
    var keyword=$("#keyword").val();
    $.ajax({
        url: "<?php echo site_url('search');?>",
        type: 'GET',
        data: {keyword:keyword,category:category,lat:lat,long:long,page:page},
        dataType: 'json',
        success:function(resp){
            $("#loader").hide();  
            if(resp.status==1){
                page++;
                $("#records").html('');
                for (var i = resp.list.length - 1; i >= 0; i--) {
                    let rec=resp.list[i];
                    var html=`<!-- <span class="lastvisited">Last Visited</span> -->
                        <a href="${rec.link}" class="card mb-2 r-10 text-decoration-none">
                            <div class="card-body p-2 searchList">
                                <div class="d-flex ">
                                    <div class="me-2 position-relative">
                                        <img src="${rec.logo}" alt=""  class="img-fluid">
                                        <span class="statusclr online"></span>
                                    </div>
                                    <div class="caption">
                                        <h4 class="mb-0">${rec.business_name}</h4>
                                        <p class="mb-0"><span>${rec.fullname}</span><span class=" text-dark"> ${rec.category}</span></p>
                                        <p class="mb-0 justify-content-start">
                                        <span>${rec.address}</span> 
                                        <img  class="img-fluid _locationarrow ms-1" src="<?php echo site_url();?>assets/front/images/new/location_arrow.svg" alt=""></p>
                                    </div>
                                </div>
                            </div>
                        </a>`;
                    $("#records").append(html);
                }
            }else{
                $("#records").html(`<?php echo $this->lang->line('err_no_data');?>`);
            }
        },
        error:function(err){
            $("#records").html('');
            $("#loader").hide();
            // swal("error","Something went wrong. Please refresh page.");
        }
    });
}


</script>
<script src="<?php echo site_url('assets/front/js/owl.carousel.min.js');?>"></script>
<script>
    $(document).ready(function(){
$(".owl-carousel").owlCarousel({
    items:1,
    dots:true,
    nav:false,
    margin:10
})
});
</script>