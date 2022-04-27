<?php
require_once("./config.php");
function pr($arr)
{
    echo '<pre>';
    print_r($arr);
}

function prx($arr)
{
    echo '<pre>';
    print_r($arr);
    die();
}

function get_safe_value($con, $str)
{
    if ($str != '') {
        $str = trim($str);
        return mysqli_real_escape_string($con, $str);
    }
}

function get_product($con,$limit='',$cat_id='',$pro_id,$sort_order){
    $query = "Select product.*,category.category from product,category where product.p_status=1";
    if($cat_id!=""){
        $query.=" and product.cat_id=$cat_id";
        }
    if($pro_id!=""){
        $query.=" and product.p_id=$pro_id";
        }
        $query.=" and product.cat_id=category.c_id";
        if($sort_order!=""){
            $query.= $sort_order;
        }else{

            $query.=" order by product.p_id desc";
        }
    if($limit!=""){
    $query.=" limit $limit";
    }
    $fetch_pro = mysqli_query($con,$query);
    $data = array();
    while($row=mysqli_fetch_assoc($fetch_pro)){
        $data[]=$row;
    }
    return $data;
}
function best_sale($con,$limit='',$cat_id='',$pro_id,$sort_order){
    $query = "Select product.*,category.category from product,category where product.p_status=1";
    if($cat_id!=""){
        $query.=" and product.cat_id=$cat_id";
        }
    if($pro_id!=""){
        $query.=" and product.p_id=$pro_id";
        }
        $query.=" and product.cat_id=category.c_id";
        if($sort_order!=""){
            $query.= $sort_order;
        }else{

            $query.=" order by product.p_price desc";
        }
    if($limit!=""){
    $query.=" limit $limit";
    }
    $fetch_pro = mysqli_query($con,$query);
    $data = array();
    while($row=mysqli_fetch_assoc($fetch_pro)){
        $data[]=$row;
    }
    return $data;
}
function get_products($con,$limit='',$cat_id='',$pro_id,$search_str){
    $query = "Select product.*,category.category from product,category where product.p_status=1";
    if($cat_id!=""){
        $query.=" and product.cat_id=$cat_id";
        }
    if($pro_id!=""){
        $query.=" and product.p_id=$pro_id";
        }
        $query.=" and product.cat_id=category.c_id";
        if($search_str!=""){
            $query.=" and (product.p_name like '%$search_str%' or product.p_short_des like '%$search_str%')";
            }
    $query.=" order by product.p_id desc";
    //prx($query);

    if($limit!=""){
    $query.=" limit $limit";
    
    }
    $fetch_pro = mysqli_query($con,$query);
    $data = array();
    while($row=mysqli_fetch_assoc($fetch_pro)){
        $data[]=$row;
    }
    return $data;
}
