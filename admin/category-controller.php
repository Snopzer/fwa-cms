<?php

/*
  File name 		: 	category-controller.php
  Date Created          :	13-06-2016
  Date Updated          :	08-09-2016
  Description		:	Manage Category Operation Like Add/Edit/Delete Categories
 */
ob_start();
session_start();
include_once('../config.php');
include_once('../parameter.php');

if (!isset($_SESSION['id'])) {
    header('location:index.php');
}
if ($_POST['action'] == 'add') {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $meta_title = $conn->real_escape_string($_POST['meta_title']);
    $meta_keywords = $conn->real_escape_string($_POST['meta_keywords']);
    $meta_description = $conn->real_escape_string($_POST['meta_description']);
    $seo_url = $conn->real_escape_string($_POST['seo_url']);
    $status = $conn->real_escape_string($_POST['status']);
    $date_created = date('Y-m-d h:i:s');
    $sort_order = $_POST['sort_order'];

    $stmt = $conn->prepare("INSERT INTO r_category (name,description,date_created,meta_title,meta_keywords,meta_description,status,sort_order) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssss", $name, $description, $date_created, $meta_title, $meta_keywords, $meta_description, $status, $sort_order);
    $addCategory = $stmt->execute();
    if ($addCategory) {
        $categoryid = $conn->insert_id;
        if ($categoryid) {
            /* seo url start */
            $seo_url = strtolower(preg_replace('/\s+/', '-', $seo_url));
            $stmt = $conn->prepare("INSERT INTO  `r_seo_url` (seo_url ,`id_category`) VALUES (  '" . $seo_url . "',  '" . $categoryid . "')");
            $stmt->bind_param("ss", $seo_url, $categoryid);
            $stmt->execute();
            /* seo url end */

            /* upload photo if exist */
            if (isset($_FILES['photo']['name']) && $_FILES['photo']['name'] != '') { {
                    $temp = explode(".", $_FILES["photo"]["name"]);
                    $pic = $seo_url . '' . $categoryid . '.' . end($temp);

                    $stmt = $conn->prepare("update r_category SET image=? where id_category=?");
                    $stmt->bind_param("ss", $pic, $categoryid);
                    $stmt->execute();
                    move_uploaded_file($_FILES["photo"]["tmp_name"], "../images/category/" . $pic);
                }
            }
            $message = "<strong>Success!</strong> category Added Successfully.";
            header('location:' . SITE_ADMIN_URL . 'category.php?response=success&message=' . $message);
        } else {
            $message = "<strong>Success!</strong> category Not Added .Please check Carefully..";
            header('location:' . SITE_ADMIN_URL . 'posts.php?response=warning');
        }
    }
} else if ($_POST['action'] == 'edit') {
    $id = (int) $_POST['id'];
    if (isset($_FILES['photo']['name']) && $_FILES['photo']['name'] != '') {
        $removeimage = $_POST['preview_image'];
        $Path2 = "../images/category/" . $removeimage;
        unlink($Path2);
        $temp = explode(".", $_FILES["photo"]["name"]);
        $pic = $_POST['seo_url'] . '' . $id . '.' . end($temp);
        move_uploaded_file($_FILES["photo"]["tmp_name"], "../images/category/" . $pic);
    } else {
        $pic = $_POST['preview_image'];
    }

    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $meta_title = $conn->real_escape_string($_POST['meta_title']);
    $meta_keywords = $conn->real_escape_string($_POST['meta_keywords']);
    $meta_description = $conn->real_escape_string($_POST['meta_description']);
    $seo_url = $conn->real_escape_string($_POST['seo_url']);
    $status = $conn->real_escape_string($_POST['status']);
    $date_updated = date('Y-m-d h:i:s');
    $sort_order = $_POST['sort_order'];
    $stmt = $conn->prepare("update r_category SET name=?,description=?,meta_title=?,meta_keywords=?,meta_description=?,status=?,image=?,sort_order=? where id_category=?");
    $stmt->bind_param("sssssssss", $name, $description, $meta_title, $meta_keywords, $meta_description, $status, $pic, $sort_order, $id);
    $editCategory = $stmt->execute();

    if ($editCategory) {
        /* seo url start */
        $seo_url = strtolower(preg_replace('/\s+/', '-', $seo_url));
        $stmt = $conn->prepare("UPDATE  `r_seo_url` SET `seo_url`=? where id_category=?");
        $stmt->bind_param("ss", $seo_url, $id);
        $seoCheck = $stmt->execute();
        if ($conn->affected_rows != 1) {
            $stmt = $conn->prepare("INSERT INTO  `r_seo_url` (seo_url ,`id_category`) VALUES (?,?)");
            $stmt->bind_param("ss", $seo_url, $id);
            $stmt->execute();
        }
        /* seo url end */
        $message = "<strong>Success!</strong> Category Modified Successfully.";
        header('location:' . SITE_ADMIN_URL . 'category.php?response=success&message=' . $message);
    } else {
        $message = "<strong>Warning!</strong> Category Not Modified.Please check Carefully..";
        header('location:' . SITE_ADMIN_URL . 'category.php?response=danger&message=' . $message);
    }
} else if ($_REQUEST['action'] == 'delete') {
    $messageid = explode(",", $_REQUEST["chkdelids"]);
    $count = count($messageid);
    for ($i = 0; $i < $count; $i++) {
        $result2 = $conn->prepare("select image from r_category where id_category=?");
        $result2->bind_param("s", $messageid[$i]);
        $image =  $result2->fetch_assoc();
        $Path = "../images/category/" . $image['image'];
        unlink($Path);

        $stmt = $conn->prepare("DELETE FROM r_category WHERE id_category=?");
        $stmt->bind_param("s", $messageid[$i]);
        $Deleted =  $stmt->execute();
    }
    if ($Deleted) {
        $message = "<strong>Success!</strong> Category Deleted Successfully.";
        header('location:' . SITE_ADMIN_URL . 'category.php?response=success&message=' . $message);
    } else {
        $message = "<strong>Warning!</strong> Category Not Deleted. Please check Carefully.";
        header('location:' . SITE_ADMIN_URL . 'category.php?response=danger&message=' . $message);
    }
} else if ($_REQUEST['action'] == 'undo') { {
        $UndoDelete = $conn->query("update r_category SET deleted=0 ");
    }
    if ($UndoDelete) {
        $message = "<strong>Success!</strong> Categories Restored Successfully.";
        header('location:' . SITE_ADMIN_URL . 'category.php?response=success&message=' . $message);
    } else {
        $message = "<strong>Warning!</strong> Category Not Restored. Please check Carefully.";
        header('location:' . SITE_ADMIN_URL . 'category.php?response=danger&message=' . $message);
    }
}
/* end of file */ ?>