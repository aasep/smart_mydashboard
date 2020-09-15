 
<!-- dropdown dropdown-fw dropdown-fw-disabled  active open selected -->
<!-- dropdown more-dropdown-sub active -->
<?php
    if (isset($_GET['pm']) && $_GET['pm'] !=""){
                $active_parent=($_GET['pm']);
                $activeHome="";
        } else {
                $active_parent="";
                   
                 $activeHome="active open selected";
            }
        // active sub menu
        if (isset($_GET['module']) && $_GET['module'] !=""){
                $active_submenu=($_GET['module']);
                
                //$active_submenu=$crypt->decrypt($_GET['module']);
        } else {
                $active_submenu=""; 
               
            }



?>


 <div class="nav-collapse collapse navbar-collapse navbar-responsive-collapse">
                            <ul class="nav navbar-nav">

                                <li class="dropdown dropdown-fw dropdown-fw-disabled <?php echo $activeHome;?>">
                                    <a href="home" class="text-uppercase">
                                        <i class="icon-home"></i><span class="title bold"> Home </span></a>
                                      <ul class="dropdown-menu dropdown-menu-fw">
                                        <li>
                                            <!-- <a href="index.html">
                                                <i class="icon-home"></i> HOME </a> -->
                                        </li>
                                        
                                    </ul>  
                                </li>
<?php





                        $parent_count=0;
                        $SQL=" SELECT distinct (a.parentmenu) FROM smart_menu a, smart_group_menu b WHERE a.idmenu=b.idmenu AND b.groupid=$_SESSION[GROUP_USER]  ";
                        
                        //echo $SQL."<br>";
                        //die();
                        $RS  = $db->Execute($SQL);
                
                        if(!empty($RS->fields['parentmenu'])){
                    
                                $num = $RS->RecordCount();

                                while(!$RS->EOF){

                                            $class_parent = "";
                                            $parent_menu = $RS->fields['parentmenu'] ;
                                            if ($active_parent == sha1($parent_menu) && $parent_menu!="") { 
                                                $class_parent="dropdown dropdown-fw dropdown-fw-disabled  active open selected"; 
                                            } else{
                                                $class_parent="dropdown dropdown-fw dropdown-fw-disabled"; 
                                            }

                                            $SQL2=" SELECT menuname,icon FROM smart_menu WHERE idmenu='$parent_menu' and parentmenu='0' ";
                                            //echo $SQL2."<br>";
                                            //die();
                                            $RS2  = $db->Execute($SQL2);
                                            #### DISPLAY PARENT
                                            if(!empty($RS2->fields['menuname'])){

                                                echo "<li class='$class_parent' ><a href='#' class='text-uppercase'><i class='".$RS2->fields['icon']."'></i><span class='title bold'>". $RS2->fields['menuname'] ." </span></a>";


                                                $SQL3 =" SELECT distinct (a.menuname), a.idmenu,a.icon,a.urut  FROM smart_menu a, smart_group_menu b WHERE a.idmenu=b.idmenu ";
                                                $SQL3.=" AND b.groupid=$_SESSION[GROUP_USER]  AND a.parentmenu='$parent_menu' order by a.urut asc ";
                                                $RS3  = $db->Execute($SQL3);
                                            }

                                            
                                            //echo $SQL3."<br>";
                                            
                                            if(!empty($RS3->fields['menuname'])){

                                                $num2 = $RS3->RecordCount();
                                                //echo $num2;
                                                //die();
                                                if ($num2 >= 1 ) {
                                                    echo "<ul class='dropdown-menu dropdown-menu-fw'>";
                                                    while(!$RS3->EOF) {
                                                            $class_submenu="";
                                                             if ($active_submenu == sha1($RS3->fields['idmenu']) && $active_submenu!="") {
                                                                $class_submenu="dropdown more-dropdown-sub active";
                                                             }else{
                                                                $class_submenu="dropdown more-dropdown-sub";
                                                             } 
                                                            
                                                                 echo "<li  ><a href='home?module=".sha1($RS3->fields['idmenu'])."&pm=".sha1($parent_menu)."'><i class='".$RS3->fields['icon']."'></i> <span class='title bold'> ".$RS3->fields['menuname']."</span></a></li>";
                                                              

                                                        $RS3->MoveNext();

                                                    }

                                                    echo "</ul>";
                                                }

                                            }
                                        
                                    echo "</li>";
                                    $parent_count++;
                                    $RS->MoveNext();
                                }


                        }





?>


                                <!-- <li class="dropdown dropdown-fw dropdown-fw-disabled  ">
                                    <a href="javascript:;" class="text-uppercase">
                                        <i class="icon-home"></i> Dashboard </a>
                                    <ul class="dropdown-menu dropdown-menu-fw">
                                        <li>
                                            <a href="index.html">
                                                <i class="icon-bar-chart"></i> Default </a>
                                        </li>
                                        <li>
                                            <a href="dashboard_2.html">
                                                <i class="icon-bulb"></i> Dashboard 2 </a>
                                        </li>
                                        <li>
                                            <a href="dashboard_3.html">
                                                <i class="icon-graph"></i> Dashboard 3 </a>
                                        </li>
                                    </ul>
                                </li> -->


                                <!-- <li class="dropdown more-dropdown">
                                    <a href="javascript:;" class="text-uppercase"> More </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="#">Link 1</a>
                                        </li>
                                        <li>
                                            <a href="#">Link 2</a>
                                        </li>
                                        <li>
                                            <a href="#">Link 3</a>
                                        </li>
                                        <li>
                                            <a href="#">Link 4</a>
                                        </li>
                                        <li>
                                            <a href="#">Link 5</a>
                                        </li>
                                    </ul>
                                </li> -->
                            </ul>
                        </div>