<?php
session_start();
include_once('includes/config.php');
if (!isset($_SESSION['id'])) {

    header('location:index.php');
}
?>  
<?php include_once('includes/header.php'); ?>
<?php include_once('includes/menu.php'); ?>
<?php if (!isset($_GET['action']) & !isset($_GET['type'])) { ?>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="content-main">	
            <div class="banner">
                <h2>
                    <a href="home.php">Home</a>
                    <i class="fa fa-angle-right"></i>
                    <span>Countries</span>
                </h2>
            </div>
            <div class="grid-system">
                <div class="horz-grid">
                    <div class="grid-system">

                        <div class="horz-grid">
                            <div class="bs-example">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><h1 id="h1.-bootstrap-heading"> COUNTRIES - [<?php
                                                    $select = mysql_query("SELECT * FROM r_country order by id_country  desc")or die(mysql_error());
                                                    $count = mysql_num_rows($select);
                                                    echo "$count";
                                                    ?>]</h1></td>
                                            <td class="type-info text-right">
                                                <a href="country.php?action=add"><span class="btn btn-success">Add New</span></a> 
                                                <a><span class="btn btn-primary">Edit</span></a>
                                                <a><span class="btn btn-danger">Delete</span></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <form action="country.php?type=search" method="post">
                                <table class="table"> 

                                    <tr class="table-row">
                                        <td class="table-img">&nbsp;</td>
                                        <td class="march"><h6><input class="form-control" type="text" name="search"></h6></td>
                                        <td class="march"><h6><input class="btn btn-default" type="submit"  ></h6></td>                                
                                        <!--<td class="table-text"><h6>Password</h6></td>
                                                <td class="table-text"><h6>Skills</h6></td>
                                        <td class="table-text"><h6>Country</h6></td>-->
                                    </tr>

                                    <tr class="table-row">
                                        <td class="table-img">
                                            <input type="checkbox" id="selectall" onClick="selectAll(this)" >
                                        </td>
                                        <td class="table-text"><h6>Country's</h6></td>
                                        <td class="march"> Action </td>
                                    </tr>
                                    <?php
                                    $page = false;
                                    if (array_key_exists('page', $_GET)) {
                                        $page = $_GET['page'];
                                    }
                                    //  $page = $_GET["page"];
                                    if ($page == "" || $page == 1) {
                                        $page1 = 0;
                                    } else {
                                        $page1 = ($page * 5) - 5;
                                    }
                                    $select = mysql_query("SELECT * FROM r_country order by id_country desc limit $page1,5")or die(mysql_error());
                                    if ($select) {
                                        while ($row = mysql_fetch_assoc($select)) {
                                            ?>
                                            <tr class="table-row">
                                                <td class="table-img"><input type="checkbox" name="colors[]"></td>
                                                <td class="march"><h6><?=$row["name"] ?></h6></td>

                                                <td><a href="country.php?id=<?= $row["id_country"] ?>&action=edit&page=<?echo "$page"?>"><span class="label label-primary">Edit</span><a/>
                                                        <a href="country-controller.php?id=<?= $row["id_country"] ?>&action=delete&page=<?echo "$page"?>""><span class="label label-info">Delete</span></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </table>
                            </form>
                            <?php
                            $res1 = mysql_query("SELECT * FROM r_country");
                            $count = mysql_num_rows($res1);
                            //echo "$count";
                            $a = $count / 5;
                            $a = ceil($a);
							 if ($count > 5) {
                            ?>
                            <div class="horz-grid text-center">
                                <ul class="pagination pagination-lg">
                                    
                                    <?php for ($b = 1; $b <= $a; $b++) { ?>
                                        <?php if ($b == $page) { ?>
                                            <li class="active"><a href="country.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a></li>    
                                        <?php } else { ?>
                                            <li><a href="country.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a></li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
							 <? } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    <?php }// show all users ends here?>
    <?php
    if (isset($_GET['action'])) {
        ?>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="content-main">
                <div class="banner">
                    <h2>
                        <a href="home.php">Home</a>
                        <i class="fa fa-angle-right"></i>
                        <span><a href="country.php">Countries</a></span>
                        <i class="fa fa-angle-right"></i>
                        <span><?php echo ($_GET['action'] == 'edit') ? 'Edit Country' : 'Add Country'; ?></span>
                    </h2>
                </div>
                <div class="grid-system">
                    <div class="horz-grid">
                        <div class="grid-hor">
                            <h4 id="grid-example-basic">Country Details:</h4>

                        </div>
                        <?php
                        if ($_GET['action'] == "edit") {
                            $id = $_GET['id'];
                            $page = $_GET['page'];
                            $query = mysql_query("select * from r_country where id_country=$id")or die(mysql_error());
                            $result = mysql_fetch_assoc($query);
                            ?>
                            <form class="form-horizontal" action="country-controller.php" method="post">
                                <input type="hidden" name="action" value="edit"/>
                                <input type="hidden" name="id" value="<?= $result["id_country"] ?>">
                                <input type="hidden" name="page" value='<? echo "$page"?>'>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label hor-form" for="inputEmail3">Country</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="country" class="form-control" id="country" value="<?= $result["name"] ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <input type="submit" value="ADD" class="btn-primary btn">
                                        <!--<button class="btn btn-default" type="reset">Reset</button>-->
                                    </div>
                                </div>	
                            </form>
                            <?php
                        } elseif ($_GET['action'] == "add") {
                            ?>
                            <form class="form-horizontal" action="country-controller.php" method="post">
                                <input type="hidden" name="action" value="add"/>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label hor-form" for="inputEmail3">Country Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="country" id="country" >
                                    </div>
                                </div>	
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2"><br>
                                        <input type="submit" value="Insert" class="btn-primary btn">
										<!--<button class="btn btn-default" type="reset">Reset</button>-->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }// end of add
        }// end of action set edit/add
        ?>
        <?php
        if (isset($_GET['type']) && $_GET['type'] == "search") {
            $search = $_POST['search'];
            //echo "$search";
            //exit;
            $query = mysql_query("SELECT * FROM `r_country` WHERE CONCAT( `country`) LIKE '%" . $search . "%' ")or die(mysql_error());
            ?>


            <div id="page-wrapper" class="gray-bg dashbard-1">
                <div class="content-main"> 
                    <div class="banner">
                        <h2>
                            <a href="home.php">Home</a>
                            <i class="fa fa-angle-right"></i>
                            <span>Countries</span>
                        </h2>
                    </div>
                    <div class="grid-system">
                        <div class="horz-grid">
                            <div class="grid-system">
                                <div class="horz-grid">
                                    <div class="bs-example">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><h1 id="h1.-bootstrap-heading"> Countries - [<?php
                                                            $select = mysql_query("SELECT * FROM `r_country` WHERE CONCAT( `country`) LIKE '%" . $search . "%' ")or die(mysql_error());
                                                            $count = mysql_num_rows($select);
                                                            echo "$count";
                                                            ?>]</h1></td>
                                                    <td class="type-info text-right">
                                                        <a href="category.php?action=add"><span class="btn btn-success">Add New</span></a> 
                                                        <a><span class="btn btn-primary">Edit</span></a>
                                                        <a><span class="btn btn-danger">Delete</span></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <form action="country.php?type=search" method="post">
                                        <table class="table"> 

                                            <tr class="table-row">
                                                <td class="table-img">&nbsp;</td>
                                                <td class="march"><h6><input class="form-control" type="text" name="search" id="department"></h6></td>
                                                <td class="march"><h6><input class="btn btn-default" type="submit"></h6></td>                                
                                            </tr>

                                            <tr class="table-row">
                                                <td class="table-img">
                                                    <input type="checkbox" id="selectall" onClick="selectAll(this)" >
                                                </td>
                                                <td class="table-text"><h6>Name</h6></td>
                                                <td class="table-text"><h6>Description</h6></td>
                                                <!--<td class="table-text"><h6>Status</h6></td>-->
                                            </tr>
                                            <?php
                                            $page = false;
                                            if (array_key_exists('page', $_GET)) {
                                                $page = $_GET['page'];
                                            }
                                            //  $page = $_GET["page"];
                                            if ($page == "" || $page == 1) {
                                                $page1 = 0;
                                            } else {
                                                $page1 = ($page * 5) - 5;
                                            }
                                            $query = mysql_query("SELECT * FROM `r_country` WHERE CONCAT( `country`) LIKE '%" . $search . "%' ")or die(mysql_error());
                                            if ($query) {

                                                if (mysql_num_rows($query) > 0) {
                                                    while ($row = mysql_fetch_assoc($query)) {
                                                        ?>
                                                        <tr class="table-row">
                                                            <td class="table-img"><input type="checkbox" name="colors[]"></td>
                                                            <td class="march"><h6><?=$row["name"] ?></h6></td>
                                                            <td><a href="country.php?id=<?= $row["id_country"] ?>&action=edit&page=<?echo "$page"?>"><span class="label label-primary">Edit</span><a/>
                                                                    <a href="country-controller.php?id=<?= $row["id_country"] ?>&action=delete&page=<?echo "$page"?>""><span class="label label-info">Delete</span></a>
                                                            </td>
                                                        </tr>
                                                        <?php }
                                                } else {
                                                    ?>
                                                    <tr class="table-row">
                                                        <td class="march"></td>
                                                        <td class="march"><h3>NO RESULTS MATCHING</h3></td>

                                                    <?php
                                                    }
                                                }
                                                ?>
                                        </table>
                                    </form>
                                    <?php
                                    $res1 = mysql_query("SELECT * FROM `r_country` WHERE CONCAT( `country`) LIKE '%" . $search . "%'");
                                    $count = mysql_num_rows($res1);
                                    //echo "$count";
                                    $a = $count / 5;
                                    $a = ceil($a);
									 if ($count > 5) {
                                    ?>
                                    <div class="horz-grid text-center">
                                        <ul class="pagination pagination-lg">

                                                <?php for ($b = 1; $b <= $a; $b++) { ?>
                                                    <?php if ($b == $page) { ?>
                                                    <li class="active"><a href="country.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a></li>    
                                                <?php } else { ?>
                                                    <li><a href="country.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a></li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
									 <? } ?>
									
                                </div>
                            </div>

                        </div>
                    </div>
                </div>



<?php } ?>

            <script language="JavaScript">
                function selectAll(source) {
                    checkboxes = document.getElementsByName('colors[]');
                    for (var i in checkboxes)
                        checkboxes[i].checked = source.checked;
                }
            </script>
<?php include_once('includes/footer.php'); ?>	

