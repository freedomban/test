<?php


   //限制圖片型別格式，大小
   if ((($_FILES["file"]["type"] == "image/png")
   || ($_FILES["file"]["type"] == "image/jpeg")
   || ($_FILES["file"]["type"] == "image/jpg"))
   && ($_FILES["file"]["size"] < 200000)) {
            if ($_FILES["file"]["error"] > 0) {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
            } else {
                echo "檔名: " . $_FILES["file"]["name"] . "<br />";
                echo "檔案型別: " . $_FILES["file"]["type"] . "<br />";
                echo "檔案大小: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                echo "快取檔案: " . $_FILES["file"]["tmp_name"] . "<br />";

                //設定檔案上傳路徑，選擇指定資料夾

                if (file_exists("upload/" . $_FILES["file"]["name"])) {
                    echo $_FILES["file"]["name"] . " already exists. ";
                } else {
                    move_uploaded_file(
                        $_FILES["file"]["tmp_name"],
                        "upload" . $_FILES["file"]["name"]
                    );
                    echo "儲存於: " . "upload" . $_FILES["file"]["name"];//上傳成功後提示上傳資訊
                }
            }
        } else {
                echo "上傳失敗！";//上傳失敗後顯示錯誤資訊
            }
    //連結資料庫
    include('connect.php');

    //定義變數，儲存檔案上傳路徑，之後將變數寫進資料庫相應欄位即可
    $file = "../" . $_FILES["file"]["name"];
    $sql = "INSERT INTO `product_type` (`product_type_id`, `product_type_content`) VALUES ('' , '藝術家複製畫');";
    $sql = "INSERT INTO `product` (`product_id`, `product_name`, `artist`, `product_img`, `product_in_img_1`, `product_in_img_2`, `product_type`, `product_info`, `product_price`, `product_quantity`, `product_status`) VALUES (NULL, '商品1', 'vane', '$file', NULL, NULL, '', '複製畫', '1000', '20', '1')";

    $result = $conn->query($sql);
     
    // 確認是否有拿到結果
    
  if (!$result) {
    die($conn->error);
  }

    header("Refresh:1;url=./b_product.html");//成功插入資料後返回某個網頁







?>