<?php

class Menu {
 
    private $__conn = null;
     
    // Kết nối
    function connect(){
        $this->__conn  = mysqli_connect('localhost', 'root', '', 'ecommerce');
    }
     
    // Đóng kết nối
    function close(){
        mysqli_close($this->__conn);
    }
     
    // Lấy danh sách Menu trả về một mảng
    function getList()
    {
        $this->connect();
        $result = array();
         
        $query = mysqli_query($this->__conn, 'SELECT * FROM menu');
         
        if ($query){
            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                $result[] = $row;
            }
        }
        $this->close();
        return $result;
    }
}

$conn = new mysqli("localhost", "root", "", "ecommerce");
if(isset($_REQUEST['action'])) {
    //die($_POST['title'].",". $_POST['link'] . ",". $_POST['parent_id']);
    addMenu($_POST['title'], $_POST['link'], $_POST['parent_id']);
}


function addMenu($title, $link, $parent) {
    $query = "INSERT INTO menu VALUES (NULL, '$title', '$link', '$parent');";
    $conn->query($query);
    
}

function getParent($id) {
    $query = "SELECT * FROM menu WHERE menu_id = '$id'";
    $result = $conn->query($query);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $item[] = $row;
        }
    }
}

function showMenuLi($menus, $id_parent = 0) 
{
    # BƯỚC 1: LỌC DANH SÁCH MENU VÀ CHỌN RA NHỮNG MENU CÓ ID_PARENT = $id_parent
     
    // Biến lưu menu lặp ở bước đệ quy này
    $menu_tmp = array();
 
    foreach ($menus as $key => $item) {
        // Nếu có parent_id bằng với parrent id hiện tại
        if ((int) $item['menu_parent_id'] == (int) $id_parent) {
            $menu_tmp[] = $item;
            // Sau khi thêm vào biên lưu trữ menu ở bước lặp
            // thì unset nó ra khỏi danh sách menu ở các bước tiếp theo
            unset($menus[$key]);
        }
    }
 
    # BƯỚC 2: lẶP MENU THEO DANH SÁCH MENU Ở BƯỚC 1
     
    // Điều kiện dừng của đệ quy là cho tới khi menu không còn nữa
    if ($menu_tmp) 
    {
        foreach ($menu_tmp as $item) 
        {
            echo '<ul>';
            echo '<li class="list-group-item">';
            echo '<a href="' . $item['menu_link'] . '" style="text-decoration: none;">' . $item['menu_title'] . '</a>';
            echo '
            <form method="POST" action="./dequy.php?action=addMenu">
                <div>
                    <table border="0">
                        <tr>
                            <td>Title</td>
                            <td><input name="title" class="form-control" id="menu_title_' . $item['menu_id'] . '" value="' . $item['menu_title'] . '" /></td>
                        </tr>
                        <tr>
                            <td>Link</td>
                            <td><input name="link" class="form-control" id="menu_link_' . $item['menu_id'] . '" value="' . $item['menu_link'] . '" /></td>
                        </tr>
                        <tr>
                            <td>Parent</td>
                            <td>
                                <select name="parent_id" id="menu_parent_id_' . $item['menu_id'] . '">
                                </select></br></br>
                                <button type="submit" data-id="' . $item['menu_id'] . '" class="button menu-save btn btn-warning">Lưu</button
                            </td>
                        </tr>
                    </table>
                   </div>';
            // Gọi lại đệ quy
            // Truyền vào danh sách menu chưa lặp và id parent của menu hiện tại
            showMenuLi($menus, $item['menu_id']);
            echo '</li>';
            echo '</ul>';
        }
    }
}
// Đối tượng menu
$object = new Menu();
 
// Danh sách menu
$menus = $object->getList();
?>
 
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="style.css" rel="stylesheet"/>
         <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
         <script language="javascript">
             $(document).ready(function(){
                $('#menu_wrapper ul div').hide();
                $('#menu_wrapper ul li a').click(function(){
                    var tmp = $(this).next('div');
                    if ($(tmp).is(':visible')){
                        $(tmp).hide();
                    }
                    else{
                        $(tmp).show();
                    }
                    return false;
                }); 
             });
         </script>
    </head>
    <body>
        <div id="menu_wrapper">
            <?php showMenuLi($menus); ?>
        </div>
    </body>
</html>