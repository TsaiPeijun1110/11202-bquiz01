<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <!-- 動態文字廣告管理標題 -->
    <p class="t cent botli">動態文字廣告管理</p>
    
    <!-- 表單開始 -->
    <form method="post" action="./api/edit.php">
        <!-- 動態文字廣告顯示表格 -->
        <table width="100%" style="text-align: center">
            <tbody>
                <!-- 表頭 -->
                <tr class="yel">
                    <td width="80%">動態文字廣告</td>
                    <td width="10%">顯示</td>
                    <td width="10%">刪除</td>
                </tr>
                
                <?php               
                // 取得所有資料
                $rows = $DB->all();
                
                // 迴圈顯示每一筆資料
                foreach ($rows as $row) {
                ?>
                <tr>
                    <!-- 動態文字廣告輸入框 -->
                    <td>
                        <input type="text" name="text[]" style="width:90%" value="<?=$row['text'];?>">
                        
                        <!-- 資料 id 隱藏欄位 -->
                        <input type="hidden" name="id[]" value="<?=$row['id'];?>">
                    </td>
                    
                    <!-- 顯示與否的勾選框 -->
                    <td>
                        <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=($row['sh']==1)?'checked':'';?>>
                    </td>
                    
                    <!-- 刪除的勾選框 -->
                    <td>
                        <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        
        <!-- 操作按鈕區域 -->
        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <!-- 隱藏欄位，傳送表單的目標資料表名稱 -->
                    <input type="hidden" name="table" value="<?=$do;?>">
                    
                    <!-- 新增動態文字廣告按鈕 -->
                    <td width="200px"><input type="button" onclick="op('#cover','#cvr','./modal/<?=$do;?>.php?table=<?=$do;?>')" value="新增動態文字廣告"></td>
                    
                    <!-- 確定修改和重置按鈕 -->
                    <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
                </tr>
            </tbody>
        </table>
    </form>
    <!-- 表單結束 -->
</div>
