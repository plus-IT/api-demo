<?php require_once("./header.php"); ?>


<div class="container  main_wrapper" id='details'>


</div>

        <?php require_once("./footer.php");?>
    <script type='text/javascript' >
            function renderSeminarDetails(data){

               return  `
               <div class="container  main_wrapper">
   <div>
      <div pagedata="{}" results="" filtervars="" side_filters="" settings="">
         <div class="row">
            <div class="col-md-8">
               <div class="header_wrapper"></div>
               <h5 class="event_name">${data.event_name}</h5>
            </div>
            <div class="col-md-4">
               <div class="button_wrapper">
                  <span>
                     <button id="" type="button" class="btn btn-primary float-right"><i class="fas fa-shopping-cart"></i> Book </button> <!---->
                  </span>
                  <button id="" type="button" class="btn btn-primary float-right" style="display: none;"><i class="fas fa-shopping-cart"></i> Remove from cart </button> <!---->
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-3 col-sm-4 col-xs-12">
               <div class="left_panel_header"> Seminar details </div>
               <table class="table no-border">
                  <tbody>
                     <tr>
                        <td>Date:</td>
                        <td><span>
                        ${data.event_startdate}
                           </span>
                        </td>
                     </tr>
                     <tr>
                        <td>Time:</td>
                        <td>
                           ${data.schedule_time.start_time}-${data.schedule_time.end_time} 
                        </td>
                     </tr>
                     <tr>
                        <td>Location:</td>
                        <td></td>
                     </tr>
                     <tr class="event_fees">
                        <td>Fees:</td>
                        <td>${data.event_price} €</td>
                     </tr>
                     <!----> <!----> <!---->
                  </tbody>
               </table>
               <div class="left_panel_header">Trainer details</div>
            </div>
            <div class="col-lg-9 col-sm-8 col-xs-12">
               <div class="about_event_wrapper">
                  <div class="right_header">
                     <h6>Description</h6>
                  </div>
                  <p class="text-justify" style="min-height: 300px;">
                     <img src="https://jatin-admin.test-simplyorg-tenant.de//picture/event/${data.id}" class="detail_event_pic" style="max-height: 300px;"> <span></span> 
                     <span style="width: 100%; float: left; padding-top: 10px; display: contents;">
                        <!----> 
                        <span>
                           <span>
                              <span>
                                 <button id="" type="button" class="btn btn-primary cart_button_fixed"><i class="fas fa-shopping-cart"></i> Book </button> <!---->
                              </span>
                              <button id="" type="button" class="btn btn-primary cart_button_fixed" style="display: none;"><i class="fas fa-shopping-cart"></i> Remove from cart </button>
                           </span>
                        </span>
                     </span>
                  </p>
               </div>
               <div class="target_group_wrapper">
                  <!----> <!----> <!----> <!---->
               </div>
               
            </div>
         </div>
         <div id="waitingListFeatureMessage" role="dialog" data-toggle="modal" class="modal fade">
            <div class="modal-dialog modal-lg">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" data-dismiss="modal" class="close">×</button> 
                     <h4 class="modal-title">Add Participants</h4>
                  </div>
                  <div class="modal-body">
                     <div>
                        We apologize for the inconvenience. All seats of this seminar is fully booked. please check after some time
                     </div>
                  </div>
                  <!---->
               </div>
            </div>
         </div>
      </div>
      <div id="page-footer">
         <div id="footer-notice">
            <div>
               <span class="footer_link_span">
                  <!----> 
                  <a target="_blank" href="#">
                     <!----> AGB
                  </a>
               </span>
               <span class="footer_link_span">
                  <span> | </span> 
                  <a target="_blank" href="#">
                     <!----> Imprint
                  </a>
               </span>
               <span class="footer_link_span">
                  <span> | </span> 
                  <a target="_blank" href="#">
                     <!----> Data protection
                  </a>
               </span>
               <span class="footer_link_span">
                  <span> | </span> 
                  <a target="_blank" href="#">
                     <!----> Contact
                  </a>
               </span>
            </div>
         </div>
      </div>
   </div>
</div>
               `
            }
            function loadSeminar(id){
                $.ajax({
                    url:"/simplyorapiintegration?ajax=true&endpoint=CMSSeminarList/"+id+"&Type=Seminar",
                    success:function(response){
                            response=JSON.parse(response);
                            let details=document.getElementById("details");
                            details.innerHTML=renderSeminarDetails(response.data);
                    }
                })
            }
            $(document).ready(function(){
                    loadSeminar(<?php echo $_GET["id"]?>)
            })
    </script>