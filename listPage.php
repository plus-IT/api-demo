<div class="container  main_wrapper">
<div><span class="catalog_container" pagedata="[object Object]" results="" filtervars="[object Object]" side_filters="[object Object]" app_loaded="true" settings="[object Object]"><div class="row"><div class="col-lg-10 col-md-9 col-sm-9"><div class="input-group mb-3"><input type="text" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2" class="form-control"> <div class="input-group-append"><button type="button" class="btn btn-primary"><i class="fas fa-search"></i>Search</button></div></div></div> <div class="col-lg-2 col-md-3 col-sm-3 filter_button"><button id="filter_button" type="button" class="btn btn-primary"><i class="fas fa-filter"></i>Show filters</button></div></div>   <div class="filter_wrapper filter_wrapper_hide"><div class="filter_header"><span class="left_text"><i class="fas fa-filter"></i> Filters
            <span class="float-md-right float-right right_text"><a href="javascript:void(0)">Clear filters</a></span></span></div> <div class="filter_subheader">Seminar Type</div> <div class="contenttype_wrapper"><form><div><!----> <div class="form-group  manager-auto-select   "><!----> <div dir="auto" class="dropdown v-select single searchable"><div class="dropdown-toggle clearfix"> <input type="search" autocomplete="false" placeholder="Seminar Type" aria-label="Search for option" class="form-control" style="width: 100%;"> <button type="button" title="Clear selection" class="clear" style="display: none;"><span aria-hidden="true">×</span></button> <i role="presentation" class="open-indicator"></i> <div class="spinner" style="display: none;">Loading...</div></div> <!----></div></div></div></form></div> <div class="filter_subheader">By date</div> <div class="date_wrapper"><form><div><label style="display: none;"> 
            Start date <!----></label> <div class="form-group form-md-line-input form-md-floating-label edited "><input type="text" id="id_1613111233264_6560" placeholder="Start date" autocomplete="off" name="start_date" class="form-control   "></div></div><div><label style="display: none;"> 
            End date <!----></label> <div class="form-group form-md-line-input form-md-floating-label edited "><input type="text" id="id_1613111233265_56736" placeholder="End date" autocomplete="off" name="end_date" class="form-control   "></div></div></form></div> <div class="filter_subheader">By location </div> <div class="contenttype_wrapper"><form><div><!----> <div class="form-group  manager-auto-select   "><div dir="auto" class="dropdown v-select searchable"><div class="dropdown-toggle clearfix"> <input type="search" autocomplete="false" placeholder="City" aria-label="Search for option" class="form-control" style="width: 100%;"> <button type="button" title="Clear selection" class="clear" style="display: none;"><span aria-hidden="true">×</span></button> <i role="presentation" class="open-indicator"></i> <div class="spinner" style="display: none;">Loading...</div></div> <!----></div> <!----></div></div></form></div> <div><div class="filter_subheader">Categories </div> <div class="contenttype_wrapper"><form><div><!----> <div class="form-group  manager-auto-select   "><div dir="auto" class="dropdown v-select searchable"><div class="dropdown-toggle clearfix"> <input type="search" autocomplete="false" placeholder="Categories" aria-label="Search for option" class="form-control" style="width: 100%;"> <button type="button" title="Clear selection" class="clear" style="display: none;"><span aria-hidden="true">×</span></button> <i role="presentation" class="open-indicator"></i> <div class="spinner" style="display: none;">Loading...</div></div> <!----></div> <!----></div></div></form></div></div> <br> <span class="float-md-right float-right right_text"><a href="javascript:void(0)" style="color: rgb(255, 255, 255);">Hide filters</a></span></div></span> <div id="page-footer"><div id="footer-notice"><div><span class="footer_link_span"><!----> <a target="_blank" href="#"><!----> AGB</a></span><span class="footer_link_span"><span> | </span> <a target="_blank" href="#"><!----> Imprint</a></span><span class="footer_link_span"><span> | </span> <a target="_blank" href="#"><!----> Data protection</a></span><span class="footer_link_span"><span> | </span> <a target="_blank" href="#"><!----> Contact</a></span></div></div></div></div>
            <div id='list'></div>

        </div>
        <?php require_once("./footer.php");?>

    <script type='text/javascript' >
            function renderListItem(data){
                return `<li>
                        <span class="seminar_card">
                            <div class="card">
                                <span style="width: 100%;">
                                    <div class="image_wrapper">
                                     <img src="https://jatin-admin.test-simplyorg-tenant.de/picture/e-learning/${data.id}" alt="seminar image" class="card-img-top"/>
                                     </div>
                                     <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="/simplyorgapiintegration?id=${data.id}">
                                                <i class="fas fa-globe"></i> 
                                                <span>
                                                    <span class="">${data.name}</span>
                                                </span>
                                            </a>
                                         </h5>
                                         <p class="card-text">
                                            <span>Published on: ${data.start_date}</span>
                                         </p>
                                         <p class="card-text"> Category: ${data.event_category.event_category_name}</p>
                                         <p class="card-text"> </p> 
                                         <div class="other_schedule_icon"></div>
                                     </div>
                                </span>
                            </div>
                        </span>
                    </li>`
            }
            function renderList(listNode,data){
                let listData='';
                for(let i=0;i<data.length;i++){
                    listData+=renderListItem(data[i]);
                }
                list=`<span class="search_result_container"><ul>${listData}</ul></span>`;
                listNode.innerHTML=listData;
            }
            function loadList(){
                $.ajax({
                    url:"/simplyorapiintegration?ajax=true&endpoint=CMSSeminarList",
                    success:function(response){
                            response=JSON.parse(response);
                            let listNode=document.getElementById("list");
                              renderList(listNode,response.data);
                    }
                })
            }
            $(document).ready(function(){
                    loadList();
            })
    </script>