<?php
$search_value = $_POST["search"];
$tbl_name = $_POST["table_name"];
//connection
session_start();
require_once("./config.php");

if ($tbl_name == "customer") {

    $query = "Select * from customer where customer_name like '%{$search_value}%' or designation like '%{$search_value}%'";
    $query_run = mysqli_query($con, $query);
    $output = "";
    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $output .= "
        ?>
            <tr>
            <td>{$row['customer_id']}</td>
            <td>{$row['customer_name']}</td>
            <td>{$row['customer_email']}</td>
            <td>{$row['contact_person']}</td>
            <td>{$row['designation']}</td>
            <td>{$row['company_address']}</td>
            <td>{$row['company_tel']}</td>
            <td>{$row['cell_number']}</td>
            </tr>
    <?php
    ";
        }
    } else {
        echo "No Record Found!";
    }
    mysqli_close($con);
    echo $output;
?>
    </tbody>
<?php

    //BUYER ITEM SEARCH

} else if ($tbl_name == "buyer_item") {
    $query = "Select * from buyer_item where buyer like '%{$search_value}%' or product like '%{$search_value}%' or customer like '%{$search_value}%'";
    $query_run = mysqli_query($con, $query);
    $output = "";
    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $output .= "
        ?>
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['segment']}</td>
                <td>{$row['buyer']}</td>
                <td>{$row['product']}</td>
                <td>{$row['customer']}</td>
                <td>{$row['quantity']}</td>
            </tr>
    <?php
    ";
        }
    } else {
        echo "No Record Found!";
    }
    mysqli_close($con);
    echo $output;
?>
    </tbody>
<?php
} else if ($tbl_name == "our_supplied") {
    $query = "Select * from our_supplied where segment like '%{$search_value}%' or product like '%{$search_value}%'";
    $query_run = mysqli_query($con, $query);
    $output = "";
    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $output .= "
        ?>
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['segment']}</td>
                <td>{$row['supplier']}</td>
                <td>{$row['customer']}</td>
                <td>{$row['product']}</td>
                <td>{$row['quantity']}</td>
            </tr>
    <?php
    ";
        }
    } else {
        echo "No Record Found!";
    }
    mysqli_close($con);
    echo $output;
?>
    </tbody>
<?php
} else if ($tbl_name == "buyer_quotation") {
    $query = "Select * from buyer_quotation where customer_name like '%{$search_value}%' or brand_name like '%{$search_value}%'";
    $query_run = mysqli_query($con, $query);
    $output = "";
    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $output .= "
        ?>
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['min_of_meeting']}</td>
                <td>{$row['s_no']}</td>
                <td>{$row['customer_name']}</td>
                <td>{$row['brand_name']}</td>
                <td>{$row['composition']}</td>
                <td>{$row['pack_size']}</td>
                <td>{$row['decision']}</td>
                <td>{$row['remarks']}</td>
            </tr>
    <?php
    ";
        }
    } else {
        echo "No Record Found!";
    }
    mysqli_close($con);
    echo $output;
?>
    </tbody>
<?php
} else if ($tbl_name == "supplier_item") {
    $query = "Select * from supplier_item where supplier like '%{$search_value}%' or product like '%{$search_value}%' or customer like '%{$search_value}%'";
    $query_run = mysqli_query($con, $query);
    $output = "";
    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $output .= "
        ?>
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['segment']}</td>
                <td>{$row['supplier']}</td>
                <td>{$row['product']}</td>
                <td>{$row['customer']}</td>
                <td>{$row['quantity']}</td>
            </tr>
    <?php
    ";
        }
    } else {
        echo "No Record Found!";
    }
    mysqli_close($con);
    echo $output;
?>
    </tbody>
<?php
} else if ($tbl_name == "dtl_supplier_item") {
    $query = "Select * from dtl_supplier_item where supplier like '%{$search_value}%' or product like '%{$search_value}%' or customer like '%{$search_value}%' or price like '%{$search_value}%'";
    $query_run = mysqli_query($con, $query);
    $output = "";
    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $output .= "
        ?>
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['segment']}</td>
                <td>{$row['supplier']}</td>
                <td>{$row['product']}</td>
                <td>{$row['customer']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['price']}</td>
            </tr>
    <?php
    ";
        }
    } else {
        echo "No Record Found!";
    }
    mysqli_close($con);
    echo $output;
?>
    </tbody>
<?php
} else if ($tbl_name == "supplier_db") {
    $query = "Select * from supplier_db where supplier_name like '%{$search_value}%' or product_name like '%{$search_value}%' or credentials like '%{$search_value}%'";
    $query_run = mysqli_query($con, $query);
    $output = "";
    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $output .= "
        ?>
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['supplier_name']}</td>
                <td>{$row['product_name']}</td>
                <td>{$row['pharmacopia']}</td>
                <td>{$row['credentials']}</td>
                <td>{$row['agency']}</td>
            </tr>
    <?php
    ";
        }
    } else {
        echo "No Record Found!";
    }
    mysqli_close($con);
    echo $output;
?>
    </tbody>
