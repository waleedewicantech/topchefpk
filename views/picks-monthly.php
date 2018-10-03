<?php
include_once '../api/constants.php';
include_once '../api/menus.php';
$menu = new Menus();

$monthlyMenus= $menu->getMonthlyMenuByType('WMP_M');
$menus = $monthlyMenus->menus;  
for($i=0;$i<count($menus);$i++){
?>
<div class="col-sm-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title underline-menu"><?php echo $menus[$i]->title; ?></h4>
            <p style="text-align:right;">PRICE/HEAD:<?php echo $menus[$i]->price; ?></p>
                <div class="card-text">
                    <p><?php echo $menus[$i]->description;  ?></p>
                </div>
                <div class="row">
                    <div class="col-sm-6" style="text-align: center">
                        <a class="href-btn" href="#" data-toggle="modal" data-target="#patients-modal-<?php echo $menus[$i]->menu_id;?>">View Detail</a>
                    </div>
                    <div class="col-sm-6" style="text-align: center">
                        <a class="href-btn" href="#">Add cart</a>
                    </div>
                </div>
        </div>
    </div>
</div>

<div class="modal" id="patients-modal-<?php echo $menus[$i]->menu_id;?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                    
                                    <div class="modal-header">
                                        <h4 class="modal-title"><?php echo $menus[$i]->title;?></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                    
                                    <div class="modal-body">
                                        <table class="table table-monthly">
                                            <tr>
                                                <th></th>
                                                <th> Monday </th>
                                                <th> Tuesday </th>
                                                <th> Wednesday </th>
                                                <th> Thursday </th>
                                                <th> Friday </th>
                                                <th> Saturday </th>
                                                <th> Sunday </th>
                                            </tr>
                    
                                            <tr>
                                                <td>Week 1</td>
                                                <td><?php echo $menus[$i]->menu->week1[0]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week1[1]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week1[2]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week1[3]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week1[4]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week1[5]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week1[6]; ?></td>
                                            </tr>
                    
                                            <tr>
                                                <td> Week 2 </td>
                                                <td><?php echo $menus[$i]->menu->week2[0]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week2[1]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week2[2]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week2[3]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week2[4]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week2[5]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week2[6]; ?></td>
                                            </tr>
                    
                                            <tr>
                                                <td> Week 3 </td>
                                                <td><?php echo $menus[$i]->menu->week3[0]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week3[1]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week3[2]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week3[3]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week3[4]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week3[5]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week3[6]; ?></td>
                                            </tr>
                    
                                            <tr>
                                                <td> Week 4 </td>
                                                <td><?php echo $menus[$i]->menu->week4[0]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week4[1]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week4[2]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week4[3]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week4[4]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week4[5]; ?></td>
                                                <td><?php echo $menus[$i]->menu->week4[6]; ?></td>
                                            </tr>
                    
                    
                                        </table>
                                    </div>
                    
                                </div>
                            </div>
                        </div>
<?php
}

?>