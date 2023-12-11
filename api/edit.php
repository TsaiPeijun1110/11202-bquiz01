<?php
// 引入資料庫連線檔案
include_once "db.php";

// 從 POST 數據中取得資料表名稱
$table = $_POST['table'];

// 根據資料表名稱動態建立對應的資料表物件
$DB = ${ucfirst($table)};

// 刪除 $_POST 中的 'table' 鍵
unset($_POST['table']);

// 迴圈處理每一筆資料
foreach ($_POST['id'] as $key => $id) {
    // 如果 'del' 在 $_POST 中並且 $id 在 'del' 中，則刪除資料
    if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
        $DB->del($id);
    } else {
        // 取得資料表中該筆資料的原始資料
        $row = $DB->find($id);

        // 如果 'text' 在 $_POST 中，則更新原始資料的 'text' 欄位
        if (isset($row['text'])) {
            $row['text'] = $_POST['text'][$key];
        }

        // 根據資料表名稱進行不同的處理
        switch ($table) {
            case "title":
                // 如果 'sh' 在 $_POST 中並且 $_POST['sh'] 等於 $id，則設定 'sh' 為 1，否則為 0
                $row['sh'] = (isset($_POST['sh']) && $_POST['sh'] == $id) ? 1 : 0;
                break;
            case "admine":
                // 更新 'acc' 和 'pw' 欄位
                $row['acc'] = $_POST['acc'][$key];
                $row['pw'] = $_POST['pw'][$key];
                break;
            case "menu":
                $row['href']=$_POST['href'][$key];
                $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
                // 在 'menu' 資料表中沒有特別處理
             break;
            default:
                // 如果 'sh' 在 $_POST 中並且 $id 在 'sh' 中，則設定 'sh' 為 1，否則為 0
                $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
        }

        // 儲存更新後的資料
        $DB->save($row);
    }
}

// 轉址到指定的後台頁面
to("../back.php?do=$table");
?>