<?php
} else if ($tbl_name == "proposal") {
    $query = "Select * from proposal where customer like '%{$search_value}%' or supplier like '%{$search_value}%' or product like '%{$search_value}%' or concern_person like '%{$search_value}%'";
    $query_run = mysqli_query($con, $query);
    $output = "";
    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $output .= "
        ?>
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['sr_no']}</td>
                <td>{$row['date']}</td>
                <td>{$row['customer']}</td>
                <td>{$row['supplier']}</td>
                <td>{$row['product']}</td>
                <td>{$row['quantity_price']}</td>
                <td>{$row['follow_up_date']}</td>
                <td>{$row['concern_person']}</td>
                <td>{$row['reason']}</td>
            </tr>
    <?php
    ";
        }
    } else {
        echo "No Record Found!";
    }
    mysqli_close($con);
    echo $output;
?>
    </tbody>
<?php
} else if ($tbl_name == "dwr") {
    $query = "Select * from dwr where date like '%{$search_value}%' or supplier like '%{$search_value}%' or ccy like '%{$search_value}%' or uom like '%{$search_value}%'";
    $query_run = mysqli_query($con, $query);
    $query_runs = mysqli_query($con, $query);
    $output = "";
    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $output .= "
        ?>
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['date']}</td>
                <td>{$row['qty']}</td>
                <td>{$row['uom']}</td>
                <td>{$row['item']}</td>
                <td>{$row['ccy']}</td>
                <td>{$row['price']}</td>
                <td>{$row['pay_term']}</td>
                <td>{$row['supplier']}</td>
            </tr>
            <tr>
                <th>Remarks:</th>
                <td colspan='8'>{$row['remarks']}</td>
            </tr>
    <?php
    ";
        }
    } else {
        echo "No Record Found!";
    }
    mysqli_close($con);
    echo $output;
?>
    </tbody>
<?php
} else if ($tbl_name == "indent_register") {
    $query = "Select * from indent_register where indent_no like '%{$search_value}%' or supplier like '%{$search_value}%' or buyer like '%{$search_value}%' or currency like '%{$search_value}%' or ship_mode like '%{$search_value}%' or date like '%{$search_value}%'";
    $output = "";
    $outputs = "";
    $query_run = mysqli_query($con, $query);
    $query_runs = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $output .= "
        ?>
        <tr>
        <td>{$row['id']}</td>
        <td colspan='2'>{$row['indent_no']}</td>
        <td>{$row['buyer']}</td>
        <td>{$row['item']}</td>
        <td>{$row['quantity']}</td>
        <td>{$row['price']}</td>
        <td>{$row['value']}</td>
        <td>{$row['hs_code']}</td>
        <td>{$row['pay_term']}</td>
        <td>{$row['shipment']}</td>
        <td>{$row['invoice_no']}</td>
        <td>{$row['po_no']}</td>
    </tr>
    <?php
";
        }

$output .= "

    <thead>
    <tr>
        <th>INDENT DATE</th>
        <th>SUPPLIER</th>
        <th>ATTRIBUTE</th>
        <th>INSTANCE</th>
        <th>UOM </th>
        <th>CURRENCY</th>
        <th>SHIPMENT MODE</th>
        <th>PAYMENT TERM</th>
        <th>SHIPMENT MODE</th>
        <th>DATE</th>
        <th>EXPIRY DATE</th>
        <th>INVOICE DATE</th>
        <th>PO DATE</th>
    </tr>
    </thead>

";

        while ($rows = mysqli_fetch_assoc($query_runs)) {
            $outputs .= "
    ?>    
            <tr>
                <td>{$rows['indent_date']}</td>
                <td>{$rows['supplier']}</td>
                <td>{$rows['attribute']}</td>
                <td>{$rows['instance']}</td>
                <td>{$rows['uom']}</td>
                <td>{$rows['currency']}</td>
                <td>{$rows['ship_mode']}</td>
                <td>{$rows['payment_term']}</td>
                <td>{$rows['shipment_mode']}</td>
                <td>{$rows['date']}</td>
                <td>{$rows['exp_date']}</td>
                <td>{$rows['invoice_date']}</td>
                <td>{$rows['po_date']}</td>
            </tr>
    <?php    
    ";
        }
    } else {
        echo 'No Record Found!';
    }
    // mysqli_close($con);
    echo $output;
    echo $outputs;
?>
    </tbody>
<?php
}else if ($tbl_name == "pay_term") {
    $query = "Select * from payment_term where buyer like '%{$search_value}%' or supplier like '%{$search_value}%' or item like '%{$search_value}%' or currency like '%{$search_value}%'";
    $query_run = mysqli_query($con, $query);
    $query_runs = mysqli_query($con, $query);
    $output = "";
    if (mysqli_num_rows($query_run) > 0) {
        $counter=1;
        while ($row = mysqli_fetch_assoc($query_run)) {
            $output .= "
        ?>
        <tr>
        <td>{$row['id']}</td>
        <td>{$counter}</td>
        <td>{$row['order_no']}<br>{$row['order_date']}</td>
        <td>{$row['buyer']}<br>{$row['supplier']}</td>
        <td>{$row['quantity']}{$row['qty']}</td>
        <td>{$row['item']}<br>{$row['attribute_instance']}</td>
        <td>{$row['currency']}<br>{$row['price']}</td>
        <td>{$row['delivery_mech']}<br>{$row['payment_term']}</td>
        <td>{$row['delivery_period_b']}<br>{$row['delivery_period_s']}</td>
        <td>{$row['dwr_remarks']}</td>
        </tr>
    <?php
    $counter++;
    ";
        }
    } else {
        echo "No Record Found!";
    }
    mysqli_close($con);
    echo $output;
?>
    </tbody>
<?php
}
?>