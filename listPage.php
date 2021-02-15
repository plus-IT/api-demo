<div class="container  main_wrapper">
<div>
   <span class="catalog_container" pagedata="[object Object]" results="" filtervars="[object Object]" side_filters="[object Object]" app_loaded="true" settings="[object Object]">
      <div class="row">
         <div class="col-lg-10 col-md-9 col-sm-9">
         <h1>Simplyorg Api Demo</h1>
         </div>
      </div>
   </span>
</div>
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
                                            <a href="/?id=${data.id}">
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
            function handleSearch(){
                let q=$("searchBox").val;
                if(q!=''){
                    this.loadList(q);
                }
            }

            function renderList(listNode,data){
                let listData='';
                for(let i=0;i<data.length;i++){
                    listData+=renderListItem(data[i]);
                }
                list=`<span class="search_result_container"><ul>${listData}</ul></span>`;
                listNode.innerHTML=listData;
            }
            function loadList(q=''){
                $.ajax({
                    url:"/?ajax=true&endpoint=CMSSeminarList"+q,
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