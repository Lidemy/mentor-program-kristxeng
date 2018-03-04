## 資料庫欄位型態 VARCHAR 跟 TEXT 的差別是什麼  
- 在為 TEXT 型態設定index時，需要強制設定 prefix length (索引只會儲存前綴長度的資料，而不會把所有值拿來做索引)；而在VARCHAR型態設定 index 時，則沒有強制需設定 prefix length。  
- VARCHAR 與 TEXT 同為可變長度資料型態，但 VARCHAR 欄位在資料容量 255bytes 以內時，會使用 1 byte 的前綴來儲存資料長度，資料容量超過 255bytes 時，使用 2 bytes 的前綴；而 TEXT 無論資料容量大小，皆使用 2 bytes的前綴來儲存資料長度。  
- TEXT 欄位不能使用預設值，而 VARCHAR 則沒有此限制。  

## Cookie 是什麼？在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又會以什麼形式帶去 Server？  
- Cookie 是伺服器端透過瀏覽器儲存在用戶端電腦上的一小段資料文件。是純資料格式，而不含可執行代碼。  
- 伺服器使用發送稱為 set-cookie 的 http header ，來通知瀏覽器創建 cookie，並記錄該 cookie 隸屬的網域、路徑、過期時間和是否為安全連線等資訊。  
- 當瀏覽器再次向伺服器發出 request 時，瀏覽器會先確認目前是否有 cookie 需帶去伺服器；若有，則會將該 cookie 資訊包含在 http request header 的 cookie 項目中。  

## 我們本週實作的會員系統，你能夠想到什麼潛在的問題嗎？    
- 複製已登入使用者的 cookie，就可以不需要使用帳號密碼，取得登入狀態。或是修改 cookie 中 user_id 的值，就可以偽裝其他使用者的登入資格。  
- 使用者的密碼使用明碼儲存，登入資料庫的管理員都可以看到所有使用者的密碼。  

