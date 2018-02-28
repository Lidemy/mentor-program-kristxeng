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
		<div class="title">留言板</div>
		<div class="container">

			<!-- 主要留言的撰寫框 -->
			<div class="cmmt-box">
				<form action="insert_cmmt.php" method="post">
					<input class="nickname" name="nickname" type="text" placeholder="暱稱" required />
					<textarea class="content" name="content" placeholder="留言內容" required></textarea>
					<input type="hidden" name="parent_id" value='0' />
					<input type="submit" value="送 出" />
				</form>
			</div>


			<?php
				require_once('conn.php');

				//查詢主要留言筆數
				$pages_sql = "SELECT COUNT(parent_id) AS datanum FROM " . $table . " WHERE parent_id = 0";
				$pages_result = $conn->query( $pages_sql );
				$pages_row = $pages_result->fetch_assoc();

				//確認總頁數
				$pagesnum = ceil ( $pages_row['datanum'] / 10 );

				//設定目前所在頁數
				if( !isset( $_GET['page'])) $page=1;
				else $page =  intval( $_GET['page'] );

				//查詢目前頁面需要的十筆主留言
				$sql = "SELECT id, nickname, time, content FROM " . $table . " WHERE parent_id = 0 ORDER BY time DESC LIMIT " . ($page-1)*10 . ", 10";
				$result = $conn->query( $sql );

				if( $result->num_rows > 0 ){
					while( $row = $result->fetch_assoc()){
			?>

			<div class="cmmt-box">

				<!-- 顯示主要留言 -->
				<div class="nickname"><?php echo $row["nickname"]; ?></div>		
				<div class="time"><?php echo $row["time"]; ?></div>
				<hr>
				<div class="content"><?php echo $row["content"]; ?></div>

				<?php 
					//查詢子留言
					$sub_sql = "SELECT id, nickname, time, content FROM " . $table . " WHERE parent_id = " . $row['id'] . " ORDER BY time DESC";
					$sub_result = $conn->query($sub_sql);

					if( $sub_result->num_rows > 0 ){
						while( $sub_row = $sub_result->fetch_assoc() ){
				?>
							<!-- 子留言方塊 -->
							<div class="sub-cmmt">
								<div class="nickname"><?php echo $sub_row["nickname"]; ?></div>
								<div class="time"><?php echo $sub_row["time"]; ?></div>
								<hr>
								<div class="content"><?php echo $sub_row["content"]; ?></div>
							</div>

				<?php
						}
					}
				?>
				
				<!-- 子留言的撰寫框 -->
				<div class="sub-cmmt">
					<div class="box-collapse">回應▶</div>
					<form action="insert_cmmt.php" method="post">
						<input class="nickname" name="nickname" type="text" placeholder="暱稱" required />
						<textarea class="content" name="content" placeholder="留言內容" required></textarea>
						<input type="hidden" name="parent_id" value=<?php echo $row['id']; ?> />
						<input type="submit" value="送 出" />
					</form>
				</div>
			</div>

			<?php
					}
				}
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