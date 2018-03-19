## 請說明 SQL Injection 的攻擊原理以及防範方法    
**SQL Injection 的攻擊原理：**  
使用後端技術(例如：PHP)操作資料庫時，傳統上習慣使用動態串接字串的方式，來組合SQL語法，如：  
```
$sql = "SELECT username, password FROM $users_table WHERE username = '" . $_POST['username']."' AND password = '" . $_POST['password'] . "'";
```  
如果使用者在username的地方輸入`' OR 1=1 --` 則上面的指令會變成
`$sql = "SELECT id, username, password FROM '' OR 1=1 "`  
而讓惡意使用者有可能取得其他使用者的帳號密碼，更甚者可以竄改或是刪除資料庫內的資料。  

**SQL Injection 防範方法：**  
1. 使用參數化的查詢語法，例如 PHP 的 prepare statement，上面的例子可以改寫為：
```
$stmt = $conn->prepare("SELECT username, password FROM $users_table WHERE username=:username AND password=:password");
$stmt->bindParam(':username', $_POST['username']);
$stmt->bindParam(':password', $_POST['password']);
```
使用者輸入的資料透過參數的方式傳遞，而不會直接結合SQL查詢語法，以避免惡意使用者有機會植入攻擊性字串。  
2. 明確劃分資料庫使用者權限，避免一般使用者有機會執行權限外的動作。  
3. 對使用者輸入的資料作驗證，僅接受該輸入欄目所需要的合理值，可用的工具如 PHP 的 filter 或是使用正規表達式作驗證。  

## 請說明 XSS 的攻擊原理以及防範方法  
**XSS 的攻擊原理**  
利用網頁上的漏洞，將指令碼(通常是 javascript)植入網頁上，並在其他使用者瀏覽該網頁時執行植入的程式碼，以竊取使用者或是網站資料。例如在留言板的留言內容輸入
`<script>alert('document.cookie')</script>`，如果在網頁開發時沒有作特別處理的話，瀏覽器會將這段文字當作網頁內容，而執行 alert。如果在其中植入惡意程式碼，就有可能竊取使用者 cookie 內容。  

**XSS防範方法**  
在將經由使用者輸入的資料顯示於網頁上之前，使用`htmlspecialchars()`做轉換處理。`htmlspecialchars()` 會將 & " ' < > 等符號轉換為 html 實體，例如 < 轉換成 `&lt;`，而使瀏覽器將該筆資料作為文字資料顯示，而不會當作網頁程式碼。

## 請說明 CSRF 的攻擊原理以及防範方法
**CSRF 攻擊原理**  
利用瀏覽器在向網站發出 request 時，會將同網域的 cookie 一併送出的特性，來偽造使用者身分。
以使用者登入 A 網頁為例，A 網頁的伺服器在使用者登入時，會將認證資訊留存在 cookie 中，而在使用者未主動登出或是網頁設定時限未到之前，該 cookie 都算是合法認證。如果使用者在此時被誘導瀏覽或點擊了惡意使用者置入帶有向 A 網頁發出 request 的網頁時，因為瀏覽器有將 A 網頁設置的 cookie 資料一併送出，而讓 A 網頁誤以為該 request 是使用者發出的，而達到偽造使用者請求的目的。  

**CSRF 防範方法**  
1. 驗證 HTTP 的 Refer  
2. 在 HTTP Request 中加入惡意使用者無法偽造的資訊，例如：簡訊驗證碼、圖形驗證碼、CSRF Token等。CSRF Token 每次發送 Request 之前隨機產生，並隨著 Request 發送回伺服器，可與伺服器內的 CSRF Token 值比對，也可設定在 Cookie 中一併送回比對。重點在於可以分辨發送 Requrest 的是否是合法網域即可。  
3. 在設定 cookie 時，加上 SameSite 參數，可防止cookie 隨著跨站的 Request 發送。SameSite 有兩種模式，`SameSite=Strict` 限制了所有的跨站請求，而`SameSite=Lax`放寬了一些限制，如：`<a href="…">` `<link rel="prerender" href="…">` `<form method="get" action="…">`。不過目前並非所有的瀏覽器都支援 SameSite 參數，Chrome 51、Firefox 59、Opera 39 以上的瀏覽器已支援參數。

## 請舉出三種不同的雜湊函數
MD5、SHA-256、bcrypt


## 請去查什麼是 Session，以及 Session 跟 Cookie 的差別  
cookie 和 session 都是為了補強 HTTP stateless 特性，暫存資訊的文本文件。cookie 是留存在客戶端電腦中，隨著每次發送 request 時一併回送回伺服器，以查驗身分或是狀態；而 session 是將資訊儲存在伺服器端，透過亂數雜湊的 session_id 辨識不同的客戶端，預設session_id會留存在客戶端 cookie 的 PHPSESSID。

## `include`、`require`、`include_once`、`require_once` 的差別  
require 與 include 都是用來引入外部檔案，差別在於如果引入時發生錯誤，require 會中斷程式執行，並丟出錯誤(E_COMPILE_ERROR)，而include 並不會中斷程式的執行，而只是拋出警告(E_WARNING)並回傳false。
include_once和require_once 與上同，但會檢查是否已經在其他地方引入過了，而避免重複引入。


