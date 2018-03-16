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
					require_once('convert_time.php');
					$login_user_id = 0;
					//做子留言框顯示判斷

					if( isset($_COOKIE['certificate']) ){

						//用cookie中的certificate尋找登入者的nickname
						$user_stmt = $conn->prepare("SELECT id, nickname FROM $users_table AS user INNER JOIN $certificates_table ".
							"ON certificate = :certificate AND id = user_id");
						$user_stmt->bindParam(':certificate', $_COOKIE['certificate']);
						$user_stmt->execute();
						$user_stmt->setFetchMode(PDO::FETCH_ASSOC);

						//certificate比對正確，顯示撰寫留言框
						if( $user_stmt->rowCount() === 1){
							$user_row = $user_stmt->fetch();
							$login_user_id = $user_row['id'];

				?>
						
						<form action="insert_cmmt.php" method="post">
							<div class="cmmt__nickname">
								<?php echo $user_row['nickname'] ?>
								<span class="cmmt__logout">[ 登出 ]</span>
							</div>
							<textarea class="cmmt__textarea" name="content" placeholder="留言內容" required></textarea>
							<input type="hidden" name="parent_id" value='0' />
							<input class="cmmt__btn" type="submit" value="送 出" />
						</form>
				
				<?php
						}else{  //如果certificate比對不成功，顯示登入框
				?>

							<input class="cmmt__btn" type="button" value="登入以使用留言功能" onclick="location.href='login.php'" />
				
				<?php
						}						
					}else{  //沒有設定cookie，顯示登入框
				?> 

					
						<input class="cmmt__btn" type="button" value="登入以使用留言功能" onclick="location.href='login.php'" />
		
				<?php
					}
				?>

			</div>

			<?php
				
				//查詢主要留言筆數
				$pages_sql = "SELECT COUNT(parent_id) AS datanum FROM " . $cmmts_table . " WHERE parent_id = 0";
				$pages_result = $conn->query( $pages_sql );
				$pages_result->setFetchMode(PDO::FETCH_ASSOC);
				$pages_row = $pages_result->fetch();

				//確認總頁數
				$pagesnum = ceil ( $pages_row['datanum'] / 10 );

				//設定目前所在頁數
				if( !isset( $_GET['page'])) $page=1;
				else $page =  intval( $_GET['page'] );

				//查詢目前頁面需要的十筆主留言
				$cmmt_sql = "SELECT c.id AS cmmt_id, user_id, nickname, created_by, content FROM $cmmts_table AS c INNER JOIN" . 
						" $users_table ON parent_id = 0 AND user_id = $users_table.id ORDER BY created_by DESC " . 
						"LIMIT " . ($page-1)*10 . ", 10";

				$cmmt_result = $conn->query( $cmmt_sql );
				$cmmt_result->setFetchMode(PDO::FETCH_ASSOC);
				while( $cmmt_row = $cmmt_result->fetch()){
			?>

			<div class="cmmt-box">

				<!-- 顯示主要留言 -->
				<div class="cmmt__header">
					<div class="cmmt__nickname"><?php echo $cmmt_row["nickname"] ?></div>
					<div>
						<div class="cmmt__time"><?php echo convert_time( $cmmt_row["created_by"] ) ?></div>
						<div class="cmmt__edit-delete">

							<?php  //如果這條留言的user_id等於當前用戶的 user_id，則顯示編輯/刪除按鈕
								if( $cmmt_row['user_id'] === $login_user_id ){
								
									echo '<span class="cmmt__edit">編輯</span>&nbsp;/&nbsp;<span class="cmmt__delete">刪除</span>';
								}
							?>

						</div>
					</div>
				</div>
				<div class="cmmt__content"><?php echo $cmmt_row["content"] ?></div>
				<div class="cmmt__id"><?php echo $cmmt_row["cmmt_id"] ?></div>


				<!-- 顯示子留言 -->
				<?php 
					//查詢子留言
					$sub_sql = "SELECT c.id AS cmmt_id, user_id, nickname, created_by, content FROM $cmmts_table AS c INNER JOIN $users_table".
								" WHERE parent_id = " . $cmmt_row['cmmt_id'] . " AND user_id = $users_table.id".
								" ORDER BY created_by ASC";

					$sub_result = $conn->query($sub_sql );
					$sub_result->setFetchMode(PDO::FETCH_ASSOC);
					while( $sub_row = $sub_result->fetch() ){

						//如果是主留言者，則背景上色
						if( $sub_row['user_id'] === $cmmt_row['user_id'] ) echo '<div class="sub-cmmt sub-cmmt__main-author">';
						else echo '<div class="sub-cmmt">';

				?>

								<div class="cmmt__header">
									<div class="cmmt__nickname"><?php echo $sub_row["nickname"] ?></div>
									<div>	
										<div class="cmmt__time"><?php echo convert_time( $sub_row["created_by"] ) ?></div>
										<div class="cmmt__edit-delete">
											<?php  //如果這條留言的user_id等於當前用戶的 user_id，則顯示編輯/刪除按鈕
												if( $sub_row['user_id'] === $login_user_id ){
												
													echo '<span class="cmmt__edit">編輯</span>&nbsp;/&nbsp;<span class="cmmt__delete">刪除</span>';
												}
											?>
										</div>
									</div>
								</div>

								<div class="cmmt__content"><?php echo $sub_row["content"] ?></div>
								<div class="cmmt__id"><?php echo $sub_row["cmmt_id"] ?></div>
							</div> <!-- END of <div class="sub-cmmt"> -->

				<?php
					}
				?>
			
				<!-- 子留言的撰寫框 -->
				<div class="sub-cmmt">

					<?php
						if( $login_user_id ){
						
					?>

							<div class="sub-cmmt__collapse-toggle">回應[+]</div>
							<form action="insert_cmmt.php" method="post">
								<div class="cmmt__nickname"><?php echo $user_row['nickname'] ?></div>
								<textarea class="cmmt__textarea" name="content" placeholder="留言內容" required></textarea>
								<input type="hidden" name="parent_id" value=<?php echo $cmmt_row['cmmt_id'] ?> />
								<input class="cmmt__btn sub-cmmt__btn" type="submit" value="送 出" />
							</form>

					<?php
						}else{
					?>

						<a class="sub-cmmt__login-link" onclick="location.href='login.php'">
							登入以發表回應 
						</a>

					

							

					<?php
						}
					?>

				</div>

			</div>

			<?php
				} //END of while
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