<!DOCTYPE html>
<html lang="zh-Hant-TW">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Kris's Comment Board</title>
		<meta name="description" content="This is Mentor Program Week5 hw2" />
		<link rel="stylesheet" type="text/css" href="style.css" />
		<script src="script.js"></script> 
	</head>
	<body>
		<div class="container">
			<div class="title">留言板</div>
			
			<!-- 主要留言的撰寫框 -->
			<div class="cmmt-box">

				<?php
					require_once('conn.php');

					if( !isset($_COOKIE['user_id']) ){
				?>
					<input class="cmmt-box__btn" type="button" value="登入以使用留言功能" onclick="location.href='login.php'" />

				<?php
					}else{ 

						//用cookie中的user_id尋找nickname
						$nickname_sql = "SELECT nickname FROM $users_table WHERE id = '" .$_COOKIE['user_id']. "'";
						$nickname_result = $conn->query($nickname_sql);
						$nickname_row = $nickname_result->fetch_assoc();
				?>
						
						<form action="insert_cmmt.php" method="post">
							<div class="cmmt-box__nickname">
								<?php echo $nickname_row['nickname'] ?>
								<span class="cmmt-box__logout"><a>[ 登出 ]</a></span>
							</div>
							<textarea class="cmmt-box__textarea" name="content" placeholder="留言內容" required></textarea>
							<input type="hidden" name="parent_id" value='0' />
							<input class="cmmt-box__btn" type="submit" value="送 出" />
						</form>
				<?php
					} //END of else
				?>

			</div>

			<?php
				
				//查詢主要留言筆數
				$pages_sql = "SELECT COUNT(parent_id) AS datanum FROM " . $cmmts_table . " WHERE parent_id = 0";
				$pages_result = $conn->query( $pages_sql );
				$pages_row = $pages_result->fetch_assoc();

				//確認總頁數
				$pagesnum = ceil ( $pages_row['datanum'] / 10 );

				//設定目前所在頁數
				if( !isset( $_GET['page'])) $page=1;
				else $page =  intval( $_GET['page'] );

				//查詢目前頁面需要的十筆主留言
				$sql = "SELECT c.id AS cmmt_id, nickname, time, content FROM $cmmts_table AS c INNER JOIN" . 
						" $users_table ON parent_id = 0 AND user_id = $users_table.id ORDER BY time DESC " . 
						"LIMIT " . ($page-1)*10 . ", 10";

				$result = $conn->query( $sql );
				if( $result->num_rows > 0 ){
					while( $row = $result->fetch_assoc()){
			?>

			<div class="cmmt-box">

				<!-- 顯示主要留言 -->
				<div class="cmmt-box__nickname"><?php echo $row["nickname"]; ?></div>		
				<div class="cmmt-box__time"><?php echo $row["time"]; ?></div>
				<hr>
				<div class="cmmt-box__content"><?php echo $row["content"]; ?></div>

					<?php 
						//查詢子留言
						$sub_sql = "SELECT nickname, time, content FROM $cmmts_table INNER JOIN $users_table" .
									" WHERE parent_id = " . $row['cmmt_id'] . " AND user_id = $users_table.id" .
									" ORDER BY time DESC";

						$sub_result = $conn->query($sub_sql);

						if( $sub_result->num_rows > 0 ){
							while( $sub_row = $sub_result->fetch_assoc() ){
					?>

								<!-- 子留言方塊 -->
								<div class="sub-cmmt">
									<div class="sub-cmmt__nickname"><?php echo $sub_row["nickname"]; ?></div>
									<div class="sub-cmmt__time"><?php echo $sub_row["time"]; ?></div>
									<hr>
									<div class="sub-cmmt__content"><?php echo $sub_row["content"]; ?></div>
								</div>

					<?php
							} //END of while
						} //END of if
					?>
				
				<!-- 子留言的撰寫框 -->
				<div class="sub-cmmt">

					<?php
						if( !isset($_COOKIE['user_id']) ){
						//如果未登入，顯示登入按鈕
					?>

						<a class="sub-cmmt__login-link" onclick="location.href='login.php'">
							登入以發表回應 
						</a>

					<?php
						}else{
						//如果已登入，則顯示撰寫留言框
					?>

							<div class="sub-cmmt__collapse-toggle">回應[+]</div>
							<form action="insert_cmmt.php" method="post">
								<div class="sub-cmmt__nickname"><?php echo $nickname_row['nickname'] ?></div>
								<textarea class="sub-cmmt__textarea" name="content" placeholder="留言內容" required></textarea>
								<input type="hidden" name="parent_id" value=<?php echo $row['cmmt_id']; ?> />
								<input class="sub-cmmt__btn" type="button" value="送 出" />
							</form>

					<?php
						}
					?>

				</div>

			</div>

			<?php
					} //END of while
				} //END of if
			?>

			<div class="pagesnum">
				<ul>

					<?php
						//設定頁碼
						for($i=1; $i <= $pagesnum; $i++ ){

							//如果是目前頁面的頁碼不做連結
							if( $i === $page ) echo "<li><b>[ $i ]</b></li>";

							else echo "<li><a href='index.php?page=" . $i . "'>" . $i . "</a></li>";
						}
					?>
					
				</ul>
			</div>
		</div>
	</body>
</html>